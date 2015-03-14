<?php

class TableCreateController extends BaseController {
	
	public function index()
	{		
		return View::make('table.create', array('tables' => $this->getTables()));
	}
	
	public function create()
	{
		$rules = array(
				'tableName' => 'required|alpha_num',
		);
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::action('TableCreateController@index')
			->withErrors($validator);
		}
		
		$tableName = Input::get('tableName');
		
		$pdo = DB::connection()->getPdo();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$stmt = $pdo->prepare("CREATE TABLE `{$tableName}` (
								id INT,
							    PRIMARY KEY (id)
							);");
		
		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		
		//echo print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
		//echo print_r($pdo->errorInfo());
		//$stmt->execute();
		
		//echo $pdo->getAttribute(PDO::ATTR_SERVER_INFO);
		
		//$stmt = $pdo->prepare('SELECT DATABASE();');
		//$stmt->execute();
		
		//echo print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
		
				
		return View::make('table.create',array('tableName' => $tableName,
				'tables' => $this->getTables()
		));
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
