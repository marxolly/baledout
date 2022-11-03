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

    public function __construct(){}

}