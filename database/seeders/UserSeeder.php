<?php

// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $email = "djielejames@gmail.com";
        $user = User::where('email', $email)->first();
        
        if ($user) {
            // Mettre à jour les informations si l'utilisateur existe déjà
            $user->update([
                'name' => 'James Djiele',
                'role' => 'supplier',
                'password' => Hash::make('ayobo237'),
                'username' => 'jameskl237',
                'phone' => '237695988879',
                'address' => 'yaounde',
            ]);
        } else {
            // Créer un nouvel utilisateur
            User::create([
                'name' => 'James Djiele',
                'email' => $email,
                'role' => 'supplier',
                'password' => Hash::make('ayobo237'),
                'username' => 'jameskl237',
                'phone' => '237695988879',
                'address' => 'yaounde',
            ]);
        }
    }
}

