@if (Auth::user()->role_id != 4)
    <a href="{{ route('invoice.index', $id) }}"
        class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Ventas"><i class="fas fa-file-export"></i>
    </a>
@endif





