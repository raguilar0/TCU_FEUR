<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Exception\Exception;
use Cake\Datasource\Exception\RecordNotFoundException;

class AmountsController extends AppController
{

	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		$this->viewBuilder()->layout('admin_views');
		$query = $this->Amounts;
		
		if(($this->request->session()->read('Auth.User.role')) == 'rep'){
			$actualDate = date("Y-m-d");
			$tract_id = $this->getTractId($actualDate) ;
			$association_id = $this->request->session()->read('Auth.User.association_id');
			
			$this->paginate = [
				'contain' => ['Associations',
							'Tracts' => function ($q) use($tract_id) {
							 return $q->where(['Tracts.id' => $tract_id]);
							 }]
			];
			
			$query = $this->Amounts->find()
						->andWhere(['association_id'=>$association_id, 'type'=>1]);
		
		}
		elseif(($this->request->session()->read('Auth.User.role')) == 'admin')
		{
		
			$this->paginate = [
				'contain' => ['Associations'=>function($q){
					return $q->where(['enable'=>1]);
				}, 'Tracts']
			];			
		}
		


		$amounts = $this->paginate($query);

		$this->set(compact('amounts'));
		$this->set('_serialize', ['amounts']);

	}

	/**
	 * View method
	 *
	 * @param string|null $id Initial Amount id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		try
		{
			$this->viewBuilder()->layout('admin_views');
			$amounts = $this->Amounts->get($id, [
				'contain' => ['Associations', 'Tracts']
			]);
			$this->set('amount', $amounts);
			$this->set('_serialize', ['amount']);
		}
		catch (RecordNotFoundException $e)
		{
			$this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
			return $this->redirect(['action' => 'index']);
		}




	}

	public function addAmounts()
	{
		if(($this->request->session()->read('Auth.User.role')) != 'rep'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{
			$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vista

			$tract = $this->getTractId(date('Y-m-d'));
			$amount = $this->Amounts->newEntity();

			if($this->request->is('POST'))
			{
				$association_id = $this->request->session()->read('Auth.User.association_id');
				$type = 1;
				$data = $this->request->data;


				$data['tract_id'] = $tract;
				$data['association_id'] = $association_id;
				$data['type'] = $type;

				$amount = $this->Amounts->patchEntity($amount,$data);



					if($this->Amounts->save($amount))
					{
						$this->Flash->success('Se agregaron los montos exitosamente');
						return $this->redirect(['action'=>'index']);
					}
					else
					{
						$this->Flash->error('No se pudo agregar el monto. Probablemente no introdujo datos válidos.');
					}

			}

			$this->set('amount',$amount);
			$this->set('tract',$tract);

		}
	}




	public function add($association_id = null)
	{
		

		$this->viewBuilder()->layout('admin_views'); //Carga un layout personalizado para esta vist
		$amounts = $this->Amounts->find()
			->hydrate(false)
			->select(['tract.id'])
			->join([
				'table'=>'tracts',
				'alias'=>'tract',
				'type'=>'inner',
				'conditions'=>'Amounts.tract_id = tract.id'

			])
			->where(['Amounts.association_id'=>$association_id, 'OR'=>[['YEAR(tract.date)'=>date('Y')],['YEAR(tract.date)'=>(date('Y')+1)]]]);

		$tracts = $this->Amounts->Tracts->find()
			->hydrate(false)
			->select(['id','date', 'deadline', 'number'])
			->where(function ($exp,$q)use($amounts){return $exp->notIn('id',$amounts);})
			->order(['YEAR(date)'])
			->order(['number = '=>'2 DESC']);

		$tracts = $tracts->toArray();

		if($this->request->is('POST'))
		{

			$data = $this->request->data;
			$association_id = $data['association_id'];
			unset($data['association_id']);

			$result = $this->saveAmounts($data, $tracts, $association_id); //Guardamos los montos

			if($result[1])
			{
				$message = 'Se agregaron '.$result[1]." de ".count($tracts)." montos de tracto<br />";

				$resultBoxesTract = $this->saveBoxes($result[0],0,$tracts, $association_id); //Guardamos las cajas de tracto
				$resultBoxesGenerated = $this->saveBoxes($resultBoxesTract[0],1,$tracts,$association_id); //Guardamos las cajas de ingresos generados

				$message .= 'Se agregaron '.$resultBoxesTract[1]." de ".count($tracts)." cajas de tracto <br />";
				$message .= 'Se agregaron '.$resultBoxesGenerated[1]." de ".count($tracts)." cajas de ingresos generados";

				$this->Flash->success($message);

				return $this->redirect(['action'=>'add',$association_id]);
			}
			else
			{
				$this->Flash->error('Ocurrió un error al tratar de agregar los montos. Además tampoco se agregaron las cajas correspondientes. Verifique los datos que está ingresando e intente de nuevo.');
			}



		}

		$associations = $this->Amounts->Associations->find('list')
											->where(['enable'=>1]);
		$this->set(compact('tracts','associations'));

	}


	private function saveAmounts($data, $tracts, $association_id)
	{
		if(($this->request->session()->read('Auth.User.role')) != 'admin'){
			return $this->redirect($this->Auth->redirectUrl());
		}
		else{


			$detail = $data['detail'];
			unset($data['detail']);

			$index = 0;
			$result[1] = 0;

			$values['association_id'] = $association_id;
			$values['detail'] = $detail;
			$values['type'] = 0;

			foreach ($data as $key => $value) { //Se agrega monto por monto al tracto correspondiente

					$values['amount'] = $value;
					$values['tract_id'] = $tracts[$index]['id'];

					$entity = $this->Amounts->newEntity($values);

					try
					{
						if($this->Amounts->save($entity))
						{
							++$result[1];
						}
						else
						{
							unset($data[$key]);
						}
					}
					catch(Exception $e)
					{

					}



				++$index;


			}

			$result[0] = $data;
			return $result;
		}
	}


	private function saveBoxes($data, $type, $tracts,$association_id)
	{

		$this->loadModel('Boxes');

		$values['association_id'] = $association_id;
		$index = 0;
		$result[1] = 0;

		$values['type'] = $type;

		foreach ($data as $key => $value) { //Se agrega monto por monto al tracto correspondiente


			$values['little_amount'] = 0;
			$values['big_amount'] = 0;
			$values['tract_id'] = $tracts[$index]['id'];

			$entity = $this->Boxes->newEntity($values);

			try {
				if ($this->Boxes->save($entity)) {
					++$result[1];
				}
				else
				{
					unset($data[$key]);
				}
			} catch (Exception $e) {

			}


			++$index;
		}

		$result[0] = $data;
		return $result;
	}


	public function getTracts($year)
	{

			$query = $this->Amounts->Tracts->find()
			->hydrate(false)
				->where(['YEAR(date)'=>$year]); //Queremos los tractos del año actual



		$query = $query->toArray();

		return $query;
	}





/**
 *  Esta funcion devuelve el id del tracto correspondiente a la fecha enviada
 **/
	private function getTractId($actualDate)
	{
		$this->loadModel('Tracts');


		$id = $this->Tracts->find()
					->hydrate(false)
					->select(['id'])
					->where(function ($exp) use($actualDate) {
                        return $exp
                        	->lte('date',$actualDate) //<= date <= fecha actual
                        	->gte('deadline',$actualDate); //deadline >= fecha actual
                    });

        $id = $id->toArray();

		return (isset($id[0])? $id[0]['id']: null);
	}

	public function getAssociations($headquarter_name)
	{

		if($this->request->is("GET"))
		{
			$headquarter_id = $this->Amounts->Associations->Headquarters->find() //Se busca primero el id de esa sede por medio del nombre
									->hydrate(false)
									->select(['id'])
									->where(['name'=>$headquarter_name]);

			$headquarter_id = $headquarter_id->toArray();


			$associations = $this->Amounts->Associations->find() //Se obtienen los nombres de las asociaciones con el id recuperado
							->hydrate(false)
							->select(['name'])
							->where(['headquarter_id'=>$headquarter_id[0]['id']]);

			$associations = $associations->toArray();

			$associations = json_encode($associations);

			die($associations);
		}


	}


	public function getAssociationId($association_name)
	{
			$association_id = $this->Amounts->Associations->find() //Se busca primero el id de esa sede por medio del nombre
									->hydrate(false)
									->select(['id'])
									->where(['name'=>$association_name]);

			$association_id = $association_id->toArray();

			return $association_id[0]['id'];
	}


	public function edit($id = null)
	{

		try
		{
			$this->viewBuilder()->layout('admin_views');
			$amount = $this->Amounts->get($id, [
				'contain' => []
			]);



			if ($this->request->is(['patch', 'post', 'put'])) {

				$amount = $this->Amounts->patchEntity($amount, $this->request->data);
				if ($this->Amounts->save($amount)) {
					$this->Flash->success(__('El monto ha sido guardado.'));
					return $this->redirect(['action' => 'index']);
				} else {
					$this->Flash->error(__('El monto no ha podido ser guardado. Intentelo de nuevo'));
				}

			}


			$this->set(compact('amount'));
			$this->set('_serialize', ['amount']);
		}
		catch (RecordNotFoundException $e)
		{
			$this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
			return $this->redirect(['action' => 'index']);
		}

	}





    /**
     * Delete method
     *
     * @param string|null $id Surplus id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

          try
          {
              $this->viewBuilder()->layout('admin_views');
              $this->request->allowMethod(['post', 'delete']);
              $amount = $this->Amounts->get($id);
              try
              {
				  if(($this->request->session()->read('Auth.User.role')) == 'admin' && ($amount->type === 0 )) {
					  $this->deleteBoxes($amount->association_id, $amount->tract_id);
				  }


                  if ($this->Amounts->delete($amount)) {
                      $this->Flash->success(__('El monto ha sido borrado.'));
                  } else {
                      $this->Flash->error(__('El monto no ha podido ser borrado. Intentelo de nuevo'));
                  }
                  return $this->redirect(['action' => 'index']);
              }
              catch (\PDOException $e)
              {
                  $this->Flash->error(__('Error al borrar el monto. Esto puede deberse a que hay información asociada en la base de datos a este monto. Borre cualquier información asociada y luego intente de nuevo.'));
                  return $this->redirect(['action' => 'index']);
              }
          }
          catch (RecordNotFoundException $record)
          {
              $this->Flash->error(__('La información que está tratando de recuperar no existe en la base de datos. Verifique e intente de nuevo'));
              return $this->redirect(['action' => 'index']);
          }


    }


	private function deleteBoxes($association_id, $tract_id)
	{
		$this->loadModel('Boxes');

		try
		{
			$boxes = $this->Boxes->query();
			$boxes->delete()
				->andWhere(['association_id'=>$association_id, 'tract_id'=>$tract_id, 'type'=>0])
				->execute();

			$boxes = $this->Boxes->query();
			$boxes->delete()
				->andWhere(['association_id'=>$association_id, 'tract_id'=>$tract_id, 'type'=>1])
				->execute();
			$this->Flash->success(__('Se borraron las cajas asociadas a este monto'));
		}
		catch (\PDOException $e)
		{
			$this->Flash->error(__('No existen cajas asociadas a este monto. Verifique e intente de nuevo'));
			return $this->redirect(['action' => 'index']);
		}


	}

	public function isAuthorized($user)
	{
		
		if(in_array($this->request->action,['edit','delete']))
		{
			$amountId = (int)$this->request->params['pass'][0];
			$actualDate = date("Y-m-d");
			$tract_id = $this->getTractId($actualDate);
	        if ((($this->request->session()->read('Auth.User.role')) == 'rep') && $this->Amounts->isOwnedBy($amountId, $user['association_id'], $tract_id)) {
	            return true;
	        }
		}
		elseif(in_array($this->request->action,['addAmounts','index']))
		{
			return true;
		}



		return parent::isAuthorized($user);
	}




}