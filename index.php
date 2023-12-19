<?
require_once($_SERVER['DOCUMENT_ROOT']."/textdb/index.php");
p($TEXTDB['Product']->create(['name'=>'Natali']));
// p($TEXTDB['Product']->Update());
// p($TEXTDB['Product']->Read([2,3]));
// p($TEXTDB['Product']->ReadOne(1));
// p($TEXTDB['Product']->Delete());



// require_once($_SERVER['DOCUMENT_ROOT']."/product.php");	 
  
// $product = new Product;
// // p($product->tableFolder);
// $array1 = ['name'=>'Ivan','created_at'=>1];
// $array2 = ['name'=>'Nataly','created_at'=>2];
// $array3 = ['name'=>'Dmitry','created_at'=>3];
// $array4 = ['name'=>'Helen','created_at'=>4];
// $array5 = ['name'=>'John','created_at'=>5];
// $new_Array = ['name'=>'John'];

// // p(array_key_first($product->read(1)));
// // p($product->read(1)[array_key_first($product->read(1))]);
// // p($product->ReadOne(2));
// // p($product->create($array5));
// // p($product->update(2,$new_Array));
// // p($product->path(1));
// p($product->Read(2));
// // p(array_key_exists('name', $array),'vd');

// // foreach ($array as $key ) {
// // 	p($key);
// // }
// // p($product->delete(1));