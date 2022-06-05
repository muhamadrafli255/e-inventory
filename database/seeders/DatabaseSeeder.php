<?php

namespace Database\Seeders;

use App\Models\statusLoans;
use App\Models\User;
use App\Models\userClass;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'userclass_id' => '10',
            'number_phone' => '+62-838-4423-5749',
            'address' => 'Bojong Tanjung, Sangkanhurip, Katapang, Bandung, JawaBarat, 40921',
            'password' => bcrypt('Rafli@#12'),
        ]);
        User::factory(25)->create();

        userClass::create([
            'class_name' => 'X RPL'
        ]);
        userClass::create([
            'class_name' => 'X MM1'
        ]);
        userClass::create([
            'class_name' => 'X MM2'
        ]);
        userClass::create([
            'class_name' => 'XI RPL'
        ]);
        userClass::create([
            'class_name' => 'XI MM1'
        ]);
        userClass::create([
            'class_name' => 'XI MM2'
        ]);
        userClass::create([
            'class_name' => 'XII RPL'
        ]);
        userClass::create([
            'class_name' => 'XII MM1'
        ]);
        userClass::create([
            'class_name' => 'XII MM2'
        ]);
        userClass::create([
            'class_name' => 'GURU/TU'
        ]);

        statusLoans::create([
            'name' => 'Dipinjam'
        ]);
        statusLoans::create([
            'name' => 'Selesai'
        ]);
        statusLoans::create([
            'name' => 'Pending'
        ]);

    }
}
