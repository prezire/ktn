class @Util
    @showModal: (show, title, body) ->
        m = $('.modal')
        if show
            m.modal 'show'
            if title
                $('.modal .modal-title').html title
            if body
                $('.modal .modal-body p').html body
        else
            m.modal 'hide'