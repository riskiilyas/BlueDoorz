<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Room;

class RoomController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Room';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Room());

        $grid->column('id', __('Id'));
        $grid->column('number', __('Number'));
        $grid->column('type_id', __('Type id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('branch_address_id', __('Branch address id'));

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
        $show = new Show(Room::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('number', __('Number'));
        $show->field('type_id', __('Type id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('branch_address_id', __('Branch address id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Room());

        $form->text('number', __('Number'));
        $form->number('type_id', __('Type id'));
//        $form->belongsTo('type_id','room_types.id');
        $form->number('branch_address_id', __('Branch address id'));

        return $form;
    }
}
