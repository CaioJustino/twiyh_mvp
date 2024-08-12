<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\LodgeController;

// Client
Route::post('/client', [ClientController::class, 'create']); // Rota para criar um novo cliente
Route::get('/client/{id}', [ClientController::class, 'get']); // Rota para mostrar detalhes de um cliente específico
Route::put('/client/{id}', [ClientController::class, 'update']); // Rota para atualizar os detalhes de um cliente
Route::put('/client/pass/{id}', [ClientController::class, 'update_pass']); // Rota para atualizar a senha de um cliente
Route::put('/client/del/{id}', [ClientController::class, 'delete']); // Rota para desativar o cadastro de um cliente

// ClientAddress
Route::post('/client/address/{id}', [ClientController::class, 'create_address']); // Rota para criar o endereço de um cliente
Route::get('/client/address/{id}', [ClientController::class, 'get_address']); // Rota para mostrar detalhes de um endereço de um cliente específico
Route::put('/client/address/{id}', [ClientController::class, 'update_address']); // Rota para atualizar os detalhes de um endereço de um cliente

// Company
Route::post('/company', [CompanyController::class, 'create']); // Rota para criar uma nova empresa
Route::get('/company/{id}', [CompanyController::class, 'get']); // Rota para mostrar detalhes de uma empresa específica
Route::put('/company/{id}', [CompanyController::class, 'update']); // Rota para atualizar os detalhes de uma nova empresa
Route::put('/company/pass/{id}', [CompanyController::class, 'update_pass']); // Rota para atualizar a senha de uma empresa
Route::put('/company/del/{id}', [CompanyController::class, 'delete']); // Rota para desativar o cadastro de uma empresa

// Package
Route::post('/package/{id}', [PackageController::class, 'create']); // Rota para criar um novo pacote
Route::get('/package/{id}', [PackageController::class, 'get']); // Rota para mostrar detalhes de um pacote específico
Route::put('/package/{id}', [PackageController::class, 'update']); // Rota para atualizar os detalhes de um novo pacote
Route::delete('/package/del/{id}', [PackageController::class, 'delete']); // Rota para deletar o cadastro de um pacote

// Lodge
Route::post('/lodge', [LodgeController::class, 'create']); // Rota para criar um novo cliente
Route::get('/lodge/{id}', [LodgeController::class, 'get']); // Rota para mostrar detalhes de um cliente específico
Route::get('/lodge/all', [LodgeController::class, 'get_all']); // Rota para mostrar detalhes de um cliente específico
Route::put('/lodge/{id}', [LodgeController::class, 'update']); // Rota para atualizar os detalhes de um cliente
Route::put('/lodge/del/{id}', [LodgeController::class, 'delete']); // Rota para desativar o cadastro de um cliente

// LodgeAddress
Route::post('/lodge/address/{id}', [LodgeController::class, 'create_address']); // Rota para criar o endereço de um cliente
Route::get('/lodge/address/{id}', [LodgeController::class, 'get_address']); // Rota para mostrar detalhes de um endereço de um cliente específico
Route::put('/lodge/address/{id}', [LodgeController::class, 'update_address']); // Rota para atualizar os detalhes de um endereço de um cliente

// // LodgeFeed
// Route::post('/client', [ClientController::class, 'create']); // Rota para criar um novo cliente
// Route::get('/client/{id}', [ClientController::class, 'get']); // Rota para mostrar detalhes de um cliente específico
// Route::put('/client/{id}', [ClientController::class, 'update']); // Rota para atualizar os detalhes de um cliente
// Route::put('/client/pass/{id}', [ClientController::class, 'update_pass']); // Rota para atualizar a senha de um cliente
// Route::put('/client/del/{id}', [ClientController::class, 'delete']); // Rota para desativar o cadastro de um cliente

// // LodgeList
// Route::post('/client/address/{id}', [ClientController::class, 'create_address']); // Rota para criar o endereço de um cliente
// Route::get('/client/address/{id}', [ClientController::class, 'get_address']); // Rota para mostrar detalhes de um endereço de um cliente específico
// Route::put('/client/address/{id}', [ClientController::class, 'update_address']); // Rota para atualizar os detalhes de um endereço de um cliente