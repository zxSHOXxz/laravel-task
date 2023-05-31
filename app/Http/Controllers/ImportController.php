<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;

class ImportController extends Controller
{

    public function create()
    {
        return view('cms.excel.create');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $path = $request->file('file')->getRealPath();
        $data = Excel::import(new StudentsImport, $path);

        return redirect()->back()->with('success', 'تم استيراد الملف بنجاح');
    }
}
