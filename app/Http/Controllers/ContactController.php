<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactFormSubmitted;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ContactFormRequest  $request
     * @return RedirectResponse
     */
    public function store(ContactFormRequest $request): RedirectResponse
    {
        $request->validated();

        Mail::to(env('ESCCOR_OWNER_EMAIL'))
            ->cc('paul.d.przyborski@nasa.gov')
            ->bcc('karl.hill@nasa.gov')
            ->send(new ContactFormSubmitted($request)
            );

        toastr()->success('Thank you for contacting us.');

        return back();
    }
}
