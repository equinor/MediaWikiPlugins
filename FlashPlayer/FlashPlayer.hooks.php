<?php

class FlashPlayerHooks {

	public static function init(Parser &$parser) {
		$parser->setHook('flashplayer', 'FlashPlayerHooks::renderFromTag');
		return true;
	}

	public static function renderFromTag($input, array $args, Parser $parser, PPFrame $frame) {
		global $wgServer, $wgScriptPath;
		$basepath = $wgScriptPath . '/images/flash/';
		$config = self::getTagConfig($args);
		$url = $wgServer;
		if ($args['file']) {
			if ($args['file'][0] !== '/') {
				$url .= $basepath;
			}
			$url .= $args['file'];
			$output = '<object id="presentation" width="' . $config['width'] . '" height="' . $config['height'] . '"
classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="powerpoint" />
<param name="quality" value="high" />
<param name="bgcolor" value="#ffffff" />
<param name="allowFullScreen" value="true" />
<embed src="' . $url . '" quality="high" bgcolor="#ffffff"
width="' . $config['width'] . '" height="' . $config['height'] . '" name="presentation"
align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash"
pluginspage="http://www.adobe.com/go/getflashplayer" allowFullScreen="true" />
</object>';
		} else {
			$output = "<div>Flash file " . $args['file'] . "doesn't exist</div>";
		}
		return array($output, 'noparse' => true, 'isHTML' => true);
	}


	public static function registerUnitTests(&$files) {
		return true;
	}

	public static function getTagConfig($args) {
		$config['width'] = array_key_exists('width', $args) ? filter_var($args['width'], FILTER_VALIDATE_INT) : 800;
		$config['height'] = array_key_exists('height', $args) ? filter_var($args['height'], FILTER_VALIDATE_INT) : 600;
		return $config;
	}
}