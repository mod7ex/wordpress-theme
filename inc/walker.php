<?php 


class Primary_Nav_Walker extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = \null)
    {
        $indent = str_repeat("\t", $depth);

        $submenu = ($depth > 0) ? 'sub-menu' : '';

        $output .= "\n$indent<ul class=\"dropdown-menu $submenu depth-$depth\" >\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = \null, $id = 0)
    {
        $indent = str_repeat("\t", $depth);

        $li_attributes = '';
        $values = '';

        // $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes = array();
        $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';

        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = ' class="' . esc_attr($class_names) . '" ';

        $id = apply_filters('nav_menu_item_id', 'menu_item-' . $item->ID, $item, $args);
        $id = ' id="' . esc_attr($id) . '" ';

        $output .= $indent . '<li' . $id . $values . $class_names . $li_attributes . '>';

        // making the a tag
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '" ' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '" ' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '" ' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '" ' : '';
        // $attributes .= ($args->walker->has_children) ? ' data-toggle="dropdown" ' : '';

        // $a_classes = array('nav-link pl-2');
        // $a_classes[] = ($args->walker->has_children) ? 'dropdown-toggle' : '';
        // $a_classes[] = $depth ? 'dropdown-item' : '';
        // $a_classes = join(' ', $a_classes);
        // $a_classes = ' class="' . esc_attr($a_classes) . '" '; // nav-item

        $menu_item = $args->before;
        $menu_item .= '<a' . $attributes . '>';
        $menu_item .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $menu_item .= '</a>';
        $menu_item .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $menu_item, $item, $depth, $args);
    }
}