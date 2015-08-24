<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;


$cakeDescription = 'GenQR';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('genqr.css') ?>
    <?= $this->Html->css('cake.css') ?>
</head>
<body class="home">
<header>
    <div class="header-image">
        <?= $this->Html->image('http://cakephp.org/img/cake-logo.png') ?>
        <h1>
            <?php
            echo $this->Html->link(
                "Go to login page",
                [
                    'controller' => 'Users',
                    'action' => 'login'
                ],
                [
                    'class' => "loginLink"
                ]
            );
            ?>

        </h1>
    </div>
</header>
<div id="content">

    <div class="row">
        <div class="columns large-12">
            <h3 class="">More about GenQR</h3>

            <p>
                GenQR is an online website which provides QRcode.
            </p>

        </div>
    </div>
</div>
<footer>
</footer>
</body>
</html>
