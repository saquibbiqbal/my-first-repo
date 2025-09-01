<?php
//Web Settings dynamic
require_once '../app/libraries/Database.php';
$db = new Database();

$model = 'WebSettingModel';
require_once APPROOT . '/models/' . $model . '.php'; //calling Web Settings model

$modal = new WebSettingModel();
$data = $modal->getDataAllData(); //pulling data from Web Settings model
$key_names = array();

foreach ($data as $val) {
    array_push($key_names, $val->name);
    if ($val->status == 1) {
        defined($val->name) or define($val->name, $val->value); //defining Web Settings keys and respective values from database
    } else {
        define($val->name, ''); //defining Web Settings keys and respective values from database for status "0"
    }
}
if (!in_array("SET_COUNTRY", $key_names)) {
    define('SET_COUNTRY', 'US'); //defining Web Settings keys and respective values forcefully for blank database result.
}
if (!in_array("URLROOT", $key_names)) {
    define('URLROOT', 'http://localhost/paiden/public'); //defining Web Settings keys and respective values forcefully for blank database result.
}
if (!in_array("SITENAME", $key_names)) {
    define('SITENAME', ''); //defining Web Settings keys and respective values forcefully for blank database result.
}
if (!in_array("FOOTER_NOTICE", $key_names)) {
    define('FOOTER_NOTICE', ''); //defining Web Settings keys and respective values forcefully for blank database result.
}
if (!in_array("APPVERSION", $key_names)) {
    define('APPVERSION', '1.15.0'); //defining Web Settings keys and respective values forcefully for blank database result.
}
if (!in_array("ALLOWED_HOSTS", $key_names)) {
    define('ALLOWED_HOSTS', URLROOT); //defining Web Settings keys and respective values forcefully for blank database result.
}
if (!in_array("RATE_LIMIT", $key_names)) {
    define('RATE_LIMIT', 10); //defining Web Settings keys and respective values forcefully for blank database result.
}
if (!in_array("RATE_TIME_FRAME", $key_names)) {
    define('RATE_TIME_FRAME', 60); //defining Web Settings keys and respective values forcefully for blank database result.
}

//Middleware Default Settings
if (!in_array("ALLOWED_HOSTS", $key_names)) {
    define('ALLOWED_HOSTS', URLROOT); //defining Web Settings keys and respective values forcefully for blank database result.
}
if (!in_array("RATE_LIMIT", $key_names)) {
    define('RATE_LIMIT', 10); //defining Web Settings keys and respective values forcefully for blank database result.
}
if (!in_array("RATE_TIME_FRAME", $key_names)) {
    define('RATE_TIME_FRAME', 60); //defining Web Settings keys and respective values forcefully for blank database result.
}

//Web APIs dynamic
$webmodel = 'WebApiModel';
require_once APPROOT . '/models/' . $webmodel . '.php'; //calling Web Api model
$webmodal = new WebApiModel();
$webdata = $webmodal->getwebData(); //pulling data from Web Api model

foreach ($webdata as $webval) {
    if ($webval->status == 1) {
        defined($webval->key_name) or define($webval->key_name, $webval->key_value); //defining Web Api keys and respective values from database
    } else {
        define($webval->key_name, ''); //defining Web Api keys and respective values from database for status "0"
    }
}


$organization_arr = ["1" => "Default"];

define("ORGANIZATION", $organization_arr);
$webmodel = 'WebApiModel';
require_once APPROOT . '/models/' . $webmodel . '.php'; //calling Web Api model
$webmodal = new WebApiModel();
$firebasedata = $webmodal->getfirebaseData(); //pulling data from Web Api model
//Whether email is unique, to make unique , make IS_EMAIL_UNIQUE true in web_settings from admin panel
defined("IS_EMAIL_UNIQUE") or define("IS_EMAIL_UNIQUE", '0');
foreach ($firebasedata as $firebaseval) {
    if ($firebaseval->apiKey != ' ') {
        define('APIKEY', $firebaseval->apiKey);
    } else {
        define('APIKEY', '');
    }

    if ($firebaseval->authDomain != ' ') {
        define('AUTHDOMAIN', $firebaseval->authDomain);
    } else {
        define('AUTHDOMAIN', '');
    }

    if ($firebaseval->databaseURL != ' ') {
        define('DATABASEURL', $firebaseval->databaseURL);
    } else {
        define('DATABASEURL', '');
    }

    if ($firebaseval->projectId != ' ') {
        define('PROJECTID', $firebaseval->projectId);
    } else {
        define('PROJECTID', '');
    }

    if ($firebaseval->storageBucket != ' ') {
        define('STORAGEBUCKET', $firebaseval->storageBucket);
    } else {
        define('STORAGEBUCKET', '');
    }

    if ($firebaseval->messagingSenderId != ' ') {
        define('MESSAGINGSENDERID', $firebaseval->messagingSenderId);
    } else {
        define('MESSAGINGSENDERID', '');
    }

    if ($firebaseval->appId != ' ') {
        define('APPID', $firebaseval->appId);
    } else {
        define('APPID', '');
    }

    if ($firebaseval->measurementId != ' ') {
        define('MEASUREMENTID', $firebaseval->measurementId);
    } else {
        define('MEASUREMENTID', '');
    }
}

//Mail Settings dynamic
$MailSettingModel = 'MailSettingModel';
require_once APPROOT . '/models/' . $MailSettingModel . '.php'; //calling Mail Settings model
$mailsettingmodel = new MailSettingModel();
$mailsettingdata = $mailsettingmodel->getData(); //pulling data from Mail Settings model

foreach ($mailsettingdata as $mailsettingval) {
    if ($mailsettingval->status == 1) {
        //define($mailsettingval->key_name,$mailsettingval->key_value); //defining Mail Settings keys and respective values from database
    }
}

//Mail Configuration dynamic
$mailmodel = 'MailConfigurationModel';
require_once APPROOT . '/models/' . $mailmodel . '.php'; //calling Mail Configuration model
$mailmodal = new MailConfigurationModel();
$maildata = $mailmodal->getmailData(); //pulling data from Mail Configuration model


//define('COPYRIGHT','Total AI Systems LLC');
//define('PAYMENT_RECEIPT_MESSAGE','We have received your check.Thank you for payment.');

//Debugging? : true or false (1 or 0)
define('DEBUG', false);


//************* */
//SMTP
//Mail Configuration dynamic
if ($maildata == '') {
    //defining Mail Configuration parameters forcefully for blank database result.
    define('PORT', '');
    define('HOST', '');
    define('AUTH_USERNAME', '');
    define('AUTH_PASSWORD', '');
} else {
    //defining Mail Configuration parameters from database
    define('PORT', $maildata->port);
    define('HOST', $maildata->host);
    define('AUTH_USERNAME', $maildata->uname);
    define('AUTH_PASSWORD', $maildata->pass);
}

//htaccess auth
define("HTTP_SERVICE_AUTH", 1);
define("HTTP_SERVICE_AUTH_USERNAME", 'ftpupload');
define("HTTP_SERVICE_AUTH_PASSWORD", 'Ftp123456');

//RabbitMQ Queues
//define("RABBITMQ_QUEUES",['tc_media_traverse1','tc_media_traverse2','tc_media_traverse3','tc_media_traverse4']);
//define("RABBITMQ_GENERAL_QUEUE","tc_general_traverse");

//RabbitMQ Queues
$q_identifier = "__Add a queue identifier__";
define("RABBITMQ_COLLECTIONS_GENERAL_QUEUES", [$q_identifier.'_media_traverse1', $q_identifier.'_media_traverse2']);
define("RABBITMQ_COLLECTIONS_EMAIL_QUEUES", [$q_identifier.'_collections_email_traverse1', $q_identifier.'_collections_email_traverse2']);
define("RABBITMQ_COLLECTIONS_SMS_QUEUES", [$q_identifier.'_collections_sms_traverse1', $q_identifier.'_collections_sms_traverse2']);
define("RABBITMQ_COLLECTIONS_PHONECALL_QUEUES", [$q_identifier.'_collections_phonecall_traverse1', $q_identifier.'_collections_phonecall_traverse2']);
define("RABBITMQ_COLLECTIONS_PUSH_QUEUES", [$q_identifier.'_collections_push_traverse1', $q_identifier.'_collections_push_traverse2']);
define("RABBITMQ_COLLECTIONS_MAILLETTER_QUEUES", [$q_identifier.'_collections_mailletter_traverse1', $q_identifier.'_collections_mailletter_traverse2']);
define("RABBITMQ_COLLECTIONS_DIRECTMESSAGE_QUEUES", [$q_identifier.'_collections_directmessage_traverse1', $q_identifier.'_collections_directmessage_traverse2']);
define("RABBITMQ_GENERAL_QUEUE", "qa_general_traverse");
define("RABBITMQ_SMS_WEBHOOK_QUEUES", [$q_identifier.'_sms_webhook_traverse1', $q_identifier.'_sms_webhook_traverse2']);
define("RABBITMQ_SYSTEM_QUEUES", [$q_identifier.'_system_traverse1', $q_identifier.'_system_traverse2']);
define("RABBITMQ_SENDGRID_WEBHOOK_QUEUES",[$q_identifier.'_sendgrid_webhook_traverse1',$q_identifier.'_sendgrid_webhook_traverse2']);
//SMS length for 1 segment
define("SMS_SEGMENT_LENGTH", 153);

//Will communication be logged based on return status or irrespective of return status?
define("COMMUNICATIONS_LOG_MODE", 0); //0=Irrespective of return status 1=Based on return status

//This will report any error to the TotalCollectR support team by email true/false(boolean)
define("ERROR_REPORT_SUPPORT_COMMUNICATION", false);

//firebase credential
define test
define("FIREBASE_DATABASE_URL", 'https://totalcollectr-829d3-default-rtdb.firebaseio.com/');
define("FIREBASE_JSON", 'totalcollectr-829d3-firebase-adminsdk-i66nf-15aa15ccdf.json');
define("CHAT_SEVER", 'https://chat2.totalaichat.com/');
//  define("CHAT_SEVER",'https://sms.totalaichat.com/');
define("DEFAULT_CHAT_SEVER", 'https://chat2.totalaichat.com/');
define("CHAT_SEVER_DB_A", '__add your db name for chat__');
define("ENCYPTED_KEY", '0Tt5M74lGoIZL1LorQuLTHM8zl(h4S<]HiO');

//define("CHAT_SEVER",'http://localhost:7000/');
//define("CHAT_SEVER_DB_A",'dbcon_13');


/*
 rulebased settlement payment settings duration type
*/
$duration_type = ["1" => "Account Open Date", "2" => "Last Payment Date", "3" => "Chargeoff Date", "4" => "Placement Date"];
define("DURATION_TYPE", $duration_type);
/*
 rulebased settlement payment settings duration age
*/
$duration_age = ["30" => "0 - 30 days", "60" => "31 - 60 days", "90" => "61 - 90 days", "120" => "91 - 120 days", "150" => "121 - 150 days", "180" => "151 - 180 days", "99999999999" => "180+ days"];
define("DURATION_AGE", $duration_age);

define("DECLINED_TIMEZONE", 'America/New_York');


define("ERROR_103_INVALID_POST_REQUEST", 'Error 103 - Invalid POST Request received. You are not authorized to call this function directly or did not pass the appropriate POST data in your request. Please contact an Administrator for more information. ');

define("ERROR_104", 'Error 104 - Invalid/Error Response During AJAX Call. There was an error during the AJAX POST/GET request which returned an invalid JSON response. Please contact an Administrator for more information.');

define("ERROR_105", '105 - Invalid/Error/Unexpected Response During VSFTP import/export/delete process.');

//Confirmation message for customers blacklisting
define("BLACKLIST_REQUEST_MESSAGE", 'Thank you! You will no longer receive text messages to this telephone number.');

//Country Code Glossary
if (defined('SET_COUNTRY')) {
    switch (SET_COUNTRY) {
        case 'US':
            define("SSN_VARIANT", 'SSN');
            define("SSN_VARIANT_FULL", 'Social Security Number');
            break;
        case 'CA':
            define("SSN_VARIANT", 'SIN');
            define("SSN_VARIANT_FULL", 'Social Insurance Number');
            break;
        default:
            define("SSN_VARIANT", 'SSN');
            define("SSN_VARIANT_FULL", 'Social Security Number');
    }
} else {
    define("SSN_VARIANT", 'SSN');
    define("SSN_VARIANT_FULL", 'Social Security Number');
}


/*Central Message Setttings*/
defined('CENTRAL_MSG_FETCH_URL') or define('CENTRAL_MSG_FETCH_URL', URLROOT . "/CentralPlaceMsg/fetchMessages/");
defined('CENTRAL_MSG_SAVE_URL') or define('CENTRAL_MSG_SAVE_URL', URLROOT . "/CentralPlaceMsg/saveMessage/");
defined('CENTRAL_MSG_DELETE_URL') or define('CENTRAL_MSG_DELETE_URL', URLROOT . "/CentralPlaceMsg/deleteMessage/");

/*CLIENT_AUTH  is unique and required for every Team Member who send and see messages set in Websettings  */

defined('CARD_TYPE') or define('CARD_TYPE', 'CARD PAYMENT');

define('APPPATH', dirname(dirname(dirname(__FILE__))));
// defining e-signature maximum file size upload in MB
define('ESIGNFILESIZE', 2);
define('ESIGNFORMATS', [
    'image/jpeg',
    'image/png'
]);
define('ESIGNFORMATSSTRING', "jpeg , jpg and png");
//Configuration Wizard Settings
require_once APPROOT . '/models/ConfigurationWizardModel.php';
$configurationwizardmodal = new ConfigurationWizardModel();
$configurationwizarddata = $configurationwizardmodal->getRow();
if (isset($configurationwizarddata->id)) {
    defined('CONFIGURATION_WIZARD_STATUS') or define('CONFIGURATION_WIZARD_STATUS', $configurationwizarddata->status);
    defined('CONFIGURATION_WIZARD_STEP') or define('CONFIGURATION_WIZARD_STEP', $configurationwizarddata->step);
    defined('CONFIGURATION_WIZARD_DRAFT') or define('CONFIGURATION_WIZARD_DRAFT', json_decode($configurationwizarddata->draft));
} else {
    //Create new entry
    $configurationwizardmodal->insertRow();
    defined('CONFIGURATION_WIZARD_STATUS') or define('CONFIGURATION_WIZARD_STATUS', 0);
    defined('CONFIGURATION_WIZARD_STEP') or define('CONFIGURATION_WIZARD_STEP', 0);
    defined('CONFIGURATION_WIZARD_DRAFT') or define('CONFIGURATION_WIZARD_DRAFT', []);
}

//Chatbot AI Controls
//Configuration Wizard Settings
require_once APPROOT . '/models/ChatsettingModel.php';
$chatsettingModel = new ChatsettingModel();
$chat_configuration = $chatsettingModel->getRowData();
if (!empty($chat_configuration) && isset($chat_configuration->chatbot_ai_conversation) && $chat_configuration->chatbot_ai_conversation == 1) {
    define("CHATBOT_AI_CONVERSATION", true);
} else {
    define("CHATBOT_AI_CONVERSATION", false);
}

//Linked Account Number Activation For Login
define("LINKED_ACCOUNT_LOGIN", TRUE);

//CSV UTF Conversion
define("CSV_UTF_8_CONVERSION", false);

//CSV Chunk splitting
define("CSV_CHUNK_SPLITTING", true); //Enable = true, Disable = false
define("CSV_CHUNK_SPLITTING_SIZE", 100000); //Number of rows per chunk

defined('CENTERALSYSTEM_HOLIDAYS_LIST') or define('CENTERALSYSTEM_HOLIDAYS_LIST', getenv("HOLIDAYLIST_JSON"));

define('CSS_DIR_NAME', 'default'); //defining the css directory name for the common css. In case of client instance the value will be according to the instance css folder name

defined('CSRF_TOKEN_EXPIRY') or define('CSRF_TOKEN_EXPIRY', 900); // 15 minutes
