<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Validators\ClientValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Illuminate\Database\QueryException;

class ClientService
{
	/**
	 * @var IClientRepository
	 */
	protected $repository;

	/**
	 * @var ClientValidator
	 */
	private $validator;

	public function __construct(ClientRepository $repository, ClientValidator $validator)
	{
		$this->validator = $validator;
		$this->repository = $repository;
	}

	public function find($id)
	{
		try {

				return $this->repository->find($id);

		} catch (ModelNotFoundException $e) {
				return [
					'error' => false,
					'message' => 'Client not exists '
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
			$client = $data['name'];
			$this->repository->update($data,$id);

			return [
				'error' => false,
				'message' => 'Client '. $client .' update success'
			];

		} catch (ModelNotFoundException $e) {

			return [
				'error' => true,
				'message' => 'Client that it you are trying to update not exists'
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

					$this->repository->skipPresenter()->find($id)->delete();

    		 return [
    		 	'error' => false,
    		 	'message' => 'Client Deleted'
    		 ];

			 } catch (ModelNotFoundException $e) {

 				return [
 				 'error' => true,
 				 'message' => "Client not exists"
 			 ];

			 } catch (QueryException $e) {

				 return [
					'error' => true,
					'message' => "This client cannot be deleted because it are in one or more projects"
				];

    	}


    }
}
