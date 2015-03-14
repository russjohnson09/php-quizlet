<?php

class TableCreateController extends BaseController {
	
	public function index()
	{		
		$errorMsg = '';
		return View::make('table.create', array('tables' => $this->getTables(),
				'errorMsg' => $errorMsg
		));
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
							
		return View::make('table.create',array('tableName' => $tableName,
				'tables' => $this->getTables(),
				'errorMsg' => $errorMsg
		));
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
	
	private function getTables()
	{
		$pdo = DB::connection()->getPdo();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$stmt = $pdo->prepare('SHOW TABLES');
		
		$stmt->execute();
		
		$tables = array();
		
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $t) {
			foreach($t as $key => $val) {
				$tables[] = $val;
			}
		}
		return $tables;
	}
}
