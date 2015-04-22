<?php
	/**
	 * Class used to store menu information.
	 */
	class menuItem {
		/**
		 * Menu Image's path name.
		 * @var String
		 */
		private $itemImage;
		/**
		 * Menu's name.
		 * @var String
		 */
		private $itemName;
		/**
		 * Menu's description.
		 * @var String
		 */		
		private $description;
		/**
		 * Menu's price.
		 * @var String
		 */		
		private $price;
	
		/**
		 * Constructor. .
		 * @param String $itemImage
		 * @param String $itemName
		 * @param String $description
		 * @param String $price
		 */
		public function __construct($itemImage, $itemName, $description, $price) {
			$this->itemImage = $itemImage;
			$this->itemName = $itemName;
			$this->description = $description;
			$this->price = $price;
		}
		/**
		 * Returns itemImage.
		 */
		public function getItemImage() {
			return $this->itemImage;
		}
		/**
		 * Sets Image path.
		 * @param String $itemImage
		 */
		public function setItemImage($itemImage) {
			$this->itemImage = $itemImage;
		}
		/**
		 * Returns itemName.
		 */		
		public function getItemName() {
			return $this->itemName;
		}
		/**
		 * Sets menu Name.
		 * @param String $itemName
		 */
		public function setItemName($itemName) {
			$this->itemName = $itemName;
		}
		/**
		 * Returns description.
		 */		
		public function getDescription() {
			return $this->description;
		}
		/**
		 * Sets menu description.
		 * @param String $description
		 */		
		public function setDescription($description) {
			$this->description = $description;
		}	
		/**
		 * Returns price.
		 */		
		public function getPrice() {
			return $this->price;
		}
		/**
		 * Sets menu price.
		 * @param String $price
		 */		
		public function setPrice($price) {
			$this->price = $price;
		}		
	}
	
?>