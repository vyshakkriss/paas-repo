<!-- <?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>

<main id="main">
	<!-- ======= Values Section ======= -->
	
	<section id="values" class="values about">

	  <div class="container" >
	  	
		    <header class="section-header pt-5">
		      
		      <h2> Set Review Date</h2>
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
          	    <label for="exampleInputEmail1" class="form-label">Event Name</label>
          	    <input type="text" name="eventname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Review" value="<?=setValue('eventname')?>">
          	    <div id="emailHelp" class="form-text">Eg: 1st Review</div>
          	  </div>
          	  
          	  <div class="mb-3">
          	    <label for="exampleInputEmail1" class="form-label">Select Date</label>
          	    <input type="date" name="lastdate" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?=setValue('eventdate')?>">
          	    <div id="emailHelp" class="form-text">Eg: 18-03-1998	</div>
          	  </div>
          	  
          	  
          	  <div class="text-center text-lg-center my-4">
	      	   <button type="submit" class="border-0 btn-read-more align-items-center justify-content-center align-self-center">
	      	      <span>Set Date</span>
	      	      <i class="bi bi-arrow-right"></i>
	      	    </button>
	      		
	      	</div>
          	</form>
          	<?php if(!empty($reviewdates)): ?>

          		<table class="table">
          		  <thead>
          		    <tr>
          		      <th scope="col">#</th>
          		      <th scope="col">Event</th>
          		      <th scope="col" >Date</th>
          		      <th scope="col" ></th>
          		    </tr>
          		  </thead>
          		  <tbody style="font-size:14px">
          		  	<?php foreach ($reviewdates as $review): ?>
          		  	<tr>
          		  		<td>1</td>
          		  		<td><?=$review->eventname?></td>
          		  		<td><?=SETDATE($review->lastdate)?></td>	
          		  		<td><i title="Delete" class="bi bi-trash"></td>	
          		  	</tr>
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

<?php $this->view('includes/footer',$data) ?> -->