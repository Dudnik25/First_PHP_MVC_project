<?php

namespace engine\model;


use engine\core\Model;
use R;

class AdminModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAdminPageContent($curent_page, $session_id) {
        $limit = 10;
        $iLeft = 4;
        $iRight = 5;
        $needles=R::count('users');
        $totalPages=ceil($needles/$limit);

        //$totalPages = 8;
        if ($totalPages != 0) {
            $all = R::findAll('users', 'ORDER BY regdate DESC LIMIT ?,? ',array((($curent_page-1)*$limit),$limit));
//            echo '<pre>';
//            print_r($all);
//            exit();

            if (!empty($all)) {
                $favor = R::findAll('userfavor', 'WHERE user_id = ?', array($session_id));
                $country = include 'engine/config/country_list.php';
                foreach ($all as $user) {
                    $fav = false;
                    foreach ($favor as $value) {
                        if ($user->id == $value->company_id) {
                            $fav = true;
                        }
                    }
                    foreach ($user->ownUsercommerceList as $value) {
                        $id = $value->commerce;
                        $bean = R::load('commerce', $id);
                        $comerce[] = $bean->name;
                    }
                    foreach ($user->ownUsercompanytypeList as $value) {
                        $id = $value->companytype;
                        $bean = R::load('companytype', $id);
                        $companytype[] = $bean->name;
                    }
                    $data[] = [
                        'id' => $user->id,
                        'access' => $user->access,
                        'name' => $user->name,
                        'infomin' => $user->infomin,
                        'country' => $country[$user->country],
                        'regdate' => $user->regdate,
                        'site' => $user->site,
                        'facebook' => $user->facebook,
                        'commerce' => $comerce,
                        'companytype' => $companytype,
                        'favor' => $fav
                    ];
                    unset($comerce);
                    unset($companytype);
                }

                $pagination = '<div class="row flex-row justify-content-center text-white">';
                $pagination .= '<div class="pagination_page"';
                if (($curent_page - 1) > 0) {
                    $pagination .= ' onclick="getAdminContent('. ($curent_page - 1) .')"';
                }
                $pagination .=  '>&laquo;</div>';
                if ($curent_page > $iLeft && $curent_page < ($totalPages - $iRight)) {
                    for ($i = $curent_page - $iLeft; $i <= $curent_page + $iRight; $i++) {
                        $pagination .=  '<div class="pagination_page';
                        if ($curent_page == $i) {
                            $pagination .=  ' active';
                        }
                        $pagination .=  '"';
                        if ( $curent_page != $i ) { $pagination .=  'onclick="getAdminContent('. $i .')"'; }
                        $pagination .=  '>' . $i . '</div>';
                    }
                } elseif ($curent_page <= $iLeft) {
                    $iSlice = 1 + $iLeft - $curent_page;
                    for ($i = 1; $i <= $curent_page + ($iRight + $iSlice); $i++) {
                        if ($i > 0 AND $i <= $totalPages) {
                            $pagination .=  '<div class="pagination_page';
                            if ($curent_page == $i) {
                                $pagination .=  ' active';
                            }
                            $pagination .=  '"';
                            if ( $curent_page != $i ) { $pagination .=  'onclick="getAdminContent('. $i .')"'; }
                            $pagination .=  '>' . $i . '</div>';
                        }
                    }
                } else {
                    $iSlice = $iRight - ($totalPages - $curent_page);
                    for ($i = $curent_page - ($iLeft + $iSlice); $i <= $totalPages; $i++) {
                        if ($i > 0 AND $i <= $totalPages) {
                            $pagination .=  '<div class="pagination_page';
                            if ($curent_page == $i) {
                                $pagination .=  ' active';
                            }
                            $pagination .=  '"';
                            if ( $curent_page != $i ) { $pagination .=  'onclick="getAdminContent('. $i .')"'; }
                            $pagination .=  '>' . $i . '</div>';
                        }
                    }
                }
                $pagination .=  '<div class="pagination_page"';
                if (($curent_page + 1) <= $totalPages) { $pagination .=  ' onclick="getAdminContent('. ($curent_page + 1) .')"'; }
                $pagination .=  '>&raquo;</div>';
                $pagination .=  '</div>';

                return array(
                    'data' => $data,
                    'pagination' => $pagination
                );
            }
        } else {
            echo '<div class="error text-center text-white">Нет новых компаний</div>';
            return false;
        }
    }

}