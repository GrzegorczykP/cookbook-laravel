<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'edit own recipes']);
        Permission::create(['name' => 'create recipe']);
        Permission::create(['name' => 'delete all recipes']);
        Permission::create(['name' => 'delete own recipes']);
        Permission::create(['name' => 'edit all recipes']);
        Permission::create(['name' => 'publish recipe']);
        Permission::create(['name' => 'unpublish recipe']);

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo(['edit own recipes', 'create recipe', 'delete own recipes']);
        $user = factory(App\User::class)->create(['email' => 'user@example.com']);
        $user->assignRole($role);

        $role2 = Role::create(['name' => 'moderator']);
        $role2->givePermissionTo(['edit all recipes', 'delete all recipes', 'publish recipe', 'unpublish recipe']);
        $user = factory(App\User::class)->create(['email' => 'moderator@example.com']);
        $user->assignRole($role, $role2);

        $role3 = Role::create(['name' => 'admin']);
        $user = factory(App\User::class)->create(['email' => 'admin@example.com']);
        $user->assignRole($role3, $role2, $role);
    }
}
