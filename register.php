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
          <div class="col-lg-8 col-md-10 d-flex flex-column align-items-center justify-content-center">

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
                  <div class="col-lg-12">
                    <label for="id_number" class="form-label">ID Number</label>
                    <input type="text" class="form-control" id="id_number" name="id_number" />
                  </div>
                  <div class="col-lg-4">
                    <label for="first_name" class="form-label">First Name<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required />
                  </div>
                  <div class="col-lg-4">
                    <label for="middle_name" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" />
                  </div>
                  <div class="col-lg-4">
                    <label for="last_name" class="form-label">Last Name<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required />
                  </div>
                  <div class="col-lg-6">
                    <label for="date_birth" class="form-label">Date of Birth<span class="text-danger"> *</span></label>
                    <input type="date" class="form-control" id="date_birth" name="date_birth" required />
                  </div>
                  <div class="col-lg-6">
                    <label for="sex" class="form-label">Sex<span class="text-danger"> *</span></label>
                    <select class="form-select" id="sex" name="sex" required>
                      <option value="" selected disabled>choose...</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="1" id="is_pwd" name="is_pwd">
                      <label class="form-check-label" for="is_pwd">
                        Person with disability
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" />
                  </div>
                  <div class="col-lg-6">
                    <label for="email" class="form-label">Email<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" id="email" name="email" required />
                  </div>
                  <div class="col-lg-12">
                    <label for="address" class="form-label">Address</label>
                    <textarea type="text" class="form-control" id="address" name="address"></textarea>
                  </div>
                  <div class="col-lg-12">
                    <label for="designation" class="form-label">designation</label>
                    <input type="text" class="form-control" id="designation" name="designation" />
                  </div>
                  <div class="col-lg-6">
                    <label for="offices_id" class="form-label">Office<span class="text-danger"> *</span></label>
                    <select class="form-select select-init" id="offices_id" name="offices_id" required>
                      <option value="" selected disabled>choose...</option>
                    </select>
                  </div>
                  <div class="col-lg-6">
                    <label for="divisions_id" class="form-label">Division<span class="text-danger"> *</span></label>
                    <select class="form-select select-init" id="divisions_id" name="divisions_id" required>
                      <option value="" selected disabled>choose...</option>
                    </select>
                  </div>
                  <div class="col-lg-12">
                    <label for="client_types_id" class="form-label">Client Type<span class="text-danger">
                        *</span></label>
                    <select class="form-select select-init" id="client_types_id" name="client_types_id" required>
                      <option value="" selected disabled>choose...</option>
                    </select>
                  </div>
                  <hr>
                  <div class="col-lg-12">
                    <label for="username" class="form-label">Username<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" id="username" name="username" required />
                  </div>
                  <div class="col-lg-12">
                    <label for="password" class="form-label">Password<span class="text-danger"> *</span></label>
                    <input type="password" class="form-control" id="password" name="password" required />
                  </div>
                  <div class="col-lg-12">
                    <div class="mb-3 form-check">
                      <input type="checkbox" class="form-check-input" id="showPassword" onclick="password.type = password.type === 'password' ? 'text' : 'password'">
                      <label class="form-check-label" for="showPassword">show password</label>
                    </div>
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