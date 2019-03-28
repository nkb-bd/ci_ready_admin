<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {


    //  session data
    //  [id] => 1
    // [username] => admin
    // [first_name] => Site
    // [last_name] => Administrator
    // [email] => admin@admin.com
    // [language] => english
    // [is_admin] => 1
    // [status] => 1
    // [created] => 2013-01-01 00:00:00
    // [updated] => 2018-09-22 22:28:14

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language files
        $this->lang->load('dashboard');
    }


    /**
     * Dashboard
     */
    function index()
    {
        $this->set_title('Admin ');
        $this->set_page_header('Dashboard');

        $data = $this->includes;
        
        // set content data
        $content_data = array(
            'total_page'   => 0,
            'total_user'   => $this->count_by_condtion('users'),
            'total_gallery'   => 0,
            'total_slider'   =>0,
            'main_menu'   => '',
            'login_logs'  => $this->_login_logs(),
            'login_attempts'  => $this->_login_attempts(),
        );


        // echo "<pre>";

        // print_r($content_data);
        // exit();

        // load views
        $data['content'] = $this->load->view('admin/dashboard', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }



    private function _login_logs(){


      $this->db->select('data,timestamp');
      $this->db->from('ci_sessions');
      $this->db->limit('4');
      $test = $this->db->get();
      
      $session_log = $test->result();

      $all_data = array( );
      foreach ( $session_log as $key=>$value) {


                $session_logion_data = $value->data ;  // your BLOB data who are a String

                 // array where you put your "BLOB" resolved data
                             
                $offset = 0;

                while ($offset < strlen($session_logion_data)) 
                    {
                       if (!strstr(substr($session_logion_data, $offset), "|")) 
                        {
                          throw new Exception("invalid data, remaining: " . substr($session_logion_data, $offset));
                        }
                          $pos = strpos($session_logion_data, "|", $offset);
                          $num = $pos - $offset;
                          $varname = substr($session_logion_data, $offset, $num);
                          $offset += $num + 1;
                          $data = unserialize(substr($session_logion_data, $offset));
                          $return_data[$varname] = $data;  
                          $offset += strlen(serialize($data));
                    }

                    if (($return_data['logged_in'])) {
                      


                     $all_data[$key] = $return_data['logged_in']; 

                   
                     
                    }

                     $all_data[$key]['time'] =  $value->timestamp;
                }
 
       return $all_data;


    }

    private function _login_attempts(){

        $this->db->select('*');
        $this->db->from('login_attempts');
        $this->db->order_by('attempt','DESC');
        $this->db->limit(2);
        $data = $this->db->get();

        return $data->result_array();

    }

    public function backup_db(){


      $base_name =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']); 
      $base_name_without_slash = str_replace('/','',$base_name);
      $this->load->dbutil();

        $prefs = array(     
            'format'      => 'zip',             
            'filename'    => $base_name_without_slash.'.sql'
            );


        $backup =& $this->dbutil->backup($prefs); 

        $db_name = 'db-backup-'. date("d-m-Y") .'.zip';
        $save = $db_name;

        $this->load->helper('file');
        write_file($save, $backup); 


        $this->load->helper('download');
        force_download($db_name, $backup);

    }

    public function main_menu() {

        $query = $this->db->select('menu_content.*,menu.*')

        ->from('menu_content')

        ->join('menu','menu.menu_id=menu_content.menu_id')

        ->where('menu.menu_position','1')

        ->order_by('menu_content.menu_position','ASC')

        ->get();



        if ($query->num_rows() > 0) {

            return $query->result();

        } else {

            return false;

        }



    }

    public function count_by_condtion($table)
    {
        return ;  

            // return $this->db
            // ->where('deleted', '0')
            // ->count_all_results($table);
    }

}