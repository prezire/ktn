class @Ktns
    constructor: ->
        @setListeners()
        $('table.data-tables ').DataTable()

    setListeners: ->
        #https://davidwalsh.name/browser-camera
        #$('#report.map .btn.take-photo').

$(document).ready -> new Ktns()