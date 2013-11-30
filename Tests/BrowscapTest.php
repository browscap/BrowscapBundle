<?php
namespace Browscap\BrowscapBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Filesystem\Filesystem;

class BrowscapTest extends WebTestCase
{
    protected static function createKernel(array $options = array())
    {
        $env = @$options['env'] ?: 'test';

        return new AppKernel($env, true);
    }

    protected function setUp()
    {
        $fs = new Filesystem();
        $fs->remove(sys_get_temp_dir().'/BrowscapBundle/');
    }

    protected function tearDown()
    {
        static::$kernel = null;
    }

    public function testService() {

        $client = static::createClient();

        $bc = $client->getContainer()->get('browscap');
        
        $this->assertInstanceOf('Browscap\BrowscapBundle\Browscap', $bc);
    }

    /**
     * @dataProvider getBrowsers
     */
    public function testBrowsers($browser, array $expected) {

        $client = static::createClient();

        $bc = $client->getContainer()->get('browscap');
        $result = $bc->getBrowser($browser, true);

        foreach ($expected as $key => $value) {

            $this->assertEquals($value, $result[$key]);
        }
    }

    /**
     * Data Provider for testBrowsers
     */
    public function getBrowsers() {

        return array(
            array(
                'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:25.0) Gecko/20100101 Firefox/24.0',
                array(
                    'Parent' => 'Firefox 24.0',
                    'Platform' => 'Linux',
                    'CssVersion' => 3,
                ),
            ),
            array(
                'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)',
                array(
                    'Parent' => 'IE 10.0',
                    'Platform' => 'Win7',
                    'CssVersion' => 3,
                ),
            ),
            array(
                'Mozilla/5.0 (Linux; U; Android 4.0.3; ko-kr; LG-L160L Build/IML74K) AppleWebkit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
                array(
                    'Parent' => 'Android Browser 4.0',
                    'Platform' => 'Android',
                    'CssVersion' => 3,
                    'isMobileDevice' => true,
                ),
            ),
        );
    }
}
