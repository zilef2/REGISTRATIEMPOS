@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('reportes.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>nombre</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($reportes as $reporte)

				<tr>
					<td>{{ $reporte->id }}</td>
					<td>{{ $reporte->nombre }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('reportes.show', [$reporte->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('reportes.edit', [$reporte->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['reportes.destroy', $reporte->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
