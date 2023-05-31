<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\Subject;
use App\Models\SubjectName;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentsImport implements ToModel, ToCollection
{
    public function collection(Collection $rows)
    {
        $headers = $rows->shift()->toArray();
        $data = $rows->toArray();

        foreach ($data as $row) {
            $student = Student::create([
                'name' => $row[0]
            ]);

            for ($i = 1; $i < count($row); $i++) {
                Subject::create([
                    'name' => $headers[$i],
                    'grade' => $row[$i],
                    'student_id' => $student->id
                ]);
            }
        }
        array_shift($headers);

        foreach ($headers as $header) {
            SubjectName::firstOrCreate(['name' => $header]);
        }
    }
    public function model(array $row)
    {
        return;
    }
}
