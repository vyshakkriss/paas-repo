<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>

 <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="assets/img/hero-img.png" class="img-fluid" alt="">
        </div>
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up"><?=APP_TAG?></h1>
          <h2 data-aos="fade-up" data-aos-delay="400"><?=APP_DESC?></h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="login" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Login!</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        
      </div>
    </div>

  </section><!-- End Hero -->

<?php $this->view('includes/footer',$data) ?>