<?php

namespace PhpSpec\Symfony2Extension\CodeGenerator;

use PhpSpec\CodeGenerator\Generator\SpecificationGenerator;
use PhpSpec\Locator\ResourceInterface;
use PhpSpec\Symfony2Extension\Locator\ControllerResource;
use Prophecy\Argument;

class ControllerSpecificationGenerator extends SpecificationGenerator
{
    /**
     * @param ResourceInterface $resource
     * @param string            $generation
     * @param array             $data
     *
     * @return boolean
     */
    public function supports(ResourceInterface $resource, $generation, array $data)
    {
        return 'specification' === $generation && $resource instanceof ControllerResource;
    }

    /**
     * @return integer
     */
    public function getPriority()
    {
        return 10;
    }

    /**
     * @return string
     */
    protected function getTemplate()
    {
        return file_get_contents(__FILE__, null, null, __COMPILER_HALT_OFFSET__);
    }
}
__halt_compiler();<?php

namespace %namespace%;

use PhpSpec\Symfony2Extension\Specification\ControllerBehavior;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Prophecy\Argument;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Routing\Router;

/**
 * @mixin \%subject%
 */
class %name% extends ControllerBehavior
{
    function let(Registry $doctrine, SecurityContext $securityContext, EntityRepository $repository,
                 TokenInterface $token, UserInterface $user, EntityManager $entityManager, Request $request,
                 FormFactory $formFactory, FormBuilder $formBuilder, Form $form, FormView $formView,
                 Router $router, TwigEngine $templating, Response $response)
    {
        $this->letController(
            $doctrine, $securityContext, $repository, $token, $user, $entityManager, $request,
            $formFactory, $formBuilder, $form, $formView, $router, $templating, $response
        );
    }

    function it_is_container_aware()
    {
        $this->shouldHaveType('Symfony\Component\DependencyInjection\ContainerAwareInterface');
    }
}
