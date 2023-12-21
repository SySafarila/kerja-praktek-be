<?php

namespace Database\Seeders;

use App\Models\PpdbSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PpdbSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PpdbSetting::create([
            'key' => 'price',
            'value' => '150000'
        ]);
        PpdbSetting::create([
            'key' => 'accept_students',
            'value' => 'true'
        ]);
        PpdbSetting::create([
            'key' => 'payment_methods',
            'value' => 'qris,va_bca,va_bni,va_bri,va_permata,va_cimb,gopay,shopeepay,offline'
        ]);
    }
}
