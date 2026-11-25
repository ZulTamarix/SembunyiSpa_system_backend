<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Room;
use App\Models\Membership;
use App\Models\Roster\Roster_leave;
use App\Models\Roster\Roster_shift;
use App\Models\Voucher\Voucher;
use App\Models\Voucher\Voucher_customer;
use App\Models\Package\Package;
use App\Models\Package\Package_category;
use App\Models\Package\Package_therapist;
use App\Models\Package\Package_room;
use App\Models\Package\Package_service;
use App\Models\Roster\Roster;
use App\Models\Banner;
use App\Models\Booking\Booking;
use App\Models\Booking\Booking_selected;

use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        /*
            #region A) --> Testing

                #region 1) --> User
                    User::insert([
                        ['id'=> '1', 'role'=> 'therapist', 'name'=> 'Alicia Tan', 'email'=> 'alicia.tan@example.com', 'phoneNo'=> '0123456789', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> 'Spa Manager', 'code'=> 'C1234', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> '2', 'role'=> 'therapist', 'name'=> 'Daniel Lim', 'email'=> 'daniel.lim@example.com', 'phoneNo'=> '0134567890', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> 'Spa Receiptionist', 'code'=> 'C5678', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> '3', 'role'=> 'therapist', 'name'=> 'Sophia Lee', 'email'=> 'sophia.lee@example.com', 'phoneNo'=> '0145678901', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> 'Manager', 'code'=> 'C9012', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> '4', 'role'=> 'therapist', 'name'=> 'Jason Wong', 'email'=> 'jason.wong@example.com', 'phoneNo'=> '0156789012', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> 'Spa Manager', 'code'=> 'C3456', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> '5', 'role'=> 'therapist', 'name'=> 'Emily Chong', 'email'=> 'emily.chong@example.com', 'phoneNo'=> '0167890123', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> 'Therapist', 'code'=> 'C7890', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> '6', 'role'=> 'customer', 'name'=> 'Ryan Tan', 'email'=> 'ryan.tan@example.com', 'phoneNo'=> '0178901234', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'created_at'=> now(), 'membership_id'=> null, 'membership_date_expired' => null, 'updated_at'=> now()],
                        ['id'=> '7', 'role'=> 'customer', 'name'=> 'Michelle Wong', 'email'=> 'michelle.wong@example.com', 'phoneNo'=> '0189012345', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> '8', 'role'=> 'customer', 'name'=> 'Anthony', 'email'=> 'anthony.wong@example.com', 'phoneNo'=> '0134567890', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null,'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> '9', 'role'=> 'customer', 'name'=> 'Michael', 'email'=> 'michael.wong@example.com', 'phoneNo'=> '0145678901', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> '10', 'role'=> 'customer', 'name'=> 'Farid Hassan', 'email'=> 'farid.hassan@example.com', 'phoneNo'=> '0112345678', 'password'=> null, 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> '11', 'role'=> 'customer', 'name'=> 'Nur Aina', 'email'=> 'nur.aina@example.com', 'phoneNo'=> '0128765432', 'password'=> null, 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> '12', 'role'=> 'customer', 'name'=> 'Kevin Tan', 'email'=> 'kevin.tan@example.com', 'phoneNo'=> '0163456789', 'password'=> null, 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                    
                        ['id'=> '13', 'role'=> 'admin', 'name'=> 'administrator', 'email'=> 'admin', 'phoneNo'=> '0190123456', 'password'=> bcrypt('abc123'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> '14', 'role'=> 'customer', 'name'=> 'Norna', 'email'=> 'test', 'phoneNo'=> '0178901234', 'password'=> bcrypt('abc123'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'created_at'=> now(), 'membership_id'=> null, 'membership_date_expired' => null, 'updated_at'=> now()],
                        ['id'=> '15', 'role'=> 'therapist', 'name'=> 'Norna', 'email'=> 'test2', 'phoneNo'=> '0167890123', 'password'=> bcrypt('abc123'), 'status'=> 'active', 'specialty'=> 'Massage', 'code'=> 'C7890', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                    ]);
                #endregion

                #region 2) --> Roster
                    Roster_shift::insert([
                        ['id' => 1,  'icon' => 1,  'time_start' => '09:00:00', 'time_end' => '17:00:00', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 2,  'icon' => 6,  'time_start' => '10:00:00', 'time_end' => '18:00:00', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 3,  'icon' => 7,  'time_start' => '11:00:00', 'time_end' => '19:00:00', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 4,  'icon' => 8,  'time_start' => '12:00:00', 'time_end' => '20:00:00', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 5,  'icon' => 9,  'time_start' => '13:00:00', 'time_end' => '21:00:00', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 6, 'icon' => 10, 'time_start' => '14:00:00', 'time_end' => '22:00:00', 'created_at' => now(), 'updated_at' => now()],
                    ]);
                    Roster_leave::insert([
                        ['id' => 1, 'icon' => 'OFF', 'description' => 'Off Day', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 2, 'icon' => 'ROD', 'description' => 'Replacement Off Day', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 3, 'icon' => 'PH', 'description' => 'Public Holiday', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 4, 'icon' => 'RPH', 'description' => 'Replacement Public Holiday', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 5, 'icon' => 'MC', 'description' => 'Medical Leave', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 6, 'icon' => 'EL', 'description' => 'Emergency Leave', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 7, 'icon' => 'AL', 'description' => 'Annual Leave', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 8, 'icon' => 'AB', 'description' => 'Absent', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 9, 'icon' => 'TR', 'description' => 'Training', 'created_at' => now(), 'updated_at' => now()],
                    ]);
                    Roster::insert([
                        ['id' => 1, 'user_id' => 15, 'roster_shift_id' => 1, 'roster_leave_id' => null,  'date' => '2026-11-01', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 2, 'user_id' => 2, 'roster_shift_id' => 2, 'roster_leave_id' => null,  'date' => '2026-11-01', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 3, 'user_id' => 3, 'roster_shift_id' => 3, 'roster_leave_id' => null,  'date' => '2026-11-01', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 4, 'user_id' => 4, 'roster_shift_id' => null, 'roster_leave_id' => 1,  'date' => '2026-11-01', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 5, 'user_id' => 5, 'roster_shift_id' => null, 'roster_leave_id' => 2,  'date' => '2026-11-03', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 6, 'user_id' => 15, 'roster_shift_id' => 2, 'roster_leave_id' => null,  'date' => '2026-11-05', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 7, 'user_id' => 2, 'roster_shift_id' => 2, 'roster_leave_id' => null,  'date' => '2026-11-07', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 8, 'user_id' => 15, 'roster_shift_id' => 5, 'roster_leave_id' => null,  'date' => '2026-11-08', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 9, 'user_id' => 3, 'roster_shift_id' => null, 'roster_leave_id' => 6,  'date' => '2026-11-08', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 10, 'user_id' => 5, 'roster_shift_id' => null, 'roster_leave_id' => 5, 'date' => '2026-11-10', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 11, 'user_id' => 4, 'roster_shift_id' => 2, 'roster_leave_id' => null, 'date' => '2026-11-12', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 12, 'user_id' => 2, 'roster_shift_id' => 2, 'roster_leave_id' => null, 'date' => '2026-11-13', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 13, 'user_id' => 4, 'roster_shift_id' => 3, 'roster_leave_id' => null, 'date' => '2026-11-13', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 14, 'user_id' => 5, 'roster_shift_id' => 4, 'roster_leave_id' => null, 'date' => '2026-11-17', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 15, 'user_id' => 15, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-20', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 16, 'user_id' => 2, 'roster_shift_id' => 5, 'roster_leave_id' => null, 'date' => '2026-11-20', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 17, 'user_id' => 15, 'roster_shift_id' => null, 'roster_leave_id' => 1, 'date' => '2026-11-04', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 18, 'user_id' => 3, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-02', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 19, 'user_id' => 4, 'roster_shift_id' => 2, 'roster_leave_id' => null, 'date' => '2026-11-03', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 21, 'user_id' => 3, 'roster_shift_id' => null, 'roster_leave_id' => 5, 'date' => '2026-11-18', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 22, 'user_id' => 4, 'roster_shift_id' => 5, 'roster_leave_id' => null, 'date' => '2026-11-02', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 23, 'user_id' => 2, 'roster_shift_id' => 4, 'roster_leave_id' => null, 'date' => '2026-11-03', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 26, 'user_id' => 3, 'roster_shift_id' => 2, 'roster_leave_id' => null, 'date' => '2026-11-12', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 27, 'user_id' => 4, 'roster_shift_id' => 5, 'roster_leave_id' => null, 'date' => '2026-11-05', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 28, 'user_id' => 15, 'roster_shift_id' => 3, 'roster_leave_id' => null, 'date' => '2026-11-19', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 29, 'user_id' => 5, 'roster_shift_id' => 6, 'roster_leave_id' => null, 'date' => '2026-11-02', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 30, 'user_id' => 2, 'roster_shift_id' => 3, 'roster_leave_id' => null, 'date' => '2026-11-14', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 31, 'user_id' => 4, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-10', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 32, 'user_id' => 3, 'roster_shift_id' => 5, 'roster_leave_id' => null, 'date' => '2026-11-07', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 33, 'user_id' => 5, 'roster_shift_id' => 2, 'roster_leave_id' => null, 'date' => '2026-11-20', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 34, 'user_id' => 15, 'roster_shift_id' => 4, 'roster_leave_id' => null, 'date' => '2026-11-06', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 35, 'user_id' => 3, 'roster_shift_id' => 6, 'roster_leave_id' => null, 'date' => '2026-11-15', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 36, 'user_id' => 2, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-04', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 37, 'user_id' => 4, 'roster_shift_id' => 3, 'roster_leave_id' => null, 'date' => '2026-11-18', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 38, 'user_id' => 5, 'roster_shift_id' => 5, 'roster_leave_id' => null, 'date' => '2026-11-11', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 39, 'user_id' => 2, 'roster_shift_id' => 6, 'roster_leave_id' => null, 'date' => '2026-11-09', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 40, 'user_id' => 15, 'roster_shift_id' => 2, 'roster_leave_id' => null, 'date' => '2026-11-16', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 42, 'user_id' => 3, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-13', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 44, 'user_id' => 15, 'roster_shift_id' => 5, 'roster_leave_id' => null, 'date' => '2026-11-11', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 45, 'user_id' => 3, 'roster_shift_id' => 4, 'roster_leave_id' => null, 'date' => '2026-11-06', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 46, 'user_id' => 2, 'roster_shift_id' => 6, 'roster_leave_id' => null, 'date' => '2026-11-18', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 47, 'user_id' => 4, 'roster_shift_id' => 2, 'roster_leave_id' => null, 'date' => '2026-11-09', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 48, 'user_id' => 15, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-15', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 49, 'user_id' => 5, 'roster_shift_id' => 4, 'roster_leave_id' => null, 'date' => '2026-11-04', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 51, 'user_id' => 3, 'roster_shift_id' => 2, 'roster_leave_id' => null, 'date' => '2026-11-20', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 52, 'user_id' => 4, 'roster_shift_id' => 6, 'roster_leave_id' => null, 'date' => '2026-11-07', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 54, 'user_id' => 5, 'roster_shift_id' => 6, 'roster_leave_id' => null, 'date' => '2026-11-16', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 55, 'user_id' => 15, 'roster_shift_id' => 3, 'roster_leave_id' => null, 'date' => '2026-11-10', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 56, 'user_id' => 4, 'roster_shift_id' => 5, 'roster_leave_id' => null, 'date' => '2026-11-19', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 58, 'user_id' => 5, 'roster_shift_id' => 2, 'roster_leave_id' => null, 'date' => '2026-11-12', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 59, 'user_id' => 2, 'roster_shift_id' => 4, 'roster_leave_id' => null, 'date' => '2026-11-05', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 60, 'user_id' => 15, 'roster_shift_id' => 6, 'roster_leave_id' => null, 'date' => '2026-11-17', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 61, 'user_id' => 3, 'roster_shift_id' => 5, 'roster_leave_id' => null, 'date' => '2026-11-14', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 63, 'user_id' => 15, 'roster_shift_id' => 2, 'roster_leave_id' => null, 'date' => '2026-11-03', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 64, 'user_id' => 4, 'roster_shift_id' => 6, 'roster_leave_id' => null, 'date' => '2026-11-08', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 65, 'user_id' => 2, 'roster_shift_id' => 4, 'roster_leave_id' => null, 'date' => '2026-11-15', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 66, 'user_id' => 5, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-06', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 67, 'user_id' => 3, 'roster_shift_id' => 5, 'roster_leave_id' => null, 'date' => '2026-11-19', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 68, 'user_id' => 2, 'roster_shift_id' => 3, 'roster_leave_id' => null, 'date' => '2026-11-11', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 73, 'user_id' => 5, 'roster_shift_id' => 3, 'roster_leave_id' => null, 'date' => '2026-11-01', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 75, 'user_id' => 15, 'roster_shift_id' => 6, 'roster_leave_id' => null, 'date' => '2026-11-07', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 77, 'user_id' => 4, 'roster_shift_id' => 2, 'roster_leave_id' => null, 'date' => '2026-11-16', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 81, 'user_id' => 4, 'roster_shift_id' => null, 'roster_leave_id' => 2, 'date' => '2026-11-15', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 82, 'user_id' => 2, 'roster_shift_id' => null, 'roster_leave_id' => 5, 'date' => '2026-11-02', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 91, 'user_id' => 5, 'roster_shift_id' => null, 'roster_leave_id' => 4, 'date' => '2026-11-18', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 93, 'user_id' => 5, 'roster_shift_id' => null, 'roster_leave_id' => 9, 'date' => '2026-11-14', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 95, 'user_id' => 3, 'roster_shift_id' => null, 'roster_leave_id' => 7, 'date' => '2026-11-17', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 96, 'user_id' => 2, 'roster_shift_id' => null, 'roster_leave_id' => 3, 'date' => '2026-11-08', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 97, 'user_id' => 4, 'roster_shift_id' => null, 'roster_leave_id' => 8, 'date' => '2026-11-20', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 99, 'user_id' => 5, 'roster_shift_id' => null, 'roster_leave_id' => 1, 'date' => '2026-11-05', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 101, 'user_id' => 5, 'roster_shift_id' => null, 'roster_leave_id' => 4, 'date' => '2026-11-08', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 105, 'user_id' => 5, 'roster_shift_id' => null, 'roster_leave_id' => 2, 'date' => '2026-11-09', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 106, 'user_id' => 2, 'roster_shift_id' => null, 'roster_leave_id' => 8, 'date' => '2026-11-12', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 116, 'user_id' => 3, 'roster_shift_id' => 2, 'roster_leave_id' => null, 'date' => '2026-11-10', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 117, 'user_id' => 4, 'roster_shift_id' => 5, 'roster_leave_id' => null, 'date' => '2026-11-11', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 118, 'user_id' => 15, 'roster_shift_id' => 3, 'roster_leave_id' => null, 'date' => '2026-11-13', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 124, 'user_id' => 15, 'roster_shift_id' => null, 'roster_leave_id' => 9, 'date' => '2026-11-09', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 127, 'user_id' => 5, 'roster_shift_id' => null, 'roster_leave_id' => 5, 'date' => '2026-11-15', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 132, 'user_id' => 3, 'roster_shift_id' => 6, 'roster_leave_id' => null, 'date' => '2026-11-04', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 136, 'user_id' => 15, 'roster_shift_id' => 4, 'roster_leave_id' => null, 'date' => '2026-11-12', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 143, 'user_id' => 4, 'roster_shift_id' => null, 'roster_leave_id' => 2, 'date' => '2026-11-06', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 149, 'user_id' => 15, 'roster_shift_id' => null, 'roster_leave_id' => 4, 'date' => '2026-11-18', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 151, 'user_id' => 15, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-02', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 154, 'user_id' => 5, 'roster_shift_id' => 5, 'roster_leave_id' => null, 'date' => '2026-11-07', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 155, 'user_id' => 3, 'roster_shift_id' => 2, 'roster_leave_id' => null, 'date' => '2026-11-09', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 157, 'user_id' => 5, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-13', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 201, 'user_id' => 3, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-03', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 202, 'user_id' => 4, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-04', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 203, 'user_id' => 3, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-05', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 204, 'user_id' => 2, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-06', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 205, 'user_id' => 2, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-10', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 206, 'user_id' => 3, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-11', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 207, 'user_id' => 4, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-14', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 208, 'user_id' => 15, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-14', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 209, 'user_id' => 2, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-16', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 210, 'user_id' => 3, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-16', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 211, 'user_id' => 2, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-17', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 212, 'user_id' => 4, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-17', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 213, 'user_id' => 2, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-19', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 214, 'user_id' => 5, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-19', 'created_at' => now(), 'updated_at' => now()],
                    ]);
                #endregion

                #region 3) --> Membership
                    Membership::insert([
                        ['id'=> '1', 'tier'=> 'Gold', 'serial_code'=> 'GL', 'duration'=> 12, 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> '2', 'tier'=> 'Silver', 'serial_code'=> 'SL','duration'=> 12, 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> '3', 'tier'=> 'Bronze', 'serial_code'=> 'BR','duration'=> 3, 'created_at'=> now(), 'updated_at'=> now()],
                    ]);
                #endregion

                #region 4) --> Voucher
                    Voucher::insert([
                        ['id' => 1, 'membership_id' => 1, 'code' => 'PERCENT10', 'description' => '10% Welcome Voucher', 'type' => 'gift', 'date_expired' => '2027-01-10', 'status' => 'active', 'discount_type' => 'discount_percentage', 'discount_value' => 10, 'quantity' => 1, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 2, 'membership_id' => 1, 'code' => 'VALUE20', 'description' => 'RM20 Discount Voucher', 'type' => 'promotion', 'date_expired' => '2027-02-15', 'status' => 'active', 'discount_type' => 'discount_amount', 'discount_value' => 20, 'quantity' => null, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 3, 'membership_id' => 1, 'code' => 'SPA15', 'description' => '15% Spa Treatment Discount', 'type' => 'promotion', 'date_expired' => '2027-03-01', 'status' => 'active', 'discount_type' => 'discount_percentage', 'discount_value' => 15, 'quantity' => 20, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 4, 'membership_id' => null, 'code' => 'EXTRA30', 'description' => '30 Minutes Treatment Extension', 'type' => 'gift', 'date_expired' => '2027-03-20', 'status' => 'active', 'discount_type' => 'time_extension', 'discount_value' => 150, 'quantity' => 5, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 5, 'membership_id' => null, 'code' => 'FREEFACIAL', 'description' => 'Complimentary Facial Treatment', 'type' => 'gift', 'date_expired' => '2027-04-10', 'status' => 'active', 'discount_type' => 'complimentary', 'discount_value' => null, 'quantity' => 5, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 6, 'membership_id' => 2, 'code' => 'RELAX25', 'description' => '25% Relaxation Package Discount', 'type' => 'promotion', 'date_expired' => '2027-05-05', 'status' => 'active', 'discount_type' => 'discount_percentage', 'discount_value' => 25, 'quantity' =>null, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 7, 'membership_id' => 2, 'code' => 'RM50OFF', 'description' => 'RM50 Off Premium Package', 'type' => 'promotion', 'date_expired' => '2027-05-25', 'status' => 'inactive', 'discount_type' => 'discount_amount', 'discount_value' => null, 'quantity' => 10, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 8, 'membership_id' => null, 'code' => 'EXTEND15', 'description' => '15 Minutes Complimentary Extension', 'type' => 'gift', 'date_expired' => '2027-06-15', 'status' => 'active', 'discount_type' => 'time_extension', 'discount_value' => 15, 'quantity' => 10, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 9, 'membership_id' => null, 'code' => 'COMPLIMENTSCRUB', 'description' => 'Complimentary Body Scrub', 'type' => 'gift', 'date_expired' => '2027-10-01', 'status' => 'inactive', 'discount_type' => 'complimentary', 'discount_value' => null, 'quantity' => 8, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 10, 'membership_id' => null, 'code' => 'SUMMER10', 'description' => '10% Summer Promotion', 'type' => 'promotion', 'date_expired' => '2027-10-30', 'status' => 'active', 'discount_type' => 'discount_percentage', 'discount_value' => 10, 'quantity' => 25, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 11, 'membership_id' => null, 'code' => 'GIFT30', 'description' => 'RM30 Gift Voucher', 'type' => 'gift', 'date_expired' => '2027-08-15', 'status' => 'inactive', 'discount_type' => 'discount_amount', 'discount_value' => 30, 'quantity' => 5, 'created_at' => now(), 'updated_at' => now()],
                    ]);
                    Voucher_customer::insert([
                        ['id' => 1, 'voucher_id' => 1, 'user_id' => 7, 'serial_no' => null, 'quantity' => 4, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 2, 'voucher_id' => 2, 'user_id' => 7, 'serial_no' => null, 'quantity' => 5, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 3, 'voucher_id' => 4, 'user_id' => 7, 'serial_no' => null, 'quantity' => 10, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 4, 'voucher_id' => 9, 'user_id' => 7, 'serial_no' => null, 'quantity' => 10, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 5, 'voucher_id' => 3, 'user_id' => 8, 'serial_no' => null, 'quantity' => 20, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                    ]);
                #endregion

                #region 5) --> Package + Service
                    Room::insert([
                        ['id'=> 1, 'name'=> 'Bayu', 'description'=> 'Single Room', 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> 2, 'name'=> 'Embun', 'description'=> 'Couple Room', 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> 3, 'name'=> 'Ombak', 'description'=> 'Hair Spa', 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> 4, 'name'=> 'Bunga', 'description'=> 'Single Room', 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> 5, 'name'=> 'Rimba', 'description'=> 'Couple Room', 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> 6, 'name'=> 'Sutra', 'description'=> 'Hair Spa', 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> 7, 'name'=> 'Seri', 'description'=> 'Single Room', 'created_at'=> now(), 'updated_at'=> now()],
                        ['id'=> 8, 'name'=> 'Mentari', 'description'=> 'Couple Room', 'created_at'=> now(), 'updated_at'=> now()],
                    ]);
                    Package_category::insert([
                        ['id' => 1, 'name' => 'Body Massage', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 2, 'name' => 'Body Treatment', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 3, 'name' => 'Sembunyi Spa Signature', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 4, 'name' => 'Hair Spa', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 5, 'name' => 'Sound Therapy', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 6, 'name' => 'Facial', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 7, 'name' => 'Spa Experiences', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 8, 'name' => 'Sembunyi Spa Signature', 'created_at' => now(), 'updated_at' => now()],
                    ]);
                    
                    Package::insert([
                        ['id' => 1, 'type' => 'service', 'poster' => 'Service/service_1.jpg', 'title' => 'Ming Dynasty Princess Ritual',    'duration' => 50, 'price' => 388, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => 'A 2.5-hour East-meets-West spa journey inspired by the Ming dynasty princess. Combines Chinese meridian techniques, aromatherapy massage, and a soothing herbal body treatment.', 'detail' => 'Chinese meridian massageAromatherapy oil massageHerbal body treatmentRelaxing tea ritual', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 2, 'type' => 'service', 'poster' => 'Service/service_2.jpg', 'title' => 'Majapahit Queen Ritual',          'duration' => 40, 'price' => 368, 'gender' => 'single', 'package_category_id' => 2, 'is_standalone' => true, 'description' => 'A 2.5-hour Majapahit-inspired queen ritual. Begins with a Javanese Lulur scrub, continues with a deep Balinese massage, and concludes with a floral bath.', 'detail' => 'Javanese Lulur body scrubBalinese deep tissue massageTraditional floral bathRelaxing aromatherapy', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 4, 'type' => 'service', 'poster' => 'Service/service_3.jpg', 'title' => 'Jasmine Princess Ritual',         'duration' => 30, 'price' => 348, 'gender' => 'single', 'package_category_id' => 2, 'is_standalone' => false, 'description' => 'A feminine 2.5-hour ritual for women drawing on ancient court beauty traditions. Features a gentle full-body massage and jasmine-infused floral bath.', 'detail' => 'Gentle full-body massageJasmine body treatmentJasmine-infused floral bathCalming aromatherapy', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 5, 'type' => 'service', 'poster' => 'Service/service_4.jpg', 'title' => 'Royal Herbal Compress',           'duration' => 50, 'price' => 228, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => false, 'description' => 'A traditional herbal therapy combining warm herbal compresses with a relaxing full-body massage to release muscle tension and restore the body.', 'detail' => 'Warm herbal compressFull-body massageAromatherapy treatmentMuscle tension relief', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 6, 'type' => 'service', 'poster' => 'Service/service_5.jpg', 'title' => 'Balinese Aromatherapy Massage',   'duration' => 80, 'price' => 198, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => 'A relaxing traditional Balinese massage using aromatic essential oils and rhythmic pressure techniques to ease tension and promote deep relaxation.', 'detail' => 'Traditional Balinese massageSelected essential oilsGentle stretching techniquesDeep relaxation treatment', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 3, 'type' => 'package', 'poster' => 'Package/package_1.jpg', 'title' => 'Massage',                         'duration' => 90, 'price' => 230, 'gender' => 'single', 'package_category_id' => 8, 'is_standalone' => null, 'description' => '... Entahlah', 'detail' => 'Traditional massageSelected essential oilsGentle stretching techniquesDeep relaxation treatment', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 7, 'type' => 'package', 'poster' => 'Package/package_2.jpg', 'title' => 'Balinese Aromatherapy Massage',   'duration' => 130, 'price' => 800, 'gender' => 'single', 'package_category_id' => 7, 'is_standalone' => null, 'description' => 'Combination of service 1+2', 'detail' => 'Traditional Balinese massageSelected essential oilsGentle stretching techniquesDeep relaxation treatment', 'created_at' => now(), 'updated_at' => now()],
                    ]);
                    Package_therapist::insert([
                        ['id' => 1, 'package_id' => 1, 'user_id' => 15, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 2, 'package_id' => 1, 'user_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 3, 'package_id' => 1, 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 4, 'package_id' => 2, 'user_id' => 4, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 5, 'package_id' => 6, 'user_id' => 15, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 6, 'package_id' => 6, 'user_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 7, 'package_id' => 6, 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 8, 'package_id' => 6, 'user_id' => 4, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 9, 'package_id' => 6, 'user_id' => 5, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 10, 'package_id' => 4, 'user_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 11, 'package_id' => 4, 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 12, 'package_id' => 5, 'user_id' => 4, 'created_at' => now(), 'updated_at' => now()],
                    ]);
                    Package_room::insert([
                        ['id' => 1, 'package_id' => 1, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 2, 'package_id' => 1, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 3, 'package_id' => 2, 'room_id' => 3, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 4, 'package_id' => 2, 'room_id' => 4, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 5, 'package_id' => 6, 'room_id' => 5, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 6, 'package_id' => 6, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 7, 'package_id' => 6, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 8, 'package_id' => 4, 'room_id' => 3, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 9, 'package_id' => 4, 'room_id' => 4, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 10, 'package_id' => 5, 'room_id' => 5, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 11, 'package_id' => 5, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 12, 'package_id' => 5, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                    ]);
                    Package_service::insert([
                        ['id' => 1, 'package_id' => 3, 'service_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 2, 'package_id' => 3, 'service_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 3, 'package_id' => 7, 'service_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 4, 'package_id' => 7, 'service_id' => 4, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 5, 'package_id' => 7, 'service_id' => 5, 'created_at' => now(), 'updated_at' => now()],
                    ]);
                #endregion

                #region 6) --> Banner
                    Banner::insert([
                        ['id' => 1, 'poster' => 'Service/service_3.jpg', 'title' => 'Balinese Aromatherapy Massage', 'description' => 'Combination of service 1+2', 'date_expired' => '2027-10-12', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 2, 'poster' => 'Service/service_4.jpg', 'title' => 'Massage', 'description' => '... Entahlah', 'date_expired' => '2027-10-12', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 3, 'poster' => 'Service/service_5.jpg', 'title' => 'Advertisement', 'description' => 'Check out our latest offers!', 'date_expired' => '2027-10-12', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                    ]);
                #endregion
        
                #region 7) --> Schedule
                    Booking::insert([
                        ['id' => 1,  'package_id' => null, 'user_id' => 14, 'date_start' => '2026-11-01', 'time_start' => '14:00', 'time_end' => '17:00', 'payment' => 'pending', 'status' => 'booked', 'booking_type' => 'prepaid', 'price_original' => 350, 'price_discount' => 0, 'price_final' => 350, 'remark' => null, 'recorded_time_start' => null, 'recorded_time_end' => null,  'created_at' => now(), 'updated_at' => now()],
                        ['id' => 2,  'package_id' => null, 'user_id' => 7,  'date_start' => '2026-11-03', 'time_start' => '11:30', 'time_end' => '15:30', 'payment' => 'pending', 'status' => 'booked', 'booking_type' => 'prepaid', 'price_original' => 400, 'price_discount' => 0, 'price_final' => 400, 'remark' => null, 'recorded_time_start' => null, 'recorded_time_end' => null,  'created_at' => now(), 'updated_at' => now()],
                        ['id' => 3,  'package_id' => null, 'user_id' => 8,  'date_start' => '2026-11-03', 'time_start' => '13:00', 'time_end' => '16:00', 'payment' => 'pending', 'status' => 'booked', 'booking_type' => 'prepaid', 'price_original' => 250, 'price_discount' => 0, 'price_final' => 250, 'remark' => null, 'recorded_time_start' => null, 'recorded_time_end' => null,  'created_at' => now(), 'updated_at' => now()],
                        ['id' => 4,  'package_id' => null, 'user_id' => 14, 'date_start' => '2026-11-05', 'time_start' => '11:00', 'time_end' => '13:00', 'payment' => 'pending', 'status' => 'booked', 'booking_type' => 'prepaid', 'price_original' => 600, 'price_discount' => 0, 'price_final' => 600, 'remark' => null, 'recorded_time_start' => null, 'recorded_time_end' => null,  'created_at' => now(), 'updated_at' => now()],
                        ['id' => 5,  'package_id' => null, 'user_id' => 8,  'date_start' => '2026-11-08', 'time_start' => '10:30', 'time_end' => '12:00', 'payment' => 'pending', 'status' => 'booked', 'booking_type' => 'prepaid', 'price_original' => 500, 'price_discount' => 0, 'price_final' => 500, 'remark' => null, 'recorded_time_start' => null, 'recorded_time_end' => null,  'created_at' => now(), 'updated_at' => now()],
                        ['id' => 6,  'package_id' => null, 'user_id' => 14, 'date_start' => '2026-11-11', 'time_start' => '10:00', 'time_end' => '11:30', 'payment' => 'pending', 'status' => 'booked', 'booking_type' => 'prepaid', 'price_original' => 450, 'price_discount' => 0, 'price_final' => 450, 'remark' => null, 'recorded_time_start' => null, 'recorded_time_end' => null,  'created_at' => now(), 'updated_at' => now()],
                        ['id' => 7,  'package_id' => null, 'user_id' => 6,  'date_start' => '2026-11-15', 'time_start' => '8:30',  'time_end' => '10:00', 'payment' => 'pending', 'status' => 'booked', 'booking_type' => 'prepaid', 'price_original' => 600, 'price_discount' => 0, 'price_final' => 600, 'remark' => null, 'recorded_time_start' => null, 'recorded_time_end' => null,  'created_at' => now(), 'updated_at' => now()],
                        ['id' => 8,  'package_id' => null, 'user_id' => 6,  'date_start' => '2026-11-15', 'time_start' => '13:00', 'time_end' => '16:00', 'payment' => 'pending', 'status' => 'booked', 'booking_type' => 'prepaid', 'price_original' => 900, 'price_discount' => 0, 'price_final' => 900, 'remark' => null, 'recorded_time_start' => null, 'recorded_time_end' => null,  'created_at' => now(), 'updated_at' => now()],
                        
                        ['id' => 9,  'package_id' => 3, 'user_id' => 6,  'date_start' => '2026-11-03', 'time_start' => '13:00', 'time_end' => '16:00', 'payment' => 'pending', 'status' => 'booked', 'booking_type' => 'prepaid', 'price_original' => 500, 'price_discount' => 0, 'price_final' => 500, 'remark' => null, 'recorded_time_start' => null, 'recorded_time_end' => null,  'created_at' => now(), 'updated_at' => now()],
                        ['id' => 10, 'package_id' => 7, 'user_id' => 6,  'date_start' => '2026-11-05', 'time_start' => '12:00', 'time_end' => '13:00', 'payment' => 'pending', 'status' => 'booked', 'booking_type' => 'prepaid', 'price_original' => 400, 'price_discount' => 0, 'price_final' => 400, 'remark' => null, 'recorded_time_start' => null, 'recorded_time_end' => null,  'created_at' => now(), 'updated_at' => now()],
                        ['id' => 11, 'package_id' => 3, 'user_id' => 6,  'date_start' => '2026-11-10', 'time_start' => '11:00', 'time_end' => '15:00', 'payment' => 'pending', 'status' => 'booked', 'booking_type' => 'prepaid', 'price_original' => 450, 'price_discount' => 0, 'price_final' => 450, 'remark' => null, 'recorded_time_start' => null, 'recorded_time_end' => null,  'created_at' => now(), 'updated_at' => now()],
                    ]);
                    Booking_selected::insert([
                        ['id' => 1, 'booking_id' => 1, 'package_id' => 1, 'room_id' => 5, 'user_id' => 15, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 2, 'booking_id' => 2, 'package_id' => 2, 'room_id' => 3, 'user_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 3, 'booking_id' => 3, 'package_id' => 4, 'room_id' => 7, 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 4, 'booking_id' => 4, 'package_id' => 4, 'room_id' => 7, 'user_id' => 15, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 5, 'booking_id' => 5, 'package_id' => 5, 'room_id' => 4, 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 6, 'booking_id' => 6, 'package_id' => 6, 'room_id' => 2, 'user_id' => 4, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 7, 'booking_id' => 7, 'package_id' => 2, 'room_id' => 1, 'user_id' => 15, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 8, 'booking_id' => 8, 'package_id' => 1, 'room_id' => 4, 'user_id' => 5, 'created_at' => now(), 'updated_at' => now()],

                        ['id' => 9,  'booking_id' => 9, 'package_id' => 1, 'room_id' => 1, 'user_id' => 15, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 10,  'booking_id' => 9, 'package_id' => 2, 'room_id' => 1, 'user_id' => 15, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 11, 'booking_id' => 10, 'package_id' => 4, 'room_id' => 3, 'user_id' => 15, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 12, 'booking_id' => 10, 'package_id' => 5, 'room_id' => 3, 'user_id' => 15, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 13, 'booking_id' => 10, 'package_id' => 3, 'room_id' => 3, 'user_id' => 15, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 14, 'booking_id' => 11, 'package_id' => 1, 'room_id' => 4, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 15, 'booking_id' => 11, 'package_id' => 2, 'room_id' => 4, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                    ]);
                #endregion
        
            #endregion
        */


            #region B) --> Production

                #region 1) -> Membership + Voucher
                    // a.
                        Membership::insert([
                            ['id'=> '1', 'tier'=> 'Gold', 'serial_code'=> 'GLD', 'duration'=> 12, 'created_at'=> now(), 'updated_at'=> now()],
                            ['id'=> '2', 'tier'=> 'Silver', 'serial_code'=> 'SLV','duration'=> 12, 'created_at'=> now(), 'updated_at'=> now()],
                            ['id'=> '3', 'tier'=> 'Pickleball', 'serial_code'=> 'PCL','duration'=> 3, 'created_at'=> now(), 'updated_at'=> now()],
                        ]);
                    // b.
                        Voucher::insert([
                            ['id' => 1,   'membership_id' => 1, 'code' => 'GLD_90MIN',    'type' => 'gift', 'date_expired' => null, 'status' => 'active', 'discount_type' => 'complimentary', 'discount_value' => null, 'quantity' => 12,     'description' => '90 mins Spa Treatment',                                                       'created_at' => now(), 'updated_at' => now()],
                            ['id' => 2,   'membership_id' => 1, 'code' => 'GLD_SPA',      'type' => 'gift', 'date_expired' => null, 'status' => 'active', 'discount_type' => 'complimentary', 'discount_value' => null, 'quantity' => 4,      'description' => 'Unlimited Spa Facilities Access Pass',                                        'created_at' => now(), 'updated_at' => now()],
                            ['id' => 3,   'membership_id' => 1, 'code' => 'GLD_ROOM',     'type' => 'gift', 'date_expired' => null, 'status' => 'active', 'discount_type' => 'complimentary', 'discount_value' => null, 'quantity' => 1,      'description' => '2 Days 1 Night Stay at Executive Deluxe Room with Breakfast for 2 persons ',  'created_at' => now(), 'updated_at' => now()],
                            ['id' => 4,   'membership_id' => 1, 'code' => 'GLD_GYM',      'type' => 'gift', 'date_expired' => null, 'status' => 'active', 'discount_type' => 'complimentary', 'discount_value' => null, 'quantity' => null,   'description' => 'Unlimited Usage of Gymnasium for 1 year',                                     'created_at' => now(), 'updated_at' => now()],
                            ['id' => 5,   'membership_id' => 1, 'code' => 'GLD_FACI',     'type' => 'gift', 'date_expired' => null, 'status' => 'active', 'discount_type' => 'complimentary', 'discount_value' => null, 'quantity' => null,   'description' => 'Unlimited Usage of Spa Facilities Access for 1 year',                         'created_at' => now(), 'updated_at' => now()],
                            ['id' => 6,   'membership_id' => 1, 'code' => 'GLD_20%_SERVICE',     'type' => 'gift', 'date_expired' => null, 'status' => 'active', 'discount_type' => 'discount_percentage', 'discount_value' => 20, 'quantity' => 1,   'description' => '20% Discount on Ala Carte Spa Treatment ',                                   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 7,   'membership_id' => 1, 'code' => 'GLD_50%_BIRTHDAY',    'type' => 'gift', 'date_expired' => null, 'status' => 'active', 'discount_type' => 'discount_percentage', 'discount_value' => 50, 'quantity' => 1,   'description' => '50% Discount for Birthday month ',                                           'created_at' => now(), 'updated_at' => now()],
                            
                            ['id' => 8,   'membership_id' => 2, 'code' => 'SLV_60MIN',    'type' => 'gift', 'date_expired' => null, 'status' => 'active', 'discount_type' => 'complimentary', 'discount_value' => null, 'quantity' => 10,     'description' => '60 minutes Spa Treatment',                                                    'created_at' => now(), 'updated_at' => now()],
                            ['id' => 9,   'membership_id' => 2, 'code' => 'SLV_ROOM',     'type' => 'gift', 'date_expired' => null, 'status' => 'active', 'discount_type' => 'complimentary', 'discount_value' => null, 'quantity' => 2,      'description' => 'Unlimited Spa Facilities Access Pass  ',                                      'created_at' => now(), 'updated_at' => now()],
                            ['id' => 10,  'membership_id' => 2, 'code' => 'SLV_GYM',      'type' => 'gift', 'date_expired' => null, 'status' => 'active', 'discount_type' => 'complimentary', 'discount_value' => null, 'quantity' => null,   'description' => 'Unlimited Usage of Gymnasium for 1 year',                                     'created_at' => now(), 'updated_at' => now()],
                            ['id' => 11,  'membership_id' => 2, 'code' => 'SLV_FACI',     'type' => 'gift', 'date_expired' => null, 'status' => 'active', 'discount_type' => 'complimentary', 'discount_value' => null, 'quantity' => null,   'description' => 'Unlimited Usage of Spa Facilities Access for 1 year',                         'created_at' => now(), 'updated_at' => now()],
                            ['id' => 12,  'membership_id' => 2, 'code' => 'SLV_GIFT',     'type' => 'gift', 'date_expired' => null, 'status' => 'active', 'discount_type' => 'complimentary', 'discount_value' => null, 'quantity' => 1,      'description' => 'Spa Gift Set worth RM150nett ',                                               'created_at' => now(), 'updated_at' => now()],
                            ['id' => 13,  'membership_id' => 2, 'code' => 'SLV_20%_SERVICE',     'type' => 'gift', 'date_expired' => null, 'status' => 'active', 'discount_type' => 'discount_percentage', 'discount_value' => 20, 'quantity' => 1,   'description' => '20% Discount on Ala Carte Spa Treatment ',                                   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 14,  'membership_id' => 2, 'code' => 'SLV_50%_BIRTHDAY',    'type' => 'gift', 'date_expired' => null, 'status' => 'active', 'discount_type' => 'discount_percentage', 'discount_value' => 50, 'quantity' => 1,   'description' => '50% Discount for Birthday month ',                                           'created_at' => now(), 'updated_at' => now()],
                            
                            ['id' => 15,  'membership_id' => 3, 'code' => 'PCL_60MIN',    'type' => 'gift', 'date_expired' => null, 'status' => 'active', 'discount_type' => 'complimentary', 'discount_value' => null, 'quantity' => 3,      'description' => '60 mins SPa Treatment',                                                       'created_at' => now(), 'updated_at' => now()],
                            
                            // for testing only 
                                ['id' => 21,  'membership_id' => null, 'code' => 'TEST_FIXED',      'type' => 'gift', 'date_expired' => null, 'status' => 'active', 'discount_type' => 'discount_amount',       'discount_value' => 100, 'quantity' => 20,      'description' => 'For testing only',                                                       'created_at' => now(), 'updated_at' => now()],
                                ['id' => 22,  'membership_id' => null, 'code' => 'TEST_PERCENT',    'type' => 'gift', 'date_expired' => null, 'status' => 'active', 'discount_type' => 'discount_percentage',   'discount_value' => 20,  'quantity' => 20,      'description' => 'For testing only',                                                       'created_at' => now(), 'updated_at' => now()],
                                ['id' => 23,  'membership_id' => null, 'code' => 'TEST_TIME',       'type' => 'gift', 'date_expired' => null, 'status' => 'active', 'discount_type' => 'time_extension',        'discount_value' => 30,  'quantity' => 20,      'description' => 'For testing only',                                                       'created_at' => now(), 'updated_at' => now()],
                        ]);
                    // c.
                        User::insert([
                            ['id'=> 1, 'role'=> 'admin', 'name'=> 'Administrator', 'email'=> 'admin', 'phoneNo'=> '0190123456', 'password'=> bcrypt('sembunyi123'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                            
                            ['id'=> 2,  'role'=> 'customer', 'name'=> 'Mr Ahmed Shoshaa',                 'email'=> '', 'phoneNo'=> '010 714 4794',     'password'=> null, 'status'=> 'active', 'specialty'=> null, 'code'=> '1',       'membership_id'=> null, 'membership_date_expired' => null,         'created_at'=> now(), 'updated_at'=> now()],
                            ['id'=> 3,  'role'=> 'customer', 'name'=> 'Ms Azleen Rosemy Ahmad',           'email'=> '', 'phoneNo'=> '012 311 1665',     'password'=> null, 'status'=> 'active', 'specialty'=> null, 'code'=> 'SLV2',    'membership_id'=> 2,    'membership_date_expired' => '2026-12-05', 'created_at'=> now(), 'updated_at'=> now()],
                            ['id'=> 4,  'role'=> 'customer', 'name'=> 'Miss Chika Asada',                 'email'=> '', 'phoneNo'=> '011 317 51136',    'password'=> null, 'status'=> 'active', 'specialty'=> null, 'code'=> 'SLV3',    'membership_id'=> 2,    'membership_date_expired' => '2027-01-19', 'created_at'=> now(), 'updated_at'=> now()],
                            ['id'=> 5,  'role'=> 'customer', 'name'=> 'Mr Raageavendra Rao',              'email'=> '', 'phoneNo'=> '016 410 5305',     'password'=> null, 'status'=> 'active', 'specialty'=> null, 'code'=> 'SLV4',    'membership_id'=> 2,    'membership_date_expired' => '2027-03-24', 'created_at'=> now(), 'updated_at'=> now()],
                            ['id'=> 6,  'role'=> 'customer', 'name'=> 'Mr Surendran',                     'email'=> '', 'phoneNo'=> '016 499 8902',     'password'=> null, 'status'=> 'active', 'specialty'=> null, 'code'=> 'SLV5',    'membership_id'=> 2,    'membership_date_expired' => '2027-03-26', 'created_at'=> now(), 'updated_at'=> now()],
                            ['id'=> 7,  'role'=> 'customer', 'name'=> 'Miss Adi Fatin Izdihar Norhisham', 'email'=> '', 'phoneNo'=> '',                 'password'=> null, 'status'=> 'active', 'specialty'=> null, 'code'=> 'SLV6',    'membership_id'=> 2,    'membership_date_expired' => '2027-07-09', 'created_at'=> now(), 'updated_at'=> now()],
                            ['id'=> 8,  'role'=> 'customer', 'name'=> 'Mr Julian R',                      'email'=> '', 'phoneNo'=> '012 5160140',      'password'=> null, 'status'=> 'active', 'specialty'=> null, 'code'=> 'SLV7',    'membership_id'=> 2,    'membership_date_expired' => '2027-09-03', 'created_at'=> now(), 'updated_at'=> now()],
                            ['id'=> 9,  'role'=> 'customer', 'name'=> 'Ms Mariam Mior Sallehhuddin',      'email'=> '', 'phoneNo'=> '019 371 6057',     'password'=> null, 'status'=> 'active', 'specialty'=> null, 'code'=> 'SLV8',    'membership_id'=> 2,    'membership_date_expired' => '2027-09-27', 'created_at'=> now(), 'updated_at'=> now()],
                        
                            ['id'=> 10, 'role'=> 'customer', 'name'=> 'Miss Duna',                        'email'=> '', 'phoneNo'=> '016 206 2777',     'password'=> null, 'status'=> 'active', 'specialty'=> null, 'code'=> 'GLD9',    'membership_id'=> 1,    'membership_date_expired' => '2027-05-11', 'created_at'=> now(), 'updated_at'=> now()],
                            ['id'=> 11, 'role'=> 'customer', 'name'=> 'Miss Thilaga Shanmugam',           'email'=> '', 'phoneNo'=> '018 987 5975',     'password'=> null, 'status'=> 'active', 'specialty'=> null, 'code'=> 'GLD10',   'membership_id'=> 1,    'membership_date_expired' => '2027-10-23', 'created_at'=> now(), 'updated_at'=> now()],
                        
                            ['id'=> 12, 'role'=> 'customer', 'name'=> 'Dato Farid Ravi',                  'email'=> '', 'phoneNo'=> '019 241 0062',     'password'=> null, 'status'=> 'active', 'specialty'=> null, 'code'=> 'PCL11',   'membership_id'=> 3,    'membership_date_expired' => '2027-01-27', 'created_at'=> now(), 'updated_at'=> now()],
                            ['id'=> 13, 'role'=> 'customer', 'name'=> 'Mr Yoshi',                         'email'=> '', 'phoneNo'=> '017 309 3423',     'password'=> null, 'status'=> 'active', 'specialty'=> null, 'code'=> 'PCL12',   'membership_id'=> 3,    'membership_date_expired' => '2027-02-11', 'created_at'=> now(), 'updated_at'=> now()],
                        
                        
                            // for testing only
                                ['id'=> 21, 'role'=> 'therapist', 'name'=> 'Daniel Lim',  'email'=> 'daniel.lim@example.com', 'phoneNo'=> '0134567890', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> 'Spa Receiptionist', 'code'=> 'C5678', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                                ['id'=> 22, 'role'=> 'therapist', 'name'=> 'Emily Chong', 'email'=> 'emily.chong@example.com', 'phoneNo'=> '0167890123','password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> 'Therapist', 'code'=> 'C7890', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                            // for norna
                                ['id'=> 23, 'role'=> 'customer', 'name'=> 'Norna', 'email'=> 'test', 'phoneNo'=> '0178901234', 'password'=> bcrypt('abc123'), 'status'=> 'active', 'specialty'=> null, 'code'=> 'GLD20', 'created_at'=> now(), 'membership_id'=> 1, 'membership_date_expired' => '2027-03-03', 'updated_at'=> now()],
                                ['id'=> 24, 'role'=> 'therapist', 'name'=> 'Norna', 'email'=> 'test2', 'phoneNo'=> '0167890123', 'password'=> bcrypt('abc123'), 'status'=> 'active', 'specialty'=> 'Massage', 'code'=> 'C7890', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                        ]);
                    // d.
                        Voucher_customer::insert([
                            // User 2
                            ['id' => 1,  'voucher_id' => 8,  'user_id' => 2, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 10,   'date_expired' => '2026-11-23', 'status' => 'expired', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 2,  'voucher_id' => 9,  'user_id' => 2, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 2,    'date_expired' => '2026-11-23', 'status' => 'expired', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 3,  'voucher_id' => 10, 'user_id' => 2, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2026-11-23', 'status' => 'expired', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 4,  'voucher_id' => 11, 'user_id' => 2, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2026-11-23', 'status' => 'expired', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 5,  'voucher_id' => 12, 'user_id' => 2, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2026-11-23', 'status' => 'expired', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 6,  'voucher_id' => 13, 'user_id' => 2, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2026-11-23', 'status' => 'expired', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 7,  'voucher_id' => 14, 'user_id' => 2, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2026-11-23', 'status' => 'expired', 'created_at' => now(), 'updated_at' => now()],

                            // User 3
                            ['id' => 8,  'voucher_id' => 8,  'user_id' => 3, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 10,   'date_expired' => '2026-12-05', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 9,  'voucher_id' => 9,  'user_id' => 3, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 2,    'date_expired' => '2026-12-05', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 10, 'voucher_id' => 10, 'user_id' => 3, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2026-12-05', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 11, 'voucher_id' => 11, 'user_id' => 3, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2026-12-05', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 12, 'voucher_id' => 12, 'user_id' => 3, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2026-12-05', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 13, 'voucher_id' => 13, 'user_id' => 3, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2026-12-05', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 14, 'voucher_id' => 14, 'user_id' => 3, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2026-12-05', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],

                            // User 4
                            ['id' => 15, 'voucher_id' => 8,  'user_id' => 4, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 10,   'date_expired' => '2027-01-19', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 16, 'voucher_id' => 9,  'user_id' => 4, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 2,    'date_expired' => '2027-01-19', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 17, 'voucher_id' => 10, 'user_id' => 4, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2027-01-19', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 18, 'voucher_id' => 11, 'user_id' => 4, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2027-01-19', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 19, 'voucher_id' => 12, 'user_id' => 4, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-01-19', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 20, 'voucher_id' => 13, 'user_id' => 4, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-01-19', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 21, 'voucher_id' => 14, 'user_id' => 4, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-01-19', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],

                            // User 5
                            ['id' => 22, 'voucher_id' => 8,  'user_id' => 5, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 10,   'date_expired' => '2027-03-24', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 23, 'voucher_id' => 9,  'user_id' => 5, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 2,    'date_expired' => '2027-03-24', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 24, 'voucher_id' => 10, 'user_id' => 5, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2027-03-24', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 25, 'voucher_id' => 11, 'user_id' => 5, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2027-03-24', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 26, 'voucher_id' => 12, 'user_id' => 5, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-03-24', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 27, 'voucher_id' => 13, 'user_id' => 5, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-03-24', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 28, 'voucher_id' => 14, 'user_id' => 5, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-03-24', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],

                            // User 6
                            ['id' => 29, 'voucher_id' => 8,  'user_id' => 6, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 10,   'date_expired' => '2027-03-26', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 30, 'voucher_id' => 9,  'user_id' => 6, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 2,    'date_expired' => '2027-03-26', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 31, 'voucher_id' => 10, 'user_id' => 6, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2027-03-26', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 32, 'voucher_id' => 11, 'user_id' => 6, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2027-03-26', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 33, 'voucher_id' => 12, 'user_id' => 6, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-03-26', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 34, 'voucher_id' => 13, 'user_id' => 6, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-03-26', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 35, 'voucher_id' => 14, 'user_id' => 6, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-03-26', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],

                            // User 7
                            ['id' => 36, 'voucher_id' => 8,  'user_id' => 7, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 10,   'date_expired' => '2027-07-09', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 37, 'voucher_id' => 9,  'user_id' => 7, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 2,    'date_expired' => '2027-07-09', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 38, 'voucher_id' => 10, 'user_id' => 7, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2027-07-09', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 39, 'voucher_id' => 11, 'user_id' => 7, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2027-07-09', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 40, 'voucher_id' => 12, 'user_id' => 7, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-07-09', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 41, 'voucher_id' => 13, 'user_id' => 7, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-07-09', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 42, 'voucher_id' => 14, 'user_id' => 7, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-07-09', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],

                            // User 8
                            ['id' => 43, 'voucher_id' => 8,  'user_id' => 8, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 10,   'date_expired' => '2027-09-03', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 44, 'voucher_id' => 9,  'user_id' => 8, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 2,    'date_expired' => '2027-09-03', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 45, 'voucher_id' => 10, 'user_id' => 8, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2027-09-03', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 46, 'voucher_id' => 11, 'user_id' => 8, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2027-09-03', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 47, 'voucher_id' => 12, 'user_id' => 8, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-09-03', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 48, 'voucher_id' => 13, 'user_id' => 8, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-09-03', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 49, 'voucher_id' => 14, 'user_id' => 8, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-09-03', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],

                            // User 9
                            ['id' => 50, 'voucher_id' => 8,  'user_id' => 9, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 10,   'date_expired' => '2027-09-27', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 51, 'voucher_id' => 9,  'user_id' => 9, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 2,    'date_expired' => '2027-09-27', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 52, 'voucher_id' => 10, 'user_id' => 9, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2027-09-27', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 53, 'voucher_id' => 11, 'user_id' => 9, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2027-09-27', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 54, 'voucher_id' => 12, 'user_id' => 9, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-09-27', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 55, 'voucher_id' => 13, 'user_id' => 9, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-09-27', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 56, 'voucher_id' => 14, 'user_id' => 9, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-09-27', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            
                            // User 10
                            ['id' => 57, 'voucher_id' => 1, 'user_id' => 10, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 12,   'date_expired' => '2027-05-11', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 58, 'voucher_id' => 2, 'user_id' => 10, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 4,    'date_expired' => '2027-05-11', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 59, 'voucher_id' => 3, 'user_id' => 10, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-05-11', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 60, 'voucher_id' => 4, 'user_id' => 10, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2027-05-11', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 61, 'voucher_id' => 5, 'user_id' => 10, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2027-05-11', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 62, 'voucher_id' => 6, 'user_id' => 10, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-05-11', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 63, 'voucher_id' => 7, 'user_id' => 10, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-05-11', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],

                            // User 11
                            ['id' => 64, 'voucher_id' => 1, 'user_id' => 11, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 12,   'date_expired' => '2027-10-23', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 65, 'voucher_id' => 2, 'user_id' => 11, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 4,    'date_expired' => '2027-10-23', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 66, 'voucher_id' => 3, 'user_id' => 11, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-10-23', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 67, 'voucher_id' => 4, 'user_id' => 11, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2027-10-23', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 68, 'voucher_id' => 5, 'user_id' => 11, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2027-10-23', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 69, 'voucher_id' => 6, 'user_id' => 11, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-10-23', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 70, 'voucher_id' => 7, 'user_id' => 11, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-10-23', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],

                            // User 12
                            ['id' => 71,    'voucher_id' => 15, 'user_id' => 12, 'serial_no' => strtoupper(str::random(8)), 'quantity' => 3,  'date_expired' => '2027-01-27',  'status' => 'active',     'created_at' => now(), 'updated_at' => now()],
                            
                            // User 13
                            ['id' => 72,    'voucher_id' => 15, 'user_id' => 13, 'serial_no' => strtoupper(str::random(8)), 'quantity' => 3,  'date_expired' => '2027-02-11',  'status' => 'active',     'created_at' => now(), 'updated_at' => now()],
                        
                        
                            // For testing only
                                ['id' => 80, 'voucher_id' => 8,  'user_id' => 23, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 10,   'date_expired' => '2027-03-24', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                                ['id' => 81, 'voucher_id' => 9,  'user_id' => 23, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 2,    'date_expired' => '2027-03-24', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                                ['id' => 82, 'voucher_id' => 10, 'user_id' => 23, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2027-03-24', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                                ['id' => 83, 'voucher_id' => 11, 'user_id' => 23, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => null, 'date_expired' => '2027-03-24', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                                ['id' => 84, 'voucher_id' => 12, 'user_id' => 23, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-03-24', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                                ['id' => 85, 'voucher_id' => 13, 'user_id' => 23, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-03-24', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                                ['id' => 86, 'voucher_id' => 14, 'user_id' => 23, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 1,    'date_expired' => '2027-03-24', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                                ['id' => 87, 'voucher_id' => 21, 'user_id' => 23, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 20,    'date_expired' => '2027-03-24', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                                ['id' => 88, 'voucher_id' => 22, 'user_id' => 23, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 20,    'date_expired' => '2027-03-24', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                                ['id' => 89, 'voucher_id' => 23, 'user_id' => 23, 'serial_no' => strtoupper(Str::random(8)), 'quantity' => 20,    'date_expired' => '2027-03-24', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],

                        ]);
                #endregion


                #region 2) -> Treatment
                    // a.
                        Room::insert([
                            ['id'=> 1, 'name'=> 'Bayu', 'description'=> 'Single Room', 'created_at'=> now(), 'updated_at'=> now()],
                            ['id'=> 2, 'name'=> 'Embun', 'description'=> 'Couple Room', 'created_at'=> now(), 'updated_at'=> now()],
                        ]);
                    // b.
                        Package_category::insert([
                            ['id' => 1, 'name' => 'Body Massage', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 2, 'name' => 'Body Treatment', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 3, 'name' => 'Sembunyi Spa Signature', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 4, 'name' => 'Hair Spa', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 5, 'name' => 'Sound Therapy', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 6, 'name' => 'Facial', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 7, 'name' => 'Spa Experiences', 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 8, 'name' => 'Sembunyi Spa Signature', 'created_at' => now(), 'updated_at' => now()],
                        ]);
                    // c.
                        Package::insert([
                            ['id' => 1,  'type' => 'package',  'poster' => 'Service/service_1.jpg',  'title' => 'Parameswara Experience',                                'duration' => 150, 'price' => 408.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => null, 'description' => "Restore Strength & Vital Energy\nRelieve deep muscle tension, improve circulation, and revitalise your body\n75 mins Deep Relaxing Massage\n45 mins Tongkat Ali Body Scrub\n30 mins Aromatic Bath\nBest for: Muscle fatigue, stress relief, energy boost",                                                                  'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 2,  'type' => 'package',  'poster' => 'Service/service_2.jpg',  'title' => 'Dara Pethak Experience',                                'duration' => 150, 'price' => 408.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => null, 'description' => "Gentle Relaxation & Skin Nourishment\nA calming journey to soften the skin and soothe emotional tension.\n75 mins Seven Flowers Relaxing Massage\n45 mins Seven Herbs Body Scrub\n30 mins Flower Milk Bath\nBest for: Relaxation, glowing skin, first-time spa guests",                                                     'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 3,  'type' => 'package',  'poster' => 'Service/service_3.jpg',  'title' => 'Ratu Tribhuwana Experience',                            'duration' => 150, 'price' => 408.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => null, 'description' => "Firming & Body Revitalisation\nEnhance circulation and improve skin tone with this invigorating ritual.\n75 mins Firming Body Massage\n45 mins Body Shaper Mask\n30 mins Lime Bath\nBest for: Body toning, detox, circulation boost",                                                                                       'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 21,  'type' => 'service',  'poster' => 'Service/service_16.jpg',  'title' => 'Seven Flowers Relaxing Massage ',        'duration' => 75, 'price' => 0.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => false, 'description' => "", 'detail' => "",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 22,  'type' => 'service',  'poster' => 'Service/service_16.jpg',  'title' => 'Body Shaper Mask',                       'duration' => 45, 'price' => 0.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => false, 'description' => "", 'detail' => "",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 23,  'type' => 'service',  'poster' => 'Service/service_16.jpg',  'title' => 'Flower Milk Bath',                       'duration' => 30, 'price' => 0.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => false, 'description' => "", 'detail' => "",   'created_at' => now(), 'updated_at' => now()],
                        
                            ['id' => 4,  'type' => 'service',  'poster' => 'Service/service_4.jpg',  'title' => 'Hang Li Po Experience ',                                'duration' => 150, 'price' => 408.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => "Body & Facial Rejuvenation\nA perfect harmony of body relaxation and facial renewal.\n75 mins Energising Body Massage\n45 mins Seven Spices Body Scrub\n30 mins Oriental Facial\nBest for: Full rejuvenation, skin + body care",                                                                                            'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 5,  'type' => 'service',  'poster' => 'Service/service_5.jpg',  'title' => 'Sembunyi Spa Signature - The Mahabrata Experience',     'duration' => 90,  'price' => 328.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => "This signature treatment blends a natural candlenut body scrub with a Balinese massage performed in one seamless flow. Gentle exfoliation refreshes the skin, while rhythmic massage movements relax the body and calm the mind.\nBest for: First-time guests, all-in-one experience",                                      'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 6,  'type' => 'service',  'poster' => 'Service/service_6.jpg',  'title' => 'Balinese Massage ',                                     'duration' => 60,  'price' => 218.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => "Various tempos of acupressure, rolling motions, long strokes and percussion are applied to invigorate and energise the body.",                                                                                                                                                                                              'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 7,  'type' => 'service',  'poster' => 'Service/service_6.jpg',  'title' => 'Balinese Massage ',                                     'duration' => 90,  'price' => 308.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => "Various tempos of acupressure, rolling motions, long strokes and percussion are applied to invigorate and energise the body.",                                                                                                                                                                                              'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 8,  'type' => 'service',  'poster' => 'Service/service_7.jpg',  'title' => 'Malay Massage',                                         'duration' => 60,  'price' => 218.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => "Strokes focus on the muscles. Pressure is applied to various selected points on the body to help lengthen muscles, increase circulation and relieve stress and tension. ",                                                                                                                                                  'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 9,  'type' => 'service',  'poster' => 'Service/service_7.jpg',  'title' => 'Malay Massage',                                         'duration' => 90,  'price' => 308.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => "Strokes focus on the muscles. Pressure is applied to various selected points on the body to help lengthen muscles, increase circulation and relieve stress and tension. ",                                                                                                                                                  'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 10, 'type' => 'service',  'poster' => 'Service/service_8.jpg',  'title' => 'Swedish Massage',                                       'duration' => 60,  'price' => 218.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => "A classic oil massage with rhythmic strokes works predominantly with the muscles, soft tissues and joints while increasing blood circulation and easing muscle tension. ",                                                                                                                                                  'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 11, 'type' => 'service',  'poster' => 'Service/service_8.jpg',  'title' => 'Swedish Massage',                                       'duration' => 90,  'price' => 308.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => "A classic oil massage with rhythmic strokes works predominantly with the muscles, soft tissues and joints while increasing blood circulation and easing muscle tension. ",                                                                                                                                                  'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 12, 'type' => 'service',  'poster' => 'Service/service_9.jpg',  'title' => 'Aroma Massage',                                         'duration' => 60,  'price' => 218.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => "A gentle and relaxing massage using selection of essential oil help increase the energy flow, improve circulation and relieve stress. ",                                                                                                                                                                                    'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 13, 'type' => 'service',  'poster' => 'Service/service_9.jpg',  'title' => 'Aroma Massage',                                         'duration' => 90,  'price' => 308.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => "A gentle and relaxing massage using selection of essential oil help increase the energy flow, improve circulation and relieve stress. ",                                                                                                                                                                                    'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 14, 'type' => 'service',  'poster' => 'Service/service_10.jpg', 'title' => 'Reflexology Massage',                                   'duration' => 60,  'price' => 218.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => "Pressure is applied on reflex points to relieve tiredness and restore natural functions to related areas of the body. ",                                                                                                                                                                                                    'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 15, 'type' => 'service',  'poster' => 'Service/service_10.jpg', 'title' => 'Reflexology Massage',                                   'duration' => 90,  'price' => 308.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => "Pressure is applied on reflex points to relieve tiredness and restore natural functions to related areas of the body. ",                                                                                                                                                                                                    'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 16, 'type' => 'service',  'poster' => 'Service/service_11.jpg', 'title' => 'Lulur Body Scrub',                                      'duration' => 60,  'price' => 238.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => "Traditional Javanese body mask with a combination of ingredients and yogurt that has anti-ageing benefits to beautify and add radiance to the skin.\nBest for: Dull skin, brightening",                                                                                                                                     'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 17, 'type' => 'service',  'poster' => 'Service/service_12.jpg', 'title' => 'Boreh Body Wrap',                                       'duration' => 60,  'price' => 238.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => "Traditional body wrap or body mask uses antioxidant herbs that help increase blood circulation and reduce water retention while providing relief for aches and sore muscles.\nBest for: Detox, muscle relief",                                                                                                              'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 18, 'type' => 'service',  'poster' => 'Service/service_13.jpg', 'title' => 'Traditional Face Care',                                 'duration' => 60,  'price' => 188.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => "Cleanses, refreshes, and relaxes the skin using natural ingredients suitable for all skin types, including yogurt, cucumber, honey, papaya, and aloe vera.\nThe treatment is completed with a comforting 16-point facial massage to relieve facial tension and promote relaxation.\nBest for: Gentle skincare, relaxation", 'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 19, 'type' => 'service',  'poster' => 'Service/service_14.jpg', 'title' => 'Traditional Hair Care',                                 'duration' => 60,  'price' => 188.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => "A hair cleansing and nourishing treatment using a selection of natural ingredients. Coconut helps condition and soften the hair.\nYogurt cools the scalp while pandan provides a relaxing sensation. Treatment is completed by using Limau Kasturi as a scalp cleanser.\nBest for: Scalp care, hydration, relaxation",      'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                            ['id' => 20, 'type' => 'service',  'poster' => 'Service/service_15.jpg', 'title' => 'Sound Therapy',                                         'duration' => 60,  'price' => 178.00, 'gender' => 'single', 'package_category_id' => 1, 'is_standalone' => true, 'description' => "A meditative experience using sound vibrations to release emotional and mental stress. Guests are guided through a centering exercise followed by a singing bowl ceremony to help release emotional, mental, and physical tension.\nBest for: Mental relaxation, stress release, inner balance",                            'detail' => "Welcome Refreshment\nSpa Locker\nShower Amenities\nComplimentary usage of Spa Facilities – Hot Jacuzzi, Cold Plunge Pool, Steam Room, Sauna Room and Outdoor Lap Pool.",   'created_at' => now(), 'updated_at' => now()],
                        ]);
                    // d.  
                        Package_therapist::insert([
                            ['id' => 1, 'package_id' => 1, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 2, 'package_id' => 1, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 3, 'package_id' => 1, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 4, 'package_id' => 2, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 5, 'package_id' => 2, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 6, 'package_id' => 2, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 7, 'package_id' => 3, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 8, 'package_id' => 3, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 9, 'package_id' => 3, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 10, 'package_id' => 4, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 11, 'package_id' => 4, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 12, 'package_id' => 4, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 13, 'package_id' => 5, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 14, 'package_id' => 5, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 15, 'package_id' => 5, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 16, 'package_id' => 6, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 17, 'package_id' => 6, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 18, 'package_id' => 6, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 19, 'package_id' => 7, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 20, 'package_id' => 7, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 21, 'package_id' => 7, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 22, 'package_id' => 8, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 23, 'package_id' => 8, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 24, 'package_id' => 8, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 25, 'package_id' => 9, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 26, 'package_id' => 9, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 27, 'package_id' => 9, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 28, 'package_id' => 10, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 29, 'package_id' => 10, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 30, 'package_id' => 10, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 31, 'package_id' => 11, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 32, 'package_id' => 11, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 33, 'package_id' => 11, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 34, 'package_id' => 12, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 35, 'package_id' => 12, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 36, 'package_id' => 12, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 37, 'package_id' => 13, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 38, 'package_id' => 13, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 39, 'package_id' => 13, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 40, 'package_id' => 14, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 41, 'package_id' => 14, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 42, 'package_id' => 14, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 43, 'package_id' => 15, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 44, 'package_id' => 15, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 45, 'package_id' => 15, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 46, 'package_id' => 16, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 47, 'package_id' => 16, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 48, 'package_id' => 16, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 49, 'package_id' => 17, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 50, 'package_id' => 17, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 51, 'package_id' => 17, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 52, 'package_id' => 18, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 53, 'package_id' => 18, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 54, 'package_id' => 18, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 55, 'package_id' => 19, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 56, 'package_id' => 19, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 57, 'package_id' => 19, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 58, 'package_id' => 20, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 59, 'package_id' => 20, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 60, 'package_id' => 20, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                        ]);
                    // e.
                        Package_room::insert([
                            ['id' => 1, 'package_id' => 1, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 2, 'package_id' => 1, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 3, 'package_id' => 2, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 4, 'package_id' => 2, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 5, 'package_id' => 3, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 6, 'package_id' => 3, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 7, 'package_id' => 4, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 8, 'package_id' => 4, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 9, 'package_id' => 5, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 10, 'package_id' => 5, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 11, 'package_id' => 6, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 12, 'package_id' => 6, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 13, 'package_id' => 7, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 14, 'package_id' => 7, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 15, 'package_id' => 8, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 16, 'package_id' => 8, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 17, 'package_id' => 9, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 18, 'package_id' => 9, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 19, 'package_id' => 10, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 20, 'package_id' => 10, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 21, 'package_id' => 11, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 22, 'package_id' => 11, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 23, 'package_id' => 12, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 24, 'package_id' => 12, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 25, 'package_id' => 13, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 26, 'package_id' => 13, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 27, 'package_id' => 14, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 28, 'package_id' => 14, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 29, 'package_id' => 15, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 30, 'package_id' => 15, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 31, 'package_id' => 16, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 32, 'package_id' => 16, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 33, 'package_id' => 17, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 34, 'package_id' => 17, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 35, 'package_id' => 18, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 36, 'package_id' => 18, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 37, 'package_id' => 19, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 38, 'package_id' => 19, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 39, 'package_id' => 20, 'room_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 40, 'package_id' => 20, 'room_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                        ]);
                    // f.
                        Package_service::insert([
                            ['id' => 1, 'package_id' => 1, 'service_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 2, 'package_id' => 1, 'service_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 3, 'package_id' => 1, 'service_id' => 23, 'created_at' => now(), 'updated_at' => now()],
                            
                            ['id' => 4, 'package_id' => 2, 'service_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 5, 'package_id' => 2, 'service_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 6, 'package_id' => 2, 'service_id' => 23, 'created_at' => now(), 'updated_at' => now()],
                            
                            ['id' => 7, 'package_id' => 3, 'service_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 8, 'package_id' => 3, 'service_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                            ['id' => 9, 'package_id' => 3, 'service_id' => 23, 'created_at' => now(), 'updated_at' => now()],
                        ]);
                #endregion


                #region 3) --> Roster
                    Roster_shift::insert([
                        ['id' => 1,  'icon' => 1,  'time_start' => '08:00:00', 'time_end' => '18:00:00', 'created_at' => now(), 'updated_at' => now()],
                    ]);
                    Roster_leave::insert([
                        ['id' => 1, 'icon' => 'AL', 'description' => 'Annual Leave', 'created_at' => now(), 'updated_at' => now()],
                    ]);
                    Roster::insert([
                        ['id' => 1, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-01', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 2, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-01', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 3, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-01', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 4, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-02', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 5, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-02', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 6, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-02', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 7, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-03', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 8, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-03', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 9, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-03', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 10, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-04', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 11, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-04', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 12, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-04', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 13, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-05', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 14, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-05', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 15, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-05', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 16, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-06', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 17, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-06', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 18, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-06', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 19, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-07', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 20, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-07', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 21, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-07', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 22, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-08', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 23, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-08', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 24, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-08', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 25, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-09', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 26, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-09', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 27, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-09', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 28, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-10', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 29, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-10', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 30, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-10', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 31, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-11', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 32, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-11', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 33, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-11', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 34, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-12', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 35, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-12', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 36, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-12', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 37, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-13', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 38, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-13', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 39, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-13', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 40, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-14', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 41, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-14', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 42, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-14', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 43, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-15', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 44, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-15', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 45, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-15', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 46, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-16', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 47, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-16', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 48, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-16', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 49, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-17', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 50, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-17', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 51, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-17', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 52, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-18', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 53, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-18', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 54, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-18', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 55, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-19', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 56, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-19', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 57, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-19', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 58, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-20', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 59, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-20', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 60, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-20', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 61, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-21', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 62, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-21', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 63, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-21', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 64, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-22', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 65, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-22', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 66, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-22', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 67, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-23', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 68, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-23', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 69, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-23', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 70, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-24', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 71, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-24', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 72, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-24', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 73, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-25', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 74, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-25', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 75, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-25', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 76, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-26', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 77, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-26', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 78, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-26', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 79, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-27', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 80, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-27', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 81, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-27', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 82, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-28', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 83, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-28', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 84, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-28', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 85, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-29', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 86, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-29', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 87, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-29', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 88, 'user_id' => 21, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-30', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 89, 'user_id' => 22, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-30', 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 90, 'user_id' => 24, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-11-30', 'created_at' => now(), 'updated_at' => now()],
                    ]);
                #endregion


                #region 4) --> Booking
                    Booking::insert([
                        ['id' => 1,  'package_id' => null, 'user_id' => 23,  'date_start' => '2026-11-20', 'time_start' => '14:00', 'time_end' => '17:00', 'payment' => 'pending', 'status' => 'pending', 'booking_type' => 'online', 'price_original' => 350, 'price_discount' => 0, 'price_final' => 350, 'remark' => null, 'recorded_time_start' => null, 'recorded_time_end' => null,  'created_at' => now(), 'updated_at' => now()],
                        ['id' => 2,  'package_id' => null, 'user_id' => 23,  'date_start' => '2026-11-20', 'time_start' => '11:30', 'time_end' => '15:30', 'payment' => 'pending', 'status' => 'booked', 'booking_type' => 'online', 'price_original' => 400, 'price_discount' => 0, 'price_final' => 400, 'remark' => null, 'recorded_time_start' => null, 'recorded_time_end' => null,  'created_at' => now(), 'updated_at' => now()],
                        ['id' => 3,  'package_id' => null, 'user_id' => 23,  'date_start' => '2026-11-23', 'time_start' => '13:00', 'time_end' => '16:00', 'payment' => 'pending', 'status' => 'pending', 'booking_type' => 'online', 'price_original' => 250, 'price_discount' => 0, 'price_final' => 250, 'remark' => null, 'recorded_time_start' => null, 'recorded_time_end' => null,  'created_at' => now(), 'updated_at' => now()],
                        ['id' => 4,  'package_id' => null, 'user_id' => 23,  'date_start' => '2026-11-23', 'time_start' => '11:00', 'time_end' => '13:00', 'payment' => 'pending', 'status' => 'booked', 'booking_type' => 'online', 'price_original' => 600, 'price_discount' => 0, 'price_final' => 600, 'remark' => null, 'recorded_time_start' => null, 'recorded_time_end' => null,  'created_at' => now(), 'updated_at' => now()],
                        ['id' => 5,  'package_id' => null, 'user_id' => 23,  'date_start' => '2026-11-24', 'time_start' => '10:30', 'time_end' => '12:00', 'payment' => 'paid', 'status' => 'booked', 'booking_type' => 'online', 'price_original' => 500, 'price_discount' => 0, 'price_final' => 500, 'remark' => null, 'recorded_time_start' => null, 'recorded_time_end' => null,  'created_at' => now(), 'updated_at' => now()],
                    ]);
                    Booking_selected::insert([
                        ['id' => 1, 'booking_id' => 1, 'package_id' => 11, 'room_id' => 1, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 2, 'booking_id' => 2, 'package_id' => 12, 'room_id' => 2, 'user_id' => 21, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 3, 'booking_id' => 3, 'package_id' => 13, 'room_id' => 1, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 4, 'booking_id' => 4, 'package_id' => 14, 'room_id' => 1, 'user_id' => 24, 'created_at' => now(), 'updated_at' => now()],
                        ['id' => 5, 'booking_id' => 5, 'package_id' => 15, 'room_id' => 2, 'user_id' => 22, 'created_at' => now(), 'updated_at' => now()],
                    ]);
                #endregion


            #endregion
            

    }
}
