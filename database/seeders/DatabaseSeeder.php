<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            'username' => "Kemal",
            'name' => "Muhammad Kemal Pasha",
            'email' => "kemal@gmail.com",
            'address' => "Kp tak pernah ada RT null RW null",
            'password' => Hash::make('123'),
            'contact' => "085323666527",
            'credit_number' => "1234567890",
            'account_number' => "098765",
            'type_account' => "Gold",
        ]);

        DB::table('users')->insert([
            'username' => "Pasha",
            'name' => "Kemal Pasha",
            'email' => "pasha@gmail.com",
            'address' => "Kp ada RT null RW null",
            'password' => Hash::make('123'),
            'contact' => "085323666",
            'credit_number' => "1234567",
            'account_number' => "098123",
            'type_account' => "Silver",
        ]);

        // DB::table('history')->insert([
        //     // 'id_history' => 1,
        //     'account_number' => "098123",
        //     'type_bank' => "BJB",
        //     'name' => "Kemal Pasha",
        //     'nominal' => 20000,
        //     'date' => "2023-06-10",
        //     'status' => "sukses",
        // ]);

    }
}
