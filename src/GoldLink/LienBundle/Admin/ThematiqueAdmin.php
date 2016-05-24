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

class ThematiqueAdmin extends Admin{

    protected $dataGridValues = array(
        '_sort_order'  => 'DESC',
        '_sort_by'     => 'libelleThematique'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('libelleThematique')

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('libelleThematique')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('libelleThematique')
            ->add('id')
        ;
    }

} 