<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '07 / PO Allocation — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'po-allocation';

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
    'info'      => '<circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>',
    'x'         => '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>',
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

            <div class="relative grid min-h-[200px] grid-cols-1 items-start gap-6 px-6 pt-3 pb-6 lg:grid-cols-12 lg:px-8 lg:pt-3 lg:pb-8">

                <div class="space-y-3 lg:col-span-12">
                    <nav aria-label="Breadcrumb" class="inline-flex flex-wrap items-center gap-2 text-[10px] font-mono font-semibold uppercase tracking-[0.14em] text-gray-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                        <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors">PRODUCTION REQUIREMENTS</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors">DR-2026-001</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/explore" class="hover:text-white transition-colors">NORTH KALIMANTAN PALM</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/batches" class="hover:text-white transition-colors">BATCH NK-001</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="font-bold text-white uppercase">PO ALLOCATION</span>
                    </nav>

                    <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-200">
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">DEMO / PROTOTYPE</span>
                        <span>07 / PO ALLOCATION</span>
                    </div>

                    <h1 class="max-w-3xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">Take a Production Allocation</h1>
                    
                    <p class="max-w-3xl text-base font-medium leading-relaxed text-gray-200">
                        Join a defined production batch through a documented PO allocation connected to production capacity, RAB, milestones and commercial delivery.
                    </p>
                    <p class="text-[10px] italic text-gray-400">
                        Ambil alokasi produksi dalam batch yang terdefinisi dan terhubung dengan kapasitas produksi, RAB, milestone, serta proses delivery komersial.
                    </p>
                </div>

            </div>
        </section>

        <!-- ================= CONTENT ================= -->
        <div class="space-y-6 px-4 pb-16 pt-6 sm:px-6 lg:px-8">

            <!-- ---------- 3. IMPORTANT POSITIONING INFORMATION STRIP ---------- -->
            <section class="<?= $card ?> p-4 bg-[#081611]/90 border-emerald-500/30 flex items-start gap-3">
                <span class="text-emerald-400 shrink-0 mt-0.5"><?= $svg($ic['info'], 'w-5 h-5') ?></span>
                <div class="space-y-0.5 text-xs">
                    <div class="font-bold text-white">You are allocating production capacity &mdash; not purchasing land ownership.</div>
                    <div class="text-[11px] text-gray-300">Anda mengambil alokasi produksi &mdash; bukan membeli kepemilikan atas tanah.</div>
                    <div class="text-[9px] italic text-gray-400 pt-1 border-t border-white/5">
                        Final legal characterization, documentation and participant rights are subject to the applicable legal and commercial structure.
                    </div>
                </div>
            </section>

            <!-- ================= MAIN LAYOUT GRID (65% LEFT, 35% RIGHT STICKY) ================= -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 items-start">

                <!-- LEFT COLUMN (65% / 8 COLS) -->
                <div class="space-y-6 lg:col-span-8">

                    <!-- 5. SELECT BATCH -->
                    <section class="<?= $card ?> p-5 space-y-4">
                        <div class="border-b border-white/10 pb-2">
                            <h2 class="text-xs font-bold uppercase tracking-wider text-emerald-300">Production Batch</h2>
                        </div>

                        <div class="rounded-xl border border-white/10 bg-[#07110E] p-4 flex flex-col sm:flex-row gap-4 items-start">
                            <div class="relative w-full sm:w-32 h-28 shrink-0 overflow-hidden rounded-lg border border-white/15 shadow">
                                <img src="<?= $basePrefix ?>/2.jpg" alt="North Kalimantan Palm" class="h-full w-full object-cover" />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                            </div>

                            <div class="space-y-2 flex-1 text-xs">
                                <div class="flex flex-wrap items-center justify-between gap-2">
                                    <div>
                                        <h3 class="text-sm font-extrabold text-white">NORTH KALIMANTAN PALM &bull; BATCH NK-001</h3>
                                        <div class="mt-0.5 flex items-center gap-2 font-mono text-[10px]">
                                            <span class="font-bold text-emerald-300">PT. Kaltara 8</span>
                                            <span class="text-gray-400">ID: ID-ML-0001</span>
                                            <span class="text-gray-500">•</span>
                                            <span class="text-gray-400">No Project: PO-KAL-0001</span>
                                        </div>
                                    </div>
                                    <span class="rounded border border-amber-400/30 bg-amber-500/20 px-2 py-0.5 text-[8px] font-bold text-amber-300">PENDING PO COLLECTION</span>
                                </div>

                                <div class="grid grid-cols-2 gap-2 text-[10px] text-gray-300">
                                    <div><span class="text-gray-400">Region:</span> <strong class="text-white">North Kalimantan, Indonesia</strong></div>
                                    <div><span class="text-gray-400">Batch Size:</span> <strong class="text-white">100 HA</strong></div>
                                    <div><span class="text-gray-400">Requirement:</span> <strong class="font-bold text-emerald-300">880.000 usdt</strong></div>
                                    <div><span class="text-gray-400">Project Status:</span> <span class="font-bold text-amber-300">DEMO / PENDING</span></div>
                                </div>

                                <div class="pt-1">
                                    <a href="<?= $basePrefix ?>/batches" class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-300 hover:underline">VIEW BATCH DETAILS &rsaquo;</a>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 6 & 7. ALLOCATION AMOUNT & UNITS -->
                    <section class="<?= $card ?> p-5 space-y-4">
                        <div class="border-b border-white/10 pb-2">
                            <h2 class="text-base font-bold text-white">Select PO Allocation</h2>
                            <p class="text-xs text-gray-300">Choose the production allocation amount available within this batch.</p>
                        </div>

                        <!-- Quick Selection Pills -->
                        <div class="flex flex-wrap items-center gap-2">
                            <button type="button" class="rounded-lg bg-emerald-950 px-4 py-2 text-xs font-bold text-emerald-300 border border-emerald-400 shadow">8.000 usdt (1 Unit)</button>
                            <button type="button" class="rounded-lg bg-white/5 px-4 py-2 text-xs font-bold text-gray-300 border border-white/10 hover:bg-white/10">24.000 usdt (3 Units)</button>
                            <button type="button" class="rounded-lg bg-white/5 px-4 py-2 text-xs font-bold text-gray-300 border border-white/10 hover:bg-white/10">40.000 usdt (5 Units)</button>
                            <button type="button" class="rounded-lg bg-white/5 px-4 py-2 text-xs font-bold text-gray-300 border border-white/10 hover:bg-white/10">80.000 usdt (10 Units)</button>
                            <button type="button" class="rounded-lg bg-white/5 px-4 py-2 text-xs font-bold text-gray-300 border border-white/10 hover:bg-white/10">Custom</button>
                        </div>

                        <!-- Input Box -->
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold uppercase tracking-wider text-gray-400">MINIMUM 8.000 usdt (1 PO ALLOCATION UNIT)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-bold text-gray-400">usdt</span>
                                <input type="text" value="8.000" readonly class="w-full rounded-xl border border-emerald-400/50 bg-[#07110E] py-3 pl-16 pr-4 text-lg font-black text-white focus:outline-none" />
                            </div>
                            <span class="text-[9px] font-mono text-emerald-300 block pt-0.5">1 &times; 8.000 usdt PO allocation unit</span>
                        </div>

                        <!-- Allocation Breakdown Grid -->
                        <div class="grid grid-cols-3 gap-3 text-center text-xs">
                            <div class="p-3 rounded-lg border border-white/10 bg-[#07110E]">
                                <div class="text-[8px] text-gray-400 uppercase font-bold">BATCH REQUIREMENT</div>
                                <div class="text-sm font-black text-white mt-0.5">880.000 usdt</div>
                            </div>
                            <div class="p-3 rounded-lg border border-white/10 bg-[#07110E]">
                                <div class="text-[8px] text-gray-400 uppercase font-bold">YOUR ALLOCATION</div>
                                <div class="text-sm font-black text-emerald-300 mt-0.5">8.000 usdt</div>
                            </div>
                            <div class="p-3 rounded-lg border border-white/10 bg-[#07110E]">
                                <div class="text-[8px] text-gray-400 uppercase font-bold">REMAINING REQUIREMENT</div>
                                <div class="text-sm font-black text-white mt-0.5">872.000 usdt</div>
                            </div>
                        </div>

                        <!-- Allocation Units Dot Progress Tracker -->
                        <div class="space-y-2 border-t border-white/10 pt-3">
                            <div class="flex justify-between text-xs font-bold">
                                <span class="text-gray-300">1 / 110 PO allocation units</span>
                                <span class="text-emerald-300">0.91%</span>
                            </div>

                            <div class="flex items-center gap-1.5 flex-wrap">
                                <span class="h-3 w-3 rounded-full bg-emerald-400 border border-emerald-300"></span>
                                <?php for ($i = 0; $i < 14; $i++): ?>
                                    <span class="h-3 w-3 rounded-full bg-white/10 border border-white/20"></span>
                                <?php endfor; ?>
                                <span class="text-[9px] font-mono text-gray-400">+95 more units</span>
                            </div>

                            <p class="text-[9px] text-gray-400">
                                Mitra dapat mengambil production allocation minimum 8.000 usdt dan, sesuai struktur program, dapat mengalokasikan production demand across multiple batches (110 minimum PO allocation units per 100 HA batch).
                            </p>
                        </div>
                    </section>

                    <!-- 8. ALLOCATION SHARE & NO-OWNERSHIP DISCLAIMER -->
                    <section class="<?= $card ?> p-4 bg-amber-950/20 border-amber-500/30 space-y-2">
                        <div class="flex justify-between items-center text-xs font-bold">
                            <div class="text-[10px] text-gray-400 mt-0.5">Allocation Share of Batch Requirement</div>
                            <span class="text-amber-300 text-sm">0.91%*</span>
                        </div>
                        <p class="text-[9px] italic text-gray-300 leading-relaxed">
                            *This percentage represents the allocation proportion within the modeled batch requirement and does not represent legal ownership of land or the operating company.
                        </p>
                    </section>

                    <!-- 9. WHAT YOUR ALLOCATION REPRESENTS (3 CARDS) -->
                    <section class="<?= $card ?> p-5 space-y-4">
                        <div class="border-b border-white/10 pb-2">
                            <h3 class="text-sm font-bold text-white">What Your Allocation Represents</h3>
                        </div>

                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3 text-xs">
                            <div class="rounded-xl border border-white/10 bg-[#07110E] p-3.5 space-y-2">
                                <div class="flex items-center gap-2">
                                    <span class="<?= $iconBox ?> h-7 w-7 text-[10px] font-bold">01</span>
                                    <span class="font-bold text-white text-[11px]">Production Capacity</span>
                                </div>
                                <p class="text-[10px] text-gray-300 leading-relaxed">Your allocation is linked to a defined production batch.</p>
                                <p class="text-[8px] italic text-gray-400">Alokasi terhubung dengan batch produksi tertentu.</p>
                            </div>

                            <div class="rounded-xl border border-white/10 bg-[#07110E] p-3.5 space-y-2">
                                <div class="flex items-center gap-2">
                                    <span class="<?= $iconBox ?> h-7 w-7 text-[10px] font-bold">02</span>
                                    <span class="font-bold text-white text-[11px]">Production Execution</span>
                                </div>
                                <div class="text-[9px] font-mono text-emerald-300 space-y-0.5">
                                    <div>RAB &rsaquo; Vendors</div>
                                    <div>Milestones &rsaquo; Verification</div>
                                </div>
                            </div>

                            <div class="rounded-xl border border-white/10 bg-[#07110E] p-3.5 space-y-2">
                                <div class="flex items-center gap-2">
                                    <span class="<?= $iconBox ?> h-7 w-7 text-[10px] font-bold">03</span>
                                    <span class="font-bold text-white text-[11px]">Commercial Output</span>
                                </div>
                                <div class="text-[9px] font-mono text-emerald-300 space-y-0.5">
                                    <div>Harvest &rsaquo; Processing</div>
                                    <div>Delivery &rsaquo; Settlement</div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 10. WHAT THIS ALLOCATION DOES NOT REPRESENT -->
                    <section class="<?= $card ?> p-5 space-y-4">
                        <div class="border-b border-white/10 pb-2">
                            <h3 class="text-sm font-bold text-white">What This Allocation Does Not Represent</h3>
                        </div>

                        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 text-[10px] text-rose-300">
                            <div class="flex items-center gap-2"><span class="text-rose-400 font-bold">&times;</span> Direct land ownership</div>
                            <div class="flex items-center gap-2"><span class="text-rose-400 font-bold">&times;</span> Automatic company ownership</div>
                            <div class="flex items-center gap-2"><span class="text-rose-400 font-bold">&times;</span> Guaranteed production output</div>
                            <div class="flex items-center gap-2"><span class="text-rose-400 font-bold">&times;</span> Guaranteed commercial return</div>
                            <div class="flex items-center gap-2"><span class="text-rose-400 font-bold">&times;</span> Guaranteed resale value</div>
                            <div class="flex items-center gap-2"><span class="text-rose-400 font-bold">&times;</span> Guaranteed settlement amount</div>
                        </div>

                        <p class="text-[9px] text-gray-400 border-t border-white/5 pt-2">
                            Commercial and legal rights depend on the final contractual structure and verified production performance.
                        </p>
                    </section>

                    <!-- ADDITIONAL PARAMETERS & TRACEABILITY -->
                    <section class="<?= $card ?> p-5 space-y-4">
                        <div class="border-b border-white/10 pb-2">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-white">Batch Production Parameters</h3>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-[9px] text-gray-300">
                            <div class="p-2 rounded bg-[#07110E] border border-white/5"><span>Batch Size:</span> <strong class="text-white block font-mono text-[10px]">100 HA</strong></div>
                            <div class="p-2 rounded bg-[#07110E] border border-white/5"><span>Requirement:</span> <strong class="text-emerald-300 block font-mono text-[10px]">880,000 USDT</strong></div>
                            <div class="p-2 rounded bg-[#07110E] border border-white/5"><span>Min PO:</span> <strong class="text-white block font-mono text-[10px]">8,000 USDT</strong></div>
                            <div class="p-2 rounded bg-[#07110E] border border-white/5"><span>Contract Horizon:</span> <strong class="text-white block font-mono text-[10px]">20 years</strong></div>
                        </div>

                        <!-- Vendor Traceability Grid -->
                        <div class="space-y-2 border-t border-white/10 pt-3">
                            <div class="text-[9px] font-bold uppercase tracking-wider text-emerald-300">Production Vendor Traceability</div>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-[9px]">
                                <div class="p-2 rounded bg-[#07110E] border border-white/5">
                                    <div class="text-gray-400 text-[7px] uppercase font-bold">SEED SUPPLIER</div>
                                    <div class="font-bold text-white">Demo Seed Producer</div>
                                </div>
                                <div class="p-2 rounded bg-[#07110E] border border-white/5">
                                    <div class="text-gray-400 text-[7px] uppercase font-bold">FERTILIZER</div>
                                    <div class="font-bold text-white">Demo Input Supplier</div>
                                </div>
                                <div class="p-2 rounded bg-[#07110E] border border-white/5">
                                    <div class="text-gray-400 text-[7px] uppercase font-bold">HEAVY EQUIPMENT</div>
                                    <div class="font-bold text-white">Demo Equipment Partner</div>
                                </div>
                                <div class="p-2 rounded bg-[#07110E] border border-white/5">
                                    <div class="text-gray-400 text-[7px] uppercase font-bold">LOGISTICS</div>
                                    <div class="font-bold text-white">Demo Logistics Partner</div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>

                <!-- RIGHT COLUMN (35% STICKY / 4 COLS MATCHING WIREFRAME) -->
                <div class="space-y-4 lg:col-span-4 lg:sticky lg:top-4">

                    <!-- Card 1: ALLOCATION SUMMARY -->
                    <div class="<?= $card ?> p-5 space-y-4">
                        <div class="border-b border-white/10 pb-3">
                            <h3 class="text-sm font-bold uppercase tracking-wider text-white">Allocation Summary</h3>
                        </div>

                        <div class="space-y-2 text-xs">
                            <div class="flex justify-between"><span class="text-gray-400">BATCH</span><span class="font-bold font-mono text-white">NK-001</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">PROJECT</span><span class="font-bold text-white">North Kalimantan Palm</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">ALLOCATION</span><span class="font-bold text-emerald-300 text-sm">8,000 USDT</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">MINIMUM</span><span class="font-bold text-white">8,000 USDT</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">BATCH REQUIREMENT</span><span class="font-bold text-white">880,000 USDT</span></div>
                            <div class="flex justify-between"><span class="text-gray-400">ALLOCATION SEATS</span><span class="font-bold font-mono text-emerald-300">1 / 110</span></div>
                        </div>

                        <div class="space-y-1.5 border-t border-white/10 pt-3 text-[10px]">
                            <div class="flex justify-between font-bold">
                                <span class="text-gray-300">PO COLLECTION</span>
                                <span class="text-emerald-300">0.91%</span>
                            </div>
                            <div class="text-xs font-black text-white">8,000 USDT / 880,000 USDT</div>
                            <div class="h-2 w-full rounded-full bg-white/10 overflow-hidden">
                                <div class="h-full bg-emerald-400 w-[0.91%]"></div>
                            </div>
                        </div>

                        <!-- Allocation Share -->
                        <div class="p-3 rounded-lg border border-amber-500/30 bg-amber-950/20 space-y-1 text-[9px]">
                            <div class="flex justify-between font-bold text-amber-300">
                                <span>Allocation Share</span>
                                <span>0.91%</span>
                            </div>
                            <p class="text-gray-400 leading-tight">
                                Proportion within the modeled batch requirement; not legal ownership of land or operating company.
                            </p>
                        </div>
                    </div>

                    <!-- Card 2: NEXT STEPS STEPPER -->
                    <div class="<?= $card ?> p-5 space-y-3">
                        <div class="border-b border-white/10 pb-2">
                            <h4 class="text-xs font-bold text-white uppercase tracking-wider">Next Steps</h4>
                        </div>

                        <div class="relative pl-5 space-y-2.5 text-[10px]">
                            <div class="absolute left-[6px] top-[4px] bottom-[8px] w-[2px] bg-white/20"></div>

                            <div class="relative flex items-center gap-2">
                                <span class="absolute -left-5 top-[2px] h-3 w-3 rounded-full border border-emerald-400 bg-emerald-400"></span>
                                <span class="font-bold text-white">01. Review allocation</span>
                            </div>
                            <div class="relative flex items-center gap-2">
                                <span class="absolute -left-5 top-[2px] h-3 w-3 rounded-full border border-emerald-400 bg-[#07110E]"></span>
                                <span class="font-bold text-gray-300">02. Confirm documents</span>
                            </div>
                            <div class="relative flex items-center gap-2 opacity-60">
                                <span class="absolute -left-5 top-[2px] h-3 w-3 rounded-full border border-gray-500 bg-[#07110E]"></span>
                                <span class="font-bold text-gray-400">03. Submit allocation request</span>
                            </div>
                            <div class="relative flex items-center gap-2 opacity-60">
                                <span class="absolute -left-5 top-[2px] h-3 w-3 rounded-full border border-gray-500 bg-[#07110E]"></span>
                                <span class="font-bold text-gray-400">04. Commercial / legal confirmation</span>
                            </div>
                            <div class="relative flex items-center gap-2 opacity-60">
                                <span class="absolute -left-5 top-[2px] h-3 w-3 rounded-full border border-gray-500 bg-[#07110E]"></span>
                                <span class="font-bold text-gray-400">05. Allocation recorded</span>
                            </div>
                            <div class="relative flex items-center gap-2 opacity-60">
                                <span class="absolute -left-5 top-[2px] h-3 w-3 rounded-full border border-gray-500 bg-[#07110E]"></span>
                                <span class="font-bold text-gray-400">06. Track production</span>
                            </div>
                        </div>

                        <!-- PRIMARY ACTION BUTTON -->
                        <div class="pt-2">
                            <a href="<?= $basePrefix ?>/allocations" class="w-full flex items-center justify-center gap-2 rounded-xl bg-emerald-950/90 border border-emerald-400/50 py-3 text-xs font-extrabold text-emerald-300 uppercase hover:bg-emerald-900/90 transition shadow-lg">
                                <span>REQUEST PO ALLOCATION</span><?= $arrow ?>
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
