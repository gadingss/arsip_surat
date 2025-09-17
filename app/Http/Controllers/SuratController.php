<?php
namespace App\Http\Controllers;
use App\Models\Surat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $suratQuery = Surat::with('kategori')->orderBy('tanggal','desc');

        if($q){
            $suratQuery->where('judul', 'like', "%{$q}%");
        }

        $surats = $suratQuery->paginate(10)->withQueryString();
        return view('surat.index', compact('surats','q'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('surat.form', ['kategori'=>$kategori, 'surat'=>null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'nullable|string|max:100',
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            // 'tanggal' => 'required|date',
            'file' => 'required|mimes:pdf|max:5120'
        ]);

        $file = $request->file('file');
        $filename = time().'_'.$file->getClientOriginalName();
        // $path = $file->storeAs('public/uploads/surat', $filename);
        $file->move(public_path('uploads/surat'), $filename);
        // dd([
        //     'is_valid' => $file->isValid(),
        //     'original_name' => $file->getClientOriginalName(),
        //     'stored_path' => $path,
        //     'full_path' => storage_path('app/'.$path),
        // ]);

        Surat::create([
            'nomor_surat' => $request->nomor_surat,
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            // 'tanggal' => $request->tanggal,
            'file_path' => $filename,
        ]);

        return redirect()->route('surat.index')->with('success','Data berhasil disimpan');
    }

    public function show($id)
    {
        $surat = Surat::with('kategori')->findOrFail($id);
        return view('surat.show', compact('surat'));
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        $kategori = Kategori::all();
        return view('surat.form', compact('surat','kategori'));
    }

    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        $request->validate([
            'nomor_surat' => 'nullable|string|max:100',
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            // 'tanggal' => 'required|date',
            'file' => 'nullable|mimes:pdf|max:5120'
        ]);

        if($request->hasFile('file')){
            // hapus file lama
            $old = storage_path('app/public/uploads/surat/'.$surat->file_path);
            if(File::exists($old)) File::delete($old);

            $file = $request->file('file');
            $filename = time().'_'.$file->getClientOriginalName();
            // $file->storeAs('public/uploads/surat', $filename);
            $file->move(public_path('uploads/surat'), $filename);
            $surat->file_path = $filename;
        }

        $surat->update([
            'nomor_surat' => $request->nomor_surat,
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            // 'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('surat.index')->with('success','Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $file = public_path('uploads/surat/'.$surat->file_path);
        if(File::exists($file)) File::delete($file);
        $surat->delete();
        return redirect()->route('surat.index')->with('success','Data berhasil dihapus');
    }

    public function download($id)
    {
        $surat = Surat::findOrFail($id);
        $file = public_path('uploads/surat/'.$surat->file_path);
        if(!File::exists($file)){
            abort(404);
        }
        return response()->download($file, $surat->file_path);
    }
}
