<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ???
 */
class Welcome extends CI_Controller {

	/**
     * contructor/conexión. 
     * @author Cristian Avila <?>
     * @date 06/12/2021
     * @method {{POST}}
     */
	function __construct()
    {   
        parent::__construct();
 		$this->load->model("user/adminUser", "adminUser");
    }

	/**
	 * Home -> Listado de tareas
     * @author Cristian Avila <?>
     * @date 06/12/2021
     * @method {{GET}}
     * @return array Vista renderizada
     * @route /
     */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	/**
	 * Crear tarea
     * @author Cristian Avila <?>
     * @date 06/12/2021
     * @method {{POST}}
     * @param 
	 * 		{int} id id tarea, 
	 * 		{string} name nombre tarea 
	 * 		{string} description descripción tarea.   
     * @return JSON status|message|data
     * @route /Welcome/add
     */

	public function add() {//pasar a función agregar

		$formdata = $this->input->post();
        $response = $this->adminUser->addUseLog($formdata);//pasar a adminUser 
		$jsonstring = json_encode($response);
		echo $jsonstring;                             
		return;
	}

	/**
     * Paso de información para eliminar tareas. 
     * @author Cristian Avila <?>
     * @date 06/12/2021
     * @method {{POST}}
     * @param {string} name Nombre tarea  
     * @return JSON status|message|data
     * @route /Welcome/delete
     */

	public function delete() {//pasar a función eliminar

        $response = $this->adminUser->deleteUseLog();//pasar a adminUser 
		$jsonstring = json_encode($response);
        echo $jsonstring;
        return;
	}
	/**
     * Paso de información para tomar la información del id de la tarea y enviarselo al formulario modal. 
     * @author Cristian Avila <?>
     * @date 06/12/2021
     * @method {{POST}}
     * @param {int} id id tarea  
     * @return JSON status|message|data
     * @route /Welcome/modifyId
     */

	public function modifyId() {//pasar a función buscador e implementador Id modificar

        $response = $this->adminUser->modifyIdUseLog();//pasar a adminUser 
		$jsonstring = json_encode($response);
		echo $jsonstring;                             
	}

	/**
     * Paso de información para modificar información de la tarea. 
     * @author Cristian Avila <?>
     * @date 06/12/2021
     * @method {{POST}}
     * @param {int} id id de la tarea, {string} name nombre tarea {string} description descripción tarea.
     * @return JSON status|message|data
     * @route /Welcome/modify
     */

	public function modify() {//pasar a función modificar

        $response = $this->adminUser->modifyUseLog();//pasar a adminUser 
		$jsonstring = json_encode($response);
        echo $jsonstring;
        return;                       

	}
	
	/**
     * Paso de información buscador de tareas. 
     * @author Cristian Avila <?>
     * @date 06/12/2021
     * @method {{POST}}
     * @param {string} name nombre tarea.  
     * @return JSON status|message|data
     * @route /Welcome/searsh
     */

	public function searsh(){//pasar a función listar 
			
		$response = $this->adminUser->searshUseLog();//pasar a adminUser 
		$jsonstring = json_encode($response);
		echo $jsonstring;

	}

	/**
     * Paso de información listar tareas. 
     * @author Cristian Avila <?>
     * @date 06/12/2021
     * @method {{GET}}
     * @param {int} id id de la tarea, {string} name nombre tarea {string} description descripción tarea. 
     * @return JSON status|message|data
     * @route /Welcome/list
     */

	public function list(){//pasar a función listar 
		
		$response = $this->adminUser->listUseLog();//pasar a adminUser 
		$jsonstring = json_encode($response);
		echo $jsonstring;

	}
}
