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
		      		
		      			<h2><?=$student_row[0]->username?></h2>
		      			<h3><?=$student_row[0]->class?></h3>
		 
		      	<?php endif; ?>
		      		
		      <?php endif; ?>

		      <!-- < Student Module Starts Here-->
		      <?php if(!empty($project_progress_row) && Auth::getUser('role')<3): ?>
		      		<h3>Project Details</h3>
			      <h2><?=$project_progress_row[0]->project_row->projectname?></h2>
			      Done by
			      <h5>
			      	<?=$student_row[0]->username?>	
			      
			      </h5>
			      <span>Under the Guideance of </span>

			      <h5>
			      	<?=$project_progress_row[0]->guide_row->prefix?>	
			      	<?=$project_progress_row[0]->guide_row->name?>
			      </h5>
			      <h6>
			      	<?=$project_progress_row[0]->guide_row->guidedegree?>
			      	<?=$project_progress_row[0]->guide_row->guidedsg?>
			      		
			      </h6	>
			      <p style="font-size: 15px; font-weight: 100;">Student has completed
			      	
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
		   of their overall project submittion process	</p>

		   		<?php elseif(!empty($guide_row) && Auth::getUser('role')<3): ?>
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

		   	<?php if(empty($project_row) && !empty($student_row) && Auth::getUser('role')<3): ?>
		   		<br>
		   		<button class="btn btn-danger btn-lg" >No Project Uploaded!</button>

		   		  <div class="text-center text-lg-center my-4">
		   		   
		   		      <span>Contact Student</span>
		   		      <i class="bi bi-arrow-right"></i>
		   		  
		   			
		   		</div>

				<?php endif; ?>
		    </header>
	

		     <div class="row justify-content-center">
		     <?php if(!empty($project_progress_row) && Auth::getUser('role')<3):?>
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
		             <a href="<?=ROOT?>/studentupload/<?=$student_row[0]->username?>"><button type="submit" class="border-0 btn-read-more align-items-center justify-content-center align-self-center">
		                <span>View Uploaded Documents</span>
		                <i class="bi bi-arrow-right"></i>
		              </button>
		          	</a>
		          </div>
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