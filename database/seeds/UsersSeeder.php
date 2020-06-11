<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
        	['name'=>'Lourence John Cabaluna','role_id'=>1,'email'=>'lourencejohn@digicononline.com','password'=>'Lcabalun0300'],
        	['name'=>'Jason Jaca','role_id'=>1,'email'=>'jason@digicononline.com','password'=>'12345678'],
        	['name'=>'TJ Jaca','role_id'=>2,'email'=>'tjaca@digicononline.com','password'=>'12345678'],
        	['name'=>'Francis Labitad','role_id'=>3,'email'=>'flabitad@digicononline.com','password'=>'12345678']
        ];

        foreach ($users as $user) {
        	$u = new User;

        	$u->name = $user['name'];
        	$u->role_id = $user['role_id'];
        	$u->email = $user['email'];
        	$u->password = Hash::make($user['password']);
        	$u->save();
        }
    }
}
