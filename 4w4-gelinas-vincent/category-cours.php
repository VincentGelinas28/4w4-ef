<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package theme4w4
 */

get_header();
?>
	<main id="primary" class="site-main">
	


		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">Categorie Cours</h1>
				<?php
				//the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<section class="category_cours">
			<?php
			/* Start the Loop */
            $precedent = "XXXXXX";
			$chaine_bouton_radio = '';
			//global $tProprieté;
			while ( have_posts() ) :
				the_post();
                convertirTableau($tPropriété);
				//print_r($tPropriété);
				if ($tPropriété['typeCours'] != $precedent): 
					if ("XXXXXX" != $precedent)	: ?>
						</section>
						<?php if (in_array($precedent, ['Web', 'Jeu', 'Spécifique','Conception','Imagerie_2d/3d'])) : ?>
						<?php endif; ?>
					<?php endif; ?>	
					
					<section <?php echo class_composant($tPropriété['typeCours']) ?>>
				<?php endif ?>	

				<?php if (in_array($tPropriété['typeCours'], ['Web', 'Jeu', 'Spécifique','Conception','Imagerie_2d/3d']) ) : 
						get_template_part( 'template-parts/content', 'cours-carrousel' ); 
					

						else :		
						get_template_part( 'template-parts/content', 'cours-article' ); 
				endif;	
				$precedent = $tPropriété['typeCours'];
			endwhile;?>
			</section> <!-- fin section cours -->
		<?php endif; ?>

	

	</main><!-- #main -->

<?php 
// get_sidebar();
get_footer();

function convertirTableau(&$tPropriété)
{

	$tPropriété['titre'] = get_the_title(); 
	$tPropriété['sigle'] = substr($tPropriété['titre'], 0, 7);
	$tPropriété['nbHeure'] = substr($tPropriété['titre'],-6,6);
	$tPropriété['titrePartiel'] = substr($tPropriété['titre'],8,-6);
	$tPropriété['session'] = substr($tPropriété['titre'], 4,1);
	$tPropriété['typeCours'] = get_field('type_de_cours');
}


function class_composant($typeCours){

	if (in_array($typeCours, ['Web'])){
		return 'class="bloc_Web"';
	}
	if (in_array($typeCours, ['Jeu'])){
		return 'class="bloc_Jeu"';
	}
	if (in_array($typeCours, ['Spécifique'])){
		return 'class="bloc_Spécifique"';
	}
	if (in_array($typeCours, ['Conception'])){
		return 'class="bloc_Conception"';
	}
	if (in_array($typeCours, ['Imagerie_2d/3d'])){
		return 'class="bloc_Imagerie_2d/3d"';
	}

	else {
		return 'class="bloc_cours"';
	}
}
