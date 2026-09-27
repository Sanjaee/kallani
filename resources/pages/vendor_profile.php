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
        'image' => '/1.jpg',
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
        'image' => '/4.jpg',
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
        'image' => '/2.jpg',
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
        'image' => '/3.jpg',
        'type' => 'seed'
    ]
];

if (!isset($vendors[$vendorId])) {
    $vendorId = 'pt-agro-nusantara-fertilizer';
}
$v = $vendors[$vendorId];
$title = $v['name'] . ' — NINA Vendor Network';
ob_start();
?>

<div class="relative w-full font-sans pb-16" x-data="{ activeTab: 'overview' }">
    <!-- PAGE BACKGROUND -->
    <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden">
        <img src="<?= $basePrefix ?><?= $v['image'] ?>" alt="" class="h-full w-full scale-110 object-cover opacity-10 blur-xl grayscale" />
        <div class="absolute inset-0 bg-gradient-to-b from-[#020A07]/90 via-[#030F0A]/95 to-[#020A07]"></div>
    </div>

    <div class="relative z-10 px-4 pt-6 sm:px-6 lg:px-8 space-y-6">

        <!-- Top Row: Breadcrumb -->
        <div class="flex items-center gap-2 text-[10px] font-mono font-bold uppercase tracking-wider text-gray-400 border-b border-emerald-500/20 pb-4">
            <a href="<?= $basePrefix ?>/vendors" class="hover:text-emerald-400 transition-colors">Vendor Directory</a>
            <span class="text-gray-600">/</span>
            <span class="text-gray-300"><?= $e($v['category']) ?></span>
            <span class="text-gray-600">/</span>
            <span class="text-emerald-400"><?= $e($v['name']) ?></span>
        </div>

        <!-- HERO CARD -->
        <div class="<?= $card ?> overflow-hidden relative">
            <img src="<?= $basePrefix ?><?= $v['image'] ?>" class="absolute top-0 right-0 h-full w-full lg:w-2/3 object-cover opacity-30 lg:opacity-60 mask-image-gradient" style="mask-image: linear-gradient(to right, transparent, black);" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#040C0A] via-[#040C0A]/90 to-transparent"></div>
            
            <div class="relative p-6 lg:p-8 flex flex-col lg:flex-row gap-6 lg:items-center">
                <!-- Logo Block -->
                <div class="w-24 h-24 lg:w-32 lg:h-32 bg-emerald-950/80 rounded-2xl border border-emerald-500/40 flex items-center justify-center shrink-0 shadow-[0_0_30px_rgba(16,185,129,0.15)]">
                    <div class="text-center">
                        <div class="text-emerald-400 mb-1 flex justify-center"><?= $svg($ic['leaf'], 'w-8 h-8 lg:w-10 lg:h-10') ?></div>
                        <div class="text-[9px] lg:text-[10px] font-extrabold text-white uppercase tracking-widest leading-none"><?= substr(str_replace('PT ', '', $v['name']), 0, 8) ?></div>
                    </div>
                </div>
                
                <!-- Info Block -->
                <div class="flex-1 space-y-3">
                    <div class="flex items-center gap-3">
                        <span class="rounded bg-emerald-500/20 px-2.5 py-1 text-[10px] font-bold text-emerald-300 border border-emerald-500/40 flex items-center gap-1.5 uppercase tracking-widest">
                            <?= $svg($ic['shield'], 'w-3 h-3') ?> NINA VERIFIED VENDOR
                        </span>
                        <span class="rounded bg-emerald-500 px-2.5 py-1 text-[10px] font-extrabold text-black flex items-center gap-1.5 uppercase tracking-widest shadow-[0_0_15px_rgba(16,185,129,0.3)]">
                            <?= $svg($ic['check'], 'w-3 h-3') ?> ACTIVE
                        </span>
                    </div>
                    
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-extrabold text-white tracking-tight"><?= $e($v['name']) ?></h1>
                        <h2 class="text-lg lg:text-xl font-bold text-gray-300 mt-1"><?= $e($v['category']) ?></h2>
                    </div>
                    
                    <div class="flex items-center gap-4 text-xs font-mono font-bold">
                        <span class="text-emerald-400"><?= $e($v['role']) ?></span>
                        <div class="flex items-center gap-1.5 text-gray-400">
                            <?= $svg($ic['mapPin'], 'w-3.5 h-3.5') ?>
                            <?= implode(' &bull; ', $v['coverage']) ?>
                        </div>
                    </div>
                    
                    <div class="pt-2 flex items-center gap-3">
                        <span class="rounded bg-amber-950/80 px-3 py-1.5 text-[10px] font-extrabold text-amber-400 border border-amber-500/40 uppercase tracking-widest flex items-center gap-1.5">
                            <?= $svg($ic['shield'], 'w-3 h-3') ?> <?= $e($v['tier']) ?>
                        </span>
                        <span class="text-[10px] font-mono text-gray-400 uppercase tracking-widest bg-white/5 border border-white/10 px-3 py-1.5 rounded flex items-center gap-2"><?= $e($v['tier_label']) ?> &rarr;</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABS -->
        <div class="flex items-center gap-6 border-b border-emerald-500/20 text-[10px] font-mono font-bold uppercase tracking-wider overflow-x-auto scrollbar-none">
            <button @click="activeTab = 'overview'" :class="activeTab === 'overview' ? 'text-emerald-400 border-b-2 border-emerald-400 pb-3' : 'text-gray-400 hover:text-white pb-3'">Overview</button>
            <button @click="activeTab = 'packages'" :class="activeTab === 'packages' ? 'text-emerald-400 border-b-2 border-emerald-400 pb-3' : 'text-gray-400 hover:text-white pb-3'">100 HA Package</button>
            <button @click="activeTab = 'listings'" :class="activeTab === 'listings' ? 'text-emerald-400 border-b-2 border-emerald-400 pb-3' : 'text-gray-400 hover:text-white pb-3'">Listings</button>
            <button @click="activeTab = 'history'" :class="activeTab === 'history' ? 'text-emerald-400 border-b-2 border-emerald-400 pb-3' : 'text-gray-400 hover:text-white pb-3'">Supply History</button>
            <button @click="activeTab = 'performance'" :class="activeTab === 'performance' ? 'text-emerald-400 border-b-2 border-emerald-400 pb-3' : 'text-gray-400 hover:text-white pb-3'">Performance</button>
            <button @click="activeTab = 'reviews'" :class="activeTab === 'reviews' ? 'text-emerald-400 border-b-2 border-emerald-400 pb-3' : 'text-gray-400 hover:text-white pb-3'">Reviews</button>
        </div>

        <div x-show="activeTab === 'overview'" class="space-y-6">
            <!-- 1. PERFORMANCE OVERVIEW -->
            <div class="<?= $card ?> p-5 lg:p-6 space-y-5">
                <div class="flex items-center justify-between border-b border-emerald-500/20 pb-3">
                    <div class="flex items-center gap-2 text-emerald-400 font-bold text-[10px] uppercase tracking-widest">
                        <?= $svg($ic['leaf'], 'w-4 h-4') ?> VENDOR PERFORMANCE OVERVIEW
                    </div>
                    <a href="#" class="text-[9px] font-mono text-gray-400 hover:text-emerald-400 transition-colors uppercase tracking-widest">View Full Performance &rarr;</a>
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
                    
                    <div class="<?= $metricBox ?>">
                        <div class="text-2xl lg:text-3xl font-extrabold text-white font-mono leading-none"><?= number_format($v['score'], 1) ?> <span class="text-sm text-gray-500">/ 5</span></div>
                        <div class="text-[9px] text-gray-400 uppercase tracking-widest font-bold mt-2">Project Experience</div>
                    </div>
                    <div class="border border-emerald-500/40 bg-emerald-950/40 p-3 lg:p-4 rounded-xl flex items-center justify-center flex-col text-center gap-2">
                        <?= $svg($ic['shield'], 'w-8 h-8 text-emerald-400') ?>
                        <div>
                            <div class="text-emerald-300 font-extrabold text-xs uppercase tracking-widest">VERIFIED</div>
                            <div class="text-emerald-400/70 text-[8px] font-mono uppercase tracking-widest mt-0.5">Performance Record</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. VERIFIED CAPABILITY -->
            <div class="<?= $card ?> p-5 lg:p-6 space-y-5">
                <div class="flex items-center justify-between border-b border-emerald-500/20 pb-3">
                    <div class="flex items-center gap-2 text-emerald-400 font-bold text-[10px] uppercase tracking-widest">
                        <?= $svg($ic['shield'], 'w-4 h-4') ?> VERIFIED <?= ($v['type'] == 'services' ? 'SERVICE' : ($v['type'] == 'equipment' ? 'FLEET' : ($v['type'] == 'seed' ? 'NURSERY' : 'SUPPLY'))) ?> CAPABILITY
                    </div>
                    <a href="#" class="text-[9px] font-mono text-gray-400 hover:text-emerald-400 transition-colors uppercase tracking-widest">View Details &rarr;</a>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                    <!-- Image -->
                    <div class="lg:col-span-3">
                        <div class="rounded-xl overflow-hidden border border-emerald-500/20 h-40 relative">
                            <img src="<?= $basePrefix ?><?= $v['image'] ?>" class="w-full h-full object-cover" />
                            <div class="absolute inset-0 bg-emerald-900/20 mix-blend-overlay"></div>
                        </div>
                    </div>
                    
                    <!-- Dynamic Details depending on Type -->
                    <div class="lg:col-span-9 grid grid-cols-2 lg:grid-cols-3 gap-6 font-mono text-xs">
                        <?php if($v['type'] == 'fertilizer'): ?>
                            <div class="space-y-4">
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Product Category</div>
                                    <div class="text-white font-bold">Fertilizer & Crop Nutrition</div>
                                </div>
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Verified Supply Capacity</div>
                                    <div class="text-lg text-emerald-300 font-bold">500 MT / Month</div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Key Products</div>
                                    <ul class="text-gray-300 space-y-1">
                                        <li>&bull; NPK 15-15-15</li>
                                        <li>&bull; Urea</li>
                                        <li>&bull; Dolomite</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Minimum Order</div>
                                    <div class="text-white font-bold">10 MT</div>
                                </div>
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Coverage</div>
                                    <ul class="text-gray-300 space-y-0.5 text-[10px]">
                                        <li>&bull; North Kalimantan</li>
                                        <li>&bull; East Kalimantan</li>
                                        <li>&bull; Central Kalimantan</li>
                                    </ul>
                                </div>
                            </div>
                        <?php elseif($v['type'] == 'equipment'): ?>
                            <div class="space-y-4">
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Equipment Category</div>
                                    <div class="text-white font-bold">Heavy Machinery & Fleet</div>
                                </div>
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Verified Fleet Size</div>
                                    <div class="text-lg text-emerald-300 font-bold">35 Units</div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Key Equipment</div>
                                    <ul class="text-gray-300 space-y-1">
                                        <li>&bull; Excavator 20 Ton</li>
                                        <li>&bull; Bulldozer D85</li>
                                        <li>&bull; Motor Grader 120K</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Operator Included</div>
                                    <div class="text-white font-bold">Yes - Verified</div>
                                </div>
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Coverage</div>
                                    <ul class="text-gray-300 space-y-0.5 text-[10px]">
                                        <li>&bull; All Kalimantan Provinces</li>
                                    </ul>
                                </div>
                            </div>
                        <?php elseif($v['type'] == 'services'): ?>
                            <div class="space-y-4">
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Service Category</div>
                                    <ul class="text-gray-300 space-y-1.5">
                                        <li class="flex items-center gap-2"><?= $svg($ic['check'], 'w-3 h-3 text-emerald-400') ?> Land Clearing</li>
                                        <li class="flex items-center gap-2"><?= $svg($ic['check'], 'w-3 h-3 text-emerald-400') ?> Land Preparation</li>
                                        <li class="flex items-center gap-2"><?= $svg($ic['check'], 'w-3 h-3 text-emerald-400') ?> Drainage Work</li>
                                        <li class="flex items-center gap-2"><?= $svg($ic['check'], 'w-3 h-3 text-emerald-400') ?> Field Road</li>
                                        <li class="flex items-center gap-2"><?= $svg($ic['check'], 'w-3 h-3 text-emerald-400') ?> Planting Support</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Max Verified Capacity</div>
                                    <div class="text-lg text-emerald-300 font-bold">250 HA / Project</div>
                                </div>
                                <div class="pt-2">
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Coverage</div>
                                    <div class="text-white font-bold">North Kalimantan</div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Crew Capacity</div>
                                    <div class="text-white font-bold">6 Field Teams</div>
                                </div>
                            </div>
                        <?php elseif($v['type'] == 'seed'): ?>
                            <div class="space-y-4">
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Planting Material</div>
                                    <div class="text-emerald-400 font-bold">Certified Superior Seed</div>
                                </div>
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Source</div>
                                    <div class="text-white font-bold">Verified Nursery</div>
                                </div>
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Certification</div>
                                    <div class="text-white font-bold">Document Verified</div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Monthly Capacity</div>
                                    <div class="text-white font-bold">150,000 Seedlings</div>
                                </div>
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Minimum Order</div>
                                    <div class="text-white font-bold">10,000 Seedlings</div>
                                </div>
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Replacement Policy</div>
                                    <div class="text-white font-bold">Documented</div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Coverage</div>
                                    <ul class="text-gray-300 space-y-0.5 text-[10px]">
                                        <li>&bull; North Kalimantan</li>
                                        <li>&bull; East Kalimantan</li>
                                        <li>&bull; Sulawesi</li>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- 3. VERIFIED LISTINGS / PACKAGES (Mocking generic data block based on type) -->
            <div class="<?= $card ?> p-5 lg:p-6 space-y-5">
                <div class="flex items-center justify-between border-b border-emerald-500/20 pb-3">
                    <div class="flex items-center gap-2 text-emerald-400 font-bold text-[10px] uppercase tracking-widest">
                        <?= $svg($ic['leaf'], 'w-4 h-4') ?> <?= ($v['type'] == 'services' ? 'WORK ORDER HISTORY' : 'VERIFIED LISTINGS') ?>
                    </div>
                    <a href="#" class="text-[9px] font-mono text-gray-400 hover:text-emerald-400 transition-colors uppercase tracking-widest">View All <?= ($v['type'] == 'services' ? 'Work Orders' : 'Listings') ?> &rarr;</a>
                </div>
                
                <?php if ($v['type'] == 'services'): ?>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <?php foreach([['Batch 01', 'Land Preparation', '25 HA'], ['Batch 02', 'Land Preparation', '25 HA'], ['Batch 03', 'Drainage & Field Road', '']] as $srv): ?>
                        <div class="border border-emerald-500/30 bg-emerald-950/20 rounded-xl p-4 font-mono">
                            <div class="text-white font-bold text-sm uppercase">KALTARA 8 &bull; <?= $srv[0] ?></div>
                            <div class="text-gray-400 text-xs mt-1"><?= $srv[1] ?><?= $srv[2] ? ' &bull; ' . $srv[2] : '' ?></div>
                            <div class="flex items-center gap-2 mt-4 pt-4 border-t border-emerald-500/20">
                                <span class="rounded bg-white/5 px-2 py-0.5 text-[9px] font-bold text-gray-300 border border-white/10 uppercase">COMPLETED</span>
                                <span class="rounded bg-emerald-500/20 px-2 py-0.5 text-[9px] font-bold text-emerald-400 border border-emerald-500/40 uppercase flex items-center gap-1">VERIFIED</span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="border border-emerald-500/30 bg-emerald-950/20 rounded-xl p-4 lg:p-5 flex flex-col lg:flex-row gap-6">
                        <div class="w-full lg:w-48 h-32 rounded-lg overflow-hidden border border-emerald-500/20 shrink-0">
                            <img src="<?= $basePrefix ?><?= $v['image'] ?>" class="w-full h-full object-cover" />
                        </div>
                        <div class="flex-1 font-mono">
                            <div class="flex items-center gap-3 mb-4 border-b border-emerald-500/20 pb-3">
                                <h3 class="text-xl font-extrabold text-white uppercase tracking-tight"><?= ($v['type'] == 'fertilizer' ? 'NPK 15-15-15' : ($v['type'] == 'equipment' ? 'Excavator 20 Ton' : ($v['type'] == 'seed' ? 'Certified Superior Oil Palm Seedling' : 'Land Preparation Package'))) ?></h3>
                                <span class="rounded bg-emerald-500/20 px-2.5 py-1 text-[9px] font-bold text-emerald-400 border border-emerald-500/40 uppercase tracking-widest flex items-center gap-1.5"><?= $svg($ic['shield'], 'w-3 h-3') ?> VERIFIED</span>
                            </div>
                            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 text-xs">
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Unit</div>
                                    <div class="text-white font-bold text-sm"><?= ($v['type'] == 'fertilizer' ? 'MT' : ($v['type'] == 'equipment' ? 'Machine Unit' : ($v['type'] == 'seed' ? 'Seedling' : 'HA'))) ?></div>
                                </div>
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold"><?= ($v['type'] == 'equipment' ? 'Available Units' : 'MOQ') ?></div>
                                    <div class="text-white font-bold text-sm"><?= ($v['type'] == 'fertilizer' ? '10 MT' : ($v['type'] == 'equipment' ? '8 Units' : ($v['type'] == 'seed' ? '10,000' : '25 HA'))) ?></div>
                                </div>
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Capacity</div>
                                    <div class="text-white font-bold text-sm"><?= ($v['type'] == 'fertilizer' ? '500 MT / Month' : ($v['type'] == 'equipment' ? 'Available' : ($v['type'] == 'seed' ? '150k / Month' : '250 HA / Project'))) ?></div>
                                </div>
                                <div>
                                    <div class="text-[9px] text-gray-500 uppercase tracking-widest mb-1 font-bold">Delivery / Lead Time</div>
                                    <div class="text-white font-bold text-sm"><?= ($v['type'] == 'equipment' ? 'Mobilization 7 Days' : '7 Days') ?></div>
                                </div>
                            </div>
                            <div class="mt-4 pt-3 text-right">
                                <a href="#" class="inline-flex items-center gap-2 rounded-lg border border-emerald-500/40 bg-emerald-950/50 px-4 py-2 text-[10px] font-bold text-emerald-400 uppercase tracking-widest hover:bg-emerald-900 transition-colors">
                                    VIEW SPECIFICATION &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- 4. PROJECT EXPERIENCE (HISTORY) -->
            <div class="<?= $card ?> p-5 lg:p-6 space-y-5">
                <div class="flex items-center justify-between border-b border-emerald-500/20 pb-3">
                    <div class="flex items-center gap-2 text-emerald-400 font-bold text-[10px] uppercase tracking-widest">
                        <?= $svg($ic['shield'], 'w-4 h-4') ?> PROJECT EXPERIENCE
                    </div>
                    <a href="#" class="text-[9px] font-mono text-gray-400 hover:text-emerald-400 transition-colors uppercase tracking-widest">View All Projects &rarr;</a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="border border-emerald-500/20 bg-black/40 p-4 rounded-xl font-mono space-y-3">
                        <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest border-b border-white/5 pb-2">KALTARA 8 &bull; Batch 03</div>
                        <div class="text-white text-xs font-bold uppercase"><?= $v['category'] ?></div>
                        <div class="text-emerald-300 text-lg font-bold mt-1"><?= ($v['type'] == 'fertilizer' ? '125 MT' : ($v['type'] == 'equipment' ? '2 Excavators' : ($v['type'] == 'seed' ? '25,000 Seedlings' : '25 HA'))) ?></div>
                        <div class="flex items-center gap-2 pt-2">
                            <span class="rounded bg-white/5 px-2 py-0.5 text-[9px] font-bold text-gray-300 border border-white/10 uppercase">COMPLETED</span>
                            <span class="rounded bg-emerald-500/20 px-2 py-0.5 text-[9px] font-bold text-emerald-400 border border-emerald-500/40 uppercase flex items-center gap-1">VERIFIED</span>
                        </div>
                    </div>
                    
                    <div class="border border-emerald-500/20 bg-black/40 p-4 rounded-xl font-mono space-y-3">
                        <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest border-b border-white/5 pb-2">KALTARA 8 &bull; Batch 04</div>
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
                    <a href="#" class="text-[9px] font-mono text-gray-400 hover:text-emerald-400 transition-colors uppercase tracking-widest">View All Reviews &rarr;</a>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start font-mono">
                    <div class="lg:col-span-3">
                        <div class="rounded-xl overflow-hidden border border-emerald-500/20 h-32 relative">
                            <img src="<?= $basePrefix ?>/4.jpg" class="w-full h-full object-cover" />
                        </div>
                    </div>
                    
                    <div class="lg:col-span-4 space-y-3">
                        <h4 class="text-lg lg:text-xl font-extrabold text-white uppercase leading-none">KALTARA 8 <span class="text-gray-500">&bull; BATCH 02/03</span></h4>
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

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/dashboard.php';
