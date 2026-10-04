<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'vendors';
$vendorId = $_GET['id'] ?? 'pt-agro-nusantara-fertilizer';

/* ---------- Helpers & Icons ---------- */
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
$svg = fn(string $inner, string $cls = 'w-4 h-4') =>
    '<svg class="' . $cls . '" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">' . $inner . '</svg>';

$ic = [
    'star'      => '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>',
    'check'     => '<path d="M20 6L9 17l-5-5"/>',
    'shield'    => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
    'clock'     => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
    'arrowLeft' => '<path d="M19 12H5M12 19l-7-7 7-7"/>',
    'arrowRight'=> '<path d="M5 12h14M12 5l7 7-7 7"/>',
    'leaf'      => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>',
    'truck'     => '<rect x="1" y="3" width="15" height="13" rx="2"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>',
    'user'      => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
    'mapPin'    => '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>',
    'wrench'    => '<path d="M14.7 6.3a4 4 0 0 1-5.4 5.4l-6.6 6.6a2 2 0 0 0 2.8 2.8l6.6-6.6a4 4 0 0 1 5.4-5.4l-3 3-2-2 3-3z"/>',
    'gauge'     => '<path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/><path d="M12 15V9"/><path d="M4.6 19.4A9 9 0 1 1 19.4 19.4"/>',
    'seedling'  => '<path d="M12 20v-9"/><path d="M12 11C7 11 4 7 4 3c4 0 8 3 8 8Z"/><path d="M12 11c5 0 8-4 8-8-4 0-8 3-8 8Z"/>',
];

$card      = 'rounded-xl border border-emerald-500/20 bg-[#040C0A]/90 shadow-2xl';
$metricBox = 'border border-emerald-500/20 bg-emerald-950/20 p-3 lg:p-4 rounded-xl space-y-1 flex flex-col justify-between';

/* ---------- VENDOR DATA ---------- */
$vendors = [
    'pt-agro-nusantara-fertilizer' => [
        'name' => 'PT Agro Nusantara Fertilizer',
        'category' => 'Fertilizer & Agricultural Inputs',
        'role' => 'Verified Production Supply Partner',
        'coverage' => ['North Kalimantan', 'East Kalimantan'],
        'tier' => 'GOLD',
        'tier_label' => 'Multi-Batch Supplier',
        'metrics' => [
            ['val' => '05', 'label' => 'Projects Supported'],
            ['val' => '12', 'label' => 'Batches Supported'],
            ['val' => '1,250 MT', 'label' => 'Verified Supply'],
            ['val' => '96%', 'label' => 'On-Time Delivery'],
            ['val' => '97%', 'label' => 'Quality Acceptance'],
            ['val' => '98%', 'label' => 'Quantity Accuracy'],
        ],
        'score' => 4.8,
        'image' => '/fertilizer.jpg',
        'type' => 'fertilizer'
    ],
    'pt-kalimantan-heavy-equipment' => [
        'name' => 'PT Kalimantan Heavy Equipment',
        'category' => 'Heavy Equipment & Field Machinery',
        'role' => 'Verified Field Equipment Partner',
        'coverage' => ['Kalimantan'],
        'tier' => 'PLATINUM',
        'tier_label' => 'Fleet Operator',
        'metrics' => [
            ['val' => '08', 'label' => 'Projects Supported'],
            ['val' => '14', 'label' => 'Batches Supported'],
            ['val' => '32', 'label' => 'Equipment Assignments'],
            ['val' => '94%', 'label' => 'On-Time Mobilization'],
            ['val' => '97%', 'label' => 'Equipment Acceptance'],
            ['val' => '96%', 'label' => 'Uptime Performance'],
        ],
        'score' => 4.7,
        'image' => '/excavator.jpg',
        'type' => 'equipment'
    ],
    'pt-borneo-field-operations' => [
        'name' => 'PT Borneo Field Operations',
        'category' => 'Land Preparation & Field Services',
        'role' => 'Verified Production Execution Partner',
        'coverage' => ['Kalimantan'],
        'tier' => 'PLATINUM',
        'tier_label' => 'Multi-Batch Executor',
        'metrics' => [
            ['val' => '18', 'label' => 'Projects Supported'],
            ['val' => '31', 'label' => 'Batches Supported'],
            ['val' => '2,450 HA', 'label' => 'Supported Area'],
            ['val' => '97%', 'label' => 'On-Time Completion'],
            ['val' => '95%', 'label' => 'Schedule Adherence'],
            ['val' => '98%', 'label' => 'Quality Acceptance'],
        ],
        'score' => 4.8,
        'image' => '/4.jpg',
        'type' => 'services'
    ],
    'pt-nusantara-superior-seed' => [
        'name' => 'PT Nusantara Superior Seed',
        'category' => 'Seed & Planting Material',
        'role' => 'Verified Production Supply Partner',
        'coverage' => ['North Kalimantan', 'East Kalimantan', 'Sulawesi'],
        'tier' => 'GOLD',
        'tier_label' => 'Multi-Batch Supplier',
        'metrics' => [
            ['val' => '04', 'label' => 'Projects Supported'],
            ['val' => '09', 'label' => 'Batches Supported'],
            ['val' => '420,000', 'label' => 'Seedlings Supplied'],
            ['val' => '98%', 'label' => 'On-Time Delivery'],
            ['val' => '99%', 'label' => 'Doc/Cert Acceptance'],
            ['val' => '98%', 'label' => 'Quantity Accuracy'],
        ],
        'score' => 4.9,
        'image' => '/nursery.jpg',
        'type' => 'seed'
    ]
];

if (!isset($vendors[$vendorId])) {
    $vendorId = 'pt-agro-nusantara-fertilizer';
}
$v = $vendors[$vendorId];
$title = $v['name'] . ' — NINA Vendor Network';

/* ---------- DYNAMIC TAB SET PER VENDOR TYPE ----------
   Same visual style/markup for every tab button; only the
   set of tabs + labels changes depending on vendor type,
   matching the per-category reference screenshots. */
$tabSets = [
    'fertilizer' => [
        ['id' => 'overview',    'label' => 'Overview'],
        ['id' => 'packages',    'label' => '100 HA Package'],
        ['id' => 'listings',    'label' => 'Listings'],
        ['id' => 'history',     'label' => 'Supply History'],
        ['id' => 'performance', 'label' => 'Performance'],
        ['id' => 'reviews',     'label' => 'Reviews'],
    ],
    'services' => [
        ['id' => 'overview',    'label' => 'Overview'],
        ['id' => 'packages',    'label' => '100 HA Package'],
        ['id' => 'listings',    'label' => 'Services'],
        ['id' => 'history',     'label' => 'Supply History'],
        ['id' => 'performance', 'label' => 'Performance'],
        ['id' => 'reviews',     'label' => 'Reviews'],
    ],
    'seed' => [
        ['id' => 'overview',    'label' => 'Overview'],
        ['id' => 'packages',    'label' => '100 HA Package'],
        ['id' => 'listings',    'label' => 'Listings'],
        ['id' => 'nursery',     'label' => 'Nursery & Certification'],
        ['id' => 'performance', 'label' => 'Performance'],
        ['id' => 'reviews',     'label' => 'Reviews'],
    ],
    'equipment' => [
        ['id' => 'overview',    'label' => 'Overview'],
        ['id' => 'packages',    'label' => '100 HA Package'],
        ['id' => 'fleet',       'label' => 'Fleet & Equipment'],
        ['id' => 'utilization', 'label' => 'Utilization'],
        ['id' => 'performance', 'label' => 'Performance'],
        ['id' => 'reviews',     'label' => 'Reviews'],
    ],
];
$tabs = $tabSets[$v['type']] ?? $tabSets['fertilizer'];

ob_start();
?>

<div class="relative w-full font-sans pb-16" x-data="{ activeTab: 'overview' }">
    <!-- ================= HERO HEADER ================= -->
    <section class="relative overflow-hidden shadow-2xl" style="border-bottom: none !important;">
        <img src="<?= $basePrefix ?><?= $v['image'] ?>" alt="<?= $e($v['name']) ?>" class="absolute inset-0 h-full w-full object-cover opacity-60" />
        <div class="absolute inset-0 bg-gradient-to-r from-[#050D07]/95 via-[#050D07]/75 to-[#050D07]/20"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#06120F]/90 via-transparent to-transparent"></div>

        <div class="relative flex flex-col xl:flex-row xl:items-end justify-between gap-8 px-6 pt-8 pb-8 lg:px-8 lg:pt-10 lg:pb-10">
            <div class="space-y-6 max-w-4xl flex-1">
                <!-- Breadcrumb -->
                <nav aria-label="Breadcrumb" class="inline-flex flex-wrap items-center gap-2 text-[10px] font-mono font-semibold uppercase tracking-[0.14em] text-gray-300">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                    <a href="<?= $basePrefix ?>/vendors" class="hover:text-white transition-colors">VENDOR NETWORK</a>
                    <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-emerald-400"><?= $e($v['category']) ?></span>
                </nav>

                <div class="flex flex-col sm:flex-row gap-6 sm:items-start lg:items-center">
                    <!-- Logo Block -->
                    <div class="w-16 h-16 sm:w-20 sm:h-20 lg:w-28 lg:h-28 bg-emerald-950/80 rounded-2xl border border-emerald-500/40 flex items-center justify-center shrink-0 shadow-[0_0_30px_rgba(16,185,129,0.15)]">
                        <div class="text-center">
                            <div class="text-emerald-400 mb-1 flex justify-center"><?= $svg($ic['leaf'], 'w-6 h-6 lg:w-8 lg:h-8') ?></div>
                            <div class="text-[8px] lg:text-[10px] font-extrabold text-white uppercase tracking-widest leading-none"><?= substr(str_replace('PT ', '', $v['name']), 0, 8) ?></div>
                        </div>
                    </div>

                    <!-- Info Block -->
                    <div class="space-y-3 sm:space-y-4">
                        <div class="flex items-center gap-3 flex-wrap">
                            <span class="rounded border border-emerald-400/40 bg-emerald-500/20 px-3 py-1 text-[9px] lg:text-[10px] font-bold tracking-widest text-emerald-300 uppercase flex items-center gap-1.5 shadow-[0_0_10px_rgba(16,185,129,0.2)]">
                                <?= $svg($ic['shield'], 'w-3 h-3') ?> NINA VERIFIED
                            </span>
                            <span class="rounded border border-emerald-400/40 bg-emerald-500 px-3 py-1 text-[9px] lg:text-[10px] font-bold tracking-widest text-black uppercase flex items-center gap-1.5 shadow-[0_0_15px_rgba(16,185,129,0.3)]">
                                <?= $svg($ic['check'], 'w-3 h-3') ?> ACTIVE
                            </span>
                        </div>
                        
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-[1.1]">
                            <?= $e($v['name']) ?>
                        </h1>

                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 text-xs font-mono font-bold text-gray-300 pt-1">
                            <span class="text-emerald-400 flex items-center gap-1.5">
                                <?= $svg($ic['wrench'], 'w-3.5 h-3.5 text-emerald-400') ?> 
                                <?= $e($v['role']) ?>
                            </span>
                            <span class="hidden sm:inline text-white/20">|</span>
                            <div class="flex items-center gap-1.5 text-gray-400">
                                <?= $svg($ic['mapPin'], 'w-3.5 h-3.5 text-gray-400') ?>
                                <?= implode(' &bull; ', $v['coverage']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TIER BADGE SECTION -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 shrink-0 mt-6 xl:mt-0 w-full xl:w-auto">
                <span class="rounded bg-amber-950/80 px-4 py-2.5 sm:py-2 text-xs font-extrabold text-amber-400 border border-amber-500/40 uppercase tracking-widest flex items-center justify-center gap-2 shadow-2xl backdrop-blur-xl">
                    <?= $svg($ic['shield'], 'w-4 h-4') ?> <?= $e($v['tier']) ?>
                </span>
                <span class="text-[10px] font-mono text-gray-400 uppercase tracking-widest bg-white/5 border border-white/10 px-4 py-2.5 sm:py-2 rounded flex items-center justify-center gap-2 backdrop-blur-xl"><?= $e($v['tier_label']) ?> &rarr;</span>
            </div>
        </div>
    </section>

    <!-- Main Content Wrapper -->
    <div class="relative z-10 px-4 pt-6 sm:px-6 lg:px-8 space-y-6">

        <!-- TABS (dynamic per vendor type, same style throughout) -->
        <div class="flex items-center gap-6 border-b border-emerald-500/20 text-[10px] font-mono font-bold uppercase tracking-wider overflow-x-auto scrollbar-none">
            <?php foreach ($tabs as $tab): ?>
            <button
                @click="activeTab = '<?= $tab['id'] ?>'"
                :class="activeTab === '<?= $tab['id'] ?>' ? 'text-emerald-400 border-b-2 border-emerald-400 pb-3' : 'text-gray-400 hover:text-white pb-3'"
            ><?= $e($tab['label']) ?></button>
            <?php endforeach; ?>
        </div>

        <div x-show="activeTab === 'overview'" class="space-y-6">
            <!-- 1. PERFORMANCE OVERVIEW -->
            <div class="<?= $card ?> p-5 lg:p-6 space-y-5">
                <div class="flex items-center justify-between border-b border-emerald-500/20 pb-3">
                    <div class="flex items-center gap-2 text-emerald-400 font-bold text-[10px] uppercase tracking-widest">
                        <?= $svg($ic['leaf'], 'w-4 h-4') ?> VENDOR PERFORMANCE OVERVIEW
                    </div>
                    <a href="#" @click.prevent="activeTab = 'performance'" class="text-[9px] font-mono text-gray-400 hover:text-emerald-400 transition-colors uppercase tracking-widest">View Full Performance &rarr;</a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <?php foreach(array_slice($v['metrics'], 0, 4) as $m): ?>
                    <div class="<?= $metricBox ?>">
                        <div class="text-2xl lg:text-3xl font-extrabold text-white font-mono leading-none"><?= $m['val'] ?></div>
                        <div class="text-[9px] text-gray-400 uppercase tracking-widest font-bold mt-2"><?= $m['label'] ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <?php foreach(array_slice($v['metrics'], 4, 2) as $m): ?>
                    <div class="<?= $metricBox ?>">
                        <div class="text-2xl lg:text-3xl font-extrabold text-white font-mono leading-none"><?= $m['val'] ?></div>
                        <div class="text-[9px] text-gray-400 uppercase tracking-widest font-bold mt-2"><?= $m['label'] ?></div>
                    </div>
                    <?php endforeach; ?>

                    <div class="<?= $card ?> col-span-2 p-4 flex flex-col md:flex-row items-center justify-between gap-4 border border-emerald-500/30 bg-black/40">
                        <div class="text-center md:text-left shrink-0 border-b md:border-b-0 md:border-r border-white/10 pb-3 md:pb-0 md:pr-6">
                            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 flex items-center justify-center md:justify-start gap-1">
                                <?= $svg($ic['star'], 'w-3 h-3 text-amber-400') ?> EXPERIENCE SCORE
                            </div>
                            <div class="text-3xl lg:text-4xl font-extrabold text-amber-300 font-mono leading-none mt-1">
                                <?= number_format($v['score'], 1) ?> <span class="text-lg text-gray-500">/ 5</span>
                            </div>
                            <div class="text-[9px] font-mono text-emerald-300 mt-2 font-bold uppercase tracking-wider">Verified Record</div>
                        </div>
                        <div class="space-y-1.5 text-[9px] font-mono text-gray-300 flex-1 w-full">
                            <div class="text-emerald-400 font-bold uppercase mb-2 border-b border-white/10 pb-1 text-[10px]">Operational Experience</div>
                            <div class="flex justify-between"><span>Completed Projects:</span><span class="font-bold text-white"><?= $v['metrics'][0]['val'] ?></span></div>
                            <div class="flex justify-between"><span>Completed Batches:</span><span class="font-bold text-white"><?= $v['metrics'][1]['val'] ?></span></div>
                            <div class="flex justify-between"><span>Total Executed:</span><span class="font-bold text-white"><?= $v['metrics'][2]['val'] ?></span></div>
                            <div class="flex justify-between"><span>Regions Served:</span><span class="font-bold text-white truncate max-w-[120px]">North & East Kalimantan</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- DYNAMIC VENDOR LAYOUTS -->
            <?php if ($v['type'] == 'fertilizer' || $v['type'] == 'services'): ?>
            <!-- GRID CONTENT (Fertilizer & Services) -->
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
                <!-- LEFT COLUMN (Capacity & 100 HA Package) -->
                <div class="xl:col-span-8 space-y-6">
                    <!-- VERIFIED CAPACITY -->
                    <div class="<?= $card ?> p-5 lg:p-6 space-y-5">
                        <div class="flex items-center justify-between border-b border-emerald-500/20 pb-3">
                            <div class="flex items-center gap-2 text-emerald-400 font-bold text-[10px] uppercase tracking-widest">
                                <?= $svg($ic['shield'], 'w-4 h-4') ?> VERIFIED <?= ($v['type'] == 'services' ? 'SERVICE' : ($v['type'] == 'equipment' ? 'FLEET' : ($v['type'] == 'seed' ? 'NURSERY' : 'CAPACITY'))) ?>
                            </div>
                            <a href="#" @click.prevent="activeTab = 'listings'" class="text-[9px] font-mono text-gray-400 hover:text-emerald-400 transition-colors uppercase tracking-widest">View Details &rarr;</a>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 font-mono text-xs">
                            <div class="space-y-4">
                                <?php if($v['type'] == 'fertilizer'): ?>
                                    <div>
                                        <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Product Category</div>
                                        <div class="text-white font-bold">Fertilizer & Crop Nutrition</div>
                                    </div>
                                    <div>
                                        <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Monthly Capacity</div>
                                        <div class="text-lg text-emerald-300 font-bold">500 MT / Month</div>
                                    </div>
                                <?php elseif($v['type'] == 'equipment'): ?>
                                    <div>
                                        <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Equipment Category</div>
                                        <div class="text-white font-bold">Heavy Machinery & Fleet</div>
                                    </div>
                                    <div>
                                        <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Verified Fleet Size</div>
                                        <div class="text-lg text-emerald-300 font-bold">35 Units</div>
                                    </div>
                                <?php else: ?>
                                    <div>
                                        <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Service Category</div>
                                        <div class="text-white font-bold">Land Preparation</div>
                                    </div>
                                    <div>
                                        <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Max Verified Capacity</div>
                                        <div class="text-lg text-emerald-300 font-bold">250 HA / Project</div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="space-y-4 border-t sm:border-t-0 sm:border-l border-emerald-500/20 pt-4 sm:pt-0 sm:pl-6">
                                <?php if($v['type'] == 'fertilizer'): ?>
                                    <div>
                                        <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Current Stock</div>
                                        <div class="text-white font-bold text-sm">420 MT</div>
                                    </div>
                                    <div>
                                        <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Committed Capacity</div>
                                        <div class="text-white font-bold text-sm">280 MT</div>
                                    </div>
                                    <div>
                                        <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Uncommitted Capacity</div>
                                        <div class="text-white font-bold text-sm">220 MT</div>
                                    </div>
                                <?php else: ?>
                                    <div>
                                        <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Currently Deployed</div>
                                        <div class="text-white font-bold text-sm">27 Units</div>
                                    </div>
                                    <div>
                                        <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Committed</div>
                                        <div class="text-white font-bold text-sm">6 Units</div>
                                    </div>
                                    <div>
                                        <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Uncommitted</div>
                                        <div class="text-white font-bold text-sm">2 Units</div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-emerald-500/20 font-mono text-[9px] uppercase tracking-widest font-bold">
                            <div class="flex h-2.5 w-full bg-emerald-950/40 rounded-full overflow-hidden border border-emerald-500/20">
                                <div class="h-full bg-emerald-400" style="width: 78%;"></div>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-emerald-300 flex items-center gap-1.5"><?= $svg($ic['shield'], 'w-3 h-3') ?> Committed <span class="text-white ml-1">78%</span></div>
                                <div class="text-gray-400">Uncommitted 22%</div>
                            </div>
                        </div>
                    </div>

                    <!-- 100 HA PACKAGE -->
                    <div class="<?= $card ?> p-5 lg:p-6 space-y-5">
                        <div class="flex items-center justify-between border-b border-emerald-500/20 pb-3">
                            <div class="flex items-center gap-2 text-emerald-400 font-bold text-[10px] uppercase tracking-widest">
                                <?= $svg($ic['leaf'], 'w-4 h-4') ?> 100 HA PACKAGE
                            </div>
                            <a href="#" @click.prevent="activeTab = 'packages'" class="text-[9px] font-mono text-gray-400 hover:text-emerald-400 transition-colors uppercase tracking-widest">View All Packages &rarr;</a>
                        </div>

                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="w-full md:w-36 h-36 rounded-lg border border-emerald-500/30 overflow-hidden shrink-0">
                                <img src="<?= $basePrefix ?><?= $v['image'] ?>" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 font-mono">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h4 class="text-white font-extrabold text-base tracking-tight"><?= ($v['type'] == 'fertilizer' ? 'NPK 15-15-15' : ($v['type'] == 'equipment' ? 'Land Prep Fleet Package' : 'Planting Services')) ?></h4>
                                        <div class="text-[10px] text-gray-400 uppercase tracking-widest mt-1"><?= $v['category'] ?></div>
                                    </div>
                                    <span class="rounded border border-emerald-400/40 bg-emerald-500/20 px-2 py-0.5 text-[9px] font-bold tracking-wider text-emerald-300 uppercase flex items-center gap-1 w-fit"><?= $svg($ic['shield'], 'w-3 h-3') ?> VERIFIED</span>
                                </div>

                                <div class="grid grid-cols-2 gap-y-4 gap-x-2 mt-5 text-xs">
                                    <div>
                                        <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Total Quantity</div>
                                        <div class="text-white font-bold"><?= ($v['type'] == 'fertilizer' ? '15 MT' : '2 Units') ?></div>
                                    </div>
                                    <div>
                                        <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Package Price</div>
                                        <div class="text-emerald-300 font-bold">US$ 6,750</div>
                                    </div>
                                    <div>
                                        <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Price / HA</div>
                                        <div class="text-gray-300 font-bold text-[11px]">Use / HA US$ 67.50</div>
                                    </div>
                                    <div>
                                        <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Commercial Basis</div>
                                        <div class="text-gray-300 font-bold text-[11px]">Delivered / Ex-Works</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2 pt-4 border-t border-emerald-500/20 font-mono text-[9px] uppercase tracking-widest font-bold flex items-center gap-3">
                            <?= $svg($ic['check'], 'w-3.5 h-3.5 text-emerald-400') ?>
                            <div class="flex-1 h-1.5 bg-emerald-950/40 rounded-full overflow-hidden border border-emerald-500/20">
                                <div class="h-full bg-emerald-400" style="width: 100%;"></div>
                            </div>
                            <div class="text-emerald-400">2 BATCHES</div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN (Coverage & Listings) -->
                <div class="xl:col-span-4 space-y-6">
                    <!-- COVERAGE AREA (map grid example — reused as-is) -->
                    <div class="<?= $card ?> p-5 lg:p-6 space-y-5">
                        <div class="flex items-center justify-between border-b border-emerald-500/20 pb-3">
                            <div class="flex items-center gap-2 text-emerald-400 font-bold text-[10px] uppercase tracking-widest">
                                <?= $svg($ic['mapPin'], 'w-4 h-4') ?> COVERAGE AREA
                            </div>
                        </div>
                        <div class="flex flex-col gap-3 font-mono text-xs text-gray-300 font-bold">
                            <?php foreach($v['coverage'] as $cov): ?>
                            <div class="flex items-center gap-3">
                                <span class="w-1.5 h-1.5 border border-emerald-400 bg-transparent transform rotate-45 shrink-0"></span>
                                <?= $e($cov) ?>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="mt-4 opacity-90 relative">
                            <div id="vendorMap" class="w-full h-36 rounded-xl overflow-hidden border border-white/10 shadow-lg bg-[#040E0A]"></div>
                        </div>
                    </div>

                    <!-- LISTINGS -->
                    <div class="<?= $card ?> p-5 lg:p-6 space-y-5">
                        <div class="flex items-center justify-between border-b border-emerald-500/20 pb-3">
                            <div class="flex items-center gap-2 text-emerald-400 font-bold text-[10px] uppercase tracking-widest">
                                <?= $svg($ic['leaf'], 'w-4 h-4') ?> <?= ($v['type'] == 'services' ? 'SERVICES' : 'LISTINGS') ?>
                            </div>
                            <a href="#" @click.prevent="activeTab = 'listings'" class="text-[9px] font-mono text-gray-400 hover:text-emerald-400 transition-colors uppercase tracking-widest">View All &rarr;</a>
                        </div>

                        <div class="space-y-3 font-mono">
                            <?php if ($v['type'] == 'services'): ?>
                                <?php foreach([['Land Preparation', '25 HA'], ['Drainage', '50 HA'], ['Planting Support', '25 HA']] as $srv): ?>
                                <div class="flex items-center gap-3 p-2.5 rounded bg-white/5 border border-white/10 hover:border-emerald-500/30 transition-colors">
                                    <div class="w-10 h-10 rounded bg-emerald-950/50 border border-emerald-500/20 flex items-center justify-center shrink-0 text-emerald-400">
                                        <?= $svg($ic['check'], 'w-4 h-4') ?>
                                    </div>
                                    <div class="flex-1 overflow-hidden">
                                        <div class="text-white text-[11px] font-bold truncate"><?= $srv[0] ?></div>
                                        <div class="text-gray-400 text-[9px] mt-0.5"><?= $srv[1] ?></div>
                                    </div>
                                    <span class="rounded bg-emerald-500/20 px-1.5 py-0.5 text-[8px] font-bold text-emerald-400 border border-emerald-500/40 uppercase flex items-center gap-0.5 shrink-0"><?= $svg($ic['shield'], 'w-2.5 h-2.5') ?> VERIFIED</span>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="flex items-center gap-3 p-2.5 rounded bg-white/5 border border-white/10 hover:border-emerald-500/30 transition-colors">
                                    <img src="<?= $basePrefix ?>/1.jpg" class="w-10 h-10 rounded object-cover shrink-0">
                                    <div class="flex-1 overflow-hidden">
                                        <div class="text-white text-[11px] font-bold truncate">NPK 15-15-15</div>
                                        <div class="text-gray-400 text-[9px] mt-0.5">15 MT</div>
                                    </div>
                                    <span class="rounded bg-emerald-500/20 px-1.5 py-0.5 text-[8px] font-bold text-emerald-400 border border-emerald-500/40 uppercase flex items-center gap-0.5 shrink-0"><?= $svg($ic['shield'], 'w-2.5 h-2.5') ?> VERIFIED</span>
                                </div>
                                <div class="flex items-center gap-3 p-2.5 rounded bg-white/5 border border-white/10 hover:border-emerald-500/30 transition-colors">
                                    <img src="<?= $basePrefix ?>/1.jpg" class="w-10 h-10 rounded object-cover grayscale brightness-125 shrink-0">
                                    <div class="flex-1 overflow-hidden">
                                        <div class="text-white text-[11px] font-bold truncate">Urea</div>
                                        <div class="text-gray-400 text-[9px] mt-0.5">10 MT</div>
                                    </div>
                                    <span class="rounded bg-emerald-500/20 px-1.5 py-0.5 text-[8px] font-bold text-emerald-400 border border-emerald-500/40 uppercase flex items-center gap-0.5 shrink-0"><?= $svg($ic['shield'], 'w-2.5 h-2.5') ?> VERIFIED</span>
                                </div>
                                <div class="flex items-center gap-3 p-2.5 rounded bg-white/5 border border-white/10 hover:border-emerald-500/30 transition-colors">
                                    <img src="<?= $basePrefix ?>/1.jpg" class="w-10 h-10 rounded object-cover sepia shrink-0">
                                    <div class="flex-1 overflow-hidden">
                                        <div class="text-white text-[11px] font-bold truncate">Dolomite</div>
                                        <div class="text-gray-400 text-[9px] mt-0.5">30 MT</div>
                                    </div>
                                    <span class="rounded bg-emerald-500/20 px-1.5 py-0.5 text-[8px] font-bold text-emerald-400 border border-emerald-500/40 uppercase flex items-center gap-0.5 shrink-0"><?= $svg($ic['shield'], 'w-2.5 h-2.5') ?> VERIFIED</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php elseif ($v['type'] == 'seed'): ?>
            <!-- 1 COLUMN FULL WIDTH CONTENT (Seed) -->
            <div class="space-y-6">
                <!-- VERIFIED NURSERY CAPABILITY -->
                <div class="<?= $card ?> p-5 lg:p-6 space-y-5">
                    <div class="flex items-center justify-between border-b border-emerald-500/20 pb-3">
                        <div class="flex items-center gap-2 text-emerald-400 font-bold text-[10px] uppercase tracking-widest">
                            <?= $svg($ic['shield'], 'w-4 h-4') ?> VERIFIED NURSERY CAPABILITY
                        </div>
                        <a href="#" @click.prevent="activeTab = 'nursery'" class="text-[9px] font-mono text-gray-400 hover:text-emerald-400 transition-colors uppercase tracking-widest">View Details &rarr;</a>
                    </div>
                    <div class="flex flex-col md:flex-row gap-6 font-mono text-xs">
                        <div class="w-full md:w-48 h-48 rounded-lg overflow-hidden shrink-0 border border-emerald-500/30">
                            <img src="<?= $basePrefix ?><?= $v['image'] ?>" class="w-full h-full object-cover">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 flex-1 text-gray-300">
                            <div class="space-y-4">
                                <div><div class="text-[9px] text-gray-500 uppercase font-bold">Planting Material</div><div class="text-emerald-300 font-bold">Certified Superior Seed</div></div>
                                <div><div class="text-[9px] text-gray-500 uppercase font-bold">Source</div><div class="text-white font-bold">Verified Nursery</div></div>
                                <div><div class="text-[9px] text-gray-500 uppercase font-bold">Planting Readiness</div><div class="text-white font-bold">Verified</div></div>
                                <div><div class="text-[9px] text-gray-500 uppercase font-bold">Certification</div><div class="text-white font-bold">Document Verified</div></div>
                            </div>
                            <div class="space-y-4">
                                <div><div class="text-[9px] text-gray-500 uppercase font-bold">Monthly Capacity</div><div class="text-white font-bold">150,000 Seedlings</div></div>
                                <div><div class="text-[9px] text-gray-500 uppercase font-bold">Minimum Order</div><div class="text-white font-bold">10,000 Seedlings</div></div>
                                <div><div class="text-[9px] text-gray-500 uppercase font-bold">Replacement Policy</div><div class="text-white font-bold">Documented</div></div>
                                <div><div class="text-[9px] text-gray-500 uppercase font-bold">Coverage</div><div class="text-white font-bold"><?= implode('<br>', $v['coverage']) ?></div></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 100 HA PACKAGE -->
                <div class="<?= $card ?> p-5 lg:p-6 space-y-5">
                    <div class="flex items-center justify-between border-b border-emerald-500/20 pb-3">
                        <div class="flex items-center gap-2 text-emerald-400 font-bold text-[10px] uppercase tracking-widest">
                            <?= $svg($ic['shield'], 'w-4 h-4') ?> 100 HA PACKAGE
                        </div>
                        <a href="#" @click.prevent="activeTab = 'packages'" class="text-[9px] font-mono text-gray-400 hover:text-emerald-400 transition-colors uppercase tracking-widest">View All Packages &rarr;</a>
                    </div>
                    <div class="flex flex-col md:flex-row gap-6 font-mono text-xs">
                        <div class="w-full md:w-48 h-36 rounded-lg overflow-hidden shrink-0 border border-emerald-500/30">
                            <img src="<?= $basePrefix ?><?= $v['image'] ?>" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 space-y-5">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="text-white font-extrabold text-base tracking-tight">Certified Superior Oil Palm Seedling</div>
                                    <div class="text-[10px] text-gray-400 mt-1 uppercase tracking-widest font-bold">Density: 143 seedling / HA</div>
                                </div>
                                <span class="rounded border border-emerald-400/40 bg-emerald-500/20 px-2 py-0.5 text-[9px] font-bold text-emerald-300 uppercase flex items-center gap-1"><?= $svg($ic['shield'], 'w-3 h-3') ?> VERIFIED</span>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 items-end">
                                <div><div class="text-[9px] text-gray-500 uppercase font-bold mb-1">Price / Seedling</div><div class="text-white font-bold">US$ 2.20</div></div>
                                <div><div class="text-[9px] text-gray-500 uppercase font-bold mb-1">Total Seedlings</div><div class="text-white font-bold">14,300 seedlings</div></div>
                                <div><button class="border border-emerald-500/40 px-3 py-2 rounded text-emerald-400 text-[9px] font-bold uppercase tracking-widest hover:bg-emerald-950 transition-colors w-full text-center">View Certification &rarr;</button></div>
                                <div><div class="text-[9px] text-gray-500 uppercase font-bold mb-1">Package Price</div><div class="text-emerald-300 font-bold">US$ 31,460</div></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- LISTINGS -->
                <div class="<?= $card ?> p-5 lg:p-6 space-y-5">
                    <div class="flex items-center justify-between border-b border-emerald-500/20 pb-3">
                        <div class="flex items-center gap-2 text-emerald-400 font-bold text-[10px] uppercase tracking-widest">
                            <?= $svg($ic['shield'], 'w-4 h-4') ?> LISTINGS
                        </div>
                        <a href="#" @click.prevent="activeTab = 'listings'" class="text-[9px] font-mono text-gray-400 hover:text-emerald-400 transition-colors uppercase tracking-widest">View All &rarr;</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 font-mono">
                        <div class="flex items-center gap-3 p-3 rounded-lg bg-white/5 border border-white/10 hover:border-emerald-500/30 transition-colors">
                            <img src="<?= $basePrefix ?><?= $v['image'] ?>" class="w-16 h-16 rounded object-cover shrink-0">
                            <div class="flex-1 overflow-hidden">
                                <div class="text-white text-[11px] font-bold truncate">Certified Superior Seedling</div>
                                <div class="text-gray-400 text-[9px] mt-0.5">Seedling Supply &bull; 25,000</div>
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="rounded bg-white/5 px-1.5 py-0.5 text-[8px] font-bold text-gray-300 border border-white/10 uppercase">COMPLETED</span>
                                    <span class="rounded bg-emerald-500/20 px-1.5 py-0.5 text-[8px] font-bold text-emerald-400 border border-emerald-500/40 uppercase flex items-center gap-0.5"><?= $svg($ic['shield'], 'w-2 h-2') ?> VERIFIED</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-lg bg-white/5 border border-white/10 hover:border-emerald-500/30 transition-colors">
                            <img src="<?= $basePrefix ?>/nursery.jpg" class="w-16 h-16 rounded object-cover shrink-0 grayscale brightness-125">
                            <div class="flex-1 overflow-hidden">
                                <div class="text-white text-[11px] font-bold truncate">PT. Papua Hutan Lestari - Batch 02</div>
                                <div class="text-gray-400 text-[9px] mt-0.5">Seedling Supply &bull; 25,000</div>
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="rounded bg-white/5 px-1.5 py-0.5 text-[8px] font-bold text-gray-300 border border-white/10 uppercase">COMPLETED</span>
                                    <span class="rounded bg-emerald-500/20 px-1.5 py-0.5 text-[8px] font-bold text-emerald-400 border border-emerald-500/40 uppercase flex items-center gap-0.5"><?= $svg($ic['shield'], 'w-2 h-2') ?> VERIFIED</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php elseif ($v['type'] == 'equipment'): ?>
            <!-- 1 COLUMN FULL WIDTH CONTENT (Equipment) -->
            <div class="space-y-6">
                <!-- VERIFIED FLEET CAPABILITY -->
                <div class="<?= $card ?> p-5 lg:p-6 space-y-5">
                    <div class="flex items-center justify-between border-b border-emerald-500/20 pb-3">
                        <div class="flex items-center gap-2 text-emerald-400 font-bold text-[10px] uppercase tracking-widest">
                            <?= $svg($ic['shield'], 'w-4 h-4') ?> VERIFIED FLEET CAPABILITY
                        </div>
                        <a href="#" @click.prevent="activeTab = 'fleet'" class="text-[9px] font-mono text-gray-400 hover:text-emerald-400 transition-colors uppercase tracking-widest">View Details &rarr;</a>
                    </div>
                    <div class="flex flex-col md:flex-row gap-6 font-mono text-xs">
                        <div class="w-full md:w-64 h-48 rounded-lg overflow-hidden shrink-0 border border-emerald-500/30">
                            <img src="<?= $basePrefix ?><?= $v['image'] ?>" class="w-full h-full object-cover">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 flex-1 text-gray-300">
                            <div class="space-y-4">
                                <div>
                                    <div class="text-white font-extrabold text-lg mb-3 tracking-tight">Excavator 20 Ton</div>
                                    <div class="text-[9px] text-gray-500 uppercase font-bold mb-1">Equipment Type</div><div class="text-white font-bold">Excavator</div>
                                </div>
                                <div><div class="text-[9px] text-gray-500 uppercase font-bold mb-1">Class</div><div class="text-white font-bold">20 Ton</div></div>
                                <div><div class="text-[9px] text-gray-500 uppercase font-bold mb-1">Mobilization Point</div><div class="text-emerald-300 font-bold">East Kalimantan</div></div>
                            </div>
                            <div class="space-y-4">
                                <div><div class="text-[9px] text-gray-500 uppercase font-bold mb-1">Uncommitted Units</div><div class="text-white font-bold">8</div></div>
                                <div><div class="text-[9px] text-gray-500 uppercase font-bold mb-1">Operating Units</div><div class="text-white font-bold">7 Units</div></div>
                                <div><div class="text-[9px] text-gray-500 uppercase font-bold mb-1">Fleet Utilization</div><div class="text-white font-bold">87.5%</div></div>
                                <div><div class="text-[9px] text-gray-500 uppercase font-bold mb-1">Coverage Area</div><div class="text-white font-bold border border-white/20 bg-white/5 rounded px-2 py-1 inline-block mt-1">Kalimantan</div></div>
                            </div>
                            <div class="space-y-4 flex flex-col justify-between items-start h-full pb-1">
                                <span class="rounded bg-emerald-500/20 px-2.5 py-1 text-[9px] font-bold text-emerald-400 border border-emerald-500/40 uppercase flex items-center gap-1.5"><?= $svg($ic['shield'], 'w-3 h-3') ?> NINA VERIFIED</span>
                                <div class="w-full space-y-4 mt-2">
                                    <div><div class="text-[9px] text-gray-500 uppercase font-bold mb-1">Fleet Inspection</div><div class="text-white font-bold">Verified</div></div>
                                    <div><div class="text-[9px] text-gray-500 uppercase font-bold mb-1">Maintenance</div><div class="text-white font-bold">Standard Compliant</div></div>
                                </div>
                                <button class="border border-emerald-500/40 px-3 py-2 rounded text-emerald-400 text-[9px] font-bold uppercase tracking-widest hover:bg-emerald-950 transition-colors w-full text-center mt-auto">View Equipment Specification &rarr;</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 100 HA PACKAGE -->
                <div class="<?= $card ?> p-5 lg:p-6 space-y-5">
                    <div class="flex items-center justify-between border-b border-emerald-500/20 pb-3">
                        <div class="flex items-center gap-2 text-emerald-400 font-bold text-[10px] uppercase tracking-widest">
                            <?= $svg($ic['shield'], 'w-4 h-4') ?> 100 HA PACKAGE
                        </div>
                        <a href="#" @click.prevent="activeTab = 'packages'" class="text-[9px] font-mono text-gray-400 hover:text-emerald-400 transition-colors uppercase tracking-widest">View All &rarr;</a>
                    </div>
                    <div class="flex flex-col md:flex-row gap-6 font-mono text-xs">
                        <div class="w-full md:w-56 h-40 rounded-lg overflow-hidden shrink-0 border border-emerald-500/30 relative group">
                            <img src="<?= $basePrefix ?><?= $v['image'] ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute bottom-2 left-2 right-2 bg-black/80 backdrop-blur rounded px-3 py-2 border border-white/10 text-center">
                                <div class="text-[8px] text-gray-400 uppercase font-bold mb-0.5">Package Price</div>
                                <div class="text-emerald-300 font-bold text-xs">US$ 42,000</div>
                            </div>
                        </div>
                        <div class="flex-1 space-y-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="text-white font-extrabold text-base tracking-tight mb-3">Land Preparation Equipment Package</div>
                                    <div class="text-[10px] text-gray-300 space-y-1.5 bg-white/5 border border-white/10 p-3 rounded-lg w-fit">
                                        <div class="text-gray-500 uppercase font-bold text-[9px] mb-2">Equipment Mix</div>
                                        <div class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Excavator 20T (2 units)</div>
                                        <div class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Bulldozer (1 unit)</div>
                                        <div class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Dump Truck (4 units)</div>
                                    </div>
                                </div>
                                <span class="rounded border border-emerald-400/40 bg-emerald-500/20 px-2 py-0.5 text-[9px] font-bold text-emerald-300 uppercase flex items-center gap-1 shrink-0"><?= $svg($ic['shield'], 'w-3 h-3') ?> VERIFIED</span>
                            </div>
                            <div class="flex flex-col sm:flex-row gap-6 sm:items-end justify-between border-t border-white/5 pt-4">
                                <button class="border border-emerald-500/40 px-4 py-2 rounded text-emerald-400 text-[9px] font-bold uppercase tracking-widest hover:bg-emerald-950 transition-colors w-fit">View Productivity Basis &rarr;</button>

                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-x-8 gap-y-4">
                                    <div><div class="text-[9px] text-gray-500 uppercase font-bold mb-1">Total Standard Hours</div><div class="text-white font-bold">960 MH</div></div>
                                    <div><div class="text-[9px] text-gray-500 uppercase font-bold mb-1">Coverage</div><div class="text-white font-bold">North Kalimantan</div></div>
                                    <div><div class="text-[9px] text-gray-500 uppercase font-bold mb-1">Price Basis</div><div class="text-white font-bold">100 HA / Standard Condition</div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- EQUIPMENT LISTING -->
                <div class="<?= $card ?> p-5 lg:p-6 space-y-5">
                    <div class="flex items-center justify-between border-b border-emerald-500/20 pb-3">
                        <div class="flex items-center gap-2 text-emerald-400 font-bold text-[10px] uppercase tracking-widest">
                            <?= $svg($ic['shield'], 'w-4 h-4') ?> EQUIPMENT LISTING
                        </div>
                        <a href="#" @click.prevent="activeTab = 'fleet'" class="text-[9px] font-mono text-gray-400 hover:text-emerald-400 transition-colors uppercase tracking-widest">View All &rarr;</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 font-mono">
                        <div class="flex items-center gap-3 p-3 rounded-lg bg-white/5 border border-white/10 hover:border-emerald-500/30 transition-colors">
                            <img src="<?= $basePrefix ?>/excavator.jpg" class="w-16 h-16 rounded object-cover shrink-0">
                            <div class="flex-1 overflow-hidden">
                                <div class="text-white text-[11px] font-bold truncate">PT. Mahakam Tirta Perdana - Batch 01</div>
                                <div class="text-gray-400 text-[9px] mt-0.5">Land Preparation &bull; 2 Excavators</div>
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="rounded bg-white/5 px-1.5 py-0.5 text-[8px] font-bold text-gray-300 border border-white/10 uppercase">COMPLETED</span>
                                    <span class="rounded bg-emerald-500/20 px-1.5 py-0.5 text-[8px] font-bold text-emerald-400 border border-emerald-500/40 uppercase flex items-center gap-0.5"><?= $svg($ic['shield'], 'w-2 h-2') ?> VERIFIED</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-lg bg-white/5 border border-white/10 hover:border-emerald-500/30 transition-colors">
                            <img src="<?= $basePrefix ?><?= $v['image'] ?>" class="w-16 h-16 rounded object-cover shrink-0 grayscale brightness-125">
                            <div class="flex-1 overflow-hidden">
                                <div class="text-white text-[11px] font-bold truncate">Bulldozer</div>
                                <div class="text-gray-400 text-[9px] mt-0.5">4 Units</div>
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="rounded bg-white/5 px-1.5 py-0.5 text-[8px] font-bold text-gray-300 border border-white/10 uppercase">COMPLETED</span>
                                    <span class="rounded bg-emerald-500/20 px-1.5 py-0.5 text-[8px] font-bold text-emerald-400 border border-emerald-500/40 uppercase flex items-center gap-0.5"><?= $svg($ic['shield'], 'w-2 h-2') ?> VERIFIED</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-lg bg-white/5 border border-white/10 hover:border-emerald-500/30 transition-colors">
                            <img src="<?= $basePrefix ?>/excavator.jpg" class="w-16 h-16 rounded object-cover shrink-0 sepia">
                            <div class="flex-1 overflow-hidden">
                                <div class="text-white text-[11px] font-bold truncate">Dump Truck</div>
                                <div class="text-gray-400 text-[9px] mt-0.5">10 Units</div>
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="rounded bg-emerald-500/20 px-1.5 py-0.5 text-[8px] font-bold text-emerald-400 border border-emerald-500/40 uppercase flex items-center gap-0.5"><?= $svg($ic['shield'], 'w-2 h-2') ?> VERIFIED</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <!-- END DYNAMIC VENDOR LAYOUTS -->

            <!-- 4. PROJECT EXPERIENCE (HISTORY) -->
            <div class="<?= $card ?> p-5 lg:p-6 space-y-5">
                <div class="flex items-center justify-between border-b border-emerald-500/20 pb-3">
                    <div class="flex items-center gap-2 text-emerald-400 font-bold text-[10px] uppercase tracking-widest">
                        <?= $svg($ic['shield'], 'w-4 h-4') ?> PROJECT EXPERIENCE
                    </div>
                    <a href="#" @click.prevent="activeTab = '<?= $v['type'] == 'equipment' ? 'utilization' : ($v['type'] == 'seed' ? 'nursery' : 'history') ?>'" class="text-[9px] font-mono text-gray-400 hover:text-emerald-400 transition-colors uppercase tracking-widest">View All Projects &rarr;</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="border border-emerald-500/20 bg-black/40 p-4 rounded-xl font-mono space-y-3">
                        <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest border-b border-white/5 pb-2">PT. Papua Hutan Lestari &bull; Batch 03</div>
                        <div class="text-white text-xs font-bold uppercase"><?= $v['category'] ?></div>
                        <div class="text-emerald-300 text-lg font-bold mt-1"><?= ($v['type'] == 'fertilizer' ? '125 MT' : ($v['type'] == 'equipment' ? '2 Excavators' : ($v['type'] == 'seed' ? '25,000 Seedlings' : '25 HA'))) ?></div>
                        <div class="flex items-center gap-2 pt-2">
                            <span class="rounded bg-white/5 px-2 py-0.5 text-[9px] font-bold text-gray-300 border border-white/10 uppercase">COMPLETED</span>
                            <span class="rounded bg-emerald-500/20 px-2 py-0.5 text-[9px] font-bold text-emerald-400 border border-emerald-500/40 uppercase flex items-center gap-1">VERIFIED</span>
                        </div>
                    </div>

                    <div class="border border-emerald-500/20 bg-black/40 p-4 rounded-xl font-mono space-y-3">
                        <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest border-b border-white/5 pb-2">PT. Mahakam Tirta Perdana &bull; Batch 04</div>
                        <div class="text-white text-xs font-bold uppercase"><?= $v['category'] ?></div>
                        <div class="text-emerald-300 text-lg font-bold mt-1"><?= ($v['type'] == 'fertilizer' ? '140 MT' : ($v['type'] == 'equipment' ? '3 Excavators' : ($v['type'] == 'seed' ? '14,300 Seedlings' : '25 HA'))) ?></div>
                        <div class="flex items-center gap-2 pt-2">
                            <span class="rounded bg-white/5 px-2 py-0.5 text-[9px] font-bold text-gray-300 border border-white/10 uppercase">COMPLETED</span>
                            <span class="rounded bg-emerald-500/20 px-2 py-0.5 text-[9px] font-bold text-emerald-400 border border-emerald-500/40 uppercase flex items-center gap-1">VERIFIED</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. PROJECT EXPERIENCE REVIEW -->
            <div class="<?= $card ?> p-5 lg:p-6 space-y-5">
                <div class="flex items-center justify-between border-b border-emerald-500/20 pb-3">
                    <div class="flex items-center gap-2 text-emerald-400 font-bold text-[10px] uppercase tracking-widest">
                        <?= $svg($ic['leaf'], 'w-4 h-4') ?> PROJECT EXPERIENCE REVIEW
                    </div>
                    <a href="#" @click.prevent="activeTab = 'reviews'" class="text-[9px] font-mono text-gray-400 hover:text-emerald-400 transition-colors uppercase tracking-widest">View All Reviews &rarr;</a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start font-mono">
                    <div class="lg:col-span-3">
                        <div class="rounded-xl overflow-hidden border border-emerald-500/20 h-32 relative">
                            <img src="<?= $basePrefix ?>/4.jpg" class="w-full h-full object-cover" />
                        </div>
                    </div>

                    <div class="lg:col-span-4 space-y-3">
                        <h4 class="text-lg lg:text-xl font-extrabold text-white uppercase leading-none">PT. Papua Hutan Lestari <span class="text-gray-500">&bull; BATCH 02</span></h4>
                        <div class="grid grid-cols-2 gap-y-2.5 text-[9px] uppercase font-bold text-gray-400 pt-2">
                            <div>RAB Category</div><div class="text-white truncate"><?= $v['category'] ?></div>
                            <div>Vendor Scope</div><div class="text-white truncate">Execution / Supply</div>
                            <div>Execution</div><div class="text-white">Completed</div>
                            <div>Verification</div><div class="text-emerald-400">Verified</div>
                        </div>
                    </div>

                    <div class="lg:col-span-2 flex flex-col items-start lg:items-center justify-center border-t lg:border-t-0 lg:border-l border-emerald-500/20 pt-4 lg:pt-0 lg:px-4 h-full">
                        <div class="text-[9px] text-emerald-400 uppercase tracking-widest font-bold mb-1">Experience Score</div>
                        <div class="text-3xl font-extrabold text-white leading-none"><?= number_format($v['score'], 1) ?> <span class="text-sm text-gray-500">/ 5</span></div>
                        <div class="flex text-amber-400 mt-2">
                            <?= str_repeat($svg($ic['star'], 'w-4 h-4 text-amber-400'), 5) ?>
                        </div>
                    </div>

                    <div class="lg:col-span-3 border-t lg:border-t-0 lg:border-l border-emerald-500/20 pt-4 lg:pt-0 lg:pl-6 space-y-3 text-[9px] uppercase font-bold text-gray-400">
                        <div class="mb-3 text-emerald-400">Performance Breakdown</div>
                        <?php
                        $bdowns = [
                            'fertilizer' => ['Product Quality' => 4.9, 'Delivery Reliability' => 4.8, 'Quantity Accuracy' => 4.9, 'Documentation' => 4.8, 'Responsiveness' => 4.7],
                            'equipment' => ['Equipment Availability' => 4.9, 'Mobilization' => 4.8, 'Schedule Adherence' => 4.7, 'Operator Support' => 4.8, 'Breakdown Response' => 4.7, 'Safety Documentation' => 4.8],
                            'services' => ['Completion Reliability' => 4.9, 'Field Quality' => 4.8, 'Schedule Adherence' => 4.7, 'Documentation' => 4.8, 'Plant Regeneration' => 4.8, 'Cost Control' => 4.8],
                            'seed' => ['Material Quality' => 4.9, 'Certification' => 5.0, 'Quantity Accuracy' => 4.9, 'Delivery Condition' => 4.8, 'Delivery Timing' => 4.8]
                        ];
                        $cBD = $bdowns[$v['type']] ?? $bdowns['fertilizer'];
                        foreach($cBD as $name => $sc):
                        ?>
                        <div class="flex items-center justify-between gap-4">
                            <span class="truncate"><?= $name ?></span>
                            <div class="flex items-center gap-2 shrink-0">
                                <div class="w-16 h-1.5 bg-white/10 rounded-full overflow-hidden"><div class="h-full bg-emerald-400 w-11/12"></div></div>
                                <span class="text-white w-4"><?= number_format($sc, 1) ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="mt-4 p-5 rounded-xl border border-emerald-500/20 bg-emerald-950/20 text-xs text-gray-300 italic leading-relaxed font-sans">
                    "The <?= ($v['type'] == 'fertilizer' ? 'fertilizer package' : ($v['type'] == 'equipment' ? 'equipment mobilization' : ($v['type'] == 'seed' ? 'planting material' : 'land preparation work'))) ?> was delivered according to the approved RAB specification and scheduled field requirement. Quantity documentation and delivery coordination were clear throughout the execution period."
                </div>

                <div class="flex items-center justify-between pt-2">
                    <div class="flex items-center gap-4">
                        <span class="rounded border border-emerald-500/40 bg-emerald-950/80 px-3 py-1.5 text-[9px] font-extrabold text-emerald-400 uppercase tracking-widest flex items-center gap-1.5 shadow-[0_0_10px_rgba(16,185,129,0.2)]">
                            <?= $svg($ic['shield'], 'w-3 h-3') ?> VERIFIED PROJECT EXPERIENCE
                        </span>
                        <span class="text-[9px] font-mono text-gray-500 uppercase tracking-widest">Reviewed &bull; Sep 2026</span>
                    </div>
                    <span class="text-[9px] font-mono text-gray-600 uppercase tracking-widest hidden sm:block">SIMULATED / ILLUSTRATIVE VENDOR PROFILE</span>
                </div>
            </div>

        </div> <!-- END TAB OVERVIEW -->
    </div>
</div>

<script>
    function initVendorMap() {
        const mapEl = document.getElementById('vendorMap');
        if (!mapEl) return;

        const NETWORK_STYLE = [
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

        const map = new google.maps.Map(mapEl, {
            center: { lat: 1.5, lng: 116.5 },
            zoom: 4,
            styles: NETWORK_STYLE,
            backgroundColor: '#040E0A',
            disableDefaultUI: true,
            gestureHandling: 'none',
            zoomControl: false
        });

        const coverageDict = {
            'North Kalimantan': { lat: 3.1257, lng: 116.5936 },
            'East Kalimantan': { lat: 1.0963, lng: 116.3262 },
            'Kalimantan': { lat: 1.0, lng: 114.0 },
            'Sulawesi': { lat: -2.0, lng: 120.0 }
        };

        const coverages = <?= json_encode($v['coverage']) ?>;
        const bounds = new google.maps.LatLngBounds();
        let hasPoints = false;

        coverages.forEach(cov => {
            const pos = coverageDict[cov];
            if (pos) {
                hasPoints = true;
                bounds.extend(pos);

                // Draw a simple dot marker
                new google.maps.Marker({
                    position: pos,
                    map: map,
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        fillColor: '#34d399', // emerald-400
                        fillOpacity: 0.8,
                        strokeColor: '#fff',
                        strokeWeight: 1.5,
                        scale: 4
                    }
                });
            }
        });

        if (hasPoints) {
            if (coverages.length === 1) {
                map.setCenter(coverageDict[coverages[0]]);
                map.setZoom(5);
            } else {
                map.fitBounds(bounds, 10);
            }
        }
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeyP_0nYynBU5ImC0AWBzGxkiXep-Z0K4&callback=initVendorMap"></script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/dashboard.php';
