<?php

use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', UserController::class . "@login");
Route::post('/register', UserController::class . "@register");

Route::post('/checklist', ChecklistController::class . "@save");
Route::delete('/checklist/{id}', ChecklistController::class . "@delete");
Route::get('/checklist', ChecklistController::class . "@get");
Route::get('/checklist/{id}/item', ChecklistController::class . "@detailChecklist");
Route::post('/checklist/{id}/item', ChecklistController::class . "@saveDetailChecklist");
Route::get('/checklist/{id}/item/{itemId}', ChecklistController::class . "@detailChecklistItem");
Route::put('/checklist/{id}/item/{itemId}', ChecklistController::class . "@updateStatusChecklistItem");
Route::delete('/checklist/{id}/item/{itemId}', ChecklistController::class . "@deleteStatusChecklistItem");
Route::put('/checklist/{id}/item/rename/{itemId}', ChecklistController::class . "@renameStatusChecklistItem");
