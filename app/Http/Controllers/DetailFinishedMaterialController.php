<?php

namespace App\Http\Controllers;

use App\Models\DetailFinishedMaterial;
use App\Models\FinishedMaterial;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DetailFinishedMaterialController extends Controller
{
     /**
     * Title views
     */
    protected $title = 'Detail Bahan Jadi';

    /**
     * Folder views
     */
    protected $_view = 'data.finished_material.';
    
    /**
     * Route index
     */
    protected $_route = 'detail_finished_material.index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(DetailFinishedMaterial::with('finished_material')->orderBy('id')->get())
                ->editColumn('price', function($data) {
                    return "Rp " . number_format($data->price,0,',',',');
                })
                ->addColumn('total', function($data) {
                    $total = $data->quantity*$data->price;
                    return "Rp " . number_format($total,0,',',',');
                })
                ->addColumn('action', function($data){
                    return '<a href="'.route('detail_finished_material.edit', $data->id).'" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" id="delete" data-id="'.$data->id.'" class="btn btn-danger btn-sm" title="Hapus" data-url="'.route('detail_finished_material.destroy', $data->id).'"><i class="fa fa-trash"></i></a>';
                })
                ->make(true);
        }
        return view($this->_view.'index', ['title' => $this->title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fm = FinishedMaterial::orderBy('id')->get();
        return view($this->_view.'form', ['title' => $this->title, 'fm' => $fm]);
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
            'finished_material' => 'required|unique:detail_finished_materials,finished_material_id',
            'quantity' => 'required',
            'price' => 'required'
        ]);

        DetailFinishedMaterial::create([
            'finished_material_id' => $request->finished_material,
            'quantity' => $request->quantity,
            'price' => floatval(preg_replace('/[^\d.]/', '', $request->price))
        ]);

        return redirect()->route($this->_route)->with('success', 'Data berhasil ditambahkan');
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
        $data = DetailFinishedMaterial::find($id);
        $fm = FinishedMaterial::orderBy('id')->get();
        return view($this->_view.'form', ['title' => $this->title, 'data' => $data, 'fm' => $fm]);
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
            'finished_material' => 'required|unique:detail_finished_materials,finished_material_id,'.$id,
            'quantity' => 'required',
            'price' => 'required'
        ]);
        
        $data = DetailFinishedMaterial::find($id);
        $data->update([
            'finished_material_id' => $request->finished_material,
            'quantity' => $request->quantity,
            'price' => floatval(preg_replace('/[^\d.]/', '', $request->price))
        ]);

        return redirect()->route($this->_route)->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DetailFinishedMaterial::find($id);
        $data->delete();

        return redirect()->route($this->_route)->with('success', 'Data berhasil dihapus');
    }
}
