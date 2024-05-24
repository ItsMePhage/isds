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

      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
              Helpdesks
              <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#add_helpdesks">Add
                ICT Heldesks</button>
            </h5>
            <table id="tbl_allhelpdesks" style="width:100%">
              <thead>
                <tr>
                  <th scope="col" class="text-nowrap">Date Requested</th>
                  <th scope="col" class="text-nowrap">Requested By</th>
                  <th scope="col" class="text-nowrap">Request Number</th>
                  <th scope="col" class="text-nowrap">Category</th>
                  <th scope="col" class="text-nowrap">Sub Category</th>
                  <th scope="col" class="text-nowrap">Status</th>
                  <th scope="col" class="text-nowrap"></th>
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