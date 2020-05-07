<?php

namespace App\Exports;

use App;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class TaxiGastos implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        /*return App\Record::query()
        	->join('taxis', 'taxis.id', '=', 'records.vehicle')
        	->select('taxis.plate', DB::raw('YEAR(records.created_at)'), 'records.week', 'records.created_at', 'records.begin', 'records.end', 'records.produced', 'records.expenses', 'records.payment')->where('records.vehicle', '=', $this->id);
*/
        return App\Expense::query()
        	->join('taxis', 'taxis.id', '=', 'expenses.vehicle')
        	->join('expense_categories', 'expense_categories.id', '=', 'expenses.category')
        	->join('expense_descriptions', 'expense_descriptions.id', '=', 'expenses.description')
        	->select('taxis.plate', DB::raw('YEAR(expenses.begin)'), 'expenses.week', 'expenses.pay_to', 'expense_categories.category', 'expense_descriptions.description', 'expenses.value')->where('expenses.vehicle', '=', $this->id);
    }

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function headings(): array
    {
        return ["Carro", "Año", "Semana", "Pago a", "Gasto Categoria", "Gasto Descripcion", "Monto"];
    }
}
