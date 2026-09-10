<?php

namespace Database\Seeders;

use App\Models\Canteen;
use App\Models\Menu;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class DemoCanteenSeeder extends Seeder
{
    public function run(): void
    {
        // Kantin Utama
        $canteen = Canteen::updateOrCreate(
            ['slug' => 'kantin-pusat'],
            ['name' => 'Kantin Pusat Utama']
        );

        // Tenant 1
        $tenantA = Tenant::updateOrCreate(
            ['canteen_id' => $canteen->id, 'code' => 'TNT-01'],
            ['slug' => 'warung-bu-siti', 'display_name' => 'Warung Bu Siti', 'status' => 'active']
        );

        Menu::updateOrCreate(
            ['tenant_id' => $tenantA->id, 'name' => 'Nasi Goreng Special'],
            ['price_amount' => 15000, 'is_available' => true]
        );

        // Tenant 2
        $tenantB = Tenant::updateOrCreate(
            ['canteen_id' => $canteen->id, 'code' => 'TNT-02'],
            ['slug' => 'es-kopi-kenangan', 'display_name' => 'Es Kopi Kenangan', 'status' => 'active']
        );

        Menu::updateOrCreate(
            ['tenant_id' => $tenantB->id, 'name' => 'Es Kopi Susu'],
            ['price_amount' => 12000, 'is_available' => true]
        );
    }
}
