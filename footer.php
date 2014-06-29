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
</body>
</html>