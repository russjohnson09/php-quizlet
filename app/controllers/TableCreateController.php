<?php

class TableCreateController extends BaseController {
	
	protected $defaults = array('tableName' => '');
	
	public function index()
	{		
		$tableName = Input::get('editTable');
		$rules = array(
				'tableName' => 'alpha_num',
		);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			App::abort(404);
		}
		$validator = Validator::make(Input::all(), $rules);
		$errorMsg = '';
		return View::make('table.create', 
				array_merge($this->defaults,
				array('tables' => $this->getTables($tableName),
				'errorMsg' => $errorMsg,
				'editTable' => $tableName,
		)));
	}
	
	public function create()
	{
		$errorMsg = '';
		$rules = array(
				'tableName' => 'required|alpha_num',
		);
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::action('TableCreateController@index')
			->withErrors($validator);
		}
		
		$tableName = Input::get('tableName');
		
		if (Input::has('Drop')) {
			$action = 'Drop';
			$errorMsg = $this->dropTable($tableName);
		}
		elseif (Input::has('Create')) {
			$action = 'Create';
			$errorMsg = $this->createTable($tableName);
		}
		elseif (Input::has('Add Integer')) {
			
		}
							
		return View::make('table.create',array_merge($this->defaults,
				array('tableName' => $tableName,
				'tables' => $this->getTables(),
				'errorMsg' => $errorMsg
		)));
	}
	
	private function createTable($tableName)
	{
		$errorMsg = '';
		$pdo = DB::connection()->getPdo();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		try {
			$stmt = $pdo->prepare("CREATE TABLE `{$tableName}` (
			id INT,
			PRIMARY KEY (id)
			);");
			$stmt->execute();
		}
		catch (Exception $e) {
			$errorMsg = $e->getMessage();
		}
		return $errorMsg;
	}
	
	private function dropTable($tableName)
	{
		$errorMsg = '';
		$pdo = DB::connection()->getPdo();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
		try {
			$stmt = $pdo->prepare("DROP TABLE `{$tableName}`;");
			$stmt->execute();
		}
		catch (Exception $e) {
			$errorMsg = $e->getMessage();
		}
		return $errorMsg;
	}
	
	private function getTables($editTable)
	{
		$pdo = DB::connection()->getPdo();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$stmt = $pdo->prepare('SHOW TABLES');
		
		$stmt->execute();
		
		$tables = array();
		
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $t) {
			foreach($t as $key => $val) {
				$tables[$val] = array('name' => $val);
			}
			if ($val == $editTable) {
				$tables[$val]['columns'] = $this->getColumns($val);
			}
		}
		return $tables;
	}
	
	private function getColumns($table)
	{
		$pdo = DB::connection()->getPdo();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$stmt = $pdo->prepare("DESCRIBE `{$table}`");
		
		$stmt->execute();
		
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
}
