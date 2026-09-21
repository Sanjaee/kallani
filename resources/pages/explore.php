<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$constants = $config['system_constants'] ?? [];
$demoDemand = $config['demo_demands'][0] ?? [];
$title = '04 / Explore Projects — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'explore';

/* ---------- Helpers & data ---------- */
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

$demoId    = $demoDemand['id']    ?? 'DR-2026-001';
$demoBuyer = $demoDemand['buyer'] ?? 'DEMO OFFTAKE BUYER';

/* Demo project catalogue.
   img  : photo path inside /public (swap with real project photos)
   pos  : CSS object-position so the same photo crops differently per card
   badge: demo | pipeline | planned | pending      verification: pending | pipeline | verified */
/* Demo project catalogue (NINA Operating System Model) */
$projects = [
    [
        'id' => 1, 
        'name' => 'North Kalimantan Palm Project',   
        'category' => 'Palm Production', 
        'region' => 'North Kalimantan',   
        'network' => 300, 
        'mapped' => 300,
        'batch_count' => 3, 
        'modeled_budget' => '2.640.000 usdt',
        'land_status' => 'GIS Boundary Surveyed',
        'seed_status' => 'Certified High Yield',
        'partner' => 'Verified Land Partner (Mitra Lahan)',   
        'verification' => 82, 
        'verif_label' => 'verified',
        'badge' => 'demo',     
        'availability' => 'Available', 
        'checks' => ['land' => true,  'partner' => true,  'seed' => true,  'gis' => true,  'audit' => false], 
        'img' => '/1.jpg', 
        'pos' => '50% 35%', 
        'lat' => 2.85,  
        'lng' => 116.55
    ],
    [
        'id' => 2, 
        'name' => 'South Kalimantan Palm Cluster',   
        'category' => 'Palm Production', 
        'region' => 'South Kalimantan',   
        'network' => 700, 
        'mapped' => 700, 
        'batch_count' => 7,
        'modeled_budget' => '6.160.000 usdt',
        'land_status' => 'GIS Boundary Verified',
        'seed_status' => 'Certified Seedlings Allocated',
        'partner' => 'Verified Land Partner (Mitra Lahan)', 
        'verification' => 94, 
        'verif_label' => 'verified',
        'badge' => 'pipeline', 
        'availability' => 'Available', 
        'checks' => ['land' => true,  'partner' => true,  'seed' => true,  'gis' => true, 'audit' => true], 
        'img' => '/2.jpg', 
        'pos' => '50% 60%', 
        'lat' => -2.98, 
        'lng' => 115.08
    ],
    [
        'id' => 3, 
        'name' => 'Central Kalimantan Eco Forest', 
        'category' => 'Forestry',      
        'region' => 'Central Kalimantan', 
        'network' => 1200, 
        'mapped' => 1200,   
        'batch_count' => 12,
        'modeled_budget' => '10.560.000 usdt',
        'land_status' => 'Concession Surveyed',
        'seed_status' => 'Native Nursery Certified',
        'partner' => 'State & Community Partner', 
        'verification' => 78, 
        'verif_label' => 'pipeline',
        'badge' => 'planned',  
        'availability' => 'Available', 
        'checks' => ['land' => true,  'partner' => true, 'seed' => false, 'gis' => true, 'audit' => false], 
        'img' => '/3.jpg', 
        'pos' => '80% 40%', 
        'lat' => -1.7,  
        'lng' => 113.4
    ],
    [
        'id' => 4, 
        'name' => 'Mahakam Water Infrastructure', 
        'category' => 'Infrastructure', 
        'region' => 'East Kalimantan', 
        'network' => 500, 
        'mapped' => 500,   
        'batch_count' => 5,
        'modeled_budget' => '4.400.000 usdt',
        'land_status' => 'Hydro Survey Complete',
        'seed_status' => 'N/A — Infrastructure Unit',
        'partner' => 'Regional Vendor Partner', 
        'verification' => 88, 
        'verif_label' => 'verified',
        'badge' => 'demo',  
        'availability' => 'Available', 
        'checks' => ['land' => true,  'partner' => true, 'seed' => true, 'gis' => true, 'audit' => true], 
        'img' => '/5.jpg', 
        'pos' => '50% 50%', 
        'lat' => -0.5,  
        'lng' => 117.15
    ],
    [
        'id' => 5, 
        'name' => 'West Papua Certified Timber Zone', 
        'category' => 'Forestry', 
        'region' => 'West Papua', 
        'network' => 1500, 
        'mapped' => 1500,   
        'batch_count' => 15,
        'modeled_budget' => '13.200.000 usdt',
        'land_status' => 'Forest Cadastre Verified',
        'seed_status' => 'Natural Regeneration Certified',
        'partner' => 'Customary Land Partner', 
        'verification' => 91, 
        'verif_label' => 'verified',
        'badge' => 'pipeline',  
        'availability' => 'Available', 
        'checks' => ['land' => true,  'partner' => true, 'seed' => true, 'gis' => true, 'audit' => true], 
        'img' => '/6.jpg', 
        'pos' => '40% 40%', 
        'lat' => -1.33,  
        'lng' => 133.17
    ],
    [
        'id' => 6, 
        'name' => 'South Sulawesi Agro Park', 
        'category' => 'Agriculture', 
        'region' => 'South Sulawesi', 
        'network' => 800, 
        'mapped' => 800,   
        'batch_count' => 8,
        'modeled_budget' => '7.040.000 usdt',
        'land_status' => 'GIS Cadastre Complete',
        'seed_status' => 'Multi-Crop Certified',
        'partner' => 'Cooperative Land Partner', 
        'verification' => 75, 
        'verif_label' => 'pending',
        'badge' => 'planned',  
        'availability' => 'Available', 
        'checks' => ['land' => true,  'partner' => true, 'seed' => false, 'gis' => false, 'audit' => false], 
        'img' => '/7.jpg', 
        'pos' => '60% 80%', 
        'lat' => -3.6,  
        'lng' => 119.85
    ],
    [
        'id' => 7, 
        'name' => 'Kaltim Offtake Processing Hub', 
        'category' => 'Infrastructure', 
        'region' => 'East Kalimantan', 
        'network' => 200, 
        'mapped' => 200,   
        'batch_count' => 2,
        'modeled_budget' => '1.760.000 usdt',
        'land_status' => 'Port & Terminal Permitted',
        'seed_status' => 'N/A — Offtake Hub',
        'partner' => 'Logistics Vendor Partner', 
        'verification' => 96, 
        'verif_label' => 'verified',
        'badge' => 'demo',  
        'availability' => 'Available', 
        'checks' => ['land' => true,  'partner' => true, 'seed' => true, 'gis' => true, 'audit' => true], 
        'img' => '/8.jpg', 
        'pos' => '30% 30%', 
        'lat' => -1.26,  
        'lng' => 116.83
    ],
];
$projects = array_map(fn($p) => $p + ['location' => $p['region'] . ', Indonesia'], $projects);

$assetTypes = array_values(array_unique(array_column($projects, 'category')));
$regions    = array_values(array_unique(array_column($projects, 'region')));
sort($regions);
$projectUrl = $basePrefix . '/project-overview';

/* Icons: $svg(inner-paths, size-classes) */
$svg = fn(string $inner, string $cls = 'w-5 h-5') =>
    '<svg class="' . $cls . '" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">' . $inner . '</svg>';

$ic = [
    'target'  => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.5"/>',
    'leaf'    => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>',
    'network' => '<circle cx="6" cy="6" r="2"/><circle cx="18" cy="6" r="2"/><circle cx="12" cy="18" r="2"/><path d="M8 6h8M7 8l4 8M17 8l-4 8"/>',
    'shield'  => '<path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/>',
    'pin'     => '<path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="2.5"/>',
    'check'   => '<circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 4.5-5"/>',
    'search'  => '<circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/>',
    'verify'  => '<circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3M8.5 11l2 2 3.5-4"/>',
    'box'     => '<path d="M21 8l-9-5-9 5 9 5 9-5z"/><path d="M3 8v8l9 5 9-5V8M12 13v8"/>',
    'grid'    => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/>',
    'map'     => '<path d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>',
    'active'  => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3.5"/>',
];

$chev  = '<svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>';
$arrow = '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>';

/* Reusable class strings (Tailwind) */
$card      = 'rounded-xl border border-white/10 bg-[#0B1815]/90 shadow-xl';
$iconBox   = 'flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-emerald-100';
$metricLbl = 'text-[9px] font-medium uppercase tracking-wide text-gray-400';
$fieldBox  = 'relative block rounded-lg border border-white/10 bg-[#07110E] px-3 pb-1.5 pt-1.5 focus-within:border-emerald-400/70';
$fieldLbl  = 'block text-[9px] text-gray-400';
$fieldSel  = 'w-full cursor-pointer appearance-none bg-transparent pr-6 text-xs font-medium text-white focus:outline-none';

$footerCols = [
    'Product'  => [['Explore', '/explore'], ['Production', '/demand'], ['Partners', '/vendors'], ['Vendors', '/vendors'], ['Audit', '/audit-trail']],
    'Protocol' => [['How It Works', '/#system-architecture'], ['Verification', '/verification'], ['Documents', '/documents'], ['Audit Trail', '/audit-trail']],
    'Company'  => [['About', '#'], ['Contact', '#']],
];

ob_start();
?>

<style>
    /* Google Maps InfoWindow — dark theme */
    .gm-style .gm-style-iw-c {
        background-color: #0B1815 !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        border-radius: 12px !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5) !important;
        padding: 0 !important;
    }
    .gm-style .gm-style-iw-d { overflow: hidden !important; padding: 12px 14px !important; }
    .gm-style .gm-style-iw-tc::after { background-color: #0B1815 !important; }
    .gm-style .gm-ui-hover-effect { filter: invert(1) !important; top: 2px !important; right: 2px !important; }
</style>

<!-- Page state (declared before the markup so x-data="explorePage()" can find it) -->
<script>
    const BASE_PREFIX  = <?= json_encode($basePrefix) ?>;
    const PROJECT_URL  = <?= json_encode($projectUrl) ?>;
    const EXPLORE_PROJECTS = <?= json_encode($projects, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP) ?>;

    function explorePage() {
        return {
            projects: EXPLORE_PROJECTS,
            basePrefix: BASE_PREFIX,
            projectUrl: PROJECT_URL,
            q: '',
            sort: 'cap-desc',
            view: 'grid',
            page: 1,
            perPage: 4,
            filters: { type: 'All Assets', region: 'All Regions', capacity: 'Any Capacity', status: 'All Status', availability: 'Available' },

            badgeCls: {
                demo:     'border-emerald-300/40 bg-emerald-500/30 text-emerald-100',
                pipeline: 'border-emerald-300/40 bg-teal-400/30 text-emerald-50',
                planned:  'border-sky-300/40 bg-sky-500/40 text-sky-100',
                pending:  'border-white/20 bg-slate-600/50 text-gray-200'
            },
            verifCls: { pending: 'text-amber-400', pipeline: 'text-sky-400', verified: 'text-emerald-400' },
            checkItems: [
                { key: 'land', label: 'Land' }, { key: 'partner', label: 'Partner' },
                { key: 'seed', label: 'Seed' }, { key: 'gis', label: 'GIS' }, { key: 'audit', label: 'Audit' }
            ],

            fmt(n) { return Number(n).toLocaleString('en-US'); },
            pct(p) { return Math.min(100, Math.round((p.mapped / 1000) * 100)); },

            get filtered() {
                const f = this.filters;
                const q = this.q.trim().toLowerCase();
                const minCap = { 'Any Capacity': 0, '1,000+ ha': 1000, '2,000+ ha': 2000, '4,000+ ha': 4000 }[f.capacity] || 0;

                const list = this.projects.filter(p => {
                    if (q && !(p.name + ' ' + p.category + ' ' + p.location + ' ' + p.partner).toLowerCase().includes(q)) return false;
                    if (f.type !== 'All Assets' && p.category !== f.type) return false;
                    if (f.region !== 'All Regions' && p.region !== f.region) return false;
                    if (p.network < minCap) return false;
                    if (f.status !== 'All Status' && p.verification !== f.status.toLowerCase()) return false;
                    if (f.availability !== 'All' && p.availability !== f.availability) return false;
                    return true;
                });

                const sorters = {
                    'cap-desc':    (a, b) => b.network - a.network,
                    'cap-asc':     (a, b) => a.network - b.network,
                    'mapped-desc': (a, b) => b.mapped - a.mapped,
                    'name':        (a, b) => a.name.localeCompare(b.name)
                };
                return list.slice().sort(sorters[this.sort]);
            },
            get totalPages() { return Math.max(1, Math.ceil(this.filtered.length / this.perPage)); },
            get paged() {
                const start = (Math.min(this.page, this.totalPages) - 1) * this.perPage;
                return this.filtered.slice(start, start + this.perPage);
            },
            get mappedCount() { return this.filtered.filter(p => p.mapped > 0).length; },
            get rangeText() {
                const total = this.filtered.length;
                if (!total) return 'Showing 0 of 0';
                const start = (Math.min(this.page, this.totalPages) - 1) * this.perPage + 1;
                return 'Showing ' + start + '–' + (start + this.paged.length - 1) + ' of ' + total;
            },

            setView(v) {
                this.view = v;
                this.$nextTick(() => {
                    if (window.refitNetworkMap) window.refitNetworkMap();
                    if (v === 'map') document.getElementById('production-network').scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
            },
            resetFilters() {
                this.q = '';
                this.sort = 'cap-desc';
                this.filters = { type: 'All Assets', region: 'All Regions', capacity: 'Any Capacity', status: 'All Status', availability: 'Available' };
            },

            init() {
                const syncMap = () => { window.__visibleIds = this.filtered.map(p => p.id); if (window.setVisibleProjects) window.setVisibleProjects(window.__visibleIds); };
                syncMap();
                this.$watch('filtered', syncMap);
                ['q', 'sort', 'filters'].forEach(k => this.$watch(k, () => { this.page = 1; }));
            }
        };
    }
</script>

<div class="relative w-full font-sans" x-data="explorePage()">

    <!-- PAGE BACKGROUND (soft blurred forest) -->
    <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden">
        <img src="<?= $basePrefix ?>/1.jpg" alt="" class="h-full w-full scale-110 object-cover opacity-30 blur-md" />
        <div class="absolute inset-0 bg-gradient-to-b from-[#06120F]/60 via-[#06120F]/85 to-[#04100B]"></div>
    </div>

    <div class="relative z-10">

        <!-- ================= HERO ================= -->
        <section class="relative overflow-hidden shadow-2xl" style="border-bottom: none !important;">
            <img src="<?= $basePrefix ?>/1.jpg" alt="Aerial view of forest and river" class="absolute inset-0 h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#050D07]/85 via-[#050D07]/45 to-[#050D07]/5"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#06120F]/80 via-transparent to-transparent"></div>

            <div class="relative grid min-h-[260px] grid-cols-1 items-start gap-8 px-6 pt-3 pb-6 lg:grid-cols-12 lg:px-8 lg:pt-3 lg:pb-8">

                <!-- Left -->
                <div class="space-y-4 lg:col-span-7">
                    <nav aria-label="Breadcrumb" class="inline-flex flex-wrap items-center gap-2 text-[10px] font-mono font-semibold uppercase tracking-[0.14em] text-gray-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                        <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors">PRODUCTION REQUIREMENTS</a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <a href="<?= $basePrefix ?>/demand" class="hover:text-white transition-colors"><?= $e($demoId) ?></a>
                        <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="font-bold text-white uppercase">EXPLORE PROJECTS</span>
                    </nav>

                    <div class="flex flex-wrap items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-gray-200">
                        <span>04 / Explore Production Projects</span>
                        <span class="rounded-full border border-emerald-300/50 bg-emerald-500/70 px-2.5 py-0.5 text-[9px] font-bold tracking-wider text-white">Mapped to <?= $e($demoId) ?></span>
                    </div>

                    <h1 class="max-w-xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">Explore Production Capacity.</h1>

                    <p class="max-w-md text-sm leading-relaxed text-gray-200">
                        Discover productive assets, production partners and executable capacity connected to the NINA production network.
                    </p>

                    <div class="inline-grid grid-cols-2 divide-x divide-white/15 rounded-xl border border-white/20 bg-black/30 backdrop-blur-md">
                        <div class="px-4 py-3">
                            <div class="text-[9px] uppercase text-gray-400">Requirement</div>
                            <div class="mt-0.5 text-sm font-bold text-white"><?= $e($demoId) ?></div>
                        </div>
                        <div class="px-5 py-3">
                            <div class="text-[9px] uppercase text-gray-400">Required Capacity</div>
                            <div class="mt-0.5 text-sm font-bold text-white">1,000 HA</div>
                        </div>
                    </div>
                </div>

                <!-- Right: active requirement -->
                <div class="lg:col-span-4 lg:col-start-9">
                    <div class="space-y-4 rounded-xl border border-white/15 bg-[#08130F]/75 p-5 shadow-2xl backdrop-blur-xl">
                        <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-wider text-gray-200">
                            <span class="text-emerald-300"><?= $svg($ic['active'], 'w-3.5 h-3.5') ?></span>Active Requirement
                        </div>
                        <div>
                            <div class="text-lg font-bold leading-tight text-white"><?= $e($demoId) ?></div>
                            <div class="mt-0.5 text-[11px] font-semibold uppercase text-gray-300"><?= $e($demoBuyer) ?></div>
                        </div>
                        <div>
                            <div class="text-[10px] text-gray-400">Required Capacity</div>
                            <div class="text-sm font-bold text-white">1,000 HA</div>
                        </div>
                        <div>
                            <div class="text-[10px] text-gray-400">Mapped Capacity</div>
                            <div class="text-sm font-bold text-white">1,000 HA</div>
                            <div class="mt-1.5 flex items-center gap-2">
                                <div class="h-1.5 flex-1 overflow-hidden rounded-full bg-white/10">
                                    <div class="h-full w-full rounded-full bg-gradient-to-r from-emerald-400 to-emerald-200"></div>
                                </div>
                                <span class="text-[9px] font-semibold text-gray-300">100%</span>
                            </div>
                        </div>
                        <a href="<?= $basePrefix ?>/demand" class="inline-flex items-center gap-2 rounded-lg border border-white/30 px-4 py-2 text-[10px] font-semibold uppercase tracking-wider text-white transition hover:bg-white/10">
                            <span>View Requirement</span><?= $arrow ?>
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- ================= CONTENT (with left/right padding) ================= -->
        <div class="space-y-5 px-4 pb-8 pt-5 sm:px-6 lg:px-8">

            <!-- ---------- METRIC CARDS ---------- -->
            <section class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['leaf']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">Production Projects</div>
                        <div class="text-2xl font-extrabold leading-tight text-white"><?= sprintf('%02d', count($projects)) ?></div>
                        <div class="text-[10px] text-gray-400">Network entries</div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['network']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">Active Production Capacity</div>
                        <div class="flex items-center gap-2">
                            <span class="text-2xl font-extrabold leading-tight text-white">4,000 HA</span>
                            <span class="rounded border border-emerald-400/40 bg-emerald-950/70 px-1.5 py-0.5 text-[9px] font-bold text-emerald-300">DEMO</span>
                        </div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['shield']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">Mapped to Requirement</div>
                        <div class="text-2xl font-extrabold leading-tight text-white">1,000 HA</div>
                        <div class="text-[10px] text-gray-400">For <?= $e($demoId) ?></div>
                    </div>
                </div>

                <div class="<?= $card ?> flex items-center gap-3 px-4 py-3.5">
                    <span class="<?= $iconBox ?>"><?= $svg($ic['target']) ?></span>
                    <div>
                        <div class="<?= $metricLbl ?>">Production Batch Size</div>
                        <div class="text-2xl font-extrabold leading-tight text-white">100 HA</div>
                        <div class="text-[10px] text-gray-400">Standard prototype unit</div>
                    </div>
                </div>

            </section>

            <!-- ---------- SEARCH + FILTERS ---------- -->
            <section class="<?= $card ?> space-y-3 p-4">

                <div class="flex flex-col gap-3 md:flex-row md:items-center">
                    <label class="relative block flex-1">
                        <span class="sr-only">Search projects</span>
                        <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><?= $svg($ic['search'], 'w-4 h-4') ?></span>
                        <input type="search" x-model.debounce.200ms="q" placeholder="Search project, region, partner..."
                               class="w-full rounded-lg border border-white/10 bg-[#07110E] py-2.5 pl-9 pr-3 text-xs text-white placeholder-gray-500 focus:border-emerald-400/70 focus:outline-none" />
                    </label>

                    <div class="flex items-center gap-2">
                        <label for="sort-select" class="text-[11px] text-gray-400">Sort by</label>
                        <div class="relative w-52">
                            <select id="sort-select" x-model="sort" style="color-scheme: dark"
                                    class="w-full cursor-pointer appearance-none rounded-lg border border-white/10 bg-[#07110E] px-3 py-2.5 pr-9 text-xs font-medium text-white focus:border-emerald-400/70 focus:outline-none">
                                <option value="cap-desc">Capacity - High to Low</option>
                                <option value="cap-asc">Capacity - Low to High</option>
                                <option value="mapped-desc">Mapped - High to Low</option>
                                <option value="name">Name A-Z</option>
                            </select><?= $chev ?>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="button" @click="setView('grid')"
                                :class="view === 'grid' ? 'border-emerald-300/60 bg-emerald-300/90 font-bold text-[#04100B]' : 'border-white/10 bg-[#07110E] font-medium text-gray-300 hover:text-white'"
                                class="inline-flex items-center gap-2 rounded-lg border px-4 py-2.5 text-[11px] transition"><?= $svg($ic['grid'], 'w-3.5 h-3.5') ?>Grid</button>
                        <button type="button" @click="setView('map')"
                                :class="view === 'map' ? 'border-emerald-300/60 bg-emerald-300/90 font-bold text-[#04100B]' : 'border-white/10 bg-[#07110E] font-medium text-gray-300 hover:text-white'"
                                class="inline-flex items-center gap-2 rounded-lg border px-4 py-2.5 text-[11px] transition"><?= $svg($ic['map'], 'w-3.5 h-3.5') ?>Map</button>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 md:grid-cols-5">
                    <label class="<?= $fieldBox ?>">
                        <span class="<?= $fieldLbl ?>">Asset Type</span>
                        <select x-model="filters.type" style="color-scheme: dark" class="<?= $fieldSel ?>">
                            <option>All Assets</option>
                            <?php foreach ($assetTypes as $t): ?><option><?= $e($t) ?></option><?php endforeach; ?>
                        </select><?= $chev ?>
                    </label>
                    <label class="<?= $fieldBox ?>">
                        <span class="<?= $fieldLbl ?>">Region</span>
                        <select x-model="filters.region" style="color-scheme: dark" class="<?= $fieldSel ?>">
                            <option>All Regions</option>
                            <?php foreach ($regions as $r): ?><option><?= $e($r) ?></option><?php endforeach; ?>
                        </select><?= $chev ?>
                    </label>
                    <label class="<?= $fieldBox ?>">
                        <span class="<?= $fieldLbl ?>">Capacity</span>
                        <select x-model="filters.capacity" style="color-scheme: dark" class="<?= $fieldSel ?>">
                            <option>Any Capacity</option>
                            <option>1,000+ ha</option>
                            <option>2,000+ ha</option>
                            <option>4,000+ ha</option>
                        </select><?= $chev ?>
                    </label>
                    <label class="<?= $fieldBox ?>">
                        <span class="<?= $fieldLbl ?>">Verification</span>
                        <select x-model="filters.status" style="color-scheme: dark" class="<?= $fieldSel ?>">
                            <option>All Status</option>
                            <option>Verified</option>
                            <option>Pending</option>
                            <option>Pipeline</option>
                        </select><?= $chev ?>
                    </label>
                    <label class="<?= $fieldBox ?>">
                        <span class="<?= $fieldLbl ?>">Availability</span>
                        <select x-model="filters.availability" style="color-scheme: dark" class="<?= $fieldSel ?>">
                            <option>Available</option>
                            <option>Reserved</option>
                            <option>All</option>
                        </select><?= $chev ?>
                    </label>
                </div>
            </section>

            <!-- ---------- PRODUCTION NETWORK MAP + MAPPED TO REQUIREMENT ---------- -->
            <section id="production-network" class="grid grid-cols-1 items-stretch gap-4 lg:grid-cols-12">

                <!-- Map card -->
                <div class="<?= $card ?> flex flex-col overflow-hidden sm:flex-row lg:col-span-8">
                    <div class="flex min-w-0 flex-1 flex-col">
                        <div class="px-5 pb-2 pt-4">
                            <h2 class="text-base font-bold text-white">Production Network</h2>
                            <p class="text-[11px] text-gray-400">Mapped projects and capacity distribution across Indonesia.</p>
                        </div>
                        <div class="relative flex-1 bg-[#040E0A] transition-[min-height]"
                             :class="view === 'map' ? 'min-h-[560px]' : 'min-h-[320px]'">
                            <div id="network-map" class="absolute inset-0"></div>
                        </div>
                    </div>

                    <!-- Legend -->
                    <div class="border-t border-white/10 p-4 sm:w-44 sm:shrink-0 sm:border-l sm:border-t-0">
                        <ul class="grid grid-cols-2 gap-x-4 gap-y-3 text-[11px] text-gray-200 sm:grid-cols-1">
                            <li class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-400"></span>Active Production</li>
                            <li class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-teal-300"></span>Mapped Capacity</li>
                            <li class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-sky-400"></span>Pipeline</li>
                            <li class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-orange-400"></span>Pending Verification</li>
                            <li class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-yellow-300"></span>Demo</li>
                        </ul>
                    </div>
                </div>

                <!-- Mapped to requirement -->
                <aside class="<?= $card ?> flex flex-col p-5 lg:col-span-4">
                    <div class="text-sm font-bold text-white">Mapped to Requirement</div>

                    <div class="mt-3">
                        <div class="flex items-baseline justify-between">
                            <span class="text-sm font-bold text-white"><?= $e($demoId) ?></span>
                            <span class="text-[10px] text-gray-400">Required 1,000 HA</span>
                        </div>
                        <div class="mt-0.5 text-lg font-extrabold text-white">1,000 HA <span class="text-[10px] font-normal text-gray-400">mapped</span></div>
                    </div>

                    <div class="mt-5 text-[9px] font-semibold uppercase tracking-wider text-gray-400">Capacity Breakdown</div>
                    <dl class="mt-3 space-y-3 text-[11px]">
                        <div class="grid grid-cols-[1fr_auto_2.5rem] items-center gap-3">
                            <dt class="flex items-center gap-2 text-white"><span class="h-2 w-2 rounded-full bg-emerald-400"></span>North Kalimantan</dt>
                            <dd class="text-right font-bold text-white">200 HA</dd>
                            <dd class="text-right text-gray-400">20%</dd>
                        </div>
                        <div class="grid grid-cols-[1fr_auto_2.5rem] items-center gap-3">
                            <dt class="flex items-center gap-2 text-white"><span class="h-2 w-2 rounded-full bg-sky-400"></span>South Kalimantan</dt>
                            <dd class="text-right font-bold text-white">800 HA</dd>
                            <dd class="text-right text-gray-400">80%</dd>
                        </div>
                        <div class="grid grid-cols-[1fr_auto_2.5rem] items-center gap-3 border-t border-white/15 pt-3 font-bold text-white">
                            <dt>Total</dt>
                            <dd class="text-right">1,000 HA</dd>
                            <dd class="text-right text-gray-300">100%</dd>
                        </div>
                    </dl>

                    <div class="mt-auto pt-6">
                        <div class="mb-2 text-[9px] font-semibold uppercase tracking-wider text-gray-400">Map View</div>
                        <a href="<?= $basePrefix ?>/capacity-mapping" class="inline-flex items-center gap-2 rounded-lg border border-white/30 px-4 py-2 text-[10px] font-semibold uppercase tracking-wider text-white transition hover:bg-white/10">
                            <span>View Full Map</span><?= $arrow ?>
                        </a>
                    </div>
                </aside>
            </section>

            <!-- ---------- PRODUCTION PROJECTS ---------- -->
            <section x-show="view === 'grid'" class="<?= $card ?> p-5 sm:p-6">

                <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <h2 class="text-base font-bold text-white">Production Projects</h2>
                        <p class="mt-0.5 text-[11px] text-gray-400">
                            <span x-text="filtered.length"><?= count($projects) ?></span> projects found.
                            <span x-text="mappedCount">2</span> mapped to your current requirement.
                        </p>
                    </div>
                    <div class="flex items-center gap-3 text-[11px] text-gray-300">
                        <span x-text="rangeText">Showing 1–4 of <?= count($projects) ?></span>
                        <div class="flex items-center gap-1.5">
                            <button type="button" @click="page = Math.max(1, page - 1)" :disabled="page <= 1" aria-label="Previous page"
                                    class="flex h-7 w-7 items-center justify-center rounded-full border border-white/15 text-gray-200 transition hover:bg-white/10 disabled:cursor-not-allowed disabled:opacity-35 disabled:hover:bg-transparent">&lsaquo;</button>
                            <button type="button" @click="page = Math.min(totalPages, page + 1)" :disabled="page >= totalPages" aria-label="Next page"
                                    class="flex h-7 w-7 items-center justify-center rounded-full border border-white/15 text-gray-200 transition hover:bg-white/10 disabled:cursor-not-allowed disabled:opacity-35 disabled:hover:bg-transparent">&rsaquo;</button>
                        </div>
                    </div>
                </div>

                <!-- Project cards -->
                <div class="mt-5 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                    <template x-for="p in paged" :key="p.id">
                        <article class="flex flex-col overflow-hidden rounded-xl border border-white/10 bg-[#0B1815] transition hover:border-emerald-400/30">

                            <div class="relative h-28 overflow-hidden">
                                <img :src="basePrefix + p.img" :alt="p.name" :style="'object-position:' + p.pos" loading="lazy" class="h-full w-full object-cover" />
                                <div class="absolute inset-0 bg-gradient-to-t from-[#0B1815]/50 to-transparent"></div>
                                <span class="absolute right-2 top-2 rounded border px-2 py-0.5 text-[8px] font-bold uppercase tracking-wider backdrop-blur-sm"
                                      :class="badgeCls[p.badge]" x-text="p.badge"></span>
                            </div>

                            <div class="flex flex-1 flex-col gap-3 p-4">
                                <div class="space-y-1">
                                    <h3 class="text-sm font-bold leading-snug text-white" x-text="p.name"></h3>
                                    <div class="flex items-center gap-1.5 text-[10px] text-gray-300">
                                        <span class="text-emerald-300"><?= $svg($ic['leaf'], 'w-3 h-3') ?></span><span x-text="p.category"></span>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-[10px] text-gray-400">
                                        <span><?= $svg($ic['pin'], 'w-3 h-3') ?></span><span x-text="p.location"></span>
                                    </div>
                                </div>

                                <dl class="space-y-1.5 text-[10px]">
                                    <div class="flex items-center justify-between gap-2"><dt class="text-gray-400">Mapped Capacity</dt><dd class="font-bold text-white" x-text="fmt(p.mapped) + ' HA'"></dd></div>
                                    <div class="flex items-center justify-between gap-2"><dt class="text-gray-400">Batch Structure</dt><dd class="font-bold text-emerald-300" x-text="p.batch_count + ' × 100 HA Batches'"></dd></div>
                                    <div class="flex items-center justify-between gap-2"><dt class="text-gray-400">Modeled Requirement</dt><dd class="font-bold text-white" x-text="p.modeled_budget"></dd></div>
                                </dl>

                                <div class="border-t border-white/10 pt-2.5 space-y-1 text-[10px]">
                                    <div class="flex justify-between items-center"><span class="text-gray-400">Partner</span><span class="font-bold text-white truncate max-w-[140px]" x-text="p.partner"></span></div>
                                    <div class="flex justify-between items-center"><span class="text-gray-400">Land Status</span><span class="text-emerald-300 font-medium truncate max-w-[140px]" x-text="p.land_status"></span></div>
                                    <div class="flex justify-between items-center"><span class="text-gray-400">Seed Status</span><span class="text-gray-300 font-medium truncate max-w-[140px]" x-text="p.seed_status"></span></div>
                                </div>

                                <div class="space-y-1.5">
                                    <div class="flex items-center justify-between text-[10px]">
                                        <span class="text-gray-400">Verification Score</span>
                                        <span class="text-[10px] font-bold text-emerald-300" x-text="p.verification + '% GIS Verified'"></span>
                                    </div>
                                    <div class="h-1.5 overflow-hidden rounded-full bg-white/10">
                                        <div class="h-full rounded-full bg-gradient-to-r from-emerald-400 to-emerald-200" :style="'width:' + p.verification + '%'"></div>
                                    </div>
                                </div>

                                <div class="flex flex-wrap gap-x-3 gap-y-1">
                                    <template x-for="c in checkItems" :key="c.key">
                                        <span class="flex items-center gap-1 text-[9px]" :class="p.checks[c.key] ? 'text-gray-200' : 'text-gray-500'"
                                              :title="c.label + (p.checks[c.key] ? ' verified' : ' pending')">
                                            <span :class="p.checks[c.key] ? 'text-emerald-400' : 'text-gray-600'"><?= $svg($ic['check'], 'w-3.5 h-3.5') ?></span>
                                            <span x-text="c.label"></span>
                                        </span>
                                    </template>
                                </div>

                                <a :href="projectUrl + '?id=' + p.id"
                                   class="mt-auto inline-flex w-fit items-center gap-1.5 rounded-lg border border-emerald-400/40 bg-emerald-500/10 hover:bg-emerald-500/20 px-3.5 py-1.5 text-[10px] font-semibold uppercase tracking-wider text-emerald-300 transition">
                                    <span>View Production Project</span><?= $arrow ?>
                                </a>
                            </div>
                        </article>
                    </template>
                </div>

                <!-- Empty state -->
                <div x-show="filtered.length === 0" style="display:none" class="mt-5 rounded-xl border border-dashed border-white/15 px-6 py-10 text-center">
                    <div class="text-sm font-bold text-white">No projects match these filters</div>
                    <p class="mt-1 text-[11px] text-gray-400">Try a different region, capacity or verification status.</p>
                    <button type="button" @click="resetFilters()" class="mt-4 rounded-full border border-emerald-300/60 px-5 py-2 text-[10px] font-semibold uppercase tracking-wider text-white transition hover:bg-emerald-400/10">Reset filters</button>
                </div>
            </section>

            <!-- ---------- FROM REQUIREMENT TO PRODUCTION PROJECT ---------- -->
            <section class="<?= $card ?> overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-12">

                    <div class="relative h-40 lg:col-span-3 lg:h-auto lg:min-h-[170px]">
                        <img src="<?= $basePrefix ?>/2.jpg" alt="Production landscape" class="absolute inset-0 h-full w-full object-cover" />
                        <div class="absolute inset-0 bg-black/10"></div>
                    </div>

                    <div class="p-5 lg:col-span-9">
                        <h2 class="text-base font-bold text-white">From Requirement to Production Project.</h2>
                        <p class="mt-0.5 text-[11px] text-gray-400">NINA matches your demand with verified capacity, partners and executable batches.</p>

                        <div class="mt-4 grid grid-cols-1 items-stretch gap-3 md:grid-cols-[1fr_1fr_1fr_auto]">
                            <div class="flex items-start gap-3 rounded-lg border border-white/10 bg-[#07110E] p-3">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-white/20 text-emerald-100"><?= $svg($ic['shield'], 'w-4 h-4') ?></span>
                                <div class="leading-snug">
                                    <div class="text-[10px] font-bold text-white">01</div>
                                    <div class="text-[9px] font-semibold uppercase text-gray-300">Capacity</div>
                                    <div class="mt-0.5 text-[10px] text-gray-400">Identify available productive capacity.</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 rounded-lg border border-white/10 bg-[#07110E] p-3">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-white/20 text-emerald-100"><?= $svg($ic['verify'], 'w-4 h-4') ?></span>
                                <div class="leading-snug">
                                    <div class="text-[10px] font-bold text-white">02</div>
                                    <div class="text-[9px] font-semibold uppercase text-gray-300">Verification</div>
                                    <div class="mt-0.5 text-[10px] text-gray-400">Check land, partner, production and documentation status.</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 rounded-lg border border-white/10 bg-[#07110E] p-3">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-white/20 text-emerald-100"><?= $svg($ic['box'], 'w-4 h-4') ?></span>
                                <div class="leading-snug">
                                    <div class="text-[10px] font-bold text-white">03</div>
                                    <div class="text-[9px] font-semibold uppercase text-gray-300">Batch</div>
                                    <div class="mt-0.5 text-[10px] text-gray-400">Convert suitable capacity into executable production units.</div>
                                </div>
                            </div>
                            <div class="flex items-center md:pl-2">
                                <a href="<?= $basePrefix ?>/capacity-mapping" class="inline-flex items-center gap-2 whitespace-nowrap rounded-full border border-emerald-300/60 px-5 py-2.5 text-[10px] font-semibold uppercase tracking-wider text-white transition hover:bg-emerald-400/10">
                                    <span>View Capacity Details</span><?= $arrow ?>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

        </div>

        <!-- ================= FOOTER ================= -->
        <footer class="border-t border-white/10 bg-[#040C09]/95">
            <div class="grid grid-cols-1 gap-8 px-6 py-8 lg:grid-cols-12 lg:px-8">

                <div class="flex flex-col group text-left lg:col-span-4 space-y-1">
                    <span class="text-xl sm:text-2xl font-serif font-extrabold tracking-[0.25em] text-white uppercase leading-none">KALLANI</span>
                    <span class="text-[9px] font-mono tracking-[0.18em] text-white uppercase leading-none">NINA / OPERATING SYSTEM</span>
                    <p class="pt-1.5 max-w-[240px] text-[10px] leading-snug text-gray-400">Operating System for Productive Natural Assets</p>
                </div>

                <nav class="grid grid-cols-3 gap-6 lg:col-span-5" aria-label="Footer">
                    <?php foreach ($footerCols as $heading => $links): ?>
                        <div>
                            <div class="text-[9px] font-bold uppercase tracking-wider text-gray-400"><?= $e($heading) ?></div>
                            <ul class="mt-3 space-y-2">
                                <?php foreach ($links as [$label, $href]): ?>
                                    <li><a href="<?= $href === '#' ? '#' : $basePrefix . $href ?>" class="text-[11px] text-gray-300 transition hover:text-white"><?= $e($label) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </nav>

                <div class="space-y-2 lg:col-span-3 lg:border-l lg:border-white/10 lg:pl-8">
                    <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-wider text-gray-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>System Status
                    </div>
                    <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-wider text-white">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>Demo / Simulated Environment
                    </div>
                    <p class="text-[10px] leading-snug text-gray-400">This prototype contains simulated data for demonstration purposes.</p>
                </div>

            </div>
        </footer>

    </div>
</div>

<!-- ================= GOOGLE MAPS (Production Network) ================= -->
<script>
    let networkMap = null;
    let networkInfo = null;
    const networkMarkers = {};

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

    // Sumatra → Sulawesi (Java and Kalimantan in between)
    const NETWORK_BOUNDS = { south: -9.5, west: 95, north: 6.5, east: 125.5 };

    function fitNetwork() {
        if (networkMap) networkMap.fitBounds(NETWORK_BOUNDS, 16);
    }

    window.refitNetworkMap = function () {
        if (!networkMap) return;
        setTimeout(() => { google.maps.event.trigger(networkMap, 'resize'); fitNetwork(); }, 60);
    };

    // Called from Alpine whenever the filtered list changes
    window.setVisibleProjects = function (ids) {
        window.__visibleIds = ids;
        Object.keys(networkMarkers).forEach(id => networkMarkers[id].setVisible(ids.includes(Number(id))));
    };

    function initNetworkMap() {
        const mapEl = document.getElementById('network-map');

        networkMap = new google.maps.Map(mapEl, {
            center: { lat: -2, lng: 112 },
            zoom: 4,
            minZoom: 3,
            maxZoom: 9,
            styles: NETWORK_STYLE,
            backgroundColor: '#040E0A',
            disableDefaultUI: true,
            zoomControl: true,
            gestureHandling: 'cooperative',
            clickableIcons: false
        });
        fitNetwork();

        let resizeTimer;
        window.addEventListener('resize', () => { clearTimeout(resizeTimer); resizeTimer = setTimeout(fitNetwork, 200); });

        networkInfo = new google.maps.InfoWindow({ maxWidth: 240, pixelOffset: new google.maps.Size(0, -14) });
        networkMap.addListener('click', () => networkInfo.close());

        /* ----- HTML overlay marker (no default red pins) ----- */
        class HtmlMarker extends google.maps.OverlayView {
            constructor(position, map, html, opts = {}) {
                super();
                this.position = new google.maps.LatLng(position);
                this.html = html;
                this.transform = opts.transform || 'translate(-50%, -50%)';
                this.onClick = opts.onClick || null;
                this.visible = true;
                this.div = null;
                this.setMap(map);
            }
            setVisible(v) {
                this.visible = v;
                if (this.div) this.div.style.display = v ? '' : 'none';
            }
            onAdd() {
                const div = document.createElement('div');
                div.style.position = 'absolute';
                div.style.transform = this.transform;
                div.style.whiteSpace = 'nowrap';
                div.style.display = this.visible ? '' : 'none';
                div.style.fontFamily = getComputedStyle(document.body).fontFamily;
                div.innerHTML = this.html;
                if (this.onClick) {
                    div.style.cursor = 'pointer';
                    div.addEventListener('click', (ev) => { ev.stopPropagation(); this.onClick(ev); });
                }
                this.div = div;
                this.getPanes().overlayMouseTarget.appendChild(div);
            }
            draw() {
                const proj = this.getProjection();
                if (!proj || !this.div) return;
                const p = proj.fromLatLngToDivPixel(this.position);
                if (p) { this.div.style.left = p.x + 'px'; this.div.style.top = p.y + 'px'; }
            }
            onRemove() {
                if (this.div && this.div.parentNode) this.div.parentNode.removeChild(this.div);
                this.div = null;
            }
        }

        const pinSvg = '<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="2.5"/></svg>';

        // Full class strings so Tailwind can detect them
        const ringCls = {
            demo:     'border-emerald-400 text-emerald-300',
            pipeline: 'border-sky-400 text-sky-300',
            planned:  'border-sky-400 text-sky-300',
            pending:  'border-orange-400 text-orange-300'
        };
        const dotCls = {
            demo:     'bg-emerald-400',
            pipeline: 'bg-sky-400',
            planned:  'bg-sky-400',
            pending:  'bg-orange-400'
        };

        const fmt = (n) => Number(n).toLocaleString('en-US');

        const labelHtml = (p) => `
            <div class="flex select-none items-center gap-2 transition-transform hover:scale-105">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border-2 bg-[#06120F] shadow-lg ${ringCls[p.badge]}">${pinSvg}</div>
                <div class="rounded-lg border border-white/20 bg-[#06120F]/95 px-3 py-1.5 shadow-2xl">
                    <div class="text-[8px] font-bold uppercase tracking-wider text-gray-300">${p.region}</div>
                    <div class="text-xs font-extrabold leading-tight text-white">${fmt(p.mapped)} HA</div>
                    <div class="text-[9px] text-gray-400">${(p.mapped / 100).toFixed(1)} batch equivalent</div>
                </div>
            </div>`;

        const dotHtml = (p) => `
            <span title="${p.name}" class="block h-3 w-3 rounded-full border-2 border-white/80 shadow-lg ${dotCls[p.badge]}"></span>`;

        const infoHtml = (p) => `
            <div style="font-family: inherit; max-width: 210px; color: #fff;">
                <div style="margin: 0 0 2px; font-size: 12px; font-weight: 800;">${p.name}</div>
                <div style="margin: 0 0 8px; font-size: 10px; color: #9CA3AF;">${p.location}</div>
                <p style="margin: 0 0 10px; font-size: 11px; line-height: 1.45; color: #D1D5DB;">
                    Network capacity: <strong style="color:#fff">${fmt(p.network)} HA</strong><br>
                    Mapped to requirement: <strong style="color:#fff">${fmt(p.mapped)} HA</strong>
                </p>
                <a href="${PROJECT_URL}?id=${p.id}" style="display:block; text-align:center; background:#6EE7B7; color:#04100B; padding:6px 12px; border-radius:999px; font-size:10px; font-weight:800; letter-spacing:.06em; text-transform:uppercase; text-decoration:none;">View Project</a>
            </div>`;

        EXPLORE_PROJECTS.forEach((p) => {
            const pos = { lat: p.lat, lng: p.lng };
            const mapped = p.mapped > 0;
            networkMarkers[p.id] = new HtmlMarker(
                pos, networkMap,
                mapped ? labelHtml(p) : dotHtml(p),
                {
                    // Labelled pins: the circle sits exactly on the coordinate, the label extends to the right
                    transform: mapped ? 'translate(-18px, -50%)' : 'translate(-50%, -50%)',
                    onClick: () => { networkInfo.setContent(infoHtml(p)); networkInfo.setPosition(pos); networkInfo.open({ map: networkMap }); }
                }
            );
        });

        if (window.__visibleIds) window.setVisibleProjects(window.__visibleIds);
    }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeyP_0nYynBU5ImC0AWBzGxkiXep-Z0K4&callback=initNetworkMap"></script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';