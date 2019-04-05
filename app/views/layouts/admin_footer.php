<div class="footer">
    <div class="container">
      <b class="copyright">&copy; 2019 Health Jam </b> All rights reserved.
  </div>
</div>

<script src="<?php echo URL; ?>/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>/js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>/js/flot/jquery.flot.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>/js/datatables/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
      $('.datatable-1').dataTable();
      $('.dataTables_paginate').addClass("btn-group datatable-pagination");
      $('.dataTables_paginate > a').wrapInner('<span />');
      $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
      $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
  } );
</script>
</body>
</html>