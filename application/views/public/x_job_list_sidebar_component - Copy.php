<div class="wt-widget wt-effectiveholder">
	<div class="wt-widgettitle">
		<h2>Search </h2>
	</div>
	<div class="wt-widgetcontent">
		<form action="<?=base_url()?>search" class="wt-formtheme wt-formsearchxx	">
			
			<fieldset>
				
				<div class="form-group">
					<input type="text" name="query" class="form-control form-control-fix" name="query"  placeholder="Search leads " id="search-btn" required="" value="<?php   echo (isset($_GET['query']))?$_GET['query'] : ''  ?>" >
					<button type="submit" class="wt-searchgbtn"><i class="fa fa-search"></i></button>
				</div>
				
				<!-- location -->
				<div class="form-group row">
					<input  style=" border-top-right-radius: 0px;border-bottom-right-radius: 0px;" type="text" class="form-control form-control-fix col-md-10" placeholder="Location" name="location" id="address"   value="<?php   echo (isset($_GET['location']))?$_GET['location'] : ''  ?>"  >

					<button style=" border-top-left-radius: 0px;border-bottom-left-radius: 0px;" title="Get my location"  class="btn btn-info form-control-fix  map-btn col-md-2"> <i class="fa fa-map-marker"></i></button>
          <p><small>*Please click on the map icon to get your location and allow location access </small></p>

          <input type="hidden" name="category">

					   <div class=" slider-box col-md-12" style="display: none;padding: 0px;">

                        <div class="form-group">
                          <label for="slider"> <b>Radius (km) <span id="radius-val">10</span>  <b></label>
                          <div id="map_result" ></div>

                        </div>
                        <div class="slidecontainer form-group ">
                          <input type="range" min="1" max="150" value="10" class="slider form-control" id="myRange">
                        </div>

	                      <div id="map" class="col-md-12"></div>
                      </div>
				</div>

				<!-- location -->

				


				<?php echo 	form_close(); ?>

			</fieldset>

			<?php if (	isset($page)&&($page=='search')||$page=='category'):
			// if search page then show category
			 ?>

			 <fieldset class="">
				<div class="wt-widgettitle">
					<h2> Category</h2>
				</div>

				<div class="wt-checkboxholder wt-verticalscrollbar scrollable" style="max-height:200px; ">

				<?php if (	$all_category): ?>
					<?php foreach ($all_category as $key => $value): ?>
						
							<span class="wt-checkbox">
								<a href="<?php echo 	base_url() ?>category/<?php echo 	$value['slug'] ?>">	
									<label for="wordpress"><i class="fa fa-tag wt-viewjobtag"></i>   <?php echo 	$value['name'] ?></label>
								</a>
							</span>

					<?php endforeach ?>
				<?php endif ?>
				
					
				</div>
			</fieldset>
			<br>	
				
			<?php endif ?>	
			<?php if (	isset($page)&&($page=='category')):
			// if not search page then show sub category
			 ?>

		
					
					<?php if (($all_sub_category) && count($all_sub_category)>0): ?>

						 <fieldset>
							<div class="wt-widgettitle">
								<h2>Sub Category</h2>
							</div>
							<div class="wt-checkboxholder wt-verticalscrollbar  scrollable" style="max-height:150px; ">

						<?php foreach ($all_sub_category	 as $key => $value): ?>

							<span class="wt-checkbox">

								<a href="<?php echo 	base_url() ?>sub_category/<?php echo 	$value['parent_cat_id'] ?>/<?php echo 	$value['id'] ?>">	

									<i class="fa fa-tag wt-viewjobtag"></i> <?php echo 	$value['name'] ?>

								</a>

							


							</span>
							
						<?php endforeach ?>

							</div>
			</fieldset>
						
					<?php endif ?>
					
			
				
			<?php endif ?>
			
		</form>
	</div>
</div>





<script>

     var x = document.getElementById("demo");

      var toggle = 'false';

      $('body').on('click', '.map-btn', function(event) {
        event.preventDefault();
        /* Act on the event */
        // toggle map on or off

        toggle = (toggle === 'true') ? 'false' :'true';

        if(toggle === 'true'){

          // remove reuired button of searhc query when using location  search
          $('#search-btn').removeAttr('required');

          initMap();

        }else{

             // add reuired button of search  query when  not using location  search

              $('#select_embed').prop('required',true)

              $('#map').slideUp('slow');

              $('.slider-box').slideUp('slow');

              // set value to null
              $('#lat-input').val(''); 
              $('#lng-input').val(''); 

        }


      });
      
      // create two div with the id
      var map, infoWindow;
      var api_key = '<?php echo $this->config->item('gmap_api_key') ?>';

      var var_lat = 0;
      var var_lng = 0;


      // console.log(api);
      function initMap(){

        // for toggling map
        toggle = (toggle === 'true') ? 'true' :'false';

      	// two input field for lat lng in form
      	if(!$('#lat-input').length>0 && !$('#lng-input').length>0){

      		 	$('form').append('<input type="hidden" name="lat" id="lat-input" >');
		      	$('form').append('<input type="hidden" name="lang" id="lng-input" >');
            $('form').append('<input type="hidden" value="50" name="radius" id="radius-input" >');
      	}
     
        // first show the div
        /////////////////////
        $('#map').slideDown('slow', function() {
        
            $(this).css('min-height', '240px');

        });
        $('.slider-box').slideDown('slow', function() {
        
            $(this).css('display', 'block');

        });

        // default lat lang

        var myLatLng = {lat: -25.363, lng: 131.044};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom  : 9,
          center: myLatLng,
          fullscreenControl: true,
         
        });


            // localStorage.setItem("localMap", map);

        var perm = null;
        // get current lat lang
        if (navigator.geolocation.watchPosition) {

          navigator.geolocation.getCurrentPosition(function(position) {

            // position Found
            document.getElementById('map_result').innerHTML = 'Location Found ';

            if( var_lat!=0){

            	var pos = {
	              lat: var_lat,
	              lng: var_lng
	            };


            }else{
            	 var pos = {
	              lat: position.coords.latitude,
	              lng: position.coords.longitude
	            };

            }
           

            map.setCenter(pos);

            // set marker
            var marker = new google.maps.Marker({
                position : pos,
                map      : map,
                title    : 'Found!',
                draggable: true
              });

            // get lat lng after drag

            km = $('.slider').val();
           

            google.maps.event.addListener(marker, 'dragend', function(marker) {

              var latLng = marker.latLng;
              document.getElementById('map_result').innerHTML = 'Lat :' + latLng.lat() + ' , Lan :' +latLng.lng();
              
              get_address(latLng.lat(),latLng.lng());

              DrowCircle(marker,map,  km);

          	  // save lat lang to var
              var_lat = latLng.lat();
			        var_lng = latLng.lng();


            });

           
			
      
            get_address(pos.lat,pos.lng);

            // draw circle
            DrowCircle(marker,map, km);


   		

          });


        } else{
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }


      }

      // get address from lat and lng
      function get_address(lat,lng){


          // get address from lat lang
          $.get('https://maps.googleapis.com/maps/api/geocode/json?latlng='+lat+','+lng+'&key=<?php echo $this->config->item('gmap_api_key') ?>', function(data) {

            if (data.results[0].formatted_address.length>0) {

              $('#address').val(data.results[0].formatted_address);

            }
          });

          // set lat and alt value for formatted_address

          km = $('.slider').val();


          $('#lat-input').val(lat); 
          $('#lng-input').val(lng); 
          $('#radius-input').val(km); 

             
         
      }

      // draw circle
      function DrowCircle(marker,map,  km ) {

          
            // Add circle overlay and bind to marker
            // 1 meter =  0.001 km
            var circle = new google.maps.Circle({
              map: map,
              radius: km*1000,    // turning into km as default unit of map is meters
              strokeColor: '#FF0000',
              strokeOpacity: 0.8,
              strokeWeight: 2,
              fillColor: '#FF0000',
              fillOpacity: 0.15,

            });
            circle.bindTo('center', marker, 'position');

           
        }

        $('.slider').change(function(event) {
          /* Act on the event */

          initMap();

          $('#radius-val').html($(this).val());

        });
      // show error
      function handleLocationError(browserHasGeolocation, infoWindow, pos) {

          document.getElementById('map_result').innerHTML = '<span class="alert alert-danger"><b><small>Please enable geolocation & refresh! </small></b></span>';
      }


     
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->config->item('gmap_api_key') ?>&callback=">
</script>