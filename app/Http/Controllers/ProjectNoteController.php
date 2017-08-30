<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Http\Requests;
use Illuminate\Support\Facades\Response;
use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Services\ProjectNoteService;

class ProjectNoteController extends Controller
{
   /**
     * @var IClientRepository
     */
    protected $repository;

    /**
     * @var ClientValidator
     */
    private $service;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
    {
      $this->service = $service;
      $this->repository = $repository;
    }
    public function index($id)
    {
      return $this->repository->findWhere(['project_id' => $id]);
    }

    public function update(Request $request, $id,$noteId)
    {
       return $this->service->update($request->all(), $noteId);
    }

    public function store(Request $request)
    {

      $result = $this->service->create($request->all());

      if( $result['error'] ) {
       
        return response(
          $result['message']->getMessages()['project_id'],
          400 
        )->header('Content-Type','application/json');
      }

      return $this->service->create($request->all());
    }

    public function show($id, $noteId)
    {
      return $this->repository->findWhere(['project_id' => $id, 'id' => $noteId]);
    }

    public function destroy($id,$noteId)
    {
        return $this->service->destroy($noteId);
    }
}
