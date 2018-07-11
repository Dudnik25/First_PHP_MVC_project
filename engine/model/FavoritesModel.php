<?php

namespace engine\model;
use R;


class FavoritesModel {

    public function checkFavor($user_id, $company_id) {
        $favorit = R::findOne('userfavor', 'WHERE user_id = ? AND company_id = ?', array($user_id, $company_id));
        if (isset($favorit)){
            R::trash($favorit);
            echo 'remove';
        } else {
            $favor = R::dispense('userfavor');
            $favor->user_id = $user_id;
            $favor->company_id = $company_id;
            R::store($favor);
            echo 'add';
        }
    }

    public function showFavor($data_favor, $u_id) {
        $curent_page = (int)$data_favor;
        $limit = 10;
        $iLeft = 4;
        $iRight = 5;
        $needles=R::count('userfavor', 'WHERE user_id = ?', array($u_id));
        $totalPages=ceil($needles/$limit);
        //$totalPages = 8;
        if ($totalPages != 0) {
            $all = R::findAll('userfavor', 'WHERE user_id = ? ORDER BY id LIMIT ?,? ',array($u_id, (($curent_page-1)*$limit),$limit));
//            echo '<pre>';
//            print_r($all);
//            exit();
            if (!empty($all)) {
                foreach ($all as $value) {
                    $user_id[] = $value['company_id'];
                }
                $users = R::loadAll('users', $user_id);
                $country = include 'engine/config/country_list.php';
                foreach ($users as $user) {
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
                        'name' => $user->name,
                        'infomin' => $user->infomin,
                        'country' => $country[$user->country],
                        'regdate' => $user->regdate,
                        'site' => $user->site,
                        'facebook' => $user->facebook,
                        'commerce' => $comerce,
                        'companytype' => $companytype,
                        'favor' => true
                    ];
                    unset($comerce);
                    unset($companytype);
                }

                $pagination = '<div class="row flex-row justify-content-center text-white">';
                $pagination .= '<div class="pagination_page"';
                if (($curent_page - 1) > 0) {
                    $pagination .= ' onclick="favor_page('. ($curent_page - 1) .')"';
                }
                $pagination .=  '>&laquo;</div>';
                if ($curent_page > $iLeft && $curent_page < ($totalPages - $iRight)) {
                    for ($i = $curent_page - $iLeft; $i <= $curent_page + $iRight; $i++) {
                        $pagination .=  '<div class="pagination_page';
                        if ($curent_page == $i) {
                            $pagination .=  ' active';
                        }
                        $pagination .=  '"';
                        if ( $curent_page != $i ) { $pagination .=  'onclick="favor_page('. $i .')"'; }
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
                            if ( $curent_page != $i ) { $pagination .=  'onclick="favor_page('. $i .')"'; }
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
                            if ( $curent_page != $i ) { $pagination .=  'onclick="favor_page('. $i .')"'; }
                            $pagination .=  '>' . $i . '</div>';
                        }
                    }
                }
                $pagination .=  '<div class="pagination_page"';
                if (($curent_page + 1) <= $totalPages) { $pagination .=  ' onclick="favor_page('. ($curent_page + 1) .')"'; }
                $pagination .=  '>&raquo;</div>';
                $pagination .=  '</div>';

                return array(
                    'data' => $data,
                    'pagination' => $pagination
                );
            }
        } else {
            echo '<div class="error text-center text-white">Ничего не найдено</div>';
            return false;
        }
    }

}