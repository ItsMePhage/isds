<?php
$page = "User Profile";
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
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="../assets/img/logo.png" alt="Profile">
            <h2><?= $acc->first_name ?> <?= $acc->middle_name ?> <?= $acc->last_name ?></h2>
            <h3><?= $acc->designation ?></h3>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                  Profile</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form>

                  <div class="row mb-3">
                    <label for="id_number" class="col-md-4 col-lg-3 col-form-label">ID Number</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="id_number" type="text" class="form-control" id="id_number"
                        value="<?= $acc->id_number ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="first_name" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="first_name" type="text" class="form-control" id="first_name"
                        value="<?= $acc->first_name ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="middle_name" class="col-md-4 col-lg-3 col-form-label">Middle Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="middle_name" type="text" class="form-control" id="middle_name"
                        value="<?= $acc->middle_name ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="last_name" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="last_name" type="text" class="form-control" id="last_name"
                        value="<?= $acc->last_name ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="date_birth" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="date_birth" type="date" class="form-control" id="date_birth"
                        value="<?= $acc->date_birth ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="sex" class="col-md-4 col-lg-3 col-form-label">Sex</label>
                    <div class="col-md-8 col-lg-9">
                      <select class="form-select" id="sex" name="sex" required>
                        <option value="" selected disabled>choose...</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>

                      <script>
                        document.getElementById('sex').value = '<?= $acc->sex ?>';
                      </script>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="is_pwd" class="col-md-4 col-lg-3 col-form-label"></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="is_pwd" type="checkbox" class="form-check-input" id="is_pwd" <?= $acc->is_pwd ? 'checked' : '' ?>>
                      <label class="form-check-label small" for="is_pwd">Person with disability</label>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="phone" value="<?= $acc->phone ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="email" value="<?= $acc->email ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="address" type="text" class="form-control"
                        id="address"><?= $acc->address ?></textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="designation" class="col-md-4 col-lg-3 col-form-label">designation</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="designation" type="text" class="form-control" id="designation"
                        value="<?= $acc->designation ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="offices_id" class="col-md-4 col-lg-3 col-form-label">Office</label>
                    <div class="col-md-8 col-lg-9">
                      <select class="form-select select-init" id="offices_id" name="offices_id" required>
                        <option value="" selected disabled>choose...</option>
                      </select>

                      <script>
                        select_data_val[0] = <?= $acc->offices_id ?>;
                      </script>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="divisions_id" class="col-md-4 col-lg-3 col-form-label">Division</label>
                    <div class="col-md-8 col-lg-9">
                      <select class="form-select select-init" id="divisions_id" name="divisions_id" required>
                        <option value="" selected disabled>choose...</option>
                      </select>

                      <script>
                        select_data_val[1] = <?= $acc->divisions_id ?>;
                      </script>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="client_types_id" class="col-md-4 col-lg-3 col-form-label">Client Type</label>
                    <div class="col-md-8 col-lg-9">
                      <select class="form-select select-init" id="client_types_id" name="client_types_id" required>
                        <option value="" selected disabled>choose...</option>
                      </select>

                      <script>
                        select_data_val[2] = <?= $acc->client_types_id ?>;
                      </script>
                    </div>
                  </div>



                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->

<?php
require_once "../partials/footer.php";
require_once "../partials/foot.php";
?>