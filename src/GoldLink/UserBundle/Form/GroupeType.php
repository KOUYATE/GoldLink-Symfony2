<?php

namespace GoldLink\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupeType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomDuGroupe','text',array('attr'=>array('class'=>'form-control')))
            ->add('description','textarea',array('attr'=>array('class'=>'form-control')))
            ->add('droit','choice', array('attr'=>array('class'=>'form-control'),
                'choices'   => array('public' => 'Public', 'prive' => 'Privé'),
                'required'  => true ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GoldLink\UserBundle\Entity\Groupe'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'goldlink_userbundle_groupe';
    }
}
