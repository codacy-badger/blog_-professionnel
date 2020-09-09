<?php

namespace blogProfessionnel\app\Models\Entity;

class Comment
{
    private $id;
    private $title;
    private $content;
    private $date;
    private $status;
    private $userId;
    private $blogPostId;

    public function __construct($id, $title, $content, $date, $status, $userId, $blogPostId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->date = $date;
        $this->status = $status;
        $this->userId = $userId;
        $this->blogPostId = $blogPostId;
    }


    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }


    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setstatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getBlogPostId()
    {
        return $this->blogPostId;
    }

    /**
     * @param mixed $blogPostId
     */
    public function setBlogPostId($blogPostId)
    {
        $this->blogPostId = $blogPostId;
    }
}
