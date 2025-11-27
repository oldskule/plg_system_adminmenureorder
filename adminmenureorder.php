<?php
/**
 * Plugin Name: Admin Menu Reorder
 * Description: Reorders Joomla Admin Menu sidebar items based on a defined order.
 * Version: 1.0
 * Author: Your Name
 */

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\User\User;

defined('_JEXEC') or die;

class PlgSystemAdminMenuReorder extends CMSPlugin
{
    protected $app;

    public function onBeforeCompileHead()
	{
		if (!$this->app->isClient('administrator')) {
			return;
		}
	
		// Get the menu order from the plugin parameters
		$menuOrderParam = $this->params->get('menu_order', '[]');
		$menuOrderItems = is_string($menuOrderParam) ? json_decode($menuOrderParam) : $menuOrderParam;
		$order = [];

		if (!empty($menuOrderItems)) {
			// Ensure it's a simple array of objects
			$menuOrderItems = array_values((array)$menuOrderItems);
			$order = array_column($menuOrderItems, 'title');
		}
	
		// Encode for JavaScript
		$jsArray = json_encode($order);
	
		// The pure JavaScript code
$scriptStart = <<<'JS'
document.addEventListener("DOMContentLoaded", function () {
    const order = 
JS;

$scriptEnd = <<<'JS'
;
    const menu = document.querySelector("#collapse3");
    if (!menu) return console.warn("AdminMenuReorder: collapse3 not found.");

    const items = Array.from(menu.querySelectorAll("li.item.item-level-2"));
    const matched = [], unmatched = [];

    items.forEach(li => {
        const labelEl = li.querySelector(".sidebar-item-title");
        if (!labelEl) return;

        const title = labelEl.textContent.trim();
        const index = order.indexOf(title);
        if (index >= 0) {
            matched[index] = li;
        } else {
            unmatched.push(li);
        }
    });

    const final = matched.filter(Boolean).concat(unmatched);
    final.forEach(li => menu.appendChild(li));

    console.groupCollapsed("✅ AdminMenuReorder (JS-based)");
    final.forEach((li, i) => {
        const title = li.querySelector(".sidebar-item-title")?.textContent.trim();
        console.log(`#${i + 1}: ${title}`);
    });
    console.groupEnd();
});
JS;

		$script = $scriptStart . $jsArray . $scriptEnd;

		// Add the inline script via the Web Asset Manager
		$this->app->getDocument()->getWebAssetManager()->addInlineScript($script);
	}

}
