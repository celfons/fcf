<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('username', 'Usu�rio � necess�rio')
            ->notEmpty('password', 'Senha � necess�ria')
            ->notEmpty('role', 'Fun��o � necess�ria')
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'author']],
                'message' => 'Por favor informe uma fun��o v�lida'
            ]);
    }

}