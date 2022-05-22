<?php

use App\Http\Controllers\LineMessageController;
use App\Http\Controllers\List_repairController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\MachineController;
use Symfony\Component\Process\Process;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProcessController::class, 'login'])->name("login");
Route::post('/', [ProcessController::class, 'check_login'])->name("check");

Route::middleware(['check_login'])->group(function () {
    Route::get('/alert_menu', function () {
        return view("alert.alert_menu");
    });
    //ProcessController
    Route::get('/index', [ProcessController::class, 'index']);
    Route::get('/checkIn_management', [ProcessController::class, 'checkIn_management']);
    Route::get('/show_user', [ProcessController::class, 'show_user']); //->middleware('auth');
    Route::get('/insert_user', [ProcessController::class, 'insert_user']);
    Route::get('/check_in', [ProcessController::class, 'check_working']);
    Route::get('/logout', [ProcessController::class, 'logout']);
    Route::get('/modify_user/{id}', [ProcessController::class, 'modify_user']);
    Route::post('/modify_user/update', [ProcessController::class, 'user_update']);

    Route::post('/check_in', [ProcessController::class, 'check_in']);
    Route::post('/insert_user/add', [ProcessController::class, 'add_user']);
  
    //MachineController
    Route::get('/detail_check_machine/{id}/{room}', [MachineController::class, 'detail_check_machine']);
    Route::get('/check_machine', [MachineController::class, 'check_machine']);
    Route::get('/insert_machine', [MachineController::class, 'insert_machine']);

    Route::get('/report_check_machine', [MachineController::class, 'report_check_machine']);
    Route::get('/detail_report_check_machine/{id}/{room}/{room_level}', [MachineController::class, 'detail_report_check_machine']);

    Route::get('/back_page', [MachineController::class, 'back_page']);

    Route::post('/row_report_check_machine', [MachineController::class, 'row_report_check_machine']);

    Route::get('/checking_machine/delete/{id}', [MachineController::class, 'delete_descriptions_machine']);
    
    
    Route::get('/remove_machine_room/{id}', [MachineController::class, 'remove_machine_room']);
    Route::get('/modify_machine_room/{id}', [MachineController::class, 'modify_machine_room']);
    Route::post('/modify_machine/update', [MachineController::class, 'machine_update']);
    Route::get('/checking_machine/{id}/{room}/{room_id}/{room_level}', [MachineController::class, 'checking_machine']);

    Route::get('/takephoto', function () {
        return view("layouts.takephoto");
    });

    Route::post('/checking_machine/update', [MachineController::class, 'checking_machine_update']);
    Route::post('/insert_machine/add', [MachineController::class, 'add_machine']);

    //List_RepairControler
    Route::get('/list_repairs', [List_repairController::class, 'list_repair']);
    Route::get('/insert_list_repair', [List_repairController::class, 'form_list_repair']);
    Route::get('/history_list_of_repair', [List_repairController::class, 'history_list_of_repair']);
    Route::get('/process_repair/{id}', [List_repairController::class, 'process_repair']);
    Route::post('/insert_list_repair/add', [List_repairController::class, 'insert_list_repair']);
    Route::post('/set_bookmark', [List_repairController::class, 'set_bookmark']);
    Route::post('/process_repair_update', [List_repairController::class, 'process_repair_update']);
    
});

Route::get('/callLineMessage', [LineMessageController::class, 'getLineGroup']);

// Route::post('/check_login', [ProcessController::class, 'check_login']);


// Route::get('/index', function(){
//     return view('index');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
