<?php

namespace Database\Seeders;
use App\IssueRecord;
use App\Worker;
use App\ItemNfcRel;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IssueRecordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IssueRecord::truncate();
        // Insert sample data
        $data = [
            [
                'worker_id' => Worker::inRandomOrder()->first()->id,
                'issue_date' => now()->subDays(10)->toDateString(),
                'nfc_tag_id' => ItemNfcRel::inRandomOrder()->first()->id,
                'is_expired' => false,
                'expire_date' => now()->addDays(20)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'worker_id' => Worker::inRandomOrder()->first()->id,
                'issue_date' => now()->subDays(5)->toDateString(),
                'nfc_tag_id' => ItemNfcRel::inRandomOrder()->first()->id,
                'is_expired' => true,
                'expire_date' => now()->subDays(2)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'worker_id' => Worker::inRandomOrder()->first()->id,
                'issue_date' => now()->subDays(5)->toDateString(),
                'nfc_tag_id' => ItemNfcRel::inRandomOrder()->first()->id,
                'is_expired' => true,
                'expire_date' => now()->subDays(2)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'worker_id' => Worker::inRandomOrder()->first()->id,
                'issue_date' => now()->subDays(15)->toDateString(),
                'nfc_tag_id' => ItemNfcRel::inRandomOrder()->first()->id,
                'is_expired' => false,
                'expire_date' => now()->addDays(10)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more data as needed
        ];

        // Insert the data into the 'issue_records' table
        IssueRecord::insert($data);
    }
}
