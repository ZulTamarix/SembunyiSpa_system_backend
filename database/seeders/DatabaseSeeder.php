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

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        #region 1) --> User
            User::insert([
                ['id'=> '1', 'role'=> 'therapist', 'name'=> 'Alicia Tan', 'email'=> 'alicia.tan@example.com', 'phoneNo'=> '0123456789', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> 'Spa Manager', 'code'=> 'C1234', 'date_joined'=> '2026-01-15', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                ['id'=> '2', 'role'=> 'therapist', 'name'=> 'Daniel Lim', 'email'=> 'daniel.lim@example.com', 'phoneNo'=> '0134567890', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> 'Spa Receiptionist', 'code'=> 'C5678', 'date_joined'=> '2026-03-22', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                ['id'=> '3', 'role'=> 'therapist', 'name'=> 'Sophia Lee', 'email'=> 'sophia.lee@example.com', 'phoneNo'=> '0145678901', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> 'Manager', 'code'=> 'C9012', 'date_joined'=> '2026-02-08', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                ['id'=> '4', 'role'=> 'therapist', 'name'=> 'Jason Wong', 'email'=> 'jason.wong@example.com', 'phoneNo'=> '0156789012', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> 'Spa Manager', 'code'=> 'C3456', 'date_joined'=> '2026-05-17', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                ['id'=> '5', 'role'=> 'therapist', 'name'=> 'Emily Chong', 'email'=> 'emily.chong@example.com', 'phoneNo'=> '0167890123', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> 'Therapist', 'code'=> 'C7890', 'date_joined'=> '2026-04-03', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                ['id'=> '6', 'role'=> 'customer', 'name'=> 'Ryan Tan', 'email'=> 'ryan.tan@example.com', 'phoneNo'=> '0178901234', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'date_joined'=> '2026-02-15', 'created_at'=> now(), 'membership_id'=> null, 'membership_date_expired' => null, 'updated_at'=> now()],
                ['id'=> '7', 'role'=> 'customer', 'name'=> 'Michelle Wong', 'email'=> 'michelle.wong@example.com', 'phoneNo'=> '0189012345', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'date_joined'=> '2026-05-23', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                ['id'=> '8', 'role'=> 'customer', 'name'=> 'Anthony', 'email'=> 'anthony.wong@example.com', 'phoneNo'=> '0134567890', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'date_joined'=> '2026-08-20', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                ['id'=> '9', 'role'=> 'customer', 'name'=> 'Michael', 'email'=> 'michael.wong@example.com', 'phoneNo'=> '0145678901', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'date_joined'=> '2026-01-10', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                ['id'=> '10', 'role'=> 'walkin', 'nae'=> 'Farid Hassan', 'email'=> 'farid.hassan@example.com', 'phoneNo'=> '0112345678', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'date_joined'=> '2026-10-04', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                ['id'=> '11', 'role'=> 'walkin', 'name'=> 'Nur Aina', 'email'=> 'nur.aina@example.com', 'phoneNo'=> '0128765432', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'date_joined'=> '2026-08-11', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                ['id'=> '12', 'role'=> 'walkin', 'name'=> 'Kevin Tan', 'email'=> 'kevin.tan@example.com', 'phoneNo'=> '0163456789', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'date_joined'=> '2026-09-05', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
                ['id'=> '13', 'role'=> 'admin', 'name'=> 'Admin Sembunyi', 'email'=> 'admin@sembunyispa.com', 'phoneNo'=> '0190123456', 'password'=> bcrypt('password'), 'status'=> 'active', 'specialty'=> null, 'code'=> null, 'date_joined'=> '2026-06-12', 'membership_id'=> null, 'membership_date_expired' => null, 'created_at'=> now(), 'updated_at'=> now()],
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
                ['id' => 1, 'user_id' => 1, 'roster_shift_id' => 1, 'roster_leave_id' => null,  'date' => '2026-10-01', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 2, 'user_id' => 2, 'roster_shift_id' => 2, 'roster_leave_id' => null,  'date' => '2026-10-01', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 3, 'user_id' => 3, 'roster_shift_id' => 3, 'roster_leave_id' => null,  'date' => '2026-10-01', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 4, 'user_id' => 4, 'roster_shift_id' => null, 'roster_leave_id' => 1,  'date' => '2026-10-01', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 5, 'user_id' => 5, 'roster_shift_id' => null, 'roster_leave_id' => 2,  'date' => '2026-10-03', 'created_at' => now(), 'updated_at' => now()],
                
                ['id' => 6, 'user_id' => 1, 'roster_shift_id' => 2, 'roster_leave_id' => null,  'date' => '2026-10-05', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 7, 'user_id' => 2, 'roster_shift_id' => 2, 'roster_leave_id' => null,  'date' => '2026-10-07', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 8, 'user_id' => 1, 'roster_shift_id' => 5, 'roster_leave_id' => null,  'date' => '2026-10-08', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 9, 'user_id' => 3, 'roster_shift_id' => null, 'roster_leave_id' => 6,  'date' => '2026-10-08', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 10, 'user_id' => 5, 'roster_shift_id' => null, 'roster_leave_id' => 5, 'date' => '2026-10-10', 'created_at' => now(), 'updated_at' => now()],
                
                ['id' => 11, 'user_id' => 4, 'roster_shift_id' => 2, 'roster_leave_id' => null, 'date' => '2026-10-12', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 12, 'user_id' => 2, 'roster_shift_id' => 2, 'roster_leave_id' => null, 'date' => '2026-10-13', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 13, 'user_id' => 4, 'roster_shift_id' => 3, 'roster_leave_id' => null, 'date' => '2026-10-13', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 14, 'user_id' => 5, 'roster_shift_id' => 4, 'roster_leave_id' => null, 'date' => '2026-10-17', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 15, 'user_id' => 1, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-10-20', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 16, 'user_id' => 2, 'roster_shift_id' => 5, 'roster_leave_id' => null, 'date' => '2026-10-20', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 17, 'user_id' => 1, 'roster_shift_id' => null, 'roster_leave_id' => 1, 'date' => '2026-10-23', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 18, 'user_id' => 3, 'roster_shift_id' => 1, 'roster_leave_id' => null, 'date' => '2026-10-24', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 19, 'user_id' => 4, 'roster_shift_id' => 2, 'roster_leave_id' => null, 'date' => '2026-10-26', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 20, 'user_id' => 5, 'roster_shift_id' => null, 'roster_leave_id' => 4, 'date' => '2026-10-26', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 21, 'user_id' => 3, 'roster_shift_id' => null, 'roster_leave_id' => 5, 'date' => '2026-10-26', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 22, 'user_id' => 4, 'roster_shift_id' => 5, 'roster_leave_id' => null, 'date' => '2026-10-30', 'created_at' => now(), 'updated_at' => now()],
            ]);
        #endregion

        #region 3) --> Membership
            Membership::insert([
                ['id'=> '1', 'tier'=> 'Gold', 'created_at'=> now(), 'updated_at'=> now()],
                ['id'=> '2', 'tier'=> 'Silver', 'created_at'=> now(), 'updated_at'=> now()],
                ['id'=> '3', 'tier'=> 'Bronze', 'created_at'=> now(), 'updated_at'=> now()],
            ]);
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
        #endregion

        #region 4) --> Voucher
            Voucher::insert([
                ['id' => 1, 'membership_id' => 1, 'code' => 'WELCOME10', 'description' => '10% Welcome Voucher', 'type' => 'percentage', 'date_expired' => '2027-01-10', 'status' => 'active', 'discount_type' => 'percentage', 'discount_value' => 10, 'quantity' => 1, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 2, 'membership_id' => 1, 'code' => 'SAVE20', 'description' => 'RM20 Discount Voucher', 'type' => 'promotion', 'date_expired' => '2027-02-15', 'status' => 'active', 'discount_type' => 'discount_amount', 'discount_value' => 20, 'quantity' => null, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 3, 'membership_id' => 1, 'code' => 'SPA15', 'description' => '15% Spa Treatment Discount', 'type' => 'promotion', 'date_expired' => '2027-03-01', 'status' => 'active', 'discount_type' => 'discount_percentage', 'discount_value' => 15, 'quantity' => 20, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 4, 'membership_id' => null, 'code' => 'EXTRA30', 'description' => '30 Minutes Treatment Extension', 'type' => 'gift', 'date_expired' => '2027-03-20', 'status' => 'active', 'discount_type' => 'time_extension', 'discount_value' => 30, 'quantity' => 5, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 5, 'membership_id' => null, 'code' => 'FREEFACIAL', 'description' => 'Complimentary Facial Treatment', 'type' => 'gift', 'date_expired' => '2027-04-10', 'status' => 'active', 'discount_type' => 'complimentary', 'discount_value' => null, 'quantity' => 5, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 6, 'membership_id' => 2, 'code' => 'RELAX25', 'description' => '25% Relaxation Package Discount', 'type' => 'promotion', 'date_expired' => '2027-05-05', 'status' => 'active', 'discount_type' => 'discount_percentage', 'discount_value' => 25, 'quantity' =>null, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 7, 'membership_id' => 2, 'code' => 'RM50OFF', 'description' => 'RM50 Off Premium Package', 'type' => 'promotion', 'date_expired' => '2027-05-25', 'status' => 'inactive', 'discount_type' => 'discount_amount', 'discount_value' => 50, 'quantity' => 10, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 8, 'membership_id' => null, 'code' => 'EXTEND15', 'description' => '15 Minutes Complimentary Extension', 'type' => 'gift', 'date_expired' => '2027-06-15', 'status' => 'active', 'discount_type' => 'time_extension', 'discount_value' => 15, 'quantity' => 10, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 9, 'membership_id' => null, 'code' => 'FREESCRUB', 'description' => 'Complimentary Body Scrub', 'type' => 'gift', 'date_expired' => '2027-10-01', 'status' => 'inactive', 'discount_type' => 'complimentary', 'discount_value' => null, 'quantity' => 8, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 10, 'membership_id' => null, 'code' => 'SUMMER10', 'description' => '10% Summer Promotion', 'type' => 'promotion', 'date_expired' => '2027-10-30', 'status' => 'active', 'discount_type' => 'discount_percentage', 'discount_value' => 10, 'quantity' => 25, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 11, 'membership_id' => null, 'code' => 'GIFT30', 'description' => 'RM30 Gift Voucher', 'type' => 'gift', 'date_expired' => '2027-08-15', 'status' => 'inactive', 'discount_type' => 'discount_amount', 'discount_value' => 30, 'quantity' => 5, 'created_at' => now(), 'updated_at' => now()],
            ]);
            Voucher_customer::insert([
                ['id' => 1, 'voucher_id' => 1, 'user_id' => 7, 'quantity' => 1, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 2, 'voucher_id' => 2, 'user_id' => 7, 'quantity' => null, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 3, 'voucher_id' => 3, 'user_id' => 8, 'quantity' => 20, 'created_at' => now(), 'updated_at' => now()]
            ]);
        #endregion

        #region 5) --> Package + Service
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
                ['id' => 1, 'type' => 'service', 'poster' => 'Service/service_1.jpg', 'title' => 'Ming Dynasty Princess Ritual', 'description' => 'A 2.5-hour East-meets-West spa journey inspired by the Ming dynasty princess. Combines Chinese meridian techniques, aromatherapy massage, and a soothing herbal body treatment.', 'duration' => 150, 'price' => 388, 'gender' => 'Unisex', 'detail' => '<ul><li>Chinese meridian massage</li><li>Aromatherapy oil massage</li><li>Herbal body treatment</li><li>Relaxing tea ritual</li></ul>', 'package_category_id' => 1, 'is_standalone' => true, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 2, 'type' => 'service', 'poster' => 'Service/service_2.jpg', 'title' => 'Majapahit Queen Ritual', 'description' => 'A 2.5-hour Majapahit-inspired queen ritual. Begins with a Javanese Lulur scrub, continues with a deep Balinese massage, and concludes with a floral bath.', 'duration' => 150, 'price' => 368, 'gender' => 'Unisex', 'detail' => '<ul><li>Javanese Lulur body scrub</li><li>Balinese deep tissue massage</li><li>Traditional floral bath</li><li>Relaxing aromatherapy</li></ul>', 'package_category_id' => 2, 'is_standalone' => true, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 3, 'type' => 'package', 'poster' => 'Package/package_2.jpeg', 'title' => 'Massage', 'description' => '... Entahlah', 'duration' => 600, 'price' => 230, 'gender' => 'Female', 'detail' => '<ul><li>Traditional massage</li><li>Selected essential oils</li><li>Gentle stretching techniques</li><li>Deep relaxation treatment</li></ul>', 'package_category_id' => 8, 'is_standalone' => null, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 4, 'type' => 'service', 'poster' => 'Service/service_3.jpg', 'title' => 'Jasmine Princess Ritual', 'description' => 'A feminine 2.5-hour ritual for women drawing on ancient court beauty traditions. Features a gentle full-body massage and jasmine-infused floral bath.', 'duration' => 150, 'price' => 348, 'gender' => 'Female', 'detail' => '<ul><li>Gentle full-body massage</li><li>Jasmine body treatment</li><li>Jasmine-infused floral bath</li><li>Calming aromatherapy</li></ul>', 'package_category_id' => 2, 'is_standalone' => true, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 5, 'type' => 'service', 'poster' => 'Service/service_4.jpg', 'title' => 'Royal Herbal Compress', 'description' => 'A traditional herbal therapy combining warm herbal compresses with a relaxing full-body massage to release muscle tension and restore the body.', 'duration' => 90, 'price' => 228, 'gender' => 'Unisex', 'detail' => '<ul><li>Warm herbal compress</li><li>Full-body massage</li><li>Aromatherapy treatment</li><li>Muscle tension relief</li></ul>', 'package_category_id' => 1, 'is_standalone' => false, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 6, 'type' => 'service', 'poster' => 'Service/service_5.jpg', 'title' => 'Balinese Aromatherapy Massage', 'description' => 'A relaxing traditional Balinese massage using aromatic essential oils and rhythmic pressure techniques to ease tension and promote deep relaxation.', 'duration' => 90, 'price' => 198, 'gender' => 'Unisex', 'detail' => '<ul><li>Traditional Balinese massage</li><li>Selected essential oils</li><li>Gentle stretching techniques</li><li>Deep relaxation treatment</li></ul>', 'package_category_id' => 1, 'is_standalone' => true, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 7, 'type' => 'package', 'poster' => 'Package/package_1.jpg', 'title' => 'Balinese Aromatherapy Massage', 'description' => 'Combination of service 1+2', 'duration' => 390, 'price' => 800, 'gender' => 'Male','detail' => '<ul><li>Traditional Balinese massage</li><li>Selected essential oils</li><li>Gentle stretching techniques</li><li>Deep relaxation treatment</li></ul>', 'package_category_id' => 7, 'is_standalone' => null, 'created_at' => now(), 'updated_at' => now()],
            ]);
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
            Package_therapist::insert([
                ['id' => 1, 'package_id' => 1, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 2, 'package_id' => 1, 'user_id' => 2, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 3, 'package_id' => 1, 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 4, 'package_id' => 2, 'user_id' => 4, 'created_at' => now(), 'updated_at' => now()],
                ['id' => 5, 'package_id' => 6, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
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
                ['id' => 1, 'poster' => 'Banner/banner_1.jpg', 'title' => 'Balinese Aromatherapy Massage', 'description' => 'Combination of service 1+2', 'date_expired' => '2027-10-12', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 2, 'poster' => 'Banner/banner_2.jpeg', 'title' => 'Massage', 'description' => '... Entahlah', 'date_expired' => '2027-10-12', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 3, 'poster' => 'Banner/banner_3.jpeg', 'title' => 'Advertisement', 'description' => 'Check out our latest offers!', 'date_expired' => '2027-10-12', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ]);
        #endregion
    }
}
