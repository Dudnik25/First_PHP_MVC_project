<header style="border-bottom:  1px solid white; background-color: #343a40!important">
    <div class="container-fluid">
        <nav class="navbar justify-content-around">
            <div class="navbar-brand logo">
                <img class="img-fluid" src="<?php echo base_dir; ?>resources/img/1.png" alt="UCCI Portal">
            </div>
            <ul class="nav flex-column flex-sm-row">
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?php echo base_url .'admin'; ?>">Активность</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?php echo base_url .'catalog'; ?>">Каталог</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?php echo base_url .'notes'; ?>">Заметки</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?php echo base_url .'favorites'; ?>">Избранное</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?php echo base_url . 'events'; ?>">Мероприятия</a>
                </li>
            </ul>
            <ul class="nav flex-column flex-sm-row">
            <div class="nav-item justify-content-end">
                <a nav-link class="logout d-inline" href="<?php echo base_url ."logout"; ?>">
                    <i class="fa fa-fw fa-sign-out text-white d-inline"></i>
                    Выход
                </a>
            </div>
            </ul>
        </nav>

    </div>
</header>