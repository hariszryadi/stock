<?php

namespace App\Http\Controllers;

use App\Models\BasicMaterial;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BasicMaterialController extends Controller
{
    /**
     * Title views
     */
    protected $title = 'Bahan Dasar';

    /**
     * Folder views
     */
    protected $_view = 'master.basic_material.';
    
    /**
     * Route index
     */
    protected $_route = 'basic_material.index';

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
            return DataTables::of(BasicMaterial::orderBy('id')->get())
                ->addColumn('action', function($data){
                    return '<a href="'.route('basic_material.edit', $data->id).'" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" id="delete" data-id="'.$data->id.'" class="btn btn-danger btn-sm" title="Hapus" data-url="'.route('basic_material.destroy', $data->id).'"><i class="fa fa-trash"></i></a>';
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
        return view($this->_view.'form', ['title' => $this->title]);
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
            'code' => 'required|unique:basic_materials|numeric|digits:11',
            'name' => 'required|max:255'
        ]);

        BasicMaterial::create([
            'code' => $request->code,
            'name' => $request->name
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
        $data = BasicMaterial::find($id);
        return view($this->_view.'form', ['title' => $this->title, 'data' => $data]);
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
            'code' => 'required|unique:basic_materials,code,'.$id.'|numeric|digits:11',
            'name' => 'required|max:255'
        ]);

        $data = BasicMaterial::find($id);
        $data->update([
            'code' => $request->code,
            'name' => $request->name
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
        $data = BasicMaterial::find($id);
        $data->delete();

        return redirect()->route($this->_route)->with('success', 'Data berhasil dihapus');
    }
}
