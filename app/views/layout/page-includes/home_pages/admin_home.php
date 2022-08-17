<?php
$cc = 5;
?>
<input type="hidden" id="admin_from_value" value="<?php echo strtotime('last friday', strtotime('-3 months'));?>" />
<input type="hidden" id="admin_to_value" value="<?php echo strtotime('last friday', strtotime('tomorrow'));?>" />
<div class="row">
    <div class="col-md-12 col-xl-2 order-xl-2 mb-3">
        <div class="card cardholder quicklinkscardholder h-100">
            <div class="card-header text-center">Quick Links</div>
            <div class="card-body">
                <div class="quicklink">
                    <a href="/jobs/add-job">
                        <span class="fa-layers fa-fw"><i class="fa-duotone fa-truck-container"></i><i class="fa-solid fa-plus" data-fa-transform="shrink-8 up-5 right-10"></i></span>&nbsp;
                        Add A Job
                    </a>
                </div>
                <div class="quicklink">
                    <a href="/clients/add-client">
                        <span class="fa-layers fa-fw"><i class="fa-duotone fa-user-tie"></i><i class="fa-solid fa-plus" data-fa-transform="shrink-8 up-5 right-8"></i></span>&nbsp;
                        Add A Client
                    </a>
                </div>
                <div class="quicklink">
                    <a href="depots/add-depot">
                        <span class="fa-layers fa-fw"><i class="fa-duotone fa-warehouse-full"></i><i class="fa-solid fa-plus" data-fa-transform="shrink-8 up-6 right-12"></i></span>&nbsp;
                        Add A Depot
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col col-md-12 col-xl-10 order-xl-1">
        <div class="card cardholder jobscardholder h-100">
            <div class="card-header text-center">Jobs</div>
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