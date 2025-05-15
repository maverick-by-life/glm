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
$lid = get_field('gutenberg-lid') ?: 'Заполните текст первого абзаца';
?>


<?php if ( $lid ) :  ?>
    <div class="lid"><?= $lid; ?></div>
<?php endif; ?>
