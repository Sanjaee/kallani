<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$constants = $config['system_constants'] ?? [];
$demoDemand = $config['demo_demands'][0] ?? [];
$title = '16 / Batch Completion & Settlement — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'completion';

/* ---------- Helpers & Icons ---------- */
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

$svg = fn(string $inner, string $cls = 'w-4 h-4') =>
    '<svg class="' . $cls . '" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">' . $inner . '</svg>';

$ic = [
    'target'    => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.5"/>',
    'leaf'      => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>',
    'truck'     => '<rect x="1" y="3" width="15" height="13" rx="2"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>',
    'scale'     => '<path d="M12 3v18M3 7l9-4 9 4M3 7l3 9a3 3 0 0 0 6 0L9 7M15 7l3 9a3 3 0 0 0 6 0l-3-9"/>',
    'factory'   => '<path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V4H2z"/>',
    'box'       => '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>',
    'check'     => '<circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 4.5-5"/>',
    'shield'    => '<path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/>',
    'clock'     => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>',
    'doc'       => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>',
    'chevron'   => '<path d="M9 18l6-6-6-6"/>',
    'arrow'     => '<path d="M5 12h14M12 5l7 7-7 7"/>',
    'dollar'    => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>',
    'lock'      => '<rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
    'download'  => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>',
];

$card      = 'rounded-xl border border-white/10 bg-[#0B1815]/90 shadow-xl';
$iconBox   = 'flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-emerald-300';
$metricLbl = 'text-[9px] font-mono font-medium uppercase tracking-wider text-gray-400';

ob_start();
?>

<div class="relative w-full font-sans">

    <!-- PAGE BACKGROUND (soft blurred forest background) -->
    <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden">
        <img src="<?= $basePrefix ?>/1.jpg" alt="" class="h-full w-full scale-110 object-cover opacity-25 blur-md" />
        <div class="absolute inset-0 bg-gradient-to-b from-[#06120F]/60 via-[#06120F]/85 to-[#04100B]"></div>
    </div>

    <div class="relative z-10">

        <!-- ================= 01. PAGE HEADER & HERO SECTION ================= -->
        <section class="relative overflow-hidden shadow-2xl" style="border-bottom: none !important;">
            <img src="<?= $basePrefix ?>/1.jpg" alt="Natural forest canopy" class="absolute inset-0 h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#050D07]/90 via-[#050D07]/60 to-[#050D07]/20"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#06120F]/90 via-transparent to-transparent"></div>

            <div class="relative space-y-4 px-6 pt-3 pb-6 lg:px-8 lg:pt-3 lg:pb-8">

                <!-- Top Row: Breadcrumb & Right Header Actions -->
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <nav aria-label="Breadcrumb" class="inline-flex flex-wrap items-center gap-2 text-[10px] font-mono font-semibold uppercase tracking-[0.14em] text-gray-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                        <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors">NINA</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors">PRODUCTION</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/batches" class="hover:text-white transition-colors">BATCHES</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/batches" class="hover:text-white transition-colors">NK-001</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="font-bold text-white uppercase">COMPLETION</span>
                    </nav>

                    <div class="flex flex-wrap items-center gap-2 text-[10px] font-bold">
                        <a href="<?= $basePrefix ?>/commercial-output" class="rounded-lg bg-emerald-950/80 border border-emerald-400/40 px-3 py-1.5 text-emerald-300 hover:bg-emerald-900/80 uppercase tracking-wide flex items-center gap-1.5">
                            <span>VIEW COMMERCIAL OUTPUT</span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="<?= $basePrefix ?>/verification" class="rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10 uppercase tracking-wide">VERIFICATION VAULT</a>
                        <a href="<?= $basePrefix ?>/audit-trail" class="rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10 uppercase tracking-wide">AUDIT TRAIL</a>
                    </div>
                </div>

                <!-- Headline & Subheadline Grid -->
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 items-center">
                    <div class="space-y-2 lg:col-span-8">
                        <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-200">
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">COMMERCIAL SETTLEMENT & CLOSURE</span>
                            <span>16 / BATCH COMPLETION & SETTLEMENT</span>
                        </div>

                        <h1 class="max-w-3xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">Complete the Production Cycle.</h1>
                        
                        <p class="max-w-3xl text-sm font-medium leading-relaxed text-gray-200">
                            From verified delivery to commercial settlement, every completed production batch is closed with documented output, transaction records, verification evidence and an auditable completion report.
                        </p>
                    </div>

                    <!-- Right Side Hero Status Card -->
                    <div class="lg:col-span-4">
                        <div class="space-y-3 rounded-xl border border-white/15 bg-[#08130F]/80 p-4 shadow-2xl backdrop-blur-xl">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-mono font-bold text-emerald-300">BATCH NK-001</span>
                                <span class="rounded bg-amber-950 border border-amber-500/30 px-2 py-0.5 text-[9px] font-bold text-amber-300">DEMO / SIMULATED</span>
                            </div>
                            <div class="text-xs font-bold text-white">North Kalimantan Palm (100 HA)</div>
                            <div class="flex items-center justify-between text-[11px] font-mono border-t border-white/10 pt-2">
                                <span class="text-gray-400">Current Status:</span>
                                <strong class="text-amber-300 font-bold uppercase">SETTLEMENT PENDING</strong>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ================= CONTENT WRAPPER ================= -->
        <div class="space-y-6 px-4 pb-16 pt-6 sm:px-6 lg:px-8">

            <!-- ---------- 02. TOP STATUS STRIP (5 KPI CARDS) ---------- -->
            <section class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5">

                <!-- CARD 01: PRODUCTION -->
                <div class="<?= $card ?> flex items-center gap-3 px-3.5 py-3">
                    <span class="<?= $iconBox ?> text-emerald-400"><?= $svg($ic['leaf']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">PRODUCTION</div>
                        <div class="text-base font-extrabold text-white">100 HA</div>
                        <div class="text-[8px] text-emerald-300 font-mono">Completed / Pending Final</div>
                    </div>
                </div>

                <!-- CARD 02: HARVEST -->
                <div class="<?= $card ?> flex items-center gap-3 px-3.5 py-3">
                    <span class="<?= $iconBox ?> text-emerald-400"><?= $svg($ic['target']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">HARVEST</div>
                        <div class="text-sm font-bold text-emerald-300 uppercase">RECORDED</div>
                        <div class="text-[8px] text-amber-300 font-mono">Verified Output Pending</div>
                    </div>
                </div>

                <!-- CARD 03: PROCESSING -->
                <div class="<?= $card ?> flex items-center gap-3 px-3.5 py-3">
                    <span class="<?= $iconBox ?> text-emerald-400"><?= $svg($ic['factory']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">PROCESSING</div>
                        <div class="text-sm font-bold text-emerald-300 uppercase">COMPLETED</div>
                        <div class="text-[8px] text-gray-400 font-mono">Product Record Created</div>
                    </div>
                </div>

                <!-- CARD 04: DELIVERY -->
                <div class="<?= $card ?> flex items-center gap-3 px-3.5 py-3">
                    <span class="<?= $iconBox ?> text-emerald-400"><?= $svg($ic['truck']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">DELIVERY</div>
                        <div class="text-sm font-bold text-emerald-300 uppercase">ACCEPTED</div>
                        <div class="text-[8px] text-gray-400 font-mono">Commercial Acceptance</div>
                    </div>
                </div>

                <!-- CARD 05: SETTLEMENT -->
                <div class="<?= $card ?> flex items-center gap-3 px-3.5 py-3">
                    <span class="<?= $iconBox ?> text-amber-400"><?= $svg($ic['dollar']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">SETTLEMENT</div>
                        <div class="text-sm font-bold text-amber-300 uppercase">PENDING</div>
                        <div class="text-[8px] text-gray-400 font-mono">Awaiting Final Conditions</div>
                    </div>
                </div>

            </section>

            <!-- ---------- 03. BATCH COMPLETION TIMELINE ---------- -->
            <section class="<?= $card ?> p-5 space-y-4">
                <div class="flex items-center justify-between border-b border-white/10 pb-3">
                    <div>
                        <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-white">03 / BATCH COMPLETION TIMELINE</h3>
                        <p class="text-[10px] text-gray-400">Sequential verification & lifecycle closure stages</p>
                    </div>
                    <div class="flex items-center gap-3 text-[9px] font-mono text-gray-300">
                        <span class="flex items-center gap-1"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> Verified</span>
                        <span class="flex items-center gap-1"><span class="h-2 w-2 rounded-full bg-amber-400"></span> Pending</span>
                        <span class="flex items-center gap-1"><span class="h-2 w-2 rounded-full bg-gray-600"></span> Locked</span>
                    </div>
                </div>

                <!-- Precision Horizontal Node-and-Line Stepper Flow -->
                <div class="overflow-x-auto pb-3 pt-2 scrollbar-none border-b border-white/10 mb-3">
                    <div class="min-w-[850px] grid grid-cols-9 font-mono text-[9px] relative px-2">
                        
                        <!-- Step 1: Production -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-emerald-500 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-emerald-500 text-black flex items-center justify-center font-bold text-[10px] shadow-md shadow-emerald-950 z-10">✓</div>
                            <span class="font-bold text-white mt-1.5">Production</span>
                            <span class="text-[8px] text-emerald-300">Verified</span>
                        </div>

                        <!-- Step 2: Harvest -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-emerald-500 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-emerald-500 text-black flex items-center justify-center font-bold text-[10px] shadow-md shadow-emerald-950 z-10">✓</div>
                            <span class="font-bold text-white mt-1.5">Harvest</span>
                            <span class="text-[8px] text-emerald-300">Verified</span>
                        </div>

                        <!-- Step 3: Weighing -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-emerald-500 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-emerald-500 text-black flex items-center justify-center font-bold text-[10px] shadow-md shadow-emerald-950 z-10">✓</div>
                            <span class="font-bold text-white mt-1.5">Weighing</span>
                            <span class="text-[8px] text-emerald-300">Verified</span>
                        </div>

                        <!-- Step 4: Processing -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-emerald-500 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-emerald-500 text-black flex items-center justify-center font-bold text-[10px] shadow-md shadow-emerald-950 z-10">✓</div>
                            <span class="font-bold text-white mt-1.5">Processing</span>
                            <span class="text-[8px] text-emerald-300">Verified</span>
                        </div>

                        <!-- Step 5: Product -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-emerald-500 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-emerald-500 text-black flex items-center justify-center font-bold text-[10px] shadow-md shadow-emerald-950 z-10">✓</div>
                            <span class="font-bold text-white mt-1.5">Product</span>
                            <span class="text-[8px] text-emerald-300">Verified</span>
                        </div>

                        <!-- Step 6: Delivery -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-emerald-500 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-emerald-500 text-black flex items-center justify-center font-bold text-[10px] shadow-md shadow-emerald-950 z-10">✓</div>
                            <span class="font-bold text-white mt-1.5">Delivery</span>
                            <span class="text-[8px] text-emerald-300">Verified</span>
                        </div>

                        <!-- Step 7: Acceptance -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-gradient-to-r from-emerald-500 to-amber-500 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-emerald-500 text-black flex items-center justify-center font-bold text-[10px] shadow-md shadow-emerald-950 z-10">✓</div>
                            <span class="font-bold text-white mt-1.5">Acceptance</span>
                            <span class="text-[8px] text-emerald-300">Verified</span>
                        </div>

                        <!-- Step 8: Settlement -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-amber-500 text-black flex items-center justify-center font-bold text-[10px] ring-4 ring-amber-500/20 shadow-md z-10">●</div>
                            <span class="font-bold text-amber-300 mt-1.5">Settlement</span>
                            <span class="text-[8px] text-amber-300">Pending</span>
                        </div>

                        <!-- Step 9: Batch Closure -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[9px] z-10">🔒</div>
                            <span class="text-gray-400 font-medium mt-1.5">Closure</span>
                            <span class="text-[8px] text-gray-500">Locked</span>
                        </div>

                    </div>
                </div>

                <!-- Horizontal Step Grid Cards -->
                <div class="grid grid-cols-3 gap-2 sm:grid-cols-5 lg:grid-cols-9 text-center text-xs font-mono pt-1">
                    
                    <div class="rounded-lg border border-emerald-500/40 bg-emerald-950/60 p-2 space-y-1">
                        <div class="text-[8px] text-gray-400">01 STAGE</div>
                        <div class="font-bold text-white text-[11px]">Production</div>
                        <div class="text-[9px] text-emerald-300 font-bold">VERIFIED ✓</div>
                    </div>

                    <div class="rounded-lg border border-emerald-500/40 bg-emerald-950/60 p-2 space-y-1">
                        <div class="text-[8px] text-gray-400">02 STAGE</div>
                        <div class="font-bold text-white text-[11px]">Harvest</div>
                        <div class="text-[9px] text-emerald-300 font-bold">VERIFIED ✓</div>
                    </div>

                    <div class="rounded-lg border border-emerald-500/40 bg-emerald-950/60 p-2 space-y-1">
                        <div class="text-[8px] text-gray-400">03 STAGE</div>
                        <div class="font-bold text-white text-[11px]">Weighing</div>
                        <div class="text-[9px] text-emerald-300 font-bold">VERIFIED ✓</div>
                    </div>

                    <div class="rounded-lg border border-emerald-500/40 bg-emerald-950/60 p-2 space-y-1">
                        <div class="text-[8px] text-gray-400">04 STAGE</div>
                        <div class="font-bold text-white text-[11px]">Processing</div>
                        <div class="text-[9px] text-emerald-300 font-bold">VERIFIED ✓</div>
                    </div>

                    <div class="rounded-lg border border-emerald-500/40 bg-emerald-950/60 p-2 space-y-1">
                        <div class="text-[8px] text-gray-400">05 STAGE</div>
                        <div class="font-bold text-white text-[11px]">Product</div>
                        <div class="text-[9px] text-emerald-300 font-bold">VERIFIED ✓</div>
                    </div>

                    <div class="rounded-lg border border-emerald-500/40 bg-emerald-950/60 p-2 space-y-1">
                        <div class="text-[8px] text-gray-400">06 STAGE</div>
                        <div class="font-bold text-white text-[11px]">Delivery</div>
                        <div class="text-[9px] text-emerald-300 font-bold">VERIFIED ✓</div>
                    </div>

                    <div class="rounded-lg border border-emerald-500/40 bg-emerald-950/60 p-2 space-y-1">
                        <div class="text-[8px] text-gray-400">07 STAGE</div>
                        <div class="font-bold text-white text-[11px]">Acceptance</div>
                        <div class="text-[9px] text-emerald-300 font-bold">VERIFIED ✓</div>
                    </div>

                    <div class="rounded-lg border border-amber-500/40 bg-amber-950/60 p-2 space-y-1">
                        <div class="text-[8px] text-gray-400">08 STAGE</div>
                        <div class="font-bold text-white text-[11px]">Settlement</div>
                        <div class="text-[9px] text-amber-300 font-bold">PENDING</div>
                    </div>

                    <div class="rounded-lg border border-white/10 bg-white/5 p-2 space-y-1 opacity-75">
                        <div class="text-[8px] text-gray-400">09 STAGE</div>
                        <div class="font-bold text-gray-300 text-[11px]">Closure</div>
                        <div class="text-[9px] text-gray-400 font-bold">LOCKED 🔒</div>
                    </div>

                </div>
            </section>

            <!-- ---------- 04. COMMERCIAL OUTPUT SUMMARY & 05. MODEL VS ACTUAL ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                <!-- 04 / COMMERCIAL OUTPUT SUMMARY -->
                <div class="<?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">04 / COMMERCIAL OUTPUT SUMMARY</h3>
                            <p class="text-[10px] text-gray-400">Verified commercial output recorded from physical execution</p>
                        </div>
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">VERIFIED CHAIN</span>
                    </div>

                    <div class="space-y-1.5 text-xs font-mono">
                        <div class="flex justify-between border-b border-white/5 py-1"><span class="text-gray-400">Batch ID</span><span class="text-white font-bold">NK-001</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span class="text-gray-400">Production Area</span><span class="text-white">100 HA</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span class="text-gray-400">Harvest Record</span><span class="text-emerald-300">HARV-NK-001-001</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span class="text-gray-400">Weighing Record</span><span class="text-emerald-300">WGH-NK-001-001</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span class="text-gray-400">Processing Record</span><span class="text-emerald-300">PROC-NK-001-001</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span class="text-gray-400">Product Record</span><span class="text-emerald-300">PROD-NK-001-001</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span class="text-gray-400">Delivery Record</span><span class="text-emerald-300">DEL-NK-001-001</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span class="text-gray-400">Buyer Requirement</span><span class="text-white font-bold">DR-2026-001</span></div>
                        <div class="flex justify-between py-1"><span class="text-gray-400">Commercial Status</span><span class="text-emerald-300 font-bold">ACCEPTED / DEMO</span></div>
                    </div>

                    <a href="<?= $basePrefix ?>/commercial-output" class="inline-flex items-center gap-1.5 rounded bg-white/5 border border-white/10 px-3 py-1.5 text-[10px] font-mono font-bold text-gray-300 hover:bg-white/10 transition">
                        <span>VIEW FULL OUTPUT RECORD</span><?= $svg($ic['arrow'], 'w-3 h-3') ?>
                    </a>
                </div>

                <!-- 05 / MODEL VS ACTUAL -->
                <div class="<?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">05 / MODELLED CAPACITY VS VERIFIED ACTUAL</h3>
                            <p class="text-[10px] text-gray-400">Institutional distinction between benchmark & physical output</p>
                        </div>
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300">DISTINCTION</span>
                    </div>

                    <div class="grid grid-cols-2 gap-3 text-xs font-mono">
                        <!-- Model Column -->
                        <div class="rounded-lg border border-emerald-500/30 bg-emerald-950/40 p-3 space-y-2">
                            <span class="text-[9px] font-bold text-emerald-300 uppercase block border-b border-emerald-500/20 pb-1">MODEL (Benchmark)</span>
                            <div class="flex justify-between text-[11px]"><span class="text-gray-400">TBS Yield:</span><strong class="text-white">18.00 T/HA/YR</strong></div>
                            <div class="flex justify-between text-[11px]"><span class="text-gray-400">Model TBS:</span><strong class="text-emerald-300">1,800 T/YR</strong></div>
                            <div class="flex justify-between text-[11px]"><span class="text-gray-400">OER:</span><strong class="text-white">22%</strong></div>
                            <div class="flex justify-between text-[11px]"><span class="text-gray-400">Model CPO:</span><strong class="text-emerald-300">396 T/YR</strong></div>
                            <div class="text-[8px] text-gray-400 italic pt-1 border-t border-emerald-500/20">Modelled capacity only. Not a guaranteed outcome.</div>
                        </div>

                        <!-- Actual Column -->
                        <div class="rounded-lg border border-amber-500/30 bg-amber-950/40 p-3 space-y-2">
                            <span class="text-[9px] font-bold text-amber-300 uppercase block border-b border-amber-500/20 pb-1">ACTUAL (Verified)</span>
                            <div class="flex justify-between text-[11px]"><span class="text-gray-400">Actual Harvest:</span><strong class="text-amber-300">—</strong></div>
                            <div class="flex justify-between text-[11px]"><span class="text-gray-400">Actual TBS:</span><strong class="text-amber-300">—</strong></div>
                            <div class="flex justify-between text-[11px]"><span class="text-gray-400">Processing Output:</span><strong class="text-amber-300">—</strong></div>
                            <div class="flex justify-between text-[11px]"><span class="text-gray-400">Verified Quantity:</span><strong class="text-amber-300">—</strong></div>
                            <div class="text-[8px] text-gray-400 italic pt-1 border-t border-amber-500/20">Actual values available post-field weighing.</div>
                        </div>
                    </div>
                </div>

            </section>

            <!-- ---------- 06. COMMERCIAL ACCEPTANCE & 07. SETTLEMENT CENTER ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                <!-- 06 / COMMERCIAL ACCEPTANCE RECORD -->
                <div class="<?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">06 / COMMERCIAL ACCEPTANCE</h3>
                            <p class="text-[10px] text-gray-400">Buyer verification & delivery acceptance log</p>
                        </div>
                        <span class="rounded bg-amber-950 px-2 py-0.5 text-[9px] font-bold text-amber-300 border border-amber-500/30">PENDING / DEMO</span>
                    </div>

                    <div class="space-y-2 text-xs font-mono">
                        <div class="flex justify-between"><span class="text-gray-400">Acceptance ID</span><span class="text-white font-bold">ACC-NK-001-001</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Buyer / Offtaker</span><span class="text-emerald-300 font-bold">Demo Offtake Buyer</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Product</span><span class="text-white">CPO / Palm Oil Product</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Acceptance Status</span><span class="text-emerald-300 font-bold">ACCEPTED / DEMO</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Acceptance Document</span><span class="text-amber-300">Pending Upload</span></div>
                    </div>

                    <div class="flex items-center justify-between text-[8px] font-mono text-gray-400 border-t border-white/10 pt-2">
                        <span class="px-1.5 py-0.5 rounded bg-white/5">NOT SUBMITTED</span> →
                        <span class="px-1.5 py-0.5 rounded bg-white/5">SUBMITTED</span> →
                        <span class="px-1.5 py-0.5 rounded bg-emerald-950 text-emerald-300 border border-emerald-500/30 font-bold">ACCEPTED</span> →
                        <span class="px-1.5 py-0.5 rounded bg-emerald-950 text-emerald-300 border border-emerald-500/30 font-bold">SETTLEMENT ELIGIBLE</span>
                    </div>
                </div>

                <!-- 07 / SETTLEMENT CENTER -->
                <div class="<?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">07 / COMMERCIAL SETTLEMENT</h3>
                            <p class="text-[10px] text-gray-400">Eligible post verified production, delivery & acceptance</p>
                        </div>
                        <span class="rounded bg-amber-950 px-2 py-0.5 text-[9px] font-bold text-amber-300 border border-amber-500/30">PENDING SETTLEMENT</span>
                    </div>

                    <div class="space-y-1.5 text-xs font-mono">
                        <div class="flex justify-between border-b border-white/5 py-1"><span>Production Verified</span><span class="text-emerald-300 font-bold">✓</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span>Harvest Verified</span><span class="text-emerald-300 font-bold">✓</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span>Weighing Verified</span><span class="text-emerald-300 font-bold">✓</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span>Processing Verified</span><span class="text-emerald-300 font-bold">✓</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span>Delivery Verified</span><span class="text-emerald-300 font-bold">✓</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span>Commercial Acceptance</span><span class="text-emerald-300 font-bold">✓</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span>Settlement Documentation</span><span class="text-amber-300 font-bold">Pending</span></div>
                        <div class="flex justify-between py-1"><span>Settlement Approval</span><span class="text-amber-300 font-bold">Pending</span></div>
                    </div>
                </div>

            </section>

            <!-- ---------- 08. SETTLEMENT FLOW & 09. REGISTERED RECIPIENT & 10. TRANSACTION RECORD ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-12">

                <!-- 08 / SETTLEMENT FLOW (4 cols) -->
                <div class="lg:col-span-4 <?= $card ?> p-5 space-y-3">
                    <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">08 / SETTLEMENT FLOW</h3>
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] text-emerald-300">GOVERNANCE</span>
                    </div>
                    <div class="space-y-1 text-[9px] font-mono text-gray-300">
                        <div class="p-1 rounded bg-white/5">1. VERIFIED OUTPUT ✓</div>
                        <div class="p-1 rounded bg-white/5">2. COMMERCIAL ACCEPTANCE ✓</div>
                        <div class="p-1 rounded bg-emerald-950 text-emerald-300 border border-emerald-500/30 font-bold">3. SETTLEMENT ELIGIBILITY</div>
                        <div class="p-1 rounded bg-white/5 text-gray-400">4. SETTLEMENT APPROVAL (PENDING)</div>
                        <div class="p-1 rounded bg-white/5 text-gray-400">5. DESIGNATED DOWNSTREAM ENTITY</div>
                        <div class="p-1 rounded bg-white/5 text-gray-400">6. REGISTERED RECIPIENT</div>
                    </div>
                    <p class="text-[8px] font-mono text-gray-400 italic">
                        NINA coordinates and records the operational lifecycle. Commercial sale & settlement performed by designated downstream operating entity under approved legal structure.
                    </p>
                </div>

                <!-- 09 / REGISTERED RECIPIENT (4 cols) -->
                <div class="lg:col-span-4 <?= $card ?> p-5 space-y-3 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                            <h3 class="text-xs font-mono font-bold uppercase text-white">09 / REGISTERED RECIPIENT</h3>
                            <span class="rounded bg-amber-950 px-2 py-0.5 text-[9px] text-amber-300">PENDING</span>
                        </div>
                        <div class="space-y-2 text-xs font-mono pt-1">
                            <div class="flex justify-between"><span class="text-gray-400">Participant / Counterparty</span><span class="text-white font-bold">Registered Operating Co</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Entity ID</span><span class="text-emerald-300 font-mono">ENT-NK01-0001</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Registered Wallet</span><span class="text-white font-mono">0x71A...9F2B</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Settlement Status</span><span class="text-amber-300 font-bold">LOCKED / ELIGIBLE</span></div>
                        </div>
                    </div>
                    <button type="button" disabled class="w-full rounded bg-white/5 border border-white/10 px-3 py-1.5 text-[10px] font-mono font-bold text-gray-400 cursor-not-allowed">
                        VIEW IDENTITY RECORD
                    </button>
                </div>

                <!-- 10 / TRANSACTION RECORD (4 cols) -->
                <div class="lg:col-span-4 <?= $card ?> p-5 space-y-3">
                    <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">10 / TRANSACTION RECORD</h3>
                        <span class="rounded bg-amber-950 px-2 py-0.5 text-[9px] text-amber-300">PENDING APPROVAL</span>
                    </div>
                    <div class="space-y-1.5 text-xs font-mono">
                        <div class="flex justify-between"><span class="text-gray-400">Transaction ID</span><span class="text-white font-bold">TX-NK-001-SET-001</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Type</span><span class="text-emerald-300">Commercial Settlement</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Sender Entity</span><span class="text-white text-[10px]">Downstream Operating Co</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Amount</span><span class="text-amber-300">Pending Execution</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Verification</span><span class="text-amber-300">Pending Approval</span></div>
                    </div>
                </div>

            </section>

            <!-- ---------- 11. BATCH COMPLETION REPORT & 12. DOCUMENT CENTER ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-12">

                <!-- 11 / BATCH COMPLETION REPORT (7 cols) -->
                <div class="lg:col-span-7 <?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">11 / BATCH COMPLETION REPORT</h3>
                            <p class="text-[10px] text-gray-400">Permanent operational record combining production, execution, verification & settlement</p>
                        </div>
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">AUDITABLE REPORT</span>
                    </div>

                    <div class="grid grid-cols-2 gap-2.5 text-xs font-mono">
                        <div class="p-2 rounded bg-white/5 border border-white/10 flex items-center justify-between"><span class="text-gray-300">1. Production Execution</span><span class="text-emerald-300 font-bold">✓</span></div>
                        <div class="p-2 rounded bg-white/5 border border-white/10 flex items-center justify-between"><span class="text-gray-300">2. Field Verification</span><span class="text-emerald-300 font-bold">✓</span></div>
                        <div class="p-2 rounded bg-white/5 border border-white/10 flex items-center justify-between"><span class="text-gray-300">3. Harvest Record</span><span class="text-emerald-300 font-bold">✓</span></div>
                        <div class="p-2 rounded bg-white/5 border border-white/10 flex items-center justify-between"><span class="text-gray-300">4. Weighing Record</span><span class="text-emerald-300 font-bold">✓</span></div>
                        <div class="p-2 rounded bg-white/5 border border-white/10 flex items-center justify-between"><span class="text-gray-300">5. Processing Record</span><span class="text-emerald-300 font-bold">✓</span></div>
                        <div class="p-2 rounded bg-white/5 border border-white/10 flex items-center justify-between"><span class="text-gray-300">6. Product Traceability</span><span class="text-emerald-300 font-bold">✓</span></div>
                        <div class="p-2 rounded bg-white/5 border border-white/10 flex items-center justify-between"><span class="text-gray-300">7. Delivery Documentation</span><span class="text-emerald-300 font-bold">✓</span></div>
                        <div class="p-2 rounded bg-white/5 border border-white/10 flex items-center justify-between"><span class="text-gray-300">8. Commercial Acceptance</span><span class="text-emerald-300 font-bold">✓</span></div>
                        <div class="p-2 rounded bg-amber-950 border border-amber-500/30 flex items-center justify-between"><span class="text-amber-300">9. Settlement</span><span class="text-amber-300 font-bold">○</span></div>
                        <div class="p-2 rounded bg-white/5 border border-white/10 flex items-center justify-between opacity-60"><span class="text-gray-400">10. Final Closure</span><span class="text-gray-400">🔒</span></div>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="button" class="rounded bg-emerald-950 border border-emerald-400/40 px-4 py-2 text-xs font-mono font-bold text-emerald-300 hover:bg-emerald-900 transition flex items-center gap-2">
                            <span>VIEW COMPLETION REPORT</span><?= $svg($ic['doc'], 'w-3.5 h-3.5') ?>
                        </button>
                        <button type="button" class="rounded border border-white/15 bg-white/5 px-4 py-2 text-xs font-mono font-bold text-gray-300 hover:bg-white/10 transition flex items-center gap-2">
                            <span>EXPORT REPORT</span><?= $svg($ic['download'], 'w-3.5 h-3.5') ?>
                        </button>
                    </div>
                </div>

                <!-- 12 / COMPLETION DOCUMENTS (5 cols) -->
                <div class="lg:col-span-5 <?= $card ?> p-5 space-y-3">
                    <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">12 / COMPLETION DOCUMENTS</h3>
                        <span class="rounded bg-white/5 px-2 py-0.5 text-[9px] text-gray-400">VAULT</span>
                    </div>

                    <div class="space-y-1.5 text-[10px] font-mono">
                        <div class="flex justify-between border-b border-white/5 py-0.5"><span>01 — Production Completion Report</span><span class="text-amber-300">Pending</span></div>
                        <div class="flex justify-between border-b border-white/5 py-0.5"><span>02 — Harvest Record</span><span class="text-emerald-300">Verified</span></div>
                        <div class="flex justify-between border-b border-white/5 py-0.5"><span>03 — Weighing Record</span><span class="text-emerald-300">Verified</span></div>
                        <div class="flex justify-between border-b border-white/5 py-0.5"><span>04 — Processing Record</span><span class="text-emerald-300">Verified</span></div>
                        <div class="flex justify-between border-b border-white/5 py-0.5"><span>05 — Product Traceability Record</span><span class="text-emerald-300">Verified</span></div>
                        <div class="flex justify-between border-b border-white/5 py-0.5"><span>06 — Delivery / Proof of Delivery</span><span class="text-emerald-300">Verified</span></div>
                        <div class="flex justify-between border-b border-white/5 py-0.5"><span>07 — Commercial Acceptance</span><span class="text-amber-300">Pending</span></div>
                        <div class="flex justify-between border-b border-white/5 py-0.5"><span>08 — Settlement Record</span><span class="text-amber-300">Pending</span></div>
                        <div class="flex justify-between py-0.5"><span>09 — Batch Closure Certificate</span><span class="text-gray-500">Locked</span></div>
                    </div>
                </div>

            </section>

            <!-- ---------- 13. REPUTATION TRIGGER & 14. BATCH HISTORY ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                <!-- 13 / POST-COMPLETION REPUTATION -->
                <div class="<?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">13 / POST-COMPLETION REPUTATION</h3>
                            <p class="text-[10px] text-gray-400">Reputation generated post-verified batch completion</p>
                        </div>
                        <span class="rounded bg-gray-800 px-2 py-0.5 text-[9px] text-gray-300">LOCKED</span>
                    </div>

                    <div class="space-y-2 text-xs font-mono">
                        <div class="flex justify-between"><span class="text-gray-400">Execution Score</span><span class="text-gray-500">Generates Post-Closure</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Timeliness Rating</span><span class="text-gray-500">Generates Post-Closure</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Documentation Verification</span><span class="text-gray-500">Generates Post-Closure</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Participant Review</span><span class="text-gray-500">Locked Until Closure</span></div>
                    </div>

                    <div class="text-[9px] font-mono text-gray-400 italic border-t border-white/10 pt-2">
                        Reputation becomes available after a production batch reaches verified completion. New partners do not receive fabricated ratings.
                    </div>
                </div>

                <!-- 14 / PRODUCTION BATCH HISTORY -->
                <div class="<?= $card ?> p-5 space-y-3">
                    <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">14 / PRODUCTION BATCH HISTORY</h3>
                        <span class="rounded bg-white/5 px-2 py-0.5 text-[9px] text-gray-400">3 BATCHES</span>
                    </div>

                    <table class="w-full text-left text-xs font-mono">
                        <thead>
                            <tr class="border-b border-white/10 text-gray-400 text-[10px] uppercase">
                                <th class="py-1.5 px-2">Batch</th>
                                <th class="py-1.5 px-2">Area</th>
                                <th class="py-1.5 px-2">Region</th>
                                <th class="py-1.5 px-2">Status</th>
                                <th class="py-1.5 px-2">Completion</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5 text-gray-200">
                            <tr>
                                <td class="py-2 px-2 font-bold text-white">NK-001</td>
                                <td class="py-2 px-2">100 HA</td>
                                <td class="py-2 px-2">North Kalimantan</td>
                                <td class="py-2 px-2 text-emerald-300 font-bold">Current</td>
                                <td class="py-2 px-2 text-amber-300 font-bold">Pending</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-2 font-bold text-white">NK-002</td>
                                <td class="py-2 px-2">100 HA</td>
                                <td class="py-2 px-2">North Kalimantan</td>
                                <td class="py-2 px-2 text-gray-400">Pipeline</td>
                                <td class="py-2 px-2 text-gray-500">—</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-2 font-bold text-white">NK-003</td>
                                <td class="py-2 px-2">100 HA</td>
                                <td class="py-2 px-2">North Kalimantan</td>
                                <td class="py-2 px-2 text-gray-400">Pipeline</td>
                                <td class="py-2 px-2 text-gray-500">—</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </section>

            <!-- ---------- 15. FINAL CLOSURE GATE & 16. FINAL AUDIT TRAIL ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-12">

                <!-- 15 / BATCH CLOSURE GATE (6 cols) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-4 border-l-4 border-l-amber-400 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between border-b border-white/10 pb-3">
                            <div>
                                <h3 class="text-xs font-mono font-bold uppercase text-white">15 / BATCH CLOSURE GATE</h3>
                                <p class="text-[10px] text-gray-400">Controls required before permanent batch closure</p>
                            </div>
                            <span class="rounded bg-amber-950 px-2 py-0.5 text-[9px] font-bold text-amber-300 border border-amber-500/30">8 / 10 CONTROLS COMPLETE</span>
                        </div>

                        <div class="grid grid-cols-2 gap-1.5 text-[10px] font-mono pt-2">
                            <div class="text-emerald-300">✓ Production completed</div>
                            <div class="text-emerald-300">✓ Field evidence verified</div>
                            <div class="text-emerald-300">✓ Harvest recorded</div>
                            <div class="text-emerald-300">✓ Weighing verified</div>
                            <div class="text-emerald-300">✓ Processing verified</div>
                            <div class="text-emerald-300">✓ Product traceability</div>
                            <div class="text-emerald-300">✓ Delivery accepted</div>
                            <div class="text-emerald-300">✓ Commercial docs complete</div>
                            <div class="text-amber-300 font-bold">○ Settlement completed</div>
                            <div class="text-amber-300 font-bold">○ Audit record complete</div>
                        </div>
                    </div>

                    <div class="space-y-2 pt-2 border-t border-white/10">
                        <button type="button" disabled title="Batch closure is locked until all required completion controls are satisfied." class="w-full rounded bg-gray-800 border border-white/10 px-4 py-2 text-xs font-mono font-bold text-gray-400 cursor-not-allowed flex items-center justify-center gap-2">
                            <?= $svg($ic['lock'], 'w-4 h-4') ?>
                            <span>CLOSE BATCH (LOCKED)</span>
                        </button>
                        <p class="text-[9px] font-mono text-gray-400 text-center italic">
                            Batch closure is locked until all required completion controls are satisfied.
                        </p>
                    </div>
                </div>

                <!-- 16 / FINAL AUDIT TRAIL (6 cols) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-3">
                    <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">16 / FINAL AUDIT TRAIL LOG</h3>
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-mono text-emerald-300 border border-emerald-500/30">AUDIT LOG</span>
                    </div>

                    <div class="space-y-1.5 text-[10px] font-mono text-gray-300">
                        <div class="flex justify-between border-b border-white/5 py-1"><span>AUD-0001 — Production completed</span><span class="text-emerald-300">VERIFIED</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span>AUD-0002 — Harvest record submitted</span><span class="text-emerald-300">VERIFIED</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span>AUD-0003 — Weighing record verified</span><span class="text-emerald-300">VERIFIED</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span>AUD-0004 — Processing output recorded</span><span class="text-emerald-300">VERIFIED</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span>AUD-0005 — Delivery verified</span><span class="text-emerald-300">VERIFIED</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span>AUD-0006 — Commercial acceptance recorded</span><span class="text-emerald-300">VERIFIED</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span>AUD-0007 — Settlement approved</span><span class="text-amber-300">PENDING</span></div>
                        <div class="flex justify-between py-1"><span>AUD-0008 — Batch closed</span><span class="text-gray-500">LOCKED</span></div>
                    </div>
                </div>

            </section>

            <!-- ---------- 18. PARTICIPANT EXPERIENCE & 19. CORE DATA LIFECYCLE RELATIONSHIP ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-12">

                <!-- 18 / MY PRODUCTION ALLOCATION (6 cols) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">18 / MY PRODUCTION ALLOCATION (ALC-2026-NK001-0001)</h3>
                            <p class="text-[10px] text-gray-400">Participant view of allocation lifecycle completion</p>
                        </div>
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">8,000 USDT ALLOCATION</span>
                    </div>

                    <div class="flex flex-wrap items-center gap-1.5 text-[8px] font-mono text-gray-300">
                        <span class="px-1.5 py-0.5 bg-emerald-950 text-emerald-300 rounded">PO CONFIRMED ✓</span> →
                        <span class="px-1.5 py-0.5 bg-emerald-950 text-emerald-300 rounded">M1 ✓</span> →
                        <span class="px-1.5 py-0.5 bg-emerald-950 text-emerald-300 rounded">M2 ✓</span> →
                        <span class="px-1.5 py-0.5 bg-emerald-950 text-emerald-300 rounded">M3 ✓</span> →
                        <span class="px-1.5 py-0.5 bg-emerald-950 text-emerald-300 rounded">M4 ✓</span> →
                        <span class="px-1.5 py-0.5 bg-emerald-950 text-emerald-300 rounded">HARVEST ✓</span> →
                        <span class="px-1.5 py-0.5 bg-emerald-950 text-emerald-300 rounded">DELIVERY ✓</span> →
                        <span class="px-1.5 py-0.5 bg-amber-950 text-amber-300 rounded">SETTLEMENT ○</span>
                    </div>
                </div>

                <!-- 19 / CORE DATA LIFECYCLE RELATIONSHIP (6 cols) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-3">
                    <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">19 / CORE DATA LIFECYCLE RELATIONSHIP</h3>
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-mono text-emerald-300 border border-emerald-500/30">SYSTEM ARCHITECTURE</span>
                    </div>
                    <div class="rounded bg-black/40 border border-white/10 p-3 text-[10px] font-mono text-gray-300 leading-relaxed">
                        PRODUCTION BATCH ├── HARVEST ├── WEIGHING ├── PROCESSING ├── PRODUCT ├── DELIVERY ├── ACCEPTANCE ├── SETTLEMENT └── AUDIT → BATCH COMPLETED → REPUTATION UPDATE
                    </div>
                </div>

            </section>

            <!-- ---------- 23. CORE MESSAGE BANNER ---------- -->
            <section class="rounded-xl border border-emerald-500/40 bg-gradient-to-r from-emerald-950/80 via-[#0B1815] to-[#04100B] p-6 text-center space-y-2 shadow-2xl">
                <p class="text-sm font-semibold tracking-wide text-white max-w-4xl mx-auto leading-relaxed">
                    “A production batch is not complete when work stops. It is complete when production is verified, output is measured, delivery is accepted, settlement is documented and the entire lifecycle is auditable.”
                </p>
                <p class="text-xs italic text-emerald-300 max-w-4xl mx-auto">
                    “Sebuah batch produksi tidak dianggap selesai ketika pekerjaan lapangan berhenti. Batch selesai ketika produksi terverifikasi, output terukur, delivery diterima, settlement terdokumentasi, dan seluruh lifecycle dapat diaudit.”
                </p>
                <div class="pt-2 text-[10px] font-mono text-gray-400 uppercase tracking-widest">
                    NINA OPERATING SYSTEM FOR PRODUCTIVE NATURAL ASSETS • END-TO-END LIFECYCLE CLOSURE
                </div>
            </section>

        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
?>
