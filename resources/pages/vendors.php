<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$constants = $config['system_constants'] ?? [];
$demoDemand = $config['demo_demands'][0] ?? [];
$title = '19 / Partners & Vendors Marketplace — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'vendors';

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
    'user'      => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
    'wallet'    => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 10h20"/><path d="M16 14h.01"/>',
    'building'  => '<rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/>',
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

        <!-- ================= 01 & 02. HERO HEADER & NETWORK STRUCTURE ================= -->
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
                        <span class="font-bold text-white uppercase">PARTNERS & VENDORS</span>
                    </nav>

                    <div class="flex flex-wrap items-center gap-2 text-[10px] font-bold">
                        <span class="rounded bg-emerald-950 px-3 py-1 text-emerald-300 border border-emerald-500/30 uppercase tracking-wider">PRODUCTION SUPPLY NETWORK</span>
                        <span class="rounded bg-white/10 px-3 py-1 text-gray-300 border border-white/10 uppercase tracking-wider">NETWORK / DEMO ENVIRONMENT</span>
                    </div>
                </div>

                <!-- Headline & Right Diagram Grid -->
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 items-center">
                    <div class="space-y-2 lg:col-span-6">
                        <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-200">
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">SUPPLY-SIDE NETWORK</span>
                            <span>19 / PARTNERS & VENDORS MARKETPLACE</span>
                        </div>

                        <h1 class="max-w-2xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">Build Production With Verified Capabilities.</h1>
                        
                        <p class="max-w-2xl text-sm font-medium leading-relaxed text-gray-200">
                            Discover production partners and operational vendors connected to NINA's productive asset network — from land preparation and planting inputs to equipment, logistics and processing.
                        </p>
                        <p class="text-[11px] italic text-gray-400">
                            Temukan mitra produksi dan vendor operasional berdasarkan kapasitas, wilayah, verifikasi, pengalaman dan kebutuhan produksi.
                        </p>
                    </div>

                    <!-- Right Side Interactive Flow Diagram (02) -->
                    <div class="lg:col-span-6">
                        <div class="rounded-xl border border-emerald-500/30 bg-[#07130D]/95 p-4 shadow-2xl backdrop-blur-md space-y-3 font-mono text-[10px]">
                            <div class="flex items-center justify-between border-b border-white/10 pb-2">
                                <span class="font-bold text-emerald-400 uppercase">OPERATIONAL LINKAGE ARCHITECTURE</span>
                                <span class="text-gray-400 text-[9px]">RAB $\rightarrow$ WORK ORDER MATCHING</span>
                            </div>

                            <div class="bg-black/50 p-3 rounded-lg border border-white/5 space-y-2 text-center">
                                <div class="inline-block bg-emerald-950 px-3 py-1 rounded text-emerald-300 border border-emerald-500/30 font-bold">
                                    DEMAND (Offtake Requirement)
                                </div>
                                <div class="text-gray-500 font-bold">↓</div>
                                <div class="inline-block bg-white/10 px-3 py-1 rounded text-white border border-white/10 font-bold">
                                    PRODUCTION BATCH & RAB
                                </div>
                                <div class="text-gray-500 font-bold">↓</div>
                                <div class="grid grid-cols-3 gap-2">
                                    <div class="bg-emerald-900/40 p-1.5 rounded border border-emerald-500/30 text-emerald-200">
                                        PARTNER<br/><span class="text-[8px] text-gray-400">Land & Field</span>
                                    </div>
                                    <div class="bg-emerald-900/40 p-1.5 rounded border border-emerald-500/30 text-emerald-200">
                                        VENDOR<br/><span class="text-[8px] text-gray-400">Heavy Equip & Inputs</span>
                                    </div>
                                    <div class="bg-emerald-900/40 p-1.5 rounded border border-emerald-500/30 text-emerald-200">
                                        PROCESSOR<br/><span class="text-[8px] text-gray-400">Mill / Logistics</span>
                                    </div>
                                </div>
                                <div class="text-gray-500 font-bold">↓</div>
                                <div class="inline-block bg-amber-950 px-3 py-1 rounded text-amber-300 border border-amber-500/30 font-bold">
                                    WORK ORDER $\rightarrow$ EXECUTION $\rightarrow$ VERIFICATION $\rightarrow$ OUTPUT
                                </div>
                            </div>

                            <p class="text-[9px] text-gray-400 italic text-center">
                                "RAB defines what is required. The network identifies who can execute it."
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ================= MAIN BODY CONTENT ================= -->
        <div class="space-y-6 px-4 pb-16 pt-6 sm:px-6 lg:px-8">

            <!-- ---------- 03. TOP KPI STRIP (5 FACTUAL CARDS) ---------- -->
            <section class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5">

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">PRODUCTION PARTNERS</span>
                        <span class="text-emerald-400"><?= $svg($ic['user'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-white font-mono">—</div>
                    <div class="text-[9px] text-gray-400">Verification data pending</div>
                </div>

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">OPERATIONAL VENDORS</span>
                        <span class="text-emerald-400"><?= $svg($ic['truck'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-white font-mono">—</div>
                    <div class="text-[9px] text-gray-400">Vendor network configured</div>
                </div>

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">ACTIVE REGIONS</span>
                        <span class="text-emerald-400"><?= $svg($ic['globe'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-emerald-300 font-mono">02</div>
                    <div class="text-[9px] text-gray-400">North & South Kalimantan</div>
                </div>

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">ACTIVE WORK ORDERS</span>
                        <span class="text-amber-400"><?= $svg($ic['doc'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-amber-300 font-mono">01</div>
                    <div class="text-[9px] text-amber-400/80 font-medium">Demo WO-NK-001-M1-001</div>
                </div>

                <div class="<?= $card ?> px-4 py-3 col-span-2 sm:col-span-1">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">COMPLETED BATCHES</span>
                        <span class="text-gray-400"><?= $svg($ic['check'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-gray-400 font-mono">00</div>
                    <div class="text-[9px] text-gray-500">Historical record pending</div>
                </div>

            </section>

            <!-- ---------- 04 & 05. PRIMARY NAVIGATION & SEARCH BAR ---------- -->
            <section class="space-y-3">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="flex items-center gap-1.5 overflow-x-auto pb-2 scrollbar-none text-[11px] font-mono">
                        <button class="rounded-lg bg-emerald-500 text-black font-bold px-3 py-1.5 uppercase shadow">ALL NETWORK</button>
                        <button class="rounded-lg bg-white/5 hover:bg-white/10 text-gray-300 px-3 py-1.5 uppercase">PRODUCTION PARTNERS (1)</button>
                        <button class="rounded-lg bg-white/5 hover:bg-white/10 text-gray-300 px-3 py-1.5 uppercase">VENDORS (1)</button>
                        <button class="rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 px-3 py-1.5 uppercase">PROCESSING (0)</button>
                        <button class="rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 px-3 py-1.5 uppercase">LOGISTICS (0)</button>
                        <button class="rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 px-3 py-1.5 uppercase">VERIFICATION</button>
                        <button class="rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 px-3 py-1.5 uppercase">MY NETWORK (0)</button>
                    </div>

                    <a href="#register-partner-form" class="rounded-lg bg-emerald-950 border border-emerald-500/40 text-emerald-300 font-mono text-[11px] font-bold px-3 py-1.5 uppercase tracking-wide hover:bg-emerald-900 shrink-0">
                        + REGISTER AS PARTNER / VENDOR
                    </a>
                </div>

                <!-- Search Input Bar -->
                <div class="<?= $card ?> p-3 flex flex-col sm:flex-row items-center gap-3">
                    <div class="relative flex-1 w-full">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <?= $svg($ic['search'], 'w-4 h-4') ?>
                        </span>
                        <input type="text" placeholder="Search partner, vendor, entity, capability or region (e.g. 'Heavy equipment', 'North Kalimantan', 'PT-NINA-PARTNER-001')..." class="w-full rounded-lg bg-black/40 border border-white/10 pl-9 pr-4 py-2 text-xs font-mono text-white placeholder-gray-500 focus:border-emerald-500 focus:outline-none" />
                    </div>
                    <button class="w-full sm:w-auto rounded-lg bg-emerald-500 hover:bg-emerald-400 text-black font-extrabold text-xs px-5 py-2 uppercase font-mono shadow">
                        SEARCH
                    </button>
                </div>
            </section>

            <!-- ---------- 06. HORIZONTAL FILTER CONTROLS ---------- -->
            <section class="<?= $card ?> p-4 space-y-3">
                <div class="text-[10px] font-mono font-bold uppercase tracking-wider text-gray-400">FACTUAL NETWORK FILTERS</div>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-2 text-xs font-mono">
                    <div>
                        <label class="text-[9px] text-gray-400 block mb-1">ROLE</label>
                        <select class="w-full rounded bg-black/40 border border-white/10 px-2 py-1.5 text-gray-300 focus:border-emerald-500 text-xs">
                            <option>All Roles</option>
                            <option>Production Partner</option>
                            <option>Land Partner</option>
                            <option>Heavy Equipment</option>
                            <option>Seed Producer</option>
                            <option>Input Supplier</option>
                            <option>Processing Partner</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-[9px] text-gray-400 block mb-1">REGION</label>
                        <select class="w-full rounded bg-black/40 border border-white/10 px-2 py-1.5 text-gray-300 focus:border-emerald-500 text-xs">
                            <option>All Regions</option>
                            <option>North Kalimantan</option>
                            <option>South Kalimantan</option>
                            <option>East Kalimantan</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-[9px] text-gray-400 block mb-1">CAPACITY</label>
                        <select class="w-full rounded bg-black/40 border border-white/10 px-2 py-1.5 text-gray-300 focus:border-emerald-500 text-xs">
                            <option>All Capacities</option>
                            <option>100 HA+</option>
                            <option>1,000 HA+</option>
                            <option>10,000 HA+</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-[9px] text-gray-400 block mb-1">VERIFICATION</label>
                        <select class="w-full rounded bg-black/40 border border-white/10 px-2 py-1.5 text-gray-300 focus:border-emerald-500 text-xs">
                            <option>All Statuses</option>
                            <option>Verified</option>
                            <option>Pending</option>
                            <option>Correction Required</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-[9px] text-gray-400 block mb-1">PROJECT HISTORY</label>
                        <select class="w-full rounded bg-black/40 border border-white/10 px-2 py-1.5 text-gray-300 focus:border-emerald-500 text-xs">
                            <option>All History</option>
                            <option>New Entity</option>
                            <option>Active Batches</option>
                            <option>Completed Batches</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-[9px] text-gray-400 block mb-1">SORT BY</label>
                        <select class="w-full rounded bg-black/40 border border-white/10 px-2 py-1.5 text-gray-300 focus:border-emerald-500 text-xs">
                            <option>Capacity</option>
                            <option>Verification Status</option>
                            <option>Region</option>
                            <option>Recently Updated</option>
                        </select>
                    </div>
                </div>
            </section>

            <!-- ---------- 07, 08, 09 & 10. PRODUCTION PARTNERS SECTION & CAPACITY TIERS ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- Production Partner Cards (8 cols) -->
                <div class="lg:col-span-8 space-y-6">

                    <!-- Partner Card 01 -->
                    <div class="<?= $card ?> p-5 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-white/10 pb-3">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="rounded bg-amber-950 px-2 py-0.5 text-[9px] font-bold text-amber-300 border border-amber-500/30 uppercase">PENDING VERIFICATION</span>
                                    <span class="text-xs font-mono text-gray-400">ENTITY ID: PT-NINA-PARTNER-001</span>
                                </div>
                                <h3 class="text-xl font-extrabold text-white mt-1">DEMO PRODUCTION PARTNER</h3>
                                <p class="text-xs text-gray-300 font-mono">Role: <strong class="text-white">Production Partner</strong> | Region: <strong class="text-white">North Kalimantan</strong></p>
                            </div>
                            <button class="rounded-lg bg-emerald-500 hover:bg-emerald-400 text-black font-extrabold text-xs px-4 py-2 uppercase font-mono shadow shrink-0">
                                VIEW PROFILE
                            </button>
                        </div>

                        <!-- Partner Details Grid (08) -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 bg-white/5 p-3 rounded-lg border border-white/5 text-xs font-mono">
                            <div>
                                <div class="text-[9px] text-gray-400">MAPPED CAPACITY</div>
                                <div class="mt-0.5 text-sm font-bold text-emerald-300">200 HA</div>
                                <div class="text-[9px] text-gray-500">North Kalimantan</div>
                            </div>
                            <div>
                                <div class="text-[9px] text-gray-400">STANDARD BATCH</div>
                                <div class="mt-0.5 text-sm font-bold text-white">100 HA</div>
                                <div class="text-[9px] text-gray-500">NK-001 Mapped</div>
                            </div>
                            <div>
                                <div class="text-[9px] text-gray-400">COMPLETED BATCHES</div>
                                <div class="mt-0.5 text-sm font-bold text-white">00</div>
                                <div class="text-[9px] text-gray-500">Historical Record Pending</div>
                            </div>
                            <div>
                                <div class="text-[9px] text-gray-400">REPUTATION STATE</div>
                                <div class="mt-0.5 text-xs font-bold text-amber-300">★ 0.0 / 5.0</div>
                                <div class="text-[9px] text-gray-500">New Entity (0 Reviews)</div>
                            </div>
                        </div>

                        <!-- 10. Partner Verification Matrix Snapshot -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-xs font-mono">
                                <span class="font-bold text-gray-300 uppercase">PARTNER VERIFICATION CONTROLS</span>
                                <a href="<?= $basePrefix ?>/verification" class="text-emerald-400 hover:underline text-[10px]">VIEW VERIFICATION CENTER →</a>
                            </div>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-1.5 text-[10px] font-mono">
                                <div class="bg-black/40 p-2 rounded border border-white/5 flex items-center justify-between">
                                    <span class="text-gray-400">Entity Identity</span>
                                    <span class="text-amber-300 font-bold">Pending</span>
                                </div>
                                <div class="bg-black/40 p-2 rounded border border-white/5 flex items-center justify-between">
                                    <span class="text-gray-400">Company Docs</span>
                                    <span class="text-amber-300 font-bold">Pending</span>
                                </div>
                                <div class="bg-black/40 p-2 rounded border border-white/5 flex items-center justify-between">
                                    <span class="text-gray-400">Capacity</span>
                                    <span class="text-amber-300 font-bold">Pending</span>
                                </div>
                                <div class="bg-black/40 p-2 rounded border border-white/5 flex items-center justify-between">
                                    <span class="text-gray-400">Registered Wallet</span>
                                    <span class="text-amber-300 font-bold">Pending</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 11 & 12. PROJECT & BATCH HISTORY -->
                    <div class="<?= $card ?> p-5 space-y-3">
                        <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                            <h4 class="text-xs font-mono font-bold uppercase text-white">BATCH PARTICIPATION & WORK ORDERS</h4>
                            <span class="text-[10px] font-mono text-gray-400">LINKED BATCH: NK-001</span>
                        </div>

                        <div class="overflow-x-auto text-xs font-mono">
                            <table class="w-full text-left">
                                <thead class="bg-white/5 text-gray-400 text-[9px] uppercase">
                                    <tr>
                                        <th class="p-2">Batch ID</th>
                                        <th class="p-2">Project</th>
                                        <th class="p-2">Area</th>
                                        <th class="p-2">Role</th>
                                        <th class="p-2">Work Orders</th>
                                        <th class="p-2">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5 text-gray-200">
                                    <tr>
                                        <td class="p-2 font-bold text-emerald-300">NK-001</td>
                                        <td class="p-2">North Kalimantan Palm</td>
                                        <td class="p-2">100 HA</td>
                                        <td class="p-2">Production Partner</td>
                                        <td class="p-2 font-bold text-white">01 (WO-NK-001-M1-001)</td>
                                        <td class="p-2"><span class="text-amber-300 bg-amber-950 px-1.5 py-0.5 rounded text-[9px] font-bold">PENDING</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <!-- Right Column: Capacity Classification Tiers (09) -->
                <div class="lg:col-span-4 space-y-6">

                    <!-- Capacity Tiers Box -->
                    <div class="<?= $card ?> p-5 space-y-4">
                        <div class="border-b border-white/10 pb-2.5">
                            <div class="text-[9px] font-mono text-emerald-400 uppercase font-bold tracking-wider">CLASSIFICATION FRAMEWORK</div>
                            <h3 class="text-sm font-mono font-bold text-white">Production Capacity Tiers</h3>
                        </div>

                        <div class="space-y-2.5 text-xs font-mono">
                            <div class="p-3 rounded-lg bg-white/5 border border-white/10 flex items-center justify-between">
                                <div>
                                    <div class="font-bold text-gray-300">SILVER TIER</div>
                                    <div class="text-[10px] text-gray-400">100 HA Standard Capacity</div>
                                </div>
                                <span class="rounded bg-white/10 px-2 py-0.5 text-[9px] text-gray-300">100 HA</span>
                            </div>

                            <div class="p-3 rounded-lg bg-emerald-950/60 border border-emerald-500/40 flex items-center justify-between">
                                <div>
                                    <div class="font-bold text-emerald-300">GOLD TIER</div>
                                    <div class="text-[10px] text-emerald-400/80">1,000 HA Standard Capacity</div>
                                </div>
                                <span class="rounded bg-emerald-500/20 text-emerald-300 px-2 py-0.5 text-[9px] font-bold">1,000 HA</span>
                            </div>

                            <div class="p-3 rounded-lg bg-white/5 border border-white/10 flex items-center justify-between">
                                <div>
                                    <div class="font-bold text-gray-300">PLATINUM TIER</div>
                                    <div class="text-[10px] text-gray-400">10,000 HA Capacity</div>
                                </div>
                                <span class="rounded bg-white/10 px-2 py-0.5 text-[9px] text-gray-300">10,000 HA</span>
                            </div>

                            <div class="p-3 rounded-lg bg-white/5 border border-white/10 flex items-center justify-between">
                                <div>
                                    <div class="font-bold text-gray-300">INSTITUTIONAL</div>
                                    <div class="text-[10px] text-gray-400">> 10,000 HA Institutional</div>
                                </div>
                                <span class="rounded bg-white/10 px-2 py-0.5 text-[9px] text-gray-300">>10K HA</span>
                            </div>
                        </div>

                        <p class="text-[9px] text-gray-400 italic leading-relaxed">
                            Tier classification is based on verified production capacity and operational history, not investment amount or projected return.
                        </p>
                    </div>

                    <!-- 32. Internal Rule Callout -->
                    <div class="rounded-xl border border-emerald-500/30 bg-emerald-950/30 p-4 text-xs font-mono space-y-1.5">
                        <div class="font-bold text-emerald-300 text-[10px] uppercase">OPERATIONAL INTEGRITY RULE</div>
                        <p class="text-gray-300 leading-relaxed text-[11px]">
                            Vendor placement must not be determined solely by payment or sponsorship. Matching remains strictly based on verified capability, capacity, region, availability, and work-order requirements.
                        </p>
                    </div>

                </div>

            </section>

            <!-- ---------- 13, 14 & 15. OPERATIONAL VENDORS & RAB LINKAGE ---------- -->
            <section class="space-y-4">
                <div class="flex items-center justify-between border-b border-white/10 pb-3">
                    <div>
                        <h3 class="text-sm font-mono font-bold uppercase text-white">OPERATIONAL VENDOR NETWORK</h3>
                        <p class="text-[11px] text-gray-400">Every operational vendor assignment is linked to an approved RAB category and work order.</p>
                    </div>
                    <span class="text-xs font-mono text-emerald-400 font-bold">RAB-LINKED VENDORS</span>
                </div>

                <!-- 15. RAB LINK VISUAL -->
                <div class="<?= $card ?> p-4 bg-black/40 text-xs font-mono space-y-2">
                    <div class="text-[10px] text-gray-400 uppercase font-bold">OPERATIONAL VENDOR MATCHING PATHWAY</div>
                    <div class="flex items-center gap-2 overflow-x-auto text-[11px] text-gray-300 py-1 scrollbar-none">
                        <span class="bg-emerald-950 px-2.5 py-1 rounded text-emerald-300 border border-emerald-500/30 font-bold">RAB-NK-001-V01</span>
                        <span>→</span>
                        <span class="bg-white/10 px-2.5 py-1 rounded text-white">Land Preparation Category</span>
                        <span>→</span>
                        <span class="bg-amber-950 px-2.5 py-1 rounded text-amber-300 border border-amber-500/30 font-bold">Demo Heavy Equipment Partner</span>
                        <span>→</span>
                        <span class="bg-white/10 px-2.5 py-1 rounded text-white">WO-NK-001-M1-001</span>
                        <span>→</span>
                        <span class="bg-emerald-950 px-2.5 py-1 rounded text-emerald-300">Field Execution</span>
                    </div>
                </div>

                <!-- Vendor Cards Grid (13 & 14) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                    <!-- Vendor Card 1 -->
                    <div class="<?= $card ?> p-4 space-y-3">
                        <div class="flex items-start justify-between">
                            <span class="<?= $iconBox ?>"><?= $svg($ic['truck']) ?></span>
                            <span class="text-[9px] font-mono font-bold text-amber-300 bg-amber-950 px-2 py-0.5 rounded border border-amber-500/30">PENDING</span>
                        </div>
                        <div>
                            <div class="text-[9px] font-mono text-gray-400">ID: VND-NINA-0001</div>
                            <h4 class="font-extrabold text-white text-sm">DEMO HEAVY EQUIPMENT PARTNER</h4>
                            <div class="text-[11px] font-mono text-emerald-300">Category: Heavy Equipment</div>
                            <div class="text-[10px] font-mono text-gray-400">Region: North Kalimantan</div>
                        </div>
                        <div class="flex justify-between border-t border-white/5 pt-2 text-[10px] font-mono text-gray-400">
                            <span>Work Orders: <strong class="text-white">01</strong></span>
                            <span>Reputation: <strong class="text-amber-300">★ 0.0 / 5.0</strong></span>
                        </div>
                    </div>

                    <!-- Vendor Card 2 -->
                    <div class="<?= $card ?> p-4 space-y-3 opacity-90">
                        <div class="flex items-start justify-between">
                            <span class="<?= $iconBox ?>"><?= $svg($ic['leaf']) ?></span>
                            <span class="rounded bg-white/10 px-2 py-0.5 text-[9px] font-mono font-bold text-gray-400">PIPELINE</span>
                        </div>
                        <div>
                            <div class="text-[9px] font-mono text-gray-400">ID: VND-NINA-0002</div>
                            <h4 class="text-sm font-extrabold text-white">CERTIFIED SEED PRODUCER</h4>
                            <div class="text-[11px] font-mono text-emerald-300">Category: Superior Planting Seeds</div>
                            <div class="text-[10px] font-mono text-gray-400">Region: Indonesia / Demo</div>
                        </div>
                        <div class="flex justify-between border-t border-white/5 pt-2 text-[10px] font-mono text-gray-400">
                            <span>Work Orders: <strong class="text-gray-400">00</strong></span>
                            <span>Reputation: <strong class="text-gray-400">★ 0.0 / 5.0</strong></span>
                        </div>
                    </div>

                    <!-- Vendor Card 3 -->
                    <div class="<?= $card ?> p-4 space-y-3 opacity-75">
                        <div class="flex items-start justify-between">
                            <span class="<?= $iconBox ?>"><?= $svg($ic['box']) ?></span>
                            <span class="text-[9px] font-mono font-bold text-gray-400 bg-white/10 px-2 py-0.5 rounded">PIPELINE</span>
                        </div>
                        <div>
                            <div class="text-[9px] font-mono text-gray-400">ID: VND-NINA-0003</div>
                            <h4 class="font-extrabold text-gray-300 text-sm">AGRONOMIC INPUT SUPPLIER</h4>
                            <div class="text-[11px] font-mono text-gray-400">Category: Fertilizer & Inputs</div>
                            <div class="text-[10px] font-mono text-gray-500">Region: Indonesia</div>
                        </div>
                        <div class="border-t border-white/5 pt-2 text-[10px] font-mono text-gray-400 flex justify-between">
                            <span>Work Orders: <strong class="text-gray-500">00</strong></span>
                            <span>Status: <strong class="text-gray-500">Pipeline</strong></span>
                        </div>
                    </div>

                    <!-- Vendor Card 4 -->
                    <div class="<?= $card ?> p-4 space-y-3 opacity-75">
                        <div class="flex items-start justify-between">
                            <span class="<?= $iconBox ?>"><?= $svg($ic['factory']) ?></span>
                            <span class="text-[9px] font-mono font-bold text-gray-400 bg-white/10 px-2 py-0.5 rounded">PIPELINE</span>
                        </div>
                        <div>
                            <div class="text-[9px] font-mono text-gray-400">ID: VND-NINA-0004</div>
                            <h4 class="font-extrabold text-gray-300 text-sm">LOGISTICS & PROCESSING PARTNER</h4>
                            <div class="text-[11px] font-mono text-gray-400">Category: FFB Transport & Processing</div>
                            <div class="text-[10px] font-mono text-gray-500">Region: Indonesia</div>
                        </div>
                        <div class="border-t border-white/5 pt-2 text-[10px] font-mono text-gray-400 flex justify-between">
                            <span>Work Orders: <strong class="text-gray-500">00</strong></span>
                            <span>Status: <strong class="text-gray-500">Pipeline</strong></span>
                        </div>
                    </div>

                </div>
            </section>

            <!-- ---------- 16, 17 & 18. VENDOR MATCHING ENGINE & ASSIGNMENT FLOW ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- Requirement Matcher Box (7 cols) -->
                <div class="lg:col-span-7 <?= $card ?> p-5 space-y-4">
                    <div class="border-b border-white/10 pb-2.5">
                        <div class="text-[9px] font-mono text-emerald-400 font-bold uppercase tracking-wider">FACTUAL MATCHING ENGINE</div>
                        <h3 class="text-base font-extrabold text-white">Match Operational Requirement</h3>
                    </div>

                    <div class="grid grid-cols-2 gap-3 text-xs font-mono">
                        <div>
                            <label class="text-[9px] text-gray-400 block mb-1">BATCH ID</label>
                            <input type="text" value="NK-001 (100 HA)" readonly class="w-full rounded bg-black/40 border border-white/10 px-3 py-1.5 text-emerald-300 font-bold" />
                        </div>
                        <div>
                            <label class="text-[9px] text-gray-400 block mb-1">RAB CATEGORY</label>
                            <input type="text" value="Land Preparation" readonly class="w-full rounded bg-black/40 border border-white/10 px-3 py-1.5 text-white font-bold" />
                        </div>
                    </div>

                    <!-- Match Result Card (17) -->
                    <div class="rounded-xl bg-white/5 p-4 border border-emerald-500/30 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-white text-sm font-mono">DEMO HEAVY EQUIPMENT PARTNER</span>
                            <span class="text-emerald-400 text-[10px] font-mono font-bold bg-emerald-950 px-2 py-0.5 rounded border border-emerald-500/30">MATCH FOUND</span>
                        </div>

                        <div class="grid grid-cols-3 gap-2 text-[10px] font-mono text-gray-300">
                            <div>Capability: <strong class="text-emerald-300">Land Prep</strong></div>
                            <div>Region: <strong class="text-emerald-300">North Kalimantan</strong></div>
                            <div>Status: <strong class="text-amber-300">Pending</strong></div>
                        </div>

                        <div class="pt-2 flex items-center justify-between border-t border-white/10">
                            <span class="text-[10px] font-mono text-gray-400">Assigned WO: WO-NK-001-M1-001</span>
                            <button class="rounded bg-emerald-500 hover:bg-emerald-400 text-black font-extrabold font-mono text-xs px-3 py-1.5 uppercase">
                                REQUEST ASSIGNMENT
                            </button>
                        </div>
                    </div>
                </div>

                <!-- 18 & 19. ASSIGNMENT FLOW & WORK ORDER TRACKING (5 cols) -->
                <div class="lg:col-span-5 <?= $card ?> p-5 space-y-4">
                    <div class="border-b border-white/10 pb-2.5">
                        <div class="text-[9px] font-mono text-emerald-400 font-bold uppercase tracking-wider">ASSIGNMENT PROTOCOL</div>
                        <h3 class="text-base font-extrabold text-white">Vendor Assignment Flow</h3>
                    </div>

                    <div class="space-y-2 text-xs font-mono">
                        <div class="flex items-center gap-2 text-emerald-300">
                            <span>✓</span> <span>1. Production Requirement Defined</span>
                        </div>
                        <div class="flex items-center gap-2 text-emerald-300">
                            <span>✓</span> <span>2. RAB Approved (RAB-NK-001-V01)</span>
                        </div>
                        <div class="flex items-center gap-2 text-emerald-300">
                            <span>✓</span> <span>3. Vendor Capability Match</span>
                        </div>
                        <div class="flex items-center gap-2 text-amber-300 font-bold">
                            <span>●</span> <span>4. Assignment Request & WO Authorization</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-500">
                            <span>○</span> <span>5. Field Execution & Evidence Submission</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-500">
                            <span>○</span> <span>6. Verification & Settlement Release</span>
                        </div>
                    </div>

                    <a href="<?= $basePrefix ?>/verification" class="block text-center text-xs font-mono font-bold text-emerald-400 hover:underline pt-2">
                        VIEW VERIFICATION PROTOCOL →
                    </a>
                </div>

            </section>

            <!-- ---------- 21, 24 & 25. SETTLEMENT IDENTITY, REPUTATION & DOCUMENTS ---------- -->
            <section class="space-y-6">

                <!-- Featured: Registered Vendor Wallet (Full Width Prominent Block) -->
                <div class="<?= $card ?> p-6 bg-gradient-to-r from-[#0C2219] via-[#0E1A16] to-[#0B1815] border border-emerald-500/40 relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>

                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-white/10 pb-4 mb-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-[9px] font-mono font-extrabold text-emerald-400 bg-emerald-950/80 px-2.5 py-0.5 rounded border border-emerald-500/30 uppercase tracking-wider">SETTLEMENT IDENTITY</span>
                                <span class="text-[9px] font-mono text-amber-300 bg-amber-950/60 px-2 py-0.5 rounded border border-amber-500/20">PENDING VERIFICATION</span>
                            </div>
                            <h3 class="text-lg font-extrabold text-white mt-1 flex items-center gap-2">
                                Registered Vendor Wallet
                                <span class="text-xs font-mono text-gray-400 font-normal">(USDT / Multi-Sig Vault)</span>
                            </h3>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="text-right font-mono hidden sm:block">
                                <div class="text-[9px] text-gray-400">NETWORK PROTOCOL</div>
                                <div class="text-xs font-bold text-emerald-300">Base Mainnet / EVM</div>
                            </div>
                            <button class="rounded-lg bg-emerald-500 hover:bg-emerald-400 text-black font-extrabold font-mono text-xs px-4 py-2 uppercase shadow transition-all">
                                CONNECT WALLET
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                        <!-- Left: Wallet Details -->
                        <div class="md:col-span-7 space-y-3 font-mono">
                            <div class="bg-black/50 p-3.5 rounded-xl border border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div>
                                    <span class="text-[9px] text-gray-400 block uppercase">Vendor ID & Public Address</span>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="text-xs font-bold text-white">VND-NINA-0001</span>
                                        <span class="text-gray-500">|</span>
                                        <span class="text-xs font-bold text-emerald-400 tracking-wider">0x892A83F9...11F4</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 text-xs">
                                    <button class="px-2.5 py-1 rounded bg-white/10 hover:bg-white/20 text-gray-300 font-mono text-[10px] border border-white/10 transition-colors">
                                        COPY ADDRESS
                                    </button>
                                    <a href="#" class="px-2.5 py-1 rounded bg-emerald-950/60 hover:bg-emerald-900/60 text-emerald-300 font-mono text-[10px] border border-emerald-500/30 transition-colors">
                                        EXPLORER ↗
                                    </a>
                                </div>
                            </div>

                            <p class="text-[10px] text-gray-400 leading-relaxed italic">
                                Wallet identity is cryptographically linked to verified entity record for operating settlements upon work order completion & verified field execution.
                            </p>
                        </div>

                        <!-- Right: Quick Settlement Stats -->
                        <div class="md:col-span-5 grid grid-cols-2 gap-3 text-xs font-mono">
                            <div class="bg-white/5 p-3 rounded-lg border border-white/5">
                                <span class="text-[9px] text-gray-400 block uppercase">TARGET BATCH</span>
                                <span class="text-sm font-bold text-emerald-300">NK-001 (100 HA)</span>
                                <span class="text-[9px] text-gray-500 block mt-0.5">North Kalimantan</span>
                            </div>
                            <div class="bg-white/5 p-3 rounded-lg border border-white/5">
                                <span class="text-[9px] text-gray-400 block uppercase">SETTLEMENT CURRENCY</span>
                                <span class="text-sm font-bold text-white">USDT</span>
                                <span class="text-[9px] text-emerald-400 block mt-0.5">Direct On-Chain</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Balanced 2-Column Grid: Reputation & Document Control -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                    <!-- Factual Reputation (6 cols) -->
                    <div class="lg:col-span-6 <?= $card ?> p-5 space-y-4">
                        <div class="border-b border-white/10 pb-2.5 flex items-center justify-between font-mono">
                            <div>
                                <div class="text-[9px] text-emerald-400 font-bold uppercase tracking-wider">FACTUAL CONTROL METRICS</div>
                                <h4 class="text-sm font-bold text-white uppercase">Operational Reputation</h4>
                            </div>
                            <span class="text-[10px] font-mono text-amber-300 bg-amber-950/60 px-2 py-0.5 rounded border border-amber-500/20">NEW VENDOR</span>
                        </div>

                        <div class="grid grid-cols-2 gap-3 text-xs font-mono">
                            <div class="bg-black/30 p-3 rounded-lg border border-white/5 space-y-1">
                                <span class="text-[9px] text-gray-400 block">COMPLETED WORK ORDERS</span>
                                <span class="text-lg font-bold text-white">00 <span class="text-xs text-gray-500 font-normal">/ 00</span></span>
                            </div>
                            <div class="bg-black/30 p-3 rounded-lg border border-white/5 space-y-1">
                                <span class="text-[9px] text-gray-400 block">ON-TIME COMPLETION RATE</span>
                                <span class="text-lg font-bold text-emerald-300">100% <span class="text-xs text-gray-500 font-normal">(Initial)</span></span>
                            </div>
                            <div class="bg-black/30 p-3 rounded-lg border border-white/5 space-y-1">
                                <span class="text-[9px] text-gray-400 block">CORRECTION REQUESTS</span>
                                <span class="text-lg font-bold text-white">00 <span class="text-xs text-emerald-400 font-normal">Clean</span></span>
                            </div>
                            <div class="space-y-1 border border-white/5 bg-black/30 p-3 rounded-lg">
                                <span class="block text-[9px] text-gray-400">PARTICIPANT REVIEWS</span>
                                <span class="text-lg font-bold text-amber-300">★ 0.0 <span class="text-xs font-normal text-gray-500">(0 Reviews)</span></span>
                            </div>
                        </div>

                        <div class="space-y-1.5 rounded-lg border border-white/10 bg-black/50 p-3 font-mono text-[10px] text-gray-300">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="h-2 w-2 rounded-full bg-amber-400 animate-pulse"></span>
                                    <span>Reputation State: <strong class="text-amber-300">★ 0.0 / 5.0 (Starting Point)</strong></span>
                                </div>
                                <span class="font-bold text-emerald-400">Silver Tier (100 HA / Batch)</span>
                            </div>
                            <div class="flex items-center justify-between border-t border-white/10 pt-1.5 text-[9px] text-gray-400">
                                <span>Reviews: <strong class="text-white">0</strong></span>
                                <span>Completed Batches: <strong class="text-white">0</strong></span>
                                <span>Tier Progression: <strong class="text-emerald-300">Silver &rarr; Gold (1,000 HA) &rarr; Platinum (10,000 HA)</strong></span>
                            </div>
                        </div>
                    </div>

                    <!-- Vendor Verification Documents (6 cols) -->
                    <div class="lg:col-span-6 <?= $card ?> p-5 space-y-4">
                        <div class="border-b border-white/10 pb-2.5 flex items-center justify-between font-mono">
                            <div>
                                <div class="text-[9px] text-emerald-400 font-bold uppercase tracking-wider">DOCUMENT CONTROL</div>
                                <h4 class="text-sm font-bold text-white uppercase">Vendor Verification Documents</h4>
                            </div>
                            <span class="text-[10px] font-mono text-gray-400">4 REQUIRED</span>
                        </div>

                        <div class="space-y-2 text-xs font-mono">
                            <div class="flex items-center justify-between p-2.5 rounded bg-black/30 border border-white/5">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <span class="text-gray-300 font-bold">Company Registration (NIB / Legal)</span>
                                </div>
                                <span class="text-[10px] font-bold text-amber-300 bg-amber-950/60 px-2 py-0.5 rounded border border-amber-500/20">PENDING</span>
                            </div>
                            <div class="flex items-center justify-between p-2.5 rounded bg-black/30 border border-white/5">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    <span class="text-gray-300 font-bold">Heavy Equipment License & Asset Proof</span>
                                </div>
                                <span class="text-[10px] font-bold text-amber-300 bg-amber-950/60 px-2 py-0.5 rounded border border-amber-500/20">PENDING</span>
                            </div>
                            <div class="flex items-center justify-between p-2.5 rounded bg-black/30 border border-white/5">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    <span class="text-gray-300 font-bold">Project History Record & Portfolio</span>
                                </div>
                                <span class="text-[10px] font-bold text-amber-300 bg-amber-950/60 px-2 py-0.5 rounded border border-amber-500/20">PENDING</span>
                            </div>
                            <div class="flex items-center justify-between p-2.5 rounded bg-black/30 border border-white/5">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                    <span class="text-gray-300 font-bold">Registered Wallet Authorization Doc</span>
                                </div>
                                <span class="text-[10px] font-bold text-amber-300 bg-amber-950/60 px-2 py-0.5 rounded border border-amber-500/20">PENDING</span>
                            </div>
                        </div>

                    </div>

                </div>

            </section>
            <!-- ---------- 34 & 35. ENTITY RELATIONSHIP GRAPH & NETWORK STATUS LEGEND ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- 34. Entity Relationship Data Architecture Graph (7 cols) -->
                <div class="lg:col-span-7 <?= $card ?> p-5 space-y-3">
                    <div class="border-b border-white/10 pb-2.5 flex items-center justify-between">
                        <div>
                            <div class="text-[9px] font-mono text-emerald-400 font-bold uppercase tracking-wider">DATA ARCHITECTURE</div>
                            <h4 class="text-xs font-mono font-bold text-white uppercase">Entity Relationship Graph</h4>
                        </div>
                        <span class="text-[10px] font-mono text-gray-400">SUPPLY-SIDE OPERATING LAYER</span>
                    </div>

                    <div class="bg-black/50 p-3 rounded-lg border border-white/5 font-mono text-[10px] text-gray-300 space-y-2">
                        <div class="flex justify-center">
                            <span class="bg-emerald-950 px-3 py-1 rounded text-emerald-300 font-bold border border-emerald-500/30">ENTITY (Partner / Vendor / Buyer)</span>
                        </div>
                        <div class="text-center text-gray-500 font-bold">↓</div>
                        <div class="grid grid-cols-3 gap-2 text-center">
                            <span class="bg-white/10 p-1.5 rounded">PROJECT</span>
                            <span class="bg-white/10 p-1.5 rounded text-emerald-300 font-bold">BATCH (100 HA)</span>
                            <span class="bg-white/10 p-1.5 rounded">RAB BUDGET</span>
                        </div>
                        <div class="text-center text-gray-500 font-bold">↓</div>
                        <div class="grid grid-cols-3 gap-2 text-center">
                            <span class="bg-amber-950/80 p-1.5 rounded text-amber-300 font-bold border border-amber-500/30">WORK ORDER</span>
                            <span class="bg-white/10 p-1.5 rounded">FIELD EXECUTION</span>
                            <span class="bg-white/10 p-1.5 rounded">VERIFICATION</span>
                        </div>
                        <div class="text-center text-gray-500 font-bold">↓</div>
                        <div class="flex justify-center gap-3">
                            <span class="bg-emerald-950 px-3 py-1 rounded text-emerald-300 font-bold border border-emerald-500/30">APPROVED SETTLEMENT</span>
                            <span class="bg-white/10 px-3 py-1 rounded text-gray-300">AUDIT TRAIL & REPUTATION</span>
                        </div>
                    </div>
                </div>

                <!-- 35. Network Control States Legend (5 cols) -->
                <div class="lg:col-span-5 <?= $card ?> p-5 space-y-3">
                    <div class="border-b border-white/10 pb-2.5 flex items-center justify-between">
                        <div>
                            <div class="text-[9px] font-mono text-emerald-400 font-bold uppercase tracking-wider">PROTOCOL STANDARDS</div>
                            <h4 class="text-xs font-mono font-bold text-white uppercase">Network Status Legend</h4>
                        </div>
                        <span class="text-[10px] font-mono text-gray-400">8 CONTROL STATES</span>
                    </div>

                    <div class="grid grid-cols-2 gap-2 text-[10px] font-mono">
                        <div class="bg-white/5 p-2 rounded border border-white/5">
                            <span class="font-bold text-gray-400 block">PIPELINE</span>
                            <span class="text-gray-500 text-[9px]">Identified, not active</span>
                        </div>
                        <div class="bg-white/5 p-2 rounded border border-white/5">
                            <span class="font-bold text-amber-300 block">PENDING</span>
                            <span class="text-gray-500 text-[9px]">Submitted, not verified</span>
                        </div>
                        <div class="bg-white/5 p-2 rounded border border-white/5">
                            <span class="font-bold text-emerald-300 block">VERIFIED</span>
                            <span class="text-gray-500 text-[9px]">Controls passed</span>
                        </div>
                        <div class="bg-white/5 p-2 rounded border border-white/5">
                            <span class="font-bold text-emerald-400 block">ACTIVE</span>
                            <span class="text-gray-500 text-[9px]">Participating in batch</span>
                        </div>
                        <div class="bg-white/5 p-2 rounded border border-white/5">
                            <span class="font-bold text-amber-500 block">SUSPENDED</span>
                            <span class="text-gray-500 text-[9px]">Temporarily restricted</span>
                        </div>
                        <div class="bg-white/5 p-2 rounded border border-white/5">
                            <span class="font-bold text-gray-500 block">EXPIRED</span>
                            <span class="text-gray-500 text-[9px]">Verification expired</span>
                        </div>
                        <div class="bg-white/5 p-2 rounded border border-white/5">
                            <span class="font-bold text-blue-300 block">COMPLETED</span>
                            <span class="text-gray-500 text-[9px]">Work completed</span>
                        </div>
                        <div class="bg-white/5 p-2 rounded border border-white/5">
                            <span class="font-bold text-red-400 block">REJECTED</span>
                            <span class="text-gray-500 text-[9px]">Verification failed</span>
                        </div>
                    </div>
                </div>

            </section>

            <!-- ---------- 29 & 30. ONBOARDING & REGISTRATION FORM PREVIEW ---------- -->
            <section id="register-partner-form" class="<?= $card ?> p-6 space-y-4 bg-gradient-to-b from-[#0E1F16] to-[#0B1815] border border-emerald-500/40">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-4">
                    <div>
                        <div class="text-[10px] font-mono text-emerald-400 font-bold uppercase tracking-wider">NETWORK ONBOARDING</div>
                        <h3 class="text-xl font-extrabold text-white">Become a NINA Production Partner or Vendor</h3>
                        <p class="text-xs text-gray-300 mt-1">Register your operational capability, land asset, machinery or agronomic service.</p>
                    </div>
                    <div class="flex gap-2 font-mono text-xs font-bold">
                        <button class="rounded-lg bg-emerald-500 hover:bg-emerald-400 text-black px-4 py-2 uppercase shadow">
                            REGISTER AS PARTNER
                        </button>
                        <button class="rounded-lg bg-white/10 hover:bg-white/20 text-white border border-white/10 px-4 py-2 uppercase">
                            REGISTER AS VENDOR
                        </button>
                    </div>
                </div>

                <!-- Registration Form Fields Preview -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs font-mono">
                    <div>
                        <label class="text-[9px] text-gray-400 block mb-1">ENTITY TYPE</label>
                        <select class="w-full rounded bg-black/40 border border-white/10 px-3 py-2 text-gray-300 focus:border-emerald-500">
                            <option>Company / PT</option>
                            <option>Cooperative / Koperasi</option>
                            <option>Production Partner</option>
                            <option>Vendor / Service Provider</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-[9px] text-gray-400 block mb-1">PRIMARY OPERATING REGION</label>
                        <select class="w-full rounded bg-black/40 border border-white/10 px-3 py-2 text-gray-300 focus:border-emerald-500">
                            <option>North Kalimantan</option>
                            <option>South Kalimantan</option>
                            <option>East Kalimantan</option>
                            <option>Other Province</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-[9px] text-gray-400 block mb-1">ACTUAL CAPABILITY / AREA</label>
                        <input type="text" placeholder="e.g. 300 HA Land / 10 Excavators" class="w-full rounded bg-black/40 border border-white/10 px-3 py-2 text-white placeholder-gray-500 focus:border-emerald-500" />
                    </div>
                </div>
            </section>

            <!-- ---------- 36 & 39. PRIMARY BOTTOM BANNER & CORE MESSAGE ---------- -->
            <section class="rounded-2xl border border-emerald-500/40 bg-gradient-to-r from-[#04100B] via-[#091D13] to-[#04100B] p-6 text-center space-y-4 shadow-2xl">
                <div class="max-w-3xl mx-auto space-y-2">
                    <h3 class="text-2xl font-extrabold text-white">Connect Capability to Production.</h3>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        Every productive asset requires capable people, equipment, materials, logistics and processing. NINA makes those operational relationships visible, structured and traceable.
                    </p>
                    <p class="text-[11px] text-emerald-400 italic">
                        NINA bukan sekadar direktori vendor. NINA menghubungkan kemampuan operasional dengan kebutuhan produksi, RAB, work order, pelaksanaan lapangan, bukti eksekusi dan verifikasi.
                    </p>
                </div>

                <div class="flex flex-wrap items-center justify-center gap-3 font-mono text-xs font-bold pt-2">
                    <a href="<?= $basePrefix ?>/production-network" class="rounded-lg bg-emerald-500 hover:bg-emerald-400 text-black px-5 py-2.5 uppercase shadow-lg">
                        EXPLORE PRODUCTION NETWORK
                    </a>
                    <a href="#register-partner-form" class="rounded-lg bg-white/10 hover:bg-white/20 text-white border border-white/10 px-5 py-2.5 uppercase">
                        REGISTER AS PARTNER
                    </a>
                    <a href="#register-partner-form" class="rounded-lg bg-white/10 hover:bg-white/20 text-white border border-white/10 px-5 py-2.5 uppercase">
                        REGISTER AS VENDOR
                    </a>
                </div>
            </section>

        </div>

    </div>

</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/dashboard.php';
