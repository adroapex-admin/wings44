<?php
// 1. Include the Database Connection
// require_once 'includes/db.php';

// Fetch Active Categories (Limit to the Seed 5 for the visual grid)
// try {
//     $stmtCats = $pdo->prepare("SELECT name, slug, image_path FROM categories WHERE status = 'active' ORDER BY sort_order ASC LIMIT 5");
//     $stmtCats->execute();
//     $categories = $stmtCats->fetchAll();
// } catch (PDOException $e) {
//     error_log("Failed to fetch categories: " . $e->getMessage());
//     $categories = [];
// }

// Fetch Featured Published Products (Limit to 6)
// try {
//     $stmtProds = $pdo->prepare("SELECT p.name, p.slug, p.short_description, p.thumbnail, c.name as category_name 
//                                 FROM products p 
//                                 JOIN categories c ON p.category_id = c.id 
//                                 WHERE p.status = 'published' AND p.is_featured = 1 AND c.status = 'active'
//                                 ORDER BY p.sort_order ASC LIMIT 6");
//     $stmtProds->execute();
//     $featuredProducts = $stmtProds->fetchAll();
// } catch (PDOException $e) {
//     error_log("Failed to fetch products: " . $e->getMessage());
//     $featuredProducts = [];
// }

// Include Universal Header
require_once 'includes/header.php';
?>

<!-- Section 1: Hero Banner -->
<section class="relative bg-w44Black text-white overflow-hidden">
    <div class="absolute inset-0 z-0">
        <!-- Requires: assets/images/hero/factory-floor.jpg -->
        <img src="assets/images/hero/locker.webp" alt="Wings44 Factory Floor" class="w-full h-full object-cover opacity-30">
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
        <span class="inline-block px-3 py-1 bg-w44Grey text-white text-xs font-bold uppercase tracking-wider mb-6 rounded-sm">ISO 17025 Certified Manufacturer</span>
        <h1 class="text-4xl md:text-6xl font-heading font-bold uppercase tracking-tight mb-6">
            Engineered for Precision <br> & Durability Since 2006
        </h1>
        <p class="text-lg md:text-xl text-gray-300 max-w-2xl mb-10">
            World-class manufacturing of heavy-duty sheet metal furniture, custom workstations, and modular storage solutions for industrial, institutional, and modern living environments.
        </p>
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
            <a href="products.php" class="bg-w44Yellow text-w44Black font-bold uppercase tracking-wide px-8 py-4 text-center hover:bg-yellow-500 transition-colors rounded-sm">Explore Products</a>
            <a href="#quote-form" class="border-2 border-white text-white font-bold uppercase tracking-wide px-8 py-4 text-center hover:bg-white hover:text-w44Black transition-colors rounded-sm">Request a Quote</a>
        </div>
    </div>
</section>

<!-- Section 2: Visual Product Categories -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-heading font-bold uppercase tracking-wider text-w44Black">Core Storage Solutions</h2>
            <div class="w-24 h-1 bg-w44Yellow mx-auto mt-4"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $cat): ?>
                    <a href="products.php?cat=<?= htmlspecialchars($cat['slug']) ?>" class="group block border border-gray-200 rounded-sm overflow-hidden hover:border-w44Yellow transition-colors">
                        <div class="aspect-w-1 aspect-h-1 bg-gray-100">
                            <!-- Ensure category images exist or use a safe placeholder -->
                            <img src="<?= htmlspecialchars($cat['image_path'] ?: 'assets/images/categories/placeholder.jpg') ?>" alt="<?= htmlspecialchars($cat['name']) ?>" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-4 bg-white text-center">
                            <h3 class="font-bold text-w44Black uppercase text-sm group-hover:text-w44Yellow transition-colors"><?= htmlspecialchars($cat['name']) ?></h3>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-gray-500 col-span-full">Categories are currently being updated.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Section 3: Dynamic Featured Products Grid -->
<section class="py-20 bg-w44Light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-heading font-bold uppercase tracking-wider text-w44Black">Featured Equipment</h2>
                <div class="w-24 h-1 bg-w44Yellow mt-4"></div>
            </div>
            <a href="products.php" class="hidden md:inline-block border border-w44Black text-w44Black px-6 py-2 uppercase text-sm font-bold hover:bg-w44Black hover:text-white transition-colors rounded-sm">View Full Catalog</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (!empty($featuredProducts)): ?>
                <?php foreach ($featuredProducts as $product): ?>
                    <div class="bg-white border border-gray-200 rounded-sm overflow-hidden shadow-sm flex flex-col">
                        <div class="relative bg-gray-50 p-6 h-64 flex items-center justify-center border-b border-gray-100">
                            <span class="absolute top-4 left-4 bg-w44Grey text-white text-[10px] font-bold px-2 py-1 uppercase tracking-wider rounded-sm"><?= htmlspecialchars($product['category_name']) ?></span>
                            <img src="<?= htmlspecialchars($product['thumbnail'] ?: 'assets/images/products/placeholder.jpg') ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="max-h-full object-contain">
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold text-w44Black mb-2"><?= htmlspecialchars($product['name']) ?></h3>
                            <p class="text-sm text-w44Grey mb-6 flex-grow"><?= htmlspecialchars($product['short_description']) ?></p>
                            <a href="product.php?slug=<?= htmlspecialchars($product['slug']) ?>" class="w-full block text-center bg-w44Yellow text-w44Black font-bold uppercase text-sm px-4 py-3 hover:bg-yellow-500 transition-colors rounded-sm">Request Quote</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-gray-500 col-span-full py-10">Featured products are currently being updated.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Section 4: Infrastructure / Capabilities Showcase -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-w44Grey font-bold uppercase tracking-wider text-sm">Our Infrastructure</span>
            <h2 class="text-3xl font-heading font-bold uppercase tracking-wider text-w44Black mt-2">Precision Engineering Capabilities</h2>
            <div class="w-24 h-1 bg-w44Yellow mx-auto mt-4"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="group relative overflow-hidden bg-w44Black rounded-sm h-80">
                <img src="assets/images/manufacturing/laser-cutting.jpg" alt="Advanced Laser Cutting" class="w-full h-full object-cover opacity-60 group-hover:opacity-40 transition-opacity duration-300">
                <div class="absolute inset-0 p-6 flex flex-col justify-end">
                    <h3 class="text-white text-xl font-bold uppercase mb-2">Advanced Laser Cutting</h3>
                    <p class="text-gray-300 text-sm transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">High-precision sheet metal cutting ensuring exact specifications for every unit.</p>
                </div>
            </div>
            <div class="group relative overflow-hidden bg-w44Black rounded-sm h-80">
                <img src="assets/images/manufacturing/metal-fabrication.jpg" alt="Precision Fabrication" class="w-full h-full object-cover opacity-60 group-hover:opacity-40 transition-opacity duration-300">
                <div class="absolute inset-0 p-6 flex flex-col justify-end">
                    <h3 class="text-white text-xl font-bold uppercase mb-2">Precision Fabrication</h3>
                    <p class="text-gray-300 text-sm transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">Heavy-duty welding, bending, and shaping by experienced craftsmen.</p>
                </div>
            </div>
            <div class="group relative overflow-hidden bg-w44Black rounded-sm h-80">
                <img src="assets/images/manufacturing/assembly-line.jpg" alt="On-Site Assembly" class="w-full h-full object-cover opacity-60 group-hover:opacity-40 transition-opacity duration-300">
                <div class="absolute inset-0 p-6 flex flex-col justify-end">
                    <h3 class="text-white text-xl font-bold uppercase mb-2">On-Site Assembly</h3>
                    <p class="text-gray-300 text-sm transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">Modular designs delivered and professionally assembled at your facility.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 5: Trust Signals & Client Feedback -->
<section class="py-20 bg-w44Black text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl font-heading font-bold uppercase tracking-wider mb-12">Trusted by Institutions & Industry Leaders</h2>
        <!-- Verified Client Logos Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center justify-items-center opacity-70 mb-16">
            <img src="assets/images/trust/client-1.png" alt="Client Logo" class="h-12 object-contain grayscale hover:grayscale-0 transition-all">
            <img src="assets/images/trust/client-2.png" alt="Client Logo" class="h-12 object-contain grayscale hover:grayscale-0 transition-all">
            <img src="assets/images/trust/client-3.png" alt="Client Logo" class="h-12 object-contain grayscale hover:grayscale-0 transition-all">
            <img src="assets/images/trust/client-4.png" alt="Client Logo" class="h-12 object-contain grayscale hover:grayscale-0 transition-all">
        </div>
        
        <!-- Simplified Testimonial Focus -->
        <div class="max-w-3xl mx-auto bg-[#1A1A1A] p-8 border-l-4 border-w44Yellow rounded-sm">
            <p class="text-lg italic mb-6">"Wings44 delivered heavy-duty lockers for our facility on a tight deadline. The build quality is exceptional, and the on-site assembly team was highly professional. These units are truly engineered to last."</p>
            <div>
                <p class="font-bold text-w44Yellow uppercase">Facility Operations Manager</p>
                <p class="text-sm text-gray-400">Kolhapur Industrial Estate</p>
            </div>
        </div>
    </div>
</section>

<!-- Section 6: Value Proposition Grid -->
<section class="py-20 bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <div class="text-center">
                <div class="w-16 h-16 mx-auto bg-w44Light rounded-sm flex items-center justify-center mb-4 border border-gray-200">
                    <span class="text-2xl">📐</span>
                </div>
                <h3 class="font-bold text-w44Black uppercase mb-2">Space Optimized</h3>
                <p class="text-sm text-w44Grey">Engineered designs that maximize your storage capacity while minimizing floor footprint.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 mx-auto bg-w44Light rounded-sm flex items-center justify-center mb-4 border border-gray-200">
                    <span class="text-2xl">🛡️</span>
                </div>
                <h3 class="font-bold text-w44Black uppercase mb-2">100% Termite Free</h3>
                <p class="text-sm text-w44Grey">Heavy-duty sheet metal construction guarantees a long, pest-free lifespan.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 mx-auto bg-w44Light rounded-sm flex items-center justify-center mb-4 border border-gray-200">
                    <span class="text-2xl">🔧</span>
                </div>
                <h3 class="font-bold text-w44Black uppercase mb-2">Modular Assembly</h3>
                <p class="text-sm text-w44Grey">Smart modular components that allow for rapid deployment and on-site assembly.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 mx-auto bg-w44Light rounded-sm flex items-center justify-center mb-4 border border-gray-200">
                    <span class="text-2xl">✅</span>
                </div>
                <h3 class="font-bold text-w44Black uppercase mb-2">ISO Certified Quality</h3>
                <p class="text-sm text-w44Grey">Manufactured under strict ISO 17025 quality control protocols.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section 7: Industry / Application Focus -->
<section class="py-20 bg-w44Light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-heading font-bold uppercase tracking-wider text-w44Black">Solutions Built For Your Sector</h2>
            <div class="w-24 h-1 bg-w44Yellow mx-auto mt-4"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 border-t-4 border-w44Yellow shadow-sm rounded-sm">
                <h3 class="text-xl font-bold uppercase text-w44Black mb-4">Industrial & Warehousing</h3>
                <p class="text-w44Grey text-sm mb-6">Heavy-duty Drawer Cabinets, VMC Tooling Storage, and Compactors designed to organize shop floors and secure valuable equipment.</p>
                <a href="products.php?cat=vmc-tooling" class="text-w44Yellow font-bold text-sm uppercase hover:text-w44Black transition-colors">View Industrial Range &rarr;</a>
            </div>
            <div class="bg-white p-8 border-t-4 border-w44Grey shadow-sm rounded-sm">
                <h3 class="text-xl font-bold uppercase text-w44Black mb-4">Institutional & Office</h3>
                <p class="text-w44Grey text-sm mb-6">Secure Lockers and Storage Cabinets engineered for high-traffic environments, schools, laboratories, and corporate offices.</p>
                <a href="products.php?cat=lockers" class="text-w44Yellow font-bold text-sm uppercase hover:text-w44Black transition-colors">View Institutional Range &rarr;</a>
            </div>
            <div class="bg-white p-8 border-t-4 border-w44Black shadow-sm rounded-sm">
                <h3 class="text-xl font-bold uppercase text-w44Black mb-4">Home & City Living</h3>
                <p class="text-w44Grey text-sm mb-6">Modern, space-optimized wardrobes and cupboards that provide termite-free, durable storage for residential spaces.</p>
                <a href="products.php?cat=storage-cabinet" class="text-w44Yellow font-bold text-sm uppercase hover:text-w44Black transition-colors">View Home Range &rarr;</a>
            </div>
        </div>
    </div>
</section>

<!-- Section 8: Manufacturing Process Timeline -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-heading font-bold uppercase tracking-wider text-w44Black">How We Work</h2>
            <div class="w-24 h-1 bg-w44Yellow mx-auto mt-4"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center relative">
            <!-- Connecting Line (Desktop only) -->
            <div class="hidden md:block absolute top-8 left-12 right-12 h-0.5 bg-gray-200 z-0"></div>
            
            <div class="relative z-10">
                <div class="w-16 h-16 mx-auto bg-w44Black text-w44Yellow rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-md">1</div>
                <h3 class="font-bold uppercase text-w44Black mb-2">Requirement Analysis</h3>
                <p class="text-sm text-w44Grey">Understanding your specific space and storage needs.</p>
            </div>
            <div class="relative z-10">
                <div class="w-16 h-16 mx-auto bg-w44Black text-w44Yellow rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-md">2</div>
                <h3 class="font-bold uppercase text-w44Black mb-2">Custom Design & Quote</h3>
                <p class="text-sm text-w44Grey">Providing exact specifications and transparent pricing.</p>
            </div>
            <div class="relative z-10">
                <div class="w-16 h-16 mx-auto bg-w44Black text-w44Yellow rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-md">3</div>
                <h3 class="font-bold uppercase text-w44Black mb-2">Precision Manufacturing</h3>
                <p class="text-sm text-w44Grey">Fabrication at our Kolhapur facility using advanced machinery.</p>
            </div>
            <div class="relative z-10">
                <div class="w-16 h-16 mx-auto bg-w44Yellow text-w44Black rounded-full flex items-center justify-center font-bold text-xl mb-4 shadow-md">4</div>
                <h3 class="font-bold uppercase text-w44Black mb-2">Delivery & Assembly</h3>
                <p class="text-sm text-w44Grey">Secure transport and professional on-site installation.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section 9: Bottom of Funnel Lead Generation Form -->
<section id="quote-form" class="py-0 bg-w44Black text-white">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col lg:flex-row">
            <!-- Call to Action Left -->
            <div class="lg:w-1/2 p-10 lg:p-20 flex flex-col justify-center">
                <h2 class="text-3xl md:text-5xl font-heading font-bold uppercase tracking-tight mb-6">Ready to Upgrade Your Storage?</h2>
                <p class="text-gray-300 mb-8 text-lg">Contact our engineering team today. We will analyze your requirements and provide a custom manufacturing quote tailored to your facility.</p>
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-w44Yellow rounded-full flex items-center justify-center">
                        <span class="text-w44Black font-bold">📞</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400 uppercase tracking-wider">Direct Sales Line</p>
                        <p class="text-xl font-bold">+91 91756 76244</p>
                    </div>
                </div>
            </div>
            
            <!-- Lead Form Right -->
            <div class="lg:w-1/2 bg-white p-10 lg:p-20 rounded-tl-3xl lg:rounded-l-none">
                <h3 class="text-2xl font-bold text-w44Black mb-8 uppercase">Request a Custom Quote</h3>
                <!-- Form posts to submit-inquiry.php which handles the email logic -->
                <form action="submit-inquiry.php" method="POST" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-bold text-w44Grey mb-2 uppercase">Full Name / Company Name *</label>
                        <input type="text" id="name" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-sm focus:outline-none focus:border-w44Yellow focus:ring-1 focus:ring-w44Yellow text-w44Black">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-bold text-w44Grey mb-2 uppercase">Email Address *</label>
                            <input type="email" id="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-sm focus:outline-none focus:border-w44Yellow text-w44Black">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-bold text-w44Grey mb-2 uppercase">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" required class="w-full px-4 py-3 border border-gray-300 rounded-sm focus:outline-none focus:border-w44Yellow text-w44Black">
                        </div>
                    </div>
                    <div>
                        <label for="interest" class="block text-sm font-bold text-w44Grey mb-2 uppercase">Primary Interest *</label>
                        <select id="interest" name="interest" required class="w-full px-4 py-3 border border-gray-300 rounded-sm focus:outline-none focus:border-w44Yellow text-w44Black bg-white">
                            <option value="">Select a Category...</option>
                            <option value="Lockers">Lockers</option>
                            <option value="Compactor Storage">Compactor Storage System</option>
                            <option value="Drawer Cabinet">Drawer Cabinet</option>
                            <option value="VMC Tooling">VMC / CNC Tooling Storage</option>
                            <option value="Storage Cabinet">Storage Cabinet</option>
                            <option value="Other / Not Sure">Multiple / Other</option>
                        </select>
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-bold text-w44Grey mb-2 uppercase">Project Details *</label>
                        <textarea id="message" name="message" rows="4" required class="w-full px-4 py-3 border border-gray-300 rounded-sm focus:outline-none focus:border-w44Yellow text-w44Black placeholder-gray-400" placeholder="Tell us about your space requirements, quantities, or specific use-case..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-w44Black text-white font-bold uppercase tracking-wide px-8 py-4 text-center hover:bg-w44Yellow hover:text-w44Black transition-colors rounded-sm shadow-md">
                        Submit Enquiry
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
// Include Universal Footer
require_once 'includes/footer.php';
?>