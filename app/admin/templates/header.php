<!-- Start container-kanan -->
<div class="container-kanan">

    <!-- Start Header -->
    <header>
        <div class="dashboard">
            <span>Admin</span>
            <p>Dashboard</p>
        </div>
        <div class="profil">
            <p><?= $_SESSION['username']; ?></p>
            <img src="<?= BASEURL ;?>/app/assets/img/icon-profile.png" alt="icon-profil" class="icon-profil">
        </div>
    </header>
    <!-- End Header -->