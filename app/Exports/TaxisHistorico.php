<?php

namespace App\Exports;

use App;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class TaxisHistorico implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return App\Record::query()
        	->join('taxis', 'taxis.id', '=', 'records.vehicle')
        	->select(DB::raw('YEAR(records.begin)'), 'records.week', 'records.created_at', 'records.begin', 'records.end', 'taxis.plate', 'records.produced', 'records.expenses', 'records.payment');
    }

    public function __construct()
    {

    }

    public function headings(): array
    {
        return ["Año", "Semana", "Fecha", "Producido desde", "Producido hasta", "Carro", "Producido", "Gastos", "Entrada"];
    }
}
