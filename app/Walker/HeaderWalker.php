<?php

namespace App\Walker;

use Walker_Nav_Menu;

class HeaderWalker extends Walker_Nav_Menu
{
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0): void
    {
        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $classes[] = 'menu-item';
        $classes[] = 'nav-item';

        $is_current = in_array('current-menu-item', $classes) ||
                      in_array('current-menu-parent', $classes) ||
                      in_array('current-menu-ancestor', $classes);

        $attributes = '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ' class="transition-colors hover:text-indigo-600';

        if ($is_current) {
            $attributes .= ' text-indigo-600 font-semibold';
        } else {
            $attributes .= ' text-gray-700';
        }

        $attributes .= '"';

        $link = sprintf(
            '<a%s>%s</a>',
            $attributes,
            apply_filters('the_title', $item->title, $item->ID)
        );

        $item_output = $args->before ?? '';
        $item_output .= '<li class="' . esc_attr(implode(' ', $classes)) . '">';
        $item_output .= $link;
        $item_output .= '</li>';
        $item_output .= $args->after ?? '';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
