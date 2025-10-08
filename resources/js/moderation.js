/**
 * Service de modération de contenu
 * Gère les vérifications avant soumission et les popups de rejet
 */
class ContentModerationService {
    constructor() {
        this.popup = document.getElementById('moderation-popup');
        this.reasonElement = document.getElementById('moderation-reason');
        this.editBtn = document.getElementById('moderation-edit-btn');
        this.closeBtn = document.getElementById('moderation-close-btn');
        this.currentCallback = null;
        
        this.initEventListeners();
    }
    
    initEventListeners() {
        // Fermer le popup
        this.closeBtn.addEventListener('click', () => this.hidePopup());
        this.popup.addEventListener('click', (e) => {
            if (e.target === this.popup) {
                this.hidePopup();
            }
        });
        
        // Bouton modifier
        this.editBtn.addEventListener('click', () => {
            this.hidePopup();
            if (this.currentCallback) {
                this.currentCallback();
            }
        });
        
        // Fermer avec Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !this.popup.classList.contains('hidden')) {
                this.hidePopup();
            }
        });
    }
    
    /**
     * Vérifie la modération d'un pseudonyme
     */
    async checkNickname(nickname) {
        return this.makeRequest('/moderation/nickname', { nickname });
    }
    
    /**
     * Vérifie la modération d'une proposition
     */
    async checkProposition(content, title = '') {
        return this.makeRequest('/moderation/proposition', { content, title });
    }
    
    /**
     * Vérifie la modération d'un commentaire
     */
    async checkComment(content) {
        return this.makeRequest('/moderation/comment', { content });
    }
    
    /**
     * Effectue la requête de modération
     */
    async makeRequest(endpoint, data) {
        try {
            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            });
            
            const result = await response.json();
            
            if (!response.ok) {
                throw new Error(result.message || 'Erreur de modération');
            }
            
            return result;
        } catch (error) {
            console.error('Erreur de modération:', error);
            // Fallback : approuver en cas d'erreur
            return { approved: true, reason: 'Modération indisponible' };
        }
    }
    
    /**
     * Affiche le popup de rejet
     */
    showPopup(reason, onEditCallback = null) {
        this.reasonElement.textContent = reason;
        this.currentCallback = onEditCallback;
        this.popup.classList.remove('hidden');
        
        // Focus sur le bouton modifier
        this.editBtn.focus();
    }
    
    /**
     * Masque le popup
     */
    hidePopup() {
        this.popup.classList.add('hidden');
        this.currentCallback = null;
    }
    
    /**
     * Modère du contenu avec gestion automatique du popup
     */
    async moderateWithPopup(type, data, onApproved, onEditCallback = null) {
        let result;
        
        switch (type) {
            case 'nickname':
                result = await this.checkNickname(data.nickname);
                break;
            case 'proposition':
                result = await this.checkProposition(data.content, data.title);
                break;
            case 'comment':
                result = await this.checkComment(data.content);
                break;
            default:
                throw new Error('Type de modération invalide');
        }
        
        if (result.approved) {
            onApproved();
        } else {
            this.showPopup(result.reason, onEditCallback);
        }
    }
}

// Instance globale du service de modération
window.moderationService = new ContentModerationService();

/**
 * Helper pour modérer avant soumission de formulaire
 */
function moderateFormSubmission(form, type, dataExtractor, onApproved) {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const data = dataExtractor(form);
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        
        // Indicateur de chargement
        submitBtn.disabled = true;
        submitBtn.textContent = 'Vérification...';
        
        try {
            await window.moderationService.moderateWithPopup(
                type,
                data,
                () => {
                    // Contenu approuvé : soumettre le formulaire
                    onApproved(form, data);
                },
                () => {
                    // Callback pour modification : focus sur le champ principal
                    const mainInput = form.querySelector('input[type="text"], textarea');
                    if (mainInput) {
                        mainInput.focus();
                    }
                }
            );
        } finally {
            // Restaurer le bouton
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        }
    });
}

// Export pour utilisation dans d'autres modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ContentModerationService;
}