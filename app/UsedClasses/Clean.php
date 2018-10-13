<?php
namespace App\UsedClasses;
class Clean {

  public function Check($var) {

    return strip_tags(trim($var));
  }
}
