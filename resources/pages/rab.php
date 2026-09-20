<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '10 / Production RAB — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'rab';

/* ---------- Helpers & Icons ---------- */
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

$svg = fn(string $inner, string $cls = 'w-4 h-4') =>
    '<svg class="' . $cls . '" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">' . $inner . '</svg>';

$ic = [
    'target'    => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.5"/>',
    'leaf'      => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>',
    'coin'      => '<circle cx="12" cy="12" r="9"/><path d="M14.5 9.5c-.5-1-1.4-1.5-2.5-1.5-1.4 0-2.5.8-2.5 2s1 1.7 2.5 2 2.5.8 2.5 2-1.1 2-2.5 2c-1.1 0-2-.5-2.5-1.5M12 6v2M12 16v2"/>',
    'grid'      => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/>',
    'pin'       => '<path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="2.5"/>',
    'check'     => '<circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 4.5-5"/>',
    'shield'    => '<path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/>',
    'clock'     => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>',
    'doc'       => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>',
    'filter'    => '<polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>',
    'download'  => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>',
    'search'    => '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>',
];

$chev  = '<svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>';
$arrow = '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>';

$card      = 'rounded-xl border border-white/10 bg-[#0B1815]/90 shadow-xl';
$iconBox   = 'flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-emerald-100';
$metricLbl = 'text-[9px] font-medium uppercase tracking-wide text-gray-400';

ob_start();
?>

<div class="relative w-full font-sans">

    <!-- PAGE BACKGROUND (soft blurred forest background) -->
    <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden">
        <img src="<?= $basePrefix ?>/1.jpg" alt="" class="h-full w-full scale-110 object-cover opacity-25 blur-md" />
        <div class="absolute inset-0 bg-gradient-to-b from-[#06120F]/60 via-[#06120F]/85 to-[#04100B]"></div>
    </div>

    <div class="relative z-10">

        <!-- ================= HERO (STYLE MATCHING BATCHES.PHP & EXPLORE.PHP) ================= -->
        <section class="relative overflow-hidden border-b border-white/10 shadow-2xl">
            <img src="<?= $basePrefix ?>/1.jpg" alt="Natural forest canopy" class="absolute inset-0 h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#050D07]/85 via-[#050D07]/45 to-[#050D07]/10"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#06120F]/80 via-transparent to-transparent"></div>

            <div class="relative grid min-h-[260px] grid-cols-1 items-start gap-8 px-6 py-8 lg:grid-cols-12 lg:px-8 lg:py-10">

                <!-- Left: breadcrumb, title, sub-info -->
                <div class="space-y-4 lg:col-span-7">
                    <div class="inline-flex flex-wrap items-center gap-2 rounded-full border border-white/15 bg-black/40 px-3 py-1.5 text-[9px] font-semibold uppercase tracking-[0.14em] text-gray-300 backdrop-blur-md">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                        <a href="<?= $basePrefix ?>/allocations" class="hover:text-white">MY ALLOCATIONS</a>
                        <span class="text-gray-500">&rsaquo;</span>
                        <a href="<?= $basePrefix ?>/explore" class="hover:text-white">NORTH KALIMANTAN PALM</a>
                        <span class="text-gray-500">&rsaquo;</span>
                        <a href="<?= $basePrefix ?>/batches" class="hover:text-white">BATCH NK-001</a>
                        <span class="text-gray-500">&rsaquo;</span>
                        <a href="<?= $basePrefix ?>/milestones" class="hover:text-white">MILESTONE 01</a>
                        <span class="text-gray-500">&rsaquo;</span>
                        <span class="font-bold text-white">RAB</span>
                    </div>

                    <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-200">
                        <span>10 / PRODUCTION RAB</span>
                        <span class="rounded border border-amber-400/40 bg-amber-500/20 px-2 py-0.5 text-[9px] font-bold tracking-wider text-amber-300">DEMO / MODEL</span>
                    </div>

                    <h1 class="max-w-2xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">Production RAB</h1>
                    <div class="text-lg font-bold text-emerald-300">100 HA Batch Cost & Execution Structure</div>

                    <div class="flex flex-wrap items-center gap-4 text-xs font-semibold text-gray-300 pt-1">
                        <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> Project: <strong class="text-white">North Kalimantan Palm</strong></span>
                        <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> Batch: <strong class="text-white">NK-001</strong></span>
                    </div>
                </div>

                <!-- Right: HERO RAB STATUS SUMMARY CARD -->
                <div class="lg:col-span-4 lg:col-start-9">
                    <div class="space-y-4 rounded-xl border border-white/15 bg-[#08130F]/70 p-5 shadow-2xl backdrop-blur-xl">
                        <div class="flex items-center justify-between border-b border-white/10 pb-2">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-white">RAB STATUS</span>
                            <span class="rounded border border-amber-400/40 bg-amber-950/80 px-2 py-0.5 text-[9px] font-bold text-amber-300">● MODEL / PENDING CONFIGURATION</span>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-2 text-center text-xs">
                            <div class="rounded border border-white/10 bg-white/5 p-2">
                                <div class="text-[8px] text-gray-400 uppercase">RAB Version</div>
                                <div class="font-extrabold text-white text-xs mt-0.5">V01</div>
                            </div>
                            <div class="rounded border border-white/10 bg-white/5 p-2">
                                <div class="text-[8px] text-gray-400 uppercase">Categories</div>
                                <div class="font-extrabold text-emerald-300 text-xs mt-0.5">09</div>
                            </div>
                            <div class="rounded border border-white/10 bg-white/5 p-2">
                                <div class="text-[8px] text-gray-400 uppercase">Vendors</div>
                                <div class="font-extrabold text-amber-300 text-xs mt-0.5">0 / Pending</div>
                            </div>
                        </div>

                        <p class="text-[9px] italic text-gray-400 leading-tight">
                            Indicative model parameter. Final RAB is subject to verified project documentation and approved commercial structure.
                        </p>
                    </div>
                </div>

            </div>
        </section>

        <!-- ================= CONTENT ================= -->
        <div class="space-y-5 px-4 pb-16 pt-5 sm:px-6 lg:px-8">

            <!-- ---------- 3. TOTAL BATCH REQUIREMENT SUMMARY HERO BOX ---------- -->
            <section class="<?= $card ?> p-5 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-white/10 pb-4">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-400">TOTAL BATCH REQUIREMENT</span>
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">MODELED REQUIREMENT</span>
                        </div>
                        <div class="text-3xl font-black tracking-tight text-white sm:text-4xl">Rp15,000,000,000</div>
                    </div>
                    <div class="flex flex-wrap items-center gap-4 text-xs">
                        <div class="rounded-lg border border-white/10 bg-[#07110E] p-3 text-center">
                            <div class="text-[9px] text-gray-400 uppercase font-bold">BATCH SIZE</div>
                            <div class="text-sm font-extrabold text-white mt-0.5">100 HA STANDARD BATCH</div>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-[#07110E] p-3 text-center">
                            <div class="text-[9px] text-gray-400 uppercase font-bold">INDICATIVE AVERAGE</div>
                            <div class="text-sm font-extrabold text-emerald-300 mt-0.5">Rp150,000,000 / HA</div>
                        </div>
                    </div>
                </div>
                <p class="text-[10px] italic text-gray-400">
                    Indicative model parameter. Final RAB is subject to verified project documentation and approved commercial structure.
                </p>
            </section>

            <!-- ---------- 4. TOP KPI STRIP (5 CARDS) ---------- -->
            <section class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-5">

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['coin']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">TOTAL RAB</div>
                        <div class="text-lg font-extrabold leading-tight text-white">Rp15B</div>
                        <div class="text-[9px] text-gray-400">Model Requirement</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['grid']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">ALLOCATED</div>
                        <div class="text-lg font-extrabold leading-tight text-emerald-300">Rp0</div>
                        <div class="text-[9px] text-gray-400">Initial Demo</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['clock']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">COMMITTED</div>
                        <div class="text-lg font-extrabold leading-tight text-white">Rp0</div>
                        <div class="text-[9px] text-gray-400">Initial Demo</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['target']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">EXECUTED</div>
                        <div class="text-lg font-extrabold leading-tight text-white">Rp0</div>
                        <div class="text-[9px] text-gray-400">Initial Demo</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['shield']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">VERIFIED</div>
                        <div class="text-lg font-extrabold leading-tight text-amber-300">Rp0</div>
                        <div class="text-[9px] text-gray-400">Initial Demo</div>
                    </div>
                </div>

            </section>

            <!-- ---------- 6. RAB EXECUTION PROGRESS BAR ---------- -->
            <section class="<?= $card ?> p-4 space-y-3">
                <div class="flex justify-between items-center text-xs font-bold">
                    <span class="text-white uppercase tracking-wider">RAB Execution Progress</span>
                    <span class="text-emerald-300">0%</span>
                </div>
                <div class="h-2 w-full overflow-hidden rounded-full bg-white/10">
                    <div class="h-full w-0 rounded-full bg-emerald-400 transition-all duration-1000"></div>
                </div>
                <div class="flex flex-wrap items-center gap-4 text-[10px] text-gray-400 pt-1">
                    <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> Planned</span>
                    <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-blue-400"></span> Allocated</span>
                    <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-amber-400"></span> Committed</span>
                    <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-rose-400"></span> Executed</span>
                    <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-gray-400"></span> Verified</span>
                </div>
            </section>

            <!-- ================= MAIN LAYOUT GRID (8 COLS LEFT, 4 COLS RIGHT STICKY) ================= -->
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-12 items-start">

                <!-- LEFT MAIN CONTENT (8 COLS) -->
                <div class="space-y-5 lg:col-span-8">

                    <!-- 7. PRODUCTION COST STRUCTURE (9 CATEGORIES GRID) -->
                    <section class="<?= $card ?> p-5 space-y-4">
                        <div class="border-b border-white/10 pb-3">
                            <h2 class="text-base font-bold text-white">Production Cost Structure</h2>
                            <p class="text-xs text-gray-300">The RAB breaks the 100 HA production requirement into defined operating categories.</p>
                        </div>

                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                            <?php
                            $catsList = [
                                ['id' => '01', 'name' => 'LAND / PARTNERSHIP', 'status' => 'Pending'],
                                ['id' => '02', 'name' => 'LAND PREPARATION', 'status' => 'Pending'],
                                ['id' => '03', 'name' => 'SEEDLINGS', 'status' => 'Pending'],
                                ['id' => '04', 'name' => 'FERTILIZER & INPUTS', 'status' => 'Pending'],
                                ['id' => '05', 'name' => 'MACHINERY & EQUIPMENT', 'status' => 'Pending'],
                                ['id' => '06', 'name' => 'INFRASTRUCTURE', 'status' => 'Pending'],
                                ['id' => '07', 'name' => 'MAINTENANCE', 'status' => 'Pending'],
                                ['id' => '08', 'name' => 'OPERATIONS', 'status' => 'Pending'],
                                ['id' => '09', 'name' => 'CONTINGENCY', 'status' => 'Pending'],
                            ];
                            foreach ($catsList as $cItem):
                            ?>
                                <div class="rounded-xl border border-white/10 bg-[#07110E] p-3 flex flex-col justify-between space-y-2 hover:border-emerald-400/40 transition">
                                    <div class="flex items-center gap-2">
                                        <span class="<?= $iconBox ?> h-7 w-7 text-[10px] font-bold"><?= $cItem['id'] ?></span>
                                        <span class="text-[10px] font-bold text-white leading-tight"><?= $cItem['name'] ?></span>
                                    </div>
                                    <div class="flex items-center justify-between border-t border-white/5 pt-1.5">
                                        <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300"><?= $cItem['status'] ?></span>
                                        <span class="text-gray-400 text-[10px] font-bold">&rsaquo;</span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="pt-2 flex justify-end">
                            <a href="#full-rab-table" class="inline-flex items-center gap-1.5 rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-[10px] font-bold uppercase text-gray-300 hover:bg-white/10">
                                <span>VIEW FULL RAB</span><?= $arrow ?>
                            </a>
                        </div>
                    </section>

                    <!-- 10. VENDOR ASSIGNMENT & 26. RAB BY MILESTONE -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <!-- Vendor Assignment -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">Vendor Assignment</h3>
                                    <p class="text-[9px] text-gray-400">Vendors are connected to specific RAB categories and execution requirements.</p>
                                </div>

                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    <div class="rounded-lg border border-white/10 bg-[#07110E] p-2 space-y-1">
                                        <div class="flex justify-between text-[9px] font-bold text-emerald-300"><span>SEED</span><span class="text-amber-300">PENDING</span></div>
                                        <div class="font-bold text-white text-[10px]">Demo Seed Producer</div>
                                    </div>
                                    <div class="rounded-lg border border-white/10 bg-[#07110E] p-2 space-y-1">
                                        <div class="flex justify-between text-[9px] font-bold text-emerald-300"><span>FERTILIZER</span><span class="text-amber-300">PENDING</span></div>
                                        <div class="font-bold text-white text-[10px]">Demo Input Supplier</div>
                                    </div>
                                    <div class="rounded-lg border border-white/10 bg-[#07110E] p-2 space-y-1">
                                        <div class="flex justify-between text-[9px] font-bold text-emerald-300"><span>EQUIPMENT</span><span class="text-amber-300">PENDING</span></div>
                                        <div class="font-bold text-white text-[10px]">Demo Equipment Partner</div>
                                    </div>
                                    <div class="rounded-lg border border-white/10 bg-[#07110E] p-2 space-y-1">
                                        <div class="flex justify-between text-[9px] font-bold text-emerald-300"><span>LOGISTICS</span><span class="text-amber-300">PENDING</span></div>
                                        <div class="font-bold text-white text-[10px]">Demo Logistics Partner</div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between border-t border-white/5 pt-2">
                                <span class="text-[9px] font-bold uppercase text-gray-400">0 / 4 ASSIGNED</span>
                                <a href="<?= $basePrefix ?>/vendors" class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-300 hover:underline">VIEW ALL VENDORS &rsaquo;</a>
                            </div>
                        </div>

                        <!-- RAB by Milestone -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">RAB by Milestone</h3>
                                    <p class="text-[9px] text-gray-400">Category allocation per milestone (model view).</p>
                                </div>

                                <div class="grid grid-cols-4 gap-1.5 text-[9px] text-center">
                                    <div class="rounded border border-white/10 bg-[#07110E] p-1.5 space-y-1">
                                        <div class="font-bold text-emerald-300">M01 25%</div>
                                        <ul class="text-[7px] text-gray-400 space-y-0.5 text-left pl-1">
                                            <li>&bull; Land</li>
                                            <li>&bull; Prep</li>
                                            <li>&bull; Seedlings</li>
                                            <li>&bull; Inputs</li>
                                        </ul>
                                    </div>
                                    <div class="rounded border border-white/10 bg-[#07110E] p-1.5 space-y-1">
                                        <div class="font-bold text-white">M02 25%</div>
                                        <ul class="text-[7px] text-gray-400 space-y-0.5 text-left pl-1">
                                            <li>&bull; Maintenance</li>
                                            <li>&bull; Operations</li>
                                            <li>&bull; Infra</li>
                                        </ul>
                                    </div>
                                    <div class="rounded border border-white/10 bg-[#07110E] p-1.5 space-y-1">
                                        <div class="font-bold text-white">M03 25%</div>
                                        <ul class="text-[7px] text-gray-400 space-y-0.5 text-left pl-1">
                                            <li>&bull; Maintenance</li>
                                            <li>&bull; Operations</li>
                                        </ul>
                                    </div>
                                    <div class="rounded border border-white/10 bg-[#07110E] p-1.5 space-y-1">
                                        <div class="font-bold text-white">M04 25%</div>
                                        <ul class="text-[7px] text-gray-400 space-y-0.5 text-left pl-1">
                                            <li>&bull; Harvest</li>
                                            <li>&bull; Processing</li>
                                            <li>&bull; Delivery</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <a href="<?= $basePrefix ?>/milestones" class="inline-flex items-center gap-1.5 rounded-lg border border-white/15 bg-white/5 px-2.5 py-1 text-[9px] font-bold uppercase text-gray-300 hover:bg-white/10 w-fit">
                                <span>VIEW MILESTONE ALLOCATION</span><?= $arrow ?>
                            </a>
                        </div>

                    </div>

                    <!-- 15. MAIN TABLE — FULL RAB DETAIL & 16. FILTERS -->
                    <section id="full-rab-table" class="<?= $card ?> p-5 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-white/10 pb-3">
                            <div>
                                <h2 class="text-base font-bold text-white">Full RAB Detail</h2>
                                <p class="text-xs text-gray-300">Complete category allocation and execution status matrix.</p>
                            </div>
                        </div>

                        <!-- Filters & Search Controls -->
                        <div class="grid grid-cols-1 gap-2 sm:grid-cols-6 text-xs">
                            <div class="sm:col-span-2 relative">
                                <input type="text" placeholder="Search category, vendor, work order..." class="w-full rounded-lg border border-white/10 bg-[#07110E] px-3 py-1.5 text-xs text-white focus:outline-none focus:border-emerald-400" />
                            </div>
                            <div>
                                <select class="w-full rounded-lg border border-white/10 bg-[#07110E] px-2 py-1.5 text-xs text-gray-300"><option>Category: All</option></select>
                            </div>
                            <div>
                                <select class="w-full rounded-lg border border-white/10 bg-[#07110E] px-2 py-1.5 text-xs text-gray-300"><option>Milestone: All</option></select>
                            </div>
                            <div>
                                <select class="w-full rounded-lg border border-white/10 bg-[#07110E] px-2 py-1.5 text-xs text-gray-300"><option>Status: All</option></select>
                            </div>
                            <div>
                                <select class="w-full rounded-lg border border-white/10 bg-[#07110E] px-2 py-1.5 text-xs text-gray-300"><option>Sort: Category</option></select>
                            </div>
                        </div>

                        <!-- Full 8-Column Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs text-gray-300">
                                <thead>
                                    <tr class="border-b border-white/10 text-[9px] uppercase tracking-wider text-gray-400">
                                        <th class="py-2 px-3">Category</th>
                                        <th class="py-2 px-3">Planned</th>
                                        <th class="py-2 px-3">Allocated</th>
                                        <th class="py-2 px-3">Committed</th>
                                        <th class="py-2 px-3">Executed</th>
                                        <th class="py-2 px-3">Verified</th>
                                        <th class="py-2 px-3">Status</th>
                                        <th class="py-2 px-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5">
                                    <?php foreach ($catsList as $cRow): ?>
                                        <tr class="hover:bg-white/5 transition">
                                            <td class="py-2 px-3 font-semibold text-white flex items-center gap-2">
                                                <span class="text-emerald-300"><?= $svg($ic['grid'], 'w-3.5 h-3.5') ?></span>
                                                <?= $cRow['name'] ?>
                                            </td>
                                            <td class="py-2 px-3 text-gray-500">&mdash;</td>
                                            <td class="py-2 px-3 text-gray-500">&mdash;</td>
                                            <td class="py-2 px-3 text-gray-500">&mdash;</td>
                                            <td class="py-2 px-3 text-gray-500">&mdash;</td>
                                            <td class="py-2 px-3 text-gray-500">&mdash;</td>
                                            <td class="py-2 px-3"><span class="rounded bg-amber-500/20 px-2 py-0.5 text-[8px] font-bold text-amber-300"><?= $cRow['status'] ?></span></td>
                                            <td class="py-2 px-3"><a href="#" class="text-emerald-300 font-bold hover:underline">View &rsaquo;</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr class="border-t border-white/20 font-bold text-white bg-white/5">
                                        <td class="py-2.5 px-3">TOTAL</td>
                                        <td class="py-2.5 px-3 text-emerald-300">Rp15B</td>
                                        <td class="py-2.5 px-3 text-gray-500">&mdash;</td>
                                        <td class="py-2.5 px-3 text-gray-500">&mdash;</td>
                                        <td class="py-2.5 px-3 text-gray-500">&mdash;</td>
                                        <td class="py-2.5 px-3 text-gray-500">&mdash;</td>
                                        <td class="py-2.5 px-3" colspan="2"><span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300">Model</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <!-- 28. BUDGET STATUS PROGRESS BARS & 30. RAB AUDIT TRAIL -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <!-- Budget Status -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">Budget Status</h3>
                                </div>

                                <div class="space-y-2.5 text-[10px]">
                                    <div>
                                        <div class="flex justify-between font-bold text-gray-300"><span>PLANNED</span><span>100%</span></div>
                                        <div class="h-1.5 w-full bg-white/10 rounded-full overflow-hidden mt-0.5">
                                            <div class="h-full bg-emerald-400 w-full animate-bar-full"></div>
                                        </div>
                                        <div class="text-[8px] text-gray-400 font-semibold mt-0.5">Rp15B</div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between font-bold text-gray-400"><span>ALLOCATED</span><span>0%</span></div>
                                        <div class="h-1.5 w-full bg-white/10 rounded-full overflow-hidden mt-0.5">
                                            <div class="h-full bg-blue-400 w-0"></div>
                                        </div>
                                        <div class="text-[8px] text-gray-500 font-semibold mt-0.5">Rp0</div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between font-bold text-gray-400"><span>COMMITTED</span><span>0%</span></div>
                                        <div class="h-1.5 w-full bg-white/10 rounded-full overflow-hidden mt-0.5">
                                            <div class="h-full bg-amber-400 w-0"></div>
                                        </div>
                                        <div class="text-[8px] text-gray-500 font-semibold mt-0.5">Rp0</div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between font-bold text-gray-400"><span>EXECUTED</span><span>0%</span></div>
                                        <div class="h-1.5 w-full bg-white/10 rounded-full overflow-hidden mt-0.5">
                                            <div class="h-full bg-rose-400 w-0"></div>
                                        </div>
                                        <div class="text-[8px] text-gray-500 font-semibold mt-0.5">Rp0</div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between font-bold text-gray-400"><span>VERIFIED</span><span>0%</span></div>
                                        <div class="h-1.5 w-full bg-white/10 rounded-full overflow-hidden mt-0.5">
                                            <div class="h-full bg-gray-400 w-0"></div>
                                        </div>
                                        <div class="text-[8px] text-gray-500 font-semibold mt-0.5">Rp0</div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-[8px] italic text-gray-500 border-t border-white/5 pt-1.5">
                                Initial prototype state. Actual amounts will be populated from the final RAB.
                            </p>
                        </div>

                        <!-- RAB Audit Trail -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">RAB Audit Trail</h3>
                                </div>

                                <div class="relative pl-6 space-y-3.5 text-[10px]">
                                    <div class="absolute left-[7px] top-[4px] bottom-[8px] w-[2px] bg-white/20"></div>

                                    <div class="relative flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <span class="absolute -left-6 top-[2px] flex h-3.5 w-3.5 items-center justify-center rounded-full border border-emerald-400 bg-[#07110E]">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                            </span>
                                            <div>
                                                <div class="font-bold text-white">RAB CREATED</div>
                                                <div class="text-[8px] text-gray-500">2026-06-12</div>
                                            </div>
                                        </div>
                                        <div class="text-right text-[8px] text-gray-400">
                                            <div>2026-06-12</div>
                                            <div class="text-gray-500">NINA Operations</div>
                                        </div>
                                    </div>

                                    <div class="relative flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <span class="absolute -left-6 top-[2px] flex h-3.5 w-3.5 items-center justify-center rounded-full border border-emerald-400 bg-[#07110E]">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                            </span>
                                            <div>
                                                <div class="font-bold text-white">CATEGORY CREATED</div>
                                                <div class="text-[8px] text-gray-500">2026-06-12</div>
                                            </div>
                                        </div>
                                        <div class="text-right text-[8px] text-gray-400">
                                            <div>2026-06-12</div>
                                            <div class="text-gray-500">NINA Operations</div>
                                        </div>
                                    </div>

                                    <div class="relative flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <span class="absolute -left-6 top-[2px] flex h-3.5 w-3.5 items-center justify-center rounded-full border border-emerald-400 bg-[#07110E]">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                            </span>
                                            <div>
                                                <div class="font-bold text-white">VENDOR LINKED</div>
                                                <div class="text-[8px] text-gray-500">2026-06-12</div>
                                            </div>
                                        </div>
                                        <div class="text-right text-[8px] text-gray-400">
                                            <div>2026-06-12</div>
                                            <div class="text-gray-500">NINA Operations</div>
                                        </div>
                                    </div>

                                    <div class="relative flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <span class="absolute -left-6 top-[2px] flex h-3.5 w-3.5 items-center justify-center rounded-full border border-emerald-400 bg-[#07110E]">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                            </span>
                                            <div>
                                                <div class="font-bold text-white">WORK ORDER CREATED</div>
                                                <div class="text-[8px] text-gray-500">2026-06-12</div>
                                            </div>
                                        </div>
                                        <div class="text-right text-[8px] text-gray-400">
                                            <div>2026-06-12</div>
                                            <div class="text-gray-500">NINA Operations</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="<?= $basePrefix ?>/audit-trail" class="w-fit rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-[10px] font-bold uppercase text-gray-300 transition hover:bg-white/10 hover:text-white inline-flex items-center gap-1">
                                <span>VIEW FULL AUDIT TRAIL</span><?= $arrow ?>
                            </a>
                        </div>

                    </div>

                </div>

                <!-- RIGHT STICKY SIDEBAR (4 COLS MATCHING WIREFRAME) -->
                <div class="space-y-4 lg:col-span-4 lg:sticky lg:top-4">

                    <!-- Card 1: BATCH RAB SUMMARY -->
                    <div class="<?= $card ?> p-4 space-y-3">
                        <div class="border-b border-white/10 pb-2">
                            <div class="text-[9px] font-bold uppercase tracking-wider text-emerald-300">BATCH RAB</div>
                            <div class="text-sm font-extrabold text-white">NK-001 &bull; 100 HA</div>
                        </div>

                        <div class="space-y-1.5 text-xs">
                            <div class="flex justify-between"><span class="text-gray-400">Total Requirement</span><span class="font-bold text-emerald-300">Rp15B</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">RAB Version</span><span class="font-bold text-white">V01</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Categories</span><span class="font-bold text-white">09</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Execution Progress</span><span class="font-bold text-amber-300">0%</span></div>
                        </div>

                        <div class="space-y-1.5 pt-1">
                            <a href="<?= $basePrefix ?>/milestones" class="w-full flex items-center justify-between rounded border border-white/10 bg-white/5 p-2 text-[10px] font-bold text-gray-300 hover:bg-white/10"><span>VIEW MILESTONE</span><span>&rsaquo;</span></a>
                            <a href="<?= $basePrefix ?>/vendors" class="w-full flex items-center justify-between rounded border border-white/10 bg-white/5 p-2 text-[10px] font-bold text-gray-300 hover:bg-white/10"><span>VIEW VENDORS</span><span>&rsaquo;</span></a>
                            <a href="<?= $basePrefix ?>/audit-trail" class="w-full flex items-center justify-between rounded border border-white/10 bg-white/5 p-2 text-[10px] font-bold text-gray-300 hover:bg-white/10"><span>VIEW AUDIT TRAIL</span><span>&rsaquo;</span></a>
                        </div>
                    </div>

                    <!-- Card 2: RAB DOCUMENTS -->
                    <div class="<?= $card ?> p-4 space-y-2.5">
                        <div class="border-b border-white/10 pb-2">
                            <h4 class="text-xs font-bold text-white">RAB DOCUMENTS</h4>
                        </div>

                        <div class="space-y-1.5 text-[10px]">
                            <div class="flex justify-between items-center rounded bg-white/5 p-1.5 border border-white/5">
                                <div><div class="font-bold text-white">RAB-NK-001-V01</div><div class="text-[8px] text-gray-400">Production Budget Structure</div></div>
                                <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span>
                            </div>
                            <div class="flex justify-between items-center rounded bg-white/5 p-1.5 border border-white/5">
                                <div><div class="font-bold text-white">RAB-NK-001-APPENDIX</div><div class="text-[8px] text-gray-400">Category Definitions</div></div>
                                <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span>
                            </div>
                            <div class="flex justify-between items-center rounded bg-white/5 p-1.5 border border-white/5">
                                <div><div class="font-bold text-white">RAB-NK-001-VENDOR</div><div class="text-[8px] text-gray-400">Vendor Allocation Records</div></div>
                                <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span>
                            </div>
                            <div class="flex justify-between items-center rounded bg-white/5 p-1.5 border border-white/5">
                                <div><div class="font-bold text-white">RAB-NK-001-VER</div><div class="text-[8px] text-gray-400">Verification Records</div></div>
                                <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span>
                            </div>
                        </div>

                        <a href="<?= $basePrefix ?>/documents" class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-300 hover:underline pt-1">DOCUMENT CENTER &rsaquo;</a>
                    </div>

                    <!-- Card 3: RAB VERSION CONTROL -->
                    <div class="<?= $card ?> p-4 space-y-2.5">
                        <div class="flex items-center justify-between border-b border-white/10 pb-2">
                            <h4 class="text-xs font-bold text-white">RAB Version Control</h4>
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">CURRENT</span>
                        </div>

                        <div class="space-y-1 text-xs">
                            <div class="flex justify-between"><span class="text-gray-400">VERSION</span><span class="font-bold font-mono text-white">RAB-NK-001-V01</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Created</span><span class="font-bold text-white">2026-06-12</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Created By</span><span class="font-bold text-emerald-300">NINA Operations</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">Last Updated</span><span class="font-bold text-white">2026-06-12</span></div>
                        </div>

                        <button type="button" class="w-full rounded-lg border border-white/15 bg-white/5 py-1.5 text-[10px] font-bold uppercase text-gray-300 hover:bg-white/10">
                            VIEW VERSION HISTORY &rsaquo;
                        </button>
                    </div>

                    <!-- Card 4: RAB CONTROL / STRUCTURE ANIMATED DONUT CHART -->
                    <div class="<?= $card ?> p-4 space-y-3">
                        <div class="flex items-start justify-between border-b border-white/10 pb-2">
                            <div>
                                <div class="text-[8px] font-bold uppercase tracking-wider text-gray-400">TOTAL REQUIREMENT</div>
                                <div class="text-base font-extrabold text-white">Rp15B</div>
                                <div class="text-[9px] text-gray-400 font-medium">Model / Indicative</div>
                            </div>
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30 uppercase">MODELED</span>
                        </div>

                        <!-- Donut Graphic SVG with Smooth 0 to Target Animation -->
                        <div class="flex flex-col items-center justify-center py-2">
                            <div class="relative flex items-center justify-center w-32 h-32">
                                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                                    <!-- Background Circle Track -->
                                    <path class="text-white/10" stroke-width="3" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <!-- Animated Donut Ring Path -->
                                    <path id="rabDonutArc" class="text-emerald-400" stroke-linecap="round" stroke-width="3.2" stroke-dasharray="100, 100" stroke-dashoffset="100" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" style="transition: stroke-dashoffset 1.5s cubic-bezier(0.4, 0, 0.2, 1);" />
                                </svg>
                                <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                                    <span class="text-xl font-black text-white">9</span>
                                    <span class="text-[8px] font-bold uppercase tracking-wider text-gray-400">Categories</span>
                                </div>
                            </div>
                            <span class="text-[9px] text-gray-500 italic mt-1.5">(No allocation data yet)</span>
                        </div>

                        <div class="space-y-1 text-[9px] text-gray-400">
                            <div class="flex justify-between"><span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> Planned</span><span class="font-bold text-white">100%</span></div>
                            <div class="flex justify-between"><span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-blue-400"></span> Allocated</span><span class="font-bold text-gray-500">0%</span></div>
                            <div class="flex justify-between"><span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-amber-400"></span> Committed</span><span class="font-bold text-gray-500">0%</span></div>
                            <div class="flex justify-between"><span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-rose-400"></span> Executed</span><span class="font-bold text-gray-500">0%</span></div>
                            <div class="flex justify-between"><span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-gray-400"></span> Verified</span><span class="font-bold text-gray-500">0%</span></div>
                        </div>
                    </div>

                    <!-- Card 5: CHANGE REQUEST -->
                    <div class="<?= $card ?> p-4 space-y-2.5">
                        <div class="border-b border-white/10 pb-2">
                            <h4 class="text-xs font-bold text-white">Change Request</h4>
                            <p class="text-[9px] text-gray-400">No active change request. RAB changes require review and approval.</p>
                        </div>

                        <button type="button" class="w-full rounded-lg border border-white/15 bg-white/5 py-2 text-[10px] font-bold uppercase text-gray-300 hover:bg-white/10">
                            REQUEST RAB CHANGE &rsaquo;
                        </button>
                    </div>

                    <!-- Card 6: EXPORT RAB -->
                    <div class="<?= $card ?> p-4 space-y-2">
                        <div class="text-[9px] font-bold uppercase tracking-wider text-gray-400">EXPORT RAB</div>
                        <p class="text-[9px] text-gray-400">Download RAB in your preferred format.</p>
                        <button type="button" class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-950/80 border border-emerald-400/40 py-2.5 text-[10px] font-extrabold uppercase text-emerald-300 hover:bg-emerald-900/80">
                            <span>EXPORT PDF</span><?= $svg($ic['download'], 'w-3.5 h-3.5') ?>
                        </button>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<style>
@keyframes fillBar {
    0% { width: 0%; }
    100% { width: 100%; }
}
.animate-bar-full {
    animation: fillBar 1.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        const donut = document.getElementById("rabDonutArc");
        if (donut) {
            donut.style.strokeDashoffset = "0";
        }
    }, 150);
});
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';

