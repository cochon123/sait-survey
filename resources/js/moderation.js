/**
 * Content moderation service
 * Handles pre-submission checks and rejection popups
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
        // Close the popup
        this.closeBtn.addEventListener('click', () => this.hidePopup());
        this.popup.addEventListener('click', (e) => {
            if (e.target === this.popup) {
                this.hidePopup();
            }
        });
        
        // Edit button
        this.editBtn.addEventListener('click', () => {
            this.hidePopup();
            if (this.currentCallback) {
                this.currentCallback();
            }
        });
        
        // Close with Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !this.popup.classList.contains('hidden')) {
                this.hidePopup();
            }
        });
    }
    
    /**
     * Check nickname moderation
     */
    async checkNickname(nickname) {
        return this.makeRequest('/moderation/nickname', { nickname });
    }
    
    /**
     * Check proposition moderation
     */
    async checkProposition(content, title = '') {
        return this.makeRequest('/moderation/proposition', { content, title });
    }
    
    /**
     * Check comment moderation
     */
    async checkComment(content) {
        return this.makeRequest('/moderation/comment', { content });
    }
    
    /**
     * Make moderation request
     */
    async makeRequest(endpoint, data) {
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(data)
            });
            
            const result = await response.json();
            
            if (!response.ok) {
                throw new Error(result.message || 'Moderation error');
            }
            
            return result;
        } catch (error) {
            // Fallback: approve on error
            return { approved: true, reason: 'Moderation unavailable' };
        }
    }
    
    /**
     * Show rejection popup
     */
    showPopup(reason, onEditCallback = null) {
        this.reasonElement.textContent = reason;
        this.currentCallback = onEditCallback;
        this.popup.classList.remove('hidden');
        
        // Focus on edit button
        this.editBtn.focus();
    }
    
    /**
     * Hide popup
     */
    hidePopup() {
        this.popup.classList.add('hidden');
        this.currentCallback = null;
    }
    
    /**
     * Set up form moderation
     */
    setupFormModeration(formSelector, config) {
        const form = document.querySelector(formSelector);
        if (!form) return;
        
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn?.textContent || 'Submit';
        
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Verifying...';
            }
            
            try {
                // Get form data
                const formData = config.getData(form);
                
                // Check moderation
                let result;
                if (config.type === 'nickname') {
                    result = await this.checkNickname(formData.nickname);
                } else if (config.type === 'proposition') {
                    result = await this.checkProposition(formData.content, formData.title);
                } else if (config.type === 'comment') {
                    result = await this.checkComment(formData.content);
                }
                
                if (result.approved) {
                    config.onSuccess(form, formData);
                } else {
                    this.showPopup(result.reason, () => {
                        // Focus on the input field when editing
                        const input = form.querySelector(config.inputSelector);
                        if (input) input.focus();
                    });
                }
            } catch (error) {
                config.onError?.(error);
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                }
            }
        });
    }
}

// Global instance for moderation
window.moderation = new ContentModerationService();

// Auto-setup for proposition forms
document.addEventListener('DOMContentLoaded', function() {
    // Configuration for proposition forms
    window.moderation.setupFormModeration('#proposition-form', {
        type: 'proposition',
        inputSelector: '#content',
        getData: (form) => {
            const content = form.querySelector('#content')?.value?.trim() || '';
            return { content, title: '' };
        },
        onSuccess: (form) => {
            // Submit form normally
            const formData = new FormData(form);
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    throw new Error('Submission error');
                }
            })
            .catch(() => {
                alert('An error occurred during submission');
            });
        },
        onError: () => {
            alert('An error occurred during verification');
        }
    });
});