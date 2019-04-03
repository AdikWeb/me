<?
/**
 *	нужно создать константу TRTPL к конечной папке с tpl
 */

// Был написан для одной штуки но я ее удалил. Но класс пусть будет. пригодится)
class pageLoad
{
	static $page_title = '';
	static $content = 'Not content';

	// Нужно для будущих нароботок
	static function content(){
		return self::$content;
	}
}

// Класс для шабика
class triviaTemplate extends pageLoad
{
	// массив с данными для шабика
	private $data = [];

	function __construct()
	{
		// Открываем буфер
		ob_start();
	}

	//инитим всю эту фигню
	public function templateInit($template_name,$opt = false){
		// Присваиваем путь к шаблончикам
		$template = TRTPL.$template_name;

		// Проверяем на существование файла
		if(file_exists($template)){
			// Если есть какие то аргументы
			if($opt){
				foreach ($opt as $key => $value) {
					$this->data[$key] = $value;
				}
			}			

			// открываем буфер для шабика
			ob_start();
			// инклюдим его
			include($template);
			// записываем в нужную переменную, очищаем и отключаем
			self::$content = ob_get_clean();

		}else{
			// Печаль, такого файла нет			
			self::$content = 'Not found:'.$template;
		}

		// Возвращаем контент
		return self::$content;
	}
	
	// Отобразить обработанный шаблон
	public function render_template($template_name,$opt = false){
		echo self::templateInit($template_name,$opt);
	}	
	
	// Вернуть обработанный шаблон
	public function return_template($template_name,$opt = false){
		return self::templateInit($template_name,$opt);
	}

	// Для обращения к принятым данным внутри шаблона $this->name будет $this->$data[name];
	// Ну ты понял крч
	public function __get($name) {
		if (isset($this->data[$name])) return $this->data[$name];
		return "";
	}
}

// Вывести содержимое буфера и очистить и отключить буфер (обыяно указывается в конце страницы)
function endRender(){
    $content = pageLoad::content();
    $content = shortCode(ob_get_clean());
    echo $content;
}

// Массив с шоркодами
$shortCodeArray = [];
$shortCodeRel = [];

function shorcodeRel(){
	
}

// Для добавления шоркода // add_shortcode(имя шорткода, имя функции которую он будет выполнять);
function add_shortcode($sh_name, $sh_function_name, $opt=false){
    global $shortCodeArray;   

    // Регулярка для поиска шорткода (htuekzhrb z cgbplbk :D )
    $patern = '/\['.$sh_name.'(\s.*?)?\](?:([^\[]+)?\[\/'.$sh_name.'\])?/mui';
    $shortCodeArray[$patern] = function($data) use ($sh_function_name, $opt){

    	global $shortCodeRel;
    	// Делим аргументы из шоркода и записываем их в $opt // [code id='1', count='2'];
    	if($data[1]){
	        foreach (explode(',', $data[1]) as  $value) {
	            list($key, $val) = explode('=',$value);

	            $shortCodeRel['rel'][$sh_function_name][] = $val;


	           	// Удаляем ковычки('') из шкода :D
	            $opt[preg_replace('/ /','',$key)] = preg_replace('/\'/','',$val);
	        }
        }

        // если есть что-то меж открывающим и закрывающим шкодом то записываем его в $opt['inCode']
        if(isset($data[2])){ $content = $data[2]; }
        
        // Возвращаяем все что собрали
        return $sh_function_name($opt,$content, $data, $shortCodeRel);
    };

}

// Ну тут понятно
function shortCode($content = false){
    global $shortCodeArray;
    if($rep = preg_replace_callback_array($shortCodeArray, $content)){
        return $rep;
    }
}

// Ну это, хз зачем. )
function do_shortCode($code){
	echo shortCode($code);
}



//ой, все понятно, не пизди) .......................чес сказать хз как это все вообще работает XD