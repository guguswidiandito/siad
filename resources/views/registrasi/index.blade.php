@extends('backend.template')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <a href="{{ url('/admin/registrasi/create') }}" class="btn btn-primary">Tambah Registrasi</a>
        <div class="pull-right">
            {!! Form::open(['url' => '/admin/registrasi', 'method'=>'get', 'class'=>'form-inline']) !!}
            <div class="input-group {!! $errors->has('q') ? 'has-error' : '' !!}">
                {!! Form::text('q', isset($q) ? $q : null, ['class'=>'form-control', 'placeholder' => 'No Registrasi']) !!}
                {!! $errors->first('q', '<p class="help-block">:message</p>') !!}
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </span>
            </div>
            <div class="form-group {!! $errors->has('kelas') ? 'has-error' : '' !!}">
                {!! Form::select('kelas',[]+App\Kelas::pluck('nama_kelas', 'id')->all(), null,  ['class'=>'form-control','placeholder'=>'Pilih kelas']) !!}
                {!! $errors->first('kelas', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {!! $errors->has('jenis') ? 'has-error' : '' !!}">
                {!! Form::select('jenis',[]+App\JenisPembayaran::pluck('pembayaran', 'id')->all(), null,  ['class'=>'form-control','placeholder'=>'Pilih jenis pembayaran']) !!}
                {!! $errors->first('jenis', '<p class="help-block">:message</p>') !!}
            </div>
            {!! Form::submit('Sortir', ['class'=>'btn btn-primary']) !!}
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
                        <th>No Registrasi</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Tanggal</th>
                        <th>Jenis Pembayaran</th>
                        <th>Nominal</th>
                        <th>Tunggakan</th>
                        <th>Registrasi Terakhir</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1
                    @endphp
                    @forelse ($registrasi as $r)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $r->no_reg }}</td>
                        <td>{{ $r->pembayaran->siswa->nis }}</td>
                        <td>{{ $r->siswa->kelas->nama_kelas }}</td>
                        <td>{{ $r->created_at }}</td>
                        <td>{{ $r->pembayaran->jenispembayaran->pembayaran }}</td>
                        <td class="text-right">Rp. {{ number_format($r->pembayaran->jenispembayaran->nominal) }}</td>
                        <td class="text-right">Rp. {{ number_format($r->tunggakan) }}</td>
                        <td align="center">{{ $r->updated_at }}</td>
                        <td class="text-center">
                            {!! Form::model($r, ['route' => ['registrasi.destroy', $r->id], 'method' => 'delete', 'class'=>'form-inline'] ) !!}
                            <a href="{{ route('registrasi.edit', $r->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
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
            {{ $registrasi->appends(compact('q','jenis','kelas'))->links() }}
        </div>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection