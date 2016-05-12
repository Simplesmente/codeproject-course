<?php

namespace CodeProject\Services;

use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Illuminate\Database\QueryException;


class ProjectService
{
	/**
	 * @var IClientRepository
	 */
	protected $repository;

	/**
	 * @var ClientValidator
	 */
	private $validator;

	public function __construct(ProjectRepository $repository,
															ProjectValidator $validator,
															Filesystem $filesystem,
															Storage $storage)
	{
		$this->validator = $validator;
		$this->repository = $repository;
		$this->filesystem = $filesystem;
		$this->storage = $storage;
	}

	public function addMember($project_id, $user_id)
	{
		$project = $this->repository->find($project_id);

		if(!$this->isMember($project_id, $user_id)){

				$project->members()->attach($user_id);

		}

			return $project->members()->get();
	}

	public function removeMember($project_id, $user_id)
	{
		$project = $this->repository->find($project_id);
		$project->members()->detach($user_id);

		return $project->members()->get();
	}

	public function isMember($project_id, $user_id)
	{
		$project = $this->repository->find($project_id)->members()->find(['user_id' => $user_id]);

		if(count($project)){
				return true;
		}else{
				return false;
		}
	}
	public function find($id)
	{
			try {

				return $this->repository->find($id);

			} catch (ModelNotFoundException $e) {

				return [
				'error' => true,
				'message' => 'Client not exists'
				];

			}


		}


	public function create(array $data)
	{

		try {

			$this->validator->with( $data )->passesOrFail();

			return $this->repository->create($data);

		 } catch (ValidatorException $e) {

            return [

                'error' =>true,
                'message' => $e->getMessageBag()
            ];

        }

	}

	public function update(array $data, $id)
	{

		try {
			$this->validator->with($data)->passesOrFail();
			$name = $data['name'];
			$this->repository->update($data,$id);

			return [
				'error' => false,
				'message' => 'Project ' . $name . ' updated'
			];

		} catch (ModelNotFoundException $e) {

			return [
				'error' => true,
				'message' => 'No query results'
			];

		} catch (ValidatorException $e) {

			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}

	}

	public function destroy($id)
  {
    	try {

    		$this->repository->find($id)->delete();

    		 return [
    		 	'error' => false,
    		 	'message' => 'Client Deleted'
    		 ];

			 } catch (ModelNotFoundException $e) {

				 return [
					 'error' => true,
					 'message' => 'No deleted result'
				 ];

    	} catch (ValidatorException $e) {

    		return [
				'error' => true,
				'message' => $e->getMessageBag()
			];

    	}


    }

		public function createFile(array $data)
		{
			// name, description, extension, File
			$project = $this->repository->skipPresenter()->find($data['project_id']);
			$projectFile = $project->files()->create($data);

			$this->storage->put($projectFile->id .".". $data['extension'], $this->filesystem->get($data['file']));
		}
}
