<?php

namespace App\Http\Controllers\Admin\Crm;

use App\CrmCourse;
use App\Extensions\AdminForm;
use App\Extensions\AdminForms\InputDate;
use App\Extensions\AdminForms\InputText;
use App\Extensions\AdminForms\InputTextarea;
use App\Extensions\AdminTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Crm\AddCourseRequest;
use App\Http\Requests\Admin\Crm\EditCourseRequest;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index(Request $request)
    {
        $data = CrmCourse::getAllPaginated($request);

        $table = new AdminTable($data, [
            'id' => 'Id',
            'name' => 'Nazwa',
            'start_date' => 'Data rozpoczęcia',
            'end_date' => 'Data zakończenia',
            'created_at' => 'Data dodania',
        ], 'Lista kursów', '/admin/crm/courses', true);

        return view('admin.crm.courses.index', compact('table'));
    }

    public function getAdd(Request $request)
    {
        $form = new AdminForm();
        $form->add(new InputText('name', 'Nazwa kursu', $request->old('name', '') ?? ''));
        $form->add(new InputDate('start_date', 'Data rozpoczęcia kursu', $request->old('start_date', '') ?? ''));
        $form->add(new InputDate('end_date', 'Data zakończenia kursu', $request->old('end_date', '') ?? ''));
        $form->add(new InputTextarea('info', 'Informacje', $request->old('info', '') ?? ''));
        $form->addButtons();

        $url = action('Admin\Crm\CoursesController@postAdd');

        return view('admin.crm.courses.form', compact('form', 'url'));
    }

    public function postAdd(AddCourseRequest $request)
    {
        $data = $request->all();

        CrmCourse::create($data);

        $request->session()->flash('info', 'Kurs został dodany!');

        return redirect(action('Admin\Crm\CoursesController@index'));
    }

    public function getEdit(Request $request, $id)
    {
        $entity = CrmCourse::findOrFail($id);

        $form = new AdminForm();
        $form->add(new InputText('name', 'Nazwa kursu', $request->old('name', $entity->name) ?? $entity->name));
        $form->add(new InputDate('start_date', 'Data rozpoczęcia kursu', $request->old('start_date', $entity->start_date) ?? $entity->start_date));
        $form->add(new InputDate('end_date', 'Data zakończenia kursu', $request->old('end_date', $entity->end_date) ?? $entity->end_date));
        $form->add(new InputTextarea('info', 'Informacje', $request->old('info', $entity->info) ?? $entity->info));
        $form->addButtons();

        $url = action('Admin\Crm\CoursesController@postEdit', [
            'id' => $entity
        ]);

        $deleteUrl = action('Admin\Crm\CoursesController@postDelete', [
            'id' => $entity
        ]);

        $clientsUrl = action('Admin\Crm\ClientCoursesController@getClients', [
            'course' => $entity
        ]);

        return view('admin.crm.courses.form', compact('form', 'url', 'deleteUrl', 'clientsUrl'));
    }

    public function postEdit(EditCourseRequest $request, $id)
    {
        $data = $request->all();

        $entity = CrmCourse::findOrFail($id);
        $entity->fill($data);
        $entity->save();

        $request->session()->flash('info', 'Kurs został zaktualizowany!');

        return redirect(action('Admin\Crm\CoursesController@index'));
    }

    public function postDelete(Request $request, $id)
    {
        CrmCourse::findOrFail($id)->delete();

        $request->session()->flash('info', 'Kurs został usunięty!');

        return redirect(action('Admin\Crm\CoursesController@index'));
    }
}
