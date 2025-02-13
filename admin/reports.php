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
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="mjr-tab" data-bs-toggle="tab" data-bs-target="#mjr-tab-pane"
                  type="button" role="tab" aria-controls="mjr-tab-pane" aria-selected="true">Maintenance Job
                  Request</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="ois-tab" data-bs-toggle="tab" data-bs-target="#ois-tab-pane" type="button"
                  role="tab" aria-controls="ois-tab-pane" aria-selected="false">Other ICT Service</button>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="mjr-tab-pane" role="tabpanel" aria-labelledby="mjr-tab" tabindex="0">
                <table id="mjr_report_table" style="width:100%">
                  <thead>
                    <tr>
                      <th scope="col" class="text-nowrap">id</th>
                      <th scope="col" class="text-nowrap">Office</th>
                      <th scope="col" class="text-nowrap">Request Number</th>
                      <th scope="col" class="text-nowrap">Requested By</th>
                      <th scope="col" class="text-nowrap">Email</th>
                      <th scope="col" class="text-nowrap">Date Requested</th>
                      <th scope="col" class="text-nowrap">Request Type</th>
                      <th scope="col" class="text-nowrap">Category</th>
                      <th scope="col" class="text-nowrap">Sub Category</th>
                      <th scope="col" class="text-nowrap">Complaint</th>
                      <th scope="col" class="text-nowrap">Date/Time Preferred</th>
                      <th scope="col" class="text-nowrap">Status</th>
                      <th scope="col" class="text-nowrap">CSF</th>
                      <th scope="col" class="text-nowrap">Property Number</th>
                      <th scope="col" class="text-nowrap">Priority Level</th>
                      <th scope="col" class="text-nowrap">Repair Type</th>
                      <th scope="col" class="text-nowrap">Repair Class</th>
                      <th scope="col" class="text-nowrap">Medium</th>
                      <th scope="col" class="text-nowrap">Serviced By</th>
                      <th scope="col" class="text-nowrap">Approved By</th>
                      <th scope="col" class="text-nowrap">Date/Time Started</th>
                      <th scope="col" class="text-nowrap">Pullout</th>
                      <th scope="col" class="text-nowrap">Date/Time Finished</th>
                      <th scope="col" class="text-nowrap">Turnover</th>
                      <th scope="col" class="text-nowrap">Diagnosis</th>
                      <th scope="col" class="text-nowrap">Action Taken</th>
                      <th scope="col" class="text-nowrap">Remarks</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <div class="tab-pane fade" id="ois-tab-pane" role="tabpanel" aria-labelledby="ois-tab" tabindex="0">
                <table id="ois_report_table" style="width:100%">
                  <thead>
                    <tr>
                      <th scope="col" class="text-nowrap">id</th>
                      <th scope="col" class="text-nowrap">Office</th>
                      <th scope="col" class="text-nowrap">Request Number</th>
                      <th scope="col" class="text-nowrap">Requested By</th>
                      <th scope="col" class="text-nowrap">Email</th>
                      <th scope="col" class="text-nowrap">Date Requested</th>
                      <th scope="col" class="text-nowrap">Request Type</th>
                      <th scope="col" class="text-nowrap">Category</th>
                      <th scope="col" class="text-nowrap">Sub Category</th>
                      <th scope="col" class="text-nowrap">Complaint</th>
                      <th scope="col" class="text-nowrap">Date/Time Preferred</th>
                      <th scope="col" class="text-nowrap">Status</th>
                      <th scope="col" class="text-nowrap">CSF</th>
                      <th scope="col" class="text-nowrap">Property Number</th>
                      <th scope="col" class="text-nowrap">Priority Level</th>
                      <th scope="col" class="text-nowrap">Repair Type</th>
                      <th scope="col" class="text-nowrap">Repair Class</th>
                      <th scope="col" class="text-nowrap">Medium</th>
                      <th scope="col" class="text-nowrap">Serviced By</th>
                      <th scope="col" class="text-nowrap">Approved By</th>
                      <th scope="col" class="text-nowrap">Date/Time Started</th>
                      <th scope="col" class="text-nowrap">Pullout</th>
                      <th scope="col" class="text-nowrap">Date/Time Finished</th>
                      <th scope="col" class="text-nowrap">Turnover</th>
                      <th scope="col" class="text-nowrap">Diagnosis</th>
                      <th scope="col" class="text-nowrap">Action Taken</th>
                      <th scope="col" class="text-nowrap">Remarks</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
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