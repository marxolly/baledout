<?php

 /**
  * Driver Class
  *

  * @author     Mark Solly <mark@baledout.com.au>

  FUNCTIONS
  addDriver($data)
  getAllDrivers($active = 1)
  getDriverId($name)
  getDriverInfo($driverId)
  getDriverName($driver_id)
  updateDriverInfo($data)

  */

class Driver extends Model{

    /**
    * Table name for this & extending classes.
    *
    * @var string
    */
    public $table = "drivers";
    public $addresses_table = "addresses";
    public $users_table = "users";

    public function __construct(){}


    public function getDriversDetails($active = -1, $driver_id = 0)
    {
        $db = Database::openConnection();
        $q = "
            SELECT
                d.*,
                dd.*,
                CASE
                    WHEN d.address = 0
                    THEN NULL
                    ELSE
                    GROUP_CONCAT(
                    	IFNULL(a.address,''),'|',
                        IFNULL(a.address_2,''),'|',
                        IFNULL(a.suburb,''),'|',
                        IFNULL(a.state,''),'|',
                        IFNULL(a.postcode,''),'|'
                        SEPARATOR '~'
                    )
                END AS a_string
            FROM
                {$this->table} d LEFT JOIN
                {$this->addresses_table} a ON d.address = a.id LEFT JOIN
                {$this->users_table} dd ON d.user_id = dd.id
            WHERE
                1 = 1
        ";
        if($driver_id > 0)
            $q .= " AND d.id = $driver_id";
        if($active >= 0)
            $q .= " AND d.active = $active";
        $q .= "
            GROUP BY
                d.id
            ORDER BY
                d.name
        ";
        //die($q);
        if($driver_id > 0)
            return ($db->queryRow($q));
        else
            return ($db->queryData($q));
    }

    public function checkDriverABN($ABN, $current_ABN)
    {
        $db = Database::openConnection();
        $ABN = preg_replace('/\s+/', '', $ABN);
        $current_ABN = preg_replace('/\s+/', '', $current_ABN);
        $q = "SELECT abn FROM {$this->table}";
        $rows = $db->queryData($q);
        $valid = 'true';
        foreach($rows as $row)
        {
        	if($ABN == preg_replace('/\s+/','',$row['abn']) && $ABN != $current_ABN)
        	{
        		$valid = 'false';
        	}
        }
        return $valid;
    }

}