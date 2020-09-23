<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
		include('CategoriesAttr/Mobiles_Tablets.php');
    include('CategoriesAttr/Computers_Laptop.php');
    // include('CategoriesAttr/TV_Audio.php');
    include('CategoriesAttr/Camera.php');
    include('CategoriesAttr/tv_audio_video_gaming.php');
    include('CategoriesAttr/Home_Appliance.php');
   include('CategoriesAttr/Fashion.php');
   include('CategoriesAttr/Health_Beauty.php');
   include('CategoriesAttr/Bags_Travels.php');
   include('CategoriesAttr/Sports_Outdoors.php');
   include('CategoriesAttr/Laundry_Cleaning.php');
   include('CategoriesAttr/Kitchen_Dining.php');
   include('CategoriesAttr/Stationery_Craft.php');
   include('CategoriesAttr/Bedding_Bath.php');
   include('CategoriesAttr/Digital_Goods.php');
   include('CategoriesAttr/Toys_Games.php');
   include('CategoriesAttr/Medicine.php');
   include('CategoriesAttr/Pet_Supplies.php');
   include('CategoriesAttr/Mother_Baby.php');
   include('CategoriesAttr/Motors.php');
   include('CategoriesAttr/Media_Music_Books.php');
   include('CategoriesAttr/Groceries.php');
   include('CategoriesAttr/Furniture_Décor.php');
   include('CategoriesAttr/Tools_DIY_Outdoor.php');
   include('Smecategory/Bambao_and_cane_industries.php');
   include('Smecategory/Brass_bell-metal.php');
   include('Smecategory/Cool_Mat.php');
   include('Smecategory/Cottage_Industry.php');
   include('Smecategory/Cottage_Industry.php');
   include('Smecategory/Embroidered_Quilts.php');
   include('Smecategory/Jute_goods.php');
   include('Smecategory/Ornaments .php');
   include('Smecategory/Pottery .php');
   include('Smecategory/Textile_Weaving_factories.php');
	// dd($mobiles_tablets);
     
      \Baazar::insertRecords($mobiles_tablets);
      echo  'Mobiles & Tablets Done...<>';

      \Baazar::insertRecords($Computers_Laptop);
      echo  'Computers & Laptops Done....';

      \Baazar::insertRecords($tv_audio_video_gaming);
      echo  'TV, Audio , Video, Gaming Done...';

      \Baazar::insertRecords($camera);
      echo  'Camera Done....';

      \Baazar::insertRecords($home_appliances);
      echo  'Home Appliance Done....';

      \Baazar::insertRecords($health_beauty);
      echo  'Home Appliance Done....';
      \Baazar::insertRecords($fashion);
      echo  'Fashion Done....';

      \Baazar::insertRecords($bags_travels);
      echo  'Bags And Travels Done....';

       \Baazar::insertRecords($sports_outdoors);
      echo  'Bags And Travels Done....';

      \Baazar::insertRecords($laundry_cleaning);
      echo  'Laundry & Cleaning Done....';

      \Baazar::insertRecords($kitchen_dining);
      echo  'Laundry & Cleaning Done....';

       \Baazar::insertRecords($stationery_craft);
      echo  'Sattinary & Craft  Done....';

      \Baazar::insertRecords($bedding_bath);
      echo  'Bedding & Bath  Done....';

       \Baazar::insertRecords($toys_games);
      echo  'Toys & Games  Done....';

        \Baazar::insertRecords($medicine);
      echo  'Medicine  Done....';

         \Baazar::insertRecords($pet_supplies);
      echo  'Pet Supplies  Done....';

         \Baazar::insertRecords($mother_baby);
      echo  'Mother & Baby  Done....';

          \Baazar::insertRecords($motors);
      echo  'Motors Done....';

           \Baazar::insertRecords($media_music_books);
      echo  'Media, Music & Books Done....';

   \Baazar::insertRecords($groceries);
      echo  'Groceries Done....';

       \Baazar::insertRecords($furniture_decor);
      echo  'Furniture & Décor Done....';

         \Baazar::insertRecords($tools_diy_outdoor);
      echo  'Tools, DIY & Outdoor Done....';

    // Sme Category Start //

      \Baazar::insertRecordsSme($bambocane);
      echo  'Bambo Done....';

      \Baazar::insertRecordsSme($brass_bell_metal);
      echo  'Brass Done....';

      \Baazar::insertRecordsSme($cool_mat);
      echo  'Cool Mat Done....';

      \Baazar::insertRecordsSme($cottage_industries);
      echo  'Cottage Done....';

      \Baazar::insertRecordsSme($embroidered_quilts);
      echo  'Embroidered Done....';

      \Baazar::insertRecordsSme($jute_goods);
      echo  'Jute Done....';

      \Baazar::insertRecordsSme($ornaments);
      echo  'Jute Done....';

      \Baazar::insertRecordsSme($pottery);
      echo  'Pottery Done....';

      \Baazar::insertRecordsSme($textile_weaving_factories);
      echo  'Pottery Done....';

   // Krishi Product Category //

   //  \Baazar::insertRecordsKrishi($egg);
   //  echo  'Betel Done....';

  // Krishi Product Category End //

   	}

  }
