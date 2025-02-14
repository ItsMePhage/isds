<?php
$page = "Users Management";
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

      <div class="col-lg-4">
        <div class="card info-card count-card">
          <div class="card-body" id="u_admin">
            <h5 class="card-title">Admin</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary">
                <i class="bi bi-people-fill"></i>
              </div>
              <div class="ps-3">
                <h6 id="helpdesks_count"><?= $u_admin ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card info-card count-card">
          <div class="card-body" id="u_vip">
            <h5 class="card-title">VIP</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary">
                <i class="bi bi-people-fill"></i>
              </div>
              <div class="ps-3">
                <h6 id="meetings_count"><?= $u_vip ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card info-card count-card">
          <div class="card-body" id="u_employee">
            <h5 class="card-title">Employee</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary">
                <i class="bi bi-people-fill"></i>
              </div>
              <div class="ps-3">
                <h6 id="helpdesks_count"><?= $u_employee ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
              Helpdesks
              <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#add_helpdesk">Add
                User</button>
            </h5>
            <table id="users_table" style="width:100%">
              <thead>
                <tr>
                  <th scope="col" class="text-nowrap">ID Number</th>
                  <th scope="col" class="text-nowrap">Name</th>
                  <th scope="col" class="text-nowrap">Email</th>
                  <th scope="col" class="text-nowrap">Office</th>
                  <th scope="col" class="text-nowrap">Division</th>
                  <th scope="col" class="text-nowrap">Role</th>
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
  <div class="modal fade" id="add_helpdesk" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Add User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form class="row g-3 form-validation">
            <div class="col-lg-12">
              <label for="id_number" class="form-label">ID Number</label>
              <input type="text" class="form-control" id="id_number" name="id_number" />
            </div>
            <div class="col-lg-4">
              <label for="first_name" class="form-label">First Name<span class="text-danger"> *</span></label>
              <input type="text" class="form-control" id="first_name" name="first_name" required />
            </div>
            <div class="col-lg-4">
              <label for="middle_name" class="form-label">Middle Name</label>
              <input type="text" class="form-control" id="middle_name" name="middle_name" />
            </div>
            <div class="col-lg-4">
              <label for="last_name" class="form-label">Last Name<span class="text-danger"> *</span></label>
              <input type="text" class="form-control" id="last_name" name="last_name" required />
            </div>
            <div class="col-lg-6">
              <label for="date_birth" class="form-label">Date of Birth<span class="text-danger"> *</span></label>
              <input type="date" class="form-control" id="date_birth" name="date_birth" required />
            </div>
            <div class="col-lg-6">
              <label for="sex" class="form-label">Sex<span class="text-danger"> *</span></label>
              <select class="form-select" id="sex" name="sex" required>
                <option value="" selected disabled>choose...</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
            <div class="col-lg-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="is_pwd" name="is_pwd">
                <label class="form-check-label" for="is_pwd">
                  Person with disability
                </label>
              </div>
            </div>
            <div class="col-lg-6">
              <label for="phone" class="form-label">Phone</label>
              <input type="tel" class="form-control" id="phone" name="phone" />
            </div>
            <div class="col-lg-6">
              <label for="email" class="form-label">Email<span class="text-danger"> *</span></label>
              <input type="text" class="form-control" id="email" name="email" required />
            </div>
            <div class="col-lg-12">
              <label for="address" class="form-label">Address</label>
              <textarea type="text" class="form-control" id="address" name="address"></textarea>
            </div>
            <div class="col-lg-12">
              <label for="designation" class="form-label">designation</label>
              <input type="text" class="form-control" id="designation" name="designation" />
            </div>
            <div class="col-lg-6">
              <label for="offices_id" class="form-label">Office<span class="text-danger"> *</span></label>
              <select class="form-select select-init" id="offices_id" name="offices_id" required>
                <option value="" selected disabled>choose...</option>
              </select>
            </div>
            <div class="col-lg-6">
              <label for="divisions_id" class="form-label">Division<span class="text-danger"> *</span></label>
              <select class="form-select select-init" id="divisions_id" name="divisions_id" required>
                <option value="" selected disabled>choose...</option>
              </select>
            </div>
            <div class="col-lg-12">
              <label for="client_types_id" class="form-label">Client Type<span class="text-danger">
                  *</span></label>
              <select class="form-select select-init" id="client_types_id" name="client_types_id" required>
                <option value="" selected disabled>choose...</option>
              </select>
            </div>
            <hr>
            <div class="col-lg-12">
              <label for="roles_id" class="form-label">Role<span class="text-danger">
                  *</span></label>
              <select class="form-select select-init" id="roles_id" name="roles_id" required>
                <option value="" selected disabled>choose...</option>
              </select>
            </div>
            <div class="col-lg-12">
              <label for="username" class="form-label">Username<span class="text-danger"> *</span></label>
              <input type="text" class="form-control" id="username" name="username" required />
            </div>
            <div class="col-lg-12">
              <label for="password" class="form-label">Password<span class="text-danger"> *</span></label>
              <input type="password" class="form-control" id="password" name="password" required />
            </div>
            <div class="col-lg-12">
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="showPassword"
                  onclick="password.type = password.type === 'password' ? 'text' : 'password'">
                <label class="form-check-label" for="showPassword">show password</label>
              </div>
            </div>
            <div hidden>
              
              <input name="add_user" />
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