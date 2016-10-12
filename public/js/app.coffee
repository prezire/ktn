class @Ktns
    constructor: ->
        @setListeners()
        @initCam()
        $('table.data-tables ').DataTable({responsive: true})

    initCam: ->
        if $('#report.map').length > 0
            #https://github.com/jhuckaby/webcamjs
            Webcam.set({
                width: 150,
                height: 150,
                dest_width: 640,
                dest_height: 480,
                image_format: 'jpeg',
                jpeg_quality: 100,
                force_flash: false,
                flip_horiz: true,
                fps: 45
            })
            Webcam.attach '.camera'

    takePhoto: ->
        Webcam.snap( (dataUri) ->
            rawImgData = dataUri.replace(/^data\:image\/\w+\;base64\,/, '')
            $('.photo').val rawImgData
        )

    setListeners: ->
        context = @
        $('#report.map .btn-take-photo').click (e) ->
            e.preventDefault()
            context.takePhoto()

$(document).ready -> new Ktns()