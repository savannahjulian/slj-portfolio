				<section class="contact">
					<div class="container stamp">
						<div class="column col-7 centered">
							<p class="large">
								<?php echo get_field('contact','option'); ?>
							</p>
						</div>
					</div>
				</section>

				<section class="social">
					<div class="container stamp clearfix">

						<a href="<?php echo get_field('twitter','option'); ?>" target="_blank">Twitter</a>
						<a href="<?php echo get_field('instagram','option'); ?>" target="_blank">Instagram</a>
						<a href="<?php echo get_field('linkedin','option'); ?>" target="_blank">LinkedIn</a>
					</div>
				</section>
			</div>
		</div>
	</body>
	<script src="<?php bloginfo('template_url'); ?>/js/pjax.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/slj.js"></script>
	<script type="text/javascript" src="//use.typekit.net/xgk4vpa.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<?php wp_footer(); ?>
</html>