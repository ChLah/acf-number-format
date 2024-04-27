<?php

/** 
 * Plugin Name: ACF number format
 * Description: Provides the possibility to format ACF number fields with thousand separators and decimal places.
 * Plugin URI: https://seenland-solutions.de
 * Version: 0.0.2
 * Author: Christoph Lahner 
 * Author URI: https://seenland-solutions.de
 * Text Domain: acf-number-format
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function add_number_format_settings($field)
{
    acf_render_field_setting( $field, array(
        'label'        => __( 'Format number?', 'acf-number-format' ),
        'instructions' => __('Set this if you want the number to be formatted with thousand separators and decimal places.', 'acf-number-format'),
        'name'         => 'format_number',
        'type'         => 'true_false',
        'ui'           => 1,
    ), true );
}

function format_number_field( $value, $post_id, $field ) {
    if ( empty( $field['format_number'] ) ) {
        return $value;
    }

    return number_format(floatval($value), 0, ',', '.');
}

add_action('acf/render_field_settings/type=number', 'add_number_format_settings');
add_filter('acf/format_value/type=number', 'format_number_field', 10, 3 );
