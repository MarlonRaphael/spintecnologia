<?php

namespace App\DataTables;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomersDataTable extends DataTable
{
  /**
   * Build DataTable class.
   *
   * @param mixed $query Results from query() method.
   * @return DataTableAbstract
   */
  public function dataTable($query)
  {
    return datatables()
      ->eloquent($query)
      ->editColumn('created_at', function ($customer) {
        return formatDate($customer->created_at);
      })
      ->editColumn('updated_at', function ($customer) {
        return formatDate($customer->updated_at);
      })
      ->addColumn('action', function ($customer) {
        return view('partials.actions', ['model' => $customer]);
      });
  }

  /**
   * Get query source of dataTable.
   *
   * @param Customer $model
   * @return Builder
   */
  public function query(Customer $model)
  {
    return $model->newQuery();
  }

  /**
   * Optional method if you want to use html builder.
   *
   * @return \Yajra\DataTables\Html\Builder
   */
  public function html()
  {
    return $this->builder()
      ->setTableId('customers-table')
      ->columns($this->getColumns())
      ->minifiedAjax()
      ->dom('Bfrtip')
      ->orderBy(1)
      ->buttons(
        Button::make('create'),
        Button::make('export'),
        Button::make('print'),
        Button::make('reset'),
        Button::make('reload')
      );
//      ->parameters([
//        'language' => ['url' => 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json'],
//      ]);
  }

  /**
   * Get columns.
   *
   * @return array
   */
  protected function getColumns()
  {
    return [
      Column::make('id')->title('#'),
      Column::make('name'),
      Column::make('cpf')->title('CPF'),
      Column::make('email')->title('E-mail'),
      Column::make('created_at'),
      Column::make('updated_at'),
      Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width(60)
        ->addClass('text-center')
        ->title('Ações'),
    ];
  }

  /**
   * Get filename for export.
   *
   * @return string
   */
  protected function filename()
  {
    return 'Customers_' . date('YmdHis');
  }
}
