<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '05 / Project Overview — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'explore';

/* ---------- Helpers & Icons ---------- */
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

$svg = fn(string $inner, string $cls = 'w-4 h-4') =>
    '<svg class="' . $cls . '" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">' . $inner . '</svg>';

$ic = [
    'target'    => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.5"/>',
    'leaf'      => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>',
    'grid'      => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/>',
    'pin'       => '<path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="2.5"/>',
    'check'     => '<circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 4.5-5"/>',
    'shield'    => '<path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/>',
    'clock'     => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>',
    'doc'       => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>',
    'download'  => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>',
    'user'      => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
    'building'  => '<rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/>',
    'wallet'    => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 10h20"/><path d="M16 14h.01"/>',
    'truck'     => '<rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>',
    'play'      => '<polygon points="5 3 19 12 5 21 5 3"/>',
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

        <!-- ================= HERO HEADER SECTION ================= -->
        <section class="relative overflow-hidden shadow-2xl" style="border-bottom: none !important;">
            <img src="<?= $basePrefix ?>/1.jpg" alt="Natural forest canopy" class="absolute inset-0 h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#050D07]/90 via-[#050D07]/60 to-[#050D07]/20"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#06120F]/90 via-transparent to-transparent"></div>

            <div class="relative grid min-h-[250px] grid-cols-1 items-start gap-8 px-6 pt-3 pb-6 lg:grid-cols-12 lg:px-8 lg:pt-3 lg:pb-8">

                <!-- Left Column -->
                <div class="space-y-4 lg:col-span-7">
                    <!-- Breadcrumb -->
                    <nav aria-label="Breadcrumb" class="inline-flex flex-wrap items-center gap-2 text-[10px] font-mono font-semibold uppercase tracking-[0.14em] text-gray-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                        <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors">PRODUCTION REQUIREMENTS</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors">DR-2026-001</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/explore" class="hover:text-white transition-colors">EXPLORE PROJECTS</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="font-bold text-white uppercase">NORTH KALIMANTAN PALM</span>
                    </nav>

                    <!-- Page Number & Badge -->
                    <div class="flex flex-wrap items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-200">
                        <span>05 / PROJECT OVERVIEW</span>
                        <span class="rounded border border-amber-400/40 bg-amber-500/20 px-2.5 py-0.5 text-[9px] font-bold tracking-wider text-amber-300">DEMO / PENDING VERIFICATION</span>
                    </div>

                    <h1 class="max-w-2xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">North Kalimantan Palm</h1>
                    <p class="max-w-xl text-base font-semibold leading-normal text-emerald-300">
                        Verified-capacity production project within the NINA productive asset network.
                    </p>

                    <div class="space-y-1 pt-1">
                        <div class="text-xs font-extrabold text-white">From Productive Land to Executable Production.</div>
                        <p class="max-w-xl text-xs leading-relaxed text-gray-300">
                            NINA coordinates productive land, production partners, standardized operating requirements, production batches, vendors and traceability into one operating environment.
                        </p>
                    </div>
                </div>

                <!-- Right Hero Status Card -->
                <div class="lg:col-span-5 lg:col-start-8">
                    <div class="space-y-4 rounded-xl border border-white/15 bg-[#08130F]/80 p-5 shadow-2xl backdrop-blur-xl">
                        <div class="flex items-center justify-between border-b border-white/10 pb-2">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-white flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full bg-amber-400"></span> PROJECT STATUS
                            </span>
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">DEMO</span>
                        </div>

                        <div class="text-xs font-bold text-amber-300 uppercase tracking-wide">DEMO / PENDING VERIFICATION</div>

                        <div class="grid grid-cols-2 gap-2 text-[10px]">
                            <div class="rounded border border-white/10 bg-white/5 p-2">
                                <div class="text-[8px] text-gray-400 uppercase font-bold">PROJECT ID</div>
                                <div class="font-extrabold font-mono text-white mt-0.5">PRJ-NK-001</div>
                            </div>
                            <div class="rounded border border-white/10 bg-white/5 p-2">
                                <div class="text-[8px] text-gray-400 uppercase font-bold">REGION</div>
                                <div class="font-extrabold text-white mt-0.5">North Kalimantan, Indonesia</div>
                            </div>
                            <div class="rounded border border-white/10 bg-white/5 p-2">
                                <div class="text-[8px] text-gray-400 uppercase font-bold">PRODUCTION TYPE</div>
                                <div class="font-extrabold text-emerald-300 mt-0.5">Palm Production</div>
                            </div>
                            <div class="rounded border border-white/10 bg-white/5 p-2">
                                <div class="text-[8px] text-gray-400 uppercase font-bold">STANDARD BATCH</div>
                                <div class="font-extrabold text-white mt-0.5">100 HA</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-center text-xs border-t border-white/10 pt-3">
                            <div class="rounded border border-white/10 bg-white/5 p-2">
                                <div class="text-[8px] text-gray-400 uppercase font-bold">NETWORK CAPACITY</div>
                                <div class="text-base font-black text-white mt-0.5">4,000 HA*</div>
                            </div>
                            <div class="rounded border border-white/10 bg-white/5 p-2">
                                <div class="text-[8px] text-gray-400 uppercase font-bold">MAPPED CAPACITY</div>
                                <div class="text-base font-black text-emerald-300 mt-0.5">350 HA</div>
                            </div>
                        </div>

                        <p class="text-[8px] italic text-gray-400 leading-tight">
                            * Prototype / demonstration data. Not a representation of a confirmed commercial project.
                        </p>
                    </div>
                </div>

            </div>
        </section>

        <!-- ================= CONTENT ================= -->
        <div class="space-y-6 px-4 pb-16 pt-6 sm:px-6 lg:px-8">

            <!-- ---------- 4 TOP METRIC STRIP CARDS ---------- -->
            <section class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['leaf']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">NETWORK CAPACITY</div>
                        <div class="text-xl font-extrabold leading-tight text-white">4,000 HA</div>
                        <div class="text-[8px] text-gray-400">Total project capacity</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['target']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">MAPPED CAPACITY</div>
                        <div class="text-xl font-extrabold leading-tight text-emerald-300">350 HA</div>
                        <div class="text-[8px] text-gray-400">of 1,000 HA requirement (35%)</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['grid']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">STANDARD BATCH</div>
                        <div class="text-xl font-extrabold leading-tight text-white">100 HA</div>
                        <div class="text-[8px] text-gray-400">Per executable batch</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['shield']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">PRODUCTION REQUIREMENT</div>
                        <div class="text-xl font-extrabold leading-tight text-amber-300">Rp15B</div>
                        <div class="text-[8px] text-gray-400">Modeled per 100 HA batch</div>
                    </div>
                </div>

            </section>

            <!-- ---------- SNAPSHOT & DOCUMENTS (2 COLUMNS) ---------- -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">

                <!-- Left: Project Snapshot -->
                <div class="<?= $card ?> p-5 space-y-4 lg:col-span-7">
                    <div class="border-b border-white/10 pb-2">
                        <h2 class="text-base font-bold text-white">Project Snapshot</h2>
                    </div>

                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 text-xs">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between py-1 border-b border-white/5">
                                <span class="text-gray-400 flex items-center gap-1.5"><?= $svg($ic['pin'], 'w-3.5 h-3.5 text-emerald-300') ?> Location</span>
                                <span class="font-bold text-white text-right">North Kalimantan, Indonesia</span>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-white/5">
                                <span class="text-gray-400 flex items-center gap-1.5"><?= $svg($ic['leaf'], 'w-3.5 h-3.5 text-emerald-300') ?> Asset Type</span>
                                <span class="font-bold text-white">Palm Production</span>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-white/5">
                                <span class="text-gray-400 flex items-center gap-1.5"><?= $svg($ic['grid'], 'w-3.5 h-3.5 text-emerald-300') ?> Network Capacity</span>
                                <span class="font-bold text-white">4,000 HA</span>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-white/5">
                                <span class="text-gray-400 flex items-center gap-1.5"><?= $svg($ic['target'], 'w-3.5 h-3.5 text-emerald-300') ?> Mapped Capacity</span>
                                <span class="font-bold text-emerald-300">350 HA</span>
                            </div>
                            <div class="flex items-center justify-between py-1">
                                <span class="text-gray-400 flex items-center gap-1.5"><?= $svg($ic['shield'], 'w-3.5 h-3.5 text-emerald-300') ?> Standard Batch</span>
                                <span class="font-bold text-white">100 HA</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center justify-between py-1 border-b border-white/5">
                                <span class="text-gray-400 flex items-center gap-1.5"><?= $svg($ic['user'], 'w-3.5 h-3.5 text-emerald-300') ?> Production Partner</span>
                                <span class="font-bold text-white text-right">Demo Production Partner</span>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-white/5">
                                <span class="text-gray-400 flex items-center gap-1.5"><?= $svg($ic['shield'], 'w-3.5 h-3.5 text-emerald-300') ?> Status</span>
                                <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING VERIFICATION</span>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-white/5">
                                <span class="text-gray-400 flex items-center gap-1.5"><?= $svg($ic['building'], 'w-3.5 h-3.5 text-emerald-300') ?> Partnership Structure</span>
                                <span class="font-bold text-white text-right text-[10px]">Inti-Plasma / Partnership</span>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-white/5">
                                <span class="text-gray-400 flex items-center gap-1.5"><?= $svg($ic['doc'], 'w-3.5 h-3.5 text-emerald-300') ?> Production Standard</span>
                                <span class="font-bold text-white text-right text-[10px]">Standardized Agronomic</span>
                            </div>
                            <div class="flex items-center justify-between py-1">
                                <span class="text-gray-400 flex items-center gap-1.5"><?= $svg($ic['check'], 'w-3.5 h-3.5 text-emerald-300') ?> Traceability</span>
                                <span class="rounded bg-emerald-950 px-1.5 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">PROTOTYPE / SIMULATED</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Media Preview & Documents -->
                <div class="<?= $card ?> p-5 space-y-4 lg:col-span-5 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="relative h-32 rounded-xl overflow-hidden border border-white/15 shadow-inner">
                            <img src="<?= $basePrefix ?>/2.jpg" alt="North Kalimantan Palm Canopy" class="h-full w-full object-cover" />
                            <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-500/80 text-emerald-950 shadow-lg backdrop-blur-sm cursor-pointer hover:scale-110 transition-transform">
                                    <?= $svg($ic['play'], 'w-4 h-4 fill-current ml-0.5') ?>
                                </span>
                            </div>
                        </div>

                        <div class="border-b border-white/10 pb-2">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-white">PROJECT DOCUMENTS</h3>
                        </div>

                        <div class="space-y-1.5 text-[10px]">
                            <a href="<?= $basePrefix ?>/documents" class="flex items-center justify-between p-2 rounded bg-white/5 border border-white/5 hover:bg-white/10 text-gray-300 hover:text-white">
                                <span class="font-bold flex items-center gap-1.5"><?= $svg($ic['doc'], 'w-3.5 h-3.5 text-emerald-300') ?> Project Overview (PDF)</span>
                                <span class="text-gray-400 font-mono">2.4 MB &darr;</span>
                            </a>
                            <a href="<?= $basePrefix ?>/documents" class="flex items-center justify-between p-2 rounded bg-white/5 border border-white/5 hover:bg-white/10 text-gray-300 hover:text-white">
                                <span class="font-bold flex items-center gap-1.5"><?= $svg($ic['doc'], 'w-3.5 h-3.5 text-emerald-300') ?> Location Map (PDF)</span>
                                <span class="text-gray-400 font-mono">1.8 MB &darr;</span>
                            </a>
                            <a href="<?= $basePrefix ?>/documents" class="flex items-center justify-between p-2 rounded bg-white/5 border border-white/5 hover:bg-white/10 text-gray-300 hover:text-white">
                                <span class="font-bold flex items-center gap-1.5"><?= $svg($ic['doc'], 'w-3.5 h-3.5 text-emerald-300') ?> Production Standard (PDF)</span>
                                <span class="text-gray-400 font-mono">1.2 MB &darr;</span>
                            </a>
                            <a href="<?= $basePrefix ?>/documents" class="flex items-center justify-between p-2 rounded bg-white/5 border border-white/5 hover:bg-white/10 text-gray-300 hover:text-white">
                                <span class="font-bold flex items-center gap-1.5"><?= $svg($ic['doc'], 'w-3.5 h-3.5 text-emerald-300') ?> Partner Profile (PDF)</span>
                                <span class="text-gray-400 font-mono">2.1 MB &darr;</span>
                            </a>
                        </div>
                    </div>

                    <a href="<?= $basePrefix ?>/documents" class="w-fit rounded-lg border border-emerald-400/40 bg-emerald-500/10 hover:bg-emerald-500/20 hover:border-emerald-400 px-3.5 py-1.5 text-[10px] font-bold uppercase tracking-wider text-emerald-300 inline-flex items-center gap-1.5 transition">
                        <span>VIEW ALL DOCUMENTS</span><?= $arrow ?>
                    </a>
                </div>

            </div>

            <!-- ---------- LAND PARTNERSHIP & PRODUCTION STANDARD (2 COLUMNS) ---------- -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">

                <!-- Left: Land & Production Partnership -->
                <div class="<?= $card ?> p-5 space-y-4 lg:col-span-7">
                    <div class="border-b border-white/10 pb-2">
                        <h3 class="text-sm font-bold text-white">Land & Production Partnership</h3>
                        <p class="text-[10px] text-gray-300">NINA does not treat land as a standalone listing. Each production project must be connected to a defined production partner, operating structure, capacity and verification record.</p>
                    </div>

                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <!-- Land Status Card -->
                        <div class="rounded-xl border border-white/10 bg-[#07110E] p-3 space-y-2 flex flex-col justify-between">
                            <div class="space-y-1.5">
                                <div class="flex justify-between items-center">
                                    <span class="text-[9px] font-bold text-white uppercase">LAND STATUS</span>
                                    <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[7px] font-bold text-amber-300">PENDING VERIFICATION</span>
                                </div>
                                <div class="space-y-1 text-[9px] text-gray-400">
                                    <div class="flex justify-between"><span>Region</span><span class="text-white font-bold">North Kalimantan</span></div>
                                    <div class="flex justify-between"><span>Mapped Area</span><span class="text-emerald-300 font-bold">350 HA</span></div>
                                    <div class="flex justify-between"><span>Network Capacity</span><span class="text-white font-bold">4,000 HA</span></div>
                                    <div class="flex justify-between"><span>GIS Record</span><span class="text-amber-300">Pending / Demo</span></div>
                                    <div class="flex justify-between"><span>Documentation</span><span class="text-amber-300">Pending / Demo</span></div>
                                </div>
                            </div>
                            <a href="<?= $basePrefix ?>/capacity" class="w-fit rounded-lg border border-emerald-400/30 bg-emerald-500/5 hover:bg-emerald-500/15 hover:border-emerald-400 px-3 py-1.5 text-[9px] font-bold uppercase tracking-wider text-emerald-300 inline-flex items-center gap-1.5 transition"><span>VIEW LAND RECORD</span><?= $arrow ?></a>
                        </div>

                        <!-- Production Partnership Card -->
                        <div class="rounded-xl border border-white/10 bg-[#07110E] p-3 space-y-2 flex flex-col justify-between">
                            <div class="space-y-1.5">
                                <div class="text-[9px] font-bold text-emerald-300 uppercase">PRODUCTION PARTNERSHIP</div>
                                <div class="text-xs font-black text-white">INTI-PLASMA / PRODUCTION PARTNERSHIP</div>
                                <p class="text-[8px] text-gray-400">Partnership structure connecting productive land with an operating production partner.</p>

                                <div class="space-y-1 text-[9px] text-gray-400 pt-1">
                                    <div class="flex justify-between"><span>Seed</span><span class="text-white font-bold">Certified Superior Seed</span></div>
                                    <div class="flex justify-between"><span>Status</span><span class="text-amber-300 font-bold">PENDING VERIFICATION</span></div>
                                </div>
                            </div>
                            <a href="<?= $basePrefix ?>/vendors" class="w-fit rounded-lg border border-emerald-400/30 bg-emerald-500/5 hover:bg-emerald-500/15 hover:border-emerald-400 px-3 py-1.5 text-[9px] font-bold uppercase tracking-wider text-emerald-300 inline-flex items-center gap-1.5 transition"><span>VIEW PARTNER DETAILS</span><?= $arrow ?></a>
                        </div>
                    </div>
                </div>

                <!-- Right: Production Standard -->
                <div class="<?= $card ?> p-5 space-y-4 lg:col-span-5 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="border-b border-white/10 pb-2">
                            <h3 class="text-sm font-bold text-white">Production Standard</h3>
                            <p class="text-[10px] text-gray-300">Standardized production method and agronomic protocol to ensure consistent quality and traceability.</p>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div class="rounded-xl border border-white/10 bg-[#07110E] p-3 space-y-1">
                                <div class="text-[8px] font-bold text-emerald-300 uppercase flex items-center gap-1"><?= $svg($ic['leaf'], 'w-3 h-3') ?> SEED</div>
                                <div class="text-[10px] font-bold text-white">Certified Superior Seed</div>
                                <span class="inline-block rounded bg-amber-500/20 px-1.5 py-0.5 text-[7px] font-bold text-amber-300">PENDING VERIFICATION</span>
                            </div>

                            <div class="rounded-xl border border-white/10 bg-[#07110E] p-3 space-y-1">
                                <div class="text-[8px] font-bold text-gray-400 uppercase">PLANTING DENSITY</div>
                                <div class="text-xs font-extrabold text-white">143 trees / ha</div>
                                <div class="text-[8px] text-gray-400">5 &times; 9 &times; 9 m (triangular)</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div class="rounded-xl border border-white/10 bg-[#07110E] p-3 space-y-1">
                                <div class="text-[8px] font-bold text-gray-400 uppercase">PRODUCTION METHOD</div>
                                <div class="text-[10px] font-bold text-white">Standardized Protocol</div>
                            </div>

                            <div class="rounded-xl border border-white/10 bg-[#07110E] p-3 space-y-1">
                                <div class="text-[8px] font-bold text-emerald-300 uppercase">TRACEABILITY</div>
                                <div class="text-[8px] font-bold text-white">Field &rarr; Batch &rarr; Production &rarr; Processing &rarr; Delivery</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ---------- PRODUCTION CAPACITY MODEL & PROGRAM STRUCTURE ---------- -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">

                <!-- Left: Production Capacity Model -->
                <div class="<?= $card ?> p-5 space-y-4 lg:col-span-6 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="border-b border-white/10 pb-2">
                            <h3 class="text-sm font-bold text-white">Production Capacity Model</h3>
                            <p class="text-[10px] text-gray-300">Based on current prototype model and external benchmark data.</p>
                        </div>

                        <div class="grid grid-cols-3 gap-3 text-center">
                            <div class="rounded-xl border border-emerald-400/30 bg-[#071F17] p-3">
                                <div class="text-[8px] font-bold text-emerald-300 uppercase">PROJECT CAPACITY</div>
                                <div class="text-base font-extrabold text-white">350 HA</div>
                                <div class="text-[7px] text-emerald-300 uppercase">MAPPED CAPACITY</div>
                            </div>

                            <div class="rounded-xl border border-white/10 bg-[#07110E] p-3">
                                <div class="text-[8px] font-bold text-gray-400 uppercase">CAPACITY BREAKDOWN</div>
                                <div class="text-base font-extrabold text-white">3 &times; 100 HA</div>
                                <div class="text-[7px] text-gray-400">Executable batch capacity</div>
                            </div>

                            <div class="rounded-xl border border-white/10 bg-[#07110E] p-3">
                                <div class="text-[8px] font-bold text-gray-400 uppercase">REMAINING MAPPED</div>
                                <div class="text-base font-extrabold text-amber-300">~ 50 HA</div>
                                <div class="text-[7px] text-gray-400">Remaining mapped capacity</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 pt-2 text-[9px]">
                            <div class="rounded-lg bg-white/5 p-2.5 border border-white/5">
                                <div class="text-gray-400 text-[8px] uppercase">PRODUCTION INDICATORS</div>
                                <div class="text-white font-bold">TBS Productivity (benchmark)</div>
                                <div class="text-emerald-300 text-xs font-mono font-bold">18.03 t/ha/year</div>
                            </div>

                            <div class="rounded-lg bg-white/5 p-2.5 border border-white/5">
                                <div class="text-gray-400 text-[8px] uppercase">OER (MODEL ASSUMPTION)</div>
                                <div class="text-white font-bold">CPO Output (model)</div>
                                <div class="text-emerald-300 text-xs font-mono font-bold">20% <span class="text-[8px] text-gray-400 font-normal">(360.6 t/year per 100 ha)</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Production Program Structure -->
                <div class="<?= $card ?> p-5 space-y-4 lg:col-span-6 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="border-b border-white/10 pb-2">
                            <h3 class="text-sm font-bold text-white">Production Program Structure</h3>
                            <div class="flex items-center justify-between text-[10px]">
                                <span class="text-gray-400">Contract Horizon</span>
                                <span class="font-bold text-emerald-300">20 years</span>
                            </div>
                        </div>

                        <div class="space-y-3 pt-2">
                            <!-- Timeline Bar -->
                            <div class="relative pt-4">
                                <div class="flex text-[8px] text-gray-400 justify-between mb-1">
                                    <span>Year 0</span>
                                    <span>Year 5</span>
                                    <span>Year 20</span>
                                </div>
                                <div class="h-3 w-full rounded-full bg-white/10 flex overflow-hidden">
                                    <div class="h-full bg-amber-400/80 w-[25%]" title="Development / Ramp-up (5 yrs)"></div>
                                    <div class="h-full bg-emerald-400 w-[75%]" title="Commercial Delivery (15 yrs)"></div>
                                </div>
                                <div class="grid grid-cols-2 text-[9px] mt-2 gap-2">
                                    <div class="rounded bg-amber-500/10 border border-amber-500/20 p-2 text-amber-300">
                                        <div class="font-bold">Development / Ramp-up</div>
                                        <div class="text-[8px] opacity-80">5 years</div>
                                    </div>
                                    <div class="rounded bg-emerald-500/10 border border-emerald-500/20 p-2 text-emerald-300">
                                        <div class="font-bold">Commercial Delivery</div>
                                        <div class="text-[8px] opacity-80">15 years</div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-[8px] text-gray-400 italic">
                                &iexcl; These are NINA program-model parameters and should not be interpreted as a biological minimum harvest period.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ---------- PRODUCTION REQUIREMENT + RAB + VENDORS (3 COLUMNS) ---------- -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">

                <!-- Production Requirement -->
                <div class="<?= $card ?> p-5 space-y-4 lg:col-span-4 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="border-b border-white/10 pb-2">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-white">Production Requirement</h3>
                            <p class="text-[8px] text-gray-400">Based on current prototype model and external benchmark data.</p>
                        </div>

                        <div class="space-y-2 text-[9px]">
                            <div class="rounded bg-white/5 p-2.5 border border-white/5">
                                <div class="text-gray-400 uppercase text-[8px]">PROJECT CAPACITY</div>
                                <div class="text-base font-extrabold text-white">100 HA</div>
                                <div class="text-[7.5px] text-emerald-300">MAPPED CAPACITY</div>
                            </div>

                            <div class="rounded bg-white/5 p-2.5 border border-white/5 space-y-1">
                                <div class="text-gray-400 uppercase text-[8px]">MINIMUM PO ALLOCATION</div>
                                <div class="text-base font-extrabold text-emerald-300">Rp100M</div>
                                <p class="text-gray-400 mt-1">
                                    A standard 100 HA batch is modeled at Rp15B. The minimum PO allocation is Rp100M, allowing capital diversification across multiple batches.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Production RAB -->
                <div class="<?= $card ?> p-5 space-y-3 lg:col-span-4 flex flex-col justify-between">
                    <div class="space-y-2">
                        <div class="border-b border-white/10 pb-2">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-white">Production RAB</h3>
                            <p class="text-[8px] text-gray-400">Indicative budget structure for the 100 HA batch.</p>
                        </div>

                        <div class="space-y-1 text-[8.5px] text-gray-300">
                            <div class="flex justify-between"><span>&bull; Land / Partnership</span><span class="font-bold">12%</span></div>
                            <div class="flex justify-between"><span>&bull; Land Preparation</span><span class="font-bold">10%</span></div>
                            <div class="flex justify-between"><span>&bull; Seedlings</span><span class="font-bold">8%</span></div>
                            <div class="flex justify-between"><span>&bull; Fertilizer & Inputs</span><span class="font-bold">15%</span></div>
                            <div class="flex justify-between"><span>&bull; Machinery & Equipment</span><span class="font-bold">12%</span></div>
                            <div class="flex justify-between"><span>&bull; Infrastructure</span><span class="font-bold">17%</span></div>
                            <div class="flex justify-between"><span>&bull; Maintenance</span><span class="font-bold">7%</span></div>
                            <div class="flex justify-between"><span>&bull; Operations</span><span class="font-bold">16%</span></div>
                            <div class="flex justify-between"><span>&bull; Contingency</span><span class="font-bold">10%</span></div>
                        </div>

                        <div class="border-t border-white/10 pt-2 flex justify-between items-baseline">
                            <span class="text-[9px] text-gray-400 uppercase font-bold">TOTAL BATCH REQUIREMENT</span>
                            <span class="text-base font-black text-emerald-300">Rp15B</span>
                        </div>
                    </div>

                    <a href="<?= $basePrefix ?>/rab" class="w-fit rounded-lg border border-emerald-400/30 bg-emerald-500/5 hover:bg-emerald-500/15 hover:border-emerald-400 px-3 py-1.5 text-[9px] font-bold uppercase tracking-wider text-emerald-300 inline-flex items-center gap-1.5 transition"><span>VIEW FULL RAB</span><?= $arrow ?></a>
                </div>

                <!-- Production Vendors -->
                <div class="<?= $card ?> p-5 space-y-3 lg:col-span-4 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="border-b border-white/10 pb-2">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-white">Production Vendors</h3>
                            <p class="text-[8px] text-gray-400">Vendors connected to the project's RAB and operating requirements.</p>
                        </div>

                        <div class="space-y-2 text-[9px]">
                            <div class="flex justify-between items-center rounded bg-white/5 p-1.5 border border-white/5">
                                <div><div class="font-bold text-white">Seed Supplier</div><div class="text-[7.5px] text-gray-400">Certified Seed Producer</div></div>
                                <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[7px] font-bold text-amber-300">PENDING</span>
                            </div>
                            <div class="flex justify-between items-center rounded bg-white/5 p-1.5 border border-white/5">
                                <div><div class="font-bold text-white">Fertilizer Supplier</div><div class="text-[7.5px] text-gray-400">Agro Input Supplier</div></div>
                                <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[7px] font-bold text-amber-300">PENDING</span>
                            </div>
                            <div class="flex justify-between items-center rounded bg-white/5 p-1.5 border border-white/5">
                                <div><div class="font-bold text-white">Heavy Equipment</div><div class="text-[7.5px] text-gray-400">Excavator & Land Preparation</div></div>
                                <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[7px] font-bold text-amber-300">PENDING</span>
                            </div>
                            <div class="flex justify-between items-center rounded bg-white/5 p-1.5 border border-white/5">
                                <div><div class="font-bold text-white">Logistics</div><div class="text-[7.5px] text-gray-400">Production Logistics</div></div>
                                <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[7px] font-bold text-amber-300">PENDING</span>
                            </div>
                        </div>
                    </div>

                    <a href="<?= $basePrefix ?>/vendors" class="w-fit rounded-lg border border-emerald-400/30 bg-emerald-500/5 hover:bg-emerald-500/15 hover:border-emerald-400 px-3 py-1.5 text-[9px] font-bold uppercase tracking-wider text-emerald-300 inline-flex items-center gap-1.5 transition"><span>VIEW ALL VENDORS</span><?= $arrow ?></a>
                </div>

            </div>

            <!-- ---------- BOTTOM ROW: PARTNER + VERIFICATION + WALLET + CTA ---------- -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">

                <!-- Production Partner -->
                <div class="<?= $card ?> p-4 space-y-3 lg:col-span-3 flex flex-col justify-between">
                    <div class="space-y-2">
                        <div class="border-b border-white/10 pb-2">
                            <div class="text-[8px] font-bold uppercase text-emerald-300">PRODUCTION PARTNER</div>
                            <h4 class="text-xs font-black text-white">DEMO PRODUCTION PARTNER</h4>
                        </div>

                        <div class="grid grid-cols-2 gap-1 text-[8px] text-center">
                            <div class="p-1.5 rounded bg-white/5">
                                <div class="text-gray-400">NETWORK CAP.</div>
                                <div class="font-bold text-white text-[10px]">4,000 HA</div>
                            </div>
                            <div class="p-1.5 rounded bg-white/5">
                                <div class="text-gray-400">ACTIVE CAP.</div>
                                <div class="font-bold text-emerald-300 text-[10px]">350 HA</div>
                            </div>
                            <div class="p-1.5 rounded bg-white/5">
                                <div class="text-gray-400">COMPLETED</div>
                                <div class="font-bold text-white text-[10px]">&mdash; / DEMO</div>
                            </div>
                            <div class="p-1.5 rounded bg-white/5">
                                <div class="text-gray-400">TENURE</div>
                                <div class="font-bold text-white text-[10px]">&mdash; / DEMO</div>
                            </div>
                        </div>

                        <div class="p-2 rounded border border-white/10 bg-[#07110E] text-center space-y-0.5">
                            <div class="text-[8px] font-bold text-gray-400 uppercase">REPUTATION</div>
                            <div class="text-[9px] font-bold text-white">NOT YET ESTABLISHED</div>
                            <div class="text-[7px] text-gray-500">Generated from completed batches</div>
                        </div>
                    </div>

                    <a href="<?= $basePrefix ?>/vendors" class="w-fit rounded-lg border border-emerald-400/30 bg-emerald-500/5 hover:bg-emerald-500/15 hover:border-emerald-400 px-3 py-1.5 text-[8.5px] font-bold uppercase tracking-wider text-emerald-300 inline-flex items-center gap-1.5 transition"><span>VIEW PARTNER PROFILE</span><?= $arrow ?></a>
                </div>

                <!-- Verification Status -->
                <div class="<?= $card ?> p-4 space-y-3 lg:col-span-3 flex flex-col justify-between">
                    <div class="space-y-2">
                        <div class="border-b border-white/10 pb-2">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-white">Verification Status</h4>
                        </div>

                        <div class="space-y-1 text-[8px]">
                            <div class="flex justify-between py-0.5 border-b border-white/5"><span class="text-gray-400">Land</span><span class="text-amber-300 font-bold">Pending / Demo</span></div>
                            <div class="flex justify-between py-0.5 border-b border-white/5"><span class="text-gray-400">GIS Boundary</span><span class="text-amber-300 font-bold">Pending / Demo</span></div>
                            <div class="flex justify-between py-0.5 border-b border-white/5"><span class="text-gray-400">Production Partner</span><span class="text-amber-300 font-bold">Pending / Demo</span></div>
                            <div class="flex justify-between py-0.5 border-b border-white/5"><span class="text-gray-400">Seed Source</span><span class="text-amber-300 font-bold">Pending / Demo</span></div>
                            <div class="flex justify-between py-0.5 border-b border-white/5"><span class="text-gray-400">Production Protocol</span><span class="text-emerald-300 font-bold">Defined</span></div>
                            <div class="flex justify-between py-0.5 border-b border-white/5"><span class="text-gray-400">Vendor Documentation</span><span class="text-amber-300 font-bold">Pending</span></div>
                            <div class="flex justify-between py-0.5 border-b border-white/5"><span class="text-gray-400">Commercial Documentation</span><span class="text-amber-300 font-bold">Pending</span></div>
                            <div class="flex justify-between py-0.5"><span class="text-gray-400">Audit Record</span><span class="text-emerald-300 font-bold">Prototype</span></div>
                        </div>
                    </div>

                    <a href="<?= $basePrefix ?>/verification" class="w-fit rounded-lg border border-emerald-400/30 bg-emerald-500/5 hover:bg-emerald-500/15 hover:border-emerald-400 px-3 py-1 text-[8.5px] font-bold uppercase tracking-wider text-emerald-300 inline-flex items-center gap-1.5 transition"><span>VIEW MATRIX</span><?= $arrow ?></a>
                </div>

                <!-- Registered Entity Wallet -->
                <div class="<?= $card ?> p-4 space-y-3 lg:col-span-3 flex flex-col justify-between">
                    <div class="space-y-2">
                        <div class="border-b border-white/10 pb-2">
                            <div class="text-[8px] font-bold uppercase text-emerald-300">REGISTERED WALLET</div>
                            <h4 class="text-xs font-bold text-white">Registered Entity Wallet</h4>
                        </div>

                        <div class="space-y-1.5 text-[8.5px] rounded bg-[#07110E] p-2 border border-white/10">
                            <div><span class="text-gray-400 block">ENTITY</span><span class="font-bold text-white">Demo Production Partner</span></div>
                            <div><span class="text-gray-400 block">REGISTERED WALLET</span><span class="font-mono text-emerald-300 font-bold">0x7A3F...9C2B</span></div>
                            <div><span class="text-gray-400 block">STATUS</span><span class="text-amber-300 font-bold">REGISTERED / DEMO</span></div>
                        </div>
                    </div>

                    <a href="<?= $basePrefix ?>/vendors" class="w-fit rounded-lg border border-emerald-400/30 bg-emerald-500/5 hover:bg-emerald-500/15 hover:border-emerald-400 px-3 py-1.5 text-[8.5px] font-bold uppercase tracking-wider text-emerald-300 inline-flex items-center gap-1.5 transition"><span>VIEW WALLET RECORD</span><?= $arrow ?></a>
                </div>

                <!-- Ready to Inspect CTA Box -->
                <div class="<?= $card ?> p-5 space-y-3 lg:col-span-3 flex flex-col justify-between bg-gradient-to-b from-[#0B1815] to-[#08201A]">
                    <div class="space-y-2">
                        <h4 class="text-sm font-extrabold text-white">Ready to inspect the production batch?</h4>
                        <p class="text-[9px] text-gray-300 leading-relaxed">
                            Review the batch configuration, PO allocation structure, RAB, milestone schedule and verification records before proceeding.
                        </p>
                    </div>

                    <div class="space-y-2 pt-2">
                        <a href="<?= $basePrefix ?>/batches/NK-001" class="w-full flex items-center justify-center gap-1.5 rounded-lg border border-emerald-400 bg-emerald-500/20 hover:bg-emerald-500/30 p-2.5 text-[10px] font-extrabold uppercase tracking-wider text-emerald-300 transition shadow-lg">
                            <span>VIEW PRODUCTION BATCH</span><?= $arrow ?>
                        </a>
                        <a href="<?= $basePrefix ?>/explore" class="w-full flex items-center justify-center gap-1.5 rounded-lg border border-white/20 bg-white/5 p-2.5 text-[10px] font-bold uppercase tracking-wider text-white hover:bg-white/10 hover:border-white/30 transition">
                            BACK TO PROJECTS
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
