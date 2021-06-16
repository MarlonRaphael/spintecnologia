<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
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
      ->rawColumns(['status', 'action', 'customer.name'])
      ->editColumn('customer.name', function ($order) {

        if ($order->customer->exists()) {
          return "<a href='" . route('customers.show', $order->customer_id) . "'>{$order->customer->name}</a>";
        }

        return $order->customer->name;

      })
      ->editColumn('status', function ($order) {

        switch ($order->status) {
          case '0':
            return '<span class="badge badge-pill badge-primary">Opened</span>';
          case '1':
            return '<span class="badge badge-pill badge-success">Paid</span>';
          case '2':
            return '<span class="badge badge-pill badge-danger">Cancelled</span>';
        }

        return "";

      })
      ->editColumn('total', function ($order) {
        return $order->total_view;
      })
      ->editColumn('discount', function ($order) {
        return $order->discount_view;
      })
      ->editColumn('created_at', function ($order) {
        return formatDate($order->created_at);
      })
      ->editColumn('updated_at', function ($order) {
        return formatDate($order->updated_at);
      })
      ->addColumn('action', function ($order) {
        return view('orders.actions', ['model' => $order]);
      });
  }

  /**
   * Get query source of dataTable.
   *
   * @param Order $model
   * @return Builder
   */
  public function query(Order $model)
  {
    return $model->newQuery()->select('orders.*')->with('customer:id,name');
  }

  /**
   * Optional method if you want to use html builder.
   *
   * @return \Yajra\DataTables\Html\Builder
   */
  public function html()
  {
    return $this->builder()
      ->setTableId('orders-table')
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
      Column::make('customer.name', 'customer.name')->title('Customer'),
      Column::make('status'),
      Column::make('discount'),
      Column::make('total'),
      Column::make('created_at'),
      Column::make('updated_at'),
      Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width(150)
        ->addClass('text-center'),
    ];
  }

  /**
   * Get filename for export.
   *
   * @return string
   */
  protected function filename()
  {
    return 'Orders_' . date('YmdHis');
  }
}
