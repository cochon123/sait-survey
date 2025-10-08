/**
 * Service de modération de contenu
 * Gère les vérifications avant soumission et les popups de rejet
 */
class ContentModerationService {
    constructor() {
        console.log('[Moderation] Initializing ContentModerationService');
        this.popup = document.getElementById('moderation-popup');
        this.reasonElement = document.getElementById('moderation-reason');
        this.editBtn = document.getElementById('moderation-edit-btn');
        this.closeBtn = document.getElementById('moderation-close-btn');
        this.currentCallback = null;
        
        console.log('[Moderation] Elements found:', {
            popup: !!this.popup,
            reasonElement: !!this.reasonElement,
            editBtn: !!this.editBtn,
            closeBtn: !!this.closeBtn
        });
        
        this.initEventListeners();
    }
    
    initEventListeners() {
        console.log('[Moderation] Initializing event listeners');
        
        if (!this.closeBtn || !this.popup || !this.editBtn) {
            console.error('[Moderation] Required elements not found for event listeners');
            return;
        }
        
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
        
        console.log('[Moderation] Event listeners initialized successfully');
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
        console.log('[Moderation] Making request to:', endpoint, 'with data:', data);
        
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            console.log('[Moderation] CSRF token found:', !!csrfToken);
            
            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(data)
            });
            
            console.log('[Moderation] Response status:', response.status, response.ok);
            
            const result = await response.json();
            console.log('[Moderation] Response data:', result);
            
            if (!response.ok) {
                throw new Error(result.message || 'Erreur de modération');
            }
            
            return result;
        } catch (error) {
            console.error('[Moderation] Request failed:', error);
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
        console.log('[Moderation] moderateWithPopup called:', { type, data });
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
                console.error('[Moderation] Invalid moderation type:', type);
                throw new Error('Type de modération invalide');
        }
        
        console.log('[Moderation] Moderation result:', result);
        
        if (result.approved) {
            console.log('[Moderation] Content approved, calling onApproved callback');
            onApproved();
        } else {
            console.log('[Moderation] Content rejected, showing popup with reason:', result.reason);
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
    console.log('[Moderation] moderateFormSubmission called for form:', form, 'type:', type);
    
    if (!form) {
        console.error('[Moderation] Form not found for moderation');
        return;
    }
    
    form.addEventListener('submit', async (e) => {
        console.log('[Moderation] Form submit event triggered');
        e.preventDefault();
        
        const data = dataExtractor(form);
        console.log('[Moderation] Extracted data:', data);
        
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        
        // Indicateur de chargement
        submitBtn.disabled = true;
        submitBtn.textContent = 'Vérification...';
        console.log('[Moderation] Submit button disabled, starting moderation');
        
        try {
            await window.moderationService.moderateWithPopup(
                type,
                data,
                () => {
                    console.log('[Moderation] Content approved, calling onApproved callback');
                    // Contenu approuvé : soumettre le formulaire
                    onApproved(form, data);
                },
                () => {
                    console.log('[Moderation] Content rejected, user can edit');
                    // Callback pour modification : focus sur le champ principal
                    const mainInput = form.querySelector('input[type="text"], textarea');
                    if (mainInput) {
                        mainInput.focus();
                    }
                }
            );
        } catch (error) {
            console.error('[Moderation] Error during moderation:', error);
        } finally {
            // Restaurer le bouton
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
            console.log('[Moderation] Submit button restored');
        }
    });
    
    console.log('[Moderation] Event listener added to form');
}

// Export pour utilisation dans d'autres modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ContentModerationService;
}