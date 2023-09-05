<?php

namespace App\Controllers;

use App\Models\ContactoModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;

class ContactosController extends BaseController
{
    
    //se crea una variable para obtener el objecto del modelo a usar
    protected $contactoModel;

    //se utiliza un helper para la validacion
    protected $helpers = ['form'];

    //en el constructor se llama la instancia de modelo para que sea usado 
    function __construct(){
        $this->contactoModel = new ContactoModel();
    }

    public function index(){

        //se utiliza el codeigniter's model
        $contactos = $this->contactoModel->findAll();

        //se prepara un array associativo para obtener los datos del query
        $data = [
            'contactos' => $contactos,
        ];

        //se retorna una vista y se le pasa el arreglo de datos
        return view('contactos/index',$data);
    }

    public function store(){
        //se hace uso del request para obtener los datos del formulario 
        $request = \Config\Services::request();
        //se hace uso de la libreria para validaciones
        $validation = \Config\Services::validation();

        //se ajustan las reglas de validacion
        $validation->setRules([
            'nombre' => [
                'rules' => 'required|max_length[30]|alpha_space|min_length[2]',
                'errors' => [
                    'required' => 'El campo nombre es obligatorio',
                    'max_length' => 'El campo nombre no puede exceder más de 30 caracteres',
                    'min_length' => 'El campo nombre debe contener más de 2 caracteres'
                ]
            ],
            'telefono' => [
                'rules' => 'required|max_length[10]|numeric',
                'errors' => [
                    'required' => 'El campo teléfono es obligatorio',
                    'max_length' => 'El campo teléfono no puede exceder más de 10 caracteres',
                    'numeric' => 'El campo teléfono solo se permiten números'
                ]
            ],
            'correo' => [
                'rules' => 'required|valid_email|is_unique[contacto.correo]|max_length[60]',
                'errors' => [
                    'required' => 'El campo correo electrónico es obligatorio',
                    'valid_email' => 'El campo correo electrónico debe contener una dirección de válida',
                    'is_unique' => 'El campo correo electrónico ya existe',
                    'max_length' => 'El campo correo electrónico no puede exceder más de 60 caracteres',
                ]   
            ]
        ]);

         //se reciben los datos del formulario
         $data = [
            'nombre' => $request->getPost('nombre'),
            'telefono' => $request->getPost('telefono'),
            'correo' => $request->getPost('correo'),
        ];

        //se realiza el proceso de validacion | se ejecuta cuando se encuentran errores de validacion
        if (!$validation->run($data)) {
            // If you want to get the validated data.
            //$validData = $validation->getValidated();
            //dd($validation->getErrors());
            //return redirect()->back()->withInput()->with('errors',$validation->getErrors());
            return redirect()->back()->withInput();

        }
        
        //se utiliza el metodo de codeigniter para insertar datos al modelo
        $registro = $this->contactoModel->insert($data,true);

        //se redirecciona la ruta con un mensaje flash
        if($registro == true){
            return redirect()->to(base_url().'/contactos')->with('mensaje','El contacto se ha agregado correctamente');
        }

    }

    public function edit(int $id){

        //se busca el registro a travez del ID
        $contacto = $this->contactoModel->find($id);

        //verifica que el registro exista en la BD
        if(empty($contacto)){
            return view('errors/404');
        }

        //se crear un arreglo con la informacion del contacto enctrando de la BD
        $data = [
            'contacto' => $contacto
        ];

        //se retorna una vista con ese contacto
        return view('contactos/edit',$data);
    }

    public function update(int $id){
        //se hace uso del request para obtener los datos del formulario 
        $request = \Config\Services::request();

        //se hace uso de la libreria para validaciones
        $validation = \Config\Services::validation();

        //se busca el registro a travez del ID
        $contacto = $this->contactoModel->find($id);

        //verifica que el registro exista en la BD
        if(empty($contacto)){
            return view('errors/404');
        }

        //se ajustan las reglas de validacion
        $validation->setRules([
            'contacto_id' =>[
                'rules' => 'is_not_unique[contacto.contacto_id]'
            ],
            'nombre' => [
                'rules' => 'required|max_length[30]|alpha_space|min_length[2]',
                'errors' => [
                    'required' => 'El campo nombre es obligatorio',
                    'max_length' => 'El campo nombre no puede exceder más de 30 caracteres',
                    'min_length' => 'El campo nombre debe contener más de 2 caracteres'
                ]
            ],
            'telefono' => [
                'rules' => 'required|max_length[10]|numeric',
                'errors' => [
                    'required' => 'El campo teléfono es obligatorio',
                    'max_length' => 'El campo teléfono no puede exceder más de 10 caracteres',
                    'numeric' => 'El campo teléfono solo se permiten números'
                ]
            ],
            'correo' => [
                'rules' => 'required|valid_email|is_unique[contacto.correo,contacto_id,{contacto_id}]|max_length[60]',
                'errors' => [
                    'required' => 'El campo correo electrónico es obligatorio',
                    'valid_email' => 'El campo correo electrónico debe contener una dirección de válida',
                    'is_unique' => 'El campo correo electrónico ya existe',
                    'max_length' => 'El campo correo electrónico no puede exceder más de 60 caracteres',
                ]   
            ]
        ]);

        //se reciben los datos del formulario
        $data = [
            'contacto_id' => $id,
            'nombre' => $request->getPost('nombre'),
            'telefono' => $request->getPost('telefono'),
            'correo' => $request->getPost('correo'),
        ];

        //se realiza el proceso de validacion | se ejecuta cuando se encuentran errores de validacion
        if (!$validation->run($data)) {
            return redirect()->back()->withInput();

        }

        //se hace la actualizacion en la base de datos a travez del metodo de codeigniter udpate
        $registro = $this->contactoModel->update($id,$data);

        //se redirecciona a la vista con un mensaje exitoso
        if($registro == 1){
            return redirect()->to(base_url().'/contactos')->with('mensaje','El contacto se ha actualizado correctamente');
        }


    }

    public function destroy(int $id){
        
        //se verifica que sea una peticion ajax
        if($this->request->is('ajax')){
            
            //se busca el registro a travez del ID
            $contacto = $this->contactoModel->find($id);

            //verifica que el registro exista en la BD
            if(empty($contacto)){
                return $this->response->setStatusCode(404, 'Pagina no encontrada');
            }

            //metodo para eliminar un registro del modelo de la bd
            $this->contactoModel->delete($id);
            //$this->contactoModel->where('contacto_id',$id)->delete();

            //se prepara el arreglo con una respuesta del servidor para el cliente
            $data = [
                'id' => $id,
                'success' => true
            ];

            //se retorna una respuesta en formato JSON
            return $this->response->setJSON($data);
        
        }else{

            //en caso que exista un error 
            return $this->response->setStatusCode(500, 'No se pudo procesar la solicutud');
        
        }
       
        
    } 
}
