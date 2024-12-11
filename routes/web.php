<?php

use App\Actions\ScanTicketAction;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QRCodeController;
use App\Models\Ticket;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/ticket/{group}', function (string $group) {
    $tickets = Ticket::where('group', $group)->get();

    return Inertia::render('Ticket', [
        'tickets' => $tickets
    ]);
});

Route::get('/qr/{groupUuid}/{numberUuid}', QRCodeController::class);
Route::get('/activate/qr/{groupUuid}/{numberUuid}/', function (string $groupUuid, string $numberUuid) {
    $ticket = Ticket::where('group', $groupUuid)->first();
    $scanTicketAction = new ScanTicketAction();
    $scanTicketAction->execute($ticket);
});

require __DIR__ . '/auth.php';
