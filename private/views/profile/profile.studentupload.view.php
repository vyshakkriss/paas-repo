	<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>

<main id="main">
	<!-- ======= Values Section ======= -->
	
	<section id="values" class="values about">

	  <div class="container" >
	  	
		    <header class="section-header pt-5">
		      
		      <!-- < Admin and Guide Module Starts Here-->

		      		<h2> <?=$student_row[0]->name?> </h2>
		      		<h3> <?=$student_row[0]->username?> </h3>
		      		<h3> <?=$student_row[0]->class?> </h3>
		      		
		      			
		      	
		      		
		     
			      	
			      	<?php // Snippet to change the color of the progress percentage
			      	if(!empty($project_row))
			      	{
			      		$progress = floor((($project_row[0]->stage)*100)/$project_row[0]->section);
			      		if($progress <= 30){
			      			$color = 'red';
			      		}
			      		elseif ($progress <= 60){
			      			$color = 'orange';
			      		}
			      		elseif ($progress < 90) {
			      			$color = 'green';
			      		}
			      		else{
			      			$color = 'darkgreen';
			      		}
			      	}	
			      	?>		      	 
			      	<br>
			       The Student has completed <span style="color:<?=$color?>"><?=!empty($project_row) ? $progress : "0"?>%</span> 
		   of the overall project submittion process	</p>

		   		

		   	<?php if(empty($project_row) && !empty($guide_row) && Auth::getUser('role')==3): ?>
		   		<br>
		   		<span style="color:red;">No Project Uploaded!</span>
		   		  <div class="text-center text-lg-center my-4">
		   		   <a href="<?=ROOT?>/projectupload/abstract"><button type="submit" class="border-0 btn-read-more align-items-center justify-content-center align-self-center">
		   		      <span>Upload Abtract!</span>
		   		      <i class="bi bi-arrow-right"></i>
		   		    </button>
		   			</a>
		   		</div>

				<?php endif; ?>
		    </header>


		      <?php if(message()): ?>
		      	<div class="alert alert-danger mt-4 text-center" role="alert">
		      	  <i><?=message('',true)?></i>
		      	</div>
		      <?php endif; ?>

		     <div class="row justify-content-center">
		     
		      
		        <div class="col-lg-10">
          <div class="box text-center">
          	<?php if(!empty($project_row)) : ?>
          	
          	<table class="table">
          	  <thead>
          	    <tr>
          	     
          	      <th scope="col">Project Topic </th>
          	      <th scope="col" >Status</th>
          	      <th scope="col" >View File</th>
          	    </tr>
          	  </thead>
          	  <tbody style="font-size:14px">

          	  	<?php foreach ($stage_row as $stage): ?>
  				<tr>
  				
  						<td><?=$stage->stagename; ?></td>
  						<td>
  							<?php if(!empty($stage->project_progress_row) && $stage->stageid <= $stage->project_row->stage):	  ?> 
  								<?php if($stage->stageid == $stage->project_row->stage ):?>
		  							<button class="btn btn-success rounded-circle">
		  								<i class="bi bi-cloud-plus-fill"></i>
		  							</button>
		  						<?php else: ?>
		  							<button class="btn btn-success rounded-circle">
  										<i class="bi bi-patch-check-fill"></i>
  									</button>	
  								<?php endif; ?>	
  							<?php else: ?>
  								
	  								<button class="btn btn-danger rounded-circle">
	  								<i class="bi bi-x-circle-fill"></i>
	  							</button>
	  					
  							<?php endif; ?>	
  						</td>
  						<td>
  							<?php if(!empty($stage->project_progress_row) && $stage->stageid <= $stage->project_row->stage): ?> 
  								<?php $stageurl = $stage->stageurl; ?>
								<?php if($stage->stageid <= $stage->project_progress_row->stage)	:?>
          	  										
									<a href="<?=ROOT?>/document/<?=$stage->project_row->uid?>/<?=$stage->stageurl?>/<?=$stage->stageid?>">View <?=$stage->stagename?></a>
							
									<?php else:?>
										<?php if($stage->project_row->stage != 6):?>
											<?=$stage->stagename?> not Uploaded
										<?php else: ?>
											<a href="<?=ROOT?>/document/<?=$stage->project_row->uid?>/fulldocument">View Document</a>
										<?php endif; ?>
								<?php endif; ?>
							<?php else: ?>
								---
								<?php endif; ?>
  							
  							
  							
  						</td>
  				</tr>
          	  	<?php endforeach; ?>
          	  </tbody>
          	</table>
          <?php endif; ?>
          </div>
         </div>

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