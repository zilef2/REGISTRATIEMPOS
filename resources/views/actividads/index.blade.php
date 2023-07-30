@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('actividads.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>codigo</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($actividads as $actividad)

				<tr>
					<td>{{ $actividad->id }}</td>
					<td>{{ $actividad->codigo }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('actividads.show', [$actividad->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('actividads.edit', [$actividad->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['actividads.destroy', $actividad->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
