<?php

class TestCommand extends CConsoleCommand {

    public function run($args) {
        $a = $b = microtime(true);
        $n=0;
        while($b - $a < 5){
            $n++;
            $b = microtime(true);
        }
        echo $n;
    }
}