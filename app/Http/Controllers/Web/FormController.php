<?php

namespace App\Http\Controllers\Web;

use App\FormContact;
use App\FormCourse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Http\Requests\CourseFormRequest;
use App\Mail\ContactFormConfirmation;
use App\Mail\ContactFormInformation;
use App\Mail\CourseFormConfirmation;
use App\Mail\CourseFormInformation;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    public function postContact(ContactFormRequest $request)
    {
        $form = FormContact::make($request->all());
        $form->ip = $request->ip();
        $form->save();

        Mail::to($form->email)->send(new ContactFormConfirmation($form));
        Mail::to(config('mail.info_address'))->send(new ContactFormInformation($form));

        $request->session()->flash('contact-success', 'Formularz został przesłany pomyślnie!');

        return redirect('/#kontakt');
    }

    public function postCourse(CourseFormRequest $request)
    {
        $form = FormCourse::make($request->all());
        $form->ip = $request->ip();
        $form->save();

        Mail::to($form->email)->send(new CourseFormConfirmation($form));
        Mail::to(config('mail.info_address'))->send(new CourseFormInformation($form));

        $request->session()->flash('course-success', 'Formularz zgłoszeniowy został przesłany pomyślnie!');

        return redirect(action('Web\PagesController@getCourseForm'));
    }
}
