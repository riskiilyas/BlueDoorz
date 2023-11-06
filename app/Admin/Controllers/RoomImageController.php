<?php

namespace App\Admin\Controllers;

use App\Models\BranchAddress;
use App\Models\Room;
use App\Models\RoomType;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\RoomImage;

class RoomImageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'RoomImage';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RoomImage());

        $grid->column('id', __('Id'));
        $grid->column('image_path', __('Image path'));
        $grid->column('room_id', __('Room id'));
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
        $show = new Show(RoomImage::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('image_path', __('Image path'));
        $show->field('room_id', __('Room id'));
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
        $form = new Form(new RoomImage());

//        $form->text('image_path', __('Image path'));
        $form->image('image_path', 'Room Image')->removable()->move('rooms');


        $roomsMap = [];
        foreach (Room::all() as $record) $roomsMap[$record->id] = $record->id.', '.$record->number;
        $form->select('room_id', __("Select Room"))->options($roomsMap);

        return $form;
    }
}
