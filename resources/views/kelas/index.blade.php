@extends('backend.template')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <a href="{{ url('/admin/kelas/create') }}" class="btn btn-primary">Tambah Kelas</a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
       <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
            <thead>
                <tr>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kelas as $k)
                <tr>
                    <td>{{ $k->nama_kelas }}</td>
                    <td>{{ $k->nama_jurusan }}</td>
                    <td class="text-center">
                        {!! Form::model($k, ['route' => ['kelas.destroy', $k->id], 'method' => 'delete', 'class'=>'form-inline'] ) !!}
                        <a href="{{ route('kelas.edit', $k->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus?')"><i class="fa fa-trash"></i></button>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
       </div>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection