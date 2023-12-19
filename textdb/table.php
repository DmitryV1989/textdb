<? 
class Table {

	public string $tableFolder; 

	public array $structure;

	public function Create($item) {
		// проверка структуры 
		foreach ($this->structure as $key) {
			if($key == "created_at") $item[$key] = date('Y-m-d H:i:s');
			$readyItem[$key] = $item[$key] ?? "";
		}
		// выяснить последний id
        $id = count(scandir($this->path()))==2 ? 1 : pathinfo(end(scandir($this->path())),PATHINFO_FILENAME) + 1 ;
        // substr(end(scandir($this->path())),0,-4) + 1 ;

        // создание записи
        file_put_contents($this->path($id), serialize($readyItem));

        // результат
        return $readyItem;

	}

	/*
	 если вызвать метод без аргуметов вернёт все значения текущей таблицы, если передать значение типа int, вернёт одну запись с этим id
	Read(0) - все записи
	Read(1) - 1-я запись
	Read([4,7]) - 4-я и 7-я запись
	Read(0,['name'=>'Dmitry']) - все записи с ['name'=>'Dmitry']

	TODO: 3-й аргумент будет задавать по возрастанию или по убыванию извлекать записи, ориентируясь на индекс вложенного массива "1,2,3" или "3,2,1"
	образец SELECT * FROM `patient` ORDER BY id DESC;
	аргумент должен выглядеть как DESC (обратный) или ASC (по возрастанию)
	ASC - значение по умолчанию

	TODO: нужно ликвидировать порядок "1,10,2,3,4", записи должны выводится вот так: "1,2,3,4,...,10"
	
	*/
/*
	public function Read($id = 0) { // TODO: второй параметр принимает уточняющее значение для поиска записей (пример: Read(0, ['name'=>'test2']), нужно получить все записи с ['name'=>'test2']) 
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
			$file_id = pathinfo($file,PATHINFO_FILENAME);
			$readyItem[$file_id] = array_merge(['id'=>$file_id],unserialize(file_get_contents($this->path($file_id))));

		}
		// результат
		return $readyItem;
	}
*/
		public function Read($id = 0, $filter_fields=[]) { // TODO: второй параметр принимает уточняющее значение для поиска записей (пример: Read(0, ['name'=>'test2']), нужно получить все записи с ['name'=>'test2']) 

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
		return $readyItem;
	}

	public function Update($id, $arFields) {


			$former = unserialize(file_get_contents($this->path($id)));
            // p($first);
            $new = array_replace($this->ReadOne($id), $arFields);
            // p($new );
            file_put_contents($this->path($id),serialize($new));
            return $new;

	}

	public function Delete($id) {
		return unlink($this->path($id));
	}

	// формирование пути к "папке-таблице"

	protected function path($id = 0) {

		global $TEXTDB;

		return $TEXTDB['path']."/data/".$this->tableFolder."/".($id ? $id.".txt" : "");
	}

	public function ReadOne($id) {
		return $this->read($id)[$id];
	}

}
