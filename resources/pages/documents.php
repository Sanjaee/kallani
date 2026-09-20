<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '15 / Document Vault — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'documents';

/* ---------- Helpers & Icons ---------- */
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

$svg = fn(string $inner, string $cls = 'w-4 h-4') =>
    '<svg class="' . $cls . '" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">' . $inner . '</svg>';

$ic = [
    'doc'      => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>',
    'lock'     => '<rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
    'download' => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>',
    'search'   => '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>',
    'shield'   => '<path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/>',
    'check'    => '<circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 4.5-5"/>',
    'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>',
    'grid'     => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/>',
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
                        <span class="font-bold text-white uppercase">DOCUMENTS VAULT</span>
                    </nav>

                    <!-- Header Primary/Secondary Actions -->
                    <div class="flex flex-wrap items-center gap-2 text-[10px] font-bold">
                        <a href="#hash-verifier" class="rounded-lg bg-emerald-950/80 border border-emerald-400/40 px-3 py-1.5 text-emerald-300 hover:bg-emerald-900/80 uppercase tracking-wide">VERIFY CRYPTOGRAPHIC HASH</a>
                        <a href="<?= $basePrefix ?>/verification" class="rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10 uppercase tracking-wide">VERIFICATION MATRIX</a>
                        <a href="<?= $basePrefix ?>/audit-trail" class="rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10 uppercase tracking-wide">AUDIT TRAIL LOG</a>
                    </div>
                </div>

                <!-- Headline & Subheadline -->
                <div class="space-y-3">
                    <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-200">
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">DOCUMENTATION SYSTEM</span>
                        <span>15 / DOCUMENT CENTER & LEGAL VAULT</span>
                        <span class="rounded border border-amber-400/40 bg-amber-500/20 px-2 py-0.5 text-[9px] font-bold tracking-wider text-amber-300">HASHED VAULT / DEMO</span>
                    </div>

                    <h1 class="max-w-3xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">Document Center & Legal Vault</h1>
                    
                    <p class="max-w-3xl text-sm font-medium leading-relaxed text-gray-200">
                        Cryptographically hashed legal, operational, RAB, and technical documentation with verifiable proof of authenticity.
                    </p>
                    <p class="text-[11px] italic text-gray-400">
                        Penyimpanan terpusat untuk dokumen hukum, peta GIS, RAB, work order, dan bukti verifikasi dengan referensi hash yang dapat diverifikasi.
                    </p>
                </div>

                <!-- HERO SUMMARY CARD -->
                <div class="rounded-xl border border-white/15 bg-[#08130F]/80 p-5 shadow-2xl backdrop-blur-xl space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-white/10 pb-3">
                        <div class="flex items-center gap-3">
                            <span class="<?= $iconBox ?> h-11 w-11 text-emerald-300"><?= $svg($ic['doc'], 'w-5 h-5') ?></span>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h2 class="text-lg font-black text-white">NORTH KALIMANTAN DOCUMENT VAULT</h2>
                                    <span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">100% HASHED</span>
                                </div>
                                <div class="text-[10px] font-mono text-gray-400 mt-0.5">MASTER VAULT ID: <strong class="text-gray-200">DOC-VAULT-NK001-2026</strong></div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 text-xs">
                        <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-0.5">
                            <div class="text-[8px] font-bold uppercase text-gray-400">TOTAL DOCUMENTS</div>
                            <div class="font-bold text-white text-[11px]">18 Vault Files</div>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-0.5">
                            <div class="text-[8px] font-bold uppercase text-gray-400">HASH INTEGRITY</div>
                            <div class="font-bold text-emerald-300 text-[11px]">Cryptographic Proof</div>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-0.5">
                            <div class="text-[8px] font-bold uppercase text-gray-400">LEGAL PERMITS</div>
                            <div class="font-bold text-white text-[11px]">04 Master Records</div>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-0.5">
                            <div class="text-[8px] font-bold uppercase text-gray-400">ACCESS CONTROL</div>
                            <div class="font-bold text-amber-300 text-[11px]">Role-Based Secure</div>
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
                    <span class="<?= $iconBox ?>"><?= $svg($ic['doc']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">TOTAL FILES</div>
                        <div class="text-lg font-extrabold leading-tight text-white">18</div>
                        <div class="text-[8px] text-gray-400">Categorized Vault Files</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['shield']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">HASH VERIFIED</div>
                        <div class="text-lg font-extrabold leading-tight text-emerald-300">100%</div>
                        <div class="text-[8px] text-gray-400">SHA-256 Proof</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['grid']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">LEGAL DOMAINS</div>
                        <div class="text-lg font-extrabold leading-tight text-white">07</div>
                        <div class="text-[8px] text-gray-400">Document Domains</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['lock']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">ACCESS</div>
                        <div class="text-sm font-extrabold leading-tight text-emerald-300">SECURE</div>
                        <div class="text-[8px] text-gray-400">Role Permissioned</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['clock']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">LAST FILE ADDED</div>
                        <div class="text-sm font-extrabold leading-tight text-white">20 SEP 2026</div>
                        <div class="text-[8px] text-gray-400">System Recorded</div>
                    </div>
                </div>

            </section>

            <!-- ================= MAIN LAYOUT GRID (8 COLS LEFT, 4 COLS RIGHT STICKY) ================= -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 items-start">

                <!-- LEFT MAIN CONTENT (8 COLS) -->
                <div class="space-y-6 lg:col-span-8">

                    <!-- SECTION 01: SEARCH & MASTER DOCUMENT TABLE -->
                    <section class="<?= $card ?> p-5 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-white/10 pb-3">
                            <div>
                                <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">01 / DOCUMENT LEDGER</div>
                                <h2 class="text-base font-bold text-white">Master Document Ledger & Cryptographic Hashes</h2>
                                <p class="text-xs text-gray-300">All uploaded files are permanently indexed with cryptographic hash references.</p>
                            </div>
                            <span class="rounded bg-emerald-950 px-2.5 py-1 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">HASHED INDEX</span>
                        </div>

                        <!-- Search & Filter Bar -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 text-xs">
                            <div class="sm:col-span-2 relative">
                                <input type="text" placeholder="Search document name, reference ID, category, or hash..." class="w-full rounded-lg border border-white/10 bg-[#07110E] px-3 py-1.5 text-xs text-white focus:outline-none focus:border-emerald-400" />
                            </div>
                            <div>
                                <select class="w-full rounded-lg border border-white/10 bg-[#07110E] px-2 py-1.5 text-xs text-gray-300">
                                    <option>Category: All Domains</option>
                                    <option>Legal & Land Rights</option>
                                    <option>Production & Operations</option>
                                    <option>RAB & Financial</option>
                                    <option>Vendor & Wallet</option>
                                    <option>ESG & Environmental</option>
                                </select>
                            </div>
                        </div>

                        <!-- Master Document Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs text-gray-300">
                                <thead>
                                    <tr class="border-b border-white/10 text-[9px] uppercase tracking-wider text-gray-400">
                                        <th class="py-2.5 px-3">Document Title</th>
                                        <th class="py-2.5 px-3">Reference ID</th>
                                        <th class="py-2.5 px-3">Category</th>
                                        <th class="py-2.5 px-3">Version</th>
                                        <th class="py-2.5 px-3">Date</th>
                                        <th class="py-2.5 px-3">Cryptographic Hash</th>
                                        <th class="py-2.5 px-3">Status</th>
                                        <th class="py-2.5 px-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5 text-[10px]">
                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-semibold text-white flex items-center gap-2">
                                            <span class="text-emerald-300"><?= $svg($ic['doc'], 'w-3.5 h-3.5') ?></span> RAB-NK-001-V01 Production Budget Structure
                                        </td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">DOC-RAB-001</td>
                                        <td class="py-2.5 px-3 text-gray-300">RAB & Financial</td>
                                        <td class="py-2.5 px-3 font-mono text-white">V01</td>
                                        <td class="py-2.5 px-3 text-gray-400">2026-06-12</td>
                                        <td class="py-2.5 px-3 font-mono text-emerald-300">0x8a9f2c...41b0</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">AVAILABLE</span></td>
                                        <td class="py-2.5 px-3"><a href="#" class="text-emerald-300 font-bold hover:underline">Download &rsaquo;</a></td>
                                    </tr>

                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-semibold text-white flex items-center gap-2">
                                            <span class="text-emerald-300"><?= $svg($ic['doc'], 'w-3.5 h-3.5') ?></span> Land Partnership Record & Concession Map
                                        </td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">DOC-LEG-001</td>
                                        <td class="py-2.5 px-3 text-gray-300">Legal & Land Rights</td>
                                        <td class="py-2.5 px-3 font-mono text-white">V01</td>
                                        <td class="py-2.5 px-3 text-gray-400">2026-06-10</td>
                                        <td class="py-2.5 px-3 font-mono text-emerald-300">0x4d1e8a...92c4</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">AVAILABLE</span></td>
                                        <td class="py-2.5 px-3"><a href="#" class="text-emerald-300 font-bold hover:underline">Download &rsaquo;</a></td>
                                    </tr>

                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-semibold text-white flex items-center gap-2">
                                            <span class="text-emerald-300"><?= $svg($ic['doc'], 'w-3.5 h-3.5') ?></span> DR-2026-001 Offtake Supply Agreement
                                        </td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">DOC-OFF-001</td>
                                        <td class="py-2.5 px-3 text-gray-300">Commercial Offtake</td>
                                        <td class="py-2.5 px-3 font-mono text-white">V01</td>
                                        <td class="py-2.5 px-3 text-gray-400">2026-06-08</td>
                                        <td class="py-2.5 px-3 font-mono text-emerald-300">0x3f7a1b...88a1</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">AVAILABLE</span></td>
                                        <td class="py-2.5 px-3"><a href="#" class="text-emerald-300 font-bold hover:underline">Download &rsaquo;</a></td>
                                    </tr>

                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-semibold text-white flex items-center gap-2">
                                            <span class="text-emerald-300"><?= $svg($ic['doc'], 'w-3.5 h-3.5') ?></span> CAP-2026-001 Verified Capacity Record
                                        </td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">DOC-CAP-001</td>
                                        <td class="py-2.5 px-3 text-gray-300">Capacity & Partner</td>
                                        <td class="py-2.5 px-3 font-mono text-white">V01</td>
                                        <td class="py-2.5 px-3 text-gray-400">2026-06-14</td>
                                        <td class="py-2.5 px-3 font-mono text-emerald-300">0x9e2b4c...12d3</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">AVAILABLE</span></td>
                                        <td class="py-2.5 px-3"><a href="#" class="text-emerald-300 font-bold hover:underline">Download &rsaquo;</a></td>
                                    </tr>

                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-semibold text-white flex items-center gap-2">
                                            <span class="text-emerald-300"><?= $svg($ic['doc'], 'w-3.5 h-3.5') ?></span> WO-NK-001-M1-001 Work Order Assignment
                                        </td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">DOC-WO-001</td>
                                        <td class="py-2.5 px-3 text-gray-300">Operations</td>
                                        <td class="py-2.5 px-3 font-mono text-white">V01</td>
                                        <td class="py-2.5 px-3 text-gray-400">2026-06-15</td>
                                        <td class="py-2.5 px-3 font-mono text-emerald-300">0x1a8c3d...99e4</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">AVAILABLE</span></td>
                                        <td class="py-2.5 px-3"><a href="#" class="text-emerald-300 font-bold hover:underline">Download &rsaquo;</a></td>
                                    </tr>

                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-semibold text-white flex items-center gap-2">
                                            <span class="text-emerald-300"><?= $svg($ic['doc'], 'w-3.5 h-3.5') ?></span> Certified Seed Source Certificate (PPKS)
                                        </td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">DOC-SEED-001</td>
                                        <td class="py-2.5 px-3 text-gray-300">Agronomy</td>
                                        <td class="py-2.5 px-3 font-mono text-white">V01</td>
                                        <td class="py-2.5 px-3 text-gray-400">2026-06-16</td>
                                        <td class="py-2.5 px-3 font-mono text-amber-300">0x7b5d2e...33f5</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-amber-500/20 px-2 py-0.5 text-[8px] font-bold text-amber-300">PENDING AUDIT</span></td>
                                        <td class="py-2.5 px-3"><a href="#" class="text-gray-400 font-bold hover:underline">Pending &rsaquo;</a></td>
                                    </tr>

                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-2.5 px-3 font-semibold text-white flex items-center gap-2">
                                            <span class="text-emerald-300"><?= $svg($ic['doc'], 'w-3.5 h-3.5') ?></span> GIS Boundary Survey & Coordinates File
                                        </td>
                                        <td class="py-2.5 px-3 font-mono text-gray-400">DOC-GIS-001</td>
                                        <td class="py-2.5 px-3 text-gray-300">Spatial & GIS</td>
                                        <td class="py-2.5 px-3 font-mono text-white">V01</td>
                                        <td class="py-2.5 px-3 text-gray-400">2026-06-18</td>
                                        <td class="py-2.5 px-3 font-mono text-emerald-300">0x2c4e6f...77a8</td>
                                        <td class="py-2.5 px-3"><span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">AVAILABLE</span></td>
                                        <td class="py-2.5 px-3"><a href="#" class="text-emerald-300 font-bold hover:underline">Download &rsaquo;</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <!-- SECTION 02: CRYPTOGRAPHIC HASH VERIFIER BOX -->
                    <section id="hash-verifier" class="<?= $card ?> p-5 space-y-3">
                        <div class="border-b border-white/10 pb-2 flex justify-between items-center">
                            <div>
                                <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">02 / CRYPTOGRAPHIC VERIFIER</div>
                                <h3 class="text-base font-bold text-white">Verify System Hash Authenticity</h3>
                            </div>
                            <span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">SHA-256 PROOF</span>
                        </div>

                        <div class="space-y-2">
                            <p class="text-xs text-gray-300">Paste any document reference or cryptographic hash to verify its entry in the system ledger.</p>
                            <div class="flex gap-2">
                                <input type="text" placeholder="e.g. 0x8a9f2c41b09e2b4c12d3..." class="flex-1 rounded-lg border border-white/10 bg-[#07110E] px-3 py-2 text-xs text-white font-mono focus:outline-none focus:border-emerald-400" />
                                <button type="button" class="rounded-lg bg-emerald-950/80 border border-emerald-400/40 px-4 py-2 text-xs font-bold text-emerald-300 hover:bg-emerald-900/80 uppercase">VERIFY HASH</button>
                            </div>
                        </div>
                    </section>

                </div>

                <!-- RIGHT STICKY SIDEBAR (4 COLS MATCHING WIREFRAME) -->
                <div class="space-y-4 lg:col-span-4 lg:sticky lg:top-4">

                    <!-- Card 1: VAULT OVERVIEW -->
                    <div class="<?= $card ?> p-5 space-y-4">
                        <div class="border-b border-white/10 pb-3">
                            <div class="text-[9px] font-bold uppercase tracking-wider text-emerald-300">VAULT OVERVIEW</div>
                            <div class="text-base font-black text-white mt-1">NK-001 Master Vault</div>
                        </div>

                        <div class="space-y-2 text-xs">
                            <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Total Vault Files</span><span class="font-bold text-white">18 Documents</span></div>
                            <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Index Integrity</span><span class="font-bold text-emerald-300">100% Cryptographic</span></div>
                            <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Concession Batch</span><span class="font-bold text-white">NK-001 (100 HA)</span></div>
                            <div class="flex justify-between py-1"><span class="text-gray-400">Last File Upload</span><span class="font-mono text-white">2026-06-18</span></div>
                        </div>

                        <a href="<?= $basePrefix ?>/verification" class="w-full flex items-center justify-between rounded-lg border border-emerald-400/40 bg-emerald-950/80 p-2.5 text-[10px] font-bold text-emerald-300 hover:bg-emerald-900/80">
                            <span>VIEW VERIFICATION MATRIX</span><?= $arrow ?>
                        </a>
                    </div>

                    <!-- Card 2: ROLE-BASED ACCESS CONTROL -->
                    <div class="<?= $card ?> p-5 space-y-3">
                        <div class="border-b border-white/10 pb-2">
                            <h4 class="text-xs font-bold text-white uppercase tracking-wider">Access Control Levels</h4>
                        </div>

                        <div class="space-y-2 text-[10px]">
                            <div class="flex justify-between items-center rounded bg-white/5 p-2 border border-white/5">
                                <div><div class="font-bold text-white">Participant Access</div><div class="text-[7.5px] text-gray-400">View Public Summaries</div></div>
                                <span class="text-emerald-300 font-bold">READ ONLY</span>
                            </div>
                            <div class="flex justify-between items-center rounded bg-white/5 p-2 border border-white/5">
                                <div><div class="font-bold text-white">Operations Access</div><div class="text-[7.5px] text-gray-400">Upload & Edit Files</div></div>
                                <span class="text-amber-300 font-bold">LIMITED</span>
                            </div>
                            <div class="flex justify-between items-center rounded bg-white/5 p-2 border border-white/5">
                                <div><div class="font-bold text-white">Auditor Access</div><div class="text-[7.5px] text-gray-400">Verify & Audit Hashes</div></div>
                                <span class="text-emerald-300 font-bold">AUDIT READ</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: EXPORT ALL DOCUMENTS -->
                    <div class="<?= $card ?> p-4 space-y-2">
                        <div class="text-[9px] font-bold uppercase tracking-wider text-gray-400">EXPORT ARCHIVE</div>
                        <p class="text-[9px] text-gray-400">Download all vault files in a single archive.</p>
                        <button type="button" class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-950/80 border border-emerald-400/40 py-2.5 text-[10px] font-extrabold uppercase text-emerald-300 hover:bg-emerald-900/80">
                            <span>DOWNLOAD ZIP ARCHIVE</span><?= $svg($ic['download'], 'w-3.5 h-3.5') ?>
                        </button>
                    </div>

                </div>

            </div>

            <!-- ---------- BOTTOM FOOTER BANNER ---------- -->
            <section class="<?= $card ?> p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <span class="<?= $iconBox ?> h-12 w-12 text-emerald-300"><?= $svg($ic['doc'], 'w-6 h-6') ?></span>
                    <div>
                        <h3 class="text-base font-extrabold text-white">Immutable Document Infrastructure.</h3>
                        <p class="text-xs text-gray-300 mt-0.5">Every legal contract, operational work order, and verification file is permanently hashed and recorded.</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="<?= $basePrefix ?>/verification" class="rounded-lg bg-emerald-950/80 border border-emerald-400/40 px-4 py-2 text-xs font-bold text-emerald-300 hover:bg-emerald-900/80 uppercase">
                        VERIFICATION VAULT &rsaquo;
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
