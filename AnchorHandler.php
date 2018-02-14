<?php
/**
 * MediaWiki extension AnchorHandler.
 * Allows inserting <a> anchor tags into wikitext
 *
 * To activate this extension, add the following into your LocalSettings.php file:
 * require_once('$IP/AnchorHandler/AnchorHandler.php');
 * $egAnchorNamespaces = []; must be set!
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
 */
if ( function_exists( 'wfLoadExtension' ) ) {
	wfLoadExtension( 'AnchorHandler' );
	// Keep i18n globals so mergeMessageFileList.php doesn't break
	$wgMessagesDirs['AnchorHandler'] = __DIR__ . '/i18n';
	wfWarn(
		'Deprecated PHP entry point used for the AnchorHandler extension. ' .
		'Please use wfLoadExtension instead, ' .
		'see https://www.mediawiki.org/wiki/Extension_registration for more details.'
	);
	return;
} else {
	die( 'This version of the AnchorHandler extension requires MediaWiki 1.29+' );
}
