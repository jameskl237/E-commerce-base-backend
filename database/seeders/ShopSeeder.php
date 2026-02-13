<?php

// database/seeders/ShopSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;
use App\Models\User;

class ShopSeeder extends Seeder
{
    public function run()
    {
        $supplier = User::where('email', 'djielejames@gmail.com')->where('role', 'supplier')->first();

        if (!$supplier) {
            $this->command->warn('Supplier James Djiele not found. Please run UserSeeder first.');
            return;
        }

        // Vérifier si les boutiques existent déjà
        $existingShops = Shop::where('user_id', $supplier->id)->count();

        if ($existingShops >= 2) {
            $this->command->info('Les boutiques pour James Djiele existent déjà.');
            return;
        }

        // Première boutique : Matériel de sport
        $sportShop = Shop::where('user_id', $supplier->id)
            ->where('name', 'James Djiele Sport')
            ->first();

        if (!$sportShop) {
            Shop::create([
                'name' => 'J-Sport',
                'description' => 'Boutique spécialisée dans la vente de matériel de sport de qualité. Équipements pour tous les sports : football, basketball, tennis, fitness et bien plus. Nous proposons des articles de marques reconnues pour répondre à tous vos besoins sportifs.',
                'city' => 'Yaoundé',
                'district' => 'Nkoabang',
                'phone' => $supplier->phone,
                'user_id' => $supplier->id,
            ]);
        }

        // Deuxième boutique : Brocante
        $brocanteShop = Shop::where('user_id', $supplier->id)
            ->where('name', 'Brocante-Clift')
            ->first();

        if (!$brocanteShop) {
            Shop::create([
                'name' => 'Brocante-Clift',
                'description' => 'Brocante spécialisée dans la vente d\'objets anciens, de meubles vintage et d\'articles de collection. Découvrez des pièces uniques et authentiques qui apporteront du caractère à votre intérieur. Nous proposons également des services de restauration et d\'expertise.',
                'city' => 'Yaoundé',
                'district' => 'Nkoabang',
                'phone' => '237690179030',
                'user_id' => $supplier->id,
            ]);
        }
    }
}

