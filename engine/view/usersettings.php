<?php
$companytype = $data['companytype'];
$commerce = $data['commerce'];
$companytypecheck = $data['companytypecheck'];
$commercecheck = $data['commercecheck'];
$contact = $data['contactscheck'];
?>
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <h1 class="text-center">Страница настроек</h1>
    </div>
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">Страница настроек</div>
        <form id="settingsform" method="post">
            <div id="settings" class="card-body">
                <div class="form-group">
                    <label>Название компании*</label>
                    <input  class="form-control" type="text" name="name" value="<?php if (isset($data['name'])) { echo $data['name']; } ?>">
                </div>
                <div class="form-group">
                    <label>Краткая информация о вашей компании*</label>
                    <textarea class="form-control" name="infomin" maxlength="200" value=""><?php if (isset($data['infomin'])) { echo $data['infomin']; } ?></textarea>
                </div>
                <div class="form-group">
                    <label>Страна*</label>
                    <select class="form-control" class="form-control" name="country" id="select">
                        <option selected disabled >Выберите из списка</option>
                        <?php
                            foreach ($data['country_list'] as $key => $value):
                        ?>
                                <option value="<?php echo $key; ?>" <?php if ($data['country'] == $key) { echo " selected"; } ?>><?php echo $value; ?></option>
                        <?php
                            endforeach;
                        ?>
                    </select>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-12 mb-3">
                        <div class="card">
                            <div class="card-header">Тип компании:</div>
                            <div class="card-body">
                                <?php
                                    for($i = 0; $i < 5; $i++):
                                ?>
                                    <div class="form-group<?php if(!isset($companytypecheck[$i])) { echo " hide"; } ?>">
                                        <div class="form-row">
                                            <div class="col-11 select">
                                                <select class="form-control" name="companytype[]">
                                                    <option selected disabled>Выбирите из списка</option>
                                                    <?php
                                                        foreach ( $companytype AS $value ):
                                                    ?>
                                                        <option value="<?php echo $value->id; ?>"
                                                            <?php
                                                            if (isset($companytypecheck[$i])) {
                                                                if ($companytypecheck[$i] == $value->id) { echo 'selected'; }
                                                            }
                                                             ?>
                                                        ><?php echo $value->name; ?></option>
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
                                    <div class="form-group<?php if(!isset($commercecheck[$i])) { echo " hide"; } ?>">
                                        <div class="form-row">
                                            <div class="col-11 select">
                                                <select class="form-control" name="commerce[]">
                                                    <option selected disabled>Выбирите из списка</option>
                                                    <?php
                                                        foreach ( $commerce AS $value ):
                                                        if ( $value->name != 'none'):
                                                    ?>
                                                            <option value="<?php echo $value->id; ?>"
                                                                <?php
                                                                if (isset($commercecheck[$i])) {
                                                                    if ($commercecheck[$i] == $value->id) { echo 'selected'; }
                                                                }
                                                                ?>
                                                            ><?php echo $value->name; ?></option>
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
                    <textarea class="form-control" name="infomax" maxlength="500" value=""><?php if (isset($data['infomin'])) { echo $data['infomax']; } ?></textarea>
                </div>
                <div class="form-group">
                    <label>Сайт</label>
                    <input  class="form-control" type="text" name="site" value="<?php if (isset($data['infomin'])) { echo $data['site']; } ?>">
                </div>
                <div class="form-group">
                    <label>Facebook</label>
                    <input  class="form-control" type="text" name="facebook" value="<?php if (isset($data['infomin'])) { echo $data['facebook']; } ?>">
                </div>
                <div class="form-group">
                    <label>Адрес</label>
                    <input  class="form-control" type="text" name="adress" value="<?php if (isset($data['infomin'])) { echo $data['adress']; } ?>">
                </div>
                <?php
                    for($i = 0; $i < 5; $i++):
                ?>
                    <div class="card mb-3 contact<?php if(!isset($contact[$i])){echo " hide";} ?>">
                        <div class="card-header">
                            Контактные особы*:
                            <button type="button" class="close buttonxc" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Имя*</label>
                                <input class="form-control"  type="text" name="contact_name[]" value="<?php if (isset($contact[$i]['name'])) { echo $contact[$i]['name']; } ?>">
                            </div>
                            <div class="form-group">
                                <label>Фамилия*</label>
                                <input class="form-control"  type="text" name="contact_surname[]" value="<?php if (isset($contact[$i]['surname'])) { echo $contact[$i]['surname']; } ?>">
                            </div>
                            <div class="form-group">
                                <label>Должность*</label>
                                <input class="form-control"  type="text" name="contact_position[]" value="<?php if (isset($contact[$i]['position'])) { echo $contact[$i]['position']; } ?>">
                            </div>
                            <div class="form-group">
                                <label>Эмейл*</label>
                                <input class="form-control"  type="text" name="contact_email[]" value="<?php if (isset($contact[$i]['email'])) { echo $contact[$i]['email']; } ?>">
                            </div>
                            <div class="form-group">
                                <label>Телефон</label>
                                <input class="form-control"  type="text" name="contact_number[]" value="<?php if (isset($contact[$i]['number'])) { echo $contact[$i]['number']; } ?>">
                            </div>
                            <input type="hidden" name="contact_check[]" value="<?php if(isset($contact[$i])) { echo 'yes'; } else { echo 'no'; } ?>">
                        </div>
                    </div>
                <?php
                    endfor;
                ?>
                <div class="form-group text-center col-12">
                    <i id="add_but_contact" class="fa fa-plus-circle" aria-hidden="true"></i>
                </div>
                <div class="form-group">
                    <input type="hidden" name="action" value="settings">
                    <div class="text-center text-danger form_error"></div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Сохранить</button>
            </div>
        </form>
        </div>
    </div>
</div>

