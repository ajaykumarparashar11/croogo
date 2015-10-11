<?php

use Croogo\Core\Status;

$this->extend('Croogo/Core./Common/admin_edit');

$this->CroogoHtml
	->addCrumb('', '/admin', ['icon' => $_icons['home']])
	->addCrumb(__d('croogo', 'Menus'), ['action' => 'index']);

if ($this->request->params['action'] == 'edit') {
	$this->CroogoHtml->addCrumb($menu->title, '/' . $this->request->url);

	$this->assign('title', __d('croogo', 'Edit Menu'));
}

if ($this->request->params['action'] == 'add') {
	$this->CroogoHtml->addCrumb(__d('croogo', 'Add'), '/' . $this->request->url);

	$this->assign('title', __d('croogo', 'Add Menu'));
}

$this->append('form-start', $this->Form->create($menu));

$this->append('tab-heading');
    echo $this->Croogo->adminTab(__d('croogo', 'Menu'), '#menu-basic');
    echo $this->Croogo->adminTab(__d('croogo', 'Misc.'), '#menu-misc');
    echo $this->Croogo->adminTabs();
$this->end();

$this->append('tab-content');
    echo $this->CroogoHtml->tabStart('menu-basic');
        echo $this->Form->input('id');
        $this->Form->templates(array(
            'class' => 'span10',
        ));
        echo $this->Form->input('title', array(
            'label' => __d('croogo', 'Title'),
        ));
        echo $this->Form->input('alias', array(
            'label' => __d('croogo', 'Alias'),
        ));
        echo $this->Form->input('description', array(
            'label' => __d('croogo', 'Description'),
        ));
    echo $this->CroogoHtml->tabEnd();
$this->end();

$this->append('tab-content');
    echo $this->CroogoHtml->tabStart('menu-misc');
        echo $this->Form->input('params', array(
            'label' => __d('croogo', 'Params'),
        ));
    echo $this->CroogoHtml->tabEnd();

    echo $this->Croogo->adminTabs();
$this->end();

$this->start('panels');
    echo $this->CroogoHtml->beginBox('Publishing') .
        $this->Form->button(__d('croogo', 'Apply'), array('name' => 'apply')) .
        $this->Form->button(__d('croogo', 'Save'), array('button' => 'success')) .
        $this->CroogoHtml->link(__d('croogo', 'Cancel'), array('action' => 'index'), array('button' => 'danger')) .
        $this->Form->input('status', array(
            'type' => 'radio',
            'legend' => false,
            'class' => false,
            'default' => Status::UNPUBLISHED,
            'options' => $this->Croogo->statuses(),
        )) .
        $this->CroogoHtml->div('input-daterange',
            $this->Form->input('publish_start', array(
                'label' => __d('croogo', 'Publish Start'),
                'type' => 'text',
            )) .
            $this->Form->input('publish_end', array(
                'label' => __d('croogo', 'Publish End'),
                'type' => 'text',
            ))
        ) .
        $this->CroogoHtml->endBox();

		$this->Croogo->adminBoxes();
echo $this->end('panels');

$this->append('form-end', $this->Form->end());