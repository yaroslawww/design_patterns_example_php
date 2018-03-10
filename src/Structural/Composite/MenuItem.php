<?php

namespace DesignPatterns\Structural\Composite;


class MenuItem implements MenuItemInterface
{

	protected $sub_items = [];
	protected $text;
	protected $link;
	protected $is_container;

	/**
	 * MenuItem constructor.
	 *
	 * @param $text
	 * @param $link
	 * @param bool $is_container
	 */
	public function __construct( $text = null, $link = null, $is_container = false )
	{
		$this->text         = $text;
		$this->link         = $link;
		$this->is_container = $is_container;
	}


	public function render()
	{
		$html = '';

		if(!$this->is_container) {
			$html .= '<li>';
			$html .= '<a href="' . $this->link . '">';
			$html .= $this->text;
			$html .= '</a>';
		}
		if(is_array($this->sub_items) && count($this->sub_items)) {
			$html .= '<ul>';
			/** @var MenuItem $sub_item */
			foreach ( $this->sub_items as $sub_item ) {
				$html .= $sub_item->render();
			}
			$html .= '</ul>';
		}
		if(!$this->is_container) {
			$html .= '</li>';
		}

		return $html;
	}

	/**
	 * Add subitem to specific position
	 *
	 * @param MenuItem $item
	 * @param int|null $index
	 *
	 * @return MenuItem
	 */
	public function addSubItem( MenuItem $item, $index = null )
	{
		if(!is_null($index) && $index >= 0 && $index <= count($this->sub_items)) {
			array_splice($this->sub_items, $index, 0, [ $item ]);
		} else {
			array_push($this->sub_items, $item);
		}

		return $this;
	}

	/**
	 * Remove subitem from specific position
	 *
	 * @param int|null $index
	 */
	public function removeSubItem( $index = null )
	{
		if(is_null($index)) {
			array_pop($this->sub_items);
		} elseif(isset($this->sub_items[ $index ])) {
			unset($this->sub_items[ $index ]);
		}
	}

	/**
	 * @return mixed
	 */
	public function getSubItems()
	{
		return $this->sub_items;
	}

	/**
	 * @param mixed $sub_items
	 */
	public function setSubItems( $sub_items )
	{
		$this->sub_items = $sub_items;
	}

	/**
	 * @return mixed
	 */
	public function getText()
	{
		return $this->text;
	}

	/**
	 * @param mixed $text
	 */
	public function setText( $text )
	{
		$this->text = $text;
	}

	/**
	 * @return mixed
	 */
	public function getLink()
	{
		return $this->link;
	}

	/**
	 * @param mixed $link
	 */
	public function setLink( $link )
	{
		$this->link = $link;
	}

	/**
	 * @return bool
	 */
	public function isContainer(): bool
	{
		return $this->is_container;
	}

	/**
	 * @param bool $is_container
	 *
	 * @return MenuItem
	 */
	public function makeContainer( bool $is_container = true )
	{
		$this->is_container = $is_container;

		return $this;
	}

}