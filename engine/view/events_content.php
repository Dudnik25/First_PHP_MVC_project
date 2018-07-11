<div class="row justify-content-center">
    <div class="col-6 flex-row text-center">
        <a class="arrow" onclick="calendar(<?php echo $pagination['prew_year']. ', ' .$pagination['prew_mon']; ?>)">&lt;</a>
        <div id="cal_mon" class="cal_mon" data-cal-mon="<?php echo $pagination['mon_number']; ?>"><?php echo $pagination['mon_name']; ?></div>
        <div id="cal_year" class="hide" data-cal-year="<?php echo $pagination['year_number'] ?>"></div>
        <a class="arrow" onclick="calendar(<?php echo $pagination['next_year']. ', ' .$pagination['next_mon']; ?>)">&gt;</a>
    </div>
</div>
<div class="row text-center justify-content-center">
    <div class="cal_cell_day">Пн</div>
    <div class="cal_cell_day">Вт</div>
    <div class="cal_cell_day">Ср</div>
    <div class="cal_cell_day">Чт</div>
    <div class="cal_cell_day">Пт</div>
    <div class="cal_cell_day" style="color:red">Сб</div>
    <div class="cal_cell_day" style="color:red">Вс</div>
</div>
<!-- цикл по строкам -->
<?php foreach ($data as $row) {?>
<div class="row text-center justify-content-center">
    <!-- цикл по столбам -->
    <?php foreach ($row as $i => $v) {?>
    <!-- воскресенье - "красный" день -->
    <div class="cal_cell" data-cal-date="<?php if ($v != '') { echo $v; }?>">
        <div class="flex">
            <div class="events"><?php if ($v != '') { echo '0 событий'; } else { echo ' '; }?></div>
            <div class="<?php if ($v != '') { echo 'date'; } else { echo ' '; } ?>"><?php if ($v != '') { echo $v; } else { echo ' '; }?></div>
        </div>
    </div>
    <?php } ?>
    <div class="row w-100 cal_ajax hide">

    </div>
</div>
    <?php }?>