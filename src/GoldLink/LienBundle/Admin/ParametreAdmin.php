<?php
/**
 * Created by PhpStorm.
 * User: kouyate
 * Date: 19/03/14
 * Time: 14:58
 */

namespace GoldLink\LienBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;


class ParametreAdmin extends Admin{
    protected $dataGridValues = array(
        '_sort_order'  => 'DESC',
        '_sort_by'     => 'noteMaximale'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nombreDeVotant')
            ->add('nombreDePartage')
            ->add('noteMaximale')

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nombreDeVotant')
            ->add('nombreDePartage')
            ->add('noteMaximale')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nombreDeVotant')
            ->add('nombreDePartage')
            ->add('noteMaximale')
            ->add('id')
        ;
    }
} 