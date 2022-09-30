<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Admin\Vistor;
use Illuminate\Http\Request;
use App\Models\Admin\CardTap;
use App\Models\Admin\Employee;
use App\Imports\EmployeesImport;
use App\Http\Controllers\Controller;
use App\Models\Admin\AlcoholTest;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Redirect;

class EmployeeController extends Controller
{
    public function employees(Request $request)
    {


        $employees = Employee::all();

        return view('admin.employees', ['employees' => $employees]);
    }

    public function employeesAttendance(Request $request)
    {
        if ($request->get('departement') && $request->get('departement') != "") {

            $employees = Employee::with('taps')->where('department', $request->departement)->get();
        } else {
            $employees = Employee::with('taps')->get();
        }

        if ($request->has('start_date') && $request->start_date != "" && $request->end_date != '') {

            $dateS = date($request->start_date);
            $dateE = date($request->end_date);
        } else {
            $dateS = date('Y-m-d');
            $dateE = date('Y-m-d');
        }

        $taps = CardTap::orderBy('tapped_at', 'DESC')
            ->where('card_type', 'STAFF')
            ->whereBetween('tapped_at', [$dateS . " 00:00:00", $dateE . " 23:59:59"])
            ->pluck('tapped_at')
            ->toArray();

        $ymdDate = array_map(function ($el) {

            return date('Y-m-d', strtotime($el));
        }, $taps);


        $noDuplicate = array_slice(array_map(function ($el) {
            return $el;
        }, array_unique($ymdDate)), 0);

        $daysTaps = [];

        $noDuplicate = array_slice($noDuplicate, 0, 5);

        foreach ($noDuplicate as $t) {

            foreach ($employees->toArray() as $employee) {

                if (in_array($t, array_map(function ($tap) {

                    return date('Y-m-d', strtotime($tap['tapped_at']));
                }, $employee['taps']))) {

                    if (array_key_exists($t, $daysTaps)) {

                        array_push($daysTaps[$t], $employee);
                    } else {

                        $daysTaps[$t] = [];
                        array_push($daysTaps[$t], $employee);
                    }
                }
            }
        }

        return view('admin.attendance', ['filter' => $noDuplicate, 'daysTaps' => $daysTaps, 'depts' => $employees->pluck('department')]);
    }

    public function employeesAttendanceCategory(Request $request, $category)
    {

        if ($request->get('departement') && $request->get('departement') != "") {

            $employees = Employee::with('taps')->where(['category' => $category, 'department', $request->departement])->get();
        } else {
            $employees = Employee::with('taps')->where(['category' => $category])->get();
        }


        if ($request->has('start_date') && $request->start_date != "" && $request->end_date != '') {


            $dateS = date($request->start_date);
            $dateE = date($request->end_date);
        } else {
            $dateS = date('Y-m-d');
            $dateE = date('Y-m-d');
        }


        $taps = CardTap::orderBy('tapped_at', 'DESC')
            ->whereBetween('tapped_at', [$dateS . " 00:00:00", $dateE . " 23:59:59"])
            ->pluck('tapped_at')
            ->toArray();

        $ymdDate = array_map(function ($el) {
            return date('Y-m-d', strtotime($el));
        }, $taps);


        $noDuplicate = array_slice(array_map(function ($el) {
            return $el;
        }, array_unique($ymdDate)), 0);

        $daysTaps = [];

        $noDuplicate = array_slice($noDuplicate, 0, 5);

        foreach ($noDuplicate as $t) {

            foreach ($employees->toArray() as $employee) {

                if (in_array($t, array_map(function ($tap) {

                    return date('Y-m-d', strtotime($tap['tapped_at']));
                }, $employee['taps']))) {

                    if (array_key_exists($t, $daysTaps)) {

                        array_push($daysTaps[$t], $employee);
                    } else {
                        $daysTaps[$t] = [];
                        array_push($daysTaps[$t], $employee);
                    }
                }
            }
        }

        return view('admin.attendance', ['filter' => $noDuplicate, 'daysTaps' => $daysTaps, 'depts' => array_unique(Employee::pluck('department')->toArray())]);
    }

    public function uploadEmployees(Request $request)
    {
        Excel::import(new EmployeesImport, $request->file('file'));

        return redirect()->back()->with('success', 'Employees Imported Successfully');
    }


    public function employeesAttendanceDownload(Request $request)
    {

        $taps = CardTap::orderBy('tapped_at', 'DESC')->pluck('tapped_at')->toArray();


        $visitors = Vistor::with('taps')->get();

        $ymdDate = array_map(function ($el) {

            return date('Y-m-d', strtotime($el));
        }, $taps);

        $noDuplicate = array_slice(array_map(function ($el) {
            return $el;
        }, array_unique($ymdDate)), 0);

        $daysTaps = [];

        $noDuplicate = array_slice($noDuplicate, 0, 5);


        foreach ($noDuplicate as $t) {

            foreach ($visitors->toArray() as $visitor) {
                if (in_array($t, array_map(function ($tap) {

                    return date('Y-m-d', strtotime($tap['tapped_at']));
                }, $visitor['taps']))) {
                    if (array_key_exists($t, $daysTaps)) {

                        array_push($daysTaps[$t], $visitor);
                    } else {
                        $daysTaps[$t] = [];
                        array_push($daysTaps[$t], $visitor);
                    }
                }
            }
        }




        //in Controller
        $path1 = 'user_assets/assets/images/CIMERWALogo.png';

        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $logo1 = 'data:image/' . $type1 . ';base64,' . base64_encode($data1);


        //in Controller    
        $path2 = 'user_assets/assets/images/santech.png';
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($path2);
        $logo2 = 'data:image/' . $type2 . ';base64,' . base64_encode($data2);


        $pdf = PDF::loadview('report', ['logo1' => $logo1, 'logo2' => $logo2, 'filter' => $noDuplicate[0], 'daysTaps' => $daysTaps[$noDuplicate[0]]]);

        return $pdf->download('attendance.pdf');



        $pdf = PDF::loadview('admin.attendance', ['filter' => $noDuplicate[0], 'daysTaps' => $daysTaps[$noDuplicate[0]]]);
        return $pdf->download('attendance.pdf');
    }

    public function employeeBurn(Employee $employee)
    {
        $message = $employee->state ? "Burned to Pass the gate in" : "Granted to Pass the gate in";
        $employee->update(['state' => !$employee->state]);

        return Redirect::back()->with('success', 'Employee State has ' . $message);
    }

    public function employeeAttendanceOne(Request $request, $id)
    {


        if ($request->get('departement') && $request->get('departement') != "") {

            $employees = Employee::with('taps')->where(['category' => $category, 'department', $request->departement])->get();
        } else {
            $employees = Employee::with('taps')->where(['category' => $category])->get();
        }

        if ($request->has('start_date') && $request->start_date != "" && $request->end_date != '') {


            $dateS = date($request->start_date);
            $dateE = date($request->end_date);
        } else {
            $dateS = date('Y-m-d');
            $dateE = date('Y-m-d');
        }


        $taps = CardTap::orderBy('tapped_at', 'DESC')
            ->whereBetween('tapped_at', [$dateS . " 00:00:00", $dateE . " 23:59:59"])
            ->pluck('tapped_at')
            ->toArray();

        $ymdDate = array_map(function ($el) {
            return date('Y-m-d', strtotime($el));
        }, $taps);


        $noDuplicate = array_slice(array_map(function ($el) {
            return $el;
        }, array_unique($ymdDate)), 0);

        $daysTaps = [];

        $noDuplicate = array_slice($noDuplicate, 0, 5);

        foreach ($noDuplicate as $t) {

            foreach ($employees->toArray() as $employee) {

                if (in_array($t, array_map(function ($tap) {

                    return date('Y-m-d', strtotime($tap['tapped_at']));
                }, $employee['taps']))) {

                    if (array_key_exists($t, $daysTaps)) {

                        array_push($daysTaps[$t], $employee);
                    } else {
                        $daysTaps[$t] = [];
                        array_push($daysTaps[$t], $employee);
                    }
                }
            }
        }

        return view('admin.attendance_one', ['filter' => $noDuplicate, 'daysTaps' => $daysTaps, 'depts' => $employees->pluck('department')]);

    }


    public function alcoholTest()
    {
        $alcoholTest = AlcoholTest::all();
        return view('admin.alcohol_test', compact('alcoholTest'));
    }
}
