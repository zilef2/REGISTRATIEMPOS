@extends('default')

@section('content')

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('guardargooglesheetscomercials.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>id</th>
				<th>Nombre tablero</th>
				<th>OT+Item</th>
				<th>avance</th>
				<th>Tiempo estimado Ing. mecanica</th>
				<th>Tiempo estimado Ing. electrica</th>
				<th>Tiempo estimado corte</th>
				<th>Tiempo estimado doblez</th>
				<th>Tiempo estimado soldadura</th>
				<th>Tiempo estimado pulida</th>
				<th>Tiempo estimado ensamble</th>
				<th>Tiempo estimado cableado</th>
				<th>Tiempo estimado cobre</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($guardargooglesheetscomercials as $guardargooglesheetscomercial)

				<tr>
					<td>{{ $guardargooglesheetscomercial->id }}</td>
					<td>{{ $guardargooglesheetscomercial->Nombre tablero }}</td>
					<td>{{ $guardargooglesheetscomercial->OT+Item }}</td>
					<td>{{ $guardargooglesheetscomercial->avance }}</td>
					<td>{{ $guardargooglesheetscomercial->Tiempo estimado Ing. mecanica }}</td>
					<td>{{ $guardargooglesheetscomercial->Tiempo estimado Ing. electrica }}</td>
					<td>{{ $guardargooglesheetscomercial->Tiempo estimado corte }}</td>
					<td>{{ $guardargooglesheetscomercial->Tiempo estimado doblez }}</td>
					<td>{{ $guardargooglesheetscomercial->Tiempo estimado soldadura }}</td>
					<td>{{ $guardargooglesheetscomercial->Tiempo estimado pulida }}</td>
					<td>{{ $guardargooglesheetscomercial->Tiempo estimado ensamble }}</td>
					<td>{{ $guardargooglesheetscomercial->Tiempo estimado cableado }}</td>
					<td>{{ $guardargooglesheetscomercial->Tiempo estimado cobre }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('guardargooglesheetscomercials.show', [$guardargooglesheetscomercial->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('guardargooglesheetscomercials.edit', [$guardargooglesheetscomercial->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['guardargooglesheetscomercials.destroy', $guardargooglesheetscomercial->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

@stop
