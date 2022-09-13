<?php

class Manager {
  protected function dbConnect(){
    return new PDO('mysql:host=localhost;dbname=journal_project;charset=utf8', 'root', '');
  }
}