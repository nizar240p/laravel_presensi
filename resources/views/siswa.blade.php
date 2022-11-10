@extends('master')

@section('body')
<div class="lg:flex">
    @include('sidebar')

    {{-- <h1>Main</h1> --}}
    <div class="lg:w-5/6">
        <div class="w-full h-10 bg-blue-500 lg:hidden">
            <button id="hamburger" name="hamburger" type="button" class="block absolute left-4">
                <span class="hamburger-line transition duration-300 ease-in-out origin-top-left"></span>
                <span class="hamburger-line transition duration-300 ease-in-out"></span>
                <span class="hamburger-line transition duration-300 ease-in-out origin-bottom-left"></span>
            </button>
        </div>

        <div class="px-3 py-10 lg:px-6" id="main">
            <div class="mb-10">
                <h2 class="text-2xl font-normal mb-4 text-zinc-800">Presensi Hari Ini</h2>
                <div class="overflow-scroll">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Guru</th>
                                <th>Mapel</th>
                                <th>Kelas</th>
                                <th>Tanggal</th>
                                <th>Topik</th>
                                <th>Nama Siswa</th>
                                <th>Kehadiran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($atttodays as $attendance)
                            <tr>
                                <td class="text-center">{{ $attendance->id }}</td>
                                <td>{{ $attendance->attendance->teacher->name }}</td>
                                <td>{{ $attendance->attendance->subject->name }}</td>
                                <td class="text-center">{{ $attendance->attendance->kelas->name }}</td>
                                <td class="text-center">{{ date("d M Y", strtotime($attendance->attendance->date)) }}</td>
                                <td>{{ $attendance->attendance->topic }}</td>
                                <td>{{ $attendance->student->name }}</td>
                                {{-- <td>{{ $attendance->attstatus }}</td> --}}
                                <td>@if ($attendance->attstatus == 'tanpaKeterangan')
                                    Belum Presensi
                                @else
                                    {{$attendance->attstatus}}
                                @endif</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mb-10">
                <h2 class="text-2xl font-normal mb-4 text-zinc-800">Daftar Presensi</h2>
                <div class="overflow-scroll">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Guru</th>
                                <th>Mapel</th>
                                <th>Kelas</th>
                                <th>Tanggal</th>
                                <th>Topik</th>
                                <th>Nama Siswa</th>
                                <th>Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                            <tr>
                                <td class="text-center">{{ $attendance->id }}</td>
                                <td>{{ $attendance->attendance->teacher->name }}</td>
                                <td>{{ $attendance->attendance->subject->name }}</td>
                                <td class="text-center">{{ $attendance->attendance->kelas->name }}</td>
                                <td class="text-center">{{ date("d M Y", strtotime($attendance->attendance->date)) }}</td>
                                <td>{{ $attendance->attendance->topic }}</td>
                                <td>{{ $attendance->student->name }}</td>
                                {{-- <td>{{ $attendance->attstatus }}</td> --}}
                                <td>@if ($attendance->attstatus == 'tanpaKeterangan')
                                    Belum Presensi
                                @else
                                    {{$attendance->attstatus}}
                                @endif</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    @include('script')
@endsection