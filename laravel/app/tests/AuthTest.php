<?php

class AuthTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$crawler = $this->client->request('POST', '/authtest');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

}
