<?php
$companytype = $data['companytype'];
$commerce = $data['commerce'];
?>
<div class="container mb-5">
        <div class="card card-register mx-auto mt-5">
            <div class="card-header">Страница регистрации</div>
            <form id="regform" method="post">
                <div id="reg_1" class="card-body">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label>Название компании*</label>
                                <input  class="form-control" type="text" name="name" value="">
                            </div>
                            <div class="col-md-6">
                                <label>Адрес електронной почты*</label>
                                <input  class="form-control" type="text" name="email" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label>Пароль*</label>
                                <input  class="form-control" type="password" name="password" value="">
                            </div>
                            <div class="col-md-6">
                                <label>Подтвердите Пароль*</label>
                                <input  class="form-control" type="password" name="password2" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Страна*</label>
                        <select class="form-control" class="form-control" name="country" id="select">
                                    <option selected disabled >Выберите из списка</option>
                                    <?php
                                    foreach ($data['country_list'] as $key => $value):
                                        ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                    </div>
                <div class="form-group">
                    <label>Краткая информация о вашей компании*</label>
                    <textarea class="form-control" name="infomin" maxlength="200" value=""></textarea>
                </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-12 mb-3">
                            <div class="card">
                                <div class="card-header">Тип компании:</div>
                                <div class="card-body">
                                    <?php
                                        for($i = 0; $i < 5; $i++):
                                    ?>
                                        <div class="form-group<?php if($i > 0) { echo " hide"; } ?>">
                                            <div class="form-row">
                                                <div class="col-11 select">
                                                    <select class="form-control" name="companytype[]">
                                                        <option selected disabled>Выбирите из списка</option>
                                                        <?php
                                                            foreach ( $companytype AS $value ):
                                                        ?>
                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                                        <?php
                                                            endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-1 text-center">
                                                    <button type="button" class="close buttonx" aria-label="Close">
                                                        <span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="companytype_check[]" value="<?php if ($i > 0) { echo 'no'; } else { echo 'yes'; } ?>">
                                        </div>
                                    <?php endfor; ?>
                                </div>
                                <div class="card-footer text-center">
                                    <i id="add_but_companytype" class="fa fa-plus-circle" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 mb-3">
                            <div class="card">
                                <div class="card-header">Комерческие интересы:</div>
                                <div class="card-body">
                                    <?php
                                        for($i = 0; $i < 5; $i++):
                                    ?>
                                    <div class="form-group<?php if($i > 0) { echo " hide"; } ?>">
                                        <div class="form-row">
                                            <div class="col-11 select">
                                                <select class="form-control" name="commerce[]">
                                                    <option selected disabled>Выбирите из списка</option>
                                                    <?php
                                                        foreach ( $commerce AS $value ):
                                                        if ( $value->name != 'none'):
                                                    ?>
                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                                        <?php
                                                            endif;
                                                            endforeach;
                                                        ?>
                                                </select>
                                            </div>
                                            <div class="col-1 text-center">
                                                <button type="button" class="close buttonx" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                                </button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="commerce_check[]" value="<?php if ($i > 0) { echo 'no'; } else { echo 'yes'; } ?>">
                                    </div>
                                    <?php
                                        endfor;
                                    ?>
                                </div>
                                <div class="card-footer text-center">
                                    <i id="add_but_commerce" class="fa fa-plus-circle" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Подробная информация о вашей компании</label>
                        <textarea class="form-control" name="infomax" maxlength="500" value=""></textarea>
                    </div>
                    <div class="form-group">
                        <label>Сайт</label>
                        <input  class="form-control" type="text" name="site" value="">
                    </div>
                    <div class="form-group">
                        <label>Facebook</label>
                        <input  class="form-control" type="text" name="facebook" value="">
                    </div>
                    <div class="form-group">
                        <label>Адрес</label>
                        <input  class="form-control" type="text" name="adress" value="">
                    </div>
                    <?php
                        for($i = 0; $i < 5; $i++):
                    ?>
                    <div class="card mb-3 contact<?php if($i > 0){echo " hide";} ?>">
                        <div class="card-header">
                            Контактные особы*:
                        <button type="button" class="close buttonxc" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                        </button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Имя*</label>
                                <input class="form-control"  type="text" name="contact_name[]" value="">
                            </div>
                            <div class="form-group">
                                <label>Фамилия*</label>
                                <input class="form-control"  type="text" name="contact_surname[]" value="">
                            </div>
                            <div class="form-group">
                                <label>Должность*</label>
                                <input class="form-control"  type="text" name="contact_position[]" value="">
                            </div>
                            <div class="form-group">
                                <label>Эмейл*</label>
                                <input class="form-control"  type="text" name="contact_email[]" value="">
                            </div>
                            <div class="form-group">
                                <label>Телефон</label>
                                <input class="form-control"  type="text" name="contact_number[]" value="">
                            </div>
                            <input type="hidden" name="contact_check[]" value="<?php if($i < 1) { echo 'yes'; } else { echo 'no'; } ?>">
                        </div>
                    </div>
                    <?php
                        endfor;
                    ?>
                    <div class="form-group text-center col-12">
                        <i id="add_but_contact" class="fa fa-plus-circle" aria-hidden="true"></i>
                    </div>
                <div class="form-group">
                    <input type="hidden" name="action" value="register">
                    <div class="text-center text-danger form_error"></div>
                </div>
                    <button type="submit" id="regform_button" class="btn btn-primary btn-block">Зарегестрироватся</button>
                </div>
            </form>


        </div>
    </div>

</body>