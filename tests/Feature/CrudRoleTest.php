<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CrudRoleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create()
    {
        $this->seed();
        $super_admin = User::where('email', 'super.admin@admin.com')->first();

        $response = $this->actingAs($super_admin)->post(route('admin.roles.store'), [
            'name' => 'testing'
        ]);

        $response->assertRedirect(route('admin.roles.index'));
    }

    public function test_read()
    {
        $this->seed();
        $super_admin = User::where('email', 'super.admin@admin.com')->first();

        $response = $this->actingAs($super_admin)->get(route('admin.roles.index'));

        $response->assertStatus(200);
    }

    public function test_update()
    {
        $this->seed();
        $super_admin = User::where('email', 'super.admin@admin.com')->first();

        $response = $this->actingAs($super_admin)->post(route('admin.roles.store'), [
            'name' => 'testing'
        ]);
        $response->assertRedirect(route('admin.roles.index'));

        $role = Role::findByName('testing');
        $response2 = $this->actingAs($super_admin)->patch(route('admin.roles.update', $role->id), [
            'name' => 'testing2'
        ]);
        $response2->assertRedirect(route('admin.roles.index'));
    }

    public function test_delete()
    {
        $this->seed();
        $super_admin = User::where('email', 'super.admin@admin.com')->first();

        $response = $this->actingAs($super_admin)->post(route('admin.roles.store'), [
            'name' => 'testing'
        ]);
        $response->assertRedirect(route('admin.roles.index'));

        $role = Role::findByName('testing');
        $response2 = $this->actingAs($super_admin)->delete(route('admin.roles.destroy', $role->id));
        $response2->assertRedirect(route('admin.roles.index'));
    }
}
