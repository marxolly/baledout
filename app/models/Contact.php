<?php
    /**
    * Contact Class
    *

    * @author     Mark Solly <mark@baledout.com.au>

        FUNCTIONS

        addContact($data)
        editContact($data)
        getAllContacts($active = 1)
        getContactById($id = 0)
        getSelectContactsByClient($client_id, $selected = false)

    */
class Contact extends Model {
    public $client_contacts_table = "clients_contacts";
    public $depot_contacts_table = "depots_contacts";

    public function addContact($data, $type)
    {
        $table = $type."_contacts";
        //echo "productioncontact <pre>",print_r($data),"</pre>";die();
        unset($data['contact_id']);
        $db = Database::openConnection();
        $id = $db->insertQuery($table, $data);
        return $id;
    }

    public function editContact($data, $id, $type)
    {
        $table = $type."_contacts";
        //echo "productioncontact <pre>",print_r($data),"</pre>";die();
        unset($data['contact_id']);
        $db = Database::openConnection();
        $db->updateDatabaseFields($table, $data, $id);
        return true;
    }

    public function deactivateContact($id, $type)
    {
        $table = $type."_contacts";
        $db = Database::openConnection();
        $db->updateDatabaseField( $table, 'active', 0, $id );
        return true;
    }

    public function reactivateContact($id, $type)
    {
        $table = $type."_contacts";
        $db = Database::openConnection();
        $db->updateDatabaseField( $table, 'active', 1, $id );
        return true;
    }
}//End class
?>