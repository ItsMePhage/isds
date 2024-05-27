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
                            value="<?= date('Y-m-d') ?>" required />
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
                    <?php
                    if ($acc->role == 'admin') {
                        ?>
                        <hr>

                        <div>
                            <label for="upd_h_statuses_id" class="form-label">Status</label>
                            <select type="text" class="form-select select-init" id="upd_h_statuses_id"
                                name="upd_h_statuses_id">
                                <option value="" selected disabled>choose...</option>
                            </select>
                        </div>
                        <div>
                            <label for="upd_property_number" class="form-label">Property Number</label>
                            <input class="form-control" id="upd_property_number" name="upd_property_number" />
                        </div>

                        <div>
                            <label for="upd_priority_levels_id" class="form-label">Priority Level</label>
                            <select type="text" class="form-select select-init" id="upd_priority_levels_id"
                                name="upd_priority_levels_id">
                                <option value="" selected disabled>choose...</option>
                            </select>
                        </div>

                        <div>
                            <label for="upd_repair_types_id" class="form-label">Repair Type</label>
                            <select type="text" class="form-select select-init" id="upd_repair_types_id"
                                name="upd_repair_types_id">
                                <option value="" selected disabled>choose...</option>
                            </select>
                        </div>

                        <div>
                            <label for="upd_repair_classes_id" class="form-label">Repair Classification</label>
                            <select type="text" class="form-select select-init" id="upd_repair_classes_id"
                                name="upd_repair_classes_id">
                                <option value="" selected disabled>choose...</option>
                            </select>
                        </div>

                        <div>
                            <label for="upd_mediums_id" class="form-label">Mode of Request</label>
                            <select type="text" class="form-select select-init" id="upd_mediums_id" name="upd_mediums_id">
                                <option value="" selected disabled>choose...</option>
                            </select>
                        </div>

                        <div>
                            <label for="upd_datetime_start" class="form-label">Date & Time Started</label>
                            <input type="datetime-local" class="form-control" id="upd_datetime_start"
                                name="upd_datetime_start" />
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="upd_is_pullout" name="upd_is_pullout" />
                            <label class="form-check-label" for="upd_is_pullout">Pulled out</label>
                        </div>
                        <div>
                            <label for="upd_datetime_end" class="form-label">Date & Time Finished</label>
                            <input type="datetime-local" class="form-control" id="upd_datetime_end"
                                name="upd_datetime_end" />
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="upd_is_turnover" name="upd_is_turnover" />
                            <label class="form-check-label" for="upd_is_turnover">Turned Over</label>
                        </div>
                        <div>
                            <label for="upd_diagnosis" class="form-label">Diagnosis</label>
                            <textarea class="form-control" id="upd_diagnosis" name="upd_diagnosis"></textarea>
                        </div>
                        <div>
                            <label for="upd_action_taken" class="form-label">Action Taken</label>
                            <textarea class="form-control" id="upd_action_taken" name="upd_action_taken"></textarea>
                        </div>
                        <div>
                            <label for="upd_remarks" class="form-label">Remarks</label>
                            <textarea class="form-control" id="upd_remarks" name="upd_remarks"></textarea>
                        </div>
                        <?php
                    }
                    ?>
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