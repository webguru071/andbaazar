<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Exports\InventoryExport;
use App\Imports\InventoryImport;
use App\Imports\AttributImport;
use Illuminate\Support\Facades\DB;
// use Maatwebsite\Excel\Facades\Excel;
class ExportImportController extends Controller
{
  public function importExportView()
   {
      $data = DB::table('attributes')->get();
    return view('merchant.inventory.import',compact('data'));
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
   // public function import()
   // {
   //     Excel::import(new AttributImport,request()->file('file'));

   //     return back();
   // }

   function import(Request $request)
   {

      {
         Excel::import(new AttributImport,request()->file('file'));
            
         return back();
     }
     $validator = Validator::make(
      [
          'file'      => $file,
          'extension' => strtolower($file->getClientOriginalExtension()),
      ],
      [
          'file'          => 'required',
          'extension'      => 'required|mimes:csv'
      ]
  );
    // $this->validate($request, [
    //  'select_file'  => 'required|mimes:xls,xlsx'
    // ]);

   //  $path = $request->file('select_file')->getRealPath();

   //  $data = Excel::load($path)->get();

   // if($request->hasFile('select_file')){
   //    $path = $request->file('select_file')->getRealPath();
   //    $data = \Excel::load($path)->get();
   // //  $data = DB::table('attributes')->get();
   //  if($data->count() > 0)
   //  {
   //   foreach($data->toArray() as $key => $value)
   //   {
   //    foreach($value as $row)
   //    {
   //     $insert_data[] = array(
   //      'label'         => $row['Label Name'],
   //      'type'          => $row['Type'],
   //      'required'      => $row['Required'],
   //      'suggession'    => $row['Suggession'],               
   //     );
   //    }
   //   }

   //   if(!empty($insert_data))
   //   {
   //    DB::table('attributes')->insert($insert_data);
   //   }
   //  }
   //  return back()->with('success', 'Excel Data Imported successfully.');
   // }

}
}
