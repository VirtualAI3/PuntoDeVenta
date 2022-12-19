<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PermisosModel;

class Permisos extends BaseController
{
    protected $permisos;
    protected $reglas;

    public function __construct()
    {
        $this->permisos = new PermisosModel();
        helper(['form']);

        $this->reglas = [
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'tipo' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];
    }

    public function index($activo = 1)
    {
        $permisos = $this->permisos->select('*')->findAll();
        $data = ['titulo' => 'Permisos', 'datos' => $permisos];
        echo view('header');
        echo view('permisos/permisos', $data);
        echo view('footer');
    }

    public function nuevo()
    {
        $data = ['titulo' => 'Agregar permiso'];

        echo view('header');
        echo view('permisos/nuevo', $data);
        echo view('footer');
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $this->permisos->save(['nombre' => $this->request->getPost('nombre'), 'tipo' => $this->request->getPost('tipo')]);
            return redirect()->to(base_url() . '/permisos');
        } else {
            $data = ['titulo' => 'Agregar permisos', 'validation' => $this->validator];

            echo view('header');
            echo view('permisos/nuevo', $data);
            echo view('footer');
        }
    }

    public function editar($id,$valid=null)
    {
        $unidad = $this->permisos->where('id', $id)->first();
        if ($valid!=null)
        {
            $data = ['titulo' => 'Editar unidad', 'datos' => $unidad,'validation'=>$valid];
        }else{
            $data = ['titulo' => 'Editar unidad', 'datos' => $unidad];
        }
        

        echo view('header');
        echo view('permisos/editar', $data);
        echo view('footer');
    }
    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $this->permisos->update($this->request->getPost('id'), ['nombre' => $this->request->getPost('nombre'), 'nombre_corto' => $this->request->getPost('nombre_corto')]);
            return redirect()->to(base_url() . '/permisos');
        } else{
            return $this->editar($this->request->getPost('id'),$this->validator);
        }
    }
    public function eliminar($id)
    {

        $this->permisos->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . '/permisos');
    }
    public function reingresar($id)
    {

        $this->permisos->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . '/permisos');
    }
}
