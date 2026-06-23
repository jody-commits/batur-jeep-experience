<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ── Public ─────────────────────────────────────────────────
$routes->get('/', 'Home::index');

// ── Authentication ──────────────────────────────────────────
$routes->get('auth/login',    'Auth::login');
$routes->post('auth/login',   'Auth::loginPost');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/register','Auth::registerPost');
$routes->get('auth/logout',   'Auth::logout');
