<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

if($blog_design == 'card') { ?>
    <!-- blog card post -->
    <div class="ant-blog-post ant-card <?php echo esc_attr($this->blog_card_class) ;?>" id="<?php echo esc_attr(get_the_ID()); ?>">
        <?php
            if ($thumbnail_id) {
                echo '<div class="ant-blog-thumb md '.esc_attr($this->blog_img).'">' ;
                $image_src = \Elementor\Group_Control_Image_Size::get_attachment_image_src($thumbnail_id, $thumbnail_size_key, $params['settings']);
                echo sprintf('<img src="%s" title="%s" alt="%s"%s class="ant-link-div ant-back-img" />', esc_attr($image_src), esc_attr(get_the_title($thumbnail_id)), esc_attr(anant_get_attachment_alt($thumbnail_id)), '');
                echo '</div>' ;
            }
        ?>
        <article class="small <?php echo esc_attr($this->blog_inner) ;?>">
            <div class="ant-blog-category <?php if ($category_style == 'one') { echo'one'; } 
                elseif ($category_style == 'two') { echo'two'; } 
                elseif (($category_style != 'two') || ($category_style != 'one')) { echo 'remove' ;} ;?> 
                <?php echo esc_attr($this->blog_category) ;?>">
                    <?php
                    if ( count($params['categories']) > 0 && $show_category === 'yes') {
                        foreach($params['categories'] as $category ) {
                            $category = (array) $category; ?>
                                <a href="<?php echo esc_url(get_category_link( $category['term_id'] )) ?>"><?php echo esc_html($category['name']) ?></a>
                            <?php
                        }
                    }
                    ?>
            </div>
            <?php if( ( $show_meta === 'yes') || (( $params['comments_count'] > 0 && $show_comments === 'yes')) ) { ?>
            <div class="ant-blog-meta <?php echo esc_attr($this->blog_meta) ;?>">
                <?php
                    if( $show_meta === 'yes' ) {
                        ?>
                            <span class="ant-author">
                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta( 'ID' ))); ?>"><?php echo get_avatar(get_the_author_meta( 'ID') , 150); ?><?php the_author(); ?></a>
                            </span>
                            <span class="ant-blog-date">
                                <a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')));  ?>" class="entry-date"><i class="far fa-clock"></i>
                                    <?php
                                        the_time('F j, Y');
                                    ?>
                                </a>
                            </span>
                        <?php
                    }
                ?>
                <?php
                    if ( $params['comments_count'] > 0 && $show_comments === 'yes') {
                            $text = 'Comment';
                            if ( $params['comments_count'] > 1 ) {
                                $text = 'Comments';
                            }
                        ?>
                            <span class="ant-comments-link"> <a href="<?php comments_link(); ?>"><i class="far fa-comments"></i><?php echo esc_html(get_comments_number().' ') ?></a> </span>
                        <?php
                    }
                ?>
            </div>
            <?php
            }
            if ( $show_title === 'yes' ) {
                // title_html_tag

                    echo '<'.esc_attr($title_html_tag).' class="title '.esc_attr($this->blog_title).'">';
                    if ( $params['title_length'] > 0 ) {
                        ?>
                            <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html(wp_trim_words(get_the_title(), 10 )); ?></a>
                        <?php
                    }
                    echo '</'.esc_attr($title_html_tag).'>';
                }
            ?>

            <?php if ( $params['excerpt_length'] > 0 ) { ?>
                    <div class="discription <?php echo esc_attr($this->blog_desc) ;?>">
                        <?php echo wp_kses_post(anant_get_excerpt( $params['excerpt_length'], get_post() )); ?>
                    </div>
                    <?php
                }
            ?>
            <?php
                if( $show_read_more === 'yes' ) {
                    ?>
                        <div class="ant-more-link">
                        <a
                            class="ant_cta_btn <?php echo esc_attr($this->blog_btn) ;?> <?php echo $link_button_position === 'before' ? 'anant-no-flex': '' ?>"
                            href="<?php the_permalink(); ?>" target="_blank" >
                            <?php 
                                if ($link_button_position === 'before') {
                                    \Elementor\Icons_Manager::render_icon( $link_button_icon, [ 'aria-hidden' => 'true' ] );
                                }
                            ?>
                            <?php echo esc_html($link_text) ?>
                            <?php 
                                if ($link_button_position === 'after') {
                                    \Elementor\Icons_Manager::render_icon( $link_button_icon, [ 'aria-hidden' => 'true' ] );
                                }
                            ?>
                        </a>
                        </div>
                    <?php
                }
            ?>
        </article>
    </div>
    <!-- /blog card post -->
<?php } elseif($blog_design == 'over') { ?>
    <!-- blog Overlay post -->
    <div class="ant-blog-post ant-overlay six <?php echo esc_attr($this->blog_card_class) ;?>" id="<?php echo esc_attr(get_the_ID()); ?>">
        <?php
			$image_src = '';
			if ($thumbnail_id) {
				$image_src = \Elementor\Group_Control_Image_Size::get_attachment_image_src($thumbnail_id, $thumbnail_size_key, $params['settings']);
			}

			if ( $image_src === '' ) {
				?>
					<div class="ant-blog-post three lg ant-back-img bshre <?php echo esc_attr($this->blog_img );?>">
				<?php
			} else {
				$bg = "background-image: url(". esc_url($image_src) .");";
				?>
					<div class="ant-blog-post three lg ant-back-img bshre <?php echo esc_attr($this->blog_img );?>" style=" <?php echo esc_attr($bg) ?> ">
				<?php
			}
		?>
        <a href="<?php echo esc_url(get_permalink()); ?>" class="ant-link-div"></a>

        <article class="inner <?php echo esc_attr($this->blog_inner );?>">
            <div class="ant-blog-category <?php if ($category_style == 'one') { echo'one'; } 
                elseif ($category_style == 'two') { echo'two'; } 
                elseif (($category_style != 'two') || ($category_style != 'one')) { echo 'remove' ;} ;?> 
                <?php echo esc_attr($this->blog_category) ;?>">
                    <?php
                    if ( count($params['categories']) > 0 && $show_category === 'yes') {
                        foreach($params['categories'] as $category ) {
                            $category = (array) $category;
                            ?>
                                <a href="<?php echo esc_url(get_category_link( $category['term_id'] )) ?>"><?php echo esc_html($category['name']) ?></a>
                            <?php
                        }
                    }
                    ?>
            </div>
            <?php
                if ( $show_title === 'yes' ) {
                    // title_html_tag

                    echo '<'.esc_attr($title_html_tag).' class="title '.esc_attr($this->blog_title).'">';
                    if ( $params['title_length'] > 0 ) { ?>
                            <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html(wp_trim_words(get_the_title(), $params['title_length'], '' )); ?></a>
                        <?php
                    }
                    echo '</'.esc_attr($title_html_tag).'>';
                }
            ?>
            <div class="ant-blog-meta <?php echo esc_attr($this->blog_meta );?>">
                <?php
                    if( $show_meta === 'yes' ) {
                        ?>
                            <span class="ant-author">
                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta( 'ID' ))); ?>"><?php echo get_avatar(get_the_author_meta( 'ID') , 150); ?><?php the_author(); ?></a>
                            </span>
                            <span class="ant-blog-date">
                                <a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')));  ?>" class="entry-date"><i class="far fa-clock"></i>
                                    <?php
                                        the_time('F j, Y');
                                    ?>
                                </a>
                            </span>
                        <?php
                    }
                ?>
                <?php
                    if ( $params['comments_count'] > 0 && $show_comments === 'yes') {
                            $text = 'Comment';
                            if ( $params['comments_count'] > 1 ) {
                                $text = 'Comments';
                            }
                        ?>
                            <span class="ant-comments-link"> <a href="<?php comments_link(); ?>"><i class="far fa-comments"></i><?php echo esc_html(get_comments_number().' ') ?></a> </span>
                        <?php
                    }
                ?>
            </div>
        </article>
        </div>
    </div>
    <!-- /blog Overlay post -->
<?php }