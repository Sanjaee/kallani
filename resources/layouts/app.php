<?php
$configPath = __DIR__ . '/../../config/data.php';
if (!file_exists($configPath)) {
    $configPath = __DIR__ . '/../../data.php';
}
$config = require $configPath;
$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$isProjectPage = strpos($currentPath, '/projects/') !== false;
$project = $config['projects'][0] ?? null;

$basePrefix = (strpos($currentPath, '/kallani/public') === 0) ? '/kallani/public' : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Kallani - Operating System for Productive Natural Assets'; ?></title>
    
    <script>
        (function() {
            var theme = localStorage.getItem('theme');
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'kallani-bg': '#F7F7F4',
                        'kallani-surface': '#FFFFFF',
                        'kallani-text': '#171717',
                        'kallani-text-secondary': '#6B6B6B',
                        'kallani-border': '#E5E5E5',
                        'kallani-muted': '#F0F0EC',
                        'kallani-dark': '#171717',
                        'kallani-accent': '#2D5016',
                        'kallani-green': '#059669',
                        'kallani-amber': '#D97706',
                        'kallani-red': '#DC2626',
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                        'geist': ['Geist', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        
        [x-cloak], [style*="display: none"], [style*="display:none"] { display: none !important; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        html, body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
            background-color: #F7F7F4 !important;
            color: #171717 !important;
            line-height: 1.5;
            scroll-behavior: smooth;
            overflow-x: hidden !important;
        }

        /* Anti-FOUC Instant Dark Mode */
        html.dark, html.dark body, body.dark {
            background-color: #0D120B !important;
            color: #F3F4F1 !important;
        }

        h1 { font-size: 2.5rem; font-weight: 800; line-height: 1.2; margin-bottom: 0.75rem; letter-spacing: -0.02em; color: #171717; }
        h2 { font-size: 2rem; font-weight: 700; line-height: 1.25; margin-bottom: 0.75rem; color: #171717; }
        h3 { font-size: 1.5rem; font-weight: 700; line-height: 1.3; margin-bottom: 0.5rem; color: #171717; }
        h4 { font-size: 1.25rem; font-weight: 600; line-height: 1.4; margin-bottom: 0.5rem; color: #171717; }
        p { color: #6B6B6B; margin-bottom: 0.5rem; }
        a { text-decoration: none !important; color: inherit; }

        .text-xs { font-size: 0.75rem !important; }
        .text-sm { font-size: 0.875rem !important; }
        .text-lg { font-size: 1.125rem !important; }
        .text-xl { font-size: 1.25rem !important; }
        .text-2xl { font-size: 1.5rem !important; }
        .text-3xl { font-size: 1.875rem !important; }
        .text-4xl { font-size: 2.25rem !important; }

        .font-semibold { font-weight: 600 !important; }
        .font-bold { font-weight: 700 !important; }
        .font-extrabold { font-weight: 800 !important; }

        .text-kallani-text, .text-\[\#171717\] { color: #171717 !important; }
        .text-kallani-text-secondary, .text-\[\#6B6B6B\], .text-muted { color: #6B6B6B !important; }
        .text-kallani-accent, .text-\[\#2D5016\], .text-accent { color: #2D5016 !important; }
        .text-kallani-green, .text-\[\#059669\] { color: #059669 !important; }
        .text-white { color: #FFFFFF !important; }

        .bg-kallani-bg, .bg-\[\#F7F7F4\] { background-color: #F7F7F4 !important; }
        .bg-kallani-surface, .bg-white, .bg-\[\#FFFFFF\] { background-color: #FFFFFF !important; }
        .bg-kallani-muted, .bg-\[\#F0F0EC\] { background-color: #F0F0EC !important; }
        .bg-kallani-accent, .bg-\[\#2D5016\] { background-color: #2D5016 !important; color: #FFFFFF !important; }
        .bg-kallani-green, .bg-\[\#059669\] { background-color: #059669 !important; color: #FFFFFF !important; }

        .relative { position: relative !important; }
        .absolute { position: absolute !important; }
        .fixed { position: fixed !important; }
        .sticky { position: sticky !important; }

        .top-0 { top: 0 !important; }
        .top-2 { top: 0.5rem !important; }
        .top-4 { top: 1rem !important; }
        .top-6 { top: 1.5rem !important; }
        .left-0 { left: 0 !important; }
        .left-1\.5 { left: 0.375rem !important; }
        .right-4 { right: 1rem !important; }

        .w-full { width: 100% !important; }
        .w-1 { width: 0.25rem !important; }
        .w-4 { width: 1rem !important; }
        .w-6 { width: 1.5rem !important; }
        .w-64 { width: 16rem !important; }
        .h-full { height: 100% !important; }
        .h-2 { height: 0.5rem !important; }
        .h-4 { height: 1rem !important; }
        .h-6 { height: 1.5rem !important; }
        .h-20 { height: 5rem !important; }
        .min-h-screen { min-height: 100vh !important; }

        .flex { display: flex; }
        .flex-col { flex-direction: column !important; }
        .flex-wrap { flex-wrap: wrap !important; }
        .items-center { align-items: center !important; }
        .items-start { align-items: flex-start !important; }
        .justify-between { justify-content: space-between !important; }
        .justify-center { justify-content: center !important; }

        .grid { display: grid !important; }
        .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)) !important; }
        .grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
        .grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)) !important; }
        .grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)) !important; }
        .grid-cols-5 { grid-template-columns: repeat(5, minmax(0, 1fr)) !important; }

        @media (min-width: 640px) {
          .sm\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
          .sm\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)) !important; }
        }
        @media (min-width: 768px) {
          .md\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
          .md\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)) !important; }
          .md\:hidden { display: none !important; }
          .md\:flex { display: flex !important; }
        }
        @media (min-width: 1024px) {
          .lg\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
          .lg\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)) !important; }
          .lg\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)) !important; }
          .lg\:grid-cols-5 { grid-template-columns: repeat(5, minmax(0, 1fr)) !important; }
          .lg\:col-span-2 { grid-column: span 2 / span 2 !important; }
          .lg\:hidden { display: none !important; }
          .lg\:flex { display: flex !important; }
        }

        .gap-2 { gap: 0.5rem !important; }
        .gap-4 { gap: 1rem !important; }
        .gap-6 { gap: 1.5rem !important; }
        .gap-8 { gap: 2rem !important; }

        .p-4 { padding: 1rem !important; }
        .p-6 { padding: 1.5rem !important; }
        .p-8 { padding: 2rem !important; }
        .px-6 { padding-left: 1.5rem !important; padding-right: 1.5rem !important; }
        .py-4 { padding-top: 1rem !important; padding-bottom: 1rem !important; }
        .py-12 { padding-top: 3rem !important; padding-bottom: 3rem !important; }

        .mb-2 { margin-bottom: 0.5rem !important; }
        .mb-4 { margin-bottom: 1rem !important; }
        .mb-6 { margin-bottom: 1.5rem !important; }
        .mb-12 { margin-bottom: 3rem !important; }
        .ml-12 { margin-left: 3rem !important; }
        .ml-64 { margin-left: 16rem !important; }

        .space-y-4 > * + * { margin-top: 1rem !important; }
        .space-y-6 > * + * { margin-top: 1.5rem !important; }
        .space-y-8 > * + * { margin-top: 2rem !important; }

        .border { border: 1px solid #E5E5E5 !important; }
        .border-t { border-top: 1px solid #E5E5E5 !important; }
        .border-b { border-bottom: 1px solid #E5E5E5 !important; }
        .border-r { border-right: 1px solid #E5E5E5 !important; }

        .rounded { border-radius: 0.25rem !important; }
        .rounded-lg { border-radius: 0.5rem !important; }
        .rounded-full { border-radius: 9999px !important; }

        .cursor-pointer { cursor: pointer !important; }
        .overflow-x-auto { overflow-x: auto !important; }

        /* Modal System */
        .modal {
          display: flex !important;
          position: fixed !important;
          top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important;
          width: 100vw !important; height: 100vh !important;
          background-color: rgba(0, 0, 0, 0.5) !important;
          z-index: 9999 !important;
          align-items: center !important;
          justify-content: center !important;
          padding: 1.5rem !important;
        }
        .modal[style*="display: none"], .modal[style*="display:none"] {
          display: none !important;
        }
        .modal-content {
          background-color: #FFFFFF !important;
          border-radius: 0.75rem !important;
          padding: 2rem !important;
          width: 100% !important;
          max-width: 42rem !important;
          position: relative !important;
          max-height: 85vh !important;
          overflow-y: auto !important;
          box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1) !important;
        }
        .modal-close {
          position: absolute !important;
          top: 1rem !important; right: 1rem !important;
          background: transparent !important; border: none !important;
          font-size: 1.5rem !important; line-height: 1 !important;
          color: #6B6B6B !important; cursor: pointer !important;
        }

        /* Tables */
        .table, table {
          width: 100% !important;
          border-collapse: collapse !important;
          text-align: left !important;
        }
        .table th, table th {
          background-color: #F0F0EC !important;
          color: #171717 !important;
          font-weight: 600 !important;
          font-size: 0.875rem !important;
          padding: 0.75rem 1rem !important;
          border-bottom: 1px solid #E5E5E5 !important;
        }
        .table td, table td {
          padding: 0.875rem 1rem !important;
          border-bottom: 1px solid #E5E5E5 !important;
          font-size: 0.875rem !important;
        }
        .table tbody tr:hover, table tbody tr:hover {
          background-color: #F0F0EC !important;
        }

        /* Navbar & Sidebar */
        .navbar {
          background-color: #060D07 !important;
          border-bottom: 1px solid #152416 !important;
          position: sticky !important;
          top: 0 !important;
          z-index: 50 !important;
        }
        .navbar-container {
          width: 100% !important;
          max-width: 1280px !important;
          margin: 0 auto !important;
          padding: 1rem 1.5rem !important;
          display: flex !important;
          align-items: center !important;
          justify-content: space-between !important;
        }
        .navbar-logo {
          font-size: 1.5rem !important;
          font-weight: 800 !important;
          color: #2D5016 !important;
          letter-spacing: -0.025em !important;
          text-decoration: none !important;
        }
        @media (max-width: 767px) {
          .nav-links {
            display: none !important;
          }
          .mobile-menu-btn {
            display: flex !important;
          }
        }
        @media (min-width: 768px) {
          .nav-links {
            display: flex !important;
            gap: 1.5rem !important;
            align-items: center !important;
          }
          .mobile-menu-btn {
            display: none !important;
          }
        }
        .nav-link {
          color: #6B6B6B !important;
          font-weight: 500 !important;
          font-size: 0.875rem !important;
          text-decoration: none !important;
        }
        .nav-link.active {
          color: #2D5016 !important;
          font-weight: 700 !important;
          border-bottom: 2px solid #2D5016 !important;
          padding-bottom: 0.25rem !important;
        }

        .btn-primary {
          display: inline-block !important; padding: 0.75rem 1.5rem !important;
          background-color: #2D5016 !important; color: #FFFFFF !important;
          font-weight: 600 !important; border-radius: 0.5rem !important; border: none !important; cursor: pointer !important;
        }
        .btn-secondary {
          display: inline-block !important; padding: 0.5rem 1rem !important;
          background-color: #F0F0EC !important; color: #171717 !important;
          font-weight: 600 !important; border-radius: 0.5rem !important; border: 1px solid #E5E5E5 !important; cursor: pointer !important;
        }
        .btn-outline {
          display: inline-block !important; padding: 0.5rem 1rem !important;
          background-color: #FFFFFF !important; color: #171717 !important;
          font-weight: 600 !important; border-radius: 0.5rem !important; border: 1px solid #E5E5E5 !important; cursor: pointer !important;
        }

        .card { background-color: #FFFFFF !important; border: 1px solid #E5E5E5 !important; border-radius: 0.75rem !important; padding: 1.5rem !important; }
        .stat-card {
          background-color: #FFFFFF !important;
          border: 1px solid #E5E5E5 !important;
          border-radius: 0.75rem !important;
          padding: 0.875rem !important;
          overflow: hidden !important;
        }
        .stat-value {
          font-size: 1.35rem !important;
          font-weight: 800 !important;
          color: #171717 !important;
          line-height: 1.2 !important;
          overflow-wrap: break-word !important;
        }
        @media (min-width: 640px) {
          .stat-value { font-size: 1.85rem !important; }
          .stat-card { padding: 1.25rem !important; }
        }
        .stat-label { font-size: 0.875rem !important; color: #6B6B6B !important; }

        .sidebar {
          background-color: #FFFFFF !important; border-right: 1px solid #E5E5E5 !important;
          width: 16rem !important; min-height: 100vh !important; position: fixed !important; left: 0 !important; top: 0 !important; padding-top: 5rem !important; overflow-y: auto !important;
        }
        .sidebar-item {
          display: block !important; padding: 0.75rem 1.5rem !important; color: #6B6B6B !important; font-size: 0.875rem !important; font-weight: 500 !important;
          border-left: 4px solid transparent !important; text-decoration: none !important;
        }
        .sidebar-item:hover { color: #171717 !important; background-color: #F0F0EC !important; }
        .sidebar-item.active { color: #2D5016 !important; background-color: #F0F0EC !important; border-left-color: #2D5016 !important; font-weight: 700 !important; }

        .main-content { margin-left: 16rem !important; padding: 5.5rem 2rem 2rem 2rem !important; }
        @media (max-width: 1023px) { .sidebar { display: none !important; } .main-content { margin-left: 0 !important; padding: 5.5rem 1.25rem 2rem 1.25rem !important; } }
        @media (min-width: 1024px) { .lg\:hidden { display: none !important; } }

        .progress-bar { width: 100% !important; background-color: #F0F0EC !important; border-radius: 9999px !important; height: 0.5rem !important; overflow: hidden !important; }
        .progress-fill { background-color: #059669 !important; height: 100% !important; }

        .badge-demo { background-color: #F0F0EC !important; color: #171717 !important; padding: 0.25rem 0.75rem !important; border-radius: 9999px !important; font-size: 0.75rem !important; font-weight: 700 !important; display: inline-block !important; }
        .badge-verified { background-color: #DCFCE7 !important; color: #059669 !important; padding: 0.25rem 0.75rem !important; border-radius: 9999px !important; font-size: 0.75rem !important; font-weight: 600 !important; display: inline-block !important; }
        .badge-pending { background-color: rgba(217, 119, 6, 0.1) !important; color: #D97706 !important; padding: 0.25rem 0.75rem !important; border-radius: 9999px !important; font-size: 0.75rem !important; font-weight: 600 !important; display: inline-block !important; }
        .divider { border-top: 1px solid #E5E5E5 !important; }

        /* Dark Mode Theme Engine */
        html.dark, html.dark body, body.dark {
            background-color: #0D120B !important;
            color: #F3F4F1 !important;
        }

        html.dark h1, html.dark h2, html.dark h3, html.dark h4,
        body.dark h1, body.dark h2, body.dark h3, body.dark h4 {
            color: #F3F4F1 !important;
        }

        html.dark p, html.dark .text-muted, html.dark .text-\[\#6B6B6B\], html.dark .text-kallani-text-secondary,
        body.dark p, body.dark .text-muted, body.dark .text-\[\#6B6B6B\], body.dark .text-kallani-text-secondary {
            color: #D1D5DB !important;
        }

        html.dark .bg-white, html.dark .bg-\[\#FFFFFF\], html.dark .bg-kallani-surface,
        body.dark .bg-white, body.dark .bg-\[\#FFFFFF\], body.dark .bg-kallani-surface {
            background-color: #141C12 !important;
        }

        html.dark .bg-\[\#F7F7F4\], html.dark .bg-kallani-bg,
        body.dark .bg-\[\#F7F7F4\], body.dark .bg-kallani-bg {
            background-color: #0D120B !important;
        }

        html.dark .bg-\[\#F0F0EC\], html.dark .bg-kallani-muted,
        body.dark .bg-\[\#F0F0EC\], body.dark .bg-kallani-muted {
            background-color: #1E281B !important;
            color: #F3F4F1 !important;
        }

        html.dark .text-\[\#171717\], html.dark .text-kallani-text,
        body.dark .text-\[\#171717\], body.dark .text-kallani-text {
            color: #F3F4F1 !important;
        }

        html.dark .text-\[\#2D5016\], html.dark .text-kallani-accent, html.dark .navbar-logo,
        body.dark .text-\[\#2D5016\], body.dark .text-kallani-accent, body.dark .navbar-logo {
            color: #4ADE80 !important;
        }

        html.dark .border, html.dark .border-\[\#E5E5E5\], html.dark .border-t, html.dark .border-b, html.dark .border-r, html.dark .border-kallani-border,
        body.dark .border, body.dark .border-\[\#E5E5E5\], body.dark .border-t, body.dark .border-b, body.dark .border-r, body.dark .border-kallani-border {
            border-color: #243220 !important;
        }

        html.dark .navbar, html.dark .sidebar, html.dark footer,
        body.dark .navbar, body.dark .sidebar, body.dark footer {
            background-color: #141C12 !important;
            border-color: #243220 !important;
        }

        html.dark .nav-link, body.dark .nav-link {
            color: #9CA3AF !important;
        }
        html.dark .nav-link:hover, body.dark .nav-link:hover {
            color: #F3F4F1 !important;
        }
        html.dark .nav-link.active, body.dark .nav-link.active {
            color: #4ADE80 !important;
            border-bottom-color: #4ADE80 !important;
        }

        html.dark .sidebar-item, body.dark .sidebar-item {
            color: #9CA3AF !important;
        }
        html.dark .sidebar-item:hover, body.dark .sidebar-item:hover {
            background-color: #1E281B !important;
            color: #F3F4F1 !important;
        }
        html.dark .sidebar-item.active, body.dark .sidebar-item.active {
            background-color: #1E281B !important;
            color: #4ADE80 !important;
            border-left-color: #4ADE80 !important;
        }

        html.dark .card, html.dark .stat-card,
        body.dark .card, body.dark .stat-card {
            background-color: #141C12 !important;
            border-color: #243220 !important;
        }

        html.dark .btn-primary, body.dark .btn-primary {
            background-color: #2D5016 !important;
            color: #FFFFFF !important;
        }
        html.dark .btn-secondary, html.dark .btn-outline,
        body.dark .btn-secondary, body.dark .btn-outline {
            background-color: #1E281B !important;
            color: #F3F4F1 !important;
            border-color: #243220 !important;
        }

        html.dark .table th, html.dark table th,
        body.dark .table th, body.dark table th {
            background-color: #1E281B !important;
            color: #F3F4F1 !important;
            border-color: #243220 !important;
        }
        html.dark .table td, html.dark table td,
        body.dark .table td, body.dark table td {
            border-color: #243220 !important;
            color: #E5E7EB !important;
        }
        html.dark .table tbody tr:hover, html.dark table tbody tr:hover,
        body.dark .table tbody tr:hover, body.dark table tbody tr:hover {
            background-color: #1E281B !important;
        }

        html.dark .modal-content, body.dark .modal-content {
            background-color: #141C12 !important;
            color: #F3F4F1 !important;
            border: 1px solid #243220 !important;
        }

        html.dark .badge-demo, body.dark .badge-demo {
            background-color: #1E281B !important;
            color: #F3F4F1 !important;
        }
    </style>
    <script>
        const sunIcon = `<svg class="w-4 h-4 text-amber-500 transition-transform duration-300 transform group-hover:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>`;
        const moonIcon = `<svg class="w-4 h-4 text-gray-600 dark:text-gray-300 transition-transform duration-300 transform group-hover:-rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>`;

        const idDictionary = {
            // Navigation & Sidebar
            "Home": "Beranda",
            "Explore": "Eksplorasi",
            "Overview": "Ikhtisar",
            "Asset": "Aset",
            "Operations": "Operasional",
            "Verification": "Verifikasi",
            "Capital": "Modal",
            "Distribution": "Distribusi",
            "ESG": "ESG",
            "Documents": "Dokumen",
            "Audit": "Audit",

            // Headers & Badges
            "DEMO": "DEMO",
            "Active Project": "Proyek Aktif",
            "North Kalimantan Palm Project": "Proyek Kelapa Sawit Kalimantan Utara",
            "Palm Plantation": "Perkebunan Kelapa Sawit",
            "Audited ESG Ratings 2026": "Peringkat ESG Teruji 2026",
            "RSPO & ISPO Compliant": "Patuh RSPO & ISPO",
            "Institutional Capital Ledger": "Buku Besar Modal Institusional",
            "GIS Verified Concession": "Konsesi Terverifikasi GIS",
            "Third-Party Verified": "Terverifikasi Pihak Ketiga",
            "Audited Distribution Ledger": "Buku Besar Distribusi Teruji",
            "Quarterly Payouts Active": "Pembayaran Pembagian Kuartalan Aktif",

            // Page Titles
            "Asset Intelligence": "Intelijen Aset",
            "Operational Tracking": "Pelacakan Operasional",
            "Asset Verification": "Verifikasi Aset",
            "Project Capital": "Modal Proyek",
            "Revenue & Distribution": "Pendapatan & Distribusi",
            "ESG & Sustainability": "ESG & Keberlanjutan",
            "Project Documentation": "Dokumentasi Proyek",
            "Audit Log & History": "Log Audit & Riwayat",

            // Buttons
            "Download ESG Report": "Unduh Laporan ESG",
            "Verify Audit Logs": "Verifikasi Log Audit",
            "Download Financial Deck": "Unduh Deck Keuangan",
            "Export GIS Parcels": "Ekspor Parsel GIS",
            "Export Distribution Summary": "Unduh Ringkasan Distribusi",

            // Metrics & Labels
            "Asset Area": "Luas Aset",
            "Total verified land parcels": "Total bidang tanah terverifikasi",
            "Development Progress": "Kemajuan Pembangunan",
            "Verification Level": "Tingkat Verifikasi",
            "Capital Required": "Modal Dibutuhkan",
            "Total project capital target": "Total target modal proyek",
            "Capital Committed": "Modal Terkomitmen",
            "Projected Output": "Proyeksi Hasil",
            "Estimated annual yield": "Estimasi hasil tahunan",
            "Project Timeline": "Lini Waktu Proyek",
            "Operational Status Breakdown": "Rincian Status Operasional",

            "Project Valuation": "Valuasi Proyek",
            "Estimated Gross Value": "Estimasi Nilai Bruto",
            "Total Budget Target": "Total Target Anggaran",
            "Remaining Gap": "Sisa Kebutuhan Modal",
            "Series B Funding Gap": "Sisa Pendanaan Series B",
            "Capital Allocation Chart": "Grafik Alokasi Modal",
            "Allocation Breakdown": "Rincian Alokasi",
            "Simulated Financial Model": "Simulasi Model Keuangan",

            "Gross Revenue": "Pendapatan Bruto",
            "Annual Harvest Proceeds": "Hasil Panen Tahunan",
            "Total Deductions": "Total Potongan",
            "Opex, Maintenance & Reserves": "Opex, Pemeliharaan & Cadangan",
            "Net Distributable": "Hasil Bersih Didistribusikan",
            "Available for Investor Distribution": "Tersedia untuk Distribusi Investor",
            "Revenue Waterfall Flow": "Alur Waterfall Pendapatan",
            "Sequential distribution flow from gross to net proceeds": "Alur distribusi berurutan dari hasil bruto ke hasil bersih",
            "FY 2026 Model": "Model TA 2026",
            "Operating Cost (Opex)": "Biaya Operasional (Opex)",
            "Field labor & processing expenses": "Beban tenaga kerja lapangan & pengolahan",
            "Maintenance & Equipment": "Pemeliharaan & Peralatan",
            "Infrastructure upkeep & machinery": "Pemeliharaan infrastruktur & mesin",
            "Retained Reserve": "Cadangan Ditahan",
            "Capital buffer & emergency fund": "Penyangga modal & dana darurat",
            "Net Distributable Proceeds": "Hasil Bersih yang Didistribusikan",
            "Final distributable cash flow": "Arus kas akhir yang didistribusikan",
            "Revenue Growth & Projections": "Pertumbuhan Pendapatan & Proyeksi",
            "Historical revenue trajectory and 2027 forecast": "Trajektori pendapatan historis dan perkiraan 2027",

            "Land Management": "Area Pengelolaan",
            "Land Under Management": "Lahan Dalam Pengelolaan",
            "Protected Area": "Area Dilindungi",
            "Protected Sanctuary Area": "Area Suaka Dilindungi",
            "Reforestation": "Reforestrasi Hutan",
            "Restoration Planting": "Penanaman Restorasi",
            "Carbon Potential": "Potensi Karbon",
            "High Carbon Sequestration": "Sekuestrasi Karbon Tinggi",
            "Water Management": "Manajemen Air",
            "Environmental": "Lingkungan",
            "Social": "Sosial",
            "Governance": "Tata Kelola",
            "Ecological footprint & conservation": "Jejak ekologis & konservasi",
            "Labor, safety & local communities": "Tenaga kerja, keselamatan & masyarakat lokal",
            "Compliance, audits & transparency": "Kepatuhan, audit & transparansi",
            "Verified by NDPE Policy": "Terverifikasi Kebijakan NDPE",
            "Zero Deforestation": "Bebas Deforestasi",
            "ILO Standards Compliant": "Patuh Standar ILO",
            "Fair Wages Certified": "Tersertifikasi Upah Layak",
            "Independent Verification": "Verifikasi Independen",
            "Quarterly Audits": "Audit Kuartalan",
            "Sustainability Framework & Guiding Principles": "Kerangka Keberlanjutan & Prinsip Panduan",
            "Environmental Impact": "Dampak Lingkungan",
            "Social Responsibility": "Tanggung Jawab Sosial",
            "Corporate Governance": "Tata Kelola Perusahaan",

            "Asset Breakdown": "Rincian Aset",
            "Total Area": "Total Luas",
            "Cultivated": "Terkultivasi",
            "Development": "Pembangunan",
            "Reserved": "Cadangan",
            "Verification Metrics": "Metrik Verifikasi",
            "Survey Coverage": "Cakupan Survei",
            "Boundary Verification": "Verifikasi Batas",
            "Land Parcel Map": "Peta Parsel Lahan",

            "Overall Verification Status": "Status Verifikasi Keseluruhan",
            "Verified Compliance": "Kepatuhan Terverifikasi",
            "Click for details": "Klik untuk detail",
            "Legal & Land Rights": "Hak Hukum & Lahan",
            "Environmental Impact Assessment": "Analisis Mengenai Dampak Lingkungan (AMDAL)",
            "GIS Parcel Mapping": "Pemetaan Parsel GIS",
            "High Conservation Value (HCV)": "Nilai Konservasi Tinggi (NKT)",
            "RSPO Certification": "Sertifikasi RSPO",
            "Carbon Baseline Audit": "Audit Baseline Karbon",

            "Active Concession Operations": "Operasi Konsesi Aktif",
            "Monitor project execution, field activities, infrastructure development, and planting progress.": "Pantau pelaksanaan proyek, kegiatan lapangan, pembangunan infrastruktur, dan kemajuan penanaman.",
            "Export Operations Log": "Ekspor Log Operasi",
            "Recent Field Operations": "Operasi Lapangan Terkini",
            "Showing last 5 activity logs": "Menampilkan 5 log aktivitas terakhir",
            "Activity": "Aktivitas",
            "Area Covered": "Luas Area",
            "Status": "Status",
            "Date": "Tanggal",
            "Reference Code": "Kode Referensi",
            "Contractor": "Kontraktor",
            "Completed": "Selesai",
            "In Progress": "Sedang Berlangsung",
            "Verified": "Terverifikasi",
            "Execution Date": "Tanggal Pelaksanaan",
            "Contractor Partner": "Mitra Kontraktor",

            "Independent Verification Checklist": "Daftar Periksa Verifikasi Independen",
            "Inspection Date": "Tanggal Inspeksi",
            "Attestation Agency": "Lembaga Atestasi",

            // Subtitles
            "Environmental impact, community engagement, governance framework, and ecological metrics.": "Dampak lingkungan, keterlibatan masyarakat, kerangka tata kelola, dan metrik ekologis.",
            "Illustrative capital requirements and allocation breakdown across project activities.": "Kebutuhan modal dan alokasi di seluruh aktivitas proyek.",
            "Independent verification and asset attestation records.": "Verifikasi independen dan catatan bukti aset.",
            "Comprehensive view of physical land parcels, cultivation status, and boundary verification.": "Pandangan komprehensif bidang tanah fisik, status budidaya, dan verifikasi batas.",
            "Flow of project revenue through operating costs, reserves, and net distributable proceeds.": "Alur pendapatan proyek melalui biaya operasional, cadangan, dan hasil bersih.",
            "Activity log and field operation records.": "Log aktivitas dan catatan operasi lapangan.",
            "Verified legal, survey, operations, and financial documents.": "Dokumen hukum, survei, operasional, dan keuangan terverifikasi.",
            "Immutable audit trail of asset activities, verifications, and financial updates.": "Jejak audit tidak terbantahkan dari aktivitas aset, verifikasi, dan pembaruan keuangan.",

            // Footer
            "Operating System for Productive Natural Assets": "Sistem Operasi untuk Aset Alam Produktif",
            "Product": "Produk",
            "About": "Tentang",
            "Demo Environment": "Lingkungan Demo",
            "Simulated Data": "Data Simulasi"
        };

        function getLanguage() {
            return localStorage.getItem('lang') || 'en';
        }

        function setLanguage(lang) {
            localStorage.setItem('lang', lang);
            applyLanguage(lang);
        }

        function applyLanguage(lang) {
            const btnEn = document.getElementById('lang-btn-en');
            const btnId = document.getElementById('lang-btn-id');
            if (btnEn && btnId) {
                if (lang === 'id') {
                    btnId.className = "px-2.5 py-1 rounded-lg bg-emerald-600 text-white font-bold transition-all shadow-sm cursor-pointer";
                    btnEn.className = "px-2.5 py-1 rounded-lg text-gray-500 hover:text-gray-900 dark:hover:text-white transition-all cursor-pointer";
                } else {
                    btnEn.className = "px-2.5 py-1 rounded-lg bg-emerald-600 text-white font-bold transition-all shadow-sm cursor-pointer";
                    btnId.className = "px-2.5 py-1 rounded-lg text-gray-500 hover:text-gray-900 dark:hover:text-white transition-all cursor-pointer";
                }
            }

            // Universal Translator across all DOM nodes
            const targets = document.querySelectorAll('h1, h2, h3, h4, h5, p, span, a, button, label, td, th, .sidebar-item');
            targets.forEach(el => {
                let rawText = el.getAttribute('data-orig-text');
                if (!rawText) {
                    const clone = el.cloneNode(true);
                    clone.querySelectorAll('svg').forEach(s => s.remove());
                    rawText = clone.innerText.trim();
                    if (rawText) {
                        el.setAttribute('data-orig-text', rawText);
                    }
                }

                if (rawText && idDictionary[rawText]) {
                    const targetText = (lang === 'id') ? idDictionary[rawText] : rawText;
                    
                    if (el.querySelector('svg')) {
                        const svgHtml = el.querySelector('svg').outerHTML;
                        el.innerHTML = svgHtml + ' ' + targetText;
                    } else if (el.children.length === 0) {
                        el.innerText = targetText;
                    } else {
                        for (let node of el.childNodes) {
                            if (node.nodeType === Node.TEXT_NODE && node.nodeValue.trim()) {
                                node.nodeValue = ' ' + targetText + ' ';
                                break;
                            }
                        }
                    }
                }
            });
        }

        function updateThemeUI() {
            var isDark = document.documentElement.classList.contains('dark');
            if (document.body) {
                document.body.classList.toggle('dark', isDark);
            }
            var icon = document.getElementById('theme-toggle-icon');
            if (icon) icon.innerHTML = isDark ? sunIcon : moonIcon;
        }

        function toggleDarkMode() {
            var isDark = document.documentElement.classList.toggle('dark');
            if (document.body) document.body.classList.toggle('dark', isDark);
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            updateThemeUI();
        }

        function animatePageElements() {
            // 1. Smooth Progress Bar Fill Animation (No Shrink / Flash Glitch)
            const bars = document.querySelectorAll('.progress-bar > div, [style*="width:"], [data-target-width]');
            bars.forEach(bar => {
                let targetWidth = bar.getAttribute('data-target-width');
                if (!targetWidth) {
                    const style = bar.getAttribute('style') || '';
                    const match = style.match(/width:\s*([\d.]+%)/i);
                    if (match) {
                        targetWidth = match[1];
                        bar.setAttribute('data-target-width', targetWidth);
                    }
                }

                if (targetWidth) {
                    // Turn off transition instantly so it doesn't animate backwards to 0%
                    bar.style.transition = 'none';
                    bar.style.width = '0%';
                    
                    // Force browser reflow to commit 0% immediately without animation
                    void bar.offsetWidth;

                    // Apply smooth fill animation from 0% -> targetWidth
                    bar.style.transition = 'width 1.2s cubic-bezier(0.16, 1, 0.3, 1)';
                    requestAnimationFrame(() => {
                        bar.style.width = targetWidth;
                    });
                }
            });

            // 2. Counter-Up Animation for Pure Numbers only (ignoring translated text labels to avoid glitches)
            const numberNodes = document.querySelectorAll('.text-3xl, .text-4xl, .text-5xl, .text-6xl, .stat-value');
            numberNodes.forEach(el => {
                if (el.children.length > 0) return; // Skip containers with child tags
                const fullText = el.innerText.trim();
                const match = fullText.match(/^([$€Rp]?\s*)([\d,]+(\.\d+)?)([%\sA-Za-z]*)$/);
                if (match) {
                    const prefix = match[1];
                    const targetVal = parseFloat(match[2].replace(/,/g, ''));
                    const suffix = match[4];
                    const hasDecimals = match[3] !== undefined;
                    const decimalPlaces = hasDecimals ? match[3].length - 1 : 0;
                    
                    const duration = 1000;
                    const startTime = performance.now();
                    
                    function step(currentTime) {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        const easeProgress = 1 - Math.pow(1 - progress, 3);
                        const currentVal = targetVal * easeProgress;
                        
                        let formattedNum = hasDecimals 
                            ? currentVal.toFixed(decimalPlaces) 
                            : Math.floor(currentVal).toLocaleString();
                        
                        el.innerText = prefix + formattedNum + suffix;
                        
                        if (progress < 1) {
                            requestAnimationFrame(step);
                        } else {
                            el.innerText = fullText;
                            applyLanguage(getLanguage());
                        }
                    }
                    
                    requestAnimationFrame(step);
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateThemeUI();
            applyLanguage(getLanguage());
            animatePageElements();
        });
    </script>
    <link rel="stylesheet" href="<?php echo $basePrefix; ?>/style.css">
    <link rel="stylesheet" href="<?php echo $basePrefix; ?>/css/style.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<?php
$cleanCurrentPath = rtrim(str_replace('/kallani/public', '', $currentPath), '/');
if ($cleanCurrentPath === '') { $cleanCurrentPath = '/'; }
$isHomePage = ($cleanCurrentPath === '/');
?>
<?php
$reqPath = str_replace($basePrefix, '', $cleanCurrentPath);
$activeTab = 'home';
if (strpos($reqPath, '/explore') === 0 || strpos($reqPath, '/projects') === 0 || strpos($reqPath, '/project-overview') === 0) {
    $activeTab = 'explore';
} elseif (strpos($reqPath, '/audit') === 0) {
    $activeTab = 'audit';
} elseif (strpos($reqPath, '/how-it-works') === 0) {
    $activeTab = 'how-it-works';
} elseif (strpos($reqPath, '/about') === 0) {
    $activeTab = 'about';
} elseif ($reqPath === '/' || $reqPath === '') {
    $activeTab = 'home';
}
?>
<body class="bg-[#040804] text-gray-100 font-inter <?php echo $isHomePage ? 'h-screen w-screen overflow-hidden' : 'min-h-screen'; ?>" x-data="{ mobileMenuOpen: false, sidebarOpen: false }">

    <nav id="main-navbar" class="bg-[#060D07]/95 backdrop-blur-md fixed top-0 left-0 right-0 z-[100] shadow-2xl transition-all duration-700 transform <?php echo $isHomePage ? 'opacity-0 pointer-events-none -translate-y-full' : 'opacity-100 pointer-events-auto translate-y-0'; ?>" style="border-bottom: none !important;">
        <div class="w-full px-6 py-3 flex items-center justify-between">
            <!-- Left: Logo & Subtext (Stacked vertical) -->
            <a href="<?php echo $basePrefix; ?>/" class="flex flex-col group text-left py-0.5">
                <span class="text-base sm:text-lg font-serif font-extrabold tracking-[0.28em] uppercase leading-none transition-colors" style="color: #FFFFFF !important;">KALLANI</span>
                <span class="text-[9px] font-mono tracking-[0.18em] uppercase leading-none mt-1" style="color: #FFFFFF !important;">NINA / OPERATING SYSTEM</span>
            </a>
            
            <!-- Desktop Nav Links with Active Underline -->
            <div class="hidden md:flex gap-8 items-center text-xs font-mono tracking-wider">
                <a href="<?php echo $basePrefix; ?>/" class="relative py-1 font-semibold transition-colors <?php echo ($activeTab === 'home') ? 'text-white font-bold' : 'text-gray-300 hover:text-white'; ?>">
                    <span>HOME</span>
                    <?php if ($activeTab === 'home'): ?>
                        <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-emerald-400 rounded-full"></span>
                    <?php endif; ?>
                </a>
                <a href="<?php echo $basePrefix; ?>/explore" class="relative py-1 font-semibold transition-colors <?php echo ($activeTab === 'explore') ? 'text-white font-bold' : 'text-gray-300 hover:text-white'; ?>">
                    <span>EXPLORE</span>
                    <?php if ($activeTab === 'explore'): ?>
                        <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-emerald-400 rounded-full"></span>
                    <?php endif; ?>
                </a>
                <a href="<?php echo $basePrefix; ?>/#system-architecture" class="relative py-1 font-semibold transition-colors <?php echo ($activeTab === 'how-it-works') ? 'text-white font-bold' : 'text-gray-300 hover:text-white'; ?>">
                    <span>HOW IT WORKS</span>
                    <?php if ($activeTab === 'how-it-works'): ?>
                        <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-emerald-400 rounded-full"></span>
                    <?php endif; ?>
                </a>
                <a href="<?php echo $basePrefix; ?>/audit-trail" class="relative py-1 font-semibold transition-colors <?php echo ($activeTab === 'audit') ? 'text-white font-bold' : 'text-gray-300 hover:text-white'; ?>">
                    <span>AUDIT</span>
                    <?php if ($activeTab === 'audit'): ?>
                        <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-emerald-400 rounded-full"></span>
                    <?php endif; ?>
                </a>
                <a href="<?php echo $basePrefix; ?>/#about" class="relative py-1 font-semibold transition-colors <?php echo ($activeTab === 'about') ? 'text-white font-bold' : 'text-gray-300 hover:text-white'; ?>">
                    <span>ABOUT</span>
                    <?php if ($activeTab === 'about'): ?>
                        <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-emerald-400 rounded-full"></span>
                    <?php endif; ?>
                </a>
            </div>

            <!-- Right Controls: Language & Status -->
            <div class="hidden md:flex items-center gap-5 text-xs font-mono">
                <div class="text-gray-400 select-none">
                    <strong class="text-white cursor-pointer hover:text-emerald-400">EN</strong> 
                    <span class="text-gray-600 mx-1">|</span> 
                    <span class="cursor-pointer hover:text-white">ID</span>
                </div>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-[#08150D] border border-emerald-500/30 text-[11px] text-gray-300 shadow-sm">
                    <span>SYSTEM STATUS</span>
                    <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <strong class="text-white font-bold">DEMO</strong>
                </div>
            </div>

            <!-- Mobile Hamburger Button -->
            <button @click="mobileMenuOpen = true" class="md:hidden p-2 rounded-xl bg-white/5 text-gray-300 border border-white/10 flex items-center justify-center cursor-pointer shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Slide-Out Drawer (Main Nav + Settings + Project Tabs) -->
    <div x-show="mobileMenuOpen" class="md:hidden fixed inset-0 z-[100] flex justify-end" style="display: none;">
        <!-- Backdrop -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="transition-opacity ease-linear duration-300" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             class="fixed inset-0 bg-black/60 backdrop-blur-sm" 
             @click="mobileMenuOpen = false"></div>

        <!-- Right Slide Drawer Panel -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-in-out duration-300 transform" 
             x-transition:enter-start="translate-x-full" 
             x-transition:enter-end="translate-x-0" 
             x-transition:leave="transition ease-in-out duration-300 transform" 
             x-transition:leave-start="translate-x-0" 
             x-transition:leave-end="translate-x-full" 
             class="relative max-w-xs w-full bg-white dark:bg-[#141C12] h-full shadow-2xl flex flex-col justify-between overflow-y-auto border-l border-gray-200 dark:border-gray-800 py-6 px-4">
            
            <div class="space-y-5">
                <!-- Drawer Header -->
                <div class="flex items-center justify-between pb-3 border-b border-gray-200 dark:border-gray-800">
                    <span class="text-xl font-serif font-light text-[#2D5016] dark:text-emerald-400 tracking-[0.3em] uppercase pl-[0.3em]">KALLANI</span>
                    <button @click="mobileMenuOpen = false" class="p-1.5 rounded-lg text-gray-500 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Main Navigation -->
                <div>
                    <span class="block text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-2 px-1">Navigation</span>
                    <nav class="space-y-1">
                        <a href="<?php echo $basePrefix; ?>/" data-i18n="navHome" class="block px-3 py-2 rounded-lg text-sm font-semibold transition-colors <?php echo $cleanCurrentPath === '/' ? 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-300 font-bold' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800'; ?>">Home</a>
                        <a href="<?php echo $basePrefix; ?>/explore" data-i18n="navExplore" class="block px-3 py-2 rounded-lg text-sm font-semibold transition-colors <?php echo strpos($cleanCurrentPath, '/explore') === 0 ? 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-300 font-bold' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800'; ?>">Explore</a>
                    </nav>
                </div>

                <!-- Preferences / Settings -->
                <div class="pt-4 border-t border-gray-200 dark:border-gray-800">
                    <span class="block text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-3 px-1">Preferences</span>
                    <div class="flex items-center justify-between px-1 mb-3">
                        <span class="text-xs text-gray-600 dark:text-gray-400 font-medium">Language</span>
                        <div class="flex items-center p-0.5 rounded-lg bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 font-semibold text-xs text-gray-600 dark:text-gray-300">
                            <button onclick="setLanguage('en')" class="px-2.5 py-1 rounded transition-all cursor-pointer">EN</button>
                            <button onclick="setLanguage('id')" class="px-2.5 py-1 rounded transition-all cursor-pointer">ID</button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between px-1">
                        <span class="text-xs text-gray-600 dark:text-gray-400 font-medium">Theme Mode</span>
                        <button onclick="toggleDarkMode()" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 border border-gray-200 dark:border-gray-700 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        </button>
                    </div>
                </div>

                <?php if ($isProjectPage && $project): ?>
                <!-- Project Tabs Navigation -->
                <div class="pt-4 border-t border-gray-200 dark:border-gray-800">
                    <div class="flex items-center gap-2 mb-2 px-1">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-emerald-800 dark:text-emerald-400">Project Navigation</span>
                    </div>
                    <nav class="space-y-1">
                        <?php 
                        $projectId = $project['id'];
                        $sections = ['Overview', 'Asset', 'Operations', 'Verification', 'Capital', 'Distribution', 'ESG', 'Documents', 'Audit'];
                        foreach ($sections as $section):
                            $url = $section === 'Overview' ? "{$basePrefix}/projects/{$projectId}" : "{$basePrefix}/projects/{$projectId}/" . strtolower($section);
                            $cleanUrl = $section === 'Overview' ? "/projects/{$projectId}" : "/projects/{$projectId}/" . strtolower($section);
                            $isActive = ($cleanCurrentPath === $cleanUrl);
                        ?>
                        <a href="<?php echo $url; ?>" class="sidebar-item <?php echo $isActive ? 'active' : ''; ?>">
                            <?php echo $section; ?>
                        </a>
                        <?php endforeach; ?>
                    </nav>
                </div>
                <?php endif; ?>
            </div>

            <!-- Footer Demo Status -->
            <div class="pt-4 border-t border-gray-200 dark:border-gray-800 flex items-center justify-between text-xs text-gray-500">
                <span>System Status</span>
                <span class="px-2.5 py-0.5 rounded-full font-bold bg-[#F0F0EC] text-[#171717] badge-demo">DEMO</span>
            </div>
        </div>
    </div>

    <?php if ($isProjectPage): ?>
    <!-- Desktop Project Sidebar -->
    <aside class="sidebar">
        <?php if ($project): ?>
        <nav class="mt-2 space-y-1">
            <?php 
            $projectId = $project['id'];
            $cleanCurrentPath = rtrim(str_replace('/kallani/public', '', $currentPath), '/');
            $sections = ['Overview', 'Asset', 'Operations', 'Verification', 'Capital', 'Distribution', 'ESG', 'Documents', 'Audit'];
            foreach ($sections as $section):
                $url = $section === 'Overview' ? "{$basePrefix}/projects/{$projectId}" : "{$basePrefix}/projects/{$projectId}/" . strtolower($section);
                $cleanUrl = $section === 'Overview' ? "/projects/{$projectId}" : "/projects/{$projectId}/" . strtolower($section);
                $isActive = ($cleanCurrentPath === $cleanUrl);
            ?>
            <a href="<?php echo $url; ?>" class="sidebar-item <?php echo $isActive ? 'active' : ''; ?>">
                <?php echo $section; ?>
            </a>
            <?php endforeach; ?>
        </nav>
        <?php endif; ?>
    </aside>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="<?php echo $isProjectPage ? 'main-content' : ($isHomePage ? '' : 'pt-24 pb-12 px-4 sm:px-6 max-w-7xl mx-auto'); ?>">
        <?php echo $content ?? ''; ?>
    </main>

    <?php if (!$isHomePage): ?>
    <!-- Footer -->
    <footer class="bg-white border-t border-[#E5E5E5] py-8 mt-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="flex flex-col space-y-1">
                    <span class="text-xl font-serif font-extrabold tracking-[0.25em] text-[#171717] uppercase leading-none">KALLANI</span>
                    <span class="text-[9px] font-mono tracking-[0.18em] text-[#171717] uppercase leading-none">NINA / OPERATING SYSTEM</span>
                    <p class="text-xs text-[#6B6B6B] mt-2">Operating System for Productive Natural Assets</p>
                </div>
                <div>
                    <h5 class="font-semibold text-[#171717] mb-3 text-sm">Product</h5>
                    <ul class="space-y-2 text-sm text-[#6B6B6B]">
                        <li><a href="<?php echo $basePrefix; ?>/" class="hover:text-[#2D5016]">Platform</a></li>
                        <li><a href="<?php echo $basePrefix; ?>/explore" class="hover:text-[#2D5016]">Projects</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-semibold text-[#171717] mb-3 text-sm">About</h5>
                    <ul class="space-y-2 text-sm text-[#6B6B6B]">
                        <li><a href="#" class="hover:text-[#2D5016]">Demo Environment</a></li>
                        <li><a href="#" class="hover:text-[#2D5016]">Simulated Data</a></li>
                    </ul>
                </div>
                <div>
                    <p class="text-sm text-[#6B6B6B]"><span class="badge-demo">DEMO</span></p>
                    <p class="text-xs text-[#6B6B6B] mt-4">This is a demonstration environment with simulated data.</p>
                </div>
            </div>
            <div class="border-t border-[#E5E5E5] my-6"></div>
            <div class="flex justify-between items-center text-xs text-[#6B6B6B]">
                <p>&copy; 2026 Kallani. All rights reserved.</p>
                <p>Demonstration Environment</p>
            </div>
        </div>
    </footer>
    <?php endif; ?>

    <script src="<?php echo $basePrefix; ?>/js/app.js"></script>
</body>
</html>
