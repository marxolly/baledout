<?php
$cc = 5;
?>
<input type="hidden" id="admin_from_value" value="<?php echo strtotime('last friday', strtotime('-3 months'));?>" />
<input type="hidden" id="admin_to_value" value="<?php echo strtotime('last friday', strtotime('tomorrow'));?>" />
<div class="row">
    <div class="col-md-12 col-xl-2 col-lg-3 order-lg-2 mb-3">
        <div class="card cardholder quicklinkscardholder h-100">
            <div class="card-header text-center">Unassigned Jobs</div>
            <div class="card-body">

            </div>
        </div>
    </div>
    <div class="col col-md-12 col-xl-10 col-lg-9 order-lg-1">
        <div class="card cardholder jobscardholder h-100">
            <div class="card-header text-center">Assigned Jobs</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <select id="calendar_view"  class="form-control selectpicker mb-3" data-style="btn-outline-bo">
                            <option data-view-name="week" value="week">Weekly</option>
                            <option data-view-name="month" value="month">Monthly</option>
                            <option data-view-name="day" value="day">Daily</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button id="today" class="btn btn-outline-bo mb-3">Today</button>
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                             <div id="prev" class="direction col-1">
                                <h2><i class="fa-light fa-circle-chevron-left"></i></h2>
                            </div>
                            <div class="col-8 text-center">
                                <span class="navbar--range"></span>
                            </div>
                            <div id="next" class="direction col-1">
                                <h2><i class="fa-light fa-circle-chevron-right"></i> </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="calendar" style="height: 650px"></div>
            </div>
        </div>
    </div>
</div>