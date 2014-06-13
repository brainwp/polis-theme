<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 10/06/14
 * Time: 09:42
 */
get_header();

$page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$key = ( isset( $_GET['key'] ) ) ? $_GET['key'] : '';
$formato = ( isset( $_GET['formato'] ) ) ? $_GET['formato'] : array( 'post', 'publicacoes', 'noticias', 'acoes' );
$formato_str = ( isset( $_GET['formato'] ) ) ? $_GET['formato'] : '';
$tipo = ( isset( $_GET['tipo'] ) ) ? $_GET['tipo'] : '';
$categoria = ( isset( $_GET['categoria'] ) ) ? $_GET['categoria'] : '';
$anomin = ( isset( $_GET['anomin'] ) ) ? $_GET['anomin'] : '';
$anomax = ( isset( $_GET['anomax'] ) ) ? $_GET['anomax'] : '';
$date_query = array();
if(!empty($anomin) && !empty($anomax)){
	$date_query = array(
		array(
			'after' => array(
				'year' => $anomin
			),
			'before' => array(
				'year' => $anomax,
			),
		)
	);
}
elseif(!empty($anomin) && empty($anomax)){
	$date_query = array(
		array(
			'after' => array(
				'year' => $anomin
			),
		)
	);
}
elseif(!empty($anomax) && empty($anomin)){
	$date_query = array(
		array(
			'before' => array(
				'year' => $anomax
			),
		)
	);
}
$args = array(
	'post_type'      => $formato,
	'categorias'     => $categoria,
	'tipos'          => $tipo,
	's'              => $key,
	'post_type'     => $formato,
	'categorias'    => $categoria,
	'tipos'         => $tipo,
	's'             => $key,
	'date_query'    => $date_query,
	'posts_per_page' => '30',
	'paged'          => $page,
);

// The Query
$query = new WP_Query( $args );

$count_args = array(
	'post_type'     => $formato,
	'categorias'    => $categoria,
	'tipos'         => $tipo,
	's'             => $key,
	'date_query'    => $date_query,
	'post_per_page' => 999999,
);
$count_query = new WP_Query( $count_args );
$count = $count_query->found_posts;
// grab the current page number and set to 1 if no page number is set
$total_posts = $count;
$per_page = 10;

// calculate the total number of pages.
$offset = $per_page * ( $page - 1 );
$total_pages = ceil( $total_posts / $per_page );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main biblioteca-main" role="main">
			<div class="header-area">
				<div class="left">
					<h1>Biblioteca</h1>
					O Pólis é uma Organização-Não-Governamental (ONG) de atuação nacional, com participação em redes internacionais e locais, constituída como associação civil sem fins lucrativos, apartidária, pluralista e reconhecida como entidade de utilidade pública.
				</div>
			</div>
			<?php get_template_part( 'inc/biblioteca', 'search' ); ?>
			<div class="col-md-4">

			</div>
			<div class="col-md-8 right">
				<?php
				echo $query->found_posts;
				$type_list = array();
				$type_add = array();

				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						$type_term = return_term_biblioteca( 'tipos' );
						if ( ! in_array( return_term_biblioteca( 'tipos' ), $type_add ) ) { //verifique se vetor já existe no array
							$type_add[]              = $type_term;
							$type_list[]             = $type_term;
							$type_list[$type_term][] = 0;
							//$type_list[$type_term]['name'] = return_term_biblioteca_name('categorias');
						}
						$_i = count( $type_list[$type_term] );

						$type_list[$type_term][$_i]['area']      = return_term_biblioteca_area();
						$type_list[$type_term][$_i]['term_name'] = return_term_biblioteca_name( 'tipos' );
						$type_list[$type_term][$_i]['term_slug'] = return_term_biblioteca( 'tipos' );
						$type_list[$type_term][$_i]['title']     = get_the_title();
						$type_list[$type_term][$_i]['resumo']    = get_resumo();
						$type_list[$type_term][$_i]['thumb']     = get_post_thumbnail_id();
						$type_list[$type_term][$_i] ++;
					}

					foreach ( $type_list as $slug ) {

						for ( $i = 1; $i < count( $slug ); $i ++ ) {
							$id = md5( time() );
							if ( $i == 1 ) {
								echo '<div class="create_head" data-term-slug="' . $slug[$i]['term_slug'] . '" data-id="' . $id . '">' . $slug[$i]['term_name'] . '</div>';
							}
							echo '<div class="item_search ' . $slug[$i]['term_slug'] . '" data-term-slug="' . $slug[$i]['term_slug'] . '" data-area-slug="' . $slug[$i]['area'] . '">' . $slug[$i]['title'] . '</div>';
						}
					} ?>
					<div class="working-container">
						<ul class="nav nav-tabs">
							<li id="tab-nav-inclusao-e-sustentabilidade" data-tab-element="#tab-inclusao-e-sustentabilidade">
								<a href="#tab-inclusao-e-sustentabilidade" data-toggle="tab">Inclusão e sustentabilidade</a>
							</li>
							<li id="tab-nav-democracia-e-participacao" data-tab-element="#tab-democracia-e-participacao">
								<a href="#tab-democracia-e-participacao" data-toggle="tab">Democracia e Participação</a>
							</li>
							<li id="tab-nav-cidadania-cultural" data-tab-element="#tab-cidadania-cultural">
								<a href="#tab-cidadania-cultural" data-toggle="tab">Cidadania Cultural</a></li>
							<li id="tab-nav-reforma-urbana" data-tab-element="#tab-reforma-urbana">
								<a href="#tab-reforma-urbana" data-toggle="tab">Reforma Urbana</a></li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane" id="tab-inclusao-e-sustentabilidade" data-nav="tab-nav-inclusao-e-sustentabilidade"></div>
							<div class="tab-pane" id="tab-democracia-e-participacao" data-nav="tab-nav-democracia-e-participacao"></div>
							<div class="tab-pane" id="tab-cidadania-cultural" data-nav="tab-nav-cidadania-cultural"></div>
							<div class="tab-pane" id="tab-reforma-urbana" data-nav="tab-nav-reforma-urbana"></div>
						</div>
					</div>
				<?php
				} else {
					echo 'nenhum post encontrado nessa pesquisa';
				}
				?>
			</div>
			<div class="container pagination">
				<div class="col-md-4 col-md-offset-4">
					<?php
					$search_vars = '/?key='.$key.'&tipo='.$tipo.'&formato='.$formato_str.'&categoria='.$categoria.'&anomin='.$anomin.'&anomax='.$anomax.'';
					if ( $page != 1 ) {
						?>
						<a href="<?php echo get_bloginfo( 'url' ) ?>/equipe/page/<?php echo $page - 1 . $search_vars ?>/">&lt;</a>
					<?php
					}
					?>
					<?php
					for ( $i = 1; $i < $total_pages + 1; $i ++ ) {
						if ( $i == $page ) {
							echo '<a class="atual" href="' . get_bloginfo( 'url' ) . '/equipe/page/' . $i . $search_vars.'">' . $i . '</a>';
						} else {
							echo '<a href="' . get_bloginfo( 'url' ) . '/equipe/page/' . $i . $search_vars.'">' . $i . '</a>';
						}
					}
					?>
					<?php
					if ( $page < $total_pages ) {
						?>
						<a href="<?php echo get_bloginfo( 'url' ) ?>/equipe/page/<?php echo $page + 1 . $search_vars ?>">&gt;</a>
					<?php
					}
					?>
				</div>
			</div>
		</main>
	</div>
<?php
get_footer();
?>