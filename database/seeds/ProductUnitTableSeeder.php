<?php

use Illuminate\Database\Seeder;

class ProductUnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $data = [
            [
                'name'          => 'Miligram',
                'bn_name'       => 'মিলিগ্রাম',
                'description'    => 'miligram - মিলিগ্রাম (miligram)',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'Gram',
                'bn_name'       => 'গ্রাম',
                'description'    => 'gram - গ্রাম (gram)',
                'created_at'    => now(),
                'updated_at'    => now()
            ],  
            [
                'name'          => 'Poa',
                'bn_name'       => 'পোয়া',
                'description'    => 'one-fourth of a seer - পোয়া (poa)',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'Sher',
                'bn_name'       => 'সের',
                'description'    => 'seer (a Bengali measure of weight = 0.933 kg) - সের (sher)',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'One half kilogram',
                'bn_name'       => 'আধা কেজি',
                'description'    => 'one half kilogram - আধা কেজি (adha keji)',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'Kilogram',
                'bn_name'       => 'কেজি',
                'description'    => 'kilogram - কেজি (keji)',
                'created_at'    => now(),
                'updated_at'    => now()
            ],       
            [
                'name'          => 'Dari',
                'bn_name'       => 'দাড়ি',
                'description'    => '5 kilogram - 5 কেজি (keji)',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'One half Mon',
                'bn_name'       => 'আধা মন',
                'description'    => '20 kg',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'Mon',
                'bn_name'       => 'মন',
                'description'    => '40 kg',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'Litar',
                'bn_name'       => 'লিটার',
                'description'    => 'litre - লিটার (litar)',
                'created_at'    => now(),
                'updated_at'    => now()
            ],       
            [
                'name'          => 'Sisi',
                'bn_name'       => 'শিশি',
                'description'    => 'phial/small bottle - শিশি (shishi)',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'Auns',
                'bn_name'       => 'আউন্স',
                'description'    => 'ounce - আউন্স (auns)',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'Portion',
                'bn_name'       => 'টুকরা',
                'description'    => 'portion - টুকরা (tukra)',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'Bottle',
                'bn_name'       => 'বোতল',
                'description'    => 'bottle - বোতল (botol)',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'Hali',
                'bn_name'       => 'হালি',
                'description'    => 'group of four - হালি (hali)',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'Half a dozen',
                'bn_name'       => 'হাফ ডজন',
                'description'    => 'half a dozen - হাফ ডজন (haf dôjon)',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'name'          => 'Dozen',
                'bn_name'       => 'ডজন',
                'description'    => 'dozen - ডজন (dozen)',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            
          ];
      
          DB::table('product_units')->insert($data);
         }
      
    }

