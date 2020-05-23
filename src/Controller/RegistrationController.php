<?php
	
	namespace App\Controller;
	
	use App\Entity\User;
	use App\Form\RegistrationFormType;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\Security\Core\Security;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
	
	class RegistrationController extends AbstractController
	{
		
		/**
		 * @Route("/register", name="app_register")
		 * @param Request $request
		 * @param Security $security
		 * @param UserPasswordEncoderInterface $passwordEncoder
		 * @return Response
		 */
		public function register(Request $request, Security $security, UserPasswordEncoderInterface $passwordEncoder): Response
		{
			
			if ($security->isGranted('ROLE_USER')) {
				return $this->redirectToRoute('home');
			}
			
			$user = new User();
			$form = $this->createForm(RegistrationFormType::class, $user);
			$form->handleRequest($request);
			
			if ($form->isSubmitted()) {
				if($form->isValid()) {
					$user->setPassword(
						$passwordEncoder->encodePassword(
							$user,
							$form->get('plainPassword')->getData()
						)
					);
					
					$user->setUsername(preg_replace('/\s+/', '', $form->get('username')->getData()));
					
					$entityManager = $this->getDoctrine()->getManager();
					$entityManager->persist($user);
					$entityManager->flush();
					
					
					return $this->redirectToRoute('app_login');
				}
			}
			
			return $this->render('security/register.html.twig', [
				'registrationForm' => $form->createView(),
			]);
		}
	}