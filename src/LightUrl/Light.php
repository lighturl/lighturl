<?php

namespace LightUrl;

use Illuminate\Database\ConnectionInterface;
use Hashids\Hashids;

class Light
{
    protected $connection;
    private $defaultConnection;

    public function __construct(ConnectionInterface $connection)
    {
       $this->defaultConnection=$connection;
    }

    public function lighten($heavyUrl, $format = 'json',array $options = [])
    {
        if(!$this->checkUrlFormat($heavyUrl))
            die("format error");

        if(count($this->checkDBExists($heavyUrl)))
        {
            return $this->checkDBExists($heavyUrl)->short_key;
        }

         $shortKey = $this->preShortKey($heavyUrl);

        return $this->storeLightUrl($heavyUrl,$shortKey)->short_key;
    }

    private function checkUrlFormat($heavyUrl) {
        return filter_var($heavyUrl, FILTER_VALIDATE_URL,
            FILTER_FLAG_HOST_REQUIRED);
    }

    private function checkDBExists($heavyUrl){
        return $this->defaultConnection->table('lu_url')->where('heavy_url',$heavyUrl)->first();
    }

    private function preShortKey($heavyUrl){

        $hashids = new Hashids($heavyUrl,4,"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890");
        $hash =  $hashids->encode(1058);
        return $hash;
    }

    private function storeLightUrl($heavyUrl,$shortKey){

        $status = $this->defaultConnection->table('lu_url')->insert(['heavy_url'=>$heavyUrl,'short_key'=>$shortKey,'user'=>1]);

        if($status){
            return $this->checkDBExists($heavyUrl);
        }else {
            die("insert error");
        }
    }

}