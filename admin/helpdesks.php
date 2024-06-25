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

        <div class="card" id="helpdesks_list">
          <div class="card-body">
            <h5 class="card-title">
              Helpdesks
              <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#add_helpdesks">Add
                ICT Heldesks</button>
            </h5>
            <table id="tbl_helpdesks_a" style="width:100%">
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
  <!-- Modal -->
  <div class="modal fade" id="add_helpdesks" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Add ICT Request</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form class="row g-3 form-validation">
            <div class="col-lg-6">
              <div>
                <label for="date_requested" class="form-label">Date of Request</label>
                <input type="date" class="form-control" id="date_requested" name="date_requested"
                  value="<?= date('Y-m-d') ?>" required />
              </div>
              <div>
                <label for="requested_by" class="form-label">Requestor</label>
                <select type="text" class="form-select select-init" id="requested_by" name="requested_by">
                  <option value="" selected disabled>choose...</option>
                </select>
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
            </div>

            <div class="col-lg-6">
              <div>
                <label for="h_statuses_id" class="form-label">Status</label>
                <select type="text" class="form-select select-init" id="h_statuses_id" name="h_statuses_id">
                  <option value="" selected disabled>choose...</option>
                </select>
              </div>
              <div>
                <label for="property_number" class="form-label">Property Number</label>
                <input class="form-control" id="property_number" name="property_number" />
              </div>

              <div>
                <label for="priority_levels_id" class="form-label">Priority Level</label>
                <select type="text" class="form-select select-init" id="priority_levels_id" name="priority_levels_id">
                  <option value="" selected disabled>choose...</option>
                </select>
              </div>

              <div>
                <label for="repair_types_id" class="form-label">Repair Type</label>
                <select type="text" class="form-select select-init" id="repair_types_id" name="repair_types_id">
                  <option value="" selected disabled>choose...</option>
                </select>
              </div>

              <div>
                <label for="repair_classes_id" class="form-label">
                  Repair Classification
                  <button type="button" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-html="true"
                    title="<b>Simple:</b> Basic repairs requiring minimal effort, such as replacing peripherals or fixing minor issues.<br>
               <b>Medium:</b> Moderately challenging repairs involving troubleshooting and basic technical knowledge.<br>
               <b>Complex:</b> More involved repairs demanding significant troubleshooting and expertise.<br>
               <b>Technical:</b> Repairs requiring a high level of technical knowledge and specialized skills.<br>
               <b>Highly Technical:</b> The most challenging repairs demanding expert-level knowledge and advanced problem-solving skills.">
                    <i class="bi bi-info-circle"></i>
                  </button>
                </label>
                <select type="text" class="form-select select-init" id="repair_classes_id" name="repair_classes_id">
                  <option value="" selected disabled>choose...</option>
                </select>
              </div>

              <div>
                <label for="mediums_id" class="form-label">Mode of Request</label>
                <select type="text" class="form-select select-init" id="mediums_id" name="mediums_id">
                  <option value="" selected disabled>choose...</option>
                </select>
              </div>

              <div>
                <label for="datetime_start" class="form-label">Date & Time Started</label>
                <input type="datetime-local" class="form-control" id="datetime_start" name="datetime_start" />
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" value="1" id="is_pullout" name="is_pullout" />
                <label class="form-check-label" for="is_pullout">Pulled out</label>
              </div>
              <div>
                <label for="datetime_end" class="form-label">Date & Time Finished</label>
                <input type="datetime-local" class="form-control" id="datetime_end" name="datetime_end" />
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" value="1" id="is_turnover" name="is_turnover" />
                <label class="form-check-label" for="is_turnover">Turned Over</label>
              </div>
              <div>
                <label for="diagnosis" class="form-label">Diagnosis</label>
                <textarea class="form-control" id="diagnosis" name="diagnosis"></textarea>
              </div>
              <div>
                <label for="action_taken" class="form-label">Action Taken</label>
                <textarea class="form-control" id="action_taken" name="action_taken"></textarea>
              </div>
              <div>
                <label for="remarks" class="form-label">Remarks</label>
                <textarea class="form-control" id="remarks" name="remarks"></textarea>
              </div>
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
  </div>
</main><!-- End #main -->

<?php
require_once "../partials/modal.php";
require_once "../partials/footer.php";
require_once "../partials/foot.php";
?>