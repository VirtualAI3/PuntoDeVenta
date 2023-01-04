<?php
namespace App\Models;
use CodeIgniter\Model;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Arabic;

class VentasModel extends Model {
    protected $table      = 'ventas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['folio', 'total','id_usuario','id_caja','id_cliente','forma_pago','activo','venta_dia'];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function insertaVenta($id_venta,$total,$id_usuario,$id_caja,$id_cliente,$forma_pago,$venta_dia){
        $this->insert([
            'folio'=>$id_venta,
            'total'=>$total,
            'id_usuario'=>$id_usuario,
            'id_caja'=>$id_caja,
            'id_cliente'=>$id_cliente,
            'forma_pago'=>$forma_pago,
            'venta_dia'=>$venta_dia
        ]);
        return $this->insertID();
    }

    public function obtener($activo=1){
        $this->select('ventas.*,u.usuario AS cajero, c.nombre AS cliente');
        $this->join('usuarios AS u','ventas.id_usuario=u.id'); //INNERJOIN
        $this->join('clientes AS c','ventas.id_cliente=c.id');
        $this->where('ventas.activo',$activo);
        $this->orderBy('ventas.fecha_alta','DESC');
        $datos=$this->findAll();
        //print_r($this->getlastQuery());
        return $datos;
    }
    public function totalDia($fecha){
        $this->select("sum(total) AS total");
        $where="activo = 1 AND DATE(fecha_alta)='$fecha'";
        return $this->where($where)->first();
    }
    public function numVentas($week){
        
        $results=array();
        $a=0;
        $week_d=$week.$a;
        var_dump($week_d);
        $where_d="activo = 1 AND venta_dia='$week_d'"; $a++;
        $week_l=$week.$a;
        $where_l="activo = 1 AND venta_dia='$week_l'"; $a++;
        $week_ma=$week.$a;
        $where_ma="activo = 1 AND venta_dia='$week_ma'"; $a++;
        $week_mi=$week.$a;
        $where_mi="activo = 1 AND venta_dia='$week_mi'"; $a++;
        $week_j=$week.$a;
        $where_j="activo = 1 AND venta_dia='$week_j'"; $a++;
        $week_v=$week.$a;
        $where_v="activo = 1 AND venta_dia='$week_v'"; $a++;
        $week_s=$week.$a;
        $where_s="activo = 1 AND venta_dia='$week_s'";
        $results=[
            'ventasDo'=>$this->where($where_d)->countAllResults(),
            'ventasLu'=>$this->where($where_l)->countAllResults(),
            'ventasMar'=>$this->where($where_ma)->countAllResults(),
            'ventasMie'=>$this->where($where_mi)->countAllResults(),
            'ventasJu'=>$this->where($where_j)->countAllResults(),
            'ventasVi'=>$this->where($where_v)->countAllResults(),
            'ventasSa'=>$this->where($where_s)->countAllResults()
        ];
        return $results;
    }
}

?>