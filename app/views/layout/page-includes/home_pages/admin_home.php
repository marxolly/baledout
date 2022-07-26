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
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4">
                    <?php for($c = 1; $c <= 5; $c++):
                        $logo_path = DOC_ROOT.'/images/client_logos/tn_default.png';?>
                        <div class="col mb-3">
                            <div class="card homepagecard">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-5 d-sm-none d-md-block col-md-5">
                                            <img src="/images/client_logos/tn_default.png" alt="client logo" class="img-thumbnail" />
                                        </div>
                                        <div class="col-7 col-sm-12 col-md-7">
                                            <h5 class="d-none d-md-block">Client Number <?php echo $c;?> Name</h5>
                                            <h4 class="d-md-none">Client Number <?php echo $c;?> Name</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    Count the jobs
                                </div>
                                <div class="card-footer text-center">
                                    <a class="btn btn-outline-bo" href="#">Manage Jobs</a>
                                </div>
                            </div>
                        </div>
                    <?php endfor;?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-xl-3 d-none d-md-block">
        <div class="card cardholder quicklinkscardholder">
            <div class="card-header text-center">Quick Links</div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>