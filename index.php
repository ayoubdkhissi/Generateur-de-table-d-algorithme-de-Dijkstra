<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Générateur de table d'algorithme de Dijkstra</title>
	<link rel="icon" href="icon.png" type="image/ico">
	<link rel="stylesheet" type="text/css" href="style.css?version=10">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>

	<?php
	require "init_variables.php"; 
	require "functions.php";
	?>

	<header>
		<h1 class="logo">Generateur de serie de fourier</h1>
		<ul>
			<li><a href="./index.php">home</a></li>
			<li><a href="">report bug</a></li>
		</ul>
	</header>
	<main>
	<div>
		<form method="get">
			<div>
				<label>Number of nodes :</label>
				<input type="number" name="NbrNodes" min = "1" width="3" value= "<?php echo $NbrNodes ?>" ?>
				<button name="Resize">Resize</button>
			</div>

			<div>
				<h5>Enter the adjacency Matrix:</h5>

				<table>
				<?php
					Draw_matrix($graph, $NbrNodes);
				?>
				</table>
			</div>

			<div>
				<label>Source Node :</label>
				<input type="number" name="source" value="<?php echo $source ?>" min="1" max="<?php echo $NbrNodes ?>">
			</div>

			<button name="generer" type="submit">Generate</button>
		</form>

	</div>

	<div class="generated">
		<?php
		if(isset($_GET["generer"]) &&  isset($_GET['source']))
		{
			get_data($NbrNodes, $source, $graph);
			dijkstra($NbrNodes, $graph, (int)$source);
		}
		?>
	</div>
	</main>

	<footer>
		<p>Created by ayoub</p>
	</footer>

</body>



</html>