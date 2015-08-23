
</div>
<div class="footer">
	&copy; <?php echo date("Y"); ?> <a href="http://www.focuskenya.org" target="_blank">FOCUS Kenya</a> &bull; Engineered with <i class="fa fa-heart"></i> at 
	<a href="http://labs.beyon.de/" target="_blank">Beyonde Labs</a>.
</div>



    <script src="<?php echo base_url();?>assets/js/jquery-2.1.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <?php if(isset($date_picker)):?>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>

    <script>
      $('.date-picker').datepicker(
        {
          format:'yyyy-mm-dd'
        }
      );
    </script>

	<?php endif; ?>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url(); ?>assets/js/ie10-viewport-bug-workaround.js"></script>

    <?php if(isset($datatables)): ?>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('table.data').DataTable();
      });
    </script>
    <?php endif; ?>

    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56888644-1', 'auto');
  ga('send', 'pageview');

</script>
  </body>
</html>
