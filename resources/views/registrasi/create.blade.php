@extends('backend.template')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">Tambah Registrasi</h1>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::open(['route' => 'registrasi.store'])!!}
        <table class="table table-bordered">
            <tr>
                <th width="200px">No Registrasi</th>
                <td>
                    {!! Form::text('no_reg',null, ['class'=>'form-control','placeholder' => 'No Registrasi', 'required', 'autofocus']) !!}
                    {!! $errors->first('no_reg', '<p class="help-block">:message</p>') !!}
                </td>
            </tr>
            <tr>
                <th width="200px">No Pembayaran</th>
                <td>
                    {!! Form::select('pembayaran_id', $pembayaran, null, ['class'=>'form-control','placeholder' => 'Pilih no pembayaran']) !!}
                    {!! $errors->first('pembayaran_id', '<p class="help-block">:message</p>') !!}
                </td>
            </tr>
            <tr>
                <th width="200px">Semester</th>
                <td>
                    {!! Form::select('semester', ['1 (Satu)'=>'1 (Satu)', '2 (Dua)'=>'2 (Dua)'], null , ['class'=>'form-control', 'placeholder' => 'Pilih semester', 'required']) !!}
                    {!! $errors->first('semester', '<p class="help-block">:message</p>') !!}
                </td>
            </tr>
            <tr>
                <th width="200px">Bayar</th>
                <td>
                    {!! Form::number('bayar',null , ['class'=>'form-control', 'placeholder' => 'Total Bayar', 'required', 'integer']) !!}
                    {!! $errors->first('bayar', '<p class="help-block">:message</p>') !!}
                </td>
            </tr>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('registrasi.index') }}" class="btn btn-default" title="">Kembali</a>
            </td>
        </tr>
    </table>
    {!! Form::close() !!}
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
@endsection