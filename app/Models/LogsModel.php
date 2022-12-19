<?php
namespace App\Models;
use CodeIgniter\Model;

class LogsModel extends Model {
    protected $table      = 'logs';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_usuario','evento','ip','detalles'];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function obtenerNombre(){
        $this->select('logs.*,u.usuario AS nombre');
        $this->join('usuarios AS u','logs.id_usuario=u.id'); //INNERJOIN
        $datos=$this->findAll();
        //print_r($this->getlastQuery());
        return $datos;
    }
}

?>