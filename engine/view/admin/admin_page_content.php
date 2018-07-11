<div class="row">
    <?php
    foreach ($data as $card):
        ?>
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-around">
                        <div class="col-8">
                            <?php
                                echo '<a href="' .base_url. 'admin/id'. $card['id']. '">' .$card['name']. '</a>';
                            ?>
                        </div>
                        <?php
                            if ($card['access'] == 0):
                        ?>
                        <div class="col-2 text-right">
                            <button id="conf<?php echo $card['id']; ?>" onclick="conf(<?php echo $card['id']; ?>)" class=" btn btn-block">Подтвердить</button>
                        </div>
                        <?php
                            endif;
                        ?>
                        <div class="col-2 text-right">
                            <button id="fav<?php echo $card['id']; ?>" onclick="favor(<?php echo $card['id']; ?>)" class=" btn btn-block favor<?php if ($card['favor'] == true) { echo ' fav_active'; } ?>"><i class="fa fa-star"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <img class="img-fluid" src="resources/img/1.png">
                        </div>
                        <div class="col-10">
                            <div class="row">
                                Краткая нформация о компании:<br>
                                <?php echo $card['infomin']. '<br>'; ?>
                            </div>
                            <div class="row">
                                Тип компании:<br>
                                <?php
                                foreach ($card['companytype'] as $value) {
                                    echo $value. ' ';
                                }
                                ?>
                            </div>
                            <div class="row">
                                Комерческие интересы:<br>
                                <?php
                                foreach ($card['commerce'] as $value) {
                                    echo $value. '<br>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row flex-row justify-content-end">
                        <div class="col-6 text-left">
                            <?php
                                if (!empty($card['site'])):
                                    ?>
                                    <a href="<?php echo $card['site']; ?>"><i class="fa fa-dribbble"></i></a>
                                    <?php
                                endif;
                                if (!empty($card['facebook'])):
                                    ?>
                                    <a href="<?php echo $card['facebook']; ?>"><i class="fa fa-facebook"></i></a>
                                    <?php
                                endif;
                            ?>
                        </div>
                        <div class="col-6 text-right">
                            <?php
                            echo $card['country']. ' ' . $card['regdate'];
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endforeach;
    ?>
</div>
<?php
echo $pagination;
?>