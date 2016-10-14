class @Ktns
    constructor: ->
        @setListeners()
        @initCam()
        @table = $('table.data-tables').DataTable({responsive: true})

    initCam: ->
        if $('#report.map').length > 0
            #https://github.com/jhuckaby/webcamjs
            Webcam.set({
                width: 150, #23.4375, 76.5625
                height: 113,
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
        context = @
        Webcam.snap( (dataUri) ->
            rawImgData = dataUri.replace(/^data\:image\/\w+\;base64\,/, '')
            $('.photo').val rawImgData
            Util.showModal true, 'Success!', 'A photo was captured.'
        )

    setListeners: ->
        context = @
        $('#report.map .btn-take-photo').click (e) ->
            e.preventDefault()
            context.takePhoto()

        $('.btn-delete').click (e) ->
            e.preventDefault()
            t = $(this)
            confirm = window.confirm 'Really delete?'
            #console.log 'sjdlfksjdf'
            #return false
            if confirm
                #Del in BG. No need for callback.
                $.get t.attr 'href'
                $('table.data-tables tr').removeClass 'selected'
                t.parent().parent().addClass 'selected'
                context.table.row('.selected').remove().draw false

$(document).ready -> new Ktns()