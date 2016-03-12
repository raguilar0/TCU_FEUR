<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class AssociationsController extends AppController
{



	public function index()
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

	}
	
	public function showAssociations($id = null)
	{
		$this->viewBuilder()->layout('admin_views');

		$query = $this->Associations->find()
				->select(['name','id']);
		$query->hydrate(false); //Quita elementos innecesarios de la consulta

		$data = $query->toArray();	

		$this->set('data',$data);
		
	}

	public function add()
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

		$association = $this->Associations->newEntity($this->request->data); //El parámetro es para validar los datos


		if($this->request->is('post'))
		{


			if($this->Associations->save($association)) //Guarda los datos
			{
				//$this->Flash->success(__('La Asociación ha sido guardada exitosamente'));
                //return $this->redirect(['action' => 'add']); //Redirecciona a la vista del index cuando guarda los datos. 
			}

			//$this->Flash->error(__('No es posible guardar la asociación en este momento'));
		}

		$this->set('association',$association); // set() Pasa la variable association a la vista.
	}

	public function modify($id = null)
	{
		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

		$association = $this->Associations->get($id);

		if($this->request->is(array('post','put')))
		{
			
			$asso = $this->Associations->newEntity($this->request->data);

			$association->acronym = $this->request->data['acronym'];
			$association->name = $this->request->data['name'];
			$association->location = $this->request->data['location'];
			$association->schedule = $this->request->data['schedule'];
			$association->authorized_card = $this->request->data['authorized_card'];

			if($this->Associations->save($association))
			{
					$callback = "1";

			}


		}
		else
		{
			$this->set('data',$association); // set() Pasa la variable association a la vista.
		}

		
	}

	public function delete($id = null)
	{
		$association = $this->Associations->get($id);

		if($this->Associations->delete($association))
		{
			return $this->redirect(['action'=>'showAssociations']);
		}
	}

	
}
