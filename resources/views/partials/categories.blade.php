@foreach ($subcategories as $subcategory)
    <ul>
        <li>{{ $subcategory->name }}</li>
        @php
            $subcategory = $categories->where('parent_id', $subcategory->id)->all();
        @endphp
        @if ($subcategory != null)
            @include('partials.categories', ['subcategories' => $subcategory, 'categories' => $categories])
        @endif
    </ul>
@endforeach
