<?php

namespace App\Http\Controllers;
use App\Models\buku;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->query('search');

        $query = buku::query();

        if ($search) {
            $query->where('judul', 'LIKE', "%$search%")
                ->orWhere('Genre', 'LIKE', "%$search%")
                ->orWhere('penulis', 'LIKE', "%$search%")
                ->orWhere('rating', 'LIKE', "%$search%")
                ->orWhere('tahun_terbit', 'LIKE', "%$search%");
        }

        $daftarbuku = $query->simplePaginate(1);

        $daftarbuku->appends(['search' => $search]); // Menyimpan parameter pencarian dalam URL pagination

        return view('book.index', [
            'daftarbuku' => $daftarbuku,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('book.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'judul'=>['required'],
            'Genre'=>['required'],
            'penulis'=>['required'],
            'rating'=>['required'],
            'tahun_terbit'=>['required'],
            'photo'=>['image'],
        ],[
            'judul.required'=>'Judul harus diisi',
            'Genre.required'=>'Genre harus diisi',
            'penulis.required'=>'Penulis harus diisi',
            'rating.required'=>'rating harus diisi',
            'tahun_terbit.required'=>'Tahun terbit harus diisi',
            'photo.image'=>'File harus berupa gambar',
        ]);

        $photo = null;

        if ($request->hasFile('photo')){
            $photo = $request->file('photo')->store('photos');
        }

        $buku = new buku();

        $buku->judul = $request->judul;
        $buku->Genre = $request->Genre;
        $buku->penulis = $request->penulis;
        $buku->rating = $request->rating;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->photo = $photo;
        

        $buku->save();

        return redirect()->route('daftarbuku.index');
    }

    public function edit($id)
    {
        $buku = buku::find($id);

        return view('book.edit',[
            'buku'=>$buku,
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'=>['required'],
            'Genre'=>['required'],
            'penulis'=>['required'],
            'rating'=>['required'],
            'tahun_terbit'=>['required'],
            'photo'=>['image'],
        ],[
            'judul.required'=>'Judul harus diisi',
            'Genre.required'=>'Genre harus diisi',
            'penulis.required'=>'Penulis harus diisi',
            'rating.required'=>'rating harus diisi',
            'tahun_terbit.required'=>'Tahun terbit harus diisi',
            'photo.image'=>'File harus berupa gambar',
        ]);

        $buku = buku::find($id);

        $buku->judul = $request->judul;
        $buku->Genre = $request->Genre;
        $buku->penulis = $request->penulis;
        $buku->rating = $request->rating;
        $buku->tahun_terbit = $request->tahun_terbit;

        if ($buku->photo && file_exists(storage_path('app/public/' . $buku->photo))){
            Storage::delete('public/'.$buku->photo);
        }

        $photo = $request->file('photo')->store('photos');

        $buku->photo = $photo;

        $buku->save();

        return redirect()->route('daftarbuku.index');
    }

    public function destroy($id)
    {
        $buku = buku::find($id);

        $buku->delete();

        return redirect()->route('daftarbuku.index');
    }

    public function dashboard(Request $request)
{
    $search = $request->query('search');

    $query = buku::query();

    if ($search) {
        $query->where('judul', 'LIKE', "%$search%")
            ->orWhere('Genre', 'LIKE', "%$search%")
            ->orWhere('penulis', 'LIKE', "%$search%")
            ->orWhere('rating', 'LIKE', "%$search%")
            ->orWhere('tahun_terbit', 'LIKE', "%$search%");
    }

    $daftarbuku = $query->simplePaginate(1);

    return view('dashboard', [
        'daftarbuku' => $daftarbuku,
        'search' => $search
    ]);
}


}
