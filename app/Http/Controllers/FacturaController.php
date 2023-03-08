<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Fechas para consulta
        $start_date=now()->subDays(30);
        $end_date=now();

        $facturas=Factura::where('pagada',false)
        ->whereBetween('fecha_factura',[$start_date,$end_date])
        ->select(
            DB::raw("COUNT(id) AS numeroFacturas"),
            DB::raw("SUM(total_factura) AS importeTotal"),
            DB::raw("MAX(fecha_factura) AS fechaHasta"),
            DB::raw("MIN(Fecha_factura) AS fechaDesde"),
        )
        ->first();
        return $facturas;
    }
}
