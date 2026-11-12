<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// cronJob
use Illuminate\Support\Facades\Schedule;

use App\Models\Banner;
use App\Models\Voucher\Voucher;
use App\Models\Voucher\Voucher_customer;

use App\Models\Booking\Booking;
use App\Models\Notification;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// 1) Banner
Schedule::call(function () {
    Banner::whereDate('date_expired', '<', today())
        ->update([
            'status' => 'inactive'
        ]);
})->dailyAt('00:00');
// 2) Voucher
Schedule::call(function () {
    Voucher::whereDate('date_expired', '<', today())
        ->update([
            'status' => 'inactive'
        ]);
})->dailyAt('00:00');
// 3) Voucher_customer
Schedule::call(function () {
    Voucher_customer::whereDate('date_expired', '<', today())
        ->update([
            'status' => 'inactive'
        ]);
})->dailyAt('00:00');

#region -> Treatment purpose

    // 1) reminder for therapist '30 minute' before treatment
    Schedule::call(function () {

        $reminderTime = now()->addMinutes(30);

        $bookings = Booking::with('booking_selected.package', 'package', 'user')
            ->whereDate('date_start', $reminderTime->toDateString())
            ->where('time_start', $reminderTime->format('H:i'))
            ->get();

        foreach ($bookings as $booking) {

            $therapists = $booking->booking_selected
                ->pluck('user_id')
                ->filter()
                ->unique();

            $packageTitle = $booking->package?->title
                ?? $booking->booking_selected->first()?->package?->title
                ?? 'Treatment';

            // 1. Notification for therapist
            foreach ($therapists as $therapist_id) {

                Notification::create([
                    'user_id'     => $therapist_id,
                    'title'       => 'Reminder',
                    'description' => "Your treatment for {$packageTitle} will start in 30 minutes",
                ]);
            }

            // 2. Notification for customer
            Notification::create([
                'user_id'     => $booking->user_id,
                'title'       => 'Reminder',
                'description' => "Your {$packageTitle} treatment will start in 30 minutes",
            ]);
        }

    })->everyMinute();
#endregion
