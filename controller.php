<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Incidencia
 * @author     Isaac <isaac_op_92@hotmail.com>
 * @copyright  2019 Isaac
 * @license    Licencia Pública General GNU versión 2 o posterior. Consulte LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * Class IncidenciaController
 *
 * @since  1.6
 */
class IncidenciaController extends JControllerLegacy 
{
	/**
	 * Method to display a view.
	 *
	 * @param   boolean $cachable  If true, the view output will be cached
	 * @param   mixed   $urlparams An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JController   This object to support chaining.
	 *
	 * @since    1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
        $app  = JFactory::getApplication();
        $view = $app->input->getCmd('view', 'registrar_incidencias');
		$app->input->set('view', $view);

		parent::display($cachable, $urlparams);

		return $this;
	}
}
