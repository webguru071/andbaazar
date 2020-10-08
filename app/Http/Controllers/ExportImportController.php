<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Excel;
use App\Exports\InventoryExport;
use App\Imports\InventoryImport;
use App\Imports\AttributImport;
use App\Exports\AttributeExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class ExportImportController extends Controller
{
  public function importExportView()
   {
      $data = DB::table('attributes')->get();
    return view('attribute.import',compact('data'));
   }

   /**
   * @return \Illuminate\Support\Collection
 
   /**
   * @return \Illuminate\Support\Collection
   */
   public function import()
   {
       Excel::import(new AttributImport,request()->file('file'));

       return back();
   }

   public function export() 
    {
        return Excel::download(new AttributeExport, 'attributes.xlsx');
    }
   

}
