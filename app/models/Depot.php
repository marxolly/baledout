<?php

 /**
  * Depot Class
  *

  * @author     Mark Solly <mark@baledout.com.au>
  *
  */

 class Depot extends Model{

     /**
      * Table name for this & extending classes.
      *
      * @var string
      */
    public $table = "depots";
    public $contacts_table = "depots_contacts";
    public $addresses_table = "addresses";

    public function __construct(){}

    public function addDepot($data)
    {
        //echo "The request<pre>",print_r($data),"</pre>";die();
        $db = Database::openConnection();
        $depot_values = array(
            'depot_name'		=>	$data['depot_name'],
            'abbreviation'		=>	$data['abbreviation']
        );
        if(!empty($data['email'])) $client_vales['email'] = $data['email'];
        if(!empty($data['phone'])) $client_vales['phone'] = $data['phone'];

        $depot_id = $db->insertQuery($this->table, $depot_values);

        if(!empty($data['address']) && !empty($data['suburb']) && !empty($data['state']) && !empty($data['postcode']) )
        {
            $address_array = [
                'address'   => $data['deliveryaddress'],
                'suburb'    => $data['deliverysuburb'],
                'state'     => $data['deliverystate'],
                'postcode'  => $data['deliverypostcode'],
            ];
            if( isset($data['address2']) && !empty($data['address2']))
                $address_array['address_2'] = $data['address2'];
            if( !$address_id = $db->queryValue('addresses', $address_array) )
            {
                //echo "DID NOT FIND <pre>",print_r($postal_array),"</pre>";die();
                $address_id = $db->insertQuery('addresses', $address_array);

            }
            $db->updateDatabaseField($this->table, 'address', $address_id, $depot_id);
        }

        $depot_contact = new Contact();
        foreach($data['contacts'] as $ind => $cd)
        {
            if( empty($cd['name']) && empty($cd['role']) )
                continue;
            $contact = [];
            $contact['depot_id'] = $depot_id;
            if(isset($cd['name'])) $contact['name'] = $cd['name'];
            if(isset($cd['role'])) $contact['role'] = $cd['role'];
            if(isset($cd['email'])) $contact['email'] = $cd['email'];
            if(isset($cd['phone'])) $contact['phone'] = $cd['phone'];
            $depot_contact->addContact($contact, "depots");
        }
        return $depot_id;
    }

    public function getDepotsDetails($active = -1, $depot_id = 0)
    {
        $db = Database::openConnection();
        $q = "
            SELECT
                d.*,
                GROUP_CONCAT(
                    IFNULL(dc.id,0),'|',
                    IFNULL(dc.name,''),'|',
                    IFNULL(dc.role,''),'|',
                    IFNULL(dc.email,''),'|',
                    IFNULL(dc.phone,''),'|'
                    SEPARATOR '~'
                ) AS contacts,
                CASE
                    WHEN d.address = 0
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
                END AS a_string
            FROM
                {$this->table} d LEFT JOIN
                {$this->contacts_table} dc ON dc.depot_id = d.id LEFT JOIN
                {$this->addresses_table} da ON d.address = da.id
            WHERE
                dc.active = 1
        ";
        if($depot_id > 0)
            $q .= " AND d.id = $depot_id";
        if($active >= 0)
            $q .= " AND d.active = $active";
        $q .= "
            GROUP BY
                d.id
            ORDER BY
                d.depot_name
        ";
        //die($q);
        if($depot_id > 0)
            return ($db->queryRow($q));
        else
            return ($db->queryData($q));
    }

    public function getDepotId($name)
    {
        $db = Database::openConnection();
        return $db->queryValue($this->table, array('depot_name' => $name));
    }

     public function getDepotName($depot_id)
    {
        $db = Database::openConnection();
        return $db->queryValue($this->table, array('id' => $depot_id), 'depot_name');
    }

    public function checkDepotAbbrevs($abbrev, $current_abbrev)
    {
        $db = Database::openConnection();
        $abbrev = strtoupper($abbrev);
        $current_abbrev = strtoupper($current_abbrev);
        $q = "SELECT abbreviation FROM {$this->table}";
        $rows = $db->queryData($q);
        $valid = 'true';
        foreach($rows as $row)
        {
        	if($abbrev == strtoupper($row['abbreviation']) && $abbrev != $current_abbrev)
        	{
        		$valid = 'false';
        	}
        }
        return $valid;
    }

    public function depotAbbreviationTaken($abbrev, $current_abbrev = false)
    {
        //echo $abbrev;
        //echo "<p>Current Abbrev: $current_abbrev</p>";
        //die();
        $db = Database::openConnection();
        if($current_abbrev)
        {
            return ($db->fieldValueTaken($this->table, $abbrev, 'abbreviation') && $abbrev != $current_abbrev);
        }
        return $db->fieldValueTaken($this->table, $abbrev, 'abbreviation');

    }

 }//end class