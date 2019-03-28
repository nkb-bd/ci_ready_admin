<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php echo form_open_multipart('', array('role'=>'form')); ?>

<div class="card ">
  <div class="card-body">


   
    <div id="accordion">
        <div class="row"><br /></div>

            <?php 
            $keys = array_keys($result);
            for($i = 0; $i < count($result); $i++) {

                ?>
                 <div class="">
                  <h4 class="panel-title">
                      <a  style="border: 1px solid #26354426;" class=" btn btn-mat waves-effect waves-light btn-inverse  btn-block text-left" data-toggle="collapse" style="display: block;" href="#<?php echo $keys[$i] ?>"><?php echo ucfirst( $keys[$i]) ?> <i class="fa fa-plus pull-right"></i></a>
                  </h4>
                </div>
                   <div id="<?php echo $keys[$i] ?>" style="border: 1px solid #26354426;" class="panel-collapse card-body  bg-light collapse <?php if($i==0){echo "show";} ?>">
                      <div class="panel-body">
                <?php
                foreach($result[$keys[$i]] as $key => $value) {

                    ?>

                 
                    <?php // prepare field values
                    $field_data = array();

                    if ($value['is_numeric'])
                    {
                        $field_data['type'] = "number";
                        $field_data['step'] = "any";
                    }

                    if ($value['options'])
                    {
                        $field_options = array();
                        if ($value['input_type'] == "dropdown")
                        {
                            $field_options[''] = lang('admin input select');
                        }
                        $lines = explode("\n", $value['options']);
                        foreach ($lines as $line)
                        {
                            $option = explode("|", $line);
                            $field_options[$option[0]] = $option[1];
                        }
                    }

                    switch ($value['input_size'])
                    {
                        case "small":
                            $col_size = "col-sm-3";
                            break;
                        case "medium":
                            $col_size = "col-sm-6";
                            break;
                        case "large":
                            $col_size = "col-sm-9";
                            break;
                        default:
                            $col_size = "col-sm-6";
                    }

                    if ($value['input_type'] == 'textarea')
                    {
                        $col_size = "col-sm-12";
                    }
                    ?>

                    <?php if ($value['translate'] && $this->session->languages && $this->session->language) : ?>

                        <?php // has translations ?>
                    

                        <?php // no translations
                        $field_data['name']  = $value['name'];
                        $field_data['id']    = $value['name'];
                        $field_data['class'] = "form-control" . (($value['show_editor']) ? " editor" : "");
                        $field_data['value'] = $value['value'];
                        ?>
                        <div class="row">
                            <div class="form-group <?php echo $col_size; ?><?php echo form_error($value['name']) ? ' has-error' : ''; ?>">
                                <?php echo form_label($value['label'], $value['name'], array('class'=>'control-label')); ?>
                                <?php if (strpos($value['validation'], 'required') !== FALSE) : ?>
                                    <span class="required">*</span>
                                <?php endif; ?>

                                <?php // render the correct input method
                                if ($value['input_type'] == 'input')
                                {
                                    echo form_input($field_data);
                                }
                                elseif ($value['input_type'] == 'textarea')
                                {
                                    echo form_textarea($field_data);
                                }
                                elseif ($value['input_type'] == 'radio')
                                {
                                    echo "<br />";
                                    foreach ($field_options as $value=>$label)
                                    {
                                        echo form_radio(array('name'=>$field_data['name'], 'id'=>$field_data['id'] . "-" . $value, 'value'=>$value, 'checked'=>(($value == $field_data['value']) ? 'checked' : FALSE)));
                                        echo $label;
                                    }
                                }
                                elseif ($value['input_type'] == 'dropdown')
                                {
                                    echo form_dropdown($value['name'], $field_options, $field_data['value'], 'id="' . $field_data['id'] . '" class="' . $field_data['class'] . '"');
                                }
                                elseif ($value['input_type'] == 'timezones')
                                {
                                    echo "<br />";
                                    echo timezone_menu($field_data['value']);
                                }
                                   elseif ($value['input_type'] == 'file')
                                {
                                    echo "<br />";
                                    echo '<input type="file" name="'.$field_data['name'].'" single/>';
                                }
                                ?>

                                <?php if ($value['help_text']) : ?>
                                    <span class="help-block"><?php echo $value['help_text']; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php else : ?>


                        <?php // no translations
                        $field_data['name']  = $value['name'];
                        $field_data['id']    = $value['name'];
                        $field_data['class'] = "form-control" . (($value['show_editor']) ? " editor" : "");
                        $field_data['value'] = $value['value'];
                        ?>
                        <div class="row">
                            <div class="form-group <?php echo $col_size; ?><?php echo form_error($value['name']) ? ' has-error' : ''; ?>">
                                <?php echo form_label($value['label'], $value['name'], array('class'=>'control-label f-w-600')); ?>
                                <?php if (strpos($value['validation'], 'required') !== FALSE) : ?>
                                    <span class="required">*</span>
                                <?php endif; ?>

                                <?php // render the correct input method
                                if ($value['input_type'] == 'input')
                                {
                                    echo form_input($field_data);
                                }
                                elseif ($value['input_type'] == 'textarea')
                                {
                                    echo form_textarea($field_data);
                                }
                                elseif ($value['input_type'] == 'radio')
                                {
                                    echo "<br />";
                                    foreach ($field_options as $value=>$label)
                                    {
                                        echo form_radio(array('name'=>$field_data['name'], 'id'=>$field_data['id'] . "-" . $value, 'value'=>$value, 'checked'=>(($value == $field_data['value']) ? 'checked' : FALSE)));
                                        echo $label;
                                    }
                                }
                                elseif ($value['input_type'] == 'dropdown')
                                {
                                    echo form_dropdown($value['name'], $field_options, $field_data['value'], 'id="' . $field_data['id'] . '" class="' . $field_data['class'] . '"');
                                }
                                elseif ($value['input_type'] == 'timezones')
                                {
                                    echo "<br />";
                                    echo timezone_menu($field_data['value']);
                                }
                                   elseif ($value['input_type'] == 'file')
                                {
                                    echo "<br />";
                                    echo "<img src='".base_url().$field_data['value']."' style='width:50px;' >";
                                    echo "<br />";
                                    
                                    echo '<input type="file" name="'.$field_data['name'].'" single />';
                                }
                                ?>

                                <?php if ($value['help_text']) : ?>
                                    <span class="help-block"><?php echo $value['help_text']; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php
                }
                echo '</div>
                  <div class="panel-footer"></div>
                </div>  ';
            }
            ?>


        </div>
  

     <div class=" ">
        <a class="btn btn-link" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
        <button type="submit" name="submit" class="btn btn-primary"><span class="fa fa-save"></span> Update</button>
    </div>

</div>
   


<?php echo form_close(); ?>
