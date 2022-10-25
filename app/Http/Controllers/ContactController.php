<?php

namespace App\Http\Controllers;

use App\Models\kontak;
use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\jenis_kontak;
use Illuminate\Support\Facades\Session;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

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
        $data_jkontak = jenis_kontak::paginate(5);
        return view('master.master_contact', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('TambahContact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function tambah($id)
    {
        $siswa = siswa::find($id);
        $j_kontak = jenis_kontak::all();
        return view('TambahContact', compact('siswa', 'j_kontak'));
    }

    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute harus diisi gaesss',
            'min' => ':attribute minimal :min karakter ya coy',
            'max' => ':attribute maksimal :max karakter gaess',
        ];

        //validasi form
        $this->validate($request, [
            'jenis_kontak' => 'required|min:5|max:30',
            'deskripsi' => 'required|min:5|max:50',
        ], $message);

        //insert data
        kontak::create([
            'id_siswa' => $request->id_siswa,
            'jenis_kontak' => $request->jenis_kontak,
            'deskripsi' => $request->deskripsi,
        ]);

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
        $j_kontak = jenis_kontak::all();
        return view('EditContact', compact('kontak', 'j_kontak'));
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
            'jenis_kontak' => 'required|min:5|max:30',
            'deskripsi' => 'required|min:5|max:50',
        ], $message);

        $kontak = kontak::find($id);
        $kontak->jenis_kontak = $request->jenis_kontak;
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
        //
    }

    public function hapus($id)
    {
        $kontak = kontak::find($id)->delete();
        Session::flash('success', 'Data Berhasil dihapus');
        return redirect('/master_contact');
    }
}
