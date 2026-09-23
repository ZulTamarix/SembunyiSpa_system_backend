<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User\User;
use App\Models\User\User_therapist;
use App\Models\User\User_customer;
use App\Models\Room;
use App\Models\Membership\Membership;
use App\Models\Membership\Membership_privilege;
use App\Models\Membership\Membership_customer;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1) user
        User::insert([
            ['id'=> '1', 'role'=> 'therapist', 'name'=> 'Alicia Tan', 'email'=> 'alicia.tan@example.com', 'phoneNo'=> '0123456789', 'password'=> bcrypt('password'), 'status'=> 'active', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '2', 'role'=> 'therapist', 'name'=> 'Daniel Lim', 'email'=> 'daniel.lim@example.com', 'phoneNo'=> '0134567890', 'password'=> bcrypt('password'), 'status'=> 'active', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '3', 'role'=> 'therapist', 'name'=> 'Sophia Lee', 'email'=> 'sophia.lee@example.com', 'phoneNo'=> '0145678901', 'password'=> bcrypt('password'), 'status'=> 'active', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '4', 'role'=> 'therapist', 'name'=> 'Jason Wong', 'email'=> 'jason.wong@example.com', 'phoneNo'=> '0156789012', 'password'=> bcrypt('password'), 'status'=> 'active', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '5', 'role'=> 'therapist', 'name'=> 'Emily Chong', 'email'=> 'emily.chong@example.com', 'phoneNo'=> '0167890123', 'password'=> bcrypt('password'), 'status'=> 'active', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '6', 'role'=> 'customer', 'name'=> 'Ryan Tan', 'email'=> 'ryan.tan@example.com', 'phoneNo'=> '0178901234', 'password'=> bcrypt('password'), 'status'=> 'active', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '7', 'role'=> 'customer', 'name'=> 'Michelle Wong', 'email'=> 'michelle.wong@example.com', 'phoneNo'=> '0189012345', 'password'=> bcrypt('password'), 'status'=> 'active', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '8', 'role'=> 'customer', 'name'=> 'Anthony', 'email'=> 'anthony.wong@example.com', 'phoneNo'=> '0134567890', 'password'=> bcrypt('password'), 'status'=> 'active', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '9', 'role'=> 'customer', 'name'=> 'Michael', 'email'=> 'michael.wong@example.com', 'phoneNo'=> '0145678901', 'password'=> bcrypt('password'), 'status'=> 'active', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '10', 'role'=> 'admin', 'name'=> 'Admin Sembunyi', 'email'=> 'admin@sembunyispa.com', 'phoneNo'=> '0190123456', 'password'=> bcrypt('password'), 'status'=> 'active', 'created_at'=> now(), 'updated_at'=> now()],
        ]);

        // 2) user_therapist
        User_therapist::insert([
            ['id'=> '1', 'user_id'=> '1', 'position'=> 'Spa Manager', 'code'=> 'C1234', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '2', 'user_id'=> '2', 'position'=> 'Spa Receiptionist', 'code'=> 'C5678', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '3', 'user_id'=> '3', 'position'=> 'Manager', 'code'=> 'C9012', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '4', 'user_id'=> '4', 'position'=> 'Spa Manager', 'code'=> 'C3456', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '5', 'user_id'=> '5', 'position'=> 'Therapist', 'code'=> 'C7890', 'created_at'=> now(), 'updated_at'=> now()],
        ]);

        // 3) user_customer
        User_customer::insert([
            ['id'=> '1', 'user_id'=> '6', 'total_booking'=> 12, 'date_joined'=> '2026-02-15', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '2', 'user_id'=> '7', 'total_booking'=> 7, 'date_joined'=> '2026-05-23', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '3', 'user_id'=> '8', 'total_booking'=> 0, 'date_joined'=> '2026-08-20', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '4', 'user_id'=> '9', 'total_booking'=> 5, 'date_joined'=> '2026-01-07', 'created_at'=> now(), 'updated_at'=> now()],
        ]);

        // 4) room
        Room::insert([
            ['id'=> '1', 'name'=> 'Bayu', 'description'=> 'Single Room', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '2', 'name'=> 'Embun', 'description'=> 'Couple Room', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '3', 'name'=> 'Ombak', 'description'=> 'Hair Spa', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '4', 'name'=> 'Bunga', 'description'=> 'Single Room', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '5', 'name'=> 'Rimba', 'description'=> 'Couple Room', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '6', 'name'=> 'Sutra', 'description'=> 'Hair Spa', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '7', 'name'=> 'Seri', 'description'=> 'Single Room', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '8', 'name'=> 'Mentari', 'description'=> 'Couple Room', 'created_at'=> now(), 'updated_at'=> now()],
        ]);

        // 5) membership
        Membership::insert([
            ['id'=> '1', 'tier'=> 'Gold', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '2', 'tier'=> 'Silver', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '3', 'tier'=> 'Bronze', 'created_at'=> now(), 'updated_at'=> now()],
        ]);
        // 6) membership_privilege
        Membership_privilege::insert([
            ['id'=> '1', 'membership_id'=> '1', 'list'=> 'Free Sauna Session', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '2', 'membership_id'=> '1', 'list'=> 'Free Golf Room Access', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '3', 'membership_id'=> '1', 'list'=> 'Free Towel Rental', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '4', 'membership_id'=> '1', 'list'=> '10% Off Massage Services', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '5', 'membership_id'=> '2', 'list'=> 'Free Sauna Session', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '6', 'membership_id'=> '2', 'list'=> '15% Off Massage Services', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '7', 'membership_id'=> '2', 'list'=> 'Free Refreshment', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '8', 'membership_id'=> '3', 'list'=> 'Free Sauna Session', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '9', 'membership_id'=> '3', 'list'=> '20% Off Massage Services', 'created_at'=> now(), 'updated_at'=> now()],
        ]);
        // 7) membership_customer
        Membership_customer::insert([
            ['id'=> '1', 'user_customer_id'=> '1', 'membership_id'=> '1', 'code'=> 'SPA-2026-001', 'date_joined'=> '2026-07-12', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '2', 'user_customer_id'=> '2', 'membership_id'=> '1', 'code'=> 'SPA-2026-002', 'date_joined'=> '2026-01-21', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '3', 'user_customer_id'=> '3', 'membership_id'=> '2', 'code'=> 'SPA-2026-003', 'date_joined'=> '2025-04-30', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '4', 'user_customer_id'=> '4', 'membership_id'=> '3', 'code'=> 'SPA-2026-004', 'date_joined'=> '2025-11-03', 'created_at'=> now(), 'updated_at'=> now()],
        ]);


    }
}
