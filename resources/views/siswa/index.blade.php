@extends('backend.template')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <a href="{{ url('/admin/siswa/create') }}" class="btn btn-primary">Tambah Siswa</a>
        <div class="pull-right">
            {!! Form::open(['url' => '/admin/siswa', 'method'=>'get', 'class'=>'form-inline']) !!}
            <div class="input-group {!! $errors->has('q') ? 'has-error' : '' !!}">
                {!! Form::text('q', isset($q) ? $q : null, ['class'=>'form-control', 'placeholder' => 'NIS']) !!}
                {!! $errors->first('q', '<p class="help-block">:message</p>') !!}
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </span>
            </div>
            <div class="form-group {!! $errors->has('kelas') ? 'has-error' : '' !!}">
                {!! Form::select('kelas',[]+App\Kelas::pluck('nama_kelas', 'id')->all(), null,  ['class'=>'form-control','placeholder'=>'Pilih Kelas']) !!}
                {!! $errors->first('kelas', '<p class="help-block">:message</p>') !!}
            </div>
            {!! Form::submit('Sort', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Angkatan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1
                    @endphp
                    @forelse ($siswa as $s)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $s->nis }}</td>
                        <td>{{ $s->user->name }}</td>
                        <td>{{ $s->kelas->nama_kelas }}</td>
                        <td>{{ $s->kelas->nama_jurusan }}</td>
                        <td>{{ $s->angkatan }}</td>
                        <td class="text-center">
                            {!! Form::model($s, ['route' => ['siswa.destroy', $s->id], 'method' => 'delete', 'class'=>'form-inline'] ) !!}
                            <a href="{{ route('siswa.edit', $s->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus?')"><i class="fa fa-trash"></i></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $siswa->appends(compact('q', 'kelas'))->links() }}
        </div>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection