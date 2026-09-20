<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '08 / Production Batch NK-001 — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'batches';

/* ---------- Helpers & data ---------- */
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

/* Icons: $svg(inner-paths, size-classes) */
$svg = fn(string $inner, string $cls = 'w-5 h-5') =>
    '<svg class="' . $cls . '" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">' . $inner . '</svg>';

$ic = [
    'target'    => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.5"/>',
    'leaf'      => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>',
    'calendar'  => '<path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
    'coin'      => '<circle cx="12" cy="12" r="9"/><path d="M14.5 9.5c-.5-1-1.4-1.5-2.5-1.5-1.4 0-2.5.8-2.5 2s1 1.7 2.5 2 2.5.8 2.5 2-1.1 2-2.5 2c-1.1 0-2-.5-2.5-1.5M12 6v2M12 16v2"/>',
    'grid'      => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/>',
    'pin'       => '<path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="2.5"/>',
    'check'     => '<circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 4.5-5"/>',
    'shield'    => '<path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/>',
    'clock'     => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/>',
    'wallet'    => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="M16 12h.01"/>',
    'truck'     => '<rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>',
    'tool'      => '<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>',
    'sprout'    => '<path d="M7 20h10M12 20v-8M12 12A5 5 0 0 1 7 7c0-2 2-3 5-3s5 1 5 3a5 5 0 0 1-5 5z"/>',
    'doc'       => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>',
];

$chev  = '<svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>';
$arrow = '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>';

/* Reusable class strings (Tailwind) */
$card      = 'rounded-xl border border-white/10 bg-[#0B1815]/90 shadow-xl';
$iconBox   = 'flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-emerald-100';
$metricLbl = 'text-[9px] font-medium uppercase tracking-wide text-gray-400';

$footerCols = [
    'Product'  => [['Explore', '/explore'], ['Production', '/demand'], ['Partners', '/vendors'], ['Vendors', '/vendors'], ['Audit', '/audit-trail']],
    'Protocol' => [['How It Works', '/#system-architecture'], ['Verification', '/verification'], ['Documents', '/documents'], ['Audit Trail', '/audit-trail']],
    'Company'  => [['About', '#'], ['Contact', '#']],
];

ob_start();
?>

<script>
function batchPage() {
    return {
        openModal: false,
        modalSuccess: false,
        chk1: false,
        chk2: false,
        chk3: false,
        chk4: false,
        get canSubmit() { return this.chk1 && this.chk2 && this.chk3 && this.chk4; },
        submitAllocation() {
            if (!this.canSubmit) return;
            window.location.href = '<?= $basePrefix ?>/allocations/new?batch=NK-001';
        },
        closeModal() {
            this.openModal = false;
            this.modalSuccess = false;
            this.chk1 = this.chk2 = this.chk3 = this.chk4 = false;
        }
    };
}
</script>

<div class="relative w-full font-sans" x-data="batchPage()">

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

                <!-- Left: breadcrumb, title, description -->
                <div class="space-y-4 lg:col-span-7">
                    <nav aria-label="Breadcrumb" class="inline-flex flex-wrap items-center gap-2 text-[10px] font-mono font-semibold uppercase tracking-[0.14em] text-gray-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                        <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors">PRODUCTION REQUIREMENTS</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors">DR-2026-001</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/explore" class="hover:text-white transition-colors">NORTH KALIMANTAN PALM</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="font-bold text-white uppercase">BATCH NK-001</span>
                    </nav>

                    <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-200">
                        <span>06 / Production Batch</span>
                        <span class="rounded border border-amber-400/40 bg-amber-500/20 px-2 py-0.5 text-[9px] font-bold tracking-wider text-amber-300">DEMO / PENDING PO COLLECTION</span>
                    </div>

                    <h1 class="max-w-2xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">Batch NK-001</h1>
                    <div class="text-lg font-bold text-emerald-300">100 HA Standard Production Batch</div>

                    <p class="max-w-md text-sm leading-relaxed text-gray-200">
                        A standardized 100 HA production unit within the North Kalimantan Palm project, structured for measurable PO allocation, milestone execution, vendor coordination and production traceability.
                    </p>
                </div>

                <!-- Right: BATCH STATUS card -->
                <div class="lg:col-span-4 lg:col-start-9">
                    <div class="space-y-4 rounded-xl border border-white/15 bg-[#08130F]/70 p-5 shadow-2xl backdrop-blur-xl">
                        <div class="flex items-center justify-between">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-white">Batch Status</span>
                            <span class="rounded border border-amber-400/40 bg-amber-950/80 px-2 py-0.5 text-[9px] font-bold text-amber-300">PENDING PO COLLECTION</span>
                        </div>
                        <div class="space-y-2 text-xs">
                            <div class="flex items-center justify-between"><span class="text-gray-400">Batch ID</span><span class="font-bold text-white">NK-001</span></div>
                            <div class="flex items-center justify-between"><span class="text-gray-400">Project</span><span class="font-bold text-white">North Kalimantan Palm</span></div>
                            <div class="flex items-center justify-between"><span class="text-gray-400">Region</span><span class="font-bold text-white">North Kalimantan, Indonesia</span></div>
                            <div class="flex items-center justify-between"><span class="text-gray-400">Batch Size</span><span class="font-bold text-white">100 HA</span></div>
                            <div class="flex items-center justify-between"><span class="text-gray-400">Production Requirement</span><span class="font-bold text-emerald-300">880,000 USDT</span></div>
                            <div class="flex items-center justify-between border-t border-white/10 pt-2"><span class="text-gray-400">Minimum PO Allocation</span><span class="font-bold text-white">8,000 USDT</span></div>
                        </div>
                        <p class="text-[9px] italic text-gray-400 leading-tight">Prototype / demonstration data. Not a representation of a confirmed or unverified contract program.</p>
                    </div>
                </div>

            </div>
        </section>

        <!-- ================= CONTENT (with left/right padding) ================= -->
        <div class="space-y-5 px-4 pb-8 pt-5 sm:px-6 lg:px-8">

            <!-- ---------- TOP KPI STRIP (5 CARDS) ---------- -->
            <section class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-5">

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['grid']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">01 &mdash; Batch Capacity</div>
                        <div class="text-xl font-extrabold leading-tight text-white">100 HA</div>
                        <div class="text-[10px] text-gray-400">Standard production unit</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['coin']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">02 &mdash; Production Requirement</div>
                        <div class="text-xl font-extrabold leading-tight text-white">880,000 USDT</div>
                        <div class="text-[10px] text-gray-400">Modeled requirement / 100 HA batch</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['target']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">03 &mdash; PO Allocation</div>
                        <div class="text-xl font-extrabold leading-tight text-white">8,000 USDT MIN.</div>
                        <div class="text-[10px] text-gray-400">Minimum allocation</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['shield']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">04 &mdash; PO Collection</div>
                        <div class="text-xl font-extrabold leading-tight text-white">0%</div>
                        <div class="text-[10px] text-gray-400">Prototype initial state</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['clock']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">05 &mdash; Batch Status</div>
                        <div class="text-xl font-extrabold leading-tight text-amber-300">PENDING</div>
                        <div class="text-[10px] text-gray-400">Awaiting collection / execution</div>
                    </div>
                </div>

            </section>

            <!-- ---------- BATCH OVERVIEW ---------- -->
            <section class="<?= $card ?> p-5 lg:p-6 space-y-4">
                <div>
                    <h2 class="text-base font-bold text-white">Batch Overview</h2>
                    <p class="text-xs text-gray-300">Key Information about the production batch and its operating structure.</p>
                </div>

                <div class="grid grid-cols-1 gap-5 lg:grid-cols-12 items-stretch">
                    <!-- Left: Batch Identity & Program Parameters Box -->
                    <div class="lg:col-span-8 rounded-xl border border-white/10 bg-[#07110E] p-5 sm:p-6 flex flex-col justify-between">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- BATCH IDENTITY -->
                            <div class="space-y-3">
                                <div class="text-xs font-bold uppercase tracking-wider text-gray-400 border-b border-white/10 pb-2">BATCH IDENTITY</div>
                                <dl class="space-y-2 text-xs">
                                    <div class="flex justify-between"><dt class="text-gray-400">Batch ID</dt><dd class="font-bold text-white">NK-001</dd></div>
                                    <div class="flex justify-between"><dt class="text-gray-400">Project</dt><dd class="font-bold text-white">North Kalimantan Palm</dd></div>
                                    <div class="flex justify-between"><dt class="text-gray-400">Asset Type</dt><dd class="font-bold text-white">Palm Production</dd></div>
                                    <div class="flex justify-between"><dt class="text-gray-400">Location</dt><dd class="font-bold text-white">North Kalimantan, Indonesia</dd></div>
                                    <div class="flex justify-between"><dt class="text-gray-400">Batch Size</dt><dd class="font-bold text-white">100 HA</dd></div>
                                    <div class="flex justify-between"><dt class="text-gray-400">Production Standard</dt><dd class="font-bold text-white">Standardized Agronomic Protocol</dd></div>
                                </dl>
                            </div>

                            <!-- PROGRAM PARAMETERS -->
                            <div class="space-y-3">
                                <div class="text-xs font-bold uppercase tracking-wider text-gray-400 border-b border-white/10 pb-2">PROGRAM PARAMETERS</div>
                                <dl class="space-y-2 text-xs">
                                    <div class="flex justify-between"><dt class="text-gray-400">Contract Horizon</dt><dd class="font-bold text-white">20 years</dd></div>
                                    <div class="flex justify-between"><dt class="text-gray-400">Development / Ramp-Up</dt><dd class="font-bold text-white">5 years</dd></div>
                                    <div class="flex justify-between"><dt class="text-gray-400">Commercial Delivery</dt><dd class="font-bold text-white">15 years</dd></div>
                                    <div class="flex justify-between"><dt class="text-gray-400">Seed</dt><dd class="font-bold text-white">Certified Superior Seed</dd></div>
                                    <div class="flex justify-between"><dt class="text-gray-400">Planting Density</dt><dd class="font-bold text-white">143 trees / ha</dd></div>
                                    <div class="flex justify-between"><dt class="text-gray-400">Production Model</dt><dd class="font-bold text-white">18.03 t TBS / he. / year*</dd></div>
                                </dl>
                            </div>
                        </div>
                        <p class="text-[9px] italic text-gray-500 mt-4 border-t border-white/5 pt-2">* Reference benchmark / model parameter. Actual production depends on verified agronomic and operational conditions.</p>
                    </div>

                    <!-- Right: Quick Summary Card -->
                    <div class="lg:col-span-4 rounded-xl border border-white/10 bg-[#07110E] p-4 flex flex-col justify-between space-y-3">
                        <div class="space-y-3">
                            <div class="relative h-32 overflow-hidden rounded-lg">
                                <img src="<?= $basePrefix ?>/1.jpg" alt="North Kalimantan Estate" class="h-full w-full object-cover" />
                                <span class="absolute top-2 right-2 rounded bg-emerald-950/90 border border-emerald-400/40 px-2 py-0.5 text-[9px] font-bold text-emerald-300">DEMO</span>
                            </div>
                            <div>
                                <div class="text-sm font-extrabold text-white">North Kalimantan Palm</div>
                                <div class="text-[10px] text-gray-400 flex items-center gap-1.5 mt-0.5">
                                    <span class="text-emerald-300"><?= $svg($ic['leaf'], 'w-3.5 h-3.5') ?></span> Palm Production
                                </div>
                            </div>
                            <div class="space-y-2 text-xs border-t border-white/10 pt-3">
                                <div class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">Quick Summary</div>
                                <div class="flex justify-between"><span class="text-gray-400">Batch Size</span><span class="font-bold text-white">100 HA</span></div>
                                <div class="flex justify-between"><span class="text-gray-400">Requirement</span><span class="font-bold text-emerald-300">880,000 USDT</span></div>
                                <div class="flex justify-between"><span class="text-gray-400">Min. PO Allocation</span><span class="font-bold text-white">8,000 USDT</span></div>
                                <div class="flex justify-between"><span class="text-gray-400">Status</span><span class="font-bold text-amber-300 flex items-center gap-1"><span class="text-[10px]">ⓘ</span> Pending</span></div>
                            </div>
                        </div>

                        <div class="space-y-2 pt-2">
                            <button type="button" @click="openModal = true"
                                    class="w-full inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-[#6EE7B7] to-[#A7F3D0] px-5 py-2.5 text-[11px] font-extrabold uppercase tracking-wider text-[#04100B] shadow-lg shadow-emerald-950/40 transition hover:brightness-110">
                                <span>TAKE PO ALLOCATION</span><?= $arrow ?>
                            </button>

                            <div class="grid grid-cols-2 gap-2 text-center text-[10px]">
                                <a href="#rab-section" class="rounded-full border border-white/15 bg-white/5 py-1.5 font-bold uppercase text-gray-300 transition hover:bg-white/10">VIEW RAB</a>
                                <a href="#verification-section" class="rounded-full border border-white/15 bg-white/5 py-1.5 font-bold uppercase text-gray-300 transition hover:bg-white/10">VIEW VERIFICATION</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ---------- PO ALLOCATION STATUS ---------- -->
            <section class="<?= $card ?> p-5 lg:p-6 space-y-4">
                <div>
                    <h2 class="text-base font-bold text-white">PO Allocation Status</h2>
                    <p class="text-xs text-gray-300">The batch becomes executable through defined production capacity and completed PO allocation.</p>
                </div>

                <div class="grid grid-cols-1 gap-4 lg:grid-cols-12 items-stretch">
                    <!-- Left: PO Collection Progress & 4 Summary Cards -->
                    <div class="lg:col-span-5 rounded-xl border border-white/10 bg-[#07110E] p-5 flex flex-col justify-between space-y-4">
                        <!-- Progress Bar Box -->
                        <div class="space-y-2 rounded-xl border border-white/10 bg-[#050D0A] p-4">
                            <div class="flex justify-between text-xs font-bold">
                                <span class="text-gray-400">PO COLLECTION</span>
                                <span class="text-white">0 USDT <span class="text-gray-400">/ 880,000 USDT</span></span>
                                <span class="text-emerald-300">0%</span>
                            </div>
                            <div class="h-2 w-full overflow-hidden rounded-full bg-white/10">
                                <div class="h-full w-0 rounded-full bg-emerald-400"></div>
                            </div>
                        </div>

                        <!-- 4 Summary Cards -->
                        <div class="grid grid-cols-2 gap-2 sm:grid-cols-4">
                            <div class="rounded-lg border border-white/10 bg-[#050D0A] p-2.5">
                                <div class="text-[8px] font-bold uppercase text-gray-400 leading-tight">TOTAL PRODUCTION REQUIREMENT</div>
                                <div class="text-xs font-extrabold text-white mt-1">880,000 USDT</div>
                            </div>
                            <div class="rounded-lg border border-white/10 bg-[#050D0A] p-2.5">
                                <div class="text-[8px] font-bold uppercase text-gray-400 leading-tight">COLLECTED</div>
                                <div class="text-xs font-extrabold text-white mt-1">0 USDT</div>
                            </div>
                            <div class="rounded-lg border border-white/10 bg-[#050D0A] p-2.5">
                                <div class="text-[8px] font-bold uppercase text-gray-400 leading-tight">REMAINING</div>
                                <div class="text-xs font-extrabold text-emerald-300 mt-1">880,000 USDT</div>
                            </div>
                            <div class="rounded-lg border border-white/10 bg-[#050D0A] p-2.5">
                                <div class="text-[8px] font-bold uppercase text-gray-400 leading-tight">MINIMUM ALLOCATION</div>
                                <div class="text-xs font-extrabold text-white mt-1">8,000 USDT</div>
                            </div>
                        </div>
                    </div>

                    <!-- Center: Standard Allocation Unit Formula -->
                    <div class="lg:col-span-3 rounded-xl border border-white/10 bg-[#07110E] p-5 flex flex-col justify-between space-y-4">
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-white">Standard Allocation Unit</h3>
                            <p class="text-[10px] text-gray-400 mt-2 leading-relaxed">
                                One 100 HA batch is modeled at 880,000 USDT and represented by 110 minimum 8,000 USDT PO allocation seats, allowing members to diversify capital across multiple batches.
                            </p>
                        </div>

                        <!-- Formula Box -->
                        <div class="flex items-center justify-between rounded-lg border border-emerald-500/20 bg-emerald-950/20 p-3 text-center text-xs font-bold">
                            <div>
                                <div class="text-emerald-300">880,000 USDT</div>
                                <div class="text-[7px] text-gray-400 font-normal uppercase mt-0.5">Batch Requirement</div>
                            </div>
                            <div class="text-gray-400 font-normal">&divide;</div>
                            <div>
                                <div class="text-emerald-300">8,000 USDT</div>
                                <div class="text-[7px] text-gray-400 font-normal uppercase mt-0.5">Min. Allocation</div>
                            </div>
                            <div class="text-gray-400 font-normal">=</div>
                            <div>
                                <div class="text-white text-sm">110</div>
                                <div class="text-[7px] text-emerald-300 font-bold uppercase mt-0.5">Seats</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Allocation Grid (15 Slots) -->
                    <div class="lg:col-span-4 rounded-xl border border-white/10 bg-[#07110E] p-5 space-y-3">
                        <div class="text-[10px] font-bold uppercase tracking-wider text-gray-300">Allocation Units (15)</div>
                        <div class="grid grid-cols-5 gap-1.5 text-center text-[9px]">
                            <?php for ($i = 1; $i <= 15; $i++): ?>
                                <div class="rounded border border-white/10 bg-[#050D0A] py-1.5 px-1 flex flex-col items-center justify-center">
                                    <div class="font-extrabold text-white text-[10px]"><?= sprintf('%02d', $i) ?></div>
                                    <div class="text-[7px] text-emerald-400 font-semibold uppercase">Available</div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ---------- PRODUCTION EXECUTION MILESTONES ---------- -->
            <section class="<?= $card ?> p-5 lg:p-6 space-y-6">
                <div>
                    <h2 class="text-base font-bold text-white">Production Execution Milestones</h2>
                    <p class="text-xs text-gray-300">From PO collection to commercial delivery, each milestone is verified and tracked.</p>
                </div>

                <!-- Unbroken Continuous Pipeline Line -->
                <div class="relative overflow-x-auto pb-4 pt-2">
                    <div class="relative min-w-[720px] px-8">
                        <!-- Single uninterrupted line behind step circles -->
                        <div class="absolute top-[18px] left-[48px] right-[48px] h-[2px] bg-white/20 z-0"></div>

                        <!-- Step Nodes -->
                        <div class="relative z-10 flex items-start justify-between text-center text-[10px]">
                            <?php
                            $milestonesPipeline = [
                                ['step' => '01', 'name' => 'PO COLLECTION', 'desc' => '0%', 'active' => true],
                                ['step' => '02', 'name' => 'MILESTONE 1', 'desc' => '25%', 'active' => false],
                                ['step' => '03', 'name' => 'MILESTONE 2', 'desc' => '25%', 'active' => false],
                                ['step' => '04', 'name' => 'MILESTONE 4', 'desc' => '25%', 'active' => false],
                                ['step' => '06', 'name' => 'PRODUCTION', 'desc' => '25%', 'active' => false],
                                ['step' => '07', 'name' => 'HARVESTING', 'desc' => '', 'active' => false],
                                ['step' => '08', 'name' => 'PROCESSING', 'desc' => '', 'active' => false],
                                ['step' => '09', 'name' => 'DELIVERY', 'desc' => '', 'active' => false],
                            ];
                            foreach ($milestonesPipeline as $m):
                            ?>
                                <div class="flex flex-col items-center gap-1.5 min-w-[75px] group">
                                    <div class="h-9 w-9 rounded-full border flex items-center justify-center text-xs font-extrabold transition z-10
                                        <?= $m['active'] 
                                            ? 'border-emerald-400 bg-emerald-400 text-[#04100B] shadow-lg shadow-emerald-950' 
                                            : 'border-white/30 bg-[#07110E] text-white' ?>">
                                        <?= $m['step'] ?>
                                    </div>
                                    <div class="font-extrabold uppercase tracking-tight text-white whitespace-nowrap"><?= $m['name'] ?></div>
                                    <?php if ($m['desc']): ?>
                                        <div class="text-[9px] text-emerald-400 font-extrabold tracking-wider"><?= $m['desc'] ?></div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Bottom 3 Grid Cards -->
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">

                    <!-- Milestone 01 Details -->
                    <div id="milestones-section" class="rounded-xl border border-white/10 bg-[#07110E] p-4 space-y-3">
                        <div class="flex items-center justify-between border-b border-white/10 pb-2">
                            <div class="flex items-center gap-2">
                                <span class="h-6 w-6 rounded-full bg-emerald-400 text-[#04100B] text-xs font-bold flex items-center justify-center">01</span>
                                <div>
                                    <div class="text-xs font-bold text-white">MILESTONE 01</div>
                                    <div class="text-[9px] text-emerald-300">25% Execution Stage</div>
                                </div>
                            </div>
                            <span class="rounded bg-amber-500/20 px-2 py-0.5 text-[9px] font-bold text-amber-300 border border-amber-400/30">PENDING</span>
                        </div>

                        <div class="space-y-2 text-xs">
                            <div class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Required Conditions</div>
                            <ul class="space-y-1.5 text-[11px] text-gray-300">
                                <li class="flex items-center gap-2"><span class="text-emerald-400">✓</span> PO Collection</li>
                                <li class="flex items-center gap-2"><span class="text-emerald-400">✓</span> RAB Confirmation</li>
                                <li class="flex items-center gap-2"><span class="text-emerald-400">✓</span> Vendor Assignment</li>
                                <li class="flex items-center gap-2"><span class="text-emerald-400">✓</span> Execution Approval</li>
                                <li class="flex items-center gap-2"><span class="text-emerald-400">✓</span> Verification Record</li>
                            </ul>
                        </div>

                        <a href="<?= $basePrefix ?>/milestones" class="inline-flex w-full items-center justify-center gap-1.5 rounded-lg border border-white/20 py-2 text-[10px] font-bold uppercase tracking-wider text-white transition hover:bg-white/10">
                            <span>View Milestone Requirements</span><?= $arrow ?>
                        </a>
                    </div>

                    <!-- Batch RAB Breakdown -->
                    <div id="rab-section" class="rounded-xl border border-white/10 bg-[#07110E] p-4 space-y-3">
                        <div class="border-b border-white/10 pb-2">
                            <div class="text-xs font-bold text-white">Batch RAB</div>
                            <div class="text-[9px] text-gray-400">How the 880,000 USDT requirement is allocated across categories.</div>
                        </div>

                        <ul class="space-y-1 text-[10px] divide-y divide-white/5">
                            <li class="flex justify-between py-1"><span class="text-gray-300">1. Land / Partnership</span><span class="text-gray-400">To be defined</span></li>
                            <li class="flex justify-between py-1"><span class="text-gray-300">2. Land Preparation</span><span class="text-gray-400">To be defined</span></li>
                            <li class="flex justify-between py-1"><span class="text-gray-300">3. Seedlings</span><span class="text-gray-400">To be defined</span></li>
                            <li class="flex justify-between py-1"><span class="text-gray-300">4. Fertilizer & Inputs</span><span class="text-gray-400">To be defined</span></li>
                            <li class="flex justify-between py-1"><span class="text-gray-300">5. Machinery & Equipment</span><span class="text-gray-400">To be defined</span></li>
                            <li class="flex justify-between py-1"><span class="text-gray-300">6. Infrastructure</span><span class="text-gray-400">To be defined</span></li>
                            <li class="flex justify-between py-1"><span class="text-gray-300">7. Maintenance</span><span class="text-gray-400">To be defined</span></li>
                            <li class="flex justify-between py-1"><span class="text-gray-300">8. Operations</span><span class="text-gray-400">To be defined</span></li>
                            <li class="flex justify-between py-1"><span class="text-gray-300">9. Contingency</span><span class="text-gray-400">To be defined</span></li>
                        </ul>

                        <div class="flex items-center justify-between border-t border-white/10 pt-2 text-xs">
                            <span class="text-gray-400 uppercase font-bold text-[9px]">Total Batch Requirement</span>
                            <span class="font-extrabold text-white">880,000 USDT</span>
                        </div>
                    </div>

                    <!-- Production Vendors -->
                    <div id="vendors-section" class="rounded-xl border border-white/10 bg-[#07110E] p-4 space-y-3">
                        <div class="border-b border-white/10 pb-2">
                            <div class="text-xs font-bold text-white">Production Vendors</div>
                            <div class="text-[9px] text-gray-400">Vendors connected to the project's RAB and operating requirements.</div>
                        </div>

                        <div class="space-y-2 text-xs">
                            <div class="flex items-center justify-between rounded border border-white/5 bg-white/5 p-2">
                                <div>
                                    <div class="text-[9px] font-bold text-gray-400 uppercase">Seed Supplier</div>
                                    <div class="font-bold text-white text-[11px]">Certified Seed Producer</div>
                                </div>
                                <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span>
                            </div>

                            <div class="flex items-center justify-between rounded border border-white/5 bg-white/5 p-2">
                                <div>
                                    <div class="text-[9px] font-bold text-gray-400 uppercase">Fertilizer Supplier</div>
                                    <div class="font-bold text-white text-[11px]">Agro Input Supplier</div>
                                </div>
                                <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span>
                            </div>

                            <div class="flex items-center justify-between rounded border border-white/5 bg-white/5 p-2">
                                <div>
                                    <div class="text-[9px] font-bold text-gray-400 uppercase">Heavy Equipment</div>
                                    <div class="font-bold text-white text-[11px]">Excavator & Land Prep</div>
                                </div>
                                <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span>
                            </div>

                            <div class="flex items-center justify-between rounded border border-white/5 bg-white/5 p-2">
                                <div>
                                    <div class="text-[9px] font-bold text-gray-400 uppercase">Logistics</div>
                                    <div class="font-bold text-white text-[11px]">Production Logistics</div>
                                </div>
                                <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span>
                            </div>
                        </div>

                        <a href="<?= $basePrefix ?>/vendors" class="inline-flex w-full items-center justify-center gap-1.5 rounded-lg border border-white/20 py-2 text-[10px] font-bold uppercase tracking-wider text-white transition hover:bg-white/10">
                            <span>View Vendor Ecosystem</span><?= $arrow ?>
                        </a>
                    </div>

                </div>
            </section>

            <!-- ---------- WALLET, TRANSACTIONS & EXECUTION ---------- -->
            <section class="grid grid-cols-1 gap-4 lg:grid-cols-3">

                <!-- Registered Entity Wallet -->
                <div class="<?= $card ?> p-5 space-y-3">
                    <div class="text-xs font-bold uppercase tracking-wider text-white border-b border-white/10 pb-2">Registered Entity Wallet</div>
                    <p class="text-[10px] text-gray-400 leading-snug">Each registered operating entity is linked to a fixed registered wallet identity for transaction traceability.</p>

                    <div class="rounded-lg border border-white/10 bg-[#07110E] p-3 space-y-2">
                        <div class="text-[10px] text-gray-400">ENTITY</div>
                        <div class="text-xs font-bold text-white">Demo Production Partner</div>
                        <div class="text-[10px] text-gray-400 pt-1">REGISTERED WALLET</div>
                        <div class="text-xs font-mono font-bold text-emerald-300">0x7A3F...C2B8</div>
                        <div class="flex items-center gap-1 text-[9px] font-bold text-emerald-300 pt-1">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span> REGISTERED / DEMO
                        </div>
                    </div>

                    <a href="<?= $basePrefix ?>/audit-trail" class="inline-flex w-full items-center justify-center gap-1.5 rounded-lg border border-white/20 py-2 text-[10px] font-bold uppercase tracking-wider text-white transition hover:bg-white/10">
                        <span>View Wallet Record</span><?= $arrow ?>
                    </a>
                </div>

                <!-- Batch Transaction Record -->
                <div class="<?= $card ?> p-5 space-y-3">
                    <div class="text-xs font-bold uppercase tracking-wider text-white border-b border-white/10 pb-2">Batch Transaction Record</div>
                    <p class="text-[10px] text-gray-400 leading-snug">Transaction history will be updated as events occur.</p>

                    <div class="space-y-2 text-[11px]">
                        <div class="flex items-center justify-between py-1 border-b border-white/5">
                            <span class="text-white font-medium">Batch Created</span>
                            <span class="font-mono text-gray-400">NK-001</span>
                            <span class="text-emerald-300 font-bold text-[9px]">COMPLETED</span>
                        </div>
                        <div class="flex items-center justify-between py-1 border-b border-white/5">
                            <span class="text-white font-medium">RAB Created</span>
                            <span class="font-mono text-gray-400">RAB-NK-001</span>
                            <span class="text-emerald-300 font-bold text-[9px]">COMPLETED</span>
                        </div>
                        <div class="flex items-center justify-between py-1 border-b border-white/5">
                            <span class="text-white font-medium">Vendor Assigned</span>
                            <span class="font-mono text-gray-400">VEN-001</span>
                            <span class="text-amber-300 font-bold text-[9px]">PENDING</span>
                        </div>
                        <div class="flex items-center justify-between py-1 border-b border-white/5">
                            <span class="text-white font-medium">PO Allocation</span>
                            <span class="font-mono text-gray-400">-</span>
                            <span class="text-amber-300 font-bold text-[9px]">PENDING</span>
                        </div>
                        <div class="flex items-center justify-between py-1">
                            <span class="text-white font-medium">Milestone 1 Release</span>
                            <span class="font-mono text-gray-400">-</span>
                            <span class="text-amber-300 font-bold text-[9px]">PENDING</span>
                        </div>
                    </div>
                </div>

                <!-- Production Execution Progress -->
                <div class="<?= $card ?> p-5 space-y-3">
                    <div class="text-xs font-bold uppercase tracking-wider text-white border-b border-white/10 pb-2">Production Execution</div>
                    <p class="text-[10px] text-gray-400 leading-snug">Current status of the production process.</p>

                    <div class="grid grid-cols-4 gap-2 text-center text-[9px] pt-1">
                        <div class="rounded border border-emerald-400/30 bg-emerald-950/40 p-2">
                            <div class="text-emerald-300 font-bold">Land</div>
                            <div class="text-[7px] text-amber-300">Pending</div>
                        </div>
                        <div class="rounded border border-white/10 bg-[#07110E] p-2">
                            <div class="text-gray-300 font-bold">Prep</div>
                            <div class="text-[7px] text-gray-500">Not Started</div>
                        </div>
                        <div class="rounded border border-white/10 bg-[#07110E] p-2">
                            <div class="text-gray-300 font-bold">Planting</div>
                            <div class="text-[7px] text-gray-500">Not Started</div>
                        </div>
                        <div class="rounded border border-white/10 bg-[#07110E] p-2">
                            <div class="text-gray-300 font-bold">Maintenance</div>
                            <div class="text-[7px] text-gray-500">Not Started</div>
                        </div>
                        <div class="rounded border border-white/10 bg-[#07110E] p-2">
                            <div class="text-gray-300 font-bold">Growth</div>
                            <div class="text-[7px] text-gray-500">Not Started</div>
                        </div>
                        <div class="rounded border border-white/10 bg-[#07110E] p-2">
                            <div class="text-gray-300 font-bold">Harvest</div>
                            <div class="text-[7px] text-gray-500">Not Started</div>
                        </div>
                        <div class="rounded border border-white/10 bg-[#07110E] p-2">
                            <div class="text-gray-300 font-bold">Processing</div>
                            <div class="text-[7px] text-gray-500">Not Started</div>
                        </div>
                        <div class="rounded border border-white/10 bg-[#07110E] p-2">
                            <div class="text-gray-300 font-bold">Delivery</div>
                            <div class="text-[7px] text-gray-500">Not Started</div>
                        </div>
                    </div>
                </div>

            </section>

            <!-- ---------- FIELD VERIFICATION & EVIDENCE ---------- -->
            <section id="verification-section" class="grid grid-cols-1 gap-4 lg:grid-cols-12">

                <!-- Field Verification -->
                <div class="<?= $card ?> p-5 lg:col-span-5 space-y-4">
                    <div class="border-b border-white/10 pb-2">
                        <div class="text-xs font-bold uppercase tracking-wider text-white">Field Verification</div>
                        <div class="text-[10px] text-gray-400">Verification status for key production elements.</div>
                    </div>

                    <div class="grid grid-cols-5 gap-2 text-center text-[9px]">
                        <div class="rounded border border-white/10 bg-[#07110E] p-2">
                            <div class="font-bold text-white">Land</div>
                            <div class="text-[7px] text-gray-400">GIS Boundary</div>
                            <div class="mt-1 text-[8px] font-bold text-amber-300">PENDING</div>
                        </div>
                        <div class="rounded border border-white/10 bg-[#07110E] p-2">
                            <div class="font-bold text-white">Seed</div>
                            <div class="text-[7px] text-gray-400">Seed Source</div>
                            <div class="mt-1 text-[8px] font-bold text-amber-300">PENDING</div>
                        </div>
                        <div class="rounded border border-white/10 bg-[#07110E] p-2">
                            <div class="font-bold text-white">Partner</div>
                            <div class="text-[7px] text-gray-400">Prod. Partner</div>
                            <div class="mt-1 text-[8px] font-bold text-amber-300">PENDING</div>
                        </div>
                        <div class="rounded border border-white/10 bg-[#07110E] p-2">
                            <div class="font-bold text-white">Production</div>
                            <div class="text-[7px] text-gray-400">Field Verif.</div>
                            <div class="mt-1 text-[8px] font-bold text-gray-500">NOT STARTED</div>
                        </div>
                        <div class="rounded border border-white/10 bg-[#07110E] p-2">
                            <div class="font-bold text-white">Document</div>
                            <div class="text-[7px] text-gray-400">Documentation</div>
                            <div class="mt-1 text-[8px] font-bold text-amber-300">PENDING</div>
                        </div>
                    </div>

                    <a href="<?= $basePrefix ?>/verification" class="inline-flex w-full items-center justify-center gap-1.5 rounded-lg border border-white/20 py-2 text-[10px] font-bold uppercase tracking-wider text-white transition hover:bg-white/10">
                        <span>View Verification Records</span><?= $arrow ?>
                    </a>
                </div>

                <!-- Field Evidence Grid -->
                <div class="<?= $card ?> p-5 lg:col-span-7 space-y-3">
                    <div class="border-b border-white/10 pb-2">
                        <div class="text-xs font-bold uppercase tracking-wider text-white">Field Evidence</div>
                        <div class="text-[10px] text-gray-400">Latest field documentation and imagery.</div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                        <div class="space-y-1">
                            <div class="relative h-20 overflow-hidden rounded-lg border border-white/10">
                                <img src="<?= $basePrefix ?>/1.jpg" alt="Land" class="h-full w-full object-cover" />
                            </div>
                            <div class="text-[10px] font-bold text-white">Land</div>
                            <div class="text-[8px] text-gray-400">(DEMO IMAGE)</div>
                        </div>

                        <div class="space-y-1">
                            <div class="relative h-20 overflow-hidden rounded-lg border border-white/10">
                                <img src="<?= $basePrefix ?>/2.jpg" alt="Access Road" class="h-full w-full object-cover" />
                            </div>
                            <div class="text-[10px] font-bold text-white">Access Road</div>
                            <div class="text-[8px] text-gray-400">(DEMO IMAGE)</div>
                        </div>

                        <div class="space-y-1">
                            <div class="relative h-20 overflow-hidden rounded-lg border border-white/10">
                                <img src="<?= $basePrefix ?>/1.jpg" alt="Planting Area" class="h-full w-full object-cover" />
                            </div>
                            <div class="text-[10px] font-bold text-white">Planting Area</div>
                            <div class="text-[8px] text-gray-400">(DEMO IMAGE)</div>
                        </div>

                        <div class="space-y-1">
                            <div class="relative h-20 overflow-hidden rounded-lg border border-white/10">
                                <img src="<?= $basePrefix ?>/2.jpg" alt="Production Site" class="h-full w-full object-cover" />
                            </div>
                            <div class="text-[10px] font-bold text-white">Production Site</div>
                            <div class="text-[8px] text-gray-400">(DEMO IMAGE)</div>
                        </div>
                    </div>
                </div>

            </section>

            <!-- ---------- BOTTOM BANNER & CTA ---------- -->
            <section class="overflow-hidden rounded-xl border border-white/10 bg-[#08130F]/90 p-5 shadow-xl">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-3">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-emerald-400/30 bg-emerald-950/60 text-emerald-300"><?= $svg($ic['leaf']) ?></span>
                        <div>
                            <div class="text-sm font-bold text-white">Enter the Production Batch</div>
                            <div class="text-[11px] text-gray-300">Review the PO allocation, RAB, milestones and verification records before proceeding with the production allocation.</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="button" @click="openModal = true"
                                class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-[#6EE7B7] to-[#C9F5DE] px-6 py-3 text-[11px] font-bold uppercase tracking-wider text-[#04100B] shadow-lg shadow-emerald-950/40 transition hover:brightness-110">
                            <span>Take PO Allocation</span><?= $arrow ?>
                        </button>
                        <a href="<?= $basePrefix ?>/explore" class="inline-flex items-center gap-2 rounded-full border border-white/30 bg-black/30 px-5 py-3 text-[11px] font-semibold uppercase tracking-wider text-white backdrop-blur-md transition hover:bg-white/10">
                            <span>Back to Project</span>
                        </a>
                    </div>
                </div>
            </section>

        </div>

    </div>

    <!-- ================= PO ALLOCATION REVIEW MODAL ================= -->
    <div x-show="openModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-md p-4">
        <div @click.away="closeModal()" class="w-full max-w-lg rounded-xl border border-white/15 bg-[#0B1815] p-6 shadow-2xl space-y-4">
            
            <div x-show="!modalSuccess" class="space-y-4">
                <div class="flex items-center justify-between border-b border-white/10 pb-3">
                    <div>
                        <div class="text-xs font-bold uppercase tracking-wider text-emerald-300">TAKE PO ALLOCATION</div>
                        <div class="text-lg font-extrabold text-white mt-0.5">Batch NK-001</div>
                    </div>
                    <button type="button" @click="closeModal()" class="text-gray-400 hover:text-white">&times;</button>
                </div>

                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div class="rounded-lg border border-white/10 bg-[#07110E] p-3">
                        <div class="text-[9px] uppercase text-gray-400">Allocation Unit</div>
                        <div class="text-sm font-extrabold text-white mt-0.5">8,000 USDT</div>
                    </div>
                    <div class="rounded-lg border border-white/10 bg-[#07110E] p-3">
                        <div class="text-[9px] uppercase text-gray-400">Batch 100 HA Requirement</div>
                        <div class="text-sm font-extrabold text-emerald-300 mt-0.5">880,000 USDT</div>
                    </div>
                </div>

                <div class="rounded-lg border border-amber-400/30 bg-amber-950/30 p-3 text-[11px] leading-relaxed text-amber-200">
                    <strong>Notice:</strong> You are requesting a PO allocation within Batch NK-001. This action does not represent a transfer of land ownership.
                </div>

                <div class="space-y-2 text-xs">
                    <label class="flex items-start gap-2.5 cursor-pointer text-gray-300 hover:text-white">
                        <input type="checkbox" x-model="chk1" class="mt-0.5 rounded border-white/20 bg-[#07110E] text-emerald-400 focus:ring-0" />
                        <span>I have reviewed the batch information.</span>
                    </label>
                    <label class="flex items-start gap-2.5 cursor-pointer text-gray-300 hover:text-white">
                        <input type="checkbox" x-model="chk2" class="mt-0.5 rounded border-white/20 bg-[#07110E] text-emerald-400 focus:ring-0" />
                        <span>I understand the production and commercial structure.</span>
                    </label>
                    <label class="flex items-start gap-2.5 cursor-pointer text-gray-300 hover:text-white">
                        <input type="checkbox" x-model="chk3" class="mt-0.5 rounded border-white/20 bg-[#07110E] text-emerald-400 focus:ring-0" />
                        <span>I understand that all figures shown are prototype/model parameters.</span>
                    </label>
                    <label class="flex items-start gap-2.5 cursor-pointer text-gray-300 hover:text-white">
                        <input type="checkbox" x-model="chk4" class="mt-0.5 rounded border-white/20 bg-[#07110E] text-emerald-400 focus:ring-0" />
                        <span>I acknowledge that final legal and commercial documentation applies.</span>
                    </label>
                </div>

                <div class="pt-2 flex items-center justify-end gap-3">
                    <button type="button" @click="closeModal()" class="rounded-full border border-white/20 px-5 py-2 text-xs font-semibold uppercase text-gray-300 hover:text-white">Cancel</button>
                    <button type="button" @click="submitAllocation()" :disabled="!canSubmit"
                            :class="canSubmit ? 'bg-gradient-to-r from-[#6EE7B7] to-[#C9F5DE] text-[#04100B] font-bold hover:brightness-110' : 'bg-white/10 text-gray-500 cursor-not-allowed'"
                            class="rounded-full px-6 py-2 text-xs uppercase tracking-wider transition">
                        Continue to Allocation Review
                    </button>
                </div>
            </div>

            <!-- Modal Success / Confirmed State -->
            <div x-show="modalSuccess" style="display:none" class="space-y-4 text-center py-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-emerald-400/20 text-emerald-300 mx-auto border border-emerald-400/40">
                    <?= $svg($ic['check'], 'w-6 h-6') ?>
                </div>
                <h3 class="text-lg font-extrabold text-white">PO Allocation Requested</h3>
                <p class="text-xs text-gray-300 max-w-sm mx-auto">
                    Your allocation request for 1 Seat (8,000 USDT) on Batch NK-001 has been registered for prototype review.
                </p>
                <div class="pt-2 flex justify-center gap-3">
                    <a href="<?= $basePrefix ?>/allocations" class="rounded-full bg-emerald-400 px-6 py-2 text-xs font-bold uppercase text-[#04100B] hover:brightness-110">Go to My Allocations</a>
                    <button type="button" @click="closeModal()" class="rounded-full border border-white/20 px-5 py-2 text-xs font-semibold uppercase text-gray-300 hover:text-white">Close</button>
                </div>
            </div>

        </div>
    </div>

</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
