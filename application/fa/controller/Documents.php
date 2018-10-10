<?php
namespace app\fa\controller;

class Documents extends Common
{
    public function index(){
        return $this->fetch();
    }
}