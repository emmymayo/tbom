<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Clear The table
        DB::table('roles')->delete();
        $roles = ['super','admin','mentor','mentee','author'];
        
      
        foreach($roles as $role){
            Role::factory()->create([
                'name' => $role,
                'display_name' => $role,
            ]);
        }
    }
}
