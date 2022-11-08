<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = Permission::create(['name' => 'voir pays']);
        $permission = Permission::create(['name' => 'editer pays']);

        $permission = Permission::create(['name' => 'voir employes']);
        $permission = Permission::create(['name' => 'editer employes']);

        $permission = Permission::create(['name' => 'activater desactiver utilisateur']);
        $permission = Permission::create(['name' => 'réinitialiser mot de passe']);
        
        $permission = Permission::create(['name' => 'voir divisions']);
        $permission = Permission::create(['name' => 'editer divisions']); 

        $permission = Permission::create(['name' => 'voir departements']);
        $permission = Permission::create(['name' => 'editer departements']);

        // No need for voir reunions because everyone has to have this permission
        $permission = Permission::create(['name' => 'editer reunions']);

        $permission = Permission::create(['name' => 'voir services']);
        $permission = Permission::create(['name' => 'editer services']);

        $permission = Permission::create(['name' => 'voir roles']);
        $permission = Permission::create(['name' => 'editer roles']);

        $permission = Permission::create(['name' => 'voir permissions']);
        
        $permission = Permission::create(['name' => 'voir repertoire public']);
        $permission = Permission::create(['name' => 'editer repertoire public']);

        $permission = Permission::create(['name' => 'editer annonces']);
        $permission = Permission::create(['name' => 'voir annonces']);

        // No need for voir suggestions because everyone has to have this permission
        $permission = Permission::create(['name' => 'editer boite suggestions']);

        $permission = Permission::create(['name' => 'voir presence activité']);
        $permission = Permission::create(['name' => 'editer presence activité']);
        
        // $permission = Permission::create(['name' => 'voir absences']); // not need since it is not used
        $permission = Permission::create(['name' => 'editer absences']);

        $permission = Permission::create(['name' => 'voir présences']);
        $permission = Permission::create(['name' => 'editer présences']);

        // $permission = Permission::create(['name' => 'voir conges']);
        $permission = Permission::create(['name' => 'editer conges']);

        $permission = Permission::create(['name' => 'voir sondages']);
        $permission = Permission::create(['name' => 'editer sondages']);

        $permission = Permission::create(['name' => 'voir avertissements']);
        $permission = Permission::create(['name' => 'editer avertissements']);
        
        $permission = Permission::create(['name' => 'voir depenses']);
        $permission = Permission::create(['name' => 'editer depenses']);

        $permission = Permission::create(['name' => 'voir offres']);
        $permission = Permission::create(['name' => 'editer offres']);   
        
        $permission = Permission::create(['name' => 'editer rapports']);  

        $permission = Permission::create(['name' => 'voir contrats']);   
        $permission = Permission::create(['name' => 'editer contrats']);   

        $permission = Permission::create(['name' => 'voir stats']);        
        
    }
}
