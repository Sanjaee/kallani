<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$constants = $config['system_constants'] ?? [];
$demoDemand = $config['demo_demands'][0] ?? [];
$title = '15 / Harvest & Commercial Delivery — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'commercial';

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
    'user'      => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
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

        <!-- ================= 1. HERO HEADER SECTION ================= -->
        <section class="relative overflow-hidden shadow-2xl" style="border-bottom: none !important;">
            <img src="<?= $basePrefix ?>/1.jpg" alt="Natural forest canopy" class="absolute inset-0 h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#050D07]/90 via-[#050D07]/60 to-[#050D07]/20"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#06120F]/90 via-transparent to-transparent"></div>

            <div class="relative space-y-4 px-6 pt-3 pb-6 lg:px-8 lg:pt-3 lg:pb-8">

                <!-- Top Row: Breadcrumb & Actions -->
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
                        <span class="font-bold text-white uppercase">COMMERCIAL OUTPUT</span>
                    </nav>

                    <div class="flex flex-wrap items-center gap-2 text-[10px] font-bold">
                        <a href="<?= $basePrefix ?>/milestones" class="rounded-lg bg-emerald-950/80 border border-emerald-400/40 px-3 py-1.5 text-emerald-300 hover:bg-emerald-900/80 uppercase tracking-wide flex items-center gap-1.5">
                            <span>VIEW PRODUCTION EXECUTION</span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="<?= $basePrefix ?>/verification" class="rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10 uppercase tracking-wide">VERIFICATION VAULT</a>
                        <a href="<?= $basePrefix ?>/audit-trail" class="rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10 uppercase tracking-wide">AUDIT TRAIL</a>
                    </div>
                </div>

                <!-- Headline & Subheadline -->
                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-200">
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">PRODUCTION OUTPUT</span>
                        <span>15 / HARVEST & COMMERCIAL DELIVERY</span>
                        <span class="rounded border border-amber-400/40 bg-amber-500/20 px-2 py-0.5 text-[9px] font-bold tracking-wider text-amber-300">BATCH NK-001 • 100 HA</span>
                    </div>

                    <h1 class="max-w-3xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">From Verified Production to Commercial Delivery.</h1>
                    
                    <p class="max-w-3xl text-sm font-medium leading-relaxed text-gray-200">
                        NINA tracks physical output from harvest and weighing through processing, delivery and commercial settlement.
                    </p>
                    <p class="text-[11px] italic text-gray-400">
                        NINA melacak hasil produksi dari panen dan penimbangan hingga pemrosesan, pengiriman dan commercial settlement.
                    </p>
                </div>

                <!-- Current Status Badge Banner -->
                <div class="inline-flex items-center gap-2.5 rounded-lg border border-amber-400/30 bg-amber-950/60 px-3.5 py-1.5 text-xs font-semibold text-amber-300 backdrop-blur-md">
                    <span class="h-2 w-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>CURRENT STATUS: DEVELOPMENT / NOT YET IN COMMERCIAL DELIVERY</span>
                </div>

            </div>
        </section>

        <!-- ================= CONTENT WRAPPER ================= -->
        <div class="space-y-6 px-4 pb-16 pt-6 sm:px-6 lg:px-8">

            <!-- ---------- 3. TOP KPI CARDS (6 CARDS) ---------- -->
            <section class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">

                <!-- CARD 01: PRODUCTION AREA -->
                <div class="<?= $card ?> flex items-center gap-3 px-3.5 py-3">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['leaf']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">PRODUCTION AREA</div>
                        <div class="text-lg font-extrabold text-white">100 HA</div>
                        <div class="text-[8px] text-gray-400">Batch NK-001</div>
                    </div>
                </div>

                <!-- CARD 02: HARVEST STATUS -->
                <div class="<?= $card ?> flex items-center gap-3 px-3.5 py-3">
                    <span class="<?= $iconBox ?> text-amber-400"><?= $svg($ic['target']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">HARVEST STATUS</div>
                        <div class="text-sm font-bold text-amber-300 uppercase">NOT STARTED</div>
                        <div class="text-[8px] text-gray-400">In Development</div>
                    </div>
                </div>

                <!-- CARD 03: WEIGHING -->
                <div class="<?= $card ?> flex items-center gap-3 px-3.5 py-3">
                    <span class="<?= $iconBox ?> text-amber-400"><?= $svg($ic['scale']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">WEIGHING</div>
                        <div class="text-sm font-bold text-amber-300 uppercase">PENDING</div>
                        <div class="text-[8px] text-gray-400">Scale Verification</div>
                    </div>
                </div>

                <!-- CARD 04: PROCESSING -->
                <div class="<?= $card ?> flex items-center gap-3 px-3.5 py-3">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['factory']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">PROCESSING</div>
                        <div class="text-sm font-bold text-gray-300 uppercase">NOT STARTED</div>
                        <div class="text-[8px] text-gray-400">Facility Assignment</div>
                    </div>
                </div>

                <!-- CARD 05: DELIVERY -->
                <div class="<?= $card ?> flex items-center gap-3 px-3.5 py-3">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['truck']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">DELIVERY</div>
                        <div class="text-sm font-bold text-gray-400 uppercase">NOT AVAILABLE</div>
                        <div class="text-[8px] text-gray-400">Offtake Dispatch</div>
                    </div>
                </div>

                <!-- CARD 06: SETTLEMENT -->
                <div class="<?= $card ?> flex items-center gap-3 px-3.5 py-3">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['dollar']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">SETTLEMENT</div>
                        <div class="text-sm font-bold text-gray-400 uppercase">NOT AVAILABLE</div>
                        <div class="text-[8px] text-gray-400">Commercial Term</div>
                    </div>
                </div>

            </section>

            <!-- ---------- 4. BATCH CONTEXT & 5. COMMERCIAL PRODUCTION LIFECYCLE ---------- -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">

                <!-- Left Column: Batch Context (4 cols) -->
                <div class="space-y-4 lg:col-span-4">
                    <div class="<?= $card ?> p-5 space-y-4">
                        <div class="flex items-center justify-between border-b border-white/10 pb-3">
                            <span class="text-[11px] font-mono font-bold uppercase tracking-wider text-white">01 / PRODUCTION BATCH</span>
                            <span class="rounded border border-emerald-400/40 bg-emerald-950/70 px-2 py-0.5 text-[9px] font-bold text-emerald-300">DEMO / SIMULATED</span>
                        </div>
                        
                        <div class="space-y-2.5 text-xs">
                            <div class="flex items-center justify-between"><span class="text-gray-400">Project</span><span class="font-bold text-white">North Kalimantan Palm</span></div>
                            <div class="flex items-center justify-between"><span class="text-gray-400">Batch ID</span><span class="font-mono font-bold text-emerald-300">NK-001</span></div>
                            <div class="flex items-center justify-between"><span class="text-gray-400">Area</span><span class="font-bold text-white">100 HA</span></div>
                            <div class="flex items-center justify-between"><span class="text-gray-400">Production Requirement</span><span class="font-bold text-emerald-300">Rp15,000,000,000</span></div>
                            <div class="flex items-center justify-between border-t border-white/10 pt-2"><span class="text-gray-400">Development / Ramp-Up</span><span class="font-bold text-white">5 YEARS</span></div>
                            <div class="flex items-center justify-between"><span class="text-gray-400">Commercial Delivery Horizon</span><span class="font-bold text-white">15 YEARS</span></div>
                            <div class="flex items-center justify-between"><span class="text-gray-400">Contract Horizon</span><span class="font-bold text-white">20 YEARS</span></div>
                            <div class="flex items-center justify-between border-t border-white/10 pt-2"><span class="text-gray-400">Current Status</span><span class="font-bold text-amber-300">DEMO / SIMULATED</span></div>
                        </div>

                        <div class="rounded-lg border border-white/10 bg-white/5 p-3 text-[10px] text-gray-300 leading-relaxed">
                            Prototype batch currently in early development stage. Commercial delivery workflow opens after harvest & physical verification.
                        </div>
                    </div>
                </div>

                <!-- Right Column: Visual Lifecycle Diagram (8 cols) -->
                <div class="lg:col-span-8">
                    <div class="<?= $card ?> p-5 space-y-4 h-full flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between border-b border-white/10 pb-3">
                                <div>
                                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-white">02 / COMMERCIAL PRODUCTION LIFECYCLE</h3>
                                    <p class="text-[10px] text-gray-400 mt-0.5">End-to-end physical output tracking from field harvest to commercial settlement</p>
                                </div>
                                <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-mono font-bold text-emerald-300 border border-emerald-500/30">11 STAGES</span>
                            </div>

                            <!-- Horizontal Stage Flow Grid -->
                            <div class="grid grid-cols-2 gap-2.5 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 pt-4">
                                
                                <?php
                                $lifecycle = [
                                    ['stage' => '01 PRODUCTION', 'name' => 'Production Readiness', 'status' => 'IN DEVELOPMENT', 'cls' => 'text-emerald-300 border-emerald-500/40 bg-emerald-950/60'],
                                    ['stage' => '02 HARVEST',    'name' => 'Harvest Record',       'status' => 'NOT STARTED',    'cls' => 'text-amber-300 border-amber-500/30 bg-amber-950/40'],
                                    ['stage' => '03 WEIGHING',   'name' => 'Physical Scale Log',   'status' => 'PENDING',        'cls' => 'text-amber-300 border-amber-500/30 bg-amber-950/40'],
                                    ['stage' => '04 QUALITY',    'name' => 'Quality Control',      'status' => 'NOT INSPECTED',  'cls' => 'text-gray-300 border-white/10 bg-white/5'],
                                    ['stage' => '05 PROCESSING', 'name' => 'Refining / Processing', 'status' => 'NOT STARTED',   'cls' => 'text-gray-300 border-white/10 bg-white/5'],
                                    ['stage' => '06 PRODUCT',    'name' => 'Product Output (CPO)', 'status' => 'PENDING',        'cls' => 'text-gray-300 border-white/10 bg-white/5'],
                                    ['stage' => '07 BUYER',      'name' => 'Offtake Allocation',   'status' => 'MAPPED',         'cls' => 'text-emerald-300 border-emerald-500/40 bg-emerald-950/60'],
                                    ['stage' => '08 DELIVERY',   'name' => 'Logistics Dispatch',   'status' => 'NOT READY',      'cls' => 'text-gray-400 border-white/10 bg-white/5'],
                                    ['stage' => '09 ACCEPTANCE', 'name' => 'Buyer Acceptance',     'status' => 'NOT AVAILABLE',  'cls' => 'text-gray-400 border-white/10 bg-white/5'],
                                    ['stage' => '10 SETTLEMENT', 'name' => 'Commercial Settlement','status' => 'NOT AVAILABLE',  'cls' => 'text-gray-400 border-white/10 bg-white/5'],
                                    ['stage' => '11 COMPLETION', 'name' => 'Batch Closed & Review', 'status' => 'NOT COMPLETED',  'cls' => 'text-gray-400 border-white/10 bg-white/5'],
                                ];
                                foreach ($lifecycle as $item):
                                ?>
                                    <div class="rounded-lg border p-2.5 transition hover:border-emerald-400/50 space-y-1.5 <?= $item['cls'] ?>">
                                        <div class="text-[8px] font-mono tracking-wider opacity-80 uppercase"><?= $item['stage'] ?></div>
                                        <div class="text-[11px] font-bold text-white leading-tight"><?= $item['name'] ?></div>
                                        <div class="text-[9px] font-mono font-semibold uppercase tracking-wide opacity-90"><?= $item['status'] ?></div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>

                        <div class="pt-3 border-t border-white/10 flex items-center justify-between text-[10px] font-mono text-gray-400">
                            <span>NINA Protocol Flow Requirement #15</span>
                            <span class="text-emerald-300">Verified Evidence Chain Active</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ---------- 6. STAGE 01 (PRODUCTION READINESS) & 7. STAGE 02 (HARVEST RECORD) ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                <!-- STAGE 01 — PRODUCTION READINESS -->
                <div class="<?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <span class="text-[9px] font-mono text-emerald-400 font-bold tracking-wider uppercase">STAGE 01</span>
                            <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-white">03 / PRODUCTION READINESS</h3>
                        </div>
                        <span class="rounded border border-emerald-400/40 bg-emerald-950/80 px-2 py-0.5 text-[9px] font-bold text-emerald-300">IN DEVELOPMENT</span>
                    </div>

                    <div class="grid grid-cols-2 gap-2.5 text-xs">
                        <div class="rounded-lg border border-white/10 bg-white/5 p-2.5">
                            <span class="text-[9px] text-gray-400 block">Batch</span>
                            <strong class="text-white font-mono">NK-001</strong>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-white/5 p-2.5">
                            <span class="text-[9px] text-gray-400 block">Area</span>
                            <strong class="text-white">100 HA</strong>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-white/5 p-2.5">
                            <span class="text-[9px] text-gray-400 block">Region</span>
                            <strong class="text-white">North Kalimantan</strong>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-white/5 p-2.5">
                            <span class="text-[9px] text-gray-400 block">Production Partner</span>
                            <strong class="text-amber-300">Pending Verification</strong>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-white/5 p-2.5">
                            <span class="text-[9px] text-gray-400 block">Production Standard</span>
                            <strong class="text-white text-[11px]">Standardized Agronomic Protocol</strong>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-white/5 p-2.5">
                            <span class="text-[9px] text-gray-400 block">Seed Type & Density</span>
                            <strong class="text-white text-[11px]">Certified Superior Seed (143/HA)</strong>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-2 border-t border-white/10">
                        <span class="text-[10px] text-gray-400">Production Evidence: <strong class="text-amber-300">Pending Field Upload</strong></span>
                        <a href="<?= $basePrefix ?>/milestones" class="inline-flex items-center gap-1.5 rounded bg-emerald-950 px-3 py-1.5 text-[10px] font-bold text-emerald-300 border border-emerald-400/40 hover:bg-emerald-900 transition">
                            <span>VIEW PRODUCTION EXECUTION</span><?= $svg($ic['arrow'], 'w-3 h-3') ?>
                        </a>
                    </div>
                </div>

                <!-- STAGE 02 — HARVEST RECORD -->
                <div class="<?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <span class="text-[9px] font-mono text-amber-400 font-bold tracking-wider uppercase">STAGE 02</span>
                            <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-white">04 / HARVEST RECORD</h3>
                        </div>
                        <span class="rounded border border-amber-400/40 bg-amber-950/80 px-2 py-0.5 text-[9px] font-bold text-amber-300">NOT STARTED</span>
                    </div>

                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div class="flex justify-between border-b border-white/5 py-1.5"><span class="text-gray-400">Harvest ID</span><span class="font-mono text-white font-semibold">HARV-NK-001-001</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1.5"><span class="text-gray-400">Batch</span><span class="font-mono text-white">NK-001</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1.5"><span class="text-gray-400">Harvest Area</span><span class="text-white">100 HA</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1.5"><span class="text-gray-400">Harvest Date</span><span class="text-amber-300">Pending</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1.5"><span class="text-gray-400">Harvest Volume</span><span class="text-amber-300">Pending</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1.5"><span class="text-gray-400">Verification</span><span class="text-amber-300">Pending</span></div>
                    </div>

                    <!-- Benchmark Note Card -->
                    <div class="rounded-lg border border-emerald-500/30 bg-emerald-950/40 p-3 space-y-1">
                        <div class="flex items-center justify-between text-[10px] font-bold text-emerald-300">
                            <span>MODELED ANNUAL TBS CAPACITY (BENCHMARK)</span>
                            <span class="font-mono text-white text-xs">1,803 T / YEAR</span>
                        </div>
                        <p class="text-[9px] text-gray-300 leading-tight">
                            Benchmark basis: 18.03 t TBS/ha/year × 100 ha = 1,803 t TBS/year. Labelled as <strong>MODELLED CAPACITY</strong> — not guaranteed actual production.
                        </p>
                    </div>
                </div>

            </section>

            <!-- ---------- 8. MODEL VS ACTUAL TABLE ---------- -->
            <section class="<?= $card ?> p-5 space-y-4">
                <div class="flex items-center justify-between border-b border-white/10 pb-3">
                    <div>
                        <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-white">05 / MODEL vs ACTUAL COMPARISON</h3>
                        <p class="text-[10px] text-gray-400">Clear institutional distinction between planning benchmarks and verified physical output</p>
                    </div>
                    <span class="rounded border border-emerald-400/40 bg-emerald-950/70 px-2 py-0.5 text-[9px] font-bold text-emerald-300">INSTITUTIONAL ASSURANCE</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs font-mono">
                        <thead>
                            <tr class="border-b border-white/10 text-gray-400 text-[10px] uppercase">
                                <th class="py-2 px-3">Metric</th>
                                <th class="py-2 px-3 text-emerald-300">Model Assumption</th>
                                <th class="py-2 px-3 text-amber-300">Verified Actual</th>
                                <th class="py-2 px-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5 text-gray-200">
                            <tr>
                                <td class="py-2.5 px-3 font-semibold text-white">Production Area</td>
                                <td class="py-2.5 px-3 text-emerald-300 font-bold">100 HA</td>
                                <td class="py-2.5 px-3 text-amber-300">Pending Field GIS</td>
                                <td class="py-2.5 px-3 text-gray-400">Planning Model</td>
                            </tr>
                            <tr>
                                <td class="py-2.5 px-3 font-semibold text-white">TBS / HA / Year</td>
                                <td class="py-2.5 px-3 text-emerald-300 font-bold">18.03 T</td>
                                <td class="py-2.5 px-3 text-amber-300">Pending Harvest</td>
                                <td class="py-2.5 px-3 text-gray-400">Planning Model</td>
                            </tr>
                            <tr>
                                <td class="py-2.5 px-3 font-semibold text-white">Annual TBS Output</td>
                                <td class="py-2.5 px-3 text-emerald-300 font-bold">1,803 T</td>
                                <td class="py-2.5 px-3 text-amber-300">Pending Harvest</td>
                                <td class="py-2.5 px-3 text-gray-400">Planning Model</td>
                            </tr>
                            <tr>
                                <td class="py-2.5 px-3 font-semibold text-white">Oil Extraction Rate (OER)</td>
                                <td class="py-2.5 px-3 text-emerald-300 font-bold">20% Assumption</td>
                                <td class="py-2.5 px-3 text-amber-300">Pending Processing</td>
                                <td class="py-2.5 px-3 text-gray-400">Configurable Parameter</td>
                            </tr>
                            <tr>
                                <td class="py-2.5 px-3 font-semibold text-white">CPO Product Output</td>
                                <td class="py-2.5 px-3 text-emerald-300 font-bold">360.6 T</td>
                                <td class="py-2.5 px-3 text-amber-300">Pending Processing</td>
                                <td class="py-2.5 px-3 text-gray-400">Planning Model</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="rounded-lg bg-black/40 border border-white/10 p-3 text-[10px] text-gray-400 italic">
                    Note: Modelled values are planning assumptions / benchmark-based calculations and are not guaranteed project output. NINA requires verified physical weighing & processing records before recognizing actual output.
                </div>
            </section>

            <!-- ---------- 9. WEIGHING, 10. WEIGHBRIDGE, 11. QUALITY CONTROL ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <!-- 06 / WEIGHING & RECEIVING -->
                <div class="<?= $card ?> p-5 space-y-3">
                    <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">06 / WEIGHING & RECEIVING</h3>
                        <span class="rounded bg-amber-950 px-2 py-0.5 text-[9px] font-bold text-amber-300 border border-amber-500/30">WAITING</span>
                    </div>
                    <div class="text-[10px] text-gray-400">Physical Output Measurement</div>
                    <div class="space-y-1.5 text-xs font-mono">
                        <div class="flex justify-between"><span class="text-gray-400">Weighing ID</span><span class="text-white">WGH-NK-001-001</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Harvest Ref</span><span class="text-white">HARV-NK-001-001</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Weight</span><span class="text-amber-300">Pending</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Weighbridge</span><span class="text-amber-300">Pending</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Location</span><span class="text-amber-300">Pending</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Operator</span><span class="text-amber-300">Pending</span></div>
                    </div>
                </div>

                <!-- 07 / WEIGHING EVIDENCE -->
                <div class="<?= $card ?> p-5 space-y-3">
                    <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">07 / WEIGHING EVIDENCE</h3>
                        <span class="rounded bg-white/5 px-2 py-0.5 text-[9px] text-gray-400">SCALE LOG</span>
                    </div>
                    <div class="grid grid-cols-3 gap-2 text-center text-xs font-mono pt-1">
                        <div class="rounded border border-white/10 bg-white/5 p-2">
                            <span class="text-[8px] text-gray-400 block">GROSS</span>
                            <strong class="text-white">—</strong>
                        </div>
                        <div class="rounded border border-white/10 bg-white/5 p-2">
                            <span class="text-[8px] text-gray-400 block">TARE</span>
                            <strong class="text-white">—</strong>
                        </div>
                        <div class="rounded border border-emerald-500/30 bg-emerald-950/40 p-2">
                            <span class="text-[8px] text-emerald-300 block">NET TBS</span>
                            <strong class="text-emerald-300">—</strong>
                        </div>
                    </div>
                    <div class="pt-2">
                        <button type="button" disabled class="w-full rounded bg-white/5 border border-white/10 px-3 py-1.5 text-[10px] font-mono font-bold text-gray-400 cursor-not-allowed">
                            VIEW WEIGHING RECORD
                        </button>
                    </div>
                </div>

                <!-- 08 / QUALITY CONTROL -->
                <div class="<?= $card ?> p-5 space-y-3">
                    <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">08 / QUALITY CONTROL</h3>
                        <span class="rounded bg-white/5 px-2 py-0.5 text-[9px] text-gray-400">QC MATRIX</span>
                    </div>
                    <div class="space-y-1.5 text-xs font-mono">
                        <div class="flex justify-between"><span class="text-gray-400">Product Raw</span><span class="text-white">TBS / Raw Material</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Quality Status</span><span class="text-amber-300">Pending</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Acceptance Status</span><span class="text-amber-300">Pending</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Inspection Log</span><span class="text-gray-400">Not Submitted</span></div>
                    </div>
                    <div class="flex items-center gap-1 text-[8px] font-mono text-gray-400 justify-between border-t border-white/10 pt-2">
                        <span class="px-1.5 py-0.5 bg-white/5 rounded text-amber-300">NOT INSPECTED</span>
                        <span>→</span>
                        <span class="px-1.5 py-0.5 bg-white/5 rounded">INSPECTED</span>
                        <span>→</span>
                        <span class="px-1.5 py-0.5 bg-white/5 rounded text-emerald-300">ACCEPTED</span>
                    </div>
                </div>

            </section>

            <!-- ---------- 12. PROCESSING, 13. FACILITY, 14. OER & CONVERSION ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-12">

                <!-- 09 / PROCESSING RECORD (4 cols) -->
                <div class="lg:col-span-4 <?= $card ?> p-5 space-y-3">
                    <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">09 / PROCESSING</h3>
                        <span class="rounded bg-gray-800 px-2 py-0.5 text-[9px] text-gray-300">NOT STARTED</span>
                    </div>
                    <div class="text-[10px] text-gray-400">From Raw Output to Processed Product</div>
                    <div class="space-y-2 text-xs font-mono">
                        <div class="flex justify-between"><span class="text-gray-400">Processing ID</span><span class="text-white">PROC-NK-001-001</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Input</span><span class="text-white">TBS (Fresh Fruit Bunches)</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Facility</span><span class="text-amber-300">Pending</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Output Product</span><span class="text-emerald-300">CPO / Palm Oil Product</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Verification</span><span class="text-amber-300">Pending</span></div>
                    </div>
                </div>

                <!-- 10 / DESIGNATED PROCESSING PARTNER (4 cols) -->
                <div class="lg:col-span-4 <?= $card ?> p-5 space-y-3 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                            <h3 class="text-xs font-mono font-bold uppercase text-white">DESIGNATED PROCESSING PARTNER</h3>
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">DOWNSTREAM</span>
                        </div>
                        <div class="space-y-2 text-xs font-mono pt-2">
                            <div class="flex justify-between"><span class="text-gray-400">Processing Entity</span><span class="text-amber-300">Pending Partner</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Facility Region</span><span class="text-white">North Kalimantan</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Milling Capacity</span><span class="text-white">Pending Verification</span></div>
                        </div>
                    </div>
                    <button type="button" disabled class="w-full rounded bg-white/5 border border-white/10 px-3 py-1.5 text-[10px] font-mono font-bold text-gray-400 cursor-not-allowed">
                        VIEW PROCESSING ENTITY
                    </button>
                </div>

                <!-- 10 / PROCESSING CONVERSION MODEL (4 cols) -->
                <div class="lg:col-span-4 <?= $card ?> p-5 space-y-3">
                    <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">10 / PROCESSING CONVERSION</h3>
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300">MODEL</span>
                    </div>
                    <div class="rounded bg-black/40 border border-emerald-500/30 p-3 space-y-2 font-mono text-xs">
                        <div class="flex justify-between text-gray-300"><span>OER Model Parameter:</span><strong class="text-emerald-300">20%</strong></div>
                        <div class="text-[10px] text-gray-400">Calculation Example:</div>
                        <div class="text-[11px] text-white font-bold bg-white/5 p-1.5 rounded text-center">
                            1,803 T TBS × 20% OER = 360.6 T CPO
                        </div>
                    </div>
                    <div class="text-[9px] font-mono text-gray-400">
                        Refining Conversion: <strong class="text-white uppercase">CONFIGURABLE</strong> (Depends on refinery specs)
                    </div>
                </div>

            </section>

            <!-- ---------- 15. PRODUCT OUTPUT & 16. PRODUCT TRACEABILITY ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-12">

                <!-- 11 / PRODUCT RECORD (5 cols) -->
                <div class="lg:col-span-5 <?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <span class="text-[9px] font-mono text-emerald-400 font-bold uppercase">STAGE 06</span>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">11 / PRODUCT OUTPUT RECORD</h3>
                        </div>
                        <span class="rounded bg-amber-950 px-2 py-0.5 text-[9px] font-bold text-amber-300 border border-amber-500/30">PROCESSING PENDING</span>
                    </div>

                    <div class="space-y-2 text-xs font-mono">
                        <div class="flex justify-between border-b border-white/5 py-1"><span class="text-gray-400">Product ID</span><span class="text-white font-bold">PROD-NK-001-001</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span class="text-gray-400">Source Batch</span><span class="text-emerald-300 font-bold">NK-001</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span class="text-gray-400">Input Material</span><span class="text-white">TBS</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span class="text-gray-400">Processed Product</span><span class="text-white font-bold">CPO / Palm Oil Product</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span class="text-gray-400">Quantity</span><span class="text-amber-300">Pending</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span class="text-gray-400">Quality Certificate</span><span class="text-amber-300">Pending</span></div>
                        <div class="flex justify-between border-b border-white/5 py-1"><span class="text-gray-400">Traceability Status</span><span class="text-emerald-300">Lineage Mapped</span></div>
                    </div>
                </div>

                <!-- 12 / PRODUCT TRACE LINEAGE (7 cols) -->
                <div class="lg:col-span-7 <?= $card ?> p-5 space-y-4 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between border-b border-white/10 pb-3">
                            <div>
                                <h3 class="text-xs font-mono font-bold uppercase text-white">12 / PHYSICAL PRODUCT LINEAGE TRACE</h3>
                                <p class="text-[10px] text-gray-400">Cryptographic & operational lineage connecting batch to final off-taker</p>
                            </div>
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-mono text-emerald-300 font-bold border border-emerald-500/30">RWA TRACEABLE</span>
                        </div>

                        <!-- Lineage Visual Chain -->
                        <div class="flex flex-wrap items-center gap-2 pt-4 text-[10px] font-mono">
                            <span class="px-2.5 py-1 rounded bg-emerald-950 border border-emerald-500/40 text-emerald-300 font-bold">BATCH NK-001</span>
                            <span class="text-gray-500">→</span>
                            <span class="px-2.5 py-1 rounded bg-white/5 border border-white/10 text-gray-300">HARVEST HARV-001</span>
                            <span class="text-gray-500">→</span>
                            <span class="px-2.5 py-1 rounded bg-white/5 border border-white/10 text-gray-300">WEIGHING WGH-001</span>
                            <span class="text-gray-500">→</span>
                            <span class="px-2.5 py-1 rounded bg-white/5 border border-white/10 text-gray-300">PROCESSING PROC-001</span>
                            <span class="text-gray-500">→</span>
                            <span class="px-2.5 py-1 rounded bg-white/5 border border-white/10 text-gray-300">PRODUCT PROD-001</span>
                            <span class="text-gray-500">→</span>
                            <span class="px-2.5 py-1 rounded bg-white/5 border border-white/10 text-gray-300">DELIVERY DEL-001</span>
                            <span class="text-gray-500">→</span>
                            <span class="px-2.5 py-1 rounded bg-emerald-950 border border-emerald-500/40 text-emerald-300 font-bold">BUYER OFFTAKER</span>
                        </div>
                    </div>

                    <div class="text-[10px] text-gray-400 leading-relaxed border-t border-white/10 pt-3">
                        Physical product maintains an unbroken audit lineage from verified 100 HA land parcel through processing and commercial buyer delivery.
                    </div>
                </div>

            </section>

            <!-- ---------- 17. BUYER / OFFTAKE & 18. PRODUCT ALLOCATION ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                <!-- 13 / OFFTAKE REQUIREMENT -->
                <div class="<?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">13 / OFFTAKE REQUIREMENT</h3>
                            <p class="text-[10px] text-gray-400">Linked commercial demand requirement</p>
                        </div>
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">EXAMPLE / SIMULATED</span>
                    </div>

                    <div class="space-y-2 text-xs font-mono">
                        <div class="flex justify-between"><span class="text-gray-400">Linked Requirement</span><span class="text-emerald-300 font-bold">DR-2026-001</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Offtake Buyer</span><span class="text-white font-bold">Demo Offtake Buyer — Lotte (Simulated)</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Production Requirement</span><span class="text-white">1,000 HA Capacity</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Mapped Capacity</span><span class="text-emerald-300 font-bold">1,000 HA (10 × 100 HA Batches)</span></div>
                    </div>
                </div>

                <!-- 14 / COMMERCIAL ALLOCATION -->
                <div class="<?= $card ?> p-5 space-y-4 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between border-b border-white/10 pb-3">
                            <div>
                                <h3 class="text-xs font-mono font-bold uppercase text-white">14 / COMMERCIAL ALLOCATION</h3>
                                <p class="text-[10px] text-gray-400">Current batch commercial mapping</p>
                            </div>
                            <span class="rounded bg-amber-950 px-2 py-0.5 text-[9px] font-bold text-amber-300">PENDING DELIVERY</span>
                        </div>

                        <div class="space-y-2 text-xs font-mono pt-1">
                            <div class="flex justify-between"><span class="text-gray-400">Current Batch</span><span class="text-white font-bold">NK-001 (100 HA)</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Batch Allocation Share</span><span class="text-white">100 HA / 1,000 HA (10%)</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Commercial Delivery Status</span><span class="text-amber-300">Pending Harvest & Processing</span></div>
                        </div>
                    </div>

                    <a href="<?= $basePrefix ?>/demand" class="inline-flex items-center justify-center gap-2 rounded bg-emerald-950 px-4 py-2 text-xs font-mono font-bold text-emerald-300 border border-emerald-400/40 hover:bg-emerald-900 transition">
                        <span>VIEW DEMAND REQUIREMENT</span><?= $svg($ic['arrow'], 'w-3.5 h-3.5') ?>
                    </a>
                </div>

            </section>

            <!-- ---------- 19. DELIVERY RECORD, 20. TRACKING, 21. PROOF OF DELIVERY ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <!-- 15 / DELIVERY RECORD -->
                <div class="<?= $card ?> p-5 space-y-3">
                    <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">15 / LOGISTICS DELIVERY</h3>
                        <span class="rounded bg-gray-800 px-2 py-0.5 text-[9px] text-gray-300">NOT READY</span>
                    </div>
                    <div class="space-y-1.5 text-xs font-mono">
                        <div class="flex justify-between"><span class="text-gray-400">Delivery ID</span><span class="text-white">DEL-NK-001-001</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Origin</span><span class="text-white">Processing Facility</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Destination</span><span class="text-white">Buyer Offtake Facility</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Transport Partner</span><span class="text-amber-300">Pending</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Proof of Delivery</span><span class="text-amber-300">Pending</span></div>
                    </div>
                </div>

                <!-- DELIVERY TRACKING STAGES -->
                <div class="<?= $card ?> p-5 space-y-3">
                    <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">DELIVERY TRACKING FLOW</h3>
                        <span class="rounded bg-white/5 px-2 py-0.5 text-[9px] text-gray-400">WORKFLOW</span>
                    </div>
                    <div class="space-y-1 text-[9px] font-mono text-gray-400">
                        <div class="p-1 rounded bg-white/5 text-gray-300">1. PROCESSING COMPLETE</div>
                        <div class="p-1 rounded bg-white/5 text-gray-300">2. READY FOR DISPATCH</div>
                        <div class="p-1 rounded bg-white/5 text-gray-300">3. DISPATCHED</div>
                        <div class="p-1 rounded bg-white/5 text-gray-300">4. IN TRANSIT</div>
                        <div class="p-1 rounded bg-white/5 text-gray-300">5. RECEIVED & ACCEPTED</div>
                        <div class="p-1 rounded bg-emerald-950 text-emerald-300 border border-emerald-500/30">6. SETTLEMENT ELIGIBLE</div>
                    </div>
                </div>

                <!-- 16 / DELIVERY EVIDENCE -->
                <div class="<?= $card ?> p-5 space-y-3 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                            <h3 class="text-xs font-mono font-bold uppercase text-white">16 / DELIVERY EVIDENCE</h3>
                            <span class="rounded bg-amber-950 px-2 py-0.5 text-[9px] text-amber-300">PENDING</span>
                        </div>
                        <div class="space-y-1 text-[10px] font-mono text-gray-300 pt-1">
                            <div class="flex justify-between"><span>Delivery Order</span><span class="text-amber-300">Pending</span></div>
                            <div class="flex justify-between"><span>Transport Log</span><span class="text-amber-300">Pending</span></div>
                            <div class="flex justify-between"><span>Receiving Record</span><span class="text-amber-300">Pending</span></div>
                            <div class="flex justify-between"><span>Proof of Delivery</span><span class="text-amber-300">Pending</span></div>
                            <div class="flex justify-between"><span>Quality Acceptance</span><span class="text-amber-300">Pending</span></div>
                        </div>
                    </div>
                    <button type="button" disabled class="w-full rounded bg-white/5 border border-white/10 px-3 py-1.5 text-[10px] font-mono font-bold text-gray-400 cursor-not-allowed">
                        VIEW DELIVERY RECORD
                    </button>
                </div>

            </section>

            <!-- ---------- 22. BUYER ACCEPTANCE & 23. COMMERCIAL SETTLEMENT ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                <!-- 17 / BUYER ACCEPTANCE -->
                <div class="<?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">17 / BUYER ACCEPTANCE</h3>
                            <p class="text-[10px] text-gray-400">Verification before commercial settlement trigger</p>
                        </div>
                        <span class="rounded bg-gray-800 px-2 py-0.5 text-[9px] text-gray-300">NOT AVAILABLE</span>
                    </div>

                    <div class="space-y-2 text-xs font-mono">
                        <div class="flex items-center justify-between"><span class="text-gray-400">Product Processed</span><span class="text-amber-300">○ Pending</span></div>
                        <div class="flex items-center justify-between"><span class="text-gray-400">Quantity Verified</span><span class="text-amber-300">○ Pending</span></div>
                        <div class="flex items-center justify-between"><span class="text-gray-400">Quality Verified</span><span class="text-amber-300">○ Pending</span></div>
                        <div class="flex items-center justify-between"><span class="text-gray-400">Delivery Completed</span><span class="text-amber-300">○ Pending</span></div>
                        <div class="flex items-center justify-between"><span class="text-gray-400">Buyer Acceptance Recorded</span><span class="text-amber-300">○ Pending</span></div>
                    </div>
                </div>

                <!-- 18 / COMMERCIAL SETTLEMENT -->
                <div class="<?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">18 / COMMERCIAL SETTLEMENT</h3>
                            <p class="text-[10px] text-gray-400">Settlement follows verified commercial delivery</p>
                        </div>
                        <span class="rounded bg-gray-800 px-2 py-0.5 text-[9px] text-gray-300">NOT AVAILABLE</span>
                    </div>

                    <div class="space-y-2 text-xs font-mono">
                        <div class="flex justify-between"><span class="text-gray-400">Settlement ID</span><span class="text-white">SET-NK-001-001</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Seller Entity</span><span class="text-white">Designated Downstream Operating Co</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Buyer</span><span class="text-white">Demo Offtake Buyer</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Gross Commercial Value</span><span class="text-amber-300">Pending Execution</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Settlement Status</span><span class="text-gray-400">Not Available</span></div>
                    </div>
                </div>

            </section>

            <!-- ---------- 24. REGISTERED RECIPIENT & 25. SETTLEMENT TRACE ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-12">

                <!-- 19 / REGISTERED SETTLEMENT RECIPIENT (5 cols) -->
                <div class="lg:col-span-5 <?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">19 / REGISTERED SETTLEMENT RECIPIENT</h3>
                            <p class="text-[10px] text-gray-400">Authorized entity & wallet structure</p>
                        </div>
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">GOVERNANCE</span>
                    </div>

                    <div class="space-y-2 text-xs font-mono">
                        <div class="flex justify-between"><span class="text-gray-400">Recipient</span><span class="text-amber-300">Pending Contract</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Entity</span><span class="text-white">Designated Operating Co</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Registered Wallet</span><span class="text-amber-300">Pending Registration</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Settlement Method</span><span class="text-white">Verified Commercial Escrow</span></div>
                    </div>
                </div>

                <!-- 20 / SETTLEMENT TRACE (7 cols) -->
                <div class="lg:col-span-7 <?= $card ?> p-5 space-y-4 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between border-b border-white/10 pb-3">
                            <h3 class="text-xs font-mono font-bold uppercase text-white">20 / END-TO-END SETTLEMENT TRACE</h3>
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-mono text-emerald-300 border border-emerald-500/30">IMMUTABLE</span>
                        </div>

                        <div class="flex flex-wrap items-center gap-2 pt-3 text-[10px] font-mono">
                            <span class="px-2 py-1 bg-white/5 rounded">HARVEST</span> →
                            <span class="px-2 py-1 bg-white/5 rounded">WEIGHING</span> →
                            <span class="px-2 py-1 bg-white/5 rounded">PROCESSING</span> →
                            <span class="px-2 py-1 bg-white/5 rounded">PRODUCT</span> →
                            <span class="px-2 py-1 bg-white/5 rounded">BUYER</span> →
                            <span class="px-2 py-1 bg-white/5 rounded">DELIVERY</span> →
                            <span class="px-2 py-1 bg-white/5 rounded">ACCEPTANCE</span> →
                            <span class="px-2 py-1 bg-emerald-950 text-emerald-300 border border-emerald-500/40 font-bold">SETTLEMENT</span> →
                            <span class="px-2 py-1 bg-emerald-950 text-emerald-300 border border-emerald-500/40 font-bold">AUDIT TRAIL</span>
                        </div>
                    </div>

                    <a href="<?= $basePrefix ?>/audit-trail" class="text-[10px] font-mono text-emerald-300 hover:underline flex items-center gap-1">
                        <span>View complete protocol audit trail log</span><?= $svg($ic['arrow'], 'w-3 h-3') ?>
                    </a>
                </div>

            </section>

            <!-- ---------- 29 & 30. PRODUCTION MODEL VS VERIFIED ACTUAL CARDS ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                <!-- 24 / PRODUCTION MODEL -->
                <div class="<?= $card ?> p-5 space-y-4 border-l-4 border-l-emerald-400">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">24 / PRODUCTION MODEL (100 HA BENCHMARK)</h3>
                            <p class="text-[10px] text-gray-400">Modeled engineering & yield calculations</p>
                        </div>
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300">MODEL ONLY</span>
                    </div>

                    <div class="space-y-2 text-xs font-mono">
                        <div class="flex justify-between"><span class="text-gray-400">Benchmark TBS Yield</span><span class="text-white font-bold">18.03 T / HA / YEAR</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Modelled TBS (100 HA)</span><span class="text-emerald-300 font-bold">1,803 T / YEAR</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Model OER</span><span class="text-white font-bold">20%</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Modelled CPO</span><span class="text-emerald-300 font-bold">360.6 T / YEAR</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Modelled CPO Volume</span><span class="text-white font-bold">≈405,849 L / YEAR*</span></div>
                    </div>

                    <div class="text-[9px] font-mono text-gray-400 italic">
                        *using a model density assumption of 0.889 kg/L; CPO, not finished cooking oil. MODEL ONLY — NOT GUARANTEED OUTPUT.
                    </div>
                </div>

                <!-- 25 / VERIFIED ACTUAL -->
                <div class="<?= $card ?> p-5 space-y-4 border-l-4 border-l-amber-400">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">25 / VERIFIED ACTUAL PRODUCTION</h3>
                            <p class="text-[10px] text-gray-400">Audited physical output records</p>
                        </div>
                        <span class="rounded bg-amber-950 px-2 py-0.5 text-[9px] font-bold text-amber-300">NO OUTPUT YET</span>
                    </div>

                    <div class="space-y-2 text-xs font-mono">
                        <div class="flex justify-between"><span class="text-gray-400">Actual TBS Harvested</span><span class="text-amber-300">—</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Actual CPO Produced</span><span class="text-amber-300">—</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Actual Product Delivered</span><span class="text-amber-300">—</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Actual Settlement Executed</span><span class="text-amber-300">—</span></div>
                    </div>

                    <div class="rounded bg-black/40 border border-amber-500/30 p-2 text-center text-[10px] font-mono text-amber-300 font-bold">
                        NO VERIFIED COMMERCIAL OUTPUT YET
                    </div>
                </div>

            </section>

            <!-- ---------- 31. COMPLETION STATE & 32. REPUTATION TRIGGER ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                <!-- 26 / PRODUCTION COMPLETION -->
                <div class="<?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">26 / PRODUCTION COMPLETION PROTOCOL</h3>
                            <p class="text-[10px] text-gray-400">Criteria before batch closure</p>
                        </div>
                        <span class="rounded bg-gray-800 px-2 py-0.5 text-[9px] text-gray-300">NOT COMPLETED</span>
                    </div>

                    <div class="space-y-1.5 text-xs font-mono">
                        <div class="flex justify-between text-gray-400"><span>1. Production Completed</span><span class="text-emerald-300">✓ Ready</span></div>
                        <div class="flex justify-between text-gray-400"><span>2. Harvest Recorded</span><span class="text-amber-300">○ Pending</span></div>
                        <div class="flex justify-between text-gray-400"><span>3. Output Verified</span><span class="text-amber-300">○ Pending</span></div>
                        <div class="flex justify-between text-gray-400"><span>4. Processing Completed</span><span class="text-amber-300">○ Pending</span></div>
                        <div class="flex justify-between text-gray-400"><span>5. Delivery Completed</span><span class="text-amber-300">○ Pending</span></div>
                        <div class="flex justify-between text-gray-400"><span>6. Commercial Acceptance</span><span class="text-amber-300">○ Pending</span></div>
                        <div class="flex justify-between text-gray-400"><span>7. Settlement Completed</span><span class="text-amber-300">○ Pending</span></div>
                    </div>
                </div>

                <!-- 27 / REPUTATION TRIGGER -->
                <div class="<?= $card ?> p-5 space-y-4 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between border-b border-white/10 pb-3">
                            <div>
                                <h3 class="text-xs font-mono font-bold uppercase text-white">27 / COMPLETION & REPUTATION</h3>
                                <p class="text-[10px] text-gray-400">Operational history builds verified partner reputation</p>
                            </div>
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">REPUTATION SYSTEM</span>
                        </div>

                        <div class="space-y-2 text-xs font-mono pt-2">
                            <div class="flex justify-between"><span class="text-gray-400">Batch Completion</span><span class="text-amber-300">VERIFICATION PENDING</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Participant Performance Review</span><span class="text-gray-400">Locked Until Closure</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Partner Operational Score</span><span class="text-emerald-300 font-bold">Generates Post-Completion</span></div>
                        </div>
                    </div>

                    <div class="text-[10px] text-gray-400 italic border-t border-white/10 pt-3">
                        Reputation is not declared in advance; it is dynamically earned and updated strictly upon verified operational history & batch completion.
                    </div>
                </div>

            </section>

        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
?>
