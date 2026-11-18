<!-- Main Navigation Menu -->
<header class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="index.php">
                    <img class="h-12 w-auto" src="assets/images/wings44-logo.svg" alt="Wings44 Design and Manufacturing">
                </a>
            </div>
            
            <!-- Desktop Menu -->
            <nav class="hidden md:flex space-x-8">
                <a href="index.php" class="text-w44Black hover:text-w44Yellow px-3 py-2 text-sm font-semibold uppercase tracking-wider transition">Home</a>
                <a href="about.php" class="text-w44Black hover:text-w44Yellow px-3 py-2 text-sm font-semibold uppercase tracking-wider transition">About Us</a>
                
                <!-- Simple Dropdown for Core Products -->
                <div class="relative group">
                    <button class="text-w44Black hover:text-w44Yellow px-3 py-2 text-sm font-semibold uppercase tracking-wider transition flex items-center">
                        Products <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <!-- Dropdown Content -->
                    <div class="absolute left-0 mt-0 w-56 rounded-b-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 ease-in-out">
                        <div class="py-1">
                            <a href="products.php?cat=lockers" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-w44Yellow">Lockers</a>
                            <a href="products.php?cat=compactor" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-w44Yellow">Compactor Storage</a>
                            <a href="products.php?cat=drawer-cabinet" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-w44Yellow">Drawer Cabinets</a>
                            <a href="products.php?cat=vmc-tooling" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-w44Yellow">VMC/CNC Tooling</a>
                            <a href="products.php?cat=storage-cabinet" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-w44Yellow">Storage Cabinets</a>
                        </div>
                    </div>
                </div>
                
                <a href="manufacturing.php" class="text-w44Black hover:text-w44Yellow px-3 py-2 text-sm font-semibold uppercase tracking-wider transition">Infrastructure</a>
            </nav>

            <!-- CTA Button -->
            <div class="hidden md:flex items-center">
                <a href="contact.php" class="bg-w44Yellow text-w44Black font-bold uppercase tracking-wide text-sm px-6 py-3 rounded-sm shadow-md hover:bg-yellow-500 transition-colors">
                    Request a Quote
                </a>
            </div>
        </div>
    </div>
</header>