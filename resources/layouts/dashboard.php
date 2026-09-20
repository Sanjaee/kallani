<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$basePrefix = (strpos($currentPath, '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = $activePage ?? 'demand';
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
<body class="bg-[#040804] text-gray-100 font-inter min-h-screen flex flex-col antialiased selection:bg-emerald-500 selection:text-black">

    <div class="flex flex-1 min-h-screen overflow-hidden">

        <!-- LEFT SIDEBAR NAVIGATION (MATCHING IMAGE #2 EXACTLY) -->
        <aside class="w-64 bg-[#060D07] border-r border-[#152416] flex flex-col justify-between shrink-0 relative z-30 select-none overflow-y-auto">
            
            <!-- Sidebar Top Content -->
            <div class="p-5 space-y-6">

                <!-- Brand Header -->
                <div class="space-y-1 pb-4 border-b border-[#152416]">
                    <a href="<?php echo $basePrefix; ?>/" class="block">
                        <div class="text-xl font-serif font-light tracking-[0.25em] text-white uppercase leading-none">KALLANI</div>
                        <div class="text-[9px] font-mono tracking-[0.2em] text-emerald-400 uppercase mt-1">NINA / OPERATING SYSTEM</div>
                    </a>
                </div>

                <!-- CATEGORY 1: PRODUCTION -->
                <div class="space-y-1.5">
                    <div class="text-[10px] font-mono font-semibold tracking-wider text-gray-400 uppercase px-2 mb-2">PRODUCTION</div>
                    
                    <!-- 02 Demand -->
                    <a href="<?php echo $basePrefix; ?>/demand" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'demand') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <span>Demand</span>
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

                    <!-- 10 My Allocations -->
                    <a href="<?php echo $basePrefix; ?>/my-allocations" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'allocations') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            <span>My Allocations</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'allocations') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">10</span>
                    </a>
                </div>

                <!-- CATEGORY 2: OPERATIONS -->
                <div class="space-y-1.5 pt-2">
                    <div class="text-[10px] font-mono font-semibold tracking-wider text-gray-400 uppercase px-2 mb-2">OPERATIONS</div>
                    
                    <!-- 08 Batches -->
                    <a href="<?php echo $basePrefix; ?>/batches" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'batches') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <span>Batches</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'batches') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">08</span>
                    </a>

                    <!-- 11 Milestones -->
                    <a href="<?php echo $basePrefix; ?>/milestones" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'milestones') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Milestones</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'milestones') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">11</span>
                    </a>

                    <!-- 12 RAB & Budget -->
                    <a href="<?php echo $basePrefix; ?>/rab-budget" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'rab') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>RAB & Budget</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'rab') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">12</span>
                    </a>

                    <!-- 13 Vendors -->
                    <a href="<?php echo $basePrefix; ?>/vendors" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'vendors') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <span>Vendors</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'vendors') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">13</span>
                    </a>
                </div>

                <!-- CATEGORY 3: TRANSPARENCY -->
                <div class="space-y-1.5 pt-2">
                    <div class="text-[10px] font-mono font-semibold tracking-wider text-gray-400 uppercase px-2 mb-2">TRANSPARENCY</div>
                    
                    <!-- 17 Verification -->
                    <a href="<?php echo $basePrefix; ?>/verification" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'verification') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            <span>Verification</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'verification') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">17</span>
                    </a>

                    <!-- 15 Documents -->
                    <a href="<?php echo $basePrefix; ?>/documents" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium transition-all group <?php echo ($activePage === 'documents') ? 'bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 font-semibold shadow-lg shadow-emerald-950' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?>">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            <span>Documents</span>
                        </div>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded <?php echo ($activePage === 'documents') ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-gray-400'; ?>">15</span>
                    </a>

                    <!-- 20 Audit Trail -->
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

            <!-- TOP HEADER BAR -->
            <header class="h-14 border-b border-[#152416] bg-[#060D07]/90 backdrop-blur-md px-6 flex items-center justify-between sticky top-0 z-20">
                <nav class="flex items-center gap-6 text-xs font-mono text-gray-300">
                    <a href="<?php echo $basePrefix; ?>/" class="hover:text-emerald-400 transition font-medium">HOME</a>
                    <a href="<?php echo $basePrefix; ?>/explore" class="hover:text-emerald-400 transition font-medium">EXPLORE</a>
                    <a href="<?php echo $basePrefix; ?>/#system-architecture" class="hover:text-emerald-400 transition font-medium">HOW IT WORKS</a>
                    <a href="<?php echo $basePrefix; ?>/audit-trail" class="hover:text-emerald-400 transition font-medium">AUDIT</a>
                    <a href="<?php echo $basePrefix; ?>/explore" class="hover:text-emerald-400 transition font-medium">ABOUT</a>
                </nav>

                <div class="flex items-center gap-4 text-xs font-mono">
                    <span class="text-gray-400"><strong class="text-white">EN</strong> | ID</span>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded bg-[#0E1F11] border border-emerald-500/40 text-emerald-300 text-[11px]">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        SYSTEM STATUS <strong class="text-white">DEMO</strong>
                    </span>
                </div>
            </header>

            <!-- MAIN VIEW BODY -->
            <main class="flex-1">
                <?php echo $content ?? ''; ?>
            </main>

        </div>

    </div>

</body>
</html>
