<?php

namespace App\Http\Controllers;

use App\Apartado;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     *
     * @param  int  $id
     * @return View
     */
    public function __invoke()
    {
        $fecha = Carbon::now();
        $fecha->subMonths(2); // hoy hace dos meses
        $apartados = Apartado::where('saldo', '>', 0)
                            ->where('fecha', '<=', $fecha)
                            ->with('cliente:id,nombre')
                            ->get();
        return view('dashboard', compact('apartados'));
    }
}
