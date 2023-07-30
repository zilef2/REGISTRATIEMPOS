@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('materials.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>codigo</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($materials as $material)

				<tr>
					<td>{{ $material->id }}</td>
					<td>{{ $material->codigo }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('materials.show', [$material->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('materials.edit', [$material->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['materials.destroy', $material->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
