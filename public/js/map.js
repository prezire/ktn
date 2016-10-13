(function() {
  this.Map = (function() {
    function Map() {
      this.lat = null;
      this.lng = null;
      this.map = null;
      this.distance = null;
      this.marker = null;
      this.markers = null;
      this.circle = null;
      this.markers = [];
      this.distance = 1;
      this.setListeners();
      this.fetchSenderLocation();
      this.renderMap();
    }

    Map.prototype.setListeners = function() {
      var context;
      context = this;
      $('.btn-detect-loc').click(function(e) {
        context.fetchSenderLocation();
        return e.preventDefault();
      });
      $('.btn-search').click(function(e) {
        context.search();
        return e.preventDefault();
      });
      return $('.btn-report-now').click(function(e) {
        context.sendReport();
        return e.preventDefault();
      });
    };

    Map.prototype.renderMap = function() {
      var context, latLng, marker, opts;
      context = this;
      latLng = new google.maps.LatLng(this.lat, this.lng);
      opts = {
        zoom: 15,
        center: latLng
      };
      this.map = new google.maps.Map(document.getElementById('gmap'), opts);
      marker = new google.maps.Marker({
        position: latLng,
        map: map,
        title: 'You are here!',
        draggable: true
      });
      google.maps.event.addListener(marker, 'dragend', function(e) {
        var p;
        p = this.getPosition();
        context.lat = p.lat();
        context.lng = p.lng();
        context.circle.setMap(null);
        return context.renderCircle();
      });
      this.renderCircle();
      return google.maps.event.trigger(this.map, 'resize');
    };

    Map.prototype.onGeoCode = function(lat, lng, callback) {
      var addr, geocoder, latlng;
      geocoder = new google.maps.Geocoder;
      latlng = {
        lat: lat,
        lng: lng
      };
      return geocoder.geocode({
        'location': latlng
      }, function(results, status) {}, status === 'OK' ? results[1] ? (addr = results[1].formatted_address, callback(addr)) : alert('No results found') : alert('Geocoder failed due to: ' + status));
    };

    Map.prototype.renderCircle = function() {
      var circle;
      circle = new google.maps.Circle({
        map: map,
        radius: this.distance * 1000,
        strokeWeight: 1,
        strokeOpacity: 0.5,
        fillOpacity: 0.2,
        fillColor: '#27AE60'
      });
      return circle.bindTo('center', marker, 'position');
    };

    Map.prototype.fetchSenderLocation = function() {
      var context;
      context = this;
      if (navigator.geolocation) {
        return navigator.geolocation.getCurrentPosition(function(position) {
          context.lat = position.coords.latitude;
          context.lng = position.coords.longitude;
          return context.renderMap();
        });
      } else {
        return alert('Geolocation is not supported by this browser.');
      }
    };

    Map.prototype.clearAllMarkers = function() {
      var m, marker, _i, _len, _results;
      _results = [];
      for (m = _i = 0, _len = markers.length; _i < _len; m = ++_i) {
        marker = markers[m];
        _results.push(marker.setMap(null));
      }
      return _results;
    };

    Map.prototype.renderSearchMarkers = function() {
      var d, i, l, marker, s, _i, _len, _results;
      clearAllMarkers(null);
      _results = [];
      for (i = _i = 0, _len = locations.length; _i < _len; i = ++_i) {
        l = locations[i];
        l = locations[i];
        d = l.details;
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(d.lat, d.lng),
          map: map,
          title: d.address,
          icon: $('.icon-url').val()
        });
        markers.push(marker);
        s = '<div>' + l.description + '</div>';
        _results.push(google.maps.event.addListener(marker, 'click', function(marker, content, infoWindow) {

          /*
          f = -> {
              infoWindow.setContent(content),
              infoWindow.open(map, marker)
          }(marker, s, new google.maps.InfoWindow())
          return f
           */
        }));
      }
      return _results;
    };

    Map.prototype.search = function() {
      var data, dist, kwds;
      kwds = $('form .keywords').val();
      dist = $('form .distance').val();
      if (kwds.length < 1) {
        clearAllMarkers(null);
        e.preventDefault();
        return false;
      }
      data = {
        keywords: kwds,
        lat: lat,
        lng: lng,
        distance: dist
      };
      return $.ajax({
        url: $('.search-report-url').val(),
        method: 'POST',
        data: data,
        success: function(response) {}
      });
    };

    Map.prototype.sendReport = function() {
      var dateTime, descr, photo, status;
      descr = $('form .description').val();
      dateTime = $('.current-date-time').val();
      status = $('form .status').val();
      photo = $('form .photo').val();
      return onGeoCode(lat, lng, function(addr) {
        var data;
        data = {
          description: descr,
          lat: lat,
          lng: lng,
          address: addr,
          datetime_last_seen: dateTime,
          status: status,
          photo: photo
        };
        return $.ajax({
          url: $('.create-report-url').val(),
          method: 'POST',
          data: data,
          success: function(response) {
            return $('.modal').modal('show');
          }
        });
      });
    };

    return Map;

  })();

  $(document).ready(function() {
    return new Map();
  });

}).call(this);
