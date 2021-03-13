<?php


class Modexy_Profile_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('modexy-profile', 'Modexy Profile Widget', array(
            'classname' => 'profile-widget',
            'description' => 'Custom Modexy Profile Widget'
        ), array());
    }

    public function form($instance)
    {
        echo '<p><strong>No options!</strong> please check <a href="/wp-admin/admin.php?page=modexy_admin">Admin page</a> to configure the widget</p>';
    }

    public function widget ($args, $instance)
    {
        global $facebook, $twitter, $github;

        $profile_url = get_option('profile_img');

        
        if(!empty($profile_url)){
            echo $args['before_widget'];
            echo '<div id="profile">';
            
            echo '<div id="profile_img" style="background-image: url(' . esc_url(wp_get_attachment_image_url($profile_url)) . ');"></div>';
            if(!empty(get_option('first_name')) && !empty(get_option('last_name'))){
                echo '<h2 class="fullname">' . get_option('first_name') . ' ' . get_option('last_name') . '</h2>';
            }
            if(!empty(get_option('description'))){
                echo '<p class="description">' . get_option('description') . '</p>';
            }

            echo '<div class="social">';
            if(!empty(get_option('twitter'))){
                echo '<a href="https://www.twitter.com/' . get_option('twitter') . '" target="_blank">' . $twitter . '</a>';
            }
            if(!empty(get_option('facebook'))){
                echo '<a href="' . get_option('facebook') . '" target="_blank">' . $facebook . '</a>';
            }
            if(!empty(get_option('github'))){
                echo '<a href="https://www.github.com/' . get_option('github') . '" target="_blank">' . $github . '</a>';
            }
            echo '</div>';
            echo '<hr>';
            echo '</div>';
            echo $args['after_widget'];
        }

    }
}

class Modexy_Popular_Posts_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('modexy-popular-posts', 'Modexy Popular Posts Widget', array(
            'classname' => 'popular-posts-widget',
            'description' => 'Custom Modexy Popular Posts Widget'
        ));
    }


    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : 'Popular Posts';
        $tot = !empty($instance['tot']) ? $instance['tot'] : 3;

        $output = '<p>';
        $output .= '<label for="' . esc_attr($this->get_field_id('title')) . '" >Title:</label>';
        $output .= '<input type="text" name="' . esc_attr($this->get_field_name('title')) . '" class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" value="' . esc_attr($title) . '" >';
        $output .= '</p>';

        $output .= '<p>';
        $output .= '<label for="' . esc_attr($this->get_field_id('tot')) . '" >Number Of Posts:</label>';
        $output .= '<input type="number" name="' . esc_attr($this->get_field_name('tot')) . '" class="widefat" id="' . esc_attr($this->get_field_id('tot')) . '" value="' . esc_attr($tot) . '" >';
        $output .= '</p>';

        echo $output;
    }

    public function widget($args, $instance)
    {
        global $post_views;
        $total = absint($instance['tot']);

        $query = new WP_Query(array(
            'post_type'         => 'post',
            'meta_key'    => $post_views,
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'posts_per_page'    => $total,
        ));

        
        if($query->have_posts()){
            echo $args['before_widget'];
            
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
            echo '<ul>';

            while($query->have_posts()){
                $query->the_post();

                echo '<li><a href="' . esc_url(get_the_permalink()) . '">' . get_the_title() . '</a> (' . modexy_get_the_views(get_the_ID()) . ')</li>';
            }

            echo '</ul>';
            echo $args['after_widget'];
        }
    }


    public function update($new_instance, $old_instance)
    {
        $instance = array();

        $instance['title'] = !empty($new_instance['title']) ? strip_tags($new_instance['title']) : 'Popular Posts';
        $instance['tot'] = !empty($new_instance['tot']) ? absint(strip_tags($new_instance['tot'])) : 3;

        return $instance;
    }
}




add_action('widgets_init', function() {
    register_widget('Modexy_Profile_Widget');
    register_widget('Modexy_Popular_Posts_Widget');
});


/*
add_filter('widget_tag_cloud_args', function($args) {
    $args['smallest'] = 8;
    $args['largest'] = 18;

    return $args;
});

add_filter('wp_list_categories', function($links){
    $links = str_replace('</a> (', '</a> <span>', $links);
    $links = str_replace(')', '</span>', $links);

    return $links;
});
*/