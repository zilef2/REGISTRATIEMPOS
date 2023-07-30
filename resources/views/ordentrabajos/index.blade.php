@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('ordentrabajos.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>codigo</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($ordentrabajos as $ordentrabajo)

				<tr>
					<td>{{ $ordentrabajo->id }}</td>
					<td>{{ $ordentrabajo->codigo }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('ordentrabajos.show', [$ordentrabajo->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('ordentrabajos.edit', [$ordentrabajo->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['ordentrabajos.destroy', $ordentrabajo->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
