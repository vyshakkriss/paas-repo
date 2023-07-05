<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>

<main id="main">
	<!-- ======= Values Section ======= -->
	
	<section id="values" class="values about">

	  <div class="container" >
	  	
		    <header class="section-header pt-5">
		      
		      <!-- < Admin and Guide Module Starts Here-->

		      <?php if(Auth::getUser('role') < 3): ?>
		      	<?php if(!empty($student_row)): ?>
		      		<h2> Student Details </h2>
		      			
		      	<?php else: ?>
		      		<h3> You have not been assigned to any student. Contact Admin! </h3>
		      	<?php endif; ?>
		      		
		      <?php endif; ?>

		      <!-- < Student Module Starts Here-->
		      <?php if(!empty($project_progress_row) && Auth::getUser('role')==3): ?>
		      		<h3>Your Project</h3>
			      <h2><?=$project_progress_row[0]->project_row->projectname?></h2>
			      <span>Under the Guideance of </span>
			      <h4>
			      	<?=$project_progress_row[0]->guide_row->prefix?>	
			      	<?=$project_progress_row[0]->guide_row->name?>
			      	<p style="font-size:12px; margin: -5px;">
			      	<?=$project_progress_row[0]->guide_row->guidedegree?>
			      	</p><p><?=$project_progress_row[0]->guide_row->guidedsg?>
			      	</p>	
			      </h4>
			      <p style="font-size: 15px; font-weight: 100;">You have completed
			      	
			      	<?php // Snippet to change the color of the progress percentage

			      		$progress = floor((($project_row[0]->stage)*100)/$project_progress_row[0]->project_row->section);
			      		if($progress <= 30)
			      			$color = 'red';
			      		elseif ($progress <= 60)
			      			$color = 'orange';
			      		elseif ($progress < 90) 
			      			$color = 'green';
			      		else
			      			$color = 'darkgreen';
			      	?>  

			       <span style="color:<?=$color?>"><?=$progress?>%</span> 
		   of your overall project submittion process	</p>

		   		<?php elseif(!empty($guide_row) && Auth::getUser('role')==3): ?>
					<h3>Project Guide Details</h3>
					
					<?=$guide_row[0]->prefix?>	
					<?=$guide_row[0]->name?>
					<p style="font-size:12px; margin: -5px;">
					<?=$guide_row[0]->guidedegree?>
					<br><?=$guide_row[0]->guidedsg?>
					</p>	
					</h4>
				<?php elseif(Auth::getUser('role')==3): ?>
					<h3>You have not been assigned a guide yet. Contact your administrator.</h3>
			<?php endif; ?>

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
		     <?php if(!empty($project_progress_row) && Auth::getUser('role')==3):?>
		      <div class="col-lg-12">
		        <div class="box text-center">
			          <table class="table">
			            <thead>
			              <tr>
			                <th scope="col">#</th>
			                <th scope="col">Date</th>
			                <th scope="col" >Task Name</th>
			                <th scope="col" >Remarks</th>
			                <!-- <th scope="col" class="text-start">Time</th> -->
			                <th scope="col">Progress</th>
			              </tr>
			            </thead>
			            <tbody style="font-size:14px">
		         	<?php if(!empty($project_progress_row)):?>
			            <?php for ($i=0; $i < count($project_progress_row) ; $i++) :?> 
			            
			              <tr>
			                <th scope="row"><?=$i+1?></th>
			                <th scope="row"><?=SETDATE($project_progress_row[$i]->date)?></th>
			                <td scope="row"><?=$project_progress_row[$i]->stagename?></a></td>
			                <td scope="row"><?=$project_progress_row[$i]->remark?></a></td>
			                <?php $status = $project_progress_row[$i]->status; ?>
			             	<td style="font-size:15px"><?=$status == 0 ? '<i title="Pending..." class="bi bi-hourglass-split"></i>' : '<i title="Completed"class="bi bi-check-circle-fill "></i>'?> </td>

			              </tr>
			             
			           	<?php endfor; ?>	
		        		
		            <?php endif; ?>
		            </tbody>
		          </table>
		            <div class="text-center text-lg-center my-4">
		             <a href="<?=ROOT?>/projectupload"><button type="submit" class="border-0 btn-read-more align-items-center justify-content-center align-self-center">
		                <span>Upload Pending Works</span>
		                <i class="bi bi-arrow-right"></i>
		              </button>
		          	</a>
		          </div>
		        </div>

		      </div>
		      <?php endif; ?>

		      <!-- Guide and Admin Section  -->
		      <?php if(Auth::getUser('role') < 3 && !empty($student_row)): ?>
	      		<div class="col-lg-12">
	      		  <div class="box text-center">
	      		    <table class="table">
	      		      <thead>
	      		        <tr>
	      		          <th scope="col">#</th>
	      		          <th scope="col">Student</th>
	      		          <th scope="col" >Project</th>
	      		          <!-- <th scope="col" class="text-start">Time</th> -->
	      		          <th scope="col">Progress</th>
	      		        </tr>
	      		      </thead>
	      		      <tbody style="font-size:14px">
	      		      	<?php $i=0; ?>
	      		      	<?php foreach ($student_row as $students): ?>

	      		      		<tr>
	      		      			<td><?=$i+1?></td></td>
	      		      			<td><a href="<?=ROOT?>/studentupload/<?=$students->username?>/stats"><?=$students->username?></a>-<span style="font-size: 10px"><?=$students->class?></span></td>
	      		      			<td>
	      		      			
	      		      				<?=!empty($students->project_row[0]) ? $students->project_row[0]->projectname : 'No Project Uploaded'?></td>
	      		      			<td><?=!empty($students->project_row[0]) ? floor((($students->project_row[0]->stage*100)/$students->project_row[0]->section)).'%': 'Contact Student'?></td>
	      		      		</tr>
	      		      		<?php $i++; ?>
	      		      	<?php endforeach; ?>
	      		      </tbody>
	      		  </table>
	      		 </div>
	      		</div>
	     

		      <?php endif; ?>
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