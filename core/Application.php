<?php

namespace app\bello;
/** 
 * Class Application
 * 
*/

class Application{
    
    public Router $router;
    public function ___construct(){
        $this->router = new Router();
    }


}
