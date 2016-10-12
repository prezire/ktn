(function() {
  this.Ktns = (function() {
    function Ktns() {
      this.setListeners();
      $('table.data-tables ').DataTable({
        responsive: true
      });
    }

    Ktns.prototype.setListeners = function() {};

    return Ktns;

  })();

  $(document).ready(function() {
    return new Ktns();
  });

}).call(this);
