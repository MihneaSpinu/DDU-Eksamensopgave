<?php

class Comment
{
    public static function create($fields = array())
    {
        if (!Database::getInstance()->insert('comments', $fields)) {
            throw new Exception("Unable to create the comment.");
        }
    }

    public static function getAllComments($post_id)
    {
        $comments = Database::getInstance()->get('comments', array('post_id', '=', $post_id));
        //return list of comments
        return $comments;
    }
}
