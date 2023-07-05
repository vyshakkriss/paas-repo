<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>



<main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

      <div class="container">
        <div class="row gx-0 py-5 justify-content-center text-center ">

          <div class="col-lg-8 d-flex flex-column  text-center" >
            <div class="content ">
            	<p class="display-3 my-2 py-3"> Sign Up </p>

            	<?php if(message() || (count($errors)>0)): ?>
            		<div class="alert alert-danger mt-4" role="alert">
            		  <i><?=message('',true)?></i>
            		  <?php foreach ($errors as $errors):?>
            		  		<i><?=$errors?></i>
            		  <?php endforeach; ?>
            		</div>
            	<?php endif; ?>
              <form method="post" action="">
                <div class="mb-3 py-3 ">
                  <label for="exampleInputEmail1" class="form-label">Fullname</label>
                  <input type="text"  name="name"  placeholder="Enter Your Fullname" value="<?=setValue('name')?>" class="form-control form-input" id="exampleInputEmail1" aria-describedby="emailHelp">
           
                </div>
                <div class="mb-3 py-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                  <input type="text"  name="email" placeholder="Enter Your Email" value="<?=setValue('email')?>" class="form-control form-input" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" name="password" placeholder="Enter a Strong Password" value="<?=setValue('password')?>" class="form-control form-input" id="exampleInputPassword1">
                </div>
                <input   type="hidden" name="check" value="1" > 
                <!-- <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->
                <div class="text-center text-lg-center">
                <button type="submit" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Sign Up</span>
                  <i class="bi bi-arrow-right"></i>
                </button>
              </div>
               
              </form>
              
              
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" >
            <!-- <img src="assets/img/about.jpg" class="img-fluid" alt=""> -->
          </div>

        </div>
      </div>

    </section><!-- End About Section -->

</main>
<?php $this->view('includes/footer',$data) ?>