<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class InventoryAttributeController extends Controller
{
    public function getInventoryAttr(Request $request){
        $allTheads = '';
        $allOptions = '';
        $cat = Category::find($request->cat_id);
        // dd($cat->inventoryAttributes);
        foreach($cat->inventoryAttributes as $att){
            $options = '';
            $label = $att->name;
            foreach($att->options as $opt){
                $options .= '<option value="'.$opt->option.'">'.$opt->option.'</option>';
            }

            $allTheads .= '<th class="inventoryAttributes">'.ucfirst($label).'</th> '; 
            $allOptions .= '<td class="inventoryAttributes">
                            <select name="inventoryAttr['.$label.']['.$request->id.']" class="form-control">
                                <option value="" selected disabled>Select '.$label.'</option>
                                '.$options.'
                            </select>
                        </td>';
        }
        echo json_encode(['label' => $allTheads, 'option' => $allOptions]);
    }

    public function getInventoryAttrOnNewInventory(Request $request){
        $allTheads = '';
        $allOptions = '';
        // dd($request->all());
        $cat = Category::find($request->cat_id);
        // dd($cat);
        foreach($cat->inventoryAttributes as $att){
            $options = '';
            foreach($att->options as $opt){
                $options .= '<option value="'.$opt->option.'">'.$opt->option.'</option>';
            }
            $allOptions .= '<select name="inventoryAttr['.$att->name.']" class="form-control">
                                <option value="" selected disabled>Select '.$att->name.'</option>
                                '.$options.'
                            </select>';
        }
        echo json_encode(['option' => $allOptions]);
    }
    
}
