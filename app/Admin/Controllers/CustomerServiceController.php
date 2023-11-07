<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\CustomerService;

class CustomerServiceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'CustomerService';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CustomerService());

        $grid->column('id', __('Id'));
        $grid->column('description', __('Description'));
        $grid->column('image_path', __('Image path'));
        $grid->column('response', __('Response'));
        $grid->column('user_id', __('User id'));
        $grid->column('reservation_id', __('Reservation id'));
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
        $show = new Show(CustomerService::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('description', __('Description'));
        $show->field('image_path', __('Image path'));
        $show->field('response', __('Response'));
        $show->field('user_id', __('User id'));
        $show->field('reservation_id', __('Reservation id'));
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
        $form = new Form(new CustomerService());

        $form->textarea('description', __('Description'));
        $form->text('image_path', __('Image path'));
        $form->text('response', __('Response'));
        $form->number('user_id', __('User id'));
        $form->number('reservation_id', __('Reservation id'));

        return $form;
    }
}
