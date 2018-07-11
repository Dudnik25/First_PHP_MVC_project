<header style="border-bottom:  1px solid white; background-color: #343a40!important">
    <div class="container">
        <form id="loginform">
            <div class="row pt-3 justify-content-center">
                <div class="col-12 col-md-10">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <input class="w-100" type="text" name="login"  value="" placeholder="Адрес электронной почты">
                        </div>
                        <div class="col-12 col-sm-6">
                            <input class="w-100" type="password" name="password" value="" placeholder="Пароль">
                        </div>
                    </div>
                    <div class="row pb-1">
                        <div class="col-12 col-sm-6 text-center">
                            <a href="reg" class="d-block w-100 text-white">Зарегестрироватся</a>
                        </div>
                        <div class="col-12 col-sm-6 text-center">
                            <a href="#" class="d-block w-100 text-white">Востановить праоль</a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-2 justify-content-center">
                    <button id="loginformbut" class="btn btn-primary w-100 h-100">Войти</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12 pb-3 pt-2">
                    <input type="hidden" name="action" value="login">
                    <div class="text-center text-danger form_error"></div>
                </div>
            </div>
        </form>
    </div>
</header>
