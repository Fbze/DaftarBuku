@extends('template.default')

@php
$title = 'Dashboard';
$preTitle = 'You are logged in!'
@endphp

@section('content')
<form action="{{ route('dashboard') }}" method="get" autocomplete="off" novalidate="">
    <div class="input-icon">
        <span class="input-icon-addon">
            <!-- Download SVG icon from http://tabler-icons.io/i/search -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                <path d="M21 21l-6 -6"></path>
            </svg>
        </span>
        <input type="search" name="search" value="{{ $search }}" class="form-control" placeholder="Search…" aria-label="Search in website">
    </div>
</form>

<div class="card mt-3">
    <div class="table-responsive">
        <table class="table table-vcenter card-table table-striped">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Judul</th>
                    <th>Genre</th>
                    <th>Penulis</th>
                    <th>rating</th>
                    <th>Tahun Terbit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($daftarbuku as $buku)
                <tr>
                    <td>
                        <img src="{{asset('storage/' . $buku->photo)}}" height="150px" alt="">
                    </td>
                    <td>{{$buku->judul}}</td>
                    <td>{{$buku->Genre}}</td>
                    <td>{{$buku->penulis}}</td>
                    <td>{{$buku->rating}}</td>
                    <td>{{$buku->tahun_terbit}}</td>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{ $daftarbuku->appends(['search' => $search])->links() }}

@endsection