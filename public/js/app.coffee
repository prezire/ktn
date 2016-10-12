class @Ktns
    constructor: ->
        @setListeners()
        $('table.data-tables ').DataTable({responsive: true})

    setListeners: ->
        #https://davidwalsh.name/browser-camera
        #$('#report.map .btn.take-photo').

$(document).ready -> new Ktns()