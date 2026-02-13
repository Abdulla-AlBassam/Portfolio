# Portfolio Progress Log

## Project Overview
Personal portfolio site for Abdulla AlBassam — cybersecurity student at Northumbria University.

**Tech stack:** Astro v4, Svelte v5, Tailwind CSS v3, Three.js, TypeScript, deployed on Vercel.

**Live pages:** `/` (home), `/me`, `/projects`, `/projects/rest-api`, `/photography`, `/skills`, `/contact`

---

## What's Been Built

### Core Site (completed)
- Astro multi-page site with `BaseLayout.astro` wrapping all pages
- Dark-themed design (#0a0a0a bg, white text, Space Grotesk + Inter fonts)
- Responsive across desktop/tablet/mobile

### Home Page (`src/pages/index.astro`)
- Hero with name + subtitle
- Interactive Three.js sphere cluster (`src/components/ThreeScene.svelte`)
  - 12 metallic spheres with physics simulation
  - Cursor repulsion via raycasting (only hovered spheres react)
  - Sphere-to-sphere collision for chain reactions
  - Spring-back + sine-wave floating animation

### Navigation (`src/components/Navigation.svelte`)
- Fixed header: "A." logo + hamburger menu
- Full-screen menu overlay with animated grid layout
- **Current layout: 2 cols x 3 rows**
  ```
  [01 Me.                          ]  <- row 1 (0.5fr), spans both columns
  [02 Projects.  ] [03 Photography.]  <- row 2 (1fr)
  [04 Skills.    ] [05 Contact.    ]  <- row 3 (1fr)
  ```
- Hover physics: hovering any cell expands it while compressing others
  - Column expansion: hovered side gets `1.8fr`, opposite gets `0.7fr`
  - Row expansion: hovered rows get `1.8fr`, opposite gets `0.7fr`
  - Me row shrinks from `0.5fr` to `0.35fr` when other cells hovered, expands to `0.8fr` on own hover
- All 5 cells share identical styling (number + name, bottom-left aligned, `translateX(10px)` on hover)
- Mobile: single column, 5 equal rows, Me stays first
- Smooth transitions: 0.6s cubic-bezier on grid template changes

### About Me Page (`src/pages/me.astro`)
- Bio, education (Northumbria + high school), predicted grade
- Profile photo with interactive shader warp effect (`src/components/ImageWarp.svelte`)
  - Three.js orthographic camera + GLSL fragment shader
  - Mouse-following Gaussian distortion

### Projects Page (`src/pages/projects.astro`)
- 11 project cards with poster images, descriptions, tech tags
- Sidebar category filter (Cybersecurity, Networking, Development, Machine Learning, In Progress)
- Cards link to PDFs or detail pages
- Hover: scale up + arrow indicator
- **Current order (strongest first):**
  1. Secure Local Mail System with ML-Based Spam Detection (in-progress)
  2. Sweaty: Social Game Diary & Discovery Platform (in-progress)
  3. Penetration Testing: Vulnerable VM Pen Test (in-progress)
  4. Secure Transaction Protocol + Infrastructure Hardening Plan (in-progress)
  5. Enterprise Networking: Segmented WAN with Selective IPsec
  6. Digital Forensics: RAM-to-Disk Forensic Timeline Reconstruction
  7. Client Audit + Security Assessment Report
  8. Networking: Secure VLAN Routing + Layer-2 Hardening
  9. Qualitative Study: Young-Adult Security Literacy Study
  10. REST API Build + Architecture Blueprint
  11. Operating Systems: Concurrent C Systems + HA DNS/Web Infrastructure

### Photography Page (`src/pages/photography.astro`)
- Placeholder page with masonry grid layout (3 cols, responsive)
- No photos added yet — ready for `<div class="photo-item"><img>` blocks
- Images would go in `public/photography/`

### Skills Page (`src/pages/skills.astro`)
- 5 categories: Cybersecurity, Networking, Development, Tools, Machine Learning
- 3 certifications: Cisco CCNA, ISC2 CC, Google AI Studio

### Contact Page (`src/pages/contact.astro`)
- Formspree contact form
- Social links (GitHub, LinkedIn, Letterboxd)
- CV download link

---

## What Needs Doing Next

### Photography Page
- Add actual photos to `public/photography/`
- Populate the masonry grid in `src/pages/photography.astro`

### Project Detail Pages
- Only `/projects/rest-api` has a dedicated detail page
- Other projects link to PDFs — consider adding detail pages for the in-progress ones (Sweaty, Spam Detection, Pen Test, Secure Transaction)

### Content
- Blog system is scaffolded (`src/content/blog/.gitkeep`, `src/content/config.ts` with Zod schema) but has no posts
- Consider adding blog posts or case studies

### Polish
- The navigation menu hover physics are functional but could be further tuned for feel
- Photography page needs real content
- Consider adding page transitions between routes
- Light mode toggle support is referenced in design docs but not implemented

---

## Key File Paths
```
src/
├── components/
│   ├── Navigation.svelte      # Menu overlay with grid hover physics
│   ├── ThreeScene.svelte      # Home page 3D sphere cluster
│   └── ImageWarp.svelte       # About page photo distortion shader
├── layouts/
│   └── BaseLayout.astro       # Page wrapper (nav + meta + fonts)
├── pages/
│   ├── index.astro            # Home
│   ├── me.astro               # About
│   ├── projects.astro         # Projects grid + filter
│   ├── projects/rest-api.astro
│   ├── photography.astro      # Placeholder
│   ├── skills.astro
│   └── contact.astro
├── styles/
│   └── global.css
└── content/
    ├── config.ts              # Blog collection schema
    └── blog/.gitkeep
```

## Navigation Menu Architecture (for future reference)
The menu grid in `Navigation.svelte` uses reactive Svelte stores for `colTemplate` and `rowTemplate`, driven by `hoveredCell` (-1 = none, 0-3 = outer cells, 4 = Me). Grid placement is explicit via `nth-child` selectors. The Me cell is rendered after the `{#each}` loop but placed in row 1 via CSS. On mobile (<=768px), all grid templates are overridden to single-column with `!important`.
