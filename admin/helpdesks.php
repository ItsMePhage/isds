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

      <div class="col-lg-4">
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

      <div class="col-lg-4">
        <div class="card info-card count-card">
          <div class="card-body" id="h_cancelled">
            <h5 class="card-title">Cancelled</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-danger">
                <i class="bi bi-people-fill"></i>
              </div>
              <div class="ps-3">
                <h6 id="meetings_count"><?= $h_cancelled ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
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

      <div class="col-lg-4">
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

      <div class="col-lg-4">
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
        <div class="card info-card count-card">
          <div class="card-body" id="h_unserviceable">
            <h5 class="card-title">Unserviceable</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-secondary">
                <i class="bi bi-people-fill"></i>
              </div>
              <div class="ps-3">
                <h6 id="meetings_count"><?= $h_unserviceable ?></h6>
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
              <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#add_helpdesk">Add
                ICT Heldesks</button>
            </h5>
            <table id="helpdesks_table" style="width:100%">
              <thead>
                <tr>
                  <th scope="col" class="text-nowrap">Date Requested</th>
                  <th scope="col" class="text-nowrap">Request Number</th>
                  <th scope="col" class="text-nowrap">Category</th>
                  <th scope="col" class="text-nowrap">Sub Category</th>
                  <th scope="col" class="text-nowrap">Status</th>
                  <th scope="col" class="text-nowrap">CSF</th>
                  <th scope="col" class="text-nowrap">Requested By</th>
                  <th scope="col" class="text-nowrap">Serviced By</th>
                  <th scope="col" class="text-nowrap text-center" style="width:0%">Actions</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- Modal -->
  <div class="modal fade" id="add_helpdesk" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
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
                <select class="form-select select-init" id="requested_by" name="requested_by">
                  <option value="" selected disabled>choose...</option>
                </select>
              </div>
              <div>
                <label for="request_types_id" class="form-label">Type of Request</label>
                <select class="form-select select-init" id="request_types_id" name="request_types_id" required>
                  <option value="" selected disabled>choose...</option>
                </select>
              </div>
              <div>
                <label for="categories_id" class="form-label">Category of Request</label>
                <select class="form-select" id="categories_id" name="categories_id" required>
                  <option value="" selected disabled>choose...</option>
                </select>
              </div>
              <div>
                <label for="sub_categories_id" class="form-label">Sub-Category of Request</label>
                <select class="form-select" id="sub_categories_id" name="sub_categories_id" required>
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
                <select class="form-select select-init" id="h_statuses_id" name="h_statuses_id">
                  <option value="" selected disabled>choose...</option>
                </select>
              </div>
              <div>
                <label for="property_number" class="form-label">Property Number</label>
                <input class="form-control" id="property_number" name="property_number" />
              </div>

              <div>
                <label for="priority_levels_id" class="form-label">Urgency</label>
                <select class="form-select select-init" id="priority_levels_id" name="priority_levels_id">
                  <option value="" selected disabled>choose...</option>
                </select>
              </div>

              <div>
                <label for="mediums_id" class="form-label">Mode of Request</label>
                <select class="form-select select-init" id="mediums_id" name="mediums_id">
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
              <div>
                <label for="serviced_by" class="form-label">Assigned to</label>
                <select class="form-select select-init" id="serviced_by" name="serviced_by">
                  <option value="" selected>choose...</option>
                </select>
              </div>
              <hr>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" value="1" id="send_email" name="send_email" />
                <label class="form-check-label" for="send_email">Send email</label>
              </div>
            </div>

            <div hidden>

              <input name="add_helpdesk" />
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- csf Modal -->
  <div class="modal fade" id="csfModal" tabindex="-1" aria-labelledby="csfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="csfModalLabel">csf</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="needs-validation">
            <p class="small"><strong class="small">PART I. Our office is committed to continually improve our
                services to our external clients. Please answer this Form for us to know your feedback on the
                different aspects of our services. Your feedback and impressions will help us in improving our
                services in order to better serve our clients. Rest assured all information you will provide shall
                be treated with strict confidentiality. </strong></p>

            <hr>

            <div class="row mb-2 crit1">
              <div class="col-lg-6 col-md-12 col-sm-12 small">
                <p><strong>RESPONSIVENESS, ASSURANCE, AND INTEGRITY</strong></p>
                <p>Delivery of services are on time, friendly, courteous, fair and in a professional manner.</p>
              </div>
              <div class="col-lg-6 col-md-12 col-sm-12 row">
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="4" id="crit1-4"
                    onclick="updateRating('crit1', 4, this)" title="Excellent">
                    <i class="fs-3 bi bi-emoji-laughing"></i>
                  </button>
                </div>
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="3" id="crit1-3"
                    onclick="updateRating('crit1', 3, this)" title="Good">
                    <i class="fs-3 bi bi-emoji-smile"></i>
                  </button>
                </div>
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="2" id="crit1-2"
                    onclick="updateRating('crit1', 2, this)" title="Average">
                    <i class="fs-3 bi bi-emoji-frown"></i>
                  </button>
                </div>
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="1" id="crit1-1"
                    onclick="updateRating('crit1', 1, this)" title="Poor">
                    <i class="fs-3 bi bi-emoji-angry"></i>
                  </button>
                </div>
              </div>
              <input type="hidden" name="crit1" id="crit1" />
            </div>

            <div class="row mb-2 crit2">
              <div class="col-lg-6 col-md-12 col-sm-12 small">
                <p><strong>RELIABILITY AND OUTCOME</strong></p>
                <p>Actual services are acted upon immediately. Delivery of service are complete, accurate and
                  corresponds to requirement.</p>
              </div>
              <div class="col-lg-6 col-md-12 col-sm-12 row">
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="4" id="crit2-4"
                    onclick="updateRating('crit2', 4, this)" title="Excellent">
                    <i class="fs-3 bi bi-emoji-laughing"></i>
                  </button>
                </div>
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="3" id="crit2-3"
                    onclick="updateRating('crit2', 3, this)" title="Good">
                    <i class="fs-3 bi bi-emoji-smile"></i>
                  </button>
                </div>
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="2" id="crit2-2"
                    onclick="updateRating('crit2', 2, this)" title="Average">
                    <i class="fs-3 bi bi-emoji-frown"></i>
                  </button>
                </div>
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="1" id="crit2-1"
                    onclick="updateRating('crit2', 1, this)" title="Poor">
                    <i class="fs-3 bi bi-emoji-angry"></i>
                  </button>
                </div>
              </div>
              <input type="hidden" name="crit2" id="crit2" />
            </div>

            <div class="row mb-2 crit3">
              <div class="col-lg-6 col-md-12 col-sm-12 small">
                <p><strong>ACCESS AND FACILITIES</strong></p>
                <p>Computer and Technology facilities and services are sustainable and available when needed.</p>
              </div>
              <div class="col-lg-6 col-md-12 col-sm-12 row">
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="4" id="crit3-4"
                    onclick="updateRating('crit3', 4, this)" title="Excellent">
                    <i class="fs-3 bi bi-emoji-laughing"></i>
                  </button>
                </div>
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="3" id="crit3-3"
                    onclick="updateRating('crit3', 3, this)" title="Good">
                    <i class="fs-3 bi bi-emoji-smile"></i>
                  </button>
                </div>
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="2" id="crit3-2"
                    onclick="updateRating('crit3', 2, this)" title="Average">
                    <i class="fs-3 bi bi-emoji-frown"></i>
                  </button>
                </div>
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="1" id="crit3-1"
                    onclick="updateRating('crit3', 1, this)" title="Poor">
                    <i class="fs-3 bi bi-emoji-angry"></i>
                  </button>
                </div>
              </div>
              <input type="hidden" name="crit3" id="crit3" />
            </div>

            <div class="row mb-2 crit4">
              <div class="col-lg-6 col-md-12 col-sm-12 small">
                <p><strong>COMMUNICATION</strong></p>
                <p>The requirements and process for the service requests system is properly communicated.</p>
              </div>
              <div class="col-lg-6 col-md-12 col-sm-12 row">
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="4" id="crit4-4"
                    onclick="updateRating('crit4', 4, this)" title="Excellent">
                    <i class="fs-3 bi bi-emoji-laughing"></i>
                  </button>
                </div>
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="3" id="crit4-3"
                    onclick="updateRating('crit4', 3, this)" title="Good">
                    <i class="fs-3 bi bi-emoji-smile"></i>
                  </button>
                </div>
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="2" id="crit4-2"
                    onclick="updateRating('crit4', 2, this)" title="Average">
                    <i class="fs-3 bi bi-emoji-frown"></i>
                  </button>
                </div>
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="1" id="crit4-1"
                    onclick="updateRating('crit4', 1, this)" title="Poor">
                    <i class="fs-3 bi bi-emoji-angry"></i>
                  </button>
                </div>
              </div>
              <input type="hidden" name="crit4" id="crit4" />
            </div>

            <hr>

            <div class="row mb-2 overall">
              <div class="col-lg-6 col-md-12 col-sm-12 small">
                <p><strong>OVERALL SATISFACTION RATING</strong></p>
                <p>Overall, how satisfied are you with the technology facilities and services available?</p>
              </div>
              <div class="col-lg-6 col-md-12 col-sm-12 row">
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="4" id="overall-4"
                    onclick="updateRating('overall', 4, this)" title="Excellent">
                    <i class="fs-3 bi bi-emoji-laughing"></i>
                  </button>
                </div>
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="3" id="overall-3"
                    onclick="updateRating('overall', 3, this)" title="Good">
                    <i class="fs-3 bi bi-emoji-smile"></i>
                  </button>
                </div>
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="2" id="overall-2"
                    onclick="updateRating('overall', 2, this)" title="Average">
                    <i class="fs-3 bi bi-emoji-frown"></i>
                  </button>
                </div>
                <div class="col-3 small text-center">
                  <button type="button" class="btn rating-button" data-value="1" id="overall-1"
                    onclick="updateRating('overall', 1, this)" title="Poor">
                    <i class="fs-3 bi bi-emoji-angry"></i>
                  </button>
                </div>
              </div>
              <input type="hidden" name="overall" id="overall" />
            </div>

            <script>
              function updateRating(elementId, value, button) {
                $('#' + elementId).val(value);
                // Remove the 'selected' class from all buttons
                $('.' + elementId + ' .rating-button').removeClass('text-warning');
                // Add the 'selected' class to the clicked button
                $(button).addClass('text-warning');
              }
            </script>

            <hr>
            <hr>

            <p class="small"><strong>PART II. COMMENTS AND SUGGESTIONS</strong></p>

            <hr>

            <div class="mb-2">
              <label for="reasons" class="small">Please write in the space below your reason/s for your
                "DISSATISFIED" or "VERY DISSATISFIED" rating so that we will know in which area/s we need to
                improve.</label>
              <textarea name="reasons" class="form-control form-control-sm" id="reasons" maxlength="150"></textarea>
            </div>

            <div class="mb-2">
              <label for="comments" class="small">Please give comments/suggestions to help us improve our
                service/s:</label>
              <textarea name="comments" class="form-control form-control-sm" id="comments" maxlength="150"></textarea>
            </div>
            <hr>
            <hr>
            <p class="m-0 p-0 text-center"><strong>THANK YOU!!!</strong></p>

            <div hidden>
              <input name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />

              <input name="helpdesks_id" id="helpdesks_id" />
              <input name="id" id="id" />
              <input name="add_csf" id="add_csf" disabled />
              <input name="edit_csf" id="edit_csf" disabled />
              <button type="submit" id="csfbtn"></button>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="csfbtn.click();">Save Changes</button>
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