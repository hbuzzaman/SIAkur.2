<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;
use App\Departemen;
use App\LokasiAlatukur;
use App\Maker;
use App\Pic;
use App\TempatKalibrasi;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'admin',
            
        ]);

        User::create([
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'staff',
        ]);

        User::create([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'manager',
        ]);
        
        Maker::create([
            'nama_maker' => 'TOHNICHI',
        ]);

        Departemen::create([
            'nama_departemen' => 'QUALITY CONTROL',
        ]);

        LokasiAlatukur::create([
            'lokasi_alatukur' => 'MEASURING',
        ]);

        TempatKalibrasi::create([
            'tempat_kalibrasi' => 'www',
            'alamat' => 'bekasi',
        ]);

        Pic::create([
            'idkaryawan' => '1a2b',
            'nama_pic' => 'ajiz',
            'departemen_id' => '1',
        ]);
    }
}