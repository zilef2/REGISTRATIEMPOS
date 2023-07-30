@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('centrotrabajos.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>codigo</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($centrotrabajos as $centrotrabajo)

				<tr>
					<td>{{ $centrotrabajo->id }}</td>
					<td>{{ $centrotrabajo->codigo }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('centrotrabajos.show', [$centrotrabajo->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('centrotrabajos.edit', [$centrotrabajo->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['centrotrabajos.destroy', $centrotrabajo->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
