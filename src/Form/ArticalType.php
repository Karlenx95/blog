<?php

namespace App\Form;

use App\Entity\Artical;
use Doctrine\Common\Annotations\Annotation\NamedArgumentConstructor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('isEnabled')
            ->add('created')
            ->add('articalType', ChoiceType::class,[
                'choices'=>[
                    'Politics' => 'politics',
                    'Coronavirus' => 'coronavirus',
                    'Tech' => 'tech',
                    'World' => 'world'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Artical::class,
        ]);
    }
}
