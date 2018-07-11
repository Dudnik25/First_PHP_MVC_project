<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <h1 class="text-center">Страница событий</h1>
    </div>
    <div id="cal_load" class="cal_load hide">
        <div class="row w-100 h-100 justify-content-center align-items-center flex-row">
            <img class="cal_load_img" src="resources\img\source.gif" alt="Loading">
        </div>
    </div>
    <div id="calendar">
        <?php
        $now = getdate();
        ?>
        <script>calendar(<?php echo $now['year']. ', ' .$now['mon']; ?>)</script>
    </div>
</div>


