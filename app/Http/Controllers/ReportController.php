<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use Carbon\Carbon;

use App\Models\Booking\Booking;

class ReportController
{
    // 1) GET — fetch all
    public function index(Request $request)
    {
        try {
            $switch = $request->input('switch');
            $date_start = $request->input('date_start');
            $date_end = $request->input('date_end');

            // a) Customer
            if ($switch == 'customer') {

                $data = Booking::whereBetween('date_start', [$date_start, $date_end])
                            ->where('status', '!=', 'cancelled')
                            ->with('user')
                            ->get()
                            ->groupBy('user_id') // merge if 'user_id' clashed
                            ->map(function ($bookings) {
                                $booking = $bookings->first();

                                return [
                                    'id' => $booking->id,
                                    'name' => $booking->user->name,
                                    'phoneNo' => $booking->user->phoneNo,
                                    'price' => $bookings->sum('price_final'),
                                    'total' => $bookings->count()
                                ];
                            })
                            ->values();
                return response()->json($data);

            }
            // b) Treatment
            else if ($switch == 'treatment') {

                $data = Booking::whereBetween('date_start', [$date_start, $date_end])
                    ->where('status', '!=', 'cancelled')
                    ->with([
                        'booking_selected',
                        'booking_selected.package',
                        'booking_selected.package.package_category',
                        'package'
                    ])
                    ->get()
                    ->map(function ($booking) {
                        return [
                            'id' => $booking->id,
                            
                            'treatment_id' => $booking->package?->id
                                        ?? $booking->booking_selected?->first()?->package?->id,
                            'treatment' => $booking->package?->title
                                        ?? $booking->booking_selected?->first()?->package?->title,
                            'category' => $booking->package?->package_category->name
                                        ?? $booking->booking_selected?->first()?->package?->package_category->name
                        ];
                    })
                    ->groupBy('treatment_id')
                    ->map(function ($bookings) {
                        $booking = $bookings->first();

                        return [
                            'id' => $booking['id'],
                            'treatment' => $booking['treatment'],
                            'category' => $booking['category'],
                            'total' => $bookings->count()
                        ];
                    })
                    ->values();

                    return response()->json($data);
            }
            // c) Room
            else if ($switch == 'room') {

                $data = Booking::whereBetween('date_start', [$date_start, $date_end])
                    ->where('status', '!=', 'cancelled')
                    ->with([
                        'booking_selected.room',
                    ])
                    ->get()
                    ->map(function ($booking) {
                        return [
                            'id' => $booking->id,
                            'room_id' => $booking->booking_selected->first()?->room->id,
                            'room' => $booking->booking_selected->first()?->room->name,
                            'description' => $booking->booking_selected->first()?->room->description
                        ];
                    })
                    ->groupBy('room_id')
                    ->map(function ($bookings) {
                        $booking = $bookings->first();

                        return [
                            'id' => $booking['id'],
                            'room' => $booking['room'],
                            'description' => $booking['description'],
                            'total' => $bookings->count()
                        ];
                    })
                    ->values();

                    return response()->json($data);
            }
            // d) Therapist
            else if ($switch == 'therapist') {

                $data = Booking::whereBetween('date_start', [$date_start, $date_end])
                    ->where('status', '!=', 'cancelled')
                    ->with([
                        'booking_selected.user',
                    ])
                    ->get()
                    ->map(function ($booking) {
                        return [
                            'id' => $booking->id,
                            'user_id' => $booking->booking_selected->first()?->user->id,
                            'name' => $booking->booking_selected->first()?->user->name,
                            'specialty' => $booking->booking_selected->first()?->user->specialty
                        ];
                    })
                    ->groupBy('user_id')
                    ->map(function ($bookings) {
                        $booking = $bookings->first();

                        return [
                            'id' => $booking['id'],
                            'name' => $booking['name'],
                            'specialty' => $booking['specialty'],
                            'total' => $bookings->count()
                        ];
                    })
                    ->values();

                    return response()->json($data);
            }
            // e) Revenue (RM)
            else if ($switch == 'revenue') {

                $bookings = Booking::whereBetween('date_start', [$date_start, $date_end])
                            ->where('status', '!=', 'cancelled')
                            ->get()
                            ->groupBy(function ($booking) {
                                return Carbon::parse($booking->date_start)->format('Y-m-d');
                            });

                $data = collect(CarbonPeriod::create($date_start, $date_end))
                            ->map(function ($date, $index) use ($bookings) {

                                $date = $date->format('Y-m-d');

                                $dailyBookings = $bookings->get($date, collect());

                                return [
                                    'id' => $index+1,
                                    'date' => $date,
                                    'price' => $dailyBookings->sum('price_final'),
                                ];
                            })
                            ->values();

                return response()->json($data);
            }
            

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
