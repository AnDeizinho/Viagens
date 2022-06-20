<?php
namespace Viagens\model;
include "./crud.php";
use \Viagens\model\Crud;
class Login{
    /**
     * @var Crud
     */
    private $crud;
    public function __construct()
    {
        $this->crud = new Crud();
    }

    /**
     * @return array
     */
    public function fazerlogin($email, $senha){
        return $this->crud->select("select * from usuarios where email=? and senha=MD5(?) limit 1",[$email,$senha]);
    }
}
