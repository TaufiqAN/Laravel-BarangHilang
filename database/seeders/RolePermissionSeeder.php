<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name'=>'tambah-admin']);
        Permission::create(['name'=>'hide-post']);
        Permission::create(['name'=>'lihat-profil']);

        Permission::create(['name'=>'tambah-post']);
        Permission::create(['name'=>'hapus-post']);
        Permission::create(['name'=>'edit-post']);

        Role::create(['name'=>'admin']);
        Role::create(['name'=>'user']);

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('tambah-admin');
        $roleAdmin->givePermissionTo('hide-post');
        $roleAdmin->givePermissionTo('lihat-profil');

        $roleUser = Role::findByName('user');
        $roleUser->givePermissionTo('tambah-post');
        $roleUser->givePermissionTo('hapus-post');
        $roleUser->givePermissionTo('edit-post');


    }
}
