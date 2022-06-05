<!DOCTYPE html>
<html>
<head>
	<title>E - Inventaris Laporan User</title>
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
		<h5>Laporan Data User</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
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
		</tbody>
	</table>
 
</body>
</html>