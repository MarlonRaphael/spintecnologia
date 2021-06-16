<div class="dropdown">
  <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-outline-dark btn-sm"
          data-toggle="dropdown" type="button">
    <i class="fas fa-ellipsis-v"></i>
  </button>
  <div class="dropdown-menu tx-13 shadow-sm" x-placement="bottom-start"
       style="position: absolute; will-change: transform; top: 0; left: 0; transform: translate3d(0px, 39px, 0px);">
    @if (Route::has(resource_url($model, 'show')))
      <a class="dropdown-item has-icon mr-2" href="{{ route(resource_url($model, 'show'), $model->id) }}">
        <i class="far fa-eye"></i> {{ __('View') }}
      </a>
    @endif
    @if (Route::has(resource_url($model, 'update')))
      <a class="dropdown-item has-icon mr-2" href="{{ route(resource_url($model, 'edit'), $model->id) }}">
        <i class="far fa-edit"></i> {{ __('Edit') }}
      </a>
    @endif
    @if (Route::has(resource_url($model, 'destroy')))
      <a class="dropdown-item has-icon mr-2 text-danger"
         onclick="event.preventDefault(); document.getElementById('delete-{{ $model->id }}').submit();"
         href="{{ route(resource_url($model, 'destroy'), $model->id) }}">
        <i class="fas fa-trash-alt"></i> {{ __('Delete') }}
      </a>
      <form action="{{ route(resource_url($model, 'destroy'), $model->id) }}"
            method="post" id="delete-{{ $model->id }}">
        @csrf
        @method('delete')
      </form>
    @endif
  </div>
</div>