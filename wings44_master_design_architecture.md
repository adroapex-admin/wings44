# Wings44 - Web Design System & Technical Architecture 

This document defines the core color variables, UI styling, typography, and functional architecture to be used throughout the development of the Wings44 website. The focus is on a high-conversion, **B2B** lead-generation layout (Catalog Mode) with a strong, industrial aesthetic.

## 1. Brand & Theme Colors
These colors define the primary industrial identity, engineered aesthetic, and high-visibility call-to-actions.

* **Primary Call-to-Action (Safety Yellow/Orange):** `#F4A900` or `#FF8C00`
  * *Usage:* "Get Free Quote" buttons, "Inquire Now" buttons, floating contact icons, and high-priority action items. Designed to stand out against dark industrial backgrounds.
* **Primary Brand/Structural (Heavy Black):** `#111111` or `#1C1F22` (Carbon Slate Black)
  * *Usage:* Main navigation headers, primary headings (H1/H2), dark footer backgrounds, and strong geometric section dividers.
* **Secondary Brand Accent (Industrial Steel Grey):** `#F0F2F5`
  * *Usage:* Secondary buttons, table headers, product card backgrounds, and structural UI borders. 

## 2. Typography & Styling
Defines the text readability hierarchy and the physical shape of the UI components. (Replaced the default template's organic/cursive fonts).

* **Primary Headings:** `Montserrat, sans-serif` (Bold/Extra Bold)
  * *Usage:* H1, H2, H3 tags, Section titles. Text-transform: uppercase for a rigid, factory feel.
* **Body/Paragraph Text:** `Roboto, sans-serif`
  * *Usage:* Product descriptions, specifications, dimensions, and general body copy. Highly readable and precise.
* **Component Shapes (Sharp & Geometric):**
  * *Usage:* All buttons, product cards, and images should have sharp corners. No soft, organic, or overly rounded shapes.

## 3. The "Products-First" Homepage Layout (index.php)
Inspired by top-tier e-catalogs, the homepage must follow this exact section hierarchy to immediately hook B2B buyers:

1. **Hero Slider (`banner.php`):** Full-width, high-quality images of Wings44's best products and the manufacturing floor.
2. **Product Categories (`category.php`):** A visual grid of the main verticals.
3. **Featured Products Grid (`product.php`):** Top-selling individual items with clean, white-background images and "Request a Quote" buttons.
4. **About the Manufacturer (`about.php`):** Brief introduction highlighting "ISO 17025 Certified" and "20+ years experience".
5. **Infrastructure & Capabilities (`feature.php`):** Showcasing precision metal fabrication, laser cutting, and on-site assembly.

## 4. Strict Product Catalog Requirements
The client has explicitly requested that the website focus *only* on the following products. All database entries, mega menus, and sidebar filters must map strictly to these 5 categories:

1. **Lockers**
2. **Compactor Storage System**
3. **Drawer Cabinet**
4. **VMC / CNC Tooling Storage**
5. **Storage Cabinet**

## 5. Functional UI Architecture (B2B Catalog Mode)
Since Wings44 is a **B2B** manufacturer, the site will operate strictly in Lead Generation/Catalog Mode.

* **No E-commerce Elements:** Shopping carts, pricing, and "Add to Cart" buttons are strictly prohibited.
* **Aggressive Quoting:** Every product page and product card must feature a persistent *Get Free Quote* or *Inquire Now* button.
* **The Product Detail Pages (`product-details.php`):** The primary CTA must be a lead form that captures the user's name, phone, email, and specific product/quantity requirements.

## 6. Core PHP Backend & Database Architecture
The site uses a custom PHP backend (stripping out the static HTML template features). 

**Global File Structure:**
* `includes/db.php`: Secure PDO database connection.
* `includes/header.php` & `includes/footer.php`: Global wrappers.
* `menu.php`: Dynamic mega-menu.

**MySQL Database Schema:**
* `categories`: `id`, `name`, `slug`
* `products`: `id`, `category_id`, `product_name`, `description`, `image_path`
* `inquiries`: `id`, `product_id`, `client_name`, `client_email`, `client_phone`, `message`, `created_at`

## 7. Trust Signals & Authority Assets
Required elements to be hardcoded into the global layout (Homepage, Footer, & About page):

* **Established Date:** *Manufacturing Excellence Since **2006** (20+ Years)*
* **Certifications:** **ISO 17025** Certified badge placement.
* **Process Flow:** Visual 4-step manufacturing process (Requirement Analysis -> Custom Design -> Precision Manufacturing -> On-Site Assembly).
* **Contact Info:** Persistent display of `info@wings44.com` and `+91 9175676244` in the top bar.