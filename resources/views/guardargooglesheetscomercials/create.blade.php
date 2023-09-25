@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{!! Form::open(['route' => 'guardargooglesheetscomercials.store']) !!}

		<div class="mb-3">
			{{ Form::label('Nombre tablero', 'Nombre tablero', ['class'=>'form-label']) }}
			{{ Form::text('Nombre tablero', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('OT+Item', 'OT+Item', ['class'=>'form-label']) }}
			{{ Form::text('OT+Item', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('avance', 'Avance', ['class'=>'form-label']) }}
			{{ Form::text('avance', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('Tiempo estimado Ing. mecanica', 'Tiempo estimado Ing. mecanica', ['class'=>'form-label']) }}
			{{ Form::text('Tiempo estimado Ing. mecanica', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('Tiempo estimado Ing. electrica', 'Tiempo estimado Ing. electrica', ['class'=>'form-label']) }}
			{{ Form::text('Tiempo estimado Ing. electrica', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('Tiempo estimado corte', 'Tiempo estimado corte', ['class'=>'form-label']) }}
			{{ Form::text('Tiempo estimado corte', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('Tiempo estimado doblez', 'Tiempo estimado doblez', ['class'=>'form-label']) }}
			{{ Form::text('Tiempo estimado doblez', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('Tiempo estimado soldadura', 'Tiempo estimado soldadura', ['class'=>'form-label']) }}
			{{ Form::text('Tiempo estimado soldadura', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('Tiempo estimado pulida', 'Tiempo estimado pulida', ['class'=>'form-label']) }}
			{{ Form::text('Tiempo estimado pulida', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('Tiempo estimado ensamble', 'Tiempo estimado ensamble', ['class'=>'form-label']) }}
			{{ Form::text('Tiempo estimado ensamble', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('Tiempo estimado cableado', 'Tiempo estimado cableado', ['class'=>'form-label']) }}
			{{ Form::text('Tiempo estimado cableado', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('Tiempo estimado cobre', 'Tiempo estimado cobre', ['class'=>'form-label']) }}
			{{ Form::text('Tiempo estimado cobre', null, array('class' => 'form-control')) }}
		</div>


		{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}


@stop