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

      <?php
      $acc_id = $acc->id;

      $count_day_helpdesks = $conn->query("SELECT COUNT(*) as count_day FROM helpdesks WHERE DATE(date_requested) = CURDATE() AND requested_by = $acc_id")->fetch_object()->count_day;
      $count_month_helpdesks = $conn->query("SELECT COUNT(*) as count_month FROM helpdesks WHERE YEAR(date_requested) = YEAR(CURDATE()) AND MONTH(date_requested) = MONTH(CURDATE()) AND requested_by = $acc_id")->fetch_object()->count_month;
      $count_year_helpdesks = $conn->query("SELECT COUNT(*) as count_year FROM helpdesks WHERE YEAR(date_requested) = YEAR(CURDATE()) AND requested_by = $acc_id")->fetch_object()->count_year;

      $count_day_meetings = $conn->query("SELECT COUNT(*) as count_day FROM meetings WHERE DATE(date_requested) = CURDATE() AND requested_by = $acc_id")->fetch_object()->count_day;
      $count_month_meetings = $conn->query("SELECT COUNT(*) as count_month FROM meetings WHERE YEAR(date_requested) = YEAR(CURDATE()) AND MONTH(date_requested) = MONTH(CURDATE()) AND requested_by = $acc_id")->fetch_object()->count_month;
      $count_year_meetings = $conn->query("SELECT COUNT(*) as count_year FROM meetings WHERE YEAR(date_requested) = YEAR(CURDATE()) AND requested_by = $acc_id")->fetch_object()->count_year;
      ?>

      <!-- Sales Card -->
      <div class="col-lg-6">
        <div class="card info-card sales-card">
          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Filter</h6>
              </li>
              <li><button class="dropdown-item" id="today-helpdesks">Today</button></li>
              <li><button class="dropdown-item" id="month-helpdesks">This Month</button></li>
              <li><button class="dropdown-item" id="year-helpdesks">This Year</button></li>
            </ul>
          </div>
          <div class="card-body">
            <h5 class="card-title">Helpdesks</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-cart"></i>
              </div>
              <div class="ps-3">
                <h6 id="helpdesks_count"><?= $count_day_helpdesks ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div><!-- End Sales Card -->

      <!-- Revenue Card -->
      <div class="col-lg-6">
        <div class="card info-card revenue-card">
          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Filter</h6>
              </li>
              <li><button class="dropdown-item" id="today-meetings">Today</button></li>
              <li><button class="dropdown-item" id="month-meetings">This Month</button></li>
              <li><button class="dropdown-item" id="year-meetings">This Year</button></li>
            </ul>
          </div>
          <div class="card-body">
            <h5 class="card-title">Revenue <span>| This Month</span></h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-currency-dollar"></i>
              </div>
              <div class="ps-3">
                <h6 id="meetings_count"><?= $count_day_meetings ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div><!-- End Revenue Card -->

      <script>
        document.addEventListener("DOMContentLoaded", function () {
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

          document.getElementById('today-helpdesks').addEventListener('click', function () {
            document.getElementById('helpdesks_count').innerText = counts.helpdesks.today;
          });

          document.getElementById('month-helpdesks').addEventListener('click', function () {
            document.getElementById('helpdesks_count').innerText = counts.helpdesks.month;
          });

          document.getElementById('year-helpdesks').addEventListener('click', function () {
            document.getElementById('helpdesks_count').innerText = counts.helpdesks.year;
          });

          document.getElementById('today-meetings').addEventListener('click', function () {
            document.getElementById('meetings_count').innerText = counts.meetings.today;
          });

          document.getElementById('month-meetings').addEventListener('click', function () {
            document.getElementById('meetings_count').innerText = counts.meetings.month;
          });

          document.getElementById('year-meetings').addEventListener('click', function () {
            document.getElementById('meetings_count').innerText = counts.meetings.year;
          });
        });
      </script>

      <div class="col-lg-6">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Example Card</h5>
            <p>This is an examle page with no contrnt. You can use it as a starter for your custom pages.</p>
          </div>
        </div>

      </div>

      <div class="col-lg-6">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Example Card</h5>
            <p>This is an examle page with no contrnt. You can use it as a starter for your custom pages.</p>
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