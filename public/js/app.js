(function() {
  this.Ktns = (function() {
    function Ktns() {
      this.setListeners();
      this.initCam();
      $('table.data-tables ').DataTable({
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
      return Webcam.snap(function(dataUri) {
        var rawImgData;
        rawImgData = dataUri.replace(/^data\:image\/\w+\;base64\,/, '');
        return $('.photo').val(rawImgData);
      });
    };

    Ktns.prototype.setListeners = function() {
      var context;
      context = this;
      return $('#report.map .btn-take-photo').click(function(e) {
        e.preventDefault();
        return context.takePhoto();
      });
    };

    return Ktns;

  })();

  $(document).ready(function() {
    return new Ktns();
  });

}).call(this);
