<?php
/**
 * CubeCart v6
 * ========================================
 * CubeCart is a registered trade mark of CubeCart Limited
 * Copyright CubeCart Limited 2014. All rights reserved.
 * UK Private Limited Company No. 5323904
 * ========================================
 * Web:   http://www.cubecart.com
 * Email:  sales@devellion.com
 * License:  GPL-2.0 http://opensource.org/licenses/GPL-2.0
 */

/* Generate the alternate checkout button */
require_once(dirname(__FILE__).'/../class.shareyourcart-cubecart.php');
$share = $GLOBALS['config']->get('ShareYourCart');
$cubecart = new ShareYourCartCubeCartPlugin();
$show_details = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
!empty($_POST['syc-status-form'])) {
	if($_POST['module']['status']=='1')
	{
		$cubecart->activateHook();
		$show_details = true;
	}
	else if($_POST['module']['status']=='0')
	{
		$cubecart->deactivate();
		$show_details = false;
	}
}
else
{
	if($share['status'])
	{
		$show_details = true;
	}
	else 
	{
		$show_details = false;
	}
}

$module	= new Module(__FILE__, $_GET['module'], 'admin/index.tpl', true, false);


$template_vars['cubecart'] = $cubecart;
$template_vars['show_details'] = $show_details;

//$template_vars['button'] = $cubecart->getButtonCustomizationPage();

$module->assign_to_template($template_vars,'');
$module->fetch();
$page_content = $module->display();