<?php

 /**
  * Postcode Class
  *

  * @author     Mark Solly <mark.solly@fsg.com.au>
  */

class Postcode extends Model{
    /**
      * Table name for this & extending classes.
      *
      * @var string
      */
    public $table = "postcodes";

    public function getAutocompleteSuburb($term)
    {
        $db = Database::openConnection();
        $q = strtoupper($term);
        if (!$q) return;

        $rows = $db->queryData("SELECT `postcode`, `state`, `suburb` FROM `postcodes` WHERE (`suburb` LIKE :term1) OR (`postcode` LIKE :term2)", array('term1' => '%'.$q.'%', 'term2' => '%'.$q.'%'));
        //echo $q;
        //print_r($rows);die();
        $return_array = array();

        foreach($rows as $row)
        {
        	$row_array['suburb'] = $row['suburb'];
        	$row_array['label'] = $row['suburb']."-".$row['state']." (".$row['postcode'].")";
        	$row_array['state'] = $row['state'];
            $row_array['postcode'] = $row['postcode'];
        	//$row_array['suburb'] = $row['suburb'];
        	array_push($return_array,$row_array);
        }
        return $return_array;
    }

    public function validateSuburb($suburb = NULL, $state = NULL, $postcode = NULL)
    {
        $response = array(
            'found' => true
        );
        if( empty($postcode) || empty($suburb) || empty($state) )
        {
            if( empty($postcode) )
            {
                $response['errors'][]['message'] = "No Postcode Supplied";
            }
            if( empty($suburb) )
            {
                $response['errors'][]['message'] = "No Suburb Supplied";
            }
            if( empty($state) )
            {
                $response['errors'][]['message'] = "No State Supplied";
            }
        }
        else
        {
            $db = Database::openConnection();
            $row = $db->queryRow(
                "SELECT * FROM ".$this->table." WHERE `postcode` = :postcode AND `suburb` = :suburb AND `state` = :state",
                [
                    'postcode'  => $postcode,
                    'suburb'    => $suburb,
                    'state'     => $state
                ]
            );
            if( empty($row) )
                $response['found'] = false;
        }
        return $response;
    }
}
?>