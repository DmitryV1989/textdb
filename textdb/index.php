<?
$TEXTDB['path'] = $_SERVER['DOCUMENT_ROOT']."/textdb";
// TODO: проверить все пути и работоспособность
class textdb {

    public string $path = "/textdb"; 

    public function __construct(){
        global $TEXTDB;
        // $this->path = $_SERVER['DOCUMENT_ROOT'].$this->path;
        require_once($TEXTDB['path']."/function.php");
        require_once($TEXTDB['path']."/table.php");
        // подключение классов-таблиц автоматически
        foreach (scandir($TEXTDB['path']."/table") as $file) {
            if(is_dir($file)) continue; // пропускаем ".", ".."
            require_once($TEXTDB['path']."/table/".$file);
            $name = pathinfo($file,PATHINFO_FILENAME);
            $TEXTDB[$name] = new $name;
        }
    }

    public function MakeTable($name,$structure) { 
        $status = [];
        # создание папки-таблицы
        $status['folder']  =  @mkdir($_SERVER['DOCUMENT_ROOT']."/data/$name");
        # создание класса-таблицы
        $class_file = file_get_contents($_SERVER['DOCUMENT_ROOT']."/newClass.example");
        // подстановка имени класса
        $class_file = str_replace("@class@", $name, $class_file);
        //подстановка структуры таблицы
        $new_Structure = "'".implode("','",$structure)."'";
        $class_file = str_replace("@array@",$new_Structure,$class_file);
        // формирование файл класса-таблицы
        $status['class'] = (bool)file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/".$name.".php",$class_file);
        # отчёт
        $status['message'] = $status['folder']?"Папка-таблица успешно создана":"Ошибка создания папки-таблицы";
        $status['message'].= $status['class']?"Файл создан":"Ошибка создания файла";

        return $status;
    }

}    


$text = new textdb;

