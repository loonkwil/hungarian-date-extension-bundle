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

    protected function checkToHungarianDate($out, $date)
    {
        $this->assertEquals($out, $this->hde->toHungarianDate($date));
    }

    protected function checkToHungarianDateWithHtml($out, $date)
    {
        $this->assertEquals($out, $this->hde->toHungarianDateWithHtml($date));
    }

    protected function checkToHungarianDateTime($out, $date)
    {
        $this->assertEquals($out, $this->hde->toHungarianDateTime($date));
    }

    protected function checkToHungarianDateTimeWithHtml($out, $date)
    {
        $this->assertEquals($out, $this->hde->toHungarianDateTimeWithHtml($date));
    }


    public function testToHungarianDate()
    {
        // Ekezetes karakterek kezelese
        $this->checkToHungarianDate(
            '2012. január 12.', new \DateTime('2012-01-12')
        );

        // Felesleges szokozok ellenorzese
        $this->checkToHungarianDate(
            '2012. december 2.', new \DateTime('2012-12-02')
        );

        // unix timestamp elfogadasa
        $this->checkToHungarianDate(
            '2012. december 2.', new \DateTime('2012-12-02')
        );

        $this->checkToHungarianDate(
            '2012. december 2.', (string)strtotime('2012-12-02')
        );

        // string-ben megadott datum elfogadasa
        $this->checkToHungarianDate(
            '2012. december 2.', '2012-12-02'
        );
    }

    public function testToHungarianDateWithHtml()
    {
        // Ekezetes karakterek kezelese
        $this->checkToHungarianDateWithHtml(
            '<time title="2012. január 12. csütörtök 15:16">' .
                '2012. január 12.' .
            '</time>',
            new \DateTime('2012-01-12 15:16')
        );

        // Felesleges szokozok ellenorzese
        $this->checkToHungarianDateWithHtml(
            '<time title="2012. december 2. vasárnap 15:16">' .
                '2012. december 2.' .
            '</time>',
            new \DateTime('2012-12-02 15:16')
        );

        // unix timestamp elfogadasa
        $this->checkToHungarianDateWithHtml(
            '<time title="2012. december 2. vasárnap 15:16">' .
                '2012. december 2.' .
            '</time>',
            strtotime('2012-12-02 15:16')
        );

        $this->checkToHungarianDateWithHtml(
            '<time title="2012. december 2. vasárnap 15:16">' .
                '2012. december 2.' .
            '</time>',
            (string)strtotime('2012-12-02 15:16')
        );

        // string-ben megadott datum elfogadasa
        $this->checkToHungarianDateWithHtml(
            '<time title="2012. december 2. vasárnap 15:16">' .
                '2012. december 2.' .
            '</time>',
            '2012-12-02 15:16'
        );
    }

    public function testToHungarianDateTime()
    {
        // Ekezetes karakterek kezelese
        $this->checkToHungarianDateTime(
            '2012. augusztus 13. hétfő 15:16', new \DateTime('2012-08-13 15:16')
        );

        // Felesleges szokozok ellenorzese
        $this->checkToHungarianDateTime(
            '2012. augusztus 8. szerda 6:05', new \DateTime('2012-08-08 06:05')
        );

        // unix timestamp elfogadasa
        $this->checkToHungarianDateTime(
            '2012. december 2. vasárnap 15:16', strtotime('2012-12-02 15:16')
        );

        $this->checkToHungarianDateTime(
            '2012. december 2. vasárnap 15:16',
            (string)strtotime('2012-12-02 15:16')
        );

        // string-ben megadott datum elfogadasa
        $this->checkToHungarianDateTime(
            '2012. december 2. vasárnap 15:16', '2012-12-02 15:16'
        );
    }

    public function testToHungarianDateTimeWithHtml()
    {
        // Ekezetes karakterek kezelese
        $this->checkToHungarianDateTimeWithHtml(
            '<time title="2012. augusztus 13. hétfő 15:16">' .
                '2012. augusztus 13. hétfő 15:16' .
            '</time>',
            new \DateTime('2012-08-13 15:16')
        );

        // Felesleges szokozok ellenorzese
        $this->checkToHungarianDateTimeWithHtml(
            '<time title="2012. augusztus 8. szerda 6:05">' .
                '2012. augusztus 8. szerda 6:05' .
            '</time>',
            new \DateTime('2012-08-08 06:05')
        );

        // unix timestamp elfogadasa
        $this->checkToHungarianDateTimeWithHtml(
            '<time title="2012. december 2. vasárnap 15:16">' .
                '2012. december 2. vasárnap 15:16' .
            '</time>',
            strtotime('2012-12-02 15:16')
        );

        $this->checkToHungarianDateTimeWithHtml(
            '<time title="2012. december 2. vasárnap 15:16">' .
                '2012. december 2. vasárnap 15:16' .
            '</time>',
            (string)strtotime('2012-12-02 15:16')
        );

        // string-ben megadott datum elfogadasa
        $this->checkToHungarianDateTimeWithHtml(
            '<time title="2012. december 2. vasárnap 15:16">' .
                '2012. december 2. vasárnap 15:16' .
            '</time>',
            '2012-12-02 15:16'
        );
    }
}
