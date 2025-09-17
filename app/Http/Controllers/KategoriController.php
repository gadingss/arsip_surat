<?php
namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::orderBy('id')->paginate(10);
        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        $nextId = Kategori::max('id') + 1; // cari id terakhir + 1
        return view('kategori.form', [
            'kategori' => null,
            'nextId'   => $nextId
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['nama_kategori'=>'required|string|max:100']);
        Kategori::create([
            'nama_kategori'=>$request->nama_kategori,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('kategori.index')->with('success','Data berhasil disimpan');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.form', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nama_kategori'=>'required|string|max:100']);
        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori'=>$request->nama_kategori,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('kategori.index')->with('success','Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success','Data berhasil dihapus');
    }
}
