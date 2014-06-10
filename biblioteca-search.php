<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 10/06/14
 * Time: 09:42
 */
get_header();
$args = array (
	'post_type' => array('post','acoes','noticias','publicacoes'),
	'posts_per_page' => 80
);

$query = new WP_Query( $args );
$type_list = array();
$type_add = array();

if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		echo $query->found_posts;
		$type_term = return_term_biblioteca('categorias');
		if(!in_array(return_term_biblioteca('categorias'),$type_add)){ //verifique se vetor já existe no array
			$type_add[] = $type_term;
			$type_list[] = $type_term;
			$type_list[$type_term][] = 0;
			//$type_list[$type_term]['name'] = return_term_biblioteca_name('categorias');
		}
		$_i = count($type_list[$type_term]);

		$type_list[$type_term][$_i]['term_name'] = return_term_biblioteca_name('categorias');
		$type_list[$type_term][$_i]['title'] = get_the_title();
		$type_list[$type_term][$_i]['resumo'] = get_resumo();
		$type_list[$type_term][$_i]['thumb'] = get_post_thumbnail_id();
		$type_list[$type_term][$_i]++;
	}
	foreach($type_list as $slug){
		for ( $i = 1; $i < count($slug); $i++ ) {
			if($i == 1){
				echo '<h1>'.$slug[$i]['term_name'].'</h1>';
			}
			echo $slug[$i]['title'];
		}
	}
} else {
	echo 'nenhum post encontrado nessa pesquisa';
}
get_footer();
?>