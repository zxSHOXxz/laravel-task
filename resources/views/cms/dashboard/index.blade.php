@extends('cms.master')

@section('title', 'لوحة التحكم ')

@section('tittle_1', ' لوحة التحكم ')
@section('tittle_2', ' لوحة التحكم ')


@section('styles')
    <style>
    </style>
@endsection


@section('content')


    <canvas id="myChart"></canvas>

@endsection






@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('cms/assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('cms/assets/demo/pages/form_select2.js') }}"></script>

    <script>
        const successfulStudentsData = {
            subjects: {!! json_encode($passingStudentsCountBySubject->pluck('subject')->toArray()) !!},
            counts: {!! json_encode($passingStudentsCountBySubject->pluck('count')->toArray()) !!},
        };

        const failsStudentsData = {
            subjects: {!! json_encode($FailsStudentsCountBySubject->pluck('subject')->toArray()) !!},
            counts: {!! json_encode($FailsStudentsCountBySubject->pluck('count')->toArray()) !!},
        };

        const chartData = {
            labels: successfulStudentsData.subjects,
            datasets: [{
                label: 'الطلاب الناجحين',
                data: successfulStudentsData.counts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
            }, {
                label: 'الطلاب الراسبين',
                data: failsStudentsData.counts,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
            }],
        };


        // تكوين الخيارات الخاصة بالمخطط
        const chartOptions = {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: {{ $studentsCount }},
                },
            },
            ticks: {
                stepSize: 1, // تحديد الفاصل بين الأرقام
            },
        };
        const canvas = document.getElementById('myChart');
        canvas.parentNode.style.height = '500px';
        canvas.parentNode.style.width = '500px';
        // إنشاء المخطط باستخدام بيانات الرسم والخيارات
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar', // نوع المخطط (عمودي)
            data: chartData, // بيانات المخطط
            options: chartOptions, // الخيارات
        });
    </script>
@endsection
