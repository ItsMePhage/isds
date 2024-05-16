<?php
$page = "Dashboard";
require_once "includes/conn.php";
require_once "partials/head.php";
?>
<main>
  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="d-flex justify-content-center py-4">
              <a href="dashboard.php" class="logo d-flex align-items-center w-auto">
                <img src="assets/img/logo.png" alt="">
                <span class="d-block"><?= website ?></span>
              </a>
            </div><!-- End Logo -->

            <div class="card mb-3">

              <div class="card-body">

                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                  <p class="text-center small">Enter your personal details to create account</p>
                </div>
                <form class="row g-3 form-validation">
                  <div>
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required />
                  </div>
                  <div>
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required />
                  </div>
                  <div>
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required />
                  </div>
                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="showPassword"
                      onclick="password.type = password.type === 'password' ? 'text' : 'password'">
                    <label class="form-check-label" for="showPassword">show password</label>
                  </div>
                  <div hidden>
                    <input class="captcha-token" name="captcha-token" />
                    <input name="register" />
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <br>
                <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
              </div>
            </div>

            <div class="credits">
              Designed by <a href="#">Phage</a>
            </div>

          </div>
        </div>
      </div>

    </section>

  </div>
</main><!-- End #main -->
<?php
require_once "partials/foot.php";
?>