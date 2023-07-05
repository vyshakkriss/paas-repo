<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>

<main id="main">
	
	
	<section id="values" class="values about">

	  <div class="container" >
	  	
		    <header class="section-header pt-5">
		      
		      <h2> <?=$id?></h2>
		    </header>


		      <?php if(message()): ?>
		      	<div class="alert alert-danger mt-4 text-center" role="alert">
		      	  <i><?=message('',true)?></i>
		      	</div>
		      <?php endif; ?>

		     <div class="row justify-content-center">
		     	<div class="col-lg-8">
          			<form method="post" action="">
          				<?php $id = lcfirst($id);?>
          	  			<div class="mb-3">
          	  			  <label for="exampleFormControlTextarea1" class="form-label"><?=ucfirst($id)?></label>

          	  			  <textarea class="form-control" id="exampleFormControlTextarea1" placeholder = 'You can either type or copy the <?=$id?> from your file' name=<?=$id?> rows="10"><?=!empty($viewdata->stagecontent) ? $viewdata->stagecontent : ""?></textarea>
          	  			  <div id="emailHelp" class="form-text">The description should be between 50-500 words</div>
          	  			</div>
          	  			<div class="text-center text-lg-center my-4">
          	  				<?php 
          	  					
	      	 			  		$button_type = "submit";
	      	 			  		$button_value = "Submit";
	      	 			  		$status;
	      	 			  		if(!isset($viewdata->status))
	      	 			  		{
	      	 			 			$status = -3;
	      	 			  		}
	      	 			  		else
	      	 			  			$status = $viewdata->status;
	      	 			  		 

	      	 			  		if(Auth::getUser('role') != 3)
	      	 			  		{
	      	 			  			$button_type = "submit";
	      	 			  			if($status == 0)
	      	 			  			{
	      	 			  				$button_value = "Approve";
	      	 			  				$button_type = "submit";
	      	 			  			}
	      	 			  			else if($status == -2)
	      	 			  			{
	      	 			  				$button_type = "button";
	      	 			  				$button_value = "Awaiting corrected";
	      	 			  			}
	      	 			  			else
	      	 			  			{
	      	 			  				$button_type = "button";
	      	 			  				$button_value = "Approved";
	      	 			  			}
	      	 			  			//$button_value = "Submit for review";
	      	 			  		}
	      	 			  		else
	      	 			  		{
	      	 			  			
	      	 			  			if($status == 0)
	      	 			  			{
	      	 			  				$button_value = "Awaiting review";
	      	 			  				$button_type = "button";
	      	 			  			}
	      	 			  			else if($status == -2)
	      	 			  			{
	      	 			  				$button_type = "submit";
	      	 			  				$button_value = "Re-Submit for review";
	      	 			  			}
	      	 			  			else if($status == 1)
	      	 			  			{
	      	 			  				$button_type = "button";
	      	 			  				$button_value = "Approved";
	      	 			  			}
	      	 			  			else
	      	 			  			{
	      	 			  				$button_type = "submit";
	      	 			  				$button_value = "Submit for review";
	      	 			  			}
	      	 			  		}
	      	 			  		
	      	 			  	?>
	      	 			  <button type="<?=$button_type?>" class="border-0 btn-read-more align-items-center justify-content-center align-self-center">
	      	 			  	
	      	      			<span><?=$button_value?></span>
	      	      			<i class="bi bi-arrow-right"></i>
	      	    			</button>
	      		
	      				</div>
          			</form>
          			<?php if(Auth::getUser('role')!=3 && $status !=1): ?>
          			<form action="" method="post">
          				<div class="mb-3">
          	  			  <label for="exampleFormControlTextarea1" class="form-label">Add Remarks</label>

          	  			  <textarea class="form-control" id="exampleFormControlTextarea1" placeholder = 'Add  remarks such as :- Need more content about the uses of the project.' name="remarks" rows="5"></textarea>
          	  			  
          	  			</div>
          	  			<div class="text-center text-lg-center my-4">
	      	 			  <button name="remark" value='Send Remarks' type="submit" class="border-0 btn-read-more align-items-center justify-content-center align-self-center">
	      	      			<span>Send Remarks</span>
	      	      			<i class="bi bi-arrow-right"></i>
	      	    			</button>
	      		
	      				</div>
          			</form>
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

<?php $this->view('includes/footer',$data) ?> -->