<?php



/**
 * Skeleton subclass for representing a row from the 'endpoint' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.siscad_autenticacao
 */
class Endpoint extends BaseEndpoint
{
  private $_hasAccess = true;

  /*

  */
  public function validateEndpointAccess($userRole, $method, $uri){

    $pattern = $this->_parsePattern($uri);
    $endpoint = $this->getEndpoint($method, $pattern);

    if(!is_null($endpoint)){
      if($endpoint->getRestrito()){
        $query = PerfilEndpointQuery::create()
                                    ->filterByPerfilId($userRole)
                                    ->filterByEndpointId($endpoint->getId())
                                    ->findOne();
        if(is_null($query)){
          //usuário não autorizado
          $this->_hasAccess = false;
        }
      }
    }
  }

  /*

  */
  public function getEndpoint($method, $uri){
    return EndpointQuery::create()
                          ->filterByUri($uri)
                          ->filterByMethod($method)
                          ->filterByAtivo(1)
                          ->findOne();
  }

  /*

  */
  private function _parsePattern($uri){
    $uriPieces = preg_split('/\//', $uri, 0, PREG_SPLIT_NO_EMPTY);
    $pattern = '';
    if(count($uriPieces) == 0){
      $pattern = '/';
    }elseif(count($uriPieces) == 1){
      $pattern = '/'.$uriPieces[0];
    }elseif($uriPieces[1]=='filtrar'){
      $pattern = '/'.$uriPieces[0].'/'.$uriPieces[1];
    }else{
      $pattern = '/'.$uriPieces[0];
    }
    return $pattern;
  }

  public function hasAccess(){
    return $this->_hasAccess;
  }

}
