<?php
$address = Form::value('address');
$address2 = Form::value('address2');
$suburb = Form::value('suburb');
$state = Form::value('state');
$postcode = Form::value('postcode');
$country = Form::value('country');
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <div class="row">
            <div class="col">
                <form id="send_a_message" method="post"  action="/form/procSendAMessage">
                    <div class="row">
                        <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                            <div class="row">
                                <div class="col">
                                    <h3>Type Your Message</h3>
                                    <p class="inst">fields marked <sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> are required</p>
                                </div>
                            </div>
                            <div class="p-3 light-grey mb-3">
                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Subject</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control required" name="subject" id="subject" value="<?php echo Form::value('subject');?>" />
                                        <?php echo Form::displayError('subject');?>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Message</label>
                                    <div class="col-md-4">
                                        <textarea class="form-control required ckeditor" name="message" id="message"><?php echo Form::value('message');?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                            <div class="row">
                                <div class="col">
                                    <h3>Send Your Message</h3>
                                </div>
                            </div>
                            <div class="p-3 light-grey mb-3">
                                <div class="form-group row">
                                    <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>">
                                    <input type="hidden" name="the_website" id="the_website" value="">
                                    <input type="hidden" name="loaded" id="loaded" value="<?php echo time();?>">
                                    <div class="col-md-4 offset-md-3 text-center text-md-start">
                                        <button type="submit" class="btn btn-outline-bo" id="submitter">Send It</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>