<?php
/**
 * 2015 Sarafoudis Nikolaos for 01generator
 *
 * This is a Payment module for Prestashop. This module requires
 *
 *  @author    Sarafoudis Nikolaos for 01generator
 *  @copyright Copyright (c) 2015 All Rights Reserved
 *  @license   read license.txt file for more information
 */

class Winteriscoming extends Module
{
    /* Main Constructor */
    public function __construct()
    {

        if (!defined('_PS_VERSION_')) {
            exit;
        }

        $this->name = 'winteriscoming';
        $this->tab = 'others';
        $this->version = '1.0.1';
        $this->author = '01generator';
        $this->module_key = '';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => '1.7.99');
        $this->bootstrap = true;
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
        parent::__construct();
        if (version_compare(_PS_VERSION_, '1.7.0.0 ', '>')) {
            $getTrans = Context::getContext()->getTranslator();
        }
        if (version_compare(_PS_VERSION_, '1.7.0.0 ', '<')) {
            $this->displayName = $this->l('Winter is coming! Let it snow!');
            $this->description = $this->l('Make your clients enjoy christmas by making your website to snow.');
        } else {
            $this->displayName = $getTrans->trans('Winter is coming! Let it snow!');
            $this->description = $getTrans->trans('Make your clients enjoy christmas by making your website to snow.');
        }
    }

    public function install()
    {
        if (!parent::install()
            || !$this->registerHook('displayHeader')
            || !$this->registerHook('displayFooter')
        ) {
            return false;
        }
        return true;
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->addCSS($this->_path . 'views/css/winteriscoming.css');
        return $this->display(__FILE__, 'views/templates/front/winteriscoming.tpl');
    }

    public function hookDisplayFooter($params)
    {
        $this->context->controller->addJs($this->_path . 'views/js/winteriscoming.js');
    }

    /* Configuartion page of the module */
    // public function getContent()
    // {
    //     // Store main connect configuratios values for the service providers
    //     $this->processConfiguration();
    //     $this->assignConfiguration();

    //     $this->smarty->assign('tags', array('form'));

    //     return $this->display(__FILE__, 'getContent.tpl') . $this->display(__FILE__, 'ps-tags.tpl');
    // }

    public function getHookController($hook_name)
    {
        require_once dirname(__FILE__) . '/controllers/hook/' .
            $hook_name . '.php';
        $controller_name = $this->name . $hook_name . 'Controller';
        $controller = new $controller_name($this, __FILE__,
            $this->_path);
        return $controller;
    }
}
