<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>

<main id="main">
	<!-- ======= Values Section ======= -->
	
	<section id="values" class="values about">

	  <div class="container" >
	  	<?php if($data['id']=="tasks"):?>
	  		<header class="section-header">
	  		  <h2><?=$task_details->task_name?></h2>
	  		  
	  		</header>
	  			    <div class="row justify-content-center">

	  			      <div class="col-lg-12">
	  			        <div class="box text-start">

	  			          
	  			          	<h3>Student List</h3>
	        	          	
	  			            <form class="col-md-8" style="margin:auto;" action="" method="post" class="js-editForm">
	  			            <div class="mb-3 form-check float-end">
	  			            <label class="form-check-label float-end" for="exampleCheck1">Edit
	  			            	</label>
	  			              <input type="checkbox"  class="form-check-input" onchange='toggleEdit(event)' >
	  			              
	  			            </div>	
	  			            <div class="mb-3">
	  			              <label  class="form-label">Task Name</label>
	  			              <input type="text" name="task_name"  value="<?=setValue('task_name',$task_details->task_name)?>"  class="form-control inputs disable" disabled>
	  			            </div>
	  			            <div class="mb-3">
	  			              <label for="exampleInputEmail1" class="form-label">Task Decription </label>
	  			              <textarea style="padding:0px"type="text" name="task_desc"   class="form-control inputs disable text-start" placeholder="Check out something!"  disabled>
	  			              <?php print(setValue('task_desc',$task_details->task_desc))?>
	  			              </textarea>
	  			            </div>
	  			            <div class="mb-3">
	  			              <label for="exampleInputPassword1" class="form-label">Last Date</label>
	  			              <input type="date" name="task_lastdate" value="<?=setValue('task_lastdate',$task_details->task_lastdate)?>" class="form-control inputs disable" disabled>
	  			            </div>
	  			            <div class="mb-3">
	  			              <label  class="form-label">Time</label>
	  			              <input type="time" name="task_time" value="<?=setValue('task_time',$task_details->task_time)?>" class="form-control inputs disable" disabled>
	  			            </div>
	  			            <div class="mb-3">
	  			              <label  class="form-label">Max Time to finish</label>
	  			              <input type="number" name="task_max_time" value="<?=setValue('task_max_time',$task_details->task_max_time)?>" class="form-control inputs disable" disabled>
	  			            </div>
	  			            
	  			           
	  			            <div class="mb-3 form-check">
	  			              <label class="form-check-label" for=""><?=$task_rep_array[0]==0 ? 'Add Repetation' : 'Change/Remove Repetitive Days'?></label>
	  			              <input type="checkbox" name="repitation"  class="form-check-input inputs disable" id="" onchange='toggler(event)' <?=$task_rep_array[0]>0 ? 'checked' : ''?> disabled>
	  			            </div>
	  			            <div class="mb-3 form-check js-toggle-repitation" style="display:<?=$task_rep_array[0]>0 ? 'block' : 'none'?>;">
	  			              <label class="form-check-label" for="">Select repetition</label>
	  			              <select  name="repetitive[]" class="form-control inputs disable" id="" multiple disabled> 
	  			              	<?php foreach ($days_row as $day):?>
	  			              		 <?php if($task_rep_array[0]>0):?>
	  			              			<option value="<?=$day->id?>" <?=in_array($day->id, explode(",",$task_details->repetitive)) ? 'selected' : ''?>><?=$day->day?></option>
	  			              		<?php else: ?>
	  			              			<option value="<?=$day->id?>"><?=$day->day?></option>
	  			              		
	  			              		<?php endif; ?>
	  			              	<?php endforeach;?>
	  			              </select>
	  			            </div>
	  			            <div class="mb-3 form-check">
	  			              <label class="form-check-label" for=""><?=$task_details->goal_id > 0 ? 'Change/Remove Task for the goal' : 'Add task to your goal'?></label>
	  			              <input type="checkbox" name="goal" class="form-check-input inputs disable" id="" onchange='toggler(event)' <?=$task_details->goal_id>0 ? 'checked' : ''?> disabled>
	  			            </div>
	  			     <!--  <?php show($task_details); ?>  -->
	  			            <div class="mb-3 form-check js-toggle-goal" style="display:<?=$task_details->goal_id >0 ? 'block' : 'none'?>">
	  			              <label class="form-check-label" for="">Select Goal</label>
	  			              <select  name="goals" class="form-control inputs disable" id="" disabled>
  			              			
		              			<?php if(!empty($task_details->user_goal_row)): ?>

		              				<?php foreach($task_details->user_goal_row as $user_goal_row): ?>
		              						<option value="<?=$user_goal_row->goal_id?>" <?=$user_goal_row->goal_id==$task_details->goal_id ? 'selected' : '' ?>> <?=$user_goal_row->goal_name?> </option>
		              				<?php endforeach; ?>
		              			<?php else:  ?>
		              				<option> No Goals </option>
		              			<?php endif; ?>
  			              		
	  			              </select>
	  			            </div>
	  			            
			  			           
	  			       	
	  			              <div class="text-center text-lg-center">
	  			                <button type="submit" class="border-0 btn-read-more align-items-center justify-content-center align-self-center inputs disable-button" name="update" disabled>
	  			                  <span>Update</span>
	  			                  <i class="bi bi-pencil-fill"></i>
	  			                </button>
	  			                 <button type="submit" style='background: red;' 	class="border-0 btn-danger btn-read-more align-items-center justify-content-center align-self-center inputs disable-button" name="delete"disabled>
	  			                  <span><i class="bi bi-trash-fill"></i></span>
	  			                  
	  			                </button>
	  			                
	  			            </div>
	  			          </form>
	  			          
	  			          
	  			        </div>
	  			      </div>
	  			  	</div>
	  	<?php else:?>
		    <header class="section-header pt-5">
		      <h2>Student List</h2>
		      <p style="font-size: 15px; font-weight: 100;">Overall Percentage of completion of your students is  <span style="color:green">76%</span> of your overall project submittion process	</p>
		    </header>
		      <?php if(message()): ?>
		      	<div class="alert alert-danger mt-4 text-center" role="alert">
		      	  <i><?=message('',true)?></i>
		      	</div>
		      <?php endif; ?>

		     <div class="row justify-content-center">

		      <div class="col-lg-12">
		        <div class="box text-center">
		          <table class="table">
		            <thead>
		              <tr>
		                <th scope="col">#</th>
		                <th scope="col" class="text-end" width="40%">Student</th>
		                <!-- <th scope="col" class="text-start">Time</th> -->
		                <th scope="col">Project</th>
		                <th scope="col">Status</th>
		              </tr>
		            </thead>
		            <tbody style="font-size:12px">
		         	<?php if(!empty($task_list)):?>
			            <?php for ($i=0; $i < count($task_list) ; $i++) :?> 
			            
			              <tr>
			                <th scope="row"><?=$i+1?></th>
			                <td class="text-end"><a href="<?=ROOT?>/home/task/<?=$task_list[$i]->task_url?>"><?=$task_list[$i]->task_name?></a></td>
			                <td class="text-start"><?=AMPM($task_list[$i]->task_time)?></td>
			                <td><h5><i class="bi bi-patch-check-fill text-success mx-2  rounded "></i>
			                <i class="bi bi-skip-forward-fill mx-2 text-danger rounded  "></i>
			               <i class="bi bi-arrow-right-circle-fill text-primary mx-2 rounded  "></i></h5>
			                </td>
			              </tr>
			              
			            <?php endfor; ?>
		        	<?php else:?>
		        		<tr>
			                <th>1<td> Abiram S<td> Smart Farming System<td><button style="font-size:12px" class="btn btn-success">70%</button>
			            </tr>
			            <tr>
			                <th>2<td> Sumit R<td> Smart Token<td><button style="font-size:12px" class="btn btn-success">70%</button>
			            </tr>
			            <tr>
			                <th>3<td> Kamlesh K<td> Virtual Labs<td><button style="font-size:12px" class="btn btn-success">90%</button>
			            </tr>
			            <tr>
			                <th>4<td> Ravi S<td>Bike Rental System<td><button style="font-size:12px" class="btn btn-danger">30%</button>
			            </tr>
			            <tr>
			                <th>5<td> Sultan<td> Online Tool Generator<td><button style="font-size:12px" class="btn btn-danger">50%</button>
			            </tr>
			               
			                	
			              
		            <?php endif; ?>
		            </tbody>
		          </table>
		            <div class="text-center text-lg-center my-4">
		             <a href="<?=ROOT?>/addtask"><button type="submit" class="border-0 btn-read-more align-items-center justify-content-center align-self-center">
		                <span>Contact Students!</span>
		                <i class="bi bi-arrow-right"></i>
		              </button>
		          	</a>
		          </div>
		        </div>

		      </div>
		  	</div>
	  <?php endif;?>
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