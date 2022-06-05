<html>
<head>
	<title>{{ $title }}</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
 
	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>
 
 <?php
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=Laporan-Data-Peminjaman.xls");
 ?>
 
	<center>
		<h1>{{ $title }}</h1>
	</center>
 
	<table border="1">
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
	</table>
</body>
</html>