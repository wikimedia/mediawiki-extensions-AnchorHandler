<?php
/**
 * MediaWiki extension AnchorHandler.
 * Allows inserting <a> anchor tags into wikitext
 *
 * To activate this extension, add the following into your LocalSettings.php file:
 * require_once('$IP/AnchorHandler/AnchorHandler.php');
 * $egAnchorNamespaces = array(); //Must be set!
 *
 * Copyright (C) 2014, Ike Hecht
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * @ingroup Extensions
 * @author Ike Hecht
 * @version 0.1
 * @link https://www.mediawiki.org/wiki/Extension:AnchorHandler Documentation
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */
if ( !defined( 'MEDIAWIKI' ) ) {
	echo ( "This is an extension to the MediaWiki package and cannot be run standalone.\n" );
	die( -1 );
}

// Extension credits that will show up on Special:Version
$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'AnchorHandler',
	'version' => '0.2',
	'author' => 'Ike Hecht for [http://www.wikiworks.com/ WikiWorks]',
	'url' => 'https://www.mediawiki.org/wiki/Extension:AnchorHandler',
	'descriptionmsg' => 'anchorhandler-desc',
);

$wgMessagesDirs['AnchorHandler'] = __DIR__ . '/i18n';

$egAnchorNamespaces = array();

$wgHooks['ParserFirstCallInit'][] = 'addAnchorHandler';

function addAnchorHandler( Parser &$parser ) {
	$parser->setHook( 'a', 'anchorHandler' );

	return true;
}

// If current namespace is an "anchor namespace" specified in $egAnchorNamespaces then send out real
// HTML. Otherwise, just send out the escaped anchor text.
function anchorHandler( $text, array $args, Parser $parser, PPFrame $frame ) {
	global $egAnchorNamespaces;

	$namespace = $frame->getTitle()->getNamespace();

	if ( !in_array( $namespace, $egAnchorNamespaces ) ) {
		return htmlspecialchars( $text );
	}

	$href = $args['href'];
	$output = Linker::makeExternalLink( $href, $text, false, '', $args );
	unset( $args['href'] );

	return $output;
}
