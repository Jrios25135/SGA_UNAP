<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dublincore
 *
 * @author JHON CHARLIE
 */
class dublincoreController extends Controller {
    //put your code here
    private $_dublincore;
    
    public function __construct($lang,$url) 
    {
        parent::__construct($lang,$url);       
    }
    
    public function index()
    {
       $this->validarUrlIdioma();
    }
}
