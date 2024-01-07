<?php

namespace App\Http\Controllers;

use App\Exports\ExportData;
use App\Models\lates;
use App\Models\students;
use App\Models\users;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

class LatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = students::all();
        $lates = lates::with('student')->get();
        return view('lates.index', compact('lates', 'students'));
    }

    public function rekap()
    {
        $students = students::all();
        $lates = lates::with('student')->get();

        return view('lates.rekap ', compact('lates', 'students'));
    }

    public function detail($id)
    {
        $students = Students::find($id);
        $lates = Lates::where('student_id', $id)->with('student')->get();

        return view('lates.detail', compact('students', 'lates'));

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = students::all();
        return view('lates.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'required|mimes:png,jpg,jpeg',
            'student_id' => 'required',
        ]);

        lates::create([
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
            'bukti' => $request->file('bukti')->store('bukti-images'),
            'student_id' => $request->student_id,
        ]);

        return redirect()->back()->with('success', 'Berhasil menginput data keterlambatan');
    }

    /**
     * Display the specified resource.
     */
    public function show(lates $lates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lates $lates, $id)
    {
        $lates = lates::find($id);
        $students = students::all();

        return view('lates.edit', compact('lates', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, lates $lates, $id)
    {
        $request->validate([
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'required|image|file',
        ]);

        lates::where('id', $id)->update([
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
            'bukti' => $request->file('bukti')->store('bukti-images'),
        ]);

        return redirect()->back()->with('success', 'Berhasil mengupdate data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(lates $lates, $id)
    {
        lates::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    // public function downloadPDF($id)
    // {
    //     $lates = Lates::where('student_id', $id)
    //         ->with('student')
    //         ->orderBy('created_at', 'desc')
    //         ->get();

    //     $total = $lates->count();
    //     $student = $lates->first()->student;

    //     $pdf = PDF::loadView('lates.pdf', compact('lates', 'total', 'student'));

    //     return $pdf->download('keterlambatan_report.pdf');
    // }



    public function downloadPDF($id){


        $lates = lates::find($id)->toArray();
        view()->share('lates', $lates);

        $students = Students::where('id', $lates['student_id'])->with('rayon', 'rombel')->first()->toArray();

        $pembimbing = Users::where('id', $students['rayon']['user_id'])->first();

        $pdf = PDF::loadView('lates.cetakPdf', compact('lates', 'students', 'pembimbing'));
        return $pdf->download('Surat Pernyataan Keterlambatan.pdf');
}

    public function exportExcel()
    {
        $file_name = 'rekapitulasi_keterlambatan' . '.xlsx';
        return Excel::download(new ExportData, $file_name, ExcelExcel::XLSX);
    }

}