<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Room;
use App\Models\Membership\Membership;
use App\Models\Membership\Membership_privilege;
use App\Models\Roster\Roster_leave;
use App\Models\Roster\Roster_shift;
use App\Models\Voucher\Voucher;
use App\Models\Voucher\Voucher_customer;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1) user
        User::insert([
            ['id'=> '1', 'role'=> 'therapist', 'name'=> 'Alicia Tan', 'email'=> 'alicia.tan@example.com', 'phoneNo'=> '0123456789', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> 'Spa Manager', 'code'=> 'C1234', 'date_joined'=> '2026-01-15', 'membership_id'=> null, 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '2', 'role'=> 'therapist', 'name'=> 'Daniel Lim', 'email'=> 'daniel.lim@example.com', 'phoneNo'=> '0134567890', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> 'Spa Receiptionist', 'code'=> 'C5678', 'date_joined'=> '2026-03-22', 'membership_id'=> null, 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '3', 'role'=> 'therapist', 'name'=> 'Sophia Lee', 'email'=> 'sophia.lee@example.com', 'phoneNo'=> '0145678901', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> 'Manager', 'code'=> 'C9012', 'date_joined'=> '2026-02-08', 'membership_id'=> null, 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '4', 'role'=> 'therapist', 'name'=> 'Jason Wong', 'email'=> 'jason.wong@example.com', 'phoneNo'=> '0156789012', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> 'Spa Manager', 'code'=> 'C3456', 'date_joined'=> '2026-05-17', 'membership_id'=> null, 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '5', 'role'=> 'therapist', 'name'=> 'Emily Chong', 'email'=> 'emily.chong@example.com', 'phoneNo'=> '0167890123', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> 'Therapist', 'code'=> 'C7890', 'date_joined'=> '2026-04-03', 'membership_id'=> null, 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '6', 'role'=> 'customer', 'name'=> 'Ryan Tan', 'email'=> 'ryan.tan@example.com', 'phoneNo'=> '0178901234', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'date_joined'=> '2026-02-15', 'created_at'=> now(), 'membership_id'=> null, 'updated_at'=> now()],
            ['id'=> '7', 'role'=> 'customer', 'name'=> 'Michelle Wong', 'email'=> 'michelle.wong@example.com', 'phoneNo'=> '0189012345', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'date_joined'=> '2026-05-23', 'membership_id'=> null, 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '8', 'role'=> 'customer', 'name'=> 'Anthony', 'email'=> 'anthony.wong@example.com', 'phoneNo'=> '0134567890', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'date_joined'=> '2026-08-20', 'membership_id'=> null, 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '9', 'role'=> 'customer', 'name'=> 'Michael', 'email'=> 'michael.wong@example.com', 'phoneNo'=> '0145678901', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'date_joined'=> '2026-01-07', 'membership_id'=> null, 'created_at'=> now(), 'updated_at'=> now()],
            // ['id'=> '8', 'role'=> 'customer', 'name'=> 'Anthony', 'email'=> 'anthony.wong@example.com', 'phoneNo'=> '0134567890', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> 'SPA-2026-003', 'date_joined'=> '2026-08-20', 'membership_id'=> 2, 'created_at'=> now(), 'updated_at'=> now()],
            // ['id'=> '9', 'role'=> 'customer', 'name'=> 'Michael', 'email'=> 'michael.wong@example.com', 'phoneNo'=> '0145678901', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> 'SPA-2026-001', 'date_joined'=> '2026-01-07', 'membership_id'=> 3, 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '10', 'role'=> 'walkin', 'nae'=> 'Farid Hassan', 'email'=> 'farid.hassan@example.com', 'phoneNo'=> '0112345678', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'date_joined'=> '2026-07-04', 'membership_id'=> null, 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '11', 'role'=> 'walkin', 'name'=> 'Nur Aina', 'email'=> 'nur.aina@example.com', 'phoneNo'=> '0128765432', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'date_joined'=> '2026-08-11', 'membership_id'=> null, 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '12', 'role'=> 'walkin', 'name'=> 'Kevin Tan', 'email'=> 'kevin.tan@example.com', 'phoneNo'=> '0163456789', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'date_joined'=> '2026-09-05', 'membership_id'=> null, 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '13', 'role'=> 'admin', 'name'=> 'Admin Sembunyi', 'email'=> 'admin@sembunyispa.com', 'phoneNo'=> '0190123456', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'date_joined'=> '2026-06-12', 'membership_id'=> null, 'created_at'=> now(), 'updated_at'=> now()],
        ]);

        // 2) room
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

        // // 3a) membership
        // Membership::insert([
        //     ['id'=> '1', 'tier'=> 'Gold', 'created_at'=> now(), 'updated_at'=> now()],
        //     ['id'=> '2', 'tier'=> 'Silver', 'created_at'=> now(), 'updated_at'=> now()],
        //     ['id'=> '3', 'tier'=> 'Bronze', 'created_at'=> now(), 'updated_at'=> now()],
        // ]);
        // // 3b) membership_privilege
        // Membership_privilege::insert([
        //     ['id'=> '1', 'membership_id'=> '1', 'list'=> 'Free Sauna Session', 'created_at'=> now(), 'updated_at'=> now()],
        //     ['id'=> '2', 'membership_id'=> '1', 'list'=> 'Free Golf Room Access', 'created_at'=> now(), 'updated_at'=> now()],
        //     ['id'=> '3', 'membership_id'=> '1', 'list'=> 'Free Towel Rental', 'created_at'=> now(), 'updated_at'=> now()],
        //     ['id'=> '4', 'membership_id'=> '1', 'list'=> '10% Off Massage Services', 'created_at'=> now(), 'updated_at'=> now()],
        //     ['id'=> '5', 'membership_id'=> '2', 'list'=> 'Free Sauna Session', 'created_at'=> now(), 'updated_at'=> now()],
        //     ['id'=> '6', 'membership_id'=> '2', 'list'=> '15% Off Massage Services', 'created_at'=> now(), 'updated_at'=> now()],
        //     ['id'=> '7', 'membership_id'=> '2', 'list'=> 'Free Refreshment', 'created_at'=> now(), 'updated_at'=> now()],
        //     ['id'=> '8', 'membership_id'=> '3', 'list'=> 'Free Sauna Session', 'created_at'=> now(), 'updated_at'=> now()],
        //     ['id'=> '9', 'membership_id'=> '3', 'list'=> '20% Off Massage Services', 'created_at'=> now(), 'updated_at'=> now()],
        // ]);

        // 4a) roster_shift
        Roster_shift::insert([
            ['id' => 1,  'icon' => 1,  'time_start' => '09:00:00', 'time_end' => '17:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6,  'icon' => 6,  'time_start' => '10:00:00', 'time_end' => '18:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7,  'icon' => 7,  'time_start' => '11:00:00', 'time_end' => '19:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8,  'icon' => 8,  'time_start' => '12:00:00', 'time_end' => '20:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9,  'icon' => 9,  'time_start' => '13:00:00', 'time_end' => '21:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'icon' => 10, 'time_start' => '14:00:00', 'time_end' => '22:00:00', 'created_at' => now(), 'updated_at' => now()],
        ]);
        // 4b) roster_leave
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

        // 5) voucher
        Voucher::insert([
            ['id' => 1, 'code' => 'WELCOME10', 'description' => '10% Welcome Voucher', 'type' => 'percentage', 'date_expired' => '2027-01-07', 'status' => 'active', 'discount_type' => 'percentage', 'discount_value' => 10, 'quantity' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'code' => 'SAVE20', 'description' => 'RM20 Discount Voucher', 'type' => 'promotion', 'date_expired' => '2027-02-15', 'status' => 'active', 'discount_type' => 'discount_amount', 'discount_value' => 20, 'quantity' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'code' => 'SPA15', 'description' => '15% Spa Treatment Discount', 'type' => 'promotion', 'date_expired' => '2027-03-01', 'status' => 'active', 'discount_type' => 'discount_percentage', 'discount_value' => 15, 'quantity' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'code' => 'EXTRA30', 'description' => '30 Minutes Treatment Extension', 'type' => 'gift', 'date_expired' => '2027-03-20', 'status' => 'active', 'discount_type' => 'time_extension', 'discount_value' => 30, 'quantity' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'code' => 'FREEFACIAL', 'description' => 'Complimentary Facial Treatment', 'type' => 'gift', 'date_expired' => '2027-04-10', 'status' => 'active', 'discount_type' => 'complimentary', 'discount_value' => null, 'quantity' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'code' => 'RELAX25', 'description' => '25% Relaxation Package Discount', 'type' => 'promotion', 'date_expired' => '2027-05-05', 'status' => 'active', 'discount_type' => 'discount_percentage', 'discount_value' => 25, 'quantity' =>null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'code' => 'RM50OFF', 'description' => 'RM50 Off Premium Package', 'type' => 'promotion', 'date_expired' => '2027-05-25', 'status' => 'inactive', 'discount_type' => 'discount_amount', 'discount_value' => 50, 'quantity' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'code' => 'EXTEND15', 'description' => '15 Minutes Complimentary Extension', 'type' => 'gift', 'date_expired' => '2027-06-15', 'status' => 'active', 'discount_type' => 'time_extension', 'discount_value' => 15, 'quantity' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'code' => 'FREESCRUB', 'description' => 'Complimentary Body Scrub', 'type' => 'gift', 'date_expired' => '2027-07-01', 'status' => 'inactive', 'discount_type' => 'complimentary', 'discount_value' => null, 'quantity' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'code' => 'SUMMER10', 'description' => '10% Summer Promotion', 'type' => 'promotion', 'date_expired' => '2027-07-30', 'status' => 'active', 'discount_type' => 'discount_percentage', 'discount_value' => 10, 'quantity' => 25, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'code' => 'GIFT30', 'description' => 'RM30 Gift Voucher', 'type' => 'gift', 'date_expired' => '2027-08-15', 'status' => 'inactive', 'discount_type' => 'discount_amount', 'discount_value' => 30, 'quantity' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
        // 6) voucher_customer
        Voucher_customer::insert([
            ['id' => 1, 'voucher_id' => 1, 'user_id' => 7, 'quantity' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'voucher_id' => 2, 'user_id' => 7, 'quantity' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'voucher_id' => 3, 'user_id' => 8, 'quantity' => 20, 'created_at' => now(), 'updated_at' => now()]
        ]);


    }
}
