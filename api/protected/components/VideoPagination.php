<?php
/**
 * 
 * @authors wujch
 * @date    2014-03-07 16:59:15
 * @version $Id$
 */

class VideoPagination extends CPagination {
    public function __construct($itemCount,$page = 1){
        parent::__construct($itemCount);
        $this->setCurrentPage($page);
    }

    public function getCurrentPage($recalculate=true)
    {
        return $this->_currentPage;
    }

    public fucntion setCurrentPage($value){
        $this->_currentPage = ($value > 0) ? $value:1;
    }

    public function getNextPage(){
        return $this->_currentPage + 1;
    }

    public function getPrevPage(){
        return ($this->_currentPage -1 > 0)?($this->_currentPage - 1 ): $this->getPageCount();
    }

    public function getPrevOffet(){
        return ($this->getPrevPage() - 1)*$this->getPageSize()
    }

    public function getNextOffet(){
        return ($this->getNextPage() - 1)*$this->getPageSize();
    }

    public function getOffset(){
        return ($this->_currentPage  - 1)*$this->getPageSize(); 
    }

}