<?php
namespace CodeProject\Transformers;

use League\Fractal\TransformerAbstract;

use CodeProject\Entities\Client;

class ClientTransformer extends TransformerAbstract
{

  public function transform(Client $client)
  {
      return [
        'name '=> $client->name,
        'responsable' => $client->responsable,
        'email' => $client->email,
        'phone' => $client->phone,
        'address' => $client->address,
        'obs' => $client->obs
      ];

  }
  
}
