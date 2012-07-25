<?php
ob_start();
require_once 'CSRF_Protect.php';

class CSRF_ProtectTest extends PHPUnit_Framework_Testcase
{
	public function setUp() {}
	public function tearDown() {}
	
	public function testTokenValue()
	{
		$csrf1 = new CSRF_Protect();
		$this->assertTrue($csrf1->getToken() !== '');
	}
	
	public function testTokenEquality()
	{
		$csrf1 = new CSRF_Protect();
		$csrf2 = new CSRF_Protect();
		
		$this->assertTrue($csrf1->getToken() === $csrf2->getToken());
	}
	
	public function testVerifyTrue()
	{
		$csrf1 = new CSRF_Protect();
		$token = $csrf1->getToken();
		
		$this->assertTrue($csrf1->isTokenValid($token));
	}
	
	public function testVerifyFalse()
	{
		$csrf1 = new CSRF_Protect();
		$token = $csrf1->getToken();
		
		$this->assertFalse($csrf1->isTokenValid('abcd'));
		$this->assertFalse($csrf1->isTokenValid($token . ' '));
	}
	
	public function testTokenUniqueness()
	{
		$csrf1 = new CSRF_Protect();
		$token1 = $csrf1->getToken();
		session_destroy();
		session_start();
		
		$csrf2 = new CSRF_Protect();
		$csrf2 = $csrf2->getToken();
		
		$this->assertTrue($csrf1 !== $csrf2);
	}
}