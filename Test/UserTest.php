<?php
namespace socialnet;
require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR .'autoload.php';
include ("src\includes\classes\User.php");

use PHPUnit\Framework\TestCase;
use User;

class ReceiptTest extends TestCase {

	private $db_host;
	private $db_user;
	private $db_pass;
	private $db_name;
	private $con;

	protected function setUp()
	{
		$this->db_host = "localhost"; // Database host
		$this->db_user = "root"; // Database user
		$this->db_pass = ""; // Database password
		$this->db_name = "socialnet"; // Database name
		$this->con = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name); //Connection variable

		if(mysqli_connect_errno()) 
		{
			echo "Failed to connect: " . mysqli_connect_errno();
		}

	}

	public function testUserName() {
		$user = new User($this->con , 'Purrinya_Purrinya');

		$this->assertEquals(
			'purrinya_purrinya',
			$user->getUsername(),
			'User Test'
		);

		$this->assertNotEquals(
			'puzzjn_puzzjn',
			$user->getUsername(),
			'User Test'
		);
	}

	public function testgetNumberOfFriendRequests() {
		$user = new User($this->con , 'ha_pham');

		$this->assertEquals(
			1,
			$user->getNumberOfFriendRequests(),
			'Friend Request Test'
		);

		$this->assertNotEquals(
			0,
			$user->getNumberOfFriendRequests(),
			'Friend Request Test'
		);
	}

	public function testgetNumPosts() {
		$user = new User($this->con , 'puzzjn_puzzjn');

		$this->assertEquals(
			2,
			$user->getNumPosts(),
			'Num Post Test'
		);

		$this->assertNotEquals(
			3,
			$user->getNumPosts(),
			'Num Post Test'
		);
	}

	public function testgetFirstAndLastName() {
		$user = new User($this->con , 'puzzjn_puzzjn');

		$this->assertEquals(
			'Puzzjn Puzzjn',
			$user->getFirstAndLastName(),
			'F L Name Test'
		);

		$this->assertNotEquals(
			'ASDADSDASDASDADAS',
			$user->getFirstAndLastName(),
			'F L Name Test'
		);
	}

	public function testgetProfilePic() {
		$user = new User($this->con , 'puzzjn_puzzjn');

		$this->assertEquals(
			'assets/images/profile_pics/defaults/head_emerald.png',
			$user->getProfilePic(),
			'Profile Pic Test'
		);

		$this->assertEquals(
			'assets/images/profile_pics/defaults/head_emerald.png',
			$user->getProfilePic(),
			'Profile Pic Test'
		);
	}

	public function testgetFriendArray() {
		$user = new User($this->con , 'puzzjn_puzzjn');

		$this->assertEquals(
			',purrinya_purrinya,',
			$user->getFriendArray(),
			'Friend ListTest'
		);

		$this->assertNotEquals(
			',ha_pham,',
			$user->getFriendArray(),
			'Friend ListTest'
		);
	}

	public function testisClosed() {
		$user = new User($this->con , 'puzzjn_puzzjn');

		$this->assertEquals(
			False,
			$user->isClosed(),
			'Is Closed Test'
		);

		$this->assertNotEquals(
			True,
			$user->isClosed(),
			'Is Closed Test'
		);
	}

	public function testisFriend() {
		$user = new User($this->con , 'puzzjn_puzzjn');

		$this->assertEquals(
			True,
			$user->isFriend('purrinya_purrinya'),
			'Is Friend Test'
		);

		$this->assertNotEquals(
			True,
			$user->isFriend('Ha_Pham'),
			'Is Friend Test'
		);
	}
}