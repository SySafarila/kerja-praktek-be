<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrudUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_create()
    {
        $this->seed();
        $super_admin = User::where('email', 'super.admin@admin.com')->first();

        $response = $this->actingAs($super_admin)->post(route('admin.users.store'), [
            'name' => 'testing',
            'email' => 'testing@test.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertRedirect(route('admin.users.index'));
    }

    public function test_read()
    {
        $this->seed();
        $super_admin = User::where('email', 'super.admin@admin.com')->first();

        $response = $this->actingAs($super_admin)->get(route('admin.users.index'));

        $response->assertStatus(200);
    }

    public function test_update()
    {
        $this->seed();
        $super_admin = User::where('email', 'super.admin@admin.com')->first();

        $response = $this->actingAs($super_admin)->post(route('admin.users.store'), [
            'name' => 'testing',
            'email' => 'testing@test.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);
        $response->assertRedirect(route('admin.users.index'));

        $user = User::where('email', 'testing@test.com')->first();
        $response2 = $this->actingAs($super_admin)->patch(route('admin.users.update', $user->id), [
            'name' => 'testing2',
            'email' => 'testing@test.com'
        ]);
        $response2->assertRedirect(route('admin.users.index'));
    }

    public function test_delete()
    {
        $this->seed();
        $super_admin = User::where('email', 'super.admin@admin.com')->first();

        $response = $this->actingAs($super_admin)->post(route('admin.users.store'), [
            'name' => 'testing',
            'email' => 'testing@test.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);
        $response->assertRedirect(route('admin.users.index'));

        $user = User::where('email', 'testing@test.com')->first();
        $response2 = $this->actingAs($super_admin)->delete(route('admin.users.destroy', $user->id));
        $response2->assertRedirect(route('admin.users.index'));
    }
}
