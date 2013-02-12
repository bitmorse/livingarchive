<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div id="content__">
    <div id="content_">

        <!-- end right panel -->
      <div class="row">
        <div class="span9 content-outer">

        	<div id="content">
            <h2>Add your dataset</h2>

            <p><br /></p>

            <?php echo $this->Form->create('Dataset', array('type' => 'file')); ?>
            <?php echo $this->Form->input('title');  ?>
            <?php echo $this->Form->input('notes', array('type'=>'textarea', 'label'=>'Description'));  ?>
            <?php echo $this->Form->input('tags', array('type'=>'text', 'label'=>'Tags (seperate with commas)'));  ?>
            <?php echo $this->Form->input('url', array('label'=>'URL  (link to website)')); ?>
            <?php echo $this->Form->input('file', array('type'=>'file', 'label'=>'File (currently only ZIP is supported)'));  ?>
          	<?php echo $this->Form->end('Add'); ?>

            Your IP address (<?php echo $_SERVER['REMOTE_ADDR']; ?>) will be stored with the dataset.
          </div>

        </div>
        <div class="span3 sidebar-outer">
          <div id="sidebar">
            <ul class="widget-list">
              <primarysidebar>
                


              </primarysidebar>
            </ul>
          </div>
        </div>
      </div>
    </div>
</div>
