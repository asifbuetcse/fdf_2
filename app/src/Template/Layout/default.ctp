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

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css') ?>
    <?= $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css') ?>
    <?= $this->Html->css('//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css') ?>
    <?= $this->Html->script('//code.jquery.com/jquery-1.10.2.min.js') ?>
    <?= $this->Html->script('//code.jquery.com/ui/1.10.4/jquery-ui.min.js') ?>
    <?= $this->Html->script('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?php if ($this->request->Session()->read('Auth.User')): ?>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Framgia Food and Drinks</a>
                </div>
                <ul class="nav navbar-nav">
                <?php if ($this->request->Session()->read('Auth.User.is_admin') === true): ?>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Users <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><?= $this->Html->link('View All', ['controller' => 'users', 'action' => 'index']); ?></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><?= $this->Html->link('View All', ['controller' => 'categories', 'action' => 'index']); ?></li>
                            <li><?= $this->Html->link('Create New', ['controller' => 'categories', 'action' => 'add']); ?></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Products <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><?= $this->Html->link('View All', ['controller' => 'products', 'action' => 'index']); ?></li>
                            <li><?= $this->Html->link('Create New', ['controller' => 'products', 'action' => 'add']); ?></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">List Orders <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">View All</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li><?= $this->Html->link('Products', ['controller' => 'products', 'action' => 'index']); ?></li>
                    <li><a href="#">Suggestions</a></li>
                    <li><?= $this->Html->link('Profile', ['controller' => 'users', 'action' => 'view', $this->request->Session()->read('Auth.User.id')]); ?></li>
                <?php endif; ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><?= $this->Html->link('Log Out', ['controller' => 'users', 'action' => 'logout']); ?></li>
                </ul>
            </div>
        </nav>
    <?php else: ?>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Framgia Food and Drinks</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><?= $this->Html->link('Log In', ['controller' => 'users', 'action' => 'login']); ?></li>
                    <li class="active"><?= $this->Html->link('Sign Up', ['controller' => 'users', 'action' => 'signup']); ?></li>
                </ul>
            </div>
        </nav>
    <?php endif; ?>
    <?= $this->Flash->render() ?>
    <div class="container">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
