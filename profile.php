<?php include('config/config.php'); ?>

<?php include('layout/header.php'); ?>

<?php
    if (isset($_GET['id'])) {
        $query = $db->query('SELECT * FROM users WHERE id = "'.$_GET['id'].'"');
        if ($query->num_rows > 0) {
            $user = $query->fetch_assoc();
?>

<?php include('layout/navbar.php'); ?>

<style>

#hero-no-slider::before {
  background: linear-gradient(to right, rgba(0,0,0,0.3), rgba(0,0,0,0.5)), url("public/storage/cover/<?= $user['cover_image']; ?>");
  background-size: cover;
  background-position: center;
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

    <section id="hero-no-slider" class="d-flex justify-cntent-center align-items-center"></section>

    <div class="container" style="position: relative; margin-top: -120px; z-index: 10">
        <div class="row">
            <div class="col-md-10">
                <div class="avatar d-flex flex-column flex-md-row justify-content-center justify-content-md-start">
                    <div class="avatar-img mx-auto mx-md-0">
                        <label class="label">
                            <figure class="personal-figure">
                                <img src="<?= ($user['image']) ? "public/storage/profile/".$user['image'] : "public/img/user.png" ?>" alt="" />
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
                    </div>
                </div>


                <!-- ========== About ========== -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex mb-3 justify-content-between">
                            <h4 class="card-title">About</h4>
                        </div>
                        <p><?= $user['about'] ?></p>
                    </div>
                </div>


                <!-- ========== Experience ========== -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex mb-3 justify-content-between">
                            <h4 class="card-title mb-4">Experience</h4>
                        </div>

                        <div>
                        <?php
                            $experience = $db->query('SELECT * FROM experience WHERE user_id = "'.$_GET['id'].'"');
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
                        </div>

                        <div>
                        <?php
                            $education = $db->query('SELECT * FROM education WHERE user_id = "'.$_GET['id'].'"');
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
                        </div>

                        <div>
                        <?php
                            $certificate = $db->query('SELECT * FROM certificate WHERE user_id = "'.$_GET['id'].'"');
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
                        </div>
                        <?php
                            $about = $db->query('SELECT * FROM about_me WHERE user_id = "'.$_GET['id'].'"');
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
                        </div>

                        <div>
                            <?php
                                $skill = $db->query('SELECT * FROM skills WHERE user_id = "'.$_GET['id'].'"');
                                if ($skill->num_rows > 0) {
                                    while ($_skill = $skill->fetch_assoc()) {
                            ?>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <span style="color: black; font-weight: 600"><?= $_skill['skill'] ?></span>
                                <span class="text-primary"><?= $_skill['percent'] ?>%</span>
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
                        </div>

                        <div>
                            <?php
                                $language = $db->query('SELECT * FROM languages WHERE user_id = "'.$_GET['id'].'"');
                                if ($language->num_rows > 0) {
                                    while ($_language = $language->fetch_assoc()) {
                            ?>
                            <div>
                                <span style="color: black; font-weight: 600"><?= $_language['language'] ?></span>
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
                                $portfolio = $db->query('SELECT * FROM portfolio WHERE user_id = "'.$_GET['id'].'" ORDER BY id DESC LIMIT '.$offset.', '.$port_limit.'');
                                if ($portfolio->num_rows > 0) {
                                    while ($_portfolio = $portfolio->fetch_assoc()) {
                            ?>
                            <div class="col-lg-3 mb-3">
                                <div class="card text-center text-white d-flex align-items-center justify-content-center flex-column" style="min-height: 250px; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.8)), url('public/storage/portfolio/<?= $_portfolio['image'] ?>'); background-size: cover; position: relative">
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
                        $portfolio_page = $db->query('SELECT * FROM portfolio WHERE user_id = "'.$_GET['id'].'"');
                        if ($portfolio_page->num_rows > 0) {
                            $total_portfolio = $portfolio_page->num_rows;
                            $total_port_pages = ceil($total_portfolio / $port_limit);
                        ?>
                        <nav class="mt-4">
                            <ul class="pagination justify-content-center">
                                <?php if ($port_page > 1) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="profile.php?id=<?= $_GET['id'] ?>&port-page=<?= ($port_page -1) ?>">Previous</a>
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
                                    <a class="page-link" href="profile.php?id=<?= $_GET['id'] ?>&port-page=<?= $i ?>"><?= $i; ?></a>
                                </li>
                                <?php } ?>
                                <?php if ($total_port_pages > $port_page) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="profile.php?id=<?= $_GET['id'] ?>&port-page=<?= ($port_page +1) ?>">Next</a>
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


<?php
    include('layout/footer.php');

    }else{
?>
    <h1 class="text-center display-5 mt-5">Not Found</h1>
    <p class="text-center">
        <a href="index.php" class="text-decoration-none text-success">Back To Home</a>
    </p>
<?php
    }
    }else{
?>
    <h1 class="text-center display-5 mt-5">Not Found</h1>
    <p class="text-center">
        <a href="index.php" class="text-decoration-none text-success">Back To Home</a>
    </p>
<?php } ?>