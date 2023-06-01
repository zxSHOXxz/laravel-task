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
        $subjectNames = $headerRow->slice(3)->toArray();

        foreach ($rows as $row) {
            $student_number = $row[0];
            $studentName = $row[1];
            $date = intval($row[2]);
            $formatedDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date)->format('d/m/Y');

            $marks = $row->slice(3)->toArray();

            $student = Student::updateOrCreate(
                ['student_number' => $student_number],
                ['name' => $studentName],
                ['created_at' => $formatedDate],
                ['updated_at' => $formatedDate],
            );

            foreach ($subjectNames as $index => $subjectName) {
                $mark = isset($marks[$index]) ? $marks[$index] : null;

                $subject = Subject::firstOrCreate(['name' => $subjectName]);

                $student->subjects()->attach($subject);

                if (!is_null($mark)) {
                    $mark = Mark::updateOrCreate([
                        'student_id' => $student->id,
                        'subject_id' => $subject->id,
                    ], [
                        'mark' => $mark,
                    ]);
                }
            }
        }
    }
}
