<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Admin','Client','Anonnceur'];
        for($i=0;$i<count($roles);$i++){
            Role::create([
                'role'=>$roles[$i],
            ]);
        }
        User::create([
            'fname'=>'mourad',
            'lname'=>'hilali',
            'email'=>'admin@gmail.com',
            'phone'=>'0612345678',
            'role_id'=> 1,
            'password'=>'1q2w3e4r5t',
            'email_verified_at'=>now(),
        ]);
    }
}
