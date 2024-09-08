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
                <li class="d-flex justify-content-center">
                    <button type="btn" class="btn text-center py-0" style="background-color: #28a745;">
                        <a class="dropdown-item text-white" style="background-color: #28a745; font-size: 14px;" href="">Compte</a>
                    </button>
                </li>
                <div class="dropdown-divider"></div>
                <li>
                <form action="" method="post" class="dropdown-item">
                    <button type="submit" name="logout" class="btn">Deconnexion</button>
                </form>
                </li>
            </ul>
            </div>
        </li>
    </ul>
    ';
?>