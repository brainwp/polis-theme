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
		'^equipe/?pagina=([^/]+)/?$' => 'template=equipe',
		'^equipe/(.+)/?$' => 'index.php?&nome=$1',
		'^equipe/(.+)/?$' => 'template=membros',
		'^area/([^/]+)/?$' => 'template=area&area=$matches[1]',
		'^area/([^/]+)/([^/]+)/?$' => 'template=index&area_archive=$matches[1]&area=$matches[2]',
	);
}
