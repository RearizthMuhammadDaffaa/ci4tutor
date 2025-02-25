<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class OrangSeeder extends Seeder
{
    public function run()
    {
      $faker = \Faker\Factory::create('id_ID');
      for($i = 0; $i < 50; $i++){

        $data = [
          'nama'       => $faker->name,
          'alamat'     => $faker->address,
          'created_at' => Time::createFromTimestamp($faker->unixTime()),
          'updated_at' =>  Time::now()
        ];
        $this->db->table('orang')->insert($data);
      }
      
        // $data = [
        //    [ 
        //     'nama'       => 'Daffaa',
        //     'alamat'     => 'JL.Sumedang no 666',
        //     'created_at' =>  Time::now(),
        //     'updated_at' =>  Time::now()
        //    ],

        //    [ 
        //     'nama'       => 'DODY',
        //     'alamat'     => 'JL.Sumedang no 666',
        //     'created_at' =>  Time::now(),
        //     'updated_at' =>  Time::now()
        //    ],

        //    [ 
        //     'nama'       => 'Rearizth Daffaa',
        //     'alamat'     => 'JL.Sumedang no 666',
        //     'created_at' =>  Time::now(),
        //     'updated_at' =>  Time::now()
        //    ],
        // ];

        // Simple Queries
        // $this->db->query('INSERT INTO orang (nama, alamat,created_at,updated_at) VALUES(:nama:, :alamat:,:created_at:,:updated_at:)', $data);

        // Using Query Builder

        // untuk mengisi banyak data
        // $this->db->table('orang')->insertBatch($data);
    }
}