<form class="col-md-12 busca" id="busca-biblioteca" action="<?php bloginfo('url');?>/biblioteca/busca">
	<aside class="col-md-2 left areas" id="ajax-counter">
	</aside>
	<aside class="col-md-8">
		<div class="input_container">
			<h2 class="intro">Introdução à busca avançada com Lorem ipsum Dolor sit amet e  alguma frase de efeito ou resumo.</h2>
			<label class="col-md-2">Buscar:</label>
			<input class="col-md-6 input1" name="key" placeholder="Busque por título, autor ou assunto" id="key">
			<span class="right glyphicon glyphicon-search" id="busca-biblioteca-bt"></span> <!-- icone de search !-->
		</div>
		<div class="input_container">
			<label class="col-md-2">Filtros:</label>
				<option value="">Tipo</option>
				<?php
				$_args = array(
					'type'                     => 'post',
					'child_of'                 => 0,
					'parent'                   => '',
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 1,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'include'                  => '',
					'number'                   => '',
					'taxonomy'                 => 'tipos',
					'pad_counts'               => false

				);
				$categories = get_categories($_args);
				foreach ($categories as $category) {
					echo '<option value="'.$category->slug.'">'.$category->name.'</option>';
				}
				?>
			</select>
				<option value="">Categoria</option>
				<?php
				$_args = array(
					'type'                     => 'post',
					'child_of'                 => 0,
					'parent'                   => '',
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 1,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'include'                  => '',
					'number'                   => '',
					'taxonomy'                 => 'categorias',
					'pad_counts'               => false
				);
				$categories = get_categories($_args);
				foreach ($categories as $category) {
					echo '<option value="'.$category->slug.'">'.$category->name.'</option>';
				}
				?>
			</select>
		</div>
		<div class="col-md-12 input_container data">
			<label>De</label>
            <select class="select1">
				<option value="">Ano</option>
			</select>
			<label style="margin-left: 10px">á</label>
			<select class="select1">
				<option value="">Ano</option>
			</select>
		</div>
	</aside>
</form>