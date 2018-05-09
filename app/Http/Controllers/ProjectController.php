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
        $userId = \Authorizer::getResourceOwnerId();

        $projects = $this->repository->findWhere(['owner_id' => $userId]);

        if(! $projects['data']){

            return ['message' => 'error retrieving data'];
        }

          return $projects['data'];
    }

    public function find($id = null)
    {
      $result = $this->repository->with(['owner', 'client'])->all();

      return $result;

    }

    public function findOne($id)
    {
        $this->repository->with(['owner', 'client'])->find($id);

        return $this->repository->with(['owner', 'client'])->find($id);
    }

    public function update(Request $request, $id)
    {
      if( !$this->CheckProjectPermissions($id)){
          return ['message' => 'Access Forbidden'];
      }

        return $this->service->update($request->all(), $id);
    }

    public function store(Request $request)
    {
      return $this->service->create($request->all());
    }

    public function show($id)
    {
        if( !$this->CheckProjectPermissions($id)){
            return ['message' => 'Access Forbidden'];
        }

      $result = $this->service->find($id);

      return $result['data'];

    }

    public function destroy($id)
    {
      if( !$this->CheckProjectPermissions($id)){
          return ['message' => 'Access Forbidden'];
      }

        return $this->service->destroy($id);

    }

    public function destroyMember($projectId, $userId)
    {
        return $this->service->removeMember($projectId, $userId );

    }

    public function addMember($projectId, $userId)
    {
        return $this->service->addMember($projectId, $userId );

    }

    private function checkProjectOwner($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();

      if( $this->repository->isOwner($projectId, $userId)){
            return true;
      }
        return false;
    }

    private function checkProjectMember($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();

      if( $this->repository->hasMember($projectId, $userId)){
            return true;
      }
        return false;
    }

    private function CheckProjectPermissions($projectId)
    {
      if( $this->checkProjectMember($projectId) || $this->checkProjectOwner($projectId) ){
          return true;
      }
              return false;
    }
}
