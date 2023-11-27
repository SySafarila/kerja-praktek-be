<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class UploadFileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_upload_image()
    {
        $filename = Str::random(40) . '.jpg';
        $image = UploadedFile::fake()->image($filename);
        $path = '/tests/images/';
        Storage::putFileAs($path, $image, $filename);
        Storage::assertExists($path . $filename);
    }

    public function test_delete_image()
    {
        $filename = Str::random(40) . '.jpg';
        $image = UploadedFile::fake()->image($filename);
        $path = '/tests/images/';
        Storage::putFileAs($path, $image, $filename);
        Storage::delete($path . $filename);
        Storage::assertMissing($path . $filename);
    }
}
