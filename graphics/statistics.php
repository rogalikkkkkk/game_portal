<?php

require_once ('../jpgraph-4.4.1/src/jpgraph.php');
require_once ('../jpgraph-4.4.1/src/jpgraph_bar.php');

require_once ('../not_pages/pdo_insert.php');

$stmt = $pdo->prepare('select * from dima_db.statistics');
$stmt->execute();

$res = $stmt->fetchAll();

$datay=array_column($res, 'game_count');

// Create the graph. These two calls are always required
$graph = new Graph(1300,300,'auto');
$graph->SetScale("textlin");

//$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// set major and minor tick positions manually
$graph->yaxis->SetTickPositions(array(0,5,10,15,20,25));
$graph->SetBox(false);

//$graph->ygrid->SetColor('gray');
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels(array_column($res, 'name'));
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Create the bar plots
$b1plot = new BarPlot($datay);

// ...and add it to the graPH
$graph->Add($b1plot);


$b1plot->SetColor("white");
//$b1plot->SetFillGradient("#4B0082","white",GRAD_LEFT_REFLECTION);
$b1plot->SetWidth(45);

// Display the graph
$graph->Stroke();
?>
