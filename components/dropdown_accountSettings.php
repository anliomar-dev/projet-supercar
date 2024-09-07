<?php
    echo
    '
    <ul class="navbar-nav d-flex gap-5 pr-5 align-items-lg-center flex-row flex-sm-row">
        <li class="nav-item dropdown">
            <div class="dropdown">
            <span class="nav-link" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../medias/images/icons/user.svg" alt="" style="width: 25px; height: 25px; border-radius: 50%; border: none;">
            </span>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li>
                <a class="dropdown-item text-black" href="">Compte</a>
                </li>
                <div class="dropdown-divider"></div>
                <li>
                <form action="" method="post" class="dropdown-item">
                    <button type="submit" name="logout" class="btn">deconnexion</button>
                </form>
                </li>
            </ul>
            </div>
        </li>
    </ul>
    ';
?>