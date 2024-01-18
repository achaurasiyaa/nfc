<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Worker;

class WorkersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          // Clear existing data from the table
        //   Worker::truncate();

          // Insert sample data
          Worker::create([
              'name' => 'Rahul Sharma',
              'gate_pass_number' => '12345',
              'vendor_id' => 1,
              
          ]);
  
          Worker::create([
              'name' => 'Priya Patel',
              'gate_pass_number' => '67890',
              'vendor_id' => 2,
              
          ]);
  
          // Add more records to reach at least 10
          Worker::create([
              'name' => 'Amit Singh',
              'gate_pass_number' => '54321',
              'vendor_id' => 1,
              
          ]);
  
          Worker::create([
              'name' => 'Ananya Desai',
              'gate_pass_number' => '98765',
              'vendor_id' => 2,
              
          ]);
          Worker::create([
              'name' => 'Kunal Kapoor',
              'gate_pass_number' => '24680',
              'vendor_id' => 1,
              
          ]);
  
          Worker::create([
              'name' => 'Neha Rajput',
              'gate_pass_number' => '13579',
              'vendor_id' => 2,
          ]);
  
          Worker::create([
              'name' => 'Sneha Iyer',
              'gate_pass_number' => '11223',
              'vendor_id' => 1,
          ]);
  
          Worker::create([
              'name' => 'Rajesh Verma',
              'gate_pass_number' => '44556',
              'vendor_id' => 2,
          ]);
  
          Worker::create([
              'name' => 'Pooja Gupta',
              'gate_pass_number' => '78901',
              'vendor_id' => 1,
          ]);
  
          Worker::create([
              'name' => 'Vikram Yadav',
              'gate_pass_number' => '23456',
              'vendor_id' => 2,
          ]);
    }
}
