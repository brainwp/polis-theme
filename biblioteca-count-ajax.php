<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 19/06/14
 * Time: 12:12
 */
function biblioteca_count_ajax() {
	if ( isset($_GET['isBibliotecaCountAjax']) ) {
		$democracia = biblioteca_count('democracia-e-participacao');
		$cidadania = biblioteca_count('cidadania-cultural');
		$inclusao = biblioteca_count('inclusao-e-sustentabilidade');
		$reforma = biblioteca_count('reforma-urbana');
		if($democracia >= 1){
			echo 'democracia (' . $democracia . ')<br>';
		}
		else{
			echo 'democracia<br>';
		}
		if($cidadania >= 1){
			echo 'cidadania (' . $cidadania . ')<br>';
		}
		else{
			echo 'cidadania<br>';
		}
		if($inclusao >= 1){
			echo 'inclusao (' . $inclusao . ')<br>';
		}
		else{
			echo 'inclusao<br>';
		}
		if($reforma >= 1){
			echo 'reforma (' . $reforma . ')';
		}
		else{
			echo 'reforma<br>';
		}
	die();
	}
}
add_action( 'init', 'biblioteca_count_ajax', 1 );
