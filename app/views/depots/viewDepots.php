<?php
    $link_text = (!$active)? "<a href='/depots/view-depots' class='btn btn-outline-bo'>View Active Depots</a>" : "<a href='/depots/view-depots/active=0' class='btn btn-outline-bo'>View Inactive Depots</a>";
    $i = 1;
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div class="row">
            <div class="col">
                <p class="text-right"><?php echo $link_text;?></p>
            </div>
        </div>
    </div>
    <?php if(count($depots)):?>
        <?php //echo "<pre>",print_r($depots),"</pre>";die();?>
            <div id="waiting" class="row">
                <div class="col-lg-12 text-center">
                    <h2>Drawing Table..</h2>
                    <p>May take a few moments</p>
                    <img class='loading' src='/images/preloader.gif' alt='loading...' />
                </div>
            </div>
        <div class="row" id="table_holder" style="display:none">
            <div class="col-12">
                <table id="depot_list_table" class="table-striped table-hover" width="100%">
                     <thead>
                        <tr>
                            <th>Depot Name</th>
                            <th>Depot Abbreviation</th>
                            <th>Main Phone</th>
                            <th>Main Email</th>
                            <th>Address</th>
                            <th>Contacts</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($depots as $d):
                            $email = (!empty($d['email']))? "<a href='mailto:".$d['email'].">".$d['email']."</a>":"";
                            $a_string = "";
                            if($d['address'] > 0)
                            {
                                list($a_array['address'],$a_array['address_2'],$a_array['suburb'],$a_array['state'],$a_array['postcode']) = explode("|", $d['a_string']);
                                $a_string = "<div class='mb-3'>".Utility::formatAddressWeb($a_array)."</div>";
                            }?>
                            <td><?php echo ucwords($d['name']);?></td>
                            <td><?php echo strtoupper($d['abbreviation']);?></td>
                            <td><?php echo $d['phone'];?></td>
                            <td><?php echo $email;?></td>
                            <td><?php echo $a_string;?></td>
                            <td><?php if(!empty($d['contacts'])) echo Utility::generateContactsString($d['contacts']);?></td>
                            <td>
                                <p><a class="btn btn-outline-bo" href="/depots/edit-depot/depot=<?php echo $d['id'];?>" >Edit Details</a></p>
                            </td>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else:?>
        <div class="row">
            <div class="col-lg-12">
                <div class="errorbox">
                    <h2>No Depots Listed</h2>
                    <p>You might want to <a href="/depots/add-depot/">add one</a></p>
                </div>
            </div>
        </div>
    <?php endif;?>
</div>