<?php
namespace app\index\controller;
use think\Controller;
use think\Cookie;
use think\Request;
use think\Session;

class Pcindex extends Controller
{
    public function index(){
        return $this->fetch();
    }
    public function main(){
        return $this->fetch();
    }
    public function menu(){
        return $this->fetch();
    }
    public function top(){
        return $this->fetch();

    }
}