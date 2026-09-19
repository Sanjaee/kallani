<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$project = $config['projects'][0];
$title = 'Kallani — Operating System for Productive Natural Assets';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
ob_start();
?>

<div class="landing-presentation text-[#171717] dark:text-gray-100 overflow-hidden" x-data="{ activeDiagramStage: 'Asset', activeParcel: 'A' }">
    
    <!-- SECTION 01 — CINEMATIC HERO -->
    <section class="relative min-h-[calc(100vh-73px)] flex items-center justify-center overflow-hidden bg-emerald-950 text-white py-20 px-4">
        <!-- Parallax Hero Background Imagery -->
        <div class="absolute inset-0 z-0 opacity-45 scale-105 transition-transform duration-1000 transform hover:scale-100" id="hero-bg">
            <img src="<?php echo $basePrefix; ?>/lanskap-sawi_Miftahurrohman.jpg" alt="Natural Asset Aerial Landscape" class="w-full h-full object-cover object-center filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0B1508] via-[#0B1508]/60 to-transparent"></div>
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-transparent via-[#0B1508]/40 to-[#0B1508]"></div>
        </div>

        <!-- Animated Topographic Overlay Pattern -->
        <div class="absolute inset-0 z-0 opacity-15 pointer-events-none bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px]"></div>

        <div class="relative z-10 max-w-5xl mx-auto text-center px-4 flex flex-col items-center">
            <!-- Floating Institutional Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-900/80 border border-emerald-500/40 text-emerald-300 text-xs font-bold uppercase tracking-widest backdrop-blur-md mb-8 shadow-2xl animate-pulse">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                <span>Institutional Operating Model Demo</span>
            </div>

            <!-- Main Editorial Headline -->
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white mb-6 leading-[1.1] text-balance">
                Operating Systems for <br class="hidden sm:inline" />
                <span class="bg-gradient-to-r from-emerald-300 via-emerald-100 to-amber-200 bg-clip-text text-transparent">Productive Natural Assets</span>
            </h1>

            <!-- Supporting Statement -->
            <p class="text-lg sm:text-2xl text-gray-300 font-normal max-w-3xl mb-10 leading-relaxed font-sans text-balance">
                Connecting physical assets, operations, verification, capital, and revenue into one integrated, auditable operating system.
            </p>

            <!-- Primary CTAs -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 w-full sm:w-auto mb-16">
                <a href="#core-idea" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-base shadow-xl shadow-emerald-950/50 transition-all hover:scale-105 flex items-center justify-center gap-2 border border-emerald-400/30">
                    <span>Explore Kallani System</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                </a>
                <a href="<?php echo $basePrefix; ?>/projects/north-kalimantan-palm" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-base backdrop-blur-md border border-white/20 transition-all hover:scale-105 flex items-center justify-center gap-2">
                    <span>View North Kalimantan Project</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>

            <!-- Key Asset Quick Summary Cards -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 w-full max-w-4xl text-left border-t border-white/10 pt-8">
                <div class="p-3.5 rounded-xl bg-white/5 border border-white/10 backdrop-blur-sm">
                    <span class="block text-xs text-gray-400 uppercase tracking-wider font-semibold">Demo Concession</span>
                    <span class="text-base sm:text-lg font-bold text-white mt-0.5 block">North Kalimantan</span>
                </div>
                <div class="p-3.5 rounded-xl bg-white/5 border border-white/10 backdrop-blur-sm">
                    <span class="block text-xs text-gray-400 uppercase tracking-wider font-semibold">Total Area</span>
                    <span class="text-base sm:text-lg font-bold text-emerald-300 mt-0.5 block">4,000 Hectares</span>
                </div>
                <div class="p-3.5 rounded-xl bg-white/5 border border-white/10 backdrop-blur-sm">
                    <span class="block text-xs text-gray-400 uppercase tracking-wider font-semibold">Asset Class</span>
                    <span class="text-base sm:text-lg font-bold text-white mt-0.5 block">Palm Plantation</span>
                </div>
                <div class="p-3.5 rounded-xl bg-white/5 border border-white/10 backdrop-blur-sm">
                    <span class="block text-xs text-gray-400 uppercase tracking-wider font-semibold">Audit Status</span>
                    <span class="text-base sm:text-lg font-bold text-emerald-400 mt-0.5 block flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        <span>Verified</span>
                    </span>
                </div>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <a href="#core-idea" class="absolute bottom-6 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-2 text-xs font-semibold uppercase tracking-widest text-emerald-300/80 hover:text-white transition-colors">
            <span>Scroll To Discover</span>
            <div class="w-5 h-8 rounded-full border-2 border-emerald-400/50 flex justify-center pt-1">
                <div class="w-1 h-2 rounded-full bg-emerald-300 animate-bounce"></div>
            </div>
        </a>
    </section>

    <!-- SECTION 02 — THE CORE IDEA -->
    <section id="core-idea" class="py-24 px-4 bg-[#F7F7F4] dark:bg-[#10170F] border-b border-gray-200 dark:border-gray-800">
        <div class="max-w-6xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 dark:text-emerald-400 mb-2 block">System Architecture</span>
                <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight mb-4">Natural Assets. One Connected System.</h2>
                <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400">
                    Traditional natural asset investments fragment land, physical operations, third-party verification, and capital allocation. Kallani unifies every stage into one auditable operating model.
                </p>
            </div>

            <!-- Interactive Operating Lifecycle Diagram -->
            <div class="bg-white dark:bg-[#162014] rounded-3xl p-6 sm:p-10 border border-gray-200 dark:border-gray-800 shadow-xl">
                <!-- Lifecycle Stage Selector Bar -->
                <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-2 mb-8">
                    <?php 
                    $stages = [
                        'Asset' => ['icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z', 'sub' => 'Physical Asset'],
                        'Project' => ['icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1', 'sub' => 'Concession'],
                        'Operations' => ['icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z', 'sub' => 'Field Metrics'],
                        'Verification' => ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'sub' => 'Third-Party'],
                        'Capital' => ['icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'sub' => 'Allocation'],
                        'Revenue' => ['icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'sub' => 'Flow'],
                        'Distribution' => ['icon' => 'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4', 'sub' => 'Payouts']
                    ];
                    foreach ($stages as $key => $info):
                    ?>
                    <button @click="activeDiagramStage = '<?php echo $key; ?>'" class="p-3 rounded-2xl text-left transition-all border flex flex-col justify-between" :class="activeDiagramStage === '<?php echo $key; ?>' ? 'bg-emerald-700 text-white border-emerald-600 shadow-md scale-105' : 'bg-gray-50 dark:bg-gray-900/60 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:bg-gray-100 dark:hover:bg-gray-800'">
                        <div class="flex items-center justify-between mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo $info['icon']; ?>"></path></svg>
                            <span class="w-2 h-2 rounded-full" :class="activeDiagramStage === '<?php echo $key; ?>' ? 'bg-amber-300 animate-pulse' : 'bg-gray-300 dark:bg-gray-700'"></span>
                        </div>
                        <div>
                            <span class="block text-xs font-bold"><?php echo $key; ?></span>
                            <span class="block text-[10px] opacity-80 font-medium"><?php echo $info['sub']; ?></span>
                        </div>
                    </button>
                    <?php endforeach; ?>
                </div>

                <!-- Stage Detail Display Card -->
                <div class="bg-gray-50 dark:bg-[#0D140B] rounded-2xl p-6 sm:p-8 border border-gray-200 dark:border-gray-800 flex flex-col md:flex-row items-center gap-8">
                    <div class="flex-1 text-left">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800 mb-4">
                            <span>Stage Focus</span>
                            <span>•</span>
                            <span x-text="activeDiagramStage"></span>
                        </div>
                        
                        <div x-show="activeDiagramStage === 'Asset'" x-transition>
                            <h3 class="text-2xl font-bold mb-3">Physical Asset Layer</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Establishes verifiable GIS boundary mappings, topographic elevation models, soil quality indices, and satellite tracking across 4,000 hectares of palm concession in North Kalimantan.</p>
                            <div class="grid grid-cols-2 gap-4 text-xs">
                                <div class="p-3 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
                                    <span class="text-gray-500 block">Boundary Area</span>
                                    <span class="font-bold text-base text-emerald-700 dark:text-emerald-400">4,000 Hectares</span>
                                </div>
                                <div class="p-3 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
                                    <span class="text-gray-500 block">Elevation Range</span>
                                    <span class="font-bold text-base text-gray-900 dark:text-white">15m - 85m ASL</span>
                                </div>
                            </div>
                        </div>

                        <div x-show="activeDiagramStage === 'Project'" x-transition style="display:none;">
                            <h3 class="text-2xl font-bold mb-3">Project Management Layer</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Aggregates concession permits, master development schedules, zoning registries, and infrastructure blueprints into an operational project baseline.</p>
                            <div class="grid grid-cols-2 gap-4 text-xs">
                                <div class="p-3 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
                                    <span class="text-gray-500 block">Concession ID</span>
                                    <span class="font-bold text-base text-emerald-700 dark:text-emerald-400">NKP-2026-04</span>
                                </div>
                                <div class="p-3 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
                                    <span class="text-gray-500 block">Project Status</span>
                                    <span class="font-bold text-base text-gray-900 dark:text-white">Developing / Operational</span>
                                </div>
                            </div>
                        </div>

                        <div x-show="activeDiagramStage === 'Operations'" x-transition style="display:none;">
                            <h3 class="text-2xl font-bold mb-3">Operations Tracking Layer</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Real-time recording of planting density, harvest cycles, fertilizer applications, road maintenance, and Fresh Fruit Bunch (FFB) extraction yields.</p>
                            <div class="grid grid-cols-2 gap-4 text-xs">
                                <div class="p-3 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
                                    <span class="text-gray-500 block">Planting Progress</span>
                                    <span class="font-bold text-base text-emerald-700 dark:text-emerald-400">78% Complete</span>
                                </div>
                                <div class="p-3 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
                                    <span class="text-gray-500 block">Current Yield</span>
                                    <span class="font-bold text-base text-gray-900 dark:text-white">19.4 MT / ha</span>
                                </div>
                            </div>
                        </div>

                        <div x-show="activeDiagramStage === 'Verification'" x-transition style="display:none;">
                            <h3 class="text-2xl font-bold mb-3">Verification & Attestation Layer</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Independent third-party audits, legal concession reviews, environmental compliance ratings (RSPO/ISPO), and tamper-evident document hashing.</p>
                            <div class="grid grid-cols-2 gap-4 text-xs">
                                <div class="p-3 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
                                    <span class="text-gray-500 block">Overall Verification</span>
                                    <span class="font-bold text-base text-emerald-700 dark:text-emerald-400">82% Verified</span>
                                </div>
                                <div class="p-3 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
                                    <span class="text-gray-500 block">Compliance</span>
                                    <span class="font-bold text-base text-gray-900 dark:text-white">RSPO & ISPO Certified</span>
                                </div>
                            </div>
                        </div>

                        <div x-show="activeDiagramStage === 'Capital'" x-transition style="display:none;">
                            <h3 class="text-2xl font-bold mb-3">Capital Allocation Layer</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Tracks institutional capital deployment across land development, processing infrastructure, operational reserves, and working capital funds.</p>
                            <div class="grid grid-cols-2 gap-4 text-xs">
                                <div class="p-3 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
                                    <span class="text-gray-500 block">Required Capital</span>
                                    <span class="font-bold text-base text-emerald-700 dark:text-emerald-400">$8.2M USD</span>
                                </div>
                                <div class="p-3 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
                                    <span class="text-gray-500 block">Committed Ratio</span>
                                    <span class="font-bold text-base text-gray-900 dark:text-white">82.9% Funded</span>
                                </div>
                            </div>
                        </div>

                        <div x-show="activeDiagramStage === 'Revenue'" x-transition style="display:none;">
                            <h3 class="text-2xl font-bold mb-3">Revenue Generation Layer</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Monitors gross revenues from crude palm oil (CPO) sales, palm kernel sales, byproduct extraction, and certified carbon potential credits.</p>
                            <div class="grid grid-cols-2 gap-4 text-xs">
                                <div class="p-3 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
                                    <span class="text-gray-500 block">Gross Revenue (Est)</span>
                                    <span class="font-bold text-base text-emerald-700 dark:text-emerald-400">$4.85M USD</span>
                                </div>
                                <div class="p-3 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
                                    <span class="text-gray-500 block">Net Margin</span>
                                    <span class="font-bold text-base text-gray-900 dark:text-white">60.2% Net</span>
                                </div>
                            </div>
                        </div>

                        <div x-show="activeDiagramStage === 'Distribution'" x-transition style="display:none;">
                            <h3 class="text-2xl font-bold mb-3">Distribution & Payout Layer</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Calculates net distributable cash flow after operational costs, maintenance reserves, and institutional payout distributions.</p>
                            <div class="grid grid-cols-2 gap-4 text-xs">
                                <div class="p-3 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
                                    <span class="text-gray-500 block">Net Distributable</span>
                                    <span class="font-bold text-base text-emerald-700 dark:text-emerald-400">$2.92M USD</span>
                                </div>
                                <div class="p-3 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
                                    <span class="text-gray-500 block">Payout Frequency</span>
                                    <span class="font-bold text-base text-gray-900 dark:text-white">Quarterly Audited</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stage Diagram Image / Preview Canvas -->
                    <div class="w-full md:w-80 h-56 rounded-xl overflow-hidden relative border border-gray-200 dark:border-gray-800 shadow-md shrink-0">
                        <img src="<?php echo $basePrefix; ?>/Kebun-Sawit-3.jpg" alt="Operating System Stage Visual" class="w-full h-full object-cover filter brightness-95" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-4">
                            <span class="text-xs font-bold text-emerald-400 uppercase tracking-wider">Kallani OS Engine</span>
                            <span class="text-xs text-gray-200">Interactive Pipeline Demonstration</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 03 — FROM LAND TO OPERATING ASSET -->
    <section class="py-24 px-4 bg-white dark:bg-[#0B1209] border-b border-gray-200 dark:border-gray-800">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-left">
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 dark:text-emerald-400 mb-2 block">Physical Asset Spotlight</span>
                    <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight mb-6 leading-tight">Every Project Starts with a Physical Asset.</h2>
                    <p class="text-base text-gray-600 dark:text-gray-400 mb-8 leading-relaxed">
                        The flagship demonstration asset is the <strong class="text-gray-900 dark:text-white">North Kalimantan Palm Project</strong>. Spanning 4,000 hectares of productive agricultural land in East Kalimantan, Indonesia, the concession combines mature palm production with active infrastructure development.
                    </p>

                    <!-- Interactive Parcel Selector Tabs -->
                    <div class="space-y-3 mb-8">
                        <button @click="activeParcel = 'A'" class="w-full p-4 rounded-xl text-left border transition-all flex items-center justify-between" :class="activeParcel === 'A' ? 'bg-emerald-50 dark:bg-emerald-950/60 border-emerald-500 font-bold' : 'bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-800 hover:bg-gray-100'">
                            <div>
                                <span class="block text-sm text-gray-900 dark:text-white font-bold">Zone A — Mature Plantation (1,800 ha)</span>
                                <span class="text-xs text-gray-500 font-normal">Active harvesting • Peak FFB production yield</span>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-300">Operational</span>
                        </button>

                        <button @click="activeParcel = 'B'" class="w-full p-4 rounded-xl text-left border transition-all flex items-center justify-between" :class="activeParcel === 'B' ? 'bg-emerald-50 dark:bg-emerald-950/60 border-emerald-500 font-bold' : 'bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-800 hover:bg-gray-100'">
                            <div>
                                <span class="block text-sm text-gray-900 dark:text-white font-bold">Zone B — Developing Plantation (1,400 ha)</span>
                                <span class="text-xs text-gray-500 font-normal">Young palm stands • Irrigation channel development</span>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-300">Developing</span>
                        </button>

                        <button @click="activeParcel = 'C'" class="w-full p-4 rounded-xl text-left border transition-all flex items-center justify-between" :class="activeParcel === 'C' ? 'bg-emerald-50 dark:bg-emerald-950/60 border-emerald-500 font-bold' : 'bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-800 hover:bg-gray-100'">
                            <div>
                                <span class="block text-sm text-gray-900 dark:text-white font-bold">Zone C — Processing & Hub (800 ha)</span>
                                <span class="text-xs text-gray-500 font-normal">CPO extraction mill • Logistics loading dock</span>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">Infrastructure</span>
                        </button>
                    </div>

                    <a href="<?php echo $basePrefix; ?>/projects/north-kalimantan-palm/asset" class="inline-flex items-center gap-2 text-sm font-bold text-emerald-700 dark:text-emerald-400 hover:text-emerald-600 transition-colors">
                        <span>Inspect Interactive Parcel Map</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <!-- Parcel Aerial Imagery Map Preview -->
                <div class="relative rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-800 shadow-2xl group">
                    <img src="<?php echo $basePrefix; ?>/4WY8vDotTPOafEjbvq7Bgg9RCYYyYkDo1TOl2Olx1JH2gxw3JIOVMjwGnr7v6Bi5nWZ2fjC8UgASwpnqo7YSQOBlxgzBafCB8qnKjgTASGa_6fvQuTB_gCgcLtzcpwlHEmm-HAiP3-JfSuVH-g__Mq-XzfpXjocajpV4sgGRZLM.jpg" alt="Concession Parcel Map" class="w-full h-[450px] object-cover filter contrast-105 group-hover:scale-105 transition-transform duration-700" />
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent p-6 flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-black/60 text-white backdrop-blur-md border border-white/20">GIS Parcel Map Overlay</span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-500 text-white">4,000 Hectares</span>
                        </div>

                        <div class="bg-black/70 backdrop-blur-md p-4 rounded-2xl border border-white/10 text-white text-left">
                            <span class="text-xs text-emerald-400 font-bold uppercase tracking-wider block" x-text="activeParcel === 'A' ? 'Active Selection: Zone A' : (activeParcel === 'B' ? 'Active Selection: Zone B' : 'Active Selection: Zone C')"></span>
                            <p class="text-xs text-gray-300 mt-1" x-text="activeParcel === 'A' ? 'High-density mature palm trees producing average 19.4 MT/ha FFB.' : (activeParcel === 'B' ? 'Young palm stands under scheduled fertilization and moisture monitoring.' : 'Central crude palm oil extraction mill & weighbridge facility.')"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 04 — THE OPERATING LIFECYCLE (GSAP Pinned Scroll) -->
    <section class="py-24 px-4 bg-[#F7F7F4] dark:bg-[#10170F] border-b border-gray-200 dark:border-gray-800" id="lifecycle-section">
        <div class="max-w-6xl mx-auto text-center mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 dark:text-emerald-400 mb-2 block">End-to-End Governance</span>
            <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight mb-4">The Operating Lifecycle</h2>
            <p class="text-base text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Discover how physical natural assets move seamlessly from land mapping to verified investor distributions.
            </p>
        </div>

        <div class="horizontal-scroll-container py-6">
            <div class="horizontal-scroll-wrapper gap-6 px-4">
                <?php 
                $lifecycleCards = [
                    ['num' => '01', 'title' => 'Physical Asset', 'desc' => 'Satellite boundary demarcation, GIS topographic mapping, soil indexing, and land ownership records.', 'tag' => 'Land Base', 'metric' => '4,000 ha Mapped'],
                    ['num' => '02', 'title' => 'Project', 'desc' => 'Concession permitting, environmental impact baselines, master development schedules, and budgeting.', 'tag' => 'Development', 'metric' => 'NKP-2026 Concession'],
                    ['num' => '03', 'title' => 'Operations', 'desc' => 'Field labor logs, harvest weight tracking, fertilizer applications, and processing mill extraction rates.', 'tag' => 'Real-Time Data', 'metric' => '19.4 MT/ha Yield'],
                    ['num' => '04', 'title' => 'Verification', 'desc' => 'Third-party auditor review, RSPO/ISPO sustainability validation, and document hashing.', 'tag' => 'Traceability', 'metric' => '82% Audited'],
                    ['num' => '05', 'title' => 'Capital', 'desc' => 'Institutional capital deployment, development fund allocation, and operational reserve management.', 'tag' => 'Ledger', 'metric' => '$8.2M Required'],
                    ['num' => '06', 'title' => 'Revenue', 'desc' => 'Gross income tracking from Crude Palm Oil (CPO) sales, byproduct extraction, and carbon potential.', 'tag' => 'Cash Flow', 'metric' => '$4.85M Gross'],
                    ['num' => '07', 'title' => 'Distribution', 'desc' => 'Audited net revenue calculation, maintenance reserve deduction, and investor payouts.', 'tag' => 'Payouts', 'metric' => '$2.92M Net Flow']
                ];
                foreach ($lifecycleCards as $card):
                ?>
                <div class="lifecycle-card bg-white dark:bg-[#162014] p-8 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-xl flex flex-col justify-between text-left">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <span class="text-4xl font-extrabold text-emerald-700 dark:text-emerald-400 font-mono"><?php echo $card['num']; ?></span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300"><?php echo $card['tag']; ?></span>
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-gray-900 dark:text-white"><?php echo $card['title']; ?></h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-6"><?php echo $card['desc']; ?></p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between text-xs">
                        <span class="text-gray-500">Key Indicator</span>
                        <span class="font-bold text-emerald-700 dark:text-emerald-300"><?php echo $card['metric']; ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- SECTION 05 — OPERATIONS -->
    <section class="py-24 px-4 bg-white dark:bg-[#0B1209] border-b border-gray-200 dark:border-gray-800">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5 text-left">
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 dark:text-emerald-400 mb-2 block">Operational Intelligence</span>
                    <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight mb-6 leading-tight">Make Operations Visible.</h2>
                    <p class="text-base text-gray-600 dark:text-gray-400 mb-8 leading-relaxed">
                        Monitor field activity, harvesting productivity, and processing mill throughput with real-time operational tracking. Eliminate blind spots across remote plantation sites.
                    </p>

                    <div class="space-y-4 text-sm font-semibold">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span>Planting Progress: 78% (3,120 of 4,000 ha)</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span>Average Harvest Yield: 19.4 MT / hectare</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span>Mill Processing Capacity: 45 MT FFB / hour</span>
                        </div>
                    </div>

                    <div class="mt-8">
                        <a href="<?php echo $basePrefix; ?>/projects/north-kalimantan-palm/operations" class="px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white font-bold text-sm inline-flex items-center gap-2 shadow-lg">
                            <span>Open Operations Dashboard</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Operations Preview Panel -->
                <div class="lg:col-span-7 bg-gray-50 dark:bg-[#121A10] p-6 sm:p-8 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-2xl">
                    <div class="flex items-center justify-between pb-4 mb-6 border-b border-gray-200 dark:border-gray-800">
                        <div class="text-left">
                            <h4 class="font-bold text-base text-gray-900 dark:text-white">Field Operations Feed</h4>
                            <span class="text-xs text-gray-500">Live Concession Activity Stream</span>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-300">Live Stream</span>
                    </div>

                    <div class="space-y-4">
                        <div class="p-4 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 text-left">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-sm">Zone A Harvest Batch #104</span>
                                <span class="text-xs text-emerald-600 font-semibold">Completed</span>
                            </div>
                            <p class="text-xs text-gray-500 mb-3">142 MT Fresh Fruit Bunches extracted and transported to central mill weighbridge.</p>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 100%;"></div>
                            </div>
                        </div>

                        <div class="p-4 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 text-left">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-sm">Zone B Irrigation Extension</span>
                                <span class="text-xs text-amber-600 font-semibold">78% In Progress</span>
                            </div>
                            <p class="text-xs text-gray-500 mb-3">2.4 km secondary drainage channels excavated for young palm blocks.</p>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 78%;"></div>
                            </div>
                        </div>

                        <div class="p-4 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 text-left">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-sm">Soil Organic Enrichment</span>
                                <span class="text-xs text-blue-600 font-semibold">Scheduled</span>
                            </div>
                            <p class="text-xs text-gray-500 mb-3">Application of composted empty fruit bunches across 600 ha parcel.</p>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 45%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 06 — VERIFICATION -->
    <section class="py-24 px-4 bg-[#F7F7F4] dark:bg-[#10170F] border-b border-gray-200 dark:border-gray-800" x-data="{ verTab: 'land' }">
        <div class="max-w-6xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 dark:text-emerald-400 mb-2 block">Third-Party Assurance</span>
                <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight mb-4">Build Confidence Through Traceability.</h2>
                <p class="text-base text-gray-600 dark:text-gray-400">
                    Every project document, land boundary survey, legal right, and sustainability assessment is independently verified and cryptographic hashes stored.
                </p>
            </div>

            <!-- Verification Workspace Container -->
            <div class="bg-white dark:bg-[#162014] rounded-3xl p-6 sm:p-10 border border-gray-200 dark:border-gray-800 shadow-xl">
                <!-- Filter Tabs -->
                <div class="flex flex-wrap gap-2 mb-8 pb-4 border-b border-gray-200 dark:border-gray-800">
                    <button @click="verTab = 'land'" class="px-5 py-2.5 rounded-xl text-xs font-bold transition-all" :class="verTab === 'land' ? 'bg-emerald-700 text-white shadow-md' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200'">Land & GIS</button>
                    <button @click="verTab = 'legal'" class="px-5 py-2.5 rounded-xl text-xs font-bold transition-all" :class="verTab === 'legal' ? 'bg-emerald-700 text-white shadow-md' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200'">Legal Rights</button>
                    <button @click="verTab = 'survey'" class="px-5 py-2.5 rounded-xl text-xs font-bold transition-all" :class="verTab === 'survey' ? 'bg-emerald-700 text-white shadow-md' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200'">Topographic Survey</button>
                    <button @click="verTab = 'docs'" class="px-5 py-2.5 rounded-xl text-xs font-bold transition-all" :class="verTab === 'docs' ? 'bg-emerald-700 text-white shadow-md' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200'">Audited Documents</button>
                </div>

                <!-- Tab Content -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                    <div x-show="verTab === 'land'" x-transition>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 mb-3 inline-block">Status: Verified</span>
                        <h4 class="text-xl font-bold mb-2">GIS Boundary & Spatial Verification</h4>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-6">4,000 hectares mapped via high-resolution drone photogrammetry and satellite SAR radar imagery.</p>
                        <div class="space-y-3 text-xs">
                            <div class="flex justify-between p-3 bg-gray-50 dark:bg-gray-900 rounded-xl">
                                <span class="text-gray-500">Reviewer Agency</span>
                                <span class="font-bold">AgriGIS Spatial Audit Ltd.</span>
                            </div>
                            <div class="flex justify-between p-3 bg-gray-50 dark:bg-gray-900 rounded-xl">
                                <span class="text-gray-500">Hash Verification</span>
                                <span class="font-mono font-bold text-emerald-600">0x8f4b...39a1</span>
                            </div>
                        </div>
                    </div>

                    <div x-show="verTab === 'legal'" x-transition style="display:none;">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 mb-3 inline-block">Status: Verified</span>
                        <h4 class="text-xl font-bold mb-2">Concession License & Cultivation Right (HGU)</h4>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-6">Full legal concession decree granted for 30-year operational term with extension option.</p>
                        <div class="space-y-3 text-xs">
                            <div class="flex justify-between p-3 bg-gray-50 dark:bg-gray-900 rounded-xl">
                                <span class="text-gray-500">Issuing Authority</span>
                                <span class="font-bold">Ministry of Land Affairs (BPN)</span>
                            </div>
                            <div class="flex justify-between p-3 bg-gray-50 dark:bg-gray-900 rounded-xl">
                                <span class="text-gray-500">Decree Number</span>
                                <span class="font-mono font-bold text-emerald-600">HGU-541/KAL-UT/2024</span>
                            </div>
                        </div>
                    </div>

                    <div x-show="verTab === 'survey'" x-transition style="display:none;">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300 mb-3 inline-block">Status: In Review</span>
                        <h4 class="text-xl font-bold mb-2">Soil Health & Hydrology Survey</h4>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-6">Periodic soil nutrient testing and water table monitoring across 40 sampling stations.</p>
                        <div class="space-y-3 text-xs">
                            <div class="flex justify-between p-3 bg-gray-50 dark:bg-gray-900 rounded-xl">
                                <span class="text-gray-500">Testing Station</span>
                                <span class="font-bold">North Kalimantan Soil Lab</span>
                            </div>
                            <div class="flex justify-between p-3 bg-gray-50 dark:bg-gray-900 rounded-xl">
                                <span class="text-gray-500">Completion</span>
                                <span class="font-mono font-bold text-amber-600">85% Sampled</span>
                            </div>
                        </div>
                    </div>

                    <div x-show="verTab === 'docs'" x-transition style="display:none;">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 mb-3 inline-block">Status: Verified</span>
                        <h4 class="text-xl font-bold mb-2">Audited Financial & ESG Vault</h4>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-6">Cryptographically signed annual financial audit reports and RSPO compliance certificates.</p>
                        <div class="space-y-3 text-xs">
                            <div class="flex justify-between p-3 bg-gray-50 dark:bg-gray-900 rounded-xl">
                                <span class="text-gray-500">Auditor Firm</span>
                                <span class="font-bold">Institutional Assurance Group</span>
                            </div>
                            <div class="flex justify-between p-3 bg-gray-50 dark:bg-gray-900 rounded-xl">
                                <span class="text-gray-500">Vault Reference</span>
                                <span class="font-mono font-bold text-emerald-600">DOC-2026-NKP-V8</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column Interactive Certificate Preview -->
                    <div class="bg-gray-50 dark:bg-[#0E160D] p-6 rounded-2xl border border-gray-200 dark:border-gray-800 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/60 text-emerald-700 dark:text-emerald-300 flex items-center justify-center font-bold">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                </div>
                                <div>
                                    <h5 class="font-bold text-sm">Verification Summary Card</h5>
                                    <span class="text-xs text-gray-500">Simulated Institutional Attestation</span>
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-4">All verification badges represent simulated demonstration data for the North Kalimantan Palm Project.</p>
                        </div>
                        <a href="<?php echo $basePrefix; ?>/projects/north-kalimantan-palm/verification" class="text-xs font-bold text-emerald-700 dark:text-emerald-400 hover:underline flex items-center gap-1">
                            <span>Open Verification Module</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 07 — CAPITAL & ALLOCATION -->
    <section class="py-24 px-4 bg-white dark:bg-[#0B1209] border-b border-gray-200 dark:border-gray-800">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5 text-left">
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 dark:text-emerald-400 mb-2 block">Capital Allocation</span>
                    <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight mb-6 leading-tight">Understand Where Capital Is Allocated.</h2>
                    <p class="text-base text-gray-600 dark:text-gray-400 mb-8 leading-relaxed">
                        Kallani provides transparent capital tracking, ensuring every dollar committed is mapped directly to land acquisition, infrastructure buildout, or operational reserves.
                    </p>

                    <div class="grid grid-cols-2 gap-4 text-left mb-8">
                        <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800">
                            <span class="text-xs text-gray-500 block">Total Project Value</span>
                            <span class="text-2xl font-extrabold text-emerald-700 dark:text-emerald-400">$12.5M USD</span>
                        </div>
                        <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800">
                            <span class="text-xs text-gray-500 block">Capital Committed</span>
                            <span class="text-2xl font-extrabold text-gray-900 dark:text-white">$6.8M USD</span>
                        </div>
                    </div>

                    <a href="<?php echo $basePrefix; ?>/projects/north-kalimantan-palm/capital" class="px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white font-bold text-sm inline-flex items-center gap-2 shadow-lg">
                        <span>Inspect Capital Ledger</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <!-- Capital Allocation Breakdown Visualization -->
                <div class="lg:col-span-7 bg-gray-50 dark:bg-[#121A10] p-6 sm:p-8 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-2xl">
                    <h4 class="font-bold text-base text-gray-900 dark:text-white mb-2 text-left">Capital Allocation Breakdown ($8.2M Required)</h4>
                    <p class="text-xs text-gray-500 mb-6 text-left">Simulated capital deployment breakdown across concession activities.</p>

                    <div class="space-y-4 text-left">
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span>Plantation Development & Planting (39.0%)</span>
                                <span class="text-emerald-700 dark:text-emerald-400">$3.20M USD</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 39%;"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span>Operations & Labor Working Capital (25.6%)</span>
                                <span class="text-emerald-700 dark:text-emerald-400">$2.10M USD</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill bg-blue-600" style="width: 25.6%;"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span>Mill Processing & Road Infrastructure (22.0%)</span>
                                <span class="text-emerald-700 dark:text-emerald-400">$1.80M USD</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill bg-amber-600" style="width: 22%;"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span>Risk & Maintenance Reserve (13.4%)</span>
                                <span class="text-emerald-700 dark:text-emerald-400">$1.10M USD</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill bg-purple-600" style="width: 13.4%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 08 — REVENUE & DISTRIBUTION -->
    <section class="py-24 px-4 bg-[#F7F7F4] dark:bg-[#10170F] border-b border-gray-200 dark:border-gray-800">
        <div class="max-w-6xl mx-auto text-center">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 dark:text-emerald-400 mb-2 block">Financial Waterfall</span>
            <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight mb-4">Follow the Flow from Revenue to Distribution.</h2>
            <p class="text-base text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-16">
                Understand the itemized flow from gross CPO sales to net investor distributions.
            </p>

            <!-- Waterfall Flow Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-left mb-12">
                <div class="p-6 bg-white dark:bg-[#162014] rounded-2xl border border-gray-200 dark:border-gray-800 shadow-md">
                    <span class="text-xs font-bold uppercase text-emerald-600 block mb-1">Step 1 — Gross Revenue</span>
                    <h4 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-2">$4,850,000</h4>
                    <p class="text-xs text-gray-500">Total annual sales from crude palm oil (CPO) & kernel extraction.</p>
                </div>

                <div class="p-6 bg-white dark:bg-[#162014] rounded-2xl border border-gray-200 dark:border-gray-800 shadow-md">
                    <span class="text-xs font-bold uppercase text-amber-600 block mb-1">Step 2 — Operating Cost</span>
                    <h4 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-2">-$1,420,000</h4>
                    <p class="text-xs text-gray-500">Field labor, fertilizer, harvesting logistics, and milling costs.</p>
                </div>

                <div class="p-6 bg-white dark:bg-[#162014] rounded-2xl border border-gray-200 dark:border-gray-800 shadow-md">
                    <span class="text-xs font-bold uppercase text-purple-600 block mb-1">Step 3 — Reserve Allocation</span>
                    <h4 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-2">-$510,000</h4>
                    <p class="text-xs text-gray-500">Equipment maintenance reserve & environmental compliance buffer.</p>
                </div>

                <div class="p-6 bg-emerald-900 text-white rounded-2xl border border-emerald-700 shadow-xl">
                    <span class="text-xs font-bold uppercase text-emerald-300 block mb-1">Step 4 — Net Distribution</span>
                    <h4 class="text-2xl font-extrabold text-white mb-2">$2,920,000</h4>
                    <p class="text-xs text-emerald-100">Net distributable cash flow for quarterly investor allocation.</p>
                </div>
            </div>

            <a href="<?php echo $basePrefix; ?>/projects/north-kalimantan-palm/distribution" class="inline-flex items-center gap-2 text-sm font-bold text-emerald-700 dark:text-emerald-400 hover:text-emerald-600">
                <span>View Complete Distribution Flow</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </section>

    <!-- SECTION 09 — ESG, RISK & AUDIT -->
    <section class="py-24 px-4 bg-white dark:bg-[#0B1209] border-b border-gray-200 dark:border-gray-800">
        <div class="max-w-6xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 dark:text-emerald-400 mb-2 block">Sustainability & Risk</span>
                <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight mb-4">Operational Visibility Beyond Financial Metrics.</h2>
                <p class="text-base text-gray-600 dark:text-gray-400">
                    Track environmental compliance, carbon absorption potential, biodiversity protection, and immutable audit logs.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left mb-12">
                <div class="p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 flex items-center justify-center font-bold mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5a2.5 2.5 0 002.5-2.5V14.39m-1.921-9.155A9 9 0 003.055 11"></path></svg>
                    </div>
                    <h4 class="font-bold text-lg mb-1">Carbon Potential</h4>
                    <span class="text-2xl font-extrabold text-emerald-700 dark:text-emerald-400 block mb-2">14,200 tCO2e/yr</span>
                    <p class="text-xs text-gray-500">Estimated annual carbon sequestration across high-density palm stands and forest buffer zones.</p>
                </div>

                <div class="p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-950 text-blue-700 dark:text-blue-300 flex items-center justify-center font-bold mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="font-bold text-lg mb-1">RSPO / ISPO Compliance</h4>
                    <span class="text-2xl font-extrabold text-blue-700 dark:text-blue-400 block mb-2">94% Compliant</span>
                    <p class="text-xs text-gray-500">Adherence to zero-deforestation, soil conservation, and community partnership standards.</p>
                </div>

                <div class="p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-950 text-purple-700 dark:text-purple-300 flex items-center justify-center font-bold mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h4 class="font-bold text-lg mb-1">Immutable Audit Trail</h4>
                    <span class="text-2xl font-extrabold text-purple-700 dark:text-purple-400 block mb-2">1,240 Events</span>
                    <p class="text-xs text-gray-500">Chronological activity logs recording parcel edits, harvest logs, and third-party attestations.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 10 — PROJECT REVEAL / INTERACTIVE DEMO -->
    <section class="py-24 px-4 bg-emerald-950 text-white relative overflow-hidden">
        <div class="max-w-5xl mx-auto relative z-10 text-center">
            <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-emerald-800 text-emerald-300 border border-emerald-600/40 mb-6 inline-block">Interactive Demo Spotlight</span>
            <h2 class="text-3xl sm:text-6xl font-extrabold tracking-tight mb-6">Explore a Connected Natural Asset.</h2>
            <p class="text-base sm:text-lg text-emerald-200 max-w-2xl mx-auto mb-10">
                Launch the North Kalimantan Palm Project dashboard to test all 9 operational modules in action.
            </p>

            <div class="bg-white/10 backdrop-blur-md rounded-3xl p-8 border border-white/20 text-left max-w-3xl mx-auto mb-10 shadow-2xl">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-white/10 mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-white">North Kalimantan Palm Project</h3>
                        <span class="text-xs text-emerald-300">Concession Ref: NKP-2026-04 • 4,000 Hectares</span>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-500 text-white self-start sm:self-auto">Developing / Operational</span>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs">
                    <div>
                        <span class="text-gray-400 block">Total Area</span>
                        <span class="font-bold text-base text-white">4,000 ha</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block">Current Yield</span>
                        <span class="font-bold text-base text-emerald-300">19.4 MT/ha</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block">Funded Ratio</span>
                        <span class="font-bold text-base text-white">82.9%</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block">Verification</span>
                        <span class="font-bold text-base text-emerald-300">82% Verified</span>
                    </div>
                </div>
            </div>

            <a href="<?php echo $basePrefix; ?>/projects/north-kalimantan-palm" class="px-10 py-5 rounded-2xl bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-extrabold text-lg shadow-2xl transition-all hover:scale-105 inline-flex items-center gap-3">
                <span>Enter Interactive Project Dashboard</span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </section>

    <!-- SECTION 11 — FINAL CTA & FOOTER -->
    <section class="py-20 px-4 bg-[#0A1008] text-gray-300 border-t border-emerald-900/40 text-center">
        <div class="max-w-4xl mx-auto">
            <h3 class="text-2xl sm:text-4xl font-extrabold text-white mb-4">See How Natural Assets Become Operating Systems.</h3>
            <p class="text-sm sm:text-base text-gray-400 mb-8 max-w-2xl mx-auto">
                Kallani bridges the gap between physical land management and institutional investor transparency.
            </p>

            <div class="flex flex-wrap justify-center gap-4 mb-16">
                <a href="<?php echo $basePrefix; ?>/explore" class="px-6 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-sm border border-white/20">Explore Concession Catalog</a>
                <a href="<?php echo $basePrefix; ?>/projects/north-kalimantan-palm/asset" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm">View Parcel Maps</a>
            </div>

            <div class="pt-8 border-t border-gray-800 text-xs text-gray-500 space-y-4">
                <p><strong>Institutional Demo Disclaimer:</strong> Kallani is an illustrative conceptual operating system demonstration. All metrics, land boundaries, carbon estimates, financial flows, and verification records presented are simulated data for demonstration purposes only.</p>
                <p>© <?php echo date('Y'); ?> Kallani Operating System for Natural Assets. All rights reserved.</p>
            </div>
        </div>
    </section>

</div>

<!-- GSAP ScrollTrigger Animations Initialization -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);

            // 1. Hero background parallax
            gsap.to("#hero-bg", {
                scrollTrigger: {
                    trigger: "#hero-bg",
                    start: "top top",
                    end: "bottom top",
                    scrub: true
                },
                y: 100,
                scale: 1.15
            });

            // 2. Lifecycle Horizontal Scroll (Desktop)
            if (window.innerWidth >= 768) {
                const wrapper = document.querySelector('.horizontal-scroll-wrapper');
                if (wrapper) {
                    const scrollAmount = wrapper.scrollWidth - window.innerWidth + 120;
                    gsap.to(wrapper, {
                        x: -scrollAmount,
                        ease: "none",
                        scrollTrigger: {
                            trigger: "#lifecycle-section",
                            pin: true,
                            scrub: 1,
                            end: () => "+=" + scrollAmount
                        }
                    });
                }
            }
        }
    });
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
?>
