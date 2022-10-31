<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\siswa;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // public function_construct()
    // {
    //     $his->middleware(['auth', 'admin']);
    //     $his->middleware(['auth', 'walas'])->only['index'];
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = siswa::all();
        return view('master.master_siswa', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('TambahSiswa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute harus diisi gaesss',
            'min' => ':attribute minimal :min karakter ya coy',
            'max' => ':attribute maksimal :max karakter gaess',
            'numeric' => 'attribute harus diisi angka cak!!',
            'mimes' => 'file :attribute harus bertipe :jpg,png,jpeg'
        ];

        //validasi form
        $this->validate($request, [
            'nama' => 'required|min:7|max:30',
            'nisn' => 'required|numeric',
            'alamat' => 'required',
            'jk' => 'required',
            'foto' => 'required|mimes:jpg,png,jpeg',
            'about' => 'required|min:10'
        ], $message);

        //ambil parameter
        $file = $request->file('foto');
        //rename
        $nama_file = time() . "_" . $file->getClientOriginalName();
        //proses upload
        $tujuan_upload = './template/img';
        $file->move($tujuan_upload, $nama_file);

        //insert data
        siswa::create([
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'alamat' => $request->alamat,
            'jk' => $request->jk,
            'foto' => $nama_file,
            'about' => $request->about
        ]);

        Session::flash('success', 'Data Berhasil Di Tambahkan');
        return redirect('/master_siswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa =  siswa::find($id);
        $kontak = $siswa->kontak()->get();
        $project = $siswa->project()->get();
        return view('ShowSiswa', compact('siswa', 'kontak', 'project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = siswa::find($id);
        return view('EditSiswa', compact('siswa'));
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
        $message = [
            'required' => ':attribute "minimal diisi"',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maksimal :max karakter',
            'numeric' => ':attribute minimal diisi angka',
            'mimes' => 'file :attribute harus bertipe jpg, png, jpeg'
        ];

        $this->validate($request, [
            'nama' => 'required|min:3|max:30',
            'nisn' => 'required|numeric',
            'alamat' => 'required',
            'jk' => 'required',
            'foto' => 'mimes:jpg,png,jpeg',
            'about' => 'required|min:5'
        ], $message);

        if ($request->foto != '') {

            //menghapus file foto lama
            $siswa = siswa::find($id);
            file::delete('./template/img/' . $siswa->foto);

            //ambil parameter
            $file = $request->file('foto');

            //rename
            $nama_file = time() . "_" . $file->getClientOriginalName();

            //proses upload
            $tujuan_upload = './template/img';
            $file->move($tujuan_upload, $nama_file);

            //menyimpan ke database
            $siswa->nama = $request->nama;
            $siswa->nisn = $request->nisn;
            $siswa->alamat = $request->alamat;
            $siswa->jk = $request->jk;
            $siswa->foto = $nama_file;
            $siswa->about = $request->about;
            $siswa->save();
            return redirect('master_siswa');
        } else {
            $siswa = siswa::find($id);
            $siswa->nama = $request->nama;
            $siswa->nisn = $request->nisn;
            $siswa->alamat = $request->alamat;
            $siswa->jk = $request->jk;
            $siswa->about = $request->about;
            $siswa->save();
            return redirect('/master_siswa');
        }
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

    public function hapus($id)
    {
        $siswa = siswa::find($id);
        $siswa->delete();
        Session::flash('success', 'Data Berhasil dihapus');
        return redirect('/master_siswa');
    }
}
