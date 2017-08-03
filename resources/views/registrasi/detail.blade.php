@extends('backend.template')
@section('content')
<div class="box box-primary">
	<div class="box-header with-border">
		<h1 class="box-title">Registrasi</h1>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th>Jenis Pembayaran</th>
						<th class="text-center">Nominal</th>
						<th class="text-center">Total Bayar</th>
						<th class="text-center">Tunggakan</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; ?>
					@forelse ($registrasi as $r)
					<tr>
						<td class="text-center">{{ $no++ }}</td>
						<td>{{ $r->pembayaran->jenispembayaran->pembayaran }}</td>
						<td class="text-right">Rp. {{ number_format($r->pembayaran->jenispembayaran->nominal) }}</td>
						<td class="text-right">Rp. {{ number_format($r->bayar) }}</td>
						<td class="text-right">Rp. {{ number_format($r->tunggakan) }}</td>
					</tr>
					@empty
					<tr>
						<td colspan="5" class="text-center">Tidak ada data</td>
					</tr>
					@endforelse
					<tr>
						<td colspan="3"><strong>Total</strong></td>
						<td class="text-right"><strong>Rp. {{ number_format(DB::table('registrasis')->where('user_id', Auth::id())->sum('bayar')) }}</strong></td>
						<td colspan="" class="text-right"><strong>Rp. {{ number_format(DB::table('registrasis')->where('user_id', Auth::id())->sum('tunggakan')) }}</strong></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->
@endsection