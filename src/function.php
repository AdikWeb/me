<?
	add_shortcode('accordion', 'accordion');
	add_shortcode('slider', 'test');
	add_shortcode('test', 'test');

	function test(){
		return 'test';
	}

	$accRel = [];
	function accordion($o, $content, $data, $rel){
		global $tmeplate,$accRel;
		$accRel[] = $rel['rel']['accordion'];

		// $id = rand(0, 999999);
		// $cont = preg_replace("|[\s]+|s", ' ', $content);
		// $data = [
		// 	'title' => isset($o['title']) ? $o['title'] : 'Title',
		// 	'content' => $cont,
		// 	'id' => $id
		// ];
		// return $tmeplate->return_template('accordion.tpl',$data);
	}



	function printAr($accRel){
		echo '<pre>';
		print_r($accRel);
		echo '</pre>';
	}
