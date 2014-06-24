<form class="col-md-12 busca-mini" id="busca-biblioteca-mini" action="<?php bloginfo('url');?>/biblioteca/busca">
    <div class="col-md-6 col-md-offset-2">
        <label class="pull-left">Biblioteca</label>
        <input id="key" name="key" class="col-md-8 pull-left" placeholder="Faça uma nova busca"/>
        <span class="right glyphicon glyphicon-search" id="busca-biblioteca-mini-bt"></span> <!-- icone de search !-->
        <input type="hidden" name="tipo" value="<?php echo $_GET['tipo'];?>"/>
        <input type="hidden" name="categoria" value="<?php echo $_GET['tipo'];?>"/>
    </div>
</form>