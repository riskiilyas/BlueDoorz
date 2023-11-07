<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Reservation;

class ReservationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Reservation';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Reservation());

        $grid->column('id', __('Id'));
        $grid->column('checkin', __('Checkin'));
        $grid->column('checkout', __('Checkout'));
        $grid->column('room_id', __('Room id'));
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
        $show = new Show(Reservation::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('checkin', __('Checkin'));
        $show->field('checkout', __('Checkout'));
        $show->field('room_id', __('Room id'));
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
        $form = new Form(new Reservation());

        $form->date('checkin', __('Checkin'))->default(date('Y-m-d'));
        $form->date('checkout', __('Checkout'))->default(date('Y-m-d'));
        $form->number('room_id', __('Room id'));
        $form->number('user_id', __('User id'));

        return $form;
    }
}
