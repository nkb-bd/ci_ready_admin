<?php

class Items extends CI_Model {

    public function insert_item($data) {

        if ($this->db->insert('items', $data)) {
            return $this->db->insert_id();
        } else {

            return false;
        }
    }

    function update_single($table,$data,$key) {

          $success = $this->db->update($table, $data, array($key => $data[$key] ));

          if($success){

              return true;

          }else{

            return false;

          }
    }

}
