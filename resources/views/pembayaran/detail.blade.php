@extends('backend.template')
@section('content')
<div class="box box-primary">
	<div class="box-header with-border">
		<h1 class="box-title">Pembayaran</h1>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th>No Pembayaran</th>
						<th>Tanggal</th>
						<th>Jenis Pembayaran</th>
						<th>Nominal</th>
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
						<td>{{ $p->created_at }}</td>
						<td>{{ $p->jenispembayaran->pembayaran }}</td>
						<td class="text-right">Rp. {{ number_format($p->jenispembayaran->nominal) }}</td>
					</tr>
					@empty
					<tr>
						<td colspan="5" class="text-center">Tidak ada data</td>
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