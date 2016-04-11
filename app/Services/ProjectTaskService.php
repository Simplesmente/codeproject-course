<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Validators\ProjectTaskValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Illuminate\Database\QueryException;

class ProjectTaskService
{
	/**
	 * @var IClientRepository
	 */
	protected $repository;

	/**
	 * @var ClientValidator
	 */
	private $validator;

	public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator)
	{
		$this->validator = $validator;
		$this->repository = $repository;
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

	public function find($id)
	{
			try {

				return $this->repository->find($id);

			} catch (ModelNotFoundException $e) {

				return [
				'error' => true,
				'message' => 'Task not exists'
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
}
