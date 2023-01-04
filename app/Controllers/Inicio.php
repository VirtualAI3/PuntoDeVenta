<?php

namespace App\Controllers;

use App\Models\ProductosModel;
use App\Models\VentasModel;
use App\Models\UsuariosModel;

class Inicio extends BaseController
{
    protected $productosModel, $ventasModel,$session,$usuario;
    public function __construct()
    {
        $this->productosModel = new ProductosModel();
        $this->ventasModel = new VentasModel();
        $this->session=session();
        $this->usuario=new UsuariosModel();
    }
    public function index()
    {
        if(!isset($this->session->id_usuario)){
            return redirect()->to(base_url());
        }
        $activo=$this->usuario->where('id',$this->session->id_usuario)->first();
        if($activo['activo']==0){
            $this->session->destroy();
            return redirect()->to(base_url());
        }
        $total = $this->productosModel->totalProductos();
        $totalVentas = $this->ventasModel->totalDia(date('Y-m-d'));
        $minimos=$this->productosModel->productosMinimo();
        $week=date('W',strtotime(date('Y-m-d')));
        
        $numVentasSemana=$this->ventasModel->numVentas($week);
        $datos = ['total' => $total,'totalVentas'=>$totalVentas,'minimos'=>$minimos,'numVentas'=>$numVentasSemana];
        echo view('header');
        echo view('inicio', $datos);
        echo view('footer');
    }
}
