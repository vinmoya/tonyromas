@extends('cruds.table')

<!-- Page titles -->
@section('page-title')
	<h3 class="card-header">
		Códigos
	</h3>
@endsection

<!-- Table Titles -->
@section('table-titles')
	<th>Codigo(IMG)</th>
	<th>Código</th>
	<th>Fecha de Caducidad</th>
	<th>Valor</th>
	<th>Estado</th>
	<th>Lugar de Emisión</th>
	<th>Lugar de Activación</th>
	<th>Fecha de Activación</th>
	<th>Comanda Activación</th>
	<th>Fecha de Canjeo</th>
	<th>Comanda Canjeo</th>
@endsection

<!-- Table Content -->
@section('table-rows')
	@foreach ($array as $row)
		<tr>
			<td>
				<a href="{{ asset('codes/historical/'.$row->code.'.png') }}" title="Generar Codigo" target="_blank">
					<img src="{{ asset('codes/historical/'.$row->code.'.png') }}" style="max-height:40px;">
				</a>
			</td>
			<td>
				{{ $row->code }}
			</td>
			<td>
				{{ date('d-m-Y', strtotime($row->expiration_date)) }}
			</td>
			<td>
				{{ $row->value }}
			</td>
			<td>
				{{ $row->state }}
			</td>
			<td>
				@if ( (!empty($row->campaign)) AND (!empty($row->state)) ) 
					{{ $row->campaign }} 
				@elseif( (empty($row->campaign)) AND ($row->state == "ACTIVO") ) <span>Interno</span> 
				@else {{ $row->campaign }}
				@endif
			</td>

			<td>
				@if ( ($row->state == 'ACTIVO') AND (!empty($row->campaign)) ) {{ $row->campaign }} @endif
			</td>
			<td> 
				@if (!empty($row->activation_date)) {{ date('d-m-Y', strtotime($row->activation_date)) }} @else <span class="alert-warning">Sin Activar</span> @endif  
			</td>
			<td> 
				@if (!empty($row->command_activation)) {{ $row->command_activation }} @else <spam class="alert-warning">Sin Activar</spam> 
				@endif
			</td>
			<td>
				@if (!empty($row->redemption_date)) {{ date('d-m-Y', strtotime($row->redemption_date)) }} @else <spam class="alert-warning">Sin Canjear</spam> @endif
			</td>
			<td>
				@if (!empty($row->exchange_command)) {{ $row->exchange_command }} @else <spam class="alert-warning">Sin Canjear</spam> @endif
			</td>
		</tr>
	@endforeach
@endsection

<!-- Card Footer -->
@section('card-footer')
	<div class="mx-auto" style="width: 800px;">
			<button class="btn btn-primary" data-toggle="modal" data-target=".generate-codes">Generar Códigos</button>

			<a href="{{ Route($options['route'].'.download-coupon') }}">
				<button type="button" class="btn btn-primary">Exportar Cupones y Detalles</button>
			</a>

			<a href="{{ Route($options['route'].'.download') }}">
				<button type="button" class="btn btn-primary">Descargar Último Lote de Códigos</button>
			</a>

			<button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Anular</button>
	</div>
@endsection

<!-----------------Modal Form Generate Codes----------------------->
<div class="modal fade generate-codes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generar Códigos</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
            </div>
			
			{!! Form::open(['route' => $options['route'].'.store', 'autocomplete' => 'off', 'id' => 'generated']) !!}

				<div class="modal-body">
					{{ csrf_field() }}

					<div class="form-group">
						<label for="quantity">Cantidad <span class="text-danger">(*)</span></label>
						<input id="num" type="number" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" required autofocus>
						@if ($errors->has('quantity'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('quantity') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group">
						<label for="expire">Fecha de Caducidad <span class="text-danger">(*)</span></label>
						<input id="expire" type="text" class="form-control{{ $errors->has('expire') ? ' is-invalid' : '' }} calendar" name="expire" data-date-format="Y-m-d" data-min-date="today" required>
						@if ($errors->has('expire'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('expire') }}</strong>
							</span>
						@endif
					</div>
					
					<div class="form-group">
						<label for="value">Valor del Código <span class="text-danger">(*)</span></label>
						<input id="num" type="number" class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}" name="value" required>
						@if ($errors->has('value'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('value') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group">
						<label for="camapign">Campaña</label>
						<input id="campaign" type="text" class="form-control{{ $errors->has('campaign') ? ' is-invalid' : '' }}" name="campaign">
						@if ($errors->has('value'))
							<span class="invalid-feedback">
								<strong>{{ $errors->first('campaign') }}</strong>
							</span>
						@endif
					</div>		

					<div class="form-group">
						<label for="activate_codes">Activar Códigos <span class="text-danger">(*)</span></label>
							<select name="activate_codes" class="form-control" required>

								<option value="">======== Seleccione una opción ========</option>
								<option value="SI">SI</option>
								<option value="NO">NO</option>

							</select>
					</div>			

				</div>

				<div class="modal-footer">
					<div class="form-group col text-center">
						<button type="button" class="btn btn-primary ks-light ks-rounded generated">Generar</button>
						<button type="button" class="btn btn-danger ks-light ks-rounded" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			{!! Form::close() !!}
			
		</div>
    </div>
</div>
<!----------------------------------------------------------------->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Anular Códigos</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
            </div>
			
			{!! Form::open(['route' => $options['route'].'.import-csv', 'enctype' => 'multipart/form-data']) !!}
            	<div class="modal-body">

					<div class="file-loading">
			          	<input id="input-file" name="codes" multiple type="file" required>
			        </div>
			        <div id="kartik-file-errors"></div>

		    	</div>
		    	<div class="modal-footer">
		        	<button type="submit" class="btn btn-primary ks-light ks-rounded">Enviar</button>

		        	<a href="{{ Route($options['route'].'.export-csv',['type'=>'csv']) }}" type="button" class="btn btn-primary ks-light ks-rounded">
						Descargar Plantilla
					</a>

		        	<button type="button" class="btn btn-danger ks-light ks-rounded" data-dismiss="modal">Cerrar</button>
		        </div>
			{!! Form::close() !!}
		</div>
    </div>
</div>

<script type="text/javascript">



    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });



    $(".btn-submit").click(function(e){

        e.preventDefault();


        var name = $("input[name=name]").val();

        var password = $("input[name=password]").val();

        var email = $("input[name=email]").val();



        $.ajax({

           type:'POST',

           url:'/ajaxRequest',

           data:{name:name, password:password, email:email},

           success:function(data){

              alert(data.success);

           }

        });


	});

</script>