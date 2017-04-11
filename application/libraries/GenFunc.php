<?php
/**
NOTE
This is an universal function which contains frequently used function
**/
class GenFunc {
	protected $_ci;

	function __construct(){
        $this->_ci = &get_instance();
    }

	function test() {
		return 'testing sukses lo';
	}
}