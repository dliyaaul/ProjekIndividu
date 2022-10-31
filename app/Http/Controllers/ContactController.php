<?php

namespace App\Http\Controllers;

use App\Models\kontak;
use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\jenis_kontak;
use File;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = siswa::paginate(5);
        $kontak = jenis_kontak::paginate(5);
        return view('master.master_contact', compact('data', 'kontak'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $siswa = siswa::find($id);
        $jenis = jenis_kontak::all();
        return view('TambahContact', compact('siswa', 'jenis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, $id)
    {
        $message = [
            'required' => ':attribute harus diisi gaesss',
            'min' => ':attribute minimal :min karakter ya coy',
            'max' => ':attribute maksimal :max karakter gaess',
        ];

        //validasi form
        $this->validate($request, [
            'jenis_kontak_id' => 'required|max:30',
            'deskripsi' => 'required|min:5|max:50',
        ], $message);

        //insert data
        $kontak = new kontak();
        $kontak->siswa_id = $request->siswa_id;
        $kontak->jenis_kontak_id = $request->jenis_kontak_id;
        $kontak->deskripsi = $request->deskripsi;
        $kontak->save();
        Session::flash('success', 'Data Berhasil Di Tambahkan');
        return redirect('/master_contact');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kontak = siswa::find($id)->kontak()->get();
        return view('ShowContact', compact('kontak'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kontak = kontak::find($id);
        $jenis = jenis_kontak::all();
        return view('EditContact', compact('kontak', 'jenis'));
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
        ];

        $this->validate($request, [
            'jenis_kontak_id' => 'required|max:30',
            'deskripsi' => 'required|min:5|max:50',
        ], $message);

        $kontak = kontak::find($id);
        $kontak->siswa_id = $request->siswa_id;
        $kontak->jenis_kontak_id = $request->jenis_kontak_id;
        $kontak->deskripsi = $request->deskripsi;
        $kontak->save();
        Session::flash('success', "Contact berhasil diupdate");
        return redirect('master_contact');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        kontak::find($id)->delete();
        Session::flash('Success', 'Data Berhasil Di Hapus');
        return redirect('/master_contact');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function hapus($id)
    {
        jenis_kontak::find($id)->delete();
        Session::flash('success', 'Data Berhasil Di Hapus');
        return redirect('/master_contact');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tambahjenis(Request $request)
    {
        $message = [
            'required' => 'Form Harus Di Isi',
        ];

        $this->validate($request, [
            'jenis_kontak' => 'required',
        ], $message);

        jenis_kontak::create([
            'jenis_kontak' => $request->jenis_kontak,
        ]);

        Session::flash('message', "Jenis Kontak Baru Telah Di Tambahkan");
        return redirect('/master_contact');
    }

    public function tambahjenisview()
    {
        return view('TambahJenis');
    }
}
