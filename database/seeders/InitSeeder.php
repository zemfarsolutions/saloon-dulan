<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Sections;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();
        User::create([
            'name' => "admin",
            'email' => "admin@admin.com",
            'password' => Hash::make("admin123"),
            'role_id' => 1,
            'section_id' => 0,
        ]);
        Schema::disableForeignKeyConstraints();
        DB::table('user_role')->truncate();
        Schema::enableForeignKeyConstraints();
        DB::table('user_role')->insert([
        [
            'name' => "Admin",
        ],
        [
            'name' => "Receptionist",
        ],
        [
            'name' => "Hair Dresser",
        ],
    ]);
        Schema::disableForeignKeyConstraints();
        DB::table('sections')->truncate();
        Schema::enableForeignKeyConstraints();
        DB::table('sections')->insert([
        [
            'name' => "Section A",
        ],
        [
            'name' => "Section B",
        ],
        [
            'name' => "Section C",
        ],
    ]);

        Schema::disableForeignKeyConstraints();
        DB::table('settings')->truncate();
        Schema::enableForeignKeyConstraints();
        Setting::create([
            'app_name' => "Queing App",
            'opening' => "8:00 am",
            'closing' => "12:00 am",
            'ticket_starts' => "100",
            'message' => "testing message",
            'contact' => "1111111",
            'email' => "test@que.test",
        ]);
    }
}
