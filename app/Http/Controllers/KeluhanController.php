<?php

namespace App\Http\Controllers;

use App\Keluhan;
use App\PekerjaKeluhan;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class KeluhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasRole('pelanggan')) {
            $keluhan = Keluhan::where('user_id', Auth::user()->id)->get();
        } else {
            $keluhan = Keluhan::all();
        }
        $keluhan = Keluhan::all();
        return view('keluhan.index', compact ('keluhan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::all();
        return view('keluhan.tambah', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'productkeluhan' => 'required',
            'keterangan' => 'required',
        ]);

        /* validate activated */
        $tambah = new Keluhan();

        $inis = Product::find($request['productkeluhan']);
        $arr = explode(' ', $inis->name);
        $str = substr($arr[0], -3);
        $ini = strtoupper($str);

        $tambah->invoice = $ini.$request['productkeluhan'].Auth::user()->id;
        $tambah->user_id = Auth::user()->id;
        $tambah->product_id = $request['productkeluhan'];
        $tambah->keterangan = $request['keterangan'];
        $tambah->save();
        $request->session()->flash('message', 'Data berhasil ditambahkan');

        return redirect()->to('/keluhan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $show = Keluhan::find($id);
        $product = Product::all();
        return view('keluhan.detail',compact('show', 'product'));
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
        $this->validate($request, [
            'keterangan' => 'required',
        ]);
        /* validate activated */
        $update =  Keluhan::find($id);

        $update->keterangan = $request['keterangan'];
        $update->update();

        return redirect()->to('/keluhan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Keluhan::where('id', $id)->first();
        $destroy->delete();
        \Session::flash('message', 'Data berhasil dihapus');

        return redirect()->to('/keluhan');
    }

    public function pdf($id)
    {
        $show = Keluhan::find($id);
        $product = Product::all();
        $pdf = PDF::loadView('keluhan.pdf', compact('show','product'));
        return $pdf->stream();
    }

    public function kerja($id)
    {
        $kerja = Keluhan::where('id', $id)->first();
        if($kerja->status == 1) {
            $tambah = new PekerjaKeluhan();
            $tambah->keluhan_id = $id;
            $tambah->pekerja_id = Auth::user()->id;
            $tambah->save();
            $kerja->status = 2;
        } else {
            $kerja->status = 3;
        }
        $kerja->update();
        \Session::flash('message', 'Data berhasil diubah');

        return redirect()->to('/keluhan');
    }

    public function dislike($id)
    {
        $kerja = Keluhan::where('id', $id)->first();
        $kerja->rate = 2;
        $kerja->update();
        \Session::flash('message', 'Data berhasil diubah');

        return redirect()->to('/keluhan');
    }

    public function like($id)
    {
        $kerja = Keluhan::where('id', $id)->first();
        $kerja->rate = 3;
        $kerja->update();
        \Session::flash('message', 'Data berhasil diubah');

        return redirect()->to('/keluhan');
    }
}
