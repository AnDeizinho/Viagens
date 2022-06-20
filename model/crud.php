<?php
namespace Viagens\model;
use \PDO;
class Crud{
    /**
     * @var PDO
     */
    private $con;
    /**
     * @param string
     * @param array
     * @return array
     */
    public function select($commando, $params =[]){
        $rest = $this->con->prepare($commando);
        $rest->execute($params);
        return $rest->fetchAll();
        
    }
    /**
     * @param string
     * @param array
     * @return array 
     */
    public function execute($commando, $parametros=[]){
        $rest = $this->con->prepare($commando);
        $sucesso = $rest->execute($parametros);
        if(!$sucesso){
            return $rest->errorInfo(); 
        }
        return true;
    }
    /**
     * @param string
     * @param array
     * @return array
     */
    public function delete($comando,$par=[]){
        $rest = $this->con->prepare($comando);
        $sucesso = $rest->execute($par);
        if(!$sucesso){
            return $rest->errorInfo();
        }
        return true;
    }
    public function __construct()
    {
        $this->con= new PDO("mysql:host=localhost;dbname=viagens", "root", "yerdna");
    }
}
