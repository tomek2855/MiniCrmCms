<?php

namespace App\Http\Controllers\Admin\Crm;

use App\CrmClient;
use App\CrmCourse;
use App\Extensions\AdminTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientCoursesController extends Controller
{
    public function getCourses(CrmClient $client)
    {
        $courses = $client->courses;

        $clientUrl = action('Admin\Crm\ClientsController@getEdit', [
            'id' => $client
        ]);

        $table = new AdminTable($courses, [
            'id' => 'Id kursu',
            'name' => 'Nazwa kurs',
        ], '', '/admin/crm/courses', false);

        return view('admin.crm.clientCourses.courses', compact('table', 'clientUrl', 'client'));
    }

    public function getClients(CrmCourse $course)
    {
        $clients = $course->clients;

        $courseUrl = action('Admin\Crm\CoursesController@getEdit', [
            'id' => $course
        ]);

        $table = new AdminTable($clients, [
            'id' => 'Id klienta',
            'fun|full_name' => 'Imię i nazwisko kursanta',
            'email' => 'Adres email',
            'phone_number' => 'Numer telefonu',
        ], '', '/admin/crm/clients', false);

        $table->addFunction('full_name', function($i) {
            return $i->getFullName();
        });

        return view('admin.crm.clientCourses.clients', compact('table', 'courseUrl', 'course'));
    }
}
