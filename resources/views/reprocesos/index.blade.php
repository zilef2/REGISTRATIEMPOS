@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('reprocesos.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>codigo</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($reprocesos as $reproceso)

				<tr>
					<td>{{ $reproceso->id }}</td>
					<td>{{ $reproceso->codigo }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('reprocesos.show', [$reproceso->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('reprocesos.edit', [$reproceso->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['reprocesos.destroy', $reproceso->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
