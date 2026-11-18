Wings44 - Web Design System & Technical Architecture This document defines the core color variables, UI styling, typography, and functional architecture to be used throughout the development of the Wings44 website. The focus is on a high-conversion, **B2B** lead-generation layout (Catalog Mode) with a strong, industrial aesthetic.

## Brand & Theme Colors

These colors define the primary industrial identity, engineered aesthetic, and high-visibility call-to-actions.

Primary Call-to-Action (Safety Yellow/Orange): #**FFB600** or #**FF8C00**

Usage: *Get Free Quote* buttons, *Inquire Now* buttons, floating contact icons, and high-priority action items. Designed to stand out against dark industrial backgrounds.

Primary Brand/Structural (Heavy Black): #**111111** or #**1A1A1A**

Usage: Main navigation headers, primary headings (H1/H2), dark footer backgrounds, and strong geometric section dividers.

Secondary Brand Accent (Industrial Steel Grey): #**4A5568**

Usage: Secondary buttons (e.g., *View Specifications*), table headers, and structural UI borders.

## UI & Background Colors

Used for the foundational layout, creating a clean, professional canvas that highlights the heavy-duty product lines.

Main Body Background (Cool Light Grey): #**F4F7F6**

Usage: Primary background color for the website body to give a clean, metallic, and engineered feel without the starkness of pure white.

Content/Card Background (Pure White): #**FFFFFF**

Usage: Product presentation cards (Lockers, Compactors, **VMC** Tooling), dropdown menus, and contact form backgrounds.

Trust/Authority Banner Background: #**111111** (Dark Mode section)

Usage: Background for the *20+ Years Experience* and ***ISO** **17025** Certified* statistics sections to create high contrast.

## Typography & Styling

Defines the text readability hierarchy and the physical shape of the UI components.

Primary Headings: #**111111** (Heavy Black, Bold/Extra Bold)

Usage: H1, H2, H3 tags, Section titles (e.g., *Heavy-Duty Compactor Storage*, *Industrial Applications*).

Font Style: Clean, sans-serif, geometric (e.g., Inter, Roboto, or Montserrat).

Muted/Secondary Text: #**555555** or #**666666**

Usage: Product descriptions, specifications, dimensions, and general body copy.

Component Shapes (Sharp & Geometric):

Usage: All buttons, product cards, and images should have sharp corners (0px to 2px border radius). Strict rule: No soft, organic, or overly rounded shapes, as they detract from the *heavy engineering* vibe.

## Functional UI Architecture (B2B Catalog Mode)

Since Wings44 is a **B2B** manufacturer, the site will operate strictly in Lead Generation/Catalog Mode.

No E-commerce Elements: Shopping carts, pricing, and *Add to Cart* buttons are strictly prohibited.

Aggressive Quoting: Every product page and product card must feature a persistent *Get Free Quote* or *Inquire Now* button.

Sticky Elements: A persistent *Request a Quote* button should remain visible on the screen as users scroll through long product specification pages.

## Dynamic Lead Generation & Admin Architecture

The backend must support dynamic inquiry tracking and product mapping.

Required Lead Form Architecture: When a user clicks *Get Free Quote*, the modal/form must dynamically capture:

User Details: Name, Company Name, Email, Phone Number.

Product Interest (Dynamic Dropdown): Must include the new product categories (Lockers, Compactor Storage System, Drawer Cabinet, **VMC** / **CNC** Tooling Storage, Storage Cabinet).

Application/Industry (Optional Dropdown): Industrial, Institutional, or Home Furniture.

Navigation & Categorization (Mega Menu): The Admin panel must allow products to be tagged and displayed in two distinct ways in the Mega Menu:

By Product Type: (Lockers, Cabinets, Compactors)

By Application/Industry: (Warehousing, Offices, Schools, Healthcare)

## Functional & Integration Colors

Colors used for third-party widgets, trust signals, and functional states.

WhatsApp Floating Button / Direct Chat: #**25D366** (Standard WhatsApp Green)

Call Now / Phone Integration: Primary Accent (#**FFB600**) or #**007BFF** (Action Blue)

Success/Form Submitted: #**155724** (Green text) on #**D4EDDA** (Light Green background)

Error/Validation Messages (Lead Forms): #**DC3545** (Red)

## Trust Signals & Authority Assets

Required elements to be hardcoded into the global layout (Homepage & About page):

Established Date: *Manufacturing Excellence Since **2006** (20+ Years)*

Certifications: **ISO** **17025** Certified badge placement.

Process Flow: Visual 4-step manufacturing process (Space Analysis -> Custom Design -> Precision Manufacturing -> Installation).