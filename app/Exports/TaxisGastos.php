<?php

namespace App\Exports;

use App;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class TaxisGastos implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return App\Expense::query()
        	->join('taxis', 'taxis.id', '=', 'expenses.vehicle')
        	->join('expense_categories', 'expense_categories.id', '=', 'expenses.category')
        	->join('expense_descriptions', 'expense_descriptions.id', '=', 'expenses.description')
        	->select('taxis.plate', DB::raw('YEAR(expenses.begin)'), 'expenses.week', 'expenses.pay_to', 'expense_categories.category', 'expense_descriptions.description', 'expenses.value');
    }

    public function __construct()
    {
    }

    public function headings(): array
    {
        return ["Carro", "Año", "Semana", "Pago a", "Gasto Categoria", "Gasto Descripcion", "Monto"];
    }
}
