<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Hash;  
use illuminate\Support\Str;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::factory(20)->create();
        // DB::table('profiles')->insert([
        //     'name' => str::random(10),
        //     'email' => str::random(10) .'@gmail.com',
        //     'bio' => str::random(120),
        //     'password' => Hash::make('123456'),  
        // ]);  
    }
}
