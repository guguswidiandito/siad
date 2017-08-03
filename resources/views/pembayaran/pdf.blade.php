<!DOCTYPE html>
<html>
	<head>
		<title>Laporan Pembayaran</title>
		<style>
		/* --------------------------------------------------------------
		Hartija Css Print Framework
		* Version: 1.0
		-------------------------------------------------------------- */
		body {
		width:100% !important;
		margin:0 !important;
		padding:0 !important;
		line-height: 1;
		font-family: Garamond,"Times New Roman", serif;
		color: #000;
		background: none;
		font-size: 14pt; }
		/* Headings */
		h1,h2,h3,h4,h5,h6 { page-break-after:avoid; }
		h1{font-size:19pt;}
		h2{font-size:17pt;}
		h3{font-size:15pt;}
		h4,h5,h6{font-size:14pt;}
		p, h2, h3 { orphans: 3; widows: 3; }
		code { font: 12pt Courier, monospace; }
		blockquote { margin: 1.2em; padding: 1em; font-size: 12pt; }
		hr { background-color: #ccc; }
		/* Images */
		img { float: left; margin: 1em 1.5em 1.5em 0; max-width: 100% !important; }
		a img { border: none; }
		/* Links */
		a:link, a:visited { background: transparent; font-weight: 700; text-decoration: underline;color:#333; }
		a:link[href^="http://"]:after, a[href^="http://"]:visited:after { content: " (" attr(href) ")"; font-size: 90%; }
		abbr[title]:after { content: " (" attr(title) ")"; }
		/* Don't show linked images */
		a[href^="http://"] {color:#000; }
		a[href$=".jpg"]:after, a[href$=".jpeg"]:after, a[href$=".gif"]:after, a[href$=".png"]:after {content: " (" attr(href) ") "; display:none; }
		/* Don't show links that are fragment identifiers, or use the `javascript:` pseudo protocol .\
		. taken from html5boilerplate */
		a[href^="#"]:after, a[href^="javascript:"]:after {content: "";}
		/* Table */
		table { /*margin: 1px;*/ text-align:left; }
		th { border-bottom: 2px solid #333; font-weight: bold; }
		td { border-bottom: 1px solid #333; }
		th,td { padding: 4px 10px 4px 0; }
		tfoot { font-style: italic; }
		caption { background: #fff; margin-bottom:2em; text-align:left; }
		thead {display: table-header-group;}
		img,tr {page-break-inside: avoid;}
		/* Hide various parts from the site
		#header, #footer, #navigation, #rightSideBar, #leftSideBar
		{display:none;}
		*/
		</style>
	</head>
	<body>
		<h3 style="text-align: center;">MAJELIS PENDIDIKAN DASAR DAN MENENGAH <br>PIMPINAN DAERAH MUHAMMADIYAH KABUPATEN TEGAL </h3>
		<h1 style="text-align: center;">SMA MUHAMMADIYAH SURADADI
		</h1>
		<h2 style="text-align: center;">(TERAKREDITASI B)</h2>
		<p style="text-align: center;">Alamat : Jalan Raya Suradadi Km.16 Tegal Telepon (0283) 853 271 Kode Pos 52182</p>
		<hr>
		<h1 style="text-align: center;">Laporan Pembayaran</h1>
		<hr>
		<table width="100%">
			<thead>
				<tr>
					<th>No</th>
					<th>No Pembayaran</th>
					<th>Tanggal</th>
					<th>NIS</th>
					<th>Nama</th>
					<th>Operator</th>
					<th>Jenis Pemb.</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1; ?>
				@foreach ($pembayaran as $p)
				<tr>
					<td>{{ $no++ }}</td>
					<td>{{ $p->no_pembayaran }}</td>
					<td>{{ $p->created_at }}</td>
					<td>{{ $p->siswa->nis }}</td>
					<td>{{ $p->siswa->user->name }}</td>
					<td>{{ $p->operator }}</td>
					<td>{{ $p->jenispembayaran->pembayaran }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</body>
</html>