@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($ordentrabajo, array('route' => array('ordentrabajos.update', $ordentrabajo->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('codigo', 'Codigo', ['class'=>'form-label']) }}
			{{ Form::text('codigo', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
@stop
