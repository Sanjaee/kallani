<?php
$dataPath = __DIR__ . '/../data.php';
if (!file_exists($dataPath)) {
    $dataPath = dirname(__DIR__) . '/data.php';
}
return require $dataPath;
