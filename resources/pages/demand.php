<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$constants = $config['system_constants'] ?? [];
$demoDemand = $config['demo_demands'][0] ?? [];
$title = '20 / Production Requirements & Offtake Control — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'demand';

/* ---------- Helpers & Icons ---------- */
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

$svg = fn(string $inner, string $cls = 'w-4 h-4') =>
    '<svg class="' . $cls . '" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">' . $inner . '</svg>';

$ic = [
    'target'    => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.5"/>',
    'leaf'      => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>',
    'globe'     => '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>',
    'network'   => '<rect x="16" y="16" width="6" height="6" rx="1"/><rect x="2" y="16" width="6" height="6" rx="1"/><rect x="9" y="2" width="6" height="6" rx="1"/><path d="M5 16v-3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3M12 8v4"/>',
    'truck'     => '<rect x="1" y="3" width="15" height="13" rx="2"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>',
    'factory'   => '<path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V4H2z"/>',
    'box'       => '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>',
    'check'     => '<circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 4.5-5"/>',
    'shield'    => '<path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/>',
    'clock'     => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>',
    'doc'       => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>',
    'search'    => '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>',
    'arrow'     => '<path d="M5 12h14M12 5l7 7-7 7"/>',
    'coin'      => '<circle cx="12" cy="12" r="9"/><path d="M14.5 9.5c-.5-1-1.4-1.5-2.5-1.5-1.4 0-2.5.8-2.5 2s1 1.7 2.5 2 2.5.8 2.5 2-1.1 2-2.5 2c-1.1 0-2-.5-2.5-1.5M12 6v2M12 16v2"/>',
    'user'      => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
];

$card      = 'rounded-xl border border-white/10 bg-[#0B1815]/90 shadow-xl';
$iconBox   = 'flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-emerald-300';
$metricLbl = 'text-[9px] font-mono font-medium uppercase tracking-wider text-gray-400';

ob_start();
?>

<div class="relative w-full font-sans" x-data="{ viewMode: 'operator' }">

    <!-- PAGE BACKGROUND (soft blurred forest background) -->
    <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden">
        <img src="<?= $basePrefix ?>/1.jpg" alt="" class="h-full w-full scale-110 object-cover opacity-25 blur-md" />
        <div class="absolute inset-0 bg-gradient-to-b from-[#06120F]/60 via-[#06120F]/85 to-[#04100B]"></div>
    </div>

    <div class="relative z-10">

        <!-- ================= 01 & 02. PAGE HEADER & HERO DEMAND CARD ================= -->
        <section class="relative overflow-hidden shadow-2xl" style="border-bottom: none !important;">
            <img src="<?= $basePrefix ?>/1.jpg" alt="Natural forest canopy" class="absolute inset-0 h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#050D07]/90 via-[#050D07]/60 to-[#050D07]/20"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#06120F]/90 via-transparent to-transparent"></div>

            <div class="relative space-y-4 px-6 pt-3 pb-6 lg:px-8 lg:pt-3 lg:pb-8">

                <!-- Top Row: Breadcrumb & Right Toggle View -->
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <nav aria-label="Breadcrumb" class="inline-flex flex-wrap items-center gap-2 text-[10px] font-mono font-semibold uppercase tracking-[0.14em] text-gray-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                        <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors">NINA</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors">PRODUCTION REQUIREMENTS</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="font-bold text-white uppercase">DR-2026-001</span>
                    </nav>

                    <div class="flex items-center gap-2 text-[10px] font-mono font-bold">
                        <span class="text-gray-400">VIEW MODE:</span>
                        <div class="rounded-lg bg-black/60 p-1 border border-white/10 flex gap-1">
                            <button @click="viewMode = 'operator'" :class="viewMode === 'operator' ? 'bg-emerald-500 text-black font-extrabold' : 'text-gray-400 hover:text-white'" class="px-2.5 py-1 rounded uppercase transition-all">OPERATOR VIEW</button>
                            <button @click="viewMode = 'buyer'" :class="viewMode === 'buyer' ? 'bg-emerald-500 text-black font-extrabold' : 'text-gray-400 hover:text-white'" class="px-2.5 py-1 rounded uppercase transition-all">BUYER VIEW</button>
                        </div>
                        <span class="rounded bg-emerald-950 px-3 py-1 text-emerald-300 border border-emerald-500/30 uppercase tracking-wider">DEMO / SIMULATED REQUIREMENTS</span>
                    </div>
                </div>

                <!-- Headline & Right Demand Card Grid -->
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 items-center">
                    <div class="space-y-2 lg:col-span-7">
                        <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-200">
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">DEMAND & OFFTAKE CONTROL</span>
                            <span>20 / PRODUCTION REQUIREMENTS</span>
                        </div>

                        <h1 class="max-w-3xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">Demand Becomes Production.</h1>
                        
                        <p class="max-w-3xl text-sm font-medium leading-relaxed text-gray-200">
                            NINA converts defined buyer requirements into measurable production capacity, executable batches and traceable commercial delivery.
                        </p>
                        <p class="text-[11px] italic text-gray-400">
                            Kebutuhan buyer diterjemahkan menjadi kapasitas produksi, batch yang dapat dieksekusi, dan delivery yang dapat ditelusuri.
                        </p>
                    </div>

                    <!-- Right Side Demand Card (02 & 03) -->
                    <div class="lg:col-span-5">
                        <div class="rounded-xl border border-emerald-500/30 bg-[#091610]/95 p-4 shadow-2xl backdrop-blur-md space-y-3">
                            <div class="flex items-center justify-between border-b border-white/10 pb-2">
                                <div>
                                    <div class="text-[10px] font-mono text-emerald-400 uppercase tracking-widest">DEMO OFFTAKE REQUIREMENT</div>
                                    <div class="text-sm font-extrabold text-white font-mono">DR-2026-001</div>
                                </div>
                                <span class="rounded bg-amber-950 px-2.5 py-1 text-[10px] font-bold text-amber-300 border border-amber-500/30 uppercase">EXAMPLE / SIMULATED</span>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-xs font-mono">
                                <div>
                                    <div class="text-[9px] text-gray-400">BUYER ENTITY</div>
                                    <div class="font-bold text-white">Demo Offtake Buyer</div>
                                    <div class="text-[9px] text-gray-500 italic">No live contract in prototype</div>
                                </div>
                                <div>
                                    <div class="text-[9px] text-gray-400">PRODUCT / CAPACITY</div>
                                    <div class="font-bold text-emerald-300">Palm Oil Product</div>
                                    <div class="text-[10px] text-white">1,000 HA Required</div>
                                </div>
                            </div>

                            <div class="rounded-lg bg-black/40 p-2 border border-white/5 flex items-center justify-between text-[10px] font-mono">
                                <span class="text-gray-400">Program Horizon:</span>
                                <span class="font-bold text-white">20 Years (5 Yrs Ramp-up + 15 Yrs Delivery)</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ================= MAIN CONTENT BODY ================= -->
        <div class="space-y-6 px-4 pb-16 pt-6 sm:px-6 lg:px-8">

            <!-- ---------- 04. REQUIREMENT KPI STRIP (6 CARDS) ---------- -->
            <section class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">REQUIRED CAPACITY</span>
                        <span class="text-emerald-400"><?= $svg($ic['target'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-white font-mono">1,000 HA</div>
                    <div class="text-[9px] text-gray-400">Total required capacity</div>
                </div>

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">MAPPED CAPACITY</span>
                        <span class="text-emerald-400"><?= $svg($ic['globe'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-emerald-300 font-mono">1,000 HA</div>
                    <div class="text-[9px] text-gray-400">100% mapped coverage</div>
                </div>

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">MAPPING COVERAGE</span>
                        <span class="text-emerald-400"><?= $svg($ic['check'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-emerald-300 font-mono">100%</div>
                    <div class="text-[9px] text-emerald-400/80 font-bold">Fully mapped</div>
                </div>

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">EXECUTABLE BATCHES</span>
                        <span class="text-emerald-400"><?= $svg($ic['box'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-white font-mono">10</div>
                    <div class="text-[9px] text-gray-400">100 HA standard batches</div>
                </div>

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">MODELED VALUE</span>
                        <span class="text-emerald-400"><?= $svg($ic['coin'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-white font-mono">Rp150B</div>
                    <div class="text-[9px] text-gray-400">10 × Rp15B batch model</div>
                </div>

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">VERIFIED CAPACITY</span>
                        <span class="text-amber-400"><?= $svg($ic['shield'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-xl font-extrabold text-amber-300 font-mono uppercase">PENDING</div>
                    <div class="text-[9px] text-amber-400/80">Verification in progress</div>
                </div>

            </section>

            <!-- ---------- 05 & 06. DEMAND STATUS STATE MACHINE & PROGRESS BREAKDOWN ---------- -->
            <section class="<?= $card ?> p-6 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-white/10 pb-3">
                    <div>
                        <h3 class="text-sm font-mono font-bold uppercase text-white">REQUIREMENT OPERATIONAL LIFECYCLE</h3>
                        <p class="text-[11px] text-gray-400">State machine tracking from initial requirement intake to commercial delivery.</p>
                    </div>
                    <span class="rounded bg-emerald-950 px-3 py-1 text-emerald-300 font-mono text-xs font-bold border border-emerald-500/40">
                        CURRENT STATE: CAPACITY MAPPED
                    </span>
                </div>

                <!-- State Machine Flow (Precision Horizontal Nodes & Segment Lines) -->
                <div class="overflow-x-auto pb-4 pt-2 scrollbar-none">
                    <div class="min-w-[850px] grid grid-cols-8 font-mono text-[10px] relative px-2">
                        
                        <!-- Step 1: Draft -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-emerald-500 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-emerald-500 text-black flex items-center justify-center font-bold text-[10px] shadow-md shadow-emerald-950 z-10">✓</div>
                            <span class="font-bold text-white mt-2">Draft</span>
                        </div>

                        <!-- Step 2: Submitted -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-emerald-500 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-emerald-500 text-black flex items-center justify-center font-bold text-[10px] shadow-md shadow-emerald-950 z-10">✓</div>
                            <span class="font-bold text-white mt-2">Submitted</span>
                        </div>

                        <!-- Step 3: Validated -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-emerald-500 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-emerald-500 text-black flex items-center justify-center font-bold text-[10px] shadow-md shadow-emerald-950 z-10">✓</div>
                            <span class="font-bold text-white mt-2">Validated</span>
                        </div>

                        <!-- Step 4: Mapped -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-gradient-to-r from-emerald-500 to-amber-500 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-emerald-500 text-black flex items-center justify-center font-bold text-[10px] shadow-md shadow-emerald-950 z-10">✓</div>
                            <span class="font-bold text-emerald-300 mt-2">Mapped</span>
                        </div>

                        <!-- Step 5: Batches Structured -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-amber-500 text-black flex items-center justify-center font-bold text-[10px] ring-4 ring-amber-500/20 shadow-md z-10">●</div>
                            <span class="font-bold text-amber-300 mt-2">Batches Structured</span>
                        </div>

                        <!-- Step 6: Execution -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[9px] z-10">○</div>
                            <span class="text-gray-400 font-medium mt-2">Execution</span>
                        </div>

                        <!-- Step 7: Delivery -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[9px] z-10">○</div>
                            <span class="text-gray-400 font-medium mt-2">Delivery</span>
                        </div>

                        <!-- Step 8: Fulfilled -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[9px] z-10">○</div>
                            <span class="text-gray-400 font-medium mt-2">Fulfilled</span>
                        </div>

                    </div>
                </div>

                <!-- 06. Progress Breakdown -->
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-3 text-xs font-mono bg-white/5 p-3 rounded-lg border border-white/5">
                    <div>
                        <div class="text-[9px] text-gray-400 uppercase">1. REQUIRED CAPACITY</div>
                        <div class="font-bold text-white">1,000 HA</div>
                        <div class="text-[9px] text-emerald-400">Intake Complete</div>
                    </div>
                    <div>
                        <div class="text-[9px] text-gray-400 uppercase">2. MAPPED CAPACITY</div>
                        <div class="font-bold text-emerald-300">1,000 HA (100%)</div>
                        <div class="text-[9px] text-emerald-400">Regions Allocated</div>
                    </div>
                    <div>
                        <div class="text-[9px] text-gray-400 uppercase">3. EXECUTABLE BATCHES</div>
                        <div class="font-bold text-white">10 Batches (100 HA)</div>
                        <div class="text-[9px] text-emerald-400 font-bold">Structured</div>
                    </div>
                    <div>
                        <div class="text-[9px] text-gray-400 uppercase">4. VERIFICATION / EXECUTION</div>
                        <div class="font-bold text-amber-300">Pending Authorization</div>
                        <div class="text-[9px] text-amber-400">Next Stage</div>
                    </div>
                </div>
            </section>

            <!-- ---------- 07 & 08. CAPACITY ALLOCATION MAP & REGIONAL TABLE ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- Regional Map Box (7 cols) -->
                <div class="lg:col-span-7 <?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <h3 class="text-sm font-mono font-bold uppercase text-white">REGIONAL CAPACITY ALLOCATION MAP</h3>
                        <span class="text-xs font-mono text-emerald-400 font-bold">1,000 HA MAPPED</span>
                    </div>

                    <!-- Map Display Box -->
                    <div class="relative min-h-[220px] rounded-xl bg-black/50 border border-white/10 overflow-hidden p-4 flex flex-col justify-between font-mono">
                        <img src="<?= $basePrefix ?>/1.jpg" alt="Map overlay" class="absolute inset-0 w-full h-full object-cover opacity-20 blur-sm" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>

                        <div class="relative z-10 flex justify-between items-start text-xs">
                            <span class="bg-emerald-950 px-3 py-1 rounded text-emerald-300 border border-emerald-500/30 font-bold uppercase">DEMO REGION ALLOCATION</span>
                            <span class="text-gray-400 text-[10px]">INDONESIA REGIONS</span>
                        </div>

                        <!-- Region Badges Overlay -->
                        <div class="relative z-10 grid grid-cols-2 gap-3">
                            <div class="bg-[#091C13]/90 p-3 rounded-lg border border-emerald-500/40 space-y-1">
                                <div class="text-[10px] text-emerald-400 font-bold">NORTH KALIMANTAN</div>
                                <div class="text-xl font-extrabold text-white">350 HA</div>
                                <div class="text-[9px] text-gray-400">3 × 100 HA Batches + 50 HA Mapped</div>
                            </div>
                            <div class="bg-[#091C13]/90 p-3 rounded-lg border border-emerald-500/40 space-y-1">
                                <div class="text-[10px] text-emerald-400 font-bold">SOUTH KALIMANTAN</div>
                                <div class="text-xl font-extrabold text-white">650 HA</div>
                                <div class="text-[9px] text-gray-400">7 × 100 HA Batches + 50 HA Mapped</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Regional Allocation Table (5 cols) -->
                <div class="lg:col-span-5 <?= $card ?> p-5 space-y-3">
                    <div class="border-b border-white/10 pb-2.5 flex justify-between items-center">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">REGIONAL ALLOCATION BREAKDOWN</h3>
                        <a href="<?= $basePrefix ?>/capacity-mapping" class="text-[10px] font-mono text-emerald-400 hover:underline">CAPACITY MAPPING →</a>
                    </div>

                    <div class="overflow-x-auto text-xs font-mono">
                        <table class="w-full text-left">
                            <thead class="bg-white/5 text-gray-400 text-[9px] uppercase">
                                <tr>
                                    <th class="p-2">Region</th>
                                    <th class="p-2">Capacity</th>
                                    <th class="p-2">Batch Structure</th>
                                    <th class="p-2">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5 text-gray-200">
                                <tr>
                                    <td class="p-2 font-bold text-white">North Kalimantan</td>
                                    <td class="p-2 text-emerald-300 font-bold">350 HA</td>
                                    <td class="p-2">3 × 100 HA</td>
                                    <td class="p-2"><span class="text-emerald-400 bg-emerald-950 px-1.5 py-0.5 rounded text-[9px] font-bold">MAPPED</span></td>
                                </tr>
                                <tr>
                                    <td class="p-2 font-bold text-white">South Kalimantan</td>
                                    <td class="p-2 text-emerald-300 font-bold">650 HA</td>
                                    <td class="p-2">7 × 100 HA</td>
                                    <td class="p-2"><span class="text-emerald-400 bg-emerald-950 px-1.5 py-0.5 rounded text-[9px] font-bold">MAPPED</span></td>
                                </tr>
                                <tr class="bg-white/5 font-bold">
                                    <td class="p-2 text-white">Total Allocated</td>
                                    <td class="p-2 text-emerald-300">1,000 HA</td>
                                    <td class="p-2 text-white">10 Batches</td>
                                    <td class="p-2 text-emerald-400">100% COVERAGE</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <p class="text-[9px] text-gray-500 italic">
                        Standard batch unit is 100 HA. Capacity mapping represents mapped capacity layer.
                    </p>
                </div>

            </section>

            <!-- ---------- 09, 10 & 11. EXECUTABLE BATCH STRUCTURE & VALUE MODEL ---------- -->
            <section class="<?= $card ?> p-5 space-y-4">
                <div class="flex items-center justify-between border-b border-white/10 pb-3">
                    <div>
                        <h3 class="text-sm font-mono font-bold uppercase text-white">EXECUTABLE PRODUCTION BATCH STRUCTURE</h3>
                        <p class="text-[11px] text-gray-400">10 standardized 100 HA batches created for operational execution.</p>
                    </div>
                    <a href="<?= $basePrefix ?>/batches" class="text-xs font-mono text-emerald-400 hover:underline">VIEW ALL BATCHES →</a>
                </div>

                <!-- Batch Cards Grid (09) -->
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 text-xs font-mono">
                    <div class="bg-white/5 p-3 rounded-lg border border-emerald-500/30 space-y-1">
                        <div class="text-[9px] text-emerald-400 font-bold">BATCH NK-001</div>
                        <div class="font-bold text-white">100 HA</div>
                        <div class="text-[9px] text-gray-400">North Kalimantan</div>
                        <span class="inline-block text-[8px] text-emerald-300 bg-emerald-950 px-1 py-0.2 rounded mt-1">MAPPED</span>
                    </div>

                    <div class="bg-white/5 p-3 rounded-lg border border-emerald-500/30 space-y-1">
                        <div class="text-[9px] text-emerald-400 font-bold">BATCH NK-002</div>
                        <div class="font-bold text-white">100 HA</div>
                        <div class="text-[9px] text-gray-400">North Kalimantan</div>
                        <span class="inline-block text-[8px] text-emerald-300 bg-emerald-950 px-1 py-0.2 rounded mt-1">MAPPED</span>
                    </div>

                    <div class="bg-white/5 p-3 rounded-lg border border-emerald-500/30 space-y-1">
                        <div class="text-[9px] text-emerald-400 font-bold">BATCH NK-003</div>
                        <div class="font-bold text-white">100 HA</div>
                        <div class="text-[9px] text-gray-400">North Kalimantan</div>
                        <span class="inline-block text-[8px] text-emerald-300 bg-emerald-950 px-1 py-0.2 rounded mt-1">MAPPED</span>
                    </div>

                    <div class="bg-white/5 p-3 rounded-lg border border-emerald-500/30 space-y-1">
                        <div class="text-[9px] text-emerald-400 font-bold">BATCH SK-001</div>
                        <div class="font-bold text-white">100 HA</div>
                        <div class="text-[9px] text-gray-400">South Kalimantan</div>
                        <span class="inline-block text-[8px] text-emerald-300 bg-emerald-950 px-1 py-0.2 rounded mt-1">MAPPED</span>
                    </div>

                    <div class="bg-white/5 p-3 rounded-lg border border-emerald-500/30 space-y-1">
                        <div class="text-[9px] text-emerald-400 font-bold">BATCH SK-002</div>
                        <div class="font-bold text-white">100 HA</div>
                        <div class="text-[9px] text-gray-400">South Kalimantan</div>
                        <span class="inline-block text-[8px] text-emerald-300 bg-emerald-950 px-1 py-0.2 rounded mt-1">MAPPED</span>
                    </div>

                    <div class="bg-black/40 p-3 rounded-lg border border-white/10 flex flex-col justify-center items-center text-center">
                        <div class="font-bold text-gray-300 text-sm">+5 Batches</div>
                        <div class="text-[9px] text-gray-500">SK-003 to SK-007</div>
                    </div>
                </div>

                <!-- 10 & 11. Production Value Model & Minimum Allocation -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-white/5 p-4 rounded-xl border border-white/5 text-xs font-mono">
                    <div>
                        <div class="text-[9px] text-gray-400 uppercase">MODELED PRODUCTION VALUE</div>
                        <div class="text-xl font-extrabold text-emerald-300 mt-0.5">Rp150,000,000,000</div>
                        <div class="text-[9px] text-gray-400 mt-1">
                            Calculated as 10 batches × Rp15B modeled requirement per 100 HA batch. This is a modeled requirement parameter, not cash held.
                        </div>
                    </div>
                    <div>
                        <div class="text-[9px] text-gray-400 uppercase">MINIMUM PRODUCTION ALLOCATION UNIT</div>
                        <div class="text-xl font-extrabold text-white mt-0.5">Rp1,000,000,000</div>
                        <div class="text-[9px] text-gray-400 mt-1">
                            15 minimum allocation units per 100 HA production batch.
                        </div>
                    </div>
                </div>
            </section>

            <!-- ---------- 12, 13 & 14. DIAGRAM & COMMERCIAL SPECIFICATIONS ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- Requirement -> Batch -> Mitra Diagram (12) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-4">
                    <div class="border-b border-white/10 pb-2.5">
                        <div class="text-[9px] font-mono text-emerald-400 font-bold uppercase tracking-wider">DEMAND CONVERSION FLOW</div>
                        <h3 class="text-sm font-mono font-bold text-white">Requirement to Production Lifecycle</h3>
                    </div>

                    <div class="space-y-2 text-xs font-mono">
                        <div class="p-2.5 rounded bg-white/5 border border-white/10 flex items-center justify-between">
                            <span class="text-gray-300">BUYER REQUIREMENT</span>
                            <span class="font-bold text-white">1,000 HA</span>
                        </div>
                        <div class="text-center text-gray-500 font-bold text-xs">↓</div>
                        <div class="p-2.5 rounded bg-emerald-950/60 border border-emerald-500/40 flex items-center justify-between">
                            <span class="text-emerald-300 font-bold">CAPACITY MAPPING</span>
                            <span class="font-bold text-emerald-300">1,000 HA (100%)</span>
                        </div>
                        <div class="text-center text-gray-500 font-bold text-xs">↓</div>
                        <div class="p-2.5 rounded bg-white/5 border border-white/10 flex items-center justify-between">
                            <span class="text-gray-300">10 PRODUCTION BATCHES</span>
                            <span class="font-bold text-white">100 HA Each</span>
                        </div>
                        <div class="text-center text-gray-500 font-bold text-xs">↓</div>
                        <div class="p-2.5 rounded bg-white/5 border border-white/10 flex items-center justify-between">
                            <span class="text-gray-300">PRODUCTION ALLOCATIONS</span>
                            <span class="font-bold text-emerald-300">Rp1B Min Unit</span>
                        </div>
                    </div>
                </div>

                <!-- Commercial Product Specification (13 & 14) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-3">
                    <div class="border-b border-white/10 pb-2.5 flex justify-between items-center">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">COMMERCIAL PRODUCT SPECIFICATIONS</h3>
                        <span class="text-[9px] font-mono text-amber-300 bg-amber-950 px-2 py-0.5 rounded border border-amber-500/30">CONFIGURABLE</span>
                    </div>

                    <div class="grid grid-cols-2 gap-3 text-xs font-mono">
                        <div class="bg-black/40 p-2.5 rounded border border-white/5">
                            <div class="text-[9px] text-gray-400">PRODUCT FORM</div>
                            <div class="font-bold text-white mt-0.5">CPO / RBD / Other</div>
                        </div>
                        <div class="bg-black/40 p-2.5 rounded border border-white/5">
                            <div class="text-[9px] text-gray-400">QUALITY STANDARD</div>
                            <div class="font-bold text-white mt-0.5">Buyer-Specific</div>
                        </div>
                        <div class="bg-black/40 p-2.5 rounded border border-white/5">
                            <div class="text-[9px] text-gray-400">PLANTING DENSITY</div>
                            <div class="font-bold text-emerald-300 mt-0.5">143 Trees / HA</div>
                        </div>
                        <div class="bg-black/40 p-2.5 rounded border border-white/5">
                            <div class="text-[9px] text-gray-400">DELIVERY FREQUENCY</div>
                            <div class="font-bold text-white mt-0.5">Buyer Configurable</div>
                        </div>
                    </div>
                </div>

            </section>

            <!-- ---------- 16, 19 & 20. COMMERCIAL DOCUMENTS, COVERAGE BAR & DIRECTORY TABLE ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- 16. Buyer Requirement Documents (4 cols) -->
                <div class="lg:col-span-4 <?= $card ?> p-5 space-y-3">
                    <div class="border-b border-white/10 pb-2 flex justify-between items-center">
                        <h4 class="text-xs font-mono font-bold uppercase text-white">COMMERCIAL DOCUMENTS</h4>
                        <a href="<?= $basePrefix ?>/documents" class="text-[10px] font-mono text-emerald-400 hover:underline">DOC CENTER →</a>
                    </div>

                    <div class="space-y-1.5 text-xs font-mono">
                        <div class="flex justify-between items-center text-gray-300">
                            <span>Production Requirement</span>
                            <span class="text-emerald-400 font-bold">DR-2026-001</span>
                        </div>
                        <div class="flex justify-between items-center text-gray-400">
                            <span>Buyer Specification</span>
                            <span class="text-amber-300">PENDING</span>
                        </div>
                        <div class="flex justify-between items-center text-gray-400">
                            <span>Commercial Terms</span>
                            <span class="text-amber-300">PENDING</span>
                        </div>
                        <div class="flex justify-between items-center text-gray-400">
                            <span>Offtake Agreement</span>
                            <span class="text-gray-500">NOT SUBMITTED</span>
                        </div>
                        <div class="flex justify-between items-center text-gray-400">
                            <span>Delivery & Acceptance Spec</span>
                            <span class="text-gray-500">PENDING</span>
                        </div>
                    </div>
                </div>

                <!-- 19 & 20. Coverage Visual Bar & Requirement Directory (8 cols) -->
                <div class="lg:col-span-8 <?= $card ?> p-5 space-y-4">
                    <div class="border-b border-white/10 pb-2.5 flex justify-between items-center">
                        <div>
                            <div class="text-[9px] font-mono text-emerald-400 font-bold uppercase tracking-wider">REQUIREMENT FULFILMENT TRACKER</div>
                            <h4 class="text-xs font-mono font-bold text-white uppercase">Capacity Coverage vs Execution</h4>
                        </div>
                        <span class="text-emerald-400 font-mono text-xs font-bold">1,000 HA MAPPED</span>
                    </div>

                    <!-- Visual Bar Coverage (19) -->
                    <div class="space-y-2 text-xs font-mono">
                        <div class="space-y-1">
                            <div class="flex justify-between text-[10px] text-gray-300">
                                <span>REQUIRED: <strong class="text-white">1,000 HA</strong></span>
                                <span>MAPPED: <strong class="text-emerald-300">1,000 HA (100%)</strong></span>
                            </div>
                            <div class="w-full bg-white/10 rounded-full h-2 overflow-hidden flex">
                                <div class="bg-emerald-400 h-full" style="width: 100%"></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-2 text-[9px] pt-1">
                            <div class="bg-white/5 p-2 rounded text-gray-400">
                                <span>Verified Capacity:</span> <strong class="text-amber-300 block">Pending</strong>
                            </div>
                            <div class="bg-white/5 p-2 rounded text-gray-400">
                                <span>Executed Harvest:</span> <strong class="text-gray-400 block">0 HA</strong>
                            </div>
                            <div class="bg-white/5 p-2 rounded text-gray-400">
                                <span>Delivered Output:</span> <strong class="text-gray-400 block">0 HA</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Directory Table (20) -->
                    <div class="overflow-x-auto pt-1">
                        <table class="w-full text-left text-xs font-mono">
                            <thead class="bg-white/5 text-gray-400 text-[9px] uppercase">
                                <tr>
                                    <th class="p-2">Requirement ID</th>
                                    <th class="p-2">Buyer Entity</th>
                                    <th class="p-2">Required</th>
                                    <th class="p-2">Mapped</th>
                                    <th class="p-2">Batches</th>
                                    <th class="p-2">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5 text-gray-200">
                                <tr>
                                    <td class="p-2 font-bold text-emerald-300">DR-2026-001</td>
                                    <td class="p-2">Demo Offtake Buyer</td>
                                    <td class="p-2 font-bold text-white">1,000 HA</td>
                                    <td class="p-2 text-emerald-300">1,000 HA</td>
                                    <td class="p-2">10 Batches</td>
                                    <td class="p-2"><span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30 uppercase">MAPPED</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>

            <!-- ---------- 23, 24 & 29. OPERATIONAL READINESS & EXCEPTION MANAGEMENT ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- Execution Readiness (6 cols) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-3">
                    <div class="border-b border-white/10 pb-2.5 flex justify-between items-center">
                        <h4 class="text-xs font-mono font-bold uppercase text-white">PRODUCTION READINESS CHECKLIST</h4>
                        <span class="text-amber-300 font-mono text-[10px] font-bold">2 / 8 READY</span>
                    </div>

                    <div class="grid grid-cols-2 gap-2 text-xs font-mono">
                        <div class="flex items-center gap-1.5 text-emerald-300"><span>✓</span> Requirement defined</div>
                        <div class="flex items-center gap-1.5 text-emerald-300"><span>✓</span> Capacity mapped</div>
                        <div class="flex items-center gap-1.5 text-gray-400"><span>○</span> Partner verified</div>
                        <div class="flex items-center gap-1.5 text-gray-400"><span>○</span> Land verified</div>
                        <div class="flex items-center gap-1.5 text-gray-400"><span>○</span> RAB approved</div>
                        <div class="flex items-center gap-1.5 text-gray-400"><span>○</span> Vendors assigned</div>
                        <div class="flex items-center gap-1.5 text-gray-400"><span>○</span> Work orders issued</div>
                        <div class="flex items-center gap-1.5 text-gray-400"><span>○</span> Execution started</div>
                    </div>
                </div>

                <!-- Exception Management Panel (29) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-3">
                    <div class="border-b border-white/10 pb-2.5">
                        <div class="text-[9px] font-mono text-amber-400 uppercase font-bold">CONTROL SYSTEM</div>
                        <h4 class="text-xs font-mono font-bold text-white uppercase">Requirement Exceptions</h4>
                    </div>

                    <div class="space-y-2 text-xs font-mono">
                        <div class="bg-white/5 p-2 rounded flex justify-between items-center">
                            <div>
                                <div class="font-bold text-white text-[11px]">Partner Verification Delay</div>
                                <div class="text-[9px] text-gray-400">Verification pending for North Kalimantan partner</div>
                            </div>
                            <a href="<?= $basePrefix ?>/verification" class="text-[10px] text-emerald-400 font-bold hover:underline">VIEW CONTROL →</a>
                        </div>

                        <div class="bg-white/5 p-2 rounded flex justify-between items-center">
                            <div>
                                <div class="font-bold text-white text-[11px]">Work Order Execution Pending</div>
                                <div class="text-[9px] text-gray-400">WO-NK-001-M1-001 awaiting authorization</div>
                            </div>
                            <a href="<?= $basePrefix ?>/milestones" class="text-[10px] text-emerald-400 font-bold hover:underline">VIEW WORK ORDER →</a>
                        </div>
                    </div>
                </div>

            </section>

            <!-- ---------- 30. REQUIREMENT AUDIT TRAIL ---------- -->
            <section class="<?= $card ?> p-5 space-y-3">
                <div class="border-b border-white/10 pb-2.5 flex justify-between items-center">
                    <div>
                        <div class="text-[9px] font-mono text-emerald-400 font-bold uppercase tracking-wider">IMMUTABLE LOG</div>
                        <h4 class="text-xs font-mono font-bold text-white uppercase">Requirement Audit Trail</h4>
                    </div>
                    <span class="text-[10px] font-mono text-gray-400">RECORD ID: DR-2026-001</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-6 gap-2 font-mono text-[10px]">
                    <div class="bg-white/5 p-2 rounded border border-white/5 space-y-1">
                        <span class="text-emerald-400 font-bold">1. DR Created</span>
                        <div class="text-[9px] text-gray-400">Requirement DR-2026-001 defined</div>
                    </div>
                    <div class="bg-white/5 p-2 rounded border border-white/5 space-y-1">
                        <span class="text-emerald-400 font-bold">2. Mapping Initiated</span>
                        <div class="text-[9px] text-gray-400">1,000 HA target capacity set</div>
                    </div>
                    <div class="bg-white/5 p-2 rounded border border-white/5 space-y-1">
                        <span class="text-emerald-400 font-bold">3. 350 HA Mapped</span>
                        <div class="text-[9px] text-gray-400">North Kalimantan region</div>
                    </div>
                    <div class="bg-white/5 p-2 rounded border border-white/5 space-y-1">
                        <span class="text-emerald-400 font-bold">4. 650 HA Mapped</span>
                        <div class="text-[9px] text-gray-400">South Kalimantan region</div>
                    </div>
                    <div class="bg-white/5 p-2 rounded border border-white/5 space-y-1">
                        <span class="text-emerald-300 font-bold">5. 100% Coverage</span>
                        <div class="text-[9px] text-gray-400">10 x 100 HA batches created</div>
                    </div>
                    <div class="bg-white/5 p-2 rounded border border-white/5 space-y-1">
                        <span class="text-amber-300 font-bold">6. Verification Pending</span>
                        <div class="text-[9px] text-amber-400 font-bold">Control audit active</div>
                    </div>
                </div>
            </section>

            <!-- ---------- 33 & 34. IMPORTANT DATA DISTINCTION & 24-MONTH SCALE VIEW ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- 33. Data Distinction Notice (6 cols) -->
                <div class="lg:col-span-6 rounded-xl border border-emerald-500/30 bg-emerald-950/30 p-5 font-mono text-xs space-y-2">
                    <div class="font-bold text-emerald-300 text-[10px] uppercase">IMPORTANT NINA DATA PRINCIPLE</div>
                    <div class="text-white font-bold text-sm">Requirement coverage ≠ Production completion.</div>
                    <div class="grid grid-cols-3 gap-2 text-[10px] pt-1">
                        <div class="bg-black/40 p-2 rounded border border-white/5">
                            <span class="text-emerald-300 font-bold">MAPPED:</span> Capacity associated with requirement.
                        </div>
                        <div class="bg-black/40 p-2 rounded border border-white/5">
                            <span class="text-amber-300 font-bold">VERIFIED:</span> Controls completed.
                        </div>
                        <div class="bg-black/40 p-2 rounded border border-white/5">
                            <span class="text-gray-300 font-bold">DELIVERED:</span> Physical product delivered.
                        </div>
                    </div>
                    <p class="text-[9px] text-gray-400 italic pt-1">
                        "1,000 HA mapped ≠ 1,000 HA produced ≠ 1,000 HA delivered."
                    </p>
                </div>

                <!-- 34. 24-Month Pipeline Scale View (6 cols) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-2 font-mono text-xs">
                    <div class="text-[9px] text-emerald-400 font-bold uppercase">24-MONTH DEMAND PIPELINE TARGET</div>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-extrabold text-white">10,000 HA</span>
                        <span class="text-emerald-300 font-bold">100 Production Batches</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-[10px] pt-1">
                        <div class="bg-white/5 p-2 rounded">
                            <span class="text-gray-400">Modeled Value:</span> <strong class="text-white">Rp1.5T</strong>
                        </div>
                        <div class="bg-white/5 p-2 rounded">
                            <span class="text-gray-400">Gross Fee (3%):</span> <strong class="text-emerald-300">Rp45B</strong>
                        </div>
                    </div>
                    <p class="text-[9px] text-gray-500 italic">Target model scenario only.</p>
                </div>

            </section>

            <!-- ---------- 35 & 37. BOTTOM HERO & PRIMARY CTA ---------- -->
            <section class="rounded-2xl border border-emerald-500/40 bg-gradient-to-r from-[#04100B] via-[#091D13] to-[#04100B] p-6 text-center space-y-4 shadow-2xl">
                <div class="max-w-3xl mx-auto space-y-2">
                    <h3 class="text-2xl font-extrabold text-white">Turn Demand Into Production Capacity.</h3>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        NINA starts with demand — then turns that demand into capacity, executable production batches and traceable commercial delivery.
                    </p>
                    <p class="text-[11px] text-emerald-400 italic">
                        NINA memulai dari kebutuhan nyata, lalu menerjemahkannya menjadi kapasitas produksi, batch yang dapat dieksekusi, dan delivery komersial yang dapat ditelusuri.
                    </p>
                </div>

                <div class="flex flex-wrap items-center justify-center gap-3 font-mono text-xs font-bold pt-2">
                    <a href="<?= $basePrefix ?>/demand" class="rounded-lg bg-emerald-500 hover:bg-emerald-400 text-black px-5 py-2.5 uppercase shadow-lg">
                        CREATE PRODUCTION REQUIREMENT
                    </a>
                    <a href="<?= $basePrefix ?>/explore" class="rounded-lg bg-white/10 hover:bg-white/20 text-white border border-white/10 px-5 py-2.5 uppercase">
                        EXPLORE PRODUCTION PROJECTS
                    </a>
                    <a href="<?= $basePrefix ?>/production-network" class="rounded-lg bg-white/10 hover:bg-white/20 text-white border border-white/10 px-5 py-2.5 uppercase">
                        VIEW NETWORK
                    </a>
                </div>
            </section>

        </div>

    </div>

</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/dashboard.php';