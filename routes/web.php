<?php

use App\Http\Route;

use App\Controllers\DashController;
use App\Controllers\HomeController;
use App\Controllers\PrestController;
use App\Controllers\SuperController;
use App\Middlewares\Adminable;
use App\Middlewares\Authenticable;
use App\Middlewares\Contrauth;
use App\Middlewares\Prestable;
use App\Middlewares\Superable;

Route::Get('/', [HomeController::class, 'index']);

// Auth Routes
Route::Get('/register', [HomeController::class, 'register'], Contrauth::class); // Remove this in production
Route::Post('/register', [HomeController::class, 'storeregister']); // Remove this in production
Route::Get('/login', [HomeController::class, 'login'], Contrauth::class);
Route::Post('/login', [HomeController::class, 'storelogin']);
Route::Get('/logout', [HomeController::class, 'logout'], Authenticable::class);
Route::Get('/profile', [HomeController::class, 'profile'], Authenticable::class);
Route::Get('/password', [HomeController::class, 'password'], Authenticable::class);
Route::Post('/password', [HomeController::class, 'update_password'], Authenticable::class);

// Admin Routes
Route::Get('/dashboard', [DashController::class, 'index'], Adminable::class);
Route::Get('/inventory/sections', [DashController::class, 'show_sections'], Adminable::class);
Route::Post('/inventory/create/section', [DashController::class, 'create_section'], Adminable::class);
Route::Post('/inventory/create/custom', [DashController::class, 'custom_section'], Adminable::class);
Route::Get('/inventory/update/:id/section', [DashController::class, 'updater_section'], Adminable::class);
Route::Post('/inventory/update/:id/section', [DashController::class, 'update_section'], Adminable::class);
Route::Get('/inventory/delete/:id/section', [DashController::class, 'delete_section'], Adminable::class);
Route::Get('/inventory/users', [DashController::class, 'show_users'], Adminable::class);
Route::Post('/inventory/create/user', [DashController::class, 'create_user'], Adminable::class);
Route::Post('/inventory/update/:id/user', [DashController::class, 'update_user'], Adminable::class);
Route::Get('/inventory/update/:id/user', [DashController::class, 'updater_user'], Adminable::class);
Route::Get('/inventory/delete/:id/user', [DashController::class, 'delete_user'], Adminable::class);
Route::Get('/inventory/:id/elements', [DashController::class, 'elements_admin'], Adminable::class);
Route::Get('/inventory/:id/leandings', [DashController::class, 'leandings_admin'], Adminable::class);
Route::Get('/inventory/closed/:id/leandings', [DashController::class, 'closedldg_admin'], Adminable::class);

// Supervisor Routes
Route::Get('/inventory/elements', [SuperController::class, 'show_elements'], Superable::class);
Route::Post('/inventory/create/element', [SuperController::class, 'create_element'], Superable::class);
Route::Get('/inventory/update/:id/element', [SuperController::class, 'updater_element'], Superable::class);
Route::Post('/inventory/update/:id/element', [SuperController::class, 'update_element'], Superable::class);
Route::Get('/inventory/delete/:id/element', [SuperController::class, 'delete_element'], Superable::class);
Route::Get('/inventory/show/:id/element', [SuperController::class, 'show_element'], Superable::class);
Route::Get('/inventory/show/:id/elements', [SuperController::class, 'pdf_elements'], Superable::class);

// Prestamist Routes
Route::Get('/inventory/leandings', [PrestController::class, 'show_leandings'], Prestable::class);
Route::Post('/inventory/create/leandings', [PrestController::class, 'show_create_leanding'], Prestable::class);
Route::Post('/inventory/leandings', [PrestController::class, 'create_leandings'], Prestable::class);
Route::Get('/inventory/update/:id/leanding', [PrestController::class, 'update_leanding'], Prestable::class);
Route::Get('/inventory/delete/:id/leanding', [PrestController::class, 'delete_leanding'], Prestable::class);
Route::Get('/inventory/closed/leandings', [PrestController::class, 'show_close_leandings'], Prestable::class);

// Web Routes
/*
 Route::Get("/platform", [WebController::class, 'index']);
 Route::Get("/platform/reports", [WebController::class, 'reports']);
*/
Route::Get('/not-found', [HomeController::class, 'notfound']);

Route::dispatch();
