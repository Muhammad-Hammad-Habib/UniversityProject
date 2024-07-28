<?php include('config/config.php'); ?>

<?php include('layout/header.php'); ?>

<?php
    if (isset($_SESSION['user'])) {
        $query = $db->query('SELECT * FROM users WHERE id = "'.$_SESSION['user'].'"');
        $user = $query->fetch_assoc();
?>

<?php include('layout/navbar.php'); ?>

<style>

#hero-no-slider::before {
  background: linear-gradient(to right, rgba(0,0,0,0.3), rgba(0,0,0,0.5)), url("public/storage/cover/<?= $user['cover_image']; ?>");
  background-size: cover;
  background-position: center;
}
.page-item.active{
    background: #0b212d !important;
}

.avatar-img{
    width: 170px;
    height: 170px;
    background: white;
    border-radius: 50%;
    text-align: center;
}
.avatar-img img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: start;
    border-radius: 50%;
}

.avatar-desc {
    color: var(--bs-dark);
}

@media (min-width: 768px) {
    .avatar-desc {
        color: var(--bs-white);
    }
}

.avatar-desc p{
    letter-spacing: 0.4px;
}


.avatar-img input[type="file"] {
    display: none;
}
.personal-figure {
    position: relative;
    width: 170px;
    height: 170px;
}
.personal-avatar {
    cursor: pointer;
    width: 170px;
    height: 170px;
    box-sizing: border-box;
    border-radius: 50%;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
    transition: all ease-in-out .3s;
}
.personal-avatar:hover {
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.5);
}
.personal-figcaption {
    cursor: pointer;
    position: absolute;
    top: 0px;
    width: inherit;
    height: inherit;
    border-radius: 100%;
    opacity: 0;
    background-color: rgba(0, 0, 0, 0);
    transition: all ease-in-out .3s;
}
.personal-figcaption:hover {
    opacity: 1;
    background-color: rgba(0, 0, 0, .5);
}
.personal-figcaption > img {
    margin-top: 38%;
    width: 50px;
    height: 50px;
}










/* ==================== Intro Video ==================== */
.intro-video {
    height: 400px;
    background: #000;
    border-top-left-radius: 0.375rem;
    border-top-right-radius: 0.375rem;
}
.intro-video input[type="file"] {
    display: none;
}
.intro-video img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}
.intro-video video{
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.abc { position: relative; cursor: pointer; top: 30px;}
.abc .chooser { position: absolute; z-index: 1; opacity: 0;}
.abc .chooser-2 { opacity:1;}
.abc img { width: 30px; cursor: pointer;}

</style>

<main class="profile">

    <section id="hero-no-slider" class="d-flex justify-content-end align-items-end">
        <div class="abc me-4">
            <input type="file" id="cover_img" accept="image/*" class="chooser" />
            <a href="#">
                <img src="public/img/cam.png" />
            </a>
        </div>
    </section>

    <div class="container" style="position: relative; margin-top: -120px; z-index: 10">
        <div class="row">
            <div class="col-md-10">
                <div class="avatar d-flex flex-column flex-md-row justify-content-center justify-content-md-start">
                    <div class="avatar-img mx-auto mx-md-0">
                        <label class="label">
                            <input type="file" id="profile_img" accept="image/*" />
                            <figure class="personal-figure">
                                <img src="<?= ($user['image']) ? "public/storage/profile/".$user['image'] : "public/img/user.png" ?>" alt="" />
                                <figcaption class="personal-figcaption">
                                    <img src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png" alt="....">
                                </figcaption>
                            </figure>
                        </label>
                    </div>
                    <div class="avatar-desc text-center text-md-start mt-4 mt-md-4 ms-0 ms-md-4">
                        <h2><?= $user['first_name'].' '.$user['last_name']; ?></h2>
                        <p><?= $user['email'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-9">

                <!-- ========== Intro Video Section ========== -->
                <div class="card shadow-sm mb-4">
                    <div class="intro-video">
                    <?php if ($user['intro_video']) { ?>
                        <video controls src="<?= "public/storage/video/".$user['intro_video'] ?>"></video>
                    <?php }else{ ?>
                        <img src="https://songdewnetwork.com/sgmedia/assets/images/default-video-image.png" alt="" />
                    <?php } ?>
                    </div>
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h3 class="mt-3">Introduction Video</h3>
                        <div class="dropdown">
                            <a class="nav-link" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical" style="font-size: 20px"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                <input type="file" id="intro_video" class="form-control" accept="video/*" />
                            </div>
                        </div>
                    </div>
                </div>


                <!-- ========== Personal Info ========== -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex mb-5 justify-content-between">
                            <h4 class="card-title">Personal Info</h4>
                            <div class="dropdown">
                                <a class="nav-link" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical" style="font-size: 20px"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownId">
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profile_update_modal">Edit</a>
                                </div>
                            </div>
                        </div>
                        
                        <form id="update_user_form">
                            <table style="width: 100%" class="">
                                <tr>
                                    <td style="width: 150px" class="py-2"><strong>First Name</strong></td>
                                    <td class="py-2"><span><?= $user['first_name'] ?></span></td>
                                </tr>
                                <tr>
                                    <td class="py-2"><strong>Last Name</strong></td>
                                    <td class="py-2"><span><?= $user['last_name'] ?></span></td>
                                </tr>
                                <tr>
                                    <td class="py-2"><strong>Email</strong></td>
                                    <td class="py-2"><span><?= $user['email'] ?></span></td>
                                </tr>
                                <tr>
                                    <td class="py-2"><strong>Address</strong></td>
                                    <td class="py-2"><span><?= ($user['address']!="") ? $user['address'] : 'N/A'; ?></span></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                

                <!-- ========== About ========== -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex mb-3 justify-content-between">
                            <h4 class="card-title">About</h4>
                            <div class="dropdown">
                                <a class="nav-link" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical" style="font-size: 20px"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownId">
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#about_modal">Edit</a>
                                </div>
                            </div>
                        </div>
                        <p><?= $user['about'] ?></p>
                    </div>
                </div>
                

                <!-- ========== Change Password ========== -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex mb-3 justify-content-between">
                            <h4 class="card-title">Password</h4>
                            <div class="dropdown">
                                <a class="nav-link" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical" style="font-size: 20px"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownId">
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#password_modal">Change</a>
                                </div>
                            </div>
                        </div>
                        <input type="password" value="aaaaaaaa" style="outline: none; border: none;" readonly />
                    </div>
                </div>


                <!-- ========== Experience ========== -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex mb-3 justify-content-between">
                            <h4 class="card-title mb-4">Experience</h4>
                            <div class="dropdown">
                                <a class="nav-link" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical" style="font-size: 20px"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownId">
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#experience_modal">Add</a>
                                </div>
                            </div>
                        </div>

                        <div>
                        <?php
                            $experience = $db->query('SELECT * FROM experience WHERE user_id = "'.$_SESSION['user'].'"');
                            if ($experience->num_rows > 0) {
                                while ($_experience = $experience->fetch_assoc()) {
                        ?>
                        <div class="card mb-3 border-0" style="box-shadow: 0 4px 10px -1px #c6c6c6">
                            <div class="card-body" style="padding: 12px">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div style="width: 80px; height: 80px">
                                            <img src="public/img/ic.png" alt="" style="width: 100%; height: 100%; object-fit: cover; border-right: 1px solid #b3b3b3;">
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="card-title mb-1" style="font-size: 17px; color: black"><?= $_experience['position_name']; ?></h6>
                                            <p class="card-text mb-0" style="font-size: 14px;"><?= $_experience['company_name'].' - '.$_experience['timing']; ?></p>
                                            <span style="font-size: 14px;"><?= $_experience['start_date']; ?> - <?= ($_experience['present']!="") ? $_experience['present'] : $_experience['end_date']; ?></span>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="nav-link" href="javascript:void(0)" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical" style="font-size: 20px"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="edit_experience(<?= $_experience['id'] ?>)">Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="delete_experience(<?= $_experience['id'] ?>)">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }}else{ ?>
                            No Experience Found
                        <?php } ?>
                        </div>
                    </div>
                </div>


                <!-- ========== Education ========== -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex mb-3 justify-content-between">
                            <h4 class="card-title mb-4">Education</h4>
                            <div class="dropdown">
                                <a class="nav-link" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical" style="font-size: 20px"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownId">
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#education_modal">Add</a>
                                </div>
                            </div>
                        </div>

                        <div>
                        <?php
                            $education = $db->query('SELECT * FROM education WHERE user_id = "'.$_SESSION['user'].'"');
                            if ($education->num_rows > 0) {
                                while ($_education = $education->fetch_assoc()) {
                        ?>
                        <div class="card mb-3 border-0" style="box-shadow: 0 4px 10px -1px #c6c6c6">
                            <div class="card-body" style="padding: 12px">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div style="width: 80px; height: 80px">
                                            <img src="public/img/us.png" alt="" style="width: 100%; height: 100%; object-fit: cover; border-right: 1px solid #b3b3b3;">
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="card-title mb-1" style="font-size: 17px; color: black"><?= $_education['program']; ?></h6>
                                            <p class="card-text mb-0" style="font-size: 14px;"><?= $_education['institute']; ?></p>
                                            <span style="font-size: 14px;"><?= $_education['start_date']; ?> - <?= ($_education['present']!="") ? $_education['present'] : $_education['end_date']; ?></span>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="nav-link" href="javascript:void(0)" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical" style="font-size: 20px"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="edit_education(<?= $_education['id'] ?>)">Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="delete_education(<?= $_education['id'] ?>)">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }}else{ ?>
                            No Education Found
                        <?php } ?>
                        </div>
                    </div>
                </div>


                <!-- ========== Certificate ========== -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex mb-3 justify-content-between">
                            <h4 class="card-title mb-4">Certificate</h4>
                            <div class="dropdown">
                                <a class="nav-link" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical" style="font-size: 20px"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownId">
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#certificate_modal">Add</a>
                                </div>
                            </div>
                        </div>

                        <div>
                        <?php
                            $certificate = $db->query('SELECT * FROM certificate WHERE user_id = "'.$_SESSION['user'].'"');
                            if ($certificate->num_rows > 0) {
                                while ($_certificate = $certificate->fetch_assoc()) {
                        ?>
                        <div class="card mb-3 border-0" style="box-shadow: 0 4px 10px -1px #c6c6c6">
                            <div class="card-body" style="padding: 12px">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div style="width: 80px; height: 80px">
                                            <img src="public/img/download.png" alt="" style="width: 100%; height: 100%; object-fit: cover; border-right: 1px solid #b3b3b3;">
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="card-title mb-1" style="font-size: 17px; color: black"><?= $_certificate['program']; ?></h6>
                                            <p class="card-text mb-0" style="font-size: 14px;"><?= $_certificate['institute']; ?></p>
                                            <span style="font-size: 14px;">Issued Date - <?= $_certificate['issue_date']; ?></span>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="nav-link" href="javascript:void(0)" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical" style="font-size: 20px"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="edit_certificate(<?= $_certificate['id'] ?>)">Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="delete_certificate(<?= $_certificate['id'] ?>)">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }}else{ ?>
                            No Certificate Found
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">

                <!-- ========== About Me ========== -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-4">About Me</h4>
                            <div class="dropdown">
                                <a class="nav-link" href="javascript:void(0)" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical" style="font-size: 20px"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownId">
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="edit_about_me()">Edit</a>
                                </div>
                            </div>
                        </div>
                        <?php
                            $about = $db->query('SELECT * FROM about_me WHERE user_id = "'.$_SESSION['user'].'"');
                            if ($about->num_rows > 0) {
                                while ($_about = $about->fetch_assoc()) {
                        ?>
                        <div>
                            <div class="d-flex align-items-center fw-bold mb-2">
                                <i class="bi bi-mortarboard-fill" style="font-size: 20px"></i>
                                <span class="ms-2" style="font-size: 17px">Education</span>
                            </div>
                            <p style="font-size: 15px; color: #747474"><?= $_about['education'] ?></p>
                        </div><hr>

                        <div>
                            <div class="d-flex align-items-center fw-bold mb-2">
                                <i class="bi bi-geo-alt-fill" style="font-size: 20px"></i>
                                <span class="ms-2" style="font-size: 17px">Location</span>
                            </div>
                            <p style="font-size: 15px; color: #747474"><?= $_about['location'] ?></p>
                        </div><hr>

                        <div>
                            <div class="d-flex align-items-center fw-bold mb-2">
                                <i class="bi bi-pencil-fill" style="font-size: 20px"></i>
                                <span class="ms-2" style="font-size: 17px">Email</span>
                            </div>
                            <p style="font-size: 15px; color: #747474"><?= $user['email'] ?></p>
                        </div><hr>

                        <div>
                            <div class="d-flex align-items-center fw-bold mb-2">
                                <i class="bi bi-file-earmark-text-fill" style="font-size: 20px"></i>
                                <span class="ms-2" style="font-size: 17px">Notes</span>
                            </div>
                            <p style="font-size: 15px; color: #747474"><?= $_about['notes'] ?></p>
                        </div><hr>
                        <?php }}else{ ?>
                            No Data Found
                        <?php } ?>
                    </div>
                </div>


                <!-- ========== Skills ========== -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex mb-3 justify-content-between">
                            <h4 class="card-title mb-4">Skills</h4>
                            <div class="dropdown">
                                <a class="nav-link" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical" style="font-size: 20px"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownId">
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#skills_modal">Add</a>
                                </div>
                            </div>
                        </div>

                        <div>
                            <?php
                                $skill = $db->query('SELECT * FROM skills WHERE user_id = "'.$_SESSION['user'].'"');
                                if ($skill->num_rows > 0) {
                                    while ($_skill = $skill->fetch_assoc()) {
                            ?>
                            <div class="dropdown">
                                <a href="javascript:void(0)" class="my-2 d-flex justify-content-between align-items-center" class="nav-link" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span style="color: black; font-weight: 600"><?= $_skill['skill'] ?></span>
                                    <span class="text-primary"><?= $_skill['percent'] ?>%</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownId">
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="edit_skill(<?= $_skill['id'] ?>)">Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="delete_skill(<?= $_skill['id'] ?>)">Delete</a>
                                </div>
                            </div>
                            <hr>
                            <?php }}else{ ?>
                                No Skill Found
                            <?php } ?>
                        </div>
                    </div>
                </div>


                <!-- ========== Language ========== -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex mb-3 justify-content-between">
                            <h4 class="card-title mb-4">Languages</h4>
                            <div class="dropdown">
                                <a class="nav-link" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical" style="font-size: 20px"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownId">
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#language_modal">Add</a>
                                </div>
                            </div>
                        </div>

                        <div>
                            <?php
                                $language = $db->query('SELECT * FROM languages WHERE user_id = "'.$_SESSION['user'].'"');
                                if ($language->num_rows > 0) {
                                    while ($_language = $language->fetch_assoc()) {
                            ?>
                            <div class="dropdown">
                                <a href="javascript:void(0)" class="my-2 d-flex justify-content-between align-items-center" class="nav-link" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span style="color: black; font-weight: 600"><?= $_language['language'] ?></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownId">
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="edit_language(<?= $_language['id'] ?>)">Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="delete_language(<?= $_language['id'] ?>)">Delete</a>
                                </div>
                            </div>
                            <hr>
                            <?php }}else{ ?>
                                No Skill Found
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- ========== Portfolio ========== -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex mb-5 justify-content-between">
                            <h4 class="card-title mb-4">Portfolio</h4>
                            <div class="dropdown">
                                <a class="nav-link" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical" style="font-size: 20px"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownId">
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#portfolio_modal">Add</a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <?php
                                $port_limit = 8;
                                if (isset($_GET['port-page'])) {
                                    $port_page = $_GET['port-page'];
                                }else{
                                    $port_page = 1;
                                }
                                $offset = ($port_page -1) * $port_limit;
                                $portfolio = $db->query('SELECT * FROM portfolio WHERE user_id = "'.$_SESSION['user'].'" ORDER BY id DESC LIMIT '.$offset.', '.$port_limit.'');
                                if ($portfolio->num_rows > 0) {
                                    while ($_portfolio = $portfolio->fetch_assoc()) {
                            ?>
                            <div class="col-lg-3 mb-3">
                                <div class="card text-center text-white d-flex align-items-center justify-content-center flex-column" style="min-height: 250px; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.8)), url('public/storage/portfolio/<?= $_portfolio['image'] ?>'); background-size: cover; position: relative">
                                    <div class="dropdown" style="position: absolute; top: 10px; right: 10px">
                                        <a class="nav-link" href="javascript:void(0)" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical" style="font-size: 20px"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="edit_portfolio(<?= $_portfolio['id'] ?>)">Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="delete_portfolio(<?= $_portfolio['id'] ?>)">Delete</a>
                                        </div>
                                    </div>
                                    <h3><?= $_portfolio['title'] ?></h3>
                                    <p class="mb-3"><?= $_portfolio['description'] ?></p>
                                    <p><a class="text-white fw-bold" href="<?= $_portfolio['url'] ?>" target="_blank">More Info</a></p>
                                </div>
                            </div>
                            <?php }}else{ ?>
                                No Portfolio Found
                            <?php } ?>
                        </div>

                        <?php
                        $portfolio_page = $db->query('SELECT * FROM portfolio WHERE user_id = "'.$_SESSION['user'].'"');
                        if ($portfolio_page->num_rows > 0) {
                            $total_portfolio = $portfolio_page->num_rows;
                            $total_port_pages = ceil($total_portfolio / $port_limit);
                        ?>
                        <nav class="mt-4">
                            <ul class="pagination justify-content-center">
                                <?php if ($port_page > 1) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="my-profile.php?port-page=<?= ($port_page -1) ?>">Previous</a>
                                    </li>
                                <?php }else{ ?>
                                    <li class="page-item disabled">
                                        <a class="page-link">Previous</a>
                                    </li>
                                <?php } ?>
                                <?php
                                for ($i = 1; $i <= $total_port_pages; $i++) {
                                    if ($i == $port_page) {
                                        $active = 'active';
                                    }else{
                                        $active = '';
                                    }
                                ?>
                                <li class="page-item <?= $active ?>" aria-current="page">
                                    <a class="page-link" href="my-profile.php?port-page=<?= $i ?>"><?= $i; ?></a>
                                </li>
                                <?php } ?>
                                <?php if ($total_port_pages > $port_page) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="my-profile.php?port-page=<?= ($port_page +1) ?>">Next</a>
                                    </li>
                                <?php }else{ ?>
                                    <li class="page-item disabled">
                                        <a class="page-link">Next</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </nav>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>


<!-- ========== Profile Update Modal ========== -->
<div class="modal fade" id="profile_update_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <form id="profile_update_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Update Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="edit_first_name" value="<?= $user['first_name'] ?>" class="form-control mb-2" placeholder="First Name" required />
                    <input type="text" name="edit_last_name" value="<?= $user['last_name'] ?>" class="form-control mb-2" placeholder="Last Name" required />
                    <input type="email" name="edit_email" value="<?= $user['email'] ?>" class="form-control mb-2" placeholder="Email" />
                    <textarea rows="4" name="edit_address" class="form-control" placeholder="Address"><?= $user['address'] ?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ========== About Modal ========== -->
<div class="modal fade" id="about_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <form id="about_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">About</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea rows="4" name="edit_about" class="form-control" placeholder="About..." required><?= $user['about'] ?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ========== Password Modal ========== -->
<div class="modal fade" id="password_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <form id="password_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="current_pass" class="form-control mb-2" placeholder="Current Passwotd" required />
                    <input type="text" name="new_pass" class="form-control mb-2" placeholder="New Passwotd" required />
                    <input type="text" name="confirm_pass" class="form-control mb-2" placeholder="Confirm Passwotd" required />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ========== Education Modal ========== -->
<div class="modal fade" id="education_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <form id="education_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Education</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="edu_id" id="edu_id" />
                    <input type="text" name="program" id="ed_program" placeholder="Program" class="form-control mb-3" required />
                    <input type="text" name="institute" id="ed_institute" placeholder="School / College" class="form-control mb-3" required />
                    <input type="date" name="start_date" id="ed_start_date" class="form-control mb-3" required />
                    <input type="date" name="end_date" id="ed_end_date" class="form-control mb-3" required />
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="present" id="ed_present" value="present" />
                        <label class="form-check-label" for="ed_present">Present</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ========== Certificate Modal ========== -->
<div class="modal fade" id="certificate_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <form id="certificate_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Certificate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="cer_id" id="cer_id" />
                    <input type="text" name="cer_program" id="cer_program" placeholder="Program" class="form-control mb-3" required />
                    <input type="text" name="cer_institute" id="cer_institute" placeholder="Institute" class="form-control mb-3" required />
                    <input type="date" name="cer_issue_date" id="cer_issue_date" class="form-control mb-3" required />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ========== Cover Image Modal ========== -->
<div class="modal fade" id="cover_image_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Cover Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="set-cover-image"></div>
                <form id="cover_img_form" class="d-flex my-2 my-lg-0">
                    <input type="file" id="cover_img" class="form-control me-sm-2" onchange="see_img_before_upload('set-cover-image')" required />
                    <button type="submit" class="btn btn-success">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- ========== Location Modal ========== -->
<div class="modal fade" id="location_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <form id="user_location_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Add Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="location_id" />
                    <textarea rows="4" id="location" placeholder="Enter Location..." class="form-control mb-3" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ========== Experience Modal ========== -->
<div class="modal fade" id="experience_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <form id="experience_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Add Experience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="exp_id" id="exp_id" />
                    <input type="text" name="position_name" id="position_name" placeholder="Position Name" class="form-control mb-3" required />
                    <input type="text" name="company_name" id="company_name" placeholder="Company Name" class="form-control mb-3" required />
                    <select name="timing" id="timing" class="form-select mb-3" required>
                        <option selected disabled>Select Timing</option>
                        <option value="Full Time">Full Time</option>
                        <option value="Half Time">Half Time</option>
                        <option value="Online">Online</option>
                    </select>
                    <input type="date" name="start_date" id="e_start_date" class="form-control mb-3" required />
                    <input type="date" name="end_date" id="e_end_date" class="form-control mb-3" required />
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="e_present" name="present" value="present" />
                        <label class="form-check-label" for="e_present">Present</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ========== Portfolio Modal ========== -->
<div class="modal fade" id="portfolio_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <form id="portfolio_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Add Portfolio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="port_id" />
                    <input type="text" id="port_title" placeholder="Title" class="form-control mb-3" required />
                    <input type="text" id="port_desc" placeholder="Description" class="form-control mb-3" required />
                    <input type="url" id="port_url" placeholder="URL" class="form-control mb-3" required />
                    <input type="file" id="port_image" class="form-control" required />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ========== Skills Modal ========== -->
<div class="modal fade" id="skills_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <form id="skills_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Add Skill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="skill_id" name="skill_id" />
                    <input type="text" id="skill" name="skill" placeholder="Skill" class="form-control mb-3" required />
                    <input type="text" id="percent" name="percent" placeholder="Percentage" class="form-control mb-3" required />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ========== Language Modal ========== -->
<div class="modal fade" id="language_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <form id="language_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Add Language</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="lang_id" name="lang_id" />
                    <input type="text" id="language" name="language" placeholder="Language" class="form-control mb-3" required />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ========== About Me Modal ========== -->
<div class="modal fade" id="about_me_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <form id="about_me_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Edit About Me</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea rows="3" id="edit_education" name="edit__education" placeholder="Education" class="form-control mb-3" required></textarea>
                    <input type="text" id="edit_location" name="edit__location" placeholder="Location" class="form-control mb-3" required />
                    <textarea rows="3" id="edit_notes" name="edit__notes" placeholder="Notes" class="form-control mb-3" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include('layout/footer.php'); ?>

<script>

    // ========== Update Profile Picture ==========
    $('#profile_img').change(function () {
        Swal.fire({
            title: 'Do You Really Want To Update Profile?',
            showCancelButton: true,
            confirmButtonText: 'Update',
        }).then((result) => {
            if (result.isConfirmed) {
                let form_data = new FormData();
                form_data.append('update_profile_img', "");
                form_data.append('profile_img', $('#profile_img').prop('files')[0]);

                $.ajax({
                    url: './config/code.php',
                    type: 'POST',
                    data: form_data,
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (response)=> {
                        Swal.fire('Profile Picture Updated!', response, 'success')
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    }
                });
            }
            else{
                window.location.reload();
            }
        });
    });


    // ========== Update Cover Picture ==========
    $('#cover_img').change(function () {
        Swal.fire({
            title: 'Do You Really Want To Update Cover Image?',
            showCancelButton: true,
            confirmButtonText: 'Update',
        }).then((result) => {
            if (result.isConfirmed) {
                let form_data = new FormData();
                form_data.append('update_cover_img', "");
                form_data.append('cover_img', $('#cover_img').prop('files')[0]);

                $.ajax({
                    url: './config/code.php',
                    type: 'POST',
                    data: form_data,
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (response)=> {
                        Swal.fire('Cover Picture Updated!', response, 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    }
                });
            }
            else{
                window.location.reload();
            }
        })
    });


    // ========== Update Intro Video ==========
    $('#intro_video').change(function () {
        Swal.fire({
            title: 'Do You Really Want To Update Intro Video?',
            showCancelButton: true,
            confirmButtonText: 'Update',
        }).then((result) => {
            if (result.isConfirmed) {
                let form_data = new FormData();
                form_data.append('update_intro_video', "");
                form_data.append('intro_video', $('#intro_video').prop('files')[0]);

                $.ajax({
                    url: './config/code.php',
                    type: 'POST',
                    data: form_data,
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (response)=> {
                        Swal.fire('Intro Video Updated!', response, 'success')
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    }
                });
            }
            else{
                window.location.reload();
            }
        })
    });


    // ========== Personal Info ==========
    $('#profile_update_form').submit(function (e) {
        e.preventDefault();
        $.post("./config/code.php", $('#profile_update_form').serialize(), function (response) {
            Swal.fire({
                icon: 'success',
                text: response,
            })
            setTimeout(() => {
                window.location.reload();
            }, 1700);
        });
    });


    // ========== About Form ==========
    $('#about_form').submit(function (e) {
        e.preventDefault();
        $.post("./config/code.php", $('#about_form').serialize(), function (response) {
            Swal.fire({
                icon: 'success',
                text: response,
            })
            setTimeout(() => {
                window.location.reload();
            }, 1700);
        })
    });


    // ========== Change Password ==========
    $('#password_form').submit(function (e) {
        e.preventDefault();
        $.post("./config/code.php", $('#password_form').serialize(), function (response) {
            Swal.fire({
                icon: 'success',
                text: response,
            })
            setTimeout(() => {
                window.location.reload();
            }, 1700);
        })
    });


    // ========== Experience Form ==========
    $('#e_present').click(function () {
        if ($(this).is(':checked')) {
            $('#e_end_date').attr('disabled', 'disabled');
        }else{
            $('#e_end_date').removeAttr('disabled', 'disabled');
        }
    });

    $('#experience_form').submit(function (e) { 
        e.preventDefault();
        $.post("./config/code.php", $('#experience_form').serialize(), function (response) {
            Swal.fire({
                icon: 'success',
                text: response,
            })
            setTimeout(() => {
                window.location.reload();
            }, 1700);
        })
    });


    // ========== Education Form ==========
    $('#ed_present').click(function () {
        if ($(this).is(':checked')) {
            $('#ed_end_date').attr('disabled', 'disabled');
        }else{
            $('#ed_end_date').removeAttr('disabled', 'disabled');
        }
    });

    $('#education_form').submit(function (e) {
        e.preventDefault();
        $.post("./config/code.php", $('#education_form').serialize(), function (response) {
            Swal.fire({
                icon: 'success',
                text: response,
            })
            setTimeout(() => {
                window.location.reload();
            }, 1700);
        })
    });


    // ========== Certificate Form ==========
    $('#certificate_form').submit(function (e) {
        e.preventDefault();
        $.post("./config/code.php", $('#certificate_form').serialize(), function (response) {
            Swal.fire({
                icon: 'success',
                text: response,
            })
            setTimeout(() => {
                window.location.reload();
            }, 1700);
        })
    });


    // ========== About Me Form ==========
    $('#about_me_form').submit(function (e) {
        e.preventDefault();
        $.post("./config/code.php", $('#about_me_form').serialize(), function (response) {
            Swal.fire({
                icon: 'success',
                text: response,
            })
            setTimeout(() => {
                window.location.reload();
            }, 1700);
        })
    });


    // ========== Skill Form ==========
    $('#skills_form').submit(function (e) {
        e.preventDefault();
        $.post("./config/code.php", $('#skills_form').serialize(), function (response) {
            Swal.fire({
                icon: 'success',
                text: response,
            })
            setTimeout(() => {
                window.location.reload();
            }, 1700);
        })
    });


    // ========== Languages Form ==========
    $('#language_form').submit(function (e) {
        e.preventDefault();
        $.post("./config/code.php", $('#language_form').serialize(), function (response) {
            Swal.fire({
                icon: 'success',
                text: response,
            })
            setTimeout(() => {
                window.location.reload();
            }, 1700);
        })
    });


    // ========== Portfolio Form ==========
    $('#portfolio_form').submit(function (e) {
        e.preventDefault();
        let form_data = new FormData();
        form_data.append('portfolio_action', "");
        form_data.append('port_id', $('#port_id').val());
        form_data.append('port_title', $('#port_title').val());
        form_data.append('port_desc', $('#port_desc').val());
        form_data.append('port_url', $('#port_url').val());
        form_data.append('port_image', $('#port_image').prop('files')[0]);

        $.ajax({
            url: './config/code.php',
            type: 'POST',
            data: form_data,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            success: (response)=> {
                Swal.fire({
                    icon: 'success',
                    text: response,
                })
                setTimeout(() => {
                    window.location.reload();
                }, 1700);
            }
        });
    });




    // ========== Edit Experience ==========
    function edit_experience(id) {
        $.post("./config/code.php", {edit_experience: "", id: id}, function (result) {
            let data = JSON.parse(result);
            data.map(elem=> {
                $('#exp_id').val(elem.id);
                $('#position_name').val(elem.position_name);
                $('#company_name').val(elem.company_name);
                $('#timing').val(elem.timing);
                $('#e_start_date').val(elem.start_date);

                if (elem.present!="") {
                    $('#e_present').prop('checked', true);

                    if ($('#e_present').is(':checked')) {
                        $('#e_end_date').attr('disabled', 'disabled');
                    }else{
                        $('#e_end_date').removeAttr('disabled', 'disabled');
                    }
                }else{
                    $('#e_end_date').val(elem.end_date);
                }

                $('#experience_modal').modal('show');
            })
        });
    }


    // ========== Edit Education ==========
    function edit_education(id) {
        $.post("./config/code.php", {edit_education: "", id: id}, function (result) {
            let data = JSON.parse(result);
            data.map(elem=> {
                $('#edu_id').val(elem.id);
                $('#ed_program').val(elem.program);
                $('#ed_institute').val(elem.institute);
                $('#ed_start_date').val(elem.start_date);

                if (elem.present!="") {
                    $('#ed_present').prop('checked', true);

                    if ($('#ed_present').is(':checked')) {
                        $('#ed_end_date').attr('disabled', 'disabled');
                    }else{
                        $('#ed_end_date').removeAttr('disabled', 'disabled');
                    }
                }else{
                    $('#ed_end_date').val(elem.end_date);
                }

                $('#education_modal').modal('show');
            })
        });
    }


    // ========== Edit Certificate ==========
    function edit_certificate(id) {
        $.post("./config/code.php", {edit_certificate: "", id: id}, function (result) {
            let data = JSON.parse(result);
            data.map(elem=> {
                $('#cer_id').val(elem.id);
                $('#cer_program').val(elem.program);
                $('#cer_institute').val(elem.institute);
                $('#cer_issue_date').val(elem.issue_date);
                $('#certificate_modal').modal('show');
            })
        });
    }
    

    // ========== Edit Portfolio ==========
    function edit_portfolio(id) {
        $.post("./config/code.php", {edit_portfolio: "", id: id}, function (result) {
            let data = JSON.parse(result);
            data.map(elem=> {
                $('#port_id').val(elem.id);
                $('#port_title').val(elem.title);
                $('#port_desc').val(elem.description);
                $('#port_url').val(elem.url);
                $('#port_image').removeAttr('required');
                $('#portfolio_modal').modal('show');
            })
        });
    }


    // ========== Delete Experience ==========
    function delete_experience(id) {
        $.post("./config/code.php", {delete_experience: "", id: id}, function (response) {
            Swal.fire({
                icon: 'success',
                text: response,
            })
            setTimeout(() => {
                window.location.reload();
            }, 1700);
        });
    }


    // ========== Delete Experience ==========
    function delete_language(id) {
        $.post("./config/code.php", {delete_language: "", id: id}, function (response) {
            Swal.fire({
                icon: 'success',
                text: response,
            })
            setTimeout(() => {
                window.location.reload();
            }, 1700);
        });
    }
    

    // ========== Delete Education ==========
    function delete_education(id) {
        $.post("./config/code.php", {delete_education: "", id: id}, function (response) {
            Swal.fire({
                icon: 'success',
                text: response,
            })
            setTimeout(() => {
                window.location.reload();
            }, 1700);
        });
    }


    // ========== Delete Education ==========
    function delete_certificate(id) {
        $.post("./config/code.php", {delete_certificate: "", id: id}, function (response) {
            Swal.fire({
                icon: 'success',
                text: response,
            })
            setTimeout(() => {
                window.location.reload();
            }, 1700);
        });
    }


    // ========== Delete Portfolio ==========
    function delete_portfolio(id) {
        $.post("./config/code.php", {delete_portfolio: "", id: id}, function (response) {
            Swal.fire({
                icon: 'success',
                text: response,
            })
            setTimeout(() => {
                window.location.reload();
            }, 1700);
        });
    }


    // ========== Delete Portfolio ==========
    function delete_skill(id) {
        $.post("./config/code.php", {delete_skill: "", id: id}, function (response) {
            Swal.fire({
                icon: 'success',
                text: response,
            })
            setTimeout(() => {
                window.location.reload();
            }, 1700);
        });
    }


    function edit_about_me() {
        $.post("./config/code.php", {edit_about_me: ""}, function (result) {
            let data = JSON.parse(result);
            if (data.length > 0) {
                data.map(elem=> {
                    $('#edit_education').val(elem.education);
                    $('#edit_location').val(elem.location);
                    $('#edit_notes').val(elem.notes);
                    $('#about_me_modal').modal('show');
                })
            }else{
                $('#about_me_modal').modal('show');
            }
        });
    }


    function edit_skill(id) {
        $.post("./config/code.php", {edit_skill: "", id: id}, function (result) {
            let data = JSON.parse(result);
            data.map(elem=> {
                $('#skill_id').val(elem.id);
                $('#skill').val(elem.skill);
                $('#percent').val(elem.percent);
                $('#skills_modal').modal('show');
            })
        });
    }


    function edit_language(id) {
        $.post("./config/code.php", {edit_language: "", id: id}, function (result) {
            let data = JSON.parse(result);
            data.map(elem=> {
                $('#lang_id').val(elem.id);
                $('#language').val(elem.language);
                $('#language_modal').modal('show');
            })
        });
    }

</script>


<?php
    }else{
      header('Location: login.php');
    }
?>