# VelocityNet Complaint Management System - Frontend Documentation

## 🏗️ **Professional Frontend Architecture**

This project uses a **professional hybrid approach** that separates frontend assets while maintaining the simplicity needed for a PHP-based project.

### **Directory Structure**
```
complaints_app/
├── frontend/                    # 🎨 Frontend assets (YOUR DOMAIN)
│   ├── css/
│   │   └── main.css            # Complete CSS framework
│   ├── js/
│   │   └── main.js             # Interactive functionality
│   └── components/             # Reusable PHP components
│       ├── alert.php           # Alert system
│       ├── badge.php           # Status badges
│       ├── button.php          # Button components
│       └── card.php            # Card layouts
├── view/                       # 📄 PHP templates (calls frontend)
│   ├── header.php              # Includes CSS/JS
│   ├── footer.php              # Page footer
│   ├── login.php               # Uses frontend components
│   └── ...                     # Other pages
├── model/                      # 🔧 Backend logic (teammate's domain)
├── controller/                 # 🔧 Backend logic (teammate's domain)
└── ...
```

## 🎯 **Why This Approach?**

### ✅ **Advantages**
- **Clear separation**: Frontend vs backend responsibilities
- **Team collaboration**: You can work independently in `frontend/`
- **Professional structure**: Industry-standard organization
- **Easy maintenance**: Styles and scripts in dedicated files
- **Reusable components**: Write once, use everywhere
- **Version control friendly**: Cleaner diffs and history

### 🔄 **How It Works**
1. **You work in** `frontend/` folder - this is your domain
2. **PHP templates** in `view/` call your frontend components
3. **Backend developers** work in `model/` and `controller/`
4. **Everyone stays** in their lane, minimal conflicts

## 🎨 **Design System Overview**

Built with the **Oatmeal-inspired design system** - a modern, professional dark theme:

- **Framework**: Tailwind CSS + Custom CSS
- **Theme**: Dark professional with blue/purple accents
- **Responsive**: Mobile-first design
- **Accessible**: WCAG compliant contrast and keyboard navigation

## 📚 **Component Library**

### **Using Reusable Components**

Instead of copy-pasting HTML, use these PHP components:

```php
<?php 
// Include components at the top of your PHP files
include_once('frontend/components/alert.php');
include_once('frontend/components/button.php');
include_once('frontend/components/badge.php');
include_once('frontend/components/card.php');
?>

<!-- Then use them like this: -->
<?php renderAlert('success', 'Account created successfully!'); ?>
<?php renderButton('primary', 'Submit Form', 'submit'); ?>
<?php renderStatusBadge(5, 'complaints'); ?>

<?php startCard('User Profile', 'Manage your account'); ?>
    <!-- Your content here -->
<?php endCard(); ?>
```

### **Available Components**

#### **Alerts** (`frontend/components/alert.php`)
```php
renderAlert('success|error|warning|info', 'Message', $dismissible = true)
```

#### **Buttons** (`frontend/components/button.php`)
```php
renderButton('primary|secondary|outline', 'Text', 'button|submit', $attributes)
renderLink('Text', 'href', 'primary|secondary|outline', $attributes)
```

#### **Badges** (`frontend/components/badge.php`)
```php
renderBadge('success|warning|error|info', 'Text')
renderStatusBadge($count, 'label')
renderPriorityBadge('low|medium|high|urgent')
```

#### **Cards** (`frontend/components/card.php`)
```php
startCard('Title', 'Subtitle', 'extra-classes')
endCard()
renderStatCard('Title', 'Value', $icon, 'primary|success|warning')
```

## 🎨 **Styling System**

### **CSS Classes** (in `frontend/css/main.css`)

```css
/* Layout */
.container, .page-header, .page-title, .page-subtitle

/* Cards */
.card, .card-header, .card-title, .card-body

/* Buttons */
.btn, .btn-primary, .btn-secondary, .btn-outline, .btn-sm, .btn-lg

/* Forms */
.form-group, .form-label, .form-input, .form-error, .form-success

/* Tables */
.data-table

/* Badges */
.badge, .badge-success, .badge-warning, .badge-error, .badge-info

/* Stats */
.stats-grid, .stat-card, .stat-icon, .stat-content
```

### **JavaScript Features** (in `frontend/js/main.js`)

```javascript
// Form validation
VelocityNet.validateForm()
VelocityNet.showAlert('success', 'Message')

// Table enhancements
VelocityNet.sortTable()
VelocityNet.filterTable()

// Loading states
VelocityNet.showLoading(element)
VelocityNet.hideLoading(element)

// AJAX helper
VelocityNet.request('/api/endpoint', options)
```

## 🚀 **Development Workflow**

### **For New Pages:**

1. **Create PHP template** in `view/new_page.php`:
   ```php
   <?php
   require_once("view/header.php");
   include_once('frontend/components/card.php');
   include_once('frontend/components/button.php');
   ?>

   <div class="container">
       <div class="page-header">
           <h1 class="page-title">Page Title</h1>
           <p class="page-subtitle">Description</p>
       </div>

       <?php startCard('Section Title', 'Section description'); ?>
           <!-- Your content -->
           <?php renderButton('primary', 'Action Button'); ?>
       <?php endCard(); ?>
   </div>

   <?php require_once("view/footer.php"); ?>
   ```

2. **Add custom styles** if needed in `frontend/css/main.css`
3. **Add interactions** if needed in `frontend/js/main.js`

### **For Styling Updates:**

1. **Global styles** → Edit `frontend/css/main.css`
2. **New components** → Create in `frontend/components/`
3. **Interactive features** → Add to `frontend/js/main.js`

### **Git Workflow:**

```bash
# Work on your branch
git checkout frontend-development

# Make changes in frontend/ folder
# Commit frequently with clear messages
git add frontend/
git commit -m "Add new button component styles"

# Push to share with team
git push origin frontend-development
```

## 📋 **Current Status**

### ✅ **Completed Pages**
- ✅ `header.php` - Navigation with responsive design
- ✅ `footer.php` - Professional footer
- ✅ `login.php` - Modern login form
- ✅ `register.php` - Multi-section registration
- ✅ `admin_technician_counts.php` - Dashboard with stats cards

### 🔄 **Pages Needing Styling**
- `complaint_create.php` - Complaint submission form
- `complaint_list.php` - Data table with filters
- `sitemap.php` - Navigation overview
- `admin_*.php` - Admin dashboard pages
- `technician_*.php` - Technician workflow pages
- `customer_*.php` - Customer portal pages

### 🎯 **Recommended Next Steps**

1. **Style complaint forms** using form components
2. **Create data tables** with sorting and filtering
3. **Add dashboard layouts** for admin pages
4. **Implement mobile responsiveness** testing
5. **Add form validation** with JavaScript

## 🤝 **Team Collaboration**

### **Frontend Developer (You):**
- Own the `frontend/` folder
- Update `view/` templates to use components
- Handle all styling and user interface
- Focus on user experience and design

### **Backend Developer (Teammate):**
- Own `model/` and `controller/` folders
- Handle database and business logic
- Provide data to templates
- Focus on functionality and security

### **Communication:**
- Use component functions instead of hardcoded HTML
- Document new components you create
- Test on multiple devices and browsers
- Review each other's work before merging

## 🔍 **Testing & Quality**

- **Browser testing**: Chrome, Firefox, Safari, Edge
- **Responsive testing**: Mobile, tablet, desktop
- **Accessibility**: Screen readers, keyboard navigation
- **Performance**: Fast loading, optimized assets

## 📞 **Questions?**

Feel free to:
- Check component examples in `frontend/components/`
- Refer to CSS classes in `frontend/css/main.css`
- Test JavaScript features in `frontend/js/main.js`
- Ask team questions about backend integration

---

**Happy coding!** 🎨✨
