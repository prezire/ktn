class @Map
    constructor: ->
        @lat = null
        @lng = null
        @map = null
        @distance = null
        @marker = null
        @markers = null
        @circle = null
        @markers = []
        @distance = 1
        @setListeners()
        @fetchSenderLocation()
        @renderMap()

    setListeners: ->
        context = @
        $('.btn-detect-loc').click (e) ->
            context.fetchSenderLocation()
            e.preventDefault()
        $('.btn-search').click (e) ->
            context.search()
            e.preventDefault()
        $('.btn-report-now').click (e) ->
            context.sendReport()
            e.preventDefault()
    
    renderMap: ->
        context = @
        latLng = new google.maps.LatLng(@lat, @lng)
        opts = {
            zoom: 15,
            center: latLng
        }
        @map = new google.maps.Map(document.getElementById('gmap'), opts)
        marker = new google.maps.Marker({
            position: latLng,
            map: map,
            title: 'You are here!',
            draggable: true
        })
        google.maps.event.addListener(marker, 'dragend', (e) ->
            p = this.getPosition()
            context.lat = p.lat()
            context.lng = p.lng()
            #
            context.circle.setMap(null)
            context.renderCircle()
        )
        @renderCircle()
        google.maps.event.trigger(@map, 'resize')
        
    onGeoCode: (lat, lng, callback) ->
        geocoder = new google.maps.Geocoder
        latlng = {lat: lat, lng: lng}
        geocoder.geocode({'location': latlng}, (results, status) ->
        if status is 'OK'
          if results[1]
            addr = results[1].formatted_address
            callback(addr)
          else
            alert('No results found')
          
        else
          alert('Geocoder failed due to: ' + status)
        )
    
    renderCircle: ->
        circle = new google.maps.Circle({
            map: map,
            radius: @distance * 1000,
            strokeWeight:1,
            strokeOpacity:0.5,
            fillOpacity:0.2,
            fillColor: '#27AE60'
        })
        circle.bindTo('center', marker, 'position')

    fetchSenderLocation: ->
        context = @
        if navigator.geolocation
            navigator.geolocation.getCurrentPosition( (position) ->
                context.lat = position.coords.latitude
                context.lng = position.coords.longitude
                context.renderMap()
            )
        else
            alert('Geolocation is not supported by this browser.')
    
    clearAllMarkers: ->
        for marker, m in markers
            marker.setMap(null)
    
    renderSearchMarkers: ->
        clearAllMarkers(null)
        #
        for l, i in locations
            l = locations[i]
            d = l.details
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(d.lat, d.lng),
                map: map,
                title: d.address,
                icon: $('.icon-url').val()
            })
            #
            markers.push(marker)
            #
            s = '<div>' + l.description + '</div>'
            google.maps.event.addListener(marker, 'click', (marker, content, infoWindow) ->
                ###
                f = -> {
                    infoWindow.setContent(content),
                    infoWindow.open(map, marker)
                }(marker, s, new google.maps.InfoWindow())
                return f
                ###
            )
    
    search: ->
        kwds = $('form .keywords').val()
        dist = $('form .distance').val()
        if kwds.length < 1
          clearAllMarkers(null)
          e.preventDefault()
          return false
        
        data = {
          keywords: kwds,
          lat: lat,
          lng: lng,
          distance: dist
        }
        $.ajax({
          url: $('.search-report-url').val(),
          method: 'POST',
          data: data,
          success: (response) ->
            #renderSearchMarkers(response.locations)
        })
    
    sendReport: ->
        descr = $('form .description').val()
        dateTime = $('.current-date-time').val()
        status = $('form .status').val()
        photo = $('form .photo').val()
        onGeoCode(lat, lng, (addr) ->
          data = {
            description: descr,
            lat: lat,
            lng: lng,
            address: addr,
            datetime_last_seen: dateTime,
            status: status,
            photo: photo
          }
          $.ajax({
            url: $('.create-report-url').val(),
            method: 'POST',
            data: data,
            success: (response) ->
              $('.modal').modal('show')
              #Util.showModal true
          })
        )

$(document).ready -> new Map()