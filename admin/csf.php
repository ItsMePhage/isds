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
              CSF Report
            </h5>
            <table id="csf_report_table" style="width:100%">
              <thead>
                <tr>
                  <th scope="col" class="text-nowrap">No.</th>
                  <th scope="col" class="text-nowrap">Name</th>
                  <th scope="col" class="text-nowrap">Age</th>
                  <th scope="col" class="text-nowrap">Sex</th>
                  <th scope="col" class="text-nowrap">Client Type</th>
                  <th scope="col" class="text-nowrap"><em>RESPONSIVENESS</em></th>
                  <th scope="col" class="text-nowrap"><em>ASSURANCE</em></th>
                  <th scope="col" class="text-nowrap"><em>INTEGRITY</em></th>
                  <th scope="col" class="text-nowrap"><em>RELIABILITY</em></th>
                  <th scope="col" class="text-nowrap"><em>OUTCOME</em></th>
                  <th scope="col" class="text-nowrap"><em>ACCESS TO FACILITY</em></th>
                  <th scope="col" class="text-nowrap"><em>COMMS</em></th>
                  <th scope="col" class="text-nowrap"><em>OVERALL RATING</em></th>
                  <th scope="col" class="text-nowrap">Reasons</th>
                  <th scope="col" class="text-nowrap">Comments</th>
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