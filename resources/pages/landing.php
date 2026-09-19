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

<!-- FULL-SCREEN SCENE-BASED PRESENTATION CONTAINER -->
<div id="presentation-container" class="relative w-screen h-screen overflow-hidden bg-[#0F1C0E] text-white font-inter select-none" x-data="{ 
    activeDiagramStage: 'Asset', 
    activeParcel: 'A', 
    verTab: 'land',
    stageImages: { 
        'Asset': '<?php echo $basePrefix; ?>/1.jpg', 
        'Project': '<?php echo $basePrefix; ?>/2.jpg', 
        'Operations': '<?php echo $basePrefix; ?>/3.jpg', 
        'Verification': '<?php echo $basePrefix; ?>/4.jpg', 
        'Capital': '<?php echo $basePrefix; ?>/5.jpg', 
        'Revenue': '<?php echo $basePrefix; ?>/6.jpg', 
        'Distribution': '<?php echo $basePrefix; ?>/7.jpg' 
    },
    stageDescriptions: {
        'Asset': 'Verifiable GIS boundary mapping, topographic elevation models, and soil quality indices across 4,000 ha.',
        'Project': 'Concession permits, master development schedules, and zoning registries aggregated into a baseline.',
        'Operations': 'Real-time operational tracking, harvesting productivity, and processing mill throughput.',
        'Verification': 'Independent RSPO & ISPO compliance audits, legal reviews, and document cryptographic hashing.',
        'Capital': 'Transparent capital tracking, mapping every dollar directly to plantation development and reserves.',
        'Revenue': 'Itemized waterfall flow from gross crude palm oil sales to net distributable investor cash flow.',
        'Distribution': 'Automated investor distributions, yield schedule execution, and compliance reporting.'
    }
}">

    <!-- HIGGSFIELD / AWWWARDS OPENING INTRO LOADER -->
    <div id="intro-loader" class="fixed inset-0 z-[9999] bg-[#0F1C0E] text-white flex flex-col items-center justify-center p-6 select-none">
        <div class="max-w-md w-full text-center space-y-6">
            <!-- Animated Brand Mark -->
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-emerald-950/80 border border-emerald-500/40 shadow-2xl shadow-emerald-500/20 mb-2 transform hover:scale-105 transition-transform duration-500">
                <svg class="w-10 h-10 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
            </div>
            
            <div class="space-y-2">
                <span class="text-xs font-mono uppercase tracking-[0.3em] text-emerald-400/80 block">KALLANI INFRASTRUCTURE OS</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">Productive Natural Assets</h2>
            </div>

            <!-- Loader Progress Bar & Counter -->
            <div class="space-y-3 pt-4">
                <div class="w-full bg-emerald-950/60 border border-emerald-800/40 h-2.5 rounded-full overflow-hidden p-0.5 shadow-inner">
                    <div id="loader-bar" class="bg-gradient-to-r from-emerald-500 via-emerald-400 to-amber-300 h-full w-0 rounded-full transition-all duration-75"></div>
                </div>
                <div class="flex items-center justify-between text-xs font-mono text-emerald-300/80">
                    <span id="loader-status">INITIALIZING SYSTEM MODULES...</span>
                    <span id="loader-percent" class="font-bold text-emerald-400 text-sm">0%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- PRESENTATION TOP BRAND CHROME (PRESENTATION MODE ONLY) -->
    <div id="presentation-header" class="fixed top-6 left-6 z-40 flex items-center gap-3 transition-all duration-500">
        <a href="<?php echo $basePrefix; ?>/" class="flex items-center gap-2.5 group">
            <div class="w-9 h-9 rounded-xl bg-emerald-900/80 border border-emerald-500/50 flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform">
                <svg class="w-5 h-5 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
            </div>
            <div>
                <span class="text-base font-extrabold tracking-tight text-white block leading-none">KALLANI</span>
                <span class="text-[10px] font-mono tracking-widest text-emerald-400 uppercase">Operating System</span>
            </div>
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
                      x-text="['01 Opening', '02 Problem', '03 Concept', '04 Physical Asset', '05 Structure', '06 Operations', '07 Verification', '08 Capital', '09 Revenue', '10 ESG & Risk', '11 Connected OS', '12 Final Reveal'][i - 1]"></span>
            </button>
        </template>
    </div>

    <!-- ========================================================================= -->
    <!-- 12 FULL-SCREEN SCENES (SCENE 01 TO SCENE 12)                              -->
    <!-- ========================================================================= -->

    <!-- SCENE 01 — OPENING -->
    <section id="scene-01" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 z-20 transition-opacity">
        <div class="absolute inset-0 z-0 opacity-55 scale-105" id="hero-bg">
            <img src="<?php echo $basePrefix; ?>/1.jpg" alt="Natural Asset Landscape" class="w-full h-full object-cover filter brightness-95 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/50 to-[#0F1C0E]/20"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto text-center flex flex-col items-center">
            <h1 class="scene-anim-item text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white mb-6 leading-[1.1] text-balance">
                Operating Systems for <br />
                <span class="bg-gradient-to-r from-emerald-300 via-emerald-100 to-amber-200 bg-clip-text text-transparent">Productive Natural Assets</span>
            </h1>

            <p class="scene-anim-item text-lg sm:text-2xl text-gray-300 font-normal max-w-3xl mb-10 leading-relaxed text-balance">
                Connecting physical assets, operations, verification, capital, and revenue into one integrated operating system.
            </p>

            <!-- SLEEK INTERACTIVE SCROLL PROMPT -->
            <div class="scene-anim-item flex flex-col items-center gap-3 mt-4 group cursor-pointer" onclick="window.goToScene(1)">
                <div class="w-6 h-10 rounded-full border-2 border-emerald-400/50 flex justify-center pt-2 backdrop-blur-md group-hover:border-emerald-400 transition-colors shadow-lg shadow-emerald-950">
                    <div class="w-1.5 h-3 rounded-full bg-emerald-400 animate-bounce"></div>
                </div>
                <div class="flex items-center gap-2 text-[11px] font-mono tracking-[0.25em] uppercase text-emerald-300/80 group-hover:text-emerald-300 transition-colors">
                    <span>Scroll to Explore</span>
                    <svg class="w-3.5 h-3.5 text-emerald-400 transform group-hover:translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 02 — THE PROBLEM -->
    <section id="scene-02" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/2.jpg" alt="Structural Challenge" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto text-center">
            <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-3">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <span>02 • Structural Challenge</span>
            </div>

            <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white mb-4 tracking-tight">Natural Assets. Disconnected Systems.</h2>
            <p class="scene-anim-item text-base sm:text-lg text-gray-300 max-w-2xl mx-auto mb-12">
                Traditional natural asset management fragments physical land, operational tracking, third-party verification, and investor distribution into isolated silos.
            </p>

            <!-- CARDS VISUAL MATCHING SCENE 03 & DASHBOARD CARD STYLE -->
            <div class="scene-anim-item bg-[#142314]/70 rounded-3xl p-6 sm:p-8 border border-[#1E3A24]/80 backdrop-blur-md shadow-2xl text-left">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Fragment #01 -->
                    <div class="p-4 rounded-2xl bg-black/30 text-gray-300 border border-[#1E3A24]/60 hover:border-red-500/50 hover:bg-black/50 transition-all flex flex-col justify-between cursor-pointer group">
                        <div class="flex items-center justify-between mb-3">
                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            <span class="w-2 h-2 rounded-full bg-red-400"></span>
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-white mb-1">Physical Land Records</span>
                            <span class="block text-xs text-gray-400 leading-relaxed mb-4">Cadastral surveys and GIS maps stored in paper archives or isolated software.</span>
                        </div>
                        <div class="pt-2.5 border-t border-[#1E3A24]/60 flex items-center justify-between text-[11px] font-mono text-gray-400">
                            <span>01 • Fragment</span>
                            <span class="counter-num font-bold text-red-400" data-counter="4,000 ha Mapped">4,000 ha Mapped</span>
                        </div>
                    </div>

                    <!-- Fragment #02 -->
                    <div class="p-4 rounded-2xl bg-black/30 text-gray-300 border border-[#1E3A24]/60 hover:border-amber-500/50 hover:bg-black/50 transition-all flex flex-col justify-between cursor-pointer group">
                        <div class="flex items-center justify-between mb-3">
                            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-white mb-1">Field Operations</span>
                            <span class="block text-xs text-gray-400 leading-relaxed mb-4">Harvest logs and fertilizer data manually reported without real-time auditability.</span>
                        </div>
                        <div class="pt-2.5 border-t border-[#1E3A24]/60 flex items-center justify-between text-[11px] font-mono text-gray-400">
                            <span>02 • Fragment</span>
                            <span class="counter-num font-bold text-amber-400" data-counter="19.4 MT/ha Yield">19.4 MT/ha Yield</span>
                        </div>
                    </div>

                    <!-- Fragment #03 -->
                    <div class="p-4 rounded-2xl bg-black/30 text-gray-300 border border-[#1E3A24]/60 hover:border-blue-500/50 hover:bg-black/50 transition-all flex flex-col justify-between cursor-pointer group">
                        <div class="flex items-center justify-between mb-3">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-white mb-1">Audits & Verification</span>
                            <span class="block text-xs text-gray-400 leading-relaxed mb-4">Third-party compliance assessments conducted as delayed annual PDF reports.</span>
                        </div>
                        <div class="pt-2.5 border-t border-[#1E3A24]/60 flex items-center justify-between text-[11px] font-mono text-gray-400">
                            <span>03 • Fragment</span>
                            <span class="counter-num font-bold text-blue-400" data-counter="82% Audited">82% Audited</span>
                        </div>
                    </div>

                    <!-- Fragment #04 (Highlighted Card Style matching Scene 03 Active State) -->
                    <div class="p-4 rounded-2xl bg-emerald-600 text-white border border-emerald-400 shadow-lg shadow-emerald-600/30 flex flex-col justify-between cursor-pointer">
                        <div class="flex items-center justify-between mb-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="w-2 h-2 rounded-full bg-amber-300 animate-pulse"></span>
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-white mb-1">Capital & Yields</span>
                            <span class="block text-xs text-emerald-100 leading-relaxed mb-4">Financial allocation disconnected from physical land performance metrics.</span>
                        </div>
                        <div class="pt-2.5 border-t border-emerald-500/50 flex items-center justify-between text-[11px] font-mono text-emerald-100">
                            <span>04 • Fragment</span>
                            <span class="counter-num font-bold text-white" data-counter="$12.5M Target">$12.5M Target</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 03 — THE KALLANI CONCEPT -->
    <section id="scene-03" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/3.jpg" alt="System Architecture" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto text-center">
            <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"></path></svg>
                <span>03 • System Architecture</span>
            </div>

            <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white mb-4 tracking-tight">One Connected Operating System.</h2>
            <p class="scene-anim-item text-base sm:text-lg text-gray-300 max-w-2xl mx-auto mb-10">
                Kallani unifies every stage of natural asset management into one integrated, auditable digital operating model.
            </p>

            <!-- Interactive Stage Diagram Selector -->
            <div class="scene-anim-item bg-[#142314]/70 rounded-3xl p-6 sm:p-8 border border-[#1E3A24]/80 backdrop-blur-md shadow-2xl">
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
                    <button @click="activeDiagramStage = '<?php echo $key; ?>'" class="p-3 rounded-2xl text-left transition-all border flex flex-col justify-between cursor-pointer" :class="activeDiagramStage === '<?php echo $key; ?>' ? 'bg-emerald-600 text-white border-emerald-400 shadow-lg scale-105' : 'bg-black/30 text-gray-300 border-[#1E3A24]/60 hover:bg-black/50'">
                        <div class="flex items-center justify-between mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo $info['icon']; ?>"></path></svg>
                            <span class="w-2 h-2 rounded-full" :class="activeDiagramStage === '<?php echo $key; ?>' ? 'bg-amber-300 animate-pulse' : 'bg-gray-600'"></span>
                        </div>
                        <div>
                            <span class="block text-xs font-bold"><?php echo $key; ?></span>
                            <span class="block text-[10px] opacity-80 font-medium"><?php echo $info['sub']; ?></span>
                        </div>
                    </button>
                    <?php endforeach; ?>
                </div>

                <div class="bg-black/50 rounded-2xl p-5 sm:p-6 border border-[#1E3A24]/60 text-left flex flex-col md:flex-row items-center gap-6">
                    <div class="flex-1 w-full text-left">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-emerald-950 text-emerald-300 border border-emerald-800 mb-3">
                            <span>Stage Focus</span>
                            <span>•</span>
                            <span x-text="activeDiagramStage"></span>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2 leading-tight" x-text="activeDiagramStage + ' Governance Layer'"></h3>
                        <p class="text-xs text-gray-300 leading-relaxed" x-text="stageDescriptions[activeDiagramStage] || stageDescriptions['Asset']"></p>
                    </div>
                    <div class="w-full md:w-64 h-40 rounded-xl overflow-hidden relative border border-[#1E3A24]/60 shrink-0 shadow-lg">
                        <img :src="stageImages[activeDiagramStage] || '<?php echo $basePrefix; ?>/1.jpg'" :alt="activeDiagramStage + ' Visual'" class="w-full h-full object-cover filter brightness-95 transition-all duration-500" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 04 — PHYSICAL ASSET -->
    <section id="scene-04" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/4.jpg" alt="Physical Concession" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div class="text-left">
                    <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        <span>04 • Physical Concession</span>
                    </div>

                    <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white mb-4 tracking-tight leading-tight">Every Project Starts with the Land.</h2>
                    <p class="scene-anim-item text-sm sm:text-base text-gray-300 mb-6 leading-relaxed">
                        The flagship demonstration asset is the <strong class="text-white">North Kalimantan Palm Project</strong>. Spanning 4,000 hectares of productive agricultural land in East Kalimantan, Indonesia.
                    </p>

                    <div class="scene-anim-item space-y-3 mb-6">
                        <button @click="activeParcel = 'A'" class="w-full p-3.5 rounded-xl text-left border transition-all flex items-center justify-between cursor-pointer" :class="activeParcel === 'A' ? 'bg-emerald-950/80 border-emerald-400 font-bold' : 'bg-white/5 border-white/10 hover:bg-white/10'">
                            <div>
                                <span class="block text-xs text-white font-bold">Zone A — Mature Plantation (<span class="counter-num" data-counter="1,800 ha">1,800 ha</span>)</span>
                                <span class="text-[10px] text-gray-400">Peak harvesting • High FFB yield</span>
                            </div>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/40">Operational</span>
                        </button>

                        <button @click="activeParcel = 'B'" class="w-full p-3.5 rounded-xl text-left border transition-all flex items-center justify-between cursor-pointer" :class="activeParcel === 'B' ? 'bg-emerald-950/80 border-emerald-400 font-bold' : 'bg-white/5 border-white/10 hover:bg-white/10'">
                            <div>
                                <span class="block text-xs text-white font-bold">Zone B — Developing Plantation (<span class="counter-num" data-counter="1,400 ha">1,400 ha</span>)</span>
                                <span class="text-[10px] text-gray-400">Young palm stands • Irrigation extensions</span>
                            </div>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/20 text-amber-300 border border-amber-500/40">Developing</span>
                        </button>
                    </div>
                </div>

                <div class="scene-anim-item relative rounded-3xl overflow-hidden border border-white/20 shadow-2xl group">
                    <img src="<?php echo $basePrefix; ?>/Kebun-Sawit-3.jpg" alt="Concession GIS Map" class="w-full h-[380px] object-cover filter contrast-105 group-hover:scale-105 transition-transform duration-700" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent p-6 flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full text-xs font-mono font-bold bg-black/70 text-emerald-300 border border-emerald-500/40">GIS Parcel Map Overlay</span>
                            <span class="counter-num px-3 py-1 rounded-full text-xs font-bold bg-emerald-600 text-white" data-counter="4,000 Hectares">4,000 Hectares</span>
                        </div>
                        <div class="bg-black/80 backdrop-blur-md p-4 rounded-2xl border border-white/10 text-xs text-left">
                            <span class="text-emerald-400 font-bold block mb-1">Active Selection: North Kalimantan Concession</span>
                            <span class="text-gray-300 block">High-density mature palm trees producing average <span class="counter-num text-emerald-300 font-bold" data-counter="19.4 MT/ha">19.4 MT/ha</span> FFB.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 05 — PROJECT STRUCTURE -->
    <section id="scene-05" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/5.jpg" alt="Project Baseline" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto text-center">
            <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"></path></svg>
                <span>05 • Project Baseline</span>
            </div>

            <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white mb-4 tracking-tight">Turn Physical Assets into Structured Projects.</h2>
            <p class="scene-anim-item text-base text-gray-300 max-w-2xl mx-auto mb-10">
                Kallani structures raw land concessions into auditable project baselines with defined milestones, legal decrees, and operational bounds.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-left">
                <div class="scene-anim-item p-6 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-md">
                    <span class="counter-num text-xs font-mono text-emerald-400 block mb-2 font-bold" data-counter="Milestone 01">Milestone 01</span>
                    <h3 class="text-xl font-bold text-white mb-2">Concession License HGU</h3>
                    <p class="text-xs text-gray-400 mb-4">Decree HGU-541 granted by Ministry of Land Affairs for <span class="counter-num text-emerald-300 font-bold" data-counter="30-year">30-year</span> operational term.</p>
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-950 text-emerald-300 border border-emerald-800">Verified Legal</span>
                </div>

                <div class="scene-anim-item p-6 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-md">
                    <span class="counter-num text-xs font-mono text-amber-400 block mb-2 font-bold" data-counter="Milestone 02">Milestone 02</span>
                    <h3 class="text-xl font-bold text-white mb-2">Master Development Plan</h3>
                    <p class="text-xs text-gray-400 mb-4"><span class="counter-num text-amber-300 font-bold" data-counter="3,120 ha">3,120 ha</span> planted, central CPO extraction mill & <span class="counter-num text-amber-300 font-bold" data-counter="2.4 km">2.4 km</span> secondary channels.</p>
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-950 text-amber-300 border border-amber-800">Operational</span>
                </div>

                <div class="scene-anim-item p-6 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-md">
                    <span class="counter-num text-xs font-mono text-blue-400 block mb-2 font-bold" data-counter="Milestone 03">Milestone 03</span>
                    <h3 class="text-xl font-bold text-white mb-2">Environmental Baseline</h3>
                    <p class="text-xs text-gray-400 mb-4">RSPO & ISPO compliance ratings with <span class="counter-num text-blue-300 font-bold" data-counter="14,200 tCO2e/yr">14,200 tCO2e/yr</span> carbon absorption potential.</p>
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-950 text-blue-300 border border-blue-800">Audited Rating</span>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 06 — OPERATIONS -->
    <section id="scene-06" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/6.jpg" alt="Real-Time Operations" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-5 text-left">
                    <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        <span>06 • Real-Time Operations</span>
                    </div>

                    <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white mb-4 tracking-tight leading-tight">Make Operations Visible.</h2>
                    <p class="scene-anim-item text-sm text-gray-300 mb-6 leading-relaxed">
                        Monitor field activity, harvesting productivity, and processing mill throughput with real-time operational tracking.
                    </p>

                    <div class="scene-anim-item space-y-3 text-xs font-semibold">
                        <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl border border-white/10">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            <span>Planting Progress: <strong class="counter-num text-emerald-400 font-bold" data-counter="78%">78%</strong> (3,120 of 4,000 ha)</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl border border-white/10">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            <span>Average Harvest Yield: <strong class="counter-num text-emerald-400 font-bold" data-counter="19.4 MT / hectare">19.4 MT / hectare</strong></span>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl border border-white/10">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            <span>Mill Processing Capacity: <strong class="counter-num text-emerald-400 font-bold" data-counter="45 MT FFB / hour">45 MT FFB / hour</strong></span>
                        </div>
                    </div>
                </div>

                <div class="scene-anim-item lg:col-span-7 bg-[#142314]/70 p-6 rounded-3xl border border-[#1E3A24]/80 shadow-2xl backdrop-blur-md">
                    <div class="flex items-center justify-between pb-3 mb-4 border-b border-[#1E3A24]/60">
                        <span class="font-bold text-sm text-white">Live Field Activity Feed</span>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-950 text-emerald-300 border border-emerald-800">Live Stream</span>
                    </div>
                    <div class="space-y-3 text-left">
                        <div class="p-3.5 bg-black/40 rounded-xl border border-[#1E3A24]/60">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-bold text-xs text-white">Zone A Harvest Batch #104</span>
                                <span class="counter-num text-[10px] text-emerald-400 font-semibold" data-counter="100% Completed">100% Completed</span>
                            </div>
                            <div class="w-full bg-gray-800 h-1.5 rounded-full overflow-hidden">
                                <div class="progress-bar-anim bg-emerald-500 h-full" data-bar-width="100%" style="width: 0%"></div>
                            </div>
                        </div>
                        <div class="p-3.5 bg-black/40 rounded-xl border border-[#1E3A24]/60">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-bold text-xs text-white">Zone B Irrigation Extension</span>
                                <span class="counter-num text-[10px] text-amber-400 font-semibold" data-counter="78% In Progress">78% In Progress</span>
                            </div>
                            <div class="w-full bg-gray-800 h-1.5 rounded-full overflow-hidden">
                                <div class="progress-bar-anim bg-amber-500 h-full" data-bar-width="78%" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 07 — VERIFICATION -->
    <section id="scene-07" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/7.jpg" alt="Assurance Vault" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto text-center">
            <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>07 • Assurance & Audit Vault</span>
            </div>

            <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white mb-4 tracking-tight">Understand What Has Been Verified.</h2>
            <p class="scene-anim-item text-base text-gray-300 max-w-2xl mx-auto mb-10">
                Independent third-party audits, legal concession reviews, and tamper-evident document cryptographic hashing.
            </p>

            <div class="scene-anim-item bg-[#142314]/70 rounded-3xl p-6 border border-[#1E3A24]/80 backdrop-blur-md shadow-2xl text-left">
                <div class="flex flex-wrap gap-2 mb-6 pb-4 border-b border-[#1E3A24]/60">
                    <button @click="verTab = 'land'" class="px-4 py-2 rounded-xl text-xs font-bold transition-all cursor-pointer" :class="verTab === 'land' ? 'bg-emerald-600 text-white' : 'bg-white/5 text-gray-400 hover:bg-white/10'">Land & GIS</button>
                    <button @click="verTab = 'legal'" class="px-4 py-2 rounded-xl text-xs font-bold transition-all cursor-pointer" :class="verTab === 'legal' ? 'bg-emerald-600 text-white' : 'bg-white/5 text-gray-400 hover:bg-white/10'">Legal Rights</button>
                    <button @click="verTab = 'docs'" class="px-4 py-2 rounded-xl text-xs font-bold transition-all cursor-pointer" :class="verTab === 'docs' ? 'bg-emerald-600 text-white' : 'bg-white/5 text-gray-400 hover:bg-white/10'">Audited Vault</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-950 text-emerald-300 border border-emerald-800 mb-2 inline-block">Status: Verified</span>
                        <h4 class="text-lg font-bold text-white mb-2">GIS Spatial Boundary & Topography</h4>
                        <p class="text-xs text-gray-300 mb-4"><span class="counter-num text-emerald-400 font-bold" data-counter="4,000 hectares">4,000 hectares</span> mapped via high-resolution drone photogrammetry and SAR radar imagery.</p>
                        <div class="p-3 bg-black/40 rounded-xl border border-[#1E3A24]/60 text-xs">
                            <span class="text-gray-400 block">Cryptographic Hash</span>
                            <span class="font-mono text-emerald-400 font-bold">0x8f4b7a1c90e322d8a39a1</span>
                        </div>
                    </div>
                    <div class="p-5 bg-black/50 rounded-2xl border border-[#1E3A24]/60 flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-bold text-emerald-400 uppercase tracking-wider block mb-1">Assurance Certificate</span>
                            <p class="text-xs text-gray-300">Verified by AgriGIS Spatial Audit Ltd. & Institutional Assurance Group.</p>
                        </div>
                        <span class="text-[10px] font-mono text-gray-400 mt-4 block">REF: DOC-2026-NKP-V8</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 08 — CAPITAL -->
    <section id="scene-08" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/8.jpg" alt="Capital Ledger" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-5 text-left">
                    <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2"></path></svg>
                        <span>08 • Capital Ledger</span>
                    </div>

                    <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white mb-4 tracking-tight leading-tight">Understand Where Capital Is Allocated.</h2>
                    <p class="scene-anim-item text-sm text-gray-300 mb-6 leading-relaxed">
                        Kallani provides transparent capital tracking, mapping every dollar directly to plantation development, infrastructure, and reserves.
                    </p>

                    <div class="scene-anim-item grid grid-cols-2 gap-3 text-left">
                        <div class="p-3.5 bg-[#142314]/70 rounded-2xl border border-[#1E3A24]/80 hover:border-emerald-500/40 transition-colors">
                            <span class="text-[10px] text-gray-400 block">Total Project Value</span>
                            <span class="counter-num text-xl font-extrabold text-emerald-400" data-counter="$12.5M USD">$12.5M USD</span>
                        </div>
                        <div class="p-3.5 bg-[#142314]/70 rounded-2xl border border-[#1E3A24]/80 hover:border-emerald-500/40 transition-colors">
                            <span class="text-[10px] text-gray-400 block">Capital Committed</span>
                            <span class="counter-num text-xl font-extrabold text-white" data-counter="$6.8M USD">$6.8M USD</span>
                        </div>
                    </div>
                </div>

                <div class="scene-anim-item lg:col-span-7 bg-[#142314]/70 p-6 rounded-3xl border border-[#1E3A24]/80 shadow-2xl backdrop-blur-md text-left space-y-4">
                    <h4 class="font-bold text-sm text-white">Capital Allocation Breakdown ($8.2M Target)</h4>
                    <div>
                        <div class="flex justify-between text-xs font-bold text-gray-300 mb-1">
                            <span>Plantation Development (<span class="counter-num" data-counter="39.0%">39.0%</span>)</span>
                            <span class="counter-num text-emerald-400" data-counter="$3.20M USD">$3.20M USD</span>
                        </div>
                        <div class="w-full bg-gray-900 h-2.5 rounded-full overflow-hidden p-0.5 border border-emerald-950">
                            <div class="progress-bar-anim bg-emerald-500 h-full rounded-full" data-bar-width="39%" style="width: 0%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-xs font-bold text-gray-300 mb-1">
                            <span>Operations Working Capital (<span class="counter-num" data-counter="25.6%">25.6%</span>)</span>
                            <span class="counter-num text-blue-400" data-counter="$2.10M USD">$2.10M USD</span>
                        </div>
                        <div class="w-full bg-gray-900 h-2.5 rounded-full overflow-hidden p-0.5 border border-blue-950">
                            <div class="progress-bar-anim bg-blue-500 h-full rounded-full" data-bar-width="25.6%" style="width: 0%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-xs font-bold text-gray-300 mb-1">
                            <span>Mill & Infrastructure (<span class="counter-num" data-counter="22.0%">22.0%</span>)</span>
                            <span class="counter-num text-amber-400" data-counter="$1.80M USD">$1.80M USD</span>
                        </div>
                        <div class="w-full bg-gray-900 h-2.5 rounded-full overflow-hidden p-0.5 border border-amber-950">
                            <div class="progress-bar-anim bg-amber-500 h-full rounded-full" data-bar-width="22%" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 09 — REVENUE & DISTRIBUTION -->
    <section id="scene-09" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/9.jpg" alt="Financial Waterfall" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto text-center">
            <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                <span>09 • Financial Waterfall</span>
            </div>

            <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white mb-4 tracking-tight">Follow the Flow of Value.</h2>
            <p class="scene-anim-item text-base text-gray-300 max-w-2xl mx-auto mb-10">
                Itemized waterfall flow from gross crude palm oil sales to net distributable investor cash flow.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-left">
                <div class="scene-anim-item p-5 bg-white/5 rounded-2xl border border-emerald-500/30 backdrop-blur-md">
                    <span class="text-[10px] font-mono font-bold uppercase text-emerald-400 block mb-1">Step 1 — Gross Revenue</span>
                    <h4 class="counter-num text-2xl font-extrabold text-white mb-1" data-counter="$4,850,000">$4,850,000</h4>
                    <p class="text-[10px] text-gray-400">Total annual sales from CPO & kernel extraction.</p>
                </div>

                <div class="scene-anim-item p-5 bg-white/5 rounded-2xl border border-amber-500/30 backdrop-blur-md">
                    <span class="text-[10px] font-mono font-bold uppercase text-amber-400 block mb-1">Step 2 — Operating Cost</span>
                    <h4 class="counter-num text-2xl font-extrabold text-white mb-1" data-counter="-$1,420,000">-$1,420,000</h4>
                    <p class="text-[10px] text-gray-400">Field labor, fertilizer & milling opex expenses.</p>
                </div>

                <div class="scene-anim-item p-5 bg-white/5 rounded-2xl border border-purple-500/30 backdrop-blur-md">
                    <span class="text-[10px] font-mono font-bold uppercase text-purple-400 block mb-1">Step 3 — Reserve Buffer</span>
                    <h4 class="counter-num text-2xl font-extrabold text-white mb-1" data-counter="-$510,000">-$510,000</h4>
                    <p class="text-[10px] text-gray-400">Maintenance reserve & compliance buffer.</p>
                </div>

                <div class="scene-anim-item p-5 bg-emerald-900/90 rounded-2xl border border-emerald-500 shadow-xl">
                    <span class="text-[10px] font-mono font-bold uppercase text-emerald-300 block mb-1">Step 4 — Net Distribution</span>
                    <h4 class="counter-num text-2xl font-extrabold text-white mb-1" data-counter="$2,920,000">$2,920,000</h4>
                    <p class="text-[10px] text-emerald-100">Net distributable cash flow for quarterly payouts.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 10 — ESG, RISK & AUDIT -->
    <section id="scene-10" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/10.jpg" alt="ESG & Sustainability" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto text-center">
            <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945"></path></svg>
                <span>10 • ESG & Sustainability</span>
            </div>

            <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white mb-4 tracking-tight">Visibility Beyond Financial Metrics.</h2>
            <p class="scene-anim-item text-base text-gray-300 max-w-2xl mx-auto mb-10">
                Track carbon absorption potential, environmental compliance, and immutable audit logs.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                <div class="scene-anim-item p-6 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-md">
                    <h4 class="font-bold text-lg text-white mb-1">Carbon Sequestration</h4>
                    <span class="counter-num text-2xl font-extrabold text-emerald-400 block mb-2" data-counter="14,200 tCO2e/yr">14,200 tCO2e/yr</span>
                    <p class="text-xs text-gray-400">Estimated annual carbon absorption across palm stands & forest buffers.</p>
                </div>

                <div class="scene-anim-item p-6 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-md">
                    <h4 class="font-bold text-lg text-white mb-1">RSPO / ISPO Rating</h4>
                    <span class="counter-num text-2xl font-extrabold text-blue-400 block mb-2" data-counter="94% Compliant">94% Compliant</span>
                    <p class="text-xs text-gray-400">Adherence to zero-deforestation & soil conservation standards.</p>
                </div>

                <div class="scene-anim-item p-6 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-md">
                    <h4 class="font-bold text-lg text-white mb-1">Immutable Audit Trail</h4>
                    <span class="counter-num text-2xl font-extrabold text-purple-400 block mb-2" data-counter="1,240 Events">1,240 Events</span>
                    <p class="text-xs text-gray-400">Chronological activity logs recording parcel updates & attestations.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 11 — CONNECTED SYSTEM RECAP -->
    <section id="scene-11" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-40 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/1.jpg" alt="Integrated OS" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-5xl mx-auto text-center">
            <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>11 • Integrated Operating System</span>
            </div>

            <h2 class="scene-anim-item text-3xl sm:text-5xl font-extrabold text-white mb-4 tracking-tight">One Project. Multiple Connected Layers.</h2>
            <p class="scene-anim-item text-base text-gray-300 max-w-2xl mx-auto mb-10">
                Bringing physical land, project governance, operations, verification, capital, revenue, and ESG into one auditable system.
            </p>

            <div class="scene-anim-item bg-white/5 rounded-3xl p-8 border border-white/10 backdrop-blur-md shadow-2xl">
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
                    <div class="p-4 bg-black/40 rounded-2xl border border-white/10">
                        <span class="counter-num text-[10px] font-mono text-emerald-400 uppercase block" data-counter="Layer 01">Layer 01</span>
                        <span class="font-bold text-sm text-white">Physical Land</span>
                    </div>
                    <div class="p-4 bg-black/40 rounded-2xl border border-white/10">
                        <span class="counter-num text-[10px] font-mono text-emerald-400 uppercase block" data-counter="Layer 02">Layer 02</span>
                        <span class="font-bold text-sm text-white">Project Structure</span>
                    </div>
                    <div class="p-4 bg-black/40 rounded-2xl border border-white/10">
                        <span class="counter-num text-[10px] font-mono text-emerald-400 uppercase block" data-counter="Layer 03">Layer 03</span>
                        <span class="font-bold text-sm text-white">Field Operations</span>
                    </div>
                    <div class="p-4 bg-black/40 rounded-2xl border border-white/10">
                        <span class="counter-num text-[10px] font-mono text-emerald-400 uppercase block" data-counter="Layer 04">Layer 04</span>
                        <span class="font-bold text-sm text-white">Verification</span>
                    </div>
                    <div class="p-4 bg-black/40 rounded-2xl border border-white/10">
                        <span class="counter-num text-[10px] font-mono text-emerald-400 uppercase block" data-counter="Layer 05">Layer 05</span>
                        <span class="font-bold text-sm text-white">Capital Allocation</span>
                    </div>
                    <div class="p-4 bg-black/40 rounded-2xl border border-white/10">
                        <span class="counter-num text-[10px] font-mono text-emerald-400 uppercase block" data-counter="Layer 06">Layer 06</span>
                        <span class="font-bold text-sm text-white">Revenue Flow</span>
                    </div>
                    <div class="p-4 bg-black/40 rounded-2xl border border-white/10">
                        <span class="counter-num text-[10px] font-mono text-emerald-400 uppercase block" data-counter="Layer 07">Layer 07</span>
                        <span class="font-bold text-sm text-white">Distributions</span>
                    </div>
                    <div class="p-4 bg-black/40 rounded-2xl border border-white/10">
                        <span class="counter-num text-[10px] font-mono text-emerald-400 uppercase block" data-counter="Layer 08">Layer 08</span>
                        <span class="font-bold text-sm text-white">ESG & Audit</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENE 12 — FINAL REVEAL & CTA -->
    <section id="scene-12" class="scene absolute inset-0 w-full h-full flex items-center justify-center p-6 opacity-0 pointer-events-none z-10">
        <div class="absolute inset-0 z-0 opacity-45 scale-105 pointer-events-none">
            <img src="<?php echo $basePrefix; ?>/2.jpg" alt="Final Reveal" class="w-full h-full object-cover filter brightness-90 contrast-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0F1C0E] via-[#0F1C0E]/65 to-[#0F1C0E]/30"></div>
        </div>
        <div class="relative z-10 max-w-4xl mx-auto text-center">
            <div class="scene-anim-item inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.2em] text-emerald-400 mb-4">
                <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                <span>12 • Interactive Project Dashboard</span>
            </div>
            
            <h2 class="scene-anim-item text-4xl sm:text-6xl font-extrabold text-white mb-6 tracking-tight">Explore Kallani in Action.</h2>
            <p class="scene-anim-item text-base sm:text-lg text-emerald-200 max-w-2xl mx-auto mb-10">
                Discover how productive natural assets are represented through a connected operating system.
            </p>

            <div class="scene-anim-item bg-white/10 backdrop-blur-md rounded-3xl p-8 border border-white/20 text-left max-w-2xl mx-auto mb-10 shadow-2xl">
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
                        <span class="counter-num font-bold text-base text-white" data-counter="4,000 ha">4,000 ha</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block">Current Yield</span>
                        <span class="counter-num font-bold text-base text-emerald-300" data-counter="19.4 MT/ha">19.4 MT/ha</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block">Funded Ratio</span>
                        <span class="counter-num font-bold text-base text-white" data-counter="82.9%">82.9%</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block">Verification</span>
                        <span class="counter-num font-bold text-base text-emerald-300" data-counter="82% Verified">82% Verified</span>
                    </div>
                </div>
            </div>

            <div class="scene-anim-item flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="<?php echo $basePrefix; ?>/projects/north-kalimantan-palm" class="w-full sm:w-auto px-10 py-5 rounded-2xl bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-extrabold text-lg shadow-2xl transition-all hover:scale-105 inline-flex items-center justify-center gap-3">
                    <span>Enter Interactive Project Dashboard</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                <a href="<?php echo $basePrefix; ?>/explore" class="w-full sm:w-auto px-8 py-5 rounded-2xl bg-white/10 hover:bg-white/20 text-white font-bold text-base border border-white/20 transition-all hover:scale-105">
                    <span>Explore Concession Catalog</span>
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
                "SYNCING CONCESSION LEDGERS...",
                "VERIFYING RSPO AUDIT TRAILS...",
                "COMPLEX FINANCIAL WATERFALL READY."
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

        const sceneTitles = [
            '01 — OPENING',
            '02 — THE PROBLEM',
            '03 — SYSTEM ARCHITECTURE',
            '04 — PHYSICAL ASSET SPOTLIGHT',
            '05 — PROJECT STRUCTURE',
            '06 — OPERATIONAL INTELLIGENCE',
            '07 — THIRD-PARTY ASSURANCE',
            '08 — CAPITAL ALLOCATION',
            '09 — FINANCIAL WATERFALL',
            '10 — SUSTAINABILITY & AUDIT',
            '11 — CONNECTED MODEL',
            '12 — FINAL REVEAL'
        ];

        function animateSceneCounters(container) {
            if (!container) return;
            const counterEls = container.querySelectorAll('.counter-num, [data-counter]');
            counterEls.forEach(el => {
                let targetText = el.getAttribute('data-counter');
                if (!targetText) {
                    targetText = el.textContent.trim();
                    el.setAttribute('data-counter', targetText);
                }

                const match = targetText.match(/^([^\d-]*)(-?\d[\d,.]*)(.*)$/);
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
            if (navbar) {
                if (window.currentScene === 11) {
                    navbar.classList.remove('opacity-0', 'pointer-events-none', '-translate-y-full');
                    navbar.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
                } else {
                    navbar.classList.add('opacity-0', 'pointer-events-none', '-translate-y-full');
                    navbar.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
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
            touchStartY = e.touches[0].clientY;
        }, { passive: true });

        window.addEventListener('touchend', (e) => {
            if (window.isAnimating) return;
            const touchEndY = e.changedTouches[0].clientY;
            const diff = touchStartY - touchEndY;
            if (Math.abs(diff) > 40) {
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
?>
