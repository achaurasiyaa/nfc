<?php

use App\Asset;
use App\Team;
use Illuminate\Database\Seeder;

/**
 * Class AssetsTableSeeder
 */
class AssetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $assets = [
            'Shoes',
            'masks',
            'Safety Goggles            ',
            'safety shoes            ',
            'Jackets',
        ];

        foreach ($assets as $asset) {
            Asset::factory()->create([
                'name'        => $asset,
                'description' => $asset
            ]);
        }
    }
}
