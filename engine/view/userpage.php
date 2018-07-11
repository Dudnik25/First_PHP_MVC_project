<div class="container mt-5 mb-5">
    <div class="row mb-5 justify-content-center">
        <h1 class="text-center">Страница пользователя</h1>
    </div>
    <div class="row mb-3 justify-content-center">
        <div class="col-12">
            <div class="card text-center">
                <div class="card-header">
                    <?php echo $data['name'] ?>
                </div>
                <div class="card-body">
                    <?php echo $data['country'] ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3 justify-content-center">
        <div class="col-12">
            <div class="card text-center">
                <div class="card-header">
                    Краткая информация о компании
                </div>
                <div class="card-body">
                    <?php echo $data['infomin'] ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card text-center">
                <div class="card-header">
                    Сайт
                </div>
                <div class="card-body">
                    <?php echo $data['site'] ?>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card text-center">
                <div class="card-header">
                    Фейсбук
                </div>
                <div class="card-body">
                    <?php echo $data['facebook'] ?>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card text-center">
                <div class="card-header">
                    Адрес
                </div>
                <div class="card-body">
                    <?php echo $data['adress'] ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3 mt-3 justify-content-center">
        <div class="col-6">
            <div class="card text-center">
                <div class="card-header">
                    Тип компании:
                </div>
                <div class="card-body">
                    <?php
                        if (isset($data['companytype'])) {
                            foreach ($data['companytype'] as $value) {
                                echo '<div class"row">' . $value . '</div>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card text-center">
                <div class="card-header">
                    Комерческие интересы:
                </div>
                <div class="card-body">
                    <?php
                        if (isset($data['commerce'])) {
                            foreach ($data['commerce'] as $value) {
                            echo '<div class"row">' . $value . '</div>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3 justify-content-center">
        <div class="col-12">
            <div class="card text-center">
                <div class="card-header">
                    Полная информация о компании
                </div>
                <div class="card-body">
                    <?php echo $data['infomax']; ?>
                </div>
            </div>
        </div>
    </div>


    <?php
        if ($data['access'] <= 1):
    ?>
    <div class="row justify-content-center">
        <button class="col-6 btn btn-danger">Посмотреть контакты</button>
    </div>
    <?php
        endif;
        if ($data['access'] > 1 && isset($data['contacts'])):
    ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Контактные особы
                </div>
                <div class="card-body">
                    <div class="row">
        <?php
            foreach ($data['contacts'] as $value):
        ?>
            <div class="col-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        <?php echo $value['name']. ' '. $value['surname']. ' ('. $value['position'] . ')'; ?>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <?php echo 'Email: '. $value['email']; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <?php if ($value['number'] != '') { echo 'Номер: '. $value['number']; } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            endforeach;
        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        endif;
    ?>
</div>

