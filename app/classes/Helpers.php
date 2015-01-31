<?php

class Helpers {

	public static function extraer_imagenes(Template $template) {
		$html = new Htmldom($template->content);
		$imagenes = array();

		$attr_style = $html->find('[style]');
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
		}

		$tags_img = $html->find('img');
		foreach($tags_img as $img) {
		    $filename = substr(strrchr($img->src, '/'), 1);
		    if(!in_array($filename, $imagenes)) {
		        array_push($imagenes, $filename);
		    }
		}

		sort($imagenes);

		return $imagenes;
	}

	public static function template_completa(Template $template) {
		$imagenes = Helpers::extraer_imagenes($template);
		$templateName = $template->category.'_'.$template->name;
		foreach($imagenes as $imagen) {
			if(!File::exists(storage_path("templates/{$templateName}/img/$imagen"))) {
				return false;
			}
		}

		return true;
	}

}