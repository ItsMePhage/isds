<?php
$page = "Zoom Meetings";
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
          <div class="card-body" id="m_pending">
            <h5 class="card-title">Pending</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-warning">
                <i class="bi bi-person-video2"></i>
              </div>
              <div class="ps-3">
                <h6 id="helpdesks_count"><?= $m_pending ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="card info-card count-card">
          <div class="card-body" id="m_scheduled">
            <h5 class="card-title">Scheduled</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success">
                <i class="bi bi-person-video2"></i>
              </div>
              <div class="ps-3">
                <h6 id="meetings_count"><?= $m_scheduled ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="card info-card count-card">
          <div class="card-body" id="m_unavailable">
            <h5 class="card-title">Unavailable</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-secondary">
                <i class="bi bi-person-video2"></i>
              </div>
              <div class="ps-3">
                <h6 id="helpdesks_count"><?= $m_unavailable ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="card info-card count-card">
          <div class="card-body" id="m_cancelled">
            <h5 class="card-title">Cancelled</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-danger">
                <i class="bi bi-person-video2"></i>
              </div>
              <div class="ps-3">
                <h6 id="meetings_count"><?= $m_cancelled ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Zoom Schedule</h5>
            <!-- Form remains the same -->
            <form class="row g-3 form-validation" method="POST">
              <div>
                <label for="date_requested" class="form-label">Date of Request</label>
                <input type="date" class="form-control" id="date_requested" name="date_requested"
                  value="<?= date('Y-m-d') ?>" readonly required />
              </div>
              <div>
                <label for="topic" class="form-label">Topic or Title of meeting</label>
                <textarea class="form-control" id="topic" name="topic" required></textarea>
              </div>
              <div>
                <label for="date_scheduled" class="form-label">Date of Schedule</label>
                <input type="date" class="form-control" id="date_scheduled" name="date_scheduled"
                  min="<?= date('Y-m-d') ?>" required />
              </div>
              <div>
                <label for="time_start" class="form-label">Start Time of Schedule</label>
                <input type="time" class="form-control" id="time_start" name="time_start" required />
              </div>
              <div>
                <label for="time_end" class="form-label">End Time of Schedule</label>
                <input type="time" class="form-control" id="time_end" name="time_end" required />
              </div>

              <div hidden>
                <input name="add_meeting" value="1" />
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>

      </div>

      <div class="col-lg-8" id="tbl_meetings_card">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Meetings <button class="btn btn-link float-end" onclick="tbl_meetings_card.style.display = 'none';cal_meetings_card.style.visibility = 'visible'">calendar view</button></h5>
            <!-- <table id="tbl_meetings" style="width:100%">
              <thead>
                <tr>
                  <th scope="col" class="text-nowrap">Date Requested</th>
                  <th scope="col" class="text-nowrap">Request Number</th>
                  <th scope="col" class="text-nowrap">Schedule</th>
                  <th scope="col" class="text-nowrap">Time</th>
                  <th scope="col" class="text-nowrap">Status</th>
                  <th scope="col" class="text-nowrap">Action</th>
                </tr>
              </thead>
            </table> -->
            <table id="meetings_table" style="width:100%">
              <thead>
                <tr>
                  <th scope="col" class="text-nowrap">Date Requested</th>
                  <th scope="col" class="text-nowrap">Request Number</th>
                  <th scope="col" class="text-wrap">Topic</th>
                  <th scope="col" class="text-nowrap">Date Scheduled</th>
                  <th scope="col" class="text-nowrap">Status</th>
                  <th scope="col" class="text-nowrap">Host</th>
                  <th scope="col" class="text-nowrap text-center" style="width:0%">Actions</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>

      </div>
      <div class="col-lg-8" id="cal_meetings_card" style="visibility: hidden">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Meetings <button class="btn btn-link float-end" onclick="tbl_meetings_card.style.display = '';cal_meetings_card.style.visibility = 'hidden'">table view</button></h5>
            <div id='cal_meetings_a'></div>
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