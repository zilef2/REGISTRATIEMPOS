@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('disponibilidads.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>codigo</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($disponibilidads as $disponibilidad)

				<tr>
					<td>{{ $disponibilidad->id }}</td>
					<td>{{ $disponibilidad->codigo }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('disponibilidads.show', [$disponibilidad->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('disponibilidads.edit', [$disponibilidad->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['disponibilidads.destroy', $disponibilidad->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
