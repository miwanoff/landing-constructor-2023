<?php
abstract class Block
{
    protected $on;
    protected $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
    abstract public function draw();
}