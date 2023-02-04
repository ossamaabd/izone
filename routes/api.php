<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'Admins','middleware'=>['auth:admin']],function()
{

Route::group(['prefix' => 'Clients'], function () {

    Route::post('/CreateClient', [ClientController::class, 'CreateClient']);
    Route::put('/UpdateClient/{ClientId}', [ClientController::class, 'UpdateClient']);
    Route::delete('/DeleteClient/{ClientId}', [ClientController::class, 'DeleteClient']);
    Route::get('/GetClients', [ClientController::class, 'GetClients']);
    Route::post('/login', [ClientController::class, 'login'])->withoutMiddleware(['auth:admin']);

});

Route::group(['prefix' => 'Tickets' ,  'middleware' => ['auth:admin']], function () {

    Route::post('/CreateTicket', [TicketController::class, 'CreateTicket'])->withoutMiddleware(['auth:admin'])->middleware(['auth:sanctum']);
    Route::put('/UpdateTicket/{TicketId}', [TicketController::class, 'UpdateTicket']);
    Route::delete('/DeleteTicket/{TicketId}', [TicketController::class, 'DeleteTicket']);
    Route::get('/GetTickets', [TicketController::class, 'GetTickets']);

});

Route::group(['prefix' => 'Priority'], function () {

    Route::post('/CreatePriority', [PriorityController::class, 'CreatePriority']);
    Route::put('/UpdatePriority/{PriorityId}', [PriorityController::class, 'UpdatePriority']);
    Route::delete('/DeletePriority/{PriorityId}', [PriorityController::class, 'DeletePriority']);
    Route::get('/GetPriorities', [PriorityController::class, 'GetPriorities']);

});

Route::group(['prefix' => 'Status'], function () {

    Route::post('/CreateStatus', [StatusController::class, 'CreateStatus']);
    Route::put('/UpdateStatus/{StatusId}', [StatusController::class, 'UpdateStatus']);
    Route::delete('/DeleteStatus/{StatusId}', [StatusController::class, 'DeleteStatus']);
    Route::get('/GetStatuses', [StatusController::class, 'GetStatuses']);

});

Route::group(['prefix' => 'Service'], function () {

    Route::post('/CreateService', [ServiceController::class, 'CreateService']);
    Route::put('/UpdateService/{ServiceId}', [ServiceController::class, 'UpdateService']);
    Route::delete('/DeleteService/{ServiceId}', [ServiceController::class, 'DeleteService']);
    Route::post('/CreateService', [ServiceController::class, 'CreateService']);
    Route::get('/GetServices', [ServiceController::class, 'GetServices'])->withoutMiddleware(['auth:admin']);

});

Route::group(['prefix' => 'Technician'], function () {

    Route::post('/CreateTechnician', [TechnicianController::class, 'CreateTechnician']);
    Route::put('/UpdateTechnician/{TechnicianId}', [TechnicianController::class, 'UpdateTechnician']);
    Route::delete('/DeleteTechnician/{TechnicianId}', [TechnicianController::class, 'DeleteTechnician']);
    Route::get('/GetTechnicians', [TechnicianController::class, 'GetTechnicians']);

});

});

Route::post('/login', [AdminController::class, 'login']);
Route::get('/test', [ClientController::class, 'test']);



