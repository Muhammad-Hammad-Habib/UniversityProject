<header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex justify-content-between align-items-center">

        <div class="logo">
            <h1 class="text-light">
                <a href="index.php">
                    <span>FUTURE BUILD</span>
                </a>
            </h1>
        </div>

        <nav id="navbar" class="navbar">
            <?php
                if (isset($_SESSION['user'])) {
                    $query = $db->query('SELECT * FROM users WHERE id = "'.$_SESSION['user'].'"');
                    $auth_user = $query->fetch_assoc();
            ?>
            <div class="dropdown d-block d-lg-none me-2">
                <a href="javascript:void(0)" class="avatar-nav">
                    <img src="<?= ($auth_user['image']!="") ? "public/storage/profile/".$auth_user['image'] : "public/img/user.png" ?>" alt="" />
                </a>
                <ul class="bg-dark" style="border-radius: 15px; width: 250px">
                    <li class="px-4 py-2">
                        <div class="text-white d-flex align-items-center justify-content-center flex-column">
                            <div class="mb-3" style="width: 80px; height: 80px;">
                                <img src="<?= ($auth_user['image']!="") ? "public/storage/profile/".$auth_user['image'] : "public/img/user.png" ?>" alt="" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" />
                            </div>
                            <h5 style="font-size: 18px" class="mb-0"><?= $auth_user['first_name'].' '.$auth_user['last_name']; ?></h5>
                            <p style="font-size: 15px"><?= $auth_user['email']; ?></p>
                            <a href="my-profile.php" class="mb-2" style="border: 1px solid white; padding: 4px 30px; color: white; border-radius: 30px;">View Profile</a>
                            <a href="logout.php" class="text-white">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
            <?php }else{ ?>
            <a href="login.php" class="default-btn d-block d-lg-none">Login</a>
            <?php } ?>

            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="http://localhost/ums/register.php">Register</a></li>
                <li class="px-3 px-md-0">
                    <div class="search_wrapper ms-0 ms-md-4" style="border: 1px solid #e6e6e6;">
                        <input type="text" id="search_bar" placeholder="Search" autocomplete="off" />
                        <div id="search_box" style="position: absolute; top: 50px; width: 245px; background: white; border-radius: 10px; max-height: 300px; overflow-y: auto"></div>
                    </div>
                </li>
                <?php
                    if (isset($_SESSION['user'])) {
                        $query = $db->query('SELECT * FROM users WHERE id = "'.$_SESSION['user'].'"');
                        $auth_user = $query->fetch_assoc();
                ?>
                <li class="dropdown d-none d-lg-block">
                    <a href="javascript:void(0)" class="avatar-nav">
                        <img src="<?= ($auth_user['image']!="") ? "public/storage/profile/".$auth_user['image'] : "public/img/user.png" ?>" alt="" />
                    </a>
                    <ul class="bg-dark" style="border-radius: 15px; width: 250px">
                        <li class="px-4 py-2">
                            <div class="text-white d-flex align-items-center justify-content-center flex-column">
                                <div class="mb-3" style="width: 80px; height: 80px;">
                                    <img src="<?= ($auth_user['image']!="") ? "public/storage/profile/".$auth_user['image'] : "public/img/user.png" ?>" alt="" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" />
                                </div>
                                <h5 style="font-size: 18px" class="mb-0"><?= $auth_user['first_name'].' '.$auth_user['last_name']; ?></h5>
                                <p style="font-size: 15px"><?= $auth_user['email']; ?></p>
                                <a href="my-profile.php" class="mb-2" style="border: 1px solid white; padding: 4px 30px; color: white; border-radius: 30px;">View Profile</a>
                                <a href="logout.php" class="text-white">Logout</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <?php }else{ ?>
                <li><a href="login.php" class="default-btn d-none d-lg-block">Login</a></li>
                <?php } ?>
            </ul>

            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
    </div>
</header>







<script>
    $('#search_box').hide();

    $('#search_bar').keyup(function () {
        if ($('#search_bar').val() == '') {
            return $('#search_box').hide();
        }

        $.post("./config/code.php", {search_action: "", search_bar: $('#search_bar').val()}, function(result) {
            const data = JSON.parse(result);

            if (data.message && data.message !== "") {
                $('#search_box').show().html(`<span class="mx-3 my-3 d-block">${data.message}</span>`);
            }
            else{
                let html = "";
                data.map(elem=> {
                    html += `<a href="profile.php?id=${elem.id}" class="d-flex align-items-center justify-content-start text-decoration-none text-dark px-2 py-0 my-2">`;
                    html += `<div class="user_img" style="width: 40px; height: 40px; border-radius: 50%; background: white">`;
                    html += `<img src="${(elem.image !== "" ? 'public/storage/profile/'+elem.image : 'public/img/user.png')}" alt="" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 1px solid #c6c6c6" />`;
                    html += `</div>`;
                    html += `<div class="ms-2">`;
                    html += `<h1 class="mb-0" style="font-size: 14px">${elem.first_name+' '+elem.last_name}</h1>`;
                    html += `</div>`;
                    html += `</a>`;
                })
                $('#search_box').show().html(html);
            }
        });
    });

</script>