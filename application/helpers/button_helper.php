<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('generate_action_button'))
{
    function generate_action_button($url = '',$type="",$target="_self")
    {
    	if($type==="edit"){
    		$icon='<i class="fa fa-edit" aria-hidden="true"></i> Edit';
    		$class="edit_btn btn btn-primary btn-xs";
            $modal ="";


    	}elseif($type==="edit-modal"){
            $icon='<i class="fa fa-edit" aria-hidden="true"></i> Edit';
            $class="edit-btn btn btn-primary btn-xs";
            $modal ="data-toggle='modal'";

        }else if($type==="view"){
    		$icon='<i class="fa fa-eye" aria-hidden="true"></i>';
    		$class="view_btn";
            $modal ="";


    	}else if($type==="delete-modal"){
            $icon='<i class="fa fa-trash" aria-hidden="true"></i>';
            $class="delete btn btn-danger btn-xs";
            $modal ="data-toggle='modal'";


        }else{
    		$icon='<i class="fa fa-trash" aria-hidden="true"></i> Delete';
    		$class="delete_btn btn btn-danger btn-xs";
            $modal ="";
    		return '<a href="'.$url.'" '. $modal.'  target="'.$target.'"  class="'.$class.'">'.$icon.'</a>';
    	}
    	return '<a href="'.$url.'"  '. $modal.' class="'.$class.'">'.$icon.'</a>';
    	
       
    }   
     
}