(function() {
  this.Util = (function() {
    function Util() {}

    Util.showModal = function(show, title, body) {
      var m;
      m = $('.modal');
      if (show) {
        m.modal('show');
        if (title) {
          $('.modal .modal-title').html(title);
        }
        if (body) {
          return $('.modal .modal-body p').html(body);
        }
      } else {
        return m.modal('hide');
      }
    };

    return Util;

  })();

}).call(this);
