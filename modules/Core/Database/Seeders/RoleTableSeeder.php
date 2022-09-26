<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Omaicode\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $super_admin = Role::firstOrCreate([
            'name'       => 'Super Admin',
            'guard_name' => 'admins'
        ]);

        $publisher = Role::firstOrCreate([
            'name'       => 'Publisher',
            'guard_name' => 'admins'
        ]);
    }
}
