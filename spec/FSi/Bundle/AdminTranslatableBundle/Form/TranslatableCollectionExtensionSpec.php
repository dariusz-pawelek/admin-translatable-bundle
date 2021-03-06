<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\FSi\Bundle\AdminTranslatableBundle\Form;

use FSi\Bundle\AdminTranslatableBundle\Form\TranslatableCollectionListener;
use FSi\Bundle\AdminTranslatableBundle\Form\TranslatableFormHelper;
use FSi\Bundle\AdminTranslatableBundle\Form\TypeSolver;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

class TranslatableCollectionExtensionSpec extends ObjectBehavior
{
    public function let(
        TranslatableFormHelper $translatableFormHelper,
        TranslatableCollectionListener $listener
    ) {
        $this->beConstructedWith($translatableFormHelper, $listener);
    }

    public function it_is_form_extension()
    {
        $this->beAnInstanceOf(AbstractTypeExtension::class);
    }

    public function it_extends_collection()
    {
        $this->getExtendedType()->shouldReturn(TypeSolver::getFormType(
            CollectionType::class,
            'collection'
        ));
    }

    public function it_adds_listener(
        FormBuilderInterface $builder,
        TranslatableCollectionListener $listener
    ) {
        $builder->addEventSubscriber($listener)->shouldBeCalled();
        $this->buildForm($builder, []);
    }
}
