<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '09 / Milestone 01 & Execution Detail — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'milestones';

/* ---------- Helpers & Icons ---------- */
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

$svg = fn(string $inner, string $cls = 'w-4 h-4') =>
    '<svg class="' . $cls . '" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">' . $inner . '</svg>';

$ic = [
    'target'    => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.5"/>',
    'leaf'      => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>',
    'calendar'  => '<path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
    'coin'      => '<circle cx="12" cy="12" r="9"/><path d="M14.5 9.5c-.5-1-1.4-1.5-2.5-1.5-1.4 0-2.5.8-2.5 2s1 1.7 2.5 2 2.5.8 2.5 2-1.1 2-2.5 2c-1.1 0-2-.5-2.5-1.5M12 6v2M12 16v2"/>',
    'grid'      => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/>',
    'pin'       => '<path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="2.5"/>',
    'check'     => '<circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 4.5-5"/>',
    'shield'    => '<path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/>',
    'clock'     => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>',
    'wallet'    => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="M16 12h.01"/>',
    'map'       => '<path d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>',
    'doc'       => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>',
];

$chev  = '<svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>';
$arrow = '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>';

$card      = 'rounded-xl border border-white/10 bg-[#0B1815]/90 shadow-xl';
$iconBox   = 'flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-emerald-100';
$metricLbl = 'text-[9px] font-medium uppercase tracking-wide text-gray-400';

ob_start();
?>

<div class="relative w-full font-sans">

    <!-- PAGE BACKGROUND (soft blurred forest) -->
    <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden">
        <img src="<?= $basePrefix ?>/1.jpg" alt="" class="h-full w-full scale-110 object-cover opacity-25 blur-md" />
        <div class="absolute inset-0 bg-gradient-to-b from-[#06120F]/60 via-[#06120F]/85 to-[#04100B]"></div>
    </div>

    <div class="relative z-10">

        <!-- ================= HERO (STYLE MATCHING BATCHES.PHP) ================= -->
        <section class="relative overflow-hidden shadow-2xl" style="border-bottom: none !important;">
            <img src="<?= $basePrefix ?>/1.jpg" alt="Natural forest canopy" class="absolute inset-0 h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#050D07]/85 via-[#050D07]/45 to-[#050D07]/10"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#06120F]/80 via-transparent to-transparent"></div>

            <div class="relative grid min-h-[250px] grid-cols-1 items-start gap-8 px-6 pt-3 pb-6 lg:grid-cols-12 lg:px-8 lg:pt-3 lg:pb-8">

                <!-- Left: breadcrumb, title, description -->
                <div class="space-y-4 lg:col-span-7">
                    <nav aria-label="Breadcrumb" class="inline-flex flex-wrap items-center gap-2 text-[10px] font-mono font-semibold uppercase tracking-[0.14em] text-gray-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                        <a href="<?= $basePrefix ?>/allocations" class="hover:text-white transition-colors">MY ALLOCATIONS</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/explore" class="hover:text-white transition-colors">NORTH KALIMANTAN PALM</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/batches" class="hover:text-white transition-colors">BATCH NK-001</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="font-bold text-white uppercase">MILESTONE 01</span>
                    </nav>

                    <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-200">
                        <span>09 / MILESTONE & EXECUTION</span>
                        <span class="rounded border border-amber-400/40 bg-amber-500/20 px-2 py-0.5 text-[9px] font-bold tracking-wider text-amber-300">PENDING VERIFICATION</span>
                    </div>

                    <h1 class="max-w-2xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">Milestone 01</h1>
                    <div class="text-lg font-bold text-emerald-300">Production Preparation & Initial Execution</div>

                    <div class="flex flex-wrap items-center gap-4 text-xs font-semibold text-gray-300 pt-1">
                        <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> Batch: <strong class="text-white">NK-001</strong></span>
                        <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> Project: <strong class="text-white">North Kalimantan Palm</strong></span>
                        <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> Operator: <strong class="text-emerald-300">PT. Kaltara 8</strong></span>
                        <span class="flex items-center gap-1.5 font-mono text-[11px] text-gray-400">ID Listing: <strong class="text-gray-200">ID-ML-0001</strong></span>
                        <span class="flex items-center gap-1.5 font-mono text-[11px] text-gray-400">No Project: <strong class="text-gray-200">PO-KAL-0001</strong></span>
                    </div>
                </div>

                <!-- Right: HERO MILESTONE STATUS CARD (MATCHING BATCHES.PHP) -->
                <div class="lg:col-span-4 lg:col-start-9">
                    <div class="space-y-4 rounded-xl border border-white/15 bg-[#08130F]/70 p-5 shadow-2xl backdrop-blur-xl">
                        <div class="flex items-center justify-between border-b border-white/10 pb-2">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-white">MILESTONE STATUS</span>
                            <span class="rounded border border-amber-400/40 bg-amber-950/80 px-2 py-0.5 text-[9px] font-bold text-amber-300">● PENDING</span>
                        </div>
                        
                        <div class="space-y-2 text-xs">
                            <div class="flex justify-between text-gray-400"><span class="font-medium">Target</span><span class="font-bold text-emerald-300">25%</span></div>
                            <div class="flex justify-between text-gray-400"><span class="font-medium">Execution Stage</span><span class="font-bold text-white">Stage 01</span></div>
                        </div>

                        <div class="space-y-1 text-xs border-t border-white/10 pt-2">
                            <div class="flex justify-between text-[10px] font-bold uppercase text-gray-400 mb-1">
                                <span>Required Conditions</span>
                                <span class="text-amber-300">0 / 5 READY</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-300 text-[11px]"><span class="text-gray-500">○</span> PO Collection</div>
                            <div class="flex items-center gap-2 text-gray-300 text-[11px]"><span class="text-gray-500">○</span> RAB Confirmation</div>
                            <div class="flex items-center gap-2 text-gray-300 text-[11px]"><span class="text-gray-500">○</span> Vendor Assignment</div>
                            <div class="flex items-center gap-2 text-gray-300 text-[11px]"><span class="text-gray-500">○</span> Field Verification</div>
                            <div class="flex items-center gap-2 text-gray-300 text-[11px]"><span class="text-gray-500">○</span> Execution Approval</div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ================= CONTENT (PADDING MATCHING BATCHES.PHP) ================= -->
        <div class="space-y-5 px-4 pb-16 pt-5 sm:px-6 lg:px-8">

            <!-- ---------- TOP KPI STRIP (5 CARDS) ---------- -->
            <section class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-5">

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['target']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">MILESTONE</div>
                        <div class="text-xl font-extrabold leading-tight text-white">01</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['grid']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">TARGET</div>
                        <div class="text-xl font-extrabold leading-tight text-emerald-300">25%</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['leaf']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">BATCH</div>
                        <div class="text-xl font-extrabold leading-tight text-white">100 HA</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['coin']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">BATCH REQUIREMENT</div>
                        <div class="text-xl font-extrabold leading-tight text-white">880,000 USDT</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['clock']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">MILESTONE STATUS</div>
                        <div class="text-xl font-extrabold leading-tight text-amber-300 flex items-center gap-1.5">
                            <span class="h-2 w-2 rounded-full bg-amber-400"></span> PENDING
                        </div>
                    </div>
                </div>

            </section>

            <!-- ---------- MAIN GRID: 8 COLS LEFT, 4 COLS RIGHT STICKY ---------- -->
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-12 items-start">

                <!-- LEFT MAIN CONTENT (8 COLS) -->
                <div class="space-y-5 lg:col-span-8">

                    <!-- ROW 1: MILESTONE OBJECTIVE + REQUIRED CONDITIONS & MILESTONE STATE -->
                    <div class="space-y-4">
                        <!-- Milestone Objective -->
                        <div class="<?= $card ?> p-5 space-y-2">
                            <div class="flex items-center gap-2 text-xs font-bold text-white uppercase tracking-wider">
                                <?= $svg($ic['doc'], 'w-4 h-4 text-emerald-300') ?>
                                <span>Milestone Objective</span>
                            </div>
                            <p class="text-xs text-gray-300 leading-relaxed">
                                Milestone 01 represents the first defined execution stage of Batch NK-001. It connects the approved production requirement with the operational activities required before the next execution stage can begin.
                            </p>
                        </div>

                        <!-- Required Conditions & Milestone State Side by Side -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                            <!-- Required Conditions Card -->
                            <div class="<?= $card ?> p-4 space-y-3">
                                <div class="flex items-center gap-2 text-xs font-bold text-white border-b border-white/10 pb-2 uppercase tracking-wider">
                                    <?= $svg($ic['check'], 'w-4 h-4 text-emerald-300') ?>
                                    <span>Required Conditions</span>
                                </div>
                                <div class="space-y-2 text-xs">
                                    <div class="flex items-center justify-between py-1 border-b border-white/5">
                                        <span class="text-gray-300 font-medium">01 PO COLLECTION</span>
                                        <span class="rounded bg-amber-500/20 px-2 py-0.5 text-[9px] font-bold text-amber-300 border border-amber-400/30">● PENDING</span>
                                    </div>
                                    <div class="flex items-center justify-between py-1 border-b border-white/5">
                                        <span class="text-gray-300 font-medium">02 RAB CONFIRMATION</span>
                                        <span class="rounded bg-amber-500/20 px-2 py-0.5 text-[9px] font-bold text-amber-300 border border-amber-400/30">● PENDING</span>
                                    </div>
                                    <div class="flex items-center justify-between py-1 border-b border-white/5">
                                        <span class="text-gray-300 font-medium">03 VENDOR ASSIGNMENT</span>
                                        <span class="rounded bg-amber-500/20 px-2 py-0.5 text-[9px] font-bold text-amber-300 border border-amber-400/30">● PENDING</span>
                                    </div>
                                    <div class="flex items-center justify-between py-1 border-b border-white/5">
                                        <span class="text-gray-300 font-medium">04 FIELD VERIFICATION</span>
                                        <span class="rounded bg-amber-500/20 px-2 py-0.5 text-[9px] font-bold text-amber-300 border border-amber-400/30">● PENDING</span>
                                    </div>
                                    <div class="flex items-center justify-between py-1">
                                        <span class="text-gray-300 font-medium">05 EXECUTION APPROVAL</span>
                                        <span class="rounded bg-amber-500/20 px-2 py-0.5 text-[9px] font-bold text-amber-300 border border-amber-400/30">● PENDING</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Milestone State Card (Vertical List) -->
                            <div class="<?= $card ?> p-4 space-y-3">
                                <div class="flex items-center justify-between border-b border-white/10 pb-2">
                                    <div class="text-xs font-bold text-white uppercase tracking-wider">Milestone State</div>
                                    <span class="text-[9px] font-bold text-amber-300">Active State: Pending</span>
                                </div>

                                <div class="grid grid-cols-1 gap-2 text-xs sm:grid-cols-2">
                                    <div class="space-y-1.5">
                                        <div class="flex items-center gap-2 font-bold text-amber-300">
                                            <span class="h-3 w-3 rounded-full border-2 border-amber-400 bg-amber-400"></span> Pending
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-400">
                                            <span class="h-3 w-3 rounded-full border border-white/30"></span> Ready for Execution
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-400">
                                            <span class="h-3 w-3 rounded-full border border-white/30"></span> In Execution
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-400">
                                            <span class="h-3 w-3 rounded-full border border-white/30"></span> Submitted for Verification
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-400">
                                            <span class="h-3 w-3 rounded-full border border-white/30"></span> Verified
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-400">
                                            <span class="h-3 w-3 rounded-full border border-white/30"></span> Approved
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-400">
                                            <span class="h-3 w-3 rounded-full border border-white/30"></span> Completed
                                        </div>
                                    </div>

                                    <div class="space-y-1.5 border-l border-white/10 pl-3">
                                        <div class="text-[9px] font-bold uppercase tracking-wider text-gray-400 mb-1">Other States</div>
                                        <div class="rounded border border-rose-500/30 bg-rose-950/40 px-2 py-1 text-[10px] font-bold text-rose-300">Rejected</div>
                                        <div class="rounded border border-amber-500/30 bg-amber-950/40 px-2 py-1 text-[10px] font-bold text-amber-300">Requires Correction</div>
                                        <div class="rounded border border-gray-600 bg-gray-800 px-2 py-1 text-[10px] font-bold text-gray-300">On Hold</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- ROW 2: RAB ALLOCATION & VENDOR ASSIGNMENT -->
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12 items-stretch">

                        <!-- RAB Allocation (Span 7) -->
                        <div class="<?= $card ?> p-4 lg:col-span-7 space-y-4 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">RAB Allocation</h3>
                                    <p class="text-[10px] text-gray-400">Every milestone must be connected to defined production requirements and budget categories.</p>
                                </div>

                                <!-- 3 Sub-KPI Cards -->
                                <div class="grid grid-cols-3 gap-2 text-center text-xs">
                                    <div class="rounded-lg border border-white/10 bg-[#07110E] p-2">
                                        <div class="text-[8px] uppercase text-gray-400">BATCH REQUIREMENT</div>
                                        <div class="text-xs font-extrabold text-white mt-0.5">880,000 USDT</div>
                                    </div>
                                    <div class="rounded-lg border border-white/10 bg-[#07110E] p-2">
                                        <div class="text-[8px] uppercase text-gray-400">PLANNED EXECUTION</div>
                                        <div class="text-xs font-extrabold text-emerald-300 mt-0.5">25%</div>
                                        <div class="text-[7px] italic text-gray-500">*Model calculation only</div>
                                    </div>
                                    <div class="rounded-lg border border-white/10 bg-[#07110E] p-2">
                                        <div class="text-[8px] uppercase text-gray-400">Illustrative Allocation</div>
                                        <div class="text-xs font-extrabold text-gray-200 mt-0.5">220,000 USDT</div>
                                    </div>
                                </div>

                                <!-- RAB Category Table -->
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-gray-300 mb-1.5">RAB Category</div>
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-left text-[11px] text-gray-300">
                                            <thead>
                                                <tr class="border-b border-white/10 text-[8px] uppercase tracking-wider text-gray-400">
                                                    <th class="py-1 px-2">Category</th>
                                                    <th class="py-1 px-2">Allocation</th>
                                                    <th class="py-1 px-2">Status</th>
                                                    <th class="py-1 px-2">Vendor</th>
                                                    <th class="py-1 px-2">Execution</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-white/5">
                                                <?php
                                                $rabCats = [
                                                    'Land / Partnership', 'Land Preparation', 'Seedlings', 'Fertilizer & Inputs',
                                                    'Machinery & Equipment', 'Infrastructure', 'Maintenance', 'Operations'
                                                ];
                                                foreach ($rabCats as $cat):
                                                ?>
                                                    <tr>
                                                        <td class="py-1 px-2 font-medium text-white"><?= $cat ?></td>
                                                        <td class="py-1 px-2 text-gray-500">&mdash;</td>
                                                        <td class="py-1 px-2"><span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">Pending</span></td>
                                                        <td class="py-1 px-2 text-gray-500">&mdash;</td>
                                                        <td class="py-1 px-2 text-gray-500">&mdash;</td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <a href="<?= $basePrefix ?>/batches#rab-section" class="inline-flex items-center gap-1.5 rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-[10px] font-bold uppercase text-gray-300 transition hover:bg-white/10 w-fit">
                                <span>VIEW FULL RAB</span><?= $arrow ?>
                            </a>
                        </div>

                        <!-- Vendor Assignment (Span 5) -->
                        <div class="<?= $card ?> p-4 lg:col-span-5 space-y-3 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">Vendor Assignment</h3>
                                    <p class="text-[10px] text-gray-400">Vendors are connected to specific RAB categories and execution requirements.</p>
                                </div>

                                <div class="space-y-2 text-xs">
                                    <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-1">
                                        <div class="flex justify-between text-[10px] font-bold text-emerald-300"><span>Land Preparation</span><span class="text-amber-300">● PENDING</span></div>
                                        <div class="font-bold text-white text-[11px]">Demo Heavy Equipment Partner</div>
                                        <a href="#vendor-section" class="inline-flex items-center gap-1 text-[9px] font-bold text-emerald-300 hover:underline">VIEW VENDOR &rsaquo;</a>
                                    </div>

                                    <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-1">
                                        <div class="flex justify-between text-[10px] font-bold text-emerald-300"><span>Seed</span><span class="text-amber-300">● PENDING</span></div>
                                        <div class="font-bold text-white text-[11px]">Certified Seed Producer</div>
                                        <a href="#vendor-section" class="inline-flex items-center gap-1 text-[9px] font-bold text-emerald-300 hover:underline">VIEW VENDOR &rsaquo;</a>
                                    </div>

                                    <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-1">
                                        <div class="flex justify-between text-[10px] font-bold text-emerald-300"><span>Fertilizer</span><span class="text-amber-300">● PENDING</span></div>
                                        <div class="font-bold text-white text-[11px]">Demo Input Supplier</div>
                                        <a href="#vendor-section" class="inline-flex items-center gap-1 text-[9px] font-bold text-emerald-300 hover:underline">VIEW VENDOR &rsaquo;</a>
                                    </div>

                                    <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-1">
                                        <div class="flex justify-between text-[10px] font-bold text-emerald-300"><span>Logistics</span><span class="text-amber-300">● PENDING</span></div>
                                        <div class="font-bold text-white text-[11px]">Demo Logistics Partner</div>
                                        <a href="#vendor-section" class="inline-flex items-center gap-1 text-[9px] font-bold text-emerald-300 hover:underline">VIEW VENDOR &rsaquo;</a>
                                    </div>
                                </div>
                            </div>

                            <div class="text-[9px] font-bold uppercase text-gray-400 border-t border-white/5 pt-2">0 / 4 ASSIGNED</div>
                        </div>

                    </div>

                    <!-- ROW 3: FIELD EXECUTION, FIELD EVIDENCE & GIS VERIFICATION -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                        <!-- Field Execution -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">Field Execution</h3>
                                    <p class="text-[9px] text-gray-400">Track field execution and activity progress.</p>
                                </div>

                                <div class="space-y-1.5">
                                    <div class="flex justify-between text-[11px] font-bold">
                                        <span class="text-white">LAND PREPARATION</span>
                                        <span class="text-emerald-300">0% &bull; NOT STARTED</span>
                                    </div>
                                    <div class="h-2 w-full overflow-hidden rounded-full bg-white/10">
                                        <div class="h-full w-0 rounded-full bg-emerald-400"></div>
                                    </div>
                                </div>

                                <!-- Horizontal Continuous Pipeline -->
                                <div class="relative w-full pt-2 pb-1">
                                    <div class="absolute top-[19px] left-[16px] right-[16px] h-[2px] bg-white/20 z-0"></div>
                                    <div class="relative z-10 flex items-start justify-between text-center text-[9px]">
                                        <?php
                                        $fieldSteps = [
                                            'Site Access', 'Clearing / Preparation', 'Drainage / Infrastructure', 'Planting Preparation', 'Completion'
                                        ];
                                        foreach ($fieldSteps as $sIdx => $sName):
                                        ?>
                                            <div class="flex flex-col items-center gap-1 min-w-[50px]">
                                                <div class="h-5 w-5 rounded-full border border-white/30 bg-[#07110E] text-gray-400 text-[9px] flex items-center justify-center font-bold z-10">
                                                    ○
                                                </div>
                                                <div class="text-[8px] text-gray-300 font-medium leading-tight max-w-[55px]"><?= $sName ?></div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Field Evidence -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-2">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">Field Evidence</h3>
                                    <p class="text-[9px] text-gray-400">Upload and verify field execution evidence.</p>
                                </div>

                                <div class="rounded-lg border border-white/10 bg-[#07110E] overflow-hidden p-2 space-y-2">
                                    <div class="relative h-24 rounded overflow-hidden">
                                        <img src="<?= $basePrefix ?>/1.jpg" class="h-full w-full object-cover" />
                                        <span class="absolute top-1.5 left-1.5 rounded bg-black/80 px-2 py-0.5 text-[8px] text-emerald-300 font-bold border border-white/10">DEMO IMAGE</span>
                                    </div>
                                    <div class="text-[10px] space-y-0.5">
                                        <div class="font-bold text-white">FIELD UPDATE #001 &bull; Land Preparation</div>
                                        <div class="text-gray-400">North Kalimantan &bull; 2026-04-12</div>
                                        <div class="text-amber-300 font-bold">Status: ● IN PROGRESS</div>
                                    </div>
                                </div>
                            </div>

                            <a href="#evidence-section" class="inline-flex items-center gap-1.5 text-[10px] font-bold text-emerald-300 hover:text-emerald-200">
                                <span>VIEW ALL EVIDENCE</span><?= $arrow ?>
                            </a>
                        </div>

                        <!-- GIS Verification (Satellite Map with Cyan Boundary) -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-2">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">GIS Verification</h3>
                                    <p class="text-[9px] text-gray-400">Verify location and area accuracy.</p>
                                </div>

                                <div class="rounded-lg border border-white/10 bg-[#07110E] p-2 space-y-2">
                                    <div class="relative h-24 rounded overflow-hidden border border-emerald-400/30">
                                        <img src="<?= $basePrefix ?>/2.jpg" class="h-full w-full object-cover opacity-70" />
                                        <!-- Polygon GIS Overlay -->
                                        <svg class="absolute inset-0 h-full w-full pointer-events-none" viewBox="0 0 100 100" preserveAspectRatio="none">
                                            <polygon points="15,20 85,15 90,75 25,85 10,55" fill="rgba(110, 231, 183, 0.2)" stroke="#6EE7B7" stroke-width="2" stroke-dasharray="3,3" />
                                        </svg>
                                        <div class="absolute top-1.5 right-1.5 bg-black/80 backdrop-blur-md rounded px-2 py-0.5 text-right border border-white/10">
                                            <div class="text-[10px] font-extrabold text-white">NK-001</div>
                                            <div class="text-[8px] text-emerald-300 font-bold">100 HA</div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-x-2 gap-y-1 text-[9px]">
                                        <div class="flex justify-between"><span class="text-gray-400">Boundary</span><span class="text-amber-300 font-bold">● PENDING</span></div>
                                        <div class="flex justify-between"><span class="text-gray-400">Coordinates</span><span class="text-amber-300 font-bold">● PENDING</span></div>
                                        <div class="flex justify-between"><span class="text-gray-400">Area Match</span><span class="text-amber-300 font-bold">● PENDING</span></div>
                                        <div class="flex justify-between"><span class="text-gray-400">Site Access</span><span class="text-amber-300 font-bold">● PENDING</span></div>
                                    </div>
                                </div>
                            </div>

                            <a href="<?= $basePrefix ?>/explore" class="inline-flex items-center gap-1.5 text-[10px] font-bold text-emerald-300 hover:text-emerald-200">
                                <span>VIEW GIS VIEW</span><?= $arrow ?>
                            </a>
                        </div>

                    </div>

                    <!-- ROW 4: REQUIRED DOCUMENTS, VERIFICATION & APPROVAL GATE -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                        <!-- Required Documents -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-2">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">Required Documents</h3>
                                    <p class="text-[9px] text-gray-400">Key documents required for milestone completion.</p>
                                </div>

                                <div class="grid grid-cols-2 gap-2 text-[10px]">
                                    <div class="space-y-1.5">
                                        <div class="flex items-center justify-between rounded bg-white/5 p-1.5 border border-white/5">
                                            <span class="text-gray-300 flex items-center gap-1"><?= $svg($ic['doc'], 'w-3 h-3 text-emerald-300') ?> Land Doc</span>
                                            <span class="text-amber-300 font-bold text-[8px]">PENDING</span>
                                        </div>
                                        <div class="flex items-center justify-between rounded bg-white/5 p-1.5 border border-white/5">
                                            <span class="text-gray-300 flex items-center gap-1"><?= $svg($ic['doc'], 'w-3 h-3 text-emerald-300') ?> Partner Doc</span>
                                            <span class="text-amber-300 font-bold text-[8px]">PENDING</span>
                                        </div>
                                        <div class="flex items-center justify-between rounded bg-white/5 p-1.5 border border-white/5">
                                            <span class="text-gray-300 flex items-center gap-1"><?= $svg($ic['doc'], 'w-3 h-3 text-emerald-300') ?> Vendor Doc</span>
                                            <span class="text-amber-300 font-bold text-[8px]">PENDING</span>
                                        </div>
                                        <div class="flex items-center justify-between rounded bg-white/5 p-1.5 border border-white/5">
                                            <span class="text-gray-300 flex items-center gap-1"><?= $svg($ic['doc'], 'w-3 h-3 text-emerald-300') ?> RAB</span>
                                            <span class="text-amber-300 font-bold text-[8px]">PENDING</span>
                                        </div>
                                    </div>
                                    <div class="space-y-1.5">
                                        <div class="flex items-center justify-between rounded bg-white/5 p-1.5 border border-white/5">
                                            <span class="text-gray-300 flex items-center gap-1"><?= $svg($ic['doc'], 'w-3 h-3 text-emerald-300') ?> Work Order</span>
                                            <span class="text-amber-300 font-bold text-[8px]">PENDING</span>
                                        </div>
                                        <div class="flex items-center justify-between rounded bg-white/5 p-1.5 border border-white/5">
                                            <span class="text-gray-300 flex items-center gap-1"><?= $svg($ic['doc'], 'w-3 h-3 text-emerald-300') ?> Evidence</span>
                                            <span class="text-amber-300 font-bold text-[8px]">PENDING</span>
                                        </div>
                                        <div class="flex items-center justify-between rounded bg-white/5 p-1.5 border border-white/5">
                                            <span class="text-gray-300 flex items-center gap-1"><?= $svg($ic['doc'], 'w-3 h-3 text-emerald-300') ?> Commercial</span>
                                            <span class="text-amber-300 font-bold text-[8px]">PENDING</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="<?= $basePrefix ?>/documents" class="inline-flex items-center gap-1.5 text-[10px] font-bold text-emerald-300 hover:text-emerald-200">
                                <span>OPEN DOCUMENT CENTER</span><?= $arrow ?>
                            </a>
                        </div>

                        <!-- Verification Card -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-2">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">Verification</h3>
                                    <p class="text-[9px] text-gray-400">Framework verification of execution and compliance.</p>
                                </div>

                                <div class="space-y-1 text-[10px]">
                                    <div class="flex justify-between"><span class="text-gray-400">VERIFICATION ID</span><span class="font-bold text-white font-mono">VER-NK-001-M1</span></div>
                                    <div class="flex justify-between"><span class="text-gray-400">Verifier</span><span class="font-bold text-emerald-300">NINA Operations</span></div>
                                    <div class="flex justify-between"><span class="text-gray-400">Status</span><span class="font-bold text-amber-300">Submitted</span></div>
                                    <div class="flex justify-between"><span class="text-gray-400">Reviewed</span><span class="text-gray-500">&mdash;</span></div>
                                    <div class="border-t border-white/5 pt-1.5 text-center font-bold text-amber-300">0 / 7 VERIFIED</div>
                                </div>
                            </div>

                            <a href="#verification-section" class="inline-flex items-center gap-1.5 text-[10px] font-bold text-emerald-300 hover:text-emerald-200">
                                <span>VIEW VERIFICATION</span><?= $arrow ?>
                            </a>
                        </div>

                        <!-- Milestone Approval Gate -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-2">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">Milestone Approval Gate</h3>
                                    <p class="text-[9px] text-gray-400">Milestone completion requires defined evidence and verification conditions.</p>
                                </div>

                                <div class="relative w-full py-2">
                                    <div class="absolute top-[12px] left-[15px] right-[15px] h-[2px] bg-white/20 z-0"></div>
                                    <div class="relative z-10 flex items-center justify-between text-center text-[7px] font-bold tracking-tight">
                                        <div class="bg-[#07110E] px-0.5 text-gray-300 flex flex-col items-center gap-0.5"><span class="h-4 w-4 rounded-full border border-white/30 bg-[#07110E] flex items-center justify-center">○</span>RAB</div>
                                        <div class="bg-[#07110E] px-0.5 text-gray-300 flex flex-col items-center gap-0.5"><span class="h-4 w-4 rounded-full border border-white/30 bg-[#07110E] flex items-center justify-center">○</span>Work Order</div>
                                        <div class="bg-[#07110E] px-0.5 text-gray-300 flex flex-col items-center gap-0.5"><span class="h-4 w-4 rounded-full border border-white/30 bg-[#07110E] flex items-center justify-center">○</span>Partner</div>
                                        <div class="bg-[#07110E] px-0.5 text-gray-300 flex flex-col items-center gap-0.5"><span class="h-4 w-4 rounded-full border border-white/30 bg-[#07110E] flex items-center justify-center">○</span>Execution</div>
                                        <div class="bg-[#07110E] px-0.5 text-gray-300 flex flex-col items-center gap-0.5"><span class="h-4 w-4 rounded-full border border-white/30 bg-[#07110E] flex items-center justify-center">○</span>Evidence</div>
                                        <div class="bg-[#07110E] px-0.5 text-gray-300 flex flex-col items-center gap-0.5"><span class="h-4 w-4 rounded-full border border-white/30 bg-[#07110E] flex items-center justify-center">○</span>Verification</div>
                                        <div class="bg-[#07110E] px-0.5 text-gray-300 flex flex-col items-center gap-0.5"><span class="h-4 w-4 rounded-full border border-white/30 bg-[#07110E] flex items-center justify-center">○</span>Approval</div>
                                        <div class="bg-[#07110E] px-0.5 text-gray-300 flex flex-col items-center gap-0.5"><span class="h-4 w-4 rounded-full border border-white/30 bg-[#07110E] flex items-center justify-center">○</span>Eligibility</div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" disabled class="w-full rounded-lg bg-emerald-500/20 border border-emerald-500/30 py-2 text-[10px] font-bold uppercase text-emerald-300 opacity-60 cursor-not-allowed">
                                SUBMIT FOR VERIFICATION &rsaquo;
                            </button>
                        </div>

                    </div>

                    <!-- ROW 5: TRANSACTION RECORD, AUDIT TRAIL & RECENT ACTIVITY -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                        <!-- 1. Execution Transaction Record (5-Column Table) -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between sm:col-span-1">
                            <div class="space-y-2">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">Execution Transaction Record</h3>
                                    <p class="text-[9px] text-gray-400">Track all related transactions and events for this milestone.</p>
                                </div>

                                <div class="overflow-x-auto">
                                    <table class="w-full text-left text-[10px]">
                                        <thead>
                                            <tr class="border-b border-white/10 text-[8px] uppercase tracking-wider text-gray-400">
                                                <th class="py-1 px-1">Event / Entity</th>
                                                <th class="py-1 px-1">Entity</th>
                                                <th class="py-1 px-1">Status &darr;</th>
                                                <th class="py-1 px-1">Reference</th>
                                                <th class="py-1 px-1">Timestamp</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-white/5">
                                            <tr>
                                                <td class="py-1.5 px-1 font-bold text-white flex items-center gap-1"><?= $svg($ic['shield'], 'w-3 h-3 text-emerald-300') ?> Vendor Assigned</td>
                                                <td class="py-1.5 px-1 text-gray-300">Vendor</td>
                                                <td class="py-1.5 px-1"><span class="rounded bg-amber-500/20 px-1 py-0.5 text-[7px] font-bold text-amber-300">PENDING</span></td>
                                                <td class="py-1.5 px-1 font-mono text-gray-400">VEN-001</td>
                                                <td class="py-1.5 px-1 text-gray-400">2026-04-12</td>
                                            </tr>
                                            <tr>
                                                <td class="py-1.5 px-1 font-bold text-white flex items-center gap-1"><?= $svg($ic['coin'], 'w-3 h-3 text-emerald-300') ?> RAB Allocation</td>
                                                <td class="py-1.5 px-1 text-gray-300">Batch</td>
                                                <td class="py-1.5 px-1"><span class="rounded bg-amber-500/20 px-1 py-0.5 text-[7px] font-bold text-amber-300">PENDING</span></td>
                                                <td class="py-1.5 px-1 font-mono text-gray-400">RAB-NK-001</td>
                                                <td class="py-1.5 px-1 text-gray-400">2026-04-12</td>
                                            </tr>
                                            <tr>
                                                <td class="py-1.5 px-1 font-bold text-white flex items-center gap-1"><?= $svg($ic['target'], 'w-3 h-3 text-emerald-300') ?> Execution Request</td>
                                                <td class="py-1.5 px-1 text-gray-300">Partner</td>
                                                <td class="py-1.5 px-1"><span class="rounded bg-amber-500/20 px-1 py-0.5 text-[7px] font-bold text-amber-300">PENDING</span></td>
                                                <td class="py-1.5 px-1 font-mono text-gray-400">EXE-001</td>
                                                <td class="py-1.5 px-1 text-gray-400">2026-04-12</td>
                                            </tr>
                                            <tr>
                                                <td class="py-1.5 px-1 font-bold text-white flex items-center gap-1"><?= $svg($ic['check'], 'w-3 h-3 text-emerald-300') ?> Verification</td>
                                                <td class="py-1.5 px-1 text-gray-300">NINA</td>
                                                <td class="py-1.5 px-1"><span class="rounded bg-amber-500/20 px-1 py-0.5 text-[7px] font-bold text-amber-300">PENDING</span></td>
                                                <td class="py-1.5 px-1 font-mono text-gray-400">VER-001</td>
                                                <td class="py-1.5 px-1 text-gray-400">2026-04-12</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="pt-2">
                                <span class="rounded bg-emerald-950/80 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">SIMULATED TRANSACTION</span>
                            </div>
                        </div>

                        <!-- 2. Milestone Audit Trail (Vertical Step Timeline with Block Button) -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">Milestone Audit Trail</h3>
                                    <p class="text-[9px] text-gray-400">Complete record of all milestone activities.</p>
                                </div>

                                <!-- Vertical Step Timeline -->
                                <div class="relative pl-6 space-y-3 text-[10px]">
                                    <!-- Vertical connecting line -->
                                    <div class="absolute left-[7px] top-[4px] bottom-[12px] w-[2px] bg-white/20"></div>

                                    <div class="relative">
                                        <span class="absolute -left-6 top-[2px] h-4 w-4 rounded-full border border-emerald-400/60 bg-[#07110E] flex items-center justify-center text-[9px] text-emerald-300 font-bold">🎯</span>
                                        <div class="font-extrabold uppercase text-white">MILESTONE CREATED</div>
                                        <div class="text-[9px] text-gray-400">2026-04-12 10:00 | System</div>
                                    </div>
                                    <div class="relative">
                                        <span class="absolute -left-6 top-[2px] h-4 w-4 rounded-full border border-emerald-400/60 bg-[#07110E] flex items-center justify-center text-[9px] text-emerald-300 font-bold">🎯</span>
                                        <div class="font-extrabold uppercase text-white">RAB LINKED</div>
                                        <div class="text-[9px] text-gray-400">2026-04-12 10:15 | System</div>
                                    </div>
                                    <div class="relative">
                                        <span class="absolute -left-6 top-[2px] h-4 w-4 rounded-full border border-emerald-400/60 bg-[#07110E] flex items-center justify-center text-[9px] text-emerald-300 font-bold">🎯</span>
                                        <div class="font-extrabold uppercase text-white">VENDOR ASSIGNED</div>
                                        <div class="text-[9px] text-gray-400">2026-04-12 10:30 | System</div>
                                    </div>
                                    <div class="relative">
                                        <span class="absolute -left-6 top-[2px] h-4 w-4 rounded-full border border-emerald-400/60 bg-[#07110E] flex items-center justify-center text-[9px] text-emerald-300 font-bold">🎯</span>
                                        <div class="font-extrabold uppercase text-white">WORK ORDER CREATED</div>
                                        <div class="text-[9px] text-gray-400">2026-04-12 11:00 | System</div>
                                    </div>

                                    <div class="text-[9px] text-gray-400 italic pt-1">&hellip; and 5 more events</div>
                                </div>
                            </div>

                            <a href="<?= $basePrefix ?>/audit-trail" class="w-fit rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-[10px] font-bold uppercase text-gray-300 transition hover:bg-white/10 hover:text-white inline-flex items-center gap-1">
                                <span>VIEW FULL AUDIT TRAIL</span><?= $arrow ?>
                            </a>
                        </div>

                        <!-- 3. Recent Activity (Hollow Center Rings & Block Button) -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">Recent Activity</h3>
                                    <p class="text-[9px] text-gray-400">Latest updates for this milestone.</p>
                                </div>

                                <!-- Timeline with Hollow Ring Circles -->
                                <div class="relative pl-6 space-y-3 text-[10px]">
                                    <!-- Vertical line -->
                                    <div class="absolute left-[5px] top-[4px] bottom-[8px] w-[2px] bg-white/20"></div>

                                    <div class="relative">
                                        <span class="absolute -left-6 top-[2px] h-3.5 w-3.5 rounded-full border-2 border-emerald-400 bg-transparent"></span>
                                        <div class="font-bold text-white">Field update #001 uploaded</div>
                                        <div class="text-[9px] text-gray-400">2026-04-12 14:00 | DEMO</div>
                                    </div>
                                    <div class="relative">
                                        <span class="absolute -left-6 top-[2px] h-3.5 w-3.5 rounded-full border-2 border-emerald-400 bg-transparent"></span>
                                        <div class="font-bold text-white">Vendor assignment updated</div>
                                        <div class="text-[9px] text-gray-400">2026-04-12 11:45 | DEMO</div>
                                    </div>
                                    <div class="relative">
                                        <span class="absolute -left-6 top-[2px] h-3.5 w-3.5 rounded-full border-2 border-emerald-400 bg-transparent"></span>
                                        <div class="font-bold text-white">RAB allocation linked</div>
                                        <div class="text-[9px] text-gray-400">2026-04-12 10:30 | System</div>
                                    </div>
                                    <div class="relative">
                                        <span class="absolute -left-6 top-[2px] h-3.5 w-3.5 rounded-full border-2 border-emerald-400 bg-transparent"></span>
                                        <div class="font-bold text-white">Milestone 01 created</div>
                                        <div class="text-[9px] text-gray-400">2026-04-12 09:15 | DEMO</div>
                                    </div>
                                </div>
                            </div>

                            <a href="<?= $basePrefix ?>/audit-trail" class="w-fit rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-[10px] font-bold uppercase text-gray-300 transition hover:bg-white/10 hover:text-white inline-flex items-center gap-1">
                                <span>VIEW ALL ACTIVITY</span><?= $arrow ?>
                            </a>
                        </div>

                    </div>

                </div>

                <!-- RIGHT STICKY SIDEBAR (4 COLS MATCHING BATCHES.PHP & WIREFRAME) -->
                <div class="space-y-4 lg:col-span-4 lg:sticky lg:top-4">

                    <!-- Header Conditions Widget (Matching Wireframe Top Right) -->
                    <div class="<?= $card ?> p-4 space-y-2">
                        <div class="flex justify-between text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">
                            <span>Required Conditions</span>
                            <span class="text-amber-300">0 / 5 READY</span>
                        </div>
                        <div class="space-y-1 text-xs">
                            <div class="flex items-center gap-2 text-gray-300"><span class="text-gray-500">○</span> PO Collection</div>
                            <div class="flex items-center gap-2 text-gray-300"><span class="text-gray-500">○</span> RAB Confirmation</div>
                            <div class="flex items-center gap-2 text-gray-300"><span class="text-gray-500">○</span> Vendor Assignment</div>
                            <div class="flex items-center gap-2 text-gray-300"><span class="text-gray-500">○</span> Field Verification</div>
                            <div class="flex items-center gap-2 text-gray-300"><span class="text-gray-500">○</span> Execution Approval</div>
                        </div>
                    </div>

                    <!-- Card 1: MILESTONE 01 OVERVIEW -->
                    <div class="<?= $card ?> p-4 space-y-3">
                        <div class="relative h-28 rounded-lg overflow-hidden">
                            <img src="<?= $basePrefix ?>/1.jpg" class="h-full w-full object-cover" />
                            <span class="absolute top-2 right-2 rounded bg-amber-500/90 px-2 py-0.5 text-[8px] font-bold text-black">PENDING</span>
                        </div>

                        <div class="space-y-1 text-xs">
                            <div class="font-extrabold text-white text-sm">MILESTONE 01</div>
                            <div class="text-[10px] font-bold text-gray-300">BATCH NK-001 &bull; 100 HA</div>
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-xs border-t border-white/10 pt-2">
                            <div><div class="text-[8px] text-gray-400 uppercase">Target</div><div class="font-bold text-emerald-300">25%</div></div>
                            <div><div class="text-[8px] text-gray-400 uppercase">Allocation</div><div class="font-bold text-white">8,000 USDT</div></div>
                        </div>

                        <div class="text-[9px] text-gray-400">Next Milestone: <strong class="text-gray-300">M02 &mdash; Locked</strong></div>

                        <button type="button"
                                class="w-full inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-[#6EE7B7] to-[#A7F3D0] px-4 py-2.5 text-[10px] font-extrabold uppercase tracking-wider text-[#04100B] shadow-lg shadow-emerald-950/40 transition hover:brightness-110">
                            <span>VIEW FULL DETAILS</span><?= $arrow ?>
                        </button>
                    </div>

                    <!-- Card 2: YOUR ALLOCATION -->
                    <div class="<?= $card ?> p-4 space-y-2.5">
                        <div class="border-b border-white/10 pb-2">
                            <div class="text-[9px] font-bold uppercase tracking-wider text-emerald-300">YOUR ALLOCATION</div>
                            <div class="text-xs font-mono font-extrabold text-white">ALC-2026-NK001-0001</div>
                        </div>

                        <div class="space-y-1 text-xs">
                            <div class="flex justify-between"><span class="text-gray-400">Project</span><span class="font-bold text-white">North Kalimantan Palm</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Batch</span><span class="font-bold text-white">NK-001</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Milestone</span><span class="font-bold text-emerald-300">M01</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Status</span><span class="font-bold text-amber-300">● PENDING</span></div>
                        </div>

                        <div class="text-[9px] text-gray-400 border-t border-white/5 pt-1.5">
                            Progress: <strong class="text-white">0 / 4 MILESTONES COMPLETED</strong>
                        </div>
                    </div>

                    <!-- Card 3: QUICK ACTIONS -->
                    <div class="<?= $card ?> p-4 space-y-2">
                        <div class="text-[9px] font-bold uppercase tracking-wider text-gray-400 mb-1">QUICK ACTIONS</div>
                        <div class="space-y-1.5 text-xs">
                            <a href="#rab-section" class="flex items-center justify-between rounded border border-white/10 bg-white/5 p-2 font-bold text-gray-300 hover:bg-white/10"><span>VIEW RAB</span><span>&rsaquo;</span></a>
                            <a href="#vendor-section" class="flex items-center justify-between rounded border border-white/10 bg-white/5 p-2 font-bold text-gray-300 hover:bg-white/10"><span>VIEW VENDOR</span><span>&rsaquo;</span></a>
                            <a href="#evidence-section" class="flex items-center justify-between rounded border border-white/10 bg-white/5 p-2 font-bold text-gray-300 hover:bg-white/10"><span>VIEW EVIDENCE</span><span>&rsaquo;</span></a>
                            <a href="<?= $basePrefix ?>/audit-trail" class="flex items-center justify-between rounded border border-white/10 bg-white/5 p-2 font-bold text-gray-300 hover:bg-white/10"><span>VIEW AUDIT TRAIL</span><span>&rsaquo;</span></a>
                        </div>
                    </div>

                    <!-- Card 4: NEXT MILESTONE -->
                    <div class="<?= $card ?> p-4 space-y-2.5">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-white">MILESTONE 02 (25%)</span>
                            <span class="rounded bg-gray-800 px-2 py-0.5 text-[8px] font-bold text-gray-300">LOCKED</span>
                        </div>
                        <p class="text-[10px] text-gray-400">Complete Milestone 01 to unlock this milestone stage.</p>
                        <button type="button" disabled class="w-full rounded-lg border border-white/10 bg-white/5 py-1.5 text-[10px] font-bold uppercase text-gray-500 opacity-60 cursor-not-allowed">
                            VIEW MILESTONE 02 &rsaquo;
                        </button>
                    </div>

                </div>

            </div>

            <!-- ================= BOTTOM FLOATING FOOTER BAR ================= -->
            <section class="rounded-xl border border-white/10 bg-[#07110E] p-4 flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="flex items-center gap-2 text-xs">
                    <span class="h-2 w-2 rounded-full bg-amber-400"></span>
                    <span class="text-gray-300">Milestone 01 is not yet ready for approval. Complete the required conditions and submit for verification to continue.</span>
                </div>
                <button type="button" class="shrink-0 rounded-full bg-gradient-to-r from-[#6EE7B7] to-[#A7F3D0] px-6 py-2.5 text-xs font-extrabold uppercase tracking-wider text-[#04100B] shadow-lg shadow-emerald-950/40 hover:brightness-110">
                    VIEW REQUIRED ACTIONS &rsaquo;
                </button>
            </section>

        </div>

    </div>

</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
