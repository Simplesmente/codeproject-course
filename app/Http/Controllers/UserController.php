<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

use CodeProject\Http\Requests;
use CodeProject\Entities\User;


class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
      $this->user = $user;
    }

    public function authenticated()
    {
      $id = Authorizer::getResourceOwnerId();

      return $this->user->find($id);
    }
}
