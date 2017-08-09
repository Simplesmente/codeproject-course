<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Http\Requests;
use CodeProject\Repositories\ClientRepository;
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

    public function __construct(ClientRepository $repository, ClientService $service)
    {
      $this->service = $service;
      $this->repository = $repository;
    }
    public function index()
    {
      return $this->repository->all()['data'];
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function store(Request $request)
    {
      return $this->service->create($request->all());
    }

    public function show($id)
    {
      return $this->service->find($id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
