<?php
namespace App\Model\Table;

use App\Model\Entity\Qrcode;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Qrcodes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class QrcodesTable extends Table
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

        $this->table('qrcodes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo(
            'Users',
            [
                'foreignKey' => 'user_id'
            ]
        );


        $this->addBehavior('Timestamp');
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->add('link', 'valid', [
                    'rule' => 'url',
                    'message' => __("Please enter a valid link.")
                ]);

        $validator
            ->allowEmpty('label');

        $validator
            ->add('date', 'valid', [
                    'rule' => 'datetime',
                    'message' => __("Please enter a valid date.")
                ])
            ->allowEmpty('date');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }


}
