<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 22/05/14
 * Time: 11:10
 */
get_header(); ?>
	<section class="col-md-12 content text-center">

<?php
	$imagick = new Imagick();
	$imagick->readImage( 'http://beta.brasa.art.br/polis/wp-content/uploads/sites/35/2014/07/teste.pdf' );
	$url = $imagick->writeImage('output.jpg');
?>

<img src="<?php echo $url; ?>" alt="A">

	</section>
<?php get_footer(); ?>