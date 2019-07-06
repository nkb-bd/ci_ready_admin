<style>
	.pointer {cursor: pointer;}
</style>


<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left">

									<?php if (	!$this->user): ?>
										
									<div class="wt-haslayout wt-innerbannerholder" style="max-height: 160px;margin-bottom: 	10px;-webkit-box-shadow: 0px 0px 5px 2px rgba(184,184,184,1);-moz-box-shadow: 0px 0px 5px 2px rgba(184,184,184,1);box-shadow: 0px 0px 5px 2px rgba(184,184,184,1);">
										<div class="container">
											<div class="row justify-content-md-center">
												<div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
													<div class="wt-innerbannercontent">
													<div class="wt-title"><h2>Join with us!</h2></div>
													<p style="color: #efefef">	 Register and login to start buying these leads.</p>
													<div class="wt-btnarea">
								                      <a href="<?=base_url()?>register/seller" class="wt-btn">Join Now</a>
								                    </div>
													
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php endif ?>

			<div class="wt-userlistingholder wt-haslayout">
				<?php if (isset($search)&&(!empty($search))): ?>
					
					<div class="wt-userlistingtitle">
						<span><?php echo 	$total ?> results for <em>"<?php echo 	$search ?>"</em></span>
					</div>
				<?php endif ?>
				

				<?php if (	$all_project): ?>

					<?php foreach ($all_project as $key => $value): ?>
						
								

								<div class="wt-userlistinghold wt-userlistingholdvtwo wt-featured">
												<span class="wt-featuredtag">
													
												</span>
												
												<div class="wt-userlistingcontent">
													<div class="wt-contenthead">
														<div class="wt-title">
															<!-- <a href="usersingle.html">
																<i class="fa fa-check-circle"></i> Alfredo Bossard
															</a> -->
															<h2>	<?php echo 	$value['title'] ?></h2>
														</div>

													</div>
													<div class="wt-rightarea">
														<div class="wt-tag wt-widgettag">
															<a href="javascript:void(0);">
																<?php echo 	$value['sub_cat_name'] ?>
															</a>
														</div>
													</div>
												</div>
												<div class="wt-description">
													<ul class="wt-userlisting-breadcrumb">
														
															<li><span>
																<i class="fa fa-map-marker wt-viewjobfolder"></i> 
																  <?php echo 	$value['location'] ?></span>
															</li>
															<li>
																<span>
																  <i class="fa fa-gbp wt-viewjobdollar"></i>
																  <?php echo 	$value['budget'] ?>
																</span>
															</li>
															<li>
																<span>
																	<i class="fa fa-dot-circle wt-viewjobtag"></i> 
																	<?php echo 	$value['cat_name'] ?>
																</span>
															</li>
															<li>
																<span>
																	<i class="fa fa-clock wt-viewjobclock"></i> 
																	<?php echo 	$value['duration'] ?>
																</span>
															</li>
														</ul>
												</div>
												
												<div class="wt-description">	
													<?php if (	isset($value['distance'])): ?>
													<br>	
													<p class="btn btn-sm btn-info">
														 Distance : <?php echo  number_format($value['distance'], 2)	; ?> km
													</p>

													<?php endif ?>
												</div> 
												<div class="wt-description">
													<br>	
													<p>	<?php echo 	limit_text(strip_tags($value['details']),28) ?></p>
												</div>
												<div class="wt-description text-center">
															<?php

															?>
															
																	<li class="wt-btnarea" style="padding-bottom: 10px;">

																			    

																		<?php 

																


																		if ((($this->user['id'])!=$value['posted_by'])): ?>
														

																			    <a  
																					
																					
																					href="<?php echo 	base_url().'lead/view/'.$value['project_slug'] ?>"
																					class="btn btn-info pointer text-white">View

																				</a>
															

																			<?php elseif (($this->user['id'])==$value['posted_by']): ?>
																				

																				<div class="wt-btnarea">
																					<button disabled class="btn btn-info">Your Lead</button>
																				</div>

																			<?php endif ?>
																	
																	</li>	
																	

					


																

												</div>
											
											</div>

					<?php endforeach ?>

					<div class="container" style="background: #fff;">
						  <?php if (isset($pagination)) {
						  	echo $pagination;
						  }  ?>
					</div>
					
				<?php endif ?>

				<?php if (	!$all_project): ?>
						<div class="wt-userlistinghold wt-featured wt-userlistingholdvtwo">
									
									<div class="wt-userlistingcontent">
										<div class="wt-contenthead">
											<div class="wt-title">
												
												<h2>
													No result Found! Please try again.

												</h2>
											</div>
											
										</div>
										
									</div>
								</div>
				<?php endif ?>



<!-- buy lead Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Buy Lead</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      	Are you sure want to buy 
        <strong> <span id="modal-myvar"></span> <span id="modal-bb"></span></strong> ?<br>
        After buying this lead you can contact with the seller. <br>
        Lead Cost  <?= get_currency() ?><span id="modal-myvalue"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <a id="buy-lead" href=""  class="btn btn-primary">Buy</a>

      </div>
    </div>
  </div>
</div>



<script src="<?=base_url()?>assets/themes/default/js/popper.min.js"></script>									
<script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover(); 

  // data-* attributes to scan when populating modal values
	var ATTRIBUTES = ['myvalue', 'myvar', 'bb','link'];

	$('[data-toggle="modal"]').on('click', function (e) {
	  // convert target (e.g. the button) to jquery object
	  var $target = $(e.target);
	  // modal targeted by the button
	  var modalSelector = $target.data('target');

	  var link = $(this).data('link');
	  
	  $("#buy-lead").attr("href", "<?php echo 	base_url() ?>lead/view/"+link);
	  // iterate over each possible data-* attribute
	  ATTRIBUTES.forEach(function (attributeName) {
	    // retrieve the dom element corresponding to current attribute
	    var $modalAttribute = $(modalSelector + ' #modal-' + attributeName);
	    var dataValue = $target.data(attributeName);
	    
	    // if the attribute value is empty, $target.data() will return undefined.
	    // In JS boolean expressions return operands and are not coerced into
	    // booleans. That way is dataValue is undefined, the left part of the following
	    // Boolean expression evaluate to false and the empty string will be returned
	    $modalAttribute.text(dataValue || '');
	  });
	});
});
</script>