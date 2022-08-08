<?php
$display = (!empty(Form::value('role_id')) && Form::value('role_id') == $client_role_id)? "block" : "none";
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <form id="add_user" method="post" action="/form/procUserAdd">

        </form>
    </div>
</div>