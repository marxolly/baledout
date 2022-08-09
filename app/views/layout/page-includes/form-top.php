<div class="row">
    <div class="col-lg-12 offset-xl-1 col-xl-10">
        <?php if(isset($_SESSION['feedback'])) :?>
           <div class='feedbackbox'><?php echo Session::getAndDestroy('feedback');?></div>
        <?php endif; ?>
        <?php if(isset($_SESSION['errorfeedback'])) :?>
           <div class='errorbox'><?php echo Session::getAndDestroy('errorfeedback');?></div>
        <?php endif; ?>
        <a id="form_top"></a>
        <?php if(Form::$num_errors > 0) :?>
            <div class="errorbox">
                <div class="row">
                    <div class="col-4 col-md-2 text-end">
                        <i class="fad fa-exclamation-triangle fa-6x"></i>
                    </div>
                    <div class="col-8 col-md-10">
                        <h2>Sorry, some errors were found with the form.</h2>
                        <p>Please correct where shown and re-submit.</p>
                    </div>
                </div>
            </div>
        <?php elseif(isset($_SESSION['feedback'])):?>
            <div class="feedbackbox">
                <div class="row">
                    <div class="col-4 col-md-2 text-end">
                        <i class="fad fa-badge-check fa-6x"></i>
                    </div>
                    <div class="col-8 col-md-10">
                        <h2>Form successfully processed</h2>
                        <?php echo Session::getAndDestroy('feedback');?>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <!--p class="text-info">fields marked <sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> are required</p-->
    </div>
</div>