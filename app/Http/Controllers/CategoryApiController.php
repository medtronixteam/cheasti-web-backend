<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FaqCategory;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Faq;
use Illuminate\Http\Request;

use Validator;

class CategoryApiController extends Controller
{
    public function showCategory()
    {
        $categories = Category::all();

        if ($categories->count() > 0) {
            $response = [
                'message' => $categories,
                'status' => 'success',
                'code' => 200
            ];
        } else {
            $response = [
                'message' => 'Categories not found',
                'status' => 'error',
                'code' => 404
            ];
        }

        return response()->json($response, $response['code']);
    }
    public function showFaqCategory()
    {
      //  $categories = FaqCategory::with('children')->whereNull('parent_id')->get();
        $categories = FaqCategory::with('faqs')->get();

        if ($categories->count() > 0) {
            $response = [
                'message' => $categories,
                'status' => 'success',
                'code' => 200
            ];
        } else {
            $response = [
                'message' => 'Categories not found',
                'status' => 'error',
                'code' => 404
            ];
        }

        return response()->json($response, $response['code']);
    }

}
