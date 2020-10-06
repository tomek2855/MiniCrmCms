<?php

namespace App\Http\Controllers\Admin\Crm;

use App\CrmClient;
use App\Extensions\AdminForm;
use App\Extensions\AdminForms\InputDate;
use App\Extensions\AdminForms\InputRadio;
use App\Extensions\AdminForms\InputText;
use App\Extensions\AdminForms\InputTextarea;
use App\Extensions\AdminForms\Title;
use App\Extensions\AdminTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Crm\AddClientRequest;
use App\Http\Requests\Admin\Crm\EditClientRequest;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index(Request $request)
    {
        $data = CrmClient::getAllPaginated($request);

        $table = new AdminTable($data, [
            'id' => 'Id',
            'fun|full_name' => 'Imię i nazwisko',
            'email' => 'Adres email',
            'phone_number' => 'Numer telefonu',
            'fun|address' => 'Adres',
            'created_at' => 'Data dodania',
        ], 'Lista klientów', '/admin/crm/clients', true);

        $table->addFunction('full_name', function($i) {
            return $i->getFullName();
        });

        $table->addFunction('address', function($i) {
            $str = $i->address_city . ' ul.' . $i->address_street . ' ' . $i->address_house_number . ($i->address_apartment_number ? '/' . $i->address_apartment_number : '') . ', ' . $i->address_postal_code;
            return strlen($str) > 3 ? $str : '';
        });

        return view('admin.crm.clients.index', compact('table'));
    }

    public function getAdd(Request $request)
    {
        $form = new AdminForm();
        $form->add(new Title('Ogólne'));
        $form->add(new InputText('first_name', 'Imię', $request->old('first_name', '') ?? ''));
        $form->add(new InputText('last_name', 'Nazwisko', $request->old('last_name', '') ?? ''));
        $form->add(new InputText('email', 'Adres e-mail', $request->old('email', '') ?? ''));
        $form->add(new InputText('phone_number', 'Numer telefonu', $request->old('last_name', '') ?? ''));
        $form->add(new InputText('pesel', 'Pesel', $request->old('pesel', '') ?? ''));
        $form->add(new InputRadio('gender', 'Płeć', $request->old('gender', 'F') ?? 'F', ['F' => 'Kobieta', 'M' => 'Męzczyzna']));
        $form->add(new InputDate('birthday', 'Data urodzenia', $request->old('gender', '') ?? ''));
        $form->add(new InputText('birth_city', 'Miejsce urodzenia', $request->old('birth_city', '') ?? ''));
        $form->add(new InputTextarea('info', 'Dodatkowe informacje', $request->old('info', '') ?? ''));

        $form->add(new Title('Adres'));
        $form->add(new InputText('address_city', 'Miasto', $request->old('address_city', '') ?? ''));
        $form->add(new InputText('address_street', 'Ulica', $request->old('address_street', '') ?? ''));
        $form->add(new InputText('address_postal_code', 'Kod pocztowy', $request->old('address_postal_code', '') ?? ''));
        $form->add(new InputText('address_house_number', 'Numer domu', $request->old('address_house_number', '') ?? ''));
        $form->add(new InputText('address_apartment_number', 'Numer mieszkania', $request->old('address_apartment_number', '') ?? ''));
        $form->addButtons();

        $url = action('Admin\Crm\ClientsController@postAdd');

        return view('admin.crm.clients.form', compact('form', 'url'));
    }

    public function postAdd(AddClientRequest $request)
    {
        $data = $request->all();

        CrmClient::create($data);

        $request->session()->flash('info', 'Klient został dodany!');

        return redirect(action('Admin\Crm\ClientsController@index'));
    }

    public function getEdit(Request $request, $id)
    {
        $entity = CrmClient::findOrFail($id);

        $form = new AdminForm();
        $form->add(new Title('Ogólne'));
        $form->add(new InputText('first_name', 'Imię', $request->old('first_name', $entity->first_name) ?? $entity->first_name));
        $form->add(new InputText('last_name', 'Nazwisko', $request->old('last_name', $entity->last_name) ?? $entity->last_name));
        $form->add(new InputText('email', 'Adres e-mail', $request->old('email', $entity->email) ?? $entity->email));
        $form->add(new InputText('phone_number', 'Numer telefonu', $request->old('last_name', $entity->phone_number) ?? $entity->phone_number));
        $form->add(new InputText('pesel', 'Pesel', $request->old('pesel', $entity->pesel) ?? $entity->pesel));
        $form->add(new InputRadio('gender', 'Płeć', $request->old('gender', $entity->gender) ?? $entity->gender, ['F' => 'Kobieta', 'M' => 'Męzczyzna']));
        $form->add(new InputDate('birthday', 'Data urodzenia', $request->old('gender', $entity->birthday) ?? $entity->birthday));
        $form->add(new InputText('birth_city', 'Miejsce urodzenia', $request->old('birth_city', $entity->birth_city) ?? $entity->birth_city));
        $form->add(new InputTextarea('info', 'Dodatkowe informacje', $request->old('info', $entity->info) ?? $entity->info));

        $form->add(new Title('Adres'));
        $form->add(new InputText('address_city', 'Miasto', $request->old('address_city', $entity->address_city) ?? $entity->address_city));
        $form->add(new InputText('address_street', 'Ulica', $request->old('address_street', $entity->address_street) ?? $entity->address_street));
        $form->add(new InputText('address_postal_code', 'Kod pocztowy', $request->old('address_postal_code', $entity->address_postal_code) ?? $entity->address_postal_code));
        $form->add(new InputText('address_house_number', 'Numer domu', $request->old('address_house_number', $entity->address_house_number) ?? $entity->address_house_number));
        $form->add(new InputText('address_apartment_number', 'Numer mieszkania', $request->old('address_apartment_number', $entity->address_apartment_number) ?? $entity->address_apartment_number));
        $form->addButtons();

        $url = action('Admin\Crm\ClientsController@postEdit', [
            'id' => $entity
        ]);

        $deleteUrl = action('Admin\Crm\ClientsController@postDelete', [
            'id' => $entity
        ]);

        $coursesUrl = action('Admin\Crm\ClientCoursesController@getCourses', [
            'client' => $entity
        ]);

        return view('admin.crm.clients.form', compact('form', 'url', 'deleteUrl', 'coursesUrl'));
    }

    public function postEdit(EditClientRequest $request, $id)
    {
        $data = $request->all();

        $entity = CrmClient::findOrFail($id);
        $entity->fill($data);
        $entity->save();

        $request->session()->flash('info', 'Klient został zaktualizowany!');

        return redirect(action('Admin\Crm\ClientsController@index'));
    }

    public function postDelete(Request $request, $id)
    {
        CrmClient::findOrFail($id)->delete();

        $request->session()->flash('info', 'Klient został usunięty!');

        return redirect(action('Admin\Crm\ClientsController@index'));
    }
}
