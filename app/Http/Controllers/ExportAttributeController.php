<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
class ExportAttributeController extends Controller
{
    function index()
    {
        $attribute_data = DB::table('attributes')->get();
        return view('attribute.export')->with('attribute_data', $attribute_data);
    }

    function excel()
    {
     $attribute_data = DB::table('attributes')->get()->toArray();
     $attribute_array[] = array('Label', 'Suggestion', 'Type', 'Required');
     foreach($attribute_data as $attribute)
     {
      $attribute_array[] = array(
       'Label'  => $attribute->label,
       'Suggestion'   => $attribute->suggestion,
       'Type'    => $attribute->type,
       'Required'  => $attribute->required    
      );
     }
     Excel::create('Attribute Data', function($excel) use ($attribute_array){
      $excel->setTitle('Attribute Data');
      $excel->sheet('Attribute Data', function($sheet) use ($attribute_array){
       $sheet->fromArray($attribute_array, null, 'A1', false, false);
      });
     })->download('xlsx');
    }
}



}
