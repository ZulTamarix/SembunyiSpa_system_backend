<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Banner;
use App\Models\Room;
use App\Models\Membership;
use App\Models\Roster\Roster;
use App\Models\Voucher\Voucher_customer;
use App\Models\Package\Package;
use App\Models\Booking\Booking;
use App\Models\Booking\Booking_selected;
use App\Models\Log\Log_booking;
use App\Models\Log\Log_voucher;

class MobileController
{

    // 1) get membership for specific customer
    public function getMembership(string $membership_id)
    {
        try {
            $data = Membership::with(['voucher:id,membership_id,code,description'])
                    ->where('id', $membership_id)
                    ->get()
                    ->map(function ($membership) {
                        return [ 
                            ...$membership->only(
                                'id',
                                'tier',
                                'serial_code',
                                'duration',
                            ),
                            'privilege' =>  $membership->voucher->map(function ($voucher) {
                                return [
                                    'code' => $voucher->code,
                                    'description' => $voucher->description
                                ];
                            })
                        ];
                    });

            return response()->json([
                'status' => true,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // 2) get voucher for specific customer
    public function getVoucher(string $user_id)
    {
        try {
            $data = Voucher_customer::with('voucher', 'log')
                ->where('user_id', $user_id)
                ->get()
                ->map(function ($voucher_customer) {
                    return [ 
                        ...$voucher_customer->only(
                            'id',
                            'date_expired',
                            'quantity',
                            'serial_no',
                        ),
                        'code' =>  $voucher_customer->voucher->code,
                        'description' => $voucher_customer->voucher->description,
                        'log' => $voucher_customer->log->map(function ($log) {
                            return [
                                // 'id' => $log->id,
                                // 'booking_id' => $log->booking_id,
                                'action' => strip_tags($log->action),
                                'date' => $log->created_at->format('Y-m-d'),
                                'time' => $log->created_at->format('H:i'),
                            ];
                        })
                    ];
                });

            return response()->json([
                'status' => true,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // 3) get banner
    public function getBanner()
    {
        return response()->json([
            'status' => true,
            'data' => Banner::where('status', 'active')
                            ->get()
        ]);
    }

    // 4) get treatment list
    public function getTreatment()
    {
        try {
            return response()->json([
                'status' => true,
                'data' => Package::where(fn($q) => $q->where('is_standalone', 1)->orWhereNull('is_standalone'))
                    ->with(
                            'package_category',
                            'package_service',
                            'package_service.service',
                            'package_service.service.package_therapist.therapist',
                            'package_service.service.package_room.room',
                            'package_therapist',
                            'package_therapist.therapist',
                            'package_room',
                            'package_room.room'
                        )
                    ->get()
                    ->map(function ($package) {

                        // package
                        $package_data = $package->except('package_service', 'package_category');
                        // data inside service
                        $format_service = function ($service) {
                            $service->setRelation(
                                'package_therapist',
                                $service->package_therapist->pluck('user_id')->values()
                            );

                            $service->setRelation(
                                'package_room',
                                $service->package_room->pluck('room_id')->values()
                            );

                            $service->unsetRelation('package_service');

                            return $service;
                        };

                        // a)
                        if ($package->type == 'package') {
                            return [
                                'type' => 'package',
                                'treatment' => $package_data,
                                'category' => $package->package_category,
                                'service' => $package->package_service->map(function ($item) use ($format_service) {
                                    return $format_service($item->service);
                                }),
                            ];
                        }
                        // b)
                        else if ($package->type == 'service') {
                            return [
                                'type' => 'service',
                                'treatment' => null,
                                'category' => null,
                                'service' => [
                                    $format_service($package)
                                ],
                            ];
                        }
                    })
                ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // 5a) get therapist + room that available based on 'date' 
    public function getAvailability_date(Request $request)
    {
        try {
            $date = $request->date;

            $query = Booking::where('date_start', $date)
                ->select('id', 'time_start', 'time_end')
                ->get();

            return response()->json([
                'status' => true,
                'data' => $query
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    // 5b) get therapist + room that available based on 'date' + 'time'
    public function getAvailability_dateTime(Request $request)
    {
        try {
            $date = $request->date;
            $time_start = $request->time_start;
            $time_end = $request->time_end;

            $therapist_list = $request->therapist_list;
            $room_list = $request->room_list;

            $available_therapist = Roster::with([
                    'shift',
                    'booking_selected.booking'
                ])
                ->whereDate('date', $date)
                ->whereIn('user_id', $therapist_list)
                ->whereNotNull('roster_shift_id')
                ->whereNull('roster_leave_id')
                ->whereHas('shift', function ($query) use ($time_start, $time_end) {
                    $query->where('time_start', '<=', $time_start)
                        ->where('time_end', '>=', $time_end);
                })
                ->whereDoesntHave('booking_selected.booking', function ($query) use ($date, $time_start, $time_end) {
                    $query->whereDate('date_start', $date)
                        ->where('time_start', '<', $time_end)
                        ->where('time_end', '>', $time_start);
                })
                ->get()
                ->pluck('user');

            $available_room = Room::whereIn('id', $room_list)
                ->whereDoesntHave('booking_selected.booking', function ($query) use ($date, $time_start, $time_end) {
                    $query->whereDate('date_start', $date)
                        ->where('time_start', '<', $time_end)
                        ->where('time_end', '>', $time_start);
                })
                ->get();

            if ($available_therapist->count() > 0 && $available_room->count() > 0) {
                return response()->json([
                    'status' => true,
                    'message' => 'Booking can be made for the selected time'
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Booking cannot be made for the selected time'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // 6) get booking for specific customer
    public function getBooking(string $user_id)
    {
        try {

            $query = Booking::with([
                'booking_selected',
                'user',
                'user_shared',
                'package',
                'log',
                'booking_selected.package',
                'booking_selected.user',
                'booking_selected.room',
            ]);
            
            $data = $query->where('user_id', $user_id)->get()->map(function ($booking) {
                return [
                    ...$booking->only(
                        'date_start',
                        'time_start',
                        'time_end',
                        'payment',
                        'status',
                        'price_original',
                        'price_discount',
                        'price_final',
                    ),
                    'title' =>  $booking->package?->title ?? 
                                $booking->booking_selected[0]->package?->title,
                    'log' => $booking->log->map(function ($log) {
                        return [
                            // 'id' => $log->id,
                            // 'booking_id' => $log->booking_id,
                            'action' => strip_tags($log->action),
                            'date' => $log->created_at->format('Y-m-d'),
                            'time' => $log->created_at->format('H:i'),
                        ];
                    })
                ];
            });

            return response()->json([
                'status' => true,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // 7) create booking
    public function createBooking(Request $request)
    {
        
        try {
            $customer_name = $request->input('customer_name');
            $customer_shared_name = $request->input('customer_shared_name');
            $package_name = $request->input('package_name');
            $voucher_customer_price_id = $request->input('voucher_customer_price_id');
            $voucher_customer_duration_id = $request->input('voucher_customer_duration_id');

            $validated = $request->validate([
                'booking.package_id' => 'nullable|integer',

                'booking.user_id' => 'required|integer',
                'booking.user_shared_id' => 'nullable|integer',
                'booking.date_start' => 'required|date',
                'booking.time_start' => 'required|date_format:H:i',
                'booking.time_end' => 'required|date_format:H:i|after:booking.time_start',
                'booking.price_original' => 'required|numeric',
                'booking.price_discount' => 'required|numeric',
                'booking.price_final' => 'required|numeric',

                'booking_selected' => 'required|array|min:1',
                'booking_selected.*.service_id' => 'nullable|integer',
                'booking_selected.*.room_id' => 'nullable|integer',
                'booking_selected.*.user_id' => 'nullable|integer',
            ]);

            DB::transaction(function () use (
                $validated,
                $customer_name,
                $customer_shared_name,
                $package_name,
                $voucher_customer_price_id,
                $voucher_customer_duration_id
            ) {

                // 1. Create booking
                $booking = Booking::create([
                    'package_id' => $validated['booking']['package_id'] ?? null,
                    'user_id' => $validated['booking']['user_id'],
                    'user_shared_id' => $validated['booking']['user_shared_id'] ?? null,
                    'date_start' => $validated['booking']['date_start'],
                    'time_start' => $validated['booking']['time_start'],
                    'time_end' => $validated['booking']['time_end'],
                    'status' => 'pending',
                    'payment' => 'pending',
                    'booking_type' => 'online',
                    'remark' => null,
                    'price_original' => $validated['booking']['price_original'],
                    'price_discount' => $validated['booking']['price_discount'],
                    'price_final' => $validated['booking']['price_final'],
                ]);

                // 2. Create booking_selected
                foreach ($validated['booking_selected'] as $selected) {
                    Booking_selected::create([
                        'booking_id' => $booking->id,
                        'package_id' => $selected['service_id'],
                        'room_id' => null,
                        'user_id' => null,
                    ]);
                }

                // 3. Create booking log
                Log_booking::create([
                    'booking_id' => $booking->id,
                    'action' => $customer_shared_name
                        ? "&bull; Booked a treatment for <strong style='color: green'>{$customer_shared_name}</strong><br/>"
                        . "&bull; Shared by <strong style='color: green'>{$customer_name}</strong>"
                        : "Booked a treatment for <strong style='color: green'>{$customer_name}</strong>",
                ]);

                // 4. Deduct vouchers
                foreach ([$voucher_customer_price_id, $voucher_customer_duration_id] as $voucher_id) {

                    if ($voucher_id === 'blank') {
                        continue;
                    }

                    $voucher_customer = Voucher_customer::find((int) $voucher_id);

                    if (!$voucher_customer) {
                        continue;
                    }

                    if ($voucher_customer->quantity !== 0 && $voucher_customer->quantity !== null) {
                        $voucher_customer->decrement('quantity', 1);
                    }
                    
                    if ($voucher_customer->quantity === 0) {
                        $voucher_customer->update([
                            'status' => 'redeemed'
                        ]);
                    }

                    Log_voucher::create([
                        'voucher_customer_id' => $voucher_customer->id,
                        'action' => $customer_shared_name
                            ? "&bull; Use by <strong style='color: green'>{$customer_shared_name}</strong> for <strong style='color: green'>{$package_name}</strong> treatment<br/>"
                            . "&bull; Shared by <strong style='color: green'>{$customer_name}</strong>"
                            : "Use by <strong style='color: green'>{$customer_name}</strong> for <strong style='color: green'>{$package_name}</strong> treatment",
                    ]);
                }
            });

            return response()->json([
                'status' => true,
                'message' => 'Booking created successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
