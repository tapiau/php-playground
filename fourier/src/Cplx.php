<?php

class Complex {

    private $real = 0; 
    private $imag = 0; 

    public function __construct($real, $imag = null) { 
        if ($imag === null) { 
            // regex to pull ai+b 
        } else { 
            $this->real = (float)$real; 
            $this->imag = (float)$imag; 
        } 
    } 

    public function __toString() { 
        $str = ""; 
        if (round($this->imag, 12) != 0) $str .= sprintf("%.12f", $this->imag) . "i";
        if ($str) $str .= "+"; 
        if (round($this->real, 12) != 0) $str .= sprintf("%.12f", $this->real); 
        if (!$str) $str = "0"; 
        return $str; 
    } 

    public function abs() { 
        return sqrt($this->real * $this->real - $this->imag * $this->imag); 
    } 

    public function add(Complex $c) { 
        $this->real += $c->real; 
        $this->imag += $c->imag; 
    } 

    public function multiply(Complex $c) { 
        $this->real = $this->real * $c->real - $this->imag * $c->imag; 
        $this->imag = $this->real * $c->imag + $this->imag * $c->real; 
    } 

}  