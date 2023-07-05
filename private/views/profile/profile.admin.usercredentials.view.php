<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>

<main id="main">
	<!-- ======= Values Section ======= -->
	
	<section id="values" class="values about">

	  <div class="container" >
	  	
		    <header class="section-header pt-5">
		      
		      <h2> Student User Credential Generator</h2>
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
          	    <label for="exampleInputEmail1" class="form-label">Prefix</label>
          	    <input type="number" name="prefix" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?=setValue('prefix')?>">
          	    <div id="emailHelp" class="form-text">Eg: 21, 411, 112</div>
          	  </div>
          	  <div class="mb-3">
          	    <label for="exampleInputEmail1" class="form-label">Middle Term</label>
          	    <input type="number" name="middle" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?=setValue('middle')?>">
          	    <div id="emailHelp" class="form-text">Eg: 2020, 2030, 3030</div>
          	  </div>
          	  <div class="mb-3">
          	    <label for="exampleInputEmail1" class="form-label">Max Value</label>
          	    <input type="number" name="maxvalue" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?=setValue('maxvalue')?>">
          	    <div id="emailHelp" class="form-text">Eg: To get 10 credential, set max value = 10</div>
          	  </div>
          	  <div class="mb-3">
          	    <label for="exampleInputEmail1" class="form-label">Select Class</label>
          	    <select class="form-select" aria-label="Default select example" name="class">
          	      
          	      <option value="II M.Sc Computer Science">II M.Sc Computer Science</option>
          	      <option value="III B.Sc. Computer Science">III B.Sc. Computer Science</option>
          	    </select>
          	  </div>
          	  
          	  <div class="text-center text-lg-center my-4">
	      	   <button type="submit" class="border-0 btn-read-more align-items-center justify-content-center align-self-center">
	      	      <span>Generate</span>
	      	      <i class="bi bi-arrow-right"></i>
	      	    </button>
	      		
	      	</div>
          	</form>
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