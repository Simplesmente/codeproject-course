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
      $this->repository = $repository;
      $this->service = $service;
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


    public function destroy(Request $request, $project_id, $fileId)
    {
        $data['fileId'] = $fileId;
        $data['project_id'] = $project_id;

        return $this->service->deleteFile($data);

    }


}
