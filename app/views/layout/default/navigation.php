<?php
$icons = Config::get("MENU_ICONS");
if(Session::getIsLoggedIn()):
    //echo "<pre>",print_r($_SESSION),"</pre>";
    $user_role = (Session::isAdminUser())? 'admin' : Session::getUserRole();
    $user_role = str_replace(" ","_", $user_role);
    $super_admin = (Session::getUserRole() == "super admin");
    //echo strtoupper($user_role."_PAGES");
    $pages = Config::getPages(strtoupper($user_role."_PAGES"));
    $user_info = $this->controller->user->getProfileInfo(Session::getUserId());
    $image = $user_info['image'];
else:
    $pages = array();
    $image = "/images/profile_pictures/default.png";
endif;
//echo "<pre>",print_r($pages),"</pre>";die();
//echo "<pre>",print_r($_SESSION),"</pre>";
?>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg fixed-top navbar-dark" style="background-color: transparent; height:120px;">
    <div class="container-fluid">
        <a href="/" class="navbar-brand">
            <img class="bo_logo"  src="/images/BO_logo1.png" alt="Baledout Logo" title="Portal Home">
        </a>
        <button id="navbar_toggler" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav">
                <?php if(isset($pages) && !empty($pages) && count($pages)):?>
                    <?php foreach($pages as $section => $spages):
                        if( (isset($pages[$section]['super_admin_only']) && $pages[$section]['super_admin_only'] == true) )
                        {
                            if(Session::getUserRole() != "super admin")
                                continue;
                        }
                        if($pages[$section][$section."-index"]):
                            $Section = ucwords(str_replace("-", " ", $section));?>
                            <a class="nav-link" id="<?php echo $section;?>" href="<?php echo "/$section/";?>"><?php echo $Section;?></a>
                        <?php endif;?>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
        <div id="user_info" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-user" src="<?php echo $image;?>" /><br/>
                <strong><?php echo Session::getUsersName(); ?></strong>
            </a>
            <div  class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a href="/user/profile" class="dropdown-item"><i class="fa fa-user fa-fw"></i> Profile</a>
                <a href="/login/logOut" class="dropdown-item"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </div>
        </div>
    </div>
</nav>
<!-- End Navigation -->
<!-- Common Page Header -->
<div id="page_header" class="row">
    <div class="col-lg-12">
        <h1>Baledout Web Portal</h1>
    </div>
</div>
