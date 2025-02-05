<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link collapsed" href="dashboard.php">
        <i class="bi bi-speedometer2"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <?php
    switch ($_SESSION['role']) {
      case 'admin':
        ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="users.php">
            <i class="bi bi-person-gear"></i>
            <span>Users Management</span>
          </a>
        </li>

        <li class="nav-heading">Forms</li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="helpdesks.php">
            <i class="bi bi-people-fill"></i>
            <span>Helpdesks</span>
          </a>
        </li>

        <!-- <li class="nav-item">
          <a class="nav-link collapsed" href="meetings.php">
            <i class="bi bi-person-video2"></i>
            <span>Meetings</span>
          </a>
        </li> -->

        <li class="nav-heading">Reports</li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="accomplishment.php">
            <i class="bi bi-person-video2"></i>
            <span>Accomplishment</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="reports.php">
            <i class="bi bi-person-video2"></i>
            <span>Reports</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="csf.php">
            <i class="bi bi-person-video2"></i>
            <span>CSF</span>
          </a>
        </li>
        <?php
        break;
      case 'employee':
      case 'VIP':
        ?>
        <li class="nav-heading">Forms</li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="helpdesks.php">
            <i class="bi bi-people-fill"></i>
            <span>Helpdesks</span>
          </a>
        </li>

        <!-- <li class="nav-item">
          <a class="nav-link collapsed" href="meetings.php">
            <i class="bi bi-person-video2"></i>
            <span>Meetings</span>
          </a>
        </li> -->
        <?php
        break;
    }
    ?>

  </ul>

</aside>