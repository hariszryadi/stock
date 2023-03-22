<?php

namespace App\Http\Controllers;

use App\Models\BasicMaterial;
use App\Models\TrBasicMaterial;
use App\Models\TrBasicMaterialDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BasicMaterialInController extends Controller
{
    /**
     * Title views
     */
    protected $title = 'Bahan Dasar Masuk';

    /**
     * Folder views
     */
    protected $_view = 'transaction.in.basic_material.';
    
    /**
     * Route index
     */
    protected $_route = 'basic_material_in.index';

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
            return DataTables::of(TrBasicMaterial::where('status', 1)->orderBy('created_at', 'DESC'))
                ->editColumn('date', function($data) {
                    return date('d-m-Y', strtotime($data->date));
                })
                ->editColumn('category', function($data) {
                    if ($data->category == '1') {
                        return 'Hasil Potong';
                    } else if ($data->category == '2') {
                        return 'Pembelian';
                    } else if ($data->category == '3') {
                        return 'Retur';
                    } else {
                        return '-';
                    }
                })
                ->addColumn('action', function($data) {
                    return '<a href="javascript:void(0)" id="invoice" data-id="'.$data->id.'" class="btn btn-info btn-sm" title="Invoice" data-url="'.route('basic_material_in.show', $data->id).'"><i class="fa fa-file-invoice"></i></a>
                            <a href="'.route('basic_material_in.edit', $data->id).'" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" id="delete" data-id="'.$data->id.'" class="btn btn-danger btn-sm" title="Hapus" data-url="'.route('basic_material_in.destroy', $data->id).'"><i class="fa fa-trash"></i></a>';
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
        return view($this->_view.'create', ['title' => $this->title, 'bm' => $bm]);
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
            'date' => 'required',
            'code.0' => 'required',
            'qty.0' => 'required',
            'category' => 'required'
        ]);

        try {
            DB::beginTransaction(); 

            $tbm = TrBasicMaterial::where('status', 1)->pluck('invoice')->last();
            $lastID = ltrim(substr($tbm, -3), '0');
            $saveTbm = TrBasicMaterial::create([
                'invoice' => 'INV-B1-' . date('Ymd', strtotime($request->date)) . sprintf('%03d', $lastID == null ? 1 : $lastID+1),
                'date' => date('Y-m-d', strtotime($request->date)),
                'status' => 1,
                'category' => $request->category
            ]);
            if ($saveTbm) {
                $data = [];
                for ($i=0; $i < count($request->code); $i++) {
                    $data[] = [
                        'tr_basic_material_id' => $saveTbm->id,
                        'basic_material_id' => $request->code[$i],
                        'qty' => $request->qty[$i],
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ];
                }
                $saveTbmDetail = TrBasicMaterialDetail::insert($data);
                if ($saveTbmDetail) {
                    for ($i=0; $i < count($request->code); $i++) { 
                        $bm = BasicMaterial::find($request->code[$i]);
                        $bm->update(['qty' => $bm->qty + $request->qty[$i]]);
                    }
                }
            }

            DB::commit();
            
            return redirect()->route($this->_route)->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route($this->_route)->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = DB::select("SELECT
                                a.id,
                                a.invoice,
                                a.date,
                                c.CODE,
                                c.NAME,
                                b.qty 
                            FROM
                                tr_basic_materials a
                                LEFT JOIN tr_basic_material_details b ON a.id = b.tr_basic_material_id
                                LEFT JOIN basic_materials c ON b.basic_material_id = c.id 
                            WHERE
                                a.id = $id
                            ORDER BY
                                a.created_at");
        return response()->json(['data' => $query]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bm = BasicMaterial::orderBy('id')->get();
        $tbm = TrBasicMaterial::with('detail')->find($id);
        return view($this->_view.'edit', ['title' => $this->title, 'bm' => $bm, 'tbm' => $tbm]);
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
        try {
            DB::beginTransaction(); 

            $tbm = TrBasicMaterial::with('detail')->find($id);
            foreach ($tbm->detail as $key => $value) {
                // update stock in
                $bm = BasicMaterial::find($value->basic_material_id);
                $bm->update(['qty' => $bm->qty - $value->qty]);
            }
            
            for ($i=0; $i < count($request->id_detail); $i++) {
                // update stock in detail
                $tbmDetail = TrBasicMaterialDetail::find($request->id_detail[$i]);
                $tbmDetail->update(['qty' => $request->qty[$i]]);
                // update stock
                $bm = BasicMaterial::find($request->code[$i]);
                $bm->update(['qty' => $bm->qty + $request->qty[$i]]);
            }

            DB::commit();

            return redirect()->route($this->_route)->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route($this->_route)->with('error', $e->getMessage());
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
        $tbm = TrBasicMaterial::find($id);
        foreach ($tbm->detail as $key => $value) {
            $bm = BasicMaterial::find($value->basic_material_id);
            $bm->update(['qty' => $bm->qty - $value->qty]);
        }
        $tbm->delete();

        return redirect()->route($this->_route)->with('success', 'Data berhasil dihapus');
    }
}
