<?php defined('BASEPATH') OR exit('No direct script access allowed');?>



    <?php if (empty($image)): ?>

      <div class="page-header header-filter clear-filter purple-filter" data-parallax="true"   style="height:26vh;">
    <?php if ($this->settings->template!='default'): ?>
      <!-- fix ingstyle -->
          </div>
        
      <?php endif ?>


    <?php endif ?>

    <?php if (!empty($image)): ?>

      <div class="page-header header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('<?php echo base_url()?>assets/themes/default/img/bg2.jpg');">
    
    <?php endif ?>
    
    <?php if (empty($image)): ?>    

         <?php if (!empty($title)): ?>
                
          <div class="container">
              <div class="row">
                  <div class="col-md-8 ml-auto mr-auto">
                      <div class="brand text-center">
                          <h1>
                              <?php echo $title ?>
                          </h1>
                      </div>
                  </div>
              </div>
          </div>

        <?php endif ?>     


    <?php endif ?>

</div>

<div class="main main-raised">
   
    <div class="section section-basic">
    

        <div class="container" id="my-content">

            <div id="loading" class="card bg- text-white" style="background: #b9b8b8;text-align: center!important;display: inherit;height: 30vh;">  
                <img src="<?=base_url()?>assets/loading-bubbles.svg " style="width: 70px;margin-top: 80px;" alt="">
                <h4>Loading..</h4>
            </div>
          
          
        </div>
    </div>
</div>


<script>
    $.ajax({
           type: "POST",
           url: "<?=base_url()?>welcome/page_data/",
           data: {
            slug: "<?=$slug?>",
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
           },
           beforeSend: function() {
              $("#loading-image").show();
           },
           success: function(data) {

              $("#loading").slideUp(800);

               var html = $('#my-content').html(data);

               $(html).hide().appendTo("#my-content").fadeIn(1000);

           
           }
      });
    
    
    
</script>