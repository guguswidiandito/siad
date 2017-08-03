@extends('backend.template')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">Edit <strong>{{ $anggota->name }}</strong></h1>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::model($anggota, ['route' => ['anggota.update', $anggota], 'method' =>'patch'])!!}
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <td>
                    {!! Form::text('name',null , ['class'=>'form-control', 'placeholder' => 'Name', 'required','autofocus' ]) !!} 
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </td>
            </tr>
            <tr>
                <th>Username</th>
                <td>
                    {!! Form::text('username', null, ['class'=>'form-control', 'placeholder' => 'Username', 'required','autofocus' ]) !!} 
                    {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
                </td>
            </tr>
            <tr>
                <th>Email</th>
                <td>
                    {!! Form::email('email',null , ['class'=>'form-control', 'placeholder' => 'Email', 'required', 'integer']) !!} 
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('anggota.index') }}" class="btn btn-default" title="">Kembali</a>
                </td>
            </tr>
        </table>
        {!! Form::close() !!}
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection