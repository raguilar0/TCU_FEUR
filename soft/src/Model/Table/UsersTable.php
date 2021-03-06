<?php
// src/Model/Table/UsersTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class UsersTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->belongsTo('Associations');

    }

    public function validationDefault(Validator $validator)
    {

       $validator


              ->notEmpty('password', 'Contraseña requerida')
              ->add('password', 'validFormat',[
                'rule'=>array('custom', '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/'),
                'message' => 'Password debe tener mínimo 8 letras y al menos un dígito'
              ])
              ->notEmpty('repass', 'Ingrese su contraseña de nuevo.')
              ->add('repass', [
                      'compare' => [
                                  'rule' => ['compareWith','password'],
                                  'message' => 'Las contraseñas no coinciden.'
                                  ]
              ])
              ->notEmpty('name', 'Nombre requerido')
              ->add('name', 'validFormat', [
                          'rule' => array('custom', '/^[A-Za-z0-9" "\,\.\-\:áéíóúÁÉÍÓÚñÑ\[\]\(\)\"]+$/'),
                          'message' => 'Formato inválido.'
              ])

              ->notEmpty('last_name_1')
              ->add('last_name_1', 'validFormat', [
                          'rule' => array('custom', '/^[A-Za-z0-9" "\,\.\-\:áéíóúÁÉÍÓÚñÑ\[\]\(\)\"]+$/'),
                          'message' => 'Formato inválido.'
              ])
              ->notEmpty('last_name_2')
              ->add('last_name_2', 'validFormat', [
                          'rule' => array('custom', '/^[A-Za-z0-9" "\,\.\-\:áéíóúÁÉÍÓÚñÑ\[\]\(\)\"]+$/'),
                          'message' => 'Formato inválido.'
              ])
              ->notEmpty('role')
              ->notEmpty('username')
              ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message'=>'Este nombre de usuario ya está siendo usado'])
              ->add('username', 'validFormat', [
                          'rule' => array('custom', '/^[a-z0-9\_\-\.ñ]+@ucr.ac.cr$/'),
                          'message' => 'Debe ser un correo institucional válido.'

              ])
              ;






      return $validator;
    }


        public function validationChangePassword(Validator $validator)
        {
            $validator


              ->notEmpty('password', 'Contraseña requerida')
              ->add('password', 'validFormat',[
                'rule'=>array('custom', '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/'),
                'message' => 'Password debe tener mínimo 8 caracteres y al menos un número'
              ])
              ->notEmpty('repass', 'Ingrese su contraseña de nuevo.')
              ->add('repass', [
                      'compare' => [
                                  'rule' => ['compareWith','password'],
                                  'message' => 'Las contraseñas no coinciden.'
                                  ]
              ]);

              return $validator;
        }



    public function validationChangePass(Validator $validator)
    {
        $validator
            ->add('old_password','custom',[
                'rule'=>  function($value, $context){
                    $user = $this->get($context['data']['id']);
                    if ($user && (new DefaultPasswordHasher)->check($value, $user->password)) {
                        return true;
                    }
                    return false;
                },
                'message'=>'La contraseña antigua no coincide',
                'errorField' =>'old_password'
            ])
            ->notEmpty('old_password');

        $validator
            ->add('password', 'validFormat',[
                'rule'=>array('custom', '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/'),
                'message' => 'Password debe tener mínimo 8 caracteres y al menos un número'
            ])
            ->add('password',[
                'match'=>[
                    'rule'=> ['compareWith','repass'],
                    'message'=>'¡Las contraseñas no son iguales!',
                ]
            ])
            ->notEmpty('password');

        return $validator;
    }


    public function isOwnedBy($userId, $association_id)
    {
        return $this->exists(['id' => $userId, 'association_id' => $association_id]);
    }

}
?>
