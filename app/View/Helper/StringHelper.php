<?php 

class StringHelper extends AppHelper {
    public function shorten($str, $len){
    	  $tail = max(0, $len-10);
		  $trunk = substr($str, 0, $tail);
		  $trunk .= strrev(preg_replace('~^..+?[\s,:]\b|^...~', '...', strrev(substr($str, $tail, $len-$tail))));
		  return $trunk;
	}
}



	