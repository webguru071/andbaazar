<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Exports\InventoryExport;
use App\Imports\InventoryImport;
use App\Imports\AttributImport;
// use Maatwebsite\Excel\Facades\Excel;
class ExportImportController extends Controller
{
  public function importExportView()
   {
    return view('merchant.inventory.import');
   }

   /**
   * @return \Illuminate\Support\Collection
   */
//    public function export()
//    {
//        return Excel::download(new InventoryExport, 'users.xlsx');
//    }

   /**
   * @return \Illuminate\Support\Collection
   */
   public function import()
   {
       Excel::import(new AttributImport,request()->file('file'));

       return back();
   }

}
