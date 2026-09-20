<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '20 / Audit Trail — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'audit';

/* ---------- Helpers & Icons ---------- */
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

$svg = fn(string $inner, string $cls = 'w-4 h-4') =>
    '<svg class="' . $cls . '" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">' . $inner . '</svg>';

$ic = [
    'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>',
    'check'    => '<circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 4.5-5"/>',
    'shield'   => '<path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/>',
    'doc'      => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>',
    'download' => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>',
    'search'   => '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>',
    'grid'     => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/>',
    'user'     => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
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
                        <span class="font-bold text-white uppercase">AUDIT TRAIL</span>
                    </nav>

                    <!-- Header Primary/Secondary Actions -->
                    <div class="flex flex-wrap items-center gap-2 text-[10px] font-bold">
                        <a href="#audit-log-table" class="rounded-lg bg-emerald-950/80 border border-emerald-400/40 px-3 py-1.5 text-emerald-300 hover:bg-emerald-900/80 uppercase tracking-wide">FILTER AUDIT LOGS</a>
                        <a href="<?= $basePrefix ?>/documents" class="rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10 uppercase tracking-wide">DOCUMENT VAULT</a>
                        <a href="<?= $basePrefix ?>/verification" class="rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10 uppercase tracking-wide">VERIFICATION VAULT</a>
                    </div>
                </div>

                <!-- Headline & Subheadline -->
                <div class="space-y-3">
                    <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-200">
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">PROTOCOL AUDIT TRAIL</span>
                        <span>20 / PROTOCOL AUDIT TRAIL</span>
                        <span class="rounded border border-amber-400/40 bg-amber-500/20 px-2 py-0.5 text-[9px] font-bold tracking-wider text-amber-300">IMMUTABLE LEDGER / DEMO</span>
                    </div>

                    <h1 class="max-w-3xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">System Audit Trail & Event Ledger</h1>
                    
                    <p class="max-w-3xl text-sm font-medium leading-relaxed text-gray-200">
                        Immutable chronological event log recording every material action across the entire production lifecycle.
                    </p>
                    <p class="text-[11px] italic text-gray-400">
                        Jejak audit permanen yang mencatat setiap kejadian dari alokasi kebutuhan buyer hingga penyelesaian komersial.
                    </p>
                </div>

                <!-- HERO SUMMARY CARD -->
                <div class="rounded-xl border border-white/15 bg-[#08130F]/80 p-5 shadow-2xl backdrop-blur-xl space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-white/10 pb-3">
                        <div class="flex items-center gap-3">
                            <span class="<?= $iconBox ?> h-11 w-11 text-emerald-300"><?= $svg($ic['clock'], 'w-5 h-5') ?></span>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h2 class="text-lg font-black text-white">NORTH KALIMANTAN PROTOCOL AUDIT TRAIL</h2>
                                    <span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">CHAIN VALID</span>
                                </div>
                                <div class="text-[10px] font-mono text-gray-400 mt-0.5">LEDGER ID: <strong class="text-gray-200">AUD-LEDGER-NK001-2026</strong></div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 text-xs">
                        <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-0.5">
                            <div class="text-[8px] font-bold uppercase text-gray-400">TOTAL LOGGED EVENTS</div>
                            <div class="font-bold text-white text-[11px]">14 Events Recorded</div>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-0.5">
                            <div class="text-[8px] font-bold uppercase text-gray-400">LIFECYCLE COVERAGE</div>
                            <div class="font-bold text-emerald-300 text-[11px]">12 / 12 Stages</div>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-0.5">
                            <div class="text-[8px] font-bold uppercase text-gray-400">ACTOR ENTITIES</div>
                            <div class="font-bold text-white text-[11px]">05 Actor Roles</div>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-0.5">
                            <div class="text-[8px] font-bold uppercase text-gray-400">CHAIN INTEGRITY</div>
                            <div class="font-bold text-emerald-300 text-[11px]">Unbroken Ledger</div>
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
                    <span class="<?= $iconBox ?>"><?= $svg($ic['clock']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">LOGGED EVENTS</div>
                        <div class="text-lg font-extrabold leading-tight text-white">14</div>
                        <div class="text-[8px] text-gray-400">Chronological Events</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['grid']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">STAGES COVERED</div>
                        <div class="text-lg font-extrabold leading-tight text-emerald-300">12 / 12</div>
                        <div class="text-[8px] text-gray-400">Full Lifecycle</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['user']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">ACTOR ENTITIES</div>
                        <div class="text-lg font-extrabold leading-tight text-white">05</div>
                        <div class="text-[8px] text-gray-400">Buyer, Ops, Partner, Vendor, Verifier</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['shield']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">INTEGRITY</div>
                        <div class="text-sm font-extrabold leading-tight text-emerald-300">VALID</div>
                        <div class="text-[8px] text-gray-400">Unbroken Chain</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['check']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">LAST EVENT</div>
                        <div class="text-sm font-extrabold leading-tight text-white">20 SEP 2026</div>
                        <div class="text-[8px] text-gray-400">14:32 WIB Recorded</div>
                    </div>
                </div>

            </section>

            <!-- ================= MAIN LAYOUT GRID (8 COLS LEFT, 4 COLS RIGHT STICKY) ================= -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 items-start">

                <!-- LEFT MAIN CONTENT (8 COLS) -->
                <div class="space-y-6 lg:col-span-8">

                    <!-- SECTION 01: PROTOCOL LIFECYCLE SEQUENCE BANNER -->
                    <section class="<?= $card ?> p-4 space-y-3">
                        <div class="border-b border-white/10 pb-2 flex justify-between items-center">
                            <div>
                                <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">01 / LIFECYCLE SEQUENCE</div>
                                <h3 class="text-xs font-bold text-white">NINA Protocol Audit Chain</h3>
                            </div>
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">12 STAGES</span>
                        </div>

                        <div class="flex flex-wrap items-center gap-1.5 text-[8px] font-mono text-gray-300 bg-black/40 p-3 rounded-lg border border-white/5">
                            <span class="text-emerald-300 font-bold">01 DEMAND</span> &rsaquo;
                            <span class="text-emerald-300 font-bold">02 CAPACITY</span> &rsaquo;
                            <span class="text-emerald-300 font-bold">03 BATCH</span> &rsaquo;
                            <span class="text-emerald-300 font-bold">04 PO ALLOCATION</span> &rsaquo;
                            <span class="text-emerald-300 font-bold">05 MILESTONE</span> &rsaquo;
                            <span class="text-emerald-300 font-bold">06 RAB</span> &rsaquo;
                            <span class="text-emerald-300 font-bold">07 VENDOR</span> &rsaquo;
                            <span class="text-amber-300 font-bold">08 EXECUTION</span> &rsaquo;
                            <span class="text-gray-400">09 VERIFICATION</span> &rsaquo;
                            <span class="text-gray-500">10 PROCESSING</span> &rsaquo;
                            <span class="text-gray-500">11 DELIVERY</span> &rsaquo;
                            <span class="text-gray-500">12 SETTLEMENT</span>
                        </div>
                    </section>

                    <!-- SECTION 02: AUDIT LOG MASTER TABLE & TIMELINE -->
                    <section id="audit-log-table" class="<?= $card ?> p-5 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-white/10 pb-3">
                            <div>
                                <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">02 / IMMUTABLE LOG</div>
                                <h2 class="text-base font-bold text-white">Chronological System Event Ledger</h2>
                                <p class="text-xs text-gray-300">Every operational action generates a timestamped, actor-attributed event log.</p>
                            </div>
                            <span class="rounded bg-emerald-950 px-2.5 py-1 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">AUDITED LEDGER</span>
                        </div>

                        <!-- Search & Filter Controls -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 text-xs">
                            <div class="sm:col-span-2 relative">
                                <input type="text" placeholder="Search event ID, actor, stage, or reference ID..." class="w-full rounded-lg border border-white/10 bg-[#07110E] px-3 py-1.5 text-xs text-white focus:outline-none focus:border-emerald-400" />
                            </div>
                            <div>
                                <select class="w-full rounded-lg border border-white/10 bg-[#07110E] px-2 py-1.5 text-xs text-gray-300">
                                    <option>Actor: All Entities</option>
                                    <option>NINA Operations</option>
                                    <option>Demo Offtake Buyer</option>
                                    <option>Demo Production Partner</option>
                                    <option>Verified Participant</option>
                                    <option>NINA Verifier</option>
                                </select>
                            </div>
                        </div>

                        <!-- Audit Ledger Master Table -->
                        <div classOverflow-x-auto>
                            <table class="w-full text-left text-xs text-gray-300">
                                <thead>
                                    <tr class="border-b border-white/10 text-[9px] uppercase tracking-wider text-gray-400">
                                        <th class="py-2.5 px-3">Timestamp</th>
                                        <th class="py-2.5 px-3">Event ID</th>
                                        <th class="py-2.5 px-3">Actor Entity</th>
                                        <th class="py-2.5 px-3">Lifecycle Stage</th>
                                        <th class="py-2.5 px-3">Event Summary</th>
                                        <th class="py-2.5 px-3">Reference ID</th>
                                        <th class="py-2.5 px-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5 text-[10px]">
                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-mono text-gray-400 whitespace-nowrap">20 SEP 2026 14:32</td>
                                        <td class="py-2.5 px-3 font-mono text-emerald-300">AUD-2026-0014</td>
                                        <td class="py-2.5 px-3 font-semibold text-white">NINA Operations</td>
                                        <td class="py-2.5 px-3 text-emerald-300">06 RAB & Budget</td>
                                        <td class="py-2.5 px-3 text-gray-200">RAB Structure RAB-NK-001-V01 Published (Rp15B / 100 HA)</td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">RAB-NK-001-V01</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">RECORDED</span></td>
                                    </tr>

                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-mono text-gray-400 whitespace-nowrap">20 SEP 2026 11:15</td>
                                        <td class="py-2.5 px-3 font-mono text-emerald-300">AUD-2026-0013</td>
                                        <td class="py-2.5 px-3 font-semibold text-white">Demo Offtake Buyer</td>
                                        <td class="py-2.5 px-3 text-emerald-300">01 Buyer Demand</td>
                                        <td class="py-2.5 px-3 text-gray-200">Demand Requirement DR-2026-001 Mapped (1,000 HA Capacity)</td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">DR-2026-001</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">RECORDED</span></td>
                                    </tr>

                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-mono text-gray-400 whitespace-nowrap">19 SEP 2026 16:45</td>
                                        <td class="py-2.5 px-3 font-mono text-emerald-300">AUD-2026-0012</td>
                                        <td class="py-2.5 px-3 font-semibold text-white">NINA Operations</td>
                                        <td class="py-2.5 px-3 text-emerald-300">03 Production Batch</td>
                                        <td class="py-2.5 px-3 text-gray-200">Standard Batch NK-001 Created (100 HA Concession Unit)</td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">BATCH-NK-001</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">RECORDED</span></td>
                                    </tr>

                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-mono text-gray-400 whitespace-nowrap">19 SEP 2026 10:20</td>
                                        <td class="py-2.5 px-3 font-mono text-emerald-300">AUD-2026-0011</td>
                                        <td class="py-2.5 px-3 font-semibold text-white">Verified Participant</td>
                                        <td class="py-2.5 px-3 text-emerald-300">04 PO Allocation</td>
                                        <td class="py-2.5 px-3 text-gray-200">PO Allocation Request Submitted (ALC-2026-NK001 - Rp100M)</td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">ALC-2026-NK001</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">RECORDED</span></td>
                                    </tr>

                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-mono text-gray-400 whitespace-nowrap">18 SEP 2026 15:10</td>
                                        <td class="py-2.5 px-3 font-mono text-emerald-300">AUD-2026-0010</td>
                                        <td class="py-2.5 px-3 font-semibold text-white">Demo Production Partner</td>
                                        <td class="py-2.5 px-3 text-emerald-300">07 Vendor & Partner</td>
                                        <td class="py-2.5 px-3 text-gray-200">Partner Entity PT-NINA-PARTNER-001 Linked to RAB Category 02</td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">PARTNER-001</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">RECORDED</span></td>
                                    </tr>

                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-mono text-gray-400 whitespace-nowrap">18 SEP 2026 09:30</td>
                                        <td class="py-2.5 px-3 font-mono text-emerald-300">AUD-2026-0009</td>
                                        <td class="py-2.5 px-3 font-semibold text-white">NINA Operations</td>
                                        <td class="py-2.5 px-3 text-emerald-300">08 Work Orders</td>
                                        <td class="py-2.5 px-3 text-gray-200">Work Order WO-NK-001-M1-001 Issued for Land Preparation</td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">WO-NK-001-M1-001</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">RECORDED</span></td>
                                    </tr>

                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-mono text-gray-400 whitespace-nowrap">17 SEP 2026 14:00</td>
                                        <td class="py-2.5 px-3 font-mono text-emerald-300">AUD-2026-0008</td>
                                        <td class="py-2.5 px-3 font-semibold text-white">NINA Verifier</td>
                                        <td class="py-2.5 px-3 text-emerald-300">09 Verification</td>
                                        <td class="py-2.5 px-3 text-gray-200">GIS Boundary Survey Data Submitted for Verification Matrix</td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">VER-2026-001</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">RECORDED</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                </div>

                <!-- RIGHT STICKY SIDEBAR (4 COLS MATCHING WIREFRAME) -->
                <div class="space-y-4 lg:col-span-4 lg:sticky lg:top-4">

                    <!-- Card 1: AUDIT LEDGER SUMMARY -->
                    <div class="<?= $card ?> p-5 space-y-4">
                        <div class="border-b border-white/10 pb-3">
                            <div class="text-[9px] font-bold uppercase tracking-wider text-emerald-300">AUDIT LEDGER SUMMARY</div>
                            <div class="text-base font-black text-white mt-1">NK-001 Event Chain</div>
                        </div>

                        <div class="space-y-2 text-xs">
                            <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Total Events Logged</span><span class="font-bold text-white">14 Events</span></div>
                            <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Chain Integrity</span><span class="font-bold text-emerald-300">Valid & Unbroken</span></div>
                            <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Concession Batch</span><span class="font-bold text-white">NK-001 (100 HA)</span></div>
                            <div class="flex justify-between py-1"><span class="text-gray-400">Last Event Timestamp</span><span class="font-mono text-white">2026-09-20 14:32</span></div>
                        </div>

                        <a href="<?= $basePrefix ?>/verification" class="w-full flex items-center justify-between rounded-lg border border-emerald-400/40 bg-emerald-950/80 p-2.5 text-[10px] font-bold text-emerald-300 hover:bg-emerald-900/80">
                            <span>VIEW VERIFICATION VAULT</span><?= $arrow ?>
                        </a>
                    </div>

                    <!-- Card 2: ACTOR DISTRIBUTION -->
                    <div class="<?= $card ?> p-5 space-y-3">
                        <div class="border-b border-white/10 pb-2">
                            <h4 class="text-xs font-bold text-white uppercase tracking-wider">Actor Entity Breakdown</h4>
                        </div>

                        <div class="space-y-2 text-[10px]">
                            <div class="flex justify-between items-center rounded bg-white/5 p-2 border border-white/5">
                                <div><div class="font-bold text-white">NINA Operations</div><div class="text-[7.5px] text-gray-400">System Administrator</div></div>
                                <span class="font-mono text-emerald-300 font-bold">06 Events</span>
                            </div>
                            <div class="flex justify-between items-center rounded bg-white/5 p-2 border border-white/5">
                                <div><div class="font-bold text-white">Demo Offtake Buyer</div><div class="text-[7.5px] text-gray-400">Offtake Registrant</div></div>
                                <span class="font-mono text-emerald-300 font-bold">03 Events</span>
                            </div>
                            <div class="flex justify-between items-center rounded bg-white/5 p-2 border border-white/5">
                                <div><div class="font-bold text-white">Demo Production Partner</div><div class="text-[7.5px] text-gray-400">Operational Vendor</div></div>
                                <span class="font-mono text-emerald-300 font-bold">03 Events</span>
                            </div>
                            <div class="flex justify-between items-center rounded bg-white/5 p-2 border border-white/5">
                                <div><div class="font-bold text-white">NINA Verifier</div><div class="text-[7.5px] text-gray-400">Auditor Sign-off</div></div>
                                <span class="font-mono text-emerald-300 font-bold">02 Events</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: EXPORT AUDIT LOG -->
                    <div class="<?= $card ?> p-4 space-y-2">
                        <div class="text-[9px] font-bold uppercase tracking-wider text-gray-400">EXPORT AUDIT TRAIL</div>
                        <p class="text-[9px] text-gray-400">Export complete event ledger log file.</p>
                        <button type="button" class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-950/80 border border-emerald-400/40 py-2.5 text-[10px] font-extrabold uppercase text-emerald-300 hover:bg-emerald-900/80">
                            <span>EXPORT AUDIT LEDGER (CSV/PDF)</span><?= $svg($ic['download'], 'w-3.5 h-3.5') ?>
                        </button>
                    </div>

                </div>

            </div>

            <!-- ---------- BOTTOM FOOTER BANNER ---------- -->
            <section class="<?= $card ?> p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <span class="<?= $iconBox ?> h-12 w-12 text-emerald-300"><?= $svg($ic['clock'], 'w-6 h-6') ?></span>
                    <div>
                        <h3 class="text-base font-extrabold text-white">Every Action Creates a Permanent Record.</h3>
                        <p class="text-xs text-gray-300 mt-0.5">NINA records every allocation, work order, verification, and settlement event into an auditable ledger.</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="<?= $basePrefix ?>/verification" class="rounded-lg bg-emerald-950/80 border border-emerald-400/40 px-4 py-2 text-xs font-bold text-emerald-300 hover:bg-emerald-900/80 uppercase">
                        VERIFICATION VAULT &rsaquo;
                    </a>
                    <a href="<?= $basePrefix ?>/documents" class="rounded-lg border border-white/15 bg-white/5 px-4 py-2 text-xs font-bold text-gray-300 hover:bg-white/10 uppercase">
                        DOCUMENT VAULT &rsaquo;
                    </a>
                </div>
            </section>

        </div>

    </div>

</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
