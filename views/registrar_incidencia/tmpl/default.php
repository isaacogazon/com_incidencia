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

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_incidencia');
$canDelete = JFactory::getUser()->authorise('core.delete', 'com_incidencia');

if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_incidencia'))
{
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>

<div class="item_fields">

	<table class="table table-hover">
		
		<tr>
			<th><?php echo JText::_('COM_INCIDENCIA_FORM_LBL_REGISTRAR_INCIDENCIA_FECHA'); ?></th>
			<td><?php echo date("d/m/Y", strtotime($this->item->fecha)); ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('Fecha finalización'); ?></th>
			<td><?php echo date("d/m/Y", strtotime($this->item->fechafin)); ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_INCIDENCIA_FORM_LBL_REGISTRAR_INCIDENCIA_EQUIPO'); ?></th>
			<td><?php echo $this->item->equipo; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_INCIDENCIA_FORM_LBL_REGISTRAR_INCIDENCIA_AULA'); ?></th>
			<td><?php echo $this->item->aula; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_INCIDENCIA_FORM_LBL_REGISTRAR_INCIDENCIA_PROFESOR'); ?></th>
			<td><?php echo $this->item->profesor; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_INCIDENCIA_FORM_LBL_REGISTRAR_INCIDENCIA_ALUMNO'); ?></th>
			<td><?php echo $this->item->alumno; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_INCIDENCIA_FORM_LBL_REGISTRAR_INCIDENCIA_CURSO'); ?></th>
			<td><?php echo $this->item->curso; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_INCIDENCIA_FORM_LBL_REGISTRAR_INCIDENCIA_DESCRIPCION'); ?></th>
			<td><?php echo nl2br($this->item->descripcion); ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_INCIDENCIA_FORM_LBL_REGISTRAR_INCIDENCIA_TIPO'); ?></th>
			<td><?php echo $this->item->tipo; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('Incidencia creada por');//COM_INCIDENCIA_FORM_LBL_REGISTRAR_INCIDENCIA_CREATED_BY ?></th>
			<td><?php echo $this->item->created_by_name; ?></td>
		</tr>

	</table>

</div>

<?php if($canEdit && $canDelete): ?>

	<a class="btn" href="<?php echo JRoute::_('index.php?option=com_incidencia&task=registrar_incidencia.edit&id='.$this->item->id); ?>"><?php echo JText::_("Editar"); ?></a>

<?php endif; ?>

<?php if (JFactory::getUser()->authorise('core.delete','com_incidencia.registrar_incidencia.'.$this->item->id)) : ?>

	<a class="btn btn-danger" href="#deleteModal" role="button" data-toggle="modal">
		<?php echo JText::_("Borrar incidencia"); ?>
	</a>

	<div id="deleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3><?php echo JText::_('COM_INCIDENCIA_DELETE_ITEM'); ?></h3>
		</div>
		<div class="modal-body">
			<p><?php echo JText::sprintf('COM_INCIDENCIA_DELETE_CONFIRM', $this->item->id); ?></p>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Close</button>
			<a href="<?php echo JRoute::_('index.php?option=com_incidencia&task=registrar_incidencia.remove&id=' . $this->item->id, false, 2); ?>" class="btn btn-danger">
				<?php echo JText::_('COM_INCIDENCIA_DELETE_ITEM'); ?>
			</a>
		</div>
	</div>

<?php endif; ?>