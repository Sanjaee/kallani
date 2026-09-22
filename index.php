<?php

$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$uri = str_replace('/kallani/public', '', $uri);

// Strip trailing slash except for root '/'
if ($uri !== '/' && substr($uri, -1) === '/') {
    $uri = rtrim($uri, '/');
}

$baseDir = __DIR__;
if (basename($baseDir) === 'public') {
    $baseDir = dirname($baseDir);
}

// Check if static file in public exists
$staticFile = $baseDir . '/public' . $uri;
if ($uri !== '/' && is_file($staticFile)) {
    return false;
}

// Router for NINA Operating System Dashboard
if ($uri === '' || $uri === '/') {
    include $baseDir . '/resources/pages/landing.php';
} elseif ($uri === '/demand' || $uri === '/production-requirements') {
    include $baseDir . '/resources/pages/demand.php';
} elseif ($uri === '/capacity' || $uri === '/capacity-mapping' || preg_match('/^\/production-requirements\/([a-z0-9-]+)\/capacity$/i', $uri) || preg_match('/^\/projects\/([a-z0-9-]+)\/capacity$/i', $uri)) {
    include $baseDir . '/resources/pages/capacity.php';
} elseif ($uri === '/explore') {
    if (isset($_GET['id']) && $_GET['id'] !== '') {
        include $baseDir . '/resources/pages/project_overview.php';
    } else {
        include $baseDir . '/resources/pages/explore.php';
    }
} elseif ($uri === '/allocations/new' || $uri === '/po-allocation' || preg_match('/^\/batches\/([a-z0-9-]+)\/allocate$/i', $uri)) {
    include $baseDir . '/resources/pages/po_allocation.php';
} elseif ($uri === '/allocations' || $uri === '/my-allocations' || preg_match('/^\/my-allocations\/([a-z0-9-]+)$/i', $uri) || preg_match('/^\/projects\/([a-z0-9-]+)\/allocations$/i', $uri)) {
    include $baseDir . '/resources/pages/allocations.php';
} elseif ($uri === '/batches' || preg_match('/^\/batches\/([a-z0-9-]+)$/i', $uri) || preg_match('/^\/projects\/([a-z0-9-]+)\/batches$/i', $uri)) {
    include $baseDir . '/resources/pages/batches.php';
} elseif ($uri === '/project-overview' || preg_match('/^\/explore\/projects\/([a-z0-9-]+)$/i', $uri) || preg_match('/^\/projects\/([a-z0-9-]+)$/i', $uri)) {
    include $baseDir . '/resources/pages/project_overview.php';
} elseif ($uri === '/milestones' || preg_match('/^\/projects\/([a-z0-9-]+)\/milestones$/i', $uri) || preg_match('/^\/projects\/([a-z0-9-]+)\/operations$/i', $uri)) {
    include $baseDir . '/resources/pages/milestones.php';
} elseif ($uri === '/rab' || $uri === '/rab-budget' || preg_match('/^\/projects\/([a-z0-9-]+)\/rab$/i', $uri) || preg_match('/^\/projects\/([a-z0-9-]+)\/capital$/i', $uri)) {
    include $baseDir . '/resources/pages/rab.php';
} elseif ($uri === '/vendors' || $uri === '/partners' || $uri === '/partners-vendors' || preg_match('/^\/vendors\/([a-z0-9-]+)$/i', $uri) || preg_match('/^\/projects\/([a-z0-9-]+)\/vendors$/i', $uri)) {
    include $baseDir . '/resources/pages/vendors.php';
} elseif ($uri === '/verification' || preg_match('/^\/projects\/([a-z0-9-]+)\/verification$/', $uri)) {
    include $baseDir . '/resources/pages/verification.php';
} elseif ($uri === '/documents' || preg_match('/^\/projects\/([a-z0-9-]+)\/documents$/', $uri)) {
    include $baseDir . '/resources/pages/documents.php';
} elseif ($uri === '/commercial-output' || $uri === '/harvest' || $uri === '/delivery' || $uri === '/commercial' || preg_match('/^\/projects\/([a-z0-9-]+)\/commercial$/i', $uri)) {
    include $baseDir . '/resources/pages/commercial_output.php';
} elseif ($uri === '/batch-completion' || $uri === '/completion' || $uri === '/settlement' || preg_match('/^\/projects\/([a-z0-9-]+)\/completion$/i', $uri)) {
    include $baseDir . '/resources/pages/batch_completion.php';
} elseif ($uri === '/network' || $uri === '/production-network' || preg_match('/^\/projects\/([a-z0-9-]+)\/network$/i', $uri)) {
    include $baseDir . '/resources/pages/production_network.php';
} elseif ($uri === '/production-programs' || $uri === '/programs' || preg_match('/^\/production-programs\/([a-z0-9-]+)$/i', $uri)) {
    include $baseDir . '/resources/pages/production_programs.php';
} elseif ($uri === '/audit' || $uri === '/audit-trail' || preg_match('/^\/projects\/([a-z0-9-]+)\/audit$/', $uri)) {
    include $baseDir . '/resources/pages/audit.php';
} elseif ($uri === '/field-guide' || $uri === '/glossary' || $uri === '/guide') {
    include $baseDir . '/resources/pages/field_guide.php';
} else {
    http_response_code(404);
    include $baseDir . '/resources/pages/404.php';
}
