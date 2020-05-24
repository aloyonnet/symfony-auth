<?php
	
	namespace App\Tests;
	
	use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
	use Symfony\Component\HttpFoundation\Response;
	
	/**
	 * To launch tests:
	 *
	 * $ php bin/phpunit tests/AdminControllerTest.php
	 */
	class AdminControllerTest extends WebTestCase
	{
		/**
		 * @dataProvider getUrl
		 * @param string $httpMethod
		 * @param string $url
		 */
		public function testAccessForUser(string $httpMethod, string $url): void
		{
			$client = static::createClient([], [
				'PHP_AUTH_USER' => 'normal_user',
				'PHP_AUTH_PW' => 'test',
			]);
			
			$client->request($httpMethod, $url);
			
			/**
			 * because user is logged, he is not redirected and so, see
			 * a denied access page
			 */
			$this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
		}
		
		public function getUrl(): ?\Generator
		{
			yield ['GET', '/admin'];
		}
		
		/**
		 * @dataProvider getUrl
		 * @param string $httpMethod
		 * @param string $url
		 */
		public function testAccessForAno(string $httpMethod, string $url): void
		{
			$client = static::createClient();
			$client->request($httpMethod, $url);
			
			/**
			 * if you are redirected, it is because access was refused, so you go
			 * to the login page
			 */
			$this->assertResponseRedirects(
				'http://localhost/login',
				Response::HTTP_FOUND,
				sprintf('An anonymous user is redirected correctly', $url)
			);
		}
	}
