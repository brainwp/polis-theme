<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 19/06/14
 * Time: 12:12
 */
function biblioteca_count_ajax() {
	if ( isset($_GET['isBibliotecaCountAjax']) ) {
        echo '<span>Sua busca trouxe esses resultados separados por nossas Áreas de Atuação</span>';
		$democracia = biblioteca_count('democracia-e-participacao');
		$cidadania = biblioteca_count('cidadania-cultural');
		$inclusao = biblioteca_count('inclusao-e-sustentabilidade');
		$reforma = biblioteca_count('reforma-urbana');
		if($democracia >= 1){
			echo '<a class="envia-area democracia-e-participacao" data-area="democracia-e-participacao">Democracia e Participação (' . $democracia . ')</a>';
		}
		else{
			echo '<a>Democracia e Participação</a>';
		}
		if($cidadania >= 1){
			echo '<a class="envia-area cidadania-cultural" data-area="cidadania-cultural" >Cidadania Cultural (' . $cidadania . ')</a>';
		}
		else{
			echo '<a>Cidadania Cultural</a>';
		}
		if($inclusao >= 1){
			echo '<a class="envia-area inclusao-e-sustentabilidade" data-area="inclusao-e-sustentabilidade"> Inclusao e Sustentabilidade (' . $inclusao . ')</a>';
		}
		else{
			echo '<a>Inclusão e Sustentabilidade</a>';
		}
		if($reforma >= 1){
            echo '<a class="envia-area reforma-urbana" data-area="reforma-urbana"> Reforma Urbana (' . $reforma . ')</a>';
		}
		else{
			echo '<a>Reforma Urbana</a>';
		}
        die();
	}
}
add_action( 'init', 'biblioteca_count_ajax', 1 );
