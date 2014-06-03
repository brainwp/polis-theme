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
		'^equipe/page/([^/]+)/?$' => 'template=equipe&paged=$matches[1]',
		'^equipe/([^/]+)/?$' => 'template=membros&nome=$matches[1]',
		'^equipe/([^/]+)/page/([^/]+)/?$' => 'template=membros&nome=$matches[1]&paged=$matches[2]',

		'^area/([^/]+)/?$' => 'template=area&area=$matches[1]',
		'^area/([^/]+)/([^/]+)/?$' => 'template=index&area_archive=$matches[1]&area=$matches[2]',
	);
}
