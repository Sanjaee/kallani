<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$constants = $config['system_constants'] ?? [];
$demoDemand = $config['demo_demands'][0] ?? [];
$title = '18 / My Production Allocations — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'allocations';

/* ---------- Helpers & Icons ---------- */
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

$svg = fn(string $inner, string $cls = 'w-4 h-4') =>
    '<svg class="' . $cls . '" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">' . $inner . '</svg>';

$ic = [
    'target'    => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.5"/>',
    'leaf'      => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>',
    'coin'      => '<circle cx="12" cy="12" r="9"/><path d="M14.5 9.5c-.5-1-1.4-1.5-2.5-1.5-1.4 0-2.5.8-2.5 2s1 1.7 2.5 2 2.5.8 2.5 2-1.1 2-2.5 2c-1.1 0-2-.5-2.5-1.5M12 6v2M12 16v2"/>',
    'check'     => '<circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 4.5-5"/>',
    'shield'    => '<path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/>',
    'clock'     => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>',
    'doc'       => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>',
    'search'    => '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>',
    'wallet'    => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 10h20"/><path d="M16 14h.01"/>',
    'user'      => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
    'arrow'     => '<path d="M5 12h14M12 5l7 7-7 7"/>',
    'truck'     => '<rect x="1" y="3" width="15" height="13" rx="2"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>',
    'factory'   => '<path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V4H2z"/>',
    'box'       => '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>',
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

                <!-- Top Row: Breadcrumb & Right Badge -->
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <nav aria-label="Breadcrumb" class="inline-flex flex-wrap items-center gap-2 text-[10px] font-mono font-semibold uppercase tracking-[0.14em] text-gray-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                        <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors">NINA</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/batches" class="hover:text-white transition-colors">PRODUCTION</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/batches" class="hover:text-white transition-colors">BATCHES</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/batches" class="hover:text-white transition-colors">NK-001</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="font-bold text-white uppercase">MY ALLOCATIONS</span>
                    </nav>

                    <div class="flex flex-wrap items-center gap-2 text-[10px] font-bold">
                        <span class="rounded bg-emerald-950 px-3 py-1 text-emerald-300 border border-emerald-500/30 uppercase tracking-wider">DEMO / SIMULATED ENVIRONMENT</span>
                    </div>
                </div>

                <!-- Headline & Right Card Grid -->
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 items-center">
                    <div class="space-y-2 lg:col-span-7">
                        <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-200">
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">MITRA CONTROL CENTER</span>
                            <span>18 / MY PRODUCTION ALLOCATIONS</span>
                        </div>

                        <h1 class="max-w-3xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">Your Production Allocations. One Operational View.</h1>
                        
                        <p class="max-w-3xl text-sm font-medium leading-relaxed text-gray-200">
                            Track every production allocation from PO confirmation to execution, verification, harvest, delivery and commercial settlement.
                        </p>
                        <p class="text-[11px] italic text-gray-400">
                            Pantau seluruh alokasi produksi dari konfirmasi PO sampai produksi, verifikasi, panen, delivery dan settlement komersial.
                        </p>
                    </div>

                    <!-- Right Side Allocation Summary Banner Card -->
                    <div class="lg:col-span-5">
                        <div class="rounded-xl border border-emerald-500/30 bg-[#091610]/95 p-4 shadow-2xl backdrop-blur-md space-y-3">
                            <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                                <div>
                                    <div class="text-[10px] font-mono text-emerald-400 uppercase tracking-widest">ACTIVE ALLOCATION OBJECT</div>
                                    <div class="text-sm font-extrabold text-white font-mono">ALC-2026-NK001-0001</div>
                                </div>
                                <span class="rounded bg-amber-950/80 px-2.5 py-1 text-[10px] font-bold text-amber-300 border border-amber-500/30 uppercase">PO CONFIRMATION</span>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <div>
                                    <div class="text-[9px] font-mono text-gray-400">PROJECT / BATCH</div>
                                    <div class="font-bold text-white">North Kalimantan Palm</div>
                                    <div class="text-[10px] text-gray-300 font-mono">Batch NK-001 (100 HA)</div>
                                </div>
                                <div>
                                    <div class="text-[9px] font-mono text-gray-400">ALLOCATION / BATCH</div>
                                    <div class="font-bold text-emerald-300 font-mono">Rp100M / Rp15B</div>
                                    <div class="text-[10px] text-gray-300 font-mono">1 / 150 allocation units</div>
                                </div>
                            </div>

                            <div class="rounded-lg bg-black/40 p-2 border border-white/5 flex items-center justify-between text-[11px] font-mono">
                                <span class="text-gray-400">Modeled Proportion:</span>
                                <span class="font-bold text-emerald-300">0.67% modeled batch proportion</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ================= MAIN CONTENT BODY ================= -->
        <div class="space-y-6 px-4 pb-16 pt-6 sm:px-6 lg:px-8">

            <!-- ---------- 02. TOP ACCOUNT SUMMARY STRIP ---------- -->
            <section class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5">

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">ACTIVE ALLOCATIONS</span>
                        <span class="text-emerald-400"><?= $svg($ic['target'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-emerald-300 font-mono">01</div>
                    <div class="text-[9px] text-gray-400">Currently active</div>
                </div>

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">TOTAL ALLOCATED</span>
                        <span class="text-emerald-400"><?= $svg($ic['coin'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-white font-mono">Rp100M</div>
                    <div class="text-[9px] text-gray-400">Current modeled allocation</div>
                </div>

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">IN PRODUCTION</span>
                        <span class="text-gray-400"><?= $svg($ic['leaf'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-gray-400 font-mono">00</div>
                    <div class="text-[9px] text-gray-500">No active execution in demo</div>
                </div>

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">COMPLETED</span>
                        <span class="text-gray-400"><?= $svg($ic['check'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-gray-400 font-mono">00</div>
                    <div class="text-[9px] text-gray-500">No completed batches yet</div>
                </div>

                <div class="<?= $card ?> px-4 py-3 col-span-2 sm:col-span-1">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">PENDING ACTION</span>
                        <span class="text-amber-400"><?= $svg($ic['clock'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-amber-300 font-mono">01</div>
                    <div class="text-[9px] text-amber-400/80 font-medium">Review / confirmation required</div>
                </div>

            </section>

            <!-- ---------- 26. SEARCH & FILTER CONTROLS ---------- -->
            <section class="space-y-3">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-center">
                    <!-- Search input -->
                    <div class="md:col-span-6 relative">
                        <input type="text" placeholder="Search allocation, batch, project or requirement..." class="w-full rounded-xl border border-white/10 bg-[#0B1815]/90 py-2.5 pl-10 pr-4 text-xs font-mono text-white placeholder-gray-500 focus:border-emerald-500/60 focus:outline-none focus:ring-1 focus:ring-emerald-500/40" />
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <?= $svg($ic['search'], 'w-4 h-4') ?>
                        </div>
                    </div>

                    <!-- Filter selects -->
                    <div class="md:col-span-6 grid grid-cols-3 gap-2 text-xs font-mono">
                        <select class="rounded-xl border border-white/10 bg-[#0B1815]/90 py-2 px-2.5 text-[11px] text-gray-300 focus:border-emerald-500/60 focus:outline-none">
                            <option value="">Region: All</option>
                            <option value="nk">North Kalimantan</option>
                            <option value="sk">South Kalimantan</option>
                            <option value="ek">East Kalimantan</option>
                        </select>
                        <select class="rounded-xl border border-white/10 bg-[#0B1815]/90 py-2 px-2.5 text-[11px] text-gray-300 focus:border-emerald-500/60 focus:outline-none">
                            <option value="">Asset: Palm Production</option>
                            <option value="other">Other Assets (Pipeline)</option>
                        </select>
                        <select class="rounded-xl border border-white/10 bg-[#0B1815]/90 py-2 px-2.5 text-[11px] text-gray-300 focus:border-emerald-500/60 focus:outline-none">
                            <option value="">Requirement: DR-2026-001</option>
                            <option value="all">All Requirements</option>
                        </select>
                    </div>
                </div>
            </section>

            <!-- ---------- 03. PRIMARY NAVIGATION TABS ---------- -->
            <section class="space-y-3">
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-mono font-bold uppercase tracking-wider text-gray-300">MY PRODUCTION ALLOCATIONS</h2>
                    <span class="text-[10px] font-mono text-gray-500">Showing 1 Active Record</span>
                </div>

                <div class="flex items-center gap-1.5 overflow-x-auto pb-2 scrollbar-none text-[11px] font-mono">
                    <button class="rounded-lg bg-emerald-500 text-black font-bold px-3 py-1.5 uppercase shadow">ALL (1)</button>
                    <button class="rounded-lg bg-white/5 hover:bg-white/10 text-gray-300 px-3 py-1.5 uppercase">REQUESTED (0)</button>
                    <button class="rounded-lg bg-emerald-950 text-emerald-300 border border-emerald-500/40 px-3 py-1.5 uppercase font-semibold">CONFIRMED (1)</button>
                    <button class="rounded-lg bg-white/5 hover:bg-white/10 text-gray-300 px-3 py-1.5 uppercase">COLLECTING (1)</button>
                    <button class="rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 px-3 py-1.5 uppercase">IN EXECUTION (0)</button>
                    <button class="rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 px-3 py-1.5 uppercase">HARVEST (0)</button>
                    <button class="rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 px-3 py-1.5 uppercase">PROCESSING (0)</button>
                    <button class="rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 px-3 py-1.5 uppercase">DELIVERY (0)</button>
                    <button class="rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 px-3 py-1.5 uppercase">SETTLED (0)</button>
                    <button class="rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 px-3 py-1.5 uppercase">COMPLETED (0)</button>
                    <button class="rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 px-3 py-1.5 uppercase">CANCELLED (0)</button>
                </div>
            </section>

            <!-- ---------- 04, 05 & 06. MAIN ALLOCATION CARD & PO COLLECTION BAR ---------- -->
            <section class="<?= $card ?> p-6 space-y-6">
                
                <!-- Main Header Info -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                    
                    <!-- Thumbnail & Title -->
                    <div class="lg:col-span-7 flex flex-col sm:flex-row gap-4 items-start">
                        <img src="<?= $basePrefix ?>/1.jpg" alt="North Kalimantan Palm" class="w-full sm:w-32 h-24 object-cover rounded-lg border border-white/10 shrink-0" />
                        <div class="space-y-1.5">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="rounded bg-amber-950 px-2 py-0.5 text-[9px] font-bold text-amber-300 border border-amber-500/30 uppercase">PO CONFIRMATION</span>
                                <span class="text-xs font-mono text-gray-400">ID: ALC-2026-NK001-0001</span>
                            </div>
                            <h3 class="text-xl font-extrabold text-white">North Kalimantan Palm</h3>
                            <div class="flex items-center gap-3 text-xs text-gray-300 font-mono">
                                <span>Batch: <strong class="text-white">NK-001</strong></span>
                                <span>•</span>
                                <span>Region: <strong class="text-white">North Kalimantan</strong></span>
                                <span>•</span>
                                <span>Area: <strong class="text-white">100 HA</strong></span>
                            </div>
                            <p class="text-[11px] text-gray-400">One minimum allocation unit within the standard 100 HA production batch structure.</p>
                        </div>
                    </div>

                    <!-- PO Collection Progress Box -->
                    <div class="lg:col-span-5 bg-black/40 border border-emerald-500/30 rounded-xl p-4 space-y-2.5">
                        <div class="flex items-center justify-between text-xs font-mono">
                            <span class="text-gray-300 font-bold uppercase">PO COLLECTION</span>
                            <span class="text-emerald-400 font-extrabold">Rp100M / Rp15B</span>
                        </div>

                        <!-- Progress bar -->
                        <div class="w-full bg-white/10 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-emerald-500 to-teal-400 h-full rounded-full" style="width: 0.67%"></div>
                        </div>

                        <div class="flex items-center justify-between text-[10px] font-mono text-gray-400">
                            <span>0.67% Collected</span>
                            <span>Rp14.9B Remaining</span>
                        </div>

                        <div class="pt-1 flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 text-[10px] font-mono text-amber-300">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                                COLLECTION IN PROGRESS
                            </span>
                            <a href="<?= $basePrefix ?>/po-allocation" class="text-[11px] font-mono font-bold text-emerald-400 hover:underline inline-flex items-center gap-1">
                                <span>VIEW BATCH COLLECTION</span>
                                <?= $svg($ic['arrow'], 'w-3 h-3') ?>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Key Metrics Breakdown -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 bg-white/5 rounded-xl p-4 border border-white/5 text-xs font-mono">
                    <div>
                        <div class="text-[9px] text-gray-400 uppercase">BATCH REQUIREMENT</div>
                        <div class="text-base font-extrabold text-white mt-0.5">Rp15,000,000,000</div>
                        <div class="text-[9px] text-gray-500">100 HA Standard Batch</div>
                    </div>
                    <div>
                        <div class="text-[9px] text-gray-400 uppercase">PARTICIPANT ALLOCATION</div>
                        <div class="text-base font-extrabold text-emerald-300 mt-0.5">Rp100,000,000</div>
                        <div class="text-[9px] text-emerald-400/80">Confirmed PO Unit</div>
                    </div>
                    <div>
                        <div class="text-[9px] text-gray-400 uppercase">ALLOCATION UNITS</div>
                        <div class="text-base font-extrabold text-white mt-0.5">1 / 150 Units</div>
                        <div class="text-[9px] text-gray-500">Rp100M Per Unit</div>
                    </div>
                    <div>
                        <div class="text-[9px] text-gray-400 uppercase">MODELED PROPORTION</div>
                        <div class="text-base font-extrabold text-emerald-300 mt-0.5">0.67%</div>
                        <div class="text-[9px] text-gray-500">Batch Allocation Share</div>
                    </div>
                </div>

                <!-- Important Legal Footnote -->
                <div class="rounded-lg bg-emerald-950/40 border border-emerald-500/20 p-3 text-[11px] text-gray-300 space-y-1">
                    <div class="font-bold text-emerald-300 font-mono uppercase text-[10px]">OPERATIONAL ALLOCATION NOTICE</div>
                    <p class="leading-relaxed text-gray-300">
                        Allocation proportion does not by itself represent legal ownership of land, shares in the operating company, or a guaranteed economic entitlement. Final legal/commercial structure is subject to documentation.
                    </p>
                </div>

            </section>

            <!-- ---------- 07. ORDER-LIKE STATUS TIMELINE (SHOPEE STYLE LIFECYCLE) ---------- -->
            <section class="<?= $card ?> p-6 space-y-4">
                <div class="flex items-center justify-between border-b border-white/10 pb-3">
                    <div>
                        <h3 class="text-sm font-mono font-bold uppercase tracking-wider text-white">ALLOCATION OPERATIONAL LIFECYCLE</h3>
                        <p class="text-[11px] text-gray-400">Order-like tracking from PO confirmation to commercial settlement.</p>
                    </div>
                    <span class="text-xs font-mono font-bold text-amber-300 bg-amber-950/60 border border-amber-500/30 px-3 py-1 rounded-full">
                        CURRENT STATE: COLLECTION IN PROGRESS
                    </span>
                </div>

                <!-- Order Timeline Horizontal Flow (Precision Segment Line Design) -->
                <div class="overflow-x-auto pb-4 scrollbar-none">
                    <div class="min-w-[1000px] grid grid-cols-12 text-[10px] font-mono relative px-2 py-2">
                        
                        <!-- Step 1: PO Requested -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-emerald-500 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-emerald-500 text-black flex items-center justify-center font-bold text-[10px] shadow-md shadow-emerald-950 z-10">✓</div>
                            <span class="font-bold text-white mt-1.5">PO Requested</span>
                            <span class="text-[8px] text-gray-400">Completed</span>
                        </div>

                        <!-- Step 2: PO Confirmed -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-gradient-to-r from-emerald-500 to-amber-500 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-emerald-500 text-black flex items-center justify-center font-bold text-[10px] shadow-md shadow-emerald-950 z-10">✓</div>
                            <span class="font-bold text-white mt-1.5">PO Confirmed</span>
                            <span class="text-[8px] text-gray-400">Confirmed</span>
                        </div>

                        <!-- Step 3: Collection -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-amber-500 text-black flex items-center justify-center font-bold text-[10px] ring-4 ring-amber-500/20 shadow-md z-10">●</div>
                            <span class="font-bold text-amber-300 mt-1.5">Collection</span>
                            <span class="text-[8px] text-amber-400">In Progress</span>
                        </div>

                        <!-- Step 4: Ready Exec -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[9px] z-10">○</div>
                            <span class="text-gray-400 mt-1.5">Execution Auth</span>
                            <span class="text-[8px] text-gray-500">Pending</span>
                        </div>

                        <!-- Step 5: Milestone 01 -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[8px] font-bold z-10">M01</div>
                            <span class="text-gray-400 mt-1.5">Milestone 01</span>
                            <span class="text-[8px] text-gray-500">Locked</span>
                        </div>

                        <!-- Step 6: Milestone 02 -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[8px] font-bold z-10">M02</div>
                            <span class="text-gray-400 mt-1.5">Milestone 02</span>
                            <span class="text-[8px] text-gray-500">Locked</span>
                        </div>

                        <!-- Step 7: Milestone 03 -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[8px] font-bold z-10">M03</div>
                            <span class="text-gray-400 mt-1.5">Milestone 03</span>
                            <span class="text-[8px] text-gray-500">Locked</span>
                        </div>

                        <!-- Step 8: Milestone 04 -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[8px] font-bold z-10">M04</div>
                            <span class="text-gray-400 mt-1.5">Milestone 04</span>
                            <span class="text-[8px] text-gray-500">Locked</span>
                        </div>

                        <!-- Step 9: Harvest -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[9px] z-10">○</div>
                            <span class="text-gray-400 mt-1.5">Harvest</span>
                            <span class="text-[8px] text-gray-500">Pending</span>
                        </div>

                        <!-- Step 10: Processing -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[9px] z-10">○</div>
                            <span class="text-gray-400 mt-1.5">Processing</span>
                            <span class="text-[8px] text-gray-500">Pending</span>
                        </div>

                        <!-- Step 11: Delivery -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[9px] z-10">○</div>
                            <span class="text-gray-400 mt-1.5">Delivery</span>
                            <span class="text-[8px] text-gray-500">Pending</span>
                        </div>

                        <!-- Step 12: Settlement -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[9px] z-10">○</div>
                            <span class="text-gray-400 mt-1.5">Settlement</span>
                            <span class="text-[8px] text-gray-500">Pending</span>
                        </div>

                    </div>
                </div>
            </section>

            <!-- ---------- 08. CURRENT STEP CARD ---------- -->
            <section class="<?= $card ?> p-5 bg-gradient-to-r from-[#0E1F16] via-[#0B1815] to-[#0B1815] border-l-4 border-l-amber-400 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <div class="text-[10px] font-mono text-amber-400 font-bold uppercase tracking-widest">CURRENT OPERATIONAL STEP</div>
                        <h3 class="text-xl font-extrabold text-white">PO COLLECTION</h3>
                        <p class="text-xs text-gray-300 mt-1 max-w-2xl">
                            The production batch is currently completing its required PO allocation before entering the next operational stage.
                        </p>
                    </div>
                    <a href="<?= $basePrefix ?>/po-allocation" class="rounded-lg bg-amber-500 hover:bg-amber-400 text-black font-extrabold text-xs px-4 py-2.5 uppercase font-mono shadow-lg shrink-0 flex items-center gap-2">
                        <span>VIEW COLLECTION STATUS</span>
                        <?= $svg($ic['arrow'], 'w-4 h-4') ?>
                    </a>
                </div>

                <!-- Checklist -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 text-xs font-mono pt-2 border-t border-white/10">
                    <div class="flex items-center gap-2 text-emerald-300">
                        <span class="text-emerald-400 font-bold">✓</span>
                        <span>Production requirement defined</span>
                    </div>
                    <div class="flex items-center gap-2 text-emerald-300">
                        <span class="text-emerald-400 font-bold">✓</span>
                        <span>Production batch created</span>
                    </div>
                    <div class="flex items-center gap-2 text-emerald-300">
                        <span class="text-emerald-400 font-bold">✓</span>
                        <span>Allocation submitted & confirmed</span>
                    </div>
                    <div class="flex items-center gap-2 text-amber-300 font-semibold">
                        <span class="text-amber-400">○</span>
                        <span>Required batch collection complete (6.67%)</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-400">
                        <span>○</span>
                        <span>Execution authorization</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-400">
                        <span>○</span>
                        <span>Milestone 01 release</span>
                    </div>
                </div>
            </section>

            <!-- ---------- OPERATIONAL PANELS GRID (09 to 20) ---------- -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- LEFT COLUMN (8 COLS) -->
                <div class="lg:col-span-8 space-y-6">

                    <!-- 09. PRODUCTION BATCH INFORMATION & CONTRACT HORIZON -->
                    <div class="<?= $card ?> p-5 space-y-4">
                        <div class="flex items-center justify-between border-b border-white/10 pb-3">
                            <h3 class="text-sm font-mono font-bold uppercase text-white flex items-center gap-2">
                                <span>PRODUCTION BATCH SPECIFICATIONS</span>
                                <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] text-emerald-300 border border-emerald-500/30">NK-001</span>
                            </h3>
                            <a href="<?= $basePrefix ?>/batches" class="text-xs font-mono text-emerald-400 hover:underline">VIEW BATCH →</a>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs font-mono">
                            <div>
                                <div class="text-[9px] text-gray-400">PROJECT NAME</div>
                                <div class="font-bold text-white mt-0.5">North Kalimantan Palm</div>
                            </div>
                            <div>
                                <div class="text-[9px] text-gray-400">STANDARDIZED AREA</div>
                                <div class="font-bold text-white mt-0.5">100 HA</div>
                            </div>
                            <div>
                                <div class="text-[9px] text-gray-400">PRODUCTION REQUIREMENT</div>
                                <div class="font-bold text-white mt-0.5">Rp15,000,000,000</div>
                            </div>
                            <div>
                                <div class="text-[9px] text-gray-400">MIN PO ALLOCATION</div>
                                <div class="font-bold text-emerald-300 mt-0.5">Rp100,000,000</div>
                            </div>
                        </div>

                        <!-- Horizon Breakdown Bar -->
                        <div class="rounded-lg bg-black/40 p-3 border border-white/5 space-y-2 text-xs font-mono">
                            <div class="flex items-center justify-between text-[10px] text-gray-400">
                                <span>TOTAL CONTRACT HORIZON: <strong class="text-white">20 YEARS</strong></span>
                                <span>DEVELOPMENT: <strong class="text-amber-300">5 YRS</strong> | COMMERCIAL: <strong class="text-emerald-300">15 YRS</strong></span>
                            </div>
                            <div class="flex h-2 w-full overflow-hidden rounded-full bg-white/10">
                                <div class="bg-amber-400 h-full" style="width: 25%"></div>
                                <div class="bg-emerald-400 h-full" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- 10 & 21. PRODUCTION MODEL (MODELLED VS ACTUAL) -->
                    <div class="<?= $card ?> p-5 space-y-4">
                        <div class="flex items-center justify-between border-b border-white/10 pb-3">
                            <div>
                                <h3 class="text-sm font-mono font-bold uppercase text-white">PRODUCTION MODEL BENCHMARKS</h3>
                                <p class="text-[11px] text-gray-400">Modeled batch capacity vs actual recorded field yield.</p>
                            </div>
                            <span class="rounded bg-white/10 px-2 py-0.5 text-[9px] font-mono text-gray-300 uppercase">MODEL VS ACTUAL</span>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs font-mono">
                            <div class="bg-white/5 p-3 rounded-lg border border-white/5">
                                <div class="text-[9px] text-gray-400">YIELD BENCHMARK</div>
                                <div class="text-base font-extrabold text-white mt-0.5">18.03 T</div>
                                <div class="text-[9px] text-gray-500">TBS / HA / Year</div>
                            </div>
                            <div class="bg-white/5 p-3 rounded-lg border border-white/5">
                                <div class="text-[9px] text-gray-400">MODELLED BATCH OUTPUT</div>
                                <div class="text-base font-extrabold text-white mt-0.5">1,803 T</div>
                                <div class="text-[9px] text-gray-500">TBS / Year (100 HA)</div>
                            </div>
                            <div class="bg-white/5 p-3 rounded-lg border border-white/5">
                                <div class="text-[9px] text-gray-400">OER ASSUMPTION</div>
                                <div class="text-base font-extrabold text-white mt-0.5">20.00%</div>
                                <div class="text-[9px] text-gray-500">Oil Extraction Rate</div>
                            </div>
                            <div class="bg-white/5 p-3 rounded-lg border border-white/5">
                                <div class="text-[9px] text-gray-400">MODELLED CPO OUTPUT</div>
                                <div class="text-base font-extrabold text-emerald-300 mt-0.5">360.6 T</div>
                                <div class="text-[9px] text-gray-500">CPO / Year</div>
                            </div>
                        </div>

                        <!-- Actual Production Comparison Box -->
                        <div class="rounded-lg bg-black/40 p-3 border border-white/5 flex items-center justify-between text-xs font-mono">
                            <div>
                                <span class="text-gray-400 text-[10px] uppercase">ACTUAL RECORDED YIELD:</span>
                                <div class="font-bold text-amber-300 mt-0.5">— (Pending Execution & Harvest)</div>
                            </div>
                            <span class="text-[10px] text-gray-500 italic">Actual production determined strictly by verified field records.</span>
                        </div>
                    </div>

                    <!-- 11 & 12. MILESTONE TRACKER -->
                    <div class="<?= $card ?> p-5 space-y-4">
                        <div class="flex items-center justify-between border-b border-white/10 pb-3">
                            <div>
                                <h3 class="text-sm font-mono font-bold uppercase text-white">PRODUCTION MILESTONES</h3>
                                <p class="text-[11px] text-gray-400">Four 25% protocol milestone releases subject to verification.</p>
                            </div>
                            <a href="<?= $basePrefix ?>/milestones" class="text-xs font-mono text-emerald-400 hover:underline">VIEW MILESTONES →</a>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs font-mono">
                            
                            <!-- M01 -->
                            <div class="rounded-xl bg-white/5 p-3.5 border border-white/10 space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-white">M01 — Production Preparation</span>
                                    <span class="rounded bg-amber-950 px-2 py-0.5 text-[9px] font-bold text-amber-300 border border-amber-500/30">25% • LOCKED</span>
                                </div>
                                <div class="text-[10px] text-gray-400 space-y-1">
                                    <div class="flex items-center gap-1.5 text-emerald-300"><span>✓</span> PO requirement defined</div>
                                    <div class="flex items-center gap-1.5 text-amber-300"><span>○</span> Batch collection complete</div>
                                    <div class="flex items-center gap-1.5 text-gray-500"><span>○</span> Approved RAB & Vendor assign</div>
                                </div>
                            </div>

                            <!-- M02 -->
                            <div class="rounded-xl bg-white/5 p-3.5 border border-white/10 space-y-2 opacity-75">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-gray-300">M02 — Development Execution</span>
                                    <span class="rounded bg-white/10 px-2 py-0.5 text-[9px] font-bold text-gray-400">25% • LOCKED</span>
                                </div>
                                <div class="text-[10px] text-gray-500 space-y-1">
                                    <div>○ Land clearing & preparation</div>
                                    <div>○ Planting & agronomic inputs</div>
                                    <div>○ Work order verification</div>
                                </div>
                            </div>

                            <!-- M03 -->
                            <div class="rounded-xl bg-white/5 p-3.5 border border-white/10 space-y-2 opacity-75">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-gray-300">M03 — Production Progress</span>
                                    <span class="rounded bg-white/10 px-2 py-0.5 text-[9px] font-bold text-gray-400">25% • LOCKED</span>
                                </div>
                                <div class="text-[10px] text-gray-500 space-y-1">
                                    <div>○ Infrastructure & maintenance</div>
                                    <div>○ Crop maturity verification</div>
                                    <div>○ Operational audit release</div>
                                </div>
                            </div>

                            <!-- M04 -->
                            <div class="rounded-xl bg-white/5 p-3.5 border border-white/10 space-y-2 opacity-75">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-gray-300">M04 — Completion Preparation</span>
                                    <span class="rounded bg-white/10 px-2 py-0.5 text-[9px] font-bold text-gray-400">25% • LOCKED</span>
                                </div>
                                <div class="text-[10px] text-gray-500 space-y-1">
                                    <div>○ Harvest readiness audit</div>
                                    <div>○ Downstream buyer linkage</div>
                                    <div>○ Commercial settlement prep</div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- 13 & 14. RAB TRACKING & OPERATIONAL VENDORS -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- RAB Tracking Card -->
                        <div class="<?= $card ?> p-5 space-y-3">
                            <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                                <h4 class="text-xs font-mono font-bold uppercase text-white">RAB BUDGET TRACKING</h4>
                                <a href="<?= $basePrefix ?>/rab-budget" class="text-[10px] font-mono text-emerald-400 hover:underline">VIEW RAB →</a>
                            </div>

                            <div class="text-xs font-mono space-y-1.5">
                                <div class="flex justify-between">
                                    <span class="text-gray-400">RAB Record:</span>
                                    <span class="text-white font-bold">RAB-NK-001-V01</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Planned Budget:</span>
                                    <span class="text-emerald-300 font-bold">Rp15,000,000,000</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Allocated / Committed:</span>
                                    <span class="text-gray-400">Rp0 / Rp0</span>
                                </div>
                            </div>

                            <p class="text-[9px] text-gray-500 italic">
                                Modeled budget parameter. Not automatically equivalent to cash held by NINA.
                            </p>
                        </div>

                        <!-- Operational Vendors Card -->
                        <div class="<?= $card ?> p-5 space-y-3">
                            <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                                <h4 class="text-xs font-mono font-bold uppercase text-white">OPERATIONAL VENDORS</h4>
                                <a href="<?= $basePrefix ?>/vendors" class="text-[10px] font-mono text-emerald-400 hover:underline">VIEW VENDORS →</a>
                            </div>

                            <div class="space-y-2 text-xs font-mono">
                                <div class="flex justify-between items-center bg-white/5 p-2 rounded">
                                    <div>
                                        <div class="text-[9px] text-gray-400">HEAVY EQUIPMENT</div>
                                        <div class="font-bold text-white text-[11px]">Demo Heavy Equipment Partner</div>
                                    </div>
                                    <span class="text-[9px] text-amber-300 bg-amber-950 px-1.5 py-0.5 rounded">PENDING</span>
                                </div>

                                <div class="flex justify-between items-center bg-white/5 p-2 rounded">
                                    <div>
                                        <div class="text-[9px] text-gray-400">SEED MATERIAL</div>
                                        <div class="font-bold text-white text-[11px]">Certified Seed Producer</div>
                                    </div>
                                    <span class="text-[9px] text-gray-400 bg-white/5 px-1.5 py-0.5 rounded">PENDING</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- 15 & 16. WORK ORDER TRACKING & FIELD EXECUTION -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- 15. Work Order Tracking Card -->
                        <div class="<?= $card ?> p-5 space-y-3">
                            <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                                <h4 class="text-xs font-mono font-bold uppercase text-white">WORK ORDER TRACKING</h4>
                                <a href="<?= $basePrefix ?>/milestones" class="text-[10px] font-mono text-emerald-400 hover:underline">VIEW WORK ORDER →</a>
                            </div>

                            <div class="space-y-2 text-xs font-mono">
                                <div class="flex justify-between items-center bg-white/5 p-2 rounded border border-white/5">
                                    <div>
                                        <div class="text-[9px] text-gray-400">WO-NK-001-M1-001</div>
                                        <div class="font-bold text-white text-[11px]">Land Preparation (100 HA)</div>
                                        <div class="text-[9px] text-gray-400">Partner: Demo Production Partner</div>
                                    </div>
                                    <span class="text-[9px] text-amber-400 bg-amber-950 px-2 py-0.5 rounded font-bold uppercase">NOT STARTED</span>
                                </div>
                                <div class="flex justify-between text-[10px] text-gray-400 pt-1">
                                    <span>RAB: RAB-NK-001-V01</span>
                                    <span>Milestone: M01</span>
                                </div>
                            </div>
                        </div>

                        <!-- 16. Field Progress Card -->
                        <div class="<?= $card ?> p-5 space-y-3">
                            <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                                <h4 class="text-xs font-mono font-bold uppercase text-white">FIELD EXECUTION</h4>
                                <a href="<?= $basePrefix ?>/milestones" class="text-[10px] font-mono text-emerald-400 hover:underline">VIEW FIELD OPS →</a>
                            </div>

                            <div class="space-y-2 text-xs font-mono">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-400">Field Progress:</span>
                                    <span class="font-bold text-amber-300">0% (NOT STARTED)</span>
                                </div>
                                <div class="grid grid-cols-2 gap-1 text-[10px] text-gray-400">
                                    <div>○ Site Access</div>
                                    <div>○ Land Preparation</div>
                                    <div>○ Infrastructure</div>
                                    <div>○ Planting Prep</div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- 20. COMMERCIAL LIFECYCLE OUTPUT TRACKER -->
                    <div class="<?= $card ?> p-5 space-y-4">
                        <div class="flex items-center justify-between border-b border-white/10 pb-3">
                            <div>
                                <h3 class="text-sm font-mono font-bold uppercase text-white">COMMERCIAL LIFECYCLE</h3>
                                <p class="text-[11px] text-gray-400">Downstream commercial delivery & settlement readiness.</p>
                            </div>
                            <span class="rounded bg-white/10 px-2 py-0.5 text-[9px] font-mono text-gray-400 uppercase">NOT YET AVAILABLE</span>
                        </div>

                        <!-- Commercial Stepper Node-and-Line -->
                        <div class="overflow-x-auto pb-2 scrollbar-none">
                            <div class="min-w-[650px] grid grid-cols-9 text-[9px] font-mono relative px-1 py-1">
                                <!-- Node 1: Production -->
                                <div class="flex flex-col items-center text-center relative">
                                    <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                                    <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[8px] z-10">○</div>
                                    <span class="text-gray-400 mt-1">Production</span>
                                </div>
                                <!-- Node 2: Harvest -->
                                <div class="flex flex-col items-center text-center relative">
                                    <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                                    <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[8px] z-10">○</div>
                                    <span class="text-gray-400 mt-1">Harvest</span>
                                </div>
                                <!-- Node 3: Weighing -->
                                <div class="flex flex-col items-center text-center relative">
                                    <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                                    <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[8px] z-10">○</div>
                                    <span class="text-gray-400 mt-1">Weighing</span>
                                </div>
                                <!-- Node 4: Processing -->
                                <div class="flex flex-col items-center text-center relative">
                                    <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                                    <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[8px] z-10">○</div>
                                    <span class="text-gray-400 mt-1">Processing</span>
                                </div>
                                <!-- Node 5: Product -->
                                <div class="flex flex-col items-center text-center relative">
                                    <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                                    <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[8px] z-10">○</div>
                                    <span class="text-gray-400 mt-1">Product</span>
                                </div>
                                <!-- Node 6: Delivery -->
                                <div class="flex flex-col items-center text-center relative">
                                    <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                                    <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[8px] z-10">○</div>
                                    <span class="text-gray-400 mt-1">Delivery</span>
                                </div>
                                <!-- Node 7: Acceptance -->
                                <div class="flex flex-col items-center text-center relative">
                                    <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                                    <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[8px] z-10">○</div>
                                    <span class="text-gray-400 mt-1">Acceptance</span>
                                </div>
                                <!-- Node 8: Settlement -->
                                <div class="flex flex-col items-center text-center relative">
                                    <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                                    <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[8px] z-10">○</div>
                                    <span class="text-gray-400 mt-1">Settlement</span>
                                </div>
                                <!-- Node 9: Completed -->
                                <div class="flex flex-col items-center text-center relative">
                                    <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[8px] z-10">○</div>
                                    <span class="text-gray-400 mt-1">Completed</span>
                                </div>
                            </div>
                        </div>

                        <p class="text-[10px] text-gray-400 italic">
                            Commercial settlement becomes available only after the relevant production, processing, delivery and acceptance conditions have been satisfied.
                        </p>
                    </div>

                </div>

                <!-- RIGHT COLUMN (4 COLS) -->
                <div class="lg:col-span-4 space-y-6">

                    <!-- 22 & 23. PARTICIPANT ACTION CENTER & DECISION GATE -->
                    <div class="<?= $card ?> p-5 bg-gradient-to-b from-[#0E1F16] to-[#0B1815] border border-emerald-500/40 space-y-4">
                        <div class="border-b border-white/10 pb-2.5">
                            <div class="text-[9px] font-mono text-emerald-400 font-bold uppercase tracking-wider">ACTION CENTER</div>
                            <h3 class="text-base font-extrabold text-white">Participant Review Required</h3>
                        </div>

                        <p class="text-xs text-gray-300 leading-relaxed">
                            Please confirm your production allocation details and applicable commercial terms.
                        </p>

                        <button class="w-full rounded-lg bg-emerald-500 hover:bg-emerald-400 text-black font-extrabold text-xs py-2.5 uppercase font-mono shadow-lg transition-colors">
                            REVIEW ALLOCATION TERMS
                        </button>

                        <div class="pt-2 border-t border-white/10 space-y-2">
                            <div class="text-[10px] font-mono font-bold text-gray-300 uppercase">PROTOCOL DECISION GATE</div>
                            <div class="flex gap-2">
                                <button class="flex-1 rounded bg-white/10 hover:bg-white/20 text-white font-mono text-[10px] py-1.5 uppercase font-bold">CONTINUE</button>
                                <button class="flex-1 rounded bg-amber-950/60 hover:bg-amber-900/60 text-amber-300 border border-amber-500/30 font-mono text-[10px] py-1.5 uppercase">REQUEST REVIEW</button>
                            </div>
                        </div>
                    </div>

                    <!-- 17. VERIFICATION CONTROLS PANEL -->
                    <div class="<?= $card ?> p-5 space-y-3">
                        <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                            <h4 class="text-xs font-mono font-bold uppercase text-white">VERIFICATION CONTROLS</h4>
                            <span class="text-amber-300 font-mono text-[10px] font-bold">0 / 10 VERIFIED</span>
                        </div>

                        <div class="grid grid-cols-2 gap-1.5 text-[10px] font-mono">
                            <div class="bg-white/5 p-1.5 rounded text-gray-400">○ Land Title</div>
                            <div class="bg-white/5 p-1.5 rounded text-gray-400">○ Partner KYB</div>
                            <div class="bg-white/5 p-1.5 rounded text-gray-400">○ Seed Cert</div>
                            <div class="bg-white/5 p-1.5 rounded text-gray-400">○ Capacity</div>
                            <div class="bg-white/5 p-1.5 rounded text-gray-400">○ RAB Audit</div>
                            <div class="bg-white/5 p-1.5 rounded text-gray-400">○ Vendor Audit</div>
                            <div class="bg-white/5 p-1.5 rounded text-gray-400">○ Work Order</div>
                            <div class="bg-white/5 p-1.5 rounded text-gray-400">○ Field Evidence</div>
                            <div class="bg-white/5 p-1.5 rounded text-gray-400">○ GIS Mapping</div>
                            <div class="bg-white/5 p-1.5 rounded text-gray-400">○ Wallet Identity</div>
                        </div>

                        <a href="<?= $basePrefix ?>/verification" class="block text-center text-xs font-mono font-bold text-emerald-400 hover:underline pt-1">
                            VIEW VERIFICATION CENTER →
                        </a>
                    </div>

                    <!-- 19. REGISTERED SETTLEMENT IDENTITY & WALLET -->
                    <div class="<?= $card ?> p-5 space-y-3">
                        <div class="border-b border-white/10 pb-2">
                            <div class="text-[9px] font-mono text-gray-400 uppercase">SETTLEMENT IDENTITY</div>
                            <h4 class="text-xs font-mono font-bold text-white">Registered Wallet Identity</h4>
                        </div>

                        <div class="space-y-1.5 text-xs font-mono">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Participant ID:</span>
                                <span class="text-white font-bold">ENT-2026-ALC001</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Wallet:</span>
                                <span class="text-emerald-300 font-bold">0x71C8...4F2A</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Identity Status:</span>
                                <span class="text-amber-300 font-bold">REGISTERED / PENDING</span>
                            </div>
                        </div>

                        <p class="text-[9px] text-gray-500 italic">
                            Registered wallet linked to verified entity record for approved settlement flows.
                        </p>
                    </div>

                    <!-- 18. DOCUMENT CENTER -->
                    <div class="<?= $card ?> p-5 space-y-3">
                        <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                            <h4 class="text-xs font-mono font-bold uppercase text-white">DOCUMENT CENTER</h4>
                            <a href="<?= $basePrefix ?>/documents" class="text-[10px] font-mono text-emerald-400 hover:underline">ALL DOCS →</a>
                        </div>

                        <div class="space-y-1.5 text-xs font-mono">
                            <div class="flex justify-between items-center text-gray-300">
                                <span>Demand Requirement</span>
                                <span class="text-emerald-400 font-bold">AVAILABLE</span>
                            </div>
                            <div class="flex justify-between items-center text-gray-300">
                                <span>Batch Record (NK-001)</span>
                                <span class="text-emerald-400 font-bold">AVAILABLE</span>
                            </div>
                            <div class="flex justify-between items-center text-gray-300">
                                <span>RAB-NK-001-V01</span>
                                <span class="text-emerald-400 font-bold">AVAILABLE</span>
                            </div>
                            <div class="flex justify-between items-center text-gray-400">
                                <span>Work Order Evidence</span>
                                <span class="text-amber-300">PENDING</span>
                            </div>
                        </div>
                    </div>

                    <!-- 27 & 28. COMPLETION CARD & REPUTATION REVIEW GATE -->
                    <div class="<?= $card ?> p-5 space-y-3">
                        <div class="border-b border-white/10 pb-2 flex items-center justify-between">
                            <h4 class="text-xs font-mono font-bold uppercase text-white">COMPLETION & REPUTATION</h4>
                            <span class="rounded bg-white/10 px-2 py-0.5 text-[9px] font-mono text-gray-400 uppercase">LOCKED</span>
                        </div>

                        <div class="space-y-2 text-xs font-mono">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Reputation Status:</span>
                                <span class="text-amber-300 font-bold">Reputation Not Yet Established</span>
                            </div>
                            <div class="text-[10px] text-gray-400 leading-relaxed">
                                Participant reviews and operational experience ratings become available strictly after batch completion and settlement closure.
                            </div>
                        </div>

                        <div class="flex gap-2 pt-1">
                            <button disabled class="flex-1 rounded bg-white/5 text-gray-500 font-mono text-[10px] py-1.5 uppercase cursor-not-allowed">COMPLETION REPORT</button>
                            <button disabled class="flex-1 rounded bg-white/5 text-gray-500 font-mono text-[10px] py-1.5 uppercase cursor-not-allowed">WRITE REVIEW</button>
                        </div>
                    </div>

                </div>

            </div>

            <!-- ---------- 24 & 25. ALLOCATION HISTORY TABLE & SIMULATED TIMELINE ---------- -->
            <section class="<?= $card ?> p-6 space-y-4">
                <div class="flex items-center justify-between border-b border-white/10 pb-3">
                    <h3 class="text-sm font-mono font-bold uppercase text-white">ALLOCATION HISTORY DIRECTORY</h3>
                    <span class="text-xs font-mono text-gray-400">SIMULATED PARTICIPANT RECORDS</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs font-mono">
                        <thead class="bg-white/5 text-gray-400 uppercase text-[9px] tracking-wider">
                            <tr>
                                <th class="p-3">Allocation ID</th>
                                <th class="p-3">Project</th>
                                <th class="p-3">Batch</th>
                                <th class="p-3">Amount</th>
                                <th class="p-3">Units</th>
                                <th class="p-3">Status</th>
                                <th class="p-3 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5 text-gray-200">
                            <tr class="hover:bg-white/5">
                                <td class="p-3 font-bold text-white">ALC-2026-NK001-0001</td>
                                <td class="p-3">North Kalimantan Palm</td>
                                <td class="p-3 text-emerald-300">NK-001</td>
                                <td class="p-3 font-bold text-white">Rp100,000,000</td>
                                <td class="p-3">1 / 150</td>
                                <td class="p-3"><span class="rounded bg-amber-950 px-2 py-0.5 text-[9px] font-bold text-amber-300 border border-amber-500/30 uppercase">PO CONFIRMATION</span></td>
                                <td class="p-3 text-right"><a href="<?= $basePrefix ?>/po-allocation" class="text-emerald-400 hover:underline">MANAGE →</a></td>
                            </tr>
                            <tr class="hover:bg-white/5 opacity-60">
                                <td class="p-3 font-bold text-gray-400">ALC-2026-SK001-0002</td>
                                <td class="p-3">South Kalimantan Palm</td>
                                <td class="p-3">SK-001</td>
                                <td class="p-3">Rp100,000,000</td>
                                <td class="p-3">1 / 150</td>
                                <td class="p-3"><span class="rounded bg-white/10 px-2 py-0.5 text-[9px] font-bold text-gray-400 uppercase">REQUESTED</span></td>
                                <td class="p-3 text-right"><span class="text-gray-500">VIEW</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

        </div>

    </div>

</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/dashboard.php';
