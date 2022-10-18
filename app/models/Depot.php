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