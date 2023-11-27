<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrudBlogTest extends TestCase
{
    use RefreshDatabase;

    public function test_create()
    {
        $this->seed();
        $super_admin = User::where('email', 'super.admin@admin.com')->first();

        $response = $this->actingAs($super_admin)->post(route('admin.blogs.store'), [
            'title' => 'testing',
            'body' => '<h1>body</h1>'
        ]);

        $response->assertRedirect(route('admin.blogs.index'));
    }

    public function test_read()
    {
        $this->seed();
        $super_admin = User::where('email', 'super.admin@admin.com')->first();

        $response = $this->actingAs($super_admin)->get(route('admin.blogs.index'));

        $response->assertStatus(200);
    }

    public function test_update()
    {
        $this->seed();
        $super_admin = User::where('email', 'super.admin@admin.com')->first();

        $response = $this->actingAs($super_admin)->post(route('admin.blogs.store'), [
            'title' => 'testing',
            'body' => '<h1>body</h1>'
        ]);
        $response->assertRedirect(route('admin.blogs.index'));

        $blog = Blog::where('title', 'testing')->first();
        $response2 = $this->actingAs($super_admin)->patch(route('admin.blogs.update', $blog->id), [
            'title' => 'testing2',
            'body' => '<h1>body</h1>'
        ]);
        $response2->assertRedirect(route('admin.blogs.index'));
    }

    public function test_delete()
    {
        $this->seed();
        $super_admin = User::where('email', 'super.admin@admin.com')->first();

        $response = $this->actingAs($super_admin)->post(route('admin.blogs.store'), [
            'title' => 'testing',
            'body' => '<h1>body</h1>'
        ]);
        $response->assertRedirect(route('admin.blogs.index'));

        $blog = Blog::where('title', 'testing')->first();
        $response2 = $this->actingAs($super_admin)->delete(route('admin.blogs.destroy', $blog->id));
        $response2->assertRedirect(route('admin.blogs.index'));
    }
}
