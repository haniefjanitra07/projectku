<?php 
include "connection.php";
$sql = $connect->query("SELECT * FROM murid ORDER BY nama ASC;");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <title>Read Data</title>
    <style type="text/css">
      	body {
        	font-family: 'Roboto', sans-serif;
      	}
    </style>
  </head>
  <body>
	<div class="container mt-4">
		<div class="row justify-content-center">
			<div class="col-6">
        		<table class="table table-bordered table-striped table-hover">
					<tr>
						<th class="bg-dark text-white">No</th>
						<th class="bg-dark text-white">Nama</th>
					</tr>
					<?php if ($sql->num_rows > 0): ?>
						<?php $i = 1 ?>
						<?php while ($row = $sql->fetch_assoc()) { ?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $row["nama"] ?></td>
							</tr>
							<?php $i++ ?>
						<?php } ?>
					<?php else: ?>
						<tr>
							<td colspan="2">
								Tidak Ada Data Murid Di Dalam Database MQ.
							</td>
						</tr>
					<?php endif ?>
				</table>
			</div>
		</div>
	</div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
  </body>
</html>
<?php $connect->close(); ?>