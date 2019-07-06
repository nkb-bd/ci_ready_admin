<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Model{
    
    function __construct() {
        $this->proTable   = 'projects';
        $this->transTable = 'payments';
    }
    
    /*
     * Fetch products data from the database
     * @param id returns a single record if specified, otherwise all records
     */
    public function getRows($id = ''){
        $this->db->select('id,title,file_path as image,budget');
        $this->db->from($this->proTable);
        $this->db->where('deleted', '0');
        if($id){
            $this->db->where('id', $id);
            $query  = $this->db->get();
            $result = $query->row_array();
        }else{
            $this->db->order_by('title', 'asc');
            $query  = $this->db->get();
            $result = $query->result_array();
        }
        
        // return fetched data
        return !empty($result)?$result:false;
    }
    
    /*
     * Insert data in the database
     * @param data array
     */
    public function insertTransaction($data){
        $insert = $this->db->insert($this->transTable,$data);
        return $insert?true:false;
    }
    
}