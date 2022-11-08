<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $user = User::create([
            'matricule' => "0000000000",
            'id_number' => "O000000000",
            'genre' => "Masculin",
            'nationality' => "Guinean",
            'name' => "Super",
            'surname' => "Admin",
            'dob' => "1996-01-01",
            'email' => "super.admin@gmail.com",
            'phone' => "611897566",
            'addresse' => "Lambanyi, Ratoma",
            'pays' => "République De Guinée",
            'type_employé' => "Interne",
            'role' => "Dévélopeur",
            'description' => "Dévélopeur web",
            'date_du_debut' => now(),
            'profile_picture' => "user.png",
            'last_seen' => Carbon::now(),
            'password' => '$2y$10$iwCkkXeCwThDEI6ouUGQ1eE7pHVeMv9qBkMkTwXfoWpsnQdJE1Dn6'
           ]);

        $user->assignRole("Super Admin");
        
    }
}
