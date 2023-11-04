<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\BranchAddress;

class BranchAddressController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'BranchAddress';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BranchAddress());

        $grid->column('id', __('Id'));
        $grid->column('contact_branch', __('Contact branch'));
        $grid->column('street_address', __('Street address'));
        $grid->column('city', __('City'));
        $grid->column('state', __('State'));
        $grid->column('postal_code', __('Postal code'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(BranchAddress::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('contact_branch', __('Contact branch'));
        $show->field('street_address', __('Street address'));
        $show->field('city', __('City'));
        $show->field('state', __('State'));
        $show->field('postal_code', __('Postal code'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BranchAddress());

        $form->text('contact_branch', __('Contact branch'));
        $form->text('street_address', __('Street address'));
        $form->text('city', __('City'));
        $form->text('state', __('State'));
        $form->text('postal_code', __('Postal code'));

        return $form;
    }
}
