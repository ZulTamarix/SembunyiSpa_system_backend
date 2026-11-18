<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

// cronJob
use Illuminate\Support\Facades\Schedule;

use App\Models\Banner;
use App\Models\Voucher\Voucher;
use App\Models\Voucher\Voucher_customer;
use App\Models\User;
use App\Models\Booking\Booking;
use App\Models\Notification;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

#region 1) -> Expired by date

    // a) Banner
    Schedule::call(function () {
        Banner::whereDate('date_expired', '<', today())
            ->update([
                'status' => 'inactive'
            ]);
    })->dailyAt('00:00');
    // b) Voucher
    Schedule::call(function () {
        Voucher::whereDate('date_expired', '<', today())
            ->update([
                'status' => 'inactive'
            ]);
    })->dailyAt('00:00');
    // c) Voucher_customer
    Schedule::call(function () {
        Voucher_customer::whereDate('date_expired', '<', today())
            ->update([
                'status' => 'inactive'
            ]);
    })->dailyAt('00:00');
    // d) Membership
    Schedule::call(function () {
        User::whereDate('membership_date_expired', '<', today())
            ->update([
                'membership_id' => null,
                'membership_date_expired' => null,
                'code' => DB::raw("REGEXP_REPLACE(code, '[A-Za-z]', '')"),
            ]);
    })->dailyAt('09:30');

#endregion


#region 2) -> Treatment purpose

    // a) reminder for therapist '30 minute' before treatment
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
