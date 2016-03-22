<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Http\Requests;
use CodeProject\Repositories\IClientRepository;
use CodeProject\Services\ClientService;

class ClientController extends Controller
{
   /**
     * @var IClientRepository
     */
    protected $repository;

    /**
     * @var ClientValidator
     */
    private $service;

    public function __construct(IClientRepository $repository, ClientService $service)
    {
      $this->service = $service;
      $this->repository = $repository;
    }
    public function index()
    {
      return $this->repository->all();
    }

    public function update(Request $request, $id)
    {
        return $this->repository->update($request->all(), $id);
    }

    public function store(Request $request)
    {
      return $this->service->create($request->all());
    }

    public function show($id)
    {
      return $this->repository->find($id);
    }

    public function destroy($id)
    {
        return $this->repository->find($id)->delete();

    }
}
