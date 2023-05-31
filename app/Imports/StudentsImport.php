<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Mark;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $headerRow = $rows->shift();
        $subjectNames = $headerRow->slice(2)->toArray();

        foreach ($rows as $row) {
            $student_number = $row[0];
            $studentName = $row[1];
            $marks = $row->slice(2)->toArray();

            $student = Student::updateOrCreate(
                ['student_number' => $student_number],
                ['name' => $studentName]
            );


            foreach ($subjectNames as $index => $subjectName) {
                $mark = isset($marks[$index]) ? $marks[$index] : null;

                $subject = Subject::firstOrCreate(['name' => $subjectName]);

                $student->subjects()->attach($subject);

                if (!is_null($mark)) {
                    Mark::create([
                        'student_id' => $student->id,
                        'subject_id' => $subject->id,
                        'mark' => $mark,
                    ]);
                }
            }
        }
    }
}
