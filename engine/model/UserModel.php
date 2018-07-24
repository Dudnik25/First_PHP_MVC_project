<?php

namespace engine\model;

use engine\core\Model;
use R;

class UserModel extends Model {

    protected $user;

    public function __construct($id) {
        parent::__construct();
        $this->user = $this->db->loadUser($id);
    }

    public function checkUserPage() {
        if ($this->user->id != 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUserData($access) {

        $data['access'] = $access;
        $data['name'] = $this->user->name;
        $data['country'] = $this->user->country;
        $data['infomin'] = $this->user->infomin;
        $data['infomax'] = $this->user->infomax;
        $data['site'] = $this->user->site;
        $data['facebook'] = $this->user->facebook;
        $data['adress'] = $this->user->adress;
        $commerce = $this->user->ownUsercommerceList;

        if ($commerce != null) {
            foreach ($commerce as $value) {
                $result = $this->db->loadOne('commerce', $value->commerce);
                $commercename[] = $result->name;
            }
            unset($result);
            $data['commerce'] = $commercename;
        }
        $companytype = $this->user->ownUsercompanytypeList;
        if ($companytype != null) {
            foreach ($companytype as $value) {
                $result = $this->db->loadOne('companytype', $value->companytype);
                $companytypename[] = $result->name;
            }
            unset($result);
            $data['companytype'] = $companytypename;
        }
        if ($access <= 1) {
            return $data;
        } elseif ($access > 1) {
            $contacts = $this->user->ownUsercontactsList;
            if ($contacts != null) {
                foreach ($contacts as $key => $value) {
                    $result['name'] = $value->name;
                    $result['surname'] = $value->surname;
                    $result['position'] = $value->position;
                    $result['email'] = $value->email;
                    $result['number'] = $value->number;
                    $contactsname[] = $result;
                }
                unset($result);
                $data['contacts'] = $contactsname;
            }
            return $data;
        }
    }

    public function checkUserSettings() {
        $data['name'] = $this->user->name;
        $data['commerce'] = $this->db->findAll('commerce');
        $data['companytype'] = $this->db->findAll('companytype');
        $data['infomin'] = $this->user->infomin;
        $data['infomax'] = $this->user->infomax;
        $data['site'] = $this->user->site;
        $data['facebook'] = $this->user->facebook;
        $data['adress'] = $this->user->adress;
        $data['country'] = $this->user->country;
        $data['country_list'] = require 'engine/config/country_list.php';
        $commerce = $this->user->ownUsercommerceList;

        if ($commerce != null) {
            foreach ($commerce as $value) {
                $result = $this->db->loadOne('commerce', $value->commerce);
                $commercename[] = $result->id;
            }
            unset($result);
            $data['commercecheck'] = $commercename;
        }
        $companytype = $this->user->ownUsercompanytypeList;
        if ($companytype != null) {
            foreach ($companytype as $value) {
                $result = $this->db->loadOne('companytype', $value->companytype);
                $companytypename[] = $result->id;
            }
            unset($result);
            $data['companytypecheck'] = $companytypename;
        }
        $contacts = $this->user->ownUsercontactsList;
        if ($contacts != null) {
            foreach ($contacts as $key => $value) {
                $result['name'] = $value->name;
                $result['surname'] = $value->surname;
                $result['position'] = $value->position;
                $result['email'] = $value->email;
                $result['number'] = $value->number;
                $contactsname[] = $result;
            }
            unset($result);
            $data['contactscheck'] = $contactsname;
        }
        return $data;
    }

    public function validateUserSettings($data) {

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

        if (empty($data['name'])) {
            $errors[] = 'Введите название вашей компании';
        }
        if ( !isset($data['country']) OR $data['country'] == 'none') {
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
                    if ($companytype[$i] == 'none') {
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
                    if ($commerce[$i] == 'none') {
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

    public function saveUserSettings($data) {
        //Устанавливаем новые настройки для пользователя
        $this->user->name = $data['name'];
        $this->user->infomin = $data['infomin'];
        $this->user->country = $data['country'];
        $this->user->infomax = $data['infomax'];
        $this->user->site = $data['site'];
        $this->user->facebook = $data['facebook'];
        $this->user->adress = $data['adress'];
        //Задаем комерческие интересы и удаляем ненужные
        $i = 0;
        foreach ($this->user->ownUsercommerceList as $key => $value) {
            if (isset($data['commerce'][$i]) AND $data['commerce'][$i] != 'none') {
                $value->commerce = $data['commerce'][$i];
            } else {
                unset($this->user->xownUsercommerceList[$key]);
            }
            $i++;
        }
        for ( $j = $i; $j < 5; $j++ ) {
            if (isset($data['commerce'][$j]) AND $data['commerce'][$j] != 'none') {
                $add_commerce = R::dispense('usercommerce');
                $add_commerce->commerce = $data['commerce'][$j];
                $this->user->ownUsercommereList[] = $add_commerce;
            }
        }
        //Задаем типы компании и удаляем ненужные
        $i = 0;
        foreach ($this->user->ownUsercompanytypeList as $key => $value) {
            if (isset($data['companytype'][$i]) AND $data['companytype'][$i] != 'none') {
                $value->companytype = $data['companytype'][$i];
            } else {
                unset($this->user->xownUsercompanytypeList[$key]);
            }
            $i++;
        }
        for ( $j = $i; $j < 5; $j++ ) {
            if (isset($data['companytype'][$j]) AND $data['companytype'][$j] != 'none') {
                $add_companytype = R::dispense('usercompanytype');
                $add_companytype->companytype = $data['companytype'][$j];
                $this->user->ownUsercompanytypeList[] = $add_companytype;
            }
        }
        //Задаем комтактных особ и удаляем не нужных
        $i = 0;
        foreach ($this->user->ownUsercontactsList as $key => $value) {
            if (!empty($data['contact_name'][$i])) {
                $value->name = $data['contact_name'][$i];
                $value->surname = $data['contact_surname'][$i];
                $value->position = $data['contact_position'][$i];
                $value->email = $data['contact_email'][$i];
                $value->number = $data['contact_number'][$i];
            } else {
                unset($this->user->xownUsercontactsList[$key]);
            }
            $i++;
        }
        for ( $j = $i; $j < 5; $j++ ) {
            if (!empty($data['contact_name'][$j])) {
                $add_contacts = R::dispense('usercontacts');
                $add_contacts->name = $data['contact_name'][$j];
                $add_contacts->surname = $data['contact_surname'][$j];
                $add_contacts->position = $data['contact_position'][$j];
                $add_contacts->email = $data['contact_email'][$j];
                $add_contacts->number = $data['contact_number'][$j];
                $this->user->ownUsercontactsList[] = $add_contacts;
            }
        }

        R::store($this->user);

    }

}