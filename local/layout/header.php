<?
/* @var string $title */
/* @var string $page */
/* @var bool $isAuthorized */
/* @var $breadcrumbs */
/* @var $inner */
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link href="<?= g_ROOT . "local/css/build/style.css?ver=" . rand() ?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?= g_ROOT . 'favicon.ico' ?>"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
</head>

<body data-page-type="<?= $page ?>" class="<?= $page ?>-page">
<div class="page-wrapper">
    <!-- header -->
    <header>
        <div class="container">
            <a href="<?= g_ROOT ?>" class="logo">Shop</a>

            <div class="menu">
                <a href="<?= g_ROOT ?>catalog/category/" class="underlined-button">Каталог</a>
            </div>


            <div class="auth-controller">
                <div class="reg icon js-header-icon<?= !$isAuthorized ? ' active' : '' ?>" >
                    <a href="<?= g_ROOT ?>account/reg/" title="Регистрация"><i class="fas fa-user-plus"></i></a>
                    <div class="dropdown js-dropdown"></div>
                </div>
                <div class="login icon js-header-icon<?= !$isAuthorized ? ' active' : '' ?>"><a href="<?= g_ROOT ?>account/login/" title="Войти"><i class="fas fa-sign-in-alt"></i></a></div>
                <div class="authorized icon js-header-icon<?= $isAuthorized ? ' active' : '' ?>"><a href="javascript:void(0)" title="Личный кабинет"><i class="fas fa-user"></i></a></div>
                <div class="logout icon js-header-icon<?= $isAuthorized ? ' active' : '' ?>""><a href="<?= g_ROOT ?>account/logout/" title="Выйти"><i class="fas fa-sign-out-alt"></i></a></div>

                <div class="cart icon js-header-icon<?= $isAuthorized ? ' active' : '' ?>"><a href="javascript:void(0)" title="Корзина"><i class="fas fa-shopping-cart"></i></a></div>
            </div>
        </div>
    </header>

    <!-- content -->
    <main>
        <div class="container">
            <div class="breadcrumbs">
                <?= $breadcrumbs ? $breadcrumbs : '' ?>
            </div>
            <h1><?= $title ?></h1>
            <?= $inner ?>
        </div>
    </main>
