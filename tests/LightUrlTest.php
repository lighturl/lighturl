<?php
use PHPUnit\Framework\TestCase;

use LightUrl\LightUrl;

class LightUrlTest extends TestCase
{
    public function testCheckUrlFormat(){

        $mock = Mockery::mock('Illuminate\Database\ConnectionInterface');
        $LightUrl = new LightUrl($mock);

        $heavyUrl = "www.google.com";
        $this->assertFalse($this->invokeMethod($LightUrl,'checkUrlFormat',[$heavyUrl]));

        $heavyUrl = "google.com";
        $this->assertFalse($this->invokeMethod($LightUrl,'checkUrlFormat',[$heavyUrl]));

        $heavyUrl = "http://google.com";
        $this->assertEquals($heavyUrl,$this->invokeMethod($LightUrl,'checkUrlFormat',[$heavyUrl]));
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
?>