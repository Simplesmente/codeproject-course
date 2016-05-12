<?php

namespace CodeProject\Http\Controllers;


use Illuminate\Http\Request;
use CodeProject\Http\Requests;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;

class ProjectFileController extends Controller
{
   /**
     * @var IClientRepository
     */
    protected $repository;

    /**
     * @var ClientValidator
     */
    private $service;

    //private $userId;

    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
      $this->service = $service;
      $this->repository = $repository;

    }



    public function index()
    {
      return $this->repository->findWhere(['owner_id' => $userId = \Authorizer::getResourceOwnerId()]);
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
      if( !$this->CheckProjectPermissions($id)){
          return ['message' => 'Access Forbidden'];
      }

        return $this->service->update($request->all(), $id);
    }

    public function store(Request $request)
    {
      $data = [];

      $file = $request->file('file');
      $extension = $file->getClientOriginalExtension();

      $data['file'] = $file;
      $data['extension'] = $extension;
      $data['name'] = $request->name;
      $data['project_id'] = $request->project_id;

      $this->service->createFile($data);

    }

    public function show($id)
    {
        if( !$this->CheckProjectPermissions($id)){
            return ['message' => 'Access Forbidden'];
        }

      return $this->service->find($id);
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
