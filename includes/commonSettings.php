<?php
/*****************************************************************************************************
** File Name	: commonSettings.php
** Objective	: Defines the seetings information used all over the application commonly
****************************************************************************************************/
//Year Array Starting from 1900 to Current Year
$startYear = ( (int) date('Y') - 100 );
$minimumAge = 13;
$yearArray = range($startYear, (date('Y') - $minimumAge) - ($startYear - 1));
$yearArray = array_reverse($yearArray, true);
//Month Array 
$monthArray = array('1' => 'Jan', '2' =>'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', 
	'8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');

$dayArray = range(1, 31);
//Gender Array
$genderArray = array('f' => 'Female', 'm' => 'Male');

//Category Types
$categoryArray = array('1' => 'Learn', '2' => 'Listen', '3' => 'Auditions');

//Url of current page
$url = (($_SERVER['HTTPS']) ? 'https://': 'http://'). $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

//Current File Name
$fileName = basename($_SERVER['PHP_SELF']);

define('BAND_GROUP_USER_LIST', 15);

define('BAND_GROUP_LIST', 8);

//Define Invitation status
define('INVITATION_PENDING', 0);
define('INVITATION_ACCEPTED', 1);
define('INVITATION_REJECTED', 2);

//Define different login status
define('STATUS_LOGGED_OUT', 0);
define('STATUS_LOGGED_IN', 1);
define('STATUS_LOGGED_IN_ANOTHER_SYSTEM', 2);
define('STATUS_LOGGED_TIME_OUT', 3);

//Different Category Types
define('LEARN_CATEGORY', 1);
define('LISTEN_CATEGORY', 2);
define('AUDITION_CATEGORY', 3);

//Define Default session login time in minutes
define('DFLT_LOGIN_TIME', 60);

//Check Online time difference in minutes
define('DFLT_ONLINE_TIME', 3);

//Date format without Year
define('DATE_WITH_YEAR', 'd M');

//Date Format
define('DATE_FORMAT', 'd M Y');

//Define Default group
define('DEFAULT_COUNTRY', 'US');

//Define DB Date only format
define('DB_DATE_ONLY', date('Y-m-d', time()));

//Define Database date & time
define('DB_DATE', date('Y-m-d H:i:s', time()));

//Define Smarty display date format
define('DISPLAY_FORMAT', '%d %b %Y');

//Define Smarty display date format
define('CALENDAR_DATE_FORMAT', '%m/%d/%Y');

//Define Smarty display date format
define('PROFILE_DATE_FORMAT', '%B/%d/%Y');


//Define Smarty display date format
define('MAIL_DATE_FORMAT', '%b %d %Y %I:%M %p');

//Define Notification email
define('NOTIFICATION_EMAIL', 'support@linkmusicians.com');

//Define Profile image width
define('PROFILE_IMAGE_WIDTH', 276);

//Define View Profile image width
define('VIEW_PROFILE_IMAGE_WIDTH', 215);

//Define Fellow Image width
define('FELLOW_IMAGE_WIDTH', 41);
//Define Fellow Image Height
define('FELLOW_IMAGE_HEIGHT', 46);

//Define Comment Image width & height
define('COMMENT_IMAGE_WIDTH', 55);
define('COMMENT_IMAGE_HEIGHT', 52);


//Define Recent Videos count
define('RECENT_VIDEO_COUNT', 3);
define('RECENT_UPLOAD_COUNT', 8);

//Define No. of Messages to be shown
define('RECENT_MESSAGE_COUNT', 2);

//Video width & height on video detail page
define('VIDEO_FULL_WIDTH', 573);
define('VIDEO_FULL_HEIGHT', 290);

//Video width & height on edit profile page
define('EDIT_VIDEO_WIDTH', 223);
define('EDIT_VIDEO_HEIGHT', 157);

//Video width & height on view profile page & Category listing page
define('VIEW_VIDEO_WIDTH', 316);
define('VIEW_VIDEO_HEIGHT', 246);
//define('VIEW_VIDEO_HEIGHT', 171);

//Home page Feature Video Width & Height
define('FEATURE_VIDEO_WIDTH', 161);
define('FEATURE_VIDEO_HEIGHT', 105);

//Search Video width & height
define('SEARCH_VIDEO_WIDTH', 330);
define('SEARCH_VIDEO_HEIGHT', 220);

//HOME page Video Width & Height
define('HOME_VIDEO_WIDTH', 491);
define('HOME_VIDEO_HEIGHT', 314);

//Photo single view Width & Height
define('PHOTO_SINGLE_WIDTH', 550);
define('PHOTO_SINGLE_HEIGHT', 350);

//Define No.of videos on category listing pages
define('VIDEO_PER_CATEGORY_PAGE', 15);

//Define No.of events on listing pages
define('EVENTS_PER_LISTING_PAGE', 15);

//Define No.of photos on editMyPhotos listing pages
define('PHOTO_PER_PAGE', 9);

/* Video Thumb Image Width*/
define('VIDEO_THUMB_WIDTH', 41);
define('VIDEO_THUMB_HEIGHT', 41);
/* change Video Thumb Image Width*/
define('GHANE_VIDEO_THUMB_WIDTH', 70);
define('GHANE_VIDEO_THUMB_HEIGHT', 70);

define('GHANE_VIDEO_LIST_THUMB_WIDTH', 50);
define('GHANE_VIDEO_LIST_THUMB_HEIGHT', 50);

//Define total no.of pages to be displayed in the page display lsit
define('SHOW_PAGE_LIST', 5);

//Define the Chat Time format
define('CHAT_TIME_FORMAT', '%I:%M %p');

//Define Archive video's count
define('ARCHIVE_VIDEO_COUNT', 9);

//Define More Video's count
define('MORE_VIDEO_COUNT', 4);
define('CHANGE_VIDEO_COUNT', 12);
define('USER_LIST_COUNT', 30);
define('VIDEO_LIST_COUNT', 10);

// forum display count sttings
define('FORUM_LIST_COUNT', 30);
define('FORUM_THREAD_COUNT', 10);

//Define Chat Stats
define('CHAT_ONLINE', 1);
define('CHAT_OFFLINE', 0);

define('MAX_FILE_UPLOAD_SIZE', ini_get('upload_max_filesize'));

define('CATEGORY_PER_PAGE', 20);

define('USER_PROFILE_IMAGE_WIDTH', 234);
define('USER_PROFILE_IMAGE_HEIGHT', 234);

define('USER_PROFILE_IMAGE_XWIDTH', 60);
define('USER_PROFILE_IMAGE_XHEIGHT', 60);

define('HOME_THUMB_EVENTS_WIDTH', 200);
define('HOME_THUMB_EVENTS_HEIGHT', 115);

/* photo view size */
define('PHOTOVIEW_WIDTH', 300);
define('PHOTOVIEW_HEIGHT', 400);



define('POFILE_IMAGE_ERR', 'Image is not uploading. Image size should be above 234 pixels (width) X 234 pixels (height)');
define('EVENT_IMAGE_ERR', 'Image is not uploading. Image size should be above 700 pixels (width) X 400 pixels (height)');

//Define No of rows for invite table
define('INVITE_TOTAL_PERSON', 2);

//Home Page User Count
define('HOME_USER_COUNT', 15);

define('HOME_THUMB_EVENTS_WIDTH', 200);
define('HOME_THUMB_EVENTS_HEIGHT', 115);

define('EVENT_IMAGE_WIDTH', 700);
define('EVENT_IMAGE_HEIGHT', 400);

define('BAND_IMAGE_WIDTH', 658);
define('BAND_IMAGE_HEIGHT',300);

define('BAND_SHOWPREVIEW_IMAGE_WIDTH', 329);
define('BAND_SHOWPREVIEW_IMAGE_HEIGHT',150);

define('BASE_PATH', '/var/www/html/www.linkmusicians.com');


//Modules not require authorization
$nonAuthorizeModuleArr = array('videoList', 'bands', 'comment', 'members', 'userVideoList', 'friend', 'band', 'bandDetail','profileRecentVideo', 'bandInfo', 'photoList', 'bandPhoto', 'bandVideo', 'bandEvent', 'editBandPhotos', 'editBandVideo');
//
?>