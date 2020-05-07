<?php

require_once "config/router.php";
route('/',function (){
  return "ilex Framework";
});
route('about',function (){
  return "All about ilex Framework";
});
