	<!--Main Start-->
			<main id="wt-main" class="wt-main wt-haslayout wt-innerbgcolor">
				<div class="wt-haslayout wt-main-section">
					<!-- User Listing Start-->
					<div class="wt-haslayout">
						<div class="container">
							<div class="row">
								<div id="wt-twocolumns" class="wt-twocolumns wt-haslayout">
									<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 float-left">
										<aside id="wt-sidebar" class="wt-sidebar">
											

											<!-- job list sidebar -->
											<?php 	$this->load->view('public/job_list_sidebar_component') ?>
											

										
										
											
											
										</aside>
									</div>
									

									<!-- job list component	 -->


									<?php $this->load->view('public/job_list_component') ?>
										
								
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- User Listing End-->
				</div>
			</main>
			<!--Main End-->