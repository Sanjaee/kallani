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

if ($uri === '' || $uri === '/') {
    include $baseDir . '/resources/pages/landing.php';
} elseif ($uri === '/explore') {
    include $baseDir . '/resources/pages/explore.php';
} elseif (preg_match('/^\/projects\/([a-z0-9-]+)$/', $uri, $matches)) {
    $_GET['project_id'] = $matches[1];
    include $baseDir . '/resources/pages/project/overview.php';
} elseif (preg_match('/^\/projects\/([a-z0-9-]+)\/asset$/', $uri, $matches)) {
    $_GET['project_id'] = $matches[1];
    include $baseDir . '/resources/pages/project/asset.php';
} elseif (preg_match('/^\/projects\/([a-z0-9-]+)\/operations$/', $uri, $matches)) {
    $_GET['project_id'] = $matches[1];
    include $baseDir . '/resources/pages/project/operations.php';
} elseif (preg_match('/^\/projects\/([a-z0-9-]+)\/verification$/', $uri, $matches)) {
    $_GET['project_id'] = $matches[1];
    include $baseDir . '/resources/pages/project/verification.php';
} elseif (preg_match('/^\/projects\/([a-z0-9-]+)\/capital$/', $uri, $matches)) {
    $_GET['project_id'] = $matches[1];
    include $baseDir . '/resources/pages/project/capital.php';
} elseif (preg_match('/^\/projects\/([a-z0-9-]+)\/distribution$/', $uri, $matches)) {
    $_GET['project_id'] = $matches[1];
    include $baseDir . '/resources/pages/project/distribution.php';
} elseif (preg_match('/^\/projects\/([a-z0-9-]+)\/esg$/', $uri, $matches)) {
    $_GET['project_id'] = $matches[1];
    include $baseDir . '/resources/pages/project/esg.php';
} elseif (preg_match('/^\/projects\/([a-z0-9-]+)\/documents$/', $uri, $matches)) {
    $_GET['project_id'] = $matches[1];
    include $baseDir . '/resources/pages/project/documents.php';
} elseif (preg_match('/^\/projects\/([a-z0-9-]+)\/audit$/', $uri, $matches)) {
    $_GET['project_id'] = $matches[1];
    include $baseDir . '/resources/pages/project/audit.php';
} else {
    http_response_code(404);
    include $baseDir . '/resources/pages/404.php';
}
