<?php

class PagesModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'pages.models.*',
			'pages.components.*',
		));
	}

    public $controllerMap = array(
        'manage' => 'pages.controllers.PagesManageController',
        'categories' => 'pages.controllers.PageCategoriesManageController',
        'links' => 'pages.controllers.PagesLinksController',
    );

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
