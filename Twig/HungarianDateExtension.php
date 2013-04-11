<?php

namespace SPE\HungarianDateExtensionBundle\Twig;

class HungarianDateExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            'hungarian_date' => new \Twig_Filter_Method(
                $this, 'toHungarianDate'
            ),
            'hungarian_date_tag' => new \Twig_Filter_Method(
                $this, 'toHungarianDateWithHtml', array('is_safe' => array('html'))
            ),
            'hungarian_datetime' => new \Twig_Filter_Method(
                $this, 'toHungarianDateTime'
            ),
            'hungarian_datetime_tag' => new \Twig_Filter_Method(
                $this, 'toHungarianDateTimeWithHtml', array('is_safe' => array('html'))
            ),
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'spe_hungarian_date_extension';
    }

    /**
     * @param DateTime $date
     * @return string
     */
    public function toHungarianDate(\DateTime $date)
    {
        // 2012. December  2.
        $format = '%G. %B %e.';

        return $this->formatHungarianDate($date, $format);
    }

    /**
     * @param DateTime $date
     * @return string
     */
    public function toHungarianDateWithHtml(\DateTime $date)
    {
        return '<time title="' . $this->toHungarianDateTime($date) . '">' .
            $this->toHungarianDate($date) .
            '</time>';
    }

    /**
     * @param DateTime $date
     * @return string
     */
    public function toHungarianDateTime(\DateTime $date)
    {
        // 2012. December  2. Vasárnap 15:16
        $format = '%G. %B %e. %A %k:%M';

        return $this->formatHungarianDate($date, $format);
    }

    /**
     * @param DateTime $date
     * @return string
     */
    public function toHungarianDateTimeWithHtml(\DateTime $date)
    {
        $formatedDate = $this->toHungarianDateTime($date);

        return '<time title="' . $formatedDate . '">' . $formatedDate . '</time>';
    }


    /**
     * @param DateTime $date
     * @param string $format
     * @return string
     */
    private function formatHungarianDate(\DateTime $date, $format)
    {
        $formatedDate = $this->formatDate($date, $format, 'hu_HU');

        // a magyar honapneveket kisbetuvel kell irni
        $formatedDate = $this->toLower($formatedDate);

        return $this->removeExtraSpace($formatedDate);
    }

    /**
     * @param DateTime $date
     * @param string $format
     * @param string $locale = 'hu_HU'
     * @return string
     */
    private function formatDate(\DateTime $date, $format, $locale = 'hu_HU')
    {
        $prevLocale = setlocale(LC_TIME, 0);

        setlocale(LC_TIME, $locale);
        $formatedDate = strftime($format, $date->getTimestamp());
        setlocale(LC_TIME, $prevLocale);

        return $formatedDate;
    }

    /**
     * @param string $str
     * @return string
     */
    private function removeExtraSpace($str)
    {
        return preg_replace('/[ ]{2,}/', ' ', $str);
    }

    /**
     * @param string $str
     * @return string
     */
    private function toLower($str)
    {
        return mb_strtolower($str, 'UTF-8');
    }
}
