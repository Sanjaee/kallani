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
} elseif ($uri === '/capacity-mapping' || preg_match('/^\/projects\/([a-z0-9-]+)\/capacity$/', $uri)) {
    include $baseDir . '/resources/pages/capacity.php';
} elseif ($uri === '/explore') {
    include $baseDir . '/resources/pages/explore.php';
} elseif ($uri === '/my-allocations' || preg_match('/^\/projects\/([a-z0-9-]+)\/allocations$/', $uri)) {
    include $baseDir . '/resources/pages/allocations.php';
} elseif ($uri === '/batches' || preg_match('/^\/projects\/([a-z0-9-]+)\/batches$/', $uri) || preg_match('/^\/projects\/([a-z0-9-]+)\/asset$/', $uri)) {
    include $baseDir . '/resources/pages/batches.php';
} elseif ($uri === '/milestones' || preg_match('/^\/projects\/([a-z0-9-]+)\/milestones$/', $uri) || preg_match('/^\/projects\/([a-z0-9-]+)\/operations$/', $uri)) {
    include $baseDir . '/resources/pages/milestones.php';
} elseif ($uri === '/rab-budget' || preg_match('/^\/projects\/([a-z0-9-]+)\/rab$/', $uri) || preg_match('/^\/projects\/([a-z0-9-]+)\/capital$/', $uri)) {
    include $baseDir . '/resources/pages/rab.php';
} elseif ($uri === '/vendors' || preg_match('/^\/projects\/([a-z0-9-]+)\/vendors$/', $uri)) {
    include $baseDir . '/resources/pages/vendors.php';
} elseif ($uri === '/verification' || preg_match('/^\/projects\/([a-z0-9-]+)\/verification$/', $uri)) {
    include $baseDir . '/resources/pages/verification.php';
} elseif ($uri === '/documents' || preg_match('/^\/projects\/([a-z0-9-]+)\/documents$/', $uri)) {
    include $baseDir . '/resources/pages/documents.php';
} elseif ($uri === '/audit-trail' || preg_match('/^\/projects\/([a-z0-9-]+)\/audit$/', $uri)) {
    include $baseDir . '/resources/pages/audit.php';
} elseif (preg_match('/^\/projects\/([a-z0-9-]+)$/', $uri)) {
    // Default project view redirects/loads capacity mapping view in dark dashboard
    include $baseDir . '/resources/pages/capacity.php';
} else {
    http_response_code(404);
    include $baseDir . '/resources/pages/404.php';
}
