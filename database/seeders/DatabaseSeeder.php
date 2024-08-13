<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    private $permissions = [
        'user-index', 'user-create', 'user-edit',
        'role-index', 'role-create', 'role-edit',
        'ride-index', 'ride-create', 'ride-edit',
        'ticket-index', 'ticket-create', 'ticket-edit', 'ticket-delete',
        'report-index',
        'dashboard-index',
        'profle-update',
    ];
    
    
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        };

        $user = User::create([
            'name' => 'Ali Hasan',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => "1",
        ]);

        $role = Role::create(['name' => 'superadmin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->syncRoles([$role->id]);



        // ******seeder asign******
        // $this->call([
        //     UserSeeder::class
        // ]);
    }
}
