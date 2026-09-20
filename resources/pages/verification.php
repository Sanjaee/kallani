<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '14 / Verification Vault — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'verification';

/* ---------- Helpers & Icons ---------- */
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

$svg = fn(string $inner, string $cls = 'w-4 h-4') =>
    '<svg class="' . $cls . '" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">' . $inner . '</svg>';

$ic = [
    'shield'   => '<path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/>',
    'check'    => '<circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 4.5-5"/>',
    'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>',
    'doc'      => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>',
    'download' => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>',
    'pin'      => '<path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="2.5"/>',
    'grid'     => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/>',
    'user'     => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
    'leaf'     => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>',
    'wallet'   => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 10h20"/><path d="M16 14h.01"/>',
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

            <div class="relative space-y-5 px-6 pt-3 pb-6 lg:px-8 lg:pt-3 lg:pb-8">

                <!-- Top Row: Breadcrumb & Right Header CTA Buttons -->
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <nav aria-label="Breadcrumb" class="inline-flex flex-wrap items-center gap-2 text-[10px] font-mono font-semibold uppercase tracking-[0.14em] text-gray-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                        <a href="<?= $basePrefix ?>/allocations" class="hover:text-white transition-colors">MY ALLOCATIONS</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/explore" class="hover:text-white transition-colors">NORTH KALIMANTAN PALM</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/batches" class="hover:text-white transition-colors">BATCH NK-001</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="font-bold text-white uppercase">VERIFICATION VAULT</span>
                    </nav>

                    <!-- Header Primary/Secondary Actions -->
                    <div class="flex flex-wrap items-center gap-2 text-[10px] font-bold">
                        <a href="#verification-matrix" class="rounded-lg bg-emerald-950/80 border border-emerald-400/40 px-3 py-1.5 text-emerald-300 hover:bg-emerald-900/80 uppercase tracking-wide">REQUEST AUDIT VERIFICATION</a>
                        <a href="<?= $basePrefix ?>/documents" class="rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10 uppercase tracking-wide">DOCUMENT VAULT</a>
                        <a href="<?= $basePrefix ?>/audit-trail" class="rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10 uppercase tracking-wide">AUDIT TRAIL LOG</a>
                    </div>
                </div>

                <!-- Headline & Subheadline -->
                <div class="space-y-3">
                    <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-200">
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">ASSURANCE PROTOCOL</span>
                        <span>14 / INDEPENDENT VERIFICATION VAULT</span>
                        <span class="rounded border border-amber-400/40 bg-amber-500/20 px-2 py-0.5 text-[9px] font-bold tracking-wider text-amber-300">DEMO / AUDITED MATRIX</span>
                    </div>

                    <h1 class="max-w-3xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">Production Verification Vault</h1>
                    
                    <p class="max-w-3xl text-sm font-medium leading-relaxed text-gray-200">
                        NINA separates identity, operational, field execution, and commercial verification so every claim has a corresponding auditable record.
                    </p>
                    <p class="text-[11px] italic text-gray-400">
                        Pemisahan verifikasi identitas, legalitas, kapasitas operasional, dan bukti eksekusi secara independen.
                    </p>
                </div>

                <!-- HERO SUMMARY CARD -->
                <div class="rounded-xl border border-white/15 bg-[#08130F]/80 p-5 shadow-2xl backdrop-blur-xl space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-white/10 pb-3">
                        <div class="flex items-center gap-3">
                            <span class="<?= $iconBox ?> h-11 w-11 text-emerald-300"><?= $svg($ic['shield'], 'w-5 h-5') ?></span>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h2 class="text-lg font-black text-white">NORTH KALIMANTAN BATCH NK-001</h2>
                                    <span class="rounded bg-amber-500/20 px-2 py-0.5 text-[8px] font-bold text-amber-300">PENDING AUDIT</span>
                                </div>
                                <div class="text-[10px] font-mono text-gray-400 mt-0.5">VERIFICATION MATRIX ID: <strong class="text-gray-200">VER-2026-NK001-MATRIX</strong></div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 text-xs">
                        <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-0.5">
                            <div class="text-[8px] font-bold uppercase text-gray-400">TOTAL DOMAINS</div>
                            <div class="font-bold text-white text-[11px]">07 Verification Domains</div>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-0.5">
                            <div class="text-[8px] font-bold uppercase text-gray-400">DEMO VERIFIED</div>
                            <div class="font-bold text-emerald-300 text-[11px]">02 Domains</div>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-0.5">
                            <div class="text-[8px] font-bold uppercase text-gray-400">PENDING AUDIT</div>
                            <div class="font-bold text-amber-300 text-[11px]">05 Domains</div>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-0.5">
                            <div class="text-[8px] font-bold uppercase text-gray-400">ASSURANCE MODEL</div>
                            <div class="font-bold text-white text-[11px]">Multi-Tier Independent</div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ================= CONTENT ================= -->
        <div class="space-y-6 px-4 pb-16 pt-6 sm:px-6 lg:px-8">

            <!-- ---------- TOP KPI STRIP (5 CARDS HORIZONTAL) ---------- -->
            <section class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-5">

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['grid']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">DOMAINS</div>
                        <div class="text-lg font-extrabold leading-tight text-white">07</div>
                        <div class="text-[8px] text-gray-400">Verification Domains</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['check']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">VERIFIED</div>
                        <div class="text-lg font-extrabold leading-tight text-emerald-300">02</div>
                        <div class="text-[8px] text-gray-400">Demo Environment</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['clock']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">PENDING</div>
                        <div class="text-lg font-extrabold leading-tight text-amber-300">05</div>
                        <div class="text-[8px] text-gray-400">Pending Review</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['shield']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">PROTOCOL</div>
                        <div class="text-sm font-extrabold leading-tight text-white">MULTI-TIER</div>
                        <div class="text-[8px] text-gray-400">Independent Assurance</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['doc']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">LAST TIMESTAMP</div>
                        <div class="text-sm font-extrabold leading-tight text-emerald-300">18 SEP 2026</div>
                        <div class="text-[8px] text-gray-400">System Recorded</div>
                    </div>
                </div>

            </section>

            <!-- ================= MAIN LAYOUT GRID (8 COLS LEFT, 4 COLS RIGHT STICKY) ================= -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 items-start">

                <!-- LEFT MAIN CONTENT (8 COLS) -->
                <div class="space-y-6 lg:col-span-8">

                    <!-- SECTION 01: MULTI-TIER VERIFICATION MATRIX TABLE -->
                    <section id="verification-matrix" class="<?= $card ?> p-5 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-white/10 pb-3">
                            <div>
                                <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">01 / AUDIT MATRIX</div>
                                <h2 class="text-base font-bold text-white">Independent Verification Domain Matrix</h2>
                                <p class="text-xs text-gray-300">Every operational domain requires third-party verification records.</p>
                            </div>
                            <span class="rounded bg-emerald-950 px-2.5 py-1 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">DEMO AUDIT MATRIX</span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs text-gray-300">
                                <thead>
                                    <tr class="border-b border-white/10 text-[9px] uppercase tracking-wider text-gray-400">
                                        <th class="py-2.5 px-3">Domain</th>
                                        <th class="py-2.5 px-3">Subject / Target</th>
                                        <th class="py-2.5 px-3">Verification Method</th>
                                        <th class="py-2.5 px-3">Assigned Auditor</th>
                                        <th class="py-2.5 px-3">Reference ID</th>
                                        <th class="py-2.5 px-3">Status</th>
                                        <th class="py-2.5 px-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5 text-[10px]">
                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-semibold text-white flex items-center gap-2">
                                            <span class="text-emerald-300"><?= $svg($ic['pin'], 'w-3.5 h-3.5') ?></span> Land & Boundary
                                        </td>
                                        <td class="py-2.5 px-3">North Kalimantan 100 HA Concession</td>
                                        <td class="py-2.5 px-3 text-gray-400">GIS & Cadastral Boundary Survey</td>
                                        <td class="py-2.5 px-3 text-gray-300">Independent GIS Auditor</td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">VER-GIS-001</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">DEMO VERIFIED</span></td>
                                        <td class="py-2.5 px-3"><a href="<?= $basePrefix ?>/documents" class="text-emerald-300 font-bold hover:underline">View File &rsaquo;</a></td>
                                    </tr>

                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-semibold text-white flex items-center gap-2">
                                            <span class="text-emerald-300"><?= $svg($ic['doc'], 'w-3.5 h-3.5') ?></span> Land Rights & Legal Title
                                        </td>
                                        <td class="py-2.5 px-3">HGU Concession Master Title</td>
                                        <td class="py-2.5 px-3 text-gray-400">Legal Counsel Document Review</td>
                                        <td class="py-2.5 px-3 text-amber-300">To be Appointed</td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">VER-LEG-002</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-amber-500/20 px-2 py-0.5 text-[8px] font-bold text-amber-300">PENDING REVIEW</span></td>
                                        <td class="py-2.5 px-3"><a href="<?= $basePrefix ?>/documents" class="text-emerald-300 font-bold hover:underline">View File &rsaquo;</a></td>
                                    </tr>

                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-semibold text-white flex items-center gap-2">
                                            <span class="text-emerald-300"><?= $svg($ic['user'], 'w-3.5 h-3.5') ?></span> Partner Reputation
                                        </td>
                                        <td class="py-2.5 px-3">Demo Production Partner</td>
                                        <td class="py-2.5 px-3 text-gray-400">Operational Capacity Audit</td>
                                        <td class="py-2.5 px-3 text-gray-300">NINA Network Operations</td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">VER-PARTNER-001</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">DEMO VERIFIED</span></td>
                                        <td class="py-2.5 px-3"><a href="<?= $basePrefix ?>/vendors" class="text-emerald-300 font-bold hover:underline">View Partner &rsaquo;</a></td>
                                    </tr>

                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-semibold text-white flex items-center gap-2">
                                            <span class="text-emerald-300"><?= $svg($ic['leaf'], 'w-3.5 h-3.5') ?></span> Certified Seed Source
                                        </td>
                                        <td class="py-2.5 px-3">Certified Superior Seed Supply</td>
                                        <td class="py-2.5 px-3 text-gray-400">Agronomy Certification Review</td>
                                        <td class="py-2.5 px-3 text-amber-300">To be Appointed</td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">VER-SEED-004</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-amber-500/20 px-2 py-0.5 text-[8px] font-bold text-amber-300">PENDING AUDIT</span></td>
                                        <td class="py-2.5 px-3"><a href="<?= $basePrefix ?>/documents" class="text-emerald-300 font-bold hover:underline">View File &rsaquo;</a></td>
                                    </tr>

                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-semibold text-white flex items-center gap-2">
                                            <span class="text-emerald-300"><?= $svg($ic['grid'], 'w-3.5 h-3.5') ?></span> Vendor Capability
                                        </td>
                                        <td class="py-2.5 px-3">Land Prep & Heavy Equipment</td>
                                        <td class="py-2.5 px-3 text-gray-400">Equipment Fleet Inspection</td>
                                        <td class="py-2.5 px-3 text-amber-300">To be Appointed</td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">VER-VEN-005</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-amber-500/20 px-2 py-0.5 text-[8px] font-bold text-amber-300">PENDING AUDIT</span></td>
                                        <td class="py-2.5 px-3"><a href="<?= $basePrefix ?>/vendors" class="text-emerald-300 font-bold hover:underline">View Vendor &rsaquo;</a></td>
                                    </tr>

                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-semibold text-white flex items-center gap-2">
                                            <span class="text-emerald-300"><?= $svg($ic['wallet'], 'w-3.5 h-3.5') ?></span> Registered Wallet
                                        </td>
                                        <td class="py-2.5 px-3">Settlement Address Authorization</td>
                                        <td class="py-2.5 px-3 text-gray-400">Entity Identity Mapping</td>
                                        <td class="py-2.5 px-3 text-gray-300">NINA Protocol Admin</td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">VER-WAL-006</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-amber-500/20 px-2 py-0.5 text-[8px] font-bold text-amber-300">PENDING MAPPING</span></td>
                                        <td class="py-2.5 px-3"><a href="<?= $basePrefix ?>/vendors" class="text-emerald-300 font-bold hover:underline">View Wallet &rsaquo;</a></td>
                                    </tr>

                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-semibold text-white flex items-center gap-2">
                                            <span class="text-emerald-300"><?= $svg($ic['shield'], 'w-3.5 h-3.5') ?></span> Environmental & ESG
                                        </td>
                                        <td class="py-2.5 px-3">RSPO / ISPO Compliance Protocol</td>
                                        <td class="py-2.5 px-3 text-gray-400">Third-Party ESG Assessment</td>
                                        <td class="py-2.5 px-3 text-amber-300">To be Appointed</td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">VER-ESG-007</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-amber-500/20 px-2 py-0.5 text-[8px] font-bold text-amber-300">PENDING ASSESSMENT</span></td>
                                        <td class="py-2.5 px-3"><a href="<?= $basePrefix ?>/documents" class="text-emerald-300 font-bold hover:underline">View File &rsaquo;</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <!-- SECTION 02: GIS BOUNDARY & SPATIAL ASSURANCE -->
                    <section class="<?= $card ?> p-5 space-y-4">
                        <div class="border-b border-white/10 pb-3 flex justify-between items-center">
                            <div>
                                <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">02 / GIS SPATIAL ASSURANCE</div>
                                <h3 class="text-base font-bold text-white">Spatial Concession & GIS Audit View</h3>
                            </div>
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">GIS VERIFIED / DEMO</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                            <div class="relative h-36 rounded-xl border border-white/15 overflow-hidden shadow-inner sm:col-span-1">
                                <img src="<?= $basePrefix ?>/7.jpg" alt="GIS View" class="h-full w-full object-cover" />
                                <div class="absolute inset-0 bg-emerald-950/20"></div>
                                <div class="absolute bottom-2 left-2 rounded bg-black/70 px-2 py-0.5 text-[8px] font-mono text-emerald-300">Polygon: 2.85°N, 116.55°E</div>
                            </div>
                            <div class="sm:col-span-2 space-y-2 text-xs">
                                <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Concession Region</span><span class="font-bold text-white">North Kalimantan, Indonesia</span></div>
                                <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Survey Area</span><span class="font-bold text-white">100 HA (Batch NK-001)</span></div>
                                <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">GIS Reference Hash</span><span class="font-mono text-emerald-300">0x2c4e6f8a...77a8</span></div>
                                <div class="flex justify-between py-1"><span class="text-gray-400">Last Survey Audit</span><span class="font-bold text-white">2026-08-18</span></div>
                            </div>
                        </div>
                    </section>

                </div>

                <!-- RIGHT STICKY SIDEBAR (4 COLS MATCHING WIREFRAME) -->
                <div class="space-y-4 lg:col-span-4 lg:sticky lg:top-4">

                    <!-- Card 1: VERIFICATION SUMMARY -->
                    <div class="<?= $card ?> p-5 space-y-4">
                        <div class="border-b border-white/10 pb-3">
                            <div class="text-[9px] font-bold uppercase tracking-wider text-emerald-300">VERIFICATION SUMMARY</div>
                            <div class="text-base font-black text-white mt-1">Batch NK-001 Vault</div>
                        </div>

                        <div class="space-y-2 text-xs">
                            <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Matrix Status</span><span class="font-bold text-amber-300">Pending Independent Audit</span></div>
                            <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Verified Domains</span><span class="font-bold text-emerald-300">02 / 07</span></div>
                            <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Assurance Model</span><span class="font-bold text-white">Multi-Tier Independent</span></div>
                            <div class="flex justify-between py-1"><span class="text-gray-400">System Record</span><span class="font-mono text-white">Verified Immutable</span></div>
                        </div>

                        <a href="<?= $basePrefix ?>/documents" class="w-full flex items-center justify-between rounded-lg border border-emerald-400/40 bg-emerald-950/80 p-2.5 text-[10px] font-bold text-emerald-300 hover:bg-emerald-900/80">
                            <span>VIEW HASHED DOCUMENTS</span><?= $arrow ?>
                        </a>
                    </div>

                    <!-- Card 2: ASSIGNED AUDITORS & ASSURERS -->
                    <div class="<?= $card ?> p-5 space-y-3">
                        <div class="border-b border-white/10 pb-2">
                            <h4 class="text-xs font-bold text-white uppercase tracking-wider">Independent Assurers</h4>
                        </div>

                        <div class="space-y-2 text-[10px]">
                            <div class="flex justify-between items-center rounded bg-white/5 p-2 border border-white/5">
                                <div><div class="font-bold text-white">Land & GIS Assurer</div><div class="text-[7.5px] text-gray-400">Independent GIS Surveyor</div></div>
                                <span class="text-emerald-300 font-bold">Appointed</span>
                            </div>
                            <div class="flex justify-between items-center rounded bg-white/5 p-2 border border-white/5">
                                <div><div class="font-bold text-white">Agronomy Auditor</div><div class="text-[7.5px] text-gray-400">Certified Seed Inspector</div></div>
                                <span class="text-amber-300 font-bold">Pending</span>
                            </div>
                            <div class="flex justify-between items-center rounded bg-white/5 p-2 border border-white/5">
                                <div><div class="font-bold text-white">Legal Counsel</div><div class="text-[7.5px] text-gray-400">Concession Title Auditor</div></div>
                                <span class="text-amber-300 font-bold">Pending</span>
                            </div>
                            <div class="flex justify-between items-center rounded bg-white/5 p-2 border border-white/5">
                                <div><div class="font-bold text-white">Settlement Auditor</div><div class="text-[7.5px] text-gray-400">Financial Transaction Auditor</div></div>
                                <span class="text-amber-300 font-bold">Pending</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: EXPORT VERIFICATION REPORT -->
                    <div class="<?= $card ?> p-4 space-y-2">
                        <div class="text-[9px] font-bold uppercase tracking-wider text-gray-400">EXPORT VERIFICATION</div>
                        <p class="text-[9px] text-gray-400">Download independent verification report.</p>
                        <button type="button" class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-950/80 border border-emerald-400/40 py-2.5 text-[10px] font-extrabold uppercase text-emerald-300 hover:bg-emerald-900/80">
                            <span>EXPORT VERIFICATION REPORT (PDF)</span><?= $svg($ic['download'], 'w-3.5 h-3.5') ?>
                        </button>
                    </div>

                </div>

            </div>

            <!-- ---------- BOTTOM FOOTER BANNER ---------- -->
            <section class="<?= $card ?> p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <span class="<?= $iconBox ?> h-12 w-12 text-emerald-300"><?= $svg($ic['shield'], 'w-6 h-6') ?></span>
                    <div>
                        <h3 class="text-base font-extrabold text-white">Trace Every Verified Operational Claim.</h3>
                        <p class="text-xs text-gray-300 mt-0.5">From land boundaries to commercial settlement, NINA ensures every claim is backed by auditable evidence.</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="<?= $basePrefix ?>/documents" class="rounded-lg bg-emerald-950/80 border border-emerald-400/40 px-4 py-2 text-xs font-bold text-emerald-300 hover:bg-emerald-900/80 uppercase">
                        DOCUMENT VAULT &rsaquo;
                    </a>
                    <a href="<?= $basePrefix ?>/audit-trail" class="rounded-lg border border-white/15 bg-white/5 px-4 py-2 text-xs font-bold text-gray-300 hover:bg-white/10 uppercase">
                        VIEW AUDIT TRAIL &rsaquo;
                    </a>
                </div>
            </section>

        </div>

    </div>

</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
