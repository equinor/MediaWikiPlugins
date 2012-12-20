<?php
        /**
         * MediaWiki EmbedAll extension
         *
         * @version 0.4
         * @author Dominik Sigmund
         * @link http://www.mediawiki.org/wiki/Extension:EmbedAll
         */
 
        $wgExtensionCredits['parserhook'][] = array(
                'name' => 'EmbedAll',
                'author' => 'Dominik Sigmund',
                'version' => '0.4',
                'url' => 'http://www.mediawiki.org/wiki/Extension:EmbedAll',
                'description' => 'Allows to embed documents on a wiki page.',
                );
 
        $wgExtensionFunctions[] = 'registerEmbedHandler';
 
        function registerEmbedHandler ()
        {
                global $wgParser;
                $wgParser->setHook( 'pdf', 'embedPDFHandler' );
                                $wgParser->setHook( 'svg', 'embedSVGHandler' );
                                $wgParser->setHook( 'vsd', 'embedVSDHandler' );
        }
 
        function makeHTML ( $path, $argv )
        {
                if (empty($argv['width']))
                {
                        $width = '1000';
                }
                else
                {
                        $width = $argv['width'];
                }
 
                if (empty($argv['height']))
                {
                        $height = '700';
                }
                else
                {
                        $height = $argv['height'];
                }
                return '<iframe src="'.$path.'" width="'.$width.'" height="'.$height.'"></iframe>';
        }
        function embedPDFHandler ( $input, $argv )
        {
                if (!$input)
                        return '<font color="red">Error: empty param in &lt;pdf&gt;!</font>';
 
                if (preg_match('/^[^\/]+\.pdf$/i', $input))
                {
                        $img = Image::newFromName( $input );
                        if ($img != NULL)
                                return makeHTML( $img->getURL(), $argv );
                }
 
                if (preg_match('/^http\:\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@\?\^\=\%\&:\/\~\+\#]*[\w\-\@\?\^\=\%\&\/\~\+\#])?\.pdf$/i', $input))
                        return makeHTML( $input, $argv );
                else
                        return '<font color="red">Error: bad URI in &lt;pdf&gt;!</font>';
        }
                function embedSVGHandler ( $input, $argv )
        {
                if (!$input)
                        return '<font color="red">Error: empty param in &lt;svg&gt;!</font>';
 
                if (preg_match('/^[^\/]+\.svg$/i', $input))
                {
                        $img = Image::newFromName( $input );
                        if ($img != NULL)
                                return makeHTML( $img->getURL(), $argv );
                }
 
                if (preg_match('/^http\:\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@\?\^\=\%\&:\/\~\+\#]*[\w\-\@\?\^\=\%\&\/\~\+\#])?\.svg$/i', $input))
                        return makeHTML( $input, $argv );
                else
                        return '<font color="red">Error: bad URI in &lt;svg&gt;!</font>';
        }
                function embedVSDHandler ( $input, $argv )
        {
                if (!$input)
                        return '<font color="red">Error: empty param in &lt;vsd&gt;!</font>';
 
                if (preg_match('/^[^\/]+\.vsd$/i', $input))
                {
                        $img = Image::newFromName( $input );
                        if ($img != NULL)
                                return makeHTML( $img->getURL(), $argv );
                }
 
                if (preg_match('/^http\:\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@\?\^\=\%\&:\/\~\+\#]*[\w\-\@\?\^\=\%\&\/\~\+\#])?\.vsd$/i', $input))
                        return makeHTML( $input, $argv );
                else
                        return '<font color="red">Error: bad URI in &lt;vsd&gt;!</font>';
        }
?>

