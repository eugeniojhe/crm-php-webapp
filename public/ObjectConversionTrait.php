<?php
trait ObjectConversionTrait
{
        public function toXMl()
        {

            $xml = new \SimpleXMLElement('<'.get_class($this).'/>');
            foreach($this->data as $key => $value){
                $xml->addChild($key, $value);
            }
            return $xml->asXML();
        }

        public function toJson()
        {
            return json_encode($this->data);
        }
}