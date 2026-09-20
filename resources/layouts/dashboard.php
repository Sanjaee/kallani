<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$basePrefix = (strpos($currentPath, '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = $activePage ?? 'demand';

$reqPath = str_replace($basePrefix, '', $currentPath);
$activeTab = 'demand';
if (strpos($reqPath, '/demand') === 0 || strpos($reqPath, '/production-requirements') === 0) {
    $activeTab = 'demand';
} elseif (strpos($reqPath, '/capacity') === 0) {
    $activeTab = 'capacity';
} elseif (strpos($reqPath, '/explore') === 0 || strpos($reqPath, '/projects') === 0 || strpos($reqPath, '/project-overview') === 0) {
    $activeTab = 'explore';
} elseif (strpos($reqPath, '/allocations') === 0 || strpos($reqPath, '/my-allocations') === 0 || strpos($reqPath, '/po-allocation') === 0) {
    $activeTab = 'allocations';
} elseif ($uri === '/network' || strpos($reqPath, '/network') === 0 || strpos($reqPath, '/production-network') === 0 || strpos($reqPath, '/production-programs') === 0 || strpos($reqPath, '/programs') === 0) {
    $activeTab = 'network';
} elseif (strpos($reqPath, '/audit') === 0) {
    $activeTab = 'audit';
}
?>
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'KALLANI — NINA Operating System'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'nina-bg': '#040804',
                        'nina-surface': '#0A110B',
                        'nina-card': '#0E170F',
                        'nina-border': '#152416',
                        'nina-border-glow': '#1E3820',
                        'nina-emerald': '#10B981',
                        'nina-emerald-dark': '#059669',
                        'nina-accent': '#C5A059',
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                        'mono': ['JetBrains Mono', 'monospace'],
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        body {
            background-color: #040804 !important;
            color: #E2E8F0 !important;
            font-family: 'Inter', sans-serif;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #040804; }
        ::-webkit-scrollbar-thumb { background: #152416; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #10B981; }
    </style>
</head>
<body class="bg-[#040804] text-gray-100 font-inter min-h-screen flex flex-col antialiased selection:bg-emerald-500 selection:text-black" x-data="{ mobileMenuOpen: false }">

    <!-- FULL WIDTH TOP NAVBAR (SPANS FULL WIDTH ACROSS SCREEN ABOVE SIDEBAR AND MAIN CONTENT) -->
    <header class="h-16 bg-[#060D07]/95 backdrop-blur-md px-4 sm:px-6 flex items-center justify-between sticky top-0 z-40 shrink-0 w-full" style="border-bottom: none !important;">
        <!-- Left: Logo & Subtext -->
        <a href="<?php echo $basePrefix; ?>/" class="flex flex-col group text-left py-1 w-44 sm:w-56 shrink-0">
            <span class="text-sm sm:text-base font-serif font-extrabold tracking-[0.25em] uppercase leading-none transition-colors" style="color: #FFFFFF !important;">KALLANI</span>
            <span class="text-[8px] sm:text-[9px] font-mono tracking-[0.18em] uppercase leading-none mt-1" style="color: #FFFFFF !important;">NINA / OPERATING SYSTEM</span>
        </a>

        <!-- Desktop Nav Links with Active Underline -->
        <nav class="hidden lg:flex items-center gap-6 xl:gap-8 text-xs font-mono tracking-wider">
            <a href="<?php echo $basePrefix; ?>/demand" class="relative py-1.5 font-semibold transition-colors <?php echo ($activeTab === 'demand') ? 'text-white font-bold' : 'text-gray-300 hover:text-white'; ?>">
                <span>DEMAND</span>
                <?php if ($activeTab === 'demand'): ?>
                    <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-emerald-400 rounded-full"></span>
                <?php endif; ?>
            </a>
            <a href="<?php echo $basePrefix; ?>/capacity" class="relative py-1.5 font-semibold transition-colors <?php echo ($activeTab === 'capacity') ? 'text-white font-bold' : 'text-gray-300 hover:text-white'; ?>">
                <span>CAPACITY MAPPING</span>
                <?php if ($activeTab === 'capacity'): ?>
                    <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-emerald-400 rounded-full"></span>
                <?php endif; ?>
            </a>
            <a href="<?php echo $basePrefix; ?>/explore" class="relative py-1.5 font-semibold transition-colors <?php echo ($activeTab === 'explore') ? 'text-white font-bold' : 'text-gray-300 hover:text-white'; ?>">
                <span>EXPLORE PROJECTS</span>
                <?php if ($activeTab === 'explore'): ?>
                    <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-emerald-400 rounded-full"></span>
                <?php endif; ?>
            </a>
            <a href="<?php echo $basePrefix; ?>/allocations" class="relative py-1.5 font-semibold transition-colors <?php echo ($activeTab === 'allocations') ? 'text-white font-bold' : 'text-gray-300 hover:text-white'; ?>">
                <span>MY ALLOCATIONS</span>
                <?php if ($activeTab === 'allocations'): ?>
                    <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-emerald-400 rounded-full"></span>
                <?php endif; ?>
            </a>
            <a href="<?php echo $basePrefix; ?>/audit-trail" class="relative py-1.5 font-semibold transition-colors <?php echo ($activeTab === 'audit') ? 'text-white font-bold' : 'text-gray-300 hover:text-white'; ?>">
                <span>AUDIT TRAIL</span>
                <?php if ($activeTab === 'audit'): ?>
                    <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-emerald-400 rounded-full"></span>
                <?php endif; ?>
            </a>
        </nav>

        <!-- Right Controls: Language, Status & Hamburger Toggle Button -->
        <div class="flex items-center gap-3 sm:gap-4 text-xs font-mono">
            <div class="text-gray-400 select-none hidden sm:block">
                <strong class="text-white cursor-pointer hover:text-emerald-400">EN</strong> 
                <span class="text-gray-600 mx-1">|</span> 
                <span class="cursor-pointer hover:text-white">ID</span>
            </div>

            <!-- Demo Badge (Hidden on Mobile) -->
            <div class="hidden sm:inline-flex items-center gap-1.5 sm:gap-2 px-2.5 sm:px-3 py-1.5 rounded-lg bg-[#08150D] border border-emerald-500/30 text-[10px] sm:text-[11px] text-gray-300 shadow-sm">
                <span>SYSTEM STATUS</span>
                <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <strong class="text-white font-bold">DEMO</strong>
            </div>

            <!-- Mobile/Tablet Hamburger Toggle Button (Positioned on the Far Right) -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 rounded-lg bg-[#08150D] border border-emerald-500/30 text-emerald-400 hover:text-white focus:outline-none transition-colors" aria-label="Toggle Navigation">
                <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                <svg x-show="mobileMenuOpen" x-cloak class="w-5 h-5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </header>

    <!-- MOBILE & TABLET DRAWER OVERLAY -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileMenuOpen = false" 
         class="fixed inset-0 bg-black/80 backdrop-blur-md z-50 lg:hidden" x-cloak></div>

    <!-- MOBILE & TABLET DRAWER PANEL -->
    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         class="fixed inset-y-0 left-0 w-80 max-w-[85vw] bg-[#060D07] border-r border-[#152416] z-50 flex flex-col justify-between overflow-y-auto shadow-2xl lg:hidden" x-cloak>
        
        <div class="p-5 space-y-6">
            <!-- Drawer Header -->
            <div class="flex items-center justify-between pb-4 border-b border-[#152416]">
                <a href="<?php echo $basePrefix; ?>/" class="flex flex-col group text-left">
                    <span class="text-base font-serif font-extrabold tracking-[0.25em] uppercase text-white">KALLANI</span>
                    <span class="text-[9px] font-mono tracking-[0.18em] uppercase text-emerald-400 mt-0.5">NINA / OPERATING SYSTEM</span>
                </a>
                <button @click="mobileMenuOpen = false" class="p-2 rounded-lg bg-white/5 text-gray-400 hover:text-white focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Primary Top Tabs Navigation -->
            <div class="space-y-1">
                <div class="text-[10px] font-mono font-semibold tracking-wider text-emerald-400 uppercase px-2 mb-2">QUICK NAVIGATION</div>
                <a href="<?php echo $basePrefix; ?>/demand" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-xs font-semibold <?php echo ($activeTab === 'demand') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'text-gray-300 hover:bg-white/5'; ?>">
                    <span>DEMAND REQUIREMENTS</span>
                    <span class="text-[10px] font-mono opacity-80">TAB 01</span>
                </a>
                <a href="<?php echo $basePrefix; ?>/capacity" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-xs font-semibold <?php echo ($activeTab === 'capacity') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'text-gray-300 hover:bg-white/5'; ?>">
                    <span>CAPACITY MAPPING</span>
                    <span class="text-[10px] font-mono opacity-80">TAB 02</span>
                </a>
                <a href="<?php echo $basePrefix; ?>/explore" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-xs font-semibold <?php echo ($activeTab === 'explore') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'text-gray-300 hover:bg-white/5'; ?>">
                    <span>EXPLORE PROJECTS</span>
                    <span class="text-[10px] font-mono opacity-80">TAB 03</span>
                </a>
                <a href="<?php echo $basePrefix; ?>/allocations" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-xs font-semibold <?php echo ($activeTab === 'allocations') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'text-gray-300 hover:bg-white/5'; ?>">
                    <span>MY ALLOCATIONS</span>
                    <span class="text-[10px] font-mono opacity-80">TAB 04</span>
                </a>
                <a href="<?php echo $basePrefix; ?>/audit-trail" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-xs font-semibold <?php echo ($activeTab === 'audit') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'text-gray-300 hover:bg-white/5'; ?>">
                    <span>AUDIT TRAIL</span>
                    <span class="text-[10px] font-mono opacity-80">TAB 05</span>
                </a>
            </div>

            <div class="h-px bg-[#152416] my-4"></div>

            <!-- CATEGORY 1: PRODUCTION -->
            <div class="space-y-1.5">
                <div class="text-[10px] font-mono font-semibold tracking-wider text-gray-400 uppercase px-2 mb-2">PRODUCTION MODULES</div>
                <a href="<?php echo $basePrefix; ?>/demand" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium <?php echo ($activePage === 'demand') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <span>Demand Requirements</span>
                    </div>
                    <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-white/5 text-gray-400">02</span>
                </a>
                <a href="<?php echo $basePrefix; ?>/capacity-mapping" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium <?php echo ($activePage === 'capacity') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                        <span>Capacity Mapping</span>
                    </div>
                    <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-white/5 text-gray-400">03</span>
                </a>
                <a href="<?php echo $basePrefix; ?>/explore" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium <?php echo ($activePage === 'explore') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <span>Explore Projects</span>
                    </div>
                    <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-white/5 text-gray-400">04</span>
                </a>
                <a href="<?php echo $basePrefix; ?>/batches" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium <?php echo ($activePage === 'batches') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <span>Production Batches</span>
                    </div>
                    <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-white/5 text-gray-400">06</span>
                </a>
                <a href="<?php echo $basePrefix; ?>/po-allocation" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium <?php echo ($activePage === 'po-allocation') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>PO Allocations</span>
                    </div>
                    <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-white/5 text-gray-400">07</span>
                </a>
            </div>

            <!-- CATEGORY 2: OPERATIONS -->
            <div class="space-y-1.5 pt-2">
                <div class="text-[10px] font-mono font-semibold tracking-wider text-gray-400 uppercase px-2 mb-2">OPERATIONS</div>
                <a href="<?php echo $basePrefix; ?>/milestones" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium <?php echo ($activePage === 'milestones') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Milestones</span>
                    </div>
                    <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-white/5 text-gray-400">09</span>
                </a>
                <a href="<?php echo $basePrefix; ?>/rab-budget" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium <?php echo ($activePage === 'rab') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        <span>RAB & Budget</span>
                    </div>
                    <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-white/5 text-gray-400">10</span>
                </a>
                <a href="<?php echo $basePrefix; ?>/vendors" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium <?php echo ($activePage === 'vendors') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span>Partners & Vendors</span>
                    </div>
                    <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-white/5 text-gray-400">11</span>
                </a>
                <a href="<?php echo $basePrefix; ?>/verification" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium <?php echo ($activePage === 'verification') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        <span>Verification</span>
                    </div>
                    <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-white/5 text-gray-400">14</span>
                </a>
                <a href="<?php echo $basePrefix; ?>/commercial-output" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium <?php echo ($activePage === 'commercial') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        <span>Commercial Delivery</span>
                    </div>
                    <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-white/5 text-gray-400">15</span>
                </a>
                <a href="<?php echo $basePrefix; ?>/batch-completion" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium <?php echo ($activePage === 'completion') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Batch Completion</span>
                    </div>
                    <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-white/5 text-gray-400">16</span>
                </a>
            </div>

            <!-- CATEGORY 3: ECOSYSTEM & CONTROL -->
            <div class="space-y-1.5 pt-2">
                <div class="text-[10px] font-mono font-semibold tracking-wider text-gray-400 uppercase px-2 mb-2">ECOSYSTEM & CONTROL</div>
                <a href="<?php echo $basePrefix; ?>/production-network" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium <?php echo ($activePage === 'network') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                        <span>Production Network</span>
                    </div>
                    <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-white/5 text-gray-400">17</span>
                </a>
                <a href="<?php echo $basePrefix; ?>/my-allocations" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium <?php echo ($activePage === 'allocations') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span>Mitra Allocations</span>
                    </div>
                    <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-white/5 text-gray-400">18</span>
                </a>
                <a href="<?php echo $basePrefix; ?>/production-programs" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium <?php echo ($activePage === 'programs') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <span>Production Programs</span>
                    </div>
                    <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-white/5 text-gray-400">21</span>
                </a>
                <a href="<?php echo $basePrefix; ?>/documents" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium <?php echo ($activePage === 'documents') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        <span>Documents</span>
                    </div>
                    <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-white/5 text-gray-400">DOC</span>
                </a>
                <a href="<?php echo $basePrefix; ?>/audit-trail" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium <?php echo ($activePage === 'audit') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Audit Trail</span>
                    </div>
                    <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-white/5 text-gray-400">20</span>
                </a>
            </div>
        </div>

        <!-- Drawer Footer -->
        <div class="p-5 border-t border-[#152416] bg-[#040804]/80 space-y-2 text-[11px] text-gray-400">
            <div class="flex items-center justify-between text-xs font-mono">
                <span>LANGUAGE:</span>
                <div><strong class="text-white">EN</strong> | <span>ID</span></div>
            </div>
            <div class="text-white font-medium pt-1">Transparent production.</div>
            <div>Traceable value. Sustainable future.</div>
        </div>
    </div>

    <!-- MAIN WRAPPER (SIDEBAR ON LEFT, MAIN VIEW ON RIGHT BELOW FULL NAVBAR) -->
    <div class="flex flex-1 overflow-hidden">

        <!-- LEFT SIDEBAR NAVIGATION (NO DUPLICATE LOGO) -->
        <aside class="hidden lg:flex w-64 bg-[#060D07] border-r border-[#152416] flex-col justify-between shrink-0 relative z-30 select-none overflow-y-auto">
            
            <!-- Sidebar Top Content -->
            <div class="p-5 space-y-6">

                <!-- CATEGORY 1: PRODUCTION -->
                <div class="space-y-1.5">
                    <div class="text-[10px] font-mono font-semibold tracking-wider text-gray-400 uppercase px-2 mb-2">PRODUCTION</div>
                    
                    <!-- 02 Demand -->
                    <a href="<?php echo $basePrefix; ?>/demand" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'demand') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <span>Demand Requirements</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'demand') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">02</span>
                    </a>

                    <!-- 03 Capacity Mapping -->
                    <a href="<?php echo $basePrefix; ?>/capacity-mapping" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'capacity') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                            <span>Capacity Mapping</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'capacity') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">03</span>
                    </a>

                    <!-- 04 Explore Projects -->
                    <a href="<?php echo $basePrefix; ?>/explore" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'explore') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <span>Explore Projects</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'explore') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">04</span>
                    </a>

                    <!-- 06 Production Batches -->
                    <a href="<?php echo $basePrefix; ?>/batches" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'batches') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <span>Production Batches</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'batches') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">06</span>
                    </a>

                    <!-- 07 PO Allocations -->
                    <a href="<?php echo $basePrefix; ?>/po-allocation" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'po-allocation') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>PO Allocations</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'po-allocation') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">07</span>
                    </a>

                </div>

                <!-- CATEGORY 2: OPERATIONS -->
                <div class="space-y-1.5 pt-2">
                    <div class="text-[10px] font-mono font-semibold tracking-wider text-gray-400 uppercase px-2 mb-2">OPERATIONS</div>

                    <!-- 09 Milestones -->
                    <a href="<?php echo $basePrefix; ?>/milestones" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'milestones') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Milestones</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'milestones') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">09</span>
                    </a>

                    <!-- 10 RAB & Budget -->
                    <a href="<?php echo $basePrefix; ?>/rab-budget" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'rab') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            <span>RAB & Budget</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'rab') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">10</span>
                    </a>

                    <!-- 11 Partners & Vendors -->
                    <a href="<?php echo $basePrefix; ?>/vendors" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'vendors') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <span>Partners & Vendors</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'vendors') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">11</span>
                    </a>

                    <!-- 14 Verification -->
                    <a href="<?php echo $basePrefix; ?>/verification" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'verification') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            <span>Verification</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'verification') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">14</span>
                    </a>

                    <!-- 15 Commercial Delivery -->
                    <a href="<?php echo $basePrefix; ?>/commercial-output" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'commercial') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            <span>Commercial Delivery</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'commercial') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">15</span>
                    </a>

                    <!-- 16 Batch Completion -->
                    <a href="<?php echo $basePrefix; ?>/batch-completion" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'completion') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Batch Completion</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'completion') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">16</span>
                    </a>
                </div>

                <!-- CATEGORY 3: TRANSPARENCY & NETWORK -->
                <div class="space-y-1.5 pt-2">
                    <div class="text-[10px] font-mono font-semibold tracking-wider text-gray-400 uppercase px-2 mb-2">ECOSYSTEM & CONTROL</div>

                    <!-- 17 Production Network -->
                    <a href="<?php echo $basePrefix; ?>/production-network" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'network') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                            <span>Production Network</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'network') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">17</span>
                    </a>

                    <!-- 18 My Production Allocations -->
                    <a href="<?php echo $basePrefix; ?>/my-allocations" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'allocations') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span>Mitra Allocations</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'allocations') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">18</span>
                    </a>

                    <!-- 21 Production Programs -->
                    <a href="<?php echo $basePrefix; ?>/production-programs" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'programs') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <span>Production Programs</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'programs') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">21</span>
                    </a>

                    <!-- Documents -->
                    <a href="<?php echo $basePrefix; ?>/documents" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'documents') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            <span>Documents</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-white/5 text-gray-400">DOC</span>
                    </a>

                    <!-- Audit Trail -->
                    <a href="<?php echo $basePrefix; ?>/audit-trail" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'audit') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Audit Trail</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'audit') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">20</span>
                    </a>
                </div>

            </div>

            <!-- Sidebar Bottom Branding -->
            <div class="p-5 border-t border-[#152416] bg-[#040804]/80 space-y-1 text-[11px] text-gray-400">
                <div class="text-white font-medium">Transparent production.</div>
                <div>Traceable value.</div>
                <div>A sustainable future.</div>
            </div>

        </aside>

        <!-- MAIN DASHBOARD CONTENT WRAPPER -->
        <div class="flex-1 flex flex-col min-w-0 bg-[#040804] overflow-y-auto">
            <!-- MAIN VIEW BODY -->
            <main class="flex-1">
                <?php echo $content ?? ''; ?>
            </main>
        </div>

    </div>

</body>
</html>
