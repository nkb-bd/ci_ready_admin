<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_category_model extends CI_Model {

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
        $this->_db = 'sub_category';
    }


    /**
     * 
     *
     * @param  int $limit
     * @param  int $offset
     * @param  array $filters
     * @param  string $sort
     * @param  string $dir
     * @return array|boolean
     */
    function get_all_subcategory($tbl='',$limit=0, $offset=0, $filters=array(), $sort='id', $dir='ASC')
    {

        $join   = '';
        $fields = '*';

        $sql = "
            SELECT SQL_CALC_FOUND_ROWS  cat1.sort_order, cat1.price,cat1.id as id,cat1.name,cat1.deleted,cat1.slug,cat1.created,cat1.parent_category ,sub.id as sub_cat_id, sub.name as sub_name ,sub.deleted as sub_deleted
            FROM category as cat1
            LEFT OUTER JOIN sub_category as sub on cat1.id  = sub.parent_cat_id 
            WHERE cat1.deleted = 0
            -- AND sub.deleted = 0
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


    /**
     * 
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

        $join   = '';
        $fields = '*';

        if($tbl ==''){

            $tbl=$this->_db;
            $join = "JOIN category on category.id = sub_category.parent_cat_id ";

            $fields = 'category.price,sub_category.name,sub_category.slug , sub_category.id , sub_category.parent_cat_id ,category.name as parent_cat_name';

        }
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS ".$fields."
            FROM {$tbl}
            ".$join
            ."WHERE {$tbl}.deleted = 0
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
               
                return $insert_id;

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
