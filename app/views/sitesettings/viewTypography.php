<?php
$panel_classes = array(
    'primary',
    'info',
    'success',
    'warning',
    'danger'
);
$c = 1;
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <?php //echo $user_role; die();?>
        <?php if($user_role == "admin"):?>
            <input type="hidden" id="admin_from_value" value="<?php echo strtotime('last friday', strtotime('-3 months'));?>" />
            <input type="hidden" id="admin_to_value" value="<?php echo strtotime('last friday', strtotime('tomorrow'));?>" />
            <div class="row">
                <h1>Header 1</h1>
                <h2>Header 2</h2>
                <h3>Header 3</h3>
                <h4>Header 4</h4>
                <p>Standard paragraph of text.</p>
                <p>With a <a href="#">LINK</a> before a break<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec euismod mattis felis et iaculis. Donec iaculis vehicula consequat. Curabitur ac elit vel urna molestie iaculis. Etiam tristique ligula nec commodo imperdiet. Phasellus iaculis, elit at porttitor congue, odio orci faucibus lacus, vel dapibus enim urna id sapien. Sed ultricies nulla est, quis consectetur sapien placerat ut. Morbi congue congue erat non iaculis. Nam ultrices sem sit amet interdum egestas. Etiam vel placerat tortor. Cras non pulvinar purus. Nam id feugiat dui. Quisque eleifend varius nisl, ac varius augue fringilla dapibus. Quisque quis volutpat lacus, et ultricies nisi. Aliquam erat volutpat. Sed rhoncus nibh eget nunc fringilla, vel pretium eros dictum.</p>
            </div><!-- end 1st row -->
            <div class="row"><!-- second row -->
                    <ul class="list-group">
                        <li class="list-group-item">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        <li class="list-group-item">Quisque consequat tellus vitae justo pharetra ultricies.</li>
                        <li class="list-group-item">Mauris eget nisl dictum, tristique lorem vitae, rhoncus leo.</li>
                        <li class="list-group-item">Aliquam non tellus interdum, tincidunt lorem vitae, varius purus.</li>
                        <li class="list-group-item">Morbi eu nisi finibus, scelerisque orci non, consequat felis.</li>
                        <li class="list-group-item">Sed non felis a arcu vestibulum mattis quis eget metus.</li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Morbi iaculis diam id lectus sagittis vestibulum.</li>
                        <li class="list-group-item">Etiam facilisis est ultrices nunc porta malesuada.</li>
                        <li class="list-group-item">Nunc vel diam varius mi tempus lacinia.</li>
                    </ul>
            </div> <!-- end 2nd row -->
            <div class="row">
                <h2>Buttons</h2>
                <p>
                    <button type="button" class="btn btn-primary">Primary</button>
                    <button type="button" class="btn btn-secondary">Secondary</button>
                    <button type="button" class="btn btn-success">Success</button>
                    <button type="button" class="btn btn-danger">Danger</button>
                    <button type="button" class="btn btn-warning">Warning</button>
                    <button type="button" class="btn btn-info">Info</button>
                    <button type="button" class="btn btn-light">Light</button>
                    <button type="button" class="btn btn-dark">Dark</button>
                    <button type="button" class="btn btn-link">Link</button>
                </p>

            </div>
            <div class="row">
                <h2>Cards</h2>
            </div>
            <div class="row">
                <h3>Two Columns</h3>
                <div class="col-md-6">
                    <div class="card border-primary mb-3">
                        <div class="card-header border-bottom-primary">Primary Card</div>
                        <div class="card-body">
                            <h5 class="card-title">Primary card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">Success Panel</div>
                        <div class="panel-body">
                            Panel content
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h3>Three Columns</h3>
                <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">Info Panel</div>
                        <div class="panel-body">
                            Panel content
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-warning">
                        <div class="panel-heading">Warning Panel</div>
                        <div class="panel-body">
                            Panel content
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-danger">
                        <div class="panel-heading">Danger Panel</div>
                        <div class="panel-body">
                            Panel content
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h2>Table</h2>
                <table width="100%" class="table-striped table-hover" id="the_table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Table Head 1</th>
                            <th>Table Head 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Table Head 1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sodales.</td>
                            <td data-label="Table Head 2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sodales.</td>
                        </tr>
                        <tr>
                            <td data-label="Table Head 1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sodales.</td>
                            <td data-label="Table Head 2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sodales.</td>
                        </tr>
                        <tr>
                            <td data-label="Table Head 1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sodales.</td>
                            <td data-label="Table Head 2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sodales.</td>
                        </tr>
                        <tr>
                            <td data-label="Table Head 1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sodales.</td>
                            <td data-label="Table Head 2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sodales.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php else:?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="errorbox">
                        <div class="row">
                            <div class="col-lg-2" style="font-size:96px">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="col-lg-6">
                                <h2>User Classification Error</h2>
                                <p>Sorry, there has been an error determining your access priviledges</p>
                                <p><a href="/login/logout">Please click here to login again</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </div>
</div>