<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\VillageExport;
use App\Imports\VillageImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class VillageExportImportController extends Controller
{
    public function importExportView()
    {
       $data = DB::table('villages')->get();
     return view('admin.excel_import_export.village.import',compact('data'));
    }

    public function import()
    {
        Excel::import(new VillageImport,request()->file('file'));
        
        Session::flash('success', 'Village Import Successfully!');
        
        return back();
    }
 
    public function export() 
     {
         return Excel::download(new VillageExport, 'villages.xlsx');
     }
}
