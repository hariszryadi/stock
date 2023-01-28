<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ImportController extends Controller
{
    /**
     * Print Invoice
     * 
     * @param int $id
     */
    public function print_basic($id)
    {
        $query = DB::select("SELECT
                                a.id,
                                a.invoice,
                                a.date,
                                a.status,
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
                                
        $pdf = PDF::loadView('helper.pdf-invoice', ['data' => $query]);

        return $pdf->download($query[0]->invoice.'.pdf');
    }
    
    /**
     * Print Invoice
     * 
     * @param int $id
     */
    public function print_finished($id)
    {
        $query = DB::select("SELECT
                                a.id,
                                a.invoice,
                                a.date,
                                a.status,
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
                                
        $pdf = PDF::loadView('helper.pdf-invoice', ['data' => $query]);

        return $pdf->download($query[0]->invoice.'.pdf');
    }
}