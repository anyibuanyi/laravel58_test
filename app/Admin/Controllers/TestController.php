<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Model\TestModel;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class TestController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('测试列表')
            ->description('哈哈哈哈哈')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('测试详情')
            ->description('啦啦啦啦')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('新增')
            ->description('新增测试')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TestModel());

        $grid->id('ID')->sortable();
        $grid->created_at('创建时间');
        $grid->updated_at('修改时间');
        $grid->name('姓名');
        $grid->phone('电话');
        $grid->test()->gaga('gaga');
        $grid->filter(function(Grid\Filter $filter){
            $filter->like('name', '标题');
            $filter->equal('phone', '电话');
        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(TestModel::findOrFail($id));

        $show->id('ID');
        $show->created_at('创建时间');
        $show->updated_at('修改时间');
        $show->name('姓名');
        $show->test()->gaga('gaga');
        $show->phone('电话');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TestModel);

        $form->text('name', '姓名')->rules('required');
        $form->text('phone', '电话')->rules('required');
        $form->display('id', 'ID');
        $form->display('gaga', 'gaga');
        $form->display('created_at', '创建时间');
        $form->display('updated_at', '修改时间');


        return $form;
    }
}
