	<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>

<main id="main">
	<!-- ======= Values Section ======= -->
	<section id="about" class="about">
	
	  <div class="container" >
			<header class="section-header py-3">
				<h2>Objective Upload</h2>
	    </header>

      <?php if(message() || (count($errors)>0)): ?>
      	<div class="alert alert-danger mt-4 text-center" role="alert">
      	  <i><?=message('',true)?></i>
      	  <?php foreach ($errors as $errors):?>
      	  		<i><?=$errors?></i><br>
      	  <?php endforeach; ?>
      	</div>
      <?php endif; ?>

      <div class="row justify-content-center">
        <div class="col-lg-8">
          	<form method="post" action="<?=ROOT?>/document/objective">
          	 
          	  <div class="mb-3">
          	    <label for="exampleFormControlTextarea1" class="form-label">Objective</label>

          	    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder = 'You can either type or copy the abtract from your file' name="objective" rows="5"><?=setValue('objective')?></textarea>
          	    <div id="emailHelp" class="form-text">The Objective should be between 50-500 words</div>
          	  </div>
          	  
          	  <div class="text-center text-lg-center my-4">
	      	   <button type="submit" class="border-0 btn-read-more align-items-center justify-content-center align-self-center">
	      	      <span>Upload for Review</span>
	      	      <i class="bi bi-arrow-right"></i>
	      	    </button>
	      		
	      	</div>
          	</form>
        </div>
      </div>
	         
	  </div>

	 </section>    	
</main>

	

<?php $this->view('includes/footer',$data) ?>