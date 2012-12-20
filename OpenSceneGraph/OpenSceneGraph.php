<?php

if (!defined('MEDIAWIKI')) {
	die('Not an entry point.');
}


$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'OpenSceneGraph',
	'version' => 0.1,
	'author' => 'Mathias Lidal',
	'url' => '',
	'descriptionmsg' => 'openscenegraph-desc'
);

$wgHooks['ParserFirstCallInit'][] = 'OpenSceneGraphHooks::init';

$wgHooks['UnitTestsList'][] = 'OpenSceneGraphHooks::registerUnitTests';

$wgAutoloadClasses['OpenSceneGraphHooks'] = dirname(__FILE__) . '/OpenSceneGraph.hooks.php';

?>
