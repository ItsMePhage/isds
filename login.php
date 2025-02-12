<?php
$page = "Login";
require_once "includes/conn.php";
require_once "partials/head.php";
?>
<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <span class="logo d-flex align-items-center w-auto text-center">
                                <br>
                                <span>
                                    <img src="assets/img/logo-new.png" alt="">
                                    <br>
                                    <?= website_name ?>
                                </span>
                            </span>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                    <p class="text-center small">Enter your username & password to login</p>
                                </div>
                                <form class="row g-3 form-validation">
                                    <div>
                                        <label for="username" class="form-label">Username/Email</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            required />
                                    </div>
                                    <div>
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            required />
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="showPassword"
                                            onclick="password.type = password.type === 'password' ? 'text' : 'password'">
                                        <label class="form-check-label" for="showPassword">Show password</label>
                                        <a href="forgot-password.php" class="float-end btn-link">Forgot password?</a>
                                    </div>
                                    <div hidden>
                                        <input class="captcha-token" name="captcha-token" />
                                        <input name="login" />
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i> Login</button>
                                </form>
                                <br>
                                <p class="small mb-0">
                                    Don't have account? <a href="register.php">Sign up</a>
                                </p>

                            </div>
                        </div>

                        <div class="credits">
                            Developed by <a href="#">Phage ツ</a>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->
<?php
require_once "partials/foot.php";
?>