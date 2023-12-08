<?php

namespace Database\Seeders;

use App\Models\MidtransKey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MidtransKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MidtransKey::create([
            'type' => 'server key prod',
            'key' => 'Mid-server-e44Y89GwU_d0w9M7ncmQzBvu',
            'isProd' => true
        ]);
        MidtransKey::create([
            'type' => 'server key dev',
            'key' => 'SB-Mid-server-U0LNlNf5EoS7-46FK7hbFsOQ',
            'isProd' => false
        ]);

        MidtransKey::create([
            'type' => 'client key prod',
            'key' => 'Mid-client-KSPe3HVCmwg_EIqM',
            'isProd' => true
        ]);
        MidtransKey::create([
            'type' => 'client key dev',
            'key' => 'SB-Mid-client-CU8cYh2JeI8H-I8s',
            'isProd' => false
        ]);

        MidtransKey::create([
            'type' => 'isProduction',
            'key' => 'false',
            'isProd' => config('app.env') == 'production' ? true : false
        ]);
    }
}
