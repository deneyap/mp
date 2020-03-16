<?php
use yii\helpers\Html;
use yii\web\Session;

use backend\assets\AppAsset;
use backend\assets\fonts\Roboto;

use backend\services\ManagerServices;

Roboto::register($this);
AppAsset::register($this);

$this->beginPage();

$session = new Session();
$sidenav = isset($_COOKIE[$session->name .'-sidenav']) ? $_COOKIE[$session->name .'-sidenav'] : 'false';
?><!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>" <?php echo 'true' == $sidenav ? 'class="layout-collapsed"' : ''; ?>>
<head>
    <meta charset="<?php echo Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="layout-wrapper layout-2">
        <div class="layout-inner">
            <div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-sidenav-theme <?php echo 'true' == $sidenav ? 'sidenav-collapsed' : ''; ?>">
                <div class="demo-brand">
                    <a href="/dashboard" class="demo-brand-name sidenav-text font-weight-bolder my-4 text-center"><span class="text-primary">BUG</span><span class="logo-prefix">BOUNTY</span></a>
                    <a href="javascript:void(0)" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
                        <i class="ion ion-md-menu align-middle"></i>
                    </a>
                </div>
                <div class="sidenav-divider mt-0"></div>
                <ul class="sidenav-inner ps mb-4">
                    <li class="sidenav-item<?php echo 'dashboard' == $this->context->id ? ' open active' : ''; ?>">
                        <a href="/dashboard" class="sidenav-link">
                            <i class="sidenav-icon ion ion-md-speedometer"></i>
                            <div>Genel Bakış</div>
                        </a>
                    </li>
                    <li class="sidenav-divider mb-1"></li>
                        <?php 
                        if (isset($this->context->admin->role)):
                            $ids = ManagerServices::byRules($this->context->admin->role->id);
                            foreach (ManagerServices::menus($ids) as $menu):
                                ?>
                                <?php if ('hr' == $menu->type): ?>
                                    <li class="sidenav-divider mb-1"></li>
                                <?php elseif ('header' == $menu->type): ?>
                                    <li class="sidenav-header small font-weight-semibold"><?php echo $menu->label; ?></li>
                                <?php elseif ('link' == $menu->type): ?>
                                    <li class="sidenav-item<?php echo $menu->controllerId == $this->context->id ? ' open active' : ''; ?>">
                                        <a href="<?php echo $menu->link; ?>" class="sidenav-link">
                                            <i class="sidenav-icon <?php echo $menu->icon; ?>"></i>
                                            <div><?php echo $menu->label; ?></div>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li class="sidenav-item<?php echo $menu->controllerId == $this->context->id ? ' open active' : ''; ?>">
                                        <a href="javascript:void(0)" class="sidenav-link sidenav-toggle">
                                            <i class="sidenav-icon <?php echo $menu->icon; ?>"></i>
                                            <div><?php echo $menu->label; ?></div>
                                        </a>
                                        <?php if (isset($menu->childs) && count($menu->childs) > 0): ?>
                                        <ul class="sidenav-menu">
                                            <?php foreach ($menu->childs as $child): ?>
                                                <li class="sidenav-item<?php echo $menu->controllerId == $this->context->id && $child->actionId == $this->context->action->id ? ' active' : ''; ?>">
                                                    <a href="<?php echo $child->link; ?>" class="sidenav-link">
                                                        <div><?php echo $child->label; ?></div>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endif; ?>
                            <?php 
                            endforeach; 
                        endif;
                        ?>

                </ul>
                <br><br><br>
            </div>
            <div class="layout-container">
                <?php if (isset($this->context->admin) && isset($this->context->admin->id)): ?>
                    <nav class="layout-navbar navbar navbar-expand-lg align-items-lg-center container-p-x bg-navbar-theme" id="layout-navbar">
                        <div class="navbar-collapse collapse" id="layout-navbar-collapse">
                            <hr class="d-lg-none w-100 my-2">
                            <form action="/search/" method="get" name="search" id="search">
                                <div class="navbar-nav align-items-lg-center">
                                    <label class="nav-item navbar-text navbar-search-box p-0 active">
                                        <i class="ion ion-ios-search navbar-icon align-middle"></i>
                                        <span class="navbar-search-input pl-2">
                                            <input type="text" class="form-control navbar-text mx-2" placeholder="Anahtar Kelime" style="width:200px">
                                        </span>
                                    </label>
                                </div>
                            </form>
                            <div class="navbar-nav align-items-lg-center ml-auto">
                                <div class="nav-item font-weight-bold">
                                    <a class="nav-link text-muted" href="/manager/profile">
                                        <span class="d-inline-flex flex-lg-row-reverse align-items-center align-middle">
                                            <img src="/images/avatar.svg" alt="" class="d-block ui-w-30 rounded-circle">
                                            <span class="px-1 mr-lg-2 ml-2 ml-lg-0">Merhaba <span class="text-primary"><?php echo $this->context->admin->email; ?></span>!</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="nav-item d-none d-lg-block text-big font-weight-light line-height-1 opacity-25 mr-2 ml-1">|</div>
                                <div class="nav-item">
                                    <a class="nav-link dropdown-toggle hide-arrow text-danger" href="/site/logout">
                                        <i class="ion ion-md-exit navbar-icon align-middle"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>
                <?php endif; ?>
                <div class="layout-content">
                    <?php echo $content; ?>
                </div>
                <nav class="layout-footer footer bg-footer-theme">
                    <div class="container-fluid d-flex flex-wrap justify-content-between text-center container-p-x pb-3">
                        <div class="pt-3">
                            <span class="footer-text font-weight-bolder"><span class="text-primary">BUG</span>BOUNTY</span> ©
                        </div>
                        <div>
                            <a href="<?php echo \Yii::$app->params['domain']; ?>" class="footer-link pt-3">BUGBOUNTY</a>
                            <a href="http://www.uitsec.com" class="footer-link pt-3 ml-4">UITSEC</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>