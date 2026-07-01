<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ── Public ─────────────────────────────────────────────────
$routes->get("/", "Home::index");
$routes->post("reviews", "Home::submitReview");
$routes->get("packages", "Package::index");
$routes->get("about",    "About::index");
$routes->get("contact",  "Contact::index");
$routes->post("contact", "Contact::send");
$routes->get("sitemap.xml", "Sitemap::index");

// ── Booking ─────────────────────────────────────────────────
$routes->get("booking",         "Booking::index");
$routes->post("booking",        "Booking::store");
$routes->get("booking/confirm/(:segment)", "Booking::confirm/$1");

// ── Authentication ──────────────────────────────────────────
$routes->get("auth/login",    "Auth::login");
$routes->post("auth/login",   "Auth::loginPost");
$routes->get("auth/register", "Auth::register");
$routes->post("auth/register","Auth::registerPost");
$routes->get("auth/logout",   "Auth::logout");

// ── User Area ───────────────────────────────────────────────
$routes->get("user/dashboard", "User\Dashboard::index");
$routes->get("user/bookings",  "User\Dashboard::bookings");
$routes->get("user/profile",   "User\Dashboard::profile");
$routes->post("user/profile",  "User\Dashboard::profileUpdate");

// ── DEV ONLY: Test session bypass (remove before production) ─
$routes->get("dev/login-as-user", static function () {
    session()->set([
        "user_id"    => 1,
        "user_name"  => "Budi Santoso",
        "user_email" => "budi@email.com",
        "user_phone" => "081234567890",
        "user_role"  => "user",
        "role"       => "user",
        "logged_in"  => true,
    ]);
    return redirect()->to("/user/dashboard");
});

$routes->get("dev/login-as-admin", static function () {
    session()->set([
        "user_id"    => 99,
        "user_name"  => "System Admin",
        "user_email" => "admin@baturjeep.com",
        "user_role"  => "admin",
        "role"       => "admin",
        "logged_in"  => true,
    ]);
    return redirect()->to("/admin/dashboard");
});

// ── Admin Area ──────────────────────────────────────────────
$routes->get("admin/dashboard", "Admin\Dashboard::index");

$routes->group("admin", static function ($routes) {
    // Admin Bookings
    $routes->get("bookings",               "Admin\Bookings::index");
    $routes->post("bookings/update-status/(:num)", "Admin\Bookings::updateStatus/$1");
    // $routes->post("bookings/confirm/(:num)","Admin\Bookings::confirm/$1");
    // $routes->post("bookings/cancel/(:num)", "Admin\Bookings::cancel/$1");
    // $routes->post("bookings/complete/(:num)","Admin\Bookings::complete/$1");

    // Admin Reviews
    $routes->get("reviews", "Admin\Reviews::index");
    $routes->post("reviews/updateStatus/(:num)", "Admin\Reviews::updateStatus/$1");
    $routes->get("reviews/delete/(:num)", "Admin\Reviews::delete/$1");
});

// Packages CRUD
$routes->get("admin/packages", "Admin\Packages::index");
$routes->get("admin/packages/create", "Admin\Packages::create");
$routes->post("admin/packages/store", "Admin\Packages::store");
$routes->get("admin/packages/edit/(:num)", "Admin\Packages::edit/$1");
$routes->post("admin/packages/update/(:num)", "Admin\Packages::update/$1");
$routes->post("admin/packages/delete/(:num)", "Admin\Packages::delete/$1");

$routes->get("admin/users", "Admin\Users::index");