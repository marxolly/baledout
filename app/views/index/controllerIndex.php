<?php
//echo "PAGE NAME: <p>$page_name</p>";
//echo "<pre>",print_r($pages),"</pre>"; die();
$con_index = strtolower(str_replace(" ", "-", $page_name));
//die($page_name);
$sections = $pages[$con_index];
ksort($sections);
$page_title = $sections['default-icon']['icon']." ".$page_title;
$role = Session::getUserRole();
$resource = strtolower(str_replace(" ", "", $page_name));
//echo "Sections<pre>",print_r($sections),"</pre>";
//echo "<p>Current Resource: $resource</p>";
//echo "<p>Checking Role: $role</p>";
//echo "<pre>",print_r(Permission::$perms),"</pre>";
?>
<div id="page-wrapper">
    <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
    <div id="page_container" class="container-xxl"> 
        <div class="row">
            <?php foreach($sections as $section_name => $details):
                if(!isset($details['display']) || !$details['display']) continue;
                $SectionName = ucwords(str_replace("-", " ", $section_name));
                $action = Utility::toCamelCase($SectionName);
                //echo "<p>Checking Action: $action</p>";
                if(Permission::check($role, $resource, $action, [], false)):?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h4><?php echo $SectionName;?></h4>
                            </div>
                            <div class="card-body text-center">
                            	<a class="btn btn-lg btn-outline-fsg controller-index-link" href="/<?php echo $con_index."/".$section_name;?>"><?php echo $details['icon'];?></a>
                            </div>
                        </div>
                    </div>

                <?php endif;?>
            <?php endforeach;?>
        </div>
    </div>
</div>
