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

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

//JHtml::script('incidencias/media/jui/js/javascript.js');//incidencias/components/com_incidencia/helpers/javascript.js
JHtml::script('https://momentjs.com/downloads/moment-with-locales.js');
JHtml::script('https://momentjs.com/downloads/moment.min.js');
JHtml::script('https://code.jquery.com/jquery-3.4.1.min.js');



// Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_incidencia', JPATH_SITE);
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/media/com_incidencia/js/form.js');
$doc->addScript(JUri::base() . '/media/com_incidencia/js/javascript.js');

$user    = JFactory::getUser();
$canEdit = IncidenciaHelpersIncidencia::canUserEdit($this->item, $user);


?>

<div class="registrar_incidencia-edit front-end-edit">
	<?php if (!$canEdit) : ?>
		<h3>
			<?php throw new Exception(JText::_('No autorizado'), 403); ?>
		</h3>
	<?php else : ?>
		<?php if (!empty($this->item->id)): ?>
			<h1><?php echo 'Modificar la incidencia vista por '.$this->item->profesor/*JText::sprintf('COM_INCIDENCIA_EDIT_ITEM_TITLE', $this->item->id)*/; ?></h1>
		<?php else: ?>
<h1><?php echo('Registrar nueva incidencia en IES La Marisma') /*JText::_('COM_INCIDENCIA_ADD_ITEM_TITLE')*/; ?></h1>
		<?php endif; ?>

		<form id="form-registrar_incidencia"
			  action="<?php echo JRoute::_('index.php?option=com_incidencia&task=registrar_incidencia.save'); ?>"
			  method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
			
	<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />

	<!--Para poder poner por defecto el valor de la fecha, primero he tenido que llamar
	a la funcion renderFiel modificandole el valor y dandole el valor que deseo ponerle -->
	<?php $this->form->setValue('fecha',null,date('d-m-Y H:i:s'));?>
	<?php echo $this->form->renderField('fecha');?>

	<?php //$this->form->setValue('fechafin',null);?>
	<?php echo $this->form->renderField('fechafin');?>
	
	<?php echo $this->form->renderField('equipo'); ?>

	<?php echo $this->form->renderField('aula'); ?>

	<?php echo $this->form->renderField('profesor'); ?>

	<?php echo $this->form->renderField('alumno'); ?>

	<?php echo $this->form->renderField('curso'); ?>

	<?php echo $this->form->renderField('descripcion'); ?>

	<?php echo $this->form->renderField('tipo'); ?>

	<?php echo $this->form->renderField('estado'); ?>

	<!--<input type="hidden" name="jform[estado]" value="<?php// echo 'recibido'/*$this->item->estado;*/ ?>" />-->

	<?php echo $this->form->renderField('created_by'); ?>

			<div class="control-group">
				<div class="controls">

					<?php if ($this->canSave): ?>
						<button type="submit" class="validate btn btn-primary">
							<?php echo 'Enviar'; ?>
						</button>
					<?php endif; ?>
					<a class="btn"
					   href="<?php echo JRoute::_('index.php?option=com_incidencia&task=registrar_incidenciaform.cancel'); ?>"
					   title="<?php echo 'Cancelar'; ?>">
						<?php echo 'Cancelar'; ?>
					</a>
				</div>
			</div>

			<input type="hidden" name="option" value="com_incidencia"/>
			<input type="hidden" name="task"
				   value="registrar_incidenciaform.save"/>
			<?php echo JHtml::_('form.token'); ?>
		</form>
	<?php endif; ?>
</div>
