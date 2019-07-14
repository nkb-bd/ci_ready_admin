
<script>

     var x = document.getElementById("demo");



      $('body').on('click', '.map-btn', function(event) {
        event.preventDefault();
        /* Act on the event */
        initMap();
      });
      
      // create two div with the id
      var map, infoWindow;
      var api_key = '<?php echo $this->config->item('gmap_api_key') ?>';

      var var_lat = 0;
      var var_lng = 0;

      var markers = [];
      var circles = [];

     
      // console.log(api);
      function initMap(){





      	// two input field for lat lng in form
      	if(!$('#lat-input').length>0 && !$('#lng-input').length>0){

      		 	$('form').append('<input type="hidden" name="lat" id="lat-input" >');
		      	$('form').append('<input type="hidden" name="lang" id="lng-input" >');
            // $('form').append('  <input id="pac-input" class="controls form-control " type="text" placeholder="Search Location">');

      	}
     
        // first show the div
        /////////////////////
        $('#map').slideDown('slow', function() {
        
            $(this).css('min-height', '200px');
            $(this).css('max-height', '200px');
            // $(this).append(' <div class="form-group"><input id="pac-input" class="controls form-control " type="text" placeholder="Search Location"></div>')



        });
        $('.slider-box').slideDown('slow', function() {
        
            $(this).css('display', 'block');

        });

        // default lat lang

        var myLatLng = {lat: -25.363, lng: 131.044};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom  : 9,
          center: myLatLng
        });


          var input = document.getElementById('pac-input');
          var searchBox = new google.maps.places.SearchBox(input);
          // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

          // Bias the SearchBox results towards current map's viewport.
          map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
          });

          // var markers = [];
          // Listen for the event fired when the user selects a prediction and retrieve
          // more details for that place.
          searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
              return;
            }

            // console.log(places)


            place = places[0] ;
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
              }
            // console.log(place.geometry)


            create_map(place.geometry);

            // Clear out the old markers.

            // For each place, get the icon, name and location.
            // var bounds = new google.maps.LatLngBounds();
           
        
            km = $('.slider').val();



            // map.fitBounds(bounds);
        });

            // localStorage.setItem("localMap", map);


        // get current lat lang
        if (navigator.geolocation) {

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
            
            create_map(pos);


          var input = document.getElementById('pac-input');
          var searchBox = new google.maps.places.SearchBox(input);
          // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

          // Bias the SearchBox results towards current map's viewport.
          map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
          });

          // var markers = [];
          // Listen for the event fired when the user selects a prediction and retrieve
          // more details for that place.
          searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
              return;
            }

            console.log(places)


            place = places[0] ;
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
              }
            console.log(place.geometry)

             var pos = {
                lat: place.geometry.location.lat(),
                lng: place.geometry.location.lng()
              };
            create_map(pos);
           

        });


            function create_map(pos){

              // clear previos marker
              setMapOnAll(null);
              marker=null
            
              map.setCenter(pos);



              // set marker
              var marker = new google.maps.Marker({
                  position : pos,
                  map      : map,
                  title    : 'Found!',
                  draggable: true
                });

              markers.push(marker);
            
              // Push your newly created marker into the array:


              google.maps.event.addListener(marker, 'dragend', function(marker) {

                var latLng = marker.latLng;
                document.getElementById('map_result').innerHTML = 'Lat :' + latLng.lat() + ' , Lan :' +latLng.lng();
                
                get_address(latLng.lat(),latLng.lng());

                DrowCircle(marker,map, latLng, km);

                // save lat lang to var
                var_lat = latLng.lat();
                var_lng = latLng.lng();


              });

             
        
              km = $('.slider').val();
          
              get_address(pos.lat,pos.lng);

              // draw circle
              DrowCircle(marker,map, pos, km);



            }

            // get total user near count

     		    $.post('<?=base_url()?>projects/near_me', {lat: pos.lat, lan:pos.lng , radius:$('.slider').val()}, function(data, textStatus, xhr) {
  		     	/*optional stuff to do after success */
  		     	if(data.count){


  			     	$('#user_found').html('<span class="alert alert-info"> Total '+data.count+' users found near your location (approximately)</span>');
  		     	}
  		     	
  		     });
         

          });


        } else {
          // Browser doesn't support Geolocation
          infoWindow=null;
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

          $('#lat-input').val(lat); 
          $('#lng-input').val(lng); 

             
         
      }

      function DrowCircle(marker, map, pos, km ) {

            //********************
            // draw circle
            // 1 meter =  0.001 km


            // rmove previos
            if(circles.length>0){

               for (var i = 0; i < circles.length; i++) {
                  // circles[i].visible = false;
                  circles[i].setMap(null);
                }                
              circle =null;
            }
       

            var circle = new google.maps.Circle({
              map          : map,
              radius       : km*1000,    // turning into km as default unit of map is meters
              strokeColor  : '#FF0000',
              strokeOpacity: 0.8,
              strokeWeight : 2,
              fillColor    : '#FF0000',
              fillOpacity  : 0.15,

            });
            circle.bindTo('center', marker, 'position');
            circles.push(circle);

            //************************
            // get near user total count
            //get users count near  that location
            $.ajax({
            	url: '<?=base_url()?>projects/near_me',
            	type: 'POST',
            	dataType: 'json',
            	data: {lat: pos.lat, lan : pos.lng , radius : $('.slider').val()},
            })
            .done(function(data) {

            	if(data.result ==1){


			           	$('#user_found').html('<span class="alert alert-info">'+data.count+' users found near this location (approximately)</span>');

    		     	}else{
    		     		$('#user_found').html('');
    		     	}
            })

            
            .fail(function() {
            	console.log("error");
            })


      }

      // Sets the map on all markers in the array.
      function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }

    

        $('.slider').change(function(event) {

          initMap();
          $('#radius-val').html($(this).val());

        });

      // show error
      function handleLocationError(browserHasGeolocation, infoWindow, pos) {

          document.getElementById('map_result').innerHTML = 'Geolocation is not supported by this browser.';
      }


     
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->config->item('gmap_api_key') ?>&libraries=places&callback=">
</script>