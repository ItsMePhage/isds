<?php
switch ($page) {
    case "ICT Helpdesks":
        switch ($acc->role) {
            case 'admin':
                ?>
                <!-- Modal -->
                <div class="modal fade" id="updhelpdesksmodal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Update Request</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row g-3 form-validation">
                                    <div class="col-lg-6">
                                        <div>
                                            <label for="upd_date_requested" class="form-label">Date of Request</label>
                                            <input type="date" class="form-control" id="upd_date_requested" name="date_requested"
                                                required />
                                        </div>
                                        <div>
                                            <label for="upd_requested_by" class="form-label">Requestor</label>
                                            <select type="text" class="form-select select-init" id="upd_requested_by"
                                                name="requested_by">
                                                <option value="" selected disabled>choose...</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="upd_request_types_id" class="form-label">Type of Request</label>
                                            <select type="text" class="form-select select-init" id="upd_request_types_id"
                                                name="request_types_id" required>
                                                <option value="" selected disabled>choose...</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="upd_categories_id" class="form-label">Category of Request</label>
                                            <select type="text" class="form-select" id="upd_categories_id" name="categories_id"
                                                required>
                                                <option value="" selected disabled>choose...</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="upd_sub_categories_id" class="form-label">Sub-Category of Request</label>
                                            <select type="text" class="form-select" id="upd_sub_categories_id" name="sub_categories_id"
                                                required>
                                                <option value="" selected disabled>choose...</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="upd_complaint" class="form-label">Defect, Complaint, or Request</label>
                                            <textarea class="form-control" id="upd_complaint" name="complaint"></textarea>
                                        </div>
                                        <div>
                                            <label for="upd_datetime_preferred" class="form-label">Preferred date and time</label>
                                            <input type="datetime-local" class="form-control" id="upd_datetime_preferred"
                                                name="datetime_preferred" />
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div>
                                            <label for="upd_h_statuses_id" class="form-label">Status</label>
                                            <select type="text" class="form-select select-init" id="upd_h_statuses_id"
                                                name="h_statuses_id">
                                                <option value="" selected disabled>choose...</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="upd_property_number" class="form-label">Property Number</label>
                                            <input class="form-control" id="upd_property_number" name="property_number" />
                                        </div>

                                        <div>
                                            <label for="upd_priority_levels_id" class="form-label">Priority Level</label>
                                            <select type="text" class="form-select select-init" id="upd_priority_levels_id"
                                                name="priority_levels_id">
                                                <option value="" selected disabled>choose...</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="upd_repair_types_id" class="form-label">Repair Type</label>
                                            <select type="text" class="form-select select-init" id="upd_repair_types_id"
                                                name="repair_types_id">
                                                <option value="" selected disabled>choose...</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="upd_repair_classes_id" class="form-label">Repair Classification</label>
                                            <select type="text" class="form-select select-init" id="upd_repair_classes_id"
                                                name="repair_classes_id">
                                                <option value="" selected disabled>choose...</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="upd_mediums_id" class="form-label">Mode of Request</label>
                                            <select type="text" class="form-select select-init" id="upd_mediums_id" name="mediums_id">
                                                <option value="" selected disabled>choose...</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="upd_datetime_start" class="form-label">Date & Time Started</label>
                                            <input type="datetime-local" class="form-control" id="upd_datetime_start"
                                                name="datetime_start" />
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="upd_is_pullout" name="is_pullout" />
                                            <label class="form-check-label" for="upd_is_pullout">Pulled out</label>
                                        </div>
                                        <div>
                                            <label for="upd_datetime_end" class="form-label">Date & Time Finished</label>
                                            <input type="datetime-local" class="form-control" id="upd_datetime_end"
                                                name="datetime_end" />
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="upd_is_turnover" name="is_turnover" />
                                            <label class="form-check-label" for="upd_is_turnover">Turned Over</label>
                                        </div>
                                        <div>
                                            <label for="upd_diagnosis" class="form-label">Diagnosis</label>
                                            <textarea class="form-control" id="upd_diagnosis" name="diagnosis"></textarea>
                                        </div>
                                        <div>
                                            <label for="upd_action_taken" class="form-label">Action Taken</label>
                                            <textarea class="form-control" id="upd_action_taken" name="action_taken"></textarea>
                                        </div>
                                        <div>
                                            <label for="upd_remarks" class="form-label">Remarks</label>
                                            <textarea class="form-control" id="upd_remarks" name="remarks"></textarea>
                                        </div>
                                    </div>
                                    <div hidden>
                                        <input class="captcha-token" name="captcha-token" />
                                        <input id="upd_helpdesks_id" name="upd_helpdesks_id" />
                                        <input name="upd_helpdesks" />
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                break;
            case 'employee':
                ?>
                <!-- Modal -->
                <div class="modal fade" id="updhelpdesksmodal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Update Request</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row g-3 form-validation">
                                    <div>
                                        <label for="upd_date_requested" class="form-label">Date of Request</label>
                                        <input type="date" class="form-control" id="upd_date_requested" name="date_requested"
                                            required />
                                    </div>
                                    <div>
                                        <label for="upd_request_types_id" class="form-label">Type of Request</label>
                                        <select type="text" class="form-select select-init" id="upd_request_types_id"
                                            name="request_types_id" required>
                                            <option value="" selected disabled>choose...</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="upd_categories_id" class="form-label">Category of Request</label>
                                        <select type="text" class="form-select" id="upd_categories_id" name="categories_id" required>
                                            <option value="" selected disabled>choose...</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="upd_sub_categories_id" class="form-label">Sub-Category of Request</label>
                                        <select type="text" class="form-select" id="upd_sub_categories_id" name="sub_categories_id"
                                            required>
                                            <option value="" selected disabled>choose...</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="upd_complaint" class="form-label">Defect, Complaint, or Request</label>
                                        <textarea class="form-control" id="upd_complaint" name="complaint"></textarea>
                                    </div>
                                    <div>
                                        <label for="upd_datetime_preferred" class="form-label">Preferred date and time</label>
                                        <input type="datetime-local" class="form-control" id="upd_datetime_preferred"
                                            name="datetime_preferred" />
                                    </div>
                                    <div hidden>
                                        <input class="captcha-token" name="captcha-token" />
                                        <input id="upd_helpdesks_id" name="upd_helpdesks_id" />
                                        <input name="upd_helpdesks" />
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
        }
        break;
    case "Zoom Meetings":
        switch ($acc->role) {
            case 'admin':
                ?>
                <!-- Modal -->
                <div class="modal fade" id="updmeetingsmodal" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Update Schedule</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row g-3 form-validation">
                                    <div class="col-lg-6">
                                        <div>
                                            <label for="upd_date_requested" class="form-label">Date of Request</label>
                                            <input type="date" class="form-control" id="upd_date_requested" name="date_requested"
                                                required />
                                        </div>
                                        <div>
                                            <label for="upd_requested_by" class="form-label">Requestor</label>
                                            <select type="text" class="form-select select-init" id="upd_requested_by"
                                                name="requested_by">
                                                <option value="" selected disabled>choose...</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="upd_topic" class="form-label">Topic or Title of meeting</label>
                                            <textarea class="form-control" id="upd_topic" name="topic"></textarea>
                                        </div>
                                        <div>
                                            <label for="upd_date_scheduled" class="form-label">Date of Schedule</label>
                                            <input type="date" class="form-control" id="upd_date_scheduled" name="date_scheduled"
                                                required />
                                        </div>
                                        <div>
                                            <label for="upd_time_start" class="form-label">Start Time of Schedule</label>
                                            <input type="time" class="form-control" id="upd_time_start" name="time_start" required />
                                        </div>
                                        <div>
                                            <label for="upd_time_end" class="form-label">End Time of Schedule</label>
                                            <input type="time" class="form-control" id="upd_time_end" name="time_end" required />
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div>
                                            <label for="upd_hosts_id" class="form-label">Zoom Host</label>
                                            <select type="text" class="form-select select-init" id="upd_hosts_id" name="hosts_id">
                                                <option value="" selected disabled>choose...</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="upd_m_statuses_id" class="form-label">Status</label>
                                            <select type="text" class="form-select select-init" id="upd_m_statuses_id"
                                                name="m_statuses_id">
                                                <option value="" selected disabled>choose...</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="meeting_details" class="form-label">Zoom meeting details</label>
                                            <textarea class="form-control" id="meeting_details" name="meeting_details"  cols='60' rows='8'></textarea>
                                        </div>

                                        <div class="mt-3">
                                            <button type="button"
                                                class="btn btn-secondary float-end small btn-sm generate-zoom">Generate</button>
                                        </div>
                                    </div>

                                    <div hidden>
                                        <input class="captcha-token" name="captcha-token" />
                                        <input id="upd_meetings_id" name="upd_meetings_id" />
                                        <input name="upd_meetings" />
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                break;
            case 'employee':
                ?>
                <!-- Modal -->
                <div class="modal fade" id="updmeetingsmodal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Update Schedule</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row g-3 form-validation">
                                    <div>
                                        <label for="upd_date_requested" class="form-label">Date of Request</label>
                                        <input type="date" class="form-control" id="upd_date_requested" name="date_requested"
                                            required />
                                    </div>
                                    <div>
                                        <label for="upd_topic" class="form-label">Topic or Title of meeting</label>
                                        <textarea class="form-control" id="upd_topic" name="topic"></textarea>
                                    </div>
                                    <div>
                                        <label for="upd_date_scheduled" class="form-label">Date of Schedule</label>
                                        <input type="date" class="form-control" id="upd_date_scheduled" name="date_scheduled"
                                            required />
                                    </div>
                                    <div>
                                        <label for="upd_time_start" class="form-label">Start Time of Schedule</label>
                                        <input type="time" class="form-control" id="upd_time_start" name="time_start" required />
                                    </div>
                                    <div>
                                        <label for="upd_time_end" class="form-label">End Time of Schedule</label>
                                        <input type="time" class="form-control" id="upd_time_end" name="time_end" required />
                                    </div>
                                    <div hidden>
                                        <input class="captcha-token" name="captcha-token" />
                                        <input id="upd_meetings_id" name="upd_meetings_id" />
                                        <input name="upd_meetings" />
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                break;
        }
        break;
    case "Users Management":
        ?>
        <!-- Modal -->
        <div class="modal fade" id="updusersmodal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Update User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3 form-validation">
                            <div class="col-lg-12">
                                <label for="id_number" class="form-label">ID Number</label>
                                <input type="text" class="form-control" id="upd_id_number" name="id_number" />
                            </div>
                            <div class="col-lg-4">
                                <label for="first_name" class="form-label">First Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" id="upd_first_name" name="first_name" required />
                            </div>
                            <div class="col-lg-4">
                                <label for="middle_name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="upd_middle_name" name="middle_name" />
                            </div>
                            <div class="col-lg-4">
                                <label for="last_name" class="form-label">Last Name<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" id="upd_last_name" name="last_name" required />
                            </div>
                            <div class="col-lg-6">
                                <label for="date_birth" class="form-label">Date of Birth<span class="text-danger">
                                        *</span></label>
                                <input type="date" class="form-control" id="upd_date_birth" name="date_birth" required />
                            </div>
                            <div class="col-lg-6">
                                <label for="sex" class="form-label">Sex<span class="text-danger"> *</span></label>
                                <select class="form-select" id="upd_sex" name="sex" required>
                                    <option value="" selected disabled>choose...</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="upd_is_pwd" name="is_pwd">
                                    <label class="form-check-label" for="is_pwd">
                                        Person with disability
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="upd_phone" name="phone" />
                            </div>
                            <div class="col-lg-6">
                                <label for="email" class="form-label">Email<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" id="upd_email" name="email" required />
                            </div>
                            <div class="col-lg-12">
                                <label for="address" class="form-label">Address</label>
                                <textarea type="text" class="form-control" id="upd_address" name="address"></textarea>
                            </div>
                            <div class="col-lg-12">
                                <label for="designation" class="form-label">designation</label>
                                <input type="text" class="form-control" id="upd_designation" name="designation" />
                            </div>
                            <div class="col-lg-6">
                                <label for="offices_id" class="form-label">Office<span class="text-danger"> *</span></label>
                                <select class="form-select select-init" id="upd_offices_id" name="offices_id" required>
                                    <option value="" selected disabled>choose...</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="divisions_id" class="form-label">Division<span class="text-danger"> *</span></label>
                                <select class="form-select select-init" id="upd_divisions_id" name="divisions_id" required>
                                    <option value="" selected disabled>choose...</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label for="client_types_id" class="form-label">Client Type<span class="text-danger">
                                        *</span></label>
                                <select class="form-select select-init" id="upd_client_types_id" name="client_types_id"
                                    required>
                                    <option value="" selected disabled>choose...</option>
                                </select>
                            </div>
                            <hr>
                            <div class="col-lg-12">
                                <label for="upd_roles_id" class="form-label">Role<span class="text-danger">
                                        *</span></label>
                                <select class="form-select select-init" id="upd_roles_id" name="roles_id" required>
                                    <option value="" selected disabled>choose...</option>
                                </select>
                            </div>
                            <div hidden>
                                <input class="captcha-token" name="captcha-token" />
                                <input name="upd_users" />
                                <input name="upd_users_id" />
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        break;
}
?>