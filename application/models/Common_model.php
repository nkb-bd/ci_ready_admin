<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {

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
        $this->_db = 'settings';
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
    function get_by_where($field,$field_value,$tbl,$sort='id',$sort_order='asc',$limit=0) {




            $this->db->select('*');

            $this->db->from($tbl);

            $this->db->where($field, $field_value);
            $this->db->order_by($sort, $sort_order);
            if ($limit!=0) {
                 $this->db->limit($limit);
            }
            $query = $this->db->get();



            if ($query->num_rows() >= 1){ return $query->result_array(); }



            return false;

  }

    /**
     * Get specific data
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
     * Get specific data
     *
     * @param  int $id
     * @return array|boolean
     */
    function get_project_by_slug_single($slug,$approved=0) {



         $this->db->select('first_name,last_name,users.created as seller_joined,users.profile_img as seller_img, users.id as seller_id,username,projects.id as id,category.id as cat_id,location,projects.created, sub_category.price,sub_category.id as sub_cat_id, posted_by,budget,title,details,projects.id as project_id,projects.file_path,projects.file_name,category.name as cat_name, sub_category.name as sub_cat_name,sale_limit,sale_count,users.email as seller_email,project_slug,category.price as price');
         $this->db->from('projects');
         $this->db->where('projects.project_slug', $slug);
         if($approved !=0){

             $this->db->where('projects.approved', $approved);
         }
         $this->db->join('users', 'users.id = projects.posted_by','left outer');
         $this->db->join('category', 'category.id = projects.category','left outer');
         $this->db->join('sub_category', 'sub_category.id = projects.sub_category','left outer');


        $query = $this->db->get();



        if ($query->num_rows() == 1){ return $query->row_array(); }



        return false;

      }    

    /**
     * Get project by slug
     *
     * @param  int $id
     * @return array|boolean
     */
    function get_project_category_by_slug($slug,$approved =0) {



       $this->db->select('projects.id as id,project_slug,category.id as cat_id, sub_category.price,sub_category.id as sub_cat_id, posted_by,budget,title,details,projects.file_path,projects.file_name,category.name as cat_name, sub_category.name as sub_cat_name,projects.location,projects.duration');
         $this->db->from('projects');
         $this->db->where('category.slug', $slug);
         $this->db->where('users.deleted', '0');
         if($approved !=0){

             $this->db->where('projects.approved', $approved);
         }

         $this->db->join('category', 'category.id = projects.category','left outer');
         $this->db->join('sub_category', 'sub_category.id = projects.sub_category','left outer');
         $this->db->join('users', 'users.id = projects.posted_by');


        $query = $this->db->get();



        if ($query->num_rows() >= 1){ return $query->result_array(); }



        return false;

    }
 /**
     * Get project by category and sub category
     *
     * @param  int $id
     * @return array|boolean
     */
    function get_project_by_category_sub_cat($category_id,$sub_cat_id, $approved=0) {



       $this->db->select('projects.id as id,sub_category.price,project_slug,category.id as cat_id, sub_category.id as sub_cat_id, posted_by,budget,title,details,projects.file_path,projects.file_name,category.name as cat_name, sub_category.name as sub_cat_name');
         $this->db->from('projects');
         $this->db->where('category.id', $category_id);
         $this->db->where('sub_category.id', $sub_cat_id);
         $this->db->where('users.deleted', '0');
         if($approved !=0){

             $this->db->where('projects.approved', $approved);
         }
         $this->db->join('category', 'category.id = projects.category','left outer');
         $this->db->join('sub_category', 'sub_category.id = projects.sub_category','left outer');
         $this->db->join('users', 'users.id = projects.posted_by');


        $query = $this->db->get();



        if ($query->num_rows() >= 1){ return $query->result_array(); }



        return false;

      }    
    /**
     * Get project by search
     *
     * @param  int $id
     * @return array|boolean
     */
    function get_project_by_search($search,$approved = 0,$loc='') {



       $this->db->select('projects.id as id,project_slug,sub_category.price,category.id as cat_id, sub_category.id as sub_cat_id, projects.location,posted_by,budget,title,details,projects.file_path,projects.file_name,category.name as cat_name, sub_category.name as sub_cat_name,projects.duration');
         $this->db->from('projects');
         $this->db->where('users.deleted', '0');
          if($approved !=0){

             $this->db->where('projects.approved', $approved);
         }
         if(($search!='')){

             $this->db->like('projects.title', $search);
         }
         if(($loc!='')){
            
             $this->db->like('projects.location', $loc);
         }
         $this->db->join('category', 'category.id = projects.category','left outer');
         $this->db->join('sub_category', 'sub_category.id = projects.sub_category');
         $this->db->join('users', 'users.id = projects.posted_by');


        $query = $this->db->get();



        if ($query->num_rows() >= 1){ return $query->result_array(); }



        return false;

      }    
    /**
     * Get project by search
     *
     * @param  int $id
     * @return array|boolean
     */
    function get_project_by_search_lat_lang($search,$location,$distance,$lat,$lang,$approved = 0) {

       $km  = 6371;

       $this->db->select('projects.id as id,project_slug,sub_category.price,category.id as cat_id, sub_category.id as sub_cat_id, projects.location,posted_by,budget,title,details,projects.file_path,projects.file_name,category.name as cat_name, sub_category.name as sub_cat_name,,projects.duration,
        ( '.$km.' * acos( cos( radians('.$lat.') ) * cos( radians( projects.lat ) ) * cos( radians( projects.lang ) - radians('.$lang.') ) + sin( radians('.$lat.') ) * sin(radians(projects.lat)) ) ) AS distance
        ');
         $this->db->from('projects');
         $this->db->where('users.deleted', '0');
          if($approved !=0){

             $this->db->where('projects.approved', $approved);
         }
         $this->db->like('category.name', $search);
         $this->db->or_like('projects.title', $search);
         $this->db->or_like('projects.location', $location);
         $this->db->join('category', 'category.id = projects.category','left outer');
         $this->db->join('sub_category', 'sub_category.id = projects.sub_category');
         $this->db->join('users', 'users.id = projects.posted_by');
         $this->db->having('distance <=',  floor($distance)); 


        $query = $this->db->get();



        if ($query->num_rows() >= 1){ return $query->result_array(); }



        return false;

      }    
    /**
     * Get project by search
     *
     * @param  int $id
     * @return array|boolean
     */
    function get_project_by_category_search($search,$category_id,$approved = 0) {



       $this->db->select('projects.id as id,project_slug,sub_category.price,category.id as cat_id, sub_category.id as sub_cat_id, posted_by,budget,title,details,projects.file_path,projects.file_name,category.name as cat_name, sub_category.name as sub_cat_name,projects.duration');
         $this->db->from('projects');
         $this->db->where('category.id', $category_id);
         $this->db->where('users.deleted', '0');
         $this->db->like('category.name', $search);
         $this->db->like('projects.title', $search);
          if($approved !=0){

             $this->db->where('projects.approved', $approved);
         }
         $this->db->join('category', 'category.id = projects.category','left outer');
         $this->db->join('sub_category', 'sub_category.id = projects.sub_category','left outer');
         $this->db->join('users', 'users.id = projects.posted_by');


        $query = $this->db->get();



        if ($query->num_rows() >= 1){ return $query->result_array(); }



        return false;

      }    
    /**
     * Get project by search
     *
     * @param  int $id
     * @return array|boolean
     */
    function get_latest_projects($limit=0,$approved=0) {



       $this->db->select('projects.id as id,sub_category.price,project_slug,category.id as cat_id, sub_category.id as sub_cat_id, posted_by,budget,title,details,projects.file_path,projects.file_name,category.name as cat_name, sub_category.name as sub_cat_name');
         $this->db->from('projects');
         $this->db->where('users.deleted', '0');
         if($approved !=0){

             $this->db->where('projects.approved', $approved);
         }
       
         $this->db->join('category', 'category.id = projects.category','left outer');
         $this->db->join('sub_category', 'sub_category.id = projects.sub_category','left outer');
          $this->db->join('users', 'users.id = projects.posted_by');
         $this->db->order_by('id','desc');
         $this->db->limit($limit);

        $query = $this->db->get();



        if ($query->num_rows() >= 1){ return $query->result_array(); }



        return false;

      }    

    /**
     * Get user preference
     *
     * @param  int $id
     * @return array|boolean
     */
    function get_user_preference($id) {



    $query = $this->db->select('category_prefrence.id as id,category.id as cat_id,sub_category.id as sub_cat_id,category.name as cat_name , sub_category.name as sub_category');

    $query = $this->db->from('category_prefrence');
    $query = $this->db->join('category','category.id=category_prefrence.cat_id','left outer');
    $query = $this->db->join('sub_category','sub_category.id=category_prefrence.sub_cat_id','left outer');

    $query = $this->db->where('category_prefrence.u_id', $id);
    $query = $this->db->where('category_prefrence.deleted', 0);



    $query = $this->db->get();



    if ($query->num_rows()>= 1){ return $query->result_array(); }



    return false;

  
  }    
  /**
     * Get project by prefrence
     *
     * @param  int $id
     * @return array|boolean
     */
    function get_project_by_preference($category_id,$sub_cat_id,$approved=1,$limit=0) {

      
        if (empty($sub_cat_id)) {

           $query = $this->db->select('projects.id as id,category.name as cat_name,title,details,budget,file_path,category,sub_category,projects.deleted,sale_count ');
        }  
        elseif (!empty($sub_cat_id)) {

            $query = $this->db->select('projects.id as id,category.name as cat_name,title,details,budget,file_path,category,sub_category,sub_category.name as sub_cat_name,projects.deleted,sale_count');

        }




        $query = $this->db->from('projects');
        $query = $this->db->join('category','category.id=projects.category','left outer');
        
        if (!empty($sub_cat_id)) {

            $query = $this->db->join('sub_category','sub_category.id=projects.sub_category','left outer');
            $query = $this->db->where('projects.sub_category', $sub_cat_id);
        }
         $this->db->join('users', 'users.id = projects.posted_by');
        $query = $this->db->where('projects.category', $category_id);
        $query = $this->db->where('projects.deleted', 0);
        $query = $this->db->where('users.deleted', '0');
        $query = $this->db->where('projects.approved', $approved);
        $query = $this->db->limit($limit);



        $query = $this->db->get();



        if ($query->num_rows()>= 1){ return $query->result_array(); }



        return false;

  } 

   /**
     * Get specific user
     *
     * @param  int $id
     * @return array|boolean
     */
    function check_user_preference($id,$u_id,$cat_id,$sub_cat_id) {



    $query = $this->db->select('category_prefrence.id');

    $query = $this->db->from('category_prefrence');
    $query = $this->db->join('category','category.id=category_prefrence.cat_id','left outer');
    $query = $this->db->join('sub_category','sub_category.id=category_prefrence.sub_cat_id','left outer');

    $query = $this->db->where('category_prefrence.u_id',      $u_id);
    $query = $this->db->where('category_prefrence.cat_id',    $cat_id);
    $query = $this->db->where('category_prefrence.sub_cat_id',$sub_cat_id);



    $query = $this->db->get();



    if ($query->num_rows()>= 1){ return true; }



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

    function count_by_condition($table,$condtions){

        if ( ! empty($condtions))
        {
           
            $this->db->select('id');
            $this->db->from($table);

            foreach ($condtions as $key=>$value)
            {
                $this->db->where($key, $value);
            }


            $query = $this->db->get();



            if ($query->num_rows() >= 1){ return $query->num_rows(); }



            return false;
        }
    }
    function get_by_multiple_condition($table,$condtions){

        if ( ! empty($condtions))
        {
           
            $this->db->select('*');
            $this->db->from($table);

            foreach ($condtions as $key=>$value)
            {
                $this->db->where($key, $value);
            }


            $query = $this->db->get();



            if ($query->num_rows() >= 1){ return $query->result_array(); }



            return false;
        }
    }

     /**
     * Get project by search
     *
     * @param  int $id
     * @return array|boolean
     */
    function get_latest_projects_with_pagination($tbl='',$limit=0, $offset=0,  $sort='id', $dir='ASC',$approved=0) {



       $this->db->select('projects.id as id,sub_category.price,project_slug,category.id as cat_id, sub_category.id as sub_cat_id, posted_by,budget,title,details,projects.file_path,projects.file_name,category.name as cat_name, sub_category.name as sub_cat_name,projects.location,projects.duration');
         $this->db->from('projects');
         if($approved !=0){

             $this->db->where('projects.approved', $approved);
         }
       
         $this->db->join('category', 'category.id = projects.category');
         $this->db->join('sub_category', 'sub_category.id = projects.sub_category');
         $this->db->join('users', 'users.id = projects.posted_by');
         $this->db->order_by($sort,$dir);
            
        if ($limit)
        {
             $this->db->limit($limit,$offset);
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $this->db->where('approved',1);
        $this->db->from("projects");
        $results['total'] =  $this->db->count_all_results();

      

        return $results;


       
      }    





}
