<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link collapsed" href="dashboard.php">
        <i class="bi bi-speedometer2"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-heading">Forms</li>

    <?php
    switch ($_SESSION['role']) {
      case 'admin':
        ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="users.php">
            <i class="bi bi-person-gear"></i>
            <span>Users</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="helpdesks.php">
            <i class="bi bi-people-fill"></i>
            <span>Helpdesks</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="meetings.php">
            <i class="bi bi-person-video2"></i>
            <span>Meetings</span>
          </a>
        </li>
        <?php
        break;
      case 'employee':
        ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="helpdesks.php">
            <i class="bi bi-people-fill"></i>
            <span>Helpdesks</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="meetings.php">
            <i class="bi bi-person-video2"></i>
            <span>Meetings</span>
          </a>
        </li>
        <?php
        break;
    }
    ?>

  </ul>

</aside>