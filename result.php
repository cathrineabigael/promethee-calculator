<?php
if (isset($_POST['kriteria']) && isset($_POST['kandidat']) && isset($_POST['q']) && isset($_POST['s'])) {
	$kriteria = $_POST['kriteria'];
	$kandidat = $_POST['kandidat'];
	$q = $_POST['q'];
	$s = $_POST['s'];
} else {
	header("location:index.php");
}

$fungsi_level = array();
foreach ($kriteria as $key => $value) {
	$jumlah_calon = count($value);
	foreach ($value as $key2 => $value2) {
		foreach ($value as $key3 => $value3) {
			if ($key2 != $key3) {
				$hasil = $value2 - $value3;
				if ($hasil < $q) {
					$hasil2 = 0;
				} elseif ($hasil >= $q && $hasil <= $s) {
					$hasil2 = 0.5;
				} elseif ($hasil > $s) {
					$hasil2 = 1;
				}
				$fungsi_level[$key][] = $hasil;
				$fungsi_level[$key][] = $hasil2;
			}
		}
	}
}
$index_preferensi = array();
foreach ($fungsi_level as $key => $value) {
	foreach ($value as $key2 => $value2) {
		if ($key2 % 2 != 0) {
			$jumlah = 0;
			foreach ($fungsi_level as $key3 => $value3) {
				$jumlah = (float)$jumlah + (float)$value3[$key2];
			}

			$hasil = 1 / count($fungsi_level) * $jumlah;

			$index_preferensi[] = $hasil;
		}
	}
	break;
}

$tabel_index_preferensi = array();
$i = 1;
$row = 1;
$j = 0;
foreach ($index_preferensi as $key => $value) {
	if ($row == 1  && $i == 1) {
		$tabel_index_preferensi[$row][] = 0;
	}

	$tabel_index_preferensi[$row][] = $value;

	if ($row != 1 && $i == $j) {
		$tabel_index_preferensi[$row][] = 0;
	}

	$i++;
	if ($i == $jumlah_calon) {
		$i = 1;
		$row++;
		$j++;
	}
}
$tabel_hasil = array();
foreach ($tabel_index_preferensi as $key => $value) {
	$leaving_flow = 0;
	foreach ($value as $key2 => $value2) {
		$leaving_flow = (float)$leaving_flow + (float)$value2;
	}
	$tabel_hasil[$key]['leaving_flow'] = 1 / ($jumlah_calon - 1) * $leaving_flow;
}
$i = 0;
foreach ($tabel_index_preferensi as $key => $value) {
	$entering_flow = 0;
	foreach ($tabel_index_preferensi as $key2 => $value2) {
		$entering_flow = (float)$entering_flow + (float)$value2[$i];
	}
	$i++;
	$tabel_hasil[$key]['entering_flow'] = 1 / ($jumlah_calon - 1) * $entering_flow;
}

$net_flow = array();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="../../js/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
	<link rel="stylesheet" href="style.css">
	<title>Document</title>

</head>

<body>
	<div class="wrapper">
		<section class="a">
			<div class="top-header">
				<header>Promethee Method</header>
				<h3>Level Function</h3>
			</div>
			<div id="1">
				<form action="index.php" method="post">
					<div>
						<h4>Hasil Kalkulasi</h4>
					</div>
					<div class='lengkapi'>
						<?php
						$i = 0;
						echo "<table border='1'>";
						echo "<th>Kandidat</th><th>Leaving Flow</th><th>Entering Flow</th><th>Net Flow</th><th>Keterangan</th>";
						foreach ($tabel_hasil as $key => $value) {
							$hasil = $value['leaving_flow'] - $value['entering_flow'];
							$net_flow[$key] = $hasil;
							echo "<tr>";
							echo "<td>" . $kandidat[$i] . "</td>";
							echo "<td>" . round($tabel_hasil[$i + 1]['leaving_flow'], 3) . "</td>";
							echo "<td>" . round($tabel_hasil[$i + 1]['entering_flow'], 3) . "</td>";
							echo "<td>" . round($hasil, 3) . "</td>";
							$cek = "Diterima";
							if ($hasil < 0) {
								$cek = "Ditolak";
							}
							echo "<td>" . $cek . "</td>";

							echo "</tr>";
							$i++;
						}
						echo "</table>";
						?>
					</div>
					<div class='field button'>
						<button class="secondary" type="submit" id="kembali" name="kembali">Back</button>
					</div>
				</form>
			</div>
		</section>
	</div>
</body>

</html>