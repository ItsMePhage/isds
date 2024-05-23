<?php
$page = "Forgot Password";
require_once "includes/conn.php";
require_once "partials/head.php";
?>
<main>
  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

          <div class="d-flex justify-content-center py-4">
            <span class="logo d-flex align-items-center w-auto text-center">
              <br>
              <span>
                <img src="assets/img/logo.png" class="fs-2" alt="">
                <img src="assets/img/logo-bp.png" class="fs-2" alt="">
                <br>
                <?= website_name ?>
              </span>
            </span>
          </div><!-- End Logo -->

          <div class="card mb-3">

            <div class="card-body">

              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Forgot Password</h5>
                <p class="text-center small">Enter your email to receive temporary password.</p>
              </div>

              <form class="row g-3 form-validation">
                <div>
                  <label for="username" class="form-label">Email Address</label>
                  <input type="email" class="form-control" id="username" name="username" required />
                </div>
                <span>
                  <a href="login.php" class="float-end btn-link">Return to Login.</a>
                </span>
                <div hidden>
                  <input class="captcha-token" name="captcha-token" />
                  <input name="forgot_password" />
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <p class="small mb-0">
                  Need an account? <a href="register.php">Sign up</a>
                </p>
              </form>


            </div>
          </div>

          <div class="credits">
            Designed by <a href="#">Phage</a>
          </div>

        </div>
      </div>
    </div>

  </section>
</main><!-- End #main -->
<?php
require_once "partials/foot.php";
?>