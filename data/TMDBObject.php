<?php
/**
 * 	This class handles the basic methods for all the child classes
 *
 * 	@author Olivier Nolbert | <a href="http://www.octopoos.com">Octopoos</a>
 * 	@version 0.1
 * 	@date 01/06/2015
 * 	@link https://github.com/olivier-at-octopoos/TMDB-PHP-API
 * 	@copyright Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 */
 
class TMBDObject {

    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    protected $_data;
	protected $_tmdb;

    /**
     * 	Construct Class
     *
     * 	@param array $data An array with the data of the Object
     */
    public function __construct( $data ) {
        $this->_data	=	$data;
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /** 
     *  Get the Object's name
     *
     *  @return string
     */
    public function getName() {
        return $this->_data['name'];
    }

    /** 
     *  Get the Object's id
     *
     *  @return int
     */
    public function getID() {
        return $this->_data['id'];
    }

    /**
     *  Get Generic.<br>
     *  Get a item of the array, you should not get used to use this, better use specific get's.
     *
     *  @param string $item The item of the $data array you want
     *  @return array
     */
    public function get( $item = '' ) {
        return ( empty( $item ) ) ? $this->_data : $this->_data[$item];
    }

    //------------------------------------------------------------------------------
    // Export
    //------------------------------------------------------------------------------

    /**
     *  Get the JSON representation of the Object
     *
     *  @return string
     */
    public function getJSON() {
        return json_encode( $this->_data, JSON_PRETTY_PRINT );
    }
	
	//------------------------------------------------------------------------------
	// Import an API instance
	//------------------------------------------------------------------------------

	/**
	 *	Set an instance of the API
	 *
	 *	@param TMDB $tmdb An instance of the api, necessary for the lazy load
	 */
	public function setAPI( $tmdb ){
		$this->_tmdb	=	$tmdb;
	}
}
?>