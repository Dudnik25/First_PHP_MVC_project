<div id="favor_hide" class="favor_hide">
        <div class="row h-100 flex-row justify-content-center align-items-center">
            <div class="card text-center favor_add_block">
                <div class="card-header">
                    Подтвердите действие
                </div>
                <div class="card-body">
                    <button id="favor_ok" class="btn btn-primary favor_add_but">Ok</button>
                    <button id="favor_cencel" class="btn btn-danger favor_add_but">Отмена</button>
                </div>

            </div>
        </div>
</div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <h1 class="text-center">Страница каталога</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row mb-3">
                <div class="col-12 mb-2">
                    <select id="s_cat_1" class="form-control" name="region">
                        <option disabled selected>Выберите категорию</option>
                        <option value="1-3">1 - 3 СЕЛЬСКОЕ ХОЗЯЙСТВО, ЛЕСНОЕ ХОЗЯЙСТВО И РЫБНОЕ ХОЗЯЙСТВО</option>
                        <option value="5-9">5 - 9 ДОБЫВАЮЩАЯ ПРОМЫШЛЕННОСТЬ И РАЗРАБОТКА КАРЬЕРОВ</option>
                        <option value="10-33">10 - 33 ПЕРЕРАБАТЫВАЮЩАЯ ПРОМЫШЛЕННОСТЬ</option>
                        <option value="35-35">35 ПОСТАВКА ЭЛЕКТРОЭНЕРГИИ, ГАЗА, ПАРА И КОНДИЦИОНИРОВАННОГО ВОЗДУХА</option>
                        <option value="36-39">36 - 39 ВОДОПОСТАЧАННЯ; КАНАЛІЗАЦІЯ, ПОВОДЖЕННЯ З ВІДХОДАМИ</option>
                        <option value="41-43">41 - 43 СТРОИТЕЛЬСТВО</option>
                        <option value="45-47">45 - 47 ОПТОВАЯ И РОЗНИЧНАЯ ТОРГОВЛЯ; РЕМОНТ АВТОТРАНСПОРТНЫХ СРЕДСТВ И МОТОЦИКЛОВ</option>
                        <option value="49-53">49 - 53 ТРАНСПОРТ, СКЛАДСКОЕ ХОЗЯЙСТВО, ПОЧТОВАЯ И КУРЬЕРСКАЯ ДЕЯТЕЛЬНОСТЬ</option>
                        <option value="55-56">55 - 56 ВРЕМЕННОЕ РАЗМЕЩЕНИЕ И ОРГАНИЗАЦИЯ ПИТАНИЯ</option>
                        <option value="58-63">58 - 63 ИНФОРМАЦИЯ И ТЕЛЕКОММУНИКАЦИИ</option>
                        <option value="64-66">64 - 66 ФИНАНСОВАЯ И СТРАХОВАЯ ДЕЯТЕЛЬНОСТЬ</option>
                        <option value="68-68">68 ОПЕРАЦИИ С НЕДВИЖИМЫМ ИМУЩЕСТВОМ</option>
                        <option value="69-75">69 - 75 ПРОФЕССИОНАЛЬНАЯ, НАУЧНАЯ И ТЕХНИЧЕСКАЯ ДЕЯТЕЛЬНОСТЬ</option>
                        <option value="77-82">77 - 82 ДЕЯТЕЛЬНОСТЬ В СФЕРЕ АДМИНИСТРАТИВНОГО И ВСПОМОГАТЕЛЬНОГО ОБСЛУЖИВАНИЯ</option>
                        <option value="84-84">84 ГОСУДАРСТВЕННОЕ УПРАВЛЕНИЕ И ОБОРОНА; ОБЯЗАТЕЛЬНОЕ СОЦИАЛЬНОЕ СТРАХОВАНИЕ</option>
                        <option value="85-85">85 ОБРАЗОВАНИЕ</option>
                        <option value="86-88">86 - 88 ЗДРАВООХРАНЕНИЕ И ПРЕДОСТАВЛЕНИЕ СОЦИАЛЬНОЙ ПОМОЩИ</option>
                        <option value="90-93">90 - 93 ИСКУССТВО, СПОРТ, РАЗВЛЕЧЕНИЕ И ОТДЫХ</option>
                        <option value="94-96">94 - 96 ПРЕДОСТАВЛЕНИЕ ДРУГИХ ВИДОВ УСЛУГ</option>
                        <option value="97-98">97 - 98 ДЕЯТЕЛЬНОСТЬ ДОМАШНИХ ХОЗЯЙСТВ</option>
                        <option value="99-99">99 ДЕЯТЕЛЬНОСТЬ ЭКСТЕРРИТОРИАЛЬНЫХ ОРГАНИЗАЦИЙ И ОРГАНОВ</option>
                    </select>
                </div>
                <div class="col-12">
                    <select id="s_cat_2" class="form-control" name="city" disabled="disabled">
                        <option>Выберите подкатегорию</option>
                    </select>
                </div>
            </div>
            <div id="catalog" class="w-100">
                <script>reuestcat(1);</script>
            </div>
        </div>
    </div>
</div>