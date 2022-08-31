<?php

 /**
  * Client Class
  *

  * @author     Mark Solly <mark.solly@fsg.com.au>

  FUNCTIONS
  addClient($data)
  getAllClients($active = 1)
  getClientId($name)
  getClientInfo($clientId)
  getClientName($client_id)
  updateClientInfo($data)

  */

class Client extends Model{

    /**
      * Table name for this & extending classes.
      *
      * @var string
      */
    public $table = "clients";
    public $charges_table = "client_charges";

    public function __construct(){}

    public function getClientId($name)
    {
        $db = Database::openConnection();
        return $db->queryValue($this->table, array('client_name' => $name));
    }

    public function addClient($data)
    {
        echo "The request<pre>",print_r($data),"</pre>";die();
        $db = Database::openConnection();
        $client_values = array(
            'client_name'		=>	$data['client_name']
        );
        if(!empty($data['email'])) $client_vales['email'] = $data['email'];
        if(!empty($data['phone'])) $client_vales['phone'] = $data['phone'];
        //echo "The request<pre>",print_r($client_values),"</pre>";die();
        if(!empty($data['contact_name'])) $client_values['contact_name'] = $data['contact_name'];
        if(isset($data['image_name'])) $client_values['logo'] = $data['image_name'].".jpg";
        if(isset($data['production_client'])) $client_values['production_client'] = 1;
        if(isset($data['delivery_client'])) $client_values['delivery_client'] = 1;
        if(isset($data['pick_pack'])) $client_values['pick_pack'] = 1;
        $client_values['can_adjust'] = (!isset($data['can_adjust']))? 0 : 1;
        $client_values['products_description'] = (!empty($data['products_description']))? $data['products_description']: null;

        $charges_values = array(
            'standard_truck'        => $data['standard_truck'],
            'urgent_truck'          => $data['urgent_truck'],
            'standard_ute'          => $data['standard_ute'],
            'urgent_ute'            => $data['urgent_ute'],
            'standard_bay'          => $data['standard_bay'],
            'oversize_bay'          => $data['oversize_bay'],
            '40GP_loose'            => $data['40GP_loose'],
            '20GP_loose'            => $data['20GP_loose'],
            '40GP_palletised'       => $data['40GP_palletised'],
            '20GP_palletised'       => $data['20GP_palletised'],
            'max_loose_40GP'        => $data['max_loose_40GP'],
            'max_loose_20GP'        => $data['max_loose_20GP'],
            'additional_loose'      => $data['additional_loose'],
            'repalletising'         => $data['repalletising'],
            'shrinkwrap'            => $data['shrinkwrap'],
            'service_fee'           => $data['service_fee'],
            'manual_order_entry'    => $data['manual_order_entry'],
            'pallet_in'             => $data['pallet_in'],
            'pallet_out'            => $data['pallet_in'],
            'carton_in'             => $data['carton_in'],
            'carton_out'            => $data['carton_out']
        );
        //
        //echo "CLIENT VALUES<pre>",print_r($client_values),"</pre>";die();
        $client_id = $db->insertQuery($this->table, $client_values);
        $charges_values['client_id'] = $client_id;
        //echo "CHARGES VALUES<pre>",print_r($charges_values),"</pre>";  die();
        $db->insertQuery($this->charges_table, $charges_values);
        return $client_id;
    }

    public function getAllClients($active = 1)
    {
        $db = Database::openConnection();
        $query = "SELECT * FROM {$this->table} WHERE active = $active ORDER BY client_name";
        return($db->queryData($query));
    }

    public function getClientInfo($client_id)
    {
        $db = Database::openConnection();
        $q = "SELECT * FROM {$this->table} c JOIN {$this->charges_table} cc ON c.id = cc.client_id WHERE c.id = $client_id";
        return ($db->queryRow($q));
    }

    public function getClientName($client_id)
    {
        $db = Database::openConnection();
        return $db->queryValue($this->table, array('id' => $client_id), 'client_name');
    }

    public function updateClientInfo($data)
    {
        //echo "The request<pre>",print_r($data),"</pre>";die();
        $db = Database::openConnection();
        $client_values = array(
            'client_name'		=>	$data['client_name'],
            'billing_email'		=>	$data['billing_email'],
            'sales_email'		=>	$data['sales_email'],
            'inventory_email'	=>	$data['inventory_email'],
            'deliveries_email'  =>  $data['deliveries_email'],
            'sales_contact'		=>	$data['sales_contact'],
            'inventory_contact'	=>	$data['inventory_contact'],
            'deliveries_contact'=>  $data['deliveries_contact'],
            'ref_1'				=>	$data['ref_1'],
            'address'	        =>	$data['address'],
            'suburb'	        =>	$data['suburb'],
            'state'		        =>	$data['state'],
            'postcode'	        =>	$data['postcode'],
            'country'           =>  $data['country']
        );
        $client_values['active'] = (isset($data['active']))? 1 : 0;
        $client_values['production_client'] = (isset($data['production_client']))? 1 : 0;
        $client_values['delivery_client'] = (isset($data['delivery_client']))? 1 : 0;
        $client_values['pick_pack'] = (isset($data['pick_pack']))? 1 : 0;
        $client_values['use_bubblewrap'] = (isset($data['use_bubblewrap']))? 1 : 0;
        $client_values['can_adjust'] = (!isset($data['can_adjust']))? 0 : 1;
        if(!empty($data['contact_name'])) $client_values['contact_name'] = $data['contact_name'];
        if(isset($data['image_name'])) $client_values['logo'] = $data['image_name'].".jpg";
        elseif(isset($_POST['delete_logo'])) $client_values['logo'] = "default.png";
        $client_values['products_description'] = (!empty($data['products_description']))? $data['products_description']: null;
        $db->updatedatabaseFields($this->table, $client_values, $data['client_id']);
        $charges_values = array(
            'standard_truck'        => $data['standard_truck'],
            'urgent_truck'          => $data['urgent_truck'],
            'standard_ute'          => $data['standard_ute'],
            'urgent_ute'            => $data['urgent_ute'],
            'standard_bay'          => $data['standard_bay'],
            'oversize_bay'          => $data['oversize_bay'],
            '40GP_loose'            => $data['40GP_loose'],
            '20GP_loose'            => $data['20GP_loose'],
            '40GP_palletised'       => $data['40GP_palletised'],
            '20GP_palletised'       => $data['20GP_palletised'],
            'max_loose_40GP'        => $data['max_loose_40GP'],
            'max_loose_20GP'        => $data['max_loose_20GP'],
            'additional_loose'      => $data['additional_loose'],
            'repalletising'         => $data['repalletising'],
            'shrinkwrap'            => $data['shrinkwrap'],
            'service_fee'           => $data['service_fee'],
            'manual_order_entry'    => $data['manual_order_entry'],
            'pallet_in'             => $data['pallet_in'],
            'pallet_out'            => $data['pallet_out'],
            'carton_in'             => $data['carton_in'],
            'carton_out'            => $data['carton_out']
        );
        //echo "<pre>",print_r($charges_values),"</pre>"; die();
        $db->updatedatabaseFields($this->charges_table, $charges_values, $data['charges_id']);
        return true;
    }

    public function getSelectClients($selected = false, $exclude = '')
    {
        $db = Database::openConnection();
        $check = "";
        $ret_string = "";
        $q = "SELECT id, client_name FROM clients WHERE active = 1";
        if(strlen($exclude))
        {
            $q .= " AND id NOT IN($exclude)";
        }
        $q .= " ORDER BY client_name";
        $clients = $db->queryData($q);
        foreach($clients as $c)
        {
            $label = $c['client_name'];
            $value = $c['id'];
            if($selected)
            {
                $check = ($value == $selected)? "selected='selected'" : "";
            }
            $ret_string .= "<option value='$value' $check >$label</option>";
        }
        return $ret_string;
    }
}
?>