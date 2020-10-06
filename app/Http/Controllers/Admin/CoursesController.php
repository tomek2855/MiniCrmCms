<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Extensions\AdminForm;
use App\Extensions\AdminForms\InputCheckbox;
use App\Extensions\AdminForms\InputHidden;
use App\Extensions\AdminForms\InputText;
use App\Extensions\AdminForms\InputTextarea;
use App\Extensions\AdminTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddCourseRequest;
use App\Http\Requests\Admin\EditCourseRequest;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index(Request $request)
    {
        $data = Course::getAllPaginated($request);

        $table = new AdminTable($data, [
            'id' => 'Id',
            'name' => 'Nazwa kursu',
            'bool|is_active' => 'Aktywny'
        ], 'Lista wszystkich kursów', '/admin/courses');

        return view('admin.courses.index', compact('table'));
    }

    public function getAdd(Request $request)
    {
        $form = new AdminForm();
        $form->add(new InputText('name', 'Nazwa kursu', $request->old('name', '') ?? ''));
        $form->add(new InputTextarea('description', 'Opis kursu', $request->old('description', '') ?? ''));
        $form->add(new InputCheckbox('is_active', 'Aktywny', $request->old('is_active', '') ?? ''));
        $form->addButtons();

        $url = action('Admin\CoursesController@postAdd');

        return view('admin.courses.form', compact('form', 'url'));
    }

    public function postAdd(AddCourseRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = $request->filled('is_active');

        Course::create($data);

        $request->session()->flash('info', 'Kurs został dodany!');

        return redirect(action('Admin\CoursesController@index'));
    }

    public function getEdit(Request $request, $id)
    {
        $entity = Course::findOrFail($id);

        $form = new AdminForm();
        $form->add(new InputText('name', 'Nazwa kursu', $request->old('name', $entity->name) ?? $entity->name));
        $form->add(new InputTextarea('description', 'Opis kursu', $request->old('description', $entity->description) ?? $entity->description));
        $form->add(new InputCheckbox('is_active', 'Aktywny', $request->old('is_active', $entity->is_active) ?? $entity->is_active));
        $form->addButtons();

        $url = action('Admin\CoursesController@postEdit', [
            'id' => $entity->id
        ]);

        $deleteUrl = action('Admin\CoursesController@postDelete', [
            'id' => $entity->id
        ]);

        return view('admin.courses.form', compact('form', 'url', 'deleteUrl'));
    }

    public function postEdit(EditCourseRequest $request, $id)
    {
        $data = $request->all();
        $data['is_active'] = $request->filled('is_active');

        $entity = Course::findOrFail($id);
        $entity->fill($data);
        $entity->save();

        $request->session()->flash('info', 'Kurs został zaktualizowany!');

        return redirect(action('Admin\CoursesController@index'));
    }

    public function postDelete(Request $request, $id)
    {
        Course::findOrFail($id)->delete();

        $request->session()->flash('info', 'Kurs został usunięty!');

        return redirect(action('Admin\CoursesController@index'));
    }
}
