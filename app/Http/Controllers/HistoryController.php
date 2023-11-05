<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use OpenAdmin\Admin\Form;

class HistoryController extends Controller
{
    public function index() {

        return view('history');
    }
}
