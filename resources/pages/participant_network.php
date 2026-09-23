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
    ['key' => 'NOVA', 'no' => '01', 'icon' => $ic['seed'], 'color' => 'emerald', 'label' => 'Entry Network Participant', 'threshold' => '≥ 8,000 USDT', 'desc' => 'Cumulative Participation:', 'count' => 4],
    ['key' => 'ORBIT', 'no' => '02', 'icon' => $ic['orbit'], 'color' => 'sky', 'label' => 'Established Network Participant', 'threshold' => '≥ 18,000 USDT', 'desc' => 'Cumulative Participation:', 'count' => 3],
    ['key' => 'CONSTELLATION', 'no' => '03', 'icon' => $ic['stars'], 'color' => 'purple', 'label' => 'Advanced Network Participant', 'threshold' => '≥ 28,000 USDT', 'desc' => 'Cumulative Participation:', 'count' => 5],
    ['key' => 'SOVEREIGN', 'no' => '04', 'icon' => $ic['crown'], 'color' => 'amber', 'label' => 'High-Capacity Private Participant', 'threshold' => '≥ 88,000 USDT', 'desc' => 'Cumulative Participation:', 'count' => 7],
    ['key' => 'INSTITUTIONAL', 'no' => '05', 'icon' => $ic['bank'], 'color' => 'cyan', 'label' => 'Qualified Institutional Participant', 'threshold' => 'QUALIFIED', 'desc' => 'Qualification:', 'count' => 9],
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
    // --- 1. ENTRY & PRIVATE PARTICIPANTS (NOVA & ORBIT) ---
    [
        'id' => 'NINA-P-0001', 'name' => 'Private Participant A', 'class' => 'PRIVATE', 'tier' => 'NOVA',
        'cum' => 'US$8,000', 'projects' => 1, 'active_po' => 1, 'completed' => 0, 'program' => 'North Kalimantan Palm — Demo', 'po_val' => 'US$8,000 — Simulated',
        'review' => 'The production timeline makes it easier to understand what happens after a PO allocation is confirmed.',
        'scope' => ['Production Timeline', 'PO Allocation', 'Milestone Visibility', 'Documentation'],
        'stars' => '4.8', 'badge' => 'SIMULATED PARTICIPANT', 'is_illustrative' => false
    ],
    [
        'id' => 'NINA-P-0002', 'name' => 'Private Entrepreneur B', 'class' => 'PRIVATE', 'tier' => 'NOVA',
        'cum' => 'US$8,500', 'projects' => 1, 'active_po' => 1, 'completed' => 0, 'program' => 'South Kalimantan Bio-Agriculture', 'po_val' => 'US$8,500 — Simulated',
        'review' => 'Clear operational breakdown before execution starts gives confidence in participation.',
        'scope' => ['RAB Breakdown', 'Work Orders', 'Field Status'],
        'stars' => '4.7', 'badge' => 'SIMULATED PARTICIPANT', 'is_illustrative' => false
    ],
    [
        'id' => 'NINA-P-0003', 'name' => 'Agri Investor Specialist', 'class' => 'PRIVATE', 'tier' => 'NOVA',
        'cum' => 'US$12,000', 'projects' => 2, 'active_po' => 1, 'completed' => 1, 'program' => 'North Kalimantan Palm — Demo', 'po_val' => 'US$12,000 — Simulated',
        'review' => 'First completed batch delivered exact output verification documents directly to wallet.',
        'scope' => ['Verification Documents', 'Delivery Record', 'Wallet Proof'],
        'stars' => '4.9', 'badge' => 'SIMULATED PARTICIPANT', 'is_illustrative' => false
    ],
    [
        'id' => 'NINA-P-0004', 'name' => 'Jakarta Private Office', 'class' => 'PRIVATE OFFICE', 'tier' => 'ORBIT',
        'cum' => 'US$18,000', 'projects' => 2, 'active_po' => 1, 'completed' => 1, 'program' => 'Sumatra Commercial Crops', 'po_val' => 'US$18,000 — Simulated',
        'review' => 'Well structured and transparent process gives confidence in multi-batch allocation.',
        'scope' => ['Multi-batch control', 'Audit trail', 'Yield reporting'],
        'stars' => '4.7', 'badge' => 'SIMULATED PARTICIPANT', 'is_illustrative' => false
    ],

    // --- 2. FAMILY OFFICES & PRIVATE EQUITY (ORBIT & CONSTELLATION) ---
    [
        'id' => 'NINA-P-0005', 'name' => 'Singapore Private Office', 'class' => 'PRIVATE OFFICE', 'tier' => 'ORBIT',
        'cum' => 'US$20,000', 'projects' => 3, 'active_po' => 2, 'completed' => 1, 'program' => 'Kalimantan Land Expansion', 'po_val' => 'US$20,000 — Simulated',
        'review' => 'The level of detail in the reporting and RAB line items is very helpful for our team.',
        'scope' => ['RAB line item', 'Vendor WO', 'Verification'],
        'stars' => '4.9', 'badge' => 'SIMULATED PARTICIPANT', 'is_illustrative' => false
    ],
    [
        'id' => 'NINA-P-0006', 'name' => 'Surabaya Family Venture', 'class' => 'FAMILY OFFICE', 'tier' => 'ORBIT',
        'cum' => 'US$21,500', 'projects' => 3, 'active_po' => 2, 'completed' => 1, 'program' => 'Kalimantan Land Expansion', 'po_val' => 'US$21,500 — Simulated',
        'review' => 'Direct connection between RAB line items and vendor work orders is impressive.',
        'scope' => ['RAB line item', 'Vendor WO', 'Verification'],
        'stars' => '4.8', 'badge' => 'SIMULATED PARTICIPANT', 'is_illustrative' => false
    ],
    [
        'id' => 'NINA-P-0007', 'name' => 'Asia Private Equity Fund', 'class' => 'PRIVATE EQUITY', 'tier' => 'CONSTELLATION',
        'cum' => 'US$28,000', 'projects' => 3, 'active_po' => 2, 'completed' => 1, 'program' => 'Industrial Agriculture Corridor', 'po_val' => 'US$28,000 — Simulated',
        'review' => 'The prototype connects operational controls, RAB visibility, execution verification and production documentation within one workflow.',
        'scope' => ['RAB Control', 'Work Orders', 'Execution', 'Verification'],
        'stars' => '4.8', 'badge' => 'SIMULATED USE CASE', 'is_illustrative' => false
    ],
    [
        'id' => 'NINA-P-0008', 'name' => 'Southeast Asia Alternative Fund', 'class' => 'PRIVATE EQUITY', 'tier' => 'CONSTELLATION',
        'cum' => 'US$35,000', 'projects' => 4, 'active_po' => 2, 'completed' => 2, 'program' => 'Kalimantan Infrastructure & Agri', 'po_val' => 'US$35,000 — Simulated',
        'review' => 'Verification process adds credibility to field production data and milestone releases.',
        'scope' => ['Equipment WO', 'Milestone Clearance', 'Land Dev'],
        'stars' => '4.7', 'badge' => 'SIMULATED PARTICIPANT', 'is_illustrative' => false
    ],

    // --- 3. SOVEREIGN TIER & HIGH-CAPACITY INDIVIDUALS ---
    [
        'id' => 'NINA-P-0009', 'name' => 'Southeast Asia Family Office', 'class' => 'FAMILY OFFICE', 'tier' => 'SOVEREIGN',
        'cum' => 'US$120,000', 'projects' => 6, 'active_po' => 3, 'completed' => 3, 'program' => 'North Kalimantan Palm — Demo', 'po_val' => 'US$120,000 — Simulated',
        'review' => 'The system provides a common operational view across multiple production programs while preserving project-level records.',
        'scope' => ['Multi-project visibility', 'Production allocation', 'Program monitoring', 'Verification', 'Commercial traceability'],
        'stars' => '4.9', 'badge' => 'SIMULATED PARTICIPANT', 'is_illustrative' => false
    ],
    [
        'id' => 'NINA-P-0010', 'name' => 'R. Hartono (Illustrative Private Participant)', 'class' => 'PRIVATE', 'tier' => 'SOVEREIGN',
        'cum' => 'US$125,000 — SIMULATED', 'projects' => 4, 'active_po' => 2, 'completed' => 2, 'program' => 'North Kalimantan Palm — Demo', 'po_val' => 'US$100,000 — SIMULATION ONLY',
        'public_ref' => 'Scale Reference: High-Net-Worth Private Capital / Family Business Ecosystem',
        'review' => 'High-capacity private participant simulation demonstrating individualized portfolio tracking across sovereign-scale limits.',
        'scope' => ['Individual Allocation', 'Portfolio Ledger', 'Verified Settlement'],
        'stars' => '4.9', 'badge' => 'NO REAL PARTICIPATION IMPLIED', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-P-0011', 'name' => 'J. Lim (Illustrative Private Capital Profile)', 'class' => 'PRIVATE OFFICE', 'tier' => 'SOVEREIGN',
        'cum' => 'US$250,000 — SIMULATED', 'projects' => 6, 'active_po' => 3, 'completed' => 3, 'program' => 'Regional Asset & Bio-Production', 'po_val' => 'US$250,000 — SIMULATION ONLY',
        'public_ref' => 'Scale Reference: Private Capital / Co-Founder ARA & JL Family Office Scale Reference',
        'review' => 'Illustrative profile showing how specialized Asian family office principals could manage alternative real-asset allocations through NINA.',
        'scope' => ['Real Asset Management', 'Multi-region Allocation', 'Institutional Governance'],
        'stars' => '5.0', 'badge' => 'NO REAL PARTICIPATION IMPLIED', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-P-0012', 'name' => 'Singapore Hedge Fund', 'class' => 'HEDGE FUND', 'tier' => 'SOVEREIGN',
        'cum' => 'US$98,000', 'projects' => 4, 'active_po' => 2, 'completed' => 1, 'program' => 'Logistics & Agri Supply Network', 'po_val' => 'US$98,000 — Simulated',
        'review' => 'The platform makes complex production structures and multi-vendor RABs easier to manage.',
        'scope' => ['Supply Chain', 'Transport WO', 'Commercial Delivery'],
        'stars' => '4.6', 'badge' => 'SIMULATED PARTICIPANT', 'is_illustrative' => false
    ],

    // --- 4. GLOBAL INSTITUTIONAL ASSET MANAGERS (REAL COMPANY PROFILES - ILLUSTRATIVE ONLY) ---
    [
        'id' => 'NINA-P-0013', 'name' => 'BlackRock (Illustrative Profile)', 'class' => 'ASSET MANAGER', 'tier' => 'INSTITUTIONAL',
        'cum' => 'US$2,500,000 — SIMULATION', 'projects' => 10, 'active_po' => 6, 'completed' => 4, 'program' => 'North Kalimantan Palm (NK-001 → NK-010)', 'po_val' => 'US$2,500,000 — SIMULATION ONLY',
        'public_ref' => 'Scale Reference: Top-tier global asset manager (~US$14T AUM as of Dec 31, 2025)',
        'logo' => $basePrefix . '/blackrock_logo.jpg',
        'review' => 'Illustrative example of how an institutional asset manager could review production capacity, operational controls and verified commercial output through NINA.',
        'scope' => ['Production Capacity', 'Operational Controls', 'Verified Output', 'Traceability'],
        'stars' => '4.9', 'badge' => 'NO REAL PARTICIPATION IMPLIED', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-P-0014', 'name' => 'Vanguard (Illustrative Profile)', 'class' => 'ASSET MANAGER', 'tier' => 'INSTITUTIONAL',
        'cum' => 'US$2,000,000 — SIMULATION', 'projects' => 8, 'active_po' => 5, 'completed' => 3, 'program' => 'Indonesia Palm Production Program', 'po_val' => 'US$2,000,000 — SIMULATION ONLY',
        'public_ref' => 'Scale Reference: Leading global investment management company',
        'logo' => $basePrefix . '/vanguard_logo.jpg',
        'review' => 'Illustrative architecture framework for index and asset allocation managers inspecting standardized productive asset protocols.',
        'scope' => ['Standardized Protocol', 'Asset Allocation', 'Verification Ledger'],
        'stars' => '4.8', 'badge' => 'NO REAL PARTICIPATION IMPLIED', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-P-0015', 'name' => 'Blackstone (Illustrative Profile)', 'class' => 'ASSET MANAGER', 'tier' => 'INSTITUTIONAL',
        'cum' => 'US$3,000,000 — SIMULATION', 'projects' => 12, 'active_po' => 7, 'completed' => 5, 'program' => 'Demo Multi-Region Production Program', 'po_val' => 'US$3,000,000 — SIMULATION ONLY',
        'public_ref' => 'Scale Reference: Leading alternative asset manager (~US$1.3T AUM in 2025 release)',
        'logo' => $basePrefix . '/blackstone_logo.jpg',
        'review' => 'Illustrative profile evaluating real-asset operational transparency, RAB control, and third-party vendor execution verification.',
        'scope' => ['Real-Asset Transparency', 'RAB Control', 'Vendor Execution'],
        'stars' => '5.0', 'badge' => 'NO REAL PARTICIPATION IMPLIED', 'is_illustrative' => true
    ],

    // --- 5. INDONESIA INSTITUTIONAL & SOVEREIGN ---
    [
        'id' => 'NINA-P-0016', 'name' => 'Danantara (Illustrative Sovereign Entity)', 'class' => 'PUBLIC INSTITUTION', 'tier' => 'INSTITUTIONAL',
        'cum' => 'US$10,000,000 — SIMULATION', 'projects' => 15, 'active_po' => 10, 'completed' => 5, 'program' => 'National Productive Asset Program', 'po_val' => 'US$10,000,000 — SIMULATION ONLY',
        'public_ref' => 'Scale Reference: Sovereign / State-Scale Allocation Entity',
        'review' => 'Demonstrates state-scale sovereign wealth management protocols, regional batch distribution, and national economic impact tracking.',
        'scope' => ['Sovereign Allocation', 'Regional Batch Distribution', 'National Impact'],
        'stars' => '5.0', 'badge' => 'NO REAL PARTICIPATION IMPLIED', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-P-0017', 'name' => 'Indonesian Banking Group (Illustrative)', 'class' => 'FINANCIAL INSTITUTION', 'tier' => 'INSTITUTIONAL',
        'cum' => 'US$5,000,000 — SIMULATION', 'projects' => 9, 'active_po' => 6, 'completed' => 3, 'program' => 'Commercial Agriculture Financing Facility', 'po_val' => 'US$5,000,000 — SIMULATION ONLY',
        'public_ref' => 'Scale Reference: Major regional commercial bank',
        'review' => 'Illustrates how financial institutions integrate custodial wallet settlement and verified warehouse delivery receipts.',
        'scope' => ['Custodial Wallet', 'Warehouse Receipt', 'Credit Verification'],
        'stars' => '4.8', 'badge' => 'SIMULATION ONLY', 'is_illustrative' => true
    ],

    // --- 6. INDONESIAN CONGLOMERATE GROUPS (ILLUSTRATIVE PROFILES) ---
    [
        'id' => 'NINA-P-0018', 'name' => 'Hartono Family / Djarum Ecosystem (Illustrative)', 'class' => 'CORPORATE', 'tier' => 'INSTITUTIONAL',
        'cum' => 'US$5,000,000 — SIMULATION', 'projects' => 8, 'active_po' => 5, 'completed' => 3, 'program' => 'Regional Agro-Industrial Corridor', 'po_val' => 'US$5,000,000 — SIMULATION ONLY',
        'public_ref' => 'Scale Reference: Large Indonesian Business Group Ecosystem',
        'review' => 'Illustrative profile evaluating multi-sector industrial crop off-take and automated vendor disbursement.',
        'scope' => ['Multi-sector Offtake', 'Corporate Treasury', 'Automated RAB'],
        'stars' => '4.9', 'badge' => 'SIMULATION ONLY', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-P-0019', 'name' => 'Salim Group-Related Ecosystem (Illustrative)', 'class' => 'CORPORATE', 'tier' => 'INSTITUTIONAL',
        'cum' => 'US$5,000,000 — SIMULATION', 'projects' => 8, 'active_po' => 4, 'completed' => 4, 'program' => 'Agri-Food & Plantation Network', 'po_val' => 'US$5,000,000 — SIMULATION ONLY',
        'public_ref' => 'Scale Reference: Major Integrated Food & Agri Conglomerate',
        'review' => 'Demonstrates end-to-end integration between certified seed suppliers, fertilizer vendors and off-take processing facilities.',
        'scope' => ['Integrated Food Supply', 'Certified Seeds', 'Processing Facility'],
        'stars' => '4.9', 'badge' => 'SIMULATION ONLY', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-P-0020', 'name' => 'Muria Investama (BCA Group-Related)', 'class' => 'CORPORATE', 'tier' => 'INSTITUTIONAL',
        'cum' => 'US$2,500,000 — SIMULATION', 'projects' => 7, 'active_po' => 4, 'completed' => 3, 'program' => 'Agri-Tech & Land Development Program', 'po_val' => 'US$2,500,000 — SIMULATION ONLY',
        'public_ref' => 'Scale Reference: Corporate Investment Arm',
        'review' => 'Demonstrates strategic corporate investment allocation, multi-vendor RAB monitoring, and yield settlement.',
        'scope' => ['Corporate Treasury', 'Vendor RAB', 'Yield Settlement'],
        'stars' => '4.9', 'badge' => 'SIMULATION ONLY', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-P-0021', 'name' => 'Tahir Family / Mayapada Ecosystem (Illustrative)', 'class' => 'FAMILY OFFICE', 'tier' => 'INSTITUTIONAL',
        'cum' => 'US$3,000,000 — SIMULATION', 'projects' => 6, 'active_po' => 3, 'completed' => 3, 'program' => 'Sustainable Agro-Forestry Facility', 'po_val' => 'US$3,000,000 — SIMULATION ONLY',
        'public_ref' => 'Scale Reference: Family Office / Financial Conglomerate',
        'review' => 'Shows how impact capital and sustainable production goals can be audited via real-time satellite GIS verification.',
        'scope' => ['Impact Metrics', 'GIS Verification', 'ESG Compliance'],
        'stars' => '4.8', 'badge' => 'SIMULATION ONLY', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-P-0022', 'name' => 'Riady Family / Lippo Ecosystem (Illustrative)', 'class' => 'CORPORATE', 'tier' => 'INSTITUTIONAL',
        'cum' => 'US$4,000,000 — SIMULATION', 'projects' => 7, 'active_po' => 4, 'completed' => 3, 'program' => 'Regional Land & Infrastructure Development', 'po_val' => 'US$4,000,000 — SIMULATION ONLY',
        'public_ref' => 'Scale Reference: Real Estate & Conglomerate Group',
        'review' => 'Demonstrates how physical asset development and commercial off-take agreements are linked within one operating layer.',
        'scope' => ['Asset Clearance', 'Commercial Offtake', 'Infrastructure RAB'],
        'stars' => '4.7', 'badge' => 'SIMULATION ONLY', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-P-0023', 'name' => 'Saratoga / Soeryadjaya Ecosystem (Illustrative)', 'class' => 'CORPORATE', 'tier' => 'INSTITUTIONAL',
        'cum' => 'US$4,000,000 — SIMULATION', 'projects' => 8, 'active_po' => 5, 'completed' => 3, 'program' => 'Active Bio-Energy & Plantation Corridor', 'po_val' => 'US$4,000,000 — SIMULATION ONLY',
        'public_ref' => 'Scale Reference: Active Investment & Natural Resources Group',
        'review' => 'Evaluates real-asset operational transparency, RAB control, and third-party vendor execution verification.',
        'scope' => ['Active Investment', 'Bio-Energy', 'Execution Audit'],
        'stars' => '4.9', 'badge' => 'SIMULATION ONLY', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-P-0024', 'name' => 'Artha Graha-Related Business Ecosystem', 'class' => 'CORPORATE', 'tier' => 'INSTITUTIONAL',
        'cum' => 'US$3,000,000 — SIMULATION', 'projects' => 6, 'active_po' => 3, 'completed' => 3, 'program' => 'Maritime & Agro Infrastructure Program', 'po_val' => 'US$3,000,000 — SIMULATION ONLY',
        'public_ref' => 'Scale Reference: Regional Corporate Capital & Agro-Infrastructure',
        'review' => 'Demonstrates large-scale land infrastructure preparation, logistics integration, and verified output.',
        'scope' => ['Infrastructure', 'Logistics Integration', 'Land Preparation'],
        'stars' => '4.8', 'badge' => 'SIMULATION ONLY', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-P-0025', 'name' => 'Lion Air-Related Business Ecosystem (Illustrative)', 'class' => 'CORPORATE', 'tier' => 'INSTITUTIONAL',
        'cum' => 'US$2,000,000 — SIMULATION', 'projects' => 5, 'active_po' => 3, 'completed' => 2, 'program' => 'Logistics & Cargo Support Facility', 'po_val' => 'US$2,000,000 — SIMULATION ONLY',
        'public_ref' => 'Scale Reference: National Logistics & Transport Business Group',
        'review' => 'Demonstrates commercial transport off-take contracts connected directly to field-level execution work orders.',
        'scope' => ['Cargo Support', 'Transport Offtake', 'Work Orders'],
        'stars' => '4.7', 'badge' => 'SIMULATION ONLY', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-P-0026', 'name' => 'Santini-Related Business Ecosystem (Illustrative)', 'class' => 'CORPORATE', 'tier' => 'INSTITUTIONAL',
        'cum' => 'US$2,000,000 — SIMULATION', 'projects' => 4, 'active_po' => 2, 'completed' => 2, 'program' => 'Regional Enterprise Supply Program', 'po_val' => 'US$2,000,000 — SIMULATION ONLY',
        'public_ref' => 'Scale Reference: Family Business & Corporate Holdings',
        'review' => 'Shows how family corporate holdings handle multi-batch PO allocations across regional partners.',
        'scope' => ['Corporate Holdings', 'Enterprise Supply', 'Batch Tracking'],
        'stars' => '4.8', 'badge' => 'SIMULATION ONLY', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-P-0027', 'name' => 'Indonesian Conglomerate Investment Office', 'class' => 'CORPORATE', 'tier' => 'INSTITUTIONAL',
        'cum' => 'US$7,500,000 — SIMULATION', 'projects' => 11, 'active_po' => 7, 'completed' => 4, 'program' => 'Integrated Agro-Industrial Complex', 'po_val' => 'US$7,500,000 — SIMULATION ONLY',
        'public_ref' => 'Scale Reference: Regional Corporate Capital',
        'review' => 'Shows how conglomerate treasury operations handle multi-batch PO allocations across regional land partners.',
        'scope' => ['Treasury Allocation', 'Regional Land Partners', 'Batch Tracking'],
        'stars' => '4.8', 'badge' => 'SIMULATION ONLY', 'is_illustrative' => true
    ],
    [
        'id' => 'NINA-P-0028', 'name' => 'Indonesian Industrial Group (Illustrative)', 'class' => 'CORPORATE', 'tier' => 'INSTITUTIONAL',
        'cum' => 'US$4,000,000 — SIMULATION', 'projects' => 8, 'active_po' => 5, 'completed' => 3, 'program' => 'Strategic Industrial Crop Program', 'po_val' => 'US$4,000,000 — SIMULATION ONLY',
        'public_ref' => 'Scale Reference: Strategic Industrial Operator',
        'review' => 'Demonstrates industrial processing off-take contracts connected directly to field-level execution work orders.',
        'scope' => ['Processing Offtake', 'Work Orders', 'Commercial Settlement'],
        'stars' => '4.7', 'badge' => 'SIMULATION ONLY', 'is_illustrative' => true
    ],
];

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
                        <p class="text-[11px] text-gray-400 mt-1 leading-relaxed">Measures cumulative participation history across confirmed PO allocations.</p>
                    </div>
                </div>
                <div class="<?= $card ?> p-4 flex items-start gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-sky-500/40 bg-sky-950 text-sky-300">
                        <?= $svg($ic['building'], 'w-5 h-5') ?>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-white uppercase">Entity Class</div>
                        <p class="text-[11px] text-gray-400 mt-1 leading-relaxed">Identifies who the participant is (Private, Family Office, Asset Manager, etc.).</p>
                    </div>
                </div>
                <div class="<?= $card ?> p-4 flex items-start gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-amber-500/40 bg-amber-950 text-amber-300">
                        <?= $svg($ic['reputation'], 'w-5 h-5') ?>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-white uppercase">Reputation</div>
                        <p class="text-[11px] text-gray-400 mt-1 leading-relaxed">Measures actual verified performance / engagement history.</p>
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

                            <div class="flex items-center gap-3 text-[9px] font-mono text-gray-300">
                                <span><?= $p['projects'] ?> Project<?= $p['projects'] == 1 ? '' : 's' ?></span>
                                <span class="text-gray-600">•</span>
                                <span><?= $p['active_po'] ?> Allocation<?= $p['active_po'] == 1 ? '' : 's' ?></span>
                                <span class="text-gray-600">•</span>
                                <span><?= $p['completed'] ?> Completed</span>
                            </div>

                            <div class="rounded-lg bg-white/[0.03] border border-white/10 p-2.5">
                                <p class="text-[11px] text-gray-300 italic leading-relaxed">
                                    "<?= $e($p['review']) ?>"
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-2 border-t border-white/10 text-[8px] font-mono">
                            <span class="text-gray-500 uppercase">● SIMULATED PARTICIPANT</span>
                            <span class="text-amber-400 font-bold flex items-center gap-1">
                                <?= $svg($ic['star'], 'w-3 h-3 fill-amber-400 text-amber-400') ?> <?= $e($p['stars']) ?>
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
                                <span class="text-gray-400 shrink-0">Cum. Participation:</span>
                                <strong class="text-white truncate" x-text="selectedParticipant?.cum"></strong>
                            </div>
                            <div class="flex justify-between items-center border-b border-white/10 pb-1.5 gap-2">
                                <span class="text-gray-400 shrink-0">Review Rating:</span>
                                <strong class="text-amber-400 flex items-center gap-1 shrink-0">
                                    ★ <span x-text="selectedParticipant?.stars"></span> / 5.0
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
                            <span class="text-[9px] text-gray-400 block uppercase">Cumulative Participation</span>
                            <strong class="text-white text-sm" x-text="selectedParticipant?.cum"></strong>
                        </div>
                        <div class="p-3 rounded-lg bg-white/5 border border-white/10">
                            <span class="text-[9px] text-gray-400 block uppercase">Identity Status</span>
                            <strong class="text-cyan-300 text-sm" x-text="selectedParticipant?.badge"></strong>
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
                            <div>Simulated PO Allocation: <strong class="text-emerald-400 block" x-text="selectedParticipant?.po_val"></strong></div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-emerald-500/30 bg-[#0B1815] p-4 space-y-3">
                        <div class="flex items-center justify-between border-b border-white/10 pb-2">
                            <div>
                                <h3 class="text-xs font-bold text-white uppercase">Verified Review Record</h3>
                                <span class="text-[9px] text-gray-400 block">NOT AN INVESTMENT RATING — PARTICIPANT EXPERIENCE ONLY</span>
                            </div>
                            <span class="text-amber-400 font-bold flex items-center gap-1 text-xs">
                                <?= $svg($ic['star'], 'w-4 h-4 fill-amber-400 text-amber-400') ?>
                                <span x-text="selectedParticipant?.stars"></span> / 5.0
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

                    <!-- Experience Score Breakdown -->
                    <div class="rounded-xl border border-white/10 bg-black/30 p-4 space-y-2">
                        <h3 class="text-xs font-bold text-gray-300 uppercase border-b border-white/10 pb-1.5">
                            Operational Experience Rating Breakdown
                        </h3>
                        <div class="grid grid-cols-2 gap-2 text-[10px] font-mono">
                            <div class="flex justify-between border-b border-white/5 py-1">
                                <span class="text-gray-400">Operational Visibility</span>
                                <strong class="text-emerald-400">4.9 / 5</strong>
                            </div>
                            <div class="flex justify-between border-b border-white/5 py-1">
                                <span class="text-gray-400">Documentation</span>
                                <strong class="text-emerald-400">4.8 / 5</strong>
                            </div>
                            <div class="flex justify-between border-b border-white/5 py-1">
                                <span class="text-gray-400">Milestone Clarity</span>
                                <strong class="text-emerald-400">4.7 / 5</strong>
                            </div>
                            <div class="flex justify-between border-b border-white/5 py-1">
                                <span class="text-gray-400">Field Evidence</span>
                                <strong class="text-emerald-400">4.8 / 5</strong>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-lg bg-emerald-950/40 border border-emerald-500/30 p-3 text-[10px] space-y-1.5 text-emerald-200">
                        <div class="font-bold uppercase">Review Eligibility Verified:</div>
                        <div class="flex flex-wrap gap-2 text-[9px]">
                            <span>✓ Allocation Confirmed</span>
                            <span>✓ Production Completed</span>
                            <span>✓ Batch Verified</span>
                            <span>✓ Review Eligible</span>
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