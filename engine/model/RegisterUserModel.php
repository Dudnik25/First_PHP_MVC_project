<?php

namespace engine\model;

use engine\core\Model;
use R;

class RegisterUserModel extends Model {

    public function findRegParams() {
        $params['commerce'] = $this->db->findAll('commerce');
        $params['companytype'] = $this->db->findAll('companytype');
        $params['country_list'] = require 'engine/config/country_list.php';
        return $params;
    }

    public function validationRegister($data) {
        $errors = array();
        $contact_name = $data['contact_name'];
        $contact_surname = $data['contact_surname'];
        $contact_position = $data['contact_position'];
        $contact_email = $data['contact_email'];
        $contact_number = $data['contact_number'];
        $contact_check = $data['contact_check'];
        $companytype_check = $data['companytype_check'];
        $commerce_check = $data['commerce_check'];

        $contact_name = $this->cleanArray($contact_name);
        $contact_surname = $this->cleanArray($contact_surname);
        $contact_position = $this->cleanArray($contact_position);
        $contact_email = $this->cleanArray($contact_email);
        $contact_number = $this->cleanArray($contact_number);
        $email_validate = filter_var($data['email'], FILTER_VALIDATE_EMAIL);

        if (empty($data['name'])) {
            $errors[] = 'Введите название вашей компании';
        } else {
            $data['name'] = $this->clean($data['name']);
        }
        if (empty($data['email'])) {
            $errors[] = 'Введите адрес електронной почты';
         } else {
            $data['email'] = $this->clean($data['email']);
        }
        if ( !$email_validate ) {
            $errors[] = 'Не коректный емайл адрес';
        }
        if ($this->validateLogin($data['email'])) {
            $errors[] = 'Emeil занят';
        }
        if (empty($data['password'])) {
            $errors[] = 'Введите пароль';
        }
        if ( $data['password2'] != $data['password'] ) {
            $errors[] = 'Пароли не совпадают';
        }
        if ( !isset($data['country']) ) {
            $errors[] = 'Выбирите страну из списка';
        } else {
            $this->clean($data['country']);
        }
        if (empty($data['infomin'])) {
            $errors[] = 'Введите краткую информацию о вашей компании';
        } else {
            $data['infomin'] = $this->clean($data['infomin']);
        }
        if ( $this->check_length($data['infomin'], 10, 200) ) {
            $errors[] = 'Краткая информация о компании должна содержать от 10 до 200 символов';
        }
        if (isset($data['site']) && $data['site'] != '') {
            $data['site'] = $this->clean($data['site']);
        } else {
            $data['site'] = '';
        }
        if (isset($data['facebook']) && $data['facebook'] != '') {
            $data['facebook'] = $this->clean($data['facebook']);
        } else {
            $data['facebook'] = '';
        }
        if (isset($data['adress']) && $data['adress'] != '') {
            $data['adress'] = $this->clean($data['adress']);
        } else {
            $data['adress'] = '';
        }
        if (isset($data['infomax']) && $data['infomax'] != '') {
            $data['infomax'] = $this->clean($data['infomax']);
        } else {
            $data['infomax'] = '';
        }
        if ( !isset($data['companytype']) ) {
            $errors[] = 'Выберите тип компании';
        } else {
            $this->cleanArray($data['companytype']);
            $companytype = $data['companytype'];
            for ($i = 0; $i < 5; $i++) {
                if ($companytype_check[$i] == 'yes') {
                    if (!isset($companytype[$i])) {
                        $errors[] = 'Выберите тип компании';
                    }
                }
            }
        }
        if ( !isset($data['commerce']) ) {
            $errors[] = 'Выберите тип компании';
        } else {
            $this->cleanArray($data['commerce']);
            $commerce = $data['commerce'];
            for ($i = 0; $i < 5; $i++) {
                if ($commerce_check[$i] == 'yes') {
                    if (!isset($commerce[$i])) {
                        $errors[] = 'Выберите комерческие интересы';
                    }
                }
            }
        }
        for ($i = 0; $i < 5; $i++) {
            if ($contact_check[$i] == 'yes') {
                if ($contact_name[$i] == '' OR $contact_surname[$i] == '' OR $contact_position[$i] == '' OR $contact_email[$i] == '') {
                    $errors[] = 'Введите данные контактной особы';
                }
            }
        }
        $data['errors'] = array_shift($errors);
        return $data;

    }

    private function validateLogin($login) {
    $user = $this->db->findUser($login);
    if (!empty($user)) {
        return true;
    } else {
        return false;
    }
}

    public function saveUser($data) {

        $user = R::dispense('users');
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->access = 1;
        $user->country = $data['country'];
        $user->infomin = $data['infomin'];
        $user->infomax = $data['infomax'];
        $user->site = $data['site'];
        $user->facebook = $data['facebook'];
        $user->adress = $data['adress'];
        $user->regdate = date('y-m-d');

        foreach ($data['companytype'] as $key => $value) {
            $user_companytype = R::dispense('usercompanytype');
            $user_companytype->companytype = $value;
            $user->ownUsercompanytypeList[] = $user_companytype;
        }
        foreach ($data['commerce'] as $key => $value) {
            $user_commerce = R::dispense('usercommerce');
            $user_commerce->commerce = $value;
            $user->ownUsercommerceList[] = $user_commerce;
        }
        foreach ($data['contact_name'] as $key => $value) {
            if ( $value != '' ) {
                $name[$key] = $value;
            }
        }
        foreach ($data['contact_surname'] as $key => $value) {
            if ( $value != '' ) {
                $surname[$key] = $value;
            }
        }
        foreach ($data['contact_position'] as $key => $value) {
            if ( $value != '' ) {
                $position[$key] = $value;
            }
        }
        foreach ($data['contact_email'] as $key => $value) {
            if ( $value != '' ) {
                $email[$key] = $value;
            }
        }
        foreach ($data['contact_number'] as $key => $value) {
            if ( $value != '' ) {
                $number[$key] = $value;
            } else {
                $number[$key] = '';
            }
        }
        for ( $i = 0; $i < count($name); $i++ ) {
            $user_contacts = R::dispense('usercontacts');
            $user_contacts->name = $name[$i];
            $user_contacts->surname = $surname[$i];
            $user_contacts->position = $position[$i];
            $user_contacts->email = $email[$i];
            $user_contacts->number = $number[$i];
            $user->ownUsercontactsList[] = $user_contacts;
        }

        R::store($user);

    }

}