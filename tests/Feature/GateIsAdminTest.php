<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class GateIsAdminTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_if_user_is_admin()
    {
          // Create the 'admin' role
          $adminRole = Role::create(['name' => 'admin']);

          // Create the 'user' role
          $userRole = Role::create(['name' => 'user']);

          // Create a user with the 'admin' role
          $adminUser = User::create([
              'name' => 'Admin User',
              'email' => 'admin@example.com',
              'password' => bcrypt('password'),
              'role_id' => $adminRole->id, // Assign the admin role to the user
          ]);

          // Act as the admin user
          $this->actingAs($adminUser);

          // Check that the gate allows access to the 'admin' user
          $this->assertTrue(Gate::allows('is-admin', $adminUser));

          // Now create a regular user with the 'user' role
          $regularUser = User::create([
              'name' => 'Regular User',
              'email' => 'user@example.com',
              'password' => bcrypt('password'),
              'role_id' => $userRole->id, // Assign the user role to this user
          ]);

          // Act as the regular user
          $this->actingAs($regularUser);

          // Ensure the gate denies access for a non-admin user
          $this->assertFalse(Gate::allows('is-admin', $regularUser));
    }
}
