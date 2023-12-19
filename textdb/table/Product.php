<?
class Product extends Table {

	public string $tableFolder = __CLASS__; 

	public array $structure = [
		'name',
		'created_at'
	];

}