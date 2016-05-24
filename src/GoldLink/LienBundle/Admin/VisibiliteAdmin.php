<?php
/**
 * Created by PhpStorm.
 * User: kouyate
 * Date: 19/03/14
 * Time: 21:28
 */

namespace GoldLink\LienBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;


class VisibiliteAdmin extends Admin {
    protected $dataGridValues = array(
        '_sort_order'  => 'DESC',
        '_sort_by'     => 'libelle'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('libelle')


        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('libelle')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('libelle')
            ->add('id')
        ;
    }
} 