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


class Table {

	public function Read($id = 0, $filter_fields=[],$order='asc') { 

		// выясняем список записей к выводу
		if (is_array($id)) 
			$itemList = array_map(function ($n){
				return ($n.".txt");
			}, $id);
		else
			$itemList = $id ? [$id.".txt"] : scandir($this->path());

		// обрабатываем и накапливаем записи
		foreach($itemList as $file) {
			if(is_dir($file)) continue; // пропускаем ".", ".."
			// накапливаем имена записей
			$file_id = pathinfo($file,PATHINFO_FILENAME);
			// извлекаем записи
			$readyItem[$file_id] = array_merge(['id'=>$file_id],unserialize(file_get_contents($this->path($file_id))));
			// фильтруем записи по уточняющему значению
			if(!empty($filter_fields)) {
				foreach($filter_fields as $key => $value) {
					if($readyItem[$file_id][$key] != $value) {
						unset($readyItem[$file_id]);
					}
				}
			}
		}

		function inOrder($readyItem, $order) {
			return $readyItem['id'] - $order['id'];
		}
		usort($readyItem, 'inOrder');
		array_unshift($readyItem, NULL);
		unset($readyItem[0]);
		
		if($order=='desc') {
			return	array_reverse($readyItem,'true');
		}

		// p ($readyItem);
		return $readyItem;
	}

	protected function path($id = 0) {
		return $_SERVER['DOCUMENT_ROOT']."/test/".($id ? $id.".txt" : "");
	}

}

$Table = new Table;
// $test = $Table->Read(0,['name'=>'Dmitry']);
$test = $Table->Read();
p($test);
// p($test[10]['name']);

