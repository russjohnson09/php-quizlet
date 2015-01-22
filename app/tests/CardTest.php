<?php

class CardTest extends TestCase {


	public function testRoutes()
	{
		$crawler = $this->client->request('GET','/');
		
		$this->assertTrue($this->client->getResponse()->isOk());
	}

}