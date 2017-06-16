<?php

	
/**
 * Aixeena Tags System - Taxonomy
 * Component Version 1.0.0 - Joomla! Version 1.6
 * Author: Ciro Artigot
 * info@aixeena.org
 * http://aixeena.org
 * Copyright (c) 2011 Ciro Artigot. All Rights Reserved. 
 * License: GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.html
 */
 
defined('_JEXEC') or die('Restricted access'); 

	$html = '';
	$Y=0;
	
	// ONCHANGE="location = this.options[this.selectedIndex].value;"
	$html .= '<br /><br /><br /><br /><select id="cat_select" class="select" name="forma" ONCHANGE="Page.catSelect(this.options[this.selectedIndex].value);"><option selected="true" style="display:none;">Categories:</option><br />';
	$cuantos = count($palabras_array_contadas_filtradas);
	
	// $base_url = $this->baseurl;

	$rango = $maximum_count - $minimum_count;
	foreach($palabras_array_contadas_filtradas as $k=>$v)	{
		if($v) {
			if($v==$minimum_count) $pfont=1;
			if($v==$maximum_count) $pfont = 1.5;
			if($v>$minimum_count&&$v<$maximum_count) {
				$valor_absoluto = $v-$minimum_count;
				$pfont  = 1 + ($valor_absoluto * 0.50) / $rango;
			}
			$Y++; $vrate = '';
			if($Y>$cuantas) break;

			$hashtag = 0;
			$tag = trim($k);
			
			if(strpos($tag, '#')!== false&&strpos($tag, '#')==0) $hashtag = 1;
			$guiones = 0;
			for($i = 0; $i < strlen($tag); $i++)  {
				if($tag[$i]=='-') $guiones++;
			}
			
			$tag = str_replace("#", "", trim($tag));
			
			//if($guiones>1) $tag = str_replace("-", "_", $tag);
			if($hashtag) $tag .= '_hashtag';

			// $tag = urlencode(trim($tag));
			
			$texto = '<option value="'.trim($tag).'">';
			$html .= $texto.$k."</a></option>";
			//if($Y<$cuantos) $html .= $separador."\n";
					
		}
	}  
	$html .= '</select>';
	
	echo $html;
	?>