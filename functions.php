<?php


function Draw_matrix($graph, $NbrNodes)
{
	for($i = 0; $i <= $NbrNodes; $i++)
	{
		echo "<tr>";	
		for($j = 0; $j <= $NbrNodes; $j++)
		{
			if($i==0 || $j==0)
			{
				if($i==0 && $j!=0)
					echo "<td align='center'>$j</td>";
				else if($j==0 && $i!=0)
					echo "<td align='center'>$i</td>";
				else
					echo "<td align='center'></td>";
			}
			else
				echo '<td><input type="text" name="edge' . $i,$j .'" value="' . $graph[$i][$j] .'"></td>';
		}
		echo "</tr>";
	}
}


function get_data($NbrNodes, $source, $graph)
{
	$source = (int)$_GET["source"];
	for($i=1; $i<=$NbrNodes; $i++)
	{
		for($j=1; $j<=$NbrNodes; $j++)
		{
			if(isset($_GET["edge$i$j"]))
				$graph[$i][$j] = (int)$_GET["edge$i$j"];
		}
	}
}

//Function returns the next vertex to proccess(the closest one)
function closest_vertex($NbrNodes, $visited, $distance)
{

	$minimum = PHP_INT_MAX;
	for($p=1; $p<=$NbrNodes; $p++)
	{
		if($visited[$p] == False && $distance[$p] < $minimum)
		{
			$node = $p;
			$minimum = $distance[$p];
		}
	}
	if(isset($node))
		return $node;
	else
	{
		for($i=1; $i<=$NbrNodes; $i++)
		{
			if($visited[$i] == false)
				return $i;
		}
	}
}

function draw_iteration($i, $NbrNodes, $distance)
{
	if($i>=0)
	{
		for($k=1; $k<=$NbrNodes; $k++)
		{
			if($i == $NbrNodes - 1)
				echo "<td style='font-weight: bold;'>";
			else
				echo "<td>";
			if($distance[$k] == PHP_INT_MAX)
					echo "INF";
			else
				echo "$distance[$k]";
			echo "</td>";
		}
	}
}
function dijkstra($NbrNodes, $graph, $source)
{
	$visited = new SplFixedArray($NbrNodes + 1);
	$distance = new SplFixedArray($NbrNodes + 1);

	for($i = 1; $i <= $NbrNodes; $i++)
	{
		$distance[$i] = PHP_INT_MAX;
		$visited[$i] = false;
	}
	$distance[$source] = 0;

	// L'ensembes des neouds visités
	$E = array();



	echo "<table>";
	for($i=-1; $i < $NbrNodes; $i++)
	{	
		if($i>=0)
		{
			$node = closest_vertex($NbrNodes, $visited, $distance);
			$visited[$node] = True;
			array_push($E, $node);	
		}
		echo "<tr>";
		for($j=-1; $j<= $NbrNodes; $j++)
		{

			if($i == -1 && $j == -1)
				echo "<td>Etape</td>";
			else if( $i == -1 &&  $j == 0)
				echo "<td>E[]</td>";
			else if ($i == -1)
				echo "<td>D[$j]</td>";
			else if ($j == -1)
				echo "<td>$i</td>";
			else if ($j == 0)
			{
				echo "<td>";
				echo '{ ';
				foreach($E as $k)
					echo "$k ";
				echo '}'; 
				echo "</td>";
			}
			else
			{

				if($graph[$node][$j] != 0 && $visited[$j] == False && $distance[$node] != PHP_INT_MAX && $distance[$node] + $graph[$node][$j] < $distance[$j])
				{
					$distance[$j] = $distance[$node] + $graph[$node][$j];
				}

			}
		}

		draw_iteration($i, $NbrNodes, $distance);
	}
	echo "</table>";

	echo "<br>";
	echo "<label> <b>E : L'ensemble des nœuds visités</b> </label>";
	echo "<label> <b>D[i] : la valeur du chemin le plus court du nœud source au nœud i</b> </label>";

}

function ALL_ZERO($NbrNodes, $graph)
{
	for($i=1; $i<=$NbrNodes; $i++)
	{
		for($j=1; $j<=$NbrNodes; $j++)
		{
			if($graph[$i][$j] != 0)
				return false;
		}
	}

	return true;
}
