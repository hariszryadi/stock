<?php

namespace App\Http\Controllers;

use App\Models\FinishedMaterial;
use App\Models\TrFinishedMaterial;
use App\Models\TrFinishedMaterialDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FinishedMaterialOutController extends Controller
{
    /**
     * Title views
     */
    protected $title = 'Bahan Jadi Keluar';

    /**
     * Folder views
     */
    protected $_view = 'transaction.out.finished_material.';
    
    /**
     * Route index
     */
    protected $_route = 'finished_material_out.index';

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
            return DataTables::of(TrFinishedMaterial::where('status', 0)->orderBy('created_at', 'DESC'))
                ->editColumn('date', function($data) {
                    return date('d-m-Y', strtotime($data->date));
                })
                ->editColumn('category', function($data) {
                    if ($data->category == '3') {
                        return 'Penjualan';
                    } else if ($data->category == '4') {
                        return 'Rusak';
                    } else {
                        return '-';
                    }
                })
                ->addColumn('action', function($data) {
                    return '<a href="javascript:void(0)" id="invoice" data-id="'.$data->id.'" class="btn btn-info btn-sm" title="Invoice" data-url="'.route('finished_material_out.show', $data->id).'"><i class="fa fa-file-invoice"></i></a>
                            <a href="'.route('finished_material_out.edit', $data->id).'" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" id="delete" data-id="'.$data->id.'" class="btn btn-danger btn-sm" title="Hapus" data-url="'.route('finished_material_out.destroy', $data->id).'"><i class="fa fa-trash"></i></a>';
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
        return view($this->_view.'create', ['title' => $this->title, 'fm' => $fm]);
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
            'code.0'    => 'required',
            'qty.0'  => 'required',
            'category' => 'required'
        ]);

        try {
            DB::beginTransaction(); 

            $tfm = TrFinishedMaterial::where('status', 0)->pluck('invoice')->last();
            $lastID = ltrim(substr($tfm, -3), '0');
            $saveTfm = TrFinishedMaterial::create([
                'invoice' => 'INV-F0-' . date('Ymd', strtotime($request->date)) . sprintf('%03d', $lastID == null ? 1 : $lastID+1),
                'date' => date('Y-m-d', strtotime($request->date)),
                'status' => 0,
                'category' => $request->category
            ]);
            if ($saveTfm) {
                $data = [];
                for ($i=0; $i < count($request->code); $i++) {
                    $data[] = [
                        'tr_finished_material_id' => $saveTfm->id,
                        'finished_material_id' => $request->code[$i],
                        'qty' => $request->qty[$i],
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ];
                }
                $saveTfmDetail = TrFinishedMaterialDetail::insert($data);
                if ($saveTfmDetail) {
                    for ($i=0; $i < count($request->code); $i++) { 
                        $fm = FinishedMaterial::find($request->code[$i]);
                        if ($fm->qty < $request->qty[$i]) {
                            return redirect()->back()->with('error', 'Jumlah stok kurang dari data inputan');
                        } else {
                            $fm->update(['qty' => $fm->qty - $request->qty[$i]]);
                        }
                        
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
                                tr_finished_materials a
                                LEFT JOIN tr_finished_material_details b ON a.id = b.tr_finished_material_id
                                LEFT JOIN finished_materials c ON b.finished_material_id = c.id 
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
        $fm = FinishedMaterial::orderBy('id')->get();
        $tfm = TrFinishedMaterial::with('detail')->find($id);
        return view($this->_view.'edit', ['title' => $this->title, 'fm' => $fm, 'tfm' => $tfm]);
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

            $tfm = TrFinishedMaterial::with('detail')->find($id);
            foreach ($tfm->detail as $key => $value) {
                // update stock in
                $fm = FinishedMaterial::find($value->finished_material_id);
                $fm->update(['qty' => $fm->qty + $value->qty]);
            }
            
            for ($i=0; $i < count($request->id_detail); $i++) {
                // update stock in detail
                $tfmDetail = TrFinishedMaterialDetail::find($request->id_detail[$i]);
                $tfmDetail->update(['qty' => $request->qty[$i]]);
                // update stock
                $fm = FinishedMaterial::find($request->code[$i]);
                if ($fm->qty < $request->qty[$i]) {
                    return redirect()->back()->with('error', 'Jumlah stok kurang dari data inputan');
                } else {
                    $fm->update(['qty' => $fm->qty - $request->qty[$i]]);
                }
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
        $tfm = TrFinishedMaterial::find($id);
        foreach ($tfm->detail as $key => $value) {
            $fm = FinishedMaterial::find($value->finished_material_id);
            $fm->update(['qty' => $fm->qty + $value->qty]);
        }
        $tfm->delete();

        return redirect()->route($this->_route)->with('success', 'Data berhasil dihapus');
    }
}
