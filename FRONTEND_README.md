# VelocityNet Complaint Management System - Frontend Documentation

## Design System Overview

This project uses the **Oatmeal-inspired design system** - a modern, professional dark theme built with Tailwind CSS. The design focuses on:

- **Professional appearance** suitable for business applications
- **Dark theme** for reduced eye strain during long work sessions  
- **Responsive design** that works on desktop, tablet, and mobile
- **Accessibility** with proper contrast ratios and keyboard navigation

## Color Palette

### Primary Colors
- **Blue Gradient**: `from-blue-600 to-purple-600` - Used for primary actions
- **Background**: Dark grays (`bg-gray-900`, `bg-gray-800`)
- **Text**: White and gray variants for hierarchy

### Status Colors
- **Success**: Green (`text-green-400`, `bg-green-500/20`)
- **Warning**: Yellow (`text-yellow-400`, `bg-yellow-500/20`) 
- **Error**: Red (`text-red-400`, `bg-red-500/20`)
- **Info**: Blue (`text-blue-400`, `bg-blue-500/20`)

## Component Library

### Buttons
```html
<!-- Primary Button -->
<button class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-[1.02]">
    Primary Action
</button>

<!-- Secondary Button -->
<button class="bg-gray-700 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200">
    Secondary Action
</button>
```

### Cards
```html
<div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl shadow-xl p-6">
    <!-- Card content -->
</div>
```

### Form Inputs
```html
<input class="w-full px-3 py-3 bg-gray-900/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" />
```

### Status Badges
```html
<!-- Success -->
<span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-green-500/20 text-green-400">
    Active
</span>

<!-- Warning -->
<span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-yellow-500/20 text-yellow-400">
    Pending  
</span>

<!-- Error -->
<span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-red-500/20 text-red-400">
    Error
</span>
```

### Data Tables
```html
<div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl shadow-xl overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-900/50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                    Column Header
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-700">
            <tr class="hover:bg-gray-700/30 transition-colors duration-200">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                    Cell Content
                </td>
            </tr>
        </tbody>
    </table>
</div>
```

## Page Structure

All pages follow this consistent structure:

1. **Header** (`view/header.php`):
   - Navigation bar with logo and menu items
   - Responsive mobile menu
   - Authentication links

2. **Main Content** (wrapped in `<main>` with proper spacing)
   - Page title and description
   - Content sections with appropriate cards/containers

3. **Footer** (`view/footer.php`):
   - Copyright information
   - Quick navigation links

## File Organization

```
complaints_app/
├── view/
│   ├── header.php          # Main header with navigation
│   ├── footer.php          # Footer component
│   ├── login.php           # ✅ Updated with new design
│   ├── register.php        # ✅ Updated with new design  
│   ├── admin_technician_counts.php  # ✅ Updated with new design
│   └── [other_pages.php]   # 🔄 Need styling updates
├── assets/
│   └── styles.css          # ✅ Custom CSS for additional styling
└── [other_directories]/
```

## Implementation Guidelines

### For New Pages
1. Include the header: `require_once("view/header.php");`
2. Wrap content in semantic sections with proper spacing
3. Use consistent card styling for content blocks
4. Apply responsive classes for mobile compatibility
5. Include the footer: `require_once("view/footer.php");`

### For Forms
- Use proper labels and input styling
- Include validation state classes
- Add loading states for submit buttons
- Group related fields logically

### For Data Display
- Use responsive tables with hover effects
- Include empty states with helpful messaging
- Add status indicators with appropriate colors
- Implement proper pagination if needed

## Accessibility Features

- **High contrast** text and backgrounds
- **Keyboard navigation** support
- **Screen reader** compatible markup
- **Focus indicators** on interactive elements
- **Semantic HTML** structure

## Browser Support

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

## Next Steps

1. **Continue styling remaining pages** in the same design system
2. **Add JavaScript interactions** for enhanced UX
3. **Implement responsive mobile menu** functionality
4. **Add form validation feedback** with proper styling
5. **Create reusable components** for common UI patterns

## Team Workflow

1. Work on your `frontend-development` branch
2. Make small, focused commits for each page/component
3. Test responsive design on multiple screen sizes
4. Request review before merging to main branch
5. Document any new components or patterns you create

---

**Questions or suggestions?** Feel free to reach out to discuss design decisions or implementation details!
