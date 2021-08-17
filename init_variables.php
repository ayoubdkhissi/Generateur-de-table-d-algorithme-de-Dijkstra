<?php

// Initialize number of nodes to 3 if not set
if(isset($_GET["NbrNodes"]))
{
	$NbrNodes = (int)$_GET["NbrNodes"];
}
else
	$NbrNodes = 3;



if(isset($_GET["source"]))
	$source = $_GET["source"];
else
	$source = 1;


// Intitialize edges to 0
for($i=1; $i<=$NbrNodes; $i++)
{
	for($j=1; $j<=$NbrNodes; $j++)
	{
		if(isset($_GET["edge$i$j"]))
			$graph[$i][$j] = (int)$_GET["edge$i$j"];
		else	
		 	$graph[$i][$j] = 0;
	}
}


