<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'matricule' => "0000000001",
            'id_number' => "O00179233",
            'genre' => "Masculin",
            'nationality' => "Guinean",
            'name' => "Barry",
            'surname' => "Aguibou",
            'dob' => "1996-04-02",
            'email' => "aguibou32@gmail.com",
            'phone' => "611897566",
            'addresse' => "Kipe, Ratoma",
            'pays' => "République De Guinée",
            'type_employé' => "Interne",
            'role' => "Informaticien",
            'description' => "Comptable web",
            'date_du_debut' => now(),
            'profile_picture' => "user.png",
            'password' => '$2y$10$iwCkkXeCwThDEI6ouUGQ1eE7pHVeMv9qBkMkTwXfoWpsnQdJE1Dn6',
            'last_seen' => Carbon::now(),
           ]);
    }
}
