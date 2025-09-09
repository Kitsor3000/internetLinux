<?php

use App\Http\Controllers\BookingPlanController;
use App\Http\Controllers\GamePeriodController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\WeeklyBookingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Models\Participant;

Route::middleware('guest')->group(function () {
    Route::post('/telegram/webhook', function () {

        $update = Telegram::getWebhookUpdate();

        if ($contact = $update->getMessage()->get('contact')) {

            $phone = $update->getMessage()->get('contact')->get('phone_number');
            $firstName = $update->getMessage()->get('contact')->get('first_name');
            $lastName = $update->getMessage()->get('contact')->get('last_name');

            $username = $update->getMessage()->get('from')->get('username');
            $userId = $update->getMessage()->get('from')->get('id');


            $participantQuery = Participant::query();

            $participantQuery->where('phone', $phone);

            $participant = Participant::query()
                ->where('phone', '+'.$phone)
                ->first()
            ;

            if (!$participant) {
                $participant = new Participant();
                $participant->telegram_allowed = false;
                $participant->phone = '+' . $phone;
                $participant->name = $firstName . ' ' . $lastName;
            }

            $participant->joined_date = new DateTime();
            $participant->telegram_username = $username;
            $participant->telegram_id = $userId;
            $participant->save();

            Participant::setCurrentParticipant($participant);

            Telegram::triggerCommand('help', $update);

            return 'ok';
        }


        if ($update->getChat()->get('type') === 'private') {
            Log::info($update->getChat()->get('private'));
            if ($chatId = $update->getChat()->get('id')) {
                $participant = Participant::where('telegram_id', $chatId)->first();
                Participant::setCurrentParticipant($participant);

                if ($participant && !$participant->telegram_allowed) {
                    Telegram::triggerCommand('not_authorized', $update);
                    return 'ok';
                }

                Telegram::commandsHandler(true);
            }
        }

        return 'ok';
    });
});



Route::get('/', function () {
    redirect()->route('participants.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/booking', [BookingPlanController::class, 'index'])->name('booking.index');
    Route::post('/booking', [BookingPlanController::class, 'store'])->name('booking.store');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard/Index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/participants', [ParticipantController::class, 'index'])->name('participants.index');
    Route::get('/participants/create', [ParticipantController::class, 'create'])->name('participants.create');
    Route::post('/participants', [ParticipantController::class, 'store'])->name('participants.store');
    Route::get('/participants/{participant}', [ParticipantController::class, 'show'])->name('participants.show');
    Route::get('/participants/{participant}/edit', [ParticipantController::class, 'edit'])->name('participants.edit');
    Route::put('/participants/{participant}', [ParticipantController::class, 'update'])->name('participants.update');
    Route::delete('/participants/{participant}', [ParticipantController::class, 'destroy'])->name('participants.destroy');
    // GamePeriods
    Route::get('/game_periods', [GamePeriodController::class, 'index'])->name('game_periods.index');
    Route::get('/game_periods/create', [GamePeriodController::class, 'create'])->name('game_periods.create');
    Route::post('/game_periods', [GamePeriodController::class, 'store'])->name('game_periods.store');
    Route::get('/game_periods/{gamePeriod}/edit', [GamePeriodController::class, 'edit'])->name('game_periods.edit');
    Route::put('/game_periods/{gamePeriod}', [GamePeriodController::class, 'update'])->name('game_periods.update');
    Route::get('/pricing', [PriceController::class, 'index'])->name('prices.index');
    Route::put('/pricing/{price}', [PriceController::class, 'update'])->name('prices.update');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/game_periods/{gamePeriod}/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::post('/game_periods/{gamePeriod}/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::get('/game_periods/{gamePeriod}/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
    Route::get('/game_periods/{gamePeriod}/schedules/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
    Route::put('/game_periods/{gamePeriod}/schedules/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
    Route::delete('/game_periods/{gamePeriod}/schedules/{schedule}/destroy', [ScheduleController::class, 'destroy'])->name('schedules.destroy');

    Route::get('/game_periods/{gamePeriod}/weekly_bookings', [WeeklyBookingController::class, 'index'])->name('weekly_bookings.index');
    Route::post('/game_periods/{gamePeriod}/weekly_bookings', [WeeklyBookingController::class, 'store'])->name('weekly_bookings.store');
    Route::delete('/weekly_bookings/{id}', [WeeklyBookingController::class, 'destroy'])->name('weekly_bookings.destroy');
});

require __DIR__.'/auth.php';
