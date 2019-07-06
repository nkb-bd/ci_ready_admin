<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
*    Permission Class
*    COPYRIGHT (C) 2008-2009 Haloweb Ltd
*    http://www.haloweb.co.uk/blog/
*
*    Version:    0.9.1
*    Wiki:       http://codeigniter.com/wiki/Permission_Class/
*
*    Description:
*    The Permission class uses keys in a session to allow or disallow functions
*    or areas of a site. The keys are stored in a database and this class adds 
*    and/or takes them away. The use of IF statements are required within
*    controllers and views, please see wiki for code.
*
*    Permission is hereby granted, free of charge, to any person obtaining a copy
*    of this software and associated documentation files (the "Software"), to deal
*    in the Software without restriction, including without limitation the rights
*    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
*    copies of the Software, and to permit persons to whom the Software is
*    furnished to do so, subject to the following conditions:
* 
*    The above copyright notice and this permission notice shall be included in
*    all copies or substantial portions of the Software.
* 
*    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
*    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
*    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
*    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
*    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
*    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
*    THE SOFTWARE.
**/

class Permission {

    // init vars
    var $CI;                        // CI instance
    var $where = array();
    var $set = array();
    var $required = array();

      /**
     * Constructor
     */
    function __construct()
    {
        // init vars
        $this->CI =& get_instance();

        // set groupID from session (if set)
        $this->groupID = ($this->CI->session->userdata('groupID')) ? $this->CI->session->userdata('groupID') : 0;
    }


    // get permissions from for this group
    function get_user_permissions($groupID)
    {
       

        $this->CI->db->select('key');
        $this->CI->db->from('permissions');
        $this->CI->db->join('permission_map', 'permission_map.permissionID = permissions.id');
        $this->CI->db->where('groupID', $groupID);
        $this->CI->db->where('status', 1);
        // get groups
        $query = $this->CI->db->get();
        // set permissions array and return
        if ($query->num_rows())
        {
            foreach ($query->result_array() as $row)
            {
                $permissions[] = $row['key'];
            }

            return $permissions;
        }
        else
        {
            return false;
        }
    }

    // get all permissions, or permissions from a group for the purposes of listing them in a form
    function get_permissions($groupID = '')
    {
        // select
        $this->CI->db->select('DISTINCT(category)');

        // if groupID is set get on that groupID
        if ($groupID)
        {
            $this->CI->db->where_in('key', $this->get_user_permissions($groupID));
        }

        // order
        $this->CI->db->order_by('category');
        
        // return
        $query = $this->CI->db->get('permissions');

        if ($query->num_rows())
        {
            $result = $query->result_array();

            foreach($result as $row)
            {
                if ($cat_perms = $this->get_perms_from_cat($row['category']))
                {
                    $permissions[$row['category']] = $cat_perms;
                }
                else
                {
                    $permissions[$row['category']] = 'N/A';
                }
            }
            return $permissions;
        }
        else
        {
            return false;
        }
    }    

    // get permissions from a category name, for the purposes of showing permissions inside a category
    function get_perms_from_cat($category = '')
    {
        // where
        if ($category)
        {
            $this->CI->db->where('category', $category);
        }    

        // return
        $query = $this->CI->db->get('permissions');

        if ($query->num_rows())
        {    
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    // get the map of keys from a group ID
    function get_permission_map($groupID)
    {
        // grab keys
        $this->CI->db->select('permissionID');

        // where
        $this->CI->db->where('groupID', $groupID);

        // return
        $query = $this->CI->db->get('permission_map');

        if ($query->num_rows())
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    // get the groups, for the purposes of displaying them in a form
    function get_groups()
    {
        // where
        $this->CI->db->where('siteID', $this->siteID);
        
        // return
        $query = $this->CI->db->get('permission_groups');

        if ($query->num_rows())
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }
    
    // add permissions to a group, each permission must have an input name of "perm1", or "perm2" etc
    function add_permissions($data)
    {
        $insert_data['groupID']      = $data['groupID'];
        $insert_data['permissionID'] = $data['permissionID'] ;

       
        // check for duplicate
        $this->CI->db->select('id');
        $this->CI->db->from('permission_map');
        $this->CI->db->where('groupID', $insert_data['groupID']);
        $this->CI->db->where('permissionID', $insert_data['permissionID']);

        $query = $this->CI->db->get();

        if ($query->num_rows() >= 1){ 

            return false;   

        }

        $query= $this->CI->db->insert('permission_map', $insert_data);
            if($query){
               
                return $this->CI->db->insert_id();

            }else{
                return false;
            }

    }

    // a group to the permission groups table
    function add_group($groupName = '')
    {
        if ($groupName)
        {
            $this->CI->db->set('groupName', $groupName);
            $this->CI->db->insert('permission_groups');

            return $this->CI->db->insert_id();
        }
        else
        {
            return false;
        }
    }    

   // create  permissions 
    function new_permission($data)
    {
        // delete all permissions on this groupID first

        $query= $this->CI->db->insert('permissions', $data);
            if($query){
               
                return $this->CI->db->insert_id();

            }else{
                return false;
            }
    }
   // create  permissions 
    function new_group($data)
    {
        // delete all permissions on this groupID first

        $query= $this->CI->db->insert('permission_groups', $data);
            if($query){
               
                return $this->CI->db->insert_id();

            }else{
                return false;
            }
    }

   //   permissions  list
    function all_permission_list()
    {
        // delete all permissions on this groupID first


        $query= $this->CI->db->order_by('module_name','desc')
                             ->get('permissions');
            if($query){
               
                return  $query->result_array();

            }else{
                return false;
            }
    }


   //   permissions  list
    function all_permission_data_with_group($groupID)
    {
        // delete all permissions on this groupID first

        $this->CI->db->select('perm.permission as name ,perm.id as permission_id,key,module_name,permission_map.id as permission_map_id,groupID,permissionID,status,groupName');
         // $this->CI->db->select('*');
        $this->CI->db->from("permissions as perm ");
        
       
         $this->CI->db->join('permission_map', 'perm.id = permission_map.permissionID');
         $this->CI->db->join('permission_groups', 'permission_map.groupID = permission_groups.id');
         $this->CI->db->where('groupID',$groupID );
        
         $this->CI->db->order_by('module_name','asc');
         
          $query = $this->CI->db->get(); 
       
            if($query){
               
                return  $query->result_array();

            }else{
                return false;
            }
    }

   //   permissions  list
    function all_group_list()
    {
        // delete all permissions on this groupID first


        $query= $this->CI->db->get('permission_groups');
            if($query){
               
                return  $query->result_array();

            }else{
                return false;
            }
    }

    
}