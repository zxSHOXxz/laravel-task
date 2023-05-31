@extends('cms.master')
@section('title', 'التصنيفات')

@section('tittle_1', ' عرض التصنيفات ')
@section('tittle_2', ' عرض التصنيفات ')


@section('styles')
    <style>
        .color {
            color: #fff;
            padding: 15px;
            width: 35px;
        }
    </style>
@endsection


@section('content')

    <!-- Basic datatable -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">قائمة التصنيفات</h5>
        </div>
        <div class="category p-5">
            @php
                renderCategories($categories);
            @endphp
        </div>

    </div>
    <!-- /basic datatable -->
    @php
        function renderCategories($categories, $parentId = null)
        {
            echo '<ul>';

            foreach ($categories as $category) {
                if ($category['parent_id'] == $parentId) {
                    echo '<li>' . $category['name'];
                    renderCategories($categories, $category['id']);
                    echo '</li>';
                }
            }

            echo '</ul>';
        }

    @endphp
@endsection






@section('scripts')
@endsection
