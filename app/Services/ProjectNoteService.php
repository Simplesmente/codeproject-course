<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Validators\ProjectNoteValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectNoteService
{
	/**
	 * @var IClientRepository
	 */
	protected $repository;

	/**
	 * @var ClientValidator
	 */
	private $validator;

	public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
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

	public function update(array $data, $id)
	{

		try {
			$this->validator->with($data)->passesOrFail();

			return $this->repository->update($data,$id);



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
    		 	'error' => true,
    		 	'message' => 'Note Deleted'
    		 ];

    	} catch (ValidatorException $e) {

    		return [
				'error' => true,
				'message' => $e->getMessageBag()
			];

    	}


    }
}
