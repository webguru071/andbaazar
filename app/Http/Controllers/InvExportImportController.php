<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\InventoryExport;
use App\Imports\InventoryImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class InvExportImportController extends Controller
{
    public function importExportView()
   {
      $data = DB::table('inventory_attributes')->get();
    return view('admin.excel_import_export.inventory.import',compact('data'));
   }

   /**
   * @return \Illuminate\Support\Collection
 
   /**
   * @return \Illuminate\Support\Collection
   */
   public function import()
   {
       Excel::import(new InventoryImport,request()->file('file'));
       
       Session::flash('success', 'Inventory Import Successfully!');
       
       return back();
   }

   public function export() 
    {
        return Excel::download(new InventoryExport, 'inventory_attributes.xlsx');
    }
}
