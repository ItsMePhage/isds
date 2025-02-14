<?php
$page = "Client Satisfaction Form";
require_once "includes/conn.php";
require_once "partials/head.php";

session_start();

?>
<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-12 d-flex flex-column align-items-center justify-content-center">

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
                            <div class="card-header mb-3">
                                <div class="row">
                                    <p class="col-lg-6">Request No.: <br><strong id="request_no"></strong></p>
                                    <p class="col-lg-6">Request Type: <br><strong id="request_type"></strong></p>
                                    <p class="col-lg-6">Category/Sub Category: <br><strong id="category"></strong></p>
                                    <p class="col-lg-6">Date Requested: <br><strong id="date_requested"></strong></p>
                                    <p class="col-lg-6">Defect/ Request/ Complaint: <br><strong id="complaint"></strong>
                                    </p>
                                    <p class="col-lg-6">Action taken: <br><strong id="action_taken"></strong></p>
                                    <p class="col-lg-6">Serviced by: <br><strong id="serviced_by_name"></strong></p>
                                </div>
                            </div>

                            <div class="card-body">
                                <form class="form-validation" novalidate>
                                    <p class="small"><strong>PART I. RATINGS</strong></p>
                                    <hr>

                                    <div class="row mb-2 crit1">
                                        <div class="col-lg-6 col-md-12 col-sm-12 small">
                                            <p><strong>RESPONSIVENESS, ASSURANCE, AND INTEGRITY</strong></p>
                                            <p>Delivery of services are on time, friendly, courteous, fair and in a
                                                professional manner.</p>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 row">
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="4"
                                                    onclick="updateRating('crit1', 4, this)" title="Excellent">
                                                    <i class="fs-3 bi bi-emoji-laughing"></i>
                                                </button>
                                            </div>
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="3"
                                                    onclick="updateRating('crit1', 3, this)" title="Good">
                                                    <i class="fs-3 bi bi-emoji-smile"></i>
                                                </button>
                                            </div>
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="2"
                                                    onclick="updateRating('crit1', 2, this)" title="Average">
                                                    <i class="fs-3 bi bi-emoji-frown"></i>
                                                </button>
                                            </div>
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="1"
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
                                            <p>Actual services are acted upon immediately. Delivery of service are
                                                complete,
                                                accurate and corresponds to requirement.</p>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 row">
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="4"
                                                    onclick="updateRating('crit2', 4, this)" title="Excellent">
                                                    <i class="fs-3 bi bi-emoji-laughing"></i>
                                                </button>
                                            </div>
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="3"
                                                    onclick="updateRating('crit2', 3, this)" title="Good">
                                                    <i class="fs-3 bi bi-emoji-smile"></i>
                                                </button>
                                            </div>
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="2"
                                                    onclick="updateRating('crit2', 2, this)" title="Average">
                                                    <i class="fs-3 bi bi-emoji-frown"></i>
                                                </button>
                                            </div>
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="1"
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
                                            <p>Computer and Technology facilities and services are sustainable and
                                                available
                                                when needed.</p>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 row">
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="4"
                                                    onclick="updateRating('crit3', 4, this)" title="Excellent">
                                                    <i class="fs-3 bi bi-emoji-laughing"></i>
                                                </button>
                                            </div>
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="3"
                                                    onclick="updateRating('crit3', 3, this)" title="Good">
                                                    <i class="fs-3 bi bi-emoji-smile"></i>
                                                </button>
                                            </div>
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="2"
                                                    onclick="updateRating('crit3', 2, this)" title="Average">
                                                    <i class="fs-3 bi bi-emoji-frown"></i>
                                                </button>
                                            </div>
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="1"
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
                                            <p>The requirements and process for the service requests system is properly
                                                communicated.</p>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 row">
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="4"
                                                    onclick="updateRating('crit4', 4, this)" title="Excellent">
                                                    <i class="fs-3 bi bi-emoji-laughing"></i>
                                                </button>
                                            </div>
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="3"
                                                    onclick="updateRating('crit4', 3, this)" title="Good">
                                                    <i class="fs-3 bi bi-emoji-smile"></i>
                                                </button>
                                            </div>
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="2"
                                                    onclick="updateRating('crit4', 2, this)" title="Average">
                                                    <i class="fs-3 bi bi-emoji-frown"></i>
                                                </button>
                                            </div>
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="1"
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
                                            <p>Overall, how satisfied are you with the technology facilities and
                                                services
                                                available?</p>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 row">
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="4"
                                                    onclick="updateRating('overall', 4, this)" title="Excellent">
                                                    <i class="fs-3 bi bi-emoji-laughing"></i>
                                                </button>
                                            </div>
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="3"
                                                    onclick="updateRating('overall', 3, this)" title="Good">
                                                    <i class="fs-3 bi bi-emoji-smile"></i>
                                                </button>
                                            </div>
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="2"
                                                    onclick="updateRating('overall', 2, this)" title="Average">
                                                    <i class="fs-3 bi bi-emoji-frown"></i>
                                                </button>
                                            </div>
                                            <div class="col-3 small text-center">
                                                <button type="button" class="btn rating-button" data-value="1"
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

                                    <!-- Comments and Suggestions Section -->
                                    <div class="mb-2">
                                        <label for="reasons" class="small">Please write in the space below your reason/s
                                            for
                                            your "DISSATISFIED" or "VERY DISSATISFIED" rating so that we will know in
                                            which
                                            area/s we need to improve.</label>
                                        <textarea name="reasons" class="form-control form-control-sm" id="reasons"
                                            maxlength="150"></textarea>
                                    </div>

                                    <div class="mb-2">
                                        <label for="comments" class="small">Please give comments/suggestions to help us
                                            improve our service/s:</label>
                                        <textarea name="comments" class="form-control form-control-sm" id="comments"
                                            maxlength="150"></textarea>
                                    </div>
                                    <div hidden>
                                        
                                        <input name="helpdesks_id" id="helpdesks_id" />
                                        <input name="quick_csf" />
                                        <input type="submit" id="csfbtn" />
                                    </div>
                                </form>
                            </div>

                            <div class="card-footer text-center">
                                <button type="button" class="btn btn-primary w-100"
                                    onclick="csfbtn.click()">Submit</button>
                            </div>
                        </div>


                        <div class="credits">
                            <p class="m-0 p-0 text-center"><strong>THANK YOU!!!</strong></p>
                        </div>

                        <div class="credits">
                            Developed by <a href="https://dafuerte.ndsor.com">Phage ツ</a>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->
<?php
require_once "partials/foot.php";
if (isset($_GET['reqno'])) {
    ?>
    <script>
        $.ajax({
            type: "POST",
            url: "includes/fetch.php",
            data: {
                'csf': '',
                'id': <?= $_GET['reqno'] ?>
            },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                // $('#id').val(response.id);
                if (response.csf_id) {

                    window.location.href = 'view_csf.php?reqno=' + response.id;

                } else {
                    $('#request_no').html(response.request_number + ' (<span class="text-' + response.status_color + '">' + response.status + '</span>)');
                    $('#date_requested').html(response.date_requested);
                    $('#request_type').html(response.request_type);
                    $('#category').html(response.category + ' / ' + response.sub_category);
                    $('#sub_category').html(response.sub_category);
                    $('#complaint').html(response.complaint);
                    $('#action_taken').html(response.action_taken);
                    $('#serviced_by_name').html(response.serviced_by_name);
                    $('#helpdesks_id').val(response.id);
                }
            }
        });
    </script>
    <?php
}
?>