# KALLANI — Operating System for Productive Natural Assets

A high-fidelity interactive MVP/prototype demonstrating a unified operating layer for managing productive physical assets.

## Overview

Kallani is a demonstration platform that showcases how to connect physical assets to operations, verification, capital allocation, revenue distribution, ESG metrics, and auditability through an institutional-grade operating system.

**Important:** This is a DEMO environment with simulated data. All project information, financial numbers, operational metrics, documents, verification records, ESG metrics, and audit events are illustrative and for demonstration purposes only.

## Project Structure

```
kallani/
├── public/                 # Web root
│   ├── index.php          # Main router
│   ├── css/
│   │   └── style.css      # Tailwind + custom styles
│   ├── js/
│   │   └── app.js         # JavaScript utilities
│   └── assets/            # Images, icons
├── resources/views/
│   ├── layouts/
│   │   └── app.php        # Main layout template
│   ├── components/        # Reusable components (future)
│   └── pages/
│       ├── landing.php
│       ├── explore.php
│       └── project/       # Project detail pages
├── config/
│   └── data.php           # All simulated data
├── docker-compose.yml     # Docker configuration
├── Dockerfile             # PHP container setup
└── README.md              # This file
```

## Quick Start

### Local Development (PHP Built-in Server)

1. **Clone/Extract the project:**
   ```bash
   cd kallani
   ```

2. **Start the PHP built-in server:**
   ```bash
   php -S localhost:8000 -t public
   ```

3. **Open in browser:**
   ```
   http://localhost:8000
   ```

### Docker Setup

1. **Build and run with Docker Compose:**
   ```bash
   docker-compose up -d
   ```

2. **Access the application:**
   ```
   http://localhost
   ```

3. **Stop containers:**
   ```bash
   docker-compose down
   ```

## Features

### Landing Page (`/`)
- Hero section introducing Kallani
- Interactive system flow visualization
- Platform capabilities overview
- Demonstration project preview

### Project Explorer (`/explore`)
- Portfolio view of all projects
- Filter options (status, asset type)
- Project cards with KPIs
- Quick access to detailed project views

### Project Dashboard

#### Overview (`/projects/{id}`)
- Project header with key information
- KPI cards (asset area, progress, verification, capital)
- Project timeline
- Status progress indicators

#### Asset Intelligence (`/projects/{id}/asset`)
- Asset metrics and breakdown
- Interactive land parcel grid visualization
- Parcel detail modal
- Verification metrics

#### Operations (`/projects/{id}/operations`)
- Operational metrics (planting, maintenance, infrastructure)
- Recent operations activity table
- Operation detail modal with contractor information

#### Verification (`/projects/{id}/verification`)
- Overall verification score
- Verification checklist (7 items)
- Interactive verification detail cards
- Verification method and date tracking

#### Capital (`/projects/{id}/capital`)
- Capital metrics (required, committed, remaining)
- Interactive donut chart of capital allocation
- Allocation breakdown by category
- Clear simulation badge

#### Distribution (`/projects/{id}/distribution`)
- Revenue waterfall visualization
- Gross revenue → net distributable flow
- Revenue history line chart
- Year-over-year revenue tracking with projections

#### ESG & Sustainability (`/projects/{id}/esg`)
- Key ESG metrics cards
- Environmental, Social, Governance categories
- Sustainability framework details
- Impact tracking

#### Documents (`/projects/{id}/documents`)
- Document vault organized by category
- Legal, Survey, Operations, ESG, Financial documents
- Document preview modal
- Reference numbers and upload dates

#### Audit Trail (`/projects/{id}/audit`)
- Timeline of all project events
- Event categorization
- Detailed event modals
- Complete change history

## Technology Stack

- **Backend:** PHP 7.4+
- **Frontend:** HTML5, CSS3, Tailwind CSS
- **Interactivity:** Alpine.js
- **Charts:** Chart.js
- **Database:** PostgreSQL (optional, for future enhancements)
- **Containerization:** Docker & Docker Compose

## Design System

### Colors
```
Background:      #F7F7F4
Surface:         #FFFFFF
Primary Text:    #171717
Secondary Text:  #6B6B6B
Border:          #E5E5E5
Muted BG:        #F0F0EC
Accent:          #2D5016 (Forest Green)
Status Green:    #059669
Status Amber:    #D97706
Status Red:      #DC2626
```

### Typography
- Font Family: Inter
- Weights: 400, 500, 600, 700, 800
- Scaling: h1-h4 hierarchy

## Data Structure

All demonstration data is stored in `config/data.php` as PHP arrays:

```php
return [
    'projects'     => [...],      // Project definitions
    'overview'     => [...],      // Dashboard KPIs
    'asset'        => [...],      // Land metrics
    'parcels'      => [...],      // Individual land parcels
    'operations'   => [...],      // Activity records
    'verification' => [...],      // Verification checklist
    'capital'      => [...],      // Financial allocation
    'distribution' => [...],      // Revenue waterfall
    'esg'          => [...],      // Sustainability metrics
    'documents'    => [...],      // Document vault
    'audit'        => [...],      // Event history
];
```

## Routes

| Route | Page | Purpose |
|-------|------|---------|
| `/` | Landing | Platform introduction |
| `/explore` | Projects | Portfolio view |
| `/projects/{id}` | Overview | Dashboard & KPIs |
| `/projects/{id}/asset` | Asset Intelligence | Land parcels & metrics |
| `/projects/{id}/operations` | Operations | Activity & progress |
| `/projects/{id}/verification` | Verification | Asset attestation |
| `/projects/{id}/capital` | Capital | Financing & allocation |
| `/projects/{id}/distribution` | Distribution | Revenue waterfall |
| `/projects/{id}/esg` | ESG | Sustainability metrics |
| `/projects/{id}/documents` | Documents | Vault & records |
| `/projects/{id}/audit` | Audit | Event timeline |

## Interactive Components

### Alpine.js Features
- Modal open/close with fade transitions
- Project flow interactive visualization
- Parcel grid click-to-detail
- Verification item expansion
- Document preview modal
- Audit event details

### Chart.js Visualizations
- Donut chart for capital allocation
- Line chart for revenue history
- Progress bars with animations
- Timeline visualization

## Responsive Design

- **Desktop (1280px+):** Full sidebar navigation, grid layouts
- **Tablet (768px-1279px):** Collapsed sidebar, 2-column grids
- **Mobile (<768px):** Full-width content, stacked cards, hamburger menu

## Demo Badges

Throughout the application, users see clear indicators that this is a demonstration:
- `DEMO` badge in navbar
- `SIMULATED DATA` labels on financial sections
- `DEMO RECORD` badges on verification items
- `DEMO EVENT` labels on audit events

## Important Notes

- **No Authentication:** This is a public demo. No login required.
- **No Transactions:** Capital and revenue are illustrative only.
- **No Real Data:** All information is simulated for demonstration purposes.
- **No Backend Processing:** All data is static and served from config files.
- **No Blockchain:** No cryptocurrency or smart contracts involved.

## Deployment

### Local Server
```bash
php -S 0.0.0.0:8000 -t public
```

### Production (Docker)
```bash
docker-compose -f docker-compose.yml up -d
```

### Nginx Configuration
The Docker setup includes Nginx reverse proxy. Configuration is in `docker/nginx/conf.d/app.conf`.

## Performance

- **Load Time:** < 2 seconds
- **Lighthouse Score:** Optimized for speed and accessibility
- **Bundle Size:** Minimal (< 100KB CSS + JS)

## Accessibility

- Semantic HTML structure
- WCAG AA color contrast
- Keyboard navigation support
- ARIA labels on interactive elements
- Visible focus states

## Browser Support

- Chrome/Edge 90+
- Firefox 88+
- Safari 14+
- Mobile browsers (iOS Safari, Chrome Mobile)

## Future Enhancements

- Multiple projects in portfolio
- Real database integration
- User accounts & authentication
- Real-time data feeds
- Advanced GIS integration
- PDF document generation
- Export functionality

## Support

This is a demonstration prototype. For questions about the Kallani concept or platform vision, please contact the development team.

## License

Demonstration Environment - All Rights Reserved

---

**Version:** 1.0.0  
**Last Updated:** September 2026  
**Status:** DEMO ENVIRONMENT
