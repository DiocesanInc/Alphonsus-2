<?php

/**
 * Block Name: Staff Group
 * This is the template that displays the Staff Group block.
 *
 * @link https://www.advancedcustomfields.com/resources/blocks/
 *
 * @package dpiChild
 */


// create id attribute for specific styling
$id = 'sg-' . $block['id'];
$staffGroup = get_field('group');  // object
$staffGroupID = $staffGroup->term_id;
$staffGroupName = $staffGroup->name;

// Query for staff members in Group
$args = array(
	'post_type'      => 'staff', // Change to your custom post type if needed
	'posts_per_page' => -1,
	'tax_query'      => array(
		array(
			'taxonomy' => 'staff-group',
			'field'    => 'term_id', // We are querying by term ID
			'terms'    => $staffGroupID,
			'operator' => 'IN', // Can be 'IN', 'NOT IN', or 'AND'
		),
	),
);

$query = new WP_Query($args);

$posts = $query->have_posts() ? $query->posts : array();

// If staff members, render output...

if (!empty($posts)) { ?>

<div class="wp-block-group">
    <div class="staff-group-block" id="<?php echo $id; ?>">
      <h3><?php echo esc_html( $staffGroupName); ?></h3>
        <?php
		
		// Loop through all members to display each
		foreach ($posts as $post) {
			// echo esc_html($post->post_title) . '<br>';
            setup_postdata($post);
            get_template_part('/template-parts/cpts/staff/single/staff-member');
		}
		
		?>

    </div>
</div>

<?php   
} else {
    echo 'No staff found.';
}
?>

<style type="text/css">
#<?php echo $id; ?> {
    
}

</style>

<script>

</script>