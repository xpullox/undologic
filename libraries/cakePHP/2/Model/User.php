<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Group $Group
 * @property UserType $UserType
 */
class User extends AppModel
{

    /**
     * Use database config
     *
     * @var string
     */
    public $useDbConfig = 'live';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'group_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'UserType' => array(
            'className' => 'UserType',
            'foreignKey' => 'user_type_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Term' => array(
            'className' => 'Term',
            'foreignKey' => 'term_id',
            'conditions' => '',
            'fields' => '',
            'order' => 'Term.name ASC'
        )
    );

    public $hasMany = array(
        'QuoteRow' => array(
            'className' => 'QuoteRow',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),

        'Ticket' => array(
            'className' => 'Ticket',
            'foreignKey' => 'user_id',
            'dependent' => FALSE,
            'conditions' => '',
            'fields' => '', 'order' => '', 'limit' => '', 'offset' => '', 'exclusive' => '', 'finderQuery' => '', 'counterQuery' => ''),
        'QueuedEmail' => array(
            'className' => 'QueuedEmail',
            'foreignKey' => 'user_id',
            'dependent' => FALSE,
            'conditions' => '',
            'fields' => '', 'order' => '', 'limit' => '', 'offset' => '', 'exclusive' => '', 'finderQuery' => '', 'counterQuery' => ''),

        'ShipmentOverride' => array(
            'className' => 'ShipmentOverride',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Archive' => array(
            'className' => 'Archive',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Verify' => array(
            'className' => 'Verify',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )


        //'RebatePricing' => array('className' => 'RebatePricing', 'foreignKey' => 'rebate_supplier_id', 'dependent' => FALSE, 'conditions' => '', 'fields' => '', 'order' => '', 'limit' => '', 'offset' => '', 'exclusive' => '', 'finderQuery' => '', 'counterQuery' => ''),


    );

    function doesUserExist($email)
    {
        $user = $this->find('first', array(
            'conditions' => array('User.email' => $email)));
        // pr ($user);
        // exit;
        if ($user) {
            return $user;
        } else {
            return FALSE;
        }
    }

    function isUserAuthenticated($token, $params, $headers)
    {

        if (empty($token)) {
            if (isset($headers['token'])) {
                if (!empty($headers['token'])) {
                    $token = $headers['token'];
                }
            }
        }

        $this->writeToLog('login', 'isAuthenticated?');
        //using the token in the session - lookup the db

        if (empty($params['prefix'])) {
            $this->writeToLog('login', 'no token - no prefix it is ok');
            return true;
        }

        if (empty($token)) {

            //no token and this is a prefix, so they must login
            return false;
        } else {
            //lookup the session in the db
            $user = $this->getUserByToken($token);
            $user_type_id = $user['user_type_id'];

            if (empty($user)) {
                return false;
            } else {
                $prefix = $params['prefix'];

                $levels = Configure::read('Users.user_type_id');
                $prefix_id = $levels[$prefix];

                if ($user_type_id >= $prefix_id) {
                    $this->writeToLog('login', 'userTypeId is above the prefix level');

                    return $user;
                } else {
                    $this->writeToLog('login', 'below the user_type_is level');

                    return false;
                }
            }

        }
    }

    function tryLogin($email, $pass)
    {

        $conditions = array('AND' => array(
            array('User.email' => $email),
            array('User.password' => $pass),
        ));
        $model = 'User';
        $data = $this->find('first', array(
            'conditions' => $conditions
        ));
        if (!empty($data)) {
            //we have this user
            $uniqID = uniqid();
            $data['User']['token'] = $uniqID;
            if ($this->save($data)) {
                //saved
                return $uniqID;
            } else {
                die ('could not save');
            }
        }
        return false;

    }


    function getUserByToken($token)
    {

        $conditions = array(
            'User.token' => $token
        );

        $this->writeToLog('login', 'looking for user: ' . json_encode($conditions));

        $model = 'User';
        $data = $this->find('first', array(
            'conditions' => $conditions
        ));

        if (!empty($data)) {
            return $data['User'];
        } else {
            return false;
        }

    }


    /**
     * Use database config
     *
     * @var string
     */

    function loginUser($email, $password) {

        $conditions = array('AND' => array(
            array('User.email' => $email),
            array('User.password' => $password),
        ));

        $found = $this->find('first', array(
            'conditions' => $conditions
        ));

        if (!empty($found)) {

            $this->data['User'] = $found['User'];

            $token = uniqid();
            $this->data['User']['token'] = $token;

            if ($this->save($this->data)) {

                $_SESSION['token'] = $token;

                return $token;
            } else {
                die ('cannot save');
            }
        }

        return false;
    }




















}