<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- main body -->


<!-- spinner -->

<style>
    .spinner {
  width: 40px;
  height: 40px;

  position: relative;
  margin: 100px auto;

  display: none;
}

.double-bounce1, .double-bounce2 {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background-color: #333;
  opacity: 0.6;
  position: absolute;
  top: 0;
  left: 0;
  
  -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
  animation: sk-bounce 2.0s infinite ease-in-out;
}

.double-bounce2 {
  -webkit-animation-delay: -1.0s;
  animation-delay: -1.0s;
}

@-webkit-keyframes sk-bounce {
  0%, 100% { -webkit-transform: scale(0.0) }
  50% { -webkit-transform: scale(1.0) }
}

@keyframes sk-bounce {
  0%, 100% { 
    transform: scale(0.0);
    -webkit-transform: scale(0.0);
  } 50% { 
    transform: scale(1.0);
    -webkit-transform: scale(1.0);
  }
}
</style>

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
  .wt-userlisting-breadcrumb li:first-child {
    padding: 0 12px;
    border-left: 1px solid #767676;
}
</style>
<link rel="stylesheet" href="<?=base_url()?>assets/themes/default/css/dashboard.css">
<!-- main body -->
<main id="wt-main" class="wt-main wt-haslayout">
<!--Sidebar Start-->
        <div id="wt-sidebarwrapper" class="wt-sidebarwrapper">
          
          <?php require_once 'application/views/inc/user_sidebar.php'; ?>

        </div>
        <!--Sidebar Start-->

      <!--Register Form Start-->
                    <section class="wt-haslayout wt-dbsectionspace">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-12">
                                <div class="wt-dashboardbox wt-messages-holder">
                                    <div class="wt-dashboardboxtitle">
                                        <h2>Messages</h2>
                                    </div>
                                    
                                    <div class="wt-dashboardboxcontent wt-dashboardholder wt-offersmessages">
                                        <ul>
                                            <li class="my-scroll" style="border-right: 1px solid #ddd;height: 100vh;overflow-y:auto; ">
                                              <!--   <form class="wt-formtheme wt-formsearch">
                                                    <fieldset>
                                                        <div class="form-group">
                                                            <input type="text" name="Location" class="form-control" placeholder="Search Here">
                                                            <a href="javascrip:void(0);" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></a>
                                                        </div>
                                                    </fieldset>
                                                </form> -->
                                               
                                                <div class=" user-list-box">


                                                    
                                                
                                                    
                                               
                                                </div>
                                            </li>
                                            <li>
                                                <div class="wt-chatarea">

                                                    <!--
| CHAT CONTACT HOVER SECTION
-->

<!--CHAT CONTAINER STARTS HERE-->
<div id="chat-container" class="fixed"></div>



<!--
| INDIVIDUAL CHAT SECTION
-->
<div id="chat-box" style="top: 400px">
<div class="chat-box-header">
   
    <span class="user-status is-online"></span>
    <span class="display-name"></span>
    <small></small>
</div>




                                                    <div class=" ">

                                                        <div class="msg-list-partner" style="overflow-y: auto;max-height: 500px;">
                                                            
                                                        </div>
                                                        <div class="spinner">
                                                          <div class="double-bounce1"></div>
                                                          <div class="double-bounce2"></div>
                                                        </div>

                                                

                                                    <div class="wt-replaybox">
                                                        <?php $attr = array('class' => 'send_reply','id'=>'msg_send_box'); ?>
                                                        <?php echo form_open('chat/send_msg',$attr); ?>
                                                        <div class="form-group">
                                                            <textarea id="text" maxlength="200" style="    border: 1px solid #adadad;" required class="form-control" name="reply" class="user_reply_txt" placeholder="Type message here"></textarea>
                                                        </div>
                                                        <div class="wt-iconbox">
                                                            <!-- <i class="lnr lnr-thumbs-up"></i>
                                                            <i class="lnr lnr-thumbs-down"></i>
                                                            <i class="lnr lnr-smile"></i> -->
                                                            <button class="wt-btnsendmsg"  id="submit" type="submit">Send</button>
                                                        </div>

                                                        <input type="hidden" class="user_msg_to" name="to" value="">

                                                        <?php echo form_close(); ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </section>
                    <!--Register Form End-->
  </main>
<!--Main End--> 

<script type="text/javascript">var base = "<?php echo base_url();?>";</script>


<script>
    


  jQuery(document).ready(function($) {


    $('#text').keydown(function() {
      var message = $("textarea").val();

      if (event.keyCode == 13) {
        if (message == "") {

            alert("Enter Some Text In Textarea");
          } else {
            $('.send_reply').submit();
          }
            $("textarea").val('');
            return false;
      }
      });
    
   
    setInterval(function(){ 

        get_list(false);
        // get thecurrent user slectd
        if ( $('.user_msg_to').val()) {

           get_partner_chat($('.user_msg_to').val());
        }

     

    }, 10000);


  get_list(true);

    // refresh auto


    function scroll_to_new_text(){
        


         $('.msg-list-partner').slimscroll({
            start: 'bottom',
            });
        // append your html
        // then calculate the new scroll height
        var bottomCoord = $('.msg-list-partner')[0].scrollHeight;
        $('.msg-list-partner').slimScroll({scrollTo: bottomCoord});


      
    }


    function get_list($page_load=false){



        var user_list_box = $('.user-list-box');

        $.ajaxSetup({
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            }
        });

        $.ajax({
            url: '<?=base_url()?>chat/user_list_html',
            type: 'POST',
            dataType: 'json',
            data: {param1: 'value1'},
              beforeSend: function() {
                // setting a timeout
                user_list_box.append('<i class="fa fa-circle-o-notch fa-spin" style="font-size:20px; padding:20px;"> </i>')
            }
           
        })
        .done(function(data) {
          $('.fa-spin').hide();

              user_list_box.html(data);

                // if first load then auto select the first chat user box
             
            
                if($page_load){

                  //   if ( $( ".wt-user" ).length ) {
                      

                  //     var uid = $('.wt-user').data('uid');
                  //     $('.user_msg_to').val(uid);
                  //     get_partner_chat(uid);  
                    
                   
                  // }
                }
                  <?php if ($this->session->flashdata('msg_to')) { ?>
                  // if session set for the reciver user
                  var reciver_id = <?=$this->session->flashdata('msg_to')?>;
                  console.log(reciver_id);
                  console.log('here');
                  $('*[data-uid="'+reciver_id+'"]').click();
                  
                    var uid = reciver_id;
                    $('.user_msg_to').val(uid);
                    get_partner_chat(uid);  

                <?php } ?>

        })
        .fail(function() {
            console.log("error");
          $('.fa-spin').hide();

        })
        .always(function() {
          $('.fa-spin').hide();
        });



      

      
        
    }



    $('body').on('click', '.wt-user', function(event) {
        event.preventDefault();


        $('.wt-user.userlist_active').removeClass('userlist_active');
        $(this).addClass('userlist_active');
        // get clicked user value and set to form to send msg to db
        var user_id = $(this).data('uid');
        
        $('.user_msg_to').val(user_id);

        get_partner_chat(user_id);

        $('.spinner').fadeIn(400);
    });

    function get_partner_chat(id){

        var partner_chat_box =$('.msg-list-partner');

        $('#msg_send_box').show();

        $.ajaxSetup({
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            }
        });

        $.ajax({
            url: '<?=base_url()?>chat/get_partner_chat',
            type: 'POST',
            dataType: 'json',
            data: {user_id: id},
              beforeSend: function() {


                   // $('.spinner').fadeIn(400);
            }
           
        })
        .done(function(data) {


             
               $('.spinner').fadeOut(400);
               partner_chat_box.html(data);


               scroll_to_new_text();

        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
              $('.spinner').fadeOut(400);
        });



    }



     // send msg and refresh
    $(".send_reply").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');
        var msg_box = $(this).find('.user_reply_txt');
        var partner_id = $('.user_msg_to').val();
        $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {    
                console.log(data);
                   if(data==true){
                   


                    get_partner_chat(partner_id);

                    scroll_to_new_text();
                }else{
                    console.log('error');
                }

                 form.trigger("reset");
               }
             });
        form.trigger("reset");


    });

        // enter function

        $(".user_reply_txt").keypress(function (e) {

          console.log('x');
            var code = (e.keyCode ? e.keyCode : e.which);
            //alert(code);
            if (code == 13) {
                $("#submit").trigger('click');
                return true;
            }
        });

         <?php if ($this->session->flashdata('msg_to')) { ?>

          var reciver_id = <?=$this->session->flashdata('msg_to')?>;
          console.log(reciver_id);
          console.log('here');
          $('*[data-uid="'+reciver_id+'"]').click();

            var uid = reciver_id;
            $('.user_msg_to').val(uid);
            get_partner_chat(uid);  

        <?php } ?>


   

 });



</script> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<script>
  
</script>