<?php

namespace engine\model;

use engine\core\Model;

class EventsModel extends Model {

    public function makeCal($year, $month) {
    // Получаем номер дня недели для 1 числа месяца. Корректируем
    // его, чтобы воскресенье соответствовало числу 7, а не числу 0.
    $wday = JDDayOfWeek(GregorianToJD($month, 1, $year), 0);
    if ($wday == 0) $wday = 7;
    // Начинаем с этого числа в месяце (если меньше нуля
    // или больше длины месяца, тогда в календаре будет пропуск).
    $n = - ($wday - 2);
    $cal = [];
    // Цикл по строкам.
    for ($y=0; $y<6; $y++) {
        // Будущая строка. Вначале пуста.
        $row = [];
        $notEmpty = false;
        // Цикл внутри строки по дням недели.
        for ($x=0; $x<7; $x++, $n++) {
            // Текущее число >0 и < длины месяца?
            if (checkdate($month, $n, $year)) {
                // Да. Заполняем клетку.
                $row[] = $n;
                $notEmpty = true;
            } else {
                // Нет. Клетка пуста.
                $row[] = "";
            }
        }
        // Если в данной строке нет ни одного непустого элемента,
        // значит, месяц кончился.
        if (!$notEmpty) break;
        // Добавляем строку в массив.
        $cal[] = $row;
        }
        return $cal;
        }



    public function getNext($get_year, $get_mon) {
        if ( $get_mon > 1 OR $get_mon < 12 ) {
            $prew_year = $get_year;
            $prew_mon = $get_mon-1;
            $next_year = $get_year;
            $next_mon = $get_mon+1;
        }
        if ( $get_mon <= 1 ) {
            $prew_year = $get_year-1;
            $prew_mon = 12;
        }
        if ( $get_mon >= 12 ) {
            $next_year = $get_year+1;
            $next_mon = 1;
        }
        switch ($get_mon) {
            case 1:
                $mon_name = 'Январь';
                break;
            case 2:
                $mon_name = 'Февраль';
                break;
            case 3:
                $mon_name =  'Март';
                break;
            case 4:
                $mon_name =  'Апрель';
                break;
            case 5:
                $mon_name =  'Май';
                break;
            case 6:
                $mon_name =  'Июнь';
                break;
            case 7:
                $mon_name =  'Июль';
                break;
            case 8:
                $mon_name =  'Август';
                break;
            case 9:
                $mon_name =  'Сентябрь';
                break;
            case 10:
                $mon_name =  'Октябрь';
                break;
            case 11:
                $mon_name =  'Ноябрь';
                break;
            case 12:
                $mon_name =  'Декабрь';
                break;
        }
        return array(
            'prew_year' => $prew_year,
            'next_year' => $next_year,
            'prew_mon' => $prew_mon,
            'next_mon' => $next_mon,
            'mon_name' => $mon_name,
            'mon_number' => $get_mon,
            'year_number' => $get_year
        );
    }
}