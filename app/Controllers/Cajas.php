<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CajasModel;
use App\Models\ArqueoCajaModel;
use App\Models\VentasModel;

class Cajas extends BaseController
{
    protected $cajas, $arqueoModel,$ventasModel;
    protected $reglas;

    public function __construct()
    {
        $this->cajas = new CajasModel();
        $this->arqueoModel = new ArqueoCajaModel();
        $this->ventasModel=new VentasModel();
        helper(['form']);

        $this->reglas = [
            'numero_caja' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'El campo numero caja es obligatorio.',
                    'integer' => 'El numero de caja debe ser un numero entero.'
                ]
            ],
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo nombre es obligatorio.',
                ]
            ],
            'folio' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'integer' => 'El campo {field} debe ser un numero entero.'
                ]
            ]
        ];
    }

    public function index($activo = 1)
    {
        $cajas = $this->cajas->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Cajas', 'datos' => $cajas];
        echo view('header');
        echo view('cajas/cajas', $data);
        echo view('footer');
    }
    public function eliminados($activo = 0)
    {
        $cajas = $this->cajas->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Cajas eliminadas', 'datos' => $cajas];
        echo view('header');
        echo view('cajas/eliminados', $data);
        echo view('footer');
    }

    public function nuevo()
    {
        $data = ['titulo' => 'Agregar caja'];

        echo view('header');
        echo view('cajas/nuevo', $data);
        echo view('footer');
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $this->cajas->save([
                'numero_caja' => $this->request->getPost('numero_caja'),
                'nombre' => $this->request->getPost('nombre'),
                'folio' => $this->request->getPost('folio')
            ]);
            return redirect()->to(base_url() . '/cajas');
        } else {
            $data = ['titulo' => 'Agregar caja', 'validation' => $this->validator];

            echo view('header');
            echo view('cajas/nuevo', $data);
            echo view('footer');
        }
    }

    public function editar($id, $valid = null)
    {
        $caja = $this->cajas->where('id', $id)->first();
        if ($valid != null) {
            $data = ['titulo' => 'Editar unidad', 'datos' => $caja, 'validation' => $valid];
        } else {
            $data = ['titulo' => 'Editar unidad', 'datos' => $caja];
        }


        echo view('header');
        echo view('cajas/editar', $data);
        echo view('footer');
    }
    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $this->cajas->update($this->request->getPost('id'), [
                'numero_caja' => $this->request->getPost('numero_caja'),
                'nombre' => $this->request->getPost('nombre'),
                'folio' => $this->request->getPost('folio')
            ]);
            return redirect()->to(base_url() . '/cajas');
        } else {
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }
    public function eliminar($id)
    {

        $this->cajas->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . '/cajas');
    }
    public function reingresar($id)
    {

        $this->cajas->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . '/cajas');
    }

    public function arqueo($idCaja)
    {
        $arqueos = $this->arqueoModel->getDatos($idCaja);
        $data = ['titulo' => 'Cierres de caja', 'datos' => $arqueos];

        echo view('header');
        echo view('cajas/arqueos', $data);
        echo view('footer');
    }
    public function nuevo_arqueo()
    {
        $session = session();

        $existe = $this->arqueoModel->where(['id_caja' => $session->id_caja, 'estatus' => 1])->countAllResults();
        if ($existe > 0) {
            echo 'La caja ya esta abierta';
            exit;
        }

        if ($this->request->getMethod() == "post") {
            $fecha = date('Y-m-d h:i:s');
            $existe = 0;

            $this->arqueoModel->save([
                'id_caja' => $session->id_caja,
                'id_usuario' => $session->id_usuario,
                'fecha_inicio' => $fecha,
                'monto_inicial' => $this->request->getPost(['monto_inicial']),
                'estatus' => 1
            ]);
            return redirect()->to(base_url() . '/cajas');
        } else {
            $caja = $this->cajas->where('id', $session->id_caja)->first();
            $data = ['titulo' => 'Apertura de caja', 'caja' => $caja, 'session' => $session];

            echo view('header');
            echo view('cajas/nuevo_arqueo', $data);
            echo view('footer');
        }
    }
    public function cerrar()
    {
        $session = session();

        

        if ($this->request->getMethod() == "post") {
            $fecha = date('Y-m-d h:i:s');
        

            $this->arqueoModel->update($this->request->getPost('id_arqueo'),[
                
                'fecha_fin' => $fecha,
                'monto_final' => $this->request->getPost(['monto_final']),
                'total_ventas' => $this->request->getPost(['total_ventas']),
                'estatus' => 0
            ]);
            return redirect()->to(base_url() . '/cajas');
        } else {
            $montoTotal=$this->ventasModel->totalDia(date('Y-m-d'));
            $arqueo=$this->arqueoModel->where(['id_caja' => $session->id_caja, 'estatus' => 1])->first();
            $caja = $this->cajas->where('id', $session->id_caja)->first();
            $data = ['titulo' => 'Cerrar caja', 'caja' => $caja, 'session' => $session,'arqueo'=>$arqueo,'monto'=>$montoTotal];

            echo view('header');
            echo view('cajas/cerrar', $data);
            echo view('footer');
        }
    }
}
