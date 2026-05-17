<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DummyUserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Mahasiswa SIMTA',
                'email' => 'mahasiswa@unjani.ac.id',
                'password' => Hash::make('password'),
                'role' => 'mhs',
                'nim_nip' => '1122334455',
            ],
            [
                'name' => 'Dosen Pembimbing',
                'email' => 'dosen@unjani.ac.id',
                'password' => Hash::make('password'),
                'role' => 'dsn',
                'nim_nip' => 'D1122334455',
            ],
            [
                'name' => 'Koordinator TA',
                'email' => 'koordinator@unjani.ac.id',
                'password' => Hash::make('password'),
                'role' => 'koor',
                'nim_nip' => 'K1122334455',
            ],
            [
                'name' => 'Admin Sistem',
                'email' => 'admin@unjani.ac.id',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'nim_nip' => 'A1122334455',
            ],
            [
                'name' => 'Kepala Program Studi',
                'email' => 'kaprodi@unjani.ac.id',
                'password' => Hash::make('password'),
                'role' => 'kaprodi',
                'nim_nip' => 'P1122334455',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
