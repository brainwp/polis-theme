<form class="col-md-12 busca-mini" id="busca-biblioteca-mini" action="<?php bloginfo('url');?>/biblioteca/busca">
    <?php
    $key = ( isset( $_GET['key'] ) ) ? $_GET['key'] : '';
    $area = ( isset( $_GET['area'] ) ) ? $_GET['area'] : '';
    $categoria = ( isset( $_GET['categoria'] ) ) ? $_GET['categoria'] : '';
    $anomin = ( isset( $_GET['anomin'] ) ) ? $_GET['anomin'] : '';
    $anomax = ( isset( $_GET['anomax'] ) ) ? $_GET['anomax'] : '';
    ?>
    <div class="col-md-6 col-md-offset-2">
        <label class="pull-left">Biblioteca</label>
        <input id="key" name="key" class="col-md-8 pull-left" placeholder="Faça uma nova busca" value="<?php echo $key?>"/>
        <span class="right glyphicon glyphicon-search" id="busca-biblioteca-mini-bt"></span> <!-- icone de search !-->
        <input type="hidden" id="categoria-hidden" name="categoria" value="<?php echo $categoria;?>"/>
        <input type="hidden" id="area-hidden" name="area" value="<?php echo $area;?>"/>
        <input type="hidden" name="anomin" value="<?php echo $anomin;?>"/>
        <input type="hidden" name="anomax" value="<?php echo $anomax;?>"/>
    </div>
</form>