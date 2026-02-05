/**
 * VelocityNet Complaint Management System - Main JavaScript
 * Handles interactions, form validation, and dynamic updates
 */

// Global app object
const VelocityNet = {
    // Initialize the application
    init() {
        this.bindEvents();
        this.initializeComponents();
        console.log('VelocityNet complaint system initialized');
    },

    // Bind event listeners
    bindEvents() {
        // Mobile menu toggle
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', this.toggleMobileMenu);
        }

        // Form validation
        const forms = document.querySelectorAll('form[data-validate]');
        forms.forEach(form => {
            form.addEventListener('submit', this.validateForm);
        });

        // Dismiss alerts
        const dismissButtons = document.querySelectorAll('[data-dismiss="alert"]');
        dismissButtons.forEach(button => {
            button.addEventListener('click', this.dismissAlert);
        });

        // Confirmation dialogs
        const confirmButtons = document.querySelectorAll('[data-confirm]');
        confirmButtons.forEach(button => {
            button.addEventListener('click', this.confirmAction);
        });
    },

    // Initialize components
    initializeComponents() {
        this.initTooltips();
        this.initDataTables();
        this.initFormEnhancements();
    },

    // Mobile menu toggle
    toggleMobileMenu(e) {
        e.preventDefault();
        const menu = document.querySelector('.mobile-menu');
        if (menu) {
            menu.classList.toggle('hidden');
        }
    },

    // Form validation
    validateForm(e) {
        const form = e.target;
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        // Clear previous errors
        form.querySelectorAll('.form-error').forEach(error => {
            error.remove();
        });

        // Validate required fields
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                VelocityNet.showFieldError(field, 'This field is required');
                isValid = false;
            } else if (field.type === 'email' && !VelocityNet.isValidEmail(field.value)) {
                VelocityNet.showFieldError(field, 'Please enter a valid email address');
                isValid = false;
            }
        });

        if (!isValid) {
            e.preventDefault();
            VelocityNet.showAlert('error', 'Please fix the errors below and try again.');
        }
    },

    // Show field error
    showFieldError(field, message) {
        const errorElement = document.createElement('div');
        errorElement.className = 'form-error';
        errorElement.textContent = message;
        
        field.classList.add('border-red-500');
        field.parentNode.appendChild(errorElement);
    },

    // Email validation
    isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    },

    // Dismiss alert
    dismissAlert(e) {
        e.preventDefault();
        const alert = e.target.closest('.alert');
        if (alert) {
            alert.style.opacity = '0';
            alert.style.transform = 'translateX(100%)';
            setTimeout(() => {
                alert.remove();
            }, 300);
        }
    },

    // Confirmation dialog
    confirmAction(e) {
        const message = e.target.getAttribute('data-confirm');
        if (!confirm(message)) {
            e.preventDefault();
            return false;
        }
        return true;
    },

    // Show dynamic alert
    showAlert(type, message) {
        const alertContainer = document.querySelector('.alert-container') || document.body;
        const alertElement = document.createElement('div');
        
        const alertClasses = {
            'success': 'alert alert-success',
            'error': 'alert alert-error',
            'warning': 'alert alert-warning',
            'info': 'alert alert-info'
        };

        const icons = {
            'success': '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>',
            'error': '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
            'warning': '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L12.732 3.5c-.77-.833-1.964-.833-2.732 0L1.732 17.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>',
            'info': '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
        };

        alertElement.className = alertClasses[type] || alertClasses['info'];
        alertElement.innerHTML = `
            ${icons[type] || icons['info']}
            <div>
                <p class="text-sm">${message}</p>
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg p-1.5 inline-flex h-8 w-8 hover:bg-gray-700" onclick="this.parentElement.remove()">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        `;

        alertContainer.appendChild(alertElement);

        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            if (alertElement.parentNode) {
                alertElement.style.opacity = '0';
                alertElement.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    alertElement.remove();
                }, 300);
            }
        }, 5000);
    },

    // Initialize tooltips
    initTooltips() {
        const tooltipElements = document.querySelectorAll('[data-tooltip]');
        tooltipElements.forEach(element => {
            element.addEventListener('mouseenter', this.showTooltip);
            element.addEventListener('mouseleave', this.hideTooltip);
        });
    },

    // Show tooltip
    showTooltip(e) {
        const tooltip = document.createElement('div');
        tooltip.className = 'tooltip';
        tooltip.textContent = e.target.getAttribute('data-tooltip');
        tooltip.style.cssText = `
            position: absolute;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            z-index: 1000;
            pointer-events: none;
        `;

        document.body.appendChild(tooltip);

        const rect = e.target.getBoundingClientRect();
        tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
        tooltip.style.top = rect.top - tooltip.offsetHeight - 5 + 'px';

        e.target._tooltip = tooltip;
    },

    // Hide tooltip
    hideTooltip(e) {
        if (e.target._tooltip) {
            e.target._tooltip.remove();
            delete e.target._tooltip;
        }
    },

    // Initialize data tables
    initDataTables() {
        const tables = document.querySelectorAll('.data-table');
        tables.forEach(table => {
            this.enhanceTable(table);
        });
    },

    // Enhance table with sorting and filtering
    enhanceTable(table) {
        // Add sorting to headers
        const headers = table.querySelectorAll('th[data-sortable]');
        headers.forEach(header => {
            header.style.cursor = 'pointer';
            header.addEventListener('click', () => {
                this.sortTable(table, header);
            });
        });

        // Add search if search input exists
        const searchInput = document.querySelector(`[data-table="${table.id}"]`);
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                this.filterTable(table, e.target.value);
            });
        }
    },

    // Sort table
    sortTable(table, header) {
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        const index = Array.from(header.parentNode.children).indexOf(header);
        const isAscending = !header.classList.contains('sort-desc');

        rows.sort((a, b) => {
            const aText = a.children[index].textContent.trim();
            const bText = b.children[index].textContent.trim();
            
            // Try to parse as numbers
            const aNum = parseFloat(aText);
            const bNum = parseFloat(bText);
            
            if (!isNaN(aNum) && !isNaN(bNum)) {
                return isAscending ? aNum - bNum : bNum - aNum;
            }
            
            return isAscending ? 
                aText.localeCompare(bText) : 
                bText.localeCompare(aText);
        });

        // Update header sort indicator
        table.querySelectorAll('th').forEach(th => {
            th.classList.remove('sort-asc', 'sort-desc');
        });
        header.classList.add(isAscending ? 'sort-asc' : 'sort-desc');

        // Reorder rows
        rows.forEach(row => tbody.appendChild(row));
    },

    // Filter table
    filterTable(table, searchTerm) {
        const tbody = table.querySelector('tbody');
        const rows = tbody.querySelectorAll('tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const matches = text.includes(searchTerm.toLowerCase());
            row.style.display = matches ? '' : 'none';
        });
    },

    // Initialize form enhancements
    initFormEnhancements() {
        // Auto-resize textareas
        const textareas = document.querySelectorAll('textarea[data-auto-resize]');
        textareas.forEach(textarea => {
            textarea.addEventListener('input', this.autoResizeTextarea);
        });

        // Character counters
        const countElements = document.querySelectorAll('[data-character-count]');
        countElements.forEach(element => {
            const maxLength = element.getAttribute('maxlength');
            if (maxLength) {
                this.addCharacterCounter(element, maxLength);
            }
        });
    },

    // Auto-resize textarea
    autoResizeTextarea(e) {
        e.target.style.height = 'auto';
        e.target.style.height = e.target.scrollHeight + 'px';
    },

    // Add character counter
    addCharacterCounter(element, maxLength) {
        const counter = document.createElement('div');
        counter.className = 'character-counter text-sm text-gray-400 mt-1';
        element.parentNode.appendChild(counter);

        const updateCounter = () => {
            const remaining = maxLength - element.value.length;
            counter.textContent = `${remaining} characters remaining`;
            counter.className = remaining < 10 ? 
                'character-counter text-sm text-red-400 mt-1' : 
                'character-counter text-sm text-gray-400 mt-1';
        };

        element.addEventListener('input', updateCounter);
        updateCounter();
    },

    // Loading state management
    showLoading(element) {
        element.classList.add('loading');
        element.disabled = true;
    },

    hideLoading(element) {
        element.classList.remove('loading');
        element.disabled = false;
    },

    // AJAX helper
    async request(url, options = {}) {
        const defaultOptions = {
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        };

        try {
            const response = await fetch(url, { ...defaultOptions, ...options });
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            return await response.json();
        } catch (error) {
            console.error('Request failed:', error);
            this.showAlert('error', 'An error occurred. Please try again.');
            throw error;
        }
    }
};

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    VelocityNet.init();
});

// Export for use in other scripts
window.VelocityNet = VelocityNet;
