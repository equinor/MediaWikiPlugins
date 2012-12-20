<?php

if (!defined('MEDIAWIKI')) {
	die('Not an entry point.');
}


$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'FlashPlayer',
	'version' => 0.1,
	'author' => 'Mathias Lidal',
	'url' => '',
	'descriptionmsg' => 'flashplayer-desc'
);

$wgHooks['ParserFirstCallInit'][] = 'FlashPlayerHooks::init';

$wgHooks['UnitTestsList'][] = 'FlashPlayerHooks::registerUnitTests';

$wgAutoloadClasses['FlashPlayerHooks'] = dirname(__FILE__) . '/FlashPlayer.hooks.php';

?>
