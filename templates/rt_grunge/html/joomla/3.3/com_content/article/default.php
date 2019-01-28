<?php
/**
 * @package   Template Overrides - RocketTheme
* @version   1.6 October 18, 2018
* @author    RocketTheme http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2018 RocketTheme, LLC
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Rockettheme Gantry Template uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');

// Create shortcuts to some parameters.
$params		= $this->item->params;
$images = json_decode($this->item->images);
$urls = json_decode($this->item->urls);
$canEdit	= $this->item->params->get('access-edit');
$user		= JFactory::getUser();
$publishdate = version_compare(JVERSION,'1.7.3','<') ? 'COM_CONTENT_PUBLISHED_DATE' : 'COM_CONTENT_PUBLISHED_DATE_ON';
?>
<div id="page">
<div class="rt-article">

<?php
		if (!empty($this->item->pagination) AND $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
		{
		 echo $this->item->pagination;
		}
?>

		<?php /** Begin Page Title **/ if ($this->params->get('show_page_heading', 1)) : ?>
		<h1 class="componentheading">
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h1>
		<?php /** End Page Title **/  endif; ?>
		
		<?php if ($params->get('show_create_date')) : ?>
		<span class="createdate">
						<?php echo JHtml::_('date',$this->item->created, JText::_('DATE_FORMAT_LC3')); ?>
		</span>
		<?php endif; ?>
		
		<?php /** Begin Article Title **/ if ($params->get('show_title')) : ?>
				<h2 class="contentheading">
					<?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
					<a href="<?php echo $this->item->readmore_link; ?>">
						<?php echo $this->escape($this->item->title); ?></a>
					<?php else : ?>
						<?php echo $this->escape($this->item->title); ?>
					<?php endif; ?>
				</h2>
			<div class="articledivider"></div> 	
			<?php /** End Article Title **/ endif; ?>
			
			<?php $useDefList = (($params->get('show_author')) OR ($params->get('show_create_date')) OR ($params->get('show_modify_date')) OR ($params->get('show_publish_date'))
				OR ($params->get('show_hits')) || ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon'))); ?>
			<?php /** Begin Article Info **/ if ($useDefList) : ?>
				<p class="articleinfo">
					<?php if ($params->get('show_modify_date')) : ?>
					<span class="modifydate">
						<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date',$this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
					</span>
					<?php endif; ?>
					<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
					<span class="createdby"> 
						<?php $author =  $this->item->author; ?>
						<?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>
			
						<?php if (!empty($this->item->contactid ) &&  $params->get('link_author') == true):?>
							<?php echo JHtml::_('link',JRoute::_('index.php?option=com_contact&view=contact&id='.$this->item->contactid),$author); ?>
			
						<?php else :?>
							<?php echo $author; ?>
						<?php endif; ?>
					</span>
					<?php endif; ?>
					<?php if ($params->get('show_publish_date')) : ?>
					<span class="createdby"> 
						<?php echo JText::sprintf($publishdate, JHtml::_('date',$this->item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
					</span>
					<?php endif; ?>	
					<?php if ($params->get('show_hits')) : ?>
					<span class="createdby"> 
						<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
					</span>
					<?php endif; ?>
				</p>
					
					
					<?php /** Begin Article Icons **/ if ($canEdit ||  $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
					<p class="buttonheading">
						<?php if (!$this->print) : ?>
							<?php if ($params->get('show_print_icon')) : ?>
							<span>
								<?php echo JHtml::_('icon.print_popup',  $this->item, $params); ?>
							</span>
							<?php endif; ?>
		
							<?php if ($params->get('show_email_icon')) : ?>
							<span>
								<?php echo JHtml::_('icon.email',  $this->item, $params); ?>
							</span>
							<?php endif; ?>
						
							<?php if ($canEdit) : ?>
							<span>
								<?php echo JHtml::_('icon.edit', $this->item, $params); ?>
							</span>
							<?php endif; ?>
							<?php else : ?>
							<span>
								<?php echo JHtml::_('icon.print_screen',  $this->item, $params); ?>
							</span>
						<?php endif; ?>
					</p>
				<?php /** End Article Icons **/ endif; ?>
			<?php endif; ?>

		<?php  if (!$params->get('show_intro')) :
			echo $this->item->event->afterDisplayTitle;
		endif; ?>
		
		<p class="iteminfo">
		<?php if ($params->get('show_parent_category') && $this->item->parent_slug != '1:root') : ?>
		<span>
			<?php	$title = $this->escape($this->item->parent_title);
					$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)).'">'.$title.'</a>';?>
			<?php if ($params->get('link_parent_category') AND $this->item->parent_slug) : ?>
				<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
				<?php else : ?>
				<?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
			<?php endif; ?>
		</span>
		<?php endif; ?>
		<?php if ($params->get('show_category')) : ?>
		<span>
			<?php 	$title = $this->escape($this->item->category_title);
					$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';?>
			<?php if ($params->get('link_category') AND $this->item->catslug) : ?>
				<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
				<?php else : ?>
				<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
			<?php endif; ?>
		</span>
		<?php endif; ?>
		</p>
		
		<?php echo $this->item->event->beforeDisplayContent; ?>

		<?php if (isset ($this->item->toc)) : ?>
			<?php echo $this->item->toc; ?>
		<?php endif; ?>

		<?php if (isset($urls) AND ((!empty($urls->urls_position) AND ($urls->urls_position=='0')) OR  ($params->get('urls_position')=='0' AND empty($urls->urls_position) ))
				OR (empty($urls->urls_position) AND (!$params->get('urls_position')))): ?>
		<?php echo $this->loadTemplate('links'); ?>
		<?php endif; ?>

				<?php if ($params->get('access-view')):?>
		<?php  if (isset($images->image_fulltext) and !empty($images->image_fulltext)) : ?>
		<?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
		<div class="img-fulltext-<?php echo htmlspecialchars($imgfloat); ?>">
		<img
			<?php if ($images->image_fulltext_caption):
				echo 'class="caption"'.' title="' .htmlspecialchars($images->image_fulltext_caption) .'"';
			endif; ?>
			src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>"/>
		</div>
		<?php endif; ?>
					<?php
					if (!empty($this->item->pagination) AND $this->item->pagination AND !$this->item->paginationposition AND !$this->item->paginationrelative):
						echo $this->item->pagination;
					 endif;
					?>
					<?php echo $this->item->text; ?>
					<?php
					if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND!$this->item->paginationrelative):
						 echo $this->item->pagination;?>
					<?php endif; ?>
					
		<?php if (isset($urls) AND ((!empty($urls->urls_position)  AND ($urls->urls_position=='1')) OR ( $params->get('urls_position')=='1') )): ?>
		<?php echo $this->loadTemplate('links'); ?>
		<?php endif; ?>

			
		<?php //optional teaser intro text for guests ?>
		<?php elseif ($params->get('show_noauth') == true AND  $user->get('guest') ) : ?>
			<?php echo $this->item->introtext; ?>
			<?php //Optional link to let them register to see the whole article. ?>
			<?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
				$link1 = JRoute::_('index.php?option=com_users&view=login');
				$link = new JURI($link1);?>
				<p class="readmore">
				<a href="<?php echo $link; ?>">
				<?php $attribs = json_decode($this->item->attribs);  ?> 
				<?php 
				if ($attribs->alternative_readmore == null) :
					echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
				elseif ($readmore = $this->item->alternative_readmore) :
					echo $readmore;
					if ($params->get('show_readmore_title', 0) != 0) :
					    echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
					endif;
				elseif ($params->get('show_readmore_title', 0) == 0) :
					echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');	
				else :
					echo JText::_('COM_CONTENT_READ_MORE');
					echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
				endif; ?></a>
				</p>
			<?php endif; ?>
		<?php endif; ?>

		<?php
		if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND $this->item->paginationrelative):
			 echo $this->item->pagination;?>
		<?php endif; ?>

		<?php echo $this->item->event->afterDisplayContent; ?>

		<?php if (isset($urls) AND ((!empty($urls->urls_position) AND ($urls->urls_position=='0')) OR  ($params->get('urls_position')=='0' AND empty($urls->urls_position) ))
				OR (empty($urls->urls_position) AND (!$params->get('urls_position')))): ?>
		<?php echo $this->loadTemplate('links'); ?>
		<?php endif; ?>

	<?php echo $this->item->event->afterDisplayContent; ?>
	<?php
	if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND $this->item->paginationrelative):
		 echo $this->item->pagination;?>
	<?php endif; ?>
		
	</div>
</div>