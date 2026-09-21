<?php

namespace Database\Seeders;

use App\Models\User\User;
use App\Models\User\User_therapist;
use App\Models\User\User_customer;
use App\Models\Room;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1) user
        User::insert([
            ['id'=> '29d11f58-e77d-4f48-8ed2-0a7eb04ef047', 'role'=> 'therapist', 'name'=> 'Alicia Tan', 'email'=> 'alicia.tan@example.com', 'phoneNo'=> '0123456789', 'password'=> bcrypt('password'), 'status'=> 'active', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '9909d4d6-59c4-4900-b3c3-31b39e31f051', 'role'=> 'therapist', 'name'=> 'Daniel Lim', 'email'=> 'daniel.lim@example.com', 'phoneNo'=> '0134567890', 'password'=> bcrypt('password'), 'status'=> 'active', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '495ec7a0-d50e-4e97-9a19-e3ae74b5443c', 'role'=> 'therapist', 'name'=> 'Sophia Lee', 'email'=> 'sophia.lee@example.com', 'phoneNo'=> '0145678901', 'password'=> bcrypt('password'), 'status'=> 'active', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> 'f8d334d1-0ac0-4d63-892a-79851127f5b4', 'role'=> 'therapist', 'name'=> 'Jason Wong', 'email'=> 'jason.wong@example.com', 'phoneNo'=> '0156789012', 'password'=> bcrypt('password'), 'status'=> 'active', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '93b42ee9-e7a3-48e2-a7bc-59d3c7c887ac', 'role'=> 'therapist', 'name'=> 'Emily Chong', 'email'=> 'emily.chong@example.com', 'phoneNo'=> '0167890123', 'password'=> bcrypt('password'), 'status'=> 'active', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> 'a14f6c28-3d72-4c91-8b05-72e9f4a61d33', 'role'=> 'customer', 'name'=> 'Ryan Tan', 'email'=> 'ryan.tan@example.com', 'phoneNo'=> '0178901234', 'password'=> bcrypt('password'), 'status'=> 'active', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> 'c72e9a15-6b43-4f08-91d7-38a5c2e74b60', 'role'=> 'customer', 'name'=> 'Michelle Wong', 'email'=> 'michelle.wong@example.com', 'phoneNo'=> '0189012345', 'password'=> bcrypt('password'), 'status'=> 'active', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> 'e83b5d21-9476-42ac-a3f8-16d9c7b520e4', 'role'=> 'admin', 'name'=> 'Admin Sembunyi', 'email'=> 'admin@sembunyispa.com', 'phoneNo'=> '0190123456', 'password'=> bcrypt('password'), 'status'=> 'active', 'created_at'=> now(), 'updated_at'=> now()],
        ]);

        // 2) user_therapist
        User_therapist::insert([
            ['id'=> '7f3a9c21-5d84-4b67-a912-3e8f6c2d1045', 'user_id'=> '29d11f58-e77d-4f48-8ed2-0a7eb04ef047', 'position'=> 'Spa Manager', 'code'=> 'C1234', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> 'b62e4f18-9a35-47c1-8d72-5f0a3b9e6146', 'user_id'=> '9909d4d6-59c4-4900-b3c3-31b39e31f051', 'position'=> 'Spa Receiptionist', 'code'=> 'C5678', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> 'e9157a43-2c68-4f90-b531-8d6e0a274c19', 'user_id'=> '495ec7a0-d50e-4e97-9a19-e3ae74b5443c', 'position'=> 'Manager', 'code'=> 'C9012', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '3c8b1e57-6d42-49a0-b735-f21e9c4a8063', 'user_id'=> 'f8d334d1-0ac0-4d63-892a-79851127f5b4', 'position'=> 'Spa Manager', 'code'=> 'C3456', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> 'a47d2f89-1c53-4e76-9b08-6a3d5f214ce7', 'user_id'=> '93b42ee9-e7a3-48e2-a7bc-59d3c7c887ac', 'position'=> 'Therapist', 'code'=> 'C7890', 'created_at'=> now(), 'updated_at'=> now()],
        ]);

        // 3) user_customer
        User_customer::insert([
            ['id'=> 'd84f2a61-7b39-4e05-a936-1c58d2f740ab', 'user_id'=> 'a14f6c28-3d72-4c91-8b05-72e9f4a61d33', 'total_booking'=> 12, 'date_joined'=> '2026-02-15', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '5b71c903-e642-4a18-bd57-9f3c6e205814', 'user_id'=> 'c72e9a15-6b43-4f08-91d7-38a5c2e74b60', 'total_booking'=> 7, 'date_joined'=> '2026-05-23', 'created_at'=> now(), 'updated_at'=> now()],
        ]);

        // 4) room
        Room::insert([
            ['id'=> '6a2f9c41-8d73-4b15-a620-3e57f1c90482', 'name'=> 'Bayu', 'description'=> 'Single Room', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> 'b81e4d26-5c90-47a3-9f12-6d38a5e72014', 'name'=> 'Embun', 'description'=> 'Couple Room', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '3f75c918-a624-4d80-b531-9e2a7c046158', 'name'=> 'Ombak', 'description'=> 'Hair Spa', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> 'e49b2a67-1d83-46f5-c920-7a34d8b10562', 'name'=> 'Bunga', 'description'=> 'Single Room', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '92c6f3a8-5e17-4b64-a029-8d71c4503f96', 'name'=> 'Rimba', 'description'=> 'Couple Room', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> 'd57a1e83-9b42-4c06-f735-2e68d904a151', 'name'=> 'Sutra', 'description'=> 'Hair Spa', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> '4c90e7b2-63f5-41a8-d029-7b15f3e68426', 'name'=> 'Seri', 'description'=> 'Single Room', 'created_at'=> now(), 'updated_at'=> now()],
            ['id'=> 'f16d5b39-8c24-47e0-a621-3d95b7082f64', 'name'=> 'Mentari', 'description'=> 'Couple Room', 'created_at'=> now(), 'updated_at'=> now()],
        ]);
    }
}
