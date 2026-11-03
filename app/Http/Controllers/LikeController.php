<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $review = Review::findOrFail($request->review_id);
        if($review->user_id === $request->user()->id){
            return response()->json([
                'message' => 'لا يمكنك التصويت على مراجعتك الخاصة.'
            ], 403);
        }
        $request->user()->likes()->toggle($request->review_id);
        return Review::find($request->review_id)->likes()->count();
    }

}
