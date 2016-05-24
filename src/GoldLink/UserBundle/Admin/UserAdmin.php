<?php
/**
 * Created by PhpStorm.
 * User: kouyate
 * Date: 21/03/14
 * Time: 00:03
 */

namespace GoldLink\UserBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;



class UserAdmin extends Admin {
    protected $dataGridValues = array(
        '_sort_order'  => 'DESC',
        '_sort_by'     => 'username'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('email')
            ->add('username')
            ->add('password')
            ->add('roles')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('email')
            ->add('username')
            ->add('roles')

        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('email')
            ->add('username')
            ->add('roles')
            ->add('id')
        ;
    }
} 