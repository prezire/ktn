<div id="report" class="map">
    <h1>Map</h1>
    <a href="<?php echo site_url(); ?>" class="btn btn-default">Home</a>
    <div>
        <!-- <a href="#" class="btn btn-primary take-photo">Take Photo</a> -->
        
        <form>
            <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="keywords" placeholder="Orange kitten." />
                    <select class="distance">
                      <option value="1">1 KM</option>
                      <option value="2">2 KM</option>
                      <option value="5">5 KM</option>
                      <option value="10">10 KM</option>
                      <option value="20">20 KM</option>
                      <option value="50">50 KM</option>
                      <option value="100">100 KM</option>
                    </select>
                    <button class="btn-search">Search</button>
                    <div>
                        <button class="btn-detect-loc">Detect My Location</button>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div>Seen a kitten? Report it.</div>
                    <input type="text" class="description" placeholder="Description: orange kitten, alone and soaked in rain." />
                    <button class="btn-report-now">Report Now</button>
                    <div><?php echo \Carbon\Carbon::now(); ?></div>
                </div>
            </div>
          </form>
        
        <div id="gmap"></div>

        <div class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Report Sent</h4>
              </div>
              <div class="modal-body">
                <p>Thank you.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyBxePLLPbYx5YD3_jPNejePTALh57xaYWo"></script>
        <script type="text/javascript">
          $(document).ready(function(){
            var lat;
            var lng;
            var map;
            var distance;
            var marker;
            var markers;
            var circle;
            function renderMap() {
              var latLng = new google.maps.LatLng(lat, lng);
              var opts = {
                zoom: 15,
                center: latLng
              }
              map = new google.maps.Map(document.getElementById('gmap'), opts);
              marker = new google.maps.Marker({
                  position: latLng,
                  map: map,
                  title: 'You are here!',
                  draggable: true
              });
              google.maps.event.addListener(marker, 'dragend', function(event) {
                var p = this.getPosition();
                lat = p.lat();
                lng = p.lng();
                //
                circle.setMap(null);
                renderCircle();
              });
              renderCircle();
              google.maps.event.trigger(map, 'resize');
            }
            function renderCircle(){
              circle = new google.maps.Circle({
                map: map,
                radius: distance * 1000,
                strokeWeight:1,
                strokeOpacity:0.5,
                fillOpacity:0.2,
                fillColor: '#27AE60'
              });
              circle.bindTo('center', marker, 'position');
            }
            function fetchSenderLocation(){
                
                // KLUDGE: Not sure if this is the fix for detecting mobile 
                // device locations that have GPS settings turned off.
                // http://stackoverflow.com/questions/3397585/navigator-geolocation-getcurrentposition-sometimes-works-sometimes-doesnt
                
                /*function getGeoLocation() {
                    var options = null;
                    if (navigator.geolocation) {
                        if (browserChrome) //set this var looking for Chrome un user-agent header
                            options={enableHighAccuracy: false, maximumAge: 15000, timeout: 30000};
                        else
                            options={maximumAge:Infinity, timeout:0};
                        navigator.geolocation.getCurrentPosition(getGeoLocationCallback,
                                getGeoLocationErrorCallback,
                               options);
                    }
                }*/
              
              if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(
                  function(position){
                    lat = position.coords.latitude;
                    lng = position.coords.longitude;
                    //
                    renderMap();
                  }
                );
              }
              else{
                alert('Geolocation is not supported by this browser.');
              }
            }
            function clearAllMarkers(){
              for (var i = 0; i < markers.length; i++) {
                  markers[i].setMap(null);
              }
            }
            function renderSearchMarkers(locations){
              clearAllMarkers(null);
              //
              for (var i = 0; i < locations.length; i++) {
                var l = locations[i];
                var d = l.details;
                var marker = new google.maps.Marker({
                  position: new google.maps.LatLng(d.lat, d.lng),
                  map: map,
                  title: d.address,
                  icon: "<?php echo base_url('public/images/radius_map_pin.png'); ?>"
                });
                //
                markers.push(marker);
                //
                var s = '<div>' + l.description + '</div>';
                google.maps.event.addListener(marker, 'click', 
                  function(marker, content, infoWindow) {
                     return function() {
                        infoWindow.setContent(content);
                        infoWindow.open(map, marker);
                    };
                  }(marker, s, new google.maps.InfoWindow())
                );
              }
            }
            function setListeners(){
              $('.btn-detect-loc').click(function(e){
                fetchSenderLocation();
                e.preventDefault();
              });
              /*$('form .keywords').change(function(e) {
                  $('.btn-search').focus();
              });
              $('form .distance').change(function(){
                distance = parseInt($(this).val());
                circle.setMap(null);
                renderCircle();
              });*/
              $('.btn-search').click(function(e){
                search();
                e.preventDefault();
              });
              $('.btn-report-now').click(function(e){
                sendReport();
                e.preventDefault(); 
              });
            }
            function search()
            {
                var kwds = $('form .keywords').val();
                var dist = $('form .distance').val();
                if(kwds.length < 1){
                  clearAllMarkers(null);
                  e.preventDefault();
                  return false;
                }
                var data = {
                  keywords: kwds, 
                  lat: lat, 
                  lng: lng,
                  distance: dist
                };
                $.ajax({
                  url: "<?php echo site_url('Report/search'); ?>", 
                  method: 'POST',
                  data: data,
                  success: function(response){
                    console.log(response);
                    //renderSearchMarkers(response.locations);
                  }
                });
            }
            function sendReport()
            {
                var descr = $('form .description').val();
                var dateTime = "<?php echo \Carbon\Carbon::now(); ?>"
                var data = {
                  description: descr, 
                  lat: lat, 
                  lng: lng,
                  datetime_last_seen: dateTime
                };
                $.ajax({
                  url: "<?php echo site_url('Report/create'); ?>", 
                  method: 'POST',
                  data: data,
                  success: function(response){
                    $('.modal').modal('show');
                  }
                });
            }
            function init(){
              markers = [];
              distance = 1;
              setListeners();
              fetchSenderLocation();
              renderMap();
            }
            init();
          });
        </script>

    </div>
</div>