@if ($categories)
    <ul>
        @foreach ($categories as $category)
            <li>
                {{ $category->name }}
                @php
                    $categories = collect($categories);
                    $childrens = $categories->where('parent_id', $category->id)->all();
                @endphp
                @if ($childrens)
                    @include('partials.categories', ['categories' => $childrens])
                @endif
            </li>
        @endforeach
    </ul>
@endif
