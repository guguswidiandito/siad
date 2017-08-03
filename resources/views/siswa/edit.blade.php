@extends('backend.template')
@section('content')
<div class="box box-primary">
	<div class="box-header with-border">
		<h1 class="box-title">Edit <strong>{{$siswa->user->name}}</strong></h1>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		{!! Form::model($siswa, ['route' => ['siswa.update', $siswa], 'method' =>'patch'])!!}
		<table class="table table-bordered">
			<tr>
				<th width="200px">NIS</th>
				<td>
					{!! Form::text('nis', null, ['class'=>'form-control','disabled','required', 'placeholder'=>'NIS']) !!}
					{!! $errors->first('nis', '<p class="help-block">:message</p>') !!}
				</td>
			</tr>
			<tr>
				<th width="200px">Nama</th>
				<td>
					{!! Form::select('user_id', $user, null, ['class'=>'form-control', 'placeholder'=>'Pilih nama']) !!}
					{!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
				</td>
			</tr>
			<tr>
				<th width="200px">Kelas</th>
				<td>
					{!! Form::select('kelas_id', $kelas, null, ['class'=>'form-control', 'placeholder'=>'Pilih kelas']) !!}
					{!! $errors->first('kelas_id', '<p class="help-block">:message</p>') !!}
				</td>
			</tr>
			<tr>
				<th width="200px">Angkatan</th>
				<td>
					{!! Form::selectRange('angkatan', 2010, 2017, null, ['class'=>'form-control']) !!}
				</select>
				{!! $errors->first('angkatan', '<p class="help-block">:message</p>') !!}
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<button type="submit" class="btn btn-primary">Update</button>
				<a href="{{ route('siswa.index') }}" class="btn btn-default" title="">Kembali</a>
			</td>
		</tr>
	</table>
	{!! Form::close() !!}
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
@endsection