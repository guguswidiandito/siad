@extends('backend.template')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">Edit Password</h1>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::open([url('/setelan/password')])!!}
        <table class="table table-bordered">
            <tr>
                <th>Password Lama</th>
                <td>
                    {!! Form::password('password', ['class'=>'form-control','autofocus','required', 'placeholder'=>'Password lama']) !!}
                    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                </td>
            </tr>
            <tr>
                <th>Password Baru</th>
                <td>
                    {!! Form::password('new_password', ['class'=>'form-control','required', 'placeholder'=>'Password baru']) !!}
                    {!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
                </td>
            </tr>
            <tr>
                <th>Konfirmasi Password</th>
                <td>
                    {!! Form::password('new_password_confirmation', ['class'=>'form-control','required', 'placeholder'=>'Konfirmasi password baru']) !!}
                    {!! $errors->first('new_password_confirmation', '<p class="help-block">:message</p>') !!}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
                    <a href="{{ url('/') }}" class="btn btn-default">Kembali</a>
                </td>
            </tr>
        </table>
        {!! Form::close() !!}
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection