<?php

namespace App\Exports;

use App;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class TaxisSocios implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return App\Expense::query()
        	->join('taxis', 'taxis.id', '=', 'expenses.vehicle')
        	->join('expense_categories', 'expense_categories.id', '=', 'expenses.category')
        	->join('expense_descriptions', 'expense_descriptions.id', '=', 'expenses.description')
        	->crossJoin('percentages')
        	->select('taxis.plate', DB::raw('YEAR(expenses.begin)'), 'expenses.week', 'expenses.pay_to', 'expense_categories.category', 'expense_descriptions.description', 'expenses.value', DB::raw('(expenses.value*percentages.percentage)/100'))->where([['percentages.user_id', '=', $this->id], ['percentages.state', '=', 1]]);
    }

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function headings(): array
    {
    	$nombre = App\User::select('users.name as name', 'percentages.percentage as percentage')->where('users.id', '=', $this->id)->join('percentages', 'percentages.user_id', '=', 'users.id')->first();
        return ["Carro", "Año", "Semana", "Pago a", "Gasto Categoria", "Gasto Descripcion", "Monto", "Socio ".$nombre->name . " (" . $nombre->percentage . "%)"];
    }
}
