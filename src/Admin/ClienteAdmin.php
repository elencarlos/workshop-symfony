<?php


namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class ClienteAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form->add('nome');
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->add('nome')
            ->add('_action',null, [
                'actions'=> [
                    'show' => [],
                    'edit' => [],
                    'delete'=> []
                ]
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('nome');
    }

    protected function configureShowFields(ShowMapper $show)
    {
        $show->add('nome');
    }

}