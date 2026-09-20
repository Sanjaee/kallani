<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$constants = $config['system_constants'] ?? [];
$demoDemand = $config['demo_demands'][0] ?? [];
$title = '03 / Capacity Mapping — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'capacity';

/* ---------- Helpers & data ---------- */
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

$demoId    = $demoDemand['id']    ?? 'DR-2026-001';
$demoBuyer = $demoDemand['buyer'] ?? 'DEMO OFFTAKE BUYER';

/* Icons: $svg(inner-paths, size-classes) */
$svg = fn(string $inner, string $cls = 'w-5 h-5') =>
    '<svg class="' . $cls . '" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">' . $inner . '</svg>';

$ic = [
    'target'    => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.5"/>',
    'crosshair' => '<circle cx="12" cy="12" r="8"/><path d="M12 2v4M12 18v4M2 12h4M18 12h4"/>',
    'calendar'  => '<path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
    'coin'      => '<circle cx="12" cy="12" r="9"/><path d="M14.5 9.5c-.5-1-1.4-1.5-2.5-1.5-1.4 0-2.5.8-2.5 2s1 1.7 2.5 2 2.5.8 2.5 2-1.1 2-2.5 2c-1.1 0-2-.5-2.5-1.5M12 6v2M12 16v2"/>',
    'grid'      => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/>',
    'pin'       => '<path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="2.5"/>',
    'check'     => '<circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 4.5-5"/>',
    'users'     => '<path d="M17 21v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M21 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>',
];

$chev  = '<svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>';
$arrow = '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>';

/* Reusable class strings (Tailwind) */
$card      = 'rounded-xl border border-white/10 bg-[#0B1815]/90 shadow-xl';
$iconBox   = 'flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-emerald-100';
$metricLbl = 'text-[9px] font-medium uppercase tracking-wide text-gray-400';
$cellCls   = 'rounded-lg border border-white/10 bg-[#07110E] p-3';
$filterLbl = 'mb-1 block text-[9px] uppercase tracking-wider text-gray-400';
$selectCls = 'w-full appearance-none cursor-pointer rounded-lg border border-white/10 bg-[#07110E] px-3 py-2 pr-9 text-xs font-medium text-white focus:outline-none focus:border-emerald-400/70';

$footerCols = [
    'Product'  => [['Explore', '/explore'], ['Production', '/demand'], ['Partners', '/vendors'], ['Vendors', '/vendors'], ['Audit', '/audit-trail']],
    'Protocol' => [['How It Works', '/#system-architecture'], ['Verification', '/verification'], ['Documents', '/documents'], ['Audit Trail', '/audit-trail']],
    'Company'  => [['About', '#'], ['Contact', '#']],
];

ob_start();
?>

<style>
    /* Google Maps InfoWindow — dark theme */
    .gm-style .gm-style-iw-c {
        background-color: #0B1815 !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        border-radius: 12px !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5) !important;
        padding: 0 !important;
    }
    .gm-style .gm-style-iw-d { overflow: hidden !important; padding: 12px 14px !important; }
    .gm-style .gm-style-iw-tc::after { background-color: #0B1815 !important; }
    .gm-style .gm-ui-hover-effect { filter: invert(1) !important; top: 2px !important; right: 2px !important; }
</style>

<div class="relative w-full font-sans" x-data="{ mapType: 'satellite' }">

    <!-- PAGE BACKGROUND (soft blurred forest) -->
    <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden">
        <img src="<?= $basePrefix ?>/1.jpg" alt="" class="h-full w-full scale-110 object-cover opacity-30 blur-md" />
        <div class="absolute inset-0 bg-gradient-to-b from-[#06120F]/60 via-[#06120F]/85 to-[#04100B]"></div>
    </div>

    <div class="relative z-10">

        <!-- ================= HERO ================= -->
        <section class="relative overflow-hidden shadow-2xl" style="border-bottom: none !important;">
            <img src="<?= $basePrefix ?>/1.jpg" alt="Natural forest canopy" class="absolute inset-0 h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#050D07]/85 via-[#050D07]/45 to-[#050D07]/10"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#06120F]/80 via-transparent to-transparent"></div>

            <div class="relative grid min-h-[260px] grid-cols-1 items-start gap-8 px-6 pt-3 pb-6 lg:grid-cols-12 lg:px-8 lg:pt-3 lg:pb-8">

                <!-- Left: breadcrumb, title, requirement -->
                <div class="space-y-4 lg:col-span-7">
                    <nav aria-label="Breadcrumb" class="inline-flex flex-wrap items-center gap-2 text-[10px] font-mono font-semibold uppercase tracking-[0.14em] text-gray-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                        <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors">PRODUCTION REQUIREMENTS</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors"><?= $e($demoId) ?></a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="font-bold text-white uppercase">CAPACITY MAPPING</span>
                    </nav>

                    <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-200">
                        <span>03 / Capacity Mapping</span>
                        <span class="rounded border border-white/20 bg-black/30 px-1.5 py-0.5 text-[9px] font-bold tracking-wider text-gray-100"><?= $e($demoId) ?></span>
                    </div>

                    <h1 class="max-w-2xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">Convert Demand Into Production Capacity.</h1>

                    <p class="max-w-md text-sm leading-relaxed text-gray-200">
                        NINA maps a production requirement across verified or eligible productive assets and partners.
                    </p>

                    <div class="pt-1 text-sm text-gray-200">Requirement: <span class="font-bold text-white">1,000 HA</span></div>
                </div>

                <!-- Right: glass offtake card -->
                <div class="lg:col-span-4 lg:col-start-9">
                    <div class="space-y-4 rounded-xl border border-white/15 bg-[#08130F]/70 p-5 shadow-2xl backdrop-blur-xl">
                        <span class="inline-block rounded border border-emerald-400/40 bg-emerald-950/70 px-2 py-0.5 text-[10px] font-semibold text-emerald-300">DEMO</span>
                        <div class="text-xs font-bold uppercase tracking-wide text-white">Demo Offtake Requirement</div>
                        <div>
                            <div class="text-[10px] text-gray-400">Requirement ID</div>
                            <div class="text-xs font-semibold text-white"><?= $e($demoId) ?></div>
                        </div>
                        <div>
                            <div class="text-[10px] text-gray-400">Buyer</div>
                            <div class="text-xs font-semibold text-white"><?= $e($demoBuyer) ?></div>
                        </div>
                        <div>
                            <div class="text-[10px] text-gray-400">Status</div>
                            <div class="flex items-center gap-1.5 text-[11px] font-semibold text-white">
                                <span class="h-2 w-2 rounded-full bg-white"></span>
                                EXAMPLE / SIMULATED
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ================= CONTENT (with left/right padding) ================= -->
        <div class="space-y-5 px-4 pb-8 pt-5 sm:px-6 lg:px-8">

            <!-- ---------- METRIC CARDS ---------- -->
            <section class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['target']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">Required Capacity</div>
                        <div class="text-2xl font-extrabold leading-tight text-white">1,000 HA</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['crosshair']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">Mapped Capacity</div>
                        <div class="text-2xl font-extrabold leading-tight text-white">1,000 HA</div>
                        <span class="mt-1 inline-block rounded-md border border-emerald-400/40 bg-emerald-500/15 px-2 py-0.5 text-[9px] font-bold text-emerald-300">100% MAPPED</span>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['calendar']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">Production Batches</div>
                        <div class="text-2xl font-extrabold leading-tight text-white">10</div>
                        <div class="text-[10px] text-gray-400">100 ha / batch</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['coin']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">Modeled Production Value</div>
                        <div class="text-2xl font-extrabold leading-tight text-white">8,800,000 USDT</div>
                        <div class="text-[10px] text-gray-400">10 &times; 880,000 USDT</div>
                        <div class="mt-0.5 text-[9px] italic leading-snug text-gray-500">Model parameter &mdash; not a financial commitment.</div>
                    </div>
                </div>

            </section>

            <!-- ---------- MAP + SIDEBAR ---------- -->
            <section id="capacity-map-section" class="grid grid-cols-1 items-stretch gap-4 lg:grid-cols-12">

                <!-- Map card -->
                <div class="<?= $card ?> flex flex-col overflow-hidden lg:col-span-8">

                    <div class="flex flex-col gap-3 border-b border-white/10 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-base font-bold text-white">Production Capacity Map</h2>
                            <p class="text-[11px] text-gray-400">Map the buyer requirement against available production capacity.</p>
                        </div>
                        <div class="inline-flex self-start rounded-lg border border-white/10 bg-[#07110E] p-0.5 sm:self-auto">
                            <button type="button"
                                    @click="mapType = 'satellite'; setMapType('satellite')"
                                    :class="mapType === 'satellite' ? 'bg-white/10 font-semibold text-white' : 'text-gray-400 hover:text-white'"
                                    class="rounded-md px-3.5 py-1.5 text-[11px] transition">Satellite</button>
                            <button type="button"
                                    @click="mapType = 'terrain'; setMapType('terrain')"
                                    :class="mapType === 'terrain' ? 'bg-white/10 font-semibold text-white' : 'text-gray-400 hover:text-white'"
                                    class="rounded-md px-3.5 py-1.5 text-[11px] transition">Terrain</button>
                        </div>
                    </div>

                    <!-- Map canvas (grows to match the sidebar height) -->
                    <div class="relative min-h-[360px] flex-1 bg-[#040E0A]">
                        <div id="map" class="absolute inset-0"></div>
                    </div>

                    <!-- Legend -->
                    <div class="flex flex-wrap items-center gap-x-6 gap-y-2 border-t border-white/10 px-5 py-3 text-[10px]">
                        <span class="font-bold uppercase tracking-wider text-gray-400">Map Legend</span>
                        <span class="flex items-center gap-1.5 text-gray-200"><span class="h-2 w-2 rounded-full bg-emerald-400"></span>Verified Capacity</span>
                        <span class="flex items-center gap-1.5 text-gray-200"><span class="h-2 w-2 rounded-full bg-orange-400"></span>Pending Verification</span>
                        <span class="flex items-center gap-1.5 text-gray-200"><span class="h-2 w-2 rounded-full bg-sky-400"></span>Pipeline Capacity</span>
                        <span class="flex items-center gap-1.5 text-gray-200"><span class="h-2 w-2 rounded-full bg-lime-400"></span>Selected Capacity</span>
                    </div>
                </div>

                <!-- Sidebar -->
                <aside class="flex flex-col gap-4 lg:col-span-4">

                    <!-- Mapped Capacity -->
                    <div class="<?= $card ?> p-5">
                        <div class="mb-3 flex items-center justify-between">
                            <span class="text-sm font-bold text-white">Mapped Capacity</span>
                            <span class="rounded border border-emerald-400/40 bg-emerald-950/70 px-2 py-0.5 text-[10px] font-semibold text-emerald-300">DEMO</span>
                        </div>

                        <div class="overflow-x-auto text-[11px]">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="border-b border-white/10 text-[9px] text-gray-400">
                                        <th class="pb-2 font-medium">Production Region</th>
                                        <th class="pb-2 text-right font-medium">Capacity</th>
                                        <th class="pb-2 text-right font-medium leading-tight">Batch<br>Equivalent</th>
                                        <th class="pb-2 text-right font-medium">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/10">
                                    <tr>
                                        <td class="py-3 font-semibold text-white"><span class="flex items-center gap-2"><span class="h-2 w-2 shrink-0 rounded-full bg-emerald-400"></span>North Kalimantan</span></td>
                                        <td class="py-3 text-right text-gray-200">350 HA</td>
                                        <td class="py-3 text-right text-gray-200">3.5</td>
                                        <td class="py-3 text-right"><span class="rounded border border-emerald-500/30 bg-emerald-500/15 px-1.5 py-0.5 text-[9px] font-bold text-emerald-300">&bull; DEMO</span></td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 font-semibold text-white"><span class="flex items-center gap-2"><span class="h-2 w-2 shrink-0 rounded-full bg-sky-400"></span>South Kalimantan</span></td>
                                        <td class="py-3 text-right text-gray-200">650 HA</td>
                                        <td class="py-3 text-right text-gray-200">6.5</td>
                                        <td class="py-3 text-right"><span class="rounded border border-emerald-500/30 bg-emerald-500/15 px-1.5 py-0.5 text-[9px] font-bold text-emerald-300">&bull; DEMO</span></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="border-t border-white/20 font-bold text-white">
                                        <td class="pt-3">Total</td>
                                        <td class="pt-3 text-right">1,000 HA</td>
                                        <td class="pt-3 text-right">10</td>
                                        <td class="pt-3 text-right">100%</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Capacity Filters -->
                    <div class="<?= $card ?> flex-1 p-5">
                        <div class="mb-3 text-sm font-bold text-white">Capacity Filters</div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="<?= $filterLbl ?>">Region</label>
                                <div class="relative">
                                    <select class="<?= $selectCls ?>">
                                        <option>All Regions</option>
                                        <option>North Kalimantan</option>
                                        <option>South Kalimantan</option>
                                    </select><?= $chev ?>
                                </div>
                            </div>
                            <div>
                                <label class="<?= $filterLbl ?>">Verification</label>
                                <div class="relative">
                                    <select class="<?= $selectCls ?>">
                                        <option>All Status</option>
                                        <option>Verified</option>
                                        <option>Pending</option>
                                    </select><?= $chev ?>
                                </div>
                            </div>
                            <div>
                                <label class="<?= $filterLbl ?>">Production Partner</label>
                                <div class="relative">
                                    <select class="<?= $selectCls ?>">
                                        <option>All Partners</option>
                                        <option>Partner Estate A</option>
                                        <option>Partner Estate B</option>
                                    </select><?= $chev ?>
                                </div>
                            </div>
                            <div>
                                <label class="<?= $filterLbl ?>">Capacity</label>
                                <div class="relative">
                                    <select class="<?= $selectCls ?>">
                                        <option>100+ ha</option>
                                        <option>300+ ha</option>
                                        <option>500+ ha</option>
                                    </select><?= $chev ?>
                                </div>
                            </div>
                            <div>
                                <label class="<?= $filterLbl ?>">Availability</label>
                                <div class="relative">
                                    <select class="<?= $selectCls ?>">
                                        <option>Available</option>
                                        <option>Reserved</option>
                                    </select><?= $chev ?>
                                </div>
                            </div>
                            <div>
                                <label class="<?= $filterLbl ?>">Sort by</label>
                                <div class="relative">
                                    <select class="<?= $selectCls ?>">
                                        <option>Capacity - High to Low</option>
                                        <option>Capacity - Low to High</option>
                                    </select><?= $chev ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </aside>
            </section>

            <!-- ---------- EXECUTABLE BATCH STRUCTURE ---------- -->
            <section class="<?= $card ?> p-5 sm:p-6">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <h2 class="text-base font-bold text-white">Executable Batch Structure</h2>
                        <p class="mt-0.5 text-[11px] text-gray-400">The 1,000 ha requirement will be structured into 10 executable batches (100 ha each).</p>
                    </div>
                    <div class="flex items-start gap-8">
                        <div>
                            <div class="text-[9px] text-gray-400">Total Batches</div>
                            <div class="text-lg font-extrabold leading-tight text-white">10</div>
                        </div>
                        <div>
                            <div class="text-[9px] text-gray-400">Total Area</div>
                            <div class="text-lg font-extrabold leading-tight text-white">1,000 HA</div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-5 xl:grid-cols-10">
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <a href="<?= $basePrefix ?>/batches" class="group rounded-lg border border-white/10 bg-[#07110E] p-3 transition hover:border-emerald-400/50 hover:bg-[#0E1F1A]">
                            <div class="text-[10px] font-medium text-gray-400"><?= sprintf('%02d', $i) ?></div>
                            <div class="mt-1 text-[11px] font-bold uppercase text-white">Batch <?= sprintf('%03d', $i) ?></div>
                            <div class="mt-2 flex items-center justify-between text-xs font-bold text-white">
                                <span>100 HA</span>
                                <span class="text-gray-500 transition group-hover:text-emerald-300">&rsaquo;</span>
                            </div>
                        </a>
                    <?php endfor; ?>
                </div>
            </section>

            <!-- ---------- PRODUCTION PROGRAM STRUCTURE ---------- -->
            <section class="grid grid-cols-1 items-stretch gap-4 lg:grid-cols-12">

                <div class="<?= $card ?> space-y-3 p-5 lg:col-span-5">
                    <div class="text-sm font-bold text-white">Production Program Structure</div>

                    <div class="grid grid-cols-3 gap-2">
                        <div class="<?= $cellCls ?>">
                            <div class="text-[9px] uppercase text-gray-400">Required Capacity</div>
                            <div class="mt-1 text-lg font-extrabold text-white">1,000 HA</div>
                        </div>
                        <div class="<?= $cellCls ?>">
                            <div class="text-[9px] uppercase text-gray-400">Standard Batch</div>
                            <div class="mt-1 text-lg font-extrabold text-white">100 HA</div>
                        </div>
                        <div class="<?= $cellCls ?>">
                            <div class="text-[9px] uppercase text-gray-400">Total Batches</div>
                            <div class="mt-1 text-lg font-extrabold text-white">10</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div class="<?= $cellCls ?>">
                            <div class="text-[9px] uppercase text-gray-400">Production Requirement / Batch</div>
                            <div class="mt-1 text-lg font-extrabold text-white">880,000 USDT</div>
                        </div>
                        <div class="<?= $cellCls ?>">
                            <div class="text-[9px] uppercase text-gray-400">Total Modeled Production Requirement</div>
                            <div class="mt-1 text-lg font-extrabold text-white">8,800,000 USDT</div>
                        </div>
                    </div>

                    <p class="text-[10px] leading-relaxed text-gray-400">Based on the current prototype production model of 880,000 USDT per 100-ha batch.</p>
                </div>

                <div class="<?= $card ?> space-y-3 p-5 lg:col-span-3">
                    <div class="flex items-center gap-2 text-sm font-bold text-white">
                        <span class="flex h-7 w-7 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-emerald-100"><?= $svg($ic['users'], 'w-4 h-4') ?></span>
                        <span>Minimum PO Allocation</span>
                    </div>
                    <div class="<?= $cellCls ?> space-y-2 p-4">
                        <div class="text-3xl font-extrabold text-white">8,000 USDT</div>
                        <p class="text-[10px] leading-relaxed text-gray-400">Minimum participation allocation per production program, subject to final legal and commercial structure.</p>
                    </div>
                </div>

                <div class="<?= $card ?> p-5 lg:col-span-4">
                    <div class="text-sm font-bold text-white">Production Program Details</div>
                    <dl class="mt-3 divide-y divide-white/10 text-[11px]">
                        <div class="flex items-center justify-between py-3">
                            <dt class="text-gray-400">Contract Horizon</dt>
                            <dd class="font-bold text-white">20 years</dd>
                        </div>
                        <div class="flex items-center justify-between py-3">
                            <dt class="text-gray-400">Development / Ramp-up</dt>
                            <dd class="font-bold text-white">5 years</dd>
                        </div>
                        <div class="flex items-center justify-between py-3">
                            <dt class="text-gray-400">Commercial Delivery</dt>
                            <dd class="font-bold text-white">15 years</dd>
                        </div>
                    </dl>
                </div>

            </section>

            <!-- ---------- WHAT'S NEXT ---------- -->
            <section class="<?= $card ?> p-5">
                <div class="grid grid-cols-1 items-stretch gap-6 lg:grid-cols-12">

                    <div class="flex flex-col justify-center space-y-4 lg:col-span-5">
                        <div>
                            <h3 class="text-base font-bold text-white">What's Next?</h3>
                            <p class="mt-0.5 text-[11px] leading-snug text-gray-400">The mapped capacity will be used to identify suitable projects and production partners for batch assignment.</p>
                        </div>

                        <div class="grid grid-cols-1 items-center gap-2 sm:grid-cols-[1fr_auto_1fr_auto_1fr]">
                            <div class="flex items-center gap-2 rounded-lg border border-emerald-400/40 bg-emerald-950/30 p-2.5">
                                <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full border border-emerald-300/60 text-emerald-200"><?= $svg($ic['target'], 'w-3.5 h-3.5') ?></span>
                                <div class="leading-tight">
                                    <div class="text-[11px] font-bold text-white">01</div>
                                    <div class="text-[9px] font-semibold uppercase text-gray-300">Defined</div>
                                    <div class="text-[9px] text-gray-300">Buyer Requirement</div>
                                    <div class="text-[9px] text-gray-500">(You are here)</div>
                                </div>
                            </div>
                            <span class="hidden text-gray-500 sm:block">&rsaquo;</span>
                            <div class="flex items-center gap-2 rounded-lg border border-white/10 bg-white/5 p-2.5">
                                <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full border border-white/20 text-gray-300"><?= $svg($ic['pin'], 'w-3.5 h-3.5') ?></span>
                                <div class="leading-tight">
                                    <div class="text-[11px] font-bold text-white">02</div>
                                    <div class="text-[9px] font-semibold uppercase text-gray-300">Mapped</div>
                                    <div class="text-[9px] text-gray-300">Production Capacity</div>
                                    <div class="text-[9px] text-gray-500">(Next)</div>
                                </div>
                            </div>
                            <span class="hidden text-gray-500 sm:block">&rsaquo;</span>
                            <div class="flex items-center gap-2 rounded-lg border border-white/10 bg-white/5 p-2.5">
                                <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full border border-white/20 text-gray-300"><?= $svg($ic['grid'], 'w-3.5 h-3.5') ?></span>
                                <div class="leading-tight">
                                    <div class="text-[11px] font-bold text-white">03</div>
                                    <div class="text-[9px] font-semibold uppercase text-gray-300">Executed</div>
                                    <div class="text-[9px] text-gray-300">Production Batches</div>
                                    <div class="text-[9px] text-gray-500">(Next)</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-3">
                        <div class="relative h-32 overflow-hidden rounded-xl border border-white/10 lg:h-full lg:min-h-[120px]">
                            <img src="<?= $basePrefix ?>/2.jpg" alt="Forest preview" class="absolute inset-0 h-full w-full object-cover" />
                            <div class="absolute inset-0 bg-black/15"></div>
                        </div>
                    </div>

                    <div class="flex flex-col justify-center space-y-2 lg:col-span-4">
                        <div class="flex items-center gap-2 text-sm font-bold text-white">
                            <span class="flex h-7 w-7 items-center justify-center rounded-full border border-emerald-300/60 text-emerald-300"><?= $svg($ic['check'], 'w-4 h-4') ?></span>
                            <span>Capacity Mapping Ready</span>
                        </div>
                        <p class="text-[11px] leading-snug text-gray-400">Your 1,000 ha requirement has been mapped to available production capacity.</p>
                        <div class="flex flex-wrap items-center gap-2 pt-1">
                            <a href="<?= $basePrefix ?>/explore" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-[#6EE7B7] to-[#C9F5DE] px-5 py-2.5 text-[10px] font-bold uppercase tracking-wider text-[#04100B] shadow-lg shadow-emerald-950/40 transition hover:brightness-110">
                                <span>View Mapped Projects</span><?= $arrow ?>
                            </a>
                            <a href="<?= $basePrefix ?>/batches" class="inline-flex items-center rounded-full border border-white/30 bg-black/30 px-4 py-2.5 text-[10px] font-semibold uppercase tracking-wider text-white transition hover:bg-white/10">
                                View Production Batches
                            </a>
                        </div>
                    </div>

                </div>
            </section>

        </div>

        <!-- ================= FOOTER ================= -->
        <footer class="border-t border-white/10 bg-[#040C09]/95">
            <div class="grid grid-cols-1 gap-8 px-6 py-8 lg:grid-cols-12 lg:px-8">

                <div class="flex flex-col group text-left lg:col-span-4 space-y-1">
                    <span class="text-xl sm:text-2xl font-serif font-extrabold tracking-[0.25em] text-white uppercase leading-none">KALLANI</span>
                    <span class="text-[9px] font-mono tracking-[0.18em] text-white uppercase leading-none">NINA / OPERATING SYSTEM</span>
                    <p class="pt-1.5 max-w-[240px] text-[10px] leading-snug text-gray-400">Operating System for Productive Natural Assets</p>
                </div>

                <nav class="grid grid-cols-3 gap-6 lg:col-span-5" aria-label="Footer">
                    <?php foreach ($footerCols as $heading => $links): ?>
                        <div>
                            <div class="text-[9px] font-bold uppercase tracking-wider text-gray-400"><?= $e($heading) ?></div>
                            <ul class="mt-3 space-y-2">
                                <?php foreach ($links as [$label, $href]): ?>
                                    <li><a href="<?= $href === '#' ? '#' : $basePrefix . $href ?>" class="text-[11px] text-gray-300 transition hover:text-white"><?= $e($label) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </nav>

                <div class="space-y-2 lg:col-span-3 lg:border-l lg:border-white/10 lg:pl-8">
                    <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-wider text-gray-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>System Status
                    </div>
                    <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-wider text-white">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>Demo / Simulated Environment
                    </div>
                    <p class="text-[10px] leading-snug text-gray-400">This prototype contains simulated data for demonstration purposes.</p>
                </div>

            </div>
        </footer>

    </div>
</div>

<!-- ================= GOOGLE MAPS ================= -->
<script>
    const BASE_PREFIX = <?= json_encode($basePrefix) ?>;
    let mapInstance = null;
    let infoWindow = null;

    /* Dark-green look (used by the "Satellite" toggle, matching the design).
       To use real satellite imagery instead, map 'satellite' to google.maps.MapTypeId.HYBRID in setMapType(). */
    const MAP_STYLE = [
        { elementType: 'geometry', stylers: [{ color: '#123A2A' }] },
        { elementType: 'labels', stylers: [{ visibility: 'off' }] },
        { featureType: 'water', elementType: 'geometry', stylers: [{ color: '#040E0A' }] },
        { featureType: 'landscape', elementType: 'geometry', stylers: [{ color: '#1A5A40' }] },
        { featureType: 'landscape.natural', elementType: 'geometry', stylers: [{ color: '#1F6647' }] },
        { featureType: 'poi', stylers: [{ visibility: 'off' }] },
        { featureType: 'road', stylers: [{ visibility: 'off' }] },
        { featureType: 'transit', stylers: [{ visibility: 'off' }] },
        { featureType: 'administrative.country', elementType: 'geometry.stroke', stylers: [{ color: '#7FE0B4' }, { weight: 1.4 }] },
        { featureType: 'administrative.province', elementType: 'geometry.stroke', stylers: [{ color: '#5CC79B' }, { weight: 0.8 }] }
    ];

    const KALIMANTAN_BOUNDS = { south: -4.5, west: 108.6, north: 4.7, east: 119.2 };

    function setMapType(type) {
        if (!mapInstance) return;
        mapInstance.setMapTypeId(type === 'terrain' ? google.maps.MapTypeId.TERRAIN : google.maps.MapTypeId.ROADMAP);
    }

    function fitKalimantan() {
        if (!mapInstance) return;
        const wide = document.getElementById('map').clientWidth >= 560;
        // Extra right padding leaves room for the "Buyer Requirement" card
        mapInstance.fitBounds(KALIMANTAN_BOUNDS, { top: 24, bottom: 24, left: 24, right: wide ? 190 : 24 });
    }

    function initMap() {
        const mapEl = document.getElementById('map');

        const northKalimantan = { lat: 2.85, lng: 116.55 };
        const southKalimantan = { lat: -2.98, lng: 115.08 };
        const mappingCore     = { lat: -0.4, lng: 116.1 };
        const buyerAnchor     = { lat: -0.4, lng: 119.9 };

        mapInstance = new google.maps.Map(mapEl, {
            center: { lat: 0, lng: 116.5 },
            zoom: 5,
            minZoom: 4,
            maxZoom: 9,
            styles: MAP_STYLE,
            backgroundColor: '#040E0A',
            disableDefaultUI: true,
            zoomControl: true,
            gestureHandling: 'cooperative',
            clickableIcons: false
        });
        fitKalimantan();

        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(fitKalimantan, 200);
        });

        infoWindow = new google.maps.InfoWindow({ maxWidth: 240, pixelOffset: new google.maps.Size(0, -18) });
        mapInstance.addListener('click', () => infoWindow.close());

        /* ----- HTML overlay marker (no default red pins) ----- */
        class HtmlMarker extends google.maps.OverlayView {
            constructor(position, map, html, opts = {}) {
                super();
                this.position = new google.maps.LatLng(position);
                this.html = html;
                this.transform = opts.transform || 'translate(-50%, -50%)';
                this.onClick = opts.onClick || null;
                this.div = null;
                this.setMap(map);
            }
            onAdd() {
                const div = document.createElement('div');
                div.style.position = 'absolute';
                div.style.transform = this.transform;
                div.style.whiteSpace = 'nowrap';
                div.style.fontFamily = getComputedStyle(document.body).fontFamily;
                div.innerHTML = this.html;
                if (this.onClick) {
                    div.style.cursor = 'pointer';
                    div.addEventListener('click', (ev) => { ev.stopPropagation(); this.onClick(ev); });
                } else {
                    div.style.pointerEvents = 'none'; // keep map dragging smooth
                }
                this.div = div;
                this.getPanes().overlayMouseTarget.appendChild(div);
            }
            draw() {
                const proj = this.getProjection();
                if (!proj || !this.div) return;
                const p = proj.fromLatLngToDivPixel(this.position);
                if (p) {
                    this.div.style.left = p.x + 'px';
                    this.div.style.top = p.y + 'px';
                }
            }
            onRemove() {
                if (this.div && this.div.parentNode) this.div.parentNode.removeChild(this.div);
                this.div = null;
            }
        }

        const pinSvg = '<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="2.5"/></svg>';

        const zoneMarkerHtml = (ringCls, name, ha, batch) => `
            <div class="flex select-none items-center gap-2 transition-transform hover:scale-105">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border-2 bg-[#06120F] shadow-lg ${ringCls}">${pinSvg}</div>
                <div class="rounded-lg border border-white/20 bg-[#06120F]/95 px-3 py-1.5 shadow-2xl">
                    <div class="text-[8px] font-bold uppercase tracking-wider text-gray-300">${name}</div>
                    <div class="text-xs font-extrabold leading-tight text-white">${ha}</div>
                    <div class="text-[9px] text-gray-400">${batch} batch equivalent</div>
                </div>
            </div>`;

        const zoneInfoHtml = (name, ha, batches) => `
            <div style="font-family: inherit; max-width: 210px; color: #fff;">
                <div style="margin: 0 0 4px; font-size: 11px; font-weight: 800; letter-spacing: .04em; text-transform: uppercase;">${name}</div>
                <p style="margin: 0 0 10px; font-size: 11px; line-height: 1.45; color: #D1D5DB;">
                    Mapped capacity: <strong style="color:#fff">${ha}</strong> (${batches} batches). Verified productive estate.
                </p>
                <a href="${BASE_PREFIX}/explore" style="display:block; text-align:center; background:#6EE7B7; color:#04100B; padding:6px 12px; border-radius:999px; font-size:10px; font-weight:800; letter-spacing:.06em; text-transform:uppercase; text-decoration:none;">View Details</a>
            </div>`;

        const showInfo = (position, html) => {
            infoWindow.setContent(html);
            infoWindow.setPosition(position);
            infoWindow.open({ map: mapInstance });
        };

        // Zone pins: the circle sits exactly on the coordinate, the label extends to the right
        new HtmlMarker(
            northKalimantan, mapInstance,
            zoneMarkerHtml('border-emerald-400 text-emerald-300', 'North Kalimantan', '350 HA', '3.5'),
            { transform: 'translate(-18px, -50%)', onClick: () => showInfo(northKalimantan, zoneInfoHtml('North Kalimantan Zone', '350 HA', '3.5')) }
        );
        new HtmlMarker(
            southKalimantan, mapInstance,
            zoneMarkerHtml('border-sky-400 text-sky-300', 'South Kalimantan', '650 HA', '6.5'),
            { transform: 'translate(-18px, -50%)', onClick: () => showInfo(southKalimantan, zoneInfoHtml('South Kalimantan Zone', '650 HA', '6.5')) }
        );

        // Buyer requirement: dotted connector + card (skipped on very narrow screens)
        if (mapEl.clientWidth >= 560) {
            new google.maps.Polyline({
                path: [mappingCore, buyerAnchor],
                strokeOpacity: 0,
                clickable: false,
                icons: [{
                    icon: { path: google.maps.SymbolPath.CIRCLE, fillColor: '#6EE7B7', fillOpacity: 1, strokeOpacity: 0, scale: 1.6 },
                    offset: '0',
                    repeat: '9px'
                }],
                map: mapInstance
            });

            new HtmlMarker(
                mappingCore, mapInstance,
                '<span style="display:block;width:12px;height:12px;border-radius:9999px;background:#34D399;border:2px solid #fff;box-shadow:0 0 0 4px rgba(52,211,153,.25)"></span>'
            );

            new HtmlMarker(
                buyerAnchor, mapInstance,
                `<div class="rounded-xl border border-white/60 bg-[#06120F]/95 px-4 py-2.5 shadow-2xl">
                    <div class="text-[8px] font-bold uppercase tracking-wider text-gray-300">Buyer Requirement</div>
                    <div class="text-lg font-extrabold leading-tight text-white">1,000 HA</div>
                 </div>`,
                { transform: 'translate(0, -50%)' }
            );
        }
    }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeyP_0nYynBU5ImC0AWBzGxkiXep-Z0K4&callback=initMap"></script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';