<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'slider-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-slider';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

// Load values and assing defaults.
$slides = get_field('swiper-slider') ?: 'Добавьте изображения';

?>


<?php if ( $slides ) :  ?>
    <div class="swiper-acf-block-default--wrap">
        <div id="<?= esc_attr($id); ?>" class="swiper swiper-acf-block-default">
            <div class="swiper-wrapper">
				<?php foreach ( $slides as $slide ): ?>
                    <div class="swiper-slide">
                        <a href="<?= wp_get_attachment_url( $slide); ?>"
                           data-width="1800"
                           data-fancybox="<?= esc_attr($id); ?>">
	                        <?php $params = checkAltTitle($slide, esc_attr(get_the_title()), esc_attr(get_the_title())); ?>
							<?= wp_get_attachment_image( $slide, 'full', false, $params ); ?>
                        </a>
                    </div>
				<?php endforeach; ?>
            </div>
            <div class="swiper__buttons">
                <button class="swiper__button-prev slider-btn prev">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.33399 16L4.62688 15.2929L3.91977 16L4.62688 16.7071L5.33399 16ZM25.334 17C25.8863 17 26.334 16.5523 26.334 16C26.334 15.4477 25.8863 15 25.334 15L25.334 17ZM12.6269 7.29289L4.62688 15.2929L6.04109 16.7071L14.0411 8.70711L12.6269 7.29289ZM4.62688 16.7071L12.6269 24.7071L14.0411 23.2929L6.04109 15.2929L4.62688 16.7071ZM5.33399 17L25.334 17L25.334 15L5.33399 15L5.33399 17Z"
                              fill="#181818"/>
                    </svg>
                </button>
                <button class="swiper__button-next slider-btn next">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M26.666 16L27.3731 16.7071L28.0802 16L27.3731 15.2929L26.666 16ZM6.66601 15C6.11373 15 5.66601 15.4477 5.66601 16C5.66601 16.5523 6.11373 17 6.66601 17L6.66601 15ZM19.3731 24.7071L27.3731 16.7071L25.9589 15.2929L17.9589 23.2929L19.3731 24.7071ZM27.3731 15.2929L19.3731 7.29289L17.9589 8.70711L25.9589 16.7071L27.3731 15.2929ZM26.666 15L6.66601 15L6.66601 17L26.666 17L26.666 15Z"
                              fill="#181818"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
<?php endif; ?>
