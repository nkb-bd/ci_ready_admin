
                <?php if ($all_category): ?>
                
                  <?php foreach ($all_category as $key => $value): ?>

                      <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 float-left">
                        <div class="wt-categorycontent">
                          <figure><img src="<?=base_url()?><?=$value['file_path']?>" alt="image description"></figure>
                          <div class="wt-cattitle">
                            <h3><a href="<?=base_url()?>assets/themes/default/javascrip:void(0);">
                              
                              <?php echo $value['name'] ?>
                            </a></h3>
                          </div>
                          <div class="wt-categoryslidup">
                           
                            <a href="<?=base_url()?>category/<?= $value['slug']?>" style="color:#fff;" class="btn btn-danger">Explore <i class="fa fa-arrow-right"></i></a>
                          </div>
                        </div>
                      </div>

                    
                  <?php endforeach ?>

                  
                <?php endif ?>
              