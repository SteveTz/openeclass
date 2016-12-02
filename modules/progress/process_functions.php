<?php

/* ========================================================================
 * Open eClass 
 * E-learning and Course Management System
 * ========================================================================
 * Copyright 2003-2014  Greek Universities Network - GUnet
 * A full copyright notice can be read in "/info/copyright.txt".
 * For a full list of contributors, see "credits.txt".
 *
 * Open eClass is an open platform distributed in the hope that it will
 * be useful (without any warranty), under the terms of the GNU (General
 * Public License) as published by the Free Software Foundation.
 * The full license can be read in "/info/license/license_gpl.txt".
 *
 * Contact address: GUnet Asynchronous eLearning Group,
 *                  Network Operations Center, University of Athens,
 *                  Panepistimiopolis Ilissia, 15784, Athens, Greece
 *                  e-mail: info@openeclass.org
 * ======================================================================== 
 */


/**
 * @brief add assignment db entries in certificate criterion 
 * @param type $certificate_id
 * @return type
 */
function add_assignment_to_certificate($certificate_id) {
            
    if (isset($_POST['assignment'])) {        
        foreach ($_POST['assignment'] as $datakey => $data) {
            Database::get()->query("INSERT INTO certificate_criterion
                                    SET certificate = ?d, 
                                        module= " . MODULE_ID_ASSIGN . ", 
                                        resource = ?d, 
                                        activity_type = 'assignment', 
                                        operator = ?s, 
                                        threshold = ?f",
                                    $certificate_id, 
                                    $_POST['assignment'][$datakey], 
                                    $_POST['operator'][$datakey], 
                                    $_POST['threshold'][$datakey]);
        }
    }
    return;    
}


/**
 * @brief add exercise db entries in certificate criterion 
 * @param type $certificate_id
 * @return type
 */
function add_exercise_to_certificate($certificate_id) {
    
    if (isset($_POST['exercise'])) {
        foreach ($_POST['exercise'] as $datakey => $data) {    
            Database::get()->query("INSERT INTO certificate_criterion
                                    SET certificate = ?d, 
                                        module = " . MODULE_ID_EXERCISE . ", 
                                        resource = ?d, 
                                        activity_type = 'exercise', 
                                        operator = ?s, 
                                        threshold = ?f",
                                    $certificate_id, 
                                    $_POST['exercise'][$datakey],
                                    $_POST['operator'][$datakey],
                                    $_POST['threshold'][$datakey]);
        }
    }
    return;
}


/**
 * @brief add document db entries in certificate criterion
 * @param type $certificate_id
 * @return type
 */
function add_document_to_certificate($certificate_id) {
    
    if (isset($_POST['document'])) {
        foreach ($_POST['document'] as $data) {           
           Database::get()->query("INSERT INTO certificate_criterion
                            SET certificate = ?d, 
                                module= " . MODULE_ID_DOCS . ",
                                resource = ?d, 
                                activity_type = 'document'",
                        $certificate_id, $data);              
            }
        }
    return;
}


/**
 * @brief add multimedia db entries in certificate criterion
 * @param type $certificate_id
 */
function add_multimedia_to_certificate($certificate_id) {
                
    if (isset($_POST['video'])) {
        $d = array();
        foreach ($_POST['video'] as $data) {
            $d = explode(":", $data);
            Database::get()->query("INSERT INTO certificate_criterion
                                SET certificate = ?d, module= " . MODULE_ID_VIDEO . ", resource = ?d, activity_type = ?s",
                            $certificate_id, $d[1], $d[0])->lastInsertID;
        }
    }
    if (isset($_POST['videocatlink'])) {
        $d = array();
        foreach ($_POST['videocatlink'] as $data) {
            $d = explode(":", $data);
            Database::get()->query("INSERT INTO certificate_criterion
                                SET certificate = ?d, module = " . MODULE_ID_VIDEO . ", resource = ?d, activity_type = ?s",
                            $certificate_id, $d[1], $d[0])->lastInsertID;
        }
    }
    return;
}


/**
 * @brief add lp db entries in certificate_criterion
 * @param type $certificate_id
 */
function add_lp_to_certificate($certificate_id) {
    
    if (isset($_POST['lp'])) {
        foreach ($_POST['lp'] as $datakey => $data) {
            Database::get()->query("INSERT INTO certificate_criterion
                                SET certificate = ?d, 
                                module = " . MODULE_ID_LP . ", 
                                resource = ?d,
                                activity_type = 'learning path',
                                operator = ?s, 
                                threshold = ?f",
                            $certificate_id, 
                            $_POST['lp'][$datakey],
                            $_POST['operator'][$datakey],
                            $_POST['threshold'][$datakey]);
        }
    }
    return;
}

/**
 * @brief add wiki db entries in certificate criterion
 * @param type $certificate_id
 * @return type
 */
function add_wiki_to_certificate($certificate_id) {
              
    if (isset($_POST['wiki'])) {
        foreach ($_POST['wiki'] as $datakey => $data) {
            Database::get()->query("INSERT INTO certificate_criterion
                                SET certificate = ?d, 
                                module = " . MODULE_ID_WIKI . ", 
                                resource = ?d, 
                                activity_type = 'wiki',
                                operator = ?s,
                                threshold = ?f",
                            $certificate_id, 
                            $_POST['wiki'][$datakey],
                            $_POST['operator'][$datakey],
                            $_POST['threshold'][$datakey]);
        }
    }
    return;
}

/**
 * @brief add poll db entries in certificate criterion
 * @param type $certificate_id
 * @return type
 */
function add_poll_to_certificate($certificate_id) {
    
    if (isset($_POST['poll'])) {
        foreach ($_POST['poll'] as $data) {      
          Database::get()->query("INSERT INTO certificate_criterion
                                    SET certificate = ?d, 
                                    module= " . MODULE_ID_QUESTIONNAIRE . ", 
                                    resource = ?d, 
                                    activity_type = 'questionnaire'",
                            $certificate_id,
                            $data);
        }
    }
    return;
}


/**
 * @brief add ebook db entries in certificate criterion
 * @param type $certificate_id
 * @return type
 */
function add_ebook_to_certificate($certificate_id) {
     if (isset($_POST['ebook'])) {
        foreach ($_POST['ebook'] as $data) {      
          Database::get()->query("INSERT INTO certificate_criterion
                                    SET certificate = ?d, 
                                    module= " . MODULE_ID_EBOOK . ", 
                                    resource = ?d, 
                                    activity_type = 'ebook'",
                            $certificate_id,
                            $data);
        }
    }
    return;
}


function add_forum_to_certificate($certificate_id) {
    echo ".. still working...";
}



/**
 * @brief get certificate title
 * @param type $certificate_id
 * @return type
 */
function get_certificate_title($certificate_id) {

    $cert_title = Database::get()->querySingle("SELECT title FROM certificate WHERE id = ?d", $certificate_id)->title;

    return $cert_title;
}


/**
 * @brief add certificate in DB
 * @global type $course_id
 * @param type $title
 * @param type $description
 * @param type $message
 * @param type $template
 * @param type $issuer
 * @param type $active
 * @return type
 */
function add_certificate($title, $description, $message, $template, $issuer, $active) {
    
    global $course_id;
    
    $new_cert_id = Database::get()->query("INSERT INTO certificate 
                                SET course_id = ?d,
                                title = ?s,
                                description = ?s,
                                message = ?s,
                                template = ?d,
                                issuer = ?s,
                                active = ?d", $course_id, $title, $description, $message, $template, $issuer, $active)->lastInsertID;
    return $new_cert_id;
    
}

/**
 * @brief modify certificate settings in DB
 * @global type $course_id
 * @param type $certificate_id
 * @param type $title
 * @param type $description
 * @param type $message
 * @param type $template
 * @param type $issuer
 * @param type $active
 */
function modify_certificate($certificate_id, $title, $description, $message, $template, $issuer, $active) {    
    
    global $course_id;
    
    Database::get()->query("UPDATE certificate SET title = ?s, 
                                                   description = ?s,
                                                   message = ?s,
                                                   template = ?d,
                                                   issuer = ?s,
                                                   active = ?d
                                                WHERE id = ?d AND course_id = ?d",
                                    $title, $description, $message, $template, $issuer, $active, $certificate_id, $course_id);
    
}

/**
 * @brief modify certificate resource activity
 * @param type $activity_id
 */
function modify_certificate_activity($certificate_id, $activity_id) {

    Database::get()->query("UPDATE certificate_criterion 
                                SET threshold = ?f, 
                                    operator = ?s 
                                WHERE id = ?d 
                                AND certificate = ?d",
                            $_POST['cert_threshold'], $_POST['cert_operator'], $activity_id, $certificate_id);
}

/**
 * @brief modify certificate visibility in DB
 * @global type $course_id
 * @param type $certificate_id
 * @param type $visibility
 */
function modify_certificate_visility($certificate_id, $visibility) {
    
    global $course_id;
    
    Database::get()->query("UPDATE certificate SET active = ?d WHERE id = ?d AND course_id = ?d", $visibility, $certificate_id, $course_id);
    
}

/**
 * @brief delete certificate db entries
 * @global type $course_id
 * @param type $certificate_id
 */
function delete_certificate($certificate_id) {

    global $course_id;

    $r = Database::get()->queryArray("SELECT id FROM certificate_criterion WHERE certificate = ?d", $certificate_id);
    foreach ($r as $act) { // delete certificate activities
        delete_certificate_activity($certificate_id, $act->id);
    }    
    Database::get()->query("DELETE FROM certificate WHERE id = ?d AND course_id = ?d", $certificate_id, $course_id);
}


/**
 * @brief delete certificate activity
 * @param type $certificate_id
 * @param type $activity_id
 */
function delete_certificate_activity($certificate_id, $activity_id) {
    
    Database::get()->query("DELETE FROM certificate_criterion WHERE id = ?d AND certificate = ?d", $activity_id, $certificate_id);
    
}

/**
 * @brief checks if user has used a specified certificate
 * @param type $certificate_resource_id
 * @return boolean
 */
function certificate_resource_usage($certificate_resource_id) {
    
    $sql = Database::get()->querySingle("SELECT user FROM user_certificate_criterion WHERE certificate_criterion = ?d", $certificate_resource_id);
    if ($sql) {
        return true;
    } else {
        return false;
    }    
}


function get_resource_details($resource_id) {
    
    global $course_id, $langCategoryExcercise, $langCategoryEssay, $langLearningPath,
            $langDocument, $langVideo, $langsetvideo, $langEBook, $langMetaQuestionnaire, 
            $langBlogPosts, $langBlog, $langForums, $langComments, $langForums, $langWikiPages,
            $langWikis, $langAllActivities;
    
    $data = array('type' => '', 'title' => '');
    
    $res_data = Database::get()->querySingle("SELECT activity_type, module, resource FROM certificate_criterion WHERE id = ?d", $resource_id);
    $resource = $res_data->resource;
    $resource_type = $res_data->activity_type;
    
    switch ($resource_type) {
        case ExerciseEvent::ACTIVITY: 
                $title = Database::get()->querySingle("SELECT title FROM exercise WHERE exercise.course_id = ?d AND exercise.id = ?d", $course_id, $resource)->title;
                $type = "$langCategoryExcercise";                
                break;
        case AssignmentEvent::ACTIVITY:
                $title = Database::get()->querySingle("SELECT title FROM assignment WHERE assignment.course_id = ?d AND assignment.id = ?d", $course_id, $resource)->title;
                $type = "$langCategoryEssay";                
            break;
        case LearningPathEvent::ACTIVITY: 
                $title = Database::get()->querySingle("SELECT name FROM lp_learnPath WHERE lp_learnPath.course_id = ?d AND lp_learnPath.learnPath_id = ?d", $course_id, $resource)->name;
                $type = "$langLearningPath";
            break;
        case ViewingEvent::DOCUMENT_ACTIVITY: 
                $cer_res = Database::get()->queryArray("SELECT IF(title = '', filename, title) AS file_details FROM document 
                                    WHERE document.course_id = ?d AND document.id = ?d", $course_id, $resource);                
                foreach ($cer_res as $res_data) {
                    $title = $res_data->file_details;
                }
                $type = "$langDocument";
            break;
        case ViewingEvent::VIDEO_ACTIVITY:
                $title = Database::get()->querySingle("SELECT title FROM video WHERE video.course_id = ?d AND video.id = ?d", $course_id, $resource)->title;
                $type = "$langVideo";                
            break;
        case ViewingEvent::VIDEOLINK_ACTIVITY:
                $title = Database::get()->querySingle("SELECT title FROM videolink WHERE videolink.course_id = ?d AND videolink.id = ?d", $course_id, $resource)->title;                
                $type = "$langsetvideo";                
            break;
        case ViewingEvent::EBOOK_ACTIVITY:
                $title = Database::get()->querySingle("SELECT title FROM ebook WHERE ebook.course_id = ?d AND ebook.id = ?d", $course_id, $resource)->title;                
                $type = "$langEBook";
            break;
        case ViewingEvent::QUESTIONNAIRE_ACTIVITY: 
                $title = Database::get()->querySingle("SELECT name FROM poll WHERE poll.course_id = ?d AND poll.pid = ?d", $course_id, $resource)->name;                
                $type = "$langMetaQuestionnaire";
            break;
        case BlogEvent::ACTIVITY: 
                $type = "$langBlog";
                $title = "$langBlogPosts";
            break;
        case ForumEvent::ACTIVITY:
                $type = "$langForums";
                $title = "$langComments $langForums";
            break;
        case WikiEvent::ACTIVITY:
                $type = "$langWikiPages";
                $title = "$langWikis";
            break;
        default: 
                $title = "$langAllActivities";
            break;
    }
    
    array_push($data, $type, $title);
    
    return $data;
    
    
    /*if ($details->activity_type == CommentEvent::BLOG_ACTIVITY && $details->module == MODULE_ID_COMMENTS) {
        $type = "$langComments";
        $title = "$langCommentsBlog";
    }

    if ($details->activity_type == CommentEvent::COURSE_ACTIVITY && $details->module == MODULE_ID_COMMENTS) {
        $type = "$langComments";
        $title = "$langCommentsCourse";
    }

    

    if ($details->activity_type == RatingEvent::SOCIALBOOKMARK_ACTIVITY && $details->module == MODULE_ID_RATING) {
        $type = "$langPersoValue $langCourseSocialBookmarks";
        $title = "$langPersoValue";
    }

    if ($details->activity_type == RatingEvent::FORUM_ACTIVITY && $details->module == MODULE_ID_RATING) {
        $type = "$langForumRating";
        $title = "$langPersoValue";
    }
*/
    
}