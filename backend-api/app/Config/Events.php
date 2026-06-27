<?php

namespace Config;

use CodeIgniter\Events\Events;
use CodeIgniter\Exceptions\FrameworkException;
use CodeIgniter\HotReloader\HotReloader;

/*
 * --------------------------------------------------------------------
 * Application Events
 * --------------------------------------------------------------------
 * Events allow you to tap into the execution of the program without
 * modifying or extending core files. This file provides a central
 * location to define your events, though they can always be added
 * at run-time, also, if needed.
 *
 * You create code that can execute by subscribing to events with
 * the 'on()' method. This accepts any form of callable, including
 * Closures, that will be executed when the event is triggered.
 *
 * Example:
 * Events::on('create', [$myInstance, 'myMethod']);
 */

// --- BERIKUT PENGATURAN CORS GLOBAL UNTUK UAS ---
Events::on('pre_system', function () {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "OPTIONS") {
        die();
    }
});

/*
 * --------------------------------------------------------------------
 * Debug Toolbar Listeners.
 * --------------------------------------------------------------------
 * If you delete, they will no longer be collected.
 */
if (CI_DEBUG && ! is_cli()) {
    Events::on('DBQuery', 'CodeIgniter\Debug\Toolbar\Collectors\Database::collect');
    service('toolbar')->respond();
    
    // Hot Reload route - for framework use on the hot reloader.
    if (ENVIRONMENT === 'development') {
        service('routes')->get('__hot-reload', static function (): void {
            (new HotReloader())->run();
        });
    }
} // <-- Di sini sudah diperbaiki (tidak pakai tanda kurung lagi)