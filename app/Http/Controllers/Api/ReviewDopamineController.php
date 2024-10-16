<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewDopamineResource;
use App\Models\ReviewDephomine;
use Illuminate\Http\Request;

class ReviewDopamineController extends Controller
{
    /**
     * @OA\Get(
     *      path="/review-dopamines",
     *      tags={"review-dopamines"},
     *      summary="Get all review dopamines",
     *      description="Получение всех review dopamines",
     *      @OA\Response(response=200,description="review dopamines retrived successfully")
     * )
     */

     public function index(Request $request){
        $reviewDopamine = ReviewDopamineResource::collection(ReviewDephomine::all());
        return response()->json($reviewDopamine,200);
    }
}
