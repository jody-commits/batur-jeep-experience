<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ── Public ─────────────────────────────────────────────────
$routes->get('/', 'Home::index');
$routes->get('packages', 'Package::index');

$routes->get('about',    'About::index');
$routes->get('contact',  'Contact::index');
$routes->post('contact', 'Contact::send');

// ── Booking ─────────────────────────────────────────────────
$routes->get('booking',         'Booking::index');
$routes->post('booking',        'Booking::store');
$routes->get('booking/confirm', 'Booking::confirm');

// ── Authentication ──────────────────────────────────────────
$routes->get('auth/login',    'Auth::login');
$routes->post('auth/login',   'Auth::loginPost');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/register','Auth::registerPost');
$routes->get('auth/logout',   'Auth::logout');
