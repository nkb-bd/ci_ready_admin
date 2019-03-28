<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajaxupload extends CI_Controller {

    function __Construct() {
        parent::__Construct();

        $this->load->model('Items');
    }

    public function index() {
        $this->load->view('ajaxupload');
    }

    public
            function upload() {

        echo "<pre>";

        print_r($_POST);
        print_r($_FILES);
        exit;
        $upload_data = array(
            'upload_path' => dirname($_SERVER["SCRIPT_FILENAME"]) . "/files/items",
            'upload_url' => base_url() . "/files/items",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "50000KB",
            'max_width' => 2024,
            'min_width' => 400,
            'max_hight' => 2024,
            'width' => 1024,
            'height' => 800,
            'quality' => "100%",
            'file_name' => uniqid() .'_' .date('m_Y') . '.jpg'
        );



        $file_name = null;

        $this->load->library('upload', $upload_data);

        if ($this->upload->do_upload('userfile')) {

            $uploaded_file = $this->upload->data();

            $file_name = $uploaded_file['file_name'];



            $image_config["image_library"] = "gd2";
            $image_config["source_image"] = $upload_data["upload_path"] . "/" . $file_name;
            $image_config['create_thumb'] = TRUE;
            $image_config['maintain_ratio'] = TRUE;
            $image_config['thumb_marker'] = "";

            $image_config['new_image'] = $upload_data["upload_path"] . "/thumb/" . $file_name;
            $image_config['quality'] = "100%";
            $image_config['width'] = 450;
            $image_config['height'] = 0;
            $dim = (intval($upload_data["width"]) / intval($upload_data["height"])) - ($image_config['width'] / $image_config['height']);
            $image_config['master_dim'] = ($dim > 0) ? "height" : "width";

            $this->load->library('image_lib');
            $this->image_lib->initialize($image_config);

            if (!$this->image_lib->resize()) { //Resize image
            }
        }
        if ($file_name == "") {
            $file_name = 'listing-default.png';



            $data = $_POST;



            // $this->Items->insert_item($data);
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('result' => 0)));
        } else {
            $data = array(
               'title' => $_POST['title'],
                'description' => $_POST['description'],
                'image_path' => base_url() . 'files/items/' . $file_name,
                'album' =>$_POST['album_id'],
                'image' =>   $file_name
            );


            $this->Items->insert_item($data);
            // updating album cover\
            if($_POST['album_cover']){

            	$update_data =array(
            		'cover_img' => $file_name,
            		'id' => $_POST['album_id']
            	);
            	$update= $this->Items->update_single('albums',$update_data,'id');
            }

                    $this->session->set_flashdata('message', sprintf("New Image Saved"));

            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('result' => 1)));
        }
    }

}
