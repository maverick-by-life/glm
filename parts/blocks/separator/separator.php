<?php
	
	/**
	 * Testimonial Block Template.
	 *
	 * @param   array $block The block settings and attributes.
	 * @param   string $content The block inner HTML (empty).
	 * @param   bool $is_preview True during AJAX preview.
	 * @param   (int|string) $post_id The post ID this block is saved to.
	 */
	
	
	// Load values and assing defaults.
	$separator = get_field('gutenberg-separator') ?: 'Отступ между текстом (разделитель абзаца)';
?>


<?php if ( $separator ) :  ?>
	<div class="default-separator">
		<?php if (is_admin()) : ?>
			<?= $separator; ?>
		<?php endif; ?>
	</div>
<?php endif; ?>
