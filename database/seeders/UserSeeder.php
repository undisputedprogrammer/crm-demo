<?php

namespace Database\Seeders;

use App\Models\Center;
use App\Models\Hospital;
use App\Models\User;
use App\Models\UserCenter;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $craft = Hospital::where('name', 'ABC Hospital')->get()->first();
        $craftadmin = User::create([
            'name' => 'ABC Admin',
            'email' => 'abcadmin@demo.com',
            'designation' => 'Administrator',
            'hospital_id'=> $craft->id,
            'email_verified_at' => now(),
            'password' => Hash::make('abcd1234'),
            'remember_token' => Str::random(10),
        ]);

        $craftadmin->assignRole('admin');
        foreach ($craft->centers as $c) {
            $craftadmin->centers()->save($c);
        }

        // $craftagent = User::create([
        //     'name' => 'Craft Agent',
        //     'email' => 'craftagent@demo.com',
        //     'designation' => 'Customer Relations Executive',
        //     'hospital_id' => $craft->id,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('abcd1234'),
        //     'remember_token' => Str::random(10),
        // ]);

        // $craftagent->assignRole('agent');
        // $craftcenter = Center::where('name', 'Caft_Kodungallur')->get()->first();
        // $craftagent->centers()->save($craftcenter);

        // $craftusers = User::factory()->count(5)->create(
        //     ['hospital_id' => $craft->id]
        // );

        // foreach($craftusers as $user){
        //     $user->centers()->save($craft->centers->random());
        //     $user->assignRole('agent');
        // }

        $ar = Hospital::where('name', 'ARF')->get()->first();
        $aradmin = User::create([
            'name' => 'AR Admin',
            'email' => 'admin@arfmedicalentre.com',
            'designation' => 'Administrator',
            'hospital_id'=> $ar->id,
            'email_verified_at' => now(),
            'password' => Hash::make('abcd1234'),
            'remember_token' => Str::random(10),
        ]);

        $aradmin->assignRole('admin');
        foreach ($ar->centers as $c) {
            $aradmin->centers()->save($c);
        }

        // $aragent = User::create([
        //     'name' => 'AR Agent',
        //     'email' => 'aragent@demo.com',
        //     'designation' => 'Customer Relations Executive',
        //     'hospital_id' => $ar->id,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('abcd1234'),
        //     'remember_token' => Str::random(10),
        // ]);

        // $aragent->assignRole('agent');
        // $arcenter = Center::where('name', 'AR_Kodungallur')->get()->first();
        // $aragent->centers()->save($arcenter);

        // $arusers = User::factory()->count(5)->create(
        //     ['hospital_id' => $craft->id]
        // );

        // foreach($arusers as $user){
        //     $user->centers()->save($ar->centers->random());
        //     $user->assignRole('agent');
        // }
    }
}
