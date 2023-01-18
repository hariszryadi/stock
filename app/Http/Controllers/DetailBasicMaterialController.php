<?php

namespace App\Http\Controllers;

use App\Models\BasicMaterial;
use App\Models\DetailBasicMaterial;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DetailBasicMaterialController extends Controller
{
    /**
     * Title views
     */
    protected $title = 'Detail Bahan Dasar';

    /**
     * Folder views
     */
    protected $_view = 'data.basic_material.';
    
    /**
     * Route index
     */
    protected $_route = 'detail_basic_material.index';

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
            return DataTables::of(DetailBasicMaterial::with('basic_material')->orderBy('id')->get())
                ->editColumn('price', function($data) {
                    return "Rp " . number_format($data->price,0,',',',');
                })
                ->addColumn('total', function($data) {
                    $total = $data->quantity*$data->price;
                    return "Rp " . number_format($total,0,',',',');
                })
                ->addColumn('action', function($data){
                    return '<a href="'.route('detail_basic_material.edit', $data->id).'" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" id="delete" data-id="'.$data->id.'" class="btn btn-danger btn-sm" title="Hapus" data-url="'.route('detail_basic_material.destroy', $data->id).'"><i class="fa fa-trash"></i></a>';
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
        $bm = BasicMaterial::orderBy('id')->get();
        return view($this->_view.'form', ['title' => $this->title, 'bm' => $bm]);
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
            'basic_material' => 'required|unique:detail_basic_materials,basic_material_id',
            'quantity' => 'required',
            'price' => 'required'
        ]);

        DetailBasicMaterial::create([
            'basic_material_id' => $request->basic_material,
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
        $data = DetailBasicMaterial::find($id);
        $bm = BasicMaterial::orderBy('id')->get();
        return view($this->_view.'form', ['title' => $this->title, 'data' => $data, 'bm' => $bm]);
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
            'basic_material' => 'required|unique:detail_basic_materials,basic_material_id,'.$id,
            'quantity' => 'required',
            'price' => 'required'
        ]);
        
        $data = DetailBasicMaterial::find($id);
        $data->update([
            'basic_material_id' => $request->basic_material,
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
        $data = DetailBasicMaterial::find($id);
        $data->delete();

        return redirect()->route($this->_route)->with('success', 'Data berhasil dihapus');
    }
}
