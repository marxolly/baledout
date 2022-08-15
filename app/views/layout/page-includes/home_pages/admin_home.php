<?php
$cc = 5;
?>
<input type="hidden" id="admin_from_value" value="<?php echo strtotime('last friday', strtotime('-3 months'));?>" />
<input type="hidden" id="admin_to_value" value="<?php echo strtotime('last friday', strtotime('tomorrow'));?>" />
<div class="row">
    <div class="col col-md-8 col-xl-9">
        <div class="card cardholder jobscardholder">
            <div class="card-header text-center">Jobs</div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-xl-3 d-none d-md-block">
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
</div>