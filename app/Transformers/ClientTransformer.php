<?php
namespace CodeProject\Transformers;

use CodeProject\Entities\Client;

use League\Fractal\TransformerAbstract;


class ClientTransformer extends TransformerAbstract
{

  /**
   * Transform the \Client entity
   * @param \Client $model
   *
   * @return array
   */


  public function transform(Client $client)
  {
      return [
        'id' => $client->id,
        'name'=> $client->name,
        'responsable' => $client->responsable,
        'email' => $client->email,
        'phone' => $client->phone,
        'address' => $client->address,
        'obs' => $client->obs
      ];

  }

}
