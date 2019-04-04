<!DOCTYPE html>
<html>
<head>
	<title>Submission Pertama</title>
</head>
<body>
	<form action="" method="POST">
		Nama Kategori <input type="text" name="nama" required>
		<input type="submit" name="submit" value="Submit" /> <input type="submit" name="ambi_data" value="Keluarkan Data" />
	</form>
	<?php
		$host = "kelvinwebappserver.database.windows.net";
		$user = "kelvinsentosa";
		$pass = "ksbbS2411";
		$db = "submissionwebapp";

		try {
			$conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		} catch (Exception $e) {
			 echo "Failed: " . $e;
		}

		if (isset($_POST['submit'])) {
			try {
				$nama = $_POST['nama'];
				$sql_insert = "INSERT INTO Kategori (nama_kategori) VALUES (?)";
				$stmt = $conn->prepare($sql_insert);
				$stmt->bindValue(1,$nama);
				$stmt->execute();
			} catch (Exception $e) {
				echo "Failed";
			}
		}elseif (isset($_POST['ambil_data'])) {
			try {
				$sql_select = "SELECT * FROM Kategori";
				$stmt = $conn->query($sql_select);
				$kategori = $stmt->fetchAll();
				if (count($kategori) > 0) {
					echo "<table border='1'>";
					foreach ($kategori as $data) {
						echo "<tr>";
						echo "<td>".$data['id_kategori']."</td>";
						echo "<td>".$data['nama_kategori']."</td>";
						echo "</tr>";
					}
					echo "</table>";
				}else{
					echo "No Data Available";
				}
			} catch (Exception $e) {
				echo "Failed";
			}
		}
	?>
</body>
</html>