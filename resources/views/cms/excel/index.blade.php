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
            <h5 class="mb-0">عرض درجات الطلاب</h5>
        </div>

        <table class="table datatable-basic">

            <thead>
                <tr>
                    <th>اسم الطالب</th>
                    <th>رقم الطالب</th>
                    @foreach ($subjects as $subject)
                        <th>{{ $subject->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->student_number }}</td>
                        @foreach ($subjects as $subject)
                            <td>
                                @foreach ($student->marks as $mark)
                                    @if ($mark->subject_id === $subject->id)
                                        {{ $mark->mark }}
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /basic datatable -->
@endsection






@section('scripts')
@endsection
