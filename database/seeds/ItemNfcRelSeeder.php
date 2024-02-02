<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\ItemNfcRel;
use Illuminate\Support\Str;

class ItemNfcRelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for ($i = 1; $i <= 10; $i++) {
        //     $nfcSerialNumber = 'NFC' . str_pad($i, 3, '0', STR_PAD_LEFT); // Generates NFC001, NFC002, ..., NFC010

        //     ItemNfcRel::create([
        //         'nfc_serial_number' => $nfcSerialNumber,
        //         'item_id' => 1, // Assuming you have an item with ID $i in the 'items' table
        //         // 'ageing_in_days' => rand(1, 30),
        //     ]);
        // }
        for ($i = 1; $i <= 10; $i++) {
            $nfcSerialNumber = Str::random(10); // Generates a random 10-character string

            ItemNfcRel::create([
                'nfc_serial_number' => $nfcSerialNumber,
                'item_id' => 1, // Assuming you have an item with ID $i in the 'items' table
                // 'ageing_in_days' => rand(1, 30),
            ]);
        }
    }
}