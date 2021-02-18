<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div>
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php wp_bootstrap_starter_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->
	<div class="entry-content property_type">
		<!-- let's show custom fields -->
		<?php if( get_field('property_image') ){ ?>
			<div class="row">
				<div class="col-sm-12 col-12">
					<img class="option_image" src="<?php echo get_field("property_image")["url"] ?>" alt="">
				</div>
			</div>
		<?php } ?>
		<?php if( get_field('property_title') ){ ?>
			<div class="row">
				<div class="col-sm-6 col-12 option_title">Название дома:</div>
				<div class="col-sm-6 col-12 option_value"><?php the_field("property_title") ?></div>
			</div>
		<?php } ?>

		<?php if( get_field('property_coordinates') ){ ?>
			<div class="row">
				<div class="col-sm-6 col-12 option_title">Координаты местонахождения:</div>
				<div class="col-sm-6 col-12 option_value"><?php the_field("property_coordinates") ?> <span> <a target="_blank" href="https://www.google.com/maps/search/?api=1&query=<?php the_field('property_coordinates') ?>">Google map</a></span></div>
			</div>
		<?php } ?>

		<?php if( get_field('property_floors') ){ ?>
			<div class="row">
				<div class="col-sm-6 col-12 option_title">Количество этажей:</div>
				<div class="col-sm-6 col-12 option_value"><?php the_field("property_floors") ?></div>
			</div>
		<?php } ?>

		<?php if( get_field('prioperty_type') ){ ?>
			<div class="row">
				<div class="col-sm-6 col-12 option_title">Тип строения:</div>
				<div class="col-sm-6 col-12 option_value"><?php the_field("prioperty_type") ?></div>
			</div>
		<?php } ?>

		<?php if( get_field('prioperty_eko') ){ ?>
			<div class="row">
				<div class="col-sm-6 col-12 option_title">Экологичность:</div>
				<div class="col-sm-6 col-12 option_value"><?php the_field("prioperty_eko") ?></div>
			</div>
		<?php } ?>

		
		<?php if( get_field('prioperty_eko') ){ ?>
			<p>Помещения:</p>
				<?php foreach (get_field('property_premises') as $key => $premises) { ?>
					<table>
						<?php if( $premises["property_premises_image"]) {?>
							<tr>
								<td><img src="<?php echo $premises["property_premises_image"]["url"] ?>" alt=""></td>
							</tr>
						<?php } ?>	
						<tr>
							<td width="40%">Площадь</td>
							<td><?php echo $premises["property_premises_square"] ?></td>
						</tr>
						<tr>
							<td width="40%">Количество комнат</td>
							<td><?php echo $premises["property_premises_rooms"] ?></td>
						</tr>
						<tr>
							<td width="40%">Балкон</td>
							<td><?php echo $premises["property_premises_balcony"] ? "Да" : "Нет" ?></td>
						</tr>
						<tr>
							<td width="40%">Санузел</td>
							<td><?php echo $premises["property_premises_bathroom"]  ? "Да" : "Нет" ?></td>
						</tr>
					</table>	
				<?php } ?>
			
		<?php } ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-bootstrap-starter' ),
				'after'  => '</div>',
			) );
		?>
		</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php wp_bootstrap_starter_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
