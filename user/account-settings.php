<?php
$page = "Account Settings";
$is_protected = true;
require_once "session.php";
require_once "../partials/head.php";
require_once "../partials/header.php";
require_once "../partials/aside.php";
?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1><?= $page ?></h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active"><?= $page ?></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">

      <div class="col-xl-7">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                  Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form class="form-validation">

                  <div class="row mb-3">
                    <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="username" type="text" class="form-control" id="username"
                        value="<?= $acc->username ?>">
                    </div>
                  </div>
                  <div hidden>
                    
                    <input name="change_username" />
                  </div>
                  <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save Update</button>
                  </div>
                </form>
                <hr>
                <form class="form-validation">

                  <div class="row mb-3">
                    <label for="password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="password">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="new_password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="new_password" type="password" class="form-control" id="new_password">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="ver_password" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="ver_password" type="password" class="form-control" id="ver_password">
                    </div>
                  </div>
                  <div hidden>
                    
                    <input name="change_password" />
                  </div>
                  <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save Update</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->

<?php
require_once "../partials/modal.php";
require_once "../partials/footer.php";
require_once "../partials/foot.php";
?>