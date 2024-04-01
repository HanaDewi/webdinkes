<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("database/data/akun.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                DB::table('users')->insert([
                    "name" => $data['0'],
                    "email" => $data['1'],
                    "role" => $data['2'],
                    "password"=>bcrypt($data['3']),
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
      
