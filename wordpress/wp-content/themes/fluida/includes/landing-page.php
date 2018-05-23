<?php
/**
 * Landing page functions
 * Used in front-page.php
 *
 * @package Fluida
 */

/**
 * slider builder
 */
if ( ! function_exists('fluida_lpslider' ) ):
function fluida_lpslider() {
	$options = cryout_get_option( array( 'fluida_lpslider', 'fluida_lpsliderimage', 'fluida_lpslidertitle', 'fluida_lpslidertext', 'fluida_lpslidershortcode', 'fluida_lpsliderserious', 'fluida_lpsliderserious', 'fluida_lpslidercta1text', 'fluida_lpslidercta1link', 'fluida_lpslidercta2text', 'fluida_lpslidercta2link' ) );
	if ( $options['fluida_lpslider'] )
		switch ( $options['fluida_lpslider'] ):
			case 1:
				if ( is_numeric($options['fluida_lpsliderimage']) ) {
					list( $image, ) = wp_get_attachment_image_src( $options['fluida_lpsliderimage'], 'full' );
				} else {
					$image = $options['fluida_lpsliderimage'];
				}
				fluida_lpslider_output( array(
					'image' => $image,
					'title' => $options['fluida_lpslidertitle'],
					'content' => $options['fluida_lpslidertext'],
					'lpslidercta1text' => $options['fluida_lpslidercta1text'],
					'lpslidercta1link' => $options['fluida_lpslidercta1link'],
					'lpslidercta2text' => $options['fluida_lpslidercta2text'],
					'lpslidercta2link' => $options['fluida_lpslidercta2link'],
				) );
			break;
			case 2:
				?> <div class="lp-dynamic-slider"> <?php
				echo do_shortcode( $options['fluida_lpslidershortcode'] );
				?> </div> <!-- lp-dynamic-slider --> <?php
			break;
			case 3:
				// header image
			break;
			case 4:
				?> <div class="lp-dynamic-slider"> <?php
					if ( ! empty( $options['fluida_lpsliderserious'] ) ) {
						echo do_shortcode( '[serious-slider id="' . $options['fluida_lpsliderserious'] . '"]' );
					}
				?> </div> <!-- lp-dynamic-slider --> <?php
			break;

			default:
			break;
		endswitch;

} //  fluida_lpslider()
endif;

/**
 * slider output
 */
if ( ! function_exists( 'fluida_lpslider_output' ) ):
function fluida_lpslider_output( $data ){

	extract($data);

	if ( empty( $image ) && empty( $title ) && empty( $content ) && empty( $lpslidercta1text ) && empty( $lpslidercta2text ) ) return; ?>

	<section class="lp-staticslider">
		<?php if ( ! empty( $image ) ) { ?>
			<img class="lp-staticslider-image" alt="<?php echo esc_attr( $title ) ?>" src="<?php echo esc_url( $image ); ?>">
		<?php } ?>
		<div class="staticslider-caption">
			<?php if ( ! empty( $title ) ) { ?> <h2 class="staticslider-caption-title"><?php echo do_shortcode( wp_kses_post( $title ) ) ?></h2><?php } ?>
			<?php if ( ! empty( $title ) && ! empty( $content ) )	{ ?><span class="staticslider-sep"></span><?php } ?>
			<?php if ( ! empty( $content ) ) { ?> <div class="staticslider-caption-text"><?php echo do_shortcode( wp_kses_post( $content ) ) ?></div><?php } ?>
			<div class="staticslider-caption-buttons">
				<?php if ( ! empty( $lpslidercta1text ) ) { echo '<a class="staticslider-button" href="' . esc_url( $lpslidercta1link ) . '">' . esc_html( $lpslidercta1text ) . '</a>'; } ?>
				<?php if ( ! empty( $lpslidercta2text ) ) { echo '<a class="staticslider-button" href="' . esc_url( $lpslidercta2link ) . '">' . esc_html( $lpslidercta2text ) . '</a>'; } ?>
			</div>
		</div>
	</section><!-- .lp-staticslider -->

<?php
} // fluida_lpslider_output()
endif;


/**
 * blocks builder
 */
if ( ! function_exists( 'fluida_lpblocks' ) ):
function fluida_lpblocks( $sid = 1 ) {
	$maintitle = cryout_get_option('fluida_lpblockmaintitle'.$sid);
	$maindesc = cryout_get_option('fluida_lpblockmaindesc'.$sid);
	$pageids = cryout_get_option( apply_filters('fluida_blocks_ids', array( 'fluida_lpblockone'.$sid, 'fluida_lpblocktwo'.$sid, 'fluida_lpblockthree'.$sid, 'fluida_lpblockfour'.$sid), $sid ) );
	$icon = cryout_get_option( apply_filters('fluida_blocks_icons', array( 'fluida_lpblockoneicon'.$sid, 'fluida_lpblocktwoicon'.$sid, 'fluida_lpblockthreeicon'.$sid, 'fluida_lpblockfouricon'.$sid ), $sid ) );
	$blockscontent = cryout_get_option( 'fluida_lpblockscontent'.$sid );
	$blocksclick = cryout_get_option( 'fluida_lpblocksclick'.$sid );
	$blocksreadmore = cryout_get_option( 'fluida_lpblocksreadmore'.$sid );
	$count = 1;
	$pagecount = count( array_filter( $pageids ) );
	if ( empty( $pagecount ) ) return;
	?>
	<section  id="lp-blocks<?php echo $sid ?>" class="lp-blocks lp-blocks<?php echo $sid ?> lp-blocks-rows-<?php echo apply_filters('fluida_blocks_perrow', $pagecount, $sid) ?>">
		<?php if(  ! empty( $maintitle ) || ! empty( $maindesc ) ) { ?>
			<div class="lp-section-header">
				<?php if( ! empty( $maintitle ) ) { ?><h2 class="lp-section-title"> <?php echo do_shortcode( wp_kses_post( $maintitle ) ); ?></h2><?php } ?>
				<?php if( ! empty( $maindesc ) ) { ?><div class="lp-section-desc"> <?php echo do_shortcode( wp_kses_post( $maindesc ) ); ?></div><?php } ?>
			</div>
		<?php } ?>
		<div class="lp-blocks-inside">
			<?php foreach ( $pageids as $key => $pageid ) {
				$pageid = cryout_localize_id( $pageid );
				if ( intval($pageid) > 0 ) {
					$page = get_post( $pageid );

					switch ( $blockscontent ) {
						case '0': $text = ''; break;
						case '2': $text = apply_filters( 'the_content', get_post_field( 'post_content', $pageid ) ); break;
						case '1': default: if (has_excerpt( $pageid )) $text = get_the_excerpt( $pageid ); else $text = fluida_custom_excerpt( $page->post_content ); break;
					};

					$iconid = preg_replace('/(\d)$/','icon$1', $key);

					$data[$count] = array(
						'title' => apply_filters('fluida_block_title', get_the_title( $pageid ), $pageid ),
						'text'	=> $text,
						'icon'	=> ( ( $icon[$iconid] != 'no-icon' ) ? $icon[$iconid] : '' ),
						'link'	=> apply_filters( 'fluida_block_url', get_permalink( $pageid ), $pageid ),
						'target' => apply_filters( 'fluida_block_target', '', $pageid ),
						'click'	=> $blocksclick,
						'id' 	=> $count,
						'readmore' => $blocksreadmore,
					);
					fluida_lpblock_output( $data[$count] );
					$count++;
				}
			} ?>
		</div>
	</section>
<?php
wp_reset_postdata();
} //fluida_lpblocks()
endif;

/**
 * blocks output
 */
if ( ! function_exists( 'fluida_lpblock_output' ) ):
function fluida_lpblock_output( $data ) { ?>
	<?php extract($data) ?>
			<div class="lp-block block<?php echo absint( $id ); ?>">
				<?php if ( $click ) { ?><a href="<?php echo esc_url( $link ); ?>" aria-label="<?php echo esc_attr( $title ); ?>"<?php echo $target ?>><?php } ?>
					<?php if ( ! empty ( $icon ) )	{ ?> <i class="blicon-<?php echo esc_attr( $icon ); ?>"></i><?php } ?>
				<?php if ( $click ) { ?></a> <?php } ?>
					<div class="lp-block-content">
						<?php if ( ! empty ( $title ) ) { ?><h5 class="lp-block-title"><?php echo do_shortcode( $title ); ?></h5><?php } ?>
						<?php if ( ! empty ( $text ) ) { ?><div class="lp-block-text"><?php echo do_shortcode( $text ) ;?></div><?php } ?>
						<?php if ( ! empty ( $readmore ) ) { ?><a class="lp-block-readmore" href="<?php echo esc_url( $link ); ?>" <?php echo esc_attr( $target ); ?>> <?php echo do_shortcode( wp_kses_post( $readmore ) ); ?> <em class="screen-reader-text">"<?php echo esc_attr( $title ) ?>"</em> </a><?php } ?>
					</div>
			</div><!-- lp-block -->
	<?php
} // fluida_lpblock_output()
endif;


/**
 * boxes builder
 */
if ( ! function_exists( 'fluida_lpboxes' ) ):
function fluida_lpboxes( $sid = 1 ) {
	$options = cryout_get_option(
				array(
					 'fluida_lpboxmaintitle' . $sid,
					 'fluida_lpboxmaindesc' . $sid,
					 'fluida_lpboxcat' . $sid,
					 'fluida_lpboxrow' . $sid,
					 'fluida_lpboxcount' . $sid,
					 'fluida_lpboxlayout' . $sid,
					 'fluida_lpboxmargins' . $sid,
					 'fluida_lpboxanimation' . $sid,
					 'fluida_lpboxreadmore' . $sid,
					 'fluida_lpboxlength' . $sid,
				 )
			 );

	if ( ( $options['fluida_lpboxcount' . $sid] <= 0 ) || ( $options['fluida_lpboxcat' . $sid] == '-1' ) ) return;

 	$box_counter = 1;
	$animated_class = "";
	if ( $options['fluida_lpboxanimation' . $sid] == 1 ) $animated_class = 'lp-boxes-animated';
	if ( $options['fluida_lpboxanimation' . $sid] == 2 ) $animated_class = 'lp-boxes-static';
	if ( $options['fluida_lpboxanimation' . $sid] == 3 ) $animated_class = 'lp-boxes-animated lp-boxes-animated2';
	if ( $options['fluida_lpboxanimation' . $sid] == 4 ) $animated_class = 'lp-boxes-static lp-boxes-static2';

    $custom_query = new WP_query();
    if ( ! empty( $options['fluida_lpboxcat' . $sid] ) ) $cat = $options['fluida_lpboxcat' . $sid]; else $cat = '';

	$args = apply_filters( 'fluida_boxes_query_args', array(
		'showposts' => $options['fluida_lpboxcount' . $sid],
		'cat' => cryout_localize_cat( $cat ),
		'ignore_sticky_posts' => 1,
		'lang' => cryout_localize_code()
	), $options['fluida_lpboxcat' . $sid], $sid );

    $custom_query->query( $args );

    if ( $custom_query->have_posts() ) : ?>
		<section id="lp-boxes-<?php echo absint( $sid ) ?>" class="lp-boxes lp-boxes-<?php echo absint( $sid ) ?> <?php  echo esc_attr( $animated_class ) ?> lp-boxes-rows-<?php echo absint( $options['fluida_lpboxrow' . $sid] ); ?>">
			<?php if( $options['fluida_lpboxmaintitle' . $sid] || $options['fluida_lpboxmaindesc' . $sid] ) { ?>
				<div class="lp-section-header">
					<?php if ( ! empty( $options['fluida_lpboxmaintitle' . $sid] ) ) { ?> <h2 class="lp-section-title"> <?php  echo do_shortcode( wp_kses_post( $options['fluida_lpboxmaintitle' . $sid] ) ); ?></h2><?php } ?>
					<?php if ( ! empty( $options['fluida_lpboxmaindesc' . $sid] ) ) { ?><div class="lp-section-desc"> <?php echo do_shortcode( wp_kses_post( $options['fluida_lpboxmaindesc' . $sid] ) ); ?></div><?php } ?>
				</div>
			<?php } ?>
			<div class="<?php if ( $options['fluida_lpboxlayout' . $sid] == 2 ) { echo 'lp-boxes-inside'; }?>
						<?php if ( $options['fluida_lpboxmargins' . $sid] == 2 ) { echo 'lp-boxes-margins'; }?>
						<?php if ( $options['fluida_lpboxmargins' . $sid] != 2 &&  $options['fluida_lpboxmargins' . $sid] != 2 ) { echo 'lp-boxes-padding'; }?>">
    		<?php while ( $custom_query->have_posts() ) :
	            $custom_query->the_post();
				if ( has_excerpt() ) {
					$excerpt = fluida_custom_excerpt( get_the_excerpt(), $options['fluida_lpboxlength' . $sid] );
				} else {
					$excerpt = fluida_custom_excerpt( get_the_content(), $options['fluida_lpboxlength' . $sid] );
				};
	            $box = array();
	            $box['colno'] = $box_counter++;
	            $box['counter'] = $options['fluida_lpboxcount' . $sid];
	            $box['title'] = apply_filters('fluida_box_title', get_the_title(), get_the_ID() );
	            $box['content'] = $excerpt;
	            list( $box['image'], ) = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'fluida-lpbox-' . $sid );
	            $box['link'] = apply_filters( 'fluida_box_url', get_permalink(), get_the_ID() );
				$box['readmore'] = do_shortcode( wp_kses_post( $options['fluida_lpboxreadmore' . $sid] ) );
	            $box['target'] = apply_filters( 'fluida_box_target', '', get_the_ID() );
				$box['image'] = apply_filters('fluida_preview_img_src', $box['image']);

            fluida_lpbox_output( $box );
        endwhile; ?>
			</div>
		</section><!-- .lp-boxes -->
<?php endif;
wp_reset_postdata();
} //  fluida_lpboxes()
endif;

/**
 * boxes output
 */
if ( ! function_exists( 'fluida_lpbox_output' ) ):
function fluida_lpbox_output( $data ) {
	$randomness = array ( 6, 8, 1, 5, 2, 7, 3, 4 );
	extract($data); ?>
			<div class="lp-box box<?php echo absint( $colno ); ?> ">
					<div class="lp-box-image lpbox-rnd<?php echo $randomness[$colno%8]; ?>">
						<?php if( ! empty( $image ) ) { ?><img alt="<?php echo esc_attr( $title ); ?>" src="<?php echo esc_url( $image ); ?>" /> <?php } ?>
						<a class="lp-box-link" <?php if ( !empty( $link ) ) { ?> href="<?php echo esc_url( $link ); ?>" aria-label="<?php echo esc_attr( $title ); ?>" <?php echo esc_attr( $target ); ?><?php } ?>> <i class="blicon-plus2"></i> </a>
						<div class="lp-box-overlay"></div>
					</div>
					<div class="lp-box-content">
						<?php if ( ! empty( $title ) ) { ?><h5 class="lp-box-title">
							<?php if ( !empty( $readmore ) && !empty( $link ) ) { ?> <a href="<?php echo esc_url( $link ); ?>" <?php echo esc_attr( $target ); ?>><?php } ?>
								<?php echo do_shortcode( $title ); ?>
							<?php if ( !empty( $readmore ) && !empty( $link ) ) { ?> </a> <?php } ?>
						</h5><?php } ?>
						<div class="lp-box-text">
							<?php if ( ! empty( $content ) ) { ?>
								<div class="lp-box-text-inside"> <?php echo do_shortcode( $content ); ?> </div>
							<?php } ?>
							<?php if( ! empty( $readmore ) ) { ?>
								<a class="lp-box-readmore" href="<?php if( ! empty( $link ) ) { echo esc_url( $link ); } ?>" <?php echo esc_attr( $target ); ?>> <?php echo do_shortcode( wp_kses_post( $readmore ) ); ?> <em class="screen-reader-text">"<?php echo esc_attr( $title ) ?>"</em> <i class="icon-angle-right"></i></a>
							<?php } ?>
						</div>
					</div>
			</div><!-- lp-box -->
	<?php
} // fluida_lpbox_output()
endif;


/**
 * text area builder
 */
if ( ! function_exists( 'fluida_lptext' ) ):
function fluida_lptext( $what = 'one' ) {
	$pageid = cryout_get_option( 'fluida_lptext' . $what );
	$pageid = cryout_localize_id( $pageid );
	if ( intval($pageid) > 0 ) {
		$page = get_post( $pageid );
		$data = array(
			'title' => apply_filters( 'fluida_text_title', get_the_title( $pageid ), $pageid ),
			'text'	=> apply_filters( 'the_content', get_post_field( 'post_content', $pageid ) ),
			'class' => apply_filters( 'fluida_text_class', '', $pageid ),
			'id' 	=> $what,
		);
		list( $data['image'], ) = wp_get_attachment_image_src( get_post_thumbnail_id( $pageid ), 'full' );
		fluida_lptext_output( $data );
	}
} // fluida_lptext()
endif;

/**
 * text area output
 */
if ( ! function_exists( 'fluida_lptext_output' ) ):
function fluida_lptext_output( $data ){ ?>
	<section class="lp-text <?php echo $data['class'] ?>" id="lp-text-<?php echo esc_attr( $data['id'] ); ?>"<?php if( ! empty( $data['image'] ) ) { ?> style="background-image: url( <?php echo esc_url( $data['image'] ); ?>);" <?php } ?> >
		<?php if( ! empty( $data['image'] ) ) { ?><div class="lp-text-overlay"></div><?php } ?>
			<div class="lp-text-inside">
				<?php if( ! empty( $data['title'] ) ) { ?><h2 class="lp-text-title"><?php echo do_shortcode( $data['title'] ) ?></h2><?php } ?>
				<?php if( ! empty( $data['text'] ) ) { ?><div class="lp-text-content"><?php echo do_shortcode(  $data['text'] ) ?></div><?php } ?>
			</div>

	</section><!-- .lp-text-<?php echo esc_attr( $data['id'] ); ?> -->
<?php
} // fluida_lptext_output()
endif;

/**
 * page or posts output, also used when landing page is disabled
 */
if ( ! function_exists( 'fluida_lpindex' ) ):
function fluida_lpindex() {

	$fluida_lpposts = cryout_get_option( 'fluida_lpposts' );

	switch ($fluida_lpposts) {

		case 2: // static page

			if ( have_posts() ) :
					?><section id="lp-page"> <div class="lp-page-inside"><?php
					get_template_part( 'content/content', 'page' );
					?></div> </section><!-- #lp-page --><?php
			endif;

		break;

		case 1: // posts

			if ( get_query_var('paged') ) $paged = get_query_var('paged');
			elseif ( get_query_var('page') ) $paged = get_query_var('page');
			else $paged = 1;
			$custom_query = new WP_query( array('posts_per_page'=>get_option('posts_per_page'),'paged'=>$paged) );

			if ( $custom_query->have_posts() ) :  ?>
				<section id="lp-posts"> <div class="lp-posts-inside">
				<div id="content-masonry" class="content-masonry" <?php cryout_schema_microdata( 'blog' ); ?>> <?php
					while ( $custom_query->have_posts() ) : $custom_query->the_post();
						get_template_part( 'content/content', get_post_format() );
					endwhile; ?>
				</div> <!-- content-masonry -->
				</div> </section><!-- #lp-posts -->
				<?php fluida_pagination();
				wp_reset_postdata();
			else :
				get_template_part( 'content/content', 'notfound' );
			endif;

		break;
		case 0: // disabled
		default: break;
	}

} // fluida_lpindex()
endif;

// FIN
