<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasok;

class pemasokController extends Controller
{
    public function index()
    {
        return view('pemasok.index');
    }

    public function data()
    {
        $pemasok = Pemasok::orderBy('id_pemasok', 'desc')->get();

        return datatables()
            ->of($pemasok)
            ->addIndexColumn()
            ->addColumn('action', function ($pemasok) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('pemasok.update', $pemasok->id_pemasok) .'`)"
                        class="btn btn-xs btn-info btn-flat">Edit</button>
                    <button onclick="deleteData(`'. route('pemasok.destroy', $pemasok->id_pemasok) .'`)"
                        class="btn btn-xs btn-danger btn-flat">Delete</i></button>
                </div>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pemasok = Pemasok::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pemasok = Pemasok::find($id);

        return response()->json($pemasok);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $pemasok = Pemasok::find($id)->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pemasok = Pemasok::find($id)->delete();

        return response(null, 204);
    }
}