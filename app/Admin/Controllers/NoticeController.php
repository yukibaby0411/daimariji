<?php

namespace App\Admin\Controllers;

use App\Models\Notice;

use App\Models\Notices_label;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class NoticeController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */

    public function index()
    {

        return Admin::content(function (Content $content) {

            $content->header('公告');
            $content->description('description');

            $content->body($this->grid());
        });

        //return view('notices.create');
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('公告');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('公告');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Notice::class, function (Grid $grid) {

            //$grid->id('ID')->sortable();
            $grid->id('ID');

            $grid->title('标题')->value(function($title) {
                return '<span style="display: inline-block; width: 100px;">'.$title.'</span>';
            });
            $grid->content('内容');

            $grid->notices_labels_id('标签')->value(function($notices_labels_id) {
                return '<span style=" display: inline-block; width: 40px;">'.Notices_label::find($notices_labels_id)->word.'</span>';
            });

            $grid->order('排序规则')->value(function($order) {
                if($order == 0) {
                    return '<span style="display: inline-block; width: 80px;">置顶预留</span>';
                }else {
                    return '<span style="display: inline-block; width: 80px;">正常显示</span>';
                }
            });
            $grid->created_at();

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        /*
        return Admin::form(Notice::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('title', '标题');
            $form->display('content', '内容');
        });
        */
        return Admin::form(Notice::class, function (Form $form) {

            // 显示记录id
            $form->display('id', 'ID');


            // 添加text类型的input框
            $form->radio('notices_labels_id', '标签')->values(['1' => '无标签', '2' => '置顶', '3' => '征集', '4' => '活动'])->default('1');

            $form->text('title', '标题');

            $form->textarea('content', '内容');

            // 两个时间显示
            $form->time('created_at', '创建时间');
        });

// 显示表单内容
        echo $form;

    }
}
