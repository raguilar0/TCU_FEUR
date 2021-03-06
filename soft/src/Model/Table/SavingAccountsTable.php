<?php
namespace App\Model\Table;

use App\Model\Entity\SavingAccount;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SavingAccounts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Associations
 * @property \Cake\ORM\Association\BelongsTo $Tracts
 */
class SavingAccountsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('saving_accounts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Associations', [
            'foreignKey' => 'association_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Tracts', [
            'foreignKey' => 'tract_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create')
            ->requirePresence('tract_id', 'create');

        $validator
            ->numeric('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount')
            ->add('amount', 'validFormat', [
                        'rule' => array('custom', '/^[0-9\,\.]+$/'),
                        'message' => 'Formato inválido. Solo números.'
            ]);

        $validator
            ->requirePresence('bank', 'create')
            ->notEmpty('bank')
            ->add('bank', 'validFormat', [
                        'rule' => array('custom', '/^[A-Za-z0-9" "\,\.\-\:áéíóúÁÉÍÓÚñÑ\[\]\(\)\"]+$/'),
                        'message' => 'Formato inválido.'
            ]);

        $validator
            ->requirePresence('account_owner', 'create')
            ->notEmpty('account_owner')
            ->add('account_owner', 'validFormat', [
                        'rule' => array('custom', '/^[A-Za-z0-9" "\,\.\-\:áéíóúÁÉÍÓÚñÑ\[\]\(\)\"]+$/'),
                        'message' => 'Formato inválido.'
            ]);

        $validator
            ->requirePresence('card_number', 'create')
            ->notEmpty('card_number')
            ->add('card_number', 'validFormat', [
                        'rule' => array('custom', '/^[0-9\-]+$/'),
                        'message' => 'Formato inválido. Sólo números'
            ]);


        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['association_id'], 'Associations'));
        $rules->add($rules->existsIn(['tract_id'], 'Tracts'));
        return $rules;
    }


    public function isOwnedBy($accountId, $association_id, $tract_id)
    {

        return $this->exists(['id' => $accountId, 'association_id' => $association_id, 'tract_id'=>$tract_id]);
    }

}
