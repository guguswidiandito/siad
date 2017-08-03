@extends('backend.template')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <a href="{{ url('/admin/pembayaran/create') }}" class="btn btn-primary">Tambah Pembayaran</a>
        <div class="pull-right">
            {!! Form::open(['url' => '/admin/pembayaran', 'method'=>'get', 'class'=>'form-inline']) !!}
            <div class="input-group {!! $errors->has('q') ? 'has-error' : '' !!}">
                {!! Form::text('q', isset($q) ? $q : null, ['class'=>'form-control', 'placeholder' => 'No Pembayaran']) !!}
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
                        <th>No Pembayaran</th>
                        <th>NIS</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Operator</th>
                        <th>Jenis Pembayaran</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1
                    @endphp
                    @forelse ($pembayaran as $p)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $p->no_pembayaran }}</td>
                        <td>{{ $p->siswa->nis }}</td>
                        <td>{{ $p->created_at }}</td>
                        <td>{{ $p->siswa->user->name }}</td>
                        <td>{{ $p->operator }}</td>
                        <td>{{ $p->jenispembayaran->pembayaran }}</td>
                        <td class="text-center">
                        {!! Form::model($p, ['route' => ['pembayaran.destroy', $p->id], 'method' => 'delete', 'class'=>'form-inline'] ) !!}
                        <a href="{{ route('pembayaran.edit', $p->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
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
        {{ $pembayaran->appends(compact('q'))->links() }}
    </div>
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
@endsection