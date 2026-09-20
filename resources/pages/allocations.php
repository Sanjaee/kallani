<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '08 / My Production Allocations — NINA Operating System';
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
    'grid'      => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/>',
    'pin'       => '<path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="2.5"/>',
    'check'     => '<circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 4.5-5"/>',
    'shield'    => '<path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/>',
    'clock'     => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>',
    'doc'       => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>',
    'filter'    => '<polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>',
    'download'  => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>',
    'search'    => '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>',
    'wallet'    => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 10h20"/><path d="M16 14h.01"/>',
    'user'      => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
];

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

        <!-- ================= HERO SECTION ================= -->
        <section class="relative overflow-hidden shadow-2xl" style="border-bottom: none !important;">
            <img src="<?= $basePrefix ?>/1.jpg" alt="Natural forest canopy" class="absolute inset-0 h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#050D07]/90 via-[#050D07]/60 to-[#050D07]/20"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#06120F]/90 via-transparent to-transparent"></div>

            <div class="relative space-y-4 px-6 pt-3 pb-6 lg:px-8 lg:pt-3 lg:pb-8">
                <nav aria-label="Breadcrumb" class="inline-flex flex-wrap items-center gap-2 text-[10px] font-mono font-semibold uppercase tracking-[0.14em] text-gray-300">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                    <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors">PRODUCTION REQUIREMENTS</a>
                    <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors">DR-2026-001</a>
                    <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="font-bold text-white uppercase">MY PRODUCTION ALLOCATIONS</span>
                </nav>

                <h1 class="max-w-3xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">My Production Allocations</h1>
                
                <p class="max-w-3xl text-base font-medium leading-relaxed text-gray-200">
                    Track every production allocation from PO confirmation through production execution, verification, delivery and commercial settlement.
                </p>
                <p class="text-[10px] italic text-gray-400">
                    Pantau setiap alokasi produksi mulai dari konfirmasi PO, eksekusi produksi, verifikasi, delivery hingga commercial settlement.
                </p>
            </div>
        </section>

        <!-- ================= CONTENT ================= -->
        <div class="space-y-6 px-4 pb-16 pt-6 sm:px-6 lg:px-8">

            <!-- ---------- 3. TOP SUMMARY (4 KPI CARDS) ---------- -->
            <section class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['target']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">ACTIVE ALLOCATIONS</div>
                        <div class="text-2xl font-extrabold leading-tight text-emerald-300">01</div>
                        <div class="text-[8px] text-gray-400">Active Production Units</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['coin']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">TOTAL ALLOCATED</div>
                        <div class="text-xl font-extrabold leading-tight text-white">Rp1B</div>
                        <div class="text-[8px] text-gray-400">Current Production Allocations</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['clock']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">IN PRODUCTION</div>
                        <div class="text-2xl font-extrabold leading-tight text-amber-300">00</div>
                        <div class="text-[8px] text-gray-400">Pending Execution</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['check']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">COMPLETED</div>
                        <div class="text-2xl font-extrabold leading-tight text-white">00</div>
                        <div class="text-[8px] text-gray-400">No completed batch yet</div>
                    </div>
                </div>

            </section>

            <!-- ---------- 4. FILTER BAR (SHOPEE PESANAN SAYA STYLE) ---------- -->
            <section class="<?= $card ?> p-4 space-y-3">
                <div class="flex items-center gap-2 overflow-x-auto pb-2 border-b border-white/10 text-xs font-bold text-gray-400">
                    <button type="button" class="rounded-lg bg-emerald-950 px-3 py-1.5 text-emerald-300 border border-emerald-400">ALL</button>
                    <button type="button" class="rounded-lg bg-white/5 px-3 py-1.5 hover:bg-white/10">REQUESTED</button>
                    <button type="button" class="rounded-lg bg-white/5 px-3 py-1.5 hover:bg-white/10">CONFIRMED</button>
                    <button type="button" class="rounded-lg bg-white/5 px-3 py-1.5 hover:bg-white/10">IN PRODUCTION</button>
                    <button type="button" class="rounded-lg bg-white/5 px-3 py-1.5 hover:bg-white/10">HARVEST</button>
                    <button type="button" class="rounded-lg bg-white/5 px-3 py-1.5 hover:bg-white/10">PROCESSING</button>
                    <button type="button" class="rounded-lg bg-white/5 px-3 py-1.5 hover:bg-white/10">DELIVERY</button>
                    <button type="button" class="rounded-lg bg-white/5 px-3 py-1.5 hover:bg-white/10">SETTLED</button>
                    <button type="button" class="rounded-lg bg-white/5 px-3 py-1.5 hover:bg-white/10">COMPLETED</button>
                </div>

                <div class="grid grid-cols-1 gap-2 sm:grid-cols-4 text-xs">
                    <div class="sm:col-span-2 relative">
                        <input type="text" placeholder="Search allocation, batch or project..." class="w-full rounded-lg border border-white/10 bg-[#07110E] px-3 py-1.5 text-xs text-white focus:outline-none focus:border-emerald-400" />
                    </div>
                    <div>
                        <select class="w-full rounded-lg border border-white/10 bg-[#07110E] px-2 py-1.5 text-xs text-gray-300"><option>Project: All</option></select>
                    </div>
                    <div>
                        <select class="w-full rounded-lg border border-white/10 bg-[#07110E] px-2 py-1.5 text-xs text-gray-300"><option>Sort: Recently Updated</option></select>
                    </div>
                </div>
            </section>

            <!-- ---------- 5, 6, 7. MAIN ALLOCATION CARD & PO COLLECTION ---------- -->
            <section class="<?= $card ?> p-6 space-y-6">

                <!-- Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-white/10 pb-4">
                    <div>
                        <div class="text-[9px] font-mono font-bold text-gray-400 uppercase">ALLOCATION ID: <span class="text-emerald-300">ALC-2026-NK001-0001</span></div>
                        <h2 class="text-xl font-extrabold text-white mt-0.5">NORTH KALIMANTAN PALM &bull; BATCH NK-001</h2>
                        <div class="text-xs text-gray-400">Region: North Kalimantan, Indonesia</div>
                    </div>
                    <span class="rounded bg-amber-500/20 px-3 py-1 text-xs font-bold text-amber-300 border border-amber-400/40 w-fit">PENDING CONFIRMATION</span>
                </div>

                <!-- Allocation Summary Row -->
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 text-xs">
                    <div class="p-3 rounded-lg border border-white/10 bg-[#07110E]">
                        <div class="text-[8px] text-gray-400 uppercase font-bold">YOUR ALLOCATION</div>
                        <div class="text-base font-black text-emerald-300 mt-0.5">Rp1,000,000,000</div>
                    </div>
                    <div class="p-3 rounded-lg border border-white/10 bg-[#07110E]">
                        <div class="text-[8px] text-gray-400 uppercase font-bold">BATCH REQUIREMENT</div>
                        <div class="text-base font-black text-white mt-0.5">Rp15B</div>
                    </div>
                    <div class="p-3 rounded-lg border border-white/10 bg-[#07110E]">
                        <div class="text-[8px] text-gray-400 uppercase font-bold">ALLOCATION UNITS</div>
                        <div class="text-base font-black text-white mt-0.5">1 / 15</div>
                    </div>
                    <div class="p-3 rounded-lg border border-white/10 bg-[#07110E]">
                        <div class="text-[8px] text-gray-400 uppercase font-bold">BATCH CAPACITY</div>
                        <div class="text-base font-black text-white mt-0.5">100 HA</div>
                    </div>
                    <div class="p-3 rounded-lg border border-white/10 bg-[#07110E] col-span-2 sm:col-span-1">
                        <div class="text-[8px] text-gray-400 uppercase font-bold">PROPORTION</div>
                        <div class="text-base font-black text-amber-300 mt-0.5">6.67%*</div>
                    </div>
                </div>
                <p class="text-[8px] italic text-gray-400">
                    *Proportion of the modeled batch requirement; not legal ownership of land or the operating company.
                </p>

                <!-- PO Collection Progress -->
                <div class="space-y-2 rounded-xl border border-white/10 bg-[#07110E] p-4">
                    <div class="flex justify-between text-xs font-bold">
                        <span class="text-white uppercase tracking-wider">PO Collection Progress</span>
                        <span class="text-emerald-300">Rp1B / Rp15B (6.67%)</span>
                    </div>
                    <div class="h-2 w-full rounded-full bg-white/10 overflow-hidden">
                        <div class="h-full bg-emerald-400 w-[6.67%]"></div>
                    </div>
                    <div class="flex justify-between text-[9px] text-gray-400 pt-1 font-mono">
                        <span>YOUR ALLOCATION: <strong class="text-white">Rp1B</strong></span>
                        <span>TOTAL COLLECTED: <strong class="text-emerald-300">Rp1B</strong></span>
                        <span>REMAINING: <strong class="text-white">Rp14B</strong></span>
                    </div>
                </div>

                <!-- ---------- 8. MAIN ORDER-TRACKING TIMELINE (HIGH-PRECISION 12-STAGE EXECUTION) ---------- -->
                <div class="space-y-4 border-t border-white/10 pt-5">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-xs font-bold uppercase tracking-wider text-white">Order Execution Tracker</h3>
                                <span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-mono font-bold text-emerald-300 border border-emerald-500/30">12 STAGES</span>
                            </div>
                            <p class="text-[10px] text-gray-400">End-to-end lifecycle from PO confirmation to commercial delivery and settlement.</p>
                        </div>
                        
                        <!-- Legend -->
                        <div class="flex items-center gap-3 text-[9px] font-mono font-bold text-gray-400">
                            <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-emerald-400 shadow-sm shadow-emerald-400/50"></span> COMPLETED</span>
                            <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-amber-400 animate-pulse shadow-sm shadow-amber-400/50"></span> CURRENT</span>
                            <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full border border-gray-500 bg-[#07110E]"></span> LOCKED</span>
                        </div>
                    </div>

                    <!-- 12-Stage Horizontal Timeline Container with Continuous Background Line -->
                    <div class="relative overflow-x-auto pb-4 pt-2 scrollbar-thin scrollbar-thumb-white/10 scrollbar-track-transparent">
                        <div class="relative min-w-[1150px] px-8">

                            <!-- Continuous Base Track Line (Unbroken 100% line behind all 12 steps) -->
                            <div class="absolute left-10 right-10 top-[13px] h-[2px] bg-white/20 z-0"></div>

                            <!-- Active Progress Track Line (From Step 01 to Step 02) -->
                            <div class="absolute left-10 top-[13px] w-[9%] h-[3px] bg-gradient-to-r from-emerald-400 via-emerald-300 to-amber-400 z-0 shadow-sm shadow-emerald-400/50"></div>

                            <!-- 12 Step Nodes Overlay (Evenly Space Grid) -->
                            <div class="relative z-10 flex justify-between items-start text-[9px] font-mono">

                                <!-- 01 PO REQUEST (COMPLETED) -->
                                <div class="group relative flex flex-col items-center flex-1 max-w-[90px]">
                                    <div class="h-7 w-7 rounded-full bg-emerald-400 text-[#04100B] font-extrabold flex items-center justify-center text-[11px] shadow-lg shadow-emerald-400/40 ring-4 ring-[#0B1815]">✓</div>
                                    <span class="mt-2 font-bold text-white tracking-tight text-center">01 PO REQUEST</span>
                                    <span class="text-[7px] text-emerald-400 uppercase font-semibold">2026-06-01</span>
                                </div>

                                <!-- 02 PO CONFIRMATION (CURRENT / PENDING) -->
                                <div class="group relative flex flex-col items-center flex-1 max-w-[95px]">
                                    <div class="relative flex items-center justify-center bg-[#0B1815] rounded-full ring-4 ring-[#0B1815]">
                                        <span class="absolute h-8 w-8 rounded-full bg-amber-400/20 animate-ping"></span>
                                        <span class="h-7 w-7 rounded-full border-2 border-amber-400 bg-[#0B1815] text-amber-300 font-extrabold flex items-center justify-center text-[10px] shadow-lg shadow-amber-400/40">
                                            <span class="h-2.5 w-2.5 rounded-full bg-amber-400 shadow-sm shadow-amber-400"></span>
                                        </span>
                                    </div>
                                    <span class="mt-2 font-bold text-amber-300 tracking-tight text-center">02 CONFIRMATION</span>
                                    <span class="text-[7px] text-amber-300 uppercase font-extrabold animate-pulse">PENDING REVIEW</span>
                                </div>

                                <!-- 03 MILESTONE 1 (LOCKED) -->
                                <div class="group relative flex flex-col items-center flex-1 max-w-[90px] opacity-60 hover:opacity-100 transition">
                                    <div class="h-7 w-7 rounded-full border border-white/30 bg-[#0B1815] text-gray-300 flex items-center justify-center text-[9px] group-hover:border-white/60 ring-4 ring-[#0B1815]">○</div>
                                    <span class="mt-2 font-semibold text-gray-300 tracking-tight text-center">03 MILESTONE 1</span>
                                    <span class="text-[7px] text-gray-400">25% RELEASE</span>
                                </div>

                                <!-- 04 VERIFICATION (LOCKED) -->
                                <div class="group relative flex flex-col items-center flex-1 max-w-[90px] opacity-60 hover:opacity-100 transition">
                                    <div class="h-7 w-7 rounded-full border border-white/30 bg-[#0B1815] text-gray-300 flex items-center justify-center text-[9px] group-hover:border-white/60 ring-4 ring-[#0B1815]">○</div>
                                    <span class="mt-2 font-semibold text-gray-300 tracking-tight text-center">04 VERIFICATION</span>
                                    <span class="text-[7px] text-gray-400">AUDIT PASS</span>
                                </div>

                                <!-- 05 MILESTONE 2 (LOCKED) -->
                                <div class="group relative flex flex-col items-center flex-1 max-w-[90px] opacity-60 hover:opacity-100 transition">
                                    <div class="h-7 w-7 rounded-full border border-white/30 bg-[#0B1815] text-gray-300 flex items-center justify-center text-[9px] group-hover:border-white/60 ring-4 ring-[#0B1815]">○</div>
                                    <span class="mt-2 font-semibold text-gray-300 tracking-tight text-center">05 MILESTONE 2</span>
                                    <span class="text-[7px] text-gray-400">25% RELEASE</span>
                                </div>

                                <!-- 06 PRODUCTION (LOCKED) -->
                                <div class="group relative flex flex-col items-center flex-1 max-w-[90px] opacity-60 hover:opacity-100 transition">
                                    <div class="h-7 w-7 rounded-full border border-white/30 bg-[#0B1815] text-gray-300 flex items-center justify-center text-[9px] group-hover:border-white/60 ring-4 ring-[#0B1815]">○</div>
                                    <span class="mt-2 font-semibold text-gray-300 tracking-tight text-center">06 PRODUCTION</span>
                                    <span class="text-[7px] text-gray-400">CROP GROWTH</span>
                                </div>

                                <!-- 07 MILESTONE 3 (LOCKED) -->
                                <div class="group relative flex flex-col items-center flex-1 max-w-[90px] opacity-60 hover:opacity-100 transition">
                                    <div class="h-7 w-7 rounded-full border border-white/30 bg-[#0B1815] text-gray-300 flex items-center justify-center text-[9px] group-hover:border-white/60 ring-4 ring-[#0B1815]">○</div>
                                    <span class="mt-2 font-semibold text-gray-300 tracking-tight text-center">07 MILESTONE 3</span>
                                    <span class="text-[7px] text-gray-400">25% RELEASE</span>
                                </div>

                                <!-- 08 HARVEST (LOCKED) -->
                                <div class="group relative flex flex-col items-center flex-1 max-w-[90px] opacity-60 hover:opacity-100 transition">
                                    <div class="h-7 w-7 rounded-full border border-white/30 bg-[#0B1815] text-gray-300 flex items-center justify-center text-[9px] group-hover:border-white/60 ring-4 ring-[#0B1815]">○</div>
                                    <span class="mt-2 font-semibold text-gray-300 tracking-tight text-center">08 HARVEST</span>
                                    <span class="text-[7px] text-gray-400">YIELD WEIGH</span>
                                </div>

                                <!-- 09 PROCESSING (LOCKED) -->
                                <div class="group relative flex flex-col items-center flex-1 max-w-[90px] opacity-60 hover:opacity-100 transition">
                                    <div class="h-7 w-7 rounded-full border border-white/30 bg-[#0B1815] text-gray-300 flex items-center justify-center text-[9px] group-hover:border-white/60 ring-4 ring-[#0B1815]">○</div>
                                    <span class="mt-2 font-semibold text-gray-300 tracking-tight text-center">09 PROCESSING</span>
                                    <span class="text-[7px] text-gray-400">MILL OUTPUT</span>
                                </div>

                                <!-- 10 DELIVERY (LOCKED) -->
                                <div class="group relative flex flex-col items-center flex-1 max-w-[90px] opacity-60 hover:opacity-100 transition">
                                    <div class="h-7 w-7 rounded-full border border-white/30 bg-[#0B1815] text-gray-300 flex items-center justify-center text-[9px] group-hover:border-white/60 ring-4 ring-[#0B1815]">○</div>
                                    <span class="mt-2 font-semibold text-gray-300 tracking-tight text-center">10 DELIVERY</span>
                                    <span class="text-[7px] text-gray-400">BUYER RECEIPT</span>
                                </div>

                                <!-- 11 SETTLEMENT (LOCKED) -->
                                <div class="group relative flex flex-col items-center flex-1 max-w-[95px] opacity-60 hover:opacity-100 transition">
                                    <div class="h-7 w-7 rounded-full border border-white/30 bg-[#0B1815] text-gray-300 flex items-center justify-center text-[9px] group-hover:border-white/60 ring-4 ring-[#0B1815]">○</div>
                                    <span class="mt-2 font-semibold text-gray-300 tracking-tight text-center">11 SETTLEMENT</span>
                                    <span class="text-[7px] text-gray-400">COMMERCIAL</span>
                                </div>

                                <!-- 12 COMPLETED (LOCKED) -->
                                <div class="group relative flex flex-col items-center flex-1 max-w-[90px] opacity-60 hover:opacity-100 transition">
                                    <div class="h-7 w-7 rounded-full border border-white/30 bg-[#0B1815] text-gray-300 flex items-center justify-center text-[9px] group-hover:border-white/60 ring-4 ring-[#0B1815]">○</div>
                                    <span class="mt-2 font-semibold text-gray-300 tracking-tight text-center">12 COMPLETED</span>
                                    <span class="text-[7px] text-gray-400">BATCH CLOSED</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </section>

            <!-- ================= MAIN LAYOUT GRID (LEFT 8 COLS, RIGHT 4 COLS STICKY) ================= -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 items-start">

                <!-- LEFT MAIN CONTENT (8 COLS) -->
                <div class="space-y-6 lg:col-span-8">

                    <!-- 11. MILESTONE TRACKER & DETAIL -->
                    <section class="<?= $card ?> p-5 space-y-4">
                        <div class="flex items-center justify-between border-b border-white/10 pb-3">
                            <div>
                                <h3 class="text-base font-bold text-white">Production Milestones</h3>
                                <p class="text-xs text-gray-300">Milestone release and execution timeline for Batch NK-001.</p>
                            </div>
                            <a href="<?= $basePrefix ?>/milestones" class="text-xs font-bold text-emerald-300 hover:underline">VIEW MILESTONE RECORD &rsaquo;</a>
                        </div>

                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 text-xs">
                            <div class="rounded-xl border border-emerald-400/50 bg-emerald-950/30 p-3 space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-white">MILESTONE 01</span>
                                    <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span>
                                </div>
                                <div class="text-[9px] text-gray-300">25% Planned Release</div>
                                <div class="space-y-0.5 text-[8px] text-gray-400">
                                    <div>&bull; PO Collection: <span class="text-emerald-300 font-bold">100%</span></div>
                                    <div>&bull; RAB Confirmation: <span class="text-emerald-300 font-bold">Done</span></div>
                                    <div>&bull; Vendor Assignment: <span class="text-amber-300">Pending</span></div>
                                </div>
                            </div>

                            <div class="rounded-xl border border-white/10 bg-[#07110E] p-3 space-y-2 opacity-60">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-white">MILESTONE 02</span>
                                    <span class="text-[8px] text-gray-500 uppercase font-bold">LOCKED</span>
                                </div>
                                <div class="text-[9px] text-gray-400">25% Release</div>
                            </div>

                            <div class="rounded-xl border border-white/10 bg-[#07110E] p-3 space-y-2 opacity-60">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-white">MILESTONE 03</span>
                                    <span class="text-[8px] text-gray-500 uppercase font-bold">LOCKED</span>
                                </div>
                                <div class="text-[9px] text-gray-400">25% Release</div>
                            </div>

                            <div class="rounded-xl border border-white/10 bg-[#07110E] p-3 space-y-2 opacity-60">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-white">MILESTONE 04</span>
                                    <span class="text-[8px] text-gray-500 uppercase font-bold">LOCKED</span>
                                </div>
                                <div class="text-[9px] text-gray-400">25% Release</div>
                            </div>
                        </div>
                    </section>

                    <!-- 13. RAB TRACKING & 14. VENDOR EXECUTION -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <!-- 13. Production RAB -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">Production RAB</h3>
                                    <p class="text-[9px] text-gray-400">Operating budget structure associated with your batch.</p>
                                </div>

                                <div class="space-y-1 text-xs">
                                    <div class="flex justify-between"><span class="text-gray-400">TOTAL BATCH REQUIREMENT</span><span class="font-bold text-emerald-300">Rp15B</span></div>
                                    <div class="flex justify-between"><span class="text-gray-400">Categories</span><span class="font-bold text-white">09 Categories</span></div>
                                    <div class="flex justify-between"><span class="text-gray-400">Execution Status</span><span class="font-bold text-amber-300">Pending Allocation</span></div>
                                </div>
                            </div>

                            <a href="<?= $basePrefix ?>/rab" class="w-fit rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-[10px] font-bold uppercase text-gray-300 hover:bg-white/10 inline-flex items-center gap-1">
                                <span>VIEW BATCH RAB</span><?= $arrow ?>
                            </a>
                        </div>

                        <!-- 14. Vendor Execution -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">Vendor Execution</h3>
                                    <p class="text-[9px] text-gray-400">0 / 4 Vendors Assigned</p>
                                </div>

                                <div class="grid grid-cols-2 gap-2 text-[9px]">
                                    <div class="p-2 rounded bg-[#07110E] border border-white/5">
                                        <div class="font-bold text-emerald-300">SEED</div>
                                        <div class="text-white">Demo Seed Producer</div>
                                        <span class="text-amber-300 text-[7px] font-bold">PENDING</span>
                                    </div>
                                    <div class="p-2 rounded bg-[#07110E] border border-white/5">
                                        <div class="font-bold text-emerald-300">FERTILIZER</div>
                                        <div class="text-white">Demo Input Supplier</div>
                                        <span class="text-amber-300 text-[7px] font-bold">PENDING</span>
                                    </div>
                                </div>
                            </div>

                            <a href="<?= $basePrefix ?>/vendors" class="w-fit rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-[10px] font-bold uppercase text-gray-300 hover:bg-white/10 inline-flex items-center gap-1">
                                <span>VIEW VENDORS</span><?= $arrow ?>
                            </a>
                        </div>

                    </div>

                    <!-- 15. FIELD PROGRESS & 16. FIELD UPDATES -->
                    <section class="<?= $card ?> p-5 space-y-4">
                        <div class="flex items-center justify-between border-b border-white/10 pb-3">
                            <div>
                                <h3 class="text-base font-bold text-white">Production Progress & Field Updates</h3>
                                <p class="text-xs text-gray-300">Live operational field logs from North Kalimantan plantation.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-[9px] text-center">
                            <div class="p-2 rounded bg-[#07110E] border border-emerald-400/40 font-bold text-emerald-300">LAND: VERIFIED</div>
                            <div class="p-2 rounded bg-[#07110E] border border-amber-400/40 font-bold text-amber-300">PREP: IN PROGRESS</div>
                            <div class="p-2 rounded bg-[#07110E] border border-white/10 text-gray-400">PLANTING: PENDING</div>
                            <div class="p-2 rounded bg-[#07110E] border border-white/10 text-gray-400">HARVEST: PENDING</div>
                        </div>

                        <div class="rounded-xl border border-white/10 bg-[#07110E] p-4 flex gap-4 items-center">
                            <div class="relative w-20 h-20 shrink-0 overflow-hidden rounded-lg border border-white/15">
                                <img src="<?= $basePrefix ?>/4.jpg" alt="Field Evidence" class="h-full w-full object-cover" />
                                <span class="absolute top-1 left-1 rounded bg-black/80 px-1 py-0.5 text-[7px] font-bold text-amber-300">SIMULATED</span>
                            </div>
                            <div class="space-y-1 text-xs text-gray-300 flex-1">
                                <div class="font-bold text-white text-xs">FIELD UPDATE #001 &bull; North Kalimantan</div>
                                <div class="text-[10px] text-gray-400">Activity: Land Preparation &bull; Date: 2026-06-12</div>
                                <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">IN PROGRESS</span>
                            </div>
                        </div>
                    </section>

                    <!-- 17. VERIFICATION & 18. DOCUMENTS -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <!-- 17. Verification -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">Verification Status</h3>
                                </div>

                                <div class="space-y-1 text-[9px]">
                                    <div class="flex justify-between py-0.5 border-b border-white/5"><span class="text-gray-300">Land & GIS Boundary</span><span class="text-emerald-300 font-bold">Verified</span></div>
                                    <div class="flex justify-between py-0.5 border-b border-white/5"><span class="text-gray-300">Production Partner</span><span class="text-amber-300 font-bold">Pending</span></div>
                                    <div class="flex justify-between py-0.5 border-b border-white/5"><span class="text-gray-300">Vendor Identity</span><span class="text-amber-300 font-bold">Pending</span></div>
                                    <div class="flex justify-between py-0.5"><span class="text-gray-300">Production & Harvest</span><span class="text-gray-500 font-bold">Not Started</span></div>
                                </div>
                            </div>

                            <a href="<?= $basePrefix ?>/verification" class="w-fit rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-[10px] font-bold uppercase text-gray-300 hover:bg-white/10 inline-flex items-center gap-1">
                                <span>VIEW VERIFICATION MATRIX</span><?= $arrow ?>
                            </a>
                        </div>

                        <!-- 18. Documents -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="border-b border-white/10 pb-2">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-white">Documents</h3>
                                </div>

                                <div class="space-y-1.5 text-[9px]">
                                    <div class="flex justify-between items-center p-1.5 rounded bg-white/5 border border-white/5">
                                        <span class="text-white font-bold">Batch NK-001 Overview.pdf</span><span class="text-amber-300">AVAILABLE</span>
                                    </div>
                                    <div class="flex justify-between items-center p-1.5 rounded bg-white/5 border border-white/5">
                                        <span class="text-white font-bold">RAB-NK-001.pdf</span><span class="text-amber-300">AVAILABLE</span>
                                    </div>
                                </div>
                            </div>

                            <a href="<?= $basePrefix ?>/documents" class="w-fit rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-[10px] font-bold uppercase text-gray-300 hover:bg-white/10 inline-flex items-center gap-1">
                                <span>OPEN DOCUMENT CENTER</span><?= $arrow ?>
                            </a>
                        </div>

                    </div>

                </div>

                <!-- RIGHT STICKY SIDEBAR (4 COLS MATCHING WIREFRAME) -->
                <div class="space-y-4 lg:col-span-4 lg:sticky lg:top-4">

                    <!-- Card 1: CURRENT STATUS & NEXT STEPS -->
                    <div class="<?= $card ?> p-5 space-y-4">
                        <div class="border-b border-white/10 pb-3">
                            <div class="text-[9px] font-bold uppercase tracking-wider text-emerald-300">CURRENT STATUS</div>
                            <h3 class="text-base font-black text-white mt-0.5">PO CONFIRMATION</h3>
                            <div class="text-[10px] text-amber-300 font-bold mt-1">&bull; PENDING REVIEW</div>
                        </div>

                        <p class="text-xs text-gray-300 leading-relaxed">
                            Your allocation request has been submitted and is awaiting confirmation.
                        </p>

                        <div class="space-y-2 border-t border-white/10 pt-3">
                            <div class="text-[10px] font-bold text-white uppercase">Next Steps</div>
                            <div class="space-y-1 text-[9px] text-gray-300">
                                <div>1. Allocation Review</div>
                                <div>2. Commercial & Legal Confirmation</div>
                                <div>3. Allocation Recorded</div>
                                <div>4. Production Batch Enters Execution</div>
                            </div>
                        </div>

                        <button type="button" class="w-full rounded-xl bg-white/5 border border-white/15 py-2.5 text-xs font-bold text-gray-300 uppercase hover:bg-white/10">
                            VIEW REQUIREMENTS &rsaquo;
                        </button>
                    </div>

                    <!-- Card 2: REGISTERED WALLET IDENTITY -->
                    <div class="<?= $card ?> p-5 space-y-3">
                        <div class="border-b border-white/10 pb-2">
                            <h4 class="text-xs font-bold text-white uppercase tracking-wider">Registered Participant Wallet</h4>
                        </div>

                        <div class="space-y-1.5 text-xs">
                            <div class="flex justify-between"><span class="text-gray-400">PARTICIPANT ID</span><span class="font-bold text-white">MITRA-0001</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">REGISTERED WALLET</span><span class="font-mono text-emerald-300 text-[10px]">0x••••••••C2B8</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">STATUS</span><span class="text-emerald-300 font-bold">REGISTERED</span></div>
                        </div>

                        <p class="text-[8px] italic text-gray-500 pt-1">
                            Wallet identity layer for traceable transaction records.
                        </p>
                    </div>

                    <!-- Card 3: LINKED DEMAND & COMMERCIAL SETTLEMENT -->
                    <div class="<?= $card ?> p-5 space-y-3">
                        <div class="border-b border-white/10 pb-2">
                            <h4 class="text-xs font-bold text-white uppercase tracking-wider">Linked Demand & Commercial Settlement</h4>
                        </div>

                        <div class="space-y-2 text-xs">
                            <div class="flex justify-between"><span class="text-gray-400">LINKED DEMAND</span><span class="font-mono text-emerald-300 font-bold">DR-2026-001</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">BUYER</span><span class="text-white font-bold">Demo Offtake Buyer</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">SETTLEMENT STATUS</span><span class="text-amber-300 font-bold">NOT YET AVAILABLE</span></div>
                        </div>

                        <p class="text-[8px] italic text-gray-400">
                            Settlement becomes available only after applicable production, weighing, processing, delivery and commercial conditions are verified.
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
