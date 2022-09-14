<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class UtilityController extends Controller
{
    /**
     * @return Factory|View
     */
    public function profile()
    {
        return view('profile');
    }

    /**
     * @return Factory|View
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * @return Factory|View
     */
    public function about()
    {
        return view('about');
    }

    /**
     * @return Factory|View
     */
    public function help()
    {
        return view('help');
    }
}
