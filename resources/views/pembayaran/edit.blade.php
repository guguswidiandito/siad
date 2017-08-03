@extends('backend.template')
@section('content')
<div class="box box-primary">
	<div class="box-header with-border">
		<h1 class="box-title">Edit <strong>{{$pembayaran->no_pembayaran}}</strong></h1>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		{!! Form::model($pembayaran, ['route' => ['pembayaran.update', $pembayaran], 'method' =>'patch'])!!}
		<table class="table table-bordered">
			<th width="200px">No Pembayaran</th>
			<td>
				{!! Form::text('no_pembayaran', null, ['class'=>'form-control', 'placeholder'=>'No Pembayaran', 'required', 'autofocus']) !!}
				{!! $errors->first('no_pembayaran', '<p class="help-block">:message</p>') !!}
			</td>
		</tr>
		<tr>
			<th width="200px">NIS</th>
			<td>
				{!! Form::select('siswa_id', $siswa, null, ['class'=>'form-control', 'placeholder'=>'Pilih NIS']) !!}
				{!! $errors->first('siswa_id', '<p class="help-block">:message</p>') !!}
			</td>
		</tr>
		<tr>
			<th width="200px">Jenis Pembayaran</th>
			<td>
				{!! Form::select('jenis_pembayaran_id', $jenis, null, ['class'=>'form-control', 'placeholder'=>'Pilih jenis pembayaran']) !!}
				{!! $errors->first('jenis_pembayaran_id', '<p class="help-block">:message</p>') !!}
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<button type="submit" class="btn btn-primary">Update</button>
				<a href="{{ route('pembayaran.index') }}" class="btn btn-default" title="">Kembali</a>
			</td>
		</tr>
	</table>
	{!! Form::close() !!}
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
@endsection