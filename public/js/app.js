(function() {
  this.Ktns = (function() {
    function Ktns() {
      this.setListeners();
      this.initCam();
      this.table = $('table.data-tables').DataTable({
        responsive: true
      });
    }

    Ktns.prototype.initCam = function() {
      if ($('#report.map').length > 0) {
        Webcam.set({
          width: 150,
          height: 113,
          dest_width: 640,
          dest_height: 480,
          image_format: 'jpeg',
          jpeg_quality: 100,
          force_flash: false,
          flip_horiz: true,
          fps: 45
        });
        return Webcam.attach('.camera');
      }
    };

    Ktns.prototype.takePhoto = function() {
      var context;
      context = this;
      return Webcam.snap(function(dataUri) {
        var rawImgData;
        rawImgData = dataUri.replace(/^data\:image\/\w+\;base64\,/, '');
        $('.photo').val(rawImgData);
        return Util.showModal(true, 'Success!', 'A photo was captured.');
      });
    };

    Ktns.prototype.setListeners = function() {
      var context;
      context = this;
      $('#report.map .btn-take-photo').click(function(e) {
        e.preventDefault();
        return context.takePhoto();
      });
      return $('.btn-delete').click(function(e) {
        var confirm, t;
        e.preventDefault();
        t = $(this);
        confirm = window.confirm('Really delete?');
        if (confirm) {
          $.get(t.attr('href'));
          $('table.data-tables tr').removeClass('selected');
          t.parent().parent().addClass('selected');
          return context.table.row('.selected').remove().draw(false);
        }
      });
    };

    return Ktns;

  })();

  $(document).ready(function() {
    return new Ktns();
  });

}).call(this);
