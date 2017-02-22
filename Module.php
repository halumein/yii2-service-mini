<?php

namespace halumein\servicemini;

class Module extends \yii\base\Module
{
    public $adminRoles = ['administrator','superadmin','Superadmin'];
    
    public function init()
    {
        parent::init();

    }
}
