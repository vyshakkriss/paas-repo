	<?php $this->view('includes/header',$data) ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Docment</title>
</head>
<body><center>
	<h1> Project Document </h1>

<div class="container">
<section>
		<h1><?=$projectdata[0]->projectname?></h1>
		Done by
		<h4><?=$projectdata[0]->student_row->name?></h4>
		<h4><?=$projectdata[0]->student_row->username?></h4>
		<h4><?=$projectdata[0]->student_row->class?></h4>
		<p>Under the Guidance of </p>
		<h2><?=$projectdata[0]->guide_row->prefix?> <?=$projectdata[0]->guide_row->name?></h2>
		<p style="font-size:12px; margin: -5px;">
			<?=$projectdata[0]->guide_row->guidedegree?>
		    <?=$projectdata[0]->guide_row->guidedsg?>
		</p>
</section>

<?php foreach ($projectdata[0]->project_progress_row as $data):?> 
	 
	 <section class="text-left">
	<h2><?=$data->stagename?></h2>
	<p style="text-align:justify;" ><?=$data->stagecontent?></p>
</section>

<?php endforeach; ?>


</div>
</center>
</body>
</html>