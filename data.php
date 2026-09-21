<?php

return [
    'system_constants' => [
        'batch_area_ha' => 100,
        'indicative_budget_per_batch_usdt' => 880000, // 880.000 usdt
        'indicative_cost_per_ha_usdt' => 8800, // 8.800 usdt/ha
        'min_po_allocation_usdt' => 8000, // 8.000 usdt
        'total_allocation_units_per_batch' => 110, // 110 minimum PO allocation units
        'total_seats_per_batch' => 110, // backward compatibility
        'simulation_rate_idr_per_usdt' => 17800, // Rp17.800 / usdt
        'demo_demand_ha' => 1000,
        'demo_batches_count' => 10,
        'demo_production_requirement_usdt' => 8800000, // 8.800.000 usdt
        'target_24m_ha' => 10000,
        'target_24m_batches' => 100,
        'target_24m_modeled_value_usdt' => 88000000, // 88.000.000 usdt
        'target_24m_service_fee_pct' => 3,
        'target_24m_fee_opportunity_usdt' => 2640000, // 2.640.000 usdt
        'contract_horizon_years' => 20,
        'development_ramp_up_years' => 5,
        'commercial_delivery_years' => 15,

        // Operational yield baseline (100 HA standard batch)
        'ffb_yield_benchmark_tbs_ha_yr' => 18.03,
        'ffb_total_annual_tbs' => 1803,
        'oer_assumption_pct' => 20,
        'cpo_annual_mt' => 360.6,
        'cpo_annual_liters' => 405849,

        // Legacy compatibility keys
        'indicative_budget_per_batch_idr' => 880000,
        'indicative_cost_per_ha_idr' => 8800,
        'min_po_allocation_idr' => 8000,
        'demo_production_requirement_idr' => 8800000,
        'target_24m_modeled_value_idr' => 88000000,
        'target_24m_fee_opportunity_idr' => 2640000,
    ],
    'demo_demands' => [
        [
            'id' => 'DR-2026-001',
            'buyer' => 'Demo Offtake Buyer — Sania Corp',
            'status' => 'Demo / Example Requirement',
            'product' => 'Palm Oil Product (Bio-Extraction)',
            'required_capacity_ha' => 1000,
            'contract_horizon_years' => 20,
            'development_years' => 5,
            'commercial_delivery_years' => 15,
            'preferred_region' => 'North & South Kalimantan',
            'planting_density' => '143 trees / ha',
            'verification_requirements' => [
                'Verified Land Identity',
                'Verified Production Partner',
                'Certified Seed Source',
                'Production Traceability',
                'Commercial Traceability',
                'Audit Trail'
            ]
        ]
    ],
    'projects' => [
        [
            'id' => 'north-kalimantan-palm',
            'name' => 'North Kalimantan Palm Project',
            'location' => 'North Kalimantan, Indonesia',
            'asset_type' => 'Palm Plantation',
            'category' => 'Agriculture',
            'categories' => ['All', 'Active Batches', 'Agriculture'],
            'area' => 300,
            'mapped_capacity_ha' => 300,
            'batch_structure' => '3 Executable Batches (NK-001 to NK-003)',
            'status' => 'Mapped Capacity / Verified',
            'verification' => 82,
            'modeled_budget_usdt' => 2640000,
            'land_status' => 'GIS Boundary Surveyed',
            'seed_status' => 'Certified High-Yield Seedlings',
            'partner_status' => 'Verified Land Partner (Mitra Lahan)',
            'image' => '4.jpg',
        ],
        [
            'id' => 'south-kalimantan-palm',
            'name' => 'South Kalimantan Palm Cluster',
            'location' => 'South Kalimantan, Indonesia',
            'asset_type' => 'Sustainable Plantation',
            'category' => 'Agriculture',
            'categories' => ['All', 'Active Batches', 'Agriculture'],
            'area' => 700,
            'mapped_capacity_ha' => 700,
            'batch_structure' => '7 Executable Batches (SK-001 to SK-007)',
            'status' => 'Mapped Capacity / Verified',
            'verification' => 94,
            'modeled_budget_usdt' => 6160000,
            'land_status' => 'GIS Boundary Verified',
            'seed_status' => 'Certified Seedlings Allocated',
            'partner_status' => 'Verified Land Partner (Mitra Lahan)',
            'image' => '2.jpg',
        ],
        [
            'id' => 'central-kalimantan-forest',
            'name' => 'Central Kalimantan Eco Forest Reserve',
            'location' => 'Central Kalimantan, Indonesia',
            'asset_type' => 'Forest Concession',
            'category' => 'Forestry',
            'categories' => ['All', 'Forestry'],
            'area' => 1200,
            'mapped_capacity_ha' => 1200,
            'batch_structure' => '12 Executable Batches (100 HA Standard)',
            'status' => 'Mapped Capacity',
            'verification' => 78,
            'modeled_budget_usdt' => 10560000,
            'land_status' => 'Concession Surveyed',
            'seed_status' => 'Eco Species Native Nursery',
            'partner_status' => 'State & Community Partner',
            'image' => '3.jpg',
        ],
        [
            'id' => 'mahakam-hydro-infra',
            'name' => 'Mahakam Water & Production Infrastructure',
            'location' => 'East Kalimantan, Indonesia',
            'asset_type' => 'Water & Irrigation',
            'category' => 'Infrastructure',
            'categories' => ['All', 'Infrastructure'],
            'area' => 500,
            'mapped_capacity_ha' => 500,
            'batch_structure' => '5 Executable Support Batches',
            'status' => 'Mapped Capacity',
            'verification' => 88,
            'modeled_budget_usdt' => 4400000,
            'land_status' => 'Hydro Survey Complete',
            'seed_status' => 'N/A — Infrastructure Unit',
            'partner_status' => 'Regional Vendor Partner',
            'image' => '5.jpg',
        ],
        [
            'id' => 'papua-timber-reserve',
            'name' => 'West Papua Certified Timber Zone',
            'location' => 'West Papua, Indonesia',
            'asset_type' => 'Natural Forestry',
            'category' => 'Forestry',
            'categories' => ['All', 'Forestry'],
            'area' => 1500,
            'mapped_capacity_ha' => 1500,
            'batch_structure' => '15 Executable Batches',
            'status' => 'Mapped Capacity',
            'verification' => 91,
            'modeled_budget_usdt' => 13200000,
            'land_status' => 'Forest Cadastre Verified',
            'seed_status' => 'Natural Regeneration Certified',
            'partner_status' => 'Customary Land Partner',
            'image' => '6.jpg',
        ],
        [
            'id' => 'sulawesi-agri-park',
            'name' => 'South Sulawesi Agro Park',
            'location' => 'South Sulawesi, Indonesia',
            'asset_type' => 'Multi-Crop Agriculture',
            'category' => 'Agriculture',
            'categories' => ['All', 'Agriculture'],
            'area' => 800,
            'mapped_capacity_ha' => 800,
            'batch_structure' => '8 Executable Batches',
            'status' => 'Mapped Capacity',
            'verification' => 75,
            'modeled_budget_usdt' => 7040000,
            'land_status' => 'GIS Cadastre Complete',
            'seed_status' => 'Multi-Crop High Yield Certified',
            'partner_status' => 'Cooperative Land Partner',
            'image' => '7.jpg',
        ],
        [
            'id' => 'kaltim-green-port',
            'name' => 'Kaltim Logistics & Offtake Processing Hub',
            'location' => 'East Kalimantan, Indonesia',
            'asset_type' => 'Processing & Logistics Hub',
            'category' => 'Infrastructure',
            'categories' => ['All', 'Infrastructure'],
            'area' => 200,
            'mapped_capacity_ha' => 200,
            'batch_structure' => '2 Processing Batches',
            'status' => 'Mapped Capacity',
            'verification' => 96,
            'modeled_budget_usdt' => 1760000,
            'land_status' => 'Port & Terminal Permitted',
            'seed_status' => 'N/A — Offtake Hub',
            'partner_status' => 'Logistics Vendor Partner',
            'image' => '8.jpg',
        ],
    ],

    'overview' => [
        'asset_area' => 4000,
        'development_progress' => 68,
        'verification' => 82,
        'capital_required' => 12500000,
        'capital_committed' => 6800000,
        'projected_output' => 12500,
        'timeline' => [
            ['year' => 2022, 'event' => 'Land Identification'],
            ['year' => 2023, 'event' => 'Initial Survey'],
            ['year' => 2024, 'event' => 'Development Planning'],
            ['year' => 2025, 'event' => 'Infrastructure Development'],
            ['year' => 2026, 'event' => 'Plantation Development'],
            ['year' => 2027, 'event' => 'Operational Expansion'],
        ],
        'status_progress' => [
            ['name' => 'Development', 'percentage' => 68],
            ['name' => 'Infrastructure', 'percentage' => 64],
            ['name' => 'Plantation', 'percentage' => 72],
            ['name' => 'Verification', 'percentage' => 82],
        ]
    ],

    'asset' => [
        'total_area' => 4000,
        'cultivated' => 2850,
        'development' => 750,
        'reserved' => 400,
        'survey_coverage' => 96,
        'boundary_verification' => 91,
        'last_review' => '2026-08-18',
    ],

    'parcels' => [
        ['id' => 'A-001', 'area' => 42.6, 'status' => 'Cultivated', 'planted' => 2021, 'row' => 0, 'col' => 0],
        ['id' => 'A-002', 'area' => 38.5, 'status' => 'Cultivated', 'planted' => 2021, 'row' => 0, 'col' => 1],
        ['id' => 'A-003', 'area' => 45.2, 'status' => 'Cultivated', 'planted' => 2021, 'row' => 0, 'col' => 2],
        ['id' => 'A-004', 'area' => 41.8, 'status' => 'Cultivated', 'planted' => 2021, 'row' => 0, 'col' => 3],
        ['id' => 'A-005', 'area' => 39.1, 'status' => 'Cultivated', 'planted' => 2021, 'row' => 1, 'col' => 0],
        ['id' => 'A-006', 'area' => 43.5, 'status' => 'Developing', 'planted' => 2024, 'row' => 1, 'col' => 1],
        ['id' => 'A-007', 'area' => 40.2, 'status' => 'Developing', 'planted' => 2024, 'row' => 1, 'col' => 2],
        ['id' => 'A-008', 'area' => 37.9, 'status' => 'Reserved', 'planted' => null, 'row' => 1, 'col' => 3],
        ['id' => 'A-009', 'area' => 44.1, 'status' => 'Cultivated', 'planted' => 2021, 'row' => 2, 'col' => 0],
        ['id' => 'A-010', 'area' => 41.3, 'status' => 'Cultivated', 'planted' => 2021, 'row' => 2, 'col' => 1],
        ['id' => 'A-011', 'area' => 42.7, 'status' => 'Developing', 'planted' => 2024, 'row' => 2, 'col' => 2],
        ['id' => 'A-012', 'area' => 39.8, 'status' => 'Cultivated', 'planted' => 2021, 'row' => 2, 'col' => 3],
        ['id' => 'A-013', 'area' => 43.2, 'status' => 'Cultivated', 'planted' => 2021, 'row' => 3, 'col' => 0],
        ['id' => 'A-014', 'area' => 40.6, 'status' => 'Developing', 'planted' => 2024, 'row' => 3, 'col' => 1],
        ['id' => 'A-015', 'area' => 41.9, 'status' => 'Reserved', 'planted' => null, 'row' => 3, 'col' => 2],
        ['id' => 'A-016', 'area' => 38.4, 'status' => 'Cultivated', 'planted' => 2021, 'row' => 3, 'col' => 3],
    ],

    'operations' => [
        ['activity' => 'Land Preparation', 'area' => 120, 'status' => 'Completed', 'date' => '2026-08-12', 'reference' => 'OPS-00182', 'contractor' => 'Local Operations Team'],
        ['activity' => 'Road Development', 'area' => 8.4, 'status' => 'In Progress', 'date' => '2026-08-18', 'reference' => 'OPS-00194', 'contractor' => 'Infrastructure Corp'],
        ['activity' => 'Planting', 'area' => 85, 'status' => 'Completed', 'date' => '2026-08-22', 'reference' => 'OPS-00201', 'contractor' => 'Planting Services'],
        ['activity' => 'Drainage', 'area' => 4.2, 'status' => 'In Progress', 'date' => '2026-08-27', 'reference' => 'OPS-00216', 'contractor' => 'Drainage Solutions'],
        ['activity' => 'Maintenance', 'area' => 200, 'status' => 'Completed', 'date' => '2026-08-30', 'reference' => 'OPS-00225', 'contractor' => 'Maintenance Team'],
    ],

    'operations_metrics' => [
        ['name' => 'Planting Progress', 'percentage' => 78],
        ['name' => 'Maintenance', 'percentage' => 91],
        ['name' => 'Road Infrastructure', 'percentage' => 64],
        ['name' => 'Drainage', 'percentage' => 83],
        ['name' => 'Harvest Readiness', 'percentage' => 71],
    ],

    'verification' => [
        ['item' => 'Land Identity', 'status' => 'Verified', 'method' => 'Document Review', 'date' => '2026-08-10', 'reference' => 'VER-2026-00401'],
        ['item' => 'Land Survey', 'status' => 'Verified', 'method' => 'Independent Survey', 'date' => '2026-08-18', 'reference' => 'SUR-2026-00421'],
        ['item' => 'Ownership / Rights', 'status' => 'Verified', 'method' => 'Legal Review', 'date' => '2026-08-15', 'reference' => 'LEG-2026-00512'],
        ['item' => 'Legal Documents', 'status' => 'Verified', 'method' => 'Document Audit', 'date' => '2026-08-16', 'reference' => 'DOC-2026-00623'],
        ['item' => 'Geographic Boundary', 'status' => 'Verified', 'method' => 'GIS Analysis', 'date' => '2026-08-17', 'reference' => 'GIS-2026-00734'],
        ['item' => 'Environmental Assessment', 'status' => 'Pending', 'method' => 'Field Assessment', 'date' => null, 'reference' => 'ENV-2026-PENDING'],
        ['item' => 'Asset Inspection', 'status' => 'Verified', 'method' => 'Physical Inspection', 'date' => '2026-08-19', 'reference' => 'INS-2026-00845'],
    ],

    'capital' => [
        'project_value' => 32000000,
        'capital_required' => 24000000,
        'capital_committed' => 16500000,
        'remaining_requirement' => 7500000,
        'allocation' => [
            ['category' => 'Development', 'amount' => 8000000],
            ['category' => 'Operations', 'amount' => 5000000],
            ['category' => 'Infrastructure', 'amount' => 7000000],
            ['category' => 'Reserve', 'amount' => 4000000],
        ]
    ],

    'distribution' => [
        'gross_revenue' => 12400000,
        'operating_cost' => 4100000,
        'maintenance' => 800000,
        'reserve' => 500000,
        'net_distributable' => 7000000,
        'illustrative_distribution' => 6200000,
        'revenue_history' => [
            ['year' => 2024, 'amount' => 3200000],
            ['year' => 2025, 'amount' => 5700000],
            ['year' => 2026, 'amount' => 7000000],
            ['year' => 2027, 'amount' => 8400000],
        ]
    ],

    'esg' => [
        'land_management' => 420,
        'protected_area' => 180,
        'reforestation' => 2400,
        'carbon_potential' => 87,
        'water_management' => 87,
        'environmental' => [
            ['name' => 'Land Management', 'value' => 87],
            ['name' => 'Water Management', 'value' => 87],
            ['name' => 'Biodiversity', 'value' => 78],
            ['name' => 'Carbon Potential', 'value' => 85],
            ['name' => 'Reforestation', 'value' => 92],
        ],
        'social' => [
            ['name' => 'Worker Safety', 'value' => 95],
            ['name' => 'Local Employment', 'value' => 240],
            ['name' => 'Community Programs', 'value' => 5],
            ['name' => 'Training Hours', 'value' => 320],
        ],
        'governance' => [
            ['name' => 'Verification', 'value' => 82],
            ['name' => 'Documentation', 'value' => 94],
            ['name' => 'Audit Trail', 'value' => 100],
            ['name' => 'Operational Controls', 'value' => 100],
        ]
    ],

    'documents' => [
        'Legal' => [
            ['name' => 'Land Rights Summary.pdf', 'reference' => 'DOC-LEG-001', 'size' => '2.1 MB', 'date' => '2026-08-10'],
            ['name' => 'Ownership Structure.pdf', 'reference' => 'DOC-LEG-002', 'size' => '1.8 MB', 'date' => '2026-08-12'],
            ['name' => 'Legal Review.pdf', 'reference' => 'DOC-LEG-003', 'size' => '3.4 MB', 'date' => '2026-08-15'],
        ],
        'Survey' => [
            ['name' => 'Land Survey 2026.pdf', 'reference' => 'DOC-SUR-001', 'size' => '5.2 MB', 'date' => '2026-08-18'],
            ['name' => 'Boundary Report.pdf', 'reference' => 'DOC-SUR-002', 'size' => '2.9 MB', 'date' => '2026-08-17'],
            ['name' => 'GIS Reference.pdf', 'reference' => 'DOC-SUR-003', 'size' => '4.1 MB', 'date' => '2026-08-19'],
        ],
        'Operations' => [
            ['name' => 'Development Plan.pdf', 'reference' => 'DOC-OPS-001', 'size' => '3.6 MB', 'date' => '2026-08-01'],
            ['name' => 'Operations Report.pdf', 'reference' => 'DOC-OPS-002', 'size' => '2.4 MB', 'date' => '2026-08-25'],
            ['name' => 'Infrastructure Plan.pdf', 'reference' => 'DOC-OPS-003', 'size' => '4.2 MB', 'date' => '2026-08-05'],
        ],
        'ESG' => [
            ['name' => 'Environmental Assessment.pdf', 'reference' => 'DOC-ESG-001', 'size' => '6.1 MB', 'date' => '2026-08-20'],
            ['name' => 'ESG Assessment.pdf', 'reference' => 'DOC-ESG-002', 'size' => '3.8 MB', 'date' => '2026-08-22'],
        ],
        'Financial' => [
            ['name' => 'Financial Projections.pdf', 'reference' => 'DOC-FIN-001', 'size' => '2.7 MB', 'date' => '2026-08-14'],
            ['name' => 'Allocation Report.pdf', 'reference' => 'DOC-FIN-002', 'size' => '1.9 MB', 'date' => '2026-08-16'],
        ],
    ],

    'audit' => [
        ['date' => '2026-09-18', 'event' => 'Land Survey Updated', 'category' => 'Asset Update', 'reference' => 'AUD-2026-001'],
        ['date' => '2026-09-16', 'event' => 'Capital Allocation Updated', 'category' => 'Financial Update', 'reference' => 'AUD-2026-002'],
        ['date' => '2026-09-14', 'event' => 'ESG Assessment Added', 'category' => 'ESG Update', 'reference' => 'AUD-2026-003'],
        ['date' => '2026-09-12', 'event' => 'Parcel A-023 Verified', 'category' => 'Asset Verification', 'reference' => 'VER-2026-00912'],
        ['date' => '2026-09-08', 'event' => 'Operations Report Submitted', 'category' => 'Operations', 'reference' => 'OPS-2026-00445'],
        ['date' => '2026-09-05', 'event' => 'Project Status Changed to Operational', 'category' => 'Status Change', 'reference' => 'PRJ-2026-00156'],
    ]
];
