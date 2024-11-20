<?php


namespace Elgg\Debates\Menus;

/**
 * Hook callbacks for menus
 *
 * @since 4.0
 * @internal
 */
class Site {
   /**
	 * Register item to menu
	 *
	 * @param \Elgg\Event $event 'register', 'menu:site'
	 *
	 * @return \Elgg\Menu\MenuItems
	 */
	public static function register(\Elgg\Event $event) {
		$return = $event->getValue();
		
		$return[] = \ElggMenuItem::factory([
			'name' => 'debates',
			'icon' => 'comment',
			'text' => elgg_echo('collection:object:debates'),
			'href' => elgg_generate_url('default:object:debates'),
		]);
		
		return $return;
	}
}