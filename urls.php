<?php

/**
 * Rewrite rules
 *
 * Define the array of rewrite rules and the query variables they match. Don't
 * use `index.php?` in front of the query string.
 */
function _query_rules () {

    return array(
		'^equipe/?$' => 'template=equipe',
        '^institucional/([^/]+)/?$' => 'template=redirect_js_institucional&pslug=$matches[1]',
        '^biblioteca/?$' => 'template=biblioteca',
		'^biblioteca/busca/?$' => 'template=biblioteca-search',
		'^biblioteca/busca/page/([^/]+)/?$' => 'template=biblioteca-search&paged=$matches[1]',
        '^colecoes/([^/]+)/?$' => 'template=colecoes&termo=$matches[1]',
        '^colecoes/([^/]+)/page/([^/]+)/?$' => 'template=colecoes&termo=$matches[1]&paged=$matches[2]',
        //'^boletim-dicas/?$' => 'template=boletim',
		'^equipe/page/([^/]+)/?$' => 'template=equipe&paged=$matches[1]',
		'^equipe/([^/]+)/?$' => 'template=membros&nome=$matches[1]',
		'^equipe/area/([^/]+)/?$' => 'template=equipe-area&user_area=$matches[1]',
		'^equipe/area/([^/]+)/page/([^/]+)/?$' => 'template=equipe-area&user_area=$matches[1]&paged=$matches[2]',
	    //'^equipe/([^/]+)/page/([^/]+)/?$' => 'template=membros&nome=$matches[1]&paged=$matches[2]',
		'^canal/?$' => 'template=canal',
        '^noticias-e-acoes/?$' => 'template=noticias-e-acoes',
        '^noticias-e-acoes/page/([^/]+)/?$' => 'template=noticias-e-acoes&paged=$matches[1]',
        '^projetos/?$' => 'template=projetos',
        '^projetos/page/([^/]+)/?$' => 'template=projetos&paged=$matches[1]',
        '^projetos/tipo/([^/]+)/?$' => 'template=projetos&aba=$matches[1]',
        '^projetos/tipo/([^/]+)/page/([^/]+)/?$' => 'template=projetos&aba=$matches[1]&paged=$matches[2]',
        '^area/([^/]+)/?$' => 'template=area&area=$matches[1]',
        '^area/([^/]+)/([^/]+)/?$' => 'template=area-cpt&select_query=area-cat&area=$matches[1]&cpt=$matches[2]',
        '^area/([^/]+)/([^/]+)/page/([^/]+)/?$' => 'template=area-cpt&select_query=area-cat&area=$matches[1]&cpt=$matches[2]&paged=$matches[3]',
        '^publicacoes/?$' => 'template=archive-publicacoes',
        '^publicacoes/page/([^/]+)/?$' => 'template=archive-publicacoes&paged=$matches[1]',
        '^tipo/([^/]+)/?$' => 'template=tipo&select_query=tipo&taxtipo=$matches[1]',
        '^tipo/([^/]+)/page/([^/]+)/?$' => 'template=tipo&select_query=tipo&taxtipo=$matches[1]&paged=$matches[2]',
    );
}
