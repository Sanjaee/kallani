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
        'Batch': 'Standardized 100 HA production units with modeled Rp15B budget and 20-year horizon.',
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
            <p class="tagline" style="font-size: clamp(0.85rem, 1.2vw, 1.1rem); letter-spacing: 0.45em; color: #C5A059; text-transform: uppercase; font-weight: 400; opacity: 0.95; padding-left: 0.45em; margin-bottom: 2.5rem;">NINA OPERATING SYSTEM &bull; PRODUCTIVE NATURAL ASSETS</p>

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
                    <div class="text-sm font-black text-emerald-300 mt-0.5">Rp15B</div>
                    <div class="text-[8px] text-gray-400">Rp150M / HA Modeled</div>
                </div>
                <div class="p-3 rounded-xl border border-white/10 bg-black/40 backdrop-blur-md">
                    <div class="text-[9px] text-gray-400 uppercase font-bold">MIN PO ALLOCATION</div>
                    <div class="text-sm font-black text-white mt-0.5">Rp1B</div>
                    <div class="text-[8px] text-gray-400">Minimum Unit</div>
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

                <!-- Card UI: DEMO OFFTAKE REQUIREMENT -->
                <div class="scene-anim-item lg:col-span-7 bg-[#142314]/80 p-6 rounded-3xl border border-emerald-500/40 shadow-2xl backdrop-blur-md text-left space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <div class="text-[9px] font-mono font-bold text-emerald-300 uppercase">DEMO OFFTAKE REQUIREMENT</div>
                            <h3 class="text-lg font-bold text-white">1,000 HA Production Requirement</h3>
                        </div>
                        <span class="rounded bg-amber-500/20 px-2 py-0.5 text-[8px] font-bold text-amber-300 border border-amber-400/30">DEMO / EXAMPLE</span>
                    </div>

                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div class="p-3 rounded-xl bg-white/5 border border-white/5 space-y-1">
                            <span class="text-[9px] text-gray-400 uppercase font-bold">ANNUAL REQUIREMENT</span>
                            <div class="text-sm font-extrabold text-white">Defined by Buyer Spec</div>
                        </div>
                        <div class="p-3 rounded-xl bg-white/5 border border-white/5 space-y-1">
                            <span class="text-[9px] text-gray-400 uppercase font-bold">BUYER ENTITY</span>
                            <div class="text-sm font-extrabold text-emerald-300">Demo Offtake Buyer</div>
                        </div>
                    </div>

                    <p class="text-[10px] italic text-gray-400">
                        Example buyer requirement mapped into candidate regional production clusters.
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
                            <span class="text-emerald-300 font-bold">350 HA MAPPED CAPACITY</span>
                        </div>
                        <div class="text-[10px] text-gray-400">Physical Asset Parcel Mapping &bull; Status: MAPPED</div>
                        <div class="w-full bg-gray-800 h-2 rounded-full overflow-hidden">
                            <div class="bg-emerald-400 h-full w-[35%]"></div>
                        </div>
                    </div>

                    <div class="p-4 rounded-2xl bg-black/40 border border-white/10 space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-white">SOUTH KALIMANTAN CLUSTER</span>
                            <span class="text-emerald-300 font-bold">650 HA MAPPED CAPACITY</span>
                        </div>
                        <div class="text-[10px] text-gray-400">Physical Asset Parcel Mapping &bull; Status: MAPPED</div>
                        <div class="w-full bg-gray-800 h-2 rounded-full overflow-hidden">
                            <div class="bg-emerald-400 h-full w-[65%]"></div>
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
                            <div class="text-base font-extrabold text-white">Rp15,000,000,000</div>
                        </div>
                        <div class="p-3 rounded-xl bg-white/5 border border-white/5 space-y-0.5">
                            <span class="text-[8px] text-gray-400 uppercase font-bold">MINIMUM PO ALLOCATION</span>
                            <div class="text-base font-extrabold text-emerald-300">Rp1,000,000,000</div>
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
    <section id="scene-07" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/7.jpg" alt="Production Lifecycle" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto text-center w-full">
            <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                <span>07 &bull; PRODUCTION LIFECYCLE</span>
            </div>

            <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white mb-3 tracking-tight">One Lifecycle. Every Stage Visible.</h2>
            <p class="scene-anim-item text-sm sm:text-base text-gray-300 max-w-2xl mx-auto mb-8 leading-relaxed">
                From production requirement to commercial settlement, every material event is recorded and traceable.
            </p>

            <div class="scene-anim-item bg-[#142314]/80 p-6 rounded-3xl border border-[#1E3A24]/80 shadow-2xl backdrop-blur-md">
                <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-2 text-[9px] font-mono text-center">
                    <div class="p-2.5 rounded-xl bg-black/40 border border-emerald-500/30 font-bold text-white">01 DEMAND &rsaquo;</div>
                    <div class="p-2.5 rounded-xl bg-black/40 border border-emerald-500/30 font-bold text-white">02 CAPACITY &rsaquo;</div>
                    <div class="p-2.5 rounded-xl bg-black/40 border border-emerald-500/30 font-bold text-white">03 BATCH &rsaquo;</div>
                    <div class="p-2.5 rounded-xl bg-black/40 border border-emerald-500/30 font-bold text-white">04 PO &rsaquo;</div>
                    <div class="p-2.5 rounded-xl bg-black/40 border border-emerald-500/30 font-bold text-white">05 MILESTONE &rsaquo;</div>
                    <div class="p-2.5 rounded-xl bg-black/40 border border-emerald-500/30 font-bold text-white">06 RAB &rsaquo;</div>
                    <div class="p-2.5 rounded-xl bg-black/40 border border-emerald-500/30 font-bold text-white">07 VENDOR &rsaquo;</div>
                    <div class="p-2.5 rounded-xl bg-black/40 border border-emerald-500/30 font-bold text-white">08 EXECUTION &rsaquo;</div>
                    <div class="p-2.5 rounded-xl bg-black/40 border border-emerald-500/30 font-bold text-white">09 VERIFY &rsaquo;</div>
                    <div class="p-2.5 rounded-xl bg-black/40 border border-emerald-500/30 font-bold text-white">10 PROCESS &rsaquo;</div>
                    <div class="p-2.5 rounded-xl bg-black/40 border border-emerald-500/30 font-bold text-white">11 DELIVER &rsaquo;</div>
                    <div class="p-2.5 rounded-xl bg-emerald-950 border border-emerald-400 font-bold text-emerald-300">12 SETTLE ✓</div>
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
                            <h3 class="text-base font-bold text-white mt-1">BATCH NK-001 &bull; 100 HA ALLOCATION</h3>
                        </div>
                        <span class="font-bold text-emerald-300 text-sm">Rp1,000,000,000</span>
                    </div>

                    <div class="space-y-2 text-[10px] font-mono">
                        <div class="flex justify-between items-center p-2 rounded bg-black/30 border border-white/5">
                            <span class="text-emerald-300 font-bold flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> PO Collection (Simulated State)</span>
                            <span class="text-gray-400 font-bold">100% Collected</span>
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
                <div class="grid grid-cols-1 md:grid-cols-5 gap-2 text-center text-[10px] font-mono">
                    <div class="p-3 rounded-xl bg-black/40 border border-white/10 space-y-1">
                        <span class="text-gray-400 font-bold block">Rp15B REQUIREMENT</span>
                        <span class="text-emerald-300 block">Modeled RAB</span>
                    </div>
                    <div class="p-3 rounded-xl bg-black/40 border border-white/10 space-y-1">
                        <span class="text-gray-400 font-bold block">RAB BUDGET</span>
                        <span class="text-emerald-300 block">9 Categories</span>
                    </div>
                    <div class="p-3 rounded-xl bg-black/40 border border-white/10 space-y-1">
                        <span class="text-gray-400 font-bold block">VENDORS</span>
                        <span class="text-amber-300 block">Production Partners (Verification Pending)</span>
                    </div>
                    <div class="p-3 rounded-xl bg-black/40 border border-white/10 space-y-1">
                        <span class="text-gray-400 font-bold block">REGISTERED WALLET</span>
                        <span class="text-emerald-300 block">Entity Identity</span>
                    </div>
                    <div class="p-3 rounded-xl bg-emerald-950 border border-emerald-400 space-y-1">
                        <span class="text-white font-bold block">AUDIT TRAIL</span>
                        <span class="text-emerald-300 block">Permanent Record</span>
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
                        <span class="text-gray-300 font-bold">PRODUCTION</span>
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
        <div class="absolute inset-0 z-0 opacity-40 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/1.jpg" alt="Commercial Settlement" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto text-center w-full">
            <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>11 &bull; COMMERCIAL SETTLEMENT</span>
            </div>

            <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white mb-3 tracking-tight">From Production to Commercial Settlement.</h2>
            <p class="scene-anim-item text-sm sm:text-base text-gray-300 max-w-2xl mx-auto mb-8 leading-relaxed">
                Settlement is recorded against completed production and commercial transactions.
            </p>

            <div class="scene-anim-item bg-[#142314]/85 p-6 rounded-3xl border border-emerald-500/50 shadow-2xl backdrop-blur-md text-left space-y-4">
                <div class="grid grid-cols-3 sm:grid-cols-5 lg:grid-cols-9 gap-1.5 text-[8px] font-mono text-center">
                    <div class="p-2 rounded-xl bg-black/40 border border-white/10 font-bold text-white">HARVEST &rsaquo;</div>
                    <div class="p-2 rounded-xl bg-black/40 border border-white/10 font-bold text-white">WEIGHING &rsaquo;</div>
                    <div class="p-2 rounded-xl bg-black/40 border border-white/10 font-bold text-white">QUALITY ACCEPTANCE &rsaquo;</div>
                    <div class="p-2 rounded-xl bg-black/40 border border-white/10 font-bold text-white">PROCESSING &rsaquo;</div>
                    <div class="p-2 rounded-xl bg-black/40 border border-white/10 font-bold text-white">PRODUCT &rsaquo;</div>
                    <div class="p-2 rounded-xl bg-black/40 border border-white/10 font-bold text-white">BUYER &rsaquo;</div>
                    <div class="p-2 rounded-xl bg-black/40 border border-white/10 font-bold text-white">DELIVERY &rsaquo;</div>
                    <div class="p-2 rounded-xl bg-black/40 border border-white/10 font-bold text-white">COMMERCIAL ACCEPTANCE &rsaquo;</div>
                    <div class="p-2 rounded-xl bg-emerald-950 border border-emerald-400 font-bold text-emerald-300 col-span-3 sm:col-span-1">SETTLEMENT ✓</div>
                </div>

                <p class="text-[9px] italic text-gray-400 text-center">
                    Commercial settlement requires verified delivery and commercial acceptance before transaction closure.
                </p>
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
                    <div class="text-xl font-extrabold text-white">10,000 HA</div>
                </div>
                <div class="p-3.5 rounded-2xl bg-black/50 border border-white/10 space-y-1">
                    <span class="text-[8px] font-mono text-gray-400 uppercase font-bold">PRODUCTION BATCHES</span>
                    <div class="text-xl font-extrabold text-emerald-300">100</div>
                </div>
                <div class="p-3.5 rounded-2xl bg-black/50 border border-white/10 space-y-1">
                    <span class="text-[8px] font-mono text-gray-400 uppercase font-bold">MODELED VALUE</span>
                    <div class="text-xl font-extrabold text-white">Rp1.5T</div>
                </div>
                <div class="p-3.5 rounded-2xl bg-black/50 border border-white/10 space-y-1">
                    <span class="text-[8px] font-mono text-gray-400 uppercase font-bold">MODELED 3% FEE</span>
                    <div class="text-xl font-extrabold text-amber-300">Rp45B</div>
                </div>
            </div>

            <p class="text-[9px] italic text-gray-400">
                Modeled target, not achieved results or guaranteed revenue.
            </p>

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
