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

$this->layout = false;
$this->extend('/Layout/default');
?>
<div class="container">
    <div class="jumbotron">
        <h1><?= __('Framgia Food and Drinks') ?></h1>
        <p><?= __('Welcome to Framgia Food and Drinks') ?></p>
    </div>
    <?php if (!$this->request->Session()->read('Auth.User')): ?>
        <div class="btn-group col-sm-12">
            <?= $this->Html->link('Sign Up',['controller' => 'Users', 'action' => 'signup'],['class' => 'btn btn-primary btn-lg col-sm-5', 'role' => 'button']); ?>
            <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"></div>
            <?= $this->Html->link('Login',['controller' => 'Users', 'action' => 'login'],['class' => 'btn btn-primary btn-lg col-sm-5', 'role' => 'button']); ?>
        </div>
    <?php endif; ?>
</div>
