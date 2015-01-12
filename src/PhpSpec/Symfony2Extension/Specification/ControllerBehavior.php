<?php

namespace PhpSpec\Symfony2Extension\Specification;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use PhpSpec\ObjectBehavior;
use PhpSpec\Wrapper\Subject;
use Prophecy\Argument;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\User\UserInterface;

class ControllerBehavior extends ObjectBehavior
{
    function letController(Registry $doctrine, SecurityContext $securityContext, EntityRepository $repository,
                           TokenInterface $token, UserInterface $user, EntityManager $entityManager, Request $request,
                           FormFactory $formFactory, FormBuilder $formBuilder, Form $form, FormView $formView,
                           Router $router, TwigEngine $templating, Response $response)
    {
        $router->generate(Argument::cetera())->willReturn('test_url');

        $formFactory->createBuilder(Argument::cetera())->willReturn($formBuilder);
        $formBuilder->getForm(Argument::cetera())->willReturn($form);
        $formFactory->create(Argument::cetera())->willReturn($form);
        $form->createView()->willReturn($formView);

        $doctrine->getManager()->willReturn($entityManager);
        $doctrine->getRepository(Argument::any())->willReturn($repository);
        $entityManager->getRepository(Argument::any())->willReturn($repository);

        $token->getUser()->willReturn($user);
        $securityContext->getToken()->willReturn($token);

        $templating->renderResponse(Argument::cetera())->willReturn($response);

        $this->container->has('security.token_storage')->willReturn(true);
        $this->container->get('security.token_storage')->willReturn($securityContext);
        $this->container->has('doctrine')->willReturn(true);
        $this->container->get('doctrine')->willReturn($doctrine);
        $this->container->get('form.factory')->willReturn($formFactory);
        $this->container->get('request')->willReturn($request);
        $this->container->get('router')->willReturn($router);
        $this->container->get('templating')->willReturn($templating);
    }

    /**
     * @var ContainerInterface|null
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;

        $this->object->setContainer($container);
    }
}
