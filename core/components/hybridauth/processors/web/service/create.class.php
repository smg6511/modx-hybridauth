<?php

class haUserServiceCreateProcessor extends modObjectCreateProcessor
{
    public $classKey = 'haUserService';
    public $languageTopics = array('core:default', 'core:user');
    public $permission = '';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $properties = $this->getProperties();

        foreach ($properties as $k => $v) {
            $k = strtolower($k);
            if(is_array($v)){
                $tmp = array();
                foreach ($v as $key => $val) {
                    $tmp[$key] = $this->modx->stripTags($val);
                }
                $properties[$k] = $tmp;
            } else {
                $properties[$k] = $this->modx->stripTags($v);
            }
        }
        $properties['createdon'] = date('Y-m-d H:i:m');

        if (empty($properties['internalKey'])) {
            $this->addFieldError('internalKey', $this->modx->lexicon('field_required'));
        }
        if (empty($properties['provider'])) {
            $this->addFieldError('provider', $this->modx->lexicon('field_required'));
        }

        $this->setProperties($properties);

        return !$this->hasErrors();
    }
}

return 'haUserServiceCreateProcessor';
