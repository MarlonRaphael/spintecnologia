<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
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
      ->editColumn('price', function ($product) {
        return $product->price_view;
      })
      ->editColumn('created_at', function ($product) {
        return formatDate($product->created_at);
      })
      ->editColumn('updated_at', function ($product) {
        return formatDate($product->updated_at);
      })
      ->addColumn('action', function ($product) {
        return view('partials.actions', ['model' => $product]);
      });
  }

  /**
   * Get query source of dataTable.
   *
   * @param Product $model
   * @return Builder
   */
  public function query(Product $model)
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
      ->setTableId('products-table')
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
      Column::make('name'),
      Column::make('description'),
      Column::make('price'),
      Column::make('barcode'),
      Column::make('created_at'),
      Column::make('updated_at'),
      Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width(60)
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
    return 'Products_' . date('YmdHis');
  }
}
