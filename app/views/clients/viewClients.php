<?php
    $link_text = (!$active)? "<a href='/clients/view-clients' class='btn btn-outline-bo'>View Active Clients</a>" : "<a href='/clients/view-clients/active=0' class='btn btn-outline-bo'>View Inactive Clients</a>";
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
        <?php if(count($clients)):?>
            <?php echo "<pre>",print_r($clients),"</pre>";?>
            <div id="waiting" class="row">
                <div class="col-lg-12 text-center">
                    <h2>Drawing Table..</h2>
                    <p>May take a few moments</p>
                    <img class='loading' src='/images/preloader.gif' alt='loading...' />
                </div>
            </div>
            <div class="row" id="table_holder" style="display:none">
                <div class="col-12">
                    <table id="client_list_table" class="table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Address</th>
                                <th>Contacts</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($clients as $c):
                                $logo_path = DOC_ROOT.'/images/client_logos/tn_'.$c['logo'];
                                $add_array = [
                                    'address'   => $c['address'],
                                    'address_2' => $c['address_2'],
                                    'suburb'    => $c['suburb'],
                                    'state'     => $c['state'],
                                    'postcode'  => $c['postcode']
                                ];
                                $add_string = Utility::formatAddressWeb($add_array);
                                ?>
                                <td>
                                    <?php if(file_exists($logo_path)):?>
                                        <img src="/images/client_logos/tn_<?php echo $c['logo'];?>" alt="client logo" class="img-thumbnail" /><br>
                                    <?php endif;?>
                                    <?php echo $c['client_name'];?>
                                </td>
                                <td><?php echo $add_string;?></td>
                                <td><?php if(!empty($c['contacts'])) echo Utility::generateContactsString($c['contacts']);?></td>
                                <td>
                                    <p><a class="btn btn-outline-bo" href="/clients/edit-client/client=<?php echo $c['id'];?>" >Edit Details</a></p>
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
                        <h2>No Clients Listed</h2>
                        <p>You might want to <a href="/clients/add-client/">add one</a></p>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </div>
</div>