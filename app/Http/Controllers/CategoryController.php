<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function list(Request $request)
    {
        return Category::all();
    }

    public function addCategory(Request $request)
    {

        $fields = $request->validate([
            'name' => 'required',
        ]);

        $cat = Category::create([
            'name' => $fields['name'],
        ]);

        $response = [
            'response' => 201,
            'message' => 'Category created successfully !',
            'category' => $cat,
        ];

        return response($response, 201);
    }
    
    public function delCategory(Request $request, $id)
    {
        $cat = Category::find($id);
        if ($cat != null) {
            $response = $cat->delete();
            if ($response) {
                return [
                    'response' => 201,
                    'message' => 'Category deleted successfully !',
                ];
            } else {
                return [
                    'response' => 201,
                    'message' => 'unable to delete a category !',
                ];
            }
        } else {
            return [
                'response' => 201,
                'message' => 'Category not found !',
            ];
        }

        // 
    }




    //
}
