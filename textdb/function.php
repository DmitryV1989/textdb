<?
function p($text, $flag = 'pr', $FILE = '', $LINE = '') {
    global $CORE;
    // если режим разработки выключен (DEV_MODE в значении ноль), то дебаг не будет работать
	echo "<pre style=\"white-space: pre-wrap; background:#ececec;padding:10px;margin:10px 0;\">";
    if(!empty($FILE) OR !empty($LINE)) {
        $line = !empty($LINE) ? " (строка: ".$LINE.")" : "";
        echo "<div style='background: #98c5f3; padding: 5px; margin-bottom: 5px;'>".$FILE.$line."</div>";                                    
    }
    switch ($flag) {
        case 'pr': print_r($text); break;
        case 'vd': var_dump($text); break;
    }
	echo "</pre>";
}