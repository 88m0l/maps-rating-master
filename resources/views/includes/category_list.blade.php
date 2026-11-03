@php
use App\Models\Category;
$categories = Category::all();
@endphp


@foreach($categories as $category)
    <option value="{{ $category->id }}">{{ $category->title }}</option>
@endforeach

