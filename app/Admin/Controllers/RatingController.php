<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Rating;

class RatingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Rating';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Rating());

        $grid->column('id', __('Id'));
        $grid->column('rating', __('Rating'));
        $grid->column('comment', __('Comment'));
        $grid->column('reservation_id', __('Reservation id'));
        $grid->column('user_id', __('User id'));
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
        $show = new Show(Rating::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('rating', __('Rating'));
        $show->field('comment', __('Comment'));
        $show->field('reservation_id', __('Reservation id'));
        $show->field('user_id', __('User id'));
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
        $form = new Form(new Rating());

        $form->number('rating', __('Rating'));
        $form->textarea('comment', __('Comment'));
        $form->number('reservation_id', __('Reservation id'));
        $form->number('user_id', __('User id'));

        return $form;
    }
}
