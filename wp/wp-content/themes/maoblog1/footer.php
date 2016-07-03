<footer>
	<span></span>
	<div class="clearfix"></div>
	Design By <a href="http://www.yunui.com/" title="UI设计">Yunui.com</a>
</footer>
<a id="gotop" href="#top">
	<i class="glyphicon glyphicon-upload"></i>
</a>
<a id="gotools" href="#" data-toggle="modal" data-target="#myModal">
	<i class="glyphicon glyphicon-ok-circle"></i>
</a>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center" id="myModalLabel">
					Yunui.com
				</h4>
			</div>
			<div class="modal-body">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : endif; ?>
			</div>
		</div>
	</div>
</div>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/placeholder.js"></script>
<script type="text/javascript">
	$(function() {
		$('input, textarea').placeholder();
	});
</script>
<script src="<?php bloginfo('template_directory'); ?>/js/cat.js"></script>
</body>
</html>