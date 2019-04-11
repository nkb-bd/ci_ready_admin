<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Public_Controller {

    /**
     * Constructor
     */
    // this->dynamic_page_menu
    // for dynamiclly created page menu f
    function __construct()
    {
        parent::__construct();

        // load the language file
        $this->lang->load('welcome');
        $this->load->model('common_model');



    }


    /**
	 * Default
     */
	function index()
	{  


        
         $data = $this->includes;



        // echo "<pre>";

        // print_r($blog_data);exit;

         //a;wasy same for main admin

        // setup page header data
        $this->set_page_header('page header');

        $data = $this->includes;

        $content_data = array(
            'slider_data' => '',
            'services_data' =>'' ,
            'portfolio_data' => '',
            'team_data' =>'',
            'blog_data' => '',
            'portfolio_types' => '',
        );
        

       
        // load views
        $data['content'] = $this->load->view($this->settings->theme, $content_data, TRUE);
		$this->load->view($this->template, $data);



	}

    function components(){
        


        $this->set_title('Components ');
        $this->set_page_header('page header');

        $data = $this->includes;

        $site_info =  array() ;
      
        $content_data = array(
            'dynamic_page_menu' => $this->dynamic_pages,
        );
        

        // echo "<pre>";

        // // print_r( $this->settings);
        // print_r( $this->settings->site_name);
        // exit;
        // load views
        $data['content'] = $this->load->view('pages/components', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    
    function pages($slug){
            

           if (!empty($slug)) {

               $page_data = $this->common_model->get_by_where('slug',$slug,'pages','');
               if (empty($page_data)||$page_data[0]['status']==0) {

                    $this->session->set_flashdata('message', 'Page not available!');
                    redirect('','refresh');

                }


                $page_data =  $page_data[0];
             
                $content_data = array(
                        // 'body' => $page_data['body'],
                        'title' => $page_data['title'],
                        'image' => $page_data['image'],
                        'slug' => $page_data['slug'],
                        'meta_keywords' => $page_data['meta_keywords'],
                        'meta_description' => $page_data['meta_description'],
                         'dynamic_page_menu' => $this->dynamic_pages,
                    );
                

                $data = $this->includes;                    
                $data['content'] = $this->load->view('pages/dynamic_page', $content_data, TRUE);

                $this->load->view($this->template, $data);

           }else{

                redirect('','refresh');

           }
      
    }
    
    function blogs($slug){
            

           if (!empty($slug)) {

               $page_data = $this->common_model->get_by_where('slug',$slug,'blogs','');
               if (empty($page_data)||$page_data[0]['status']==0) {

                    $this->session->set_flashdata('message', 'Blog not available!');
                    redirect('','refresh');

                }


                $page_data =  $page_data[0];
             
                $content_data = array(
                        // 'body' => $page_data['body'],
                        'title' => $page_data['title'],
                        'image' => $page_data['image'],
                        'slug' => $page_data['slug'],
                        'meta_keywords' => $page_data['meta_keywords'],
                        'meta_description' => $page_data['meta_description'],
                        'body' => $page_data['body'],
                         'dynamic_page_menu' => $this->dynamic_pages,
                    );
                

                $data = $this->includes;                    
                $data['content'] = $this->load->view('blogs/single', $content_data, TRUE);

                $this->load->view($this->template, $data);

           }else{

                redirect('','refresh');

           }
      
    }

    
    function page_data(){
            

           if (!empty($_POST)) {

               $page_data = $this->common_model->get_by_where('slug',$_POST['slug'],'pages','');
               if (empty($page_data)||$page_data[0]['status']==0) {

                   echo "string";

                }

              
                $data =$page_data[0]['body'];
                echo ( $data );
                return;
               

           }else{

                redirect('','refresh');

           }
      
    }

        /**
     * Get portfolio type by group
     *
     * @param  int $id
     * @return array|boolean
     */
    function get_portfolio_type_group() {




            $this->db->  select('type');

            $this->db->  from('portfolio');
            $this->db->group_by('type'); 
            $this->db->  where('deleted', 0);
            $query = $this->db->  where('status', 1);

            $this->db->  order_by('id', "asc");

            $query = $this->db->  get();



            if ($query ->  num_rows() >= 1) {
                return $query ->  result_array();
            }



            return false;

        }






}
