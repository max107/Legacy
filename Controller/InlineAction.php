<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Falaleev Maxim
 * @email max@studio107.ru
 * @version 1.0
 * @company Studio107
 * @site http://studio107.ru
 * @date 10/06/14.06.2014 19:50
 */

/**
 * CInlineAction class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace Mindy\Controller;

use ReflectionMethod;


/**
 * CInlineAction represents an action that is defined as a controller method.
 *
 * The method name is like 'actionXYZ' where 'XYZ' stands for the action name.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.web.actions
 * @since 1.0
 */
class InlineAction extends Action
{
    /**
     * Runs the action.
     * The action method defined in the controller is invoked.
     * This method is required by {@link CAction}.
     */
    public function run()
    {
        $method = 'action' . $this->getId();
        $this->getController()->$method();
    }

    /**
     * Runs the action with the supplied request parameters.
     * This method is internally called by {@link CController::runAction()}.
     * @param array $params the request parameters (name=>value)
     * @return boolean whether the request parameters are valid
     * @since 1.1.7
     */
    public function runWithParams($params)
    {
        $methodName = 'action' . $this->getId();
        $controller = $this->getController();
        $method = new ReflectionMethod($controller, $methodName);
        if ($method->getNumberOfParameters() > 0) {
            return $this->runWithParamsInternal($controller, $method, $params);
        } else {
            return $controller->$methodName();
        }
    }
}
