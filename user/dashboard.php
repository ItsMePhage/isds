<?php
$page = "Dashboard";
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
        <li class="breadcrumb-item active"><?= $page ?></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <div class="col-lg-6">
        <div class="card info-card count-card">
          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu small dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Filter</h6>
              </li>
              <li><button class="dropdown-item py-0 my-0" id="today-helpdesks">Today</button></li>
              <li><button class="dropdown-item py-0 my-0" id="month-helpdesks">This Month</button></li>
              <li><button class="dropdown-item py-0 my-0" id="year-helpdesks">This Year</button></li>
            </ul>
          </div>
          <div class="card-body" onclick="location='helpdesks.php'">
            <h5 class="card-title">Helpdesks <span id="helpdesks_count_scope">| Today</span></h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-people-fill"></i>
              </div>
              <div class="ps-3">
                <h6 id="helpdesks_count"><?= $count_day_helpdesks ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card info-card count-card">
          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu small dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Filter</h6>
              </li>
              <li><button class="dropdown-item py-0 my-0" id="today-meetings">Today</button></li>
              <li><button class="dropdown-item py-0 my-0" id="month-meetings">This Month</button></li>
              <li><button class="dropdown-item py-0 my-0" id="year-meetings">This Year</button></li>
            </ul>
          </div>
          <div class="card-body" onclick="location='meetings.php'">
            <h5 class="card-title">Meetings <span id="meetings_count_scope">| Today</span></h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-person-video2"></i>
              </div>
              <div class="ps-3">
                <h6 id="meetings_count"><?= $count_day_meetings ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script>
        document.addEventListener("DOMContentLoaded", function() {
          const counts = {
            helpdesks: {
              today: <?= $count_day_helpdesks ?>,
              month: <?= $count_month_helpdesks ?>,
              year: <?= $count_year_helpdesks ?>
            },
            meetings: {
              today: <?= $count_day_meetings ?>,
              month: <?= $count_month_meetings ?>,
              year: <?= $count_year_meetings ?>
            }
          };

          document.getElementById('today-helpdesks').addEventListener('click', function() {
            document.getElementById('helpdesks_count').innerText = counts.helpdesks.today;
            document.getElementById('helpdesks_count_scope').innerHTML = "| Today";
          });

          document.getElementById('month-helpdesks').addEventListener('click', function() {
            document.getElementById('helpdesks_count').innerText = counts.helpdesks.month;
            document.getElementById('helpdesks_count_scope').innerHTML = "| This month";
          });

          document.getElementById('year-helpdesks').addEventListener('click', function() {
            document.getElementById('helpdesks_count').innerText = counts.helpdesks.year;
            document.getElementById('helpdesks_count_scope').innerHTML = "| This year";
          });

          document.getElementById('today-meetings').addEventListener('click', function() {
            document.getElementById('meetings_count').innerText = counts.meetings.today;
            document.getElementById('meetings_count_scope').innerHTML = "| Today";
          });

          document.getElementById('month-meetings').addEventListener('click', function() {
            document.getElementById('meetings_count').innerText = counts.meetings.month;
            document.getElementById('meetings_count_scope').innerHTML = "| This month";
          });

          document.getElementById('year-meetings').addEventListener('click', function() {
            document.getElementById('meetings_count').innerText = counts.meetings.year;
            document.getElementById('meetings_count_scope').innerHTML = "| This year";
          });
        });
      </script>

      <div class="col-lg-6">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">ICT Helpdesk</h5>
            <form class="row g-3 form-validation">
              <div>
                <label for="date_requested" class="form-label">Date of Request</label>
                <input type="date" class="form-control" id="date_requested" name="date_requested" value="<?= date('Y-m-d') ?>" required />
              </div>
              <div>
                <label for="request_types_id" class="form-label">Type of Request</label>
                <select type="text" class="form-select select-init" id="request_types_id" name="request_types_id" required>
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
                <input type="datetime-local" class="form-control" id="datetime_preferred" name="datetime_preferred" required />
              </div>
              <div hidden>
                
                <input name="add_helpdesks" />
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>

      </div>

      <div class="col-lg-6">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Zoom Schedule</h5>
            <form class="row g-3 form-validation">
              <div>
                <label for="date_requested" class="form-label">Date of Request</label>
                <input type="date" class="form-control" id="date_requested" name="date_requested" value="<?= date('Y-m-d') ?>" required />
              </div>
              <div>
                <label for="topic" class="form-label">Topic or Title of meeting</label>
                <textarea class="form-control" id="topic" name="topic"></textarea>
              </div>
              <div>
                <label for="date_scheduled" class="form-label">Date of Schedule</label>
                <input type="date" class="form-control" id="date_scheduled" name="date_scheduled" required />
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
                
                <input name="add_meetings" />
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
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