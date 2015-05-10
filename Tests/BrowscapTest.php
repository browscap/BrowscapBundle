<?php
namespace Browscap\BrowscapBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Filesystem\Filesystem;

class BrowscapTest extends WebTestCase
{
    /**
     * @var \phpbrowscap\Browscap
     */
    private static $browscap;

    protected static function createKernel(array $options = array())
    {
        $env = @$options['env'] ?: 'test';

        return new AppKernel($env, true);
    }

    /**
     * This method is called before the first test of this test class is run.
     *
     * @since Method available since Release 3.4.0
     */
    public static function setUpBeforeClass()
    {
        $fs = new Filesystem();
        $fs->remove(sys_get_temp_dir().'/BrowscapBundle/');

        $client = static::createClient();

        /* @var $bc \Browscap\BrowscapBundle\Browscap */
        $bc = $client->getContainer()->get('browscap');
        $bc->updateCache();

        // Now, load an INI file into phpbrowscap\Browscap for testing the UAs
        self::$browscap = $bc;
    }

    public function testService()
    {
        self::assertInstanceOf('Browscap\BrowscapBundle\Browscap', self::$browscap);
    }

    /**
     * @dataProvider getBrowsers
     *
     * @param string $userAgent
     * @param array  $expectedProperties
     */
    public function testBrowsers($userAgent, array $expectedProperties)
    {
        if (!is_array($expectedProperties) || !count($expectedProperties)) {
            $this->markTestSkipped('Could not run test - no properties were defined to test');
        }

        $actualProps = (array) self::$browscap->getBrowser($userAgent);

        foreach ($expectedProperties as $propName => $propValue) {
            self::assertArrayHasKey(
                $propName,
                $actualProps,
                'Actual properties did not have "' . $propName . '" property'
            );

            self::assertSame(
                $propValue,
                $actualProps[$propName],
                'Expected actual "' . $propName . '" to be "' . $propValue . '" (was "' . $actualProps[$propName]
                . '"; used pattern: ' . $actualProps['browser_name_pattern'] .')'
            );
        }
    }

    /**
     * Data Provider for testBrowsers
     */
    public function getBrowsers()
    {
        return array(
            array(
                'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:25.0) Gecko/20100101 Firefox/24.0',
                array(
                    'Parent' => 'Firefox 24.0',
                    'Platform' => 'Ubuntu',
                    'isMobileDevice' => false,
                ),
            ),
            array(
                'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)',
                array(
                    'Parent' => 'IE 10.0',
                    'Platform' => 'Win7',
                    'isMobileDevice' => false,
                ),
            ),
            array(
                'Mozilla/5.0 (Linux; U; Android 4.0.3; ko-kr; LG-L160L Build/IML74K) AppleWebkit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
                array(
                    'Parent' => 'Android Browser 4.0',
                    'Platform' => 'Android',
                    'isMobileDevice' => true,
                ),
            ),
        );
    }
}
