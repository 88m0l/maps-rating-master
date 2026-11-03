<?php
namespace App\Http\Controllers;
use App\Models\Place;
use App\Traits\RateableTrait;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function create(){
        return view('add_place');
    }
    use RateableTrait;
    public function show(Place $place)
    {
        $place = Place::withCount('reviews')->with(['reviews' => function($query){
            $query->with('user')
            ->withCount('likes');
        }])->find($place->id);
        $avg = $this->averageRating($place);
        $total = $avg['total'];
        $service_rating = $avg['service_rating'];
        $quality_rating = $avg['quality_rating'];
        $cleanliness_rating = $avg['cleanliness_rating'];
        $pricing_rating = $avg['pricing_rating'];
        return view('details', compact('place','total', 'service_rating', 'quality_rating','cleanliness_rating', 'pricing_rating'));
    }

    public function store(Request $request){
        $data  = $request->except('image');

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/public/images'), $imageName);
            $data['image'] = $imageName;
        }
        $request->user()->places()->create($data);

        return back();
    }

}