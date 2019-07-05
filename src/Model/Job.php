<?php

namespace App\Model;

class Job
{
    private $title;
    private $location;
    private $date;
    private $content;
    private $applyLink;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getApplyLink()
    {
        return $this->applyLink;
    }

    public function setApplyLink($applyLink)
    {
        $this->applyLink = $applyLink;
    }
}