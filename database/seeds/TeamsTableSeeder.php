<?php

use App\Team;
use App\User;
use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 2; $i++) {
            $randomNumber = rand(123, 789);

            $team = Team::factory()->create([
                'name' => "Vendor $randomNumber",
            ]);

            $director = User::factory()->create([
                'name'           => "TSL $randomNumber",
                'email'          => "tsl$randomNumber@gmail.com",
                'password'       => bcrypt('password'),
                'team_id'        => $team->id,
                'remember_token' => null,
            ]);
            $director->roles()->sync(2);

            $doctor = User::factory()->create([
                'name'           => "store $randomNumber",
                'email'          => "store$randomNumber@gmail.com",
                'password'       => bcrypt('password'),
                'team_id'        => $team->id,
                'remember_token' => null,
            ]);
            $doctor->roles()->sync(2);
        }
    }
}
