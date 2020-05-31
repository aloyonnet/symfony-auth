<?php
	namespace App\DataFixtures;
	
	use App\Entity\User;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\Common\Persistence\ObjectManager;
	use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
	
	
	/**
	 * We will generate fake users to simulate the different possibilities linked to them
	 * like user or admin
	 *
	 * how to use this :
	 * use the command : php bin/console doctrine:fixtures:load
	 */
	class AppFixtures extends Fixture
	{
		/**
		 * @var UserPasswordEncoderInterface
		 */
		private $passwordEncoder;
		
		/**
		 * AppFixtures constructor.
		 * @param UserPasswordEncoderInterface $passwordEncoder
		 */
		public function __construct(UserPasswordEncoderInterface $passwordEncoder)
		{
			$this->passwordEncoder = $passwordEncoder;
		}
		
		/**
		 * @param ObjectManager $manager
		 */
		public function load(ObjectManager $manager): void
		{
			$this->loadUsers($manager);
		}
		
		/**
		 * @param ObjectManager $manager
		 */
		private function loadUsers(ObjectManager $manager): void
		{
			foreach ($this->getUserData() as [$username, $firstname, $lastname, $password, $email, $roles]) {
				$user = new User();
				$user->setUsername($username);
				$user->setFirstName($firstname);
				$user->setLastName($lastname);
				$user->setEmail($email);
				$user->setPassword($this->passwordEncoder->encodePassword($user, $password));
				$user->setRoles($roles);
				
				$manager->persist($user);
				$this->addReference($email, $user);
			}
			
			$manager->flush();
		}
		
		/**
		 * @return array|array[]
		 */
		private function getUserData(): array
		{
			return [
				// [$firstname, $lastname, $password, $email, $role];
				['normal_user', 'Normal', 'User', 'test', 'user@user.com', ['ROLE_USER']],
				['admin_user', 'Admin', 'User', 'test', 'admin@admin.com', ['ROLE_ADMIN']],
			];
		}
		
	}