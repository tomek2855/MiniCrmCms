<?php

namespace App\Http\Controllers\Admin;

use App\Extensions\AdminForm;
use App\Extensions\AdminForms\InputText;
use App\Extensions\AdminForms\InputTextarea;
use App\Extensions\AdminForms\Raw;
use App\Extensions\AdminTable;
use App\FormContact;
use App\FormCourse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    public function getContacts(Request $request)
    {
        $data = FormContact::getAllPaginated($request);

        $table = new AdminTable($data, [
            'name' => 'Imię i nazwisko',
            'email' => 'Adres email',
            'created_at' => 'Data wysłania'
        ], '', '/admin/forms/contacts');

        return view('admin.forms.index-contacts', compact('table'));
    }

    public function getContact($id)
    {
        $entity = FormContact::findOrFail($id);

        $form = new AdminForm();
        $form->add(new InputText('', 'Imię i nazwisko', $entity->name));
        $form->add(new InputText('', 'Email', $entity->email));
        $form->add(new InputTextarea('', 'Treść', $entity->content));
        $form->add(new InputText('', 'Data przesłania', $entity->created_at));
        $form->add(new InputText('', 'IP', $entity->ip));

        return view('admin.forms.details-contact', compact('form'));
    }

    public function getCourses(Request $request)
    {
        $data = FormCourse::getAllPaginated($request);
        $links = $data->links();

        $data = $data->map(function ($item) {
            $item->name = $item->getFullName();
            return $item;
        });

        $table = new AdminTable($data, [
            'name' => 'Imię i nazwisko',
            'email' => 'Adres email',
            'created_at' => 'Data wysłania'
        ], '', '/admin/forms/courses');

        $table->links = $links;

        return view('admin.forms.index-courses', compact('table'));
    }

    public function getCourse($id)
    {
        $entity = FormCourse::findOrFail($id);

        $form = new AdminForm();
        $form->add(new InputText('', 'Imię', $entity->first_name));
        $form->add(new InputText('', 'Nazwisko', $entity->last_name));
        $form->add(new InputText('', 'Email', $entity->email));
        $form->add(new InputText('', 'Numer', $entity->number));
        $form->add(new InputText('', 'PESEL', $entity->pesel));
        $form->add(new Raw('admin.forms.course-pesel', $entity));

        $form->add(new InputText('', 'Numer domu', $entity->address_number));
        $form->add(new InputText('', 'Ulica', $entity->address_street));
        $form->add(new InputText('', 'Miasto', $entity->address_city));
        $form->add(new InputText('', 'Kod pocztowy', $entity->address_zipcode));

        $form->add(new InputText('', 'Nazwa kursu', $entity->course->name));
        $form->add(new InputText('', 'Data przesłania', $entity->created_at));
        $form->add(new InputText('', 'IP', $entity->ip));

        return view('admin.forms.details-course', compact('form'));
    }
}
