@extends('backend.template')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">Laporan Registrasi</h1>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::open(['url' => route('export.registrasi.post'), 'method' => 'post', 'target'=>'_blank']) !!}
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th width="200px">Kelas</th>
                    <td>
                        {!! Form::select('kelas', []+App\Kelas::pluck('nama_kelas','id')->all(), null, [
                        'class'=>'form-control',
                        'placeholder' => 'Pilih kelas', 'required']) !!}
                        {!! $errors->first('kelas', '<p class="help-block">:message</p>') !!}
                    </td>
                </tr>
                <tr>
                    <th width="200px">Jenis Pembayaran</th>
                    <td>
                        {!! Form::select('jenis', []+App\JenisPembayaran::pluck('pembayaran','id')->all(), null, [
                        'class'=>'form-control',
                        'placeholder' => 'Pilih jenis pembayaran', 'required']) !!}
                        {!! $errors->first('jenis', '<p class="help-block">:message</p>') !!}
                    </td>
                </tr>
                <tr>
                    <th width="200px">Tahun</th>
                    <td>
                        <select name="tahun" class="form-control" required>
                            <option selected="selected" disabled="disabled" hidden="hidden" value="">Pilih tahun</option>
                            <?php
                            for ($i=2010; $i<=date('Y'); $i++) {
                            echo "<option value='".$i."'>".$i."</option>";
                            }
                            ?>
                        </select>
                        {!! $errors->first('tahun', '<p class="help-block">:message</p>') !!}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        {!! Form::submit('Download', ['class'=>'btn btn-primary']) !!}
                        <a href="{{ route('registrasi.index') }}" class="btn btn-default">Kembali</a>
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