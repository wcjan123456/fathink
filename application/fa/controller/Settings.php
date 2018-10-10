<?php
namespace app\fa\controller;

class Settings extends Common
{
    public function index(){
        return $this->fetch();
    }
}