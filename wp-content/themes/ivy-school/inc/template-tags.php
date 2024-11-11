<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 */

/**
 * author meta
 *
 * @return void
 */
function thim_entry_meta_author() {
	echo thim_get_entry_meta_author();
}

/**
 * Get author meta
 *
 * @return string
 */
function thim_get_entry_meta_author() {
	$html = '<span class="author vcard">';
	$html .=  sprintf('<i class="ion-android-person" aria-hidden="true"></i>')  . esc_html__( ' By ', 'ivy-school' ) . sprintf( '<a href="%1$s" rel="author"> %2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ) ) . '';
	$html .= '</span>';

	return $html;
}



/**
 * date meta
 *
 * @return void
 */
function thim_entry_meta_date() {
	echo thim_get_entry_meta_date();
}


/**
 * Get date meta
 *
 * @return string
 */
function thim_get_entry_meta_date() {
    $html = '<div class="entry-date date-meta">' . get_the_date('d') . '<span>' . get_the_date('M, Y') . '</span></div>';

    return $html;
}


/**
 * Get category meta
 *
 * @return void
 */
function thim_entry_meta_category() {
	echo thim_get_entry_meta_category();
}

/**
 * Get category meta
 *
 * @return string
 */
function thim_get_entry_meta_category( $limit = '-1' ) {
    $html       = '<span class="meta-category"><i class="ion-ios-pricetags-outline" aria-hidden="true"></i> ';
    $categories = get_the_category();
    if ( ! empty( $categories ) ) {
        if ( $limit == '-1' ) {
            foreach ( $categories as $cat ) {
                $html .= '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a><span>,</span>';
            }
        } else {
            foreach ( $categories as $key => $cat ) {
                if ( $key == $limit ) {
                    break;
                }
                $html .= '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '"> <i class="ion-ios-pricetags-outline" aria-hidden="true"></i> ' . esc_html( $cat->name ) . '</a> ';
            }
        }
    }
    $html .= '</span>';

    return $html;
}

/**
 * Get tags meta
 *
 * @return void
 */
function thim_entry_meta_tags() {
	echo thim_get_entry_meta_tags();
}


/**
 * Get tags meta
 *
 * @return string
 */
function thim_get_entry_meta_tags() {
	$tags_list = get_the_tag_list( '', ' ' );
	if ( $tags_list ) {
		return sprintf( '<p class="tags-links"><span>' . esc_html__( 'Tags:', 'ivy-school' ) . '</span>' . esc_html__('%1$s', 'ivy-school').'</p>', $tags_list ); // WPCS: XSS OK.
	}

	return '';
}

/**
 * comment number
 *
 * @return void
 */
function thim_entry_meta_comment_number() {
	if ( comments_open() ) { ?>
		<span class="comment-total">
            <i class="ion-android-chat" aria-hidden="true"></i>
            <?php comments_popup_link( __('No Comment', 'ivy-school'), __('1 Comment','ivy-school'), __('% Comments','ivy-school'), 'comments-link', __('Comments are off for this post','ivy-school' )); ?>
		</span>
		<?php
	}
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @return string HTML for meta tags
 */
if ( ! function_exists( 'thim_entry_meta' ) ) :
	function thim_entry_meta() {
		echo '<div class="entry-meta">';

		if ( get_theme_mod( 'show_author_meta_tags', true ) ) :
			echo thim_get_entry_meta_author();
		endif;

        if ( get_theme_mod( 'show_category_meta_tags', true ) ) :
            echo thim_get_entry_meta_category();
        endif;

		if ( get_theme_mod( 'show_comment_meta_tags', true ) ) :
			thim_entry_meta_comment_number();
		endif;


		echo '</div>';
	}
endif;

/**
 * Get social share
 *
 * @return string
 */
if ( ! function_exists( 'thim_social_share' ) ) {
    function thim_social_share( $prefix = 'blog_single_' ) {
        $socials = get_theme_mod( $prefix . 'group_sharing' );

        if ( $socials ) {
            $html = '<div class="share-click title">' . esc_html__( 'Share', 'ivy-school' ) . '</div>';
//            $html .= '<ul class="links">';
            foreach ( $socials as $key => $social ) {
                $html .= thim_render_social_share_link( $social );
            }
//            $html .= '</ul>';

            echo ent2ncr( $html );
        }

    }
}

add_action( 'thim_social_share', 'thim_social_share' );

/**
 * Render social share
 *
 * @param $social_name
 *
 * @return string
 */
function thim_render_social_share_link( $social_name ) {  
    switch ( $social_name ) {
        case 'facebook':
            return '<li><a class="icon-social facebook" title="' . esc_html__( 'Facebook', 'ivy-school' ) . '" href="http://www.facebook.com/sharer/sharer.php?u=' . urlencode( get_permalink() ) . '" rel="nofollow" onclick="window.open(this.href,this.title,\'width=600,height=600,top=200px,left=200px\');  return false;" target="_blank"><i class="ion-social-facebook"></i></a></li>';
            break;

        case 'twitter':
            return '<li><a class="icon-social twitter" title="' . esc_html__( 'Twitter', 'ivy-school' ) . '" href="https://twitter.com/intent/tweet?url=' . urlencode( get_permalink() ) . '&amp;text=' . esc_attr( urlencode( get_the_title() ) ) . '" rel="nofollow" onclick="window.open(this.href,this.title,\'width=600,height=600,top=200px,left=200px\');  return false;" target="_blank"><i class="fa-x-twitter"></i></a></li>';
            break;

        case 'pinterest':
            global $post;
            $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );

            return '<li><a class="icon-social pinterest" title="' . esc_html__( 'Pinterest', 'ivy-school' ) . '" href="http://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;media=' . ( ! empty( $src[0] ) ? $src[0] : '' ) . '&description=' . esc_attr( urlencode( get_the_title() ) ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="ion-social-pinterest" aria-hidden="true"></i></a></li>';
            break;


        case 'google':
            return '<li><a target="_blank" title="' . esc_html__( 'Google', 'ivy-school' ) . '" class="icon-social google" href="https://plus.google.com/share?url=' . urlencode( get_permalink() ) . '&amp;title=' . rawurlencode( esc_attr( get_the_title() ) ) . '" title="' . esc_attr__( 'Google Plus', 'ivy-school' ) . '" onclick=\'javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;\'><i class="fa fa-google"></i></a></li>';
            break;

        default:
            return '';
            break;
    }
}


/**
 * Get pagination
 *
 * @return string
 */

if ( ! function_exists( 'thim_paging_nav' ) ) :

	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function thim_paging_nav() {
		global $wp_rewrite;
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = esc_url( remove_query_arg( array_keys( $query_args ), $pagenum_link ) );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
		// Set up paginated links.
		$links = paginate_links( array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $GLOBALS['wp_query']->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 2,
			'add_args'  => array_map( 'urlencode', $query_args ),
            'prev_text' => '<i class="fa fa-angle-left"></i>',
            'next_text' => '<i class="fal fa-chevron-right"></i>',
			'type'      => 'array'
		) );

		if ( $links ) : ?>
			<ul class="loop-pagination">
				<?php foreach ( $links as $link ) {
					echo '<li>' . $link . '</li>';
				} ?>
			</ul><!-- .pagination -->
		<?php endif;
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function thim_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'thim_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'thim_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so thim_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so thim_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in thim_categorized_blog.
 *
 * @return bool
 */
if ( ! function_exists( 'thim_category_transient_flusher' ) ) {
	function thim_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'thim_categories' );
	}
}
add_action( 'edit_category', 'thim_category_transient_flusher' );
add_action( 'save_post', 'thim_category_transient_flusher' );

/**
 * Change default comment fields
 *
 * @param $fields
 *
 * @return string
 */
if ( ! function_exists( 'thim_new_comment_fields' ) ) {
	function thim_new_comment_fields( $fields ) {
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = ( $req ? 'aria-required=true' : '' );

		$fields = array(
			'author' => '<p class="comment-form-author">' . '<input placeholder="' . esc_attr__( 'Name', 'ivy-school' ) . ( $req ? ' *' : '' ) . '" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" ' . $aria_req . ' /></p>',
			'email'  => '<p class="comment-form-email">' . '<input placeholder="' . esc_attr__( 'Email', 'ivy-school' ) . ( $req ? ' *' : '' ) . '" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" ' . $aria_req . ' /></p>',
			'url'    => '<p class="comment-form-url">' . '<input placeholder="' . esc_attr__( 'Website', 'ivy-school' ) . '" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
		);

		return $fields;
	}
}
add_filter( 'comment_form_default_fields', 'thim_new_comment_fields' );

/**
 * Show list comments
 *
 * @return string
 */
if ( ! function_exists( 'thim_comment' ) ) {
	function thim_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		if ( 'div' == $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo ent2ncr( $tag );
		echo ' '; ?><?php comment_class( 'description_comment' ) ?> id="comment-<?php comment_ID() ?>">
		<?php
		if ( $args['avatar_size'] != 0 ) {
			echo get_avatar( $comment, 70 );
		} ?>
		<div class="content-comment">
			<div class="author">
				<?php printf( '<span class="author-name">%s</span>', get_comment_author_link() ) ?>
				<span class="comment-extra-info">
					<?php
					printf( get_comment_date() );
					echo esc_html__( ' at ', 'ivy-school' );
					printf( get_comment_time() ) ?>
				</span>
				<span class="link-reply-edit">
					<?php comment_reply_link( array_merge( $args, array(
						'add_below' => $add_below,
						'depth'     => $depth,
						'max_depth' => $args['max_depth']
					) ) ) ?>
					<?php edit_comment_link( esc_html__( 'Edit', 'ivy-school' ), '', '' ); ?>
				</span>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e(  'Your comment is awaiting moderation.', 'ivy-school' ) ?></em>
			<?php endif; ?>
			<div class="message">
				<?php comment_text() ?>
			</div>
		</div>
		<div class="clear"></div>
		<?php
	}
}

/**
 *
 * Excerpt Length
 * @return string
 */
function thim_excerpt_length() {
	$thim_options = get_theme_mods();

	if ( isset( $thim_options['excerpt_archive_content'] ) ) {
		$length = get_theme_mod( 'excerpt_archive_content' );
	} else {
		$length = '50';
	}

	return $length;
}

add_filter( 'excerpt_length', 'thim_excerpt_length', 99999 );

/**
 * Change excerpt more
 * @return string
 */
function thim_excerpt_more() {
	return '...';
}

add_filter( 'excerpt_more', 'thim_excerpt_more' );

/**
 * Get related posts
 *
 * @return WP_Query
 */
function thim_get_related_posts() {
	global $post;
	$number_posts  = (int) get_theme_mod( 'blog_single_related_post_number', 3 );
	$tags          = wp_get_post_tags( $post->ID );
	$related_query = new WP_Query();

	if ( isset( $tags[0] ) ) {
		$first_tag = $tags[0]->term_id;

		$related_args  = array(
			'tag__in'             => array( $first_tag ),
			'post__not_in'        => array( $post->ID ),
			'posts_per_page'      => $number_posts,
			'ignore_sticky_posts' => 1
		);
		$related_query = new WP_Query( $related_args );
	}

	return $related_query;
}

function thim_excerpt( $limit, $post_id = null ) {
    global $post;
    if ( $post_id ) {
        $post = get_post( $post_id );
    }

    $excerpt = '';
    if ( $limit > 0 ) {

        if ( $post->post_excerpt ) {
            $excerpt = explode( ' ', $post->post_excerpt, $limit );
        } else {
            if ( strpos( $post->post_content, '<!--more-->' ) ) {
                $get_extended = get_extended( $post->post_content );
                $excerpt      = strip_shortcodes( strip_tags( $get_extended['main'] ) );
                $excerpt      = htmlentities( $excerpt, null, 'utf-8' );
                $excerpt      = str_replace( "&amp;nbsp;", "", $excerpt );
            } else {
                $excerpt = '';
            }
            $excerpt = explode( ' ', $excerpt, $limit );
        }

        if ( count( $excerpt ) >= $limit ) {
            array_pop( $excerpt );
            $excerpt = implode( " ", $excerpt ) . '...';
        } else {
            $excerpt = implode( " ", $excerpt );
        }
        $excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

    } else if ( $limit < 0 ) {
        if ( $post->post_excerpt ) {
            $excerpt = $post->post_excerpt;
        } else {
            if ( strpos( $post->post_content, '<!--more-->' ) ) {
                $get_extended = get_extended( $post->post_content );
                $excerpt      = strip_shortcodes( strip_tags( $get_extended['main'] ) );
                $excerpt      = htmlentities( $excerpt, null, 'utf-8' );
                $excerpt      = str_replace( "&amp;nbsp;", "", $excerpt );
            } else {
                $excerpt = '';
            }
        }
    }

    return trim( $excerpt );
}
/**
 * Get related columns class
 *
 * @param string $class
 *
 * @return string
 */
function thim_get_related_columns_class( $class = '' ) {
	return $class . ' col-md-' . ( 12 / get_theme_mod( 'blog_single_related_post_column', 3 ) );
}

/**
 * Get group chat content for post format chat
 *
 * @todo Should move function thim_meta to theme.
 *
 * @return string
 */
function thim_get_list_group_chat() {
	$group_chat = thim_meta( 'thim_group_chat' );
	foreach ( $group_chat as $key => $value ) {
		echo '<ul class="group-chat"><li>';
		echo '<span class="chat-name">' . esc_attr( $value['thim_chat_name'] ) . ':</span><span class="chat-message">' . esc_attr( $value['thim_chat_content'] ) . '</span>';
		echo '</li></ul>';
	}
}

/**
 * Get archive title
 *
 * Display the archive title based on the queried object.
 *
 * @return string
 */
if ( ! function_exists( 'thim_archive_title' ) ) :
	function thim_archive_title( $before = '', $after = '' ) {
		if ( is_category() ) {
			$title = sprintf( esc_html__( '%s', 'ivy-school' ), single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			$title = sprintf( esc_html__( '%s', 'ivy-school' ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			$title = sprintf( esc_html__( '%s', 'ivy-school' ), '<span class="vcard">' . get_the_author() . '</span>' );
		} elseif ( is_year() ) {
			$title = sprintf( esc_html__( 'Year: %s', 'ivy-school' ), get_the_date( _x( 'Y', 'yearly archives date format', 'ivy-school' ) ) );
		} elseif ( is_month() ) {
			$title = sprintf( esc_html__( 'Month: %s', 'ivy-school' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'ivy-school' ) ) );
		} elseif ( is_day() ) {
			$title = sprintf( esc_html__( 'Day: %s', 'ivy-school' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'ivy-school' ) ) );
		} elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'ivy-school' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'ivy-school' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'ivy-school' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'ivy-school' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'ivy-school' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'ivy-school' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'ivy-school' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'ivy-school' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'ivy-school' );
		} elseif ( is_post_type_archive() ) {
			$title = sprintf( esc_html__( '%s', 'ivy-school' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( esc_html__( '%1$s: %2$s', 'ivy-school' ), $tax->labels->singular_name, single_term_title( '', false ) );
		} elseif ( is_404() ) {
			$title = esc_html__( '404 Page', 'ivy-school' );
		} elseif ( is_search() ) {
			$title = esc_html__( 'Search Results Page', 'ivy-school' );
		} else {
			$title = esc_html__( 'Archives', 'ivy-school' );
		}
		/**
		 * Filter the archive title.
		 *
		 * @param string $title Archive title to be displayed.
		 */
		if ( ! empty( $title ) ) {
			echo ent2ncr( $before . $title . $after );
		}
	}
endif;

/* function add create field author */
add_filter( 'user_contactmethods', 'thim_add_author_googleplus' );
function thim_add_author_googleplus($fields){
    $fields['googleplus'] = esc_html__( 'Google plus', 'ivy-school');
    return $fields;
}


/**
 * Get author social link
 *
 * @return string
 */
function thim_get_author_social_link() {
	$user = new WP_User( get_the_author_meta( 'ID' ) );

	$link_facebook  = get_the_author_meta( 'facebook' );
	$link_twitter   = get_the_author_meta( 'twitter' );
	$link_skype     = get_the_author_meta( 'skype' );
	$link_pinterest = get_the_author_meta( 'pinterest' );
    $link_googleplus = get_the_author_meta( 'googleplus' );
	?>

	<ul class="thim-author-social">
		<?php if ( ! empty( $link_facebook ) ) { ?>
			<li>
				<a href="<?php echo esc_url( $link_facebook ); ?>" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
			</li>
		<?php } ?>

		<?php if ( ! empty( $link_twitter ) ) { ?>
			<li>
				<a href="<?php echo esc_url( $link_twitter ); ?>" target="_blank" class="twitter"><i class="fa fa-x-twitter"></i></a>
			</li>
		<?php } ?>

		<?php if ( ! empty( $link_skype ) ) { ?>
			<li>
				<a href="<?php echo esc_url( $link_skype ); ?>" target="_blank" class="skype"><i class="fa fa-skype"></i></a>
			</li>
		<?php } ?>

		<?php if ( ! empty( $link_pinterest ) ) { ?>
			<li>
				<a href="<?php echo esc_url( $link_pinterest ); ?>" target="_blank" class="pinterest"><i class="fa fa-pinterest"></i></a>
			</li>
		<?php } ?>

        <?php if ( ! empty( $link_googleplus ) ) { ?>
            <li>
                <a href="<?php echo esc_url( $link_googleplus ); ?>" target="_blank" class="googleplus"><i class="ion ion-social-googleplus"></i></a>
            </li>
        <?php } ?>
	</ul>
<?php }


/**
 * Get about the author
 *
 * @return string
 */
if ( ! function_exists( 'thim_about_author' ) ) {
	function thim_about_author() {
		$user = new WP_User( get_the_author_meta( 'ID' ) );
		$link = get_author_posts_url( get_the_author_meta( 'ID' ) );
		if(get_the_author_meta( 'description' )) {
		?>
		<div class="thim-about-author">
			<div class="author-wrapper">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 147 ); ?>
                    <?php echo thim_get_author_social_link(); ?>
				</div>
				<div class="author-bio">
                    <div class="author-top">
                        <a class="name" href="<?php echo esc_url( $link ); ?>"> <?php echo get_the_author(); ?> </a>
                        <?php if ( ! empty( $user->roles ) ) {
                            echo '<div class="role">' . esc_html( $user->roles[0] ) . '</div>';
                        } ?>
                    </div>
					<div class="author-description">
						<?php echo get_the_author_meta( 'description' ); ?>
					</div>

				</div>
			</div>
		</div>
	<?php } }
}

add_action( 'thim_about_author', 'thim_about_author' );

/**
 * Add field to user profile
 *
 * @param $contactmethods
 *
 * @todo escape text
 *
 * @return mixed
 */
function thim_modify_contact_methods( $contactmethods ) {

	//Add Facebook
	$contactmethods['facebook'] = 'Facebook';
	// Add Twitter
	$contactmethods['twitter'] = 'Twitter';
	// Add Twitter
	$contactmethods['skype'] = 'Skype';
	//Add Facebook
	$contactmethods['pinterest'] = 'Pinterest';

	return $contactmethods;
}

add_filter( 'user_contactmethods', 'thim_modify_contact_methods' );

/**
 * Move field comment bellow input fields
 *
 * @param $fields
 *
 * @return mixed
 */
function thim_move_comment_field_to_bottom( $fields ) {

	$comment_field = $fields['comment'];

	unset( $fields['comment'] );

	$fields['comment'] = $comment_field;

	return $fields;
}

add_filter( 'comment_form_fields', 'thim_move_comment_field_to_bottom' );

/*
 *
 *Add placeholder for Name and Email
 *
*/
function thim_modify_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    $req       = get_option( 'require_name_email' );
    $aria_req  = ( $req ? " aria-required='true'" : '' );

    $fields['author'] = '<div class="comment-meta"><div class="row"><div class="col-md-6"><p class="comment-form-author">' .
        '<input placeholder="' . esc_attr__( 'Your Name *', 'ivy-school' ) . '" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
        '" size="30"' . $aria_req . ' /></p></div>';
    $fields['email']  = '<div class="col-md-6"><p class="comment-form-email">' .
        '<input placeholder="' . esc_attr__( 'Email *', 'ivy-school' ) . '" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .
        '" size="30"' . $aria_req . ' /></p></div></div></div>';
    $fields['url']    = '';


    return $fields;
}

add_filter( 'comment_form_default_fields', 'thim_modify_comment_form_fields' );
