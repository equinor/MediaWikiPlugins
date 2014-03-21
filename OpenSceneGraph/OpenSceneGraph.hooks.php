<?php

class OpenSceneGraphHooks {

	public static function init(Parser &$parser) {
		$parser->setHook('openscenegraph', 'OpenSceneGraphHooks::renderFromTag');
		return true;
	}

	public static function renderFromTag($input, array $args, Parser $parser, PPFrame $frame) {
		global $wgServer,$wgOut, $wgScriptPath;
		$wgOut->addModules( 'ext.OpenSceneGraph');

		$basepath = $wgScriptPath;
		$config = self::getTagConfig($args);
		$url = $wgServer;
		$file = $args['file'];

		if(filter_var($file, FILTER_VALIDATE_URL) === false){
			$file = $parser->recursiveTagParse($file,$frame);
		}

		if ($file) {
			if (stripos($file, 'http://') === 0 ||
			    stripos($file, 'https://') === 0 ||
				stripos($file, 'file://') === 0 ||
				stripos($file, 'ftp://') === 0) {
				//absolute uri
				$url = $file;
			} else if ($file[0] !== '/') {
				//relative uri
				$url .= join('/',array($basepath,$file));
			} else {
				//relative uri
				$url .= $file;
			}
			$output = "<div class=\"osg-container\" style=\"width: {$config['width']}px; height: {$config['height']}px;\">";
			$output .= "<div class=\"osg-obj-container\"><object class=\"osg-obj\" type=\"application/osg-viewer\" data=\"$url\"></object></div>";
			$output .= "<button class=\"fullscreen-control\">Toggle fullscreen</button>";
			$output .= '</div>';
		} else {
			$output = "<div>IVS file " . $file . "doesn't exist</div>";
		}
		return array($output, 'noparse' => true, 'isHTML' => true);
	}

	public static function getTagConfig($args) {
		$config['width'] = array_key_exists('width', $args) ? filter_var($args['width'], FILTER_VALIDATE_INT) : 1024;
		$config['height'] = array_key_exists('height', $args) ? filter_var($args['height'], FILTER_VALIDATE_INT) : 768;
		return $config;
	}
}
