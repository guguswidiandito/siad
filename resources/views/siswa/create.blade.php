@extends('backend.template')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">Tambah Kelas</h1>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {!! Form::open(['route' => 'siswa.store'])!!}
        <table class="table table-bordered">
            <tr>
                <th width="200px">NIS</th>
                <td>
                    {!! Form::text('nis', null, ['class'=>'form-control','autofocus','required', 'placeholder'=>'NIS']) !!}
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
                    <select name="angkatan" class="form-control" required>
                        <option selected="selected" disabled="disabled" hidden="hidden" value="">Pilih tahun</option>
                        <?php
                        for ($i=2010; $i<=date('Y'); $i++) {
                        echo "<option value='".$i."'>".$i."</option>";
                        }
                        ?>
                    </select>
                    {!! $errors->first('angkatan', '<p class="help-block">:message</p>') !!}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('siswa.index') }}" class="btn btn-default">Kembali</a>
                </td>
            </tr>
        </table>
        {!! Form::close() !!}
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection