<fieldset>
	<?php echo render('admin/group/_get_group', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
	<?php echo render('admin/permission/_get_permission', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
	<?php echo render('admin/permission/_get_actions', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>
</fieldset>
