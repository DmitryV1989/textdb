<?
define("CONFIG", [
    "DB"=>[
    	"server"=>"localhost",
    	"user"=>"root",
    	"password"=>"",
    	"name"=>"Doctor"
	]
]);

$sqlConnect = mysqli_connect(
    CONFIG['DB']['server'],
    CONFIG['DB']['user'],
    CONFIG['DB']['password'],
    CONFIG['DB']['name']
);

mysqli_set_charset($sqlConnect,'utf8');


function p($text) {
    echo "<pre style=\"white-space: pre-wrap; background:#fafafa;padding:10px;margin:10px 0;\">";
    print_r($text);
    echo "</pre>";
}



$sqlResult = mysqli_query($sqlConnect,"SELECT * FROM `patient` ORDER BY id DESC");
while($row = mysqli_fetch_assoc($sqlResult)) {
    $arPatient[$row['id']] = $row;
}
// p($arPatient);

// $fruits = array("d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple");
// asort($fruits);
// foreach ($fruits as $key => $val) {
//     p("$key = $val") ;
// }

/*
$arr=[5,8,11,2,4,9];
sort($arr);
foreach ($arr as $key=>$true) {
	p($key = $true);
}
p(sort($arr));
*/

/*
$a = [0,1,2,3];
p($a);
array_unshift($a, NULL);
unset($a[0]);

p($a);
*/

/*
$a = Array (
    1 => Array ( 'name' => 'Бананы', 'count' => 16 ),
    2 => Array ( 'name' => 'Груши', 'count' => 12 ),
    3 => Array ( 'name' => 'Яблоки', 'count' => 1 ),
    4 => Array ( 'name' => 'Апельсины', 'count' => 1 ),
    5 => Array ( 'name' => 'Мандарины', 'count' => 5 ),
);
function cmp($a, $b){
    return $a['count'] - $b['count'];
}
usort($a, 'cmp');

p($a);
*/

/*
$arr = array(5, 1, 4, 2, 8);
$size = sizeof($arr)-1;
for ($i = $size; $i>=0; $i--) {
  for ($j = 0; $j<=($i-1); $j++)
    if ($arr[$j]>$arr[$j+1]) {
      $k = $arr[$j];
      $arr[$j] = $arr[$j+1];
      $arr[$j+1] = $k;
    }
}
*/