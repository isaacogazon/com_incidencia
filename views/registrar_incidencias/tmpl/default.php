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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user       = JFactory::getUser();
$userId     = $user->get('id');
$listOrder  = $this->state->get('list.ordering');
$listDirn   = $this->state->get('list.direction');
$canCreate  = $user->authorise('core.create', 'com_incidencia') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'registrar_incidenciaform.xml');
$canEdit    = $user->authorise('core.edit', 'com_incidencia') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'registrar_incidenciaform.xml');
$canCheckin = $user->authorise('core.manage', 'com_incidencia');
$canChange  = $user->authorise('core.edit.state', 'com_incidencia');
$canDelete  = $user->authorise('core.delete', 'com_incidencia');
?>

<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post"
      name="adminForm" id="adminForm">

	<?php echo JLayoutHelper::render('default_filter', array('view' => $this), dirname(__FILE__)); ?>
	<table class="table table-striped" id="registrar_incidenciaList">
		<thead>
		<tr>
			<?php if (isset($this->items[0]->state)): ?>
				
			<?php endif; ?>

							<th class=''>
				<?php echo JHtml::_('grid.sort',  'Fecha fin', 'a.fechafin', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'Equipo', 'a.equipo', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'Aula', 'a.aula', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'Tipo', 'a.tipo', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'Estado', 'a.estado', $listDirn, $listOrder); ?>
				</th>
				<th class=''>
				<?php echo JHtml::_('grid.sort',  'Creado por', 'a.created_by', $listDirn, $listOrder); ?>
				</th>


							<?php if ($canEdit || $canDelete): ?>
					<th class="center">
				<?php echo 'Opciones'; ?>
				</th>
				<?php endif; ?>

		</tr>
		</thead>
		<tfoot>
		<tr>
			<td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">
				<?php echo $this->pagination->getListFooter(); ?>
			</td>
		</tr>
		</tfoot>
		<tbody>
		<?php foreach ($this->items as $i => $item) : ?>
			<?php $canEdit = $user->authorise('core.edit', 'com_incidencia'); ?>

							<?php if (!$canEdit && $user->authorise('core.edit.own', 'com_incidencia')): ?>
					<?php $canEdit = JFactory::getUser()->id == $item->created_by; ?>
				<?php endif; ?>

			<tr class="row<?php echo $i % 2; ?>">

				<?php if (isset($this->items[0]->state)) : ?>
					<?php $class = ($canChange) ? 'active' : 'disabled'; ?>
					
				<?php endif; ?>

								<td>

					<?php echo date("d/m/Y H:m", strtotime($item->fechafin)); ?>
				</td>
				<td>
				<?php if (isset($item->checked_out) && $item->checked_out) : ?>
					<?php echo JHtml::_('jgrid.checkedout', $i, $item->uEditor, $item->checked_out_time, 'registrar_incidencias.', $canCheckin); ?>
				<?php endif; ?>
				<a href="<?php echo JRoute::_('index.php?option=com_incidencia&view=registrar_incidencia&id='.(int) $item->id); ?>">
				<?php echo $this->escape($item->equipo); ?></a>
				</td>
				<td>
					<?php echo $item->aula; ?>
				</td>
				<td>

					<?php echo $item->tipo; ?>
				</td>
				<td>

					<?php 
						if($item->estado == 'Recibido'){
							echo('<label style="color:red;">'. $item->estado .'</label>');
						}
						else if($item->estado == 'En tratamiento'){
							echo('<label style="color:green;">'. $item->estado .'</label>');
						}
						else if($item->estado == 'Resuelto'){
							echo('<label style="color:blue;">'. $item->estado .'</label>');
						}else{
							echo('<label>'. $item->estado .'</label>');
						}
					?>
				</td>
				<td>

							<?php echo JFactory::getUser($item->created_by)->name; ?>				</td>


								<?php if ($canEdit || $canDelete): ?>
					<td class="center">
						<?php if ($canEdit && JFactory::getUser($item->created_by)->id == $user->get('id')|| $canDelete): ?>
							<a href="<?php echo JRoute::_('index.php?option=com_incidencia&task=registrar_incidenciaform.edit&id=' . $item->id, false, 2); ?>" class="btn btn-mini btn-info" type="button"><i class="icon-edit" ></i></a>
						<?php endif; ?>
						<?php if ($canDelete): ?>
							<a href="<?php echo JRoute::_('index.php?option=com_incidencia&task=registrar_incidenciaform.remove&id=' . $item->id, false, 2); ?>" class="btn btn-mini delete-button btn-danger" type="button"><i class="icon-trash" ></i></a>
						<?php endif; ?>
					</td>
				<?php endif; ?>

			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<?php if ($canCreate) : ?>
		<a href="<?php echo JRoute::_('index.php?option=com_incidencia&task=registrar_incidenciaform.edit&id=0', false, 0); ?>"
		   class="btn btn-success btn-small"><i
				class="icon-plus"></i>
			<?php echo ('Añadir nueva incidencia'); ?></a>
	<?php endif; ?>

	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
	<?php echo JHtml::_('form.token'); ?>
</form>

<?php if($canDelete) : ?>
<script type="text/javascript">

	jQuery(document).ready(function () {
		jQuery('.delete-button').click(deleteItem);
	});

	function deleteItem() {

	if (!confirm("<?php echo('¿Estás seguro que querer borrar ésta incidencia?'); ?>")) {
			return false;
		}
	}
</script>
<?php endif; ?>
