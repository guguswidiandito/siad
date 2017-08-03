@extends('backend.template')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">Laporan Identitas</h1>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::open(['url' => route('export.siswa.post'), 'method' => 'post', 'target'=>'_blank']) !!}
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th width="200px">Kelas</th>
                    <td>
                        {!! Form::select('kelas_id', []+App\Kelas::pluck('nama_kelas','id')->all(), null, [
                        'class'=>'form-control', 'placeholder'=>'Pilih kelas', 'required']) !!}
                        {!! $errors->first('kelas_id', '<p class="help-block">:message</p>') !!}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        {!! Form::submit('Download', ['class'=>'btn btn-primary']) !!}
                        <a href="{{ route('siswa.index') }}" class="btn btn-default">Kembali</a>
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