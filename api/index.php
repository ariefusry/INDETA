<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// ============================================================
// Vercel Serverless Fix: Redirect ALL writable paths to /tmp
// Vercel filesystem is read-only except /tmp
// These must be set BEFORE Laravel bootstraps
// ============================================================

$storagePath = '/tmp/storage';
$bootstrapCache = '/tmp/bootstrap/cache';

// Create all required directories BEFORE Laravel boots
$directories = [
    $storagePath . '/app/public',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/testing',
    $storagePath . '/framework/views',
    $storagePath . '/logs',
    $bootstrapCache,
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Set environment variables for paths that Laravel reads during boot
putenv("VIEW_COMPILED_PATH={$storagePath}/framework/views");

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

// Override storage and bootstrap cache paths
$app->useStoragePath($storagePath);
$app->useBootstrapPath('/tmp/bootstrap');
$app->usePublicPath(__DIR__ . '/../public');

// Set configuration values for serverless environment
$app->booted(function ($app) use ($storagePath) {
    $app['config']->set('view.compiled', $storagePath . '/framework/views');
    $app['config']->set('cache.stores.file.path', $storagePath . '/framework/cache/data');
    $app['config']->set('session.files', $storagePath . '/framework/sessions');
});

$app->handleRequest(Request::capture());