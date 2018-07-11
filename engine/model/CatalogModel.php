<?php

namespace engine\model;

use engine\core\Model;
use R;

class CatalogModel extends Model {


    public function getCatalogData($access, $cat, $sub_cat, $limit) {
        return 1;
    }

    public function getSelect($data_select) {
        if ( isset($data_select) ) {
            if ( $data_select['arr1'] == $data_select['arr2'] ) {
                $commerce_name = R::findOne('commerce', 'WHERE id = ? ORDER BY id', array($data_select['arr1']));
                echo '<option disabled selected>Выберите подкатегорию</option>';
                echo '<option value="'. $commerce_name->id .'">'. $commerce_name->name .'</option>';

            } else {
                $commerce_name = R::findAll('commerce', 'WHERE id between ? and ? ORDER BY id', array($data_select['arr1'], $data_select['arr2']));
                echo '<option disabled selected>Выберите подкатегорию</option>';
                foreach ( $commerce_name AS $value) {
                    echo '<option value="' . $value->id . '">'. $value->name .'</option>';
                }
            }
        }
    }

    public function getCatalog($data_catalog, $session_id, $access) {

            $commerce = (int)$data_catalog['search'];
            $curent_page = (int)$data_catalog['id'];
            $limit = 8;
            $iLeft = 4;
            $iRight = 5;
            if ($commerce != 0) {
                $needles=R::count('usercommerce', 'WHERE commerce = ?', array($commerce));
            } else {
                $needles=R::getAll('SELECT Count(DISTINCT users_id) FROM usercommerce');
                $needles = $needles[0]['Count(DISTINCT users_id)'];
            }

            $totalPages=ceil($needles/$limit);
            //$totalPages = 8;
            if ($totalPages != 0) {
                if ($commerce != 0) {
                    $all = R::findAll('usercommerce', 'WHERE commerce = ? ORDER BY id LIMIT ?,? ',array($commerce, (($curent_page-1)*$limit),$limit));
                } else {
                    $all = R::getAll('SELECT DISTINCT users_id FROM usercommerce ORDER BY id LIMIT ?,? ',array((($curent_page-1)*$limit),$limit));
                }

                if (!empty($all)) {
                    foreach ($all as $value) {
                        $user_id[] = $value['users_id'];
                    }
                    $favor = R::findAll('userfavor', 'WHERE user_id = ?', array($session_id));
                    $users = R::loadAll('users', $user_id);
                    $country = include 'engine/config/country_list.php';
                    foreach ($users as $user) {
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

                    $pagination = '<div class="row flex-row justify-content-center">';
                    $pagination .= '<div class="pagination_page"';
                if (($curent_page - 1) > 0) {
                    $pagination .= ' onclick="reuestcat('. ($curent_page - 1) .')"';
                }
                    $pagination .=  '>&laquo;</div>';
                if ($curent_page > $iLeft && $curent_page < ($totalPages - $iRight)) {
                    for ($i = $curent_page - $iLeft; $i <= $curent_page + $iRight; $i++) {
                        $pagination .=  '<div class="pagination_page';
                        if ($curent_page == $i) {
                            $pagination .=  ' active';
                        }
                        $pagination .=  '"';
                        if ( $curent_page != $i ) { $pagination .=  'onclick="reuestcat('. $i .')"'; }
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
                            if ( $curent_page != $i ) { $pagination .=  'onclick="reuestcat('. $i .')"'; }
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
                            if ( $curent_page != $i ) { $pagination .=  'onclick="reuestcat('. $i .')"'; }
                            $pagination .=  '>' . $i . '</div>';
                        }
                    }
                }
                    $pagination .=  '<div class="pagination_page"';
                if (($curent_page + 1) <= $totalPages) { $pagination .=  ' onclick="reuestcat('. ($curent_page + 1) .')"'; }
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














//            if ( $curent_page <= $totalPages ) {
//                if ( $all != NULL ) {
//                    echo '<input value="'. $data_catalog["search"] .'" id="search" type="hidden">';
//
//                    foreach ($all AS $value) {
//                        $check = R::findOne('favor', 'WHERE user_id = ? AND company_id = ?', array($user_id, $value->id));
//                        echo '<div class="card">';
//                        echo '<button onclick="favor('. $value->id .')" id="'. $value->id .'" class="favor';
//                        if ($check) { echo ' orange';}
//                        echo '"><i class="fa fa-star"></i></button>';
//                        echo '<img src="img/1.png" alt="' . $value->name . '">';
//                        echo '<h1>' . $value->name . '</h1>';
//                        echo '<p class="title">' . $value->country . '</p>';
//                        echo '<a href="' . $value->site . '"><i class="fa fa-dribbble"></i></a>';
//                        echo '<a href="' . $value->facebook . '"><i class="fa fa-facebook"></i></a>';
//                        echo '</div>';
//                    }
//                } else {
//                    echo '<div class="error">Ничего не найдено</div>';
//                }
//                echo '<div class="pagination">';
//                echo '<div class="pagination_page"';
//                if (($curent_page - 1) > 0) { echo ' onclick="reuestcat('. ($curent_page - 1) .')"'; }
//                echo '>&laquo;</div>';
//                if ($curent_page > $iLeft && $curent_page < ($totalPages - $iRight)) {
//                    for ($i = $curent_page - $iLeft; $i <= $curent_page + $iRight; $i++) {
//                        echo '<div class="pagination_page';
//                        if ($curent_page == $i) {
//                            echo ' active';
//                        }
//                        echo '"';
//                        if ( $curent_page != $i ) { echo 'onclick="reuestcat('. $i .')"'; }
//                        echo '>' . $i . '</div>';
//                    }
//                } elseif ($curent_page <= $iLeft) {
//                    $iSlice = 1 + $iLeft - $curent_page;
//                    for ($i = 1; $i <= $curent_page + ($iRight + $iSlice); $i++) {
//                        if ($i > 0 AND $i <= $totalPages) {
//                            echo '<div class="pagination_page';
//                            if ($curent_page == $i) {
//                                echo ' active';
//                            }
//                            echo '"';
//                            if ( $curent_page != $i ) { echo 'onclick="reuestcat('. $i .')"'; }
//                            echo '>' . $i . '</div>';
//                        }
//                    }
//                } else {
//                    $iSlice = $iRight - ($totalPages - $curent_page);
//                    for ($i = $curent_page - ($iLeft + $iSlice); $i <= $totalPages; $i++) {
//                        if ($i > 0 AND $i <= $totalPages) {
//                            echo '<div class="pagination_page';
//                            if ($curent_page == $i) {
//                                echo ' active';
//                            }
//                            echo '"';
//                            if ( $curent_page != $i ) { echo 'onclick="reuestcat('. $i .')"'; }
//                            echo '>' . $i . '</div>';
//                        }
//                    }
//                }
//                echo '<div class="pagination_page"';
//                if (($curent_page + 1) <= $totalPages) { echo ' onclick="reuestcat('. ($curent_page + 1) .')"'; }
//                echo '>&raquo;</div>';
//                echo '</div>';
//
//            } else {
//                echo '<div class="error">Страница не найдена</div>';
//            }


}