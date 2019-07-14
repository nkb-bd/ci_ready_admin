<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Projects_model extends CI_Model {

    /**
     * @vars
     */
    private $_db;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // define primary table
        $this->_db = 'category';
    }


    /**
     * Get list of non-deleted users
     *
     * @param  int $limit
     * @param  int $offset
     * @param  array $filters
     * @param  string $sort
     * @param  string $dir
     * @return array|boolean
     */
    function get_all($tbl='',$limit=0, $offset=0, $filters=array(), $sort='id', $dir='ASC')
    {


        if($tbl ==''){
            $tbl=$this->_db;
        }
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$tbl}
            WHERE deleted = 0
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }


    function save_single($data,$table) {

            $date_time=date("Y-m-d h:i:s");
            $data['created']=$date_time;
            $data['updated']=$date_time;
            $data['deleted']=0;
            $query= $this->db->insert($table, $data);
            if($query){
               
                return $this->db->insert_id();

            }else{
                return false;
            }
        }

    function save_batch($data,$table) {

            $query= $this->db->insert_batch($table, $data);
            if($query){
                

                return true;

            }else{
                return false;
            }
        }



    /**
     * Get specific user
     *
     * @param  int $id
     * @return array|boolean
     */
    function get_by_where($field,$field_value,$tbl,$sort='id') {




    $query = $this->db->select('*');

    $query = $this->db->from($tbl);

    $query = $this->db->where($field, $field_value);
    $query =    $this->db->order_by($sort, "asc");

    $query = $this->db->get();



    if ($query->num_rows() >= 1){ return $query->result_array(); }



    return false;

  }
  /**
 
    /**
     * Get specific user
     *
     * @param  int $id
     * @return array|boolean
     */
    function get_by_id($uri_genre_id,$tbl) {



        $query = $this->db->select('*');
        $query = $this->db->from($tbl);
        $query = $this->db->where('id', $uri_genre_id);

        $query = $this->db->get();

        if ($query->num_rows() == 1){ return $query->row_array(); }



        return false;

    }
    /**
     * Get specific user
     *
     * @param  int $id
     * @return array|boolean
     */
    function get_project_by_id($id) {



        $query = $this->db->select('projects.id as id,category.id as cat_id, sub_category.id as sub_cat_id, posted_by,budget,title,details,projects.file_path,projects.file_name,category.name as cat_name, sub_category.name as sub_cat_name,projects.duration');
        $query = $this->db->from('projects');
        $query = $this->db->where('projects.id', $id);
        $query = $this->db->join('category', 'category.id = projects.category','left outer');
        $query = $this->db->join('sub_category', 'sub_category.id = projects.sub_category','left outer');

        $query = $this->db->get();

        if ($query->num_rows() == 1){ return $query->row_array(); }



        return false;

    }

     /**
     * Edit an existing 
     *
     * @param  array $data
     * @return boolean
     */
    function update_single($data=array(),$table='')
    {
        if ($data)
        {  

        
           if($table ===''){
                
                $table = $this->_db ;
           }

           $date_time=date("Y-m-d h:i:s");
           $data['updated']=$date_time;

           $this->db->where('id', $data['id']);
           $success = $this->db->update($table,$data);

          if($success){

              return true;

          }else{

            return false;

          }
        }

        return FALSE;
    }


    /**
     * Edit an existing 
     *
     * @param  array $data
     * @return boolean
     */
    function edit($table,$data=array())
    {
        if ($data)
        {  
           $date_time=date("Y-m-d h:i:s");
        $data['updated']=$date_time;
        $success = $this->db->update($table, $data['id'] );

          if($success){

              return true;

          }else{

            return false;

          }
        }

        return FALSE;
    }
// update (data ,table ,key)
    
    function del_single($table,$key) {

          $success = $this->db->delete($table, array('id' => $key));

          if($success){

              return true;

          }else{

            return false;

          }
    }

       /**
     * Soft delete an existing user
     *
     * @param  int $id
     * @return boolean
     */
    function soft_delete($id=NULL,$tbl='')
    {    

     
        if ($id)
        {
            $sql = "
                UPDATE {$tbl}
                SET
                   
                    deleted = '1',
                    updated = '" . date('Y-m-d H:i:s') . "'
                WHERE id = " . $this->db->escape($id) . "
            ";

            $this->db->query($sql);

            if ($this->db->affected_rows())
            {
                return TRUE;
            }
        }

        return FALSE;
    }

    /**
     * Check to see if a username already exists
     *
     * @param  string $username
     * @return boolean
     */
    function username_exists($username)
    {
        $sql = "
            SELECT id
            FROM {$this->_db}
            WHERE username = " . $this->db->escape($username) . "
            LIMIT 1
        ";

        $query = $this->db->query($sql);

        if ($query->num_rows())
        {
            return TRUE;
        }

        return FALSE;
    }


}
