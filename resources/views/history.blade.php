@extends('master')

@section('body')
<div class="lg:flex">
    @include('sidebar')

    {{-- <h1>Main</h1> --}}
    <div class="lg:w-5/6 lg:h-screen lg:overflow-y-scroll">
        @include('stickybar')

        <div class="px-3 pt-20 pb-10 lg:px-6 lg:pt-10" id="main">
            <div class="mb-10">
                <h2 class="text-2xl font-normal mb-4 text-zinc-900">Daftar Presensi Sebelumnya</h2>
                <div class="overflow-scroll lg:overflow-auto">
                    @if($attendances->count())
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Guru</th>
                                <th>Mapel</th>
                                <th>Kelas</th>
                                <th>Tanggal</th>
                                <th>Topik</th>
                                {{-- <th>Nama Siswa</th> --}}
                                <th>Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                            <tr>
                                <td class="text-center">{{ $attendance->id }}</td>
                                {{-- <td class="text-center">{{ $no++ - $atttodays->count() }}</td> --}}
                                <td>{{ $attendance->attendance->teacher->name }}</td>
                                <td>{{ $attendance->attendance->subject->name }}</td>
                                <td class="text-center">{{ $attendance->attendance->kelas->name }}</td>
                                <td class="text-center">{{ date("d M Y", strtotime($attendance->attendance->date)) }}</td>
                                <td>{{ $attendance->attendance->topic }}</td>
                                {{-- <td>{{ $attendance->student->name }}</td> --}}
                                {{-- <td>{{ $attendance->attstatus }}</td> --}}
                                <td>
                                    @if ($attendance->attstatus == 'tanpaKeterangan')
                                    Belum Presensi
                                    @else
                                    {{$attendance->attstatus}}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        @include('pengalihan')
                    @endif
                </div>
                <div class="mt-3">
                    {{ $attendances->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

    @include('script')
@endsection