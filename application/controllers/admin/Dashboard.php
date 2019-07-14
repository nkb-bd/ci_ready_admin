<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {


   

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        $this->load->model('common_model');
        $this->load->model('seller/projects_model');

        $this->lang->load('dashboard');
        
      
    }


    /**
     * Dashboard
     */
    function index()
    {      

        // check permissions
        if (!in_array('dashboard_view', $this->permissions)){


            $this->session->set_flashdata('error', 'Permission denied !');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $this->set_title('Admin ');
        $this->set_page_header('Dashboard');

        $data = $this->includes;

     

        // $total_unapproved_projects = $this->common_model->count_by_condition('projects',$count_fields);

      

       
        // all projects
        // $all_projects = $this->common_model->get_all('projects',15,0,'','id','DESC');

        
        // set content data
        $content_data = array(
            'all_projects'             => '',
            'unapproved_project_count' => '',
            'approved_project_count'   => '',
            'total_users'              => '',
            'sale'                     =>'',
            'total_category'           =>'',
           
        );


        // echo "<pre>";

        // print_r($content_data);
        // exit();

        // load views
        $data['content'] = $this->load->view('admin/dashboard', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    // set approve status of projects
    // public function set_approve(){


    

    //   if ($_POST) {
        
        
    //     $data['id'] = $_POST['id']; 
    //     $approved = $data['approved'] = $_POST['checked']; 

    //     $project_data = $this->common_model->get_by_id($data['id'],'projects');

    //     // send email notification
    //     $title        = $project_data['title'];
    //     $category     = $project_data['category'];
    //     $sub_category = $project_data['sub_category'];


    //     if($approved==1){


    //         if ($project_data['notification_sent']==0 ) {
               
    //         }

           
    //          $this->send_project_notification($title,$category,$sub_category);
    //     }


    //     $update = $this->common_model->update_single($data,'projects');


    //     if($update ){

    //       echo json_encode(true);

    //       return;
    //     }
        
    //   }



    // }


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

    public function get_sum_sale(){

        $this->db->select_sum('sale_count');
        $result = $this->db->get('projects')->row_array();  
        return $result;
    }


    // send email
    function test_email(){


        // check permissions
        if (!in_array('email_test_view', $this->permissions)){


            $this->session->set_flashdata('error', 'Permission denied !');
            redirect($_SERVER['HTTP_REFERER']);
        }


        $this->set_title('Email Testing ');
        $this->set_page_header('Email Testing');

        $data = $this->includes;

        if(isset($_GET['email'])){

                $email = $_GET['email'];
                $name  = $_GET['name'];

                //Load email library
                $this->load->library('email');

                //SMTP & mail configuration
                $config = array(
                   'protocol'  => 'smtp',
                    'smtp_host' => $this->config->item('email_smtp_host') ,
                    'smtp_port' => $this->config->item('email_port') ,
                    'smtp_user' =>  $this->config->item('email_user') ,
                    'smtp_pass' =>  $this->config->item('email_pass'),
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8',
                    // 'smtp_crypto' => 'ssl'
                );

                $data = array(
                     'link'=> base_url(),
                     'site'=> base_url(),
                         );

                $message = $this->load->view('email/activation_email', $data, true);   

                $this->email->initialize($config);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");

                //Email content
                $htmlContent = '<h1>Hello , '.$name.'  </h1>';
                $htmlContent .= '<strong>Email Testing </strong>';
                $htmlContent .= '<p><a href="'.base_url().'"> Go to Site </a> </p>';

                $this->email->to($email);
                $this->email->from($this->config->item('email_user'),$this->settings->site_name);
                $this->email->subject('Email Test');
                $this->email->message($message);

                //Send email

                try{

                    $sent = $this->email->send();
                    if (    $sent) {


                        $this->session->set_flashdata('message',"Email sent");
                        redirect('admin/dashboard/test_email');

                    }else{
                        echo $this->email->print_debugger();
                    }
                }
                catch(Exception $e){
                    echo "  sssss";
                    $data = $this->email->print_debugger();
                    $this->session->set_flashdata('error',$data );
                    redirect('admin/dashboard/test_email');
                }
            }else{

                $data['content'] = $this->load->view('admin/test_email', '', TRUE);
                $this->load->view($this->template, $data);
            }
    }


     // send new project notification to all user according to user preference
    public function send_project_notification($title,$category,$sub_category){


      
        if($sub_category > 0){

             $fields = array(
                "sub_cat_id" => $sub_category,
                 "cat_id" => $category
            );
        }else{

              $fields = array(
                    "cat_id" => $category
                );
        }

      

        $users = $this->projects_model->get_users_by_prefrence($fields);

        
         
        if($users){

            foreach ($users as $value) {
                // echo $value['email'];
                $this->_send_email($value['email'],$value,$title);
            }
        }

        return true;
       

    }


    // send email
    function _send_email($email,$data,$project_title){
        //Load email library
        $this->load->library('email');

        //SMTP & mail configuration
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => $this->config->item('email_smtp_host') ,
            'smtp_port' => $this->config->item('email_port') ,
            'smtp_user' =>  $this->config->item('email_user') ,
            'smtp_pass' =>  $this->config->item('email_pass'),
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content

        $data = array(
                 'link'=> base_url(),
                 'site_link'=> base_url(),
                 'site'=> $this->settings->site_name,
                  'msg'=> ''
                );

        $message = $this->load->view('email/project_notification', $data, true);   


        // $htmlContent = '<h1>Hello , '.$data['first_name'].' '.$data['last_name'].'  </h1>';
        // $htmlContent .= '<strong>New Porject Posted </strong>';
        // $htmlContent .= '<h4> Name : '.ucfirst($project_title).'</h4>';
        // $htmlContent .= '<h4> category : '.$data['category_name'].'</h4>';
        // $htmlContent .= '<p><a href="'.base_url().'"> Go to Site </a> </p>';

        $this->email->to($email);
        $this->email->from($this->config->item('email_user'),$this->settings->site_name);
        $this->email->subject('New Project notification');
        $this->email->message($message );

        //Send email

        try{

            $this->email->send();
            return true;
        }
        catch(Exception $e){
                return false;
        }
    }

    // demo form for qucik copy 
    public function demo(){

      $this->set_title('Admin ');
      $this->set_page_header('Dashboard');

      $data = $this->includes;
        
      // set content data
      $content_data = array(
           
      );
        
        // load views
      $data['content'] = $this->load->view('admin/inc/demo_form', $content_data, TRUE);
      $this->load->view($this->template, $data);

    }


  

}