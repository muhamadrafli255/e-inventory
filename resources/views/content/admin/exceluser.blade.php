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
 header("Content-Disposition: attachment; filename=Laporan-Data-User.xls");
 ?>
 
	<center>
		<h1>{{ $title }}</h1>
	</center>
 
	<table border="1">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Kelas</th>
			<th>No. Telp</th>
			<th>Alamat</th>
		</tr>
        @foreach ($users as $user)
		<tr>
			<td>{{ $loop->iteration }}</td>
			<td>{{ $user->name }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->userClass->class_name }}</td>
            <td>{{ $user->number_phone }}</td>
            <td>{{ $user->address }}</td>
		</tr>
        @endforeach
	</table>
</body>
</html>