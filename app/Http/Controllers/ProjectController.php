<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Http\Requests;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;

class ProjectController extends Controller
{
   /**
     * @var IClientRepository
     */
    protected $repository;

    /**
     * @var ClientValidator
     */
    private $service;

    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
      $this->service = $service;
      $this->repository = $repository;
    }



    public function index()
    {
      return $this->repository->all();
    }

    public function find($id = null)
    {

      return $this->repository->with(['owner', 'client'])->all();

    }

    public function findOne($id)
    {
        return $this->repository->with(['owner', 'client'])->find($id);
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
