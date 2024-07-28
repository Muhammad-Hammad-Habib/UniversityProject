<?php include('config/config.php'); ?>

<?php
    if (isset($_SESSION['user'])) {
        $query = $db->query('SELECT * FROM users WHERE id = "'.$_SESSION['user'].'"');
        $user = $query->fetch_assoc();
    }
?>

<?php include('layout/header.php'); ?>
<?php include('layout/navbar.php'); ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex justify-cntent-center align-items-center">
    <div id="heroCarousel" class="container carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown"> <u>Welcome to Professional  community </u></span></h2>
          <p class="animate__animated animate__fadeInUp">The right place to make Perfect</p>
          <!-- <a href="" class="btn-get-started animate__animated animate__fadeInUp">Read More</a> -->
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown"> <u>Life is not about finding yourself,</u></h2>
          <p class="animate__animated animate__fadeInUp">It's about creating yourself</p>
          <!-- <a href="" class="btn-get-started animate__animated animate__fadeInUp">Read More</a> -->
        </div>
      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Services Section ======= -->
    <section class="services">
      <div class="container">

        <!-- <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="fade-up">
            <div class="icon-box icon-box-pink">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4 class="title"><a href="">Lorem Ipsum</a></h4>
              <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box icon-box-cyan">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
              <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box icon-box-green">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4 class="title"><a href="">Magni Dolores</a></h4>
              <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box icon-box-blue">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Nemo Enim</a></h4>
              <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
            </div>
          </div>

        </div> -->

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Why Us Section ======= -->
    <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200" class="row" >
      <div class="container">

        <div class="row" >
          <div class="col-lg-6 video-box">
            <img src="public/img/292yd0en6qdvkbezeuj71yu4y.jpeg" class="img-fluid" alt="">
            <!-- <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a> -->
          </div>

          <div class="col-lg-6 d-flex flex-column justify-content-center p-5">

            <div class="icon-box">
              <!-- <div class="icon"><i class="bx bx-fingerprint"></i></div> -->
              <h4 class="title"><a href="">WHO IS FUTURE BUILD FOR?</a></h4>
              <p class="description">Anyone looking to navigate their professional life.</p>
            </div>

            <div class="icon-box">
              <!-- <div class="icon"><i class="bx bx-gift"></i></div> -->
              <h4 class="title"><a href="">Connect with people</a></h4>
              <p class="description">Connect with people</p>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Features Section ======= -->
    <section class="features" id="about">
      <div class="container">

        <div class="section-title">
          <h2>Features</h2>
          <p>The online profile generator is to provide a platform for individuals to create a professional and attractive online presence that share their skills, experiences, and qualifications.</p>
        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-md-5">
            <img src="public/img/Screenshot_2023.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 pt-4">
            <h3>To Increase The Chances of Making a Good Impression.</h3>
            <p class="fst-italic">
            An online profile generator can vary depending on the specific tool or platform. However, some possible areas of focus for an online profile generator 
            </p>
            <ul>
              <li><i class="bi bi-check"></i>Have Some Good Impression First.</li>
              <li><i class="bi bi-check"></i>First Have Some Introduction.</li>
            </ul>
          </div>
        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-md-5 order-1 order-md-2">
            <img src="public/img/Screenshot_2023.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 pt-5 order-2 order-md-1">
            <h3>Show Some Achievement Here.</h3>
            <p class="fst-italic">
            A portfolio is a collection of investments that enhance profile. Here shows your done project and work as potential.  
            </p>
            <ul>
              <li><i class="bi bi-check"></i>Make yourself attractive most.</li>
              <li><i class="bi bi-check"></i>The talent shows struggle.</li>
            </ul>
          </div>
        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-md-5">
            <img src="public/img/Screenshot_2023.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 pt-5">
            <h3>That Make Me the Right Candidate for the Job.</h3>
            <p>Have you a strong education, experience and certification that make you qualified for  position.</p>
            <ul>
              <li><i class="bi bi-check"></i>Make some Good Impression with it.</li>
              <li><i class="bi bi-check"></i>done Some work.</li>
            </ul>
          </div>
        </div>



      </div>
    </section><!-- End Features Section -->

  </main><!-- End #main -->

<?php include('layout/footer.php'); ?>