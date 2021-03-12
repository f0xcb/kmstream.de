<div class="interface-menu">
    <p class="interface-menu-header">User</p>
    <div id="user" class="interface-menu-container">
        <ul class="interface-menu-ul">
            <li class="interface-menu-li"><a href="https://kmskollektiv.de/kmstream-interface/index.php" class="interface-menu-link"><i class="fas fa-angle-right"></i>Dashboard</a></li>
            <li class="interface-menu-li"><a href="#" class="interface-menu-link"><i class="fas fa-angle-right"></i>Bewerben</a></li>
            <li class="interface-menu-li"><a href="https://kmskollektiv.de/kmstream-interface/logout.php" class="interface-menu-link"><i class="fas fa-angle-right"></i>Logout</a></li>
        </ul>
    </div>

    <?php if (getRank($_SESSION["username"]) >= ADMIN){ ?>
        <p class="interface-menu-header">Admin</p>
        <div id="admin" class="interface-menu-container">
            <ul class="interface-menu-ul">
                <li class="interface-menu-li">
                    <a href="https://kmskollektiv.de/kmstream-interface/admin/add-post.php" class="interface-menu-link"><i class="fas fa-angle-right"></i>Beiträge</a>
                </li>
                <li class="interface-menu-li">
                    <a href="https://kmskollektiv.de/kmstream-interface/admin/show-user.php" class="interface-menu-link"><i class="fas fa-angle-right"></i>Benutzer</a>
                </li>
            </ul>
        </div>
    <?php } ?>

</div>