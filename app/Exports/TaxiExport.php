<?php

namespace App\Exports;

use App;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class TaxiExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        /*return DB::table('taxis')
            ->join('taxi_brands', 'taxis.brand', '=', 'taxi_brands.id')
            ->select('taxis.id as id', 'taxis.plate', 'taxi_brands.brand as marca', 'taxis.makes', 'taxis.serie', 'taxis.state', 'taxis.created_at')->where('taxis.id', '=', $this->id)->get();
        return App\Taxi::query()->join('taxi_brands', 'taxis.brand', '=', 'taxi_brands.id')
            ->select('taxis.id as id', 'taxis.plate', 'taxi_brands.brand as marca', 'taxis.makes', 'taxis.serie', 'taxis.state', 'taxis.created_at')->where('taxis.id', '=', $this->id)->where('taxis.id', '=', $this->id);*/
        return App\Record::query()
        	->join('taxis', 'taxis.id', '=', 'records.vehicle')
        	->select(DB::raw('YEAR(records.begin)'), 'records.week', 'records.created_at', 'records.begin', 'records.end', 'taxis.plate', 'records.produced', 'records.expenses', 'records.payment')->where('records.vehicle', '=', $this->id);
    }

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function headings(): array
    {
        return ["Año", "Semana", "Fecha", "Producido desde", "Producido hasta", "Carro", "Producido", "Gastos", "Entrada"];
    }
}
