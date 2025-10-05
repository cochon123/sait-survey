---
description: Design system and visual guidelines for the SAIT Student Survey application
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