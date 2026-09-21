<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$project = $config['projects'][0];
$title = 'Kallani — NINA Operating System for Productive Natural Assets';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
ob_start();
?>

<!-- FULL-SCREEN SCENE-BASED PRESENTATION CONTAINER -->
<div id="presentation-container" class="relative w-screen h-screen overflow-hidden bg-[#0F1C0E] text-white font-inter select-none" x-data="{ 
    activeDiagramStage: 'Demand', 
    activeParcel: 'A', 
    verTab: 'land',
    projMilestone: 4,
    activeOSLayer: 'all',
    stageImages: { 
        'Demand': '<?php echo $basePrefix; ?>/1.jpg', 
        'Capacity': '<?php echo $basePrefix; ?>/2.jpg', 
        'Batch': '<?php echo $basePrefix; ?>/3.jpg', 
        'PO': '<?php echo $basePrefix; ?>/4.jpg', 
        'RAB': '<?php echo $basePrefix; ?>/5.jpg', 
        'Execution': '<?php echo $basePrefix; ?>/6.jpg', 
        'Settlement': '<?php echo $basePrefix; ?>/7.jpg' 
    },
    stageDescriptions: {
        'Demand': 'Defined buyer product requirements and specifications mapped into production targets.',
        'Capacity': 'Regional land & partner capacity aggregation across North & South Kalimantan clusters.',
        'Batch': 'Standardized 100 HA production units with modeled 880,000 USDT budget and 20-year horizon.',
        'PO': 'Mitra PO allocations collected for verified production batch requirements.',
        'RAB': '9-category cost structure linking requirement directly to vendor work orders.',
        'Execution': 'Field work orders, GIS mapping, evidence upload, and multi-tier verification.',
        'Settlement': 'Harvesting, weighing, quality acceptance, processing, delivery, commercial acceptance, and settlement.'
    }
}">

    <!-- HIGGSFIELD / AWWWARDS OPENING INTRO LOADER -->
    <div id="intro-loader" class="fixed inset-0 z-[9999] bg-[#0F1C0E] text-white flex flex-col items-center justify-center p-6 select-none">
        <div class="max-w-4xl w-full text-center">
            <h1 style="font-family: ui-serif, Georgia, Cambria, 'Times New Roman', Times, serif; font-size: clamp(3.5rem, 8vw, 7rem); letter-spacing: 0.28em; color: #FFFFFF; text-transform: uppercase; font-weight: 300; margin-bottom: 0.75rem; text-align: center; text-shadow: 0 0 50px rgba(197, 160, 89, 0.15); padding-left: 0.28em;">KALLANI</h1>
            <p style="font-size: clamp(0.55rem, 1.1vw, 0.82rem); letter-spacing: 0.22em; color: #C5A059; text-transform: uppercase; font-weight: 400; opacity: 0.95; padding-left: 0.22em; margin-bottom: 2.5rem; text-align: center; white-space: nowrap;">NINA OPERATING SYSTEM &bull; PRODUCTIVE NATURAL ASSETS</p>

            <!-- Loader Progress Bar & Counter -->
            <div class="space-y-3 max-w-md mx-auto">
                <div class="w-full bg-emerald-950/60 border border-emerald-800/40 h-2 rounded-full overflow-hidden p-0.5 shadow-inner">
                    <div id="loader-bar" class="bg-gradient-to-r from-emerald-500 via-[#C5A059] to-amber-300 h-full w-0 rounded-full transition-all duration-75"></div>
                </div>
                <div class="flex items-center justify-between text-xs font-mono text-emerald-300/80">
                    <span id="loader-status">INITIALIZING SYSTEM MODULES...</span>
                    <span id="loader-percent" class="font-bold text-[#C5A059] text-sm">0%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- PRESENTATION TOP BRAND CHROME -->
    <div id="presentation-header" class="fixed top-6 left-6 z-40 flex items-center transition-all duration-500">
        <a href="<?php echo $basePrefix; ?>/" class="group flex items-center gap-3">
            <span class="text-xl sm:text-2xl font-serif font-light tracking-[0.3em] text-white uppercase block leading-none hover:text-emerald-300 transition-colors pl-[0.3em]">KALLANI</span>
        </a>
    </div>

    <!-- PRESENTATION RIGHT SCENE DOTS NAVIGATION -->
    <div id="scene-nav-dots" class="fixed right-6 top-1/2 -translate-y-1/2 z-40 hidden md:flex flex-col gap-3 items-center">
        <div id="scene-counter" class="text-[11px] font-mono text-emerald-400 font-bold mb-2 tracking-widest">01 / 12</div>
        <template x-for="i in 12" :key="i">
            <button @click="window.goToScene(i - 1)" 
                    :id="'dot-' + (i - 1)" 
                    class="group relative flex items-center justify-center p-1.5 focus:outline-none cursor-pointer">
                <div class="w-2.5 h-2.5 rounded-full bg-white/20 border border-white/30 transition-all duration-300 group-hover:bg-emerald-400 group-hover:scale-125 dot-inner"></div>
                <span class="absolute right-7 px-2.5 py-1 rounded-md bg-black/80 text-[10px] font-mono text-emerald-300 whitespace-nowrap opacity-0 pointer-events-none group-hover:opacity-100 transition-opacity border border-emerald-500/30 shadow-lg"
                      x-text="['01 Hero OS', '02 Silo Challenge', '03 System Architecture', '04 Start With Demand', '05 Capacity Mapping', '06 Production Batch', '07 Production Lifecycle', '08 Mitra Allocation', '09 RAB & Cost Control', '10 Assurance & Vault', '11 Commercial Settlement', '12 Network Target & CTA'][i - 1]"></span>
            </button>
        </template>
    </div>

    <!-- ========================================================================= -->
    <!-- 12 FULL-SCREEN SCENES (SCENE 01 TO SCENE 12)                              -->
    <!-- ========================================================================= -->

    <!-- SCENE 01 — HERO / OS OVERVIEW -->
    <section id="scene-01" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 z-20 transition-opacity">
        <div class="absolute inset-0 z-0 opacity-55 scale-105" id="hero-bg">
            <img src="<?php echo $basePrefix; ?>/1.jpg" alt="Natural Asset Landscape" class="w-full h-full object-cover filter brightness-95 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/50 to-[#0F1C0E]/20"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto text-center flex flex-col items-center">

            <h1 class="scene-anim-item text-3xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white mb-4 sm:mb-6 leading-tight">
                <span>From Demand to Production.</span> <br class="hidden sm:inline" />
                <span class="block sm:inline bg-gradient-to-r from-emerald-300 via-emerald-100 to-amber-200 bg-clip-text text-transparent">One Operating System.</span>
            </h1>

            <p class="scene-anim-item text-sm sm:text-xl text-gray-300 font-normal max-w-3xl mb-6 sm:mb-8 leading-relaxed text-balance">
                Connecting physical land, production requirements, verified capacity, execution, RAB cost control, and commercial settlement into one auditable operating environment.
            </p>

            <!-- Locked System Constants Strip -->
            <div class="scene-anim-item grid grid-cols-2 sm:grid-cols-4 gap-3 max-w-3xl w-full mb-8 text-center text-xs">
                <div class="p-3 rounded-xl border border-white/10 bg-black/40 backdrop-blur-md">
                    <div class="text-[9px] text-gray-400 uppercase font-bold">PRODUCTION BATCH</div>
                    <div class="text-sm font-black text-white mt-0.5">100 HA</div>
                    <div class="text-[8px] text-gray-400">Standard Unit</div>
                </div>
                <div class="p-3 rounded-xl border border-white/10 bg-black/40 backdrop-blur-md">
                    <div class="text-[9px] text-gray-400 uppercase font-bold">MODELED BATCH REQUIREMENT</div>
                    <div class="text-sm font-black text-emerald-300 mt-0.5">880.000 usdt</div>
                    <div class="text-[8px] text-gray-400">8.800 usdt/HA Modeled</div>
                </div>
                <div class="p-3 rounded-xl border border-white/10 bg-black/40 backdrop-blur-md">
                    <div class="text-[9px] text-gray-400 uppercase font-bold">MIN PO ALLOCATION</div>
                    <div class="text-sm font-black text-white mt-0.5">8.000 usdt</div>
                    <div class="text-[8px] text-gray-400">110 Minimum PO Units / Batch</div>
                </div>
                <div class="p-3 rounded-xl border border-white/10 bg-black/40 backdrop-blur-md">
                    <div class="text-[9px] text-gray-400 uppercase font-bold">CONTRACT HORIZON</div>
                    <div class="text-sm font-black text-amber-300 mt-0.5">20 YEARS</div>
                    <div class="text-[8px] text-gray-400">5 Yrs Ramp-up + 15 Yrs Delivery</div>
                </div>
            </div>

            <!-- CTAs -->
            <div class="scene-anim-item flex flex-wrap items-center justify-center gap-4">
                <a href="<?php echo $basePrefix; ?>/production-programs" class="rounded-xl bg-emerald-500 hover:bg-emerald-400 px-6 py-3 text-xs sm:text-sm font-extrabold text-emerald-950 uppercase tracking-wide shadow-xl transition-all hover:scale-105">
                    VIEW PRODUCTION PROGRAMS
                </a>
                <button type="button" onclick="window.goToScene(1)" class="rounded-xl border border-white/20 bg-white/10 hover:bg-white/20 px-6 py-3 text-xs sm:text-sm font-bold text-white uppercase tracking-wide backdrop-blur-md transition-all hover:scale-105">
                    VIEW SYSTEM FLOW
                </button>
            </div>
        </div>
    </section>

    <!-- SCENE 02 — THE SILO CHALLENGE -->
    <section id="scene-02" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/2.jpg" alt="Structural Challenge" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto text-center">
            <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-3">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <span>02 &bull; Structural Challenge</span>
            </div>

            <h2 class="scene-anim-item text-2xl sm:text-5xl font-extrabold text-white mb-3 tracking-tight">Productive Assets Are Still Operated in Silos.</h2>
            <p class="scene-anim-item text-xs sm:text-lg text-gray-300 max-w-2xl mx-auto mb-8 sm:mb-12 leading-relaxed">
                Traditional natural asset management fragments buyer demand, physical land, field execution, and commercial settlement into isolated silos.
            </p>

            <div class="scene-anim-item bg-[#142314]/70 rounded-3xl p-4 sm:p-8 border border-[#1E3A24]/80 backdrop-blur-md shadow-2xl text-left">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-4">
                    <!-- Fragment #01: DEMAND SILO -->
                    <div class="p-4 rounded-2xl bg-black/30 text-gray-300 border border-[#1E3A24]/60 hover:border-red-500/50 transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-mono font-bold text-red-400">DEMAND SILO</span>
                            <span class="w-2 h-2 rounded-full bg-red-400"></span>
                        </div>
                        <span class="block text-sm font-bold text-white mb-1">Offtake Disconnect</span>
                        <span class="block text-xs text-gray-400 leading-relaxed">Buyer specifications are separated from physical plantation planning.</span>
                    </div>

                    <!-- Fragment #02: ASSET SILO -->
                    <div class="p-4 rounded-2xl bg-black/30 text-gray-300 border border-[#1E3A24]/60 hover:border-amber-500/50 transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-mono font-bold text-amber-400">ASSET SILO</span>
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        </div>
                        <span class="block text-sm font-bold text-white mb-1">Static Concession</span>
                        <span class="block text-xs text-gray-400 leading-relaxed">Land boundaries and GIS maps locked in paper records without live data.</span>
                    </div>

                    <!-- Fragment #03: EXECUTION SILO -->
                    <div class="p-4 rounded-2xl bg-black/30 text-gray-300 border border-[#1E3A24]/60 hover:border-blue-500/50 transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-mono font-bold text-blue-400">EXECUTION SILO</span>
                            <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                        </div>
                        <span class="block text-sm font-bold text-white mb-1">Unverified Vendor Ops</span>
                        <span class="block text-xs text-gray-400 leading-relaxed">Field work orders and RAB spend lack real-time auditability.</span>
                    </div>

                    <!-- Fragment #04: SETTLEMENT SILO -->
                    <div class="p-4 rounded-2xl bg-emerald-950/80 text-white border border-emerald-400/60 shadow-lg">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-mono font-bold text-emerald-300">SETTLEMENT SILO</span>
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        </div>
                        <span class="block text-sm font-bold text-white mb-1">Manual Settlement</span>
                        <span class="block text-xs text-emerald-100 leading-relaxed">Commercial settlement disconnected from verified execution events.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 03 — SYSTEM ARCHITECTURE -->
    <section id="scene-03" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/3.jpg" alt="System Architecture" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto text-center">
            <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"></path></svg>
                <span>03 &bull; System Architecture</span>
            </div>

            <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white mb-4 tracking-tight">One Connected Operating System.</h2>
            <p class="scene-anim-item text-base sm:text-lg text-gray-300 max-w-2xl mx-auto mb-8">
                NINA unifies every stage of natural asset management into one integrated, auditable digital operating model.
            </p>

            <div class="scene-anim-item bg-[#142314]/70 rounded-3xl p-4 sm:p-8 border border-[#1E3A24]/80 backdrop-blur-md shadow-2xl">
                <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-7 gap-1.5 sm:gap-2 mb-6">
                    <?php 
                    $stages = [
                        'Demand'     => ['icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'sub' => 'Buyer Req'],
                        'Capacity'   => ['icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z', 'sub' => 'Land Mapping'],
                        'Batch'      => ['icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16', 'sub' => '100 HA Unit'],
                        'PO'         => ['icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2', 'sub' => 'Allocation'],
                        'RAB'        => ['icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2', 'sub' => 'Cost Control'],
                        'Execution'  => ['icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0', 'sub' => 'Vendor Ops'],
                        'Settlement' => ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'sub' => 'Commercial']
                    ];
                    foreach ($stages as $key => $info):
                    ?>
                    <button @click="activeDiagramStage = '<?php echo $key; ?>'" class="p-2 sm:p-3 rounded-xl sm:rounded-2xl text-left transition-all border flex items-center justify-between gap-1 sm:gap-2 cursor-pointer" :class="activeDiagramStage === '<?php echo $key; ?>' ? 'bg-emerald-600 text-white border-emerald-400 shadow-lg scale-105' : 'bg-black/30 text-gray-300 border-[#1E3A24]/60 hover:bg-black/50'">
                        <div class="flex items-center gap-1.5 sm:gap-2 min-w-0 flex-1">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo $info['icon']; ?>"></path></svg>
                            <div class="min-w-0 flex-1">
                                <span class="block text-[11px] font-bold leading-tight truncate"><?php echo $key; ?></span>
                                <span class="block text-[9px] opacity-80 leading-tight truncate"><?php echo $info['sub']; ?></span>
                            </div>
                        </div>
                    </button>
                    <?php endforeach; ?>
                </div>

                <div class="bg-black/50 rounded-2xl p-5 sm:p-6 border border-[#1E3A24]/60 text-left flex flex-col md:flex-row items-center gap-6">
                    <div class="flex-1 w-full text-left">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-emerald-950 text-emerald-300 border border-emerald-800 mb-3">
                            <span>Lifecycle Stage</span>
                            <span>&bull;</span>
                            <span x-text="activeDiagramStage"></span>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2 leading-tight" x-text="activeDiagramStage + ' Operating Protocol'"></h3>
                        <p class="text-xs text-gray-300 leading-relaxed" x-text="stageDescriptions[activeDiagramStage] || stageDescriptions['Demand']"></p>
                    </div>
                    <div class="w-full md:w-80 h-48 sm:h-56 rounded-2xl overflow-hidden relative border border-[#1E3A24]/60 shrink-0 shadow-2xl">
                        <img :src="stageImages[activeDiagramStage] || '<?php echo $basePrefix; ?>/1.jpg'" :alt="activeDiagramStage + ' Visual'" class="w-full h-full object-cover filter brightness-95 transition-all duration-500" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 04 — START WITH DEMAND -->
    <section id="scene-04" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/4.jpg" alt="Start With Demand" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-5 text-left space-y-4">
                    <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <span>04 &bull; DEMAND FIRST</span>
                    </div>

                    <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight">Start With Demand.</h2>
                    <p class="scene-anim-item text-sm sm:text-base text-gray-300 leading-relaxed">
                        Production begins with a defined requirement — not an empty asset listing.
                    </p>

                    <div class="scene-anim-item pt-2">
                        <a href="<?php echo $basePrefix; ?>/demand" class="rounded-xl bg-emerald-500 hover:bg-emerald-400 px-5 py-2.5 text-xs font-extrabold text-emerald-950 uppercase tracking-wide inline-flex items-center gap-2 shadow-lg">
                            <span>VIEW PRODUCTION PLAN</span> &rsaquo;
                        </a>
                    </div>
                </div>

                <!-- Card UI: MULTIPLE CORPORATE OFFTAKE PO REQUIREMENTS -->
                <div class="scene-anim-item lg:col-span-7 bg-[#142314]/80 p-6 rounded-3xl border border-emerald-500/40 shadow-2xl backdrop-blur-md text-left space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <div class="text-[9px] font-mono font-bold text-emerald-300 uppercase">DEMO OFFTAKE REQUIREMENTS</div>
                            <h3 class="text-base font-bold text-white">3,500 HA Mapped Demand Portfolio</h3>
                        </div>
                        <span class="rounded bg-amber-500/20 px-2 py-0.5 text-[8px] font-bold text-amber-300 border border-amber-400/30">DEMO OFFTAKE SPECIFICATIONS</span>
                    </div>

                    <div class="space-y-2 text-xs">
                        <div class="p-3 rounded-xl bg-white/5 border border-white/5 flex items-center justify-between">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="font-extrabold text-white">Demo Offtake Buyer — Sania Chemical Corp</span>
                                    <span class="px-1.5 py-0.5 rounded bg-blue-950 text-blue-300 text-[8px] font-mono border border-blue-800">DEMO-PO-2026-SANIA-001</span>
                                </div>
                                <div class="text-[10px] text-gray-400 mt-0.5">Bio-Extraction Oil &bull; 2,000 HA Mapped Requirement (Example Spec)</div>
                            </div>
                            <div class="text-right">
                                <div class="font-mono font-bold text-emerald-300">2,000 HA</div>
                                <div class="text-[9px] text-gray-400">30,000 MT/Yr</div>
                            </div>
                        </div>

                        <div class="p-3 rounded-xl bg-white/5 border border-white/5 flex items-center justify-between">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="font-extrabold text-white">Demo Offtake Buyer — Sania Supply (Simulated)</span>
                                    <span class="px-1.5 py-0.5 rounded bg-emerald-950 text-emerald-300 text-[8px] font-mono border border-emerald-800">DEMO-PO-2026-SANIA-002</span>
                                </div>
                                <div class="text-[10px] text-gray-400 mt-0.5">Biofuel & Feedstock &bull; 1,000 HA Mapped Requirement (Example Spec)</div>
                            </div>
                            <div class="text-right">
                                <div class="font-mono font-bold text-emerald-300">1,000 HA</div>
                                <div class="text-[9px] text-gray-400">15,000 MT/Yr</div>
                            </div>
                        </div>

                        <div class="p-3 rounded-xl bg-white/5 border border-white/5 flex items-center justify-between">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="font-extrabold text-white">Demo Offtake Buyer — Sania Biomass (Simulated)</span>
                                    <span class="px-1.5 py-0.5 rounded bg-amber-950 text-amber-300 text-[8px] font-mono border border-amber-800">DEMO-PO-2026-SANIA-003</span>
                                </div>
                                <div class="text-[10px] text-gray-400 mt-0.5">Crude Bio-Oil &bull; 500 HA Mapped Requirement (Example Spec)</div>
                            </div>
                            <div class="text-right">
                                <div class="font-mono font-bold text-emerald-300">500 HA</div>
                                <div class="text-[9px] text-gray-400">7,500 MT/Yr</div>
                            </div>
                        </div>
                    </div>

                    <p class="text-[10px] italic text-gray-400">
                        Demo offtake specifications mapped into regional executable production batches (1 Standard Batch = 100 HA).
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 05 — CAPACITY MAPPING -->
    <section id="scene-05" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/5.jpg" alt="Capacity Mapping" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto text-center w-full">
            <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                <span>05 &bull; CAPACITY MAPPING</span>
            </div>

            <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white mb-3 tracking-tight">Convert Demand Into Production Capacity.</h2>
            <p class="scene-anim-item text-sm sm:text-base text-gray-300 max-w-2xl mx-auto mb-8 leading-relaxed">
                Buyer requirement mapped into regional production capacity across regional clusters.
            </p>

            <div class="scene-anim-item bg-[#142314]/80 p-6 rounded-3xl border border-[#1E3A24]/80 shadow-2xl backdrop-blur-md text-left space-y-4">
                <div class="flex items-center justify-between border-b border-white/10 pb-3">
                    <span class="text-xs font-mono font-bold text-white uppercase">BUYER REQUIREMENT: 1,000 HA</span>
                    <span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">MAPPED CAPACITY</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                    <div class="p-4 rounded-2xl bg-black/40 border border-white/10 space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-white">NORTH KALIMANTAN CLUSTER</span>
                            <span class="text-emerald-300 font-bold">200 HA MAPPED CAPACITY</span>
                        </div>
                        <div class="text-[10px] text-gray-400">Physical Asset Parcel Mapping &bull; Status: MAPPED</div>
                        <div class="w-full bg-gray-800 h-2 rounded-full overflow-hidden">
                            <div class="bg-emerald-400 h-full w-[20%]"></div>
                        </div>
                    </div>

                    <div class="p-4 rounded-2xl bg-black/40 border border-white/10 space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-white">SOUTH KALIMANTAN CLUSTER</span>
                            <span class="text-emerald-300 font-bold">800 HA MAPPED CAPACITY</span>
                        </div>
                        <div class="text-[10px] text-gray-400">Physical Asset Parcel Mapping &bull; Status: MAPPED</div>
                        <div class="w-full bg-gray-800 h-2 rounded-full overflow-hidden">
                            <div class="bg-emerald-400 h-full w-[80%]"></div>
                        </div>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-black/50 border border-emerald-500/30 text-[11px] font-mono flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div>
                        <strong class="text-emerald-300">EXECUTABLE BATCH STRUCTURE:</strong> <span class="text-white">10 &times; 100 HA (Batches NK-001 to NK-010)</span>
                    </div>
                    <span class="text-[10px] text-gray-400 italic">Actual batch assignment executed upon verified capacity</span>
                </div>

                <div class="flex items-center justify-between border-t border-white/10 pt-3 text-xs">
                    <span class="text-gray-400 font-mono">TOTAL MAPPED: <strong class="text-white">1,000 HA</strong></span>
                    <a href="<?php echo $basePrefix; ?>/capacity" class="text-emerald-300 font-bold hover:underline">VIEW CAPACITY MAP &rsaquo;</a>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 06 — PRODUCTION BATCH -->
    <section id="scene-06" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/6.jpg" alt="Production Batch" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-5 text-left space-y-4">
                    <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"></path></svg>
                        <span>06 &bull; PRODUCTION BATCH</span>
                    </div>

                    <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight">Every Requirement Becomes Executable Batches.</h2>
                    <p class="scene-anim-item text-sm sm:text-base text-gray-300 leading-relaxed">
                        Standardized 100 HA production units with locked cost and operating parameters.
                    </p>

                    <div class="scene-anim-item pt-2">
                        <a href="<?php echo $basePrefix; ?>/batches" class="rounded-xl bg-emerald-500 hover:bg-emerald-400 px-5 py-2.5 text-xs font-extrabold text-emerald-950 uppercase tracking-wide inline-flex items-center gap-2 shadow-lg">
                            <span>VIEW BATCH</span> &rsaquo;
                        </a>
                    </div>
                </div>

                <!-- BATCH NK-001 CARD -->
                <div class="scene-anim-item lg:col-span-7 bg-[#142314]/80 p-6 rounded-3xl border border-emerald-500/40 shadow-2xl backdrop-blur-md text-left space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <div class="text-[9px] font-mono font-bold text-emerald-300 uppercase">BATCH NK-001</div>
                            <h3 class="text-xl font-black text-white">100 HA Production Batch</h3>
                        </div>
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">STANDARD BATCH</span>
                    </div>

                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div class="p-3 rounded-xl bg-white/5 border border-white/5 space-y-0.5">
                            <span class="text-[8px] text-gray-400 uppercase font-bold">MODELED BATCH REQUIREMENT</span>
                            <div class="text-base font-extrabold text-white">880.000 usdt</div>
                        </div>
                        <div class="p-3 rounded-xl bg-white/5 border border-white/5 space-y-0.5">
                            <span class="text-[8px] text-gray-400 uppercase font-bold">MINIMUM PO ALLOCATION</span>
                            <div class="text-base font-extrabold text-emerald-300">8.000 usdt</div>
                        </div>
                        <div class="p-3 rounded-xl bg-white/5 border border-white/5 space-y-0.5">
                            <span class="text-[8px] text-gray-400 uppercase font-bold">CONTRACT HORIZON</span>
                            <div class="text-sm font-bold text-white">20 Years Total</div>
                        </div>
                        <div class="p-3 rounded-xl bg-white/5 border border-white/5 space-y-0.5">
                            <span class="text-[8px] text-gray-400 uppercase font-bold">DEVELOPMENT / RAMP-UP</span>
                            <div class="text-sm font-bold text-amber-300">5 Yrs Ramp-up + 15 Yrs Delivery</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 07 — PRODUCTION LIFECYCLE TIMELINE -->
    <section id="scene-07" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-3 sm:p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-55 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/7.jpg" alt="Production Lifecycle" class="w-full h-full object-cover filter brightness-95 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#06120F] via-[#06120F]/90 to-transparent"></div>
        </div>
        <div class="relative z-10 max-w-6xl mx-auto w-full text-left my-auto">

            <div class="mb-2.5 sm:mb-3">
                <div class="scene-anim-item inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-1">
                    <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    <span>07 &bull; PRODUCTION LIFECYCLE</span>
                </div>

                <h2 class="scene-anim-item text-xl sm:text-4xl lg:text-5xl font-extrabold text-white mb-1 tracking-tight">One Lifecycle. Every Stage Visible.</h2>
                <p class="scene-anim-item text-[11px] sm:text-xs text-gray-300 max-w-xl leading-relaxed">
                    From production requirement to commercial settlement, every material event is recorded and traceable.
                </p>
            </div>

            <!-- Dark Glass Card with Palm Forest Overlay inside on the right -->
            <div class="scene-anim-item w-full bg-[#0B1815]/95 p-3 sm:p-5 rounded-2xl sm:rounded-3xl border border-emerald-500/30 shadow-2xl backdrop-blur-md relative overflow-hidden">

                <!-- Inner Right Background Image Overlay (fades into dark on the left) -->
                <div class="absolute inset-y-0 right-0 w-1/2 pointer-events-none opacity-25 lg:opacity-40">
                    <img src="<?php echo $basePrefix; ?>/7.jpg" alt="" class="w-full h-full object-cover object-right filter brightness-90 contrast-105" />
                    <div class="absolute inset-0 bg-gradient-to-r from-[#0B1815] via-[#0B1815]/80 to-transparent"></div>
                </div>

                <!-- Flow wrapper -->
                <div class="relative z-10 pl-4 sm:pl-6 font-mono uppercase tracking-wide leading-tight text-[9px] sm:text-[10px] xl:text-xs">

                    <!-- Spine vertikal kiri -->
                    <div class="absolute left-1.5 sm:left-2 top-2.5 bottom-2.5 w-[1.5px] sm:w-[2px] rounded-full bg-gradient-to-b from-emerald-500/10 via-emerald-500/60 to-emerald-400" aria-hidden="true"></div>

                    <ol class="space-y-2 sm:space-y-3" aria-label="Production lifecycle stages">

                        <!-- Row 1: Buyer Demand -> Production Requirement -> Capacity Mapping -->
                        <li class="relative">
                            <span class="absolute -left-[13px] sm:-left-[20px] top-2 sm:top-[11px] w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-[#06120F] border-2 border-emerald-400 ring-2 sm:ring-4 ring-emerald-500/10" aria-hidden="true"></span>
                            <ol class="flex flex-wrap items-center gap-1 sm:gap-2">
                                <li class="flex items-center gap-1 shrink-0 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg sm:rounded-xl bg-[#122620]/90 border border-emerald-500/40 text-emerald-200 text-[8px] sm:text-[9px] lg:text-[10px] shadow-sm backdrop-blur-sm hover:border-emerald-400/80 transition-colors whitespace-nowrap">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="8"/><path d="M12 2v4M12 18v4M2 12h4M18 12h4"/></svg>
                                    <span>Buyer Demand</span>
                                    <span class="ml-0.5 text-[7px] sm:text-[8px] text-emerald-300/40" aria-hidden="true">01</span>
                                </li>
                                <li class="hidden sm:inline text-gray-500 text-[10px]" aria-hidden="true">&rarr;</li>
                                <li class="flex items-center gap-1 shrink-0 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg sm:rounded-xl bg-[#122620]/90 border border-emerald-500/40 text-emerald-200 text-[8px] sm:text-[9px] lg:text-[10px] shadow-sm backdrop-blur-sm hover:border-emerald-400/80 transition-colors whitespace-nowrap">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <span>Production Requirement</span>
                                    <span class="ml-0.5 text-[7px] sm:text-[8px] text-emerald-300/40" aria-hidden="true">02</span>
                                </li>
                                <li class="hidden sm:inline text-gray-500 text-[10px]" aria-hidden="true">&rarr;</li>
                                <li class="flex items-center gap-1 shrink-0 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg sm:rounded-xl bg-[#122620]/90 border border-emerald-500/40 text-emerald-200 text-[8px] sm:text-[9px] lg:text-[10px] shadow-sm backdrop-blur-sm hover:border-emerald-400/80 transition-colors whitespace-nowrap">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="2.5"/></svg>
                                    <span>Capacity Mapping</span>
                                    <span class="ml-0.5 text-[7px] sm:text-[8px] text-emerald-300/40" aria-hidden="true">03</span>
                                </li>
                            </ol>
                        </li>

                        <!-- Row 2: Asset -> Partner -> Batch -->
                        <li class="relative">
                            <span class="absolute -left-[13px] sm:-left-[20px] top-2 sm:top-[11px] w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-[#06120F] border-2 border-emerald-400 ring-2 sm:ring-4 ring-emerald-500/10" aria-hidden="true"></span>
                            <ol class="flex flex-wrap items-center gap-1 sm:gap-2">
                                <li class="flex items-center gap-1 shrink-0 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg sm:rounded-xl bg-[#122620]/90 border border-emerald-500/40 text-emerald-200 text-[8px] sm:text-[9px] lg:text-[10px] shadow-sm backdrop-blur-sm hover:border-emerald-400/80 transition-colors whitespace-nowrap">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><path d="M21 8l-9-5-9 5v8l9 5 9-5V8z"/><path d="M3 8l9 5 9-5M12 13v8"/></svg>
                                    <span>Asset</span>
                                    <span class="ml-0.5 text-[7px] sm:text-[8px] text-emerald-300/40" aria-hidden="true">04</span>
                                </li>
                                <li class="hidden sm:inline text-gray-500 text-[10px]" aria-hidden="true">&rarr;</li>
                                <li class="flex items-center gap-1 shrink-0 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg sm:rounded-xl bg-[#122620]/90 border border-emerald-500/40 text-emerald-200 text-[8px] sm:text-[9px] lg:text-[10px] shadow-sm backdrop-blur-sm hover:border-emerald-400/80 transition-colors whitespace-nowrap">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><path d="M17 21v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M21 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                                    <span>Partner</span>
                                    <span class="ml-0.5 text-[7px] sm:text-[8px] text-emerald-300/40" aria-hidden="true">05</span>
                                </li>
                                <li class="hidden sm:inline text-gray-500 text-[10px]" aria-hidden="true">&rarr;</li>
                                <li class="flex items-center gap-1 shrink-0 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg sm:rounded-xl bg-[#122620]/90 border border-emerald-500/40 text-emerald-200 text-[8px] sm:text-[9px] lg:text-[10px] shadow-sm backdrop-blur-sm hover:border-emerald-400/80 transition-colors whitespace-nowrap">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/></svg>
                                    <span>Batch</span>
                                    <span class="ml-0.5 text-[7px] sm:text-[8px] text-emerald-300/40" aria-hidden="true">06</span>
                                </li>
                            </ol>
                        </li>

                        <!-- Row 3: PO Allocation -> Milestones -> RAB -> Vendors -->
                        <li class="relative">
                            <span class="absolute -left-[13px] sm:-left-[20px] top-2 sm:top-[11px] w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-[#06120F] border-2 border-emerald-400 ring-2 sm:ring-4 ring-emerald-500/10" aria-hidden="true"></span>
                            <ol class="flex flex-wrap items-center gap-1 sm:gap-2">
                                <li class="flex items-center gap-1 shrink-0 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg sm:rounded-xl bg-[#122620]/90 border border-emerald-500/40 text-emerald-200 text-[8px] sm:text-[9px] lg:text-[10px] shadow-sm backdrop-blur-sm hover:border-emerald-400/80 transition-colors whitespace-nowrap">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M14.5 9.5c-.5-1-1.4-1.5-2.5-1.5-1.4 0-2.5.8-2.5 2s1 1.7 2.5 2 2.5.8 2.5 2-1.1 2-2.5 2c-1.1 0-2-.5-2.5-1.5M12 6v2M12 16v2"/></svg>
                                    <span>PO Allocation</span>
                                    <span class="ml-0.5 text-[7px] sm:text-[8px] text-emerald-300/40" aria-hidden="true">07</span>
                                </li>
                                <li class="hidden sm:inline text-gray-500 text-[10px]" aria-hidden="true">&rarr;</li>
                                <li class="flex items-center gap-1 shrink-0 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg sm:rounded-xl bg-[#122620]/90 border border-emerald-500/40 text-emerald-200 text-[8px] sm:text-[9px] lg:text-[10px] shadow-sm backdrop-blur-sm hover:border-emerald-400/80 transition-colors whitespace-nowrap">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/></svg>
                                    <span>Milestones</span>
                                    <span class="ml-0.5 text-[7px] sm:text-[8px] text-emerald-300/40" aria-hidden="true">08</span>
                                </li>
                                <li class="hidden sm:inline text-gray-500 text-[10px]" aria-hidden="true">&rarr;</li>
                                <li class="flex items-center gap-1 shrink-0 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg sm:rounded-xl bg-[#122620]/90 border border-emerald-500/40 text-emerald-200 text-[8px] sm:text-[9px] lg:text-[10px] shadow-sm backdrop-blur-sm hover:border-emerald-400/80 transition-colors whitespace-nowrap">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 7h6m-6 4h6m-6 4h6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/></svg>
                                    <span>RAB</span>
                                    <span class="ml-0.5 text-[7px] sm:text-[8px] text-emerald-300/40" aria-hidden="true">09</span>
                                </li>
                                <li class="hidden sm:inline text-gray-500 text-[10px]" aria-hidden="true">&rarr;</li>
                                <li class="flex items-center gap-1 shrink-0 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg sm:rounded-xl bg-[#122620]/90 border border-emerald-500/40 text-emerald-200 text-[8px] sm:text-[9px] lg:text-[10px] shadow-sm backdrop-blur-sm hover:border-emerald-400/80 transition-colors whitespace-nowrap">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4"/></svg>
                                    <span>Vendors</span>
                                    <span class="ml-0.5 text-[7px] sm:text-[8px] text-emerald-300/40" aria-hidden="true">10</span>
                                </li>
                            </ol>
                        </li>

                        <!-- Row 4: Execution -> Verification -> Harvest/Processing -> Delivery -->
                        <li class="relative">
                            <span class="absolute -left-[13px] sm:-left-[20px] top-2 sm:top-[11px] w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-[#06120F] border-2 border-emerald-400 ring-2 sm:ring-4 ring-emerald-500/10" aria-hidden="true"></span>
                            <ol class="flex flex-wrap items-center gap-1 sm:gap-2">
                                <li class="flex items-center gap-1 shrink-0 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg sm:rounded-xl bg-[#122620]/90 border border-emerald-500/40 text-emerald-200 text-[8px] sm:text-[9px] lg:text-[10px] shadow-sm backdrop-blur-sm hover:border-emerald-400/80 transition-colors whitespace-nowrap">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    <span>Execution</span>
                                    <span class="ml-0.5 text-[7px] sm:text-[8px] text-emerald-300/40" aria-hidden="true">11</span>
                                </li>
                                <li class="hidden sm:inline text-gray-500 text-[10px]" aria-hidden="true">&rarr;</li>
                                <li class="flex items-center gap-1 shrink-0 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg sm:rounded-xl bg-[#122620]/90 border border-emerald-500/40 text-emerald-200 text-[8px] sm:text-[9px] lg:text-[10px] shadow-sm backdrop-blur-sm hover:border-emerald-400/80 transition-colors whitespace-nowrap">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    <span>Verification</span>
                                    <span class="ml-0.5 text-[7px] sm:text-[8px] text-emerald-300/40" aria-hidden="true">12</span>
                                </li>
                                <li class="hidden sm:inline text-gray-500 text-[10px]" aria-hidden="true">&rarr;</li>
                                <li class="flex items-center gap-1 shrink-0 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg sm:rounded-xl bg-[#122620]/90 border border-emerald-500/40 text-emerald-200 text-[8px] sm:text-[9px] lg:text-[10px] shadow-sm backdrop-blur-sm hover:border-emerald-400/80 transition-colors whitespace-nowrap">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 22V11"/><path d="M12 11c0-4 3-7 8-7 0 5-3 8-8 7z"/><path d="M12 15c0-3-2.5-5.5-7-5.5 0 4 2.5 6.5 7 5.5z"/></svg>
                                    <span>Harvest / Processing</span>
                                    <span class="ml-0.5 text-[7px] sm:text-[8px] text-emerald-300/40" aria-hidden="true">13</span>
                                </li>
                                <li class="hidden sm:inline text-gray-500 text-[10px]" aria-hidden="true">&rarr;</li>
                                <li class="flex items-center gap-1 shrink-0 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg sm:rounded-xl bg-[#122620]/90 border border-emerald-500/40 text-emerald-200 text-[8px] sm:text-[9px] lg:text-[10px] shadow-sm backdrop-blur-sm hover:border-emerald-400/80 transition-colors whitespace-nowrap">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                                    <span>Delivery</span>
                                    <span class="ml-0.5 text-[7px] sm:text-[8px] text-emerald-300/40" aria-hidden="true">14</span>
                                </li>
                            </ol>
                        </li>

                        <!-- Row 5: Commercial Settlement -> Audit Trail -->
                        <li class="relative">
                            <span class="absolute -left-[13px] sm:-left-[20px] top-2 sm:top-[11px] w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-emerald-400 ring-2 sm:ring-4 ring-emerald-400/25 shadow-[0_0_14px_rgba(52,211,153,0.6)]" aria-hidden="true"></span>
                            <ol class="flex flex-wrap items-center gap-1 sm:gap-2">
                                <li class="flex items-center gap-1 shrink-0 px-2 sm:px-3.5 py-1 sm:py-1.5 rounded-lg sm:rounded-xl bg-emerald-950/95 border border-emerald-400/80 text-emerald-300 font-bold text-[8px] sm:text-[9px] lg:text-[10px] shadow-lg shadow-emerald-500/20 backdrop-blur-sm whitespace-nowrap">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 shrink-0 text-emerald-300" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                    <span>Commercial Settlement &check;</span>
                                    <span class="ml-0.5 text-[7px] sm:text-[8px] text-emerald-300/50" aria-hidden="true">15</span>
                                </li>
                                <li class="hidden sm:inline text-emerald-500 text-[10px]" aria-hidden="true">&rarr;</li>
                                <li class="flex items-center gap-1 shrink-0 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg sm:rounded-xl bg-[#122620]/90 border border-emerald-500/40 text-emerald-200 text-[8px] sm:text-[9px] lg:text-[10px] shadow-sm backdrop-blur-sm hover:border-emerald-400/80 transition-colors whitespace-nowrap">
                                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                                    <span>Audit Trail</span>
                                    <span class="ml-0.5 text-[7px] sm:text-[8px] text-emerald-300/40" aria-hidden="true">16</span>
                                </li>
                            </ol>
                        </li>

                    </ol>
                </div>

                <!-- Footnote -->
                <div class="relative z-10 mt-2.5 sm:mt-3 pt-2 sm:pt-2.5 border-t border-white/10 pl-4 sm:pl-6 text-[9px] sm:text-[10px] font-mono text-gray-400 italic">
                    One production lifecycle. One auditable operating environment.
                </div>
            </div>

        </div>
    </section>

    <!-- SCENE 08 — MITRA EXPERIENCE -->
    <section id="scene-08" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/8.jpg" alt="Mitra Experience" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-5 text-left space-y-4">
                    <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span>08 &bull; MITRA EXPERIENCE</span>
                    </div>

                    <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight">See Your Production Allocation Progress.</h2>
                    <p class="scene-anim-item text-sm sm:text-base text-gray-300 leading-relaxed">
                        Track allocation progress from PO collection to commercial settlement.
                    </p>

                    <div class="scene-anim-item pt-2">
                        <a href="<?php echo $basePrefix; ?>/allocations" class="rounded-xl bg-emerald-500 hover:bg-emerald-400 px-5 py-2.5 text-xs font-extrabold text-emerald-950 uppercase tracking-wide inline-flex items-center gap-2 shadow-lg">
                            <span>VIEW MY ALLOCATIONS</span> &rsaquo;
                        </a>
                    </div>
                </div>

                <!-- MY PRODUCTION ALLOCATION CARD (SIMULATED STATE) -->
                <div class="scene-anim-item lg:col-span-7 bg-[#142314]/80 p-6 rounded-3xl border border-emerald-500/40 shadow-2xl backdrop-blur-md text-left space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="rounded bg-amber-500/20 px-2 py-0.5 text-[8px] font-bold text-amber-300 border border-amber-400/30 uppercase">SIMULATED STATE / DEMO PROTOTYPE</span>
                            </div>
                            <h3 class="text-base font-bold text-white mt-1">BATCH NK-001 &bull; PO ALLOCATION UNIT</h3>
                        </div>
                        <div class="text-right">
                            <span class="font-bold text-emerald-300 text-sm block">8.000 usdt</span>
                            <span class="text-[9px] text-gray-400">Minimum PO Allocation (110 Units / Batch)</span>
                        </div>
                    </div>

                    <div class="space-y-2 text-[10px] font-mono">
                        <div class="flex justify-between items-center p-2 rounded bg-black/30 border border-white/5">
                            <span class="text-emerald-300 font-bold flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> PO Collection (Simulated State)</span>
                            <span class="text-gray-400 font-bold">100% Mapped</span>
                        </div>
                        <div class="flex justify-between items-center p-2 rounded bg-black/30 border border-white/5">
                            <span class="text-amber-300 font-bold flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-amber-400"></span> Milestone 01 (Land Prep)</span>
                            <span class="text-amber-300">Simulated Execution</span>
                        </div>
                        <div class="flex justify-between items-center p-2 rounded bg-black/30 border border-white/5 text-gray-500">
                            <span class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-gray-600"></span> Milestone 02 &ndash; 04</span>
                            <span>Pending</span>
                        </div>
                    </div>

                    <p class="text-[10px] italic text-emerald-300/80">
                        Members can take a minimum production allocation of 8,000 usdt and allocate production demand across multiple batches according to the NINA program structure.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 09 — RAB + VENDOR + WALLET -->
    <section id="scene-09" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/9.jpg" alt="RAB & Cost Control" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto text-center w-full">
            <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"></path></svg>
                <span>09 &bull; COST CONTROL & EXECUTION</span>
            </div>

            <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white mb-3 tracking-tight">Every Production Requirement Has an Execution Trail.</h2>
            <p class="scene-anim-item text-sm sm:text-base text-gray-300 max-w-2xl mx-auto mb-8 leading-relaxed">
                Connecting budget requirements directly to responsible entities, work orders, and verified settlement.
            </p>

            <div class="scene-anim-item bg-[#142314]/80 p-6 rounded-3xl border border-[#1E3A24]/80 shadow-2xl backdrop-blur-md text-left space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-3 text-center font-mono">
                    <div class="p-4 rounded-xl bg-black/40 border border-white/10 space-y-1.5 flex flex-col justify-center min-h-[90px]">
                        <span class="text-gray-300 font-bold text-xs sm:text-sm block uppercase">880.000 usdt REQUIREMENT</span>
                        <span class="text-emerald-300 text-xs sm:text-sm block font-semibold">Modeled RAB</span>
                    </div>
                    <div class="p-4 rounded-xl bg-black/40 border border-white/10 space-y-1.5 flex flex-col justify-center min-h-[90px]">
                        <span class="text-gray-300 font-bold text-xs sm:text-sm block uppercase">RAB BUDGET</span>
                        <span class="text-emerald-300 text-xs sm:text-sm block font-semibold">9 Categories</span>
                    </div>
                    <div class="p-4 rounded-xl bg-black/40 border border-white/10 space-y-1.5 flex flex-col justify-center min-h-[90px]">
                        <span class="text-gray-300 font-bold text-xs sm:text-sm block uppercase">VENDORS</span>
                        <span class="text-amber-300 text-xs sm:text-sm block font-semibold">Production Partners (Pending)</span>
                    </div>
                    <div class="p-4 rounded-xl bg-black/40 border border-white/10 space-y-1.5 flex flex-col justify-center min-h-[90px]">
                        <span class="text-gray-300 font-bold text-xs sm:text-sm block uppercase">REGISTERED WALLET</span>
                        <span class="text-emerald-300 text-xs sm:text-sm block font-semibold">Entity Identity</span>
                    </div>
                    <div class="p-4 rounded-xl bg-emerald-950 border border-emerald-400 space-y-1.5 flex flex-col justify-center min-h-[90px]">
                        <span class="text-white font-extrabold text-xs sm:text-sm block uppercase">AUDIT TRAIL</span>
                        <span class="text-emerald-300 text-xs sm:text-sm block font-semibold">Permanent Record</span>
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <a href="<?php echo $basePrefix; ?>/rab" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg border border-emerald-400/40 bg-emerald-500/10 hover:bg-emerald-500/20 hover:border-emerald-400 text-xs font-mono font-bold tracking-wider text-emerald-300 transition">
                        <span>VIEW EXECUTION FLOW</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 10 — ASSURANCE & VERIFICATION VAULT -->
    <section id="scene-10" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/10.jpg" alt="Assurance Vault" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto text-center w-full">
            <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>10 &bull; ASSURANCE & VERIFICATION</span>
            </div>

            <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white mb-3 tracking-tight">Verification Status Across All Operational Layers.</h2>
            <p class="scene-anim-item text-sm sm:text-base text-gray-300 max-w-2xl mx-auto mb-8 leading-relaxed">
                NINA separates land, partner, seedling, vendor, field execution, and commercial verification.
            </p>

            <div class="scene-anim-item bg-[#142314]/80 p-6 rounded-3xl border border-[#1E3A24]/80 shadow-2xl backdrop-blur-md text-left space-y-4">
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                    <div class="p-3 rounded-xl bg-black/40 border border-white/10 flex justify-between items-center">
                        <span class="text-gray-300 font-bold">LAND</span>
                        <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span>
                    </div>
                    <div class="p-3 rounded-xl bg-black/40 border border-white/10 flex justify-between items-center">
                        <span class="text-gray-300 font-bold">PARTNER</span>
                        <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span>
                    </div>
                    <div class="p-3 rounded-xl bg-black/40 border border-white/10 flex justify-between items-center">
                        <span class="text-gray-300 font-bold">SEED</span>
                        <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span>
                    </div>
                    <div class="p-3 rounded-xl bg-black/40 border border-white/10 flex justify-between items-center">
                        <span class="text-gray-300 font-bold">VENDOR</span>
                        <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span>
                    </div>
                    <div class="p-3 rounded-xl bg-black/40 border border-white/10 flex justify-between items-center">
                        <span class="text-gray-300 font-bold">EXECUTION</span>
                        <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span>
                    </div>
                    <div class="p-3 rounded-xl bg-black/40 border border-white/10 flex justify-between items-center">
                        <span class="text-gray-300 font-bold">COMMERCIAL</span>
                        <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span>
                    </div>
                </div>

                <div class="flex items-center justify-between border-t border-white/10 pt-3">
                    <span class="text-[9px] font-mono text-gray-400 uppercase">SIMULATED OPERATING ENVIRONMENT</span>
                    <a href="<?php echo $basePrefix; ?>/verification" class="text-xs font-bold text-emerald-300 hover:underline">VIEW EVIDENCE &rsaquo;</a>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 11 — COMMERCIAL SETTLEMENT -->
    <section id="scene-11" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/7.jpg" alt="Commercial Settlement" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto text-center w-full space-y-4">
            <div class="scene-anim-item inline-flex items-center gap-2 text-xs font-mono uppercase tracking-[0.2em] text-emerald-400">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>11 &bull; COMMERCIAL SETTLEMENT</span>
            </div>

            <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white tracking-tight">Traceable Commercial Settlement for Every Harvest Batch.</h2>

            <div class="scene-anim-item bg-[#142314]/90 p-6 rounded-3xl border border-[#1E3A24] shadow-2xl backdrop-blur-md text-left space-y-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-xs font-mono">
                    <div class="p-4 rounded-xl bg-black/40 border border-white/10 space-y-1.5">
                        <span class="text-gray-400 font-bold block text-[10px] uppercase">FFB HARVEST YIELD</span>
                        <span class="text-base font-extrabold text-white block">1,803 TBS / YR</span>
                        <span class="text-[10px] text-emerald-400 block font-semibold">18.03 TBS/HA Benchmark</span>
                    </div>
                    <div class="p-4 rounded-xl bg-black/40 border border-white/10 space-y-1.5">
                        <span class="text-gray-400 font-bold block text-[10px] uppercase">MODELED CPO OUTPUT</span>
                        <span class="text-base font-extrabold text-white block">360.6 MT CPO / YR</span>
                        <span class="text-[10px] text-emerald-400 block font-semibold">20% OER Assumption</span>
                    </div>
                    <div class="p-4 rounded-xl bg-black/40 border border-white/10 space-y-1.5">
                        <span class="text-gray-400 font-bold block text-[10px] uppercase">EQUIVALENT VOLUME</span>
                        <span class="text-base font-extrabold text-emerald-300 block">~405,849 L CPO / YR</span>
                        <span class="text-[10px] text-gray-400 block font-semibold">Stated Density Model</span>
                    </div>
                    <div class="p-4 rounded-xl bg-black/40 border border-white/10 space-y-1.5">
                        <span class="text-gray-400 font-bold block text-[10px] uppercase">SETTLEMENT VAULT</span>
                        <span class="text-base font-extrabold text-amber-300 block">TRACEABLE PROTOCOL</span>
                        <span class="text-[10px] text-amber-400/80 block font-semibold">11-Stage Verification</span>
                    </div>
                </div>
                <div class="p-3.5 rounded-2xl bg-black/50 border border-emerald-500/30 text-[10px] font-mono text-gray-300">
                    <div class="text-emerald-400 font-bold mb-1">OPERATING SETTLEMENT PROTOCOL:</div>
                    <div class="flex flex-wrap items-center gap-1.5 text-gray-400">
                        <span>Verified Production</span> &rarr; 
                        <span>Harvest</span> &rarr; 
                        <span>Weighing</span> &rarr; 
                        <span>Processing</span> &rarr; 
                        <span>Product</span> &rarr; 
                        <span>Buyer</span> &rarr; 
                        <span>Delivery</span> &rarr; 
                        <strong class="text-white">Commercial Acceptance</strong> &rarr; 
                        <span>Settlement Eligibility</span> &rarr; 
                        <span>Approval</span> &rarr; 
                        <span>Designated Downstream Operating Co.</span> &rarr; 
                        <span>Registered Recipient</span> &rarr; 
                        <strong class="text-emerald-300">Audit Trail</strong>
                    </div>
                </div>
                <div class="pt-1 text-center">
                    <p class="text-[10px] italic text-gray-400 font-mono">
                        * Basis: 100 HA &bull; Benchmark: 18.03 TBS/HA/YEAR (1,803 TBS/yr) &bull; OER Assumption: 20% (360.6 MT CPO/yr &bull; ~405,849 L CPO/yr). Semua data merupakan model produksi terstruktur, bukan jaminan produksi (guaranteed production).
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 12 — 24-MONTH NETWORK TARGET & FINAL CTA -->
    <section id="scene-12" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/2.jpg" alt="Final Reveal" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-4xl mx-auto text-center w-full space-y-6">
            <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400">
                <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                <span>12 &bull; NETWORK SCALE TARGET</span>
            </div>
            
            <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white tracking-tight">Building Production Capacity at Network Scale.</h2>

            <!-- 4 Target Cards -->
            <div class="scene-anim-item grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs text-center">
                <div class="p-3.5 rounded-2xl bg-black/50 border border-white/10 space-y-1">
                    <span class="text-[8px] font-mono text-gray-400 uppercase font-bold">24-MONTH TARGET</span>
                    <div class="text-lg sm:text-xl font-extrabold text-white">10,000 HA</div>
                </div>
                <div class="p-3.5 rounded-2xl bg-black/50 border border-white/10 space-y-1">
                    <span class="text-[8px] font-mono text-gray-400 uppercase font-bold">PRODUCTION BATCHES</span>
                    <div class="text-lg sm:text-xl font-extrabold text-emerald-300">100</div>
                </div>
                <div class="p-3.5 rounded-2xl bg-black/50 border border-white/10 space-y-1">
                    <span class="text-[8px] font-mono text-gray-400 uppercase font-bold">MODELED VALUE</span>
                    <div class="text-sm sm:text-base font-extrabold text-white whitespace-nowrap">88.000.000 usdt</div>
                </div>
                <div class="p-3.5 rounded-2xl bg-black/50 border border-white/10 space-y-1">
                    <span class="text-[8px] font-mono text-gray-400 uppercase font-bold">MODELED 3% FEE</span>
                    <div class="text-sm sm:text-base font-extrabold text-amber-300 whitespace-nowrap">2.640.000 usdt</div>
                </div>
            </div>

            <p class="text-[9px] italic text-gray-400">
                Modeled target scenario based on 100 HA standard batches, not guaranteed production or revenue.
            </p>

            <!-- System Intake / Registration Action Bar (JOIN THE NINA NETWORK) -->
            <div class="scene-anim-item bg-[#142314]/90 p-5 rounded-3xl border border-emerald-500/40 max-w-4xl mx-auto space-y-3 text-center shadow-2xl backdrop-blur-md">
                <div class="text-xs font-mono text-emerald-400 uppercase font-extrabold tracking-widest">JOIN THE NINA NETWORK</div>
                <p class="text-xs text-gray-300 max-w-xl mx-auto leading-relaxed">
                    Choose how your company or productive asset connects to the NINA production network.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2 text-left">
                    <a href="<?php echo $basePrefix; ?>/capacity" class="group p-4 rounded-2xl bg-black/40 hover:bg-emerald-950/80 border border-emerald-500/30 hover:border-emerald-400 transition-all">
                        <div class="text-[10px] font-mono font-bold text-emerald-400 uppercase mb-1">01 &bull; MITRA LAHAN</div>
                        <div class="text-sm font-extrabold text-white group-hover:text-emerald-300 transition-colors">BECOME A LAND PARTNER</div>
                        <div class="text-[11px] text-gray-400 mt-1.5 leading-snug">Daftarkan lahan dan kapasitas produksi Anda ke dalam jaringan NINA.</div>
                    </a>
                    <a href="<?php echo $basePrefix; ?>/vendors" class="group p-4 rounded-2xl bg-black/40 hover:bg-amber-950/80 border border-amber-500/30 hover:border-amber-400 transition-all">
                        <div class="text-[10px] font-mono font-bold text-amber-400 uppercase mb-1">02 &bull; VENDOR PROJECT</div>
                        <div class="text-sm font-extrabold text-white group-hover:text-amber-300 transition-colors">BECOME A PROJECT VENDOR</div>
                        <div class="text-[11px] text-gray-400 mt-1.5 leading-snug">Daftarkan produk, layanan, dan kapasitas operasional Anda untuk mendukung production project NINA.</div>
                    </a>
                    <a href="<?php echo $basePrefix; ?>/demand" class="group p-4 rounded-2xl bg-black/40 hover:bg-blue-950/80 border border-blue-500/30 hover:border-blue-400 transition-all">
                        <div class="text-[10px] font-mono font-bold text-blue-400 uppercase mb-1">03 &bull; OFFTAKER</div>
                        <div class="text-sm font-extrabold text-white group-hover:text-blue-300 transition-colors">BECOME AN OFFTAKER</div>
                        <div class="text-[11px] text-gray-400 mt-1.5 leading-snug">Sampaikan kebutuhan produk dan kapasitas pembelian perusahaan Anda kepada NINA.</div>
                    </a>
                </div>
            </div>

            <!-- Final CTAs -->
            <div class="scene-anim-item flex flex-wrap items-center justify-center gap-4 pt-2">
                <a href="<?php echo $basePrefix; ?>/production-programs" class="px-6 py-3 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-extrabold text-xs uppercase tracking-wide shadow-xl transition-all hover:scale-105">
                    VIEW PRODUCTION PROGRAMS &rsaquo;
                </a>
                <a href="<?php echo $basePrefix; ?>/explore" class="px-6 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs border border-white/20 transition-all hover:scale-105 uppercase tracking-wide">
                    EXPLORE PROJECTS
                </a>
            </div>
        </div>
    </section>

</div>

<!-- GSAP FULL-SCREEN SCENE TRANSITION ENGINE -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof gsap === 'undefined') return;

        // Intro Loader timeline
        const loader = document.getElementById('intro-loader');
        const loaderBar = document.getElementById('loader-bar');
        const loaderPercent = document.getElementById('loader-percent');
        const loaderStatus = document.getElementById('loader-status');

        if (loader && loaderBar && loaderPercent) {
            let progressObj = { value: 0 };
            const statusMsgs = [
                "LOADING GIS SPATIAL LAYERS...",
                "SYNCING DEMAND & CAPACITY...",
                "VERIFYING NINA OPERATING PROTOCOLS...",
                "PRODUCTION SYSTEM READY."
            ];

            const introTL = gsap.timeline();
            introTL.to(progressObj, {
                value: 100,
                duration: 1.5,
                ease: "power2.inOut",
                onUpdate: () => {
                    const currentVal = Math.floor(progressObj.value);
                    loaderBar.style.width = currentVal + '%';
                    loaderPercent.textContent = currentVal + '%';

                    if (currentVal > 75) loaderStatus.textContent = statusMsgs[3];
                    else if (currentVal > 50) loaderStatus.textContent = statusMsgs[2];
                    else if (currentVal > 25) loaderStatus.textContent = statusMsgs[1];
                }
            })
            .to("#intro-loader > div", {
                opacity: 0,
                y: -30,
                duration: 0.4,
                ease: "power2.in"
            })
            .to("#intro-loader", {
                yPercent: -100,
                duration: 0.8,
                ease: "power4.inOut"
            })
            .from("#scene-01 .scene-anim-item", {
                opacity: 0,
                y: 30,
                duration: 0.6,
                stagger: 0.12,
                ease: "power3.out"
            }, "-=0.3");
        }

        // Full-screen Scene Navigation Engine State
        window.currentScene = 0;
        window.totalScenes = 12;
        window.isAnimating = false;

        function animateSceneCounters(container) {
            if (!container) return;
            const counterEls = container.querySelectorAll('.counter-num, [data-counter]');
            counterEls.forEach(el => {
                let targetText = el.getAttribute('data-counter');
                if (!targetText) {
                    targetText = el.textContent.trim();
                    el.setAttribute('data-counter', targetText);
                }

                const match = targetText.match(/^([^0-9]*)([0-9][0-9,.]*)(.*)$/);
                if (match) {
                    const prefix = match[1];
                    const rawNum = match[2].replace(/,/g, '');
                    const suffix = match[3];
                    const targetVal = parseFloat(rawNum);
                    const isFloat = rawNum.includes('.');
                    const decimals = isFloat ? (rawNum.split('.')[1] || '').length : 0;

                    let obj = { val: 0 };
                    gsap.to(obj, {
                        val: targetVal,
                        duration: 2.4,
                        ease: "power3.out",
                        onUpdate: () => {
                            let formatted = isFloat ? obj.val.toFixed(decimals) : Math.floor(obj.val).toLocaleString();
                            el.textContent = prefix + formatted + suffix;
                        }
                    });
                }
            });
        }

        function animateSceneBars(container) {
            if (!container) return;
            const barEls = container.querySelectorAll('.progress-bar-anim, [data-bar-width]');
            barEls.forEach(bar => {
                let targetWidth = bar.getAttribute('data-bar-width');
                if (!targetWidth) {
                    targetWidth = bar.style.width || '100%';
                    bar.setAttribute('data-bar-width', targetWidth);
                }
                gsap.set(bar, { width: '0%' });
                gsap.to(bar, {
                    width: targetWidth,
                    duration: 2.4,
                    ease: "power3.out",
                    delay: 0.15
                });
            });
        }

        function updateSceneIndicators(index) {
            const counter = document.getElementById('scene-counter');
            if (counter) {
                counter.textContent = String(index + 1).padStart(2, '0') + ' / 12';
            }

            // Dots UI update
            for (let i = 0; i < 12; i++) {
                const dot = document.getElementById('dot-' + i);
                if (dot) {
                    const inner = dot.querySelector('.dot-inner');
                    if (inner) {
                        if (i === index) {
                            inner.className = "w-3 h-3 rounded-full bg-emerald-400 border-2 border-white scale-125 dot-inner shadow-lg shadow-emerald-500/50";
                        } else {
                            inner.className = "w-2.5 h-2.5 rounded-full bg-white/20 border border-white/30 transition-all duration-300 group-hover:bg-emerald-400 group-hover:scale-125 dot-inner";
                        }
                    }
                }
            }
        }

        window.goToScene = function(index) {
            if (index < 0 || index >= window.totalScenes || index === window.currentScene || window.isAnimating) return;
            window.isAnimating = true;

            const prevScene = window.currentScene;
            window.currentScene = index;

            const prevId = 'scene-' + String(prevScene + 1).padStart(2, '0');
            const nextId = 'scene-' + String(window.currentScene + 1).padStart(2, '0');

            const prevEl = document.getElementById(prevId);
            const nextEl = document.getElementById(nextId);

            const direction = window.currentScene > prevScene ? 1 : -1;

            const tl = gsap.timeline({
                onComplete: () => {
                    window.isAnimating = false;
                }
            });

            // Animate out previous scene
            tl.to(prevEl, {
                opacity: 0,
                yPercent: direction * -25,
                duration: 0.5,
                ease: "power2.inOut",
                onComplete: () => {
                    prevEl.classList.add('pointer-events-none');
                    prevEl.style.zIndex = 10;
                }
            });

            // Prepare next scene
            gsap.set(nextEl, { opacity: 0, yPercent: direction * 35, zIndex: 20 });
            nextEl.classList.remove('pointer-events-none');

            // Animate in next scene
            tl.to(nextEl, {
                opacity: 1,
                yPercent: 0,
                duration: 0.7,
                ease: "power3.out"
            }, "-=0.3");

            // Stagger inner scene elements
            const animItems = nextEl.querySelectorAll('.scene-anim-item');
            if (animItems.length > 0) {
                tl.fromTo(animItems,
                    { opacity: 0, y: 25 },
                    { opacity: 1, y: 0, duration: 0.45, stagger: 0.08, ease: "power2.out" },
                    "-=0.4"
                );
            }

            // Animate numbers and progress bars smoothly when entering scene
            animateSceneCounters(nextEl);
            animateSceneBars(nextEl);

            updateSceneIndicators(window.currentScene);

            // Control Navbar reveal on Scene 12 (index 11)
            const navbar = document.getElementById('main-navbar');
            const presHeader = document.getElementById('presentation-header');
            if (navbar) {
                if (window.currentScene === 11) {
                    navbar.classList.remove('opacity-0', 'pointer-events-none', '-translate-y-full');
                    navbar.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
                    if (presHeader) {
                        presHeader.classList.add('opacity-0', 'pointer-events-none');
                    }
                } else {
                    navbar.classList.add('opacity-0', 'pointer-events-none', '-translate-y-full');
                    navbar.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                    if (presHeader) {
                        presHeader.classList.remove('opacity-0', 'pointer-events-none');
                    }
                }
            }
        };

        // Initialize dot indicators
        updateSceneIndicators(0);

        // Wheel Event listener
        let lastWheelTime = 0;
        window.addEventListener('wheel', (e) => {
            const now = Date.now();
            if (now - lastWheelTime < 400 || window.isAnimating) return;
            if (Math.abs(e.deltaY) > 20) {
                lastWheelTime = now;
                if (e.deltaY > 0) {
                    window.goToScene(window.currentScene + 1);
                } else {
                    window.goToScene(window.currentScene - 1);
                }
            }
        }, { passive: true });

        // Touch Swipe Event listener
        let touchStartY = 0;
        window.addEventListener('touchstart', (e) => {
            if (e.touches && e.touches.length > 0) {
                touchStartY = e.touches[0].clientY;
            }
        }, { passive: true });

        window.addEventListener('touchend', (e) => {
            if (window.isAnimating || !e.changedTouches || e.changedTouches.length === 0) return;
            
            const scenes = document.querySelectorAll('.scene');
            const activeScene = scenes[window.currentScene];
            
            if (activeScene) {
                const isScrollable = activeScene.scrollHeight > activeScene.clientHeight;
                if (isScrollable) {
                    const diffY = touchStartY - e.changedTouches[0].clientY;
                    if (diffY > 0 && activeScene.scrollTop + activeScene.clientHeight < activeScene.scrollHeight - 15) {
                        return;
                    }
                    if (diffY < 0 && activeScene.scrollTop > 15) {
                        return;
                    }
                }
            }

            const touchEndY = e.changedTouches[0].clientY;
            const diff = touchStartY - touchEndY;
            if (Math.abs(diff) > 80) {
                if (diff > 0) {
                    window.goToScene(window.currentScene + 1);
                } else {
                    window.goToScene(window.currentScene - 1);
                }
            }
        }, { passive: true });

        // Keyboard Navigation listener
        window.addEventListener('keydown', (e) => {
            if (window.isAnimating) return;
            if (['ArrowDown', 'PageDown', 'Space'].includes(e.code)) {
                e.preventDefault();
                window.goToScene(window.currentScene + 1);
            } else if (['ArrowUp', 'PageUp'].includes(e.code)) {
                e.preventDefault();
                window.goToScene(window.currentScene - 1);
            }
        });
    });
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/app.php';
