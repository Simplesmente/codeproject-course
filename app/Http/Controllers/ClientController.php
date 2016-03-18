<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Repositories\IClientRepository;
use CodeProject\Http\Requests;

class ClientController extends Controller
{
    private $repository;

    public function __construct(IClientRepository $repository)
    {
      $this->repository = $repository;
    }
    public function index()
    {
      return $this->repository->all();
    }

    public function store(Request $request)
    {
      return $this->repository->create($request->all());
    }

    public function show($id)
    {
      return $this->repository->find($id);
    }

    public function destroy($id)
    {
        $this->repository->find($id)->delete();

    }
}
