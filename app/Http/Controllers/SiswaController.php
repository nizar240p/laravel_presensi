<?php

namespace App\Http\Controllers;

use App\Models\Attdetail;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;

        $atttoday = Attdetail::join('attendances', 'attdetails.attendance_id', '=', 'attendances.id')
            ->select('attdetails.id', 'attendance_id', 'student_id', 'attstatus')
            ->where([
                ['student_id', '=', $id],
                ['attendances.date', '=', date('Y-m-d')],
                ])
            ->orderBy('attdetails.id', 'desc')
            ->paginate(5);

        $attendance = Attdetail::join('attendances', 'attdetails.attendance_id', '=', 'attendances.id')
            ->select('attdetails.id', 'attendance_id', 'student_id', 'attstatus')
            ->where([
                ['student_id', '=', $id],
                ['attendances.date', '<>', date('Y-m-d')],
                ])
            ->orderBy('attdetails.id', 'desc')
            ->paginate(5);

        return view('siswa')->with([
            'no' => 1,
            'atttodays' => $atttoday,
            'attendances' => $attendance,
        ]);
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
        $data = Attdetail::find($id);

        if($data->attendance->date == date('Y-m-d')){   
            return view('formpresensi')->with(['data' => $data,]);
        }else{
            return redirect()->route('siswa.index');
        }
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
        $data = [
            'attstatus' => $request->attstatus,
        ];

        Attdetail::find($id)->update($data);
        
        return redirect('/siswa')->with('success', 'Presensi Berhasil!');
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

    public function riwayat()
    {
        $id = Auth::user()->id;

        $attendance = Attdetail::join('attendances', 'attdetails.attendance_id', '=', 'attendances.id')
            ->select('attdetails.id', 'attendance_id', 'student_id', 'attstatus')
            ->where([
                ['student_id', '=', $id],
                ['attendances.date', '<>', date('Y-m-d')],
                ])
            ->orderBy('attdetails.id', 'desc')
            ->paginate(5);

        return view('history')->with([
            'no' => 1,
            'attendances' => $attendance,
        ]);
    }
}
