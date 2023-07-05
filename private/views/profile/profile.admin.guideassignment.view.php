<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>

<main id="main">
	<!-- ======= Values Section ======= -->
	
	<section id="values" class="values about">

	  <div class="container" >
	  	
		    <header class="section-header pt-5">
		      
		      <h2> Guide Assigment</h2>
		    </header>


		      <?php if(message()): ?>
		      	<div class="alert alert-danger mt-4 text-center" role="alert">
		      	  <i><?=message('',true)?></i>
		      	</div>
		      <?php endif; ?>

		     <div class="row justify-content-center">
		     	<div class="col-lg-8">
          	<form method="post" action="">
          		<div class="mb-3">
          		  <label for="exampleInputEmail1" class="form-label">Select Class</label>
          		  <select class="form-select" aria-label="Default select example" name="class">
          		    <option value="II M.Sc Computer Science">II M.Sc Computer Science</option>
          		    <option value="III B.Sc. Computer Science">III B.Sc. Computer Science</option>
          		  </select>
          		</div>

          		<table class="table">
	          	  <thead>
	          	    <tr>
	          	      <th scope="col">#</th>
	          	      <th scope="col">Guide Name </th>
	          	      <th scope="col" >Designation</th>
	          	      <th scope="col" >Students</th>
	          	      <th scope="col"> Total</th>
	          	    </tr>
	          	  </thead>
	          	   <tbody style="font-size:14px">
	          	   	<?php $i=1;?>
          	  		<?php foreach ($guide_row as $guide): ?>
          	  	 	<tr>
          	  	 		<td> <?=$i?></td>
          	  	 		<td> <?=$guide->name?></td>
          	  	 		<td> <?=$guide->guidedsg?></td>
          	  	 		<td> 
          	  	 		<?php
          	  	 			$total_student_count = 0;
          	  	 			if(!empty($guide->student_row))
          	  	 			{
	          	  	 			foreach ($guide->student_row as $students) {
	          	  	 				// code...
	          	  	 				echo "<a href=".ROOT."/studentupload/".$students->username. ">".$students->username."</a> " ;
	          	  	 				$total_student_count++;
	          	  	 			}
          	  	 			}
          	  	 			else
          	  	 				echo "No Students Assigned";
          	  	 		?>
          	  	 		</td>
          	  	 		<td><?=$total_student_count?></td>
          	  	 	</tr>
          	 		<?php $i++; ?>
          	 		<?php endforeach; ?>
          	  </tbody>
          	</table>
          	  
          	  <div class="text-center text-lg-center my-4">
	      	   <button type="submit" class="border-0 btn-read-more align-items-center justify-content-center align-self-center">
	      	      <span>Assign Guide</span>
	      	      <i class="bi bi-arrow-right"></i>
	      	    </button>
	      		
	      	</div>
          	</form>
          	
          	<?php if(!empty($non_assigned)): ?>
          	<table class="table">
	          	  <thead>
	          	    <tr>
	          	      <th scope="col">#</th>
	          	      <th scope="col">Class </th>
	          	      <th scope="col" >No. of students</th>
	          	    </tr>
	          	  </thead>
	          	   <tbody style="font-size:14px">
	          	   	
	          	   	<?php $i=1;?>
          	  		<?php foreach ($non_assigned as $nonassigned): ?>
          	  	 	<tr>
          	  	 		<td> <?=$i?></td>
          	  	 		<td> <?=$nonassigned->class?></td>
          	  	 		
          	  	 		<td><?=count($non_assigned)?> </td>
          	  	 	</tr>
          	 		<?php $i++; ?>
          	 		<?php endforeach; ?>

          	  </tbody>
          	</table>
          	<?php endif; ?>
        </div>
		  	</div>
		 
	
	  </div>

	</section><!-- End Values Section -->


</main>
<script type="text/javascript">
	
function toggleEdit(e)
{
	var form = e.currentTarget.form;
	var inputs = form.querySelectorAll('.inputs');
	//console.log("toggle Function");
	for (var i = 0; i < inputs.length; i++)
	{
		//console.log(inputs[i]);
		if(inputs[i].disabled==true)
		{
			inputs[i].disabled=false;
			inputs[i].classList.remove('disable');
			inputs[i].classList.remove('disable-button');
			
		}
		else
		{
			inputs[i].disabled=true;
			inputs[i].classList.add('disable');
			inputs[i].classList.add('disable-button');
			
		}
	}

}

	
function toggler(e)
{
	var target = e.currentTarget.name;
	var display = document.querySelector('.js-toggle-'+target).style.display;
	if(display=='none')
	{
		document.querySelector('.js-toggle-'+target).style.display="block";
		document.querySelector('.js-toggle-'+target).children[1].disabled = false;
		e.currentTarget.checked = true;
	}
	else
	{
		document.querySelector('.js-toggle-'+target).style.display="none";
		document.querySelector('.js-toggle-'+target).children[1].disabled = true;
		e.currentTarget.checked = false;
	}
	//console.log("hello");
}

</script>	

<?php $this->view('includes/footer',$data) ?>