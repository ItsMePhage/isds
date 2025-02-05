<?php
$page = "CSF Report";
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

      <div class="col-lg-12">

        <div class="card" id="helpdesks_list">
          <div class="card-body">
            <h5 class="card-title">
              Accomplishment Report
            </h5>
            <table id="accomplishment_report_table" style="width:100%">
              <thead>
                <tr>
                  <th scope="col" class="text-nowrap">Date</th>
                  <th scope="col" class="text-nowrap">Request No.</th>
                  <th scope="col" class="text-nowrap">Requestor</th>
                  <th scope="col" class="text-nowrap">Division</th>
                  <th scope="col" class="text-nowrap">Request Type</th>
                  <th scope="col" class="text-nowrap">Category</th>
                  <th scope="col" class="text-nowrap">Sub Category</th>
                  <th scope="col" class="text-nowrap">Complaint</th>
                  <th scope="col" class="text-nowrap">Diagnosis</th>
                  <th scope="col" class="text-nowrap">Action Taken</th>
                  <th scope="col" class="text-nowrap">Status</th>
                  <th scope="col" class="text-nowrap">CSF</th>
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