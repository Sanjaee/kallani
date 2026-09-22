<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$constants = $config['system_constants'] ?? [];
$demoDemand = $config['demo_demands'][0] ?? [];
$title = '21 / Production Program Control Center — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'programs';

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
    'alert'     => '<path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
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

        <!-- ================= 01, 02 & 03. PAGE HEADER & PROGRAM MASTER CARD ================= -->
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
                        <a href="<?= $basePrefix ?>/batches" class="hover:text-white transition-colors">PRODUCTION</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/production-programs" class="hover:text-white transition-colors">PROGRAMS</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="font-bold text-white uppercase">PRG-2026-001</span>
                    </nav>

                    <div class="flex flex-wrap items-center gap-2 text-[10px] font-bold">
                        <span class="rounded bg-emerald-950 px-3 py-1 text-emerald-300 border border-emerald-500/30 uppercase tracking-wider">PROGRAM / PORTFOLIO CONTROL</span>
                        <span class="rounded bg-white/10 px-3 py-1 text-gray-300 border border-white/10 uppercase tracking-wider">DEMO / SIMULATED</span>
                    </div>
                </div>

                <!-- Headline & Right Master Card Grid -->
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 items-center">
                    <div class="space-y-2 lg:col-span-6">
                        <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-200">
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">PROGRAM ORCHESTRATION</span>
                            <span>21 / PRODUCTION PROGRAM CONTROL CENTER</span>
                        </div>

                        <h1 class="max-w-2xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">One Program. Multiple Production Capacities.</h1>
                        
                        <p class="max-w-2xl text-sm font-medium leading-relaxed text-gray-200">
                            NINA coordinates multiple production requirements, productive assets, production batches, partners, vendors and commercial deliveries as one controlled production program.
                        </p>
                        <p class="text-[11px] italic text-gray-400">
                            Satu program produksi dapat terdiri dari banyak kebutuhan buyer, wilayah, project, batch, partner, vendor, dan delivery yang tetap dikendalikan dalam satu operational framework.
                        </p>
                    </div>

                    <!-- Right Side Program Master Card (03) -->
                    <div class="lg:col-span-6">
                        <div class="rounded-xl border border-emerald-500/30 bg-[#08150E]/95 p-4 shadow-2xl backdrop-blur-md space-y-3 font-mono">
                            <div class="flex items-center justify-between border-b border-white/10 pb-2">
                                <div>
                                    <div class="text-[9px] text-emerald-400 font-bold uppercase">PROGRAM MASTER RECORD</div>
                                    <div class="text-sm font-extrabold text-white">PRG-2026-001 — Indonesia Palm Production Program</div>
                                </div>
                                <span class="rounded bg-amber-950 px-2.5 py-1 text-[10px] font-bold text-amber-300 border border-amber-500/30 uppercase">DEMO / SIMULATED</span>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <div>
                                    <div class="text-[9px] text-gray-400">PROGRAM HORIZON</div>
                                    <div class="font-bold text-white">20 Years Total</div>
                                    <div class="text-[9px] text-gray-400">5 Yrs Ramp-up + 15 Yrs Delivery</div>
                                </div>
                                <div>
                                    <div class="text-[9px] text-gray-400">PROGRAM TARGET SCOPE</div>
                                    <div class="font-bold text-emerald-300">10,000 HA (100 Batches)</div>
                                    <div class="text-[9px] text-gray-400">24-Month Target Model</div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-xs bg-black/40 p-2 rounded border border-white/5">
                                <div>
                                    <div class="text-[9px] text-gray-400">MODELED VALUE</div>
                                    <div class="font-bold text-white text-sm">88.000.000 usdt</div>
                                </div>
                                <div>
                                    <div class="text-[9px] text-gray-400">GROSS FEE (3%)</div>
                                    <div class="font-bold text-emerald-300 text-sm">2.640.000 usdt</div>
                                </div>
                            </div>

                            <p class="text-[9px] text-gray-400 italic">
                                Modelled target scenario only. Not achieved production, committed capacity, guaranteed revenue or guaranteed fee income.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ================= MAIN BODY CONTENT ================= -->
        <div class="space-y-6 px-4 pb-16 pt-6 sm:px-6 lg:px-8">

            <!-- ---------- 04. TOP KPI STRIP (6 CARDS) ---------- -->
            <section class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">ACTIVE REQUIREMENTS</span>
                        <span class="text-emerald-400"><?= $svg($ic['target'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-white font-mono">01</div>
                    <div class="text-[9px] text-gray-400">DR-2026-001 Connected</div>
                </div>

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">MAPPED CAPACITY</span>
                        <span class="text-emerald-400"><?= $svg($ic['globe'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-emerald-300 font-mono">1,000 HA</div>
                    <div class="text-[9px] text-gray-400">Current demo mapped</div>
                </div>

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">EXECUTABLE BATCHES</span>
                        <span class="text-emerald-400"><?= $svg($ic['box'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-white font-mono">10</div>
                    <div class="text-[9px] text-gray-400">100 HA standard units</div>
                </div>

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">MAPPED VALUE</span>
                        <span class="text-emerald-400"><?= $svg($ic['coin'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-2xl font-extrabold text-white font-mono">8.800.000 usdt</div>
                    <div class="text-[9px] text-gray-400">10 &times; 880.000 usdt Modeled</div>
                </div>

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">VERIFIED CAPACITY</span>
                        <span class="text-amber-400"><?= $svg($ic['shield'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-xl font-extrabold text-amber-300 font-mono uppercase">PENDING</div>
                    <div class="text-[9px] text-amber-400/80">Verification in progress</div>
                </div>

                <div class="<?= $card ?> px-4 py-3">
                    <div class="flex items-center justify-between">
                        <span class="<?= $metricLbl ?>">DELIVERY STATUS</span>
                        <span class="text-gray-400"><?= $svg($ic['truck'], 'w-4 h-4') ?></span>
                    </div>
                    <div class="mt-1 text-sm font-extrabold text-gray-400 font-mono uppercase">NOT STARTED</div>
                    <div class="text-[9px] text-gray-500">No delivery in demo</div>
                </div>

            </section>

            <!-- ---------- 05. PROGRAM VS TARGET (24-MONTH COMPARISON) ---------- -->
            <section class="<?= $card ?> p-6 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-white/10 pb-3">
                    <div>
                        <h3 class="text-sm font-mono font-bold uppercase text-white">24-MONTH PROGRAM TARGET VS CURRENT DEMO STATE</h3>
                        <p class="text-[11px] text-gray-400">Progress represents mapped capacity allocation, not production completion.</p>
                    </div>
                    <span class="rounded bg-emerald-950 px-3 py-1 text-emerald-300 font-mono text-xs font-bold border border-emerald-500/40">
                        10% MAPPED CAPACITY (1,000 / 10,000 HA)
                    </span>
                </div>

                <!-- Progress Bar -->
                <div class="space-y-1.5 font-mono text-xs">
                    <div class="flex justify-between text-[10px] text-gray-400">
                        <span>Current Mapped: <strong class="text-emerald-300">1,000 HA</strong></span>
                        <span>24-Month Target: <strong class="text-white">10,000 HA</strong></span>
                    </div>
                    <div class="w-full bg-white/10 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-400 h-full rounded-full" style="width: 10%"></div>
                    </div>
                </div>

                <!-- Comparison Table -->
                <div class="overflow-x-auto text-xs font-mono">
                    <table class="w-full text-left">
                        <thead class="bg-white/5 text-gray-400 text-[9px] uppercase">
                            <tr>
                                <th class="p-2.5">Program Metric</th>
                                <th class="p-2.5">24-Month Modeled Target</th>
                                <th class="p-2.5">Current Mapped Demo State</th>
                                <th class="p-2.5">Variance / Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5 text-gray-200">
                            <tr>
                                <td class="p-2.5 font-bold text-white">Production Capacity</td>
                                <td class="p-2.5 text-white">10,000 HA</td>
                                <td class="p-2.5 text-emerald-300 font-bold">1,000 HA Mapped</td>
                                <td class="p-2.5 text-amber-300">10% Mapped Capacity</td>
                            </tr>
                            <tr>
                                <td class="p-2.5 font-bold text-white">Standard Production Batches</td>
                                <td class="p-2.5 text-white">100 Batches (100 HA)</td>
                                <td class="p-2.5 text-emerald-300 font-bold">10 Batches Structured</td>
                                <td class="p-2.5 text-amber-300">10 Batches Executable</td>
                            </tr>
                            <tr>
                                <td class="p-2.5 font-bold text-white">Modeled Production Value</td>
                                <td class="p-2.5 text-white">88.000.000 usdt</td>
                                <td class="p-2.5 text-emerald-300 font-bold">8.800.000 usdt</td>
                                <td class="p-2.5 text-amber-300">8.800.000 usdt Mapped Model</td>
                            </tr>
                            <tr>
                                <td class="p-2.5 font-bold text-white">Verified Production Capacity</td>
                                <td class="p-2.5 text-white">10,000 HA Target</td>
                                <td class="p-2.5 text-amber-300 font-bold">Pending Verification</td>
                                <td class="p-2.5 text-amber-300">Controls In Progress</td>
                            </tr>
                            <tr>
                                <td class="p-2.5 font-bold text-white">Completed Batches / Output</td>
                                <td class="p-2.5 text-white">—</td>
                                <td class="p-2.5 text-gray-400 font-bold">0 Batches / 0 Output</td>
                                <td class="p-2.5 text-gray-400">Historical Pending</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- ---------- 06. PROGRAM ARCHITECTURE DIAGRAM ---------- -->
            <section class="<?= $card ?> p-5 space-y-4">
                <div class="border-b border-white/10 pb-2.5 flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-mono font-bold uppercase text-white">PROGRAM CONTROL LAYER ARCHITECTURE</h3>
                        <p class="text-[11px] text-gray-400">Every production unit remains connected to its originating requirement and commercial destination.</p>
                    </div>
                    <span class="text-xs font-mono text-emerald-400 font-bold">PRG-2026-001 CONTROL</span>
                </div>

                <div class="overflow-x-auto pb-2 scrollbar-none font-mono text-[10px]">
                    <div class="min-w-[900px] flex items-center justify-between gap-1 text-center py-2">
                        <div class="bg-emerald-950 p-2 rounded border border-emerald-500/30 text-emerald-300 font-bold">BUYER DEMAND</div>
                        <span class="text-gray-500">→</span>
                        <div class="bg-white/10 p-2 rounded text-white">REQUIREMENT</div>
                        <span class="text-gray-500">→</span>
                        <div class="bg-white/10 p-2 rounded text-white">CAPACITY MAPPING</div>
                        <span class="text-gray-500">→</span>
                        <div class="bg-white/10 p-2 rounded text-white">PROJECTS</div>
                        <span class="text-gray-500">→</span>
                        <div class="bg-emerald-950 p-2 rounded border border-emerald-500/30 text-emerald-300 font-bold">100 HA BATCHES</div>
                        <span class="text-gray-500">→</span>
                        <div class="bg-white/10 p-2 rounded text-white">PARTNERS + VENDORS</div>
                        <span class="text-gray-500">→</span>
                        <div class="bg-white/10 p-2 rounded text-white">RAB + WORK ORDERS</div>
                        <span class="text-gray-500">→</span>
                        <div class="bg-white/10 p-2 rounded text-white">EXECUTION</div>
                        <span class="text-gray-500">→</span>
                        <div class="bg-amber-950 p-2 rounded border border-amber-500/30 text-amber-300 font-bold">VERIFICATION</div>
                        <span class="text-gray-500">→</span>
                        <div class="bg-white/10 p-2 rounded text-white">OUTPUT / DELIVERY</div>
                        <span class="text-gray-500">→</span>
                        <div class="bg-emerald-950 p-2 rounded border border-emerald-500/30 text-emerald-300 font-bold">FULFILLMENT</div>
                    </div>
                </div>
            </section>

            <!-- ---------- 07 & 08. CONNECTED DEMAND & PROGRAM CAPACITY MAP ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- Connected Demand Card (07 - 6 cols) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">CONNECTED DEMAND REQUIREMENT</h3>
                        <a href="<?= $basePrefix ?>/demand" class="text-[10px] font-mono text-emerald-400 hover:underline">VIEW REQUIREMENT →</a>
                    </div>

                    <div class="rounded-xl bg-white/5 p-4 border border-emerald-500/30 space-y-3 font-mono text-xs">
                        <div class="flex justify-between items-start">
                            <div>
                                <span class="text-[9px] text-emerald-400 font-bold">DR-2026-001</span>
                                <h4 class="font-extrabold text-white text-base">DEMO OFFTAKE REQUIREMENT</h4>
                                <div class="text-[10px] text-gray-400">Buyer: Demo Offtake Buyer (Example/Simulated)</div>
                            </div>
                            <span class="bg-emerald-950 px-2 py-0.5 rounded text-[9px] text-emerald-300 border border-emerald-500/30 font-bold">100% MAPPED</span>
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-[10px]">
                            <div class="bg-black/40 p-2 rounded border border-white/5">
                                <span class="text-gray-400">Required:</span> <strong class="text-white">1,000 HA</strong>
                            </div>
                            <div class="bg-black/40 p-2 rounded border border-white/5">
                                <span class="text-gray-400">Horizon:</span> <strong class="text-white">20 Years</strong>
                            </div>
                        </div>

                        <div class="text-[10px] text-gray-400">
                            Coverage: <strong class="text-emerald-300">North Kalimantan (200 HA)</strong> + <strong class="text-emerald-300">South Kalimantan (800 HA)</strong>
                        </div>
                    </div>
                </div>

                <!-- Program Capacity Allocation Map (08 - 6 cols) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-3">
                    <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">REGIONAL CAPACITY ORIGIN</h3>
                        <span class="text-[10px] font-mono text-emerald-400 font-bold">1,000 HA MAPPED</span>
                    </div>

                    <div class="overflow-x-auto text-xs font-mono">
                        <table class="w-full text-left">
                            <thead class="bg-white/5 text-gray-400 text-[9px] uppercase">
                                <tr>
                                    <th class="p-2">Region</th>
                                    <th class="p-2">Capacity</th>
                                    <th class="p-2">State</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5 text-gray-200">
                                <tr>
                                    <td class="p-2 font-bold text-white">North Kalimantan</td>
                                    <td class="p-2 text-emerald-300 font-bold">200 HA</td>
                                    <td class="p-2"><span class="text-emerald-400 bg-emerald-950 px-1.5 py-0.5 rounded text-[9px] font-bold">MAPPED / DEMO</span></td>
                                </tr>
                                <tr>
                                    <td class="p-2 font-bold text-white">South Kalimantan</td>
                                    <td class="p-2 text-emerald-300 font-bold">800 HA</td>
                                    <td class="p-2"><span class="text-emerald-400 bg-emerald-950 px-1.5 py-0.5 rounded text-[9px] font-bold">MAPPED / DEMO</span></td>
                                </tr>
                                <tr>
                                    <td class="p-2 font-bold text-gray-400">East Kalimantan</td>
                                    <td class="p-2 text-gray-400">—</td>
                                    <td class="p-2"><span class="text-amber-300 bg-amber-950 px-1.5 py-0.5 rounded text-[9px] font-bold">PIPELINE</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <p class="text-[9px] text-gray-500 italic font-mono">
                        Mapped ≠ Verified ≠ Executed ≠ Delivered.
                    </p>
                </div>

            </section>

            <!-- ---------- 09, 10 & 11. BATCH CONTROL, PROGRAM RAB & PARTNER TIER ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- 09. Discrete Batch Control (6 cols) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">DISCRETE BATCH STRUCTURE</h3>
                        <a href="<?= $basePrefix ?>/batches" class="text-[10px] font-mono text-emerald-400 hover:underline">10 BATCHES →</a>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 text-xs font-mono">
                        <div class="bg-white/5 p-2.5 rounded-lg border border-emerald-500/30">
                            <div class="text-[9px] text-emerald-400 font-bold">NK-001</div>
                            <div class="font-bold text-white">100 HA</div>
                            <div class="text-[9px] text-gray-400">North Kalimantan</div>
                            <span class="text-[8px] text-emerald-300 bg-emerald-950 px-1 py-0.2 rounded mt-1 inline-block">MAPPED</span>
                        </div>
                        <div class="bg-white/5 p-2.5 rounded-lg border border-emerald-500/30">
                            <div class="text-[9px] text-emerald-400 font-bold">NK-002</div>
                            <div class="font-bold text-white">100 HA</div>
                            <div class="text-[9px] text-gray-400">North Kalimantan</div>
                            <span class="text-[8px] text-emerald-300 bg-emerald-950 px-1 py-0.2 rounded mt-1 inline-block">MAPPED</span>
                        </div>
                        <div class="bg-white/5 p-2.5 rounded-lg border border-emerald-500/30">
                            <div class="text-[9px] text-emerald-400 font-bold">NK-003</div>
                            <div class="font-bold text-white">100 HA</div>
                            <div class="text-[9px] text-gray-400">North Kalimantan</div>
                            <span class="text-[8px] text-emerald-300 bg-emerald-950 px-1 py-0.2 rounded mt-1 inline-block">MAPPED</span>
                        </div>
                        <div class="bg-white/5 p-2.5 rounded-lg border border-emerald-500/30">
                            <div class="text-[9px] text-emerald-400 font-bold">SK-001</div>
                            <div class="font-bold text-white">100 HA</div>
                            <div class="text-[9px] text-gray-400">South Kalimantan</div>
                            <span class="text-[8px] text-emerald-300 bg-emerald-950 px-1 py-0.2 rounded mt-1 inline-block">MAPPED</span>
                        </div>
                        <div class="bg-white/5 p-2.5 rounded-lg border border-emerald-500/30">
                            <div class="text-[9px] text-emerald-400 font-bold">SK-002</div>
                            <div class="font-bold text-white">100 HA</div>
                            <div class="text-[9px] text-gray-400">South Kalimantan</div>
                            <span class="text-[8px] text-emerald-300 bg-emerald-950 px-1 py-0.2 rounded mt-1 inline-block">MAPPED</span>
                        </div>
                        <div class="bg-black/40 p-2.5 rounded-lg border border-white/10 flex flex-col items-center justify-center text-center">
                            <span class="font-bold text-gray-300 text-xs">+5 Batches</span>
                            <span class="text-[8px] text-gray-500">SK-003 to SK-007</span>
                        </div>
                    </div>
                </div>

                <!-- 10. Program RAB Control (6 cols) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                        <h3 class="text-xs font-mono font-bold uppercase text-white">PROGRAM RAB BUDGET CONTROL</h3>
                        <a href="<?= $basePrefix ?>/rab-budget" class="text-[10px] font-mono text-emerald-400 hover:underline">OPEN RAB →</a>
                    </div>

                    <div class="space-y-2 font-mono text-xs">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Modeled Requirement:</span>
                            <span class="text-emerald-300 font-bold">8.800.000 usdt (10 &times; 880.000 usdt)</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Planned Budget:</span>
                            <span class="text-amber-300 font-bold">Pending Approval</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Allocated / Committed:</span>
                            <span class="text-gray-400">0 usdt / 0 usdt</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Executed / Verified:</span>
                            <span class="text-gray-400">0 usdt / 0 usdt</span>
                        </div>
                    </div>

                    <div class="bg-black/40 p-2.5 rounded text-[10px] font-mono text-gray-400 italic border border-white/5">
                        PROGRAM $\rightarrow$ PROJECT $\rightarrow$ BATCH $\rightarrow$ RAB $\rightarrow$ VENDOR $\rightarrow$ WORK ORDER $\rightarrow$ EXECUTION
                    </div>
                </div>

            </section>

            <!-- ---------- 13 & 14. CONTROL BOARD & OPERATIONAL READINESS ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- 13. Execution Status Board (6 cols) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-3">
                    <div class="border-b border-white/10 pb-2.5">
                        <h4 class="text-xs font-mono font-bold uppercase text-white">PROGRAM EXECUTION STATUS BOARD</h4>
                    </div>

                    <div class="grid grid-cols-2 gap-2 text-xs font-mono">
                        <div class="flex justify-between p-1.5 bg-white/5 rounded"><span>Demand:</span> <strong class="text-emerald-300">✓ Mapped</strong></div>
                        <div class="flex justify-between p-1.5 bg-white/5 rounded"><span>Capacity:</span> <strong class="text-emerald-300">✓ 1,000 HA</strong></div>
                        <div class="flex justify-between p-1.5 bg-white/5 rounded"><span>Batches:</span> <strong class="text-white">✓ 10 Units</strong></div>
                        <div class="flex justify-between p-1.5 bg-white/5 rounded"><span>Partner Verification:</span> <strong class="text-amber-300">Pending</strong></div>
                        <div class="flex justify-between p-1.5 bg-white/5 rounded"><span>RAB Status:</span> <strong class="text-amber-300">Pending</strong></div>
                        <div class="flex justify-between p-1.5 bg-white/5 rounded"><span>Vendor Assignment:</span> <strong class="text-amber-300">Pending</strong></div>
                        <div class="flex justify-between p-1.5 bg-white/5 rounded"><span>Work Orders:</span> <strong class="text-amber-300">Pending</strong></div>
                        <div class="flex justify-between p-1.5 bg-white/5 rounded"><span>Field Execution:</span> <strong class="text-gray-400">Not Started</strong></div>
                    </div>
                </div>

                <!-- 14. Operational Readiness Metric (6 cols) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-3">
                    <div class="border-b border-white/10 pb-2.5 flex justify-between items-center">
                        <h4 class="text-xs font-mono font-bold uppercase text-white">OPERATIONAL CONTROL READINESS</h4>
                        <span class="text-amber-300 font-mono text-[10px] font-bold">3 / 12 READY</span>
                    </div>

                    <div class="grid grid-cols-2 gap-1.5 text-xs font-mono">
                        <div class="flex items-center gap-1.5 text-emerald-300"><span>✓</span> Requirement defined</div>
                        <div class="flex items-center gap-1.5 text-emerald-300"><span>✓</span> Capacity mapped</div>
                        <div class="flex items-center gap-1.5 text-emerald-300"><span>✓</span> Batch structure created</div>
                        <div class="flex items-center gap-1.5 text-gray-400"><span>○</span> Land verification</div>
                        <div class="flex items-center gap-1.5 text-gray-400"><span>○</span> Partner verification</div>
                        <div class="flex items-center gap-1.5 text-gray-400"><span>○</span> Seed verification</div>
                        <div class="flex items-center gap-1.5 text-gray-400"><span>○</span> RAB approval</div>
                        <div class="flex items-center gap-1.5 text-gray-400"><span>○</span> Vendor assignment</div>
                        <div class="flex items-center gap-1.5 text-gray-400"><span>○</span> Work order issuance</div>
                        <div class="flex items-center gap-1.5 text-gray-400"><span>○</span> Field evidence</div>
                        <div class="flex items-center gap-1.5 text-gray-400"><span>○</span> Verification complete</div>
                        <div class="flex items-center gap-1.5 text-gray-400"><span>○</span> Delivery documentation</div>
                    </div>
                </div>

            </section>

            <!-- ---------- 15. PROGRAM MILESTONES STEPPER ---------- -->
            <section class="<?= $card ?> p-5 space-y-4">
                <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                    <div>
                        <h3 class="text-sm font-mono font-bold uppercase text-white">PROGRAM OPERATIONAL MILESTONES</h3>
                        <p class="text-[11px] text-gray-400">High-level program milestone progression from demand definition to fulfillment.</p>
                    </div>
                    <span class="rounded bg-emerald-950 px-3 py-1 text-emerald-300 font-mono text-xs font-bold border border-emerald-500/40">
                        MILESTONE 03 READY
                    </span>
                </div>

                <!-- Milestone Stepper Horizontal Grid -->
                <div class="overflow-x-auto pb-4 pt-2 scrollbar-none">
                    <div class="min-w-[850px] grid grid-cols-7 font-mono text-[10px] relative px-2 py-2">
                        
                        <!-- Step 1: Demand Defined -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-emerald-500 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-emerald-500 text-black flex items-center justify-center font-bold text-[10px] shadow-md shadow-emerald-950 z-10">✓</div>
                            <span class="font-bold text-white mt-1.5">01 Demand Defined</span>
                            <span class="text-[8px] text-gray-400">Requirement</span>
                        </div>

                        <!-- Step 2: Capacity Mapped -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-gradient-to-r from-emerald-500 to-amber-500 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-emerald-500 text-black flex items-center justify-center font-bold text-[10px] shadow-md shadow-emerald-950 z-10">✓</div>
                            <span class="font-bold text-white mt-1.5">02 Capacity Mapped</span>
                            <span class="text-[8px] text-gray-400">1,000 HA</span>
                        </div>

                        <!-- Step 3: Production Structured -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-amber-500 text-black flex items-center justify-center font-bold text-[10px] ring-4 ring-amber-500/20 shadow-md z-10">●</div>
                            <span class="font-bold text-amber-300 mt-1.5">03 Structured</span>
                            <span class="text-[8px] text-amber-400 font-bold">10 Batches</span>
                        </div>

                        <!-- Step 4: Execution -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[9px] z-10">○</div>
                            <span class="text-gray-400 font-medium mt-1.5">04 Execution</span>
                            <span class="text-[8px] text-gray-500">RAB & Vendors</span>
                        </div>

                        <!-- Step 5: Verified Production -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[9px] z-10">○</div>
                            <span class="text-gray-400 font-medium mt-1.5">05 Verified Output</span>
                            <span class="text-[8px] text-gray-500">Audit Check</span>
                        </div>

                        <!-- Step 6: Commercial Delivery -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="absolute top-[11px] left-1/2 w-full h-[2px] bg-white/10 z-0"></div>
                            <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[9px] z-10">○</div>
                            <span class="text-gray-400 font-medium mt-1.5">06 Delivery</span>
                            <span class="text-[8px] text-gray-500">Offtake Buyer</span>
                        </div>

                        <!-- Step 7: Fulfillment -->
                        <div class="flex flex-col items-center text-center relative group">
                            <div class="h-6 w-6 rounded-full bg-white/10 text-gray-400 border border-white/20 flex items-center justify-center text-[9px] z-10">○</div>
                            <span class="text-gray-400 font-medium mt-1.5">07 Fulfillment</span>
                            <span class="text-[8px] text-gray-500">Program Closure</span>
                        </div>

                    </div>
                </div>
            </section>

            <!-- ---------- 16 & 17. NAVIGATION HIERARCHY CHAIN & PROGRAM ACTIVITY FEED ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- 16. Clickable Program Navigation Hierarchy (6 cols) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-3">
                    <div class="border-b border-white/10 pb-2 flex justify-between items-center">
                        <h4 class="text-xs font-mono font-bold uppercase text-white">PROGRAM OBJECT HIERARCHY</h4>
                        <span class="text-[10px] font-mono text-emerald-400">CLICKABLE LAYERS</span>
                    </div>

                    <div class="space-y-1.5 text-xs font-mono">
                        <a href="<?= $basePrefix ?>/production-programs" class="block p-2 rounded bg-white/5 hover:bg-white/10 border border-white/5 flex justify-between">
                            <span class="text-gray-300">PROGRAM: <strong class="text-white">PRG-2026-001</strong></span>
                            <span class="text-emerald-400 font-bold">Root</span>
                        </a>
                        <a href="<?= $basePrefix ?>/demand" class="block p-2 rounded bg-white/5 hover:bg-white/10 border border-white/5 flex justify-between pl-4">
                            <span class="text-gray-300">REQUIREMENT: <strong class="text-white">DR-2026-001</strong></span>
                            <span class="text-emerald-400 font-bold">1,000 HA</span>
                        </a>
                        <a href="<?= $basePrefix ?>/explore" class="block p-2 rounded bg-white/5 hover:bg-white/10 border border-white/5 flex justify-between pl-6">
                            <span class="text-gray-300">PROJECTS: <strong class="text-white">North & South Kalimantan</strong></span>
                            <span class="text-emerald-400">2 Regions</span>
                        </a>
                        <a href="<?= $basePrefix ?>/batches" class="block p-2 rounded bg-white/5 hover:bg-white/10 border border-white/5 flex justify-between pl-8">
                            <span class="text-gray-300">BATCH: <strong class="text-white">NK-001 (100 HA)</strong></span>
                            <span class="text-amber-300">Mapped</span>
                        </a>
                        <a href="<?= $basePrefix ?>/allocations" class="block p-2 rounded bg-white/5 hover:bg-white/10 border border-white/5 flex justify-between pl-10">
                            <span class="text-gray-300">ALLOCATION: <strong class="text-white">ALC-2026-NK001-0001</strong></span>
                            <span class="text-emerald-400">8.000 usdt PO allocation unit</span>
                        </a>
                    </div>
                </div>

                <!-- 17. Program Activity Feed (6 cols) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-3">
                    <div class="border-b border-white/10 pb-2 flex justify-between items-center">
                        <h4 class="text-xs font-mono font-bold uppercase text-white">PROGRAM ACTIVITY FEED</h4>
                        <span class="text-[9px] font-mono text-gray-400">SIMULATED EVENTS</span>
                    </div>

                    <div class="space-y-2 text-xs font-mono">
                        <div class="flex justify-between items-start bg-white/5 p-2 rounded">
                            <div>
                                <span class="text-[9px] text-emerald-400 font-bold">CAP-2026-001</span>
                                <div class="text-white font-bold text-[11px]">Capacity mapping created (1,000 HA)</div>
                            </div>
                            <span class="text-[8px] text-gray-400 bg-black/40 px-1.5 py-0.5 rounded">SIMULATED</span>
                        </div>
                        <div class="flex justify-between items-start bg-white/5 p-2 rounded">
                            <div>
                                <span class="text-[9px] text-emerald-400 font-bold">BATCH-2026-001</span>
                                <div class="text-white font-bold text-[11px]">10 production batches structured</div>
                            </div>
                            <span class="text-[8px] text-gray-400 bg-black/40 px-1.5 py-0.5 rounded">SIMULATED</span>
                        </div>
                        <div class="flex justify-between items-start bg-white/5 p-2 rounded">
                            <div>
                                <span class="text-[9px] text-amber-400 font-bold">RAB-2026-NK001-V01</span>
                                <div class="text-white font-bold text-[11px]">Production RAB created (880.000 usdt)</div>
                            </div>
                            <span class="text-[8px] text-amber-300 bg-amber-950 px-1.5 py-0.5 rounded">PENDING</span>
                        </div>
                    </div>
                </div>

            </section>

            <!-- ---------- 18. PROGRAM EXCEPTION CENTER ---------- -->
            <section class="<?= $card ?> p-5 space-y-3">
                <div class="border-b border-white/10 pb-2.5 flex justify-between items-center">
                    <h3 class="text-sm font-mono font-bold uppercase text-white flex items-center gap-2">
                        <span class="text-amber-400"><?= $svg($ic['alert'], 'w-4 h-4') ?></span>
                        <span>EXCEPTIONS REQUIRING ATTENTION</span>
                    </h3>
                    <span class="text-[10px] font-mono text-gray-400">4 CONTROLS PENDING AUTHORIZATION</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 font-mono text-xs">
                    <div class="bg-white/5 p-3 rounded-lg border border-amber-500/30 space-y-2">
                        <div class="text-amber-300 font-bold text-[11px]">Partner Verification</div>
                        <div class="text-[10px] text-gray-400">North Kalimantan Partner pending verification</div>
                        <a href="<?= $basePrefix ?>/verification" class="inline-block rounded bg-amber-950 px-2 py-1 text-[9px] text-amber-300 font-bold border border-amber-500/30">REVIEW →</a>
                    </div>
                    <div class="bg-white/5 p-3 rounded-lg border border-amber-500/30 space-y-2">
                        <div class="text-amber-300 font-bold text-[11px]">Seed Certification</div>
                        <div class="text-[10px] text-gray-400">Seed documentation not yet submitted</div>
                        <a href="<?= $basePrefix ?>/documents" class="inline-block rounded bg-amber-950 px-2 py-1 text-[9px] text-amber-300 font-bold border border-amber-500/30">REQUEST DOCUMENT →</a>
                    </div>
                    <div class="bg-white/5 p-3 rounded-lg border border-amber-500/30 space-y-2">
                        <div class="text-amber-300 font-bold text-[11px]">RAB Approval</div>
                        <div class="text-[10px] text-gray-400">Batch NK-001 RAB pending approval</div>
                        <a href="<?= $basePrefix ?>/rab-budget" class="inline-block rounded bg-amber-950 px-2 py-1 text-[9px] text-amber-300 font-bold border border-amber-500/30">OPEN RAB →</a>
                    </div>
                    <div class="bg-white/5 p-3 rounded-lg border border-amber-500/30 space-y-2">
                        <div class="text-amber-300 font-bold text-[11px]">Commercial Spec</div>
                        <div class="text-[10px] text-gray-400">Buyer product specification pending</div>
                        <a href="<?= $basePrefix ?>/demand" class="inline-block rounded bg-amber-950 px-2 py-1 text-[9px] text-amber-300 font-bold border border-amber-500/30">OPEN REQUIREMENT →</a>
                    </div>
                </div>
            </section>

            <!-- ---------- 19 & 20. PROGRAM DOCUMENT CENTER & AUDIT TRAIL ---------- -->
            <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- 19. Document Center (5 cols) -->
                <div class="lg:col-span-5 <?= $card ?> p-5 space-y-3">
                    <div class="border-b border-white/10 pb-2 flex justify-between items-center">
                        <h4 class="text-xs font-mono font-bold uppercase text-white">PROGRAM DOCUMENT CENTER</h4>
                        <a href="<?= $basePrefix ?>/documents" class="text-[10px] font-mono text-emerald-400 hover:underline">DOC CENTER →</a>
                    </div>

                    <div class="space-y-1.5 text-xs font-mono">
                        <div class="flex justify-between text-gray-300"><span>Production Requirement (DR-2026-001)</span><span class="text-emerald-400 font-bold">AVAILABLE</span></div>
                        <div class="flex justify-between text-gray-300"><span>Capacity Mapping Record</span><span class="text-emerald-400 font-bold">AVAILABLE</span></div>
                        <div class="flex justify-between text-gray-300"><span>RAB-NK-001-V01</span><span class="text-emerald-400 font-bold">AVAILABLE</span></div>
                        <div class="flex justify-between text-gray-400"><span>Partner Verification Record</span><span class="text-amber-300">PENDING</span></div>
                        <div class="flex justify-between text-gray-400"><span>Seed Certification</span><span class="text-amber-300">PENDING</span></div>
                    </div>
                </div>

                <!-- 20. Immutable Audit Trail (7 cols) -->
                <div class="lg:col-span-7 <?= $card ?> p-5 space-y-3">
                    <div class="border-b border-white/10 pb-2 flex justify-between items-center">
                        <h4 class="text-xs font-mono font-bold uppercase text-white">PROGRAM AUDIT TRAIL</h4>
                        <span class="text-[10px] font-mono text-gray-400">PRG-2026-001 LOG</span>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 font-mono text-[10px]">
                        <div class="bg-white/5 p-2 rounded border border-white/5">
                            <span class="text-emerald-400 font-bold block">1. Program Created</span>
                            <span class="text-gray-400 text-[9px]">PRG-2026-001 Initialized</span>
                        </div>
                        <div class="bg-white/5 p-2 rounded border border-white/5">
                            <span class="text-emerald-400 font-bold block">2. Requirement Linked</span>
                            <span class="text-gray-400 text-[9px]">DR-2026-001 (1,000 HA)</span>
                        </div>
                        <div class="bg-white/5 p-2 rounded border border-white/5">
                            <span class="text-emerald-400 font-bold block">3. Capacity Mapped</span>
                            <span class="text-gray-400 text-[9px]">NK (200 HA) + SK (800 HA)</span>
                        </div>
                        <div class="bg-white/5 p-2 rounded border border-white/5">
                            <span class="text-emerald-300 font-bold block">4. Batches Created</span>
                            <span class="text-gray-400 text-[9px]">10 x 100 HA Structured</span>
                        </div>
                        <div class="bg-white/5 p-2 rounded border border-white/5">
                            <span class="text-amber-300 font-bold block">5. RAB Submitted</span>
                            <span class="text-amber-400 text-[9px]">RAB-NK-001-V01</span>
                        </div>
                        <div class="bg-white/5 p-2 rounded border border-white/5">
                            <span class="text-amber-300 font-bold block">6. Control Audit</span>
                            <span class="text-amber-400 text-[9px]">Verification Active</span>
                        </div>
                    </div>
                </div>

            </section>

            <!-- ---------- 20, 21 & 30. AUDIT TRAIL & CORE MESSAGE BANNER ---------- -->
            <section class="rounded-2xl border border-emerald-500/40 bg-gradient-to-r from-[#04100B] via-[#091D13] to-[#04100B] p-6 text-center space-y-4 shadow-2xl">
                <div class="max-w-3xl mx-auto space-y-2">
                    <h3 class="text-2xl font-extrabold text-white">NINA Orchestrates Production Programs.</h3>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        NINA coordinates multiple production requirements, productive assets, production batches, partners, vendors and commercial deliveries into one controlled operational framework.
                    </p>
                    <p class="text-[11px] text-emerald-400 italic">
                        NINA mengorkestrasi seluruh program produksi — dari demand, kapasitas, project, batch, partner, vendor, execution, verification, sampai commercial delivery dan settlement.
                    </p>
                </div>

                <div class="flex flex-wrap items-center justify-center gap-3 font-mono text-xs font-bold pt-2">
                    <a href="<?= $basePrefix ?>/demand" class="rounded-lg bg-emerald-500 hover:bg-emerald-400 text-black px-5 py-2.5 uppercase shadow-lg">
                        VIEW CONNECTED REQUIREMENT
                    </a>
                    <a href="<?= $basePrefix ?>/batches" class="rounded-lg bg-white/10 hover:bg-white/20 text-white border border-white/10 px-5 py-2.5 uppercase">
                        VIEW PRODUCTION BATCHES
                    </a>
                    <a href="<?= $basePrefix ?>/production-network" class="rounded-lg bg-white/10 hover:bg-white/20 text-white border border-white/10 px-5 py-2.5 uppercase">
                        VIEW NETWORK
                    </a>
                    <a href="<?= $basePrefix ?>/audit-trail" class="rounded-lg bg-white/10 hover:bg-white/20 text-white border border-white/10 px-5 py-2.5 uppercase">
                        VIEW AUDIT TRAIL
                    </a>
                </div>
            </section>

        </div>

    </div>

</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/dashboard.php';
