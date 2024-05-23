<?php
$page = "ICT Helpdesks";
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
        <li class="breadcrumb-item">Forms</li>
        <li class="breadcrumb-item active"><?= $page ?></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <div class="col-lg-3">
        <div class="card info-card count-card">
          <div class="card-body" id="h_open">
            <h5 class="card-title">Open</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary">
                <i class="bi bi-people-fill"></i>
              </div>
              <div class="ps-3">
                <h6 id="helpdesks_count"><?= $h_open ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="card info-card count-card">
          <div class="card-body" id="h_pending">
            <h5 class="card-title">Pending</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-warning">
                <i class="bi bi-people-fill"></i>
              </div>
              <div class="ps-3">
                <h6 id="meetings_count"><?= $h_pending ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="card info-card count-card">
          <div class="card-body" id="h_completed">
            <h5 class="card-title">Completed</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success">
                <i class="bi bi-people-fill"></i>
              </div>
              <div class="ps-3">
                <h6 id="helpdesks_count"><?= $h_completed ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="card info-card count-card">
          <div class="card-body" id="h_prerepair">
            <h5 class="card-title">Pre-repair</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-secondary">
                <i class="bi bi-people-fill"></i>
              </div>
              <div class="ps-3">
                <h6 id="meetings_count"><?= $h_prerepair ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">ICT Helpdesk</h5>
            <form class="row g-3 form-validation">
              <div>
                <label for="date_requested" class="form-label">Date of Request</label>
                <input type="date" class="form-control" id="date_requested" name="date_requested"
                  value="<?= date('Y-m-d') ?>" required />
              </div>
              <div>
                <label for="request_types_id" class="form-label">Type of Request</label>
                <select type="text" class="form-select select-init" id="request_types_id" name="request_types_id"
                  required>
                  <option value="" selected disabled>choose...</option>
                </select>
              </div>
              <div>
                <label for="categories_id" class="form-label">Category of Request</label>
                <select type="text" class="form-select" id="categories_id" name="categories_id" required>
                  <option value="" selected disabled>choose...</option>
                </select>
              </div>
              <div>
                <label for="sub_categories_id" class="form-label">Sub-Category of Request</label>
                <select type="text" class="form-select" id="sub_categories_id" name="sub_categories_id" required>
                  <option value="" selected disabled>choose...</option>
                </select>
              </div>
              <div>
                <label for="complaint" class="form-label">Defect, Complaint, or Request</label>
                <textarea class="form-control" id="complaint" name="complaint"></textarea>
              </div>
              <div>
                <label for="datetime_preferred" class="form-label">Preferred date and time</label>
                <input type="datetime-local" class="form-control" id="datetime_preferred" name="datetime_preferred" />
              </div>
              <div hidden>
                <input class="captcha-token" name="captcha-token" />
                <input name="add_helpdesks" />
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>

      </div>

      <div class="col-lg-8">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Helpdesks</h5>
            <table id="tbl_helpdesks" style="width:100%">
              <thead>
                <tr>
                  <th scope="col" class="text-nowrap">Date Requested</th>
                  <th scope="col" class="text-nowrap">Request Number</th>
                  <th scope="col" class="text-nowrap">Category</th>
                  <th scope="col" class="text-nowrap">Sub Category</th>
                  <th scope="col" class="text-nowrap">Status</th>
                  <th scope="col" class="text-nowrap">Action</th>
                </tr>
              </thead>
            </table>
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