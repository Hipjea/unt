<?php
/**
 * Created by PhpStorm.
 * User: cbonfre
 * Date: 28/03/2019
 * Time: 11:09
 */

namespace Unt\Models;


class ResultatRechercheModel
{
    /** @var int */
    private $count;

    /** @var NoticeModel[] */
    private $notices;

    /** @var int */
    private $page;

    /**
     * ResultatRechercheModel constructor.
     */
    public function __construct($resultsList, $page)
    {
        self::setCount($resultsList->{'numFound'});
        self::setPage($page);

        $i = 0;
        foreach ($resultsList->{'docs'} as $solrNotice) {
            $notice = new NoticeModel($solrNotice);
            $this->notices[$i] = $notice;
            $i++;
        }
    }


    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    /**
     * @return NoticeModel[]
     */
    public function getNotices(): ?array
    {
        return $this->notices;
    }

    /**
     * @param NoticeModel[] $notices
     */
    public function setNotices(array $notices): void
    {
        $this->notices = $notices;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

}