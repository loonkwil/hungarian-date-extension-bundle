<?php

namespace SPE\HungarianDateExtensionBundle\Twig;

class HungarianDateExtension extends \Twig_Extension
{
    /**
     * @var array $months
     */
    private static $months = array(
        'január', 'február', 'március', 'április', 'május', 'június', 'július',
        'augusztus', 'szeptember', 'október', 'november', 'december',
    );

    /**
     * @var array $days
     */
    private static $days = array(
        'vasárnap', 'hétfő', 'kedd', 'szerda', 'csütörtök', 'péntek', 'szombat',
    );

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
     * @param string|integer|DateTime $date
     * @return string
     */
    public function toHungarianDate($date)
    {
        $date = $this->toDateTime($date);

        $year = $date->format('Y');
        $month = self::$months[ $date->format('n') - 1 ];
        $day = $date->format('j');

        // 2012. december  2.
        return $year . '. ' . $month . ' ' . $day . '.';
    }

    /**
     * @param string|integer|DateTime $date
     * @return string
     */
    public function toHungarianDateWithHtml($date)
    {
        $date = $this->toDateTime($date);

        return '<time title="' . $this->toHungarianDateTime($date) . '">' .
            $this->toHungarianDate($date) .
            '</time>';
    }

    /**
     * @param string|integer|DateTime $date
     * @return string
     */
    public function toHungarianDateTime($date)
    {
        $date = $this->toDateTime($date);

        $dayInText = self::$days[ $date->format('w') ];
        $time = $date->format('G:i');

        // 2012. december  2. vasárnap 15:16
        return $this->toHungarianDate($date) . ' ' . $dayInText . ' ' . $time;
    }

    /**
     * @param string|integer|DateTime $date
     * @return string
     */
    public function toHungarianDateTimeWithHtml($date)
    {
        $date = $this->toDateTime($date);

        $formatedDate = $this->toHungarianDateTime($date);

        return '<time title="' . $formatedDate . '">' . $formatedDate . '</time>';
    }


    /**
     * @param string|integer|DateTime $date
     * @return DateTime
     */
    protected function toDateTime($date)
    {
        if( $date instanceof \DateTime ) {
            return $date;
        }

        if( is_numeric($date) ) {
            $now = new \DateTime();
            return $now->setTimestamp($date);
        }

        return new \DateTime($date);
    }
}
