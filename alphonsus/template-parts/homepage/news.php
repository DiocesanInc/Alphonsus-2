<?php

/**
 * Template part for displaying the news on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

$news = get_field("news_category");
$show = getField("show_news", false,  false, false);


if ($show && $news) : ?>
    <div class="news-container limit-width">
        <h2 class="has-text-decoration text-decoration-is-centered has-primary-background-color-after">
            <?php echo get_cat_name($news); ?>
        </h2>
        <div class="news-posts">

            <?php

            $num_posts = 3; //number of posts to display

            $sticky_posts = get_option('sticky_posts');

            if ($sticky_posts) :
                $query = new WP_Query(array(
                    "post_type" => "post",
                    "posts_per_page" => $num_posts,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    "category__in" => $news,
                    "post__in" => $sticky_posts,
                ));

                $num_posts -= $query->found_posts; //subtract number of sticky posts

                //Show Sticky posts
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        get_template_part("template-parts/homepage/news", "post");
                    endwhile;
                    wp_reset_postdata();
                endif;
            endif;

            $query = new WP_Query(array(
                "post_type" => "post",
                "posts_per_page" => $num_posts,
                'orderby' => 'date',
                'order' => 'DESC',
                "category__in" => $news,
                "post__not_in" => $sticky_posts,

            ));

            //Show non-sticky posts
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    get_template_part("template-parts/homepage/news", "post");
                endwhile;
                wp_reset_postdata();
            endif; ?>


        </div>

        <div class="view-more-button-wrapper">
            <a href="<?php echo get_category_link($news); ?>" class="the-button" title="View all Events">
                View All
            </a>
        </div>

    </div>
<?php endif; ?>