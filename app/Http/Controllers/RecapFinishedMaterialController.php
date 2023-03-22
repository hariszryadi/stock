<?php

namespace App\Http\Controllers;

use App\Models\FinishedMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class RecapFinishedMaterialController extends Controller
{
    /**
     * Title views
     */
    protected $title = 'Rekapitulasi Bahan Jadi';

    /**
     * Folder views
     */
    protected $_view = 'recap.finished_material.';
    
    /**
     * Route index
     */
    protected $_route = 'recap_finished_material.index';

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
        $bm = FinishedMaterial::orderBy('id')->get();
        return view($this->_view.'index', ['title' => $this->title, 'bm' => $bm]);
    }

    public function getRecap(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));

        $bm = FinishedMaterial::find($request->code);
        $query = DB::select("SELECT
                                e.date,
                                GROUP_CONCAT(e.status SEPARATOR ',') AS status,
                                GROUP_CONCAT(d.qty SEPARATOR ',') AS qty
                            FROM
                                finished_materials c
                                LEFT JOIN tr_finished_material_details d ON c.id = d.finished_material_id
                                LEFT JOIN tr_finished_materials e ON d.tr_finished_material_id = e.id 
                            WHERE
                                c.id = $request->code
                                AND e.date >= '$start_date' 
                                AND e.date <= '$end_date'
                            GROUP BY
                                e.date
                            ");
        $query_total = DB::select("SELECT
                                        SUM(d.qty) AS total
                                    FROM
                                        finished_materials c
                                        LEFT JOIN tr_finished_material_details d ON c.id = d.finished_material_id
                                        LEFT JOIN tr_finished_materials e ON d.tr_finished_material_id = e.id 
                                    WHERE
                                        c.id = $request->code
                                        AND e.date >= '$start_date' 
                                        AND e.date <= '$end_date'
                                    ");

        $pdf = PDF::loadView('helper.pdf-recap', ['title' => $this->title, 'data' => $query, 'total' => $query_total[0]->total, 'bm' => $bm, 'start_date' => $start_date, 'end_date' => $end_date]);

        return $pdf->download('rekap-bahan-jadi-' . $request->start_date . '-' . $request->end_date .'.pdf');
    }
}
