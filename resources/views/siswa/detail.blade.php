@extends('backend.template')
@section('content')
<div class="box box-primary">
	<div class="box-header with-border">
		<h1 class="box-title">Identitas</h1>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table class="table table-bordered">
				<tbody>
					@foreach ($siswa as $s)
					<tr>
						<th>NIS</th>
						<td>{{ $s->nis }}</td>
					</tr>
					<tr>
						<th>Nama</th>
						<td>{{ $s->user->name }}</td>
					</tr>
					<tr>
						<th>Kelas</th>
						<td>{{ $s->kelas->nama_kelas }}</td>
					</tr>
					<tr>
						<th>Jurusan</th>
						<td>{{ $s->kelas->nama_jurusan }}</td>
					</tr>
					<tr>
						<th>Angkatan</th>
						<td>{{ $s->angkatan }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</table>
	</div>
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
@endsection