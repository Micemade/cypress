<?php
if ( ! function_exists( 'comment_function' ) ) :
function comment_function( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'cypress' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'cypress' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			
			<?php echo get_avatar( $comment, 80 );?>
			
			<section class="comment-content comment">
			
				<div class="arrow-left"></div>
				
				<header class="comment-meta comment-author vcard">
										
					<?php
						
						printf( '<cite class="fn"> %2$s %1$s, </cite>',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span class="author"> ' . __( 'Comment author', 'cypress' ) . '</span>' : ''
						);
						printf( '<a href="%1$s"><span class="icon-calendar comment-icons"></span><time datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( __( '%1$s <span class="icon-clock-2 comment-icons"></span> %2$s', 'cypress' ), get_comment_date(), get_comment_time() )
						);
					?>
				</header><!-- .comment-meta -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'cypress' ); ?></p>
				<?php endif; ?>

			
				<div class="comment-text-wrap"><?php comment_text(); ?></div>
				
				<?php edit_comment_link( __( 'Edit', 'cypress' ), '<p class="edit-link">', '</p>' ); ?>
				
				<div class="clearfix"></div>
				
			</section><!-- .comment-content -->

			<div class="reply">
			
				<?php
				$theme_args = array(
					'reply_text'	=> __( 'Reply', 'cypress' ),
					'before'		=> '<div class="button">',
					'after'			=> ' <span class="icon-arrow-down-6"></span><div>',
					'depth'			=> $depth,
					'max_depth'		=> $args['max_depth']
				);
				comment_reply_link( array_merge( $args, $theme_args ) ); ?>
				
			</div><!-- .reply -->
			
		</article><!-- #comment-## -->
		
	<?php
		break;
	endswitch; // end comment_type check
}
endif;
?>