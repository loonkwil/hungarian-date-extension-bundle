<?php

namespace SPE\HungarianDateExtensionBundle\Test\Twig;

use SPE\HungarianDateExtensionBundle\Twig\HungarianDateExtension;

class HungarianDateExtensionTest extends \PHPUnit_Framework_TestCase
{
    protected $hde;

    protected function setUp()
    {
        $this->hde = new HungarianDateExtension();
    }

    public function testToHungarianDate()
    {
        // Ekezetes karakterek kezelese
        $this->assertEquals(
            '2012. január 12.',
            $this->hde->toHungarianDate(new \DateTime('2012-01-12'))
        );

        // Felesleges szokozok ellenorzese
        $this->assertEquals(
            '2012. december 2.',
            $this->hde->toHungarianDate(new \DateTime('2012-12-02'))
        );
    }

    public function testToHungarianDateWithHtml()
    {
        // Ekezetes karakterek kezelese
        $this->assertEquals(
            '<time title="2012. január 12. csütörtök 15:16">2012. január 12.</time>',
            $this->hde->toHungarianDateWithHtml(new \DateTime('2012-01-12 15:16'))
        );

        // Felesleges szokozok ellenorzese
        $this->assertEquals(
            '<time title="2012. december 2. vasárnap 15:16">2012. december 2.</time>',
            $this->hde->toHungarianDateWithHtml(new \DateTime('2012-12-02 15:16'))
        );
    }

    public function testToHungarianDateTime()
    {
        // Ekezetes karakterek kezelese
        $this->assertEquals(
            '2012. augusztus 13. hétfő 15:16',
            $this->hde->toHungarianDateTime(new \DateTime('2012-08-13 15:16'))
        );

        // Felesleges szokozok ellenorzese
        $this->assertEquals(
            '2012. augusztus 8. szerda 6:05',
            $this->hde->toHungarianDateTime(new \DateTime('2012-08-08 06:05'))
        );
    }

    public function testToHungarianDateTimeWithHtml()
    {
        // Ekezetes karakterek kezelese
        $this->assertEquals(
            '<time title="2012. augusztus 13. hétfő 15:16">2012. augusztus 13. hétfő 15:16</time>',
            $this->hde->toHungarianDateTimeWithHtml(new \DateTime('2012-08-13 15:16'))
        );

        // Felesleges szokozok ellenorzese
        $this->assertEquals(
            '<time title="2012. augusztus 8. szerda 6:05">2012. augusztus 8. szerda 6:05</time>',
            $this->hde->toHungarianDateTimeWithHtml(new \DateTime('2012-08-08 06:05'))
        );
    }
}
