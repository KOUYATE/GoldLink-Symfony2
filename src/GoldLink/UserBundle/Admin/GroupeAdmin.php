<?php
/**
 * Created by PhpStorm.
 * User: kouyate
 * Date: 21/03/14
 * Time: 00:36
 */

namespace GoldLink\UserBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;



class GroupeAdmin extends Admin{

    protected $dataGridValues = array(
        '_sort_order'  => 'DESC',
        '_sort_by'     => 'dateCreation'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nomDuGroupe')
            ->add('description')
            ->add('droit')
            ->add('administrateur');
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nomDuGroupe')
            ->add('description')
            ->add('droit')

        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nomDuGroupe')
            ->add('description')
            ->add('dateCreation')
            ->add('administrateur')
            ->add('droit')
            ->add('id')
        ;
    }
} 