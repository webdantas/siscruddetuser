<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    private $User;

    public function __construct()
	{
		$this->User = new User();
	}

    public function index()
	{
		return view('users', [
			'users' => $this->User->paginate(10),
			'pager' => $this->User->pager
		]);
	}
}
