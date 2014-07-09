</div>
<?php if ( is_user_logged_in() ) { ?>
<footer>
	<div class="container">
	<?php get_search_form(); ?>
	</div>
</footer>
<div id="resultado_buscador"><div class="container"></div></div>
<?php } ?>
<?php wp_footer(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-52604177-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>