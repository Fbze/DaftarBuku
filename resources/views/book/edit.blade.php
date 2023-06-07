@extends('template.default')

@php
$title = 'Edit Data Buku';
$preTitle = 'Edit Data'
@endphp

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('daftarbuku.update', $buku->id)}}" class="" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name='judul' class="form-control  @error('judul')
                is-invalid 
                @enderror" name="example-text-input" placeholder="Masukkan Judul Buku" value="{{ old('judul') ?? $buku->judul}}">
                @error('judul')
                <span class="invalid-feedback">
                    {{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Genre</label>
                <input type="text" name='Genre' class="form-control 
                @error('Genre')
                is-invalid 
                @enderror " name="example-text-input" placeholder="Masukkan Genre Buku" value="{{ old('Genre') ?? $buku->Genre}}">
                @error('Genre')
                <span class="invalid-feedback">
                    {{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Penulis</label>
                <input type="text" name='penulis' class="form-control  @error('penulis')
                is-invalid 
                @enderror" name="example-text-input" placeholder="Masukkan Nama Penulis Buku" value="{{ old('penulis') ?? $buku->penulis}}">
                @error('penulis')
                <span class="invalid-feedback">
                    {{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">rating</label>
                <input type="text" name='rating' class="form-control  @error('rating')
                is-invalid 
                @enderror" name="example-text-input" placeholder="Masukkan rating Buku" value="{{ old('rating') ?? $buku->rating}}">
                @error('rating')
                <span class="invalid-feedback">
                    {{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Tahun Terbit</label>
                <input type="text" name='tahun_terbit' class="form-control  @error('tahun_terbit')
                is-invalid 
                @enderror" name="example-text-input" placeholder="Masukkan Tahun Terbit Buku" value="{{ old('tahun_terbit') ?? $buku->tahun_terbit}}">
                @error('tahun_terbit')
                <span class="invalid-feedback">
                    {{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Photo</label>
                <input type="file" name='photo' class="form-control 
                @error('photo')
                is-invalid 
                @enderror" placeholder="Masukkan photo Buku" value="{{old('photo')}}">
                @error('photo')
                <span class="invalid-feedback">
                    {{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <input type="submit" value="Simpan" class="btn btn-primary">
            </div>

        </form>
    </div>
</div>
@endsection