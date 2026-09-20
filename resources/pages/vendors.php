<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '11 / Vendor & Partner Detail — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'vendors';

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
    'filter'    => '<polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>',
    'download'  => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>',
    'search'    => '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>',
    'user'      => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
    'building'  => '<rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/>',
    'truck'     => '<rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>',
    'wallet'    => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 10h20"/><path d="M16 14h.01"/>',
    'star'      => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
    'lock'      => '<rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
    'award'     => '<circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>',
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

        <!-- ================= 1 & 2. HERO HEADER SECTION ================= -->
        <section class="relative overflow-hidden border-b border-white/10 shadow-2xl">
            <img src="<?= $basePrefix ?>/1.jpg" alt="Natural forest canopy" class="absolute inset-0 h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#050D07]/90 via-[#050D07]/60 to-[#050D07]/20"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#06120F]/90 via-transparent to-transparent"></div>

            <div class="relative space-y-6 px-6 py-8 lg:px-8 lg:py-10">

                <!-- Top Row: Breadcrumb & Right Header CTA Buttons -->
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="inline-flex flex-wrap items-center gap-2 rounded-full border border-white/15 bg-black/40 px-3 py-1.5 text-[9px] font-semibold uppercase tracking-[0.14em] text-gray-300 backdrop-blur-md">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                        <a href="<?= $basePrefix ?>/allocations" class="hover:text-white">MY ALLOCATIONS</a>
                        <span class="text-gray-500">&rsaquo;</span>
                        <a href="<?= $basePrefix ?>/explore" class="hover:text-white">NORTH KALIMANTAN PALM</a>
                        <span class="text-gray-500">&rsaquo;</span>
                        <a href="<?= $basePrefix ?>/batches" class="hover:text-white">BATCH NK-001</a>
                        <span class="text-gray-500">&rsaquo;</span>
                        <a href="<?= $basePrefix ?>/milestones" class="hover:text-white">MILESTONE 01</a>
                        <span class="text-gray-500">&rsaquo;</span>
                        <a href="<?= $basePrefix ?>/rab" class="hover:text-white">RAB</a>
                        <span class="text-gray-500">&rsaquo;</span>
                        <a href="<?= $basePrefix ?>/vendors" class="hover:text-white">VENDORS</a>
                        <span class="text-gray-500">&rsaquo;</span>
                        <span class="font-bold text-white">VENDOR-001</span>
                    </div>

                    <!-- Header Primary/Secondary Actions (Top Right) -->
                    <div class="flex flex-wrap items-center gap-2 text-[10px] font-bold">
                        <a href="#verification-matrix" class="rounded-lg bg-emerald-950/80 border border-emerald-400/40 px-3 py-1.5 text-emerald-300 hover:bg-emerald-900/80 uppercase tracking-wide">REQUEST VERIFICATION</a>
                        <a href="<?= $basePrefix ?>/milestones" class="rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10 uppercase tracking-wide">VIEW ACTIVE WORK</a>
                        <a href="<?= $basePrefix ?>/explore" class="rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10 uppercase tracking-wide">VIEW PROJECTS</a>
                        <a href="#verification-matrix" class="rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10 uppercase tracking-wide">VIEW VERIFICATION</a>
                        <a href="<?= $basePrefix ?>/audit-trail" class="rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-gray-300 hover:bg-white/10 uppercase tracking-wide">VIEW AUDIT TRAIL</a>
                    </div>
                </div>

                <!-- Headline & Subheadline -->
                <div class="space-y-3">
                    <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-200">
                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">PRODUCTION NETWORK</span>
                        <span>11 / VENDOR & PARTNER DETAIL</span>
                    </div>

                    <h1 class="max-w-3xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">Verified Production Partner</h1>
                    
                    <p class="max-w-3xl text-sm font-medium leading-relaxed text-gray-200">
                        Every production activity is linked to an identified partner, verified capacity, operational history and traceable execution record.
                    </p>
                    <p class="text-[11px] italic text-gray-400">
                        Setiap aktivitas produksi terhubung dengan identitas mitra, kapasitas terverifikasi, rekam aktivitas dan bukti pelaksanaan yang dapat ditelusuri.
                    </p>
                </div>

                <!-- ENTITY CARD (Hero Bottom) -->
                <div class="rounded-xl border border-white/15 bg-[#08130F]/80 p-5 shadow-2xl backdrop-blur-xl space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-white/10 pb-3">
                        <div class="flex items-center gap-3">
                            <span class="<?= $iconBox ?> h-11 w-11 text-emerald-300"><?= $svg($ic['building'], 'w-5 h-5') ?></span>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h2 class="text-lg font-black text-white">DEMO PRODUCTION PARTNER</h2>
                                    <span class="rounded border border-amber-400/40 bg-amber-500/20 px-2 py-0.5 text-[8px] font-bold tracking-wider text-amber-300">PENDING VERIFICATION</span>
                                </div>
                                <div class="text-[10px] font-mono text-gray-400 mt-0.5">PARTNER ID: <strong class="text-gray-200">PT-NINA-PARTNER-001</strong></div>
                            </div>
                        </div>
                    </div>

                    <!-- 4 Entity Pills -->
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 text-xs">
                        <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-0.5">
                            <div class="text-[8px] font-bold uppercase text-gray-400">ENTITY TYPE</div>
                            <div class="font-bold text-white text-[11px]">Production Partner</div>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-0.5">
                            <div class="text-[8px] font-bold uppercase text-gray-400">CATEGORY</div>
                            <div class="font-bold text-white text-[11px]">Land Preparation & Heavy Equipment</div>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-0.5">
                            <div class="text-[8px] font-bold uppercase text-gray-400">REGION</div>
                            <div class="font-bold text-white text-[11px]">North Kalimantan, Indonesia</div>
                        </div>
                        <div class="rounded-lg border border-white/10 bg-[#07110E] p-2.5 space-y-0.5">
                            <div class="text-[8px] font-bold uppercase text-gray-400">NETWORK STATUS</div>
                            <div class="font-bold text-emerald-300 text-[11px]">Active (Demo Environment)</div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ================= CONTENT ================= -->
        <div class="space-y-6 px-4 pb-16 pt-6 sm:px-6 lg:px-8">

            <!-- ---------- 3. TOP KPI CARDS (5 CARDS HORIZONTAL) ---------- -->
            <section class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-5">

                <!-- CARD 01: VERIFICATION -->
                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['shield']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">VERIFICATION</div>
                        <div class="text-sm font-extrabold leading-tight text-amber-300">PENDING</div>
                        <div class="text-[8px] text-gray-400">Land / Legal / Operational / Wallet</div>
                    </div>
                </div>

                <!-- CARD 02: NETWORK CAPACITY -->
                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['leaf']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">NETWORK CAPACITY</div>
                        <div class="text-lg font-extrabold leading-tight text-white">350 HA</div>
                        <div class="text-[8px] text-gray-400">Mapped / Demo Capacity</div>
                    </div>
                </div>

                <!-- CARD 03: ACTIVE PROJECTS -->
                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['target']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">ACTIVE PROJECTS</div>
                        <div class="text-lg font-extrabold leading-tight text-emerald-300">01</div>
                        <div class="text-[8px] text-gray-400">North Kalimantan Palm</div>
                    </div>
                </div>

                <!-- CARD 04: COMPLETED BATCHES -->
                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['check']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">COMPLETED BATCHES</div>
                        <div class="text-lg font-extrabold leading-tight text-white">00</div>
                        <div class="text-[8px] text-gray-400">No completed batch yet</div>
                    </div>
                </div>

                <!-- CARD 05: NINA TENURE -->
                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['clock']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">NINA TENURE</div>
                        <div class="text-sm font-extrabold leading-tight text-emerald-300">NEW</div>
                        <div class="text-[8px] text-gray-400">First registered activity</div>
                    </div>
                </div>

            </section>

            <!-- ================= MAIN LAYOUT GRID (8 COLS LEFT, 4 COLS RIGHT STICKY) ================= -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 items-start">

                <!-- LEFT MAIN CONTENT (8 COLS) -->
                <div class="space-y-6 lg:col-span-8">

                    <!-- ---------- 01. ENTITY IDENTITY & 02. VERIFICATION STATUS ---------- -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <!-- 01 / ENTITY IDENTITY -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="border-b border-white/10 pb-2">
                                    <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">01 / ENTITY IDENTITY</div>
                                    <h3 class="text-sm font-bold text-white">Who is this entity?</h3>
                                </div>

                                <div class="space-y-1.5 text-[10px]">
                                    <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Entity Name</span><span class="font-bold text-white">Demo Production Partner</span></div>
                                    <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Entity ID</span><span class="font-bold font-mono text-emerald-300">PT-NINA-PARTNER-001</span></div>
                                    <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Entity Type</span><span class="font-bold text-white">Production Partner</span></div>
                                    <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Category</span><span class="font-bold text-white">Heavy Equipment / Land Prep</span></div>
                                    <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Legal Entity</span><span class="font-bold text-amber-300">Pending Verification</span></div>
                                    <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Operating Region</span><span class="font-bold text-white">North Kalimantan</span></div>
                                    <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Registration Status</span><span class="font-bold text-amber-300">Pending</span></div>
                                    <div class="flex justify-between py-1"><span class="text-gray-400">NINA Status</span><span class="font-bold text-emerald-300">Active / Demo</span></div>
                                </div>
                            </div>

                            <a href="#verification-matrix" class="w-fit rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-[10px] font-bold uppercase text-gray-300 transition hover:bg-white/10 hover:text-white inline-flex items-center gap-1">
                                <span>VIEW VERIFICATION RECORD</span><?= $arrow ?>
                            </a>
                        </div>

                        <!-- 02 / VERIFICATION STATUS MATRIX -->
                        <div id="verification-matrix" class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="border-b border-white/10 pb-2">
                                    <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">02 / VERIFICATION</div>
                                    <h3 class="text-sm font-bold text-white">Verification Status</h3>
                                    <p class="text-[8px] text-gray-400 mt-0.5">NINA separates identity, operational and execution verification.</p>
                                </div>

                                <div class="space-y-1 text-[9px]">
                                    <div class="flex items-center justify-between py-1 border-b border-white/5">
                                        <span class="text-gray-300 flex items-center gap-1.5"><?= $svg($ic['user'], 'w-3 h-3 text-emerald-300') ?> Entity Identity</span>
                                        <div class="flex items-center gap-2"><span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span><a href="#" class="text-gray-400 hover:text-white">View</a></div>
                                    </div>
                                    <div class="flex items-center justify-between py-1 border-b border-white/5">
                                        <span class="text-gray-300 flex items-center gap-1.5"><?= $svg($ic['doc'], 'w-3 h-3 text-emerald-300') ?> Legal / Company Document</span>
                                        <div class="flex items-center gap-2"><span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span><a href="#" class="text-gray-400 hover:text-white">View</a></div>
                                    </div>
                                    <div class="flex items-center justify-between py-1 border-b border-white/5">
                                        <span class="text-gray-300 flex items-center gap-1.5"><?= $svg($ic['leaf'], 'w-3 h-3 text-emerald-300') ?> Operational Capacity</span>
                                        <div class="flex items-center gap-2"><span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span><a href="#" class="text-gray-400 hover:text-white">View</a></div>
                                    </div>
                                    <div class="flex items-center justify-between py-1 border-b border-white/5">
                                        <span class="text-gray-300 flex items-center gap-1.5"><?= $svg($ic['grid'], 'w-3 h-3 text-emerald-300') ?> Project History</span>
                                        <div class="flex items-center gap-2"><span class="rounded bg-emerald-950 px-1.5 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">DEMO</span><a href="#" class="text-gray-400 hover:text-white">View</a></div>
                                    </div>
                                    <div class="flex items-center justify-between py-1 border-b border-white/5">
                                        <span class="text-gray-300 flex items-center gap-1.5"><?= $svg($ic['truck'], 'w-3 h-3 text-emerald-300') ?> Equipment / Capability</span>
                                        <div class="flex items-center gap-2"><span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span><a href="#" class="text-gray-400 hover:text-white">View</a></div>
                                    </div>
                                    <div class="flex items-center justify-between py-1 border-b border-white/5">
                                        <span class="text-gray-300 flex items-center gap-1.5"><?= $svg($ic['wallet'], 'w-3 h-3 text-emerald-300') ?> Wallet Identity</span>
                                        <div class="flex items-center gap-2"><span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span><a href="#" class="text-gray-400 hover:text-white">View</a></div>
                                    </div>
                                    <div class="flex items-center justify-between py-1">
                                        <span class="text-gray-300 flex items-center gap-1.5"><?= $svg($ic['shield'], 'w-3 h-3 text-emerald-300') ?> Production Role</span>
                                        <div class="flex items-center gap-2"><span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[8px] font-bold text-amber-300">PENDING</span><a href="#" class="text-gray-400 hover:text-white">View</a></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-2 text-[7px] text-gray-400 border-t border-white/5 pt-2">
                                <span class="flex items-center gap-1"><span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span> Verified</span>
                                <span class="flex items-center gap-1"><span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span> Pending</span>
                                <span class="flex items-center gap-1"><span class="h-1.5 w-1.5 rounded-full bg-rose-400"></span> Rejected</span>
                                <span class="flex items-center gap-1"><span class="h-1.5 w-1.5 rounded-full bg-blue-400"></span> Demo</span>
                            </div>
                        </div>

                    </div>

                    <!-- ---------- 03. CAPACITY PROFILE & 04. PROJECT HISTORY ---------- -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <!-- 03 / CAPACITY PROFILE -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="flex items-start justify-between border-b border-white/10 pb-2">
                                    <div>
                                        <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">03 / CAPACITY PROFILE</div>
                                        <h3 class="text-xs font-bold text-white">Verified / Mapped Production Capacity</h3>
                                    </div>
                                    <span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">CAP-2026-001</span>
                                </div>

                                <div class="flex items-baseline justify-between">
                                    <div>
                                        <div class="text-[8px] text-gray-400 uppercase font-bold">NETWORK CAPACITY</div>
                                        <div class="text-2xl font-black text-white">350 HA</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-[8px] text-gray-400 uppercase font-bold">Mapped to</div>
                                        <div class="text-[10px] font-bold text-emerald-300">DR-2026-001</div>
                                        <div class="text-[7px] text-gray-500">Demo Offtake Requirement</div>
                                    </div>
                                </div>

                                <div class="space-y-1 text-[9px]">
                                    <div class="flex justify-between py-0.5 border-b border-white/5"><span class="text-gray-400">Network Capacity</span><span class="font-bold text-white">350 HA</span></div>
                                    <div class="flex justify-between py-0.5 border-b border-white/5"><span class="text-gray-400">Mapped to Requirement</span><span class="font-bold text-white">350 HA</span></div>
                                    <div class="flex justify-between py-0.5 border-b border-white/5"><span class="text-gray-400">Available Capacity</span><span class="font-bold text-gray-500">TBD</span></div>
                                    <div class="flex justify-between py-0.5 border-b border-white/5"><span class="text-gray-400">Committed Capacity</span><span class="font-bold text-gray-500">TBD</span></div>
                                    <div class="flex justify-between py-0.5 border-b border-white/5"><span class="text-gray-400">Standard Batch</span><span class="font-bold text-white">100 HA</span></div>
                                    <div class="flex justify-between py-0.5"><span class="text-gray-400">Production Region</span><span class="font-bold text-white">North Kalimantan</span></div>
                                </div>
                            </div>

                            <a href="<?= $basePrefix ?>/capacity" class="w-fit rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-[10px] font-bold uppercase text-gray-300 hover:bg-white/10 inline-flex items-center gap-1">
                                <span>VIEW CAPACITY RECORD</span><?= $arrow ?>
                            </a>
                        </div>

                        <!-- 04 / PROJECT HISTORY -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="border-b border-white/10 pb-2">
                                    <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">04 / PROJECT HISTORY</div>
                                    <h3 class="text-xs font-bold text-white">Projects Connected to This Partner</h3>
                                </div>

                                <div class="rounded-xl border border-white/10 bg-[#07110E] p-3 flex gap-3 items-center">
                                    <div class="relative w-20 h-24 shrink-0 overflow-hidden rounded-lg border border-white/15 shadow-inner">
                                        <img src="<?= $basePrefix ?>/2.jpg" alt="North Kalimantan Palm" class="h-full w-full object-cover" />
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                                    </div>
                                    <div class="space-y-1 text-[9px] text-gray-400 flex-1">
                                        <div class="flex items-center justify-between">
                                            <div class="font-bold text-white text-[11px] tracking-tight">NORTH KALIMANTAN PALM</div>
                                            <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[7px] font-bold text-amber-300">DEMO / PENDING</span>
                                        </div>
                                        <div class="flex justify-between"><span>Project ID</span><span class="font-mono text-gray-300">PROJ-NK-001</span></div>
                                        <div class="flex justify-between"><span>Region</span><span class="text-gray-300">North Kalimantan</span></div>
                                        <div class="flex justify-between"><span>Production Type</span><span class="text-gray-300">Palm Production</span></div>
                                        <div class="flex justify-between"><span>Capacity</span><span class="text-emerald-300 font-bold">350 HA mapped</span></div>
                                        <div class="flex justify-between"><span>Standard Batch</span><span class="text-gray-300">100 HA</span></div>
                                    </div>
                                </div>
                            </div>

                            <a href="<?= $basePrefix ?>/explore" class="w-fit rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-[10px] font-bold uppercase text-gray-300 hover:bg-white/10 inline-flex items-center gap-1">
                                <span>VIEW ALL PROJECT ACTIVITY</span><?= $arrow ?>
                            </a>
                        </div>

                    </div>

                    <!-- ---------- 05. BATCH EXECUTION HISTORY & 06. RAB & COST CONTROL ---------- -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <!-- 05 / BATCH EXECUTION HISTORY -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="border-b border-white/10 pb-2">
                                    <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">05 / BATCH EXECUTION HISTORY</div>
                                    <h3 class="text-xs font-bold text-white">Past and current batches where active</h3>
                                </div>

                                <div class="overflow-x-auto">
                                    <table class="w-full text-left text-[9px] text-gray-300">
                                        <thead>
                                            <tr class="border-b border-white/10 uppercase text-gray-400">
                                                <th class="py-1">Batch</th>
                                                <th class="py-1">Area</th>
                                                <th class="py-1">Role</th>
                                                <th class="py-1">Status</th>
                                                <th class="py-1">Verification</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border-b border-white/5">
                                                <td class="py-1.5 font-bold text-white">NK-001</td>
                                                <td class="py-1.5">100 HA</td>
                                                <td class="py-1.5">Land Preparation Partner</td>
                                                <td class="py-1.5"><span class="rounded bg-amber-500/20 px-1 py-0.5 text-[7px] font-bold text-amber-300">Pending Execution</span></td>
                                                <td class="py-1.5 text-amber-300 font-bold">Pending</td>
                                            </tr>
                                            <tr class="border-b border-white/5 opacity-60">
                                                <td class="py-1.5 font-bold text-gray-400">NK-002</td>
                                                <td class="py-1.5">100 HA</td>
                                                <td class="py-1.5">&mdash;</td>
                                                <td class="py-1.5"><span class="rounded bg-white/10 px-1 py-0.5 text-[7px] font-bold text-gray-400">Not Started</span></td>
                                                <td class="py-1.5 text-gray-500">&mdash;</td>
                                            </tr>
                                            <tr class="border-b border-white/5 opacity-60">
                                                <td class="py-1.5 font-bold text-gray-400">NK-003</td>
                                                <td class="py-1.5">100 HA</td>
                                                <td class="py-1.5">&mdash;</td>
                                                <td class="py-1.5"><span class="rounded bg-white/10 px-1 py-0.5 text-[7px] font-bold text-gray-400">Not Started</span></td>
                                                <td class="py-1.5 text-gray-500">&mdash;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <a href="<?= $basePrefix ?>/batches" class="w-fit rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-[10px] font-bold uppercase text-gray-300 hover:bg-white/10 inline-flex items-center gap-1">
                                <span>VIEW BATCH NK-001</span><?= $arrow ?>
                            </a>
                        </div>

                        <!-- 06 / RAB & COST CONTROL -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="flex items-start justify-between border-b border-white/10 pb-2">
                                    <div>
                                        <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">06 / RAB & COST CONTROL</div>
                                        <h3 class="text-xs font-bold text-white">Where This Partner Appears in RAB</h3>
                                    </div>
                                    <span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">MODEL</span>
                                </div>

                                <div class="rounded-xl border border-white/10 bg-[#07110E] p-3 space-y-2">
                                    <div class="flex justify-between items-center text-[10px]">
                                        <span class="font-bold font-mono text-white">RAB-NK-001-V01</span>
                                        <span class="font-bold text-emerald-300">Rp15,000,000,000</span>
                                    </div>
                                    <div class="text-[8px] text-gray-400">Batch NK-001 / 100 HA</div>

                                    <div class="border-t border-white/5 pt-1.5 text-[8px] text-gray-400 space-y-1">
                                        <div class="font-bold text-gray-300">Partner-linked Categories:</div>
                                        <div class="grid grid-cols-2 gap-1 text-[7.5px]">
                                            <span class="text-white">&bull; Land Preparation</span>
                                            <span class="text-white">&bull; Machinery & Equipment</span>
                                            <span class="text-white">&bull; Infrastructure</span>
                                            <span class="text-white">&bull; Operations</span>
                                        </div>
                                    </div>

                                    <div class="flex justify-between items-center pt-1 border-t border-white/5 text-[8px]">
                                        <span class="text-gray-400">Allocation Status</span>
                                        <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[7.5px] font-bold text-amber-300">PENDING ALLOCATION</span>
                                    </div>
                                </div>
                            </div>

                            <a href="<?= $basePrefix ?>/rab" class="w-fit rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-[10px] font-bold uppercase text-gray-300 hover:bg-white/10 inline-flex items-center gap-1">
                                <span>VIEW RAB</span><?= $arrow ?>
                            </a>
                        </div>

                    </div>

                    <!-- ---------- 07. WORK ORDERS, 08. EXECUTION ACTIVITY & 09. FIELD EVIDENCE ---------- -->
                    <div class="space-y-4">

                        <!-- 07 / WORK ORDERS -->
                        <div class="<?= $card ?> p-4 space-y-3">
                            <div class="border-b border-white/10 pb-2 flex justify-between items-center">
                                <div>
                                    <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">07 / WORK ORDERS</div>
                                    <h3 class="text-xs font-bold text-white">Operational Assignments</h3>
                                </div>
                                <div class="flex items-center gap-1.5 text-[8px] text-gray-400 font-mono">
                                    <span>ASSIGNED</span> &rarr; <span>ACCEPTED</span> &rarr; <span>IN EXECUTION</span> &rarr; <span>SUBMITTED</span> &rarr; <span>VERIFIED</span> &rarr; <span>COMPLETED</span>
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-[9px] text-gray-300">
                                    <thead>
                                        <tr class="border-b border-white/10 uppercase text-gray-400">
                                            <th class="py-1">Work Order ID</th>
                                            <th class="py-1">Activity</th>
                                            <th class="py-1">Batch</th>
                                            <th class="py-1">Area</th>
                                            <th class="py-1">Partner</th>
                                            <th class="py-1">Status</th>
                                            <th class="py-1">Milestone</th>
                                            <th class="py-1">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-white/5">
                                            <td class="py-1.5 font-bold font-mono text-emerald-300">WO-NK-001-M1-001</td>
                                            <td class="py-1.5 text-white">Land Preparation Setup</td>
                                            <td class="py-1.5">NK-001</td>
                                            <td class="py-1.5">100 HA</td>
                                            <td class="py-1.5 text-gray-300">Demo Production Partner</td>
                                            <td class="py-1.5"><span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[7px] font-bold text-amber-300">PENDING</span></td>
                                            <td class="py-1.5">MILESTONE 01</td>
                                            <td class="py-1.5"><a href="<?= $basePrefix ?>/milestones" class="text-emerald-300 font-bold hover:underline">View &rsaquo;</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- 08. EXECUTION ACTIVITY & 09. FIELD EVIDENCE GRID -->
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                            <!-- 08 / EXECUTION ACTIVITY -->
                            <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                                <div class="space-y-3">
                                    <div class="border-b border-white/10 pb-2">
                                        <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">08 / EXECUTION ACTIVITY</div>
                                        <h3 class="text-xs font-bold text-white">Field Execution Timeline</h3>
                                    </div>

                                    <div class="relative pl-5 space-y-2.5 text-[9px]">
                                        <div class="absolute left-[6px] top-[4px] bottom-[8px] w-[2px] bg-white/20"></div>

                                        <div class="relative flex justify-between items-center">
                                            <span class="absolute -left-5 top-[2px] h-3 w-3 rounded-full border border-emerald-400 bg-emerald-400"></span>
                                            <div>
                                                <div class="font-bold text-white">WORK ORDER CREATED</div>
                                                <div class="text-[7px] text-gray-500">WO-NK-001-M1-001 • 20 SEP 2026</div>
                                            </div>
                                            <span class="text-[7px] text-emerald-300 font-bold">RECORDED</span>
                                        </div>

                                        <div class="relative flex justify-between items-center">
                                            <span class="absolute -left-5 top-[2px] h-3 w-3 rounded-full border border-emerald-400 bg-emerald-400"></span>
                                            <div>
                                                <div class="font-bold text-white">PARTNER ASSIGNED</div>
                                                <div class="text-[7px] text-gray-500">Demo Production Partner • 20 SEP 2026</div>
                                            </div>
                                            <span class="text-[7px] text-emerald-300 font-bold">RECORDED</span>
                                        </div>

                                        <div class="relative flex justify-between items-center opacity-60">
                                            <span class="absolute -left-5 top-[2px] h-3 w-3 rounded-full border border-gray-400 bg-[#07110E]"></span>
                                            <div>
                                                <div class="font-bold text-white">EXECUTION START</div>
                                                <div class="text-[7px] text-gray-500">Pending Field Mobilization</div>
                                            </div>
                                            <span class="text-[7px] text-amber-300 font-bold">PENDING</span>
                                        </div>

                                        <div class="relative flex justify-between items-center opacity-60">
                                            <span class="absolute -left-5 top-[2px] h-3 w-3 rounded-full border border-gray-400 bg-[#07110E]"></span>
                                            <div>
                                                <div class="font-bold text-white">FIELD EVIDENCE SUBMITTED</div>
                                                <div class="text-[7px] text-gray-500">Pending Partner Upload</div>
                                            </div>
                                            <span class="text-[7px] text-amber-300 font-bold">PENDING</span>
                                        </div>

                                        <div class="relative flex justify-between items-center opacity-60">
                                            <span class="absolute -left-5 top-[2px] h-3 w-3 rounded-full border border-gray-400 bg-[#07110E]"></span>
                                            <div>
                                                <div class="font-bold text-white">VERIFICATION</div>
                                                <div class="text-[7px] text-gray-500">Pending Auditor Sign-off</div>
                                            </div>
                                            <span class="text-[7px] text-amber-300 font-bold">PENDING</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 09 / FIELD EVIDENCE -->
                            <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                                <div class="space-y-3">
                                    <div class="flex items-start justify-between border-b border-white/10 pb-2">
                                        <div>
                                            <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">09 / FIELD EVIDENCE</div>
                                            <h3 class="text-xs font-bold text-white">Operational Evidence</h3>
                                        </div>
                                        <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-[7px] font-bold text-amber-300">DEMO / SIMULATED</span>
                                    </div>

                                    <div class="rounded-xl border border-white/10 bg-[#07110E] p-3 space-y-2 text-[8.5px]">
                                        <div class="flex justify-between font-bold text-white border-b border-white/5 pb-1">
                                            <span>FIELD RECORD 001</span>
                                            <span class="text-amber-300">PENDING</span>
                                        </div>
                                        <div class="grid grid-cols-2 gap-1 text-gray-400">
                                            <div>Batch: <strong class="text-white">NK-001</strong></div>
                                            <div>Work Order: <strong class="text-white font-mono">WO-NK-001</strong></div>
                                            <div>Activity: <strong class="text-white">Land Preparation</strong></div>
                                            <div>Uploaded By: <strong class="text-white">Partner</strong></div>
                                            <div>Timestamp: <strong class="text-amber-300">Pending</strong></div>
                                            <div>Location: <strong class="text-amber-300">Pending GIS</strong></div>
                                        </div>
                                        <div class="border-t border-white/5 pt-1 text-[8px] font-bold text-amber-300 text-center">
                                            NO VERIFIED EVIDENCE YET
                                        </div>
                                    </div>
                                </div>

                                <a href="<?= $basePrefix ?>/documents" class="w-fit rounded-lg border border-white/15 bg-white/5 px-3 py-1.5 text-[10px] font-bold uppercase text-gray-300 hover:bg-white/10 inline-flex items-center gap-1">
                                    <span>VIEW ALL EVIDENCE</span><?= $arrow ?>
                                </a>
                            </div>

                        </div>

                    </div>

                    <!-- ---------- 10. GIS, 11. WALLET, 12. TRANSACTIONS, 13. REPUTATION, 14. REVIEWS ---------- -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

                        <!-- 10 / LOCATION & GIS -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-2">
                                <div class="border-b border-white/10 pb-2">
                                    <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">10 / LOCATION & GIS</div>
                                    <h3 class="text-xs font-bold text-white">GIS Verification</h3>
                                </div>

                                <div class="rounded-lg border border-white/10 bg-[#07110E] p-2 flex items-center gap-2.5">
                                    <div class="relative w-14 h-16 shrink-0 overflow-hidden rounded-md border border-white/15 shadow">
                                        <img src="<?= $basePrefix ?>/7.jpg" alt="GIS Map View" class="h-full w-full object-cover" />
                                        <div class="absolute inset-0 bg-emerald-950/20"></div>
                                        <div class="absolute bottom-1 right-1 h-1.5 w-1.5 rounded-full bg-emerald-400 animate-ping"></div>
                                    </div>
                                    <div class="space-y-0.5 text-[8px] text-gray-400 flex-1">
                                        <div class="flex justify-between"><span>Region</span><span class="font-bold text-white">North Kalimantan</span></div>
                                        <div class="flex justify-between"><span>Mapped Area</span><span class="font-bold text-white">350 HA</span></div>
                                        <div class="flex justify-between"><span>Batch Area</span><span class="font-bold text-white">100 HA</span></div>
                                        <div class="flex justify-between"><span>GIS Status</span><span class="text-amber-300 font-bold">Pending</span></div>
                                    </div>
                                </div>
                            </div>

                            <a href="<?= $basePrefix ?>/explore" class="w-fit rounded-lg border border-white/15 bg-white/5 px-2.5 py-1 text-[9px] font-bold uppercase text-gray-300 hover:bg-white/10 inline-flex items-center gap-1">
                                <span>OPEN GIS VIEW</span><?= $arrow ?>
                            </a>
                        </div>

                        <!-- 11 / REGISTERED WALLET -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-2">
                                <div class="border-b border-white/10 pb-2">
                                    <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">11 / REGISTERED WALLET</div>
                                    <h3 class="text-xs font-bold text-white">Registered Settlement Identity</h3>
                                </div>

                                <div class="rounded-lg border border-white/10 bg-[#07110E] p-2 space-y-1 text-[8.5px]">
                                    <div class="flex justify-between"><span class="text-gray-400">ENTITY</span><span class="font-bold text-white">Demo Partner</span></div>
                                    <div class="flex justify-between"><span class="text-gray-400">WALLET STATUS</span><span class="text-amber-300 font-bold">Pending Verification</span></div>
                                    <div class="flex justify-between"><span class="text-gray-400">NETWORK</span><span class="text-gray-500">&mdash;</span></div>
                                    <div class="flex justify-between"><span class="text-gray-400">ADDRESS</span><span class="font-mono text-gray-400">Not registered</span></div>
                                </div>
                            </div>

                            <button type="button" class="w-fit rounded-lg border border-white/15 bg-white/5 px-2.5 py-1 text-[9px] font-bold uppercase text-gray-300 hover:bg-white/10">
                                REQUEST WALLET UPDATE
                            </button>
                        </div>

                        <!-- 12 / TRANSACTION TRACE -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-2">
                                <div class="border-b border-white/10 pb-2">
                                    <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">12 / TRANSACTION TRACE</div>
                                    <h3 class="text-xs font-bold text-white">Transaction History</h3>
                                </div>

                                <div class="text-center py-3 text-[9px] text-gray-400 border border-white/5 rounded-lg bg-black/20 font-medium">
                                    NO TRANSACTION RECORD
                                </div>
                            </div>

                            <span class="text-[8px] italic text-gray-500">Traceable settlement log</span>
                        </div>

                        <!-- 13 / REPUTATION & PERFORMANCE -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-2">
                                <div class="border-b border-white/10 pb-2">
                                    <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">13 / REPUTATION</div>
                                    <h3 class="text-xs font-bold text-white">Operational Reputation</h3>
                                </div>

                                <div class="space-y-1 text-center py-2">
                                    <div class="flex justify-center gap-1 text-amber-400 text-xs">
                                        <?= $svg($ic['star']) ?><?= $svg($ic['star']) ?><?= $svg($ic['star']) ?><?= $svg($ic['star']) ?><?= $svg($ic['star']) ?>
                                    </div>
                                    <div class="text-[10px] font-bold text-white">REPUTATION NOT YET ESTABLISHED</div>
                                    <p class="text-[8px] text-gray-400 leading-tight">Reputation is generated from completed and verified operational activity.</p>
                                </div>
                            </div>

                            <button type="button" class="w-fit rounded-lg border border-white/15 bg-white/5 px-2.5 py-1 text-[9px] font-bold uppercase text-gray-300 hover:bg-white/10">
                                VIEW REPUTATION RECORD
                            </button>
                        </div>

                        <!-- 14 / PARTICIPANT REVIEWS -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-2">
                                <div class="border-b border-white/10 pb-2">
                                    <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">14 / REVIEWS</div>
                                    <h3 class="text-xs font-bold text-white">Participant Reviews</h3>
                                </div>

                                <div class="text-center py-3 text-[9px] text-gray-400 border border-white/5 rounded-lg bg-black/20 font-medium space-y-1">
                                    <div>NO REVIEWS YET</div>
                                    <div class="text-[7.5px] text-gray-500 italic">Reviews from completed production batches will appear here.</div>
                                </div>
                            </div>

                            <span class="text-[8px] text-gray-500 font-semibold">0 Verified Reviews</span>
                        </div>

                        <!-- 15 / NETWORK TIER -->
                        <div class="<?= $card ?> p-4 space-y-3 flex flex-col justify-between">
                            <div class="space-y-2">
                                <div class="border-b border-white/10 pb-2">
                                    <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">15 / NETWORK TIER</div>
                                    <h3 class="text-xs font-bold text-white">Network Partner Tier</h3>
                                </div>

                                <div class="space-y-1.5 text-[8.5px]">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-400">Current Tier</span>
                                        <span class="rounded bg-emerald-950 px-2 py-0.5 text-[8px] font-bold text-emerald-300 border border-emerald-500/30">SILVER</span>
                                    </div>
                                    <div class="text-[7.5px] text-gray-400">100 HA Verified / Mapped Capacity tier qualification.</div>
                                </div>
                            </div>

                            <button type="button" class="w-fit rounded-lg border border-white/15 bg-white/5 px-2.5 py-1 text-[9px] font-bold uppercase text-gray-300 hover:bg-white/10">
                                VIEW TIER STRUCTURE
                            </button>
                        </div>

                    </div>

                    <!-- ---------- 16. DOCUMENTS & 17. AUDIT TRAIL & 18. ROLE PERMISSIONS ---------- -->
                    <div class="space-y-4">

                        <!-- 16 / DOCUMENTS -->
                        <div class="<?= $card ?> p-4 space-y-3">
                            <div class="border-b border-white/10 pb-2 flex justify-between items-center">
                                <div>
                                    <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">16 / DOCUMENTS</div>
                                    <h3 class="text-xs font-bold text-white">Entity Document Center</h3>
                                </div>
                                <a href="<?= $basePrefix ?>/documents" class="text-[9px] font-bold text-emerald-300 hover:underline">VIEW DOCUMENT RECORD &rsaquo;</a>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 text-[9px]">
                                <div class="flex justify-between items-center p-2 rounded bg-white/5 border border-white/5">
                                    <div><div class="font-bold text-white">Entity Document</div><div class="text-[7.5px] text-gray-500">Legal Registration</div></div>
                                    <span class="text-amber-300 font-bold text-[8px]">Pending</span>
                                </div>
                                <div class="flex justify-between items-center p-2 rounded bg-white/5 border border-white/5">
                                    <div><div class="font-bold text-white">Operational Capacity</div><div class="text-[7.5px] text-gray-500">CAP-2026-001</div></div>
                                    <span class="text-amber-300 font-bold text-[8px]">Pending</span>
                                </div>
                                <div class="flex justify-between items-center p-2 rounded bg-white/5 border border-white/5">
                                    <div><div class="font-bold text-white">Project Assignment</div><div class="text-[7.5px] text-gray-500">PROJ-NK-001</div></div>
                                    <span class="text-emerald-300 font-bold text-[8px]">Demo V01</span>
                                </div>
                                <div class="flex justify-between items-center p-2 rounded bg-white/5 border border-white/5">
                                    <div><div class="font-bold text-white">Work Order Reference</div><div class="text-[7.5px] text-gray-500">WO-NK-001-M1-001</div></div>
                                    <span class="text-amber-300 font-bold text-[8px]">Pending</span>
                                </div>
                                <div class="flex justify-between items-center p-2 rounded bg-white/5 border border-white/5">
                                    <div><div class="font-bold text-white">RAB Reference</div><div class="text-[7.5px] text-gray-500">RAB-NK-001-V01</div></div>
                                    <span class="text-emerald-300 font-bold text-[8px]">Linked</span>
                                </div>
                                <div class="flex justify-between items-center p-2 rounded bg-white/5 border border-white/5">
                                    <div><div class="font-bold text-white">Wallet Registration</div><div class="text-[7.5px] text-gray-500">Settlement Address</div></div>
                                    <span class="text-amber-300 font-bold text-[8px]">Pending</span>
                                </div>
                            </div>
                        </div>

                        <!-- 17 / AUDIT TRAIL TIMELINE -->
                        <div class="<?= $card ?> p-4 space-y-3">
                            <div class="border-b border-white/10 pb-2 flex justify-between items-center">
                                <div>
                                    <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">17 / AUDIT TRAIL</div>
                                    <h3 class="text-xs font-bold text-white">Entity Lifecycle Audit Trail</h3>
                                </div>
                                <a href="<?= $basePrefix ?>/audit-trail" class="text-[9px] font-bold text-emerald-300 hover:underline">VIEW FULL AUDIT TRAIL &rsaquo;</a>
                            </div>

                            <div class="flex flex-wrap items-center gap-1.5 text-[8px] font-mono text-gray-400 bg-white/5 p-2.5 rounded-lg border border-white/5">
                                <span class="text-emerald-300 font-bold">ENTITY CREATED</span> &rarr;
                                <span class="text-emerald-300 font-bold">PROFILE SUBMITTED</span> &rarr;
                                <span class="text-emerald-300 font-bold">CAPACITY MAPPED</span> &rarr;
                                <span class="text-emerald-300 font-bold">PROJECT LINKED</span> &rarr;
                                <span class="text-emerald-300 font-bold">RAB CATEGORY LINKED</span> &rarr;
                                <span class="text-emerald-300 font-bold">WORK ORDER CREATED</span> &rarr;
                                <span class="text-amber-300 font-bold">FIELD EXECUTION</span> &rarr;
                                <span class="text-gray-500">EVIDENCE SUBMITTED</span> &rarr;
                                <span class="text-gray-500">VERIFICATION</span> &rarr;
                                <span class="text-gray-500">COMPLETION</span> &rarr;
                                <span class="text-gray-500">REPUTATION GENERATED</span>
                            </div>
                        </div>

                        <!-- 18 / ROLE & PERMISSIONS MATRIX -->
                        <div class="<?= $card ?> p-4 space-y-3">
                            <div class="border-b border-white/10 pb-2">
                                <div class="text-[8px] font-bold uppercase tracking-wider text-emerald-300">18 / ACCESS CONTROL</div>
                                <h3 class="text-xs font-bold text-white">Role & Permission Matrix</h3>
                            </div>

                            <div class="grid grid-cols-2 sm:grid-cols-6 gap-2 text-[8.5px] text-center">
                                <div class="rounded border border-white/10 bg-[#07110E] p-2 space-y-1">
                                    <div class="font-bold text-emerald-300">PARTNER</div>
                                    <div class="text-[7.5px] text-gray-400">View / Submit Evidence</div>
                                </div>
                                <div class="rounded border border-white/10 bg-[#07110E] p-2 space-y-1">
                                    <div class="font-bold text-white">OPERATIONS</div>
                                    <div class="text-[7.5px] text-gray-400">Assign / Manage WO</div>
                                </div>
                                <div class="rounded border border-white/10 bg-[#07110E] p-2 space-y-1">
                                    <div class="font-bold text-white">VERIFIER</div>
                                    <div class="text-[7.5px] text-gray-400">Verify Evidence & GIS</div>
                                </div>
                                <div class="rounded border border-white/10 bg-[#07110E] p-2 space-y-1">
                                    <div class="font-bold text-white">APPROVER</div>
                                    <div class="text-[7.5px] text-gray-400">Approve / Reject Claims</div>
                                </div>
                                <div class="rounded border border-white/10 bg-[#07110E] p-2 space-y-1">
                                    <div class="font-bold text-white">PARTICIPANT</div>
                                    <div class="text-[7.5px] text-gray-400">View Status & Audit</div>
                                </div>
                                <div class="rounded border border-white/10 bg-[#07110E] p-2 space-y-1">
                                    <div class="font-bold text-amber-300">ADMIN</div>
                                    <div class="text-[7.5px] text-gray-400">System Configuration</div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- RIGHT STICKY SIDEBAR (4 COLS MATCHING WIREFRAME) -->
                <div class="space-y-4 lg:col-span-4 lg:sticky lg:top-4">

                    <!-- Card 1: PARTNER SUMMARY -->
                    <div class="<?= $card ?> p-5 space-y-4">
                        <div class="border-b border-white/10 pb-3">
                            <div class="text-[9px] font-bold uppercase tracking-wider text-emerald-300">PARTNER SUMMARY</div>
                            <div class="text-base font-black text-white mt-1">Demo Production Partner</div>
                        </div>

                        <div class="space-y-2 text-xs">
                            <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Partner ID</span><span class="font-mono font-bold text-white">PT-NINA-PARTNER-001</span></div>
                            <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Category</span><span class="font-bold text-white text-right">Land Prep / Heavy Equipment</span></div>
                            <div class="flex justify-between py-1 border-b border-white/5"><span class="text-gray-400">Region</span><span class="font-bold text-white text-right">North Kalimantan, Indonesia</span></div>
                            <div class="flex justify-between py-1"><span class="text-gray-400">Current Tier</span><span class="rounded bg-emerald-950 px-2 py-0.5 text-[9px] font-bold text-emerald-300 border border-emerald-500/30">SILVER</span></div>
                        </div>

                        <a href="#verification-matrix" class="w-full flex items-center justify-between rounded-lg border border-emerald-400/40 bg-emerald-950/80 p-2.5 text-[10px] font-bold text-emerald-300 hover:bg-emerald-900/80">
                            <span>VIEW VERIFICATION RECORD</span><?= $arrow ?>
                        </a>
                    </div>

                    <!-- Card 2: PARTNER RECORDS & QUICK LINKS -->
                    <div class="<?= $card ?> p-5 space-y-3">
                        <div class="border-b border-white/10 pb-2">
                            <h4 class="text-xs font-bold text-white uppercase tracking-wider">Operational Records</h4>
                        </div>

                        <div class="space-y-2 text-[10px]">
                            <a href="<?= $basePrefix ?>/capacity" class="flex justify-between items-center rounded bg-white/5 p-2 border border-white/5 hover:bg-white/10 text-gray-300 hover:text-white">
                                <span class="font-bold">Mapped Capacity</span><span class="font-mono text-emerald-300 font-bold">CAP-2026-001 &rsaquo;</span>
                            </a>
                            <a href="<?= $basePrefix ?>/explore" class="flex justify-between items-center rounded bg-white/5 p-2 border border-white/5 hover:bg-white/10 text-gray-300 hover:text-white">
                                <span class="font-bold">Mapped Contracts</span><span class="text-gray-400">1 Project &rsaquo;</span>
                            </a>
                            <a href="<?= $basePrefix ?>/batches" class="flex justify-between items-center rounded bg-white/5 p-2 border border-white/5 hover:bg-white/10 text-gray-300 hover:text-white">
                                <span class="font-bold">Execution Record</span><span class="text-gray-400">Batch NK-001 &rsaquo;</span>
                            </a>
                            <a href="<?= $basePrefix ?>/documents" class="flex justify-between items-center rounded bg-white/5 p-2 border border-white/5 hover:bg-white/10 text-gray-300 hover:text-white">
                                <span class="font-bold">Field Evidence</span><span class="text-amber-300">Pending &rsaquo;</span>
                            </a>
                            <a href="<?= $basePrefix ?>/audit-trail" class="flex justify-between items-center rounded bg-white/5 p-2 border border-white/5 hover:bg-white/10 text-gray-300 hover:text-white">
                                <span class="font-bold">Audit Trail Record</span><span class="text-emerald-300">View Trail &rsaquo;</span>
                            </a>
                        </div>
                    </div>

                </div>

            </div>

            <!-- ---------- BOTTOM FOOTER BANNER ---------- -->
            <section class="<?= $card ?> p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <span class="<?= $iconBox ?> h-12 w-12 text-emerald-300"><?= $svg($ic['shield'], 'w-6 h-6') ?></span>
                    <div>
                        <h3 class="text-base font-extrabold text-white">Trace Every Operational Relationship.</h3>
                        <p class="text-xs text-gray-300 mt-0.5">From partner identity to production execution, NINA connects every operational record into one traceable system.</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="<?= $basePrefix ?>/milestones" class="rounded-lg bg-emerald-950/80 border border-emerald-400/40 px-4 py-2 text-xs font-bold text-emerald-300 hover:bg-emerald-900/80 uppercase">
                        VIEW ACTIVE WORK ORDERS &rsaquo;
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
