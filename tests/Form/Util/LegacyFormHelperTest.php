<?php

namespace EasyCorp\Bundle\EasyAdminBundle\Tests\Form\Util\Type;

use EasyCorp\Bundle\EasyAdminBundle\Form\Util\LegacyFormHelper;
use PHPUnit\Framework\TestCase;

/**
 * @group legacy
 */
class LegacyFormHelperTest extends TestCase
{
    public function shortTypesToFqcnProvider()
    {
        return array(
            'Symfony Type (regular name)' => array('integer', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\IntegerType'),
            'Symfony Type (irregular name)' => array('datetime', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\DateTimeType'),
            'Doctrine Bridge Type' => array('entity', 'Symfony\\Bridge\\Doctrine\\Form\\Type\\EntityType'),
            'Custom Type (short name)' => array('foo', 'foo'),
            'Custom Type (FQCN)' => array('Foo\Bar', 'Foo\Bar'),
        );
    }

    /**
     * @dataProvider shortTypesToFqcnProvider
     */
    public function testGetType($shortType, $expected)
    {
        if (LegacyFormHelper::useLegacyFormComponent()) {
            $expected = $shortType;
        }

        $this->assertSame($expected, LegacyFormHelper::getType($shortType));
    }
}
