<div class="box-body formulario">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
        @foreach ($restaurantTables as $restaurantTable)
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 radio">
                @if (isset($restaurantOrder) && $restaurantOrder->restaurant_table_id == $restaurantTable->id)
                    <input class="form-check-input" type="radio" value="{{ $restaurantTable->id }}" name="restaurant_table_id" id="{{ $restaurantTable->id }}" checked>

                    <label class="form-check-label" for="{{ $restaurantTable->id }}">{{ $restaurantTable->name }}</label>
                @elseif ($restaurantTable->id == 2)
                    <input class="form-check-input" type="radio" value="{{ $restaurantTable->id }}" name="restaurant_table_id" id="{{   $restaurantTable->id }}" checked>

                    <label class="form-check-label" for="{{ $restaurantTable->id }}">{{ $restaurantTable->name }}</label>
                @else
                    <input class="form-check-input" type="radio" value="{{ $restaurantTable->id }}" name="restaurant_table_id" id="{{ $restaurantTable->id }}">

                    <label class="form-check-label" for="{{ $restaurantTable->id }}">{{ $restaurantTable->name }}</label>
                @endif

            </div>
        @endforeach
    </div>
</div>
