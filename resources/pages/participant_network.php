<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$constants = $config['system_constants'] ?? [];
$title = '22 / Participant Network — NINA Operating System';
$basePrefix = (strpos($_SERVER['REQUEST_URI'] ?? '', '/kallani/public') === 0) ? '/kallani/public' : '';
$activePage = 'participant-network';

/* ---------- Helpers & Icons ---------- */
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');

$svg = fn(string $inner, string $cls = 'w-4 h-4') =>
    '<svg class="' . $cls . '" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">' . $inner . '</svg>';

$ic = [
    'star'      => '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>',
    'check'     => '<circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 4.5-5"/>',
    'shield'    => '<path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/>',
    'user'      => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
    'building'  => '<path d="M4 21V7l8-4v18"/><path d="M20 21V11l-8-4"/><path d="M8 9h.01"/><path d="M8 13h.01"/><path d="M8 17h.01"/>',
    'globe'     => '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>',
    'arrow'     => '<path d="M5 12h14M12 5l7 7-7 7"/>',
    'filter'    => '<polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>',
    'layers'    => '<polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/>',
    'award'     => '<circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>',
    'info'      => '<circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>',
    'close'     => '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>',
    'seed'      => '<path d="M12 22c5-3 8-8 8-13a8 8 0 0 0-16 0c0 5 3 10 8 13z"/><path d="M12 22V9"/>',
    'orbit'     => '<circle cx="12" cy="12" r="3"/><ellipse cx="12" cy="12" rx="10" ry="4.5"/>',
    'stars'     => '<path d="M12 2v4M12 18v4M4.9 4.9l2.8 2.8M16.3 16.3l2.8 2.8M2 12h4M18 12h4M4.9 19.1l2.8-2.8M16.3 7.7l2.8-2.8"/><circle cx="12" cy="12" r="3"/>',
    'crown'     => '<path d="M3 18h18l-1.5-9-4.5 4-3-7-3 7-4.5-4L3 18z"/>',
    'bank'      => '<path d="M4 21V7l8-4v18"/><path d="M20 21V11l-8-4"/><path d="M2 21h20"/>',
    'reputation'=> '<path d="M12 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/><path d="M8.5 13.5L6 21l6-3 6 3-2.5-7.5"/>',
];

$card      = 'rounded-xl border border-white/10 bg-[#0B1815]/90 shadow-xl';
$metricLbl = 'text-[9px] font-mono font-medium uppercase tracking-wider text-gray-400';

/* ---------- Tier definitions (used to drive section 02) ---------- */
$tiers = [
    ['key' => 'NOVA', 'no' => '01', 'icon' => $ic['seed'], 'color' => 'emerald', 'label' => 'Entry Network Participant', 'threshold' => '≥ US$8,000', 'desc' => 'PO Allocation Unit:'],
    ['key' => 'ORBIT', 'no' => '02', 'icon' => $ic['orbit'], 'color' => 'sky', 'label' => 'Established Network Participant', 'threshold' => '≥ US$18,000', 'desc' => 'PO Allocation Unit:'],
    ['key' => 'CONSTELLATION', 'no' => '03', 'icon' => $ic['stars'], 'color' => 'purple', 'label' => 'Advanced Network Participant', 'threshold' => '≥ US$28,000', 'desc' => 'PO Allocation Unit:'],
    ['key' => 'SOVEREIGN', 'no' => '04', 'icon' => $ic['crown'], 'color' => 'amber', 'label' => 'High-Capacity Private Participant', 'threshold' => '≥ US$88,000', 'desc' => 'PO Allocation Unit:'],
    ['key' => 'INSTITUTIONAL', 'no' => '05', 'icon' => $ic['bank'], 'color' => 'cyan', 'label' => 'Qualified Institutional Participant', 'threshold' => '≥ US$280,000', 'desc' => 'PO Allocation Unit:'],
];
$tierColorMap = [
    'emerald' => ['ring' => 'border-emerald-500/30 hover:border-emerald-400', 'chip' => 'bg-emerald-950 text-emerald-300 border-emerald-500/30', 'ic' => 'bg-emerald-950 text-emerald-300 border-emerald-500/40', 'bar' => 'bg-emerald-400'],
    'sky'     => ['ring' => 'border-sky-500/30 hover:border-sky-400', 'chip' => 'bg-sky-950 text-sky-300 border-sky-500/30', 'ic' => 'bg-sky-950 text-sky-300 border-sky-500/40', 'bar' => 'bg-sky-400'],
    'purple'  => ['ring' => 'border-purple-500/30 hover:border-purple-400', 'chip' => 'bg-purple-950 text-purple-300 border-purple-500/30', 'ic' => 'bg-purple-950 text-purple-300 border-purple-500/40', 'bar' => 'bg-purple-400'],
    'amber'   => ['ring' => 'border-amber-500/30 hover:border-amber-400', 'chip' => 'bg-amber-950 text-amber-300 border-amber-500/30', 'ic' => 'bg-amber-950 text-amber-300 border-amber-500/40', 'bar' => 'bg-amber-400'],
    'cyan'    => ['ring' => 'border-cyan-500/30 hover:border-cyan-400', 'chip' => 'bg-cyan-950 text-cyan-300 border-cyan-500/30', 'ic' => 'bg-cyan-950 text-cyan-300 border-cyan-500/40', 'bar' => 'bg-cyan-400'],
];

/* ---------- Entity class distribution (derived summary for section 04) ---------- */
$entityClassDist = [
    ['label' => 'Private', 'count' => 4],
    ['label' => 'Private Office', 'count' => 2],
    ['label' => 'Family Office', 'count' => 2],
    ['label' => 'Private Equity', 'count' => 2],
    ['label' => 'Hedge Fund', 'count' => 1],
    ['label' => 'Asset Manager', 'count' => 4],
    ['label' => 'Institutional Capital', 'count' => 3],
    ['label' => 'Sovereign', 'count' => 3],
    ['label' => 'Public / State', 'count' => 2],
    ['label' => 'Financial Institution', 'count' => 2],
    ['label' => 'Corporate', 'count' => 3],
];

/* ---------- 28 PARTICIPANT SIMULATED & ILLUSTRATIVE RECORDS ---------- */
$participants = [
    [
        'id' => 'NINA-C-0001', 'name' => 'BANK CENTRAL ASIA', 'class' => 'FINANCIAL INSTITUTION', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$840,000', 'allocations' => 3, 'program' => 'Commercial Agriculture Financing',
        'context' => 'Indonesian Banking', 'review' => 'Entity verification, land documentation, ESG controls, transaction traceability and operational reporting.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0002', 'name' => 'MAYAPADA GROUP', 'class' => 'FAMILY / CORPORATE CAPITAL', 'tier' => 'SOVEREIGN',
        'unit' => 'US$88,000', 'cum' => 'US$176,000', 'allocations' => 2, 'program' => 'Sustainable Agro-Forestry Facility',
        'context' => 'Indonesian Ecosystem', 'review' => 'Governance, documentation, sustainability classification and long-term productive assets.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0003', 'name' => 'BLACKROCK', 'class' => 'GLOBAL ASSET MANAGER', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$2,800,000', 'allocations' => 10, 'program' => 'Indonesia Palm Production Program',
        'context' => 'Global Institution', 'review' => 'Institutional-grade traceability, governance, palm-oil ESG risk, verification and long-term value.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0004', 'name' => 'VANGUARD', 'class' => 'ASSET MANAGER', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$2,240,000', 'allocations' => 8, 'program' => 'Indonesia Palm Production Program',
        'context' => 'Global Institution', 'review' => 'Standardized reporting, stewardship, consistency of operating records and long-duration monitoring.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0005', 'name' => 'BLACKSTONE', 'class' => 'ALTERNATIVE ASSET MANAGER', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$1,400,000', 'allocations' => 5, 'program' => 'Multi-Region Productive Asset Program',
        'context' => 'Global Institution', 'review' => 'Real-asset execution, infrastructure, vendor control, production evidence and commercial output.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0006', 'name' => 'STATE STREET', 'class' => 'FINANCIAL INFRASTRUCTURE', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$1,680,000', 'allocations' => 6, 'program' => 'Agricultural Financing Architecture',
        'context' => 'Global Institution', 'review' => 'Capital infrastructure, farmer financing, data standardization and operational reporting.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0007', 'name' => 'ALPHABET / GOOGLE', 'class' => 'TECHNOLOGY / CORPORATE', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$1,120,000', 'allocations' => 4, 'program' => 'Agroforestry & AI Integration',
        'context' => 'Global Technology', 'review' => 'Data architecture, geospatial intelligence, AI, production monitoring and API readiness.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0008', 'name' => 'META', 'class' => 'TECHNOLOGY / CORPORATE', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$560,000', 'allocations' => 2, 'program' => 'Digital Identity & Supply Chain',
        'context' => 'Global Technology', 'review' => 'Network effects, digital identity, operational data, AI-assisted field intelligence.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0009', 'name' => 'NVIDIA', 'class' => 'AI / COMPUTING INFRASTRUCTURE', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$840,000', 'allocations' => 3, 'program' => 'Precision Farming Intelligence',
        'context' => 'Global Technology', 'review' => 'Edge AI, drones, satellite data, computer vision, predictive maintenance and plantation intelligence.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0010', 'name' => 'THE COCA-COLA COMPANY', 'class' => 'STRATEGIC BUYER', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$560,000', 'allocations' => 2, 'program' => 'Sustainable Agricultural Sourcing',
        'context' => 'Global Consumer', 'review' => 'Sustainable agricultural sourcing, supply continuity, traceability and quality.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0011', 'name' => 'PEPSICO', 'class' => 'STRATEGIC BUYER', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$840,000', 'allocations' => 3, 'program' => 'Regenerative Agriculture Program',
        'context' => 'Global Consumer', 'review' => 'Sustainable sourcing, palm-oil supply chain, farmer capability, traceability and offtake continuity.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0012', 'name' => 'DANANTARA INDONESIA', 'class' => 'STATE INVESTMENT', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$2,800,000', 'allocations' => 10, 'program' => 'National Productive Asset Program',
        'context' => 'Sovereign / State-Scale', 'review' => 'National-scale asset governance, production capacity, downstream integration, auditability and strategic infrastructure.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0013', 'name' => 'TEMASEK', 'class' => 'STATE-OWNED INVESTMENT', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$1,680,000', 'allocations' => 6, 'program' => 'Southeast Asia Green Economy',
        'context' => 'Sovereign / State-Scale', 'review' => 'Smallholder capability, certification, sustainable agriculture and traceable supply chain technology.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0014', 'name' => 'GIC', 'class' => 'SOVEREIGN WEALTH FUND', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$1,120,000', 'allocations' => 4, 'program' => 'Agricultural Infrastructure & Marketplace',
        'context' => 'Sovereign / State-Scale', 'review' => 'Productive asset viability, infrastructure integration, agricultural marketplace and long-term capital deployment.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0015', 'name' => 'KHAZANAH NASIONAL', 'class' => 'SOVEREIGN WEALTH FUND', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$560,000', 'allocations' => 2, 'program' => 'Smallholder Aggregation Network',
        'context' => 'Sovereign / State-Scale', 'review' => 'Smallholder aggregation, data visibility, and sustainable agriculture ecosystem development.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0016', 'name' => 'PUBLIC INVESTMENT FUND (PIF)', 'class' => 'SOVEREIGN WEALTH FUND', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$840,000', 'allocations' => 3, 'program' => 'Global Food Security Initiative',
        'context' => 'Sovereign / State-Scale', 'review' => 'Food security, agricultural assets, technology integration and global supply chain resilience.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0017', 'name' => 'ABU DHABI INVESTMENT AUTHORITY', 'class' => 'SOVEREIGN WEALTH FUND', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$560,000', 'allocations' => 2, 'program' => 'Agricultural Productivity Facility',
        'context' => 'Sovereign / State-Scale', 'review' => 'Agricultural inputs, productivity enhancement, and global food infrastructure investments.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0018', 'name' => 'QUANTEDGE', 'class' => 'QUANTITATIVE MANAGER', 'tier' => 'SOVEREIGN',
        'unit' => 'US$88,000', 'cum' => 'US$176,000', 'allocations' => 2, 'program' => 'Sustainable Landscape Program',
        'context' => 'Singapore Investment', 'review' => 'Measurable impact, MRV, farmer livelihoods, landscape monitoring and scalable financing mechanisms.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0019', 'name' => 'DYMON ASIA', 'class' => 'PRIVATE EQUITY', 'tier' => 'SOVEREIGN',
        'unit' => 'US$88,000', 'cum' => 'US$176,000', 'allocations' => 2, 'program' => 'Southeast Asian Real Assets',
        'context' => 'Southeast Asia Alternative', 'review' => 'Operating partner quality, execution, regional expansion, vendor ecosystem and scalable real assets.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0020', 'name' => 'GRASSHOPPER ASIA', 'class' => 'PROPRIETARY TRADING', 'tier' => 'CONSTELLATION',
        'unit' => 'US$28,000', 'cum' => 'US$56,000', 'allocations' => 2, 'program' => 'Technology-Driven Supply Network',
        'context' => 'Quantitative Technology', 'review' => 'Data infrastructure, systematic decision-making, technology, operational latency and risk controls.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0021', 'name' => 'PUPUK INDONESIA', 'class' => 'STATE-OWNED ENTERPRISE', 'tier' => 'SOVEREIGN',
        'unit' => 'US$88,000', 'cum' => 'US$176,000', 'allocations' => 2, 'program' => 'Integrated Farmer Ecosystem',
        'context' => 'Agricultural Input', 'review' => 'RAB fertilizer tracking, vendor alignment, production yields, farmer productivity and offtake security.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0022', 'name' => 'PERTAMINA', 'class' => 'STATE-OWNED ENERGY', 'tier' => 'SOVEREIGN',
        'unit' => 'US$88,000', 'cum' => 'US$176,000', 'allocations' => 2, 'program' => 'Regenerative Community Agriculture',
        'context' => 'Industrial Group', 'review' => 'Land utilization, community agriculture, waste processing, and technology-driven sustainability.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0023', 'name' => 'PTPN IV PALMCO', 'class' => 'STATE-OWNED PLANTATION', 'tier' => 'SOVEREIGN',
        'unit' => 'US$88,000', 'cum' => 'US$264,000', 'allocations' => 3, 'program' => 'Smallholder Productivity Program',
        'context' => 'Palm Oil Operator', 'review' => 'Smallholder integration, mill capacity, production yield, certification standards and commercial offtake.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0024', 'name' => 'INDOFOOD / INDOFOOD AGRI', 'class' => 'CORPORATE AGRIBUSINESS', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$840,000', 'allocations' => 3, 'program' => 'Integrated Palm Value Chain',
        'context' => 'Consumer Agribusiness', 'review' => 'Seed quality, plantation execution, mill operations, refinery integration, and end-to-end traceability.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0025', 'name' => 'TRIPUTRA GROUP', 'class' => 'FAMILY AGRIBUSINESS', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$560,000', 'allocations' => 2, 'program' => 'Strategic Industrial Crop Program',
        'context' => 'Corporate Ecosystem', 'review' => 'Agricultural operations, sustainable farming, production continuity and industrial ecosystem integration.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0026', 'name' => 'GOLDEN AGRI-RESOURCES', 'class' => 'CORPORATE AGRIBUSINESS', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$1,120,000', 'allocations' => 4, 'program' => 'Traceable Supply Chain Network',
        'context' => 'Corporate Agribusiness', 'review' => 'Plot-level traceability, smallholder mapping, climate-resilient seeds, and blockchain-verified supply chains.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0027', 'name' => 'ASTRA AGRO LESTARI', 'class' => 'PALM OIL OPERATOR', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$560,000', 'allocations' => 2, 'program' => 'Smallholder Inclusion Program',
        'context' => 'Corporate Operator', 'review' => 'Farmer partnerships, plantation health analytics, AI/drone monitoring, and production traceability.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-C-0028', 'name' => 'BARITO PACIFIC', 'class' => 'INDUSTRIAL & RESOURCES', 'tier' => 'INSTITUTIONAL',
        'unit' => 'US$280,000', 'cum' => 'US$840,000', 'allocations' => 3, 'program' => 'Integrated Natural Resources',
        'context' => 'Corporate Ecosystem', 'review' => 'Sustainable farming empowerment, productivity enhancement, and integrated industrial operations.',
        'badge' => 'ILLUSTRATIVE PROFILE — NOT A CUSTOMER', 'is_illustrative' => true
    ],
];

// Dynamically compute tier counts based on exact participant allocation history
$tierCounts = ['NOVA' => 0, 'ORBIT' => 0, 'CONSTELLATION' => 0, 'SOVEREIGN' => 0, 'INSTITUTIONAL' => 0];
foreach ($participants as $p) {
    if (isset($tierCounts[$p['tier']])) {
        $tierCounts[$p['tier']]++;
    }
}
foreach ($tiers as &$t) {
    $t['count'] = $tierCounts[$t['key']] ?? 0;
}
unset($t);

$tierBadgeCls = [
    'NOVA' => 'bg-emerald-950 border-emerald-500/40 text-emerald-300',
    'ORBIT' => 'bg-sky-950 border-sky-500/40 text-sky-300',
    'CONSTELLATION' => 'bg-purple-950 border-purple-500/40 text-purple-300',
    'SOVEREIGN' => 'bg-amber-950 border-amber-500/40 text-amber-300',
    'INSTITUTIONAL' => 'bg-cyan-950 border-cyan-500/40 text-cyan-300',
];

ob_start();
?>

<div class="relative w-full font-sans pb-16" x-data="{
    filterClass: 'ALL',
    selectedParticipant: null,
    drawerOpen: false,

    openDetail(p) {
        this.selectedParticipant = p;
        this.drawerOpen = true;
    }
}">

    <!-- PAGE BACKGROUND -->
    <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden">
        <img src="<?= $basePrefix ?>/1.jpg" alt="" class="h-full w-full scale-110 object-cover opacity-25 blur-md" />
        <div class="absolute inset-0 bg-gradient-to-b from-[#06120F]/60 via-[#06120F]/85 to-[#04100B]"></div>
    </div>

    <!-- ================= 01. PAGE HEADER & HERO (No horizontal padding on outer, padded inside) ================= -->
    <div class="relative z-10 space-y-6">
        <section class="relative overflow-hidden rounded-2xl border border-white/10 shadow-2xl">
            <img src="<?= $basePrefix ?>/1.jpg" alt="Natural forest canopy" class="absolute inset-0 h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#050D07]/92 via-[#050D07]/65 to-[#050D07]/25"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#06120F]/90 via-transparent to-transparent"></div>

            <div class="relative space-y-4 px-6 pt-6 pb-8 lg:px-8">

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <nav aria-label="Breadcrumb" class="inline-flex flex-wrap items-center gap-2 text-[10px] font-mono font-semibold uppercase tracking-[0.14em] text-gray-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                        <span class="font-bold text-emerald-300">22 / PARTICIPANT NETWORK</span>
                    </nav>

                    <span class="rounded bg-amber-500/15 px-3 py-1 text-[10px] font-bold text-amber-300 border border-amber-500/40 uppercase tracking-wider flex items-center gap-1.5 w-fit">
                        <?= $svg($ic['info'], 'w-3.5 h-3.5 text-amber-400') ?> DEMO / SIMULATION ENVIRONMENT
                    </span>
                </div>

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 items-center">
                    <div class="space-y-2 lg:col-span-8">
                        <h1 class="max-w-3xl text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl">
                            Participation Across<br class="hidden sm:block" /> the NINA Network.
                        </h1>
                        <p class="max-w-2xl text-sm font-medium leading-relaxed text-gray-200">
                            From private participants and family offices to funds, institutional capital and sovereign-scale organizations, NINA provides a common operating layer for participation in productive production programs.
                        </p>
                    </div>

                    <div class="lg:col-span-4">
                        <div class="space-y-2 rounded-xl border border-white/15 bg-[#08130F]/85 p-4 shadow-2xl backdrop-blur-xl">
                            <div class="text-[10px] font-mono text-gray-300 leading-relaxed">
                                All participant profiles, reviews, allocations and institutional references displayed on this page are simulated product data for demonstration purposes only.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- WRAPPER FOR ALL SECTIONS EXCEPT HEADER WITH SIDE PADDING -->
        <div class="space-y-6 px-4 sm:px-6 lg:px-8">

        <!-- ================= 02. PARTICIPANT TIER SYSTEM ================= -->
        <section class="space-y-4">
            <div class="border-b border-white/10 pb-3">
                <h2 class="text-sm font-mono font-bold uppercase tracking-wider text-white flex items-center gap-2">
                    <?= $svg($ic['award'], 'w-4 h-4 text-emerald-400') ?> PARTICIPANT TIER SYSTEM
                </h2>
                <p class="text-xs text-gray-400">Cumulative participation history determines your tier.</p>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch gap-2">
                <?php foreach ($tiers as $i => $t): $c = $tierColorMap[$t['color']]; ?>
                    <div class="<?= $card ?> <?= $c['ring'] ?> flex-1 p-4 space-y-3 text-center transition-all">
                        <div class="flex items-center justify-center">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full border <?= $c['ic'] ?>">
                                <?= $svg($t['icon'], 'w-5 h-5') ?>
                            </div>
                        </div>
                        <div>
                            <div class="text-xs font-mono font-bold text-white tracking-wider"><?= $e($t['key']) ?></div>
                        </div>
                        <div class="text-[11px] font-bold text-gray-200 leading-snug min-h-[2.2em]"><?= $e($t['label']) ?></div>
                        <div class="pt-2 border-t border-white/10 text-[10px] font-mono text-gray-400 space-y-0.5">
                            <div><?= $e($t['desc']) ?></div>
                            <div class="font-bold <?= 'text-' . $t['color'] . '-300' ?>"><?= $e($t['threshold']) ?></div>
                        </div>
                    </div>
                    <?php if ($i < count($tiers) - 1): ?>
                        <div class="hidden sm:flex items-center justify-center px-0.5 text-gray-500 shrink-0">
                            <?= $svg($ic['arrow'], 'w-4 h-4') ?>
                        </div>
                        <div class="flex sm:hidden items-center justify-center py-1.5 text-gray-500 shrink-0">
                            <?= $svg($ic['arrow'], 'w-4 h-4 rotate-90') ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- ================= 03. THREE IDENTITIES, ONE ECOSYSTEM ================= -->
        <section class="space-y-4">
            <div class="border-b border-white/10 pb-3">
                <h2 class="text-sm font-mono font-bold uppercase tracking-wider text-white flex items-center gap-2">
                    <?= $svg($ic['layers'], 'w-4 h-4 text-emerald-400') ?> THREE IDENTITIES, ONE ECOSYSTEM
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="<?= $card ?> p-4 flex items-start gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-emerald-500/40 bg-emerald-950 text-emerald-300">
                        <?= $svg($ic['user'], 'w-5 h-5') ?>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-white uppercase">Participant Tier</div>
                        <p class="text-[11px] text-gray-400 mt-1 leading-relaxed">Indicates the size of a single PO Allocation Unit.</p>
                    </div>
                </div>
                <div class="<?= $card ?> p-4 flex items-start gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-sky-500/40 bg-sky-950 text-sky-300">
                        <?= $svg($ic['building'], 'w-5 h-5') ?>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-white uppercase">Entity Class</div>
                        <p class="text-[11px] text-gray-400 mt-1 leading-relaxed">Identifies participant organizational type (Private, Family Office, Asset Manager, etc.).</p>
                    </div>
                </div>
                <div class="<?= $card ?> p-4 flex items-start gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-amber-500/40 bg-amber-950 text-amber-300">
                        <?= $svg($ic['reputation'], 'w-5 h-5') ?>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-white uppercase">Reputation</div>
                        <p class="text-[11px] text-gray-400 mt-1 leading-relaxed">Measures verified production participation history.</p>
                    </div>
                </div>
            </div>

            <div class="rounded-lg bg-black/40 border border-white/10 p-3 text-[10px] font-mono text-gray-400 text-center">
                <span class="text-gray-300 font-bold">Tier</span> measures participation history. <span class="text-gray-300 font-bold">Entity Class</span> identifies participant type. <span class="text-gray-300 font-bold">Reputation</span> measures verified performance.
            </div>
        </section>

        <!-- ================= 05. PARTICIPANT NETWORK SNAPSHOT ================= -->
        <section class="<?= $card ?> p-5 space-y-5">
            <h2 class="text-sm font-mono font-bold uppercase tracking-wider text-white flex items-center gap-2">
                <?= $svg($ic['globe'], 'w-5 h-5 text-emerald-400 shrink-0') ?> PARTICIPANT NETWORK — DEMO
            </h2>

            <!-- Stats Bar -->
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 font-mono">
                <div class="p-3.5 rounded-xl bg-white/5 border border-white/10 flex items-center gap-2.5 min-w-0">
                    <div class="text-gray-400 p-2 rounded-lg bg-white/5 shrink-0">
                        <?= $svg($ic['user'], 'w-5 h-5') ?>
                    </div>
                    <div class="min-w-0">
                        <strong class="text-lg sm:text-xl font-extrabold text-white block leading-none truncate">28</strong>
                        <span class="text-[9px] text-gray-400 block uppercase mt-1 truncate">Profiles</span>
                    </div>
                </div>
                <div class="p-3.5 rounded-xl bg-white/5 border border-white/10 flex items-center gap-2.5 min-w-0">
                    <div class="text-emerald-400 p-2 rounded-lg bg-emerald-950/60 border border-emerald-500/30 shrink-0">
                        <?= $svg($ic['layers'], 'w-5 h-5') ?>
                    </div>
                    <div class="min-w-0">
                        <strong class="text-lg sm:text-xl font-extrabold text-emerald-400 block leading-none truncate">5</strong>
                        <span class="text-[9px] text-gray-400 block uppercase mt-1 truncate">Participant Tiers</span>
                    </div>
                </div>
                <div class="p-3.5 rounded-xl bg-white/5 border border-white/10 flex items-center gap-2.5 min-w-0">
                    <div class="text-purple-400 p-2 rounded-lg bg-purple-950/60 border border-purple-500/30 shrink-0">
                        <?= $svg($ic['building'], 'w-5 h-5') ?>
                    </div>
                    <div class="min-w-0">
                        <strong class="text-lg sm:text-xl font-extrabold text-purple-400 block leading-none truncate">11</strong>
                        <span class="text-[9px] text-gray-400 block uppercase mt-1 truncate">Entity Classes</span>
                    </div>
                </div>
                <div class="p-3.5 rounded-xl bg-white/5 border border-white/10 flex items-center gap-2.5 min-w-0">
                    <div class="text-amber-400 p-2 rounded-lg bg-amber-950/60 border border-amber-500/30 shrink-0">
                        <?= $svg($ic['globe'], 'w-5 h-5') ?>
                    </div>
                    <div class="min-w-0">
                        <strong class="text-sm sm:text-lg font-extrabold text-amber-400 block leading-tight truncate">Multiple</strong>
                        <span class="text-[8px] sm:text-[9px] text-gray-400 block uppercase mt-0.5 truncate leading-tight">Geographic Markets</span>
                    </div>
                </div>
                <div class="p-3.5 rounded-xl bg-white/5 border border-white/10 flex items-center gap-2.5 min-w-0 col-span-2 sm:col-span-1">
                    <div class="text-cyan-400 p-2 rounded-lg bg-cyan-950/60 border border-cyan-500/30 shrink-0">
                        <?= $svg($ic['shield'], 'w-5 h-5') ?>
                    </div>
                    <div class="min-w-0">
                        <strong class="text-lg sm:text-xl font-extrabold text-cyan-400 block leading-none truncate">100%</strong>
                        <span class="text-[9px] text-gray-400 block uppercase mt-1 truncate">Simulated</span>
                    </div>
                </div>
            </div>

            <!-- Distribution Panels -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 pt-2">
                <!-- Tier distribution bars -->
                <div class="rounded-xl border border-white/10 bg-black/30 p-4 space-y-3">
                    <div class="text-[10px] font-mono font-bold uppercase tracking-wider text-gray-300">Participant Tier Distribution</div>
                    <?php
                    $maxCount = max(array_column($tiers, 'count'));
                    foreach ($tiers as $t): $c = $tierColorMap[$t['color']]; $pct = round(($t['count'] / $maxCount) * 100);
                    ?>
                        <div class="flex items-center gap-3 text-[10px] font-mono">
                            <span class="w-28 shrink-0 font-bold <?= 'text-' . $t['color'] . '-300' ?>"><?= $e($t['key']) ?></span>
                            <div class="flex-1 h-2 rounded-full bg-white/5 overflow-hidden">
                                <div class="h-full <?= $c['bar'] ?> rounded-full" style="width: <?= $pct ?>%"></div>
                            </div>
                            <span class="w-4 text-right text-gray-300 font-bold"><?= $t['count'] ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Entity class distribution list -->
                <div class="rounded-xl border border-white/10 bg-black/30 p-4 space-y-2">
                    <div class="text-[10px] font-mono font-bold uppercase tracking-wider text-gray-300 mb-1">Entity Class Distribution</div>
                    <div class="grid grid-cols-2 gap-x-4 gap-y-1.5 text-[10px] font-mono">
                        <?php foreach ($entityClassDist as $ec): ?>
                            <div class="flex items-center justify-between border-b border-white/5 py-1">
                                <span class="text-gray-300"><?= $e($ec['label']) ?></span>
                                <strong class="text-white"><?= $ec['count'] ?></strong>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= 04. ENTITY CLASS FILTER ================= -->
        <section class="space-y-3">
            <div class="flex items-center justify-between text-xs font-mono uppercase text-gray-400">
                <span class="flex items-center gap-1.5 font-bold text-white">
                    <?= $svg($ic['filter'], 'w-4 h-4 text-emerald-400') ?> ENTITY CLASS FILTER
                </span>
                <span class="hidden sm:inline">Click a filter to isolate participant profiles</span>
            </div>

            <div class="flex flex-wrap items-center gap-2 font-mono text-[10px]">
                <?php
                $filters = [
                    'ALL', 'PRIVATE', 'PRIVATE OFFICE', 'FAMILY OFFICE', 'PRIVATE EQUITY',
                    'HEDGE FUND', 'ASSET MANAGER', 'CORPORATE', 'FINANCIAL INSTITUTION',
                    'PUBLIC INSTITUTION', 'INSTITUTIONAL CAPITAL'
                ];
                foreach ($filters as $flt):
                ?>
                    <button @click="filterClass = '<?= $flt ?>'"
                            :class="filterClass === '<?= $flt ?>' ? 'bg-emerald-500 text-black font-extrabold border-emerald-400' : 'bg-white/5 text-gray-300 hover:bg-white/10 border-white/10'"
                            class="rounded-lg px-3 py-1.5 border transition-all uppercase tracking-wider">
                        <?= $flt ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- ================= 06. PARTICIPANT RECORDS GRID ================= -->
        <section class="space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-4">
                <h2 class="text-lg font-mono font-bold uppercase tracking-wider text-white flex items-center gap-2">
                    <?= $svg($ic['user'], 'w-5 h-5 text-emerald-400') ?> 28 PARTICIPANT RECORDS
                </h2>
                <div class="text-xs font-mono text-gray-400 flex items-center gap-2">
                    Sort by:
                    <span class="rounded bg-white/5 border border-white/10 px-2 py-1 text-gray-200">Recently Updated</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($participants as $p): ?>
                    <div x-show="filterClass === 'ALL' || filterClass === '<?= $p['class'] ?>'"
                         class="<?= $card ?> p-4 flex flex-col justify-between space-y-3 hover:border-emerald-400/60 transition-all cursor-pointer group"
                         @click="openDetail(<?= htmlspecialchars(json_encode($p), ENT_QUOTES, 'UTF-8') ?>)">

                        <div class="space-y-2.5">
                            <div class="flex items-start justify-between gap-2">
                                <span class="rounded px-2 py-0.5 text-[9px] font-mono font-bold border <?= $tierBadgeCls[$p['tier']] ?>">
                                    <?= $e($p['tier']) ?>
                                </span>
                                <span class="text-[8px] font-mono text-gray-500"><?= $e($p['id']) ?></span>
                            </div>

                            <div class="flex items-center gap-3">
                                <?php if (!empty($p['logo'])): ?>
                                    <div class="h-10 w-10 shrink-0 rounded-lg overflow-hidden border border-white/20 bg-black/60 p-1 flex items-center justify-center shadow-lg">
                                        <img src="<?= $e($p['logo']) ?>" alt="<?= $e($p['name']) ?>" class="max-h-full max-w-full object-contain" />
                                    </div>
                                <?php else: ?>
                                    <div class="h-10 w-10 shrink-0 rounded-lg border border-emerald-500/30 bg-emerald-950/80 text-emerald-300 flex items-center justify-center font-bold font-mono text-xs shadow-inner">
                                        <?= strtoupper(substr($p['name'], 0, 2)) ?>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <h3 class="text-sm font-extrabold text-white group-hover:text-emerald-300 transition-colors leading-snug">
                                        <?= $e($p['name']) ?>
                                    </h3>
                                    <span class="text-[9px] font-mono text-gray-400 uppercase"><?= $e($p['class']) ?></span>
                                </div>
                            </div>

                            <div class="text-[10px] font-mono text-gray-400">
                                Cumulative Participation<br />
                                <strong class="text-emerald-400 text-xs">≥ <?= $e($p['cum']) ?></strong>
                            </div>

                            <div class="grid grid-cols-1 gap-1 text-[9px] font-mono text-gray-300">
                                <div class="flex items-center justify-between"><span class="text-emerald-400">Cumulative Participation:</span> <span class="truncate ml-2"><?= $e($p['cum']) ?></span></div>
                                <div class="flex items-center justify-between"><span class="text-emerald-400">Confirmed Allocations:</span> <span class="truncate ml-2"><?= $e($p['allocations']) ?></span></div>
                                <div class="flex items-center justify-between"><span class="text-emerald-400">Program:</span> <span class="truncate ml-2"><?= $e($p['program']) ?></span></div>
                                <?php if (!empty($p['context'])): ?>
                                    <div class="flex items-center justify-between"><span class="text-emerald-400">Capital Context:</span> <span class="truncate ml-2"><?= $e($p['context']) ?></span></div>
                                <?php endif; ?>
                            </div>

                            <div class="rounded-lg bg-white/[0.03] border border-white/10 p-2.5 mt-2">
                                <p class="text-[11px] text-gray-300 italic leading-relaxed">
                                    "<?= $e($p['review']) ?>"
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-2 border-t border-white/10 text-[8px] font-mono mt-3">
                            <span class="text-gray-500 uppercase"><?= $p['is_illustrative'] ? '● ILLUSTRATIVE SCENARIO' : '● SIMULATED PARTICIPANT' ?></span>
                            <span class="<?= $p['is_illustrative'] ? 'text-gray-500' : 'text-amber-400' ?> font-bold flex items-center gap-1">
                                <?php if (!$p['is_illustrative']): ?>
                                    <?= $svg($ic['star'], 'w-3 h-3 fill-amber-400 text-amber-400') ?> <?= $e($p['stars']) ?>
                                <?php else: ?>
                                    NO ACTUAL REVIEW
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- ================= 07. DESIGNED FOR MULTIPLE PARTICIPATION SCALES ================= -->
        <section class="relative overflow-hidden rounded-2xl border border-white/10 shadow-2xl">
            <img src="<?= $basePrefix ?>/1.jpg" alt="" class="absolute inset-0 h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#050D07]/95 via-[#050D07]/85 to-[#050D07]/60"></div>

            <div class="relative p-6 lg:p-8 space-y-5">
                <div class="text-[10px] font-mono font-bold uppercase tracking-widest text-emerald-300">Designed for Multiple Participation Scales</div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-[11px] font-mono">
                    <div>
                        <div class="font-bold text-white uppercase">Private</div>
                        <div class="text-gray-400 mt-0.5">Individual participation</div>
                    </div>
                    <div>
                        <div class="font-bold text-white uppercase">Private Capital</div>
                        <div class="text-gray-400 mt-0.5">Private office / family office</div>
                    </div>
                    <div>
                        <div class="font-bold text-white uppercase">Professional Capital</div>
                        <div class="text-gray-400 mt-0.5">PE / hedge fund / alternative fund</div>
                    </div>
                    <div>
                        <div class="font-bold text-white uppercase">Institutional Capital</div>
                        <div class="text-gray-400 mt-0.5">Asset manager / pension / insurance / corporate</div>
                    </div>
                </div>

                <h3 class="text-xl font-extrabold text-white">One operating architecture. Multiple participant classes.</h3>

                <div class="flex flex-wrap items-center gap-3 pt-2">
                    <a href="<?= $basePrefix ?>/explore" class="rounded-lg bg-emerald-500 px-4 py-2 text-[11px] font-extrabold text-black uppercase tracking-wide hover:bg-emerald-400 transition-colors">
                        Explore Projects
                    </a>
                    <a href="<?= $basePrefix ?>/production-network" class="rounded-lg border border-white/20 bg-white/5 px-4 py-2 text-[11px] font-bold text-gray-200 uppercase tracking-wide hover:bg-white/10 transition-colors">
                        View Production Network
                    </a>
                </div>
            </div>
        </section>

        <p class="text-center text-[10px] font-mono text-gray-500 px-4">
            Participant names, institutional profiles, participation volumes, reviews, allocation records and institutional use cases shown on this page are simulated data created to demonstrate NINA's intended product architecture. References to real organizations or institutions do not constitute or imply participation, investment, partnership, endorsement, mandate, customer relationship or affiliation with NINA.
        </p>

        </div> <!-- END SIDE PADDING WRAPPER -->

        <!-- ================= PARTICIPANT RECORD DETAIL MODAL (FULL SPLIT VIEW) ================= -->
        <div x-show="drawerOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 lg:p-8 bg-black/80 backdrop-blur-md"
             x-cloak>

            <!-- Modal Backdrop Area (Click to Close) -->
            <div class="fixed inset-0" @click="drawerOpen = false"></div>

            <!-- Modal Content Container -->
            <div @click.away="drawerOpen = false"
                 class="relative z-10 w-full max-w-6xl bg-[#06120F] border border-white/15 rounded-2xl max-h-[92vh] md:h-[90vh] overflow-y-auto md:overflow-hidden flex flex-col md:flex-row shadow-2xl font-mono text-white">

                <!-- LEFT PANEL: Visual Banner, Program Field Photo, and Quick Summary -->
                <div class="md:w-1/3 shrink-0 relative border-b md:border-b-0 md:border-r border-white/10 bg-[#040C0A] flex flex-col justify-between overflow-hidden">
                    <img :src="'<?= $basePrefix ?>/' + ((parseInt(selectedParticipant?.id.replace(/[^0-9]/g, '')) % 10) + 1) + '.jpg'" alt="" class="absolute inset-0 h-full w-full object-cover opacity-40 blur-xs" />
                    <div class="absolute inset-0 bg-gradient-to-t from-[#06120F] via-[#06120F]/70 to-[#06120F]/50"></div>

                    <div class="relative z-10 p-4 sm:p-6 space-y-4">
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <div class="flex items-center gap-3 min-w-0">
                                <template x-if="selectedParticipant && selectedParticipant.logo">
                                    <div class="h-12 w-12 shrink-0 rounded-lg border border-white/20 bg-black/60 p-1 flex items-center justify-center shadow-lg">
                                        <img :src="selectedParticipant.logo" :alt="selectedParticipant.name" class="max-h-full max-w-full object-contain" />
                                    </div>
                                </template>
                                <template x-if="selectedParticipant && !selectedParticipant.logo">
                                    <div class="h-12 w-12 shrink-0 rounded-lg border border-emerald-500/30 bg-emerald-950/60 text-emerald-300 flex items-center justify-center font-bold text-sm"
                                         x-text="selectedParticipant ? selectedParticipant.name.substring(0, 2).toUpperCase() : ''">
                                    </div>
                                </template>
                                <div class="min-w-0">
                                    <span class="text-[9px] text-emerald-400 font-bold block uppercase tracking-wider truncate">NINA PARTICIPANT</span>
                                    <h3 class="text-base font-extrabold text-white leading-tight break-words" x-text="selectedParticipant?.name"></h3>
                                    <span class="text-[10px] text-gray-400 block truncate" x-text="selectedParticipant?.id"></span>
                                </div>
                            </div>
                            <button @click="drawerOpen = false" class="md:hidden p-2 rounded-lg bg-white/5 hover:bg-white/10 text-gray-300 shrink-0">
                                <?= $svg($ic['close'], 'w-5 h-5') ?>
                            </button>
                        </div>

                        <!-- Active Program Field Photo -->
                        <div class="rounded-xl border border-white/15 overflow-hidden relative group">
                            <img :src="'<?= $basePrefix ?>/' + ((parseInt(selectedParticipant?.id.replace(/[^0-9]/g, '')) % 10) + 1) + '.jpg'" alt="" class="h-36 sm:h-44 w-full object-cover" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                            <div class="absolute bottom-3 left-3 right-3 text-[10px]">
                                <span class="text-emerald-400 font-bold block truncate" x-text="selectedParticipant?.program"></span>
                                <span class="text-gray-300 text-[9px] block">Verified Production Field Unit</span>
                            </div>
                        </div>

                        <!-- Left Panel Quick Summary -->
                        <div class="space-y-2 text-xs pt-2">
                            <div class="flex justify-between items-center border-b border-white/10 pb-1.5 gap-2">
                                <span class="text-gray-400 shrink-0">Class:</span>
                                <strong class="text-emerald-300 truncate" x-text="selectedParticipant?.class"></strong>
                            </div>
                            <div class="flex justify-between items-center border-b border-white/10 pb-1.5 gap-2">
                                <span class="text-gray-400 shrink-0">Tier:</span>
                                <strong class="text-amber-300 truncate" x-text="selectedParticipant?.tier"></strong>
                            </div>
                            <div class="flex justify-between items-center border-b border-white/10 pb-1.5 gap-2">
                                <span class="text-gray-400 shrink-0">PO Allocation Unit:</span>
                                <strong class="text-emerald-400 truncate" x-text="selectedParticipant?.unit"></strong>
                            </div>
                            <div class="flex justify-between items-center border-b border-white/10 pb-1.5 gap-2">
                                <span class="text-gray-400 shrink-0">Cum. PO Participation:</span>
                                <strong class="text-white truncate" x-text="selectedParticipant?.cum"></strong>
                            </div>
                            <div class="flex justify-between items-center border-b border-white/10 pb-1.5 gap-2">
                                <span class="text-gray-400 shrink-0">Confirmed Allocations:</span>
                                <strong class="text-white truncate" x-text="selectedParticipant?.allocations"></strong>
                            </div>
                            <div class="flex justify-between items-center border-b border-white/10 pb-1.5 gap-2">
                                <span class="text-gray-400 shrink-0">Status:</span>
                                <strong class="text-gray-500 flex items-center gap-1 shrink-0 text-[10px]" x-show="selectedParticipant?.is_illustrative">
                                    ILLUSTRATIVE
                                </strong>
                            </div>
                        </div>
                    </div>

                    <div class="relative z-10 p-4 sm:p-6 border-t border-white/10 text-[9px] text-gray-400 leading-relaxed hidden sm:block">
                        ★ Verified Review Record • All data simulated for architecture demonstration.
                    </div>
                </div>

                <!-- RIGHT PANEL: Full Detailed Record & Audit Breakdown -->
                <div class="md:w-2/3 flex flex-col md:h-full md:overflow-y-auto p-4 sm:p-6 space-y-6 bg-[#06120F]">

                    <div class="hidden md:flex items-center justify-between border-b border-white/10 pb-4 shrink-0">
                        <div>
                            <span class="text-[10px] text-emerald-400 font-bold block uppercase tracking-widest">PARTICIPANT RECORD DETAIL & AUDIT</span>
                            <h2 class="text-xl font-extrabold text-white break-words" x-text="selectedParticipant ? selectedParticipant.name : ''"></h2>
                        </div>
                        <button @click="drawerOpen = false" class="p-2 rounded-lg bg-white/5 hover:bg-white/10 text-gray-300 shrink-0">
                            <?= $svg($ic['close'], 'w-5 h-5') ?>
                        </button>
                    </div>

                <div x-show="selectedParticipant" class="space-y-5">
                    <template x-if="selectedParticipant?.public_ref">
                        <div class="rounded-lg bg-amber-500/10 border border-amber-500/30 p-2.5 text-[10px] text-amber-300 flex items-center justify-between">
                            <span class="font-semibold" x-text="selectedParticipant.public_ref"></span>
                            <span class="font-bold text-[9px] uppercase px-2 py-0.5 rounded bg-amber-950/60 border border-amber-500/40">SIMULATION ONLY</span>
                        </div>
                    </template>

                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div class="p-3 rounded-lg bg-white/5 border border-white/10">
                            <span class="text-[9px] text-gray-400 block uppercase">Entity Class</span>
                            <strong class="text-emerald-300 text-sm" x-text="selectedParticipant?.class"></strong>
                        </div>
                        <div class="p-3 rounded-lg bg-white/5 border border-white/10">
                            <span class="text-[9px] text-gray-400 block uppercase">Participant Tier</span>
                            <strong class="text-amber-300 text-sm" x-text="selectedParticipant?.tier"></strong>
                        </div>
                        <div class="p-3 rounded-lg bg-white/5 border border-white/10">
                            <span class="text-[9px] text-gray-400 block uppercase">PO Allocation Unit</span>
                            <strong class="text-emerald-400 text-sm" x-text="selectedParticipant?.unit"></strong>
                        </div>
                        <div class="p-3 rounded-lg bg-white/5 border border-white/10">
                            <span class="text-[9px] text-gray-400 block uppercase">Cumulative PO</span>
                            <strong class="text-white text-sm" x-text="selectedParticipant?.cum"></strong>
                        </div>
                    </div>

                    <!-- PARTICIPATION TRACE -->
                    <div class="rounded-xl border border-emerald-500/30 bg-emerald-950/20 p-4 space-y-3">
                        <h3 class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest border-b border-emerald-500/20 pb-2">Participation Trace</h3>
                        <div class="flex flex-wrap items-center gap-x-2 gap-y-1.5 text-[9px] font-mono font-bold text-gray-400 uppercase">
                            <span class="text-white">Participant</span> <span class="text-emerald-500">→</span>
                            <span class="text-white">PO Allocation</span> <span class="text-emerald-500">→</span>
                            <span class="text-white">Production Program</span> <span class="text-emerald-500">→</span>
                            <span class="text-white">Project</span> <span class="text-emerald-500">→</span>
                            <span class="text-white">Batch</span> <span class="text-emerald-500">→</span>
                            <span class="text-gray-400">Execution</span> <span class="text-emerald-500">→</span>
                            <span class="text-gray-400">Verification</span> <span class="text-emerald-500">→</span>
                            <span class="text-gray-400">Output</span> <span class="text-emerald-500">→</span>
                            <span class="text-gray-400">Delivery</span> <span class="text-emerald-500">→</span>
                            <span class="text-gray-400">Commercial Settlement</span>
                        </div>
                    </div>

                    <div class="rounded-xl border border-white/10 bg-black/40 p-4 space-y-3 relative overflow-hidden">
                        <div class="flex items-center justify-between border-b border-white/10 pb-2">
                            <h3 class="text-xs font-bold text-emerald-400 uppercase">
                                PO Allocation Specifications
                            </h3>
                            <span class="text-[9px] text-gray-400 font-mono">FIELD VERIFICATION PHOTO</span>
                        </div>
                        <div class="h-28 rounded-lg overflow-hidden relative border border-white/10 group">
                            <img :src="'<?= $basePrefix ?>/' + ((parseInt(selectedParticipant?.id.replace(/[^0-9]/g, '')) % 10) + 1) + '.jpg'" alt="Field Verification" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                            <div class="absolute bottom-2 left-3 right-3 flex justify-between items-end text-[10px]">
                                <div>
                                    <span class="text-emerald-400 font-bold block" x-text="selectedParticipant?.program"></span>
                                    <span class="text-gray-300 text-[9px]">Verified Production Field Unit</span>
                                </div>
                                <span class="bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 px-2 py-0.5 rounded text-[8px] font-bold uppercase">Active Field</span>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-[10px] text-gray-300 pt-1">
                            <div>Production Program: <strong class="text-white block" x-text="selectedParticipant?.program"></strong></div>
                            <div>PO Allocation Unit: <strong class="text-emerald-400 block" x-text="selectedParticipant?.unit"></strong></div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-emerald-500/30 bg-[#0B1815] p-4 space-y-3">
                        <div class="flex items-center justify-between border-b border-white/10 pb-2">
                            <div>
                                <h3 class="text-xs font-bold text-white uppercase">Verified Review Record</h3>
                                <span class="text-[9px] text-gray-400 block">NOT AN INVESTMENT RATING — PARTICIPANT EXPERIENCE ONLY</span>
                            </div>
                            <span class="text-amber-400 font-bold flex items-center gap-1 text-xs" x-show="!selectedParticipant?.is_illustrative">
                                <?= $svg($ic['star'], 'w-4 h-4 fill-amber-400 text-amber-400') ?>
                                <span x-text="selectedParticipant?.stars"></span> / 5.0
                            </span>
                            <span class="text-gray-500 font-bold text-[10px] uppercase" x-show="selectedParticipant?.is_illustrative">
                                Illustrative Experience Scenario
                            </span>
                        </div>
                        <div class="text-xs text-gray-200 italic p-3 rounded bg-black/40 border border-white/5" x-text="selectedParticipant?.review"></div>
                        
                        <div x-show="selectedParticipant?.scope" class="space-y-1 pt-1">
                            <span class="text-[9px] text-gray-400 uppercase font-bold block">Review Verification Scope:</span>
                            <div class="flex flex-wrap gap-1.5">
                                <template x-for="item in (selectedParticipant?.scope || [])" :key="item">
                                    <span class="rounded bg-emerald-950/80 border border-emerald-500/30 px-2 py-0.5 text-[9px] text-emerald-300" x-text="'✓ ' + item"></span>
                                </template>
                            </div>
                        </div>
                    </div>
                </div> <!-- END RIGHT PANEL -->

            </div>
        </div> <!-- END MODAL -->
    </div> <!-- END RELATIVE Z-10 -->
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/dashboard.php';
?>