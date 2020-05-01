<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [
        	['uniqid' => 1, 'name' => 'Super Admin', 'short_desc' => 'Can create all types of users'],
        	['uniqid' => 2, 'name' => 'Admin', 'short_desc' => 'Can create supervisor and auditor type of users'],
        	['uniqid' => 3, 'name' => 'Supervisor', 'short_desc' => 'Supervisor type of user'],
        	['uniqid' => 4, 'name' => 'Auditor', 'short_desc' => 'Auditor type of user']
        ];

        foreach ($roles as $role) {
        	$r = new Role;
        	$r->uniqid = $role['uniqid'];
        	$r->name = $role['name'];
        	$r->short_desc = $role['short_desc'];
        	$r->save();
        }
    }
}
