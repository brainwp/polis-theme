<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 10/06/14
 * Time: 09:42
 */
get_header();
$args = array (
	'posts_per_page' => 80
);

$query = new WP_Query( $args );
$type_list = array();
$type_add = array();

if ( $query->have_posts() ) {
	echo $query->found_posts;
	while ( $query->have_posts() ) {
		$query->the_post();
		$type_term = return_term_biblioteca('tipos');
		$type_term_name = return_term_biblioteca_name('tipos');
		if(!in_array(return_term_biblioteca('tipos'),$type_add)){ //verifique se vetor já existe no array
			$type_add[] = $type_term;
			$type_list[] = 0;
			//$type_list[$type_term]['name'] = return_term_biblioteca_name('categorias');
		}
		$_i = count($type_add);

		$type_list[$_i]['term_name'] = $type_term_name;
		$type_list[$_i]['title'] = get_the_title();
		$type_list[$_i]['resumo'] = get_resumo();
		$type_list[$_i]['thumb'] = get_post_thumbnail_id();
		//$type_list[$_i]++;
	}
	foreach($type_list as $slug){
		for ( $i = 0; $i < count($type_add); $i++ ) {
			if($i == 0){
				echo '<h1>'.$slug['term_name'].'</h1>';
			}
			echo $slug['title'];
		}
	}
} else {
	echo 'nenhum post encontrado nessa pesquisa';
}
get_footer();
?>