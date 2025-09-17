<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        // Ganti data di bawah dengan nama, NIM, foto, dan tanggal pembuatan nyata
        $data = [
            'nama' => 'Nama Kamu',
            'nim' => 'NIM Kamu',
            'foto' => 'about/photo.jpg', // letakkan di public/about/photo.jpg atau storage
            'tanggal' => date('Y-m-d')
        ];
        return view('about', compact('data'));
    }
}
