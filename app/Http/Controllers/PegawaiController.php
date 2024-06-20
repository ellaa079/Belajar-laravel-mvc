<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai; // Pastikan namespace untuk model sudah benar
use App\Models\Jabatan;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $dtPegawai = Pegawai::with('jabatan')
                ->where('nama', 'LIKE', "%{$search}%")
                ->orWhere('alamat', 'LIKE', "%{$search}%")
                ->paginate(10);
        } else {
            $dtPegawai = Pegawai::with('jabatan')->paginate(15);
        }
    
        $currentPage = $dtPegawai->currentPage();
        $perPage = $dtPegawai->perPage();
        $startNumber = ($currentPage - 1) * $perPage;
    
        return view('pegawai.Data-pegawai', compact('dtPegawai', 'startNumber'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jab = Jabatan::all();
        return view('pegawai.Create-pegawai', compact('jab'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'alamat' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'jabatan_id' => 'required',
            'tgllhr' => 'required|date',
        ], [
            'nama.required' => 'Kolom Nama Pegawai wajib diisi.',
            'nama.regex' => 'Kolom Nama Pegawai hanya boleh mengandung huruf dan spasi.',
            'alamat.required' => 'Kolom Alamat Pegawai wajib diisi.',
            'alamat.regex' => 'Kolom Alamat Pegawai hanya boleh mengandung huruf, angka, dan spasi.',
            'tgllhr.required' => 'Kolom Tanggal Lahir wajib diisi.',
            'tgllhr.date' => 'Kolom Tanggal Lahir harus berisi tanggal yang valid.'
        ]);

        Pegawai::create($validatedData);

        return redirect()->route('data-pegawai')->with('toast_success', 'Data Berhasil Tersimpan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $peg = Pegawai::findOrFail($id);  
        return view('pegawai.Edit-pegawai', compact('peg'));
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
        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'alamat' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'jabatan_id' => 'required',
            'tgllhr' => 'required|date',
        ], [
            'nama.required' => 'Kolom Nama Pegawai wajib diisi.',
            'nama.regex' => 'Kolom Nama Pegawai hanya boleh mengandung huruf dan spasi.',
            'jabatan_id.required' => 'Kolom jabatan wajib diisi.',
            'jabatan_id.regex' => 'Kolom jabatan hanya boleh mengandung huruf dan spasi.',
            'alamat.required' => 'Kolom Alamat Pegawai wajib diisi.',
            'alamat.regex' => 'Kolom Alamat Pegawai hanya boleh mengandung huruf, angka, dan spasi.',
            'tgllhr.required' => 'Kolom Tanggal Lahir wajib diisi.',
            'tgllhr.date' => 'Kolom Tanggal Lahir harus berisi tanggal yang valid.'
        ]);

        $peg = Pegawai::findOrFail($id);
        $peg->update($validatedData);

        return redirect()->route('data-pegawai')->with('toast_success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $peg = Pegawai::findOrFail($id);
        $peg->delete();
        return back()->with('info', 'Data Berhasil Dihapus');
    }
}
