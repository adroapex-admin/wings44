# Wings44 B2B Manufacturing E-Catalog Website

## Revised Software Requirements Specification (SRS) and Gemini Build Blueprint

**Document version:** 2.0\
**Status:** Approved implementation baseline for development planning\
**Business:** Wings44 Design and Manufacturing Pvt. Ltd.\
**Location:** Kolhapur, Maharashtra, India\
**Established:** 2006\
**Business focus:** Sheet-metal furniture, custom workstations,
industrial storage and tooling storage\
**Required stack:** Core PHP, PDO, MySQL, HTML5, Tailwind CSS via CDN,
Vanilla JavaScript

------------------------------------------------------------------------

# Instructions for Gemini

You are acting as a senior full-stack PHP developer, systems architect,
UI/UX designer, database engineer, and application security reviewer.
Build the Wings44 website **step by step**, following this document as
the authoritative specification.

## Required working method

1.  First inspect this specification and produce a concise
    implementation plan and complete file tree.
2.  Implement the database schema and seed data.
3.  Implement shared configuration, PDO connection, security helpers,
    and shared public layout.
4.  Implement the public catalog and all required pages.
5.  Implement the admin login and the narrowly scoped product/category
    management panel.
6.  Implement the email-only lead submission workflow.
7.  Add responsive interactions, SEO, error handling, and accessibility.
8.  Run a requirements checklist and review the project for security and
    missing functionality.
9.  At each step, list the files created/changed, provide their complete
    contents, explain how to test them, and identify any setup action
    required from the owner.
10. Do not silently skip requirements, replace Core PHP with a
    framework, or introduce an unrelated feature. Do not use
    placeholders where working functionality is required.

If working in an environment that can create files directly, create the
files in the project directory. Otherwise, provide complete files in
clearly labelled code blocks with their exact paths. Do not claim that
code has been executed or tested unless it actually has.

**Important scope corrections:** - A lead/inquiry is sent by email only.
There is no inquiry database table, no inquiry history in the admin
panel, no lead dashboard, no CRM, and no lead export. - The admin panel
exists only to manage product categories and products. It is not a
general CMS. - The owner must be able to add new categories from the
admin panel. Categories are database-driven; do not hard-code the five
initial categories as the permanent limit. - The five categories listed
below are the initial seed categories, not a permanent category cap. -
No e-commerce: no cart, checkout, online ordering, payment processing,
or visible prices. - Do not create admin controls for editing About,
Manufacturing, Contact, testimonials, home-page sections, or general
website content.

------------------------------------------------------------------------

# 1. Introduction and purpose

## 1.1 Purpose

This document is the master blueprint for implementation, testing, and
handover of the Wings44 B2B manufacturing e-catalog website. It defines
scope, application architecture, database design, user journeys, admin
capabilities, email-only inquiry processing, design standards, security,
and acceptance criteria.

## 1.2 Business objectives

The website must:

-   Present Wings44 as a credible B2B manufacturing business.
-   Help business buyers discover relevant industrial storage products.
-   Showcase manufacturing capabilities and quality processes.
-   Convert visitors into quote requests and enquiries.
-   Send submitted enquiries to the designated business email address.
-   Allow the owner to manage product categories and product records
    through a secure admin panel, without editing PHP or SQL manually.

## 1.3 Company facts and publication controls

Use the business name **Wings44 Design and Manufacturing Pvt. Ltd.** and
established year **2006**. The company is based in Kolhapur,
Maharashtra, India.

The brief states "ISO 17025 Certified." Before publishing the claim, the
owner must confirm the exact certification/accreditation wording, scope,
issuing body, and validity. Never invent certification details, client
logos, testimonials, production capacities, machine models, or customer
relationships.

## 1.4 In scope

-   Responsive public-facing B2B catalog website.
-   The nine-section homepage specified in Section 4.
-   Public About, Manufacturing, Products, Product Detail, and Contact
    pages.
-   Database-driven categories and products.
-   Secure admin login.
-   Admin CRUD for product categories and products only.
-   Product image upload and management, with strict validation.
-   Quote/enquiry form that sends email only.
-   Core PHP/PDO/MySQL architecture.
-   SEO, accessibility, security, testing, and deployment instructions.

## 1.5 Out of scope

-   Shopping cart, checkout, payment, order placement, or visible
    product prices.
-   CRM, lead dashboard, inquiry storage, inquiry history, lead exports,
    or lead statuses.
-   General CMS features or admin editing for homepage copy, About,
    Manufacturing, Contact, testimonials, or site-wide settings.
-   Customer accounts or public registration.
-   ERP/accounting/inventory integrations.
-   Automated quotation calculation or quotation PDF generation.
-   Frameworks such as Laravel or Symfony.
-   A public limit of five categories.

------------------------------------------------------------------------

# 2. User roles and permissions

## 2.1 Public visitor

A visitor can:

-   Browse categories and published products.
-   Search/filter the catalog if implemented.
-   Open product detail pages.
-   Submit a general enquiry or product-specific quote request.
-   See a confirmation that the email request was accepted for
    processing.

A visitor cannot access admin pages or change catalog data.

## 2.2 Owner / administrator

The owner can log in to the admin panel and:

-   View a dashboard with simple counts of categories and products, if
    useful.
-   Add, edit, activate/deactivate, reorder, and archive categories.
-   Add, edit, publish/unpublish, feature, reorder, and archive
    products.
-   Assign each product to a category.
-   Manage product descriptions, technical specifications, SEO fields,
    and images.
-   Change a category slug/name while receiving a warning if existing
    URLs may be affected.
-   Log out securely.

The owner cannot use the admin panel to manage leads because leads are
not stored in the application. There must be no inquiry management menu
or inquiry database.

## 2.3 Admin account provisioning

There must be no public admin registration page. Create the first admin
through a secure one-time setup script or a documented CLI/database
setup process. The setup script must be removed or disabled after the
initial account is created.

Passwords must be stored using PHP `password_hash()` and checked using
`password_verify()`. Never store plaintext passwords or a reversible
password value.

------------------------------------------------------------------------

# 3. Technology and architecture

## 3.1 Mandatory stack

-   Backend: Core PHP, preferably a currently supported PHP 8.x release
    compatible with hosting.
-   Database: MySQL with InnoDB and `utf8mb4`.
-   Database access: PDO MySQL with prepared statements.
-   Frontend: HTML5 and Tailwind CSS via CDN.
-   Browser interactions: Vanilla JavaScript.
-   Web server: Apache or another compatible PHP server.
-   Deployment: conventional PHP hosting; no Node.js runtime
    requirement.

Pin a tested Tailwind CDN version and use its matching configuration
syntax. Do not mix Tailwind v3 and v4 configuration methods. Keep custom
CSS small and place it in `assets/css/custom.css`.

## 3.2 Architecture principles

-   Server-rendered PHP pages.
-   Shared layout components.
-   Reusable validation and security helpers.
-   All database writes occur server-side.
-   All user-controlled SQL values use PDO bound parameters.
-   Catalog output is escaped before HTML rendering.
-   Admin routes require authentication and authorization.
-   Leads are emailed and are not written to the database or logs.
-   Secrets and credentials are supplied through environment variables
    or private configuration outside the public web root.

## 3.3 Request flow

**Public catalog:** Browser → PHP page → PDO query → MySQL → escaped
HTML response.

**Admin update:** Admin browser → authenticated POST request → CSRF
validation → server-side validation → PDO insert/update → success/error
response.

**Lead form:** Browser → HTTPS POST → server-side validation and spam
controls → email delivery attempt → user confirmation or actionable
failure. No inquiry row is inserted into MySQL.

------------------------------------------------------------------------

# 4. Public website requirements

## 4.1 Mandatory homepage hierarchy

`index.php` must contain these nine primary sections in this exact
order:

1.  **Hero Banner:** concise manufacturing value proposition, genuine
    factory/product imagery, "Explore Products" and "Request a Quote"
    calls to action.
2.  **Visual Product Categories:** category cards loaded from the
    database. Show all active categories according to configured
    ordering; the initial seed has five.
3.  **Dynamic Featured Products Grid:** products fetched from MySQL
    using a PHP loop. Show published products marked featured.
4.  **Infrastructure / Capabilities Showcase:** verified laser cutting,
    fabrication, manufacturing infrastructure, and capabilities. Publish
    only capabilities confirmed by the owner.
5.  **Trust Signals & Client Feedback:** verified credentials and
    genuine, authorized testimonials only. A simple accessible
    testimonial slider may be used.
6.  **Value Proposition Grid:** approved strengths such as experience,
    customization, quality processes, and application suitability.
7.  **Industry / Application Focus:** appropriate industrial
    applications for the products, based on verified business
    information.
8.  **Manufacturing Process Timeline:** approved process stages, such as
    requirement review, design, fabrication, finishing, inspection, and
    dispatch. Confirm the actual process with the owner.
9.  **Bottom-of-Funnel Lead Form:** split-screen lead generation block
    with an email-only enquiry form.

The page must not contain invented claims, fake testimonials, fake
statistics, or unsupported certifications. If content is not yet
supplied, use clearly labelled temporary content and identify it for
owner approval rather than presenting it as verified fact.

## 4.2 Public pages

### `index.php`

Implements the nine sections in the required order, database-driven
category cards, dynamic featured products, and the lead form.

### `about.php`

Company background, establishment in 2006, business overview, and
verified credentials.

### `manufacturing.php`

Manufacturing capabilities, machinery, quality process, and facility
imagery, using owner-approved facts.

### `products.php`

Catalog listing, database-driven category filtering, and optional
search. Show only products with `status = 'published'` whose category is
active.

### `product.php`

Shows one published product using its slug or ID. Display product name,
images, description, specifications, category, and "Request a Quote" /
"Enquire Now". The CTA must carry the product context into the form, but
the server must independently verify the product.

### `contact.php`

Approved contact information and a general enquiry form.

### Supporting routes

-   `submit-inquiry.php`: validates the form and sends email only.
-   `thank-you.php`: optional safe confirmation page; must not re-submit
    the form on refresh.
-   `404.php`: branded not-found page.

## 4.3 Catalog mode rules

-   No prices or price ranges may appear anywhere in the public
    interface.
-   No cart, checkout, payment, "Buy Now", or order placement controls.
-   Product-related CTAs must be enquiry-oriented.
-   Product cards must be generated from database records.
-   Only published products in active categories are public.
-   Category navigation and category cards must be database-driven.
-   Product slugs must be unique.
-   Unpublished, archived, or invalid product URLs must return a proper
    404 response.
-   Product specifications may be stored as structured JSON or
    normalized attributes; handle missing fields safely.
-   Product lists must have a sensible limit and pagination if the
    number of products grows.
-   Empty category states must be helpful and must not expose
    unpublished items.

------------------------------------------------------------------------

# 5. Email-only lead generation

## 5.1 Definitive lead handling rule

**A lead is sent by email only. It is not stored in MySQL.**

There must be: - No `inquiries` table. - No lead dashboard. - No lead
history in admin. - No lead export. - No lead status workflow. - No full
inquiry text or personal contact details written to application logs.

The product and category records are database-backed; lead submissions
are not.

## 5.2 Form fields

Required: - Full name - Email - Phone - Message / requirement
description

Optional: - Company name - City/state - Requested quantity - Product
context, preselected from a product page

Validate input on both client and server. Server-side validation is
authoritative. Set sensible maximum lengths, reject malformed email
addresses, and normalize input without corrupting legitimate phone
numbers or messages.

## 5.3 Email behavior

-   Send every valid lead to an owner-configured recipient address, such
    as `SALES_EMAIL` supplied through environment configuration.
-   Do not hard-code an invented email address.
-   Use a reliable SMTP-based mail library if available and permitted by
    the project environment. If using a library, vendor it or install it
    according to the hosting workflow; do not assume a package exists.
-   If the project must avoid dependencies, use a carefully configured
    server mail transport only after confirming the host supports it.
-   Set the recipient from trusted server configuration, never from
    visitor input.
-   Use the visitor's validated email as `Reply-To`, not as the `From`
    address, to reduce spoofing and delivery failures.
-   Set a fixed, trusted sender address on the website's domain.
-   Never put user input into email headers without strict validation.
-   Include the submitted fields, product name/slug where applicable,
    page URL/path, and server-generated submission timestamp in the
    email body.
-   Escape or safely format all user-controlled content in the email.
-   Do not send an automatic visitor acknowledgement unless separately
    approved.
-   Never expose SMTP credentials or mail server errors to the visitor.

## 5.4 Success and failure behavior

A success message may be displayed only after the email transport
reports successful acceptance for sending. This does not guarantee final
inbox delivery, so wording should say the enquiry was submitted/sent,
not promise that it has been read.

If sending fails: - Do not display a success message. - Show a clear
retry/contact alternative. - Log only a sanitized technical error
identifier and timestamp; do not log the entire form submission. - Do
not silently save the lead to a database as a fallback, because
email-only processing is a strict requirement.

Use CSRF protection, rate limiting, a honeypot or equivalent anti-spam
control, request-size limits, and duplicate-submit protection. CAPTCHA
can be added if necessary.

------------------------------------------------------------------------

# 6. Admin panel requirements

## 6.1 Admin route structure

Use a protected admin area such as:

-   `/admin/login.php`
-   `/admin/logout.php`
-   `/admin/index.php`
-   `/admin/categories/index.php`
-   `/admin/categories/create.php`
-   `/admin/categories/edit.php`
-   `/admin/categories/toggle-status.php`
-   `/admin/products/index.php`
-   `/admin/products/create.php`
-   `/admin/products/edit.php`
-   `/admin/products/toggle-status.php`
-   `/admin/products/delete.php` or an archive action
-   `/admin/includes/admin-header.php`
-   `/admin/includes/admin-footer.php`
-   `/admin/includes/auth.php`

Names may be consolidated into controller files if the result remains
readable, but all specified functionality must exist.

## 6.2 Admin dashboard

Keep the dashboard minimal. It may show counts of categories and
products, plus shortcuts to manage them. Do not add inquiry counts
because leads are not stored.

## 6.3 Category management

The owner must be able to:

-   Create a category with name, slug, description, image, alt text,
    status, and sort order.
-   Edit an existing category.
-   Set category active/inactive.
-   Change category ordering.
-   Upload/replace a category image.
-   View the number of products associated with a category.
-   Add new categories without a code change or database schema change.

The five initial categories are seed data only: 1. Lockers 2. Compactor
Storage System 3. Drawer Cabinet 4. VMC/CNC Tooling Storage 5. Storage
Cabinet

The owner can add additional categories later. Do not restrict category
count to five.

Category slug must be unique. Generate a suggested slug from the name
but let the owner review it. Validate slug format and uniqueness
server-side.

A category with associated products must not be physically deleted in a
way that orphans products. Prefer deactivation. If deletion is
permitted, require that no products reference the category and show a
clear validation message otherwise.

When a category is inactive, its products must not appear publicly, even
if those products remain marked published. The admin may still display
and edit those products.

## 6.4 Product management

The owner must be able to:

-   Create a product and assign it to an existing category.
-   Edit product name, slug, short description, detailed description,
    specifications, category, images, alt text, SEO title, SEO
    description, publication status, featured flag, and sort order.
-   Upload a primary image and optional gallery images.
-   Reorder gallery images if implemented.
-   Preview the product page.
-   Publish, unpublish, or archive a product.
-   Search and filter the admin product list by name, category, and
    status.
-   Paginate the admin list if needed.

No product price field must exist in the admin form or database schema.

A product must not be published without a name, unique slug, valid
category, and required short description. If the image is optional,
provide a safe placeholder rather than breaking the layout.

## 6.5 Admin authentication and security

-   No public registration.
-   Use `password_hash()` and `password_verify()`.
-   Regenerate the session ID after successful login.
-   Set secure session cookie attributes, including `HttpOnly`, `Secure`
    on HTTPS, and an appropriate `SameSite` policy.
-   Protect every admin page and every write endpoint with
    authentication.
-   Protect all state-changing requests with CSRF tokens.
-   Use POST for create/update/status/archive/delete operations.
-   Never change status or delete records through a GET link.
-   Rate-limit login attempts and use generic login failure messages.
-   Validate every field server-side.
-   Use PDO prepared statements.
-   Escape all displayed database content.
-   Restrict image uploads to allowed raster formats such as JPEG, PNG,
    and WebP; verify MIME type and actual file content, set file-size
    and dimension limits, generate random filenames, and never trust the
    original filename.
-   Reject SVG uploads unless a dedicated, secure SVG sanitization
    workflow is implemented.
-   Prevent executable files from being uploaded or executed.
-   Store uploads in a non-executable directory and block script
    execution there.
-   Use soft archive/deactivation rather than destructive deletion
    wherever possible.
-   Provide logout and session expiration behavior.
-   Never expose credentials, stack traces, or SQL errors in the admin
    UI.

The admin panel must not offer any feature outside category and product
management, account login/logout, and minimal dashboard counts.

------------------------------------------------------------------------

# 7. Database schema

## 7.1 Required tables

The initial application requires: 1. `categories` 2. `products` 3.
`admin_users`

There must be **no `inquiries` table** because leads are email-only.

## 7.2 Relationship model

-   One category has zero or many products.
-   Each product belongs to one category.
-   Admin users authenticate to manage categories and products.
-   Leads are sent through the email transport and are not persisted as
    relational records.

## 7.3 `categories` table

Recommended fields:

-   `id`: unsigned auto-increment primary key
-   `name`: required category name
-   `slug`: required unique URL slug
-   `description`: nullable text
-   `image_path`: nullable relative image path
-   `alt_text`: nullable image alt text
-   `status`: active/inactive
-   `sort_order`: unsigned integer
-   `created_at`: timestamp
-   `updated_at`: timestamp

Add a unique index on `slug` and an index on `(status, sort_order)`.

## 7.4 `products` table

Recommended fields:

-   `id`: unsigned auto-increment primary key
-   `category_id`: required foreign key to `categories.id`
-   `name`: required product name
-   `slug`: required unique slug
-   `short_description`: required bounded text
-   `description`: nullable long description
-   `specifications`: nullable JSON for product-specific specifications
-   `thumbnail`: nullable relative path
-   `image_gallery`: nullable JSON array of image paths
-   `alt_text`: nullable alt text
-   `status`: draft/published/archived
-   `is_featured`: boolean
-   `sort_order`: unsigned integer
-   `meta_title`: nullable SEO title
-   `meta_description`: nullable SEO description
-   `created_at`: timestamp
-   `updated_at`: timestamp

Add indexes supporting category/status/sort order and
featured/status/sort order. Use a foreign key with `ON DELETE RESTRICT`
so a category with products cannot be deleted accidentally.

**Do not add price, discount, cart, order, inventory, or inquiry
fields.**

## 7.5 `admin_users` table

Recommended fields:

-   `id`: unsigned auto-increment primary key
-   `username`: unique, required
-   `email`: unique, required
-   `password_hash`: required
-   `status`: active/inactive
-   `last_login_at`: nullable timestamp
-   `created_at`: timestamp
-   `updated_at`: timestamp

Do not store plaintext passwords. Only authorized setup logic may create
admin users.

## 7.6 Seed data

Provide a SQL seed file for the five initial categories in Section 6.3.
Seed logic must avoid creating duplicates if safely re-run. New
categories created by the owner must be stored in `categories` and
immediately be available to the category dropdown in the product admin
form, subject to their status.

------------------------------------------------------------------------

# 8. Project file structure

Use this as the baseline structure; add small helper files only when
they have a clear responsibility.

``` text
wings44/
├── index.php
├── about.php
├── manufacturing.php
├── products.php
├── product.php
├── contact.php
├── submit-inquiry.php
├── thank-you.php
├── 404.php
├── sitemap.php
├── robots.txt
├── includes/
│   ├── config.php
│   ├── db.php
│   ├── header.php
│   ├── menu.php
│   ├── footer.php
│   ├── functions.php
│   ├── csrf.php
│   ├── validation.php
│   └── seo.php
├── admin/
│   ├── login.php
│   ├── logout.php
│   ├── index.php
│   ├── categories/
│   │   ├── index.php
│   │   ├── create.php
│   │   ├── edit.php
│   │   └── toggle-status.php
│   ├── products/
│   │   ├── index.php
│   │   ├── create.php
│   │   ├── edit.php
│   │   ├── toggle-status.php
│   │   └── delete.php
│   └── includes/
│       ├── auth.php
│       ├── admin-header.php
│       └── admin-footer.php
├── assets/
│   ├── css/custom.css
│   ├── js/app.js
│   ├── js/menu.js
│   ├── js/testimonials.js
│   └── images/
│       ├── hero/
│       ├── categories/
│       ├── products/
│       ├── manufacturing/
│       └── trust/
├── uploads/
│   ├── categories/
│   └── products/
├── database/
│   ├── migrations/001_initial_schema.sql
│   └── seeds/001_categories.sql
├── tests/
│   ├── catalog-tests.php
│   ├── admin-tests.php
│   ├── inquiry-email-tests.php
│   └── security-tests.php
├── .env.example
├── .gitignore
└── README.md
```

Keep private configuration, logs, database backups, and any non-public
files outside the public web root whenever possible. If hosting
constraints prevent this, explicitly deny HTTP access. Ensure the upload
directory cannot execute PHP or other scripts.

------------------------------------------------------------------------

# 9. Design system and UI requirements

## 9.1 Required palette

  -----------------------------------------------------------------------
  Token             Hex               RGB               Usage
  ----------------- ----------------- ----------------- -----------------
  Safety            `#FFB600`         `255, 182, 0`     Primary CTA,
  Yellow/Orange                                         highlights,
                                                        active state

  Heavy Black       `#111111`         `17, 17, 17`      Header, primary
                                                        text, footer,
                                                        structural
                                                        elements

  Industrial Steel  `#4A5568`         `74, 85, 104`     Secondary text
  Grey                                                  and supporting
                                                        elements

  Cool Light Grey   `#F4F7F6`         `244, 247, 246`   Main body
                                                        background

  Pure White        `#FFFFFF`         `255, 255, 255`   Cards, form
                                                        surfaces, content
                                                        panels
  -----------------------------------------------------------------------

Use dark text on yellow buttons. Do not use small yellow text on white
backgrounds due to insufficient contrast.

## 9.2 Visual direction

-   Vercel-inspired: clean, precise, minimal, technical, high contrast.
-   Industrial and B2B, not consumer e-commerce.
-   Sharp geometric layouts; default border radius 0--4px.
-   Straight lines, restrained borders, consistent spacing, and strong
    grid alignment.
-   Avoid organic curves, excessive gradients, oversized rounded cards,
    and pill-shaped CTAs.
-   Use genuine factory and product imagery wherever possible.
-   Prioritize desktop quality while maintaining excellent mobile
    responsiveness.
-   Keep animations restrained and respect reduced-motion preferences.
-   Make navigation, forms, menus, sliders, and admin tables keyboard
    accessible.

## 9.3 Reference journey

Use `https://www.spaceplannersindia.in/` as a reference for
product-first navigation, industrial trust signals, categorized
mega-menu, and product discovery. Use it only as a UX reference; do not
copy its code, brand assets, text, or exact proprietary design.

------------------------------------------------------------------------

# 10. Non-functional requirements

## 10.1 Performance

-   Optimize and resize all images; use WebP/AVIF when supported.
-   Lazy-load below-the-fold images, but not the primary hero image if
    it is the LCP element.
-   Set image dimensions to reduce layout shift.
-   Avoid N+1 database queries.
-   Add indexes for common category and product queries.
-   Limit and paginate large catalog/admin lists.
-   Keep JavaScript small and avoid unnecessary libraries.
-   Target Core Web Vitals at the 75th percentile: LCP ≤ 2.5 seconds,
    INP ≤ 200 ms, CLS ≤ 0.1, subject to measurement on production-like
    hosting.

## 10.2 Security

-   PDO prepared statements for database operations.
-   Context-aware HTML output escaping.
-   CSRF protection for all state-changing requests.
-   HTTPS for production.
-   Secure sessions and login rate limiting.
-   Server-side validation for all public and admin forms.
-   Strict upload validation and non-executable upload storage.
-   Production error display disabled.
-   Secrets outside source control and preferably outside the web root.
-   Least-privilege database account.
-   Sanitized logs; never log full lead content.
-   Regular backups for catalog/admin data and documented restore
    procedure.

## 10.3 SEO and accessibility

-   Unique title and meta description per public page and product.
-   Stable slugs and canonical URLs where appropriate.
-   XML sitemap and correct `robots.txt`.
-   Only published products and active categories in public navigation
    and sitemap.
-   Semantic HTML, correct heading hierarchy, keyboard support, visible
    focus states, labelled forms, accessible errors, and meaningful alt
    text.
-   Target WCAG 2.2 AA.
-   No invented product price or availability data in structured data.

## 10.4 Compatibility

Test current stable versions of Chrome, Edge, Firefox, Safari, and
common mobile browsers. Verify widths around 320px, 375px, 390px, 768px,
1024px, 1440px, and 1920px.

------------------------------------------------------------------------

# 11. Testing and acceptance criteria

## 11.1 Public catalog

-   Homepage renders all nine sections in the specified order.
-   Category cards are fetched from the database.
-   The initial five categories appear in the expected order.
-   Adding a new active category through admin makes it available in
    public navigation/category sections without code changes.
-   Product cards are rendered through a PHP loop from database records.
-   Only published products with active categories appear publicly.
-   No product price or e-commerce controls are displayed.
-   Invalid/unpublished product URLs return 404.
-   Product CTAs retain the correct product context in the enquiry form.

## 11.2 Admin

-   Unauthenticated visitors cannot access admin pages or write
    endpoints.
-   Login verifies password hashes and applies rate limiting.
-   Admin can create, edit, activate/deactivate, reorder, and archive
    categories.
-   Admin can create, edit, publish/unpublish, feature, reorder, and
    archive products.
-   New categories appear in the product category selector.
-   A category with products cannot be deleted in a way that breaks
    referential integrity.
-   Invalid uploads and oversized files are rejected.
-   All state-changing operations require POST and valid CSRF tokens.
-   No admin feature exists for managing leads or editing general page
    content.

## 11.3 Email-only lead handling

-   A valid form submission triggers an email to the configured
    recipient.
-   No lead record is inserted into any database table.
-   No lead dashboard or lead history is available in admin.
-   The sender address is trusted configuration, not visitor input.
-   The validated visitor email may be used as Reply-To.
-   Email sending failure does not show a false success message.
-   Logs do not contain full form messages or personal details.
-   Spam and duplicate submission controls work.
-   The confirmation page does not resubmit the form on refresh.

## 11.4 Security and quality

-   SQL injection test inputs do not alter queries.
-   XSS test inputs are displayed safely and never executed.
-   CSRF validation rejects missing or invalid tokens.
-   Session handling and logout work correctly.
-   No credentials or stack traces are publicly exposed.
-   Layout is responsive and key interactions are keyboard-accessible.
-   Broken images, empty categories, database errors, and missing
    products are handled gracefully.

------------------------------------------------------------------------

# 12. Deployment and owner handover

Before launch:

1.  Confirm supported PHP version and required extensions.
2.  Configure database and least-privilege credentials.
3.  Apply migration and category seed scripts.
4.  Create the initial admin account through the secure setup procedure.
5.  Disable/remove the one-time admin setup script.
6.  Configure SMTP/mail transport and `SALES_EMAIL` plus trusted sender
    settings.
7.  Send a real test enquiry and confirm delivery to the correct
    mailbox.
8.  Configure HTTPS and secure session cookies.
9.  Protect private files, logs, and upload directories.
10. Test admin category and product management.
11. Verify no leads are written to MySQL or application logs.
12. Verify the five initial categories and test adding a sixth category
    through admin.
13. Obtain owner approval for content, images, testimonials, and
    certification wording.
14. Verify backups and restoration procedure.
15. Deliver source code, database migration/seed scripts, deployment
    instructions, admin login setup instructions, and a concise owner
    guide.

Do not include actual passwords, SMTP secrets, or production credentials
in the handover document.

------------------------------------------------------------------------

# 13. Definition of done

The website is ready for acceptance when:

1.  All public pages work on desktop and mobile.
2.  The homepage has the nine required sections in the correct order.
3.  The catalog is fully database-driven.
4.  The owner can add a new category through admin without code changes.
5.  The owner can manage product details and product images through
    admin.
6.  Admin authentication, CSRF protection, validation, and upload
    restrictions work.
7.  Product/category publication rules are enforced on the server.
8.  No prices, cart, checkout, payments, or online ordering exist.
9.  Valid leads are sent by email only and are not stored in a database.
10. Failed email delivery is handled honestly and safely.
11. Security, SEO, accessibility, and responsive checks pass.
12. The project includes documented setup, migrations, test results, and
    handover instructions.

------------------------------------------------------------------------

# 14. Final implementation directive for Gemini

Build the project in small, verifiable steps. Start with a plan and file
tree, then implement the database, shared architecture, public catalog,
admin panel, email-only lead flow, design polish, security, and tests in
that order.

After each step: - List files created or modified. - Provide complete
code for each file. - Explain environment variables and setup
commands. - Provide test steps and expected results. - Track completed
requirements against this SRS. - Do not claim successful testing without
running the tests. - Ask only when a required business value is
genuinely missing; otherwise use a clearly documented configuration
variable or a safe placeholder. - Never invent the destination sales
email, SMTP credentials, certification details, testimonials, or company
capabilities. - Do not add features outside the agreed scope.

**The three most important rules are:** 1. **Leads are email-only ---
never save lead submissions in the database.** 2. **The admin panel
manages categories and products only.** 3. **Categories are
database-driven and the owner can add new categories at any time.**
