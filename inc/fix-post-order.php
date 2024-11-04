<?php

/**
 * Add page attributes to post
 */
function mytheme_add_post_attributes()
{
    add_post_type_support('post', 'page-attributes');
}
add_action('init', 'mytheme_add_post_attributes', 500);

/**
 * Add the menu_order property to the post object being saved
 *
 * @param \WP_Post|\stdClass $post
 * @param WP_REST_Request $request
 *
 * @return \WP_Post
 */
function mytheme_pre_insert_post($post, \WP_REST_Request $request)
{
    $body = $request->get_body();
    if ($body) {
        $body = json_decode($body);
        if (isset($body->menu_order)) {
            $post->menu_order = $body->menu_order;
        }
    }

    return $post;
}
add_filter('rest_pre_insert_post', 'mytheme_pre_insert_post', 12, 2);


/**
 * Load the menu_order property for frontend display in the admin
 *
 * @param \WP_REST_Response $response
 * @param \WP_Post $post
 * @param \WP_REST_Request $request
 *
 * @return \WP_REST_Response
 */
function mytheme_prepare_post(\WP_REST_Response $response, $post, $request)
{
    $response->data['menu_order'] = $post->menu_order;

    return $response;
}
add_filter('rest_prepare_post', 'mytheme_prepare_post', 12, 3);