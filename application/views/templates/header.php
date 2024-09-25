<?php date_default_timezone_set('Asia/Jakarta'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="<?=base_url()?>assets/ui/css/style.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/vendors/fontawesome/css/all.min.css">


  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.2.0/css/fixedHeader.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>

  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

  <title><?=$title ?> | E-Learning 14</title>
</head>
<body style="overflow: visible;">

  <div>
    <nav id="nav-laptop" class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary ">
      <a class="navbar-brand text-white" href="#"><img width="150" src="<?=base_url('assets/ui/')?>assets/img/ic_logo.png" alt=""></a>
      <div class="justify-content-center collapse navbar-collapse" id="navbarNav">
        <?php if ($user['role_id'] == 3): ?>
          <ul class="navbar-nav">
            <li class="nav-item <?=($title == 'Home') ? "active" : "" ?>">
              <a class="nav-link <?=($title== 'Home') ? "font-weight-bold" : "" ?>" href="<?=base_url('operator') ?>">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?=($title == 'Management Users') ? "active" : "" ?>">
              <a class="nav-link <?=($title=='Management Users') ? "font-weight-bold" : "" ?>" href="<?=base_url('operator/management_users') ?>">Management Users<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?=($title == 'Data Master') ? "active" : "" ?>">
              <a class="nav-link <?=($title== 'Data Master') ? "font-weight-bold" : "" ?>" href="<?=base_url('operator/master') ?>">Data Master<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?=($title == 'Pengumuman') ? "active" : "" ?>">
              <a class="nav-link <?=($title== 'Pengumuman') ? "font-weight-bold" : "" ?>" href="<?=base_url('operator/pengumuman') ?>">Pengumuman<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?=($title == 'Profile') ? "active" : ""?>">
              <a class="nav-link <?=($title== 'Profile') ? "font-weight-bold" : "" ?>" href="<?=base_url('operator/profile') ?>">Profile<span class="sr-only">(current)</span></a>
            </li>
          </ul>
          <?php elseif($user['role_id'] == 2) : ?>
            <ul class="navbar-nav">
              <li class="nav-item <?=($title == 'Home') ? "active" : "" ?>">
                <a class="nav-link <?=($title== 'Home') ? "font-weight-bold" : "" ?>" href="<?=base_url('guru') ?>">Home<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item <?=($title == 'Courses') ? "active" : "" ?>">
                <a class="nav-link <?=($title== 'Courses') ? "font-weight-bold" : "" ?>" href="<?=base_url('course') ?>">Courses<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item <?=($title == 'Report') ? "active" : "" ?>">
                <a class="nav-link <?=($title== 'Report') ? "font-weight-bold" : "" ?>" href="<?=base_url('report') ?>">Report<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item <?=($title == 'Announcement') ? "active" : "" ?>">
                <a class="nav-link <?=($title== 'Announcement') ? "font-weight-bold" : "" ?>" href="<?=base_url('announcement') ?>">Announcement<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item <?=($title == 'Profile') ? "active" : ""?>">
                <a class="nav-link <?=($title== 'Profile') ? "font-weight-bold" : "" ?>" href="<?=base_url('guru/profile') ?>">Profile<span class="sr-only">(current)</span></a>
              </li>
            </ul>
            <?php elseif($user['role_id'] == 1) : ?>
              <ul class="navbar-nav">
                <li class="nav-item <?=($title == 'Home') ? "active" : "" ?>">
                  <a class="nav-link <?=($title== 'Home') ? "font-weight-bold" : "" ?>" href="<?=base_url('siswa') ?>">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?=($title == 'Courses') ? "active" : "" ?>">
                  <a class="nav-link <?=($title== 'Courses') ? "font-weight-bold" : "" ?>" href="<?=base_url('course') ?>">Courses<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?=($title == 'My Courses') ? "active" : "" ?>">
                  <a class="nav-link <?=($title== 'My Courses') ? "font-weight-bold" : "" ?>" href="<?=base_url('course/mycourse') ?>">My Courses<span class="sr-only">(current)</span></a>
                </li>
                 <li class="nav-item <?=($title == 'Discussion') ? "active" : "" ?>">
                  <a class="nav-link <?=($title== 'Discussion') ? "font-weight-bold" : "" ?>" href="<?=base_url('forum') ?>">Discussion<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?=($title == 'Report') ? "active" : "" ?>">
                  <a class="nav-link <?=($title== 'Report') ? "font-weight-bold" : "" ?>" href="<?=base_url('report') ?>">Report<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?=($title == 'Announcement') ? "active" : "" ?>">
                <a class="nav-link <?=($title== 'Announcement') ? "font-weight-bold" : "" ?>" href="<?=base_url('announcement') ?>">Announcement<span class="sr-only">(current)</span></a>
              </li>
                <li class="nav-item <?=($title == 'Profile') ? "active" : ""?>">
                  <a class="nav-link <?=($title== 'Profile') ? "font-weight-bold" : "" ?>" href="<?=base_url('siswa/profile') ?>">Profile<span class="sr-only">(current)</span></a>
                </li>
              </ul>
            <?php endif ?>
          </div>
          <div class="form-inline d-sm-block d-none">
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span style="font-weight: 500" class="color-white mr-2">Hai, <?=$user['name'] ?></span><img class="img-avatar" src="<?=base_url('assets/upload/avatar/').$user['photo_profile']?>" alt="">
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <?php if ($user['role_id'] == 3): ?>
                      <a class="dropdown-item" href="<?=base_url('operator/profile') ?>">Profile</a>
                      <?php elseif($user['role_id'] == 2): ?>
                        <a class="dropdown-item" href="<?=base_url('guru/profile') ?>">Profile</a>
                        <?php elseif($user['role_id'] == 1) :?>
                        <a class="dropdown-item" href="<?=base_url('siswa/profile') ?>">Profile</a>
                      <?php endif ?>
                      <a style="cursor: pointer;" class="dropdown-item text-danger" data-toggle="modal" type="button" data-target="#logoutModal">Logout</a>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </nav>

          <nav id="nav-mobile" class="fixed-top bg-primary">
            <div class="row align-items-center">
              <div class="col">
                <a class="navbar-brand text-white" href="#"><img width="100" src="<?=base_url('assets/ui/') ?>assets/img/ic_logo.png" alt=""></a>
              </div>
              <div class="dropdown">
                <a class="nav-linkdropdown-toggle" href="#" id="DropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img class="img-avatar" src="<?=base_url('assets/upload/avatar/').$user['photo_profile'] ?>" alt="">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                 <?php if ($user['role_id'] == 3): ?>
                  <a class="dropdown-item" href="<?=base_url('operator') ?>">Home</a>
                  <a class="dropdown-item" href="<?=base_url('operator/management_users') ?>">Management Users</a>
                  <a class="dropdown-item" href="<?=base_url('operator/master') ?>">Data Master</a>
                  <a class="dropdown-item" href="<?=base_url('operator/pengumuman') ?>">Pengumuman</a>
                  <a class="dropdown-item" href="<?=base_url('operator/profile') ?>">Profile</a>
                  <a style="cursor: pointer;" class="dropdown-item text-danger" data-toggle="modal" type="button" data-target="#logoutModal">Logout</a>
                  <?php elseif($user['role_id'] == 2): ?>
                    <a class="dropdown-item" href="<?=base_url('guru') ?>">Home</a>
                    <a class="dropdown-item" href="<?=base_url('course') ?>">Courses</a>
                    <a class="dropdown-item" href="<?=base_url('laporan') ?>">Laporan</a>
                    <a class="dropdown-item" href="<?=base_url('guru/profile') ?>">Profile</a>
                    <a style="cursor: pointer;" class="dropdown-item text-danger" data-toggle="modal" type="button" data-target="#logoutModal">Logout</a>
                    <?php elseif($user['role_id'] == 1): ?>
                      <a class="dropdown-item" href="<?=base_url('siswa') ?>">Home</a>
                      <a class="dropdown-item" href="<?=base_url('course') ?>">Courses</a>
                      <a class="dropdown-item" href="<?=base_url('course/mycourse') ?>">My Courses</a>
                      <a class="dropdown-item" href="<?=base_url('forum') ?>">Discussion</a>
                      <a class="dropdown-item" href="<?=base_url('report') ?>">Report</a>
                      <a class="dropdown-item" href="<?=base_url('announcement') ?>">Annoucement</a>
                      <a class="dropdown-item" href="<?=base_url('siswa/profile') ?>">Profile</a>
                      <a style="cursor: pointer;" class="dropdown-item text-danger" data-toggle="modal" type="button" data-target="#logoutModal">Logout</a>
                    <?php endif ?>
                  </div>
                </div>
              </div>
            </nav>

          </div>

          <!-- Masukk Bagian Content -->
          <div class="custom-container">