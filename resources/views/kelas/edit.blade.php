@extends('backend.template')
@section('content')
<div class="box box-primary">
	<div class="box-header with-border">
		<h1 class="box-title">Edit <strong>{{$kelas->nama_kelas}}</strong></h1>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		{!! Form::model($kelas, ['route' => ['kelas.update', $kelas], 'method' =>'patch'])!!}
		<table class="table table-bordered">
			<tr>
				<th>Kelas</th>
				<td>
					{!! Form::text('nama_kelas', null, ['class'=>'form-control','autofocus','required', 'placeholder'=>'Kelas']) !!}
					{!! $errors->first('nama_kelas', '<p class="help-block">:message</p>') !!}
				</td>
			</tr>
			<tr>
				<th>Jurusan</th>
				<td>
					{!! Form::text('nama_jurusan', null, ['class'=>'form-control', 'placeholder'=>'Jurusan']) !!}
					{!! $errors->first('nama_jurusan', '<p class="help-block">:message</p>') !!}
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<button type="submit" class="btn btn-primary">Update</button>
					<a href="{{ route('kelas.index') }}" class="btn btn-default" title="">Kembali</a>
				</td>
			</tr>
		</table>
		{!! Form::close() !!}
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->
@endsection