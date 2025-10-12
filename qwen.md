---
description: Project overview and requirements for the Campus Voice application
applyTo: '**'
---

# Campus Voice Project

A mobile-first survey application for students at SAIT university.

The objective is to build a light mobile-first web application to collect student idea about how we can make life as a sait student better

## Project Requirements

### Home Page
- Page to view student propositions from other users
- Guest users can see all posts exactly like connected users
- Guest users cannot post or vote on propositions (If the try, a popup appear proposing them to sign in)
- Clear call-to-action for registration/login

### Detail Page
- Comprehensive project information page
- Overview of the AI assistant project
- Current features and future development plans
- Ways for students to get involved

### Authentication System
- Login page with message: "Be one of the first to Join the project"
- Google OAuth authentication
- Email and password authentication
- Nickname requirement during registration
- User registration and login functionality

### Propositions Page
- Page to view student propositions for the app
- Authenticated users can submit new propositions
- Upvoting and downvoting functionality (authenticated users only)
- Animations for voting interactions
- Sorting options (top voted, most recent)
- Display of proposer's nickname
- Admin-only view of proposer's email
- Status system for propositions (zero, one, two, ready, not possible)
- Status are recongized by thier color
- at the bottom of the page there is a text input for posting our own message
- use pusher to broadcast the event of posting and upvoting or downvoting

### Admin Features
- Admin user role with special privileges
- Ability to update proposition
- User identification capabilities (admin only)

## Technical Implementation

### Backend
- Laravel PHP framework
- MySQL database
- Laravel Breeze for authentication scaffolding
- Socialite for Google OAuth integration

### Frontend
- Tailwind CSS for styling
- Responsive design
- Interactive JavaScript components

### Database Seeding
- 50 users (1 admin, 10 without accounts, 39 regular users)
- 3 propositions per user (150 total)
- Name suggestions for naming the AI assistant
- Random upvotes and downvotes for testing

## Progress Tracking

(Nothing to say for now.)

## Project Structure
- Laravel backend with MySQL database
- Tailwind CSS for frontend styling
- Laravel Breeze for authentication
- Socialite for Google OAuth
- MVC architecture pattern

## Testing Data
The database has been seeded with:
- 50 users (1 admin, 10 without accounts, 39 regular users)
- 150 propositions (3 per user)
- Random votes on propositions

## Typical user journey
- going to the url and seeing a landing page with sait colors and sait photos
- clicking a button to see the proposition page full of ideas written by other student
- attemping to upvoting and downvoting some ideas or creating his own
- seeing a popup asking him to create an account
- creating an account with google
- seeing the proposition page full of content created by other users
- upvoting and downvoting some ideas
- creating his own (waiting one day to create another proposition (to avoid spam))

## Some instruction
1. do not run "php artisan serve" (it is already running)
2. do not run "npm run dev" (it is already running)
3. use good laravel practice (Laravel12)
4. do not self commit on git.
5. The `.ssh` folder is in .gitignore - it's normal to have SSH keys locally for deployment, but they won't be committed to git

## Clean Commit Process
When the user asks to "make a clean commit", follow this comprehensive cleanup process:

### 1. Security Analysis
- Run security scanning tools (like Codacy with Trivy) to identify vulnerabilities
- Check for exposed API keys, secrets, or sensitive data in code
- Verify proper input validation and sanitization
- Review authentication and authorization mechanisms

### 2. Code Cleanup
- Remove all console.log(), var_dump(), dd(), dump() and other debug statements
- Remove commented-out code blocks that are no longer needed
- Remove temporary files and unused imports
- Clean up unnecessary whitespace and formatting inconsistencies
- Remove any TODO comments that have been completed

### 3. File Organization
- Remove test files that were created during development but not needed in production
- Clean up temporary or backup files (*.bak, *.tmp, etc.)
- Ensure proper file structure and organization
- Remove empty directories or unused assets

### 4. Code Quality
- Check for unused variables, functions, and classes
- Ensure consistent code formatting
- Verify proper error handling
- Remove redundant or duplicate code

### 5. Documentation
- Update comments to reflect current functionality
- Ensure README and documentation are current
- Remove outdated or misleading comments

### 6. Final Verification
- Run basic functionality tests to ensure nothing is broken
- Verify all routes and main features still work
- Check that no critical functionality was accidentally removed

Only after completing ALL these steps should the commit be made with a clear, descriptive commit message.

---
description: Design system and visual guidelines for the Campus Voice application
applyTo: '**'
---

# SAIT Survey Design System

This design system is based on HSL (Hue, Saturation, Lightness) color model principles, emphasizing systematic shade generation and realistic depth perception for a "frosted glass" aesthetic.

## I. Core Color Palette & Philosophy

The color palette uses a neutral base with a subtle tint (White Lilac) and a distinct brand accent, designed for both light and dark modes.

### A. Color Format Choice

We use **HSL** (Hue, Saturation, Lightness) for predictable and intuitive design, making it easy to create consistent light and dark modes by manipulating only the **Lightness** value.

### B. Defining The Colors (CSS Variables)

The colors are defined using CSS custom properties within root and light-mode selectors, suitable for Tailwind CSS theme configuration.

| Variable | Neutral HSL Values (Hue: 250, Saturation: 5%) | Brand HSL Values (Hue: 60, Saturation: 90%) |
| :--- | :--- | :--- |
| **Theme Base Hue** | `--hue-n: 250` | `--hue-b: 60` |
| **Theme Base Saturation** | `--sat-n: 5%` | `--sat-b: 90%` |

### C. Theme Implementation (HSL Lightness)

The **lightness value** is flipped between dark and light themes, maintaining the depth hierarchy across both.

| Variable | Dark Mode (Default) | Light Mode (`body.light`) | Purpose |
| :--- | :--- | :--- | :--- |
| `--bg-dark` | `hsl(var(--hue-n), var(--sat-n), 5%)` | `hsl(var(--hue-n), var(--sat-n), 95%)` | **Page Background** (Farthest from user) |
| `--bg` | `hsl(var(--hue-n), var(--sat-n), 10%)` | `hsl(var(--hue-n), var(--sat-n), 90%)` | **Base Card/Panel** (Middle layer) |
| `--bg-light` | `hsl(var(--hue-n), var(--sat-n), 15%)` | `hsl(var(--hue-n), var(--sat-n), 85%)` | **Interactive/Elevated Elements** (Closest to user) |
| `--text` | `hsl(var(--hue-n), var(--sat-n), 95%)` | `hsl(var(--hue-n), var(--sat-n), 5%)` | **Sharp Text** (High Contrast Headings) |
| `--text-muted` | `hsl(var(--hue-n), var(--sat-n), 70%)` | `hsl(var(--hue-n), var(--sat-n), 30%)` | **Muted Text** (Paragraphs, Secondary Info) |
| `--brand` | `hsl(var(--hue-b), var(--sat-b), 55%)` | `hsl(var(--hue-b), var(--sat-b), 45%)` | **Primary Action** (Yellow Accent) |

## II. Depth & "Frosted Glass" Logic

Elements closer to the user appear *lighter* in dark mode and *darker* in light mode. The "Frosted Glass" effect is achieved via shadows and background transparency/blur.

### A. Background/Depth Layering

1. **Base Layer (Page):** Use `--bg-dark` (the darkest shade)
2. **Middle Layer (Card):** Use `--bg` (slightly lighter shade, creating contrast/separation)
3. **Top Layer (Input/Button):** Use `--bg-light` (lightest shade, creating highest perceived elevation)

### B. Shadow Variables

Combining darker/shorter & lighter/longer shadows creates natural depth.

| Variable | Shadow Value | Purpose |
| :--- | :--- | :--- |
| `--shadow-s` | `0 2px 4px hsla(0, 0%, 0%, 0.1), 0 1px 0 hsla(0, 0%, 100%, 0.1)` | Small, subtle shadow for interactive elements |
| `--shadow-m` | `0 4px 8px hsla(0, 0%, 0%, 0.15), 0 2px 0 hsla(0, 0%, 100%, 0.1)` | Medium shadow for main cards/sections |
| `--shadow-inset-light` | `inset 0 1px 0 hsla(0, 0%, 100%, 0.4)` | Top light highlight (simulates light source) |
| `--shadow-inset-dark` | `inset 0 -1px 0 hsla(0, 0%, 0%, 0.4)` | Bottom dark highlight (simulates shadow) |

### C. Frosted Glass Implementation

The frosted glass look requires **three** properties:

1. **Slight Transparency:** Use palette color with low opacity (e.g., 90%)
2. **Shadows:** Apply appropriate shadow variable
3. **Backdrop Blur:** Use `backdrop-filter` property for blur effect

**Example CSS for Frosted Card:**

```css
.frosted-card {
  /* Use BG color with opacity */
  background: hsla(var(--hue-n), var(--sat-n), 10%, 0.9);
  
  /* Apply depth shadow */
  box-shadow: var(--shadow-m);

  /* The core frosted effect */
  backdrop-filter: blur(10px);
  
  /* Additional touches */
  border-radius: 1rem;
  border: 1px solid hsla(var(--hue-n), var(--sat-n), 50%, 0.1);
}

/* Light mode adjustments */
body.light .frosted-card {
  background: hsla(var(--hue-n), var(--sat-n), 90%, 0.9);
}
```

## III. Design Component Guidelines

| Element | Background Color | Text Color | Box Shadow/Depth | Frosted Glass |
| :--- | :--- | :--- | :--- | :--- |
| **Page** | `--bg-dark` | N/A | None | No |
| **Main Card** | `var(--bg)` | `--text` / `--text-muted` | `var(--shadow-m)` | Yes (slight blur) |
| **Input Fields / Buttons** | `var(--bg-light)` | `--text` (Input) / `var(--brand)` (Button) | `var(--shadow-s)` + Inset Highlight | Yes (more pronounced blur) |
| **Headings** | N/A | `--text` | N/A | N/A |
| **Paragraphs** | N/A | `--text-muted` | N/A | N/A |
| **Primary Action** | `var(--brand)` | `hsl(0, 0%, 10%)` (Dark Text on Yellow) | `var(--shadow-s)` | No (Solid/Vivid) |

## IV. Implementation Guidelines

### Key Principles:

- **Depth Hierarchy:** Use lightness scale (`--bg-dark` → `--bg-light`) to signal importance and proximity
- **Minimalism:** Rely on defined shades and depth for complexity, not multiple colors or borders
- **Subtle Tinting:** Base neutral has slight lilac tint (H=250) to maintain "White Lilac" aesthetic
- **Consistent Shadows:** Use realistic, combined shadow values for grounding floating elements

### For Developers:

1. Always use CSS variables defined in the design system
2. Apply frosted glass effect to cards and elevated elements
3. Maintain depth hierarchy: page background → cards → interactive elements
4. Use brand color sparingly for primary actions only
5. Implement proper light/dark mode switching via body class

### For SAIT Integration:

- Brand yellow (`--brand`) should complement SAIT's visual identity
- Neutral palette provides professional, academic appearance
- Frosted glass aesthetic creates modern, approachable interface suitable for students