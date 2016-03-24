<?php 

namespace CodeProject\Services;

use CodeProject\Repositories\IClientRepository;
use CodeProject\Validators\ClientValidator;
use Prettus\Validator\Exceptions\ValidatorException;

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

	public function __construct(IClientRepository $repository, ClientValidator $validator)
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
    		 	'message' => 'Client Deleted'
    		 ];

    	} catch (ValidatorException $e) {

    		return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
    		
    	}
        

    }
}