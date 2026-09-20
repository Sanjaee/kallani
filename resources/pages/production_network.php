<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$constants = $config['system_constants'] ?? [];
$demoDemand = $config['demo_demands'][0] ?? [];
$title = '17 / Production Network Control — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'network';

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

        <!-- ================= 01. PAGE HEADER & HERO SECTION ================= -->
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
                        <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors">NETWORK</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="font-bold text-white uppercase">PRODUCTION NETWORK</span>
                    </nav>

                    <div class="flex flex-wrap items-center gap-2 text-[10px] font-bold">
                        <a href="<?= $basePrefix ?>/explore" class="rounded-lg bg-emerald-950/80 border border-emerald-400/40 px-3 py-1.5 text-emerald-300 hover:bg-emerald-900/80 uppercase tracking-wide flex items-center gap-1.5">
                            <span>EXPLORE PROJECTS</span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="<?= $basePrefix ?>/demand" class="rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10 uppercase tracking-wide">DEMAND REQUIREMENTS</a>
                        <a href="<?= $basePrefix ?>/audit-trail" class="rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10 uppercase tracking-wide">AUDIT TRAIL</a>
                    </div>
                </div>

                <!-- Headline & Subheadline Grid -->
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 items-center">
                    <div class="space-y-2 lg:col-span-8">
                        <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-200">
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">NETWORK CONTROL</span>
                            <span>17 / PRODUCTION NETWORK OVERVIEW</span>
                        </div>

                        <h1 class="max-w-3xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">One Network. Multiple Production Capacities.</h1>
                        
                        <p class="max-w-3xl text-sm font-medium leading-relaxed text-gray-200">
                            NINA connects verified productive assets, production partners, vendors, production batches and commercial requirements into one operational network.
                        </p>
                        <p class="text-[11px] italic text-gray-400">
                            Satu jaringan produksi yang menghubungkan aset produktif, mitra, vendor, batch, kapasitas dan kebutuhan komersial.
                        </p>
                    </div>

                    <!-- Right Side Status Badge -->
                    <div class="lg:col-span-4">
                        <div class="space-y-3 rounded-xl border border-white/15 bg-[#08130F]/80 p-4 shadow-2xl backdrop-blur-xl">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-mono font-bold text-emerald-300">NINA NETWORK CONTROL</span>
                                <span class="rounded bg-amber-950 border border-amber-500/30 px-2 py-0.5 text-[9px] font-bold text-amber-300">DEMO NETWORK</span>
                            </div>
                            <div class="text-xs font-bold text-white">Multi-Region Production Network</div>
                            <div class="flex items-center justify-between text-[11px] font-mono border-t border-white/10 pt-2">
                                <span class="text-gray-400">Active Environment:</span>
                                <strong class="text-emerald-300 font-bold uppercase">SIMULATED DATA</strong>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ================= CONTENT WRAPPER ================= -->
        <div class="space-y-6 px-4 pb-16 pt-6 sm:px-6 lg:px-8">

            <!-- ---------- 02. HERO NETWORK ARCHITECTURE DIAGRAM ---------- -->
            <section class="<?= $card ?> p-5 space-y-3">
                <div class="flex items-center justify-between border-b border-white/10 pb-2.5">
                    <div>
                        <span class="text-[9px] font-mono text-emerald-400 font-bold uppercase tracking-wider">02 / ARCHITECTURE</span>
                        <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-white">NINA PRODUCTION NETWORK OPERATING LAYER</h3>
                    </div>
                    <span class="rounded bg-emerald-950 px-2.5 py-0.5 text-[9px] font-mono font-bold text-emerald-300 border border-emerald-500/30">OPERATIONAL ORCHESTRATION</span>
                </div>

                <!-- Network Diagram Flow Box -->
                <div class="rounded-lg border border-white/10 bg-black/50 p-4 space-y-3 font-mono text-xs text-gray-300">
                    <div class="flex justify-center">
                        <div class="px-3 py-1.5 rounded bg-emerald-950 border border-emerald-500/40 text-emerald-300 font-bold text-[11px] shadow-md">
                            COMMERCIAL DEMAND INTAKE (DR-2026-001 • 1,000 HA)
                        </div>
                    </div>
                    
                    <div class="text-center text-gray-500 text-xs font-bold">↓</div>

                    <div class="flex justify-center">
                        <div class="px-4 py-2 rounded-lg bg-gradient-to-r from-emerald-900/80 via-teal-900/80 to-emerald-900/80 border border-emerald-400/50 text-white font-extrabold text-xs shadow-xl tracking-wider uppercase text-center">
                            NINA NETWORK CONTROL LAYER (Capacity Mapping & Asset Orchestration)
                        </div>
                    </div>

                    <div class="text-center text-gray-500 text-xs font-bold">↓</div>

                    <!-- 3 Regional Branches -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-[10px]">
                        <div class="p-2.5 rounded bg-white/5 border border-white/10 space-y-1 text-center">
                            <span class="font-bold text-emerald-300 block">NORTH KALIMANTAN</span>
                            <span class="text-white block font-semibold">300 HA • 3 BATCHES</span>
                            <span class="text-[8px] text-gray-400 block">NK-001, NK-002, NK-003</span>
                        </div>
                        <div class="p-2.5 rounded bg-white/5 border border-white/10 space-y-1 text-center">
                            <span class="font-bold text-emerald-300 block">SOUTH KALIMANTAN</span>
                            <span class="text-white block font-semibold">700 HA • 7 BATCHES</span>
                            <span class="text-[8px] text-gray-400 block">SK-001 to SK-007</span>
                        </div>
                        <div class="p-2.5 rounded bg-white/5 border border-white/10 space-y-1 text-center opacity-70">
                            <span class="font-bold text-amber-300 block">EAST KALIMANTAN</span>
                            <span class="text-gray-300 block font-semibold">PIPELINE CLUSTER</span>
                            <span class="text-[8px] text-gray-500 block">Capacity Pending</span>
                        </div>
                    </div>

                    <div class="text-center text-gray-500 text-xs font-bold">↓</div>

                    <div class="flex flex-wrap items-center justify-center gap-2 text-[9px]">
                        <span class="px-2 py-1 rounded bg-white/5 border border-white/10 text-gray-300">PARTNER NETWORK</span> →
                        <span class="px-2 py-1 rounded bg-white/5 border border-white/10 text-gray-300">VENDOR MATCH</span> →
                        <span class="px-2 py-1 rounded bg-white/5 border border-white/10 text-gray-300">WORK ORDERS</span> →
                        <span class="px-2 py-1 rounded bg-white/5 border border-white/10 text-gray-300">PHYSICAL HARVEST</span> →
                        <span class="px-2 py-1 rounded bg-white/5 border border-white/10 text-gray-300">PROCESSING</span> →
                        <span class="px-2 py-1 rounded bg-emerald-950 border border-emerald-500/40 text-emerald-300 font-bold">COMMERCIAL SETTLEMENT</span>
                    </div>
                </div>
            </section>

            <!-- ---------- 03. NETWORK KPI STRIP (5 HORIZONTAL CARDS) ---------- -->
            <section class="space-y-2">
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5">

                    <!-- CARD 01: PRODUCTION CAPACITY -->
                    <div class="<?= $card ?> flex items-center gap-3 px-3.5 py-3">
                        <span class="<?= $iconBox ?> text-emerald-400"><?= $svg($ic['leaf']) ?></span>
                        <div>
                            <div class="<?= $metricLbl ?>">PRODUCTION CAPACITY</div>
                            <div class="text-lg font-extrabold text-white">10,000 HA</div>
                            <div class="text-[8px] text-gray-400 font-mono">24-month modeled target</div>
                        </div>
                    </div>

                    <!-- CARD 02: PRODUCTION BATCHES -->
                    <div class="<?= $card ?> flex items-center gap-3 px-3.5 py-3">
                        <span class="<?= $iconBox ?> text-emerald-400"><?= $svg($ic['box']) ?></span>
                        <div>
                            <div class="<?= $metricLbl ?>">PRODUCTION BATCHES</div>
                            <div class="text-lg font-extrabold text-white">100</div>
                            <div class="text-[8px] text-gray-400 font-mono">100 HA standard units</div>
                        </div>
                    </div>

                    <!-- CARD 03: PRODUCTION VALUE -->
                    <div class="<?= $card ?> flex items-center gap-3 px-3.5 py-3">
                        <span class="<?= $iconBox ?> text-emerald-400"><?= $svg($ic['dollar']) ?></span>
                        <div>
                            <div class="<?= $metricLbl ?>">PRODUCTION VALUE</div>
                            <div class="text-lg font-extrabold text-emerald-300">88,000,000 USDT</div>
                            <div class="text-[8px] text-gray-400 font-mono">Modeled requirement</div>
                        </div>
                    </div>

                    <!-- CARD 04: MINIMUM PO ALLOCATION -->
                    <div class="<?= $card ?> flex items-center gap-3 px-3.5 py-3">
                        <span class="<?= $iconBox ?> text-emerald-400"><?= $svg($ic['target']) ?></span>
                        <div>
                            <div class="<?= $metricLbl ?>">MINIMUM PO ALLOCATION</div>
                            <div class="text-lg font-extrabold text-white">8,000 USDT</div>
                            <div class="text-[8px] text-gray-400 font-mono">Per participant allocation</div>
                        </div>
                    </div>

                    <!-- CARD 05: SERVICE FEE OPPORTUNITY -->
                    <div class="<?= $card ?> flex items-center gap-3 px-3.5 py-3">
                        <span class="<?= $iconBox ?> text-emerald-400"><?= $svg($ic['dollar']) ?></span>
                        <div>
                            <div class="<?= $metricLbl ?>">SERVICE FEE OPPORTUNITY</div>
                            <div class="text-lg font-extrabold text-emerald-300">2,640,000 USDT</div>
                            <div class="text-[8px] text-gray-400 font-mono">Modeled 3% gross fee</div>
                        </div>
                    </div>

                </div>

                <div class="text-[9px] font-mono text-gray-400 italic">
                    Footnote: Target model only. Not achieved results, committed capacity, guaranteed revenue or guaranteed fee income.
                </div>
            </section>

            <!-- ---------- 19. SEARCH BAR & 20. FACT-BASED FILTERS ---------- -->
            <section class="<?= $card ?> p-4 space-y-3">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <!-- Search Input -->
                    <div class="relative flex-1">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400"><?= $svg($ic['search'], 'w-4 h-4') ?></span>
                        <input type="text" placeholder="Search project, partner, vendor, batch, requirement or entity... (e.g. 'NK-001', 'PT-NINA-PARTNER-001', 'DR-2026-001')" class="w-full rounded-lg border border-white/10 bg-black/40 pl-9 pr-4 py-2 text-xs font-mono text-white placeholder-gray-500 focus:outline-none focus:border-emerald-400" />
                    </div>

                    <!-- Quick Filter Buttons -->
                    <div class="flex flex-wrap items-center gap-2 text-xs font-mono">
                        <button type="button" class="rounded bg-emerald-950 px-3 py-1.5 text-emerald-300 border border-emerald-400/40 font-bold">ALL REGIONS</button>
                        <button type="button" class="rounded bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10">North Kalimantan (300 HA)</button>
                        <button type="button" class="rounded bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10">South Kalimantan (700 HA)</button>
                        <button type="button" class="rounded bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10">East Kalimantan (Pipeline)</button>
                    </div>
                </div>
            </section>

            <!-- ---------- 04. NETWORK STATUS (4 CARDS) & 22. CONTROL STATUS ---------- -->
            <section class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                
                <div class="<?= $card ?> p-4 space-y-1">
                    <div class="<?= $metricLbl ?>">MAPPED CAPACITY</div>
                    <div class="text-xl font-extrabold text-emerald-300">1,000 HA</div>
                    <div class="text-[9px] text-gray-400 font-mono">Connected to current demo requirement</div>
                </div>

                <div class="<?= $card ?> p-4 space-y-1">
                    <div class="<?= $metricLbl ?>">PRODUCTION BATCHES</div>
                    <div class="text-xl font-extrabold text-white">10 BATCHES</div>
                    <div class="text-[9px] text-gray-400 font-mono">100 HA standard units</div>
                </div>

                <div class="<?= $card ?> p-4 space-y-1">
                    <div class="<?= $metricLbl ?>">VERIFIED PARTNERS</div>
                    <div class="text-xl font-extrabold text-amber-300">—</div>
                    <div class="text-[9px] text-amber-300 font-mono">Verification data pending</div>
                </div>

                <div class="<?= $card ?> p-4 space-y-1">
                    <div class="<?= $metricLbl ?>">ACTIVE VENDORS</div>
                    <div class="text-xl font-extrabold text-amber-300">—</div>
                    <div class="text-[9px] text-amber-300 font-mono">Vendor network under config</div>
                </div>

            </section>

            <!-- ---------- 05. DEMAND → CAPACITY NETWORK & 06. REGIONAL PRODUCTION NETWORK ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-12">

                <!-- 05 / DEMAND DRIVES NETWORK ALLOCATION (6 cols) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">05 / DEMAND DRIVES NETWORK ALLOCATION</h3>
                            <p class="text-[10px] text-gray-400">Demand mapping across regional production network</p>
                        </div>
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">100% MAPPED</span>
                    </div>

                    <div class="rounded-lg border border-white/10 bg-black/40 p-4 space-y-3 font-mono text-xs">
                        <div class="flex items-center justify-between border-b border-white/10 pb-2">
                            <div>
                                <span class="text-[9px] text-gray-400 block">Requirement ID</span>
                                <strong class="text-emerald-300">DR-2026-001 (Demo Offtake)</strong>
                            </div>
                            <div class="text-right">
                                <span class="text-[9px] text-gray-400 block">Required Capacity</span>
                                <strong class="text-white">1,000 HA</strong>
                            </div>
                        </div>

                        <div class="space-y-1.5 text-[11px]">
                            <div class="flex justify-between"><span>North Kalimantan Cluster</span><strong class="text-white">300 HA</strong></div>
                            <div class="flex justify-between"><span>South Kalimantan Cluster</span><strong class="text-white">700 HA</strong></div>
                            <div class="flex justify-between border-t border-white/10 pt-1.5 text-emerald-300 font-bold"><span>Total Network Mapped</span><span>1,000 HA</span></div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-1">
                        <span class="text-[10px] font-mono text-gray-400">Structure: <strong class="text-white">10 × 100 HA Executable Batches</strong></span>
                        <a href="<?= $basePrefix ?>/capacity" class="inline-flex items-center gap-1.5 rounded bg-emerald-950 px-3 py-1.5 text-[10px] font-mono font-bold text-emerald-300 border border-emerald-400/40 hover:bg-emerald-900 transition">
                            <span>VIEW CAPACITY MAP</span><?= $svg($ic['arrow'], 'w-3 h-3') ?>
                        </a>
                    </div>
                </div>

                <!-- 06 / REGIONAL PRODUCTION CLUSTERS (6 cols) -->
                <div class="lg:col-span-6 <?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">06 / REGIONAL PRODUCTION CLUSTERS</h3>
                            <p class="text-[10px] text-gray-400">Regional capacity allocation cards</p>
                        </div>
                        <span class="rounded bg-white/5 px-2 py-0.5 text-[9px] text-gray-300">3 REGIONS</span>
                    </div>

                    <div class="grid grid-cols-1 gap-2.5 sm:grid-cols-3 text-xs font-mono">
                        
                        <!-- North Kalimantan -->
                        <div class="rounded-lg border border-emerald-500/30 bg-emerald-950/40 p-3 space-y-2 flex flex-col justify-between">
                            <div>
                                <span class="text-[9px] font-bold text-emerald-300 uppercase block">NORTH KALIMANTAN</span>
                                <div class="text-base font-extrabold text-white mt-1">300 HA</div>
                                <div class="text-[9px] text-gray-300 mt-1">Palm Production</div>
                                <div class="text-[9px] text-gray-400">Standard Batch: 100 HA</div>
                            </div>
                            <a href="<?= $basePrefix ?>/explore" class="text-[9px] font-bold text-emerald-300 hover:underline flex items-center gap-1 pt-2">
                                <span>VIEW REGION</span><?= $svg($ic['arrow'], 'w-2.5 h-2.5') ?>
                            </a>
                        </div>

                        <!-- South Kalimantan -->
                        <div class="rounded-lg border border-emerald-500/30 bg-emerald-950/40 p-3 space-y-2 flex flex-col justify-between">
                            <div>
                                <span class="text-[9px] font-bold text-emerald-300 uppercase block">SOUTH KALIMANTAN</span>
                                <div class="text-base font-extrabold text-white mt-1">700 HA</div>
                                <div class="text-[9px] text-gray-300 mt-1">Palm Production</div>
                                <div class="text-[9px] text-gray-400">Standard Batch: 100 HA</div>
                            </div>
                            <a href="<?= $basePrefix ?>/explore" class="text-[9px] font-bold text-emerald-300 hover:underline flex items-center gap-1 pt-2">
                                <span>VIEW REGION</span><?= $svg($ic['arrow'], 'w-2.5 h-2.5') ?>
                            </a>
                        </div>

                        <!-- East Kalimantan -->
                        <div class="rounded-lg border border-white/10 bg-white/5 p-3 space-y-2 flex flex-col justify-between">
                            <div>
                                <span class="text-[9px] font-bold text-amber-300 uppercase block">EAST KALIMANTAN</span>
                                <div class="text-xs font-bold text-gray-400 mt-1">PIPELINE</div>
                                <div class="text-[9px] text-gray-400 mt-1">Capacity Pending</div>
                            </div>
                            <span class="text-[9px] text-gray-500">VIEW PIPELINE</span>
                        </div>

                    </div>
                </div>

            </section>

            <!-- ---------- 07. EXECUTABLE PRODUCTION BATCHES GRID ---------- -->
            <section class="<?= $card ?> p-5 space-y-4">
                <div class="flex items-center justify-between border-b border-white/10 pb-3">
                    <div>
                        <h3 class="text-xs font-mono font-bold uppercase text-white">07 / EXECUTABLE PRODUCTION BATCHES</h3>
                        <p class="text-[10px] text-gray-400">Network capacity converted into 100 HA standardized production units</p>
                    </div>
                    <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">10 BATCHES</span>
                </div>

                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4 text-xs font-mono">
                    
                    <div class="rounded-lg border border-emerald-500/40 bg-emerald-950/60 p-3.5 space-y-2">
                        <div class="flex justify-between items-center"><strong class="text-white text-sm">NK-001</strong><span class="text-[9px] px-1.5 py-0.5 rounded bg-amber-950 text-amber-300 font-bold">DEMO / PENDING VERIF</span></div>
                        <div class="text-gray-300 text-[11px]">100 HA &bull; North Kalimantan</div>
                        <div class="text-emerald-300 font-bold">880,000 USDT Modeled Requirement</div>
                        <a href="<?= $basePrefix ?>/batches" class="text-[9px] font-bold text-emerald-300 hover:underline block pt-1">VIEW BATCH DETAILS &rarr;</a>
                    </div>

                    <div class="rounded-lg border border-white/10 bg-white/5 p-3.5 space-y-2">
                        <div class="flex justify-between items-center"><strong class="text-white text-sm">NK-002</strong><span class="text-[9px] px-1.5 py-0.5 rounded bg-white/5 text-gray-400">PIPELINE</span></div>
                        <div class="text-gray-300 text-[11px]">100 HA &bull; North Kalimantan</div>
                        <div class="text-gray-400">880,000 USDT Modeled Requirement</div>
                        <span class="text-[9px] text-gray-500 block pt-1">PIPELINE BATCH</span>
                    </div>

                    <div class="rounded-lg border border-emerald-500/30 bg-emerald-950/30 p-3.5 space-y-2">
                        <div class="flex justify-between items-center"><strong class="text-white text-sm">SK-001</strong><span class="text-[9px] px-1.5 py-0.5 rounded bg-emerald-950 text-emerald-300 font-bold">MAPPED / DEMO</span></div>
                        <div class="text-gray-300 text-[11px]">100 HA &bull; South Kalimantan</div>
                        <div class="text-emerald-300 font-bold">880,000 USDT Modeled Requirement</div>
                        <span class="text-[9px] text-emerald-300 block pt-1">MAPPED CAPACITY</span>
                    </div>

                    <div class="rounded-lg border border-white/10 bg-white/5 p-3.5 space-y-2">
                        <div class="flex justify-between items-center"><strong class="text-white text-sm">SK-002</strong><span class="text-[9px] px-1.5 py-0.5 rounded bg-white/5 text-gray-400">PIPELINE</span></div>
                        <div class="text-gray-300 text-[11px]">100 HA &bull; South Kalimantan</div>
                        <div class="text-gray-400">880,000 USDT Modeled Requirement</div>
                        <span class="text-[9px] text-gray-500 block pt-1">PIPELINE BATCH</span>
                    </div>

                </div>
            </section>

            <!-- ---------- 08. PARTNER NETWORK & 09. CAPACITY TIERS ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-12">

                <!-- 08 / PRODUCTION PARTNER NETWORK (7 cols) -->
                <div class="lg:col-span-7 <?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">08 / PRODUCTION PARTNER NETWORK</h3>
                            <p class="text-[10px] text-gray-400">Identified production partners with capacity & execution history</p>
                        </div>
                        <span class="rounded bg-white/5 px-2 py-0.5 text-[9px] text-gray-300">PARTNERS</span>
                    </div>

                    <table class="w-full text-left text-xs font-mono">
                        <thead>
                            <tr class="border-b border-white/10 text-gray-400 text-[10px] uppercase">
                                <th class="py-2 px-2">Partner Entity</th>
                                <th class="py-2 px-2">Region</th>
                                <th class="py-2 px-2">Capacity</th>
                                <th class="py-2 px-2">Status</th>
                                <th class="py-2 px-2">Reputation</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5 text-gray-200">
                            <tr>
                                <td class="py-2.5 px-2 font-bold text-white">Demo Production Partner</td>
                                <td class="py-2.5 px-2">North Kalimantan</td>
                                <td class="py-2.5 px-2 text-emerald-300 font-bold">300 HA</td>
                                <td class="py-2.5 px-2 text-amber-300">Pending Verification</td>
                                <td class="py-2.5 px-2 text-gray-400 text-[10px]">Not Established</td>
                            </tr>
                            <tr>
                                <td class="py-2.5 px-2 font-bold text-white">Production Partner 02</td>
                                <td class="py-2.5 px-2">South Kalimantan</td>
                                <td class="py-2.5 px-2 text-emerald-300 font-bold">700 HA</td>
                                <td class="py-2.5 px-2 text-amber-300">Pending Verification</td>
                                <td class="py-2.5 px-2 text-gray-400 text-[10px]">Not Established</td>
                            </tr>
                            <tr>
                                <td class="py-2.5 px-2 font-bold text-white">Partner 03</td>
                                <td class="py-2.5 px-2">East Kalimantan</td>
                                <td class="py-2.5 px-2 text-gray-400">—</td>
                                <td class="py-2.5 px-2 text-gray-400">Pipeline</td>
                                <td class="py-2.5 px-2 text-gray-400 text-[10px]">Not Established</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- 09 / PRODUCTION CAPACITY TIERS (5 cols) -->
                <div class="lg:col-span-5 <?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">09 / PRODUCTION CAPACITY TIERS</h3>
                            <p class="text-[10px] text-gray-400">Classified by verified operational capacity</p>
                        </div>
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">TIERS</span>
                    </div>

                    <div class="grid grid-cols-2 gap-2 text-xs font-mono">
                        <div class="p-2.5 rounded bg-white/5 border border-white/10 space-y-1">
                            <span class="text-[9px] text-gray-400 block font-bold">SILVER</span>
                            <strong class="text-white text-sm">100 HA</strong>
                            <span class="text-[8px] text-gray-400 block">Verified Capacity</span>
                        </div>

                        <div class="p-2.5 rounded bg-emerald-950/60 border border-emerald-500/40 space-y-1">
                            <span class="text-[9px] text-emerald-300 block font-bold">GOLD</span>
                            <strong class="text-white text-sm">1,000 HA</strong>
                            <span class="text-[8px] text-emerald-300 block">Verified Capacity</span>
                        </div>

                        <div class="p-2.5 rounded bg-white/5 border border-white/10 space-y-1">
                            <span class="text-[9px] text-amber-300 block font-bold">PLATINUM</span>
                            <strong class="text-white text-sm">10,000 HA</strong>
                            <span class="text-[8px] text-gray-400 block">Verified Capacity</span>
                        </div>

                        <div class="p-2.5 rounded bg-white/5 border border-white/10 space-y-1">
                            <span class="text-[9px] text-gray-400 block font-bold">INSTITUTIONAL</span>
                            <strong class="text-white text-sm">&gt; 10,000 HA</strong>
                            <span class="text-[8px] text-gray-400 block">Verified Capacity</span>
                        </div>
                    </div>

                    <div class="text-[8px] font-mono text-gray-400 italic">
                        Note: Tier classification is based on verified production capacity and operational history, not investment amount or projected return.
                    </div>
                </div>

            </section>

            <!-- ---------- 10. VENDOR NETWORK & 12. RAB → VENDOR MATCH ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-12">

                <!-- 10 / OPERATIONAL VENDOR NETWORK (7 cols) -->
                <div class="lg:col-span-7 <?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">10 / OPERATIONAL VENDOR NETWORK</h3>
                            <p class="text-[10px] text-gray-400">Approved operational requirements connected with capable vendors</p>
                        </div>
                        <a href="<?= $basePrefix ?>/vendors" class="text-[10px] font-mono text-emerald-300 font-bold hover:underline">VIEW ALL VENDORS →</a>
                    </div>

                    <div class="grid grid-cols-2 gap-2.5 sm:grid-cols-3 text-xs font-mono">
                        <div class="p-2.5 rounded bg-white/5 border border-white/10 space-y-1">
                            <span class="text-[9px] text-emerald-300 font-bold block">SEED & PLANTING</span>
                            <span class="text-white text-[11px] block">Certified Seeds</span>
                            <span class="text-[8px] text-gray-400 block">Status: Verified</span>
                        </div>
                        <div class="p-2.5 rounded bg-white/5 border border-white/10 space-y-1">
                            <span class="text-[9px] text-emerald-300 font-bold block">FERTILIZER & INPUTS</span>
                            <span class="text-white text-[11px] block">Agronomic Inputs</span>
                            <span class="text-[8px] text-gray-400 block">Status: Verified</span>
                        </div>
                        <div class="p-2.5 rounded bg-white/5 border border-white/10 space-y-1">
                            <span class="text-[9px] text-emerald-300 font-bold block">HEAVY EQUIPMENT</span>
                            <span class="text-white text-[11px] block">Land Preparation</span>
                            <span class="text-[8px] text-gray-400 block">Status: Verified</span>
                        </div>
                        <div class="p-2.5 rounded bg-white/5 border border-white/10 space-y-1">
                            <span class="text-[9px] text-emerald-300 font-bold block">INFRASTRUCTURE</span>
                            <span class="text-white text-[11px] block">Roads & Drainage</span>
                            <span class="text-[8px] text-gray-400 block">Status: Verified</span>
                        </div>
                        <div class="p-2.5 rounded bg-white/5 border border-white/10 space-y-1">
                            <span class="text-[9px] text-emerald-300 font-bold block">LOGISTICS</span>
                            <span class="text-white text-[11px] block">Transport & Delivery</span>
                            <span class="text-[8px] text-gray-400 block">Status: Verified</span>
                        </div>
                        <div class="p-2.5 rounded bg-white/5 border border-white/10 space-y-1">
                            <span class="text-[9px] text-emerald-300 font-bold block">PROCESSING</span>
                            <span class="text-white text-[11px] block">Milling Partner</span>
                            <span class="text-[8px] text-gray-400 block">Status: Verified</span>
                        </div>
                    </div>
                </div>

                <!-- 12 / RAB → VENDOR MATCH (5 cols) -->
                <div class="lg:col-span-5 <?= $card ?> p-5 space-y-4 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between border-b border-white/10 pb-3">
                            <h3 class="text-xs font-mono font-bold uppercase text-white">12 / RAB → VENDOR FLOW</h3>
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-mono text-emerald-300 border border-emerald-500/30">WORK ORDERS</span>
                        </div>

                        <div class="flex flex-wrap items-center gap-1.5 text-[9px] font-mono text-gray-300 pt-2">
                            <span class="px-1.5 py-0.5 bg-emerald-950 text-emerald-300 rounded">BATCH NK-001</span> →
                            <span class="px-1.5 py-0.5 bg-white/5 rounded">RAB CATEGORY</span> →
                            <span class="px-1.5 py-0.5 bg-white/5 rounded">VENDOR MATCH</span> →
                            <span class="px-1.5 py-0.5 bg-white/5 rounded">WORK ORDER</span> →
                            <span class="px-1.5 py-0.5 bg-emerald-950 text-emerald-300 rounded font-bold">VERIFICATION</span>
                        </div>
                    </div>

                    <a href="<?= $basePrefix ?>/rab" class="inline-flex items-center justify-center gap-2 rounded bg-emerald-950 px-4 py-2 text-xs font-mono font-bold text-emerald-300 border border-emerald-400/40 hover:bg-emerald-900 transition">
                        <span>VIEW RAB BUDGET STRUCTURE</span><?= $svg($ic['arrow'], 'w-3.5 h-3.5') ?>
                    </a>
                </div>

            </section>

            <!-- ---------- 13. WALLET / ENTITY NETWORK & 14. TRANSACTION FLOW ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                <!-- 13 / VERIFIED ENTITY NETWORK -->
                <div class="<?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">13 / VERIFIED ENTITY NETWORK</h3>
                            <p class="text-[10px] text-gray-400">Approved participant, partner & vendor identity records</p>
                        </div>
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-mono text-emerald-300 border border-emerald-500/30">GOVERNANCE</span>
                    </div>

                    <div class="flex items-center gap-2 text-[10px] font-mono text-gray-300">
                        <span class="px-2 py-1 bg-white/5 rounded">ENTITY RECORD</span> →
                        <span class="px-2 py-1 bg-white/5 rounded">IDENTITY VERIFICATION</span> →
                        <span class="px-2 py-1 bg-white/5 rounded">REGISTERED WALLET</span> →
                        <span class="px-2 py-1 bg-emerald-950 text-emerald-300 rounded font-bold">AUDIT RECORD</span>
                    </div>
                </div>

                <!-- 14 / TRANSACTION FLOW -->
                <div class="<?= $card ?> p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">14 / NETWORK TRANSACTION FLOW</h3>
                            <p class="text-[10px] text-gray-400">Operational transaction records linked to production activities</p>
                        </div>
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-mono text-emerald-300 border border-emerald-500/30">OPERATIONAL LINK</span>
                    </div>

                    <div class="flex flex-wrap items-center gap-1.5 text-[8px] font-mono text-gray-300">
                        <span class="px-1.5 py-0.5 bg-white/5 rounded">RAB ALLOCATION</span> →
                        <span class="px-1.5 py-0.5 bg-white/5 rounded">VENDOR MATCH</span> →
                        <span class="px-1.5 py-0.5 bg-white/5 rounded">WORK ORDER</span> →
                        <span class="px-1.5 py-0.5 bg-white/5 rounded">EXECUTION</span> →
                        <span class="px-1.5 py-0.5 bg-white/5 rounded">VERIFICATION</span> →
                        <span class="px-1.5 py-0.5 bg-emerald-950 text-emerald-300 rounded font-bold">AUDIT TRAIL</span>
                    </div>
                </div>

            </section>

            <!-- ---------- 23. 24-MONTH NETWORK TARGET & 24. EXPANSION LOGIC ---------- -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                <!-- 23 / 24-MONTH NETWORK TARGET -->
                <div class="<?= $card ?> p-5 space-y-4 border-l-4 border-l-emerald-400">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div>
                            <h3 class="text-xs font-mono font-bold uppercase text-white">23 / 24-MONTH NETWORK TARGET SCENARIO</h3>
                            <p class="text-[10px] text-gray-400">Scale target narrative based on 100 HA standard batch model</p>
                        </div>
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300">SCALE SCENARIO</span>
                    </div>

                    <div class="grid grid-cols-2 gap-3 text-xs font-mono">
                        <div class="p-3 rounded bg-white/5 border border-white/10 space-y-1">
                            <span class="text-[9px] text-gray-400 block">TARGET CAPACITY</span>
                            <strong class="text-2xl font-extrabold text-white">10,000 HA</strong>
                        </div>
                        <div class="p-3 rounded bg-white/5 border border-white/10 space-y-1">
                            <span class="text-[9px] text-gray-400 block">STANDARD BATCHES</span>
                            <strong class="text-2xl font-extrabold text-white">100 BATCHES</strong>
                        </div>
                        <div class="p-3 rounded bg-white/5 border border-white/10 space-y-1">
                            <span class="text-[9px] text-gray-400 block">PRODUCTION VALUE</span>
                            <strong class="text-xl font-extrabold text-emerald-300">88,000,000 USDT</strong>
                        </div>
                        <div class="p-3 rounded bg-white/5 border border-white/10 space-y-1">
                            <span class="text-[9px] text-gray-400 block">SERVICE FEE OPPORTUNITY</span>
                            <strong class="text-xl font-extrabold text-emerald-300">2,640,000 USDT</strong>
                        </div>
                    </div>

                    <div class="text-[8px] font-mono text-gray-400 italic">
                        Footnote: Modelled target based on 100 HA standard batches at 880,000 USDT modeled production requirement per batch. Target scenario, not achieved production, committed capacity or guaranteed revenue.
                    </div>
                </div>

                <!-- 24 / NETWORK EXPANSION LOGIC & 25 / INSTITUTIONAL LAYER -->
                <div class="<?= $card ?> p-5 space-y-4 border-l-4 border-l-emerald-400 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between border-b border-white/10 pb-3">
                            <div>
                                <h3 class="text-xs font-mono font-bold uppercase text-white">24 / NETWORK EXPANSION LOGIC</h3>
                                <p class="text-[10px] text-gray-400">Standardized protocol scaling across multiple regions</p>
                            </div>
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-mono text-emerald-300 border border-emerald-500/30">SCALABLE PROTOCOL</span>
                        </div>

                        <div class="flex items-center gap-2 pt-3 text-[11px] font-mono text-white justify-between">
                            <div class="p-2 rounded bg-white/5 text-center flex-1"><strong class="block text-emerald-300">100 HA</strong><span class="text-[8px] text-gray-400">1 BATCH</span></div>
                            <span>→</span>
                            <div class="p-2 rounded bg-white/5 text-center flex-1"><strong class="block text-emerald-300">1,000 HA</strong><span class="text-[8px] text-gray-400">10 BATCHES</span></div>
                            <span>→</span>
                            <div class="p-2 rounded bg-emerald-950 border border-emerald-500/40 text-center flex-1"><strong class="block text-emerald-300">10,000 HA</strong><span class="text-[8px] text-emerald-300 font-bold">100 BATCHES</span></div>
                        </div>
                    </div>

                    <div class="rounded bg-black/40 border border-white/10 p-3 text-[10px] font-mono text-gray-300 leading-relaxed">
                        Standardization enables NINA to scale the same operating protocol across multiple productive assets and regions.
                    </div>
                </div>

            </section>

            <!-- ---------- 26. FINAL NETWORK CTA & 27. FOOTER MESSAGE ---------- -->
            <section class="rounded-xl border border-emerald-500/40 bg-gradient-to-r from-emerald-950/80 via-[#0B1815] to-[#04100B] p-6 text-center space-y-3 shadow-2xl">
                <h2 class="text-xl font-extrabold text-white">Explore the Production Network.</h2>
                
                <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                    <a href="<?= $basePrefix ?>/explore" class="rounded-lg bg-gradient-to-r from-[#6EE7B7] to-[#C9F5DE] px-6 py-2.5 text-xs font-mono font-bold uppercase tracking-wider text-[#04100B] shadow-lg shadow-emerald-950/40 hover:brightness-110 transition">
                        EXPLORE PROJECTS →
                    </a>
                    <a href="<?= $basePrefix ?>/demand" class="rounded-lg border border-white/30 bg-black/30 px-6 py-2.5 text-xs font-mono font-bold uppercase tracking-wider text-white hover:bg-white/10 transition">
                        VIEW PRODUCTION REQUIREMENTS
                    </a>
                    <a href="<?= $basePrefix ?>/audit-trail" class="rounded-lg border border-white/30 bg-black/30 px-6 py-2.5 text-xs font-mono font-bold uppercase tracking-wider text-white hover:bg-white/10 transition">
                        VIEW NETWORK ACTIVITY
                    </a>
                </div>

                <div class="pt-4 border-t border-white/10 text-[11px] font-mono text-gray-300">
                    NINA is the operating layer between demand and productive execution.
                    <div class="text-[9px] text-gray-400 mt-1 uppercase tracking-widest">
                        Demand → Capacity → Batch → PO Allocation → Milestone → RAB → Vendor → Execution → Verification → Processing → Delivery → Settlement → Completion.
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
