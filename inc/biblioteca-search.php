<form class="col-md-12 busca" id="busca-biblioteca" action="<?php bloginfo('url'); ?>/biblioteca/busca">
    <aside class="col-md-4 pull-right" id="ajax-counter">
        <span>
            Abaixo exibiremos a quantidade de resultados em cada área de atuação
        </span>
        <a class="envia-area" data-area="democracia-e-participacao"> Democracia e Participação</a>
        <a class="envia-area" data-area="inclusao-e-sustentabilidade"> Inclusão e Sustentabilidade</a>
        <a class="envia-area" data-area="reforma-urbana"> Reforma Urbana</a>
        <a class="envia-area" data-area="cidadania-cultural">Cidadania Cultural</a>
    </aside>
    <aside class="col-md-8">
        <div class="input_container">
            <h2 class="intro"><?php echo of_get_option('biblioteca-form-intro'); ?></h2>
            <label class="col-md-2">Buscar:</label>
            <input class="col-md-6 input1" name="key" placeholder="Busque por título, autor ou assunto" id="key">
            <span class="right glyphicon glyphicon-search" id="busca-biblioteca-bt"></span> <!-- icone de search !-->
        </div>
        <div class="input_container">
            <label class="col-md-2">Filtros:</label>
            <select class="col-md-1 select1" name="tipo" id="select_tipo">
                <option value="">Tipo</option>
                <?php
                $_args = array(
                    'type' => 'post',
                    'child_of' => 0,
                    'parent' => '',
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'hide_empty' => 1,
                    'hierarchical' => 1,
                    'exclude' => '',
                    'include' => '',
                    'number' => '',
                    'taxonomy' => 'tipos',
                    'pad_counts' => false

                );
                $categories = get_categories($_args);
                foreach ($categories as $category) {
                    echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
                }
                ?>
            </select>
            <select class="col-md-2 select1" name="categoria" id="select_cat">
                <option value="">Categoria</option>
                <?php
                $_args = array(
                    'type' => 'post',
                    'child_of' => 0,
                    'parent' => '',
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'hide_empty' => 1,
                    'hierarchical' => 1,
                    'exclude' => '',
                    'include' => '',
                    'number' => '',
                    'taxonomy' => 'categorias',
                    'pad_counts' => false
                );
                $categories = get_categories($_args);
                foreach ($categories as $category) {
                    $parent = $category->parent;
                    if (!$parent == '0') {
                        echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-12 input_container data">
            <label>De</label>
            <select class="select1" id="select_anomin">
                <option value="">Ano</option>
                <?php for ($i = 1987; $i < 2015; $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                } ?>
            </select>
            <label style="margin-left: 10px">á</label>
            <select class="select1" id="select_anomax">
                <option value="">Ano</option>
                <?php for ($i = 2014; $i > 1987; $i--) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                } ?>
            </select>
            <input id="area-input" name="area" type="hidden" value="">
        </div>
    </aside>
</form>