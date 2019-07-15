<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_model extends CI_Model {


	protected $table_name   = '';
    protected $key          = 'id';
    protected $date_format  = '';
    protected $date         = '';
    protected $log_user     = FALSE;

	protected $set_created      = TRUE;
	protected $created_field    = 'created';


    protected $set_modified     = FALSE;
    protected $modified_field   = 'updated';

    protected $soft_deletes = TRUE;
    protected $deleted_field    = 'deleted';
	
	
	protected $return_insert_id     = true;
	protected $return_type          = 'object';
	protected $protected_attributes = array();
	protected $field_info           = array();


	// Constructor

	public function __construct(){
		parent::__construct();
        $this->date =date("Y-m-d h:i:s");

	}


	 /**
     * Get by id
     *
     * @param  int $id
     * @return array|boolean
     * lukman.nakib@gmail.com
     */
    function find($id) {



        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where('id', $id);

        if ($this->soft_deletes==true) {
       	
       		 $this->db->where($this->deleted_field, 0);
        }

        $query = $this->db->get();

        if ($query->num_rows() == 1){ 

	       	return $query->row_array(); 
        }

        return false;

     }  


     /**
     * Get all by id
     *
     * @param  int $id
     * @return array|boolean
     * lukman.nakib@gmail.com

     */
    function find_all($field , $value) {


        $this->db->select('*');
        $this->db->from($this->table_name);

        if ($this->soft_deletes==true) {
       	
       		 $this->db->where($this->deleted_field, 0);
        }

        $query = $this->db->get();

        if ($query->num_rows() >= 1){ 

	       	return $query->row_array(); 
        }

        return false;

    }  

	 /**
     * Get by by field name an value
     *
     * @param  int $id
     * @return array|boolean
     * lukman.nakib@gmail.com

     */
    function find_by($field , $value) {


        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where($field, $value);

        if ($this->soft_deletes==true) {
       	
       		 $this->db->where($this->deleted_field, 0);
        }

        $query = $this->db->get();

        if ($query->num_rows() == 1){ 

	       	return $query->row_array(); 
        }

        return false;

    }  

	 /**
     * Get all by field name an value
     *
     * @param  int $id
     * @return array|boolean
     * lukman.nakib@gmail.com

     */
    function find_by_all($field , $value) {


        $this->db->select('*');
        $this->db->from($this->table_name);

        if ($this->soft_deletes==true) {
       	
       		 $this->db->where($this->deleted_field, 0);
        }

        $query = $this->db->get();

        if ($query->num_rows() >= 1){ 

	       	return $query->row_array(); 
        }



        return false;

    }  
	 /**
     * Get all 
     *
     * @param  int $id
     * @return array|boolean
     * lukman.nakib@gmail.com

     */
    function get() {


        $this->db->select('*');
        $this->db->from($this->table_name);
        if ($this->soft_deletes==true) {
       	
       		 $this->db->where($this->deleted_field, 0);
        }

        $query = $this->db->get();

        if ($query->num_rows() >= 1){ 

	       	return $query->result_array(); 
        }



        return false;

    }  
	 /**
     * insert
     *
     * @param  array
     * @return array|boolean
     * lukman.nakib@gmail.com

     */
    function insert($data) {

        if($this->soft_deletes === true){

        	 $data[$this->deleted_field] = 0;
        }  
        if($this->set_created === true){

        	 $data[$this->created_field] = $this->date;
        }  

        if($this->set_modified === true){

        	 $data[$this->modified_field] = $this->date;
        }

        $query= $this->db->insert($this->table_name, $data);

        if($query){
           
            return $this->db->insert_id();

        }

        return false;

    }  
	 /**
     * insert bacth
     *
     * @param  array
     * @return array|boolean
     * lukman.nakib@gmail.com

     */
    function insert_batch($data) {
     
        $query= $this->db->insert_batch($this->table_name, $data);

        if($query){
           
            return $this->db->insert_id();

        }

        return false;

    }   
	 /**
     * update
     *
     * @param  array
     * @return array|boolean
     * lukman.nakib@gmail.com

     */
    function update($data) {
     
    	if($this->set_modified === true){

        	 $data[$this->modified_field] = $this->date;
        }

        $this->db->where('id', $data['id']);
        $success = $this->db->update($this->table_name,$data);

        if($success){

          return true;

        }
        return false;

    }    
	 /**
     * update
     *
     * @param  array
     * @return array|boolean
     * lukman.nakib@gmail.com

     */
    function update_where($field,$data) {
     
    	if($this->set_modified === true){

        	 $data[$this->modified_field] = $this->date;
        }

        $this->db->where($field, $data[$field]);
        $success = $this->db->update($this->table_name,$data);

        if($success){

          return true;

        }
        return false;

    }  
    /**
     * update bacth
     *
     * @param  array
     * @return array|boolean
     * lukman.nakib@gmail.com

     */
    function update_batch($field,$data) {
     
    
        $success = $this->db->update_batch($this->table_name,$data, $field); 

        if($success){

          return true;

        }
        return false;

    }  
    /**
     * delete
     *
     * @param  array
     * @return array|boolean
     * lukman.nakib@gmail.com

     */
    function delete($id) {
     	
     	if($this->soft_deletes===true){

     		$data[$this->deleted_field] = 1;
	     	$this->db->where('id', $id);
	        $success = $this->db->update($this->table_name,$data);

     	}else{

	        $success =  $this->db->delete($this->table_name, array('id' => $id));

     	}
    

        if($success){

          return true;

        }
        return false;

    }  


    /**
     * is unique
     *
     * @param  int $id
     * @return array|boolean
     * lukman.nakib@gmail.com

     */
    function is_unique($field,$string) {


        $this->db->select('id');
        $this->db->from($this->table_name);
        if ($this->soft_deletes==true) {
       	
       		 $this->db->where($this->deleted_field, 0);
        }
        $this->db->where($field, $string);

        $query = $this->db->get();

        if ($query->num_rows() == 1){ 

	       	return true; 
        }

        return false;

    }  
    /**
     * is unique
     *
     * @param  int $id
     * @return array|boolean
     * lukman.nakib@gmail.com

     */
    function count_all() {


        $this->db->select('id');
        $this->db->from($this->table_name);
        if ($this->soft_deletes==true) {
       	
       		 $this->db->where($this->deleted_field, 0);
        }

        $query = $this->db->get();

        if ($query->num_rows() >= 0){ 

	       	return $query->num_rows(); 
        }

        return false;

    }  

    /**
     * is unique
     *
     * @param  int $id
     * @return array|boolean
     * lukman.nakib@gmail.com

     */
    function count_by($field , $value) {


        $this->db->select('id');
        $this->db->from($this->table_name);

        if ($this->soft_deletes==true) {
       	
       		 $this->db->where($this->deleted_field, 0);
        }
       	$this->db->where($field, $value);

        $query = $this->db->get();

        if ($query->num_rows() >= 0){ 

	       	return $query->num_rows(); 
        }

        return false;

    }  
    /**
     * is unique
     *
     * @param  int $id
     * @return array|boolean
     * lukman.nakib@gmail.com

     */
    function get_field($field , $id) {


        $this->db->select($field);
        $this->db->from($this->table_name);

        if ($this->soft_deletes==true) {
       	
       		 $this->db->where($this->deleted_field, 0);
        }

       	$this->db->where('id', $id);

        $query = $this->db->get();

        if ($query->num_rows() == 1){ 

	       	$result= $query->row_array();

	       	return $result[$field];

        }

        return false;

    }  

}