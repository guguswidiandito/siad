@extends('backend.template')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">Laporan Pembayaran</h1>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::open(['url' => route('export.pembayaran.post'), 'method' => 'post', 'target'=>'_blank']) !!}
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Dari</th>
                    <td>
                        {!! Form::date('awal', null, ['class'=>'form-control', 'required', 'autofocus']) !!}
                        {!! $errors->first('awal', '<p class="help-block">:message</p>') !!}
                    </td>
                </tr>
                <tr>
                    <th>Sampai</th>
                    <td>
                        {!! Form::date('akhir', null, ['class'=>'form-control', 'required']) !!}
                        {!! $errors->first('akhir', '<p class="help-block">:message</p>') !!}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        {!! Form::submit('Download', ['class'=>'btn btn-primary']) !!}
                        <a href="{{ route('pembayaran.index') }}" class="btn btn-default">Kembali</a>
                    </td>
                </tr>
            </tbody>
        </table>
        {!! Form::close() !!}
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection