<!-- Modal -->
<div class="modal fade" id="updhelpdesksmodal" tabindex="-1">
    <div class="modal-dialog">
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

<!-- Modal -->
<div class="modal fade" id="add_helpdesks" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Add ICT Request</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 form-validation">
                    <div>
                        <label for="date_requested" class="form-label">Date of Request</label>
                        <input type="date" class="form-control" id="date_requested" name="date_requested"
                            value="<?= date('Y-m-d') ?>" required />
                    </div>
                    <div>
                        <label for="request_types_id" class="form-label">Type of Request</label>
                        <select type="text" class="form-select select-init" id="request_types_id"
                            name="request_types_id" required>
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
                        <select type="text" class="form-select" id="sub_categories_id" name="sub_categories_id"
                            required>
                            <option value="" selected disabled>choose...</option>
                        </select>
                    </div>
                    <div>
                        <label for="complaint" class="form-label">Defect, Complaint, or Request</label>
                        <textarea class="form-control" id="complaint" name="complaint"></textarea>
                    </div>
                    <div>
                        <label for="datetime_preferred" class="form-label">Preferred date and time</label>
                        <input type="datetime-local" class="form-control" id="datetime_preferred"
                            name="datetime_preferred" />
                    </div>
                    <div hidden>
                        <input class="captcha-token" name="captcha-token" />
                        <input name="add_helpdesks" />
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add_meetings" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Add Zoom Request</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 form-validation">
                    <div>
                        <label for="date_requested" class="form-label">Date of Request</label>
                        <input type="date" class="form-control" id="date_requested" name="date_requested"
                            value="<?= date('Y-m-d') ?>" required />
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
                        <input class="captcha-token" name="captcha-token" />
                        <input name="add_meetings" />
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>