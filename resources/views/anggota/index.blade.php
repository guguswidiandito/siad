@extends('backend.template')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <a href="{{ url('/admin/anggota/create') }}" class="btn btn-primary">Tambah User</a>
        <div class="pull-right">
            {!! Form::open(['url' => '/admin/anggota', 'method'=>'get', 'class'=>'form-inline']) !!}
            <div class="input-group {!! $errors->has('q') ? 'has-error' : '' !!}">
                {!! Form::text('q', isset($q) ? $q : null, ['class'=>'form-control', 'placeholder' => 'Nama']) !!}
                {!! $errors->first('q', '<p class="help-block">:message</p>') !!}
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </span>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1
                    @endphp
                    @forelse ($anggota as $p)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->username }}</td>
                        <td>{{ $p->email }}</td>
                        <td class="text-center">
                            {!! Form::model($p, ['route' => ['anggota.destroy', $p->id], 'method' => 'delete', 'class'=>'form-inline'] ) !!}
                            <a href="{{ route('anggota.edit', $p->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus?')"><i class="fa fa-trash"></i></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $anggota->appends(compact('q'))->links() }}
        </div>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
<div class="box box-primary">
    <div class="box-body">
        Default password adalah "rahasia"
    </div>
</div>
@endsection