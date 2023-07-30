@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('piezas.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>codigo</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($piezas as $pieza)

				<tr>
					<td>{{ $pieza->id }}</td>
					<td>{{ $pieza->codigo }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('piezas.show', [$pieza->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('piezas.edit', [$pieza->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['piezas.destroy', $pieza->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
