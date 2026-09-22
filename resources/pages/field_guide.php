<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$title = '22 / Field Guide — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'field-guide';

/* ---------- Helpers & Styles ---------- */
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
$card      = 'rounded-2xl border border-white/10 bg-[#0A1612]/90 backdrop-blur-md shadow-xl';
$subCard   = 'rounded-xl border border-white/5 bg-white/[0.03] p-4';
$metricLbl = 'text-[9px] font-mono font-medium uppercase tracking-wider text-gray-400';

ob_start();
?>

<div class="relative w-full font-sans text-gray-200" x-data="{
    searchQuery: '',
    selectedCategory: 'palm',
    activeTermKey: 'oer',
    expandedCategory: true,
    
    terms: {
        'oer': {
            term: 'OER',
            fullName: 'Oil Extraction Rate',
            category: 'palm',
            categoryName: 'Palm & Agriculture',
            simple: 'The percentage of crude palm oil extracted from fresh fruit bunches (TBS / FFB) during mill processing.',
            whyItMatters: 'Helps NINA model how much CPO can theoretically be produced from a given volume of TBS. Actual figures depend on fruit quality, mill efficiency, and plantation conditions.',
            example: '1,800 T TBS × 22% = 396 T CPO (based on model)',
            ninaUse: 'Production Output / Modeling',
            warning: '22% is a model assumption, not a guaranteed production output.',
            related: ['TBS', 'CPO', 'Yield', 'Processing', 'Mill'],
            image: '<?= $basePrefix ?>/1.jpg',
            whereAppears: [
                { title: 'Production Output / #15', url: '<?= $basePrefix ?>/commercial-output' },
                { title: 'Demand & Offtake Control / #20', url: '<?= $basePrefix ?>/demand' }
            ]
        },
        'cpo': {
            term: 'CPO',
            fullName: 'Crude Palm Oil',
            category: 'palm',
            categoryName: 'Palm & Agriculture',
            simple: 'Raw unrefined vegetable oil extracted from the mesocarp of oil palm fresh fruit bunches.',
            whyItMatters: 'The primary liquid commodity traded and settled on commercial delivery contracts with buyers.',
            example: '396 Tonnes CPO / Year (≈445,945 Liters) produced from 100 HA standard batch.',
            ninaUse: 'Commercial Output, Delivery & Settlement Engine',
            warning: 'CPO is raw industrial feedstock. It must undergo refining and fractionation to produce cooking oil.',
            related: ['TBS', 'OER', 'RBD Palm Olein', 'Mill'],
            image: '<?= $basePrefix ?>/2.jpg',
            whereAppears: [
                { title: 'Commercial Output / #15', url: '<?= $basePrefix ?>/commercial-output' },
                { title: 'Demand First / #02', url: '<?= $basePrefix ?>/demand' }
            ]
        },
        'tbs': {
            term: 'TBS',
            fullName: 'Fresh Fruit Bunches (FFB)',
            category: 'palm',
            categoryName: 'Palm & Agriculture',
            simple: 'The harvested fruit clusters freshly cut from the oil palm tree before mill crushing.',
            whyItMatters: 'The physical origin metric connecting agronomic field harvest with commercial oil mill yield.',
            example: 'Harvested TBS → Certified Weighbridge → Quality Acceptance → Processing Mill.',
            ninaUse: 'Harvest & Weighing Log Verification',
            warning: 'TBS must be transported and processed within 24 hours to prevent free fatty acid (FFA) degradation.',
            related: ['CPO', 'OER', 'TBS Yield', 'Harvest'],
            image: '<?= $basePrefix ?>/3.jpg',
            whereAppears: [
                { title: 'Harvest & Commercial Delivery', url: '<?= $basePrefix ?>/commercial-output' }
            ]
        },
        'tbs_yield': {
            term: 'TBS Yield',
            fullName: 'Fresh Fruit Bunch Productivity',
            category: 'palm',
            categoryName: 'Palm & Agriculture',
            simple: 'The weight of fruit bunches produced per hectare of plantation land over a one-year cycle.',
            whyItMatters: 'Key baseline benchmark used to model production capacity and financial feasibility.',
            example: '18.00 T / HA / Year modeled benchmark for mature plantation trees.',
            ninaUse: 'Batch Feasibility & Output Projections',
            warning: '18.00 T/HA/YR is a model benchmark input, not a guaranteed yield claim.',
            related: ['Planting Density', 'TBS', 'OER', 'Certified Superior Seed'],
            image: '<?= $basePrefix ?>/4.jpg',
            whereAppears: [
                { title: 'Production Batches', url: '<?= $basePrefix ?>/batches' },
                { title: 'Commercial Output / #15', url: '<?= $basePrefix ?>/commercial-output' }
            ]
        },
        'planting_density': {
            term: 'Planting Density',
            fullName: 'Tree Population Density',
            category: 'palm',
            categoryName: 'Palm & Agriculture',
            simple: 'The standardized count of oil palm trees planted per single hectare.',
            whyItMatters: 'Ensures optimal photosynthetic sunlight absorption and triangular root space distribution.',
            example: '143 trees / HA on a 9m × 9m equilateral triangular layout (14,300 trees per 100 HA batch).',
            ninaUse: 'GIS Mapping & Seedling Order Calculation',
            warning: 'Exceeding 143-148 trees/HA leads to etiolation and diminished fruit bunch weight.',
            related: ['Certified Superior Seed', 'TBS Yield', 'Agronomic Protocol'],
            image: '<?= $basePrefix ?>/5.jpg',
            whereAppears: [
                { title: 'Capacity Mapping', url: '<?= $basePrefix ?>/capacity' }
            ]
        },
        'superior_seed': {
            term: 'Certified Superior Seed',
            fullName: 'Certified High-Yield Seedling',
            category: 'palm',
            categoryName: 'Palm & Agriculture',
            simple: 'Oil palm germinated sprouts and seedlings sourced exclusively from government-certified breeding centers.',
            whyItMatters: 'Guarantees genetic high-yield potential (OER >22%) and prevents sterile non-productive planting.',
            example: 'Certified DxP seedlings from recognized breeding institutions with phytosanitary certificates.',
            ninaUse: 'Verification Vault / Seed Verification Gate',
            warning: 'Plasma ≠ Seed! Plasma is a smallholder partnership structure. Seed is the planting material.',
            related: ['Inti-Plasma', 'Planting Density', 'Verification'],
            image: '<?= $basePrefix ?>/6.jpg',
            whereAppears: [
                { title: 'Verification Vault', url: '<?= $basePrefix ?>/verification' }
            ]
        },
        'inti_plasma': {
            term: 'Inti–Plasma',
            fullName: 'Nucleus-Smallholder Partnership Scheme',
            category: 'palm',
            categoryName: 'Palm & Agriculture',
            simple: 'Legal partnership structure linking a plantation operating enterprise (Inti) with local community farmer cooperatives (Plasma).',
            whyItMatters: 'Ensures local agrarian empowerment and compliance with Indonesian statutory plantation partnership regulations.',
            example: '20% community partnership land facilitation mapped to regional cooperative clusters.',
            ninaUse: 'Partner Governance & Community Inclusion',
            warning: 'Inti-Plasma is an organizational partnership relationship, never a seed variety!',
            related: ['Production Partner', 'Vendor', 'Work Order'],
            image: '<?= $basePrefix ?>/7.jpg',
            whereAppears: [
                { title: 'Partner Network', url: '<?= $basePrefix ?>/partners' }
            ]
        },
        'agronomic_protocol': {
            term: 'Agronomic Protocol',
            fullName: 'Standardized Plantation Protocol',
            category: 'palm',
            categoryName: 'Palm & Agriculture',
            simple: 'Rigorous operating procedures governing planting, fertilizing, weeding, pest control, and harvesting.',
            whyItMatters: 'Maintains field quality consistency across dispersed regional partner clusters.',
            example: 'Standardized NPK application schedule, circle weeding, and ripe bunch harvesting criteria.',
            ninaUse: 'Work Order Specifications & Evidence Validation',
            warning: 'Failure to comply with agronomic protocols halts milestone verification approval.',
            related: ['Work Order', 'Field Evidence', 'Harvest'],
            image: '<?= $basePrefix ?>/1.jpg',
            whereAppears: [
                { title: 'Milestones Execution', url: '<?= $basePrefix ?>/milestones' }
            ]
        },
        'harvest': {
            term: 'Harvest',
            fullName: 'Physical Crop Harvesting',
            category: 'palm',
            categoryName: 'Palm & Agriculture',
            simple: 'The field operation of identifying ripe fruit bunches and harvesting them for weighing and transport.',
            whyItMatters: 'Marks the transition from operational capital expenditure (development) to commercial cash flow.',
            example: 'Daily harvest logs mapped to specific block polygons with harvester weigh slips.',
            ninaUse: 'Harvest Registry & Commercial Delivery Trigger',
            warning: 'Harvesting unripe bunches severely reduces extraction rate and incurs mill penalties.',
            related: ['TBS', 'Weighing', 'Mill', 'Settlement'],
            image: '<?= $basePrefix ?>/2.jpg',
            whereAppears: [
                { title: 'Commercial Output / #15', url: '<?= $basePrefix ?>/commercial-output' }
            ]
        },
        'plantation': {
            term: 'Plantation',
            fullName: 'Agricultural Production Estate',
            category: 'palm',
            categoryName: 'Palm & Agriculture',
            simple: 'The physical land concession cultivated with oil palm crops under verified legal documentation.',
            whyItMatters: 'The underlying productive natural asset generating real-world commodity output.',
            example: 'North Kalimantan Palm Estate (100 HA Batch NK-001).',
            ninaUse: 'Asset Portfolio Mapping & GIS Boundary Registration',
            warning: 'All land rights and permits must be verified in the Verification Vault before work begins.',
            related: ['GIS', 'Land Rights', 'Production Batch'],
            image: '<?= $basePrefix ?>/3.jpg',
            whereAppears: [
                { title: 'Project Overview', url: '<?= $basePrefix ?>/project-overview' }
            ]
        },
        'mill': {
            term: 'Mill',
            fullName: 'Palm Oil Processing Mill (PKS)',
            category: 'palm',
            categoryName: 'Palm & Agriculture',
            simple: 'The industrial extraction facility where fresh fruit bunches are sterilized, threshed, digested, and pressed into CPO.',
            whyItMatters: 'The processing hub that converts perishable agricultural fruit into high-value tradable crude oil.',
            example: 'Partner processing mill located within a 35 km radius with 45 Ton/Hour capacity.',
            ninaUse: 'Processing Facility Mapping & Delivery Slips',
            warning: 'Mill extraction efficiency directly determines actual OER realization.',
            related: ['CPO', 'TBS', 'OER', 'Delivery'],
            image: '<?= $basePrefix ?>/4.jpg',
            whereAppears: [
                { title: 'Commercial Output / #15', url: '<?= $basePrefix ?>/commercial-output' }
            ]
        },
        'rbd_palm_oil': {
            term: 'RBD Palm Oil',
            fullName: 'Refined, Bleached, Deodorized Palm Oil',
            category: 'palm',
            categoryName: 'Palm & Agriculture',
            simple: 'CPO that has undergone refining to remove free fatty acids, color pigments, and volatile impurities.',
            whyItMatters: 'Intermediary feedstock for downstream food manufacturing and consumer goods.',
            example: 'CPO Mentah → Refinery Process → RBD Palm Oil.',
            ninaUse: 'Downstream Offtake Specification',
            warning: 'Produced at refinery facilities, not at agricultural plantation sites.',
            related: ['CPO', 'RBD Palm Olein', 'Downstream'],
            image: '<?= $basePrefix ?>/5.jpg',
            whereAppears: [
                { title: 'Commercial Specifications', url: '<?= $basePrefix ?>/commercial-output' }
            ]
        },
        'rbd_palm_olein': {
            term: 'RBD Palm Olein',
            fullName: 'Refined Palm Olein (Liquid Fraction)',
            category: 'palm',
            categoryName: 'Palm & Agriculture',
            simple: 'The clear liquid fraction obtained by fractionating refined palm oil, used globally as premium cooking oil.',
            whyItMatters: 'The finished commercial product marketed by brands such as Sania, SunCo, and Rose Brand.',
            example: 'Bottled consumer cooking oil refined by PT Wilmar or PT Megasurya Mas.',
            ninaUse: 'End-Buyer Commercial Demand Mapping',
            warning: 'CPO is raw bulk oil. It requires multi-stage industrial refining before becoming bottled cooking oil.',
            related: ['CPO', 'Offtaker', 'Downstream'],
            image: '<?= $basePrefix ?>/6.jpg',
            whereAppears: [
                { title: 'Commercial Output', url: '<?= $basePrefix ?>/commercial-output' },
                { title: 'Demand First / #02', url: '<?= $basePrefix ?>/demand' }
            ]
        },
        'rbd_palm_stearin': {
            term: 'RBD Palm Stearin',
            fullName: 'Refined Palm Stearin (Solid Fraction)',
            category: 'palm',
            categoryName: 'Palm & Agriculture',
            simple: 'The solid fraction separated during palm oil crystallization, widely used in margarines, soaps, and shortening.',
            whyItMatters: 'Valuable co-product ensuring zero-waste commercial monetization of palm oil refinery output.',
            example: 'Solid fraction extracted alongside palm olein during winterization.',
            ninaUse: 'By-Product Monetization & Offtake',
            warning: 'High melting point makes it suitable for solid fats, distinct from liquid cooking oil.',
            related: ['CPO', 'RBD Palm Olein', 'Downstream'],
            image: '<?= $basePrefix ?>/7.jpg',
            whereAppears: [
                { title: 'Commercial Output', url: '<?= $basePrefix ?>/commercial-output' }
            ]
        },
        'prod_req': {
            term: 'Production Requirement',
            fullName: 'Commercial Demand Requirement',
            category: 'prod',
            categoryName: 'Production',
            simple: 'A verified quantity and specification of production capacity required to fulfill an offtake requirement.',
            whyItMatters: 'Production starts only when defined buyer demand exists, preventing unallocated asset speculation.',
            example: 'Buyer demand: 1,000 HA capacity mapped to 10 × 100 HA batches for 30,000 MT CPO.',
            ninaUse: '#02 Demand First & #20 Demand & Offtake Control',
            warning: 'A requirement maps operational capacity; it becomes fully binding upon formal contract execution.',
            related: ['Offtake', 'Production Capacity', 'Batch'],
            image: '<?= $basePrefix ?>/1.jpg',
            whereAppears: [
                { title: 'Demand First / #02', url: '<?= $basePrefix ?>/demand' }
            ]
        },
        'reputation_tier': {
            term: 'Operator Tiers & Reputation',
            fullName: 'NINA Partner Reputation & Progression Protocol',
            category: 'network',
            categoryName: 'Network & Infrastructure',
            simple: 'The operational ranking system (Silver 100 HA → Gold 1,000 HA → Platinum 10,000 HA → Institutional 100,000 HA) based on verified execution history.',
            whyItMatters: 'Every new entity starts strictly at 0.0 / 5.0 with 0 reviews and 0 completed batches. High-tier capacity listing requires proven execution history.',
            example: 'PT. Kaltara 8 starts at Silver Tier (100 HA/batch, 0.0 rating). Completing 10 batches (1,100 reviews) unlocks Gold Tier (1,000 HA/batch).',
            ninaUse: 'Partner Qualification, PO Allocation Minimums & Listing Limits',
            warning: 'Fabricated ratings are strictly prohibited. Reputation is earned solely through verified batch delivery.',
            related: ['Production Partner', 'PO Allocation', 'Production Batch'],
            image: '<?= $basePrefix ?>/3.jpg',
            whereAppears: [
                { title: 'Project Overview', url: '<?= $basePrefix ?>/project-overview' },
                { title: 'Partners & Vendors', url: '<?= $basePrefix ?>/vendors' }
            ]
        },
        'prod_cap': {
            term: 'Production Capacity',
            fullName: 'Aggregate Land Capacity',
            category: 'prod',
            categoryName: 'Production',
            simple: 'The total vetted hectares and partner infrastructure aggregated across verified regional clusters.',
            whyItMatters: 'Separates mapped potential land from certified operational batches.',
            example: '3,500 HA mapped capacity aggregated in North Kalimantan cluster.',
            ninaUse: '#03 Regional Capacity Mapping',
            warning: 'Mapped ≠ Verified ≠ Produced. Mapped capacity requires step-gate verification.',
            related: ['Plantation', 'Partner', 'GIS'],
            image: '<?= $basePrefix ?>/2.jpg',
            whereAppears: [
                { title: 'Capacity Mapping / #03', url: '<?= $basePrefix ?>/capacity' }
            ]
        },
        'prod_batch': {
            term: 'Production Batch',
            fullName: 'Standardized 100 HA Unit',
            category: 'prod',
            categoryName: 'Production',
            simple: 'The modular operational unit used by NINA to structure large programs into auditable packages.',
            whyItMatters: 'Enables precise RAB budget ring-fencing, milestone gate tracking, and transparent allocation units.',
            example: 'Batch NK-001 (100 HA, 880,000 USDT budget, 20-year operational horizon).',
            ninaUse: '#04 Production Batches & Lifecycle Control',
            warning: 'A batch is an operational production package, not a fractional land deed.',
            related: ['RAB', 'Work Order', 'Milestone'],
            image: '<?= $basePrefix ?>/3.jpg',
            whereAppears: [
                { title: 'Production Batches / #04', url: '<?= $basePrefix ?>/batches' }
            ]
        },
        'po_alloc': {
            term: 'PO Allocation',
            fullName: 'Mitra Participation Allocation',
            category: 'nina_part',
            categoryName: 'NINA Participation',
            simple: 'A structured unit of operational participation linked directly to a verified production batch.',
            whyItMatters: 'Enables partners to participate in transparent 1-110 units per batch backed by audited execution.',
            example: 'Batch NK-001: 110 Allocation Units @ 8,000 USDT minimum per unit.',
            ninaUse: '#06 Mitra PO Allocation & Distribution Engine',
            warning: 'PO Allocation DOES NOT equal land ownership or corporate equity. It is a commercial participation agreement.',
            related: ['RAB', 'Registered Wallet', 'Commercial Settlement'],
            image: '<?= $basePrefix ?>/4.jpg',
            whereAppears: [
                { title: 'Mitra PO Allocation / #06', url: '<?= $basePrefix ?>/allocations' }
            ]
        },
        'rab': {
            term: 'RAB',
            fullName: 'Rencana Anggaran Biaya (Cost Budget)',
            category: 'cost',
            categoryName: 'Cost & Budget',
            simple: 'The detailed 9-category cost breakdown required to execute a specific production batch.',
            whyItMatters: 'Funds are only disbursed against matching work orders with verified field photographic evidence.',
            example: 'Modeled Batch NK-001 Budget: 880,000 USDT (8,800 USDT/HA) across land, seed, inputs, and infra.',
            ninaUse: '#08 RAB & Milestone Cost Control',
            warning: 'The modeled budget represents the total requirement, not an immediate cash reserve.',
            related: ['CAPEX', 'OPEX', 'Work Order'],
            image: '<?= $basePrefix ?>/5.jpg',
            whereAppears: [
                { title: 'RAB & Cost Control / #08', url: '<?= $basePrefix ?>/rab' }
            ]
        },
        'capex': {
            term: 'CAPEX',
            fullName: 'Capital Expenditure',
            category: 'cost',
            categoryName: 'Cost & Budget',
            simple: 'Long-term capital spending used to acquire or construct physical productive plantation assets.',
            whyItMatters: 'Distinguishes durable investments (roads, drainage, certified seedlings) from recurring routine costs.',
            example: 'Land clearing, main perimeter drainage canal, certified seedling procurement, and nursery construction.',
            ninaUse: 'RAB Capital Formation Layers',
            warning: 'Incurred primarily during the 5-year development ramp-up period.',
            related: ['OPEX', 'RAB', 'Planting Density'],
            image: '<?= $basePrefix ?>/6.jpg',
            whereAppears: [
                { title: 'RAB Budget Structure', url: '<?= $basePrefix ?>/rab' }
            ]
        },
        'opex': {
            term: 'OPEX',
            fullName: 'Operating Expenditure',
            category: 'cost',
            categoryName: 'Cost & Budget',
            simple: 'Ongoing recurring operating expenses required to maintain healthy plantation agronomy day-to-day.',
            whyItMatters: 'Covers periodic fertilizer inputs, weeding labor, canopy maintenance, and crop protection.',
            example: 'Semi-annual NPK fertilizer broadcast, circle slashing, pest scouting, and field transport.',
            ninaUse: 'RAB Maintenance & Operational Layers',
            warning: 'Fluctuates according to world fertilizer raw material indices and labor rates.',
            related: ['CAPEX', 'RAB', 'Agronomic Protocol'],
            image: '<?= $basePrefix ?>/7.jpg',
            whereAppears: [
                { title: 'RAB Operations', url: '<?= $basePrefix ?>/rab' }
            ]
        }
    }
}">

    <!-- PAGE BACKGROUND (soft blurred forest background matching explore.php) -->
    <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden">
        <img src="<?= $basePrefix ?>/1.jpg" alt="" class="h-full w-full scale-110 object-cover opacity-20 blur-md" />
        <div class="absolute inset-0 bg-gradient-to-b from-[#06120F]/85 via-[#06120F]/95 to-[#04100B]"></div>
    </div>

    <div class="relative z-10">

        <!-- ================= 1. HERO SECTION ================= -->
        <section class="relative overflow-hidden border-b border-white/10 shadow-2xl">
            <img src="<?= $basePrefix ?>/1.jpg" alt="Natural forest canopy" class="absolute inset-0 h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#050D07]/95 via-[#050D07]/80 to-[#050D07]/40"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#06120F] via-transparent to-transparent"></div>

            <div class="relative space-y-5 px-6 pt-10 pb-12 lg:px-10 lg:pt-12 lg:pb-14 flex flex-col lg:flex-row lg:items-start justify-between gap-8">
                <!-- Left Content -->
                <div class="space-y-4 max-w-3xl">
                    <div class="inline-flex items-center gap-2 rounded-md bg-emerald-950/80 border border-emerald-500/30 px-2.5 py-1 text-[10px] font-mono font-bold tracking-[0.18em] text-emerald-300 uppercase">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        NINA FIELD GUIDE
                    </div>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.08] tracking-tight text-white">
                        Understand the System.<br>
                        <span class="bg-gradient-to-r from-emerald-300 via-emerald-100 to-amber-200 bg-clip-text text-transparent">
                            Without Knowing the Industry.
                        </span>
                    </h1>

                    <p class="text-sm sm:text-base font-normal leading-relaxed text-gray-300 max-w-2xl">
                        NINA uses terminology from agriculture, production, operations, commercial trade, finance, and digital infrastructure. This guide explains what each term means, why it matters, and where it appears inside the NINA Operating System.
                    </p>

                    <!-- Search Bar -->
                    <div class="relative max-w-xl pt-2">
                        <div class="absolute inset-y-0 left-0 pl-4.5 flex items-center pointer-events-none pt-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </div>
                        <input type="text" 
                               x-model="searchQuery"
                               placeholder="Search OER, CPO, RAB, CAPEX..." 
                               class="w-full bg-[#0B1815]/90 border border-white/20 text-white rounded-full py-3 pl-11 pr-14 focus:outline-none focus:border-emerald-400 focus:ring-1 focus:ring-emerald-400 backdrop-blur-md text-xs sm:text-sm placeholder-gray-500 shadow-xl transition-all">
                        <div class="absolute inset-y-0 right-1.5 flex items-center pt-2">
                            <button type="button" class="h-8 w-8 rounded-full bg-emerald-600 text-white flex items-center justify-center hover:bg-emerald-500 transition-colors shadow">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Hint Box: New to NINA? -->
                <div class="rounded-2xl border border-emerald-500/30 bg-emerald-950/40 p-5 shadow-2xl backdrop-blur-md max-w-sm shrink-0 flex items-start gap-4 border-l-4 border-l-emerald-400">
                    <div class="h-9 w-9 rounded-full bg-emerald-500/20 text-emerald-300 flex items-center justify-center border border-emerald-400/30 shadow-xs shrink-0 mt-0.5">
                        <svg class="w-5 h-5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    </div>
                    <div class="space-y-1">
                        <h3 class="text-sm font-bold text-white">New to NINA?</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            Start with the 10 most important terms below, or use the search bar to find any term you're curious about.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= CONTENT WRAPPER ================= -->
        <div class="space-y-10 px-4 pb-20 pt-8 sm:px-6 lg:px-10">

            <!-- ---------- 2. BROWSE BY CATEGORY ---------- -->
            <section class="space-y-3">
                <h2 class="text-xs font-mono font-bold uppercase tracking-wider text-emerald-400">Browse by Category</h2>
                
                <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-11 gap-2.5">
                    <?php
                    $cats = [
                        ['id' => 'all', 'label' => 'All Terms', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
                        ['id' => 'palm', 'label' => 'Palm & Agriculture', 'icon' => 'M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z'],
                        ['id' => 'prod', 'label' => 'Production', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                        ['id' => 'cost', 'label' => 'Cost & Budget', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['id' => 'comm', 'label' => 'Commercial', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                        ['id' => 'ops', 'label' => 'Operations', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                        ['id' => 'audit', 'label' => 'Verification & Audit', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                        ['id' => 'digital', 'label' => 'Digital / Blockchain', 'icon' => 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1'],
                        ['id' => 'nina_part', 'label' => 'NINA Participation', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                        ['id' => 'data', 'label' => 'Data & Metrics', 'icon' => 'M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z'],
                        ['id' => 'roles', 'label' => 'Organizations & Roles', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4']
                    ];
                    foreach ($cats as $cat):
                    ?>
                    <button @click="selectedCategory = '<?= $cat['id'] ?>'"
                            :class="selectedCategory === '<?= $cat['id'] ?>' ? 'bg-emerald-950/80 border-emerald-400 text-white font-bold ring-1 ring-emerald-400' : 'bg-[#0B1815]/90 border-white/10 text-gray-400 hover:bg-white/10 hover:text-white'"
                            class="flex flex-col items-center justify-center gap-2 rounded-xl border p-2.5 text-center h-[88px] transition-all shadow-md">
                        <span class="text-emerald-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="<?= $cat['icon'] ?>"/></svg>
                        </span>
                        <span class="text-[10px] leading-tight"><?= $cat['label'] ?></span>
                    </button>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- ---------- 3. START HERE (10 ESSENTIAL TERMS) ---------- -->
            <section class="<?= $card ?> p-6 space-y-4">
                <div class="flex items-center justify-between border-b border-white/10 pb-3">
                    <div>
                        <h2 class="text-base font-extrabold text-white">Start Here</h2>
                        <p class="text-xs text-gray-400">10 essential terms to help you quickly understand how NINA works.</p>
                    </div>
                    <a href="#glossary-view" class="text-xs font-bold text-emerald-400 hover:text-emerald-300 flex items-center gap-1">
                        <span>View Full Glossary</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 pt-1">
                    <?php
                    $essential10 = [
                        ['key' => 'prod_req', 'num' => '1', 'name' => 'Production Requirement'],
                        ['key' => 'prod_cap', 'num' => '2', 'name' => 'Production Capacity'],
                        ['key' => 'prod_batch', 'num' => '3', 'name' => 'Production Batch'],
                        ['key' => 'po_alloc', 'num' => '4', 'name' => 'PO Allocation'],
                        ['key' => 'rab', 'num' => '5', 'name' => 'RAB'],
                        ['key' => 'capex', 'num' => '6', 'name' => 'CAPEX'],
                        ['key' => 'opex', 'num' => '7', 'name' => 'OPEX'],
                        ['key' => 'tbs', 'num' => '8', 'name' => 'TBS'],
                        ['key' => 'cpo', 'num' => '9', 'name' => 'CPO'],
                        ['key' => 'oer', 'num' => '10', 'name' => 'OER'],
                    ];
                    foreach ($essential10 as $item):
                    ?>
                    <button @click="activeTermKey = '<?= $item['key'] ?>'; document.getElementById('glossary-view').scrollIntoView({behavior: 'smooth'})"
                            :class="activeTermKey === '<?= $item['key'] ?>' ? 'bg-emerald-950/80 border-emerald-400 text-white font-bold ring-1 ring-emerald-400' : 'bg-white/5 border-white/10 hover:bg-white/10 text-gray-300'"
                            class="flex items-center gap-3 rounded-xl p-3.5 border text-left transition-all shadow-sm">
                        <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 text-[10px] font-bold">
                            <?= $item['num'] ?>
                        </span>
                        <span class="text-xs font-semibold leading-tight">
                            <?= $item['name'] ?>
                        </span>
                    </button>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- ---------- 4. INTERACTIVE GLOSSARY SPLIT VIEW ---------- -->
            <section id="glossary-view" class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                <!-- Left Sidebar Navigation -->
                <div class="lg:col-span-4 space-y-4">
                    <div class="<?= $card ?> overflow-hidden">
                        
                        <!-- Search Input -->
                        <div class="p-3.5 border-b border-white/10">
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                                </span>
                                <input type="text" 
                                       x-model="searchQuery" 
                                       placeholder="Search terms..." 
                                       class="w-full bg-black/40 border border-white/10 text-white rounded-lg py-2 pl-9 pr-3 text-xs placeholder-gray-500 focus:outline-none focus:border-emerald-400">
                            </div>
                        </div>

                        <!-- Category Accordion Header -->
                        <div class="p-3.5 bg-emerald-950/30 border-b border-white/10 flex items-center justify-between cursor-pointer select-none"
                             @click="expandedCategory = !expandedCategory">
                            <div class="flex items-center gap-2 text-xs font-bold text-emerald-400">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/></svg>
                                <span>Palm & Agriculture</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="expandedCategory ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>

                        <!-- Terms List -->
                        <div class="divide-y divide-white/5" x-show="expandedCategory">
                            <?php
                            $sidebarTerms = [
                                ['key' => 'oer', 'label' => 'OER'],
                                ['key' => 'cpo', 'label' => 'CPO'],
                                ['key' => 'tbs', 'label' => 'TBS'],
                                ['key' => 'tbs_yield', 'label' => 'TBS Yield'],
                                ['key' => 'planting_density', 'label' => 'Planting Density'],
                                ['key' => 'superior_seed', 'label' => 'Certified Superior Seed'],
                                ['key' => 'inti_plasma', 'label' => 'Inti–Plasma'],
                                ['key' => 'agronomic_protocol', 'label' => 'Agronomic Protocol'],
                                ['key' => 'harvest', 'label' => 'Harvest'],
                                ['key' => 'plantation', 'label' => 'Plantation'],
                                ['key' => 'mill', 'label' => 'Mill'],
                                ['key' => 'rbd_palm_oil', 'label' => 'RBD Palm Oil'],
                                ['key' => 'rbd_palm_olein', 'label' => 'RBD Palm Olein'],
                                ['key' => 'rbd_palm_stearin', 'label' => 'RBD Palm Stearin'],
                            ];
                            foreach ($sidebarTerms as $st):
                            ?>
                            <button @click="activeTermKey = '<?= $st['key'] ?>'"
                                    :class="activeTermKey === '<?= $st['key'] ?>' ? 'bg-emerald-900/30 border-l-4 border-emerald-400 text-emerald-300 font-bold pl-4' : 'text-gray-400 hover:bg-white/5 pl-5 border-l-4 border-transparent font-medium hover:text-white'"
                                    class="w-full text-left py-2.5 pr-4 text-xs transition-colors flex items-center justify-between">
                                <span><?= $st['label'] ?></span>
                            </button>
                            <?php endforeach; ?>
                        </div>

                        <!-- Bottom Link -->
                        <div class="p-3.5 bg-black/40 border-t border-white/10">
                            <button @click="selectedCategory = 'palm'" class="text-xs font-bold text-emerald-400 hover:underline flex items-center gap-1">
                                <span>View all Palm & Agriculture</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>

                    </div>
                </div>

                <!-- Right Main Content Panel -->
                <div class="lg:col-span-8">
                    <template x-if="terms[activeTermKey]">
                        <div class="<?= $card ?> p-7 lg:p-9 space-y-6">

                            <!-- Breadcrumb & Share Button -->
                            <div class="flex items-center justify-between border-b border-white/10 pb-4">
                                <nav class="flex items-center gap-1.5 text-xs font-medium text-gray-400">
                                    <span>Glossary</span>
                                    <span class="text-gray-600">&rsaquo;</span>
                                    <span class="text-emerald-400" x-text="terms[activeTermKey].categoryName"></span>
                                    <span class="text-gray-600">&rsaquo;</span>
                                    <span class="text-white font-bold" x-text="terms[activeTermKey].term"></span>
                                </nav>

                                <button type="button" class="flex items-center gap-1.5 text-xs font-semibold text-gray-400 hover:text-white transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                                    <span>Share</span>
                                </button>
                            </div>

                            <!-- Term Title & Category Tag -->
                            <div class="space-y-1">
                                <div class="flex items-center gap-3">
                                    <h2 class="text-3xl font-extrabold text-white" x-text="terms[activeTermKey].term"></h2>
                                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-950/80 border border-emerald-500/30 px-3 py-1 text-xs font-bold text-emerald-300">
                                        <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/></svg>
                                        <span x-text="terms[activeTermKey].categoryName"></span>
                                    </span>
                                </div>
                                <div class="text-base font-semibold text-emerald-200" x-text="terms[activeTermKey].fullName"></div>
                            </div>

                            <!-- Simple Explanation -->
                            <p class="text-sm text-gray-300 leading-relaxed" x-text="terms[activeTermKey].simple"></p>

                            <!-- Two-Column Specification Detail -->
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 pt-2">
                                
                                <!-- Left Column: 4 Information Boxes -->
                                <div class="md:col-span-8 space-y-3.5">
                                    
                                    <!-- Box 1: Why it matters -->
                                    <div class="rounded-xl border border-white/10 bg-white/[0.03] p-4 flex items-start gap-3">
                                        <div class="h-6 w-6 rounded-full bg-emerald-500/20 text-emerald-300 flex items-center justify-center shrink-0 mt-0.5 border border-emerald-500/30">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                                        </div>
                                        <div class="space-y-1">
                                            <div class="text-xs font-bold text-white">Why it matters</div>
                                            <div class="text-xs text-gray-300 leading-relaxed" x-text="terms[activeTermKey].whyItMatters"></div>
                                        </div>
                                    </div>

                                    <!-- Box 2: Example Calculation -->
                                    <div class="rounded-xl border border-white/10 bg-black/40 p-4 flex items-start gap-3 shadow-inner">
                                        <div class="h-6 w-6 rounded-full bg-emerald-500/20 text-emerald-300 flex items-center justify-center shrink-0 mt-0.5 border border-emerald-500/30">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="16" y1="14" x2="16" y2="14"/><line x1="8" y1="10" x2="8" y2="10"/></svg>
                                        </div>
                                        <div class="space-y-1">
                                            <div class="text-xs font-bold text-white">Example</div>
                                            <div class="text-xs font-mono font-semibold text-emerald-300" x-text="terms[activeTermKey].example"></div>
                                        </div>
                                    </div>

                                    <!-- Box 3: NINA Use Context -->
                                    <div class="rounded-xl border border-white/10 bg-white/[0.03] p-4 flex items-start gap-3">
                                        <div class="h-6 w-6 rounded-full bg-emerald-500/20 text-emerald-300 flex items-center justify-center shrink-0 mt-0.5 border border-emerald-500/30">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </div>
                                        <div class="space-y-1">
                                            <div class="text-xs font-bold text-white">NINA use</div>
                                            <div class="text-xs text-gray-300" x-text="terms[activeTermKey].ninaUse"></div>
                                        </div>
                                    </div>

                                    <!-- Box 4: Model Assumption Alert -->
                                    <div class="rounded-xl border border-amber-500/30 bg-amber-950/20 p-4 flex items-start gap-3">
                                        <div class="h-6 w-6 rounded-full bg-amber-500/20 text-amber-300 flex items-center justify-center shrink-0 mt-0.5 border border-amber-500/30">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                        </div>
                                        <div class="space-y-0.5">
                                            <div class="text-xs font-bold text-amber-400">Model Assumption</div>
                                            <div class="text-xs text-amber-200/90 leading-relaxed" x-text="terms[activeTermKey].warning"></div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Right Column: Thumbnail, Related Terms & Where It Appears -->
                                <div class="md:col-span-4 space-y-5">
                                    <!-- Thumbnail Banner -->
                                    <div class="rounded-xl overflow-hidden border border-white/10 h-28 relative shadow-xs">
                                        <img :src="terms[activeTermKey].image" alt="Term visual" class="w-full h-full object-cover filter brightness-90" />
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                                        <span class="absolute bottom-2 left-3 text-[10px] font-bold text-white uppercase tracking-wider" x-text="terms[activeTermKey].term"></span>
                                    </div>

                                    <!-- Related Terms -->
                                    <div class="space-y-2">
                                        <div class="text-xs font-bold text-white">Related Terms</div>
                                        <div class="flex flex-wrap gap-1.5">
                                            <template x-for="rt in terms[activeTermKey].related" :key="rt">
                                                <span class="rounded bg-white/5 border border-white/10 px-2.5 py-1 text-[11px] font-medium text-gray-300 hover:border-emerald-400 transition-colors" x-text="rt"></span>
                                            </template>
                                        </div>
                                    </div>

                                    <!-- Where This Appears -->
                                    <div class="space-y-2 pt-1">
                                        <div class="text-xs font-bold text-white">Where this appears</div>
                                        <div class="space-y-1.5">
                                            <template x-for="item in terms[activeTermKey].whereAppears" :key="item.title">
                                                <a :href="item.url" class="flex items-center justify-between text-xs text-emerald-400 hover:text-emerald-300 py-1 group">
                                                    <div class="flex items-center gap-1.5">
                                                        <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                                        <span x-text="item.title"></span>
                                                    </div>
                                                    <svg class="w-3 h-3 text-gray-400 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                </a>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Card Footer Explainer Bar -->
                            <div class="rounded-xl border border-emerald-500/30 bg-emerald-950/40 p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 mt-6">
                                <div class="flex items-center gap-3">
                                    <div class="h-6 w-6 rounded-full bg-emerald-500/20 text-emerald-300 flex items-center justify-center shrink-0 border border-emerald-500/30">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                                    </div>
                                    <div class="space-y-0.5">
                                        <div class="text-xs font-bold text-white">Why am I seeing this term?</div>
                                        <div class="text-xs text-gray-300">Learn why OER appears in this page and how it's calculated.</div>
                                    </div>
                                </div>

                                <button type="button" class="rounded-lg border border-emerald-400/40 bg-emerald-900/60 hover:bg-emerald-800 px-3.5 py-1.5 text-xs font-bold text-emerald-300 flex items-center gap-1.5 shrink-0 transition-colors shadow-2xs">
                                    <span>View explanation</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </button>
                            </div>

                        </div>
                    </template>
                </div>

            </div>

            <!-- ================= 5. FINAL CTA (SECTION 70) ================= -->
            <section class="rounded-2xl border border-emerald-500/30 bg-gradient-to-r from-[#071610] via-[#0A2016] to-[#071610] p-10 lg:p-14 text-center space-y-5 shadow-2xl">
                <div class="max-w-4xl mx-auto space-y-4">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                        Now You Know the Language.
                    </h2>
                    
                    <p class="text-sm sm:text-base text-gray-300 max-w-2xl mx-auto leading-relaxed">
                        NINA is designed so you don't need to be an agronomist, plantation operator, commodity trader or blockchain expert to understand what is happening.
                    </p>

                    <div class="flex flex-wrap items-center justify-center gap-3 pt-4">
                        <a href="<?= $basePrefix ?>/" class="rounded-full bg-emerald-500 hover:bg-emerald-400 px-6 py-3 text-xs font-extrabold text-emerald-950 uppercase tracking-wide shadow-xl transition-all hover:scale-105">
                            EXPLORE THE OPERATING SYSTEM
                        </a>
                        <a href="<?= $basePrefix ?>/demand" class="rounded-full bg-emerald-950 border border-emerald-500/40 hover:bg-emerald-900 px-6 py-3 text-xs font-bold text-emerald-300 uppercase tracking-wide shadow-md transition-all hover:scale-105">
                            VIEW PRODUCTION REQUIREMENTS
                        </a>
                        <a href="<?= $basePrefix ?>/batches" class="rounded-full bg-emerald-950 border border-emerald-500/40 hover:bg-emerald-900 px-6 py-3 text-xs font-bold text-emerald-300 uppercase tracking-wide shadow-md transition-all hover:scale-105">
                            VIEW PRODUCTION BATCHES
                        </a>
                        <a href="<?= $basePrefix ?>/" class="rounded-full border border-white/20 bg-white/5 hover:bg-white/15 px-6 py-3 text-xs font-bold text-white uppercase tracking-wide shadow-xs transition-all hover:scale-105">
                            BACK TO HOME
                        </a>
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
