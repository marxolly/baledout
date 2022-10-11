<?php
    /**
    * Client Contact Class
    *

    * @author     Mark Solly <mark@baledout.com.au>

        FUNCTIONS

        addContact($data)
        editContact($data)
        getAllContacts($active = 1)
        getContactById($id = 0)
        getSelectContactsByClient($client_id, $selected = false)

    */
class Clientcontact extends Model {
    public $table = "clients_contacts";

    public function addContact($data)
    {
        //echo "productioncontact <pre>",print_r($data),"</pre>";die();
        unset($data['contact_id']);
        $db = Database::openConnection();
        $id = $db->insertQuery($this->table, $data);
        return $id;
    }

    public function editContact($data, $id)
    {
        //echo "productioncontact <pre>",print_r($data),"</pre>";die();
        unset($data['contact_id']);
        $db = Database::openConnection();
        $db->updateDatabaseFields($this->table, $data, $id);
        return true;
    }
}//End class
?>