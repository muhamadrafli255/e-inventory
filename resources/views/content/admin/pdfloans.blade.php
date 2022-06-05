<!DOCTYPE html>
<html>
<head>
	<title>E - Inventaris Laporan Peminjaman</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Data Peminjaman</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
                <th scope="col">No</th>
                <th scope="col">Kode Peminjaman</th>
                <th scope="col">Nama Peminjam</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Status Peminjaman</th>
                <th scope="col">Tujuan Peminjaman</th>
                <th scope="col">Tanggal Peminjaman</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $loan->loans_code }}</td>
                <td>{{ $loan->user->name }}</td>
                <td>{{ $loan->goods->name }}</td>
                <td>{{ $loan->statusLoans->name }}</td>
                <td>{{ $loan->purpose }}</td>
                <td>{{ $loan->created_at }}</td>
              </tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>