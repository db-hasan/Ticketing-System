<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Price;
use App\Models\Entry;
use App\Models\Ride;
use App\Models\Ticket;
use App\Models\Ticket_details;

class DatabaseSeeder extends Seeder
{
    private $permissions = [
        'user-index', 'user-create', 'user-edit',
        'role-index', 'role-create', 'role-edit',
        'price-index', 'price-edit',
        'entry-index', 'entry-create', 'entry-print',
        'ride-index', 'ride-create', 'ride-edit',
        'ticket-index', 'ticket-create', 'ticket-delete', 'ticket-print',
        'index-report', 'sales-report', 'seller-report',
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

        // User Create
        $user = User::create([
            'name' => 'Developer',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => "1",
        ]);

        $role = Role::create(['name' => 'superadmin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->syncRoles([$role->id]);

        // Price Create
        Price::create([
            'name' => 'Entry Ticket',
            'price' => '50',
        ]);

        Ride::create([
            'name' => 'Ride 1',
            'price' => '100',
        ]);

        // ******seeder asign******
        // $this->call([
        //     UserSeeder::class
        // ]);

        Entry::factory(30000)->create();

        Ticket::factory(10000)
            ->has(Ticket_details::factory()->count(3), 'details')
            ->create();
    }
}
