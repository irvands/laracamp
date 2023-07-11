<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Camp;

class CampTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $camps =[
            [
                'title'         =>  'Gila Belajar',
                'slug'          =>  'gila-belajar',
                'price'         =>  280,

                //tulis manual jika menggunakan query builder
                'created_at'    =>  date('Y-m-d H:i:s', time()),
                'updated_at'    =>  date('Y-m-d H:i:s', time())                
            ],
            [
                'title'         =>  'Baru Mulai',
                'slug'          =>  'baru-mulai',
                'price'         =>  140,

                //tulis manual jika menggunakan query builder
                'created_at'    =>  date('Y-m-d H:i:s', time()),
                'updated_at'    =>  date('Y-m-d H:i:s', time())                
            ]
        ];

        //cara pertama insert menggunakan eloquent model (created_at dan updated_at akan terisi otomatis)
        // foreach ($camps as $key => $camp){
        //     Camp::create($camp);
        // }

        //cara kedua insert menggunakan query builder 
        Camp::insert($camps);

    }
}
