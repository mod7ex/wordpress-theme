<?php 

// $data = get_theme_mod('header_image_data');

// if(!empty($data) && property_exists($data, 'attachment_id') && isset($data->attachment_id)){
//     $attachment_id = $data->attachment_id;
//     $meta_data = wp_get_attachment_metadata($attachment_id);
// }

?>
<?php if(has_header_image()): ?>
<div id="showcase" style="background-image: url(<?php esc_url(header_image()); ?>);">
    <div id="showcase-area">
        <h1 class="shc-item"><?php bloginfo('title'); ?></h1>
        <h3 class="shc-item"><?php bloginfo('description'); ?></h3>
    </div>
</div>
<?php endif; ?>