<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class CrudPermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_create()
    {
        $this->seed();
        $super_admin = User::where('email', 'super.admin@admin.com')->first();

        $response = $this->actingAs($super_admin)->post(route('admin.permissions.store'), [
            'name' => 'testing'
        ]);

        $response->assertRedirect(route('admin.permissions.index'));
    }

    public function test_read()
    {
        $this->seed();
        $super_admin = User::where('email', 'super.admin@admin.com')->first();

        $response = $this->actingAs($super_admin)->get(route('admin.permissions.index'));

        $response->assertStatus(200);
    }

    public function test_update()
    {
        $this->seed();
        $super_admin = User::where('email', 'super.admin@admin.com')->first();

        $response = $this->actingAs($super_admin)->post(route('admin.permissions.store'), [
            'name' => 'testing'
        ]);
        $response->assertRedirect(route('admin.permissions.index'));

        $permission = Permission::findByName('testing');
        $response2 = $this->actingAs($super_admin)->patch(route('admin.permissions.update', $permission->id), [
            'name' => 'testing2'
        ]);
        $response2->assertRedirect(route('admin.permissions.index'));
    }

    public function test_delete()
    {
        $this->seed();
        $super_admin = User::where('email', 'super.admin@admin.com')->first();

        $response = $this->actingAs($super_admin)->post(route('admin.permissions.store'), [
            'name' => 'testing'
        ]);
        $response->assertRedirect(route('admin.permissions.index'));

        $permission = Permission::findByName('testing');
        $response2 = $this->actingAs($super_admin)->delete(route('admin.permissions.destroy', $permission->id));
        $response2->assertRedirect(route('admin.permissions.index'));
    }
}
