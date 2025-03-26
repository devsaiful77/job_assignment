<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create([
            'role_id' => 1, 
        ]);

        
        Sanctum::actingAs($this->admin);
    }

    public function it_should_list_users_except_current_user()
    {
        
        $adminRoleId = 1;
        User::factory()->create([
            'role_id' => $adminRoleId,
        ]);

        User::factory()->count(3)->create([
            'role_id' => $adminRoleId, 
        ]);

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
            ->assertJsonStructure(['status', 'users']);
    }

   
    public function it_should_create_a_user()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role_id' => 2, 
        ];

        $response = $this->postJson('/api/user/store', $userData);

        $response->assertStatus(200)
            ->assertJson(['status' => true, 'message' => 'User created successfully']);

        $this->assertDatabaseHas('users', ['email' => 'johndoe@example.com']);
    }

    
    public function it_should_retrieve_a_user()
    {
        
        $roleId = 1; 
        $user = User::factory()->create([
            'role_id' => $roleId, 
        ]);

        
        $response = $this->getJson("/api/user/edit/{$user->id}");

        
        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $user->id]);
    }

    
    public function it_should_update_a_user()
    {
        $user = User::factory()->create();

        $updateData = [
            'name' => 'Updated Name',
            'email' => $user->email,
            'role_id' => $user->role_id,
        ];

        $response = $this->postJson("/api/user/update/{$user->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson(['status' => true, 'message' => 'User updated successfully']);

        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Updated Name']);
    }

   
    public function it_should_update_user_password()
    {
        $user = User::factory()->create([
            'password' => Hash::make('oldpassword'),
        ]);

        $passwordData = [
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ];

        $response = $this->postJson("/api/user/password-update/{$user->id}", $passwordData);

        $response->assertStatus(200)
            ->assertJson(['status' => true, 'message' => 'Password updated successfully']);

        $this->assertTrue(Hash::check('newpassword123', $user->fresh()->password));
    }

    
    public function it_should_toggle_user_status()
    {
        
        $roleId = 1; 
        $user = User::factory()->create([
            'role_id' => $roleId,
        ]);

        // Perform your actions to test toggling user status
        $response = $this->getJson("/api/user/active-inactive/{$user->id}");

        // Add assertions to verify status is toggled correctly
        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'User status updated successfully']);
    }
}
