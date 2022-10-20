<?php

 /**
  * Client Class
  *

  * @author     Mark Solly <mark@baledout.com.au>

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
    public $contacts_table = "clients_contacts";
    public $addresses_table = "addresses";
    public $charges_table = "client_charges";

    public function __construct(){}

    public function getClientId($name)
    {
        $db = Database::openConnection();
        return $db->queryValue($this->table, array('client_name' => $name));
    }

    public function addClient($data)
    {
        //echo "The request<pre>",print_r($data),"</pre>";die();
        $db = Database::openConnection();
        $client_values = array(
            'client_name'		=>	$data['client_name']
        );
        if(!empty($data['email'])) $client_vales['email'] = $data['email'];
        if(!empty($data['phone'])) $client_vales['phone'] = $data['phone'];
        if(!empty($data['website'])) $client_vales['website'] = $data['website'];
        if(isset($data['image_name'])) $client_values['logo'] = $data['image_name'].".jpg";

        $client_id = $db->insertQuery($this->table, $client_values);

        if(!empty($data['deliveryaddress']) && !empty($data['deliverysuburb']) && !empty($data['deliverystate']) && !empty($data['deliverypostcode']) )
        {
            $delivery_array = [
                'address'   => $data['deliveryaddress'],
                'suburb'    => $data['deliverysuburb'],
                'state'     => $data['deliverystate'],
                'postcode'  => $data['deliverypostcode'],
            ];
            if( isset($data['deliveryaddress2']) && !empty($data['deliveryaddress2']))
                $delivery_array['address_2'] = $data['deliveryaddress2'];
            if( !$delivery_id = $db->queryValue('addresses', $delivery_array) )
            {
                //echo "DID NOT FIND <pre>",print_r($postal_array),"</pre>";die();
                $delivery_id = $db->insertQuery('addresses', $delivery_array);

            }
            $db->updateDatabaseField($this->table, 'delivery_address', $delivery_id, $client_id);
        }

        if(!empty($data['billingaddress']) && !empty($data['billingsuburb']) && !empty($data['billingstate']) && !empty($data['billingpostcode']) )
        {
            $billing_array = [
                'address'   => $data['billingaddress'],
                'address_2' => (!empty($data['billingaddress2']))? $data['billingaddress2'] : NULL,
                'suburb'    => $data['billingsuburb'],
                'state'     => $data['billingstate'],
                'postcode'  => $data['billingpostcode'],
            ];
            if( isset($data['billingaddress2']) && !empty($data['billingaddress2']))
                $billing_array['address_2'] = $data['billingaddress2'];
            if( !$billing_id = $db->queryValue('addresses', $billing_array) )
            {
                $billing_id = $db->insertQuery('addresses', $billing_array);
            }
            $db->updateDatabaseField($this->table, 'billing_address', $billing_id, $client_id);
        }

        $client_contact = new Contact();
        foreach($data['contacts'] as $ind => $cd)
        {
            $contact = [];
            $contact['name'] = $cd['name'];
            $contact['client_id'] = $client_id;
            if(isset($cd['role'])) $contact['role'] = $cd['role'];
            if(isset($cd['email'])) $contact['email'] = $cd['email'];
            if(isset($cd['phone'])) $contact['phone'] = $cd['phone'];
            $client_contact->addContact($contact, "clients");
        }
        return $client_id;
    }

    public function getAllClients($active = 1)
    {
        $db = Database::openConnection();
        $query = "
            SELECT
                c.*,
                GROUP_CONCAT(
                    IFNULL(cc.id,0),'|',
                    IFNULL(cc.name,''),'|',
                    IFNULL(cc.role,''),'|',
                    IFNULL(cc.email,''),'|',
                    IFNULL(cc.phone,''),'|'
                    SEPARATOR '~'
                ) AS contacts
            FROM
                {$this->table} c JOIN
                {$this->contacts_table} cc ON cc.client_id = c.id
            WHERE
                c.active=$active
            GROUP BY
                c.id
            ORDER BY
                c.client_name
        ";
        return($db->queryData($query));
    }

    public function getClientsDetails($active = -1, $client_id = 0)
    {
        $db = Database::openConnection();
        $q = "
            SELECT
                c.*,
                GROUP_CONCAT(
                    IFNULL(cc.id,0),'|',
                    IFNULL(cc.name,''),'|',
                    IFNULL(cc.role,''),'|',
                    IFNULL(cc.email,''),'|',
                    IFNULL(cc.phone,''),'|'
                    SEPARATOR '~'
                ) AS contacts,
                CASE
                    WHEN c.delivery_address = 0
                    THEN NULL
                    ELSE
                    GROUP_CONCAT(
                    	IFNULL(da.address,''),'|',
                        IFNULL(da.address_2,''),'|',
                        IFNULL(da.suburb,''),'|',
                        IFNULL(da.state,''),'|',
                        IFNULL(da.postcode,''),'|'
                        SEPARATOR '~'
                    )
                END AS da_string,
                CASE
                    WHEN c.billing_address = 0
                    THEN NULL
                    ELSE
                    GROUP_CONCAT(
                    	IFNULL(ba.address,''),'|',
                        IFNULL(ba.address_2,''),'|',
                        IFNULL(ba.suburb,''),'|',
                        IFNULL(ba.state,''),'|',
                        IFNULL(ba.postcode,''),'|'
                        SEPARATOR '~'
                    )
                END AS ba_string
            FROM
                {$this->table} c JOIN
                {$this->contacts_table} cc ON cc.client_id = c.id LEFT JOIN
                {$this->addresses_table} da ON c.delivery_address = da.id LEFT JOIN
                {$this->addresses_table} ba ON c.billing_address = ba.id
            WHERE
                cc.active = 1
        ";
        if($client_id > 0)
            $q .= " AND c.id = $client_id";
        if($active >= 0)
            $q .= " AND c.active = $active";
        $q .= "
            GROUP BY
                c.id
            ORDER BY
                c.client_name
        ";
        //die($q);
        if($client_id > 0)
            return ($db->queryRow($q));
        else
            return ($db->queryData($q));
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
        //set the defaults
        $client_values = array(
            'client_name'	    => $data['client_name'],
            'email'             => NULL,
            'phone'             => NULL,
            'website'           => NULL,
            'active'            => (isset($data['active']))? 1:0,
            'delivery_address'  => 0,
            'billing_address'   => 0
        );
        //make changes
        if(!empty($data['email'])) $client_vales['email'] = $data['email'];
        if(!empty($data['phone'])) $client_vales['phone'] = $data['phone'];
        if(!empty($data['website'])) $client_vales['website'] = $data['website'];
        if(isset($data['image_name'])) $client_values['logo'] = $data['image_name'].".jpg";
        elseif(isset($data['delete_logo'])) $client_values['logo'] = "default.png";
        //update addresses
        if(!empty($data['deliveryaddress']) && !empty($data['deliverysuburb']) && !empty($data['deliverystate']) && !empty($data['deliverypostcode']) )
        {
            $delivery_array = [
                'address'   => $data['deliveryaddress'],
                'suburb'    => $data['deliverysuburb'],
                'state'     => $data['deliverystate'],
                'postcode'  => $data['deliverypostcode'],
            ];
            if( isset($data['deliveryaddress2']) && !empty($data['deliveryaddress2']))
                $delivery_array['address_2'] = $data['deliveryaddress2'];
            if( !$delivery_id = $db->queryValue('addresses', $delivery_array) )
            {
                //echo "DID NOT FIND <pre>",print_r($postal_array),"</pre>";die();
                $delivery_id = $db->insertQuery('addresses', $delivery_array);

            }
            $client_values['delivery_address'] = $delivery_id;
        }
        if(!empty($data['billingaddress']) && !empty($data['billingsuburb']) && !empty($data['billingstate']) && !empty($data['billingpostcode']) )
        {
            $billing_array = [
                'address'   => $data['billingaddress'],
                'suburb'    => $data['billingsuburb'],
                'state'     => $data['billingstate'],
                'postcode'  => $data['billingpostcode'],
            ];
            if( isset($data['billingaddress2']) && !empty($data['billingaddress2']))
                $billing_array['address_2'] = $data['billingaddress2'];
            if( !$billing_id = $db->queryValue('addresses', $billing_array) )
            {
                $billing_id = $db->insertQuery('addresses', $billing_array);
            }
            $client_values['billing_address'] = $billing_id;
        }
        //update contacts
        $client_contact = new Contact();
        foreach($data['contacts'] as $ind => $cd)
        {
            if(isset($cd['deactivate']))
                $client_contact->deactivateContact($cd['contact_id'], "clients");
            else
            {
                $contact = [];
                $contact['name'] = $cd['name'];
                $contact['client_id'] = $data['client_id'];
                if(isset($cd['role'])) $contact['role'] = $cd['role'];
                if(isset($cd['email'])) $contact['email'] = $cd['email'];
                if(isset($cd['phone'])) $contact['phone'] = $cd['phone'];
                if($cd['contact_id'] == 0)
                    $client_contact->addContact($contact, "clients");
                else
                    $client_contact->editContact($contact, $cd['contact_id'], "clients");
            }
        }
        $db->updatedatabaseFields($this->table, $client_values, $data['client_id']);
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