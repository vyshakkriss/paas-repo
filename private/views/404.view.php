<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>

<main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

      <div class="container">
        <div class="row gx-0 py-5">

          <div class="col-lg-12 d-flex flex-column justify-content-center text-center" >
            <div class="content">
            	<p class="display-1"> 404 </p>
              <h1>Page Not Found</h1>
              
              <div class="text-center text-lg-center">
                <a href="home" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Home!</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
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