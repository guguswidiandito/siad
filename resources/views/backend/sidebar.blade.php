@if (Auth::check())
<li class="header">MAIN NAVIGATION</li>
<li class="ac">
	<a href="{{ url('/')}}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
</li>
@if (Auth::user()->hak_akses == "admin")
<li class="tree-view">
	<a href="#">
		<i class="fa fa-sitemap"></i><span>Data Master</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
		<li>
			<a href="{{ route('kelas.index') }}"><i class="fa fa-circle-o"></i>Kelas</a>
		</li>
		<li>
			<a href="{{ route('siswa.index') }}" title=""><i class="fa fa-circle-o"></i>Siswa</a>
		</li>
		
		<li>
			<a href="{{ route('anggota.index') }}"><i class="fa fa-circle-o"></i>Anggota</a>
		</li>
	</ul>
</li>
<li class="tree-view">
	<a href="#">
		<i class="fa fa-retweet"></i><span>Data Keuangan</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
		<li>
			<a href="{{ route('jenis.index') }}"><i class="fa fa-circle-o"></i>Jenis Pembayaran</a>
		</li>
		<li>
			<a href="{{ route('pembayaran.index') }}"><i class="fa fa-circle-o"></i>Pembayaran</a>
		</li>
		<li>
			<a href="{{ route('registrasi.index') }}" title=""><i class="fa fa-circle-o"></i>Registrasi</a>
		</li>
	</ul>
</li>
<li class="tree-view">
	<a href="#">
		<i class="fa fa-file"></i><span>Laporan</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
		<li>
			<a href="{{ route('export.siswa') }}"><i class="fa fa-circle-o"></i>Identitas</a>
		</li>
		<li>
			<a href="{{ route('export.pembayaran') }}"><i class="fa fa-circle-o"></i>Pembayaran</a>
		</li>
		<li>
			<a href="{{ route('export.registrasi') }}"><i class="fa fa-circle-o"></i>Registrasi</a>
		</li>
	</ul>
</li>
@endif
@if (Auth::user()->hak_akses == "kepsek")
<li class="tree-view">
	<a href="#">
		<i class="fa fa-file"></i><span>Laporan</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
		<li>
			<a href="{{ route('export.siswa') }}"><i class="fa fa-circle-o"></i>Identitas</a>
		</li>
		<li>
			<a href="{{ route('export.pembayaran') }}"><i class="fa fa-circle-o"></i>Pembayaran</a>
		</li>
		<li>
			<a href="{{ route('export.registrasi') }}"><i class="fa fa-circle-o"></i>Registrasi</a>
		</li>
	</ul>
</li>
@endif
@if (Auth::user()->hak_akses == "siswa")
<li class="tree-view">
	<a href="#">
		<i class="fa fa-file"></i><span>Data Siswa</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
		<li>
			<a href="{{ route('siswa.identitas') }}"><i class="fa fa-circle-o"></i>Identitas</a>
		</li>
		<li>
			<a href="{{ route('siswa.pembayaran') }}"><i class="fa fa-circle-o"></i>Pembayaran</a>
		</li>
		<li>
			<a href="{{ route('siswa.registrasi') }}"><i class="fa fa-circle-o"></i>Registrasi</a>
		</li>
	</ul>
</li>
@endif
<li class="tree-view">
	<a href="#">
		<i class="fa fa-sliders"></i><span>Setelan</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
		<li>
			<a href="{{ url('setelan/password') }}"><i class="fa fa-lock"></i>Ubah Password</a>
		</li>
		<li>
			<a href="{{ url('/logout') }}" onclick="event.preventDefault();
				document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>Logout
			</a>
			<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
				{{ csrf_field() }}
			</form>
		</li>
	</ul>
</li>
@endif