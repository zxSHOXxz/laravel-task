<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marks = Mark::all();
        $subjects = Subject::all(); // استرجاع جميع المواد
        $passingMarks = 50; // حد النجاح
        $students = Student::all();
        $studentsCount = count($students);

        $FailsStudentsCountBySubject = new Collection();
        foreach ($subjects as $subject) {
            $FailsStudentsCount = Mark::where('subject_id', $subject->id)
                ->where('mark', '<', $passingMarks)
                ->count();
            $FailsStudentsCountBySubject->push([
                'subject' => $subject->name,
                'count' => $FailsStudentsCount,
            ]);
        }
        $passingStudentsCountBySubject = new Collection();
        foreach ($subjects as $subject) {
            $passingStudentsCount = Mark::where('subject_id', $subject->id)
                ->where('mark', '>=', $passingMarks)
                ->count();
            $passingStudentsCountBySubject->push([
                'subject' => $subject->name,
                'count' => $passingStudentsCount,
            ]);
        }
        return view('cms.dashboard.index', compact('FailsStudentsCountBySubject', 'passingStudentsCountBySubject', 'studentsCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
