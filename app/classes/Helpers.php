<?php

class Helpers {

	public static function extraer_imagenes(Template $template) {
		$html = new Htmldom($template->content);
		$imagenes = array();

		/*$attr_style = $html->find('[style]');
		foreach($attr_style as $tag) {
		    if(stristr($tag->style, 'background-image')) {
		        $primera = stristr($tag->style, 'background-image');
		        $segunda = substr(stristr($primera, '('), 1, strlen($primera));
		        $tercera = stristr($segunda, ')', true);
		        $filename = substr(strrchr($tercera, '/'), 1);
		        if(!in_array($filename, $imagenes)) {
		            array_push($imagenes, $filename);
		        }
		    }
		}*/

		$tags_img = $html->find('img');
		foreach($tags_img as $img) {
		    if(!strpos($img->src,'/') && !in_array($img->src, $imagenes)) {
		        array_push($imagenes, $img->src);
		    }
		}

		sort($imagenes);

		return $imagenes;
	}

	public static function fixImagePaths($templateContent, $templateName) {
		$html = new Htmldom($templateContent);

		/*$attr_style = $html->find('[style]');
		foreach($attr_style as $tag) {
		    if(stristr($tag->style, 'background-image')) {
		        $primera = stristr($tag->style, 'background-image');
		        $segunda = substr(stristr($primera, '('), 1, strlen($primera));
		        $tercera = stristr($segunda, ')', true);
		        $filename = substr(strrchr($tercera, '/'), 1);
		        if(!in_array($filename, $imagenes)) {
		            array_push($imagenes, $filename);
		        }
		    }
		}*/
		
		$tags_img = $html->find('img');
		foreach($tags_img as &$img) {		
		    $img->src = '//'.$_SERVER['HTTP_HOST'].'/imagenes/templates/'.$templateName.'/img/'.$img->src;
		}

		return $html;
	}

	public static function template_completa(Template $template) {
		$imagenes = Helpers::extraer_imagenes($template);
		$templateName = strtolower($template->category.'_'.$template->name);
		foreach($imagenes as $imagen) {
			if(!File::exists("public/imagenes/templates/{$templateName}/img/$imagen")) {
				return false;
			}
		}

		return true;
	}

}