<?php
	
	namespace App\Tests;
	
	use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
	
	/**
	 * To launch tests:
	 *
	 * $ php bin/phpunit tests/HomeControllerTest.php
	 */
	class HomeControllerTest extends WebTestCase
	{
		/**
		 *
		 * Small reminder : dataProvider take data from a function to put them in the params ($url here)
		 * @dataProvider getUrl
		 * @param string $httpMethod
		 * @param string $url
		 */
		public function testUrl(string $httpMethod, string $url): void
		{
			$client = static::createClient();
			$client->request($httpMethod, $url);
			
			$this->assertResponseIsSuccessful(sprintf('URL loads correctly', $url));
		}

		public function getUrl(): ?\Generator
		{
			yield ['GET', '/'];
		}
	}